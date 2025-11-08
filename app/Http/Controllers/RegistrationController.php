<?php

namespace App\Http\Controllers;

use App\Models\Course;
use App\Models\Registration;
use App\Models\User;
use Illuminate\Http\Request;
use Yajra\DataTables\Facades\DataTables;

class RegistrationController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index(Request $request)
    {
        if ($request->ajax()) {
            $query = Registration::with(['course', 'user'])->whereHas('course', function ($q) {
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
                ->addColumn('course_name', function ($row) {
                    return $row->course?->name ?? 'N/A';
                })
                ->addColumn('user_name', function ($row) {
                    return $row->user?->name ?? 'N/A';
                })
                ->addColumn('whatsapp_number', function ($row) {
                    return $row->whatsapp_number ?? 'N/A';
                })
                ->addColumn('aksi', function ($row) {
                    $whatsappLink = 'https://wa.me/62' . substr($row->whatsapp_number, 1);

                    return '<a href="' . $whatsappLink . '" target="_blank" class="btn btn-sm btn-info mr-2">
                                Hubungi WA
                            </a>
                            <a href="' . route('registrations.edit', $row->id) . '" class="btn btn-sm btn-warning mr-2">Edit</a>
                            <form action="' . route('registrations.destroy', $row->id) . '" method="POST" style="display: inline;">
                                <input type="hidden" name="_method" value="DELETE">
                                <input type="hidden" name="_token" value="' . csrf_token() . '">
                                <button type="submit" class="btn btn-sm btn-danger" onclick="return confirm(\'Yakin ingin menghapus?\')">Delete</button>
                            </form>';
                })
                ->rawColumns(['status', 'aksi'])
                ->make(true);
        }

        return view('pages.registrations.index');
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        $courses = Course::where('talent_id', auth()->id())->get(); // Pass courses milik talent
        $users = User::where('role', 'user')->get(); // Pass users (filter role jika perlu)

        return view('pages.registrations.create', compact('courses', 'users'));
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        // Validasi inline
        $request->validate([
            'course_id' => 'required|exists:courses,id',
            'user_id' => 'required|exists:users,id',
            'whatsapp_number' => 'required|string|max:20',
            'price_paid' => 'required|numeric|min:0',
            'status' => 'required|in:pending,purchased,cancelled',
        ]);

        // Cek ownership course
        $course = Course::where('id', $request->course_id)->where('talent_id', auth()->id())->firstOrFail();

        // Cek unique combination
        $existing = Registration::where('course_id', $request->course_id)
            ->where('user_id', $request->user_id)
            ->exists();
        if ($existing) {
            return back()->with('error', 'Kombinasi course dan user sudah ada.');
        }

        $data = [
            'course_id' => $request->course_id,
            'user_id' => $request->user_id,
            'whatsapp_number' => $request->whatsapp_number,
            'price_paid' => $request->price_paid,
            'status' => $request->status,
        ];

        Registration::create($data);

        return redirect('registrations')->with('toast', 'showToast("Data berhasil disimpan")');
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
        $item = Registration::whereHas('course', function ($q) {
            $q->where('talent_id', auth()->id());
        })->findOrFail($id);

        $courses = Course::where('talent_id', auth()->id())->get(); // Pass courses untuk select
        $users = User::where('role', 'user')->get(); // Pass users untuk select

        return view('pages.registrations.edit', compact('item', 'courses', 'users'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        // Validasi inline
        $request->validate([
            'course_id' => 'required|exists:courses,id',
            'user_id' => 'required|exists:users,id',
            'whatsapp_number' => 'required|string|max:20',
            'price_paid' => 'required|numeric|min:0',
            'status' => 'required|in:pending,purchased,cancelled',
        ]);

        $registration = Registration::whereHas('course', function ($q) {
            $q->where('talent_id', auth()->id());
        })->findOrFail($id);

        // Cek ownership course jika diubah
        if ($request->course_id != $registration->course_id) {
            $course = Course::where('id', $request->course_id)->where('talent_id', auth()->id())->firstOrFail();
        }

        // Cek unique combination excluding current record
        $existing = Registration::where('course_id', $request->course_id)
            ->where('user_id', $request->user_id)
            ->where('id', '!=', $id)
            ->exists();
        if ($existing) {
            return back()->with('error', 'Kombinasi course dan user sudah ada untuk registrasi lain.');
        }

        $data = [
            'course_id' => $request->course_id,
            'user_id' => $request->user_id,
            'whatsapp_number' => $request->whatsapp_number,
            'price_paid' => $request->price_paid,
            'status' => $request->status,
        ];

        $registration->update($data);

        return redirect('registrations')->with('toast', 'showToast("Data berhasil diupdate")');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        $registration = Registration::whereHas('course', function ($q) {
            $q->where('talent_id', auth()->id());
        })->findOrFail($id);
        $registration->delete();

        return redirect()->back()->with('toast', 'showToast("Data berhasil dihapus")');
    }
}
