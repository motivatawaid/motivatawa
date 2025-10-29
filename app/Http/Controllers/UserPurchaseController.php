<?php

namespace App\Http\Controllers;

use App\Models\Purchase;

class UserPurchaseController extends Controller
{
    public function index()
    {
        $purchases = auth()->user()
            ->purchases()
            ->with(['video.talent'])
            ->where('status', 'purchased')
            ->latest()
            ->paginate(12);

        return view('user.purchases.index', compact('purchases'));
    }

    public function show(Purchase $purchase)
    {
        // Manual check ownership (karena tidak ada policy)
        if ($purchase->user_id !== auth()->id()) {
            abort(403, 'Akses ditolak. Ini bukan pembelian Anda.');
        }

        if ($purchase->status !== 'purchased') {
            abort(404, 'Pembelian video tidak ditemukan atau belum dibayar.');
        }

        $purchase->load(['video.talent']);

        return view('user.purchases.show', compact('purchase'));
    }
}
