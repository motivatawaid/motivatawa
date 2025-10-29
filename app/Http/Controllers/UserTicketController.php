<?php

namespace App\Http\Controllers;

use App\Models\Ticket;

class UserTicketController extends Controller
{
    public function index()
    {
        $tickets = auth()->user()
            ->tickets()
            ->with(['event.talent'])
            ->where('status', 'purchased')
            ->latest()
            ->paginate(12);

        return view('user.tickets.index', compact('tickets'));
    }

    public function show(Ticket $ticket)
    {
        // Manual check ownership (karena tidak ada policy)
        if ($ticket->user_id !== auth()->id()) {
            abort(403, 'Akses ditolak. Ini bukan tiket Anda.');
        }

        if ($ticket->status !== 'purchased') {
            abort(404, 'Tiket tidak ditemukan atau belum dibayar.');
        }

        $ticket->load(['event.talent']);

        return view('user.tickets.show', compact('ticket'));
    }
}
