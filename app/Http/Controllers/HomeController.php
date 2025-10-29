<?php

namespace App\Http\Controllers;

use App\Models\Event;
use App\Models\Purchase;
use App\Models\Ticket;
use App\Models\Video;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Log;
use Midtrans\Config;

class HomeController extends Controller
{
    /**
     * Constructor untuk inisialisasi Midtrans config
     */
    public function __construct()
    {
        // Set konfigurasi Midtrans
        $this->setMidtransConfig();
    }

    /**
     * Tampilkan halaman utama dengan event dan video terbaru
     */
    public function index(Request $request)
    {
        // Ambil event terbaru yang akan datang (batasi 6)
        $upcomingEvents = Event::where('start_date', '>=', now())
            ->with(['talent', 'tickets' => function ($query) {
                $query->where('status', 'purchased');
            }])
            ->orderBy('start_date', 'asc')
            ->take(6)
            ->get();

        // Ambil video terbaru (batasi 6)
        $latestVideos = Video::orderBy('created_at', 'desc')
            ->take(6)
            ->get();

        // Jika user sudah login, cek status pembelian
        if ($request->user()) {
            $user = $request->user();

            // Tambahkan status pembelian untuk setiap event
            $upcomingEvents->each(function ($event) use ($user) {
                $ticket = $user->tickets()
                    ->where('event_id', $event->id)
                    ->where('status', 'purchased')
                    ->first();

                $event->is_purchased = $ticket ? true : false;
                $event->ticket_id = $ticket ? $ticket->id : null;

                // Hitung sisa quota
                $event->remaining_quota = $event->remaining_quota;
                $event->sold_tickets = $event->sold_tickets;
            });

            // Tambahkan status pembelian untuk setiap video
            $latestVideos->each(function ($video) use ($user) {
                $purchase = $user->purchases()
                    ->where('video_id', $video->id)
                    ->where('status', 'purchased')
                    ->first();

                $video->is_purchased = $purchase ? true : false;
                $video->purchase_id = $purchase ? $purchase->id : null;
            });
        } else {
            // Untuk guest, tetap hitung sisa quota
            $upcomingEvents->each(function ($event) {
                $event->remaining_quota = $event->remaining_quota;
                $event->sold_tickets = $event->sold_tickets;
            });
        }

        return view('home', compact('upcomingEvents', 'latestVideos'));
    }

    /**
     * Tampilkan semua event yang tersedia
     */
    public function allEvent(Request $request)
    {
        $events = Event::with(['talent', 'tickets' => function ($query) {
            $query->where('status', 'purchased');
        }])
            ->orderBy('start_date', 'asc')
            ->paginate(12);

        // Hitung sisa quota untuk setiap event
        $events->getCollection()->transform(function ($event) {
            $event->remaining_quota = $event->remaining_quota;
            $event->sold_tickets = $event->sold_tickets;
            return $event;
        });

        // Jika user sudah login, cek status pembelian
        if ($request->user()) {
            $user = $request->user();

            $events->each(function ($event) use ($user) {
                $ticket = $user->tickets()
                    ->where('event_id', $event->id)
                    ->where('status', 'purchased')
                    ->first();

                $event->is_purchased = $ticket ? true : false;
                $event->ticket_id = $ticket ? $ticket->id : null;
            });
        }

        return view('events.all', compact('events'));
    }

    /**
     * Tampilkan semua video yang tersedia
     */
    public function allVideo(Request $request)
    {
        $videos = Video::orderBy('created_at', 'desc')
            ->paginate(12);

        // Jika user sudah login, cek status pembelian
        if ($request->user()) {
            $user = $request->user();

            $videos->each(function ($video) use ($user) {
                $purchase = $user->purchases()
                    ->where('video_id', $video->id)
                    ->where('status', 'purchased')
                    ->first();

                $video->is_purchased = $purchase ? true : false;
                $video->purchase_id = $purchase ? $purchase->id : null;
            });
        }

        return view('videos.all', compact('videos'));
    }

    /**
     * Set konfigurasi Midtrans
     */
    private function setMidtransConfig()
    {
        Config::$serverKey = config('midtrans.server_key');
        Config::$clientKey = config('midtrans.client_key');
        Config::$isProduction = config('midtrans.is_production', false);
        Config::$isSanitized = config('midtrans.is_sanitized', true);
        Config::$is3ds = config('midtrans.is_3ds', true);
    }

    /**
     * Get event data for API
     */
    /**
     * Get event data for API
     */
    public function getEvent(Event $event)
    {
        try {
            // Get talent data separately
            $talent = null;
            if ($event->talent_id) {
                $talent = User::find($event->talent_id);
            }

            // Hitung sisa quota
            $remainingQuota = $event->remaining_quota;
            $soldTickets = $event->sold_tickets;

            // Format the response data
            $responseData = [
                'id' => $event->id,
                'title' => $event->title,
                'description' => $event->description,
                'start_date' => $event->start_date,
                'end_date' => $event->end_date,
                'location' => $event->location,
                'quota' => $event->quota,
                'remaining_quota' => $remainingQuota,
                'sold_tickets' => $soldTickets,
                'has_available_quota' => $remainingQuota > 0,
                'price' => $event->price,
                'price_formatted' => $event->price_formatted,
                'thumbnail' => $event->thumbnail,
                'talent' => $talent ? [
                    'id' => $talent->id,
                    'name' => $talent->name,
                ] : null,
                'created_at' => $event->created_at,
                'updated_at' => $event->updated_at,
            ];

            return response()->json([
                'success' => true,
                'data' => $responseData
            ]);
        } catch (\Exception $e) {
            Log::error('Error fetching event: ' . $e->getMessage());
            return response()->json([
                'success' => false,
                'error' => 'Terjadi kesalahan saat mengambil data event.'
            ], 500);
        }
    }

    /**
     * Get video data for API
     */
    public function getVideo(Video $video)
    {
        try {
            // Get talent data separately
            $talent = null;
            if ($video->talent_id) {
                $talent = User::find($video->talent_id);
            }

            // Format the response data
            $responseData = [
                'id' => $video->id,
                'title' => $video->title,
                'description' => $video->description,
                'video_path' => $video->video_path,
                'price' => $video->price,
                'price_formatted' => $video->price_formatted,
                'thumbnail' => $video->thumbnail,
                'talent' => $talent ? [
                    'id' => $talent->id,
                    'name' => $talent->name,
                ] : null,
                'created_at' => $video->created_at,
                'updated_at' => $video->updated_at,
            ];

            return response()->json([
                'success' => true,
                'data' => $responseData
            ]);
        } catch (\Exception $e) {
            Log::error('Error fetching video: ' . $e->getMessage());
            return response()->json([
                'success' => false,
                'error' => 'Terjadi kesalahan saat mengambil data video.'
            ], 500);
        }
    }

    /**
     * Create ticket for event purchase (untuk pembelian dari home)
     */
    public function createEventTicket(Request $request, Event $event)
    {
        try {
            $user = $request->user();

            // Validasi user sudah login
            if (!$user) {
                return response()->json([
                    'success' => false,
                    'error' => 'Silakan login terlebih dahulu.'
                ], 401);
            }

            // Validasi quota
            if ($event->quota <= 0) {
                return response()->json([
                    'success' => false,
                    'error' => 'Maaf, kuota untuk event ini sudah habis.'
                ], 400);
            }

            // Validasi event belum mulai
            if ($event->start_date < now()) {
                return response()->json([
                    'success' => false,
                    'error' => 'Event ini sudah berlangsung atau berakhir.'
                ], 400);
            }

            // Cek apakah user sudah memiliki ticket yang purchased
            $existingTicket = $user->tickets()
                ->where('event_id', $event->id)
                ->where('status', 'purchased')
                ->first();

            if ($existingTicket) {
                return response()->json([
                    'success' => false,
                    'error' => 'Anda sudah memiliki akses untuk event ini.'
                ], 400);
            }

            // Cari atau buat ticket pending
            $ticket = $user->tickets()
                ->where('event_id', $event->id)
                ->where('status', 'pending')
                ->first();

            if (!$ticket) {
                $ticket = DB::transaction(function () use ($user, $event) {
                    return Ticket::create([
                        'event_id' => $event->id,
                        'user_id' => $user->id,
                        'price_paid' => 0,
                        'status' => 'pending',
                    ]);
                });
            }

            return response()->json([
                'success' => true,
                'ticket_id' => $ticket->id,
                'message' => 'Ticket berhasil dibuat'
            ]);
        } catch (\Exception $e) {
            Log::error('Error creating event ticket: ' . $e->getMessage());
            return response()->json([
                'success' => false,
                'error' => 'Terjadi kesalahan saat memproses pembelian. Silakan coba lagi.'
            ], 500);
        }
    }

    /**
     * Create purchase for video (untuk pembelian dari home)
     */
    public function createVideoPurchase(Request $request, Video $video)
    {
        try {
            $user = $request->user();

            // Validasi user sudah login
            if (!$user) {
                return response()->json([
                    'success' => false,
                    'error' => 'Silakan login terlebih dahulu.'
                ], 401);
            }

            if (!$video || $video->price <= 0) {
                return response()->json([
                    'success' => false,
                    'error' => 'Video tidak valid atau tidak tersedia untuk dibeli.'
                ], 400);
            }

            // Cek apakah user sudah memiliki purchase yang purchased
            $existingPurchase = $user->purchases()
                ->where('video_id', $video->id)
                ->where('status', 'purchased')
                ->first();

            if ($existingPurchase) {
                return response()->json([
                    'success' => false,
                    'error' => 'Anda sudah membeli video ini.'
                ], 400);
            }

            // Cari atau buat purchase pending
            $purchase = $user->purchases()
                ->where('video_id', $video->id)
                ->where('status', 'pending')
                ->first();

            if (!$purchase) {
                $purchase = DB::transaction(function () use ($user, $video) {
                    return Purchase::create([
                        'video_id' => $video->id,
                        'user_id' => $user->id,
                        'price_paid' => 0,
                        'status' => 'pending',
                    ]);
                });
            }

            return response()->json([
                'success' => true,
                'purchase_id' => $purchase->id,
                'message' => 'Purchase berhasil dibuat'
            ]);
        } catch (\Exception $e) {
            Log::error('Error creating video purchase: ' . $e->getMessage());
            return response()->json([
                'success' => false,
                'error' => 'Terjadi kesalahan saat memproses pembelian. Silakan coba lagi.'
            ], 500);
        }
    }
}
