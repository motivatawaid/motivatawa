<?php

namespace App\Http\Controllers;

use App\Models\Event;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;
use Yajra\DataTables\Facades\DataTables;

class EventController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index(Request $request)
    {
        if ($request->ajax()) {
            $query = Event::with('talent')->where('talent_id', auth()->id());
            return DataTables::of($query)
                ->editColumn('thumbnail', function ($row) {
                    $defaultImg = asset('assets/img/default-thumbnail.png');
                    $imgSrc = $row->thumbnail ? asset('storage/' . $row->thumbnail) : $defaultImg;
                    return '<img alt="thumbnail" src="' . $imgSrc . '" class="rounded" width="50">';
                })
                ->editColumn('start_date', function ($row) {
                    return $row->start_date->format('d M Y, g:i A');
                })
                ->editColumn('end_date', function ($row) {
                    return $row->end_date->format('d M Y, g:i A');
                })
                ->editColumn('price', function ($row) {
                    return 'Rp. ' . number_format($row->price, 0, ',', '.');
                })
                ->addColumn('aksi', function ($row) {
                    return '<a href="' . route('events.edit', $row->id) . '" class="btn btn-sm btn-warning mr-2">Edit</a>
                            <form action="' . route('events.destroy', $row->id) . '" method="POST" style="display: inline;">
                                <input type="hidden" name="_method" value="DELETE">
                                <input type="hidden" name="_token" value="' . csrf_token() . '">
                                <button type="submit" class="btn btn-sm btn-danger" onclick="return confirm(\'Yakin ingin menghapus?\')">Delete</button>
                            </form>';
                })
                ->rawColumns(['thumbnail', 'start_date', 'end_date', 'price', 'aksi'])
                ->make(true);
        }

        return view('pages.events.index');
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        return view('pages.events.create');
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        // Validasi inline (ganti rules sesuai kebutuhan)
        $request->validate([
            'title' => 'required|string|max:255',
            'description' => 'nullable|string',
            'type' => 'required|in:online,offline',
            'start_date' => 'required|date|after:now',
            'end_date' => 'required|date|after:start_date',
            'location' => 'nullable|string|max:255',
            'quota' => 'required|integer|min:0',
            'price' => 'required|numeric|min:0',
            'thumbnail' => 'nullable|image|mimes:jpeg,png,jpg,gif|max:2048',
        ]);

        $data = [
            'talent_id' => auth()->id(),
            'title' => $request->title,
            'description' => $request->description,
            'type' => $request->type,
            'start_date' => $request->start_date,
            'end_date' => $request->end_date,
            'location' => $request->location,
            'quota' => $request->quota,
            'price' => (int) $request->price,
        ];

        if ($request->hasFile('thumbnail')) {
            $data['thumbnail'] = $request->file('thumbnail')->store('thumbnails', 'public');
        }

        Event::create($data);

        return redirect('events')->with('toast', 'showToast("Data berhasil disimpan")');
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
        $item = Event::where('talent_id', auth()->id())->findOrFail($id);

        return view('pages.events.edit', [
            'item'  =>  $item
        ]);
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        // Validasi inline (ganti rules sesuai kebutuhan, optional fields)
        $request->validate([
            'title' => 'required|string|max:255',
            'description' => 'nullable|string',
            'type' => 'required|in:online,offline',
            'start_date' => 'required|date',
            'end_date' => 'required|date|after:start_date',
            'location' => 'nullable|string|max:255',
            'quota' => 'required|integer|min:0',
            'price' => 'required|numeric|min:0',
            'thumbnail' => 'nullable|image|mimes:jpeg,png,jpg,gif|max:2048',
        ]);

        $event = Event::where('talent_id', auth()->id())->findOrFail($id);

        $data = [
            'title' => $request->title,
            'description' => $request->description,
            'type' => $request->type,
            'start_date' => $request->start_date,
            'end_date' => $request->end_date,
            'location' => $request->location,
            'quota' => $request->quota,
            'price' => (int) $request->price,
        ];

        if ($request->hasFile('thumbnail') && $request->file('thumbnail')->isValid()) {
            $path = "thumbnails/";
            if ($event->thumbnail) {
                $oldfile = $path . basename($event->thumbnail);
                Storage::disk('public')->delete($oldfile);
            }
            $data['thumbnail'] = $request->file('thumbnail')->store('thumbnails', 'public'); // Konsisten: Gunakan store()
        }

        $event->update($data);

        return redirect('events')->with('toast', 'showToast("Data berhasil diupdate")');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        $event = Event::where('talent_id', auth()->id())->findOrFail($id);
        if ($event->thumbnail) {
            Storage::disk('public')->delete('thumbnails/' . basename($event->thumbnail));
        }
        $event->delete();

        return redirect()->back()->with('toast', 'showToast("Data berhasil dihapus")');
    }
}
