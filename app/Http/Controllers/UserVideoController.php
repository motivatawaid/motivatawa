<?php

namespace App\Http\Controllers;

use App\Models\Purchase;
use App\Models\Video;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class UserVideoController extends Controller
{
    public function index()
    {
        $videos = Video::with('talent')
            ->where('price', '>', 0)
            ->latest()
            ->paginate(12);

        $purchasedVideoIds = auth()->user()
            ->purchases()
            ->where('status', 'purchased')
            ->pluck('video_id')
            ->toArray();

        return view('user.videos.index', compact('videos', 'purchasedVideoIds'));
    }

    public function show(Video $video)
    {
        $user = auth()->user();
        $purchase = $user->purchases()->where('video_id', $video->id)->where('status', 'purchased')->first();

        if (!$purchase && $video->price > 0) {
            return view('user.videos.show', compact('video', 'purchase'));
        }

        $video->load('talent');

        return view('user.videos.show', compact('video', 'purchase'));
    }

    public function buy(Request $request, Video $video)
    {
        $user = $request->user();

        if (!$video || $video->price <= 0) {
            return back()->with('error', 'Video tidak valid atau tidak tersedia untuk dibeli.');
        }

        // Handle existing purchase
        $purchase = $user->purchases()->where('video_id', $video->id)->first();

        if ($purchase) {
            if ($purchase->status === 'purchased') {
                return back()->with('error', 'Anda sudah membeli video ini.');
            } else {
                // Reset to pending for new payment attempt
                $purchase->update([
                    'status' => 'pending',
                    'price_paid' => 0,
                    'midtrans_order_id' => null,
                    'midtrans_status' => null,
                ]);
            }
        } else {
            try {
                $purchase = DB::transaction(function () use ($user, $video) {
                    return Purchase::create([
                        'video_id' => $video->id,
                        'user_id' => $user->id,
                        'price_paid' => 0,
                        'status' => 'pending',
                    ]);
                });
            } catch (\Exception $e) {
                return back()->with('error', 'Terjadi kesalahan saat memproses pembelian. Silakan coba lagi.');
            }
        }

        return view('user.videos.checkout', compact('video', 'purchase'));
    }
}
