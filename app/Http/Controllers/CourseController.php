<?php

namespace App\Http\Controllers;

use App\Models\Course;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;
use Yajra\DataTables\Facades\DataTables;

class CourseController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index(Request $request)
    {
        if ($request->ajax()) {
            $query = Course::with('talent')->where('talent_id', auth()->id());
            return DataTables::of($query)
                ->editColumn('thumbnail', function ($row) {
                    $defaultImg = asset('assets/img/default-thumbnail.png');
                    $imgSrc = $row->thumbnail ? asset('storage/' . $row->thumbnail) : $defaultImg;
                    return '<img alt="thumbnail" src="' . $imgSrc . '" class="rounded" width="50">';
                })
                ->editColumn('price', function ($row) {
                    return 'Rp. ' . number_format($row->price, 0, ',', '.');
                })
                ->editColumn('quota', function ($row) {
                    return $row->sold_registrations . ' / ' . $row->quota;
                })
                ->addColumn('aksi', function ($row) {
                    return '<a href="' . route('courses.edit', $row->id) . '" class="btn btn-sm btn-warning mr-2">Edit</a>
                            <form action="' . route('courses.destroy', $row->id) . '" method="POST" style="display: inline;">
                                <input type="hidden" name="_method" value="DELETE">
                                <input type="hidden" name="_token" value="' . csrf_token() . '">
                                <button type="submit" class="btn btn-sm btn-danger" onclick="return confirm(\'Yakin ingin menghapus?\')">Delete</button>
                            </form>';
                })
                ->rawColumns(['thumbnail', 'price', 'quota', 'aksi'])
                ->make(true);
        }

        return view('pages.courses.index');
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        return view('pages.courses.create');
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        // Validasi inline
        $request->validate([
            'name' => 'required|string|max:255',
            'description' => 'nullable|string',
            'quota' => 'required|integer|min:0',
            'price' => 'required|numeric|min:0',
            'thumbnail' => 'nullable|image|mimes:jpeg,png,jpg,gif|max:2048',
        ]);

        $data = [
            'talent_id' => auth()->id(),
            'name' => $request->name,
            'description' => $request->description,
            'quota' => $request->quota,
            'price' => (int) $request->price,
        ];

        if ($request->hasFile('thumbnail')) {
            $data['thumbnail'] = $request->file('thumbnail')->store('thumbnails', 'public');
        }

        Course::create($data);

        return redirect('courses')->with('toast', 'showToast("Data berhasil disimpan")');
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
        $item = Course::where('talent_id', auth()->id())->findOrFail($id);

        return view('pages.courses.edit', [
            'item'  =>  $item
        ]);
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        // Validasi inline
        $request->validate([
            'name' => 'required|string|max:255',
            'description' => 'nullable|string',
            'quota' => 'required|integer|min:0',
            'price' => 'required|numeric|min:0',
            'thumbnail' => 'nullable|image|mimes:jpeg,png,jpg,gif|max:2048',
        ]);

        $course = Course::where('talent_id', auth()->id())->findOrFail($id);

        $data = [
            'name' => $request->name,
            'description' => $request->description,
            'quota' => $request->quota,
            'price' => (int) $request->price,
        ];

        if ($request->hasFile('thumbnail') && $request->file('thumbnail')->isValid()) {
            $path = "thumbnails/";
            if ($course->thumbnail) {
                $oldfile = $path . basename($course->thumbnail);
                Storage::disk('public')->delete($oldfile);
            }
            $data['thumbnail'] = $request->file('thumbnail')->store('thumbnails', 'public');
        }

        $course->update($data);

        return redirect('courses')->with('toast', 'showToast("Data berhasil diupdate")');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        $course = Course::where('talent_id', auth()->id())->findOrFail($id);
        if ($course->thumbnail) {
            Storage::disk('public')->delete('thumbnails/' . basename($course->thumbnail));
        }
        $course->delete();

        return redirect()->back()->with('toast', 'showToast("Data berhasil dihapus")');
    }
}
