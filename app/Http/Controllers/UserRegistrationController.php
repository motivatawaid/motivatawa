<?php

namespace App\Http\Controllers;

use App\Models\Registration;
use Illuminate\Http\Request;

class UserRegistrationController extends Controller
{
    public function index()
    {
        $registrations = auth()->user()
            ->registrations()
            ->with(['course.talent'])
            ->where('status', 'purchased')
            ->latest()
            ->paginate(12);

        return view('user.registrations.index', compact('registrations'));
    }

    public function show(Registration $registration)
    {
        // Manual check ownership (karena tidak ada policy)
        if ($registration->user_id !== auth()->id()) {
            abort(403, 'Akses ditolak. Ini bukan registrasi Anda.');
        }

        if ($registration->status !== 'purchased') {
            abort(404, 'Registrasi tidak ditemukan atau belum dibayar.');
        }

        $registration->load(['course.talent']);

        return view('user.registrations.show', compact('registration'));
    }
}
