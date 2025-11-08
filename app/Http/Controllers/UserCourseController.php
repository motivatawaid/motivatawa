<?php

namespace App\Http\Controllers;

use App\Models\Course;
use App\Models\Registration;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Log;

class UserCourseController extends Controller
{
    public function index()
    {
        $courses = Course::where('quota', '>', 0)
            ->with(['talent'])
            ->latest('created_at')
            ->paginate(12);

        $ownedRegistrationCourseIds = auth()->user()
            ->registrations()
            ->where('status', 'purchased')
            ->pluck('course_id')
            ->toArray();

        return view('user.courses.index', compact('courses', 'ownedRegistrationCourseIds'));
    }

    public function show(Course $course)
    {
        $user = auth()->user();
        $registration = $user->registrations()->where('course_id', $course->id)->where('status', 'purchased')->first();

        $course->load('talent');

        return view('user.courses.show', compact('course', 'registration'));
    }

    public function buy(Request $request, Course $course)
    {
        $user = $request->user();

        if (!$user->whatsapp_number) {
            return redirect('/profile')->with('error', 'Silakan lengkapi nomor WhatsApp Anda terlebih dahulu sebelum mendaftar course.');
        }

        // Validasi quota
        if ($course->quota <= 0) {
            return back()->with('error', 'Maaf, kuota untuk course ini sudah habis.');
        }

        // Handle existing registration
        $registration = $user->registrations()->where('course_id', $course->id)->first();

        if ($registration) {
            if ($registration->status === 'purchased') {
                return back()->with('error', 'Anda sudah terdaftar untuk course ini.');
            } else {
                // Reset to pending for new payment attempt
                $registration->update([
                    'status' => 'pending',
                    'price_paid' => 0,
                    'midtrans_order_id' => null,
                    'midtrans_status' => null,
                ]);
            }
        } else {
            try {
                // Buat registration sementara dalam transaction
                $registration = DB::transaction(function () use ($user, $course) {
                    return Registration::create([
                        'course_id' => $course->id,
                        'user_id' => $user->id,
                        'whatsapp_number' => $user->whatsapp_number, // Nomor default
                        'price_paid' => 0,
                        'status' => 'pending',
                    ]);
                });
            } catch (\Exception $e) {
                Log::error('Error buy course: ' . $e->getMessage());
                return back()->with('error', 'Terjadi kesalahan saat memproses pendaftaran. Silakan coba lagi.');
            }
        }

        return view('user.courses.checkout', compact('registration', 'course'));
    }
}
