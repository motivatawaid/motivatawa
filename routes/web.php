<?php

use App\Http\Controllers\DashboardController;
use App\Http\Controllers\UserController;
use App\Http\Controllers\EventController;
use App\Http\Controllers\CourseController;
use App\Http\Controllers\HomeController;
use App\Http\Controllers\PaymentController;
use App\Http\Controllers\TicketController;
use App\Http\Controllers\RegistrationController;
use App\Http\Controllers\VideoController;
use App\Http\Controllers\UserEventController;
use App\Http\Controllers\UserCourseController;
use App\Http\Controllers\UserPurchaseController;
use App\Http\Controllers\UserTicketController;
use App\Http\Controllers\UserRegistrationController;
use App\Http\Controllers\UserVideoController;
use App\Http\Controllers\PurchaseController;
use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider and all of them will
| be assigned to the "web" middleware group. Make something great!
|
*/

Route::get('/', [HomeController::class, 'index'])->name('home');

// Halaman all-event, all-course dan all-video
Route::get('/all-event', [HomeController::class, 'allEvent'])->name('all-event');
Route::get('/all-course', [HomeController::class, 'allCourse'])->name('all-course');
Route::get('/all-video', [HomeController::class, 'allVideo'])->name('all-video');

// Route untuk pembelian dari home
Route::post('/event/{event}/create-ticket', [HomeController::class, 'createEventTicket'])
    ->middleware('auth')
    ->name('home.event.create-ticket');

Route::post('/course/{course}/create-registration', [HomeController::class, 'createCourseRegistration'])
    ->middleware('auth')
    ->name('home.course.create-registration');

Route::post('/video/{video}/create-purchase', [HomeController::class, 'createVideoPurchase'])
    ->middleware('auth')
    ->name('home.video.create-purchase');

// matikan route ini jika .env email sudah di seting
// Route::get('/forgot-password', function () {
//     return redirect()->back();
// })->name('password.request')->middleware(['guest']);

Route::middleware(['auth', 'verified'])->group(function () {
    Route::get('/dashboard', [DashboardController::class, 'index'])->name('dashboard');
    Route::get('/profile', [DashboardController::class, 'profile'])->name('profile');
    Route::put('/change-profile-avatar', [DashboardController::class, 'changeAvatar'])->name('change-profile-avatar');
    Route::delete('/remove-profile-avatar', [DashboardController::class, 'removeAvatar'])->name('remove-profile-avatar');

    // route untuk admin
    Route::middleware(['can:admin'])->group(function () {
        Route::resources([
            'user' => UserController::class,
        ]);
    });

    // route untuk talent/penyelenggara
    Route::middleware(['can:talent'])->group(function () {
        Route::resources([
            'events' => EventController::class,
            'courses' => CourseController::class,
            'tickets' => TicketController::class,
            'registrations' => RegistrationController::class,
            'videos' => VideoController::class,
            'purchases' => PurchaseController::class,
        ]);
    });

    // User Routes (read/buy/checkin only, prefix 'my' untuk personal feel)
    Route::middleware(['can:user'])->prefix('my')->name('user.')->group(function () {
        // Grup Events: Daftar, Buy, Check-in
        Route::get('/events', [UserEventController::class, 'index'])->name('events.index');
        Route::get('/events/{event}', [UserEventController::class, 'show'])->name('events.show');
        Route::post('/events/{event}/buy-event', [UserEventController::class, 'buy'])->name('events.buy');

        // Grup Courses: Daftar, Buy
        Route::get('/courses', [UserCourseController::class, 'index'])->name('courses.index');
        Route::get('/courses/{course}', [UserCourseController::class, 'show'])->name('courses.show');
        Route::post('/courses/{course}/buy-course', [UserCourseController::class, 'buy'])->name('courses.buy');

        // Grup Tickets: Daftar & Detail
        Route::get('/tickets', [UserTicketController::class, 'index'])->name('tickets.index');
        Route::get('/tickets/{ticket}', [UserTicketController::class, 'show'])->name('tickets.show');

        // Grup Registrations: Daftar & Detail
        Route::get('/registrations', [UserRegistrationController::class, 'index'])->name('registrations.index');
        Route::get('/registrations/{registration}', [UserRegistrationController::class, 'show'])->name('registrations.show');

        // Grup Videos: Daftar & Buy
        Route::get('/videos', [UserVideoController::class, 'index'])->name('videos.index');
        Route::get('/videos/{video}', [UserVideoController::class, 'show'])->name('videos.show');
        Route::post('/videos/{video}/buy', [UserVideoController::class, 'buy'])->name('videos.buy');

        // Purchases: Riwayat Gabungan
        Route::get('/purchases', [UserPurchaseController::class, 'index'])->name('purchases.index');
        Route::get('/purchases/{purchase}', [UserPurchaseController::class, 'show'])->name('purchases.show');
    });
});

Route::post('/payment/snap-token', [PaymentController::class, 'createSnapToken'])
    ->middleware('auth')
    ->name('payment.snap-token');

Route::post('/payment/verify-status', [PaymentController::class, 'verifyStatus'])
    ->middleware('auth')
    ->name('payment.verify-status');
