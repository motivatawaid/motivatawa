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

        if (in_array($role, ['superadmin', 'admin'])) {
            // Dashboard untuk Superadmin dan Admin
            $data['totalUsers'] = User::whereNotIn('role', ['superadmin', 'admin'])->count();
            $data['totalEvents'] = Event::count();
            $data['totalCourses'] = Course::count();
            $data['totalVideos'] = Video::count();
            $data['totalRevenue'] = Ticket::where('status', 'purchased')->sum('price_paid')
                + Registration::where('status', 'purchased')->sum('price_paid')
                + Purchase::where('status', 'purchased')->sum('price_paid');
            $data['recentEvents'] = Event::with('talent')->latest()->take(5)->get();
            $data['recentCourses'] = Course::with('talent')->latest()->take(5)->get();
            $data['recentVideos'] = Video::with('talent')->latest()->take(5)->get();
        } elseif ($role === 'talent') {
            // Dashboard untuk Talent
            $data['totalEvents'] = Event::where('talent_id', $user->id)->count();
            $data['totalCourses'] = Course::where('talent_id', $user->id)->count();
            $data['totalVideos'] = Video::where('talent_id', $user->id)->count();

            // Hitung total ticket sales
            $data['totalTicketSales'] = Ticket::whereHas('event', function ($query) use ($user) {
                $query->where('talent_id', $user->id);
            })->where('status', 'purchased')->count();

            // Hitung total registration sales
            $data['totalRegistrationSales'] = Registration::whereHas('course', function ($query) use ($user) {
                $query->where('talent_id', $user->id);
            })->where('status', 'purchased')->count();

            // Hitung total revenue
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

            // My Events dengan count tickets yang purchased
            $data['myEvents'] = Event::where('talent_id', $user->id)
                ->withCount(['tickets as tickets_count' => function ($query) {
                    $query->where('status', 'purchased');
                }])
                ->latest()
                ->take(5)
                ->get();

            // My Courses dengan count registrations yang purchased
            $data['myCourses'] = Course::where('talent_id', $user->id)
                ->withCount(['registrations as registrations_count' => function ($query) {
                    $query->where('status', 'purchased');
                }])
                ->latest()
                ->take(5)
                ->get();

            // My Videos dengan count purchases yang purchased
            $data['myVideos'] = Video::where('talent_id', $user->id)
                ->withCount(['purchases as purchases_count' => function ($query) {
                    $query->where('status', 'purchased');
                }])
                ->latest()
                ->take(5)
                ->get();
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
