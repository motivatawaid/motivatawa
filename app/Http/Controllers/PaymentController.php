<?php

namespace App\Http\Controllers;

use App\Mail\PurchaseConfirmationMail;
use Illuminate\Http\Request;
use Midtrans\Config;
use App\Models\Ticket;
use App\Models\Purchase;
use Illuminate\Support\Str;
use Midtrans\Snap;
use Illuminate\Support\Facades\Log;
use Illuminate\Support\Facades\Mail;
use Midtrans\Transaction;

class PaymentController extends Controller
{
    public function __construct()
    {
        // Set konfigurasi Midtrans
        Config::$serverKey = config('midtrans.server_key');
        Config::$clientKey = config('midtrans.client_key');
        Config::$isProduction = config('midtrans.is_production', false);
        Config::$isSanitized = config('midtrans.is_sanitized', true);
        Config::$is3ds = config('midtrans.is_3ds', true);
    }

    public function createSnapToken(Request $request)
    {
        try {
            $request->validate([
                'type' => 'required|in:ticket,video',
                'item_id' => 'required|integer',
            ]);

            $user = $request->user();
            $type = $request->type;
            $itemId = $request->item_id;

            // Ambil item berdasarkan tipe
            if ($type === 'ticket') {
                $item = Ticket::where('id', $itemId)
                    ->where('user_id', $user->id)
                    ->with('event')
                    ->first();

                if (!$item || !$item->event) {
                    return response()->json([
                        'success' => false,
                        'error' => 'Tiket tidak ditemukan'
                    ], 404);
                }

                $amount = $item->event->price;
                $name = $item->event->title;
            } else {
                $item = Purchase::where('id', $itemId)
                    ->where('user_id', $user->id)
                    ->with('video')
                    ->first();

                if (!$item || !$item->video) {
                    return response()->json([
                        'success' => false,
                        'error' => 'Video tidak ditemukan'
                    ], 404);
                }

                $amount = $item->video->price;
                $name = $item->video->title;
            }

            if (!$amount || $amount <= 0) {
                return response()->json([
                    'success' => false,
                    'error' => 'Harga tidak valid'
                ], 400);
            }

            // Generate unique order ID
            $orderId = 'ORD-' . strtoupper(Str::random(10)) . '-' . time();

            // Siapkan parameter transaksi
            $params = [
                'transaction_details' => [
                    'order_id' => $orderId,
                    'gross_amount' => (int)$amount,
                ],
                'item_details' => [
                    [
                        'id' => $type . '-' . $item->id,
                        'price' => (int)$amount,
                        'quantity' => 1,
                        'name' => $name,
                    ]
                ],
                'customer_details' => [
                    'first_name' => $user->name,
                    'email' => $user->email,
                ],
            ];

            // Dapatkan Snap Token
            $snapToken = Snap::getSnapToken($params);

            // Update item dengan order_id
            $item->update([
                'midtrans_order_id' => $orderId,
                'midtrans_status' => 'pending'
            ]);

            return response()->json([
                'success' => true,
                'snap_token' => $snapToken
            ]);
        } catch (\Exception $e) {
            Log::error('Midtrans Error: ' . $e->getMessage());

            return response()->json([
                'success' => false,
                'error' => 'Gagal membuat pembayaran: ' . $e->getMessage()
            ], 500);
        }
    }

    // Method baru: Verify status & update DB setelah onSuccess
    public function verifyStatus(Request $request)
    {
        try {
            $request->validate(['order_id' => 'required|string']);

            $orderId = $request->order_id;

            // Poll status real-time dari Midtrans API
            $statusData = Transaction::status($orderId);
            Log::info('Midtrans API status poll', ['order_id' => $orderId, 'data' => $statusData]);

            // Fixed: Access as object properties since $statusData is stdClass
            $transactionStatus = $statusData->transaction_status ?? '';
            $fraudStatus = strtolower($statusData->fraud_status ?? '');
            $paymentType = $statusData->payment_type ?? '';

            // Cari model (ticket atau purchase) dengan eager load
            $ticket = Ticket::with('event')->where('midtrans_order_id', $orderId)->first();
            $purchase = Purchase::with('video')->where('midtrans_order_id', $orderId)->first();
            $model = $ticket ?: $purchase;

            if (!$model) {
                Log::warning('Model not found for order_id: ' . $orderId);
                return response()->json(['success' => false, 'error' => 'Order tidak ditemukan'], 404);
            }

            $user = $model->user; // Pastikan relasi user ada di model Ticket dan Purchase
            $amount = $ticket?->event?->price ?? $purchase?->video?->price ?? 0;
            $itemName = $ticket?->event?->title ?? $purchase?->video?->title ?? '';
            $type = $ticket ? 'ticket' : 'video';

            // Idempotent: Jika sudah 'purchased', skip
            if ($model->status === 'purchased') {
                return response()->json([
                    'success' => true,
                    'status' => 'success',
                    'message' => 'Status sudah aktif sebelumnya.'
                ]);
            }

            // Match status
            $status = match (true) {
                ($transactionStatus === 'settlement') => 'success',
                ($transactionStatus === 'capture' && $fraudStatus === 'accept') => 'success',
                in_array($transactionStatus, ['deny', 'cancel', 'expire']) => 'failed',
                default => 'pending',
            };

            if ($status === 'success') {
                $model->update([
                    'status' => 'purchased',
                    'price_paid' => $amount,
                    'midtrans_status' => $status
                ]);

                if ($ticket && $amount > 0) {
                    $ticket->event->decrement('quota');
                }

                // 🔥 KIRIM EMAIL KONFIRMASI
                try {
                    Mail::to($user->email)->send(new PurchaseConfirmationMail(
                        $user,
                        $itemName,
                        $type,
                        $amount
                    ));
                    Log::info('Purchase confirmation email sent', [
                        'user_id' => $user->id,
                        'email' => $user->email,
                        'order_id' => $orderId
                    ]);
                } catch (\Exception $emailException) {
                    Log::error('Failed to send purchase confirmation email: ' . $emailException->getMessage(), [
                        'user_id' => $user->id,
                        'order_id' => $orderId
                    ]);
                    // Jangan return error, karena pembayaran sudah sukses
                }

                Log::info('Manual verify success - Updated to purchased', ['order_id' => $orderId, 'amount' => $amount]);
                $message = $ticket ? 'Tiket Anda telah aktif!' : 'Akses video Anda telah aktif!';
            } elseif ($status === 'failed') {
                $model->update(['status' => 'cancelled', 'midtrans_status' => $status]);
                Log::info('Manual verify failed', ['order_id' => $orderId]);
                $message = 'Pembayaran gagal - Silakan coba lagi.';
            } else {
                $model->update(['midtrans_status' => $status]);
                Log::info('Manual verify pending', ['order_id' => $orderId, 'status' => $status]);
                $message = 'Status sedang diproses - Cek riwayat sebentar lagi.';
            }

            return response()->json([
                'success' => true,
                'status' => $status,
                'message' => $message
            ]);
        } catch (\Exception $e) {
            Log::error('Verify status error: ' . $e->getMessage(), ['order_id' => $request->order_id]);
            return response()->json(['success' => false, 'error' => 'Gagal verifikasi: ' . $e->getMessage()], 500);
        }
    }
}
