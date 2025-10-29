<?php

namespace App\Http\Controllers;

use App\Models\Purchase;
use App\Models\User;
use App\Models\Video;
use Illuminate\Http\Request;
use Yajra\DataTables\Facades\DataTables;

class PurchaseController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index(Request $request)
    {
        if ($request->ajax()) {
            $query = Purchase::with(['video', 'user'])
                ->whereHas('video', function ($q) {
                    $q->where('talent_id', auth()->id());
                });

            return DataTables::of($query)
                ->editColumn('price_paid', function ($row) {
                    return 'Rp. ' . number_format($row->price_paid, 0, ',', '.');
                })
                ->editColumn('status', function ($row) {
                    $badgeClass = match ($row->status) {
                        'pending' => 'warning',
                        'purchased' => 'success',
                        'cancelled' => 'danger',
                        default => 'secondary'
                    };
                    return '<span class="badge badge-' . $badgeClass . '">' . ucfirst($row->status) . '</span>';
                })
                ->addColumn('video_title', function ($row) {
                    return $row->video?->title ?? 'N/A';
                })
                ->addColumn('user_name', function ($row) {
                    return $row->user?->name ?? 'N/A';
                })
                ->addColumn('aksi', function ($row) {
                    return '<a href="' . route('purchases.edit', $row->id) . '" class="btn btn-sm btn-warning mr-2">Edit</a>
                            <form action="' . route('purchases.destroy', $row->id) . '" method="POST" style="display: inline;">
                                <input type="hidden" name="_method" value="DELETE">
                                <input type="hidden" name="_token" value="' . csrf_token() . '">
                                <button type="submit" class="btn btn-sm btn-danger" onclick="return confirm(\'Yakin ingin menghapus?\')">Delete</button>
                            </form>';
                })
                ->rawColumns(['price_paid', 'status', 'aksi'])
                ->make(true);
        }

        return view('pages.purchases.index');
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        $videos = Video::where('talent_id', auth()->id())->get(); // Pass videos milik talent
        $users = User::where('role', 'user')->get(); // Pass users (filter role jika perlu)

        return view('pages.purchases.create', compact('videos', 'users'));
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        // Validasi inline
        $request->validate([
            'video_id' => 'required|exists:videos,id',
            'user_id' => 'required|exists:users,id',
            'price_paid' => 'required|numeric|min:0',
            'status' => 'required|in:pending,purchased,cancelled',
        ]);

        // Cek ownership video
        $video = Video::where('id', $request->video_id)->where('talent_id', auth()->id())->firstOrFail();

        // Cek unique combination
        $existing = Purchase::where('video_id', $request->video_id)
            ->where('user_id', $request->user_id)
            ->exists();
        if ($existing) {
            return back()->with('error', 'Kombinasi video dan user sudah ada.');
        }

        $data = [
            'video_id' => $request->video_id,
            'user_id' => $request->user_id,
            'price_paid' => $request->price_paid,
            'status' => $request->status,
        ];

        Purchase::create($data);

        return redirect('purchases')->with('toast', 'showToast("Data berhasil disimpan")');
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
        $item = Purchase::whereHas('video', function ($q) {
            $q->where('talent_id', auth()->id());
        })->findOrFail($id);

        $videos = Video::where('talent_id', auth()->id())->get(); // Pass videos untuk select
        $users = User::where('role', 'user')->get(); // Pass users untuk select

        return view('pages.purchases.edit', compact('item', 'videos', 'users'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        // Validasi inline
        $request->validate([
            'video_id' => 'required|exists:videos,id',
            'user_id' => 'required|exists:users,id',
            'price_paid' => 'required|numeric|min:0',
            'status' => 'required|in:pending,purchased,cancelled',
        ]);

        $purchase = Purchase::whereHas('video', function ($q) {
            $q->where('talent_id', auth()->id());
        })->findOrFail($id);

        // Cek ownership video jika diubah
        if ($request->video_id != $purchase->video_id) {
            $video = Video::where('id', $request->video_id)->where('talent_id', auth()->id())->firstOrFail();
        }

        // Cek unique combination excluding current record
        $existing = Purchase::where('video_id', $request->video_id)
            ->where('user_id', $request->user_id)
            ->where('id', '!=', $id)
            ->exists();
        if ($existing) {
            return back()->with('error', 'Kombinasi video dan user sudah ada untuk purchase lain.');
        }

        $data = [
            'video_id' => $request->video_id,
            'user_id' => $request->user_id,
            'price_paid' => $request->price_paid,
            'status' => $request->status,
        ];

        $purchase->update($data);

        return redirect('purchases')->with('toast', 'showToast("Data berhasil diupdate")');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        $purchase = Purchase::whereHas('video', function ($q) {
            $q->where('talent_id', auth()->id());
        })->findOrFail($id);
        $purchase->delete();

        return redirect()->back()->with('toast', 'showToast("Data berhasil dihapus")');
    }
}
