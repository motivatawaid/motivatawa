<?php

namespace App\Http\Controllers;

use App\Models\News;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;
use Yajra\DataTables\DataTables;

class NewsController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index(Request $request)
    {
        if ($request->ajax()) {
            $query = News::with('author')->where('author_id', auth()->id());
            return DataTables::of($query)
                ->editColumn('thumbnail', function ($row) {
                    $defaultImg = asset('assets/img/default-thumbnail.png');
                    $imgSrc = $row->thumbnail ? asset('storage/' . $row->thumbnail) : $defaultImg;
                    return '<img alt="thumbnail" src="' . $imgSrc . '" class="rounded" width="50">';
                })
                ->editColumn('published_at', function ($row) {
                    return $row->published_at ? $row->published_at->format('d M Y, g:i A') : 'Belum Dipublikasikan';
                })
                ->editColumn('excerpt', function ($row) {
                    return $row->excerpt;
                })
                ->addColumn('aksi', function ($row) {
                    return '<a href="' . route('news.edit', $row->id) . '" class="btn btn-sm btn-warning mr-2">Edit</a>
                            <form action="' . route('news.destroy', $row->id) . '" method="POST" style="display: inline;">
                                <input type="hidden" name="_method" value="DELETE">
                                <input type="hidden" name="_token" value="' . csrf_token() . '">
                                <button type="submit" class="btn btn-sm btn-danger" onclick="return confirm(\'Yakin ingin menghapus?\')">Delete</button>
                            </form>';
                })
                ->rawColumns(['thumbnail', 'published_at', 'excerpt', 'aksi'])
                ->make(true);
        }

        return view('pages.news.index');
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        return view('pages.news.create');
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        // Validasi inline (ganti rules sesuai kebutuhan)
        $request->validate([
            'title' => 'required|string|max:255',
            'article' => 'required|string',
            'thumbnail' => 'nullable|image|mimes:jpeg,png,jpg,gif|max:2048',
        ]);

        $data = [
            'author_id' => auth()->id(),
            'title' => $request->title,
            'article' => $request->article,
            'published_at' => now(),
        ];

        if ($request->hasFile('thumbnail')) {
            $data['thumbnail'] = $request->file('thumbnail')->store('thumbnails', 'public');
        }

        News::create($data);

        return redirect('news')->with('toast', 'showToast("Data berhasil disimpan")');
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
        $item = News::where('author_id', auth()->id())->findOrFail($id);

        return view('pages.news.edit', [
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
            'article' => 'required|string',
            'thumbnail' => 'nullable|image|mimes:jpeg,png,jpg,gif|max:2048',
        ]);

        $news = News::where('author_id', auth()->id())->findOrFail($id);

        $data = [
            'title' => $request->title,
            'article' => $request->article,
            'published_at' => now(),
        ];

        if ($request->hasFile('thumbnail') && $request->file('thumbnail')->isValid()) {
            $path = "thumbnails/";
            if ($news->thumbnail) {
                $oldfile = $path . basename($news->thumbnail);
                Storage::disk('public')->delete($oldfile);
            }
            $data['thumbnail'] = $request->file('thumbnail')->store('thumbnails', 'public'); // Konsisten: Gunakan store()
        }

        $news->update($data);

        return redirect('news')->with('toast', 'showToast("Data berhasil diupdate")');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        $news = News::where('author_id', auth()->id())->findOrFail($id);
        if ($news->thumbnail) {
            Storage::disk('public')->delete('thumbnails/' . basename($news->thumbnail));
        }
        $news->delete();

        return redirect()->back()->with('toast', 'showToast("Data berhasil dihapus")');
    }
}
