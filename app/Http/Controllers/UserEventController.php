<?php

namespace App\Http\Controllers;

use App\Models\Event;
use App\Models\Ticket;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Log;

class UserEventController extends Controller
{
    public function index()
    {
        $events = Event::where('start_date', '>', now())
            ->where('quota', '>', 0)
            ->with(['talent'])
            ->latest('start_date')
            ->paginate(12);

        $ownedTicketEventIds = auth()->user()
            ->tickets()
            ->where('status', 'purchased')
            ->pluck('event_id')
            ->toArray();

        return view('user.events.index', compact('events', 'ownedTicketEventIds'));
    }

    public function show(Event $event)
    {
        $user = auth()->user();
        $ticket = $user->tickets()->where('event_id', $event->id)->where('status', 'purchased')->first();

        if (!$ticket && $event->start_date < now()) {
            return back()->with('error', 'Event ini sudah berlangsung atau berakhir.');
        }

        $event->load('talent');

        return view('user.events.show', compact('event', 'ticket'));
    }

    public function buy(Request $request, Event $event)
    {
        $user = $request->user();

        // Validasi quota
        if ($event->quota <= 0) {
            return back()->with('error', 'Maaf, kuota untuk event ini sudah habis.');
        }

        // Validasi event belum mulai
        if ($event->start_date < now()) {
            return back()->with('error', 'Event ini sudah berlangsung atau berakhir.');
        }

        // Handle existing ticket
        $ticket = $user->tickets()->where('event_id', $event->id)->first();

        if ($ticket) {
            if ($ticket->status === 'purchased') {
                return back()->with('error', 'Anda sudah memiliki akses untuk event ini.');
            } else {
                // Reset to pending for new payment attempt
                $ticket->update([
                    'status' => 'pending',
                    'price_paid' => 0,
                    'midtrans_order_id' => null,
                    'midtrans_status' => null,
                ]);
            }
        } else {
            try {
                // Buat ticket sementara dalam transaction
                $ticket = DB::transaction(function () use ($user, $event) {
                    return Ticket::create([
                        'event_id' => $event->id,
                        'user_id' => $user->id,
                        'price_paid' => 0,
                        'status' => 'pending',
                    ]);
                });
            } catch (\Exception $e) {
                Log::error('Error buy event: ' . $e->getMessage());
                return back()->with('error', 'Terjadi kesalahan saat memproses pembelian. Silakan coba lagi.');
            }
        }

        return view('user.events.checkout', compact('ticket', 'event'));
    }
}
