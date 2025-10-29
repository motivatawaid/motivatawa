<?php

namespace App\Http\Controllers;

use App\Models\Video;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;
use Yajra\DataTables\Facades\DataTables;

class VideoController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index(Request $request)
    {
        if ($request->ajax()) {
            $query = Video::where('talent_id', auth()->id());
            return DataTables::of($query)
                ->editColumn('thumbnail', function ($row) {
                    $defaultImg = asset('assets/img/default-thumbnail.png');
                    $imgSrc = $row->thumbnail ? asset('storage/' . $row->thumbnail) : $defaultImg;
                    return '<img alt="thumbnail" src="' . $imgSrc . '" class="rounded" width="50">';
                })
                ->editColumn('price', function ($row) {
                    return 'Rp. ' . number_format($row->price, 0, ',', '.');
                })
                ->addColumn('aksi', function ($row) {
                    return '<a href="' . route('videos.edit', $row->id) . '" class="btn btn-sm btn-warning mr-2">Edit</a>
                            <form action="' . route('videos.destroy', $row->id) . '" method="POST" style="display: inline;">
                                <input type="hidden" name="_method" value="DELETE">
                                <input type="hidden" name="_token" value="' . csrf_token() . '">
                                <button type="submit" class="btn btn-sm btn-danger" onclick="return confirm(\'Yakin ingin menghapus?\')">Delete</button>
                            </form>';
                })
                ->rawColumns(['thumbnail', 'price', 'aksi'])
                ->make(true);
        }

        return view('pages.videos.index');
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        return view('pages.videos.create');
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        // Validasi inline
        $request->validate([
            'title' => 'required|string|max:255',
            'description' => 'nullable|string',
            'price' => 'required|numeric|min:0',
            'video_file' => 'required|file|mimes:mp4,avi,mov,wmv|max:102400', // Max 100MB, required
            'thumbnail' => 'nullable|image|mimes:jpeg,png,jpg,gif|max:2048',
        ]);

        $data = [
            'talent_id' => auth()->id(),
            'title' => $request->title,
            'description' => $request->description,
            'price' => (int) $request->price,
        ];

        if ($request->hasFile('video_file')) {
            $data['video_path'] = $request->file('video_file')->store('videos', 'public');
        }

        if ($request->hasFile('thumbnail')) {
            $data['thumbnail'] = $request->file('thumbnail')->store('thumbnails/videos', 'public');
        }

        Video::create($data);

        return redirect('videos')->with('toast', 'showToast("Data berhasil disimpan")');
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
        $item = Video::where('talent_id', auth()->id())->findOrFail($id);

        return view('pages.videos.edit', compact('item'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        // Validasi inline
        $request->validate([
            'title' => 'required|string|max:255',
            'description' => 'nullable|string',
            'price' => 'required|numeric|min:0',
            'video_file' => 'nullable|file|mimes:mp4,avi,mov,wmv|max:102400', // Optional untuk update
            'thumbnail' => 'nullable|image|mimes:jpeg,png,jpg,gif|max:2048',
        ]);

        $video = Video::where('talent_id', auth()->id())->findOrFail($id);

        $data = [
            'title' => $request->title,
            'description' => $request->description,
            'price' => (int) $request->price,
        ];

        if ($request->hasFile('video_file') && $request->file('video_file')->isValid()) {
            $path = "videos/";
            if ($video->video_path) {
                $oldfile = $path . basename($video->video_path);
                Storage::disk('public')->delete($oldfile);
            }
            $data['video_path'] = $request->file('video_file')->store('videos', 'public');
        }

        if ($request->hasFile('thumbnail') && $request->file('thumbnail')->isValid()) {
            $path = "thumbnails/videos/";
            if ($video->thumbnail) {
                $oldfile = $path . basename($video->thumbnail);
                Storage::disk('public')->delete($oldfile);
            }
            $data['thumbnail'] = $request->file('thumbnail')->store('thumbnails/videos', 'public');
        }

        $video->update($data);

        return redirect('videos')->with('toast', 'showToast("Data berhasil diupdate")');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        $video = Video::where('talent_id', auth()->id())->findOrFail($id);
        if ($video->video_path) {
            Storage::disk('public')->delete('videos/' . basename($video->video_path));
        }
        if ($video->thumbnail) {
            Storage::disk('public')->delete('thumbnails/videos/' . basename($video->thumbnail));
        }
        $video->delete();

        return redirect()->back()->with('toast', 'showToast("Data berhasil dihapus")');
    }
}
