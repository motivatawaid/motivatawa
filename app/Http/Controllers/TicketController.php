<?php

namespace App\Http\Controllers;

use App\Models\Event;
use App\Models\Ticket;
use App\Models\User;
use Illuminate\Http\Request;
use Yajra\DataTables\Facades\DataTables;

class TicketController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index(Request $request)
    {
        if ($request->ajax()) {
            $query = Ticket::with(['event', 'user'])->whereHas('event', function ($q) {
                $q->where('talent_id', auth()->id());
            });
            return DataTables::of($query)
                ->editColumn('status', function ($row) {
                    $badgeClass = match ($row->status) {
                        'pending' => 'warning',
                        'purchased' => 'success',
                        'cancelled' => 'danger',
                        default => 'secondary'
                    };
                    return '<span class="badge badge-' . $badgeClass . '">' . ucfirst($row->status) . '</span>';
                })
                ->editColumn('price_paid', function ($row) {
                    return 'Rp. ' . number_format($row->price_paid, 0, ',', '.');
                })
                ->addColumn('event_title', function ($row) {
                    return $row->event?->title ?? 'N/A';
                })
                ->addColumn('user_name', function ($row) {
                    return $row->user?->name ?? 'N/A';
                })
                ->addColumn('aksi', function ($row) {
                    return '<a href="' . route('tickets.edit', $row->id) . '" class="btn btn-sm btn-warning mr-2">Edit</a>
                            <form action="' . route('tickets.destroy', $row->id) . '" method="POST" style="display: inline;">
                                <input type="hidden" name="_method" value="DELETE">
                                <input type="hidden" name="_token" value="' . csrf_token() . '">
                                <button type="submit" class="btn btn-sm btn-danger" onclick="return confirm(\'Yakin ingin menghapus?\')">Delete</button>
                            </form>';
                })
                ->rawColumns(['status', 'aksi'])
                ->make(true);
        }

        return view('pages.tickets.index');
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        $events = Event::where('talent_id', auth()->id())->get(); // Pass events milik talent
        $users = User::where('role', 'user')->get(); // Pass users (filter role jika perlu)

        return view('pages.tickets.create', compact('events', 'users'));
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        // Validasi inline
        $request->validate([
            'event_id' => 'required|exists:events,id',
            'user_id' => 'required|exists:users,id',
            'price_paid' => 'required|numeric|min:0',
            'status' => 'required|in:pending,purchased,cancelled',
        ]);

        // Cek ownership event
        $event = Event::where('id', $request->event_id)->where('talent_id', auth()->id())->firstOrFail();

        // Cek unique combination
        $existing = Ticket::where('event_id', $request->event_id)
            ->where('user_id', $request->user_id)
            ->exists();
        if ($existing) {
            return back()->with('error', 'Kombinasi event dan user sudah ada.');
        }

        $data = [
            'event_id' => $request->event_id,
            'user_id' => $request->user_id,
            'price_paid' => $request->price_paid,
            'status' => $request->status,
        ];

        Ticket::create($data);

        return redirect('tickets')->with('toast', 'showToast("Data berhasil disimpan")');
    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(string $id)
    {
        $item = Ticket::whereHas('event', function ($q) {
            $q->where('talent_id', auth()->id());
        })->findOrFail($id);

        $events = Event::where('talent_id', auth()->id())->get(); // Pass events untuk select
        $users = User::where('role', 'user')->get(); // Pass users untuk select

        return view('pages.tickets.edit', compact('item', 'events', 'users'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        // Validasi inline
        $request->validate([
            'event_id' => 'required|exists:events,id',
            'user_id' => 'required|exists:users,id',
            'price_paid' => 'required|numeric|min:0',
            'status' => 'required|in:pending,purchased,cancelled',
        ]);

        $ticket = Ticket::whereHas('event', function ($q) {
            $q->where('talent_id', auth()->id());
        })->findOrFail($id);

        // Cek ownership event jika diubah
        if ($request->event_id != $ticket->event_id) {
            $event = Event::where('id', $request->event_id)->where('talent_id', auth()->id())->firstOrFail();
        }

        // Cek unique combination excluding current record
        $existing = Ticket::where('event_id', $request->event_id)
            ->where('user_id', $request->user_id)
            ->where('id', '!=', $id)
            ->exists();
        if ($existing) {
            return back()->with('error', 'Kombinasi event dan user sudah ada untuk tiket lain.');
        }

        $data = [
            'event_id' => $request->event_id,
            'user_id' => $request->user_id,
            'price_paid' => $request->price_paid,
            'status' => $request->status,
        ];

        $ticket->update($data);

        return redirect('tickets')->with('toast', 'showToast("Data berhasil diupdate")');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        $ticket = Ticket::whereHas('event', function ($q) {
            $q->where('talent_id', auth()->id());
        })->findOrFail($id);
        $ticket->delete();

        return redirect()->back()->with('toast', 'showToast("Data berhasil dihapus")');
    }
}
