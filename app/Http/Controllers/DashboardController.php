<?php

namespace App\Http\Controllers;

use App\Models\Course;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Storage;
use App\Models\User;
use App\Models\Event;
use App\Models\Video;
use App\Models\Ticket;
use App\Models\Purchase;
use App\Models\Registration;
use Illuminate\Http\Request;

class DashboardController extends Controller
{
    public function index(Request $request)
    {
        $user = Auth::user();
        $role = $user->role;

        $data = [];

        if (in_array($role, ['admin', 'talent'])) {
            // Dashboard untuk Admin dan Talent - format tampilan sama
            if ($role === 'admin') {
                // Admin melihat data keseluruhan
                $data['totalEvents'] = Event::count();
                $data['totalCourses'] = Course::count();
                $data['totalVideos'] = Video::count();

                // Hitung total ticket sales untuk semua talent
                $data['totalTicketSales'] = Ticket::where('status', 'purchased')->count();

                // Hitung total registration sales untuk semua talent
                $data['totalRegistrationSales'] = Registration::where('status', 'purchased')->count();

                // Hitung total video sales untuk semua talent
                $data['totalVideoSales'] = Purchase::where('status', 'purchased')->count();

                // Hitung total revenue untuk semua talent
                $data['totalRevenue'] = Ticket::where('status', 'purchased')->sum('price_paid')
                    + Registration::where('status', 'purchased')->sum('price_paid')
                    + Purchase::where('status', 'purchased')->sum('price_paid');

                // Data events dengan count tickets yang purchased untuk semua
                $data['myEvents'] = Event::withCount(['tickets as tickets_count' => function ($query) {
                    $query->where('status', 'purchased');
                }])
                    ->latest()
                    ->take(5)
                    ->get();

                // Data courses dengan count registrations yang purchased untuk semua
                $data['myCourses'] = Course::withCount(['registrations as registrations_count' => function ($query) {
                    $query->where('status', 'purchased');
                }])
                    ->latest()
                    ->take(5)
                    ->get();

                // Data videos dengan count purchases yang purchased untuk semua
                $data['myVideos'] = Video::withCount(['purchases as purchases_count' => function ($query) {
                    $query->where('status', 'purchased');
                }])
                    ->latest()
                    ->take(5)
                    ->get();
            } else {
                // Talent hanya melihat data miliknya sendiri
                $data['totalEvents'] = Event::where('talent_id', $user->id)->count();
                $data['totalCourses'] = Course::where('talent_id', $user->id)->count();
                $data['totalVideos'] = Video::where('talent_id', $user->id)->count();

                // Hitung total ticket sales untuk talent ini saja
                $data['totalTicketSales'] = Ticket::whereHas('event', function ($query) use ($user) {
                    $query->where('talent_id', $user->id);
                })->where('status', 'purchased')->count();

                // Hitung total registration sales untuk talent ini saja
                $data['totalRegistrationSales'] = Registration::whereHas('course', function ($query) use ($user) {
                    $query->where('talent_id', $user->id);
                })->where('status', 'purchased')->count();

                // Hitung total video sales untuk talent ini saja
                $data['totalVideoSales'] = Purchase::whereHas('video', function ($query) use ($user) {
                    $query->where('talent_id', $user->id);
                })->where('status', 'purchased')->count();

                // Hitung total revenue untuk talent ini saja
                $data['totalRevenue'] = Ticket::where('status', 'purchased')
                    ->whereHas('event', function ($query) use ($user) {
                        $query->where('talent_id', $user->id);
                    })->sum('price_paid')
                    + Registration::where('status', 'purchased')
                    ->whereHas('course', function ($query) use ($user) {
                        $query->where('talent_id', $user->id);
                    })->sum('price_paid')
                    + Purchase::where('status', 'purchased')
                    ->whereHas('video', function ($query) use ($user) {
                        $query->where('talent_id', $user->id);
                    })->sum('price_paid');

                // My Events dengan count tickets yang purchased untuk talent ini saja
                $data['myEvents'] = Event::where('talent_id', $user->id)
                    ->withCount(['tickets as tickets_count' => function ($query) {
                        $query->where('status', 'purchased');
                    }])
                    ->latest()
                    ->take(5)
                    ->get();

                // My Courses dengan count registrations yang purchased untuk talent ini saja
                $data['myCourses'] = Course::where('talent_id', $user->id)
                    ->withCount(['registrations as registrations_count' => function ($query) {
                        $query->where('status', 'purchased');
                    }])
                    ->latest()
                    ->take(5)
                    ->get();

                // My Videos dengan count purchases yang purchased untuk talent ini saja
                $data['myVideos'] = Video::where('talent_id', $user->id)
                    ->withCount(['purchases as purchases_count' => function ($query) {
                        $query->where('status', 'purchased');
                    }])
                    ->latest()
                    ->take(5)
                    ->get();
            }
        } elseif ($role === 'user') {
            // Dashboard untuk User
            $data['totalTickets'] = Ticket::where('user_id', $user->id)->where('status', 'purchased')->count();
            $data['totalRegistrations'] = Registration::where('user_id', $user->id)->where('status', 'purchased')->count();
            $data['totalPurchases'] = Purchase::where('user_id', $user->id)->where('status', 'purchased')->count();
            $data['totalSpent'] = Ticket::where('user_id', $user->id)->where('status', 'purchased')->sum('price_paid')
                + Registration::where('user_id', $user->id)->where('status', 'purchased')->sum('price_paid')
                + Purchase::where('user_id', $user->id)->where('status', 'purchased')->sum('price_paid');
            $data['myTickets'] = Ticket::where('user_id', $user->id)->with('event')->where('status', 'purchased')->latest()->take(5)->get();
            $data['myRegistrations'] = Registration::where('user_id', $user->id)->with('course')->where('status', 'purchased')->latest()->take(5)->get();
            $data['myPurchases'] = Purchase::where('user_id', $user->id)->with('video')->where('status', 'purchased')->latest()->take(5)->get();
        }

        return view('pages.dashboard', compact('data', 'role'));
    }

    public function profile(Request $request)
    {
        // Implementasi profile jika diperlukan, misalnya load data user
        $user = Auth::user();
        return view('pages.profile', compact('user'));
    }

    public function changeAvatar(Request $request)
    {
        $request->validate([
            'avatar' => 'required|image|mimes:jpeg,png,jpg,gif|max:2048',
        ]);

        $user = Auth::user();

        // Hapus avatar lama jika ada
        if ($user->avatar) {
            Storage::disk('public')->delete($user->avatar);
        }

        // Upload avatar baru
        $path = $request->file('avatar')->store('avatars', 'public');
        $user->avatar = $path;
        $user->save();

        return redirect()->route('profile')->with('success', 'Avatar berhasil diupdate.');
    }

    public function removeAvatar(Request $request)
    {
        $user = Auth::user();

        if ($user->avatar) {
            Storage::disk('public')->delete($user->avatar);
            $user->avatar = null;
            $user->save();
        }

        return redirect()->route('profile')->with('success', 'Avatar berhasil dihapus.');
    }
}
