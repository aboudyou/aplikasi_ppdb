<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\AuthController;
use App\Http\Controllers\AdminController;
use App\Http\Controllers\UserController;

/*
|--------------------------------------------------------------------------
| Web Routes - Aplikasi PPDB Online
|--------------------------------------------------------------------------
*/

// =========================
// 📌 ROUTE UMUM
// =========================
Route::get('/', function () {
    return view('welcome');
})->name('home');

Route::get('/contact-us', function () {
    return view('contact');
})->name('contact');

// =========================
// 📩 ROUTE OTP / VERIFIKASI EMAIL
// =========================
Route::get('/verify-email', [AuthController::class, 'showVerifyForm'])->name('verify.form');
Route::post('/send-otp', [AuthController::class, 'sendOtp'])->name('send.otp');
Route::post('/verify-email', [AuthController::class, 'verify'])->name('verify.otp');

// =========================
// 🔐 ROUTE UNTUK TAMU (BELUM LOGIN)
// =========================
Route::middleware(['guest'])->group(function () {

    // Login & Register
    Route::get('/login', [AuthController::class, 'showLoginForm'])->name('login');
    Route::post('/login', [AuthController::class, 'login'])->name('login.post');

    Route::get('/register', [AuthController::class, 'showRegistrationForm'])->name('register');
    Route::post('/register', [AuthController::class, 'register'])->name('register.post');

    // SSO (Google, Facebook, dll)
    Route::get('/auth/{provider}', [AuthController::class, 'redirect'])->name('sso.redirect');
    Route::get('/auth/{provider}/callback', [AuthController::class, 'callback'])->name('sso.callback');

    // Forgot & Reset Password
    Route::get('/forgot-password', [AuthController::class, 'showRequestForm'])->name('forgot_password.email_form');
    Route::post('/forgot-password', [AuthController::class, 'sendResetLink'])->name('forgot_password.send_link');

    Route::get('/password-reset/{token}', [AuthController::class, 'showResetForm'])->name('password.reset');
    Route::post('/password-reset', [AuthController::class, 'resetPassword'])->name('password.update');
});

// =========================
// 🧑‍💼 ROUTE UNTUK USER YANG SUDAH LOGIN
// =========================
Route::middleware(['auth', 'web'])->group(function () {

    Route::get('/dashboard', function () {
        return view('dashboard');
    })->name('dashboard');

    Route::post('/logout', [AuthController::class, 'logout'])->name('logout');

    Route::get('/myprofile', function () {
        return view('myprofile');
    })->name('myprofile');

    // =========================
    // 👑 ADMIN ROUTES
    // =========================
    Route::prefix('admin')->middleware(['cekRole:admin'])->group(function () {
        Route::get('/verifikasi', [AdminController::class, 'verifikasi'])->name('admin.verifikasi');
        Route::get('/seleksi', [AdminController::class, 'seleksi'])->name('admin.seleksi');
        Route::get('/pengumuman', [AdminController::class, 'pengumuman'])->name('admin.pengumuman');
        Route::get('/laporan', [AdminController::class, 'laporan'])->name('admin.laporan');
    });

    // =========================
    // 🙋 USER ROUTES
    // =========================
Route::prefix('user')->middleware(['cekRole:user'])->group(function () {

    // Biodata
    Route::get('/biodata', [UserController::class, 'biodata'])->name('user.biodata');
    Route::post('/biodata', [UserController::class, 'simpanBiodata'])->name('user.biodata.store');

    // Dokumen
    Route::get('/dokumen', [UserController::class, 'dokumen'])->name('user.dokumen');

    // Status
    Route::get('/status', [UserController::class, 'status'])->name('user.status');

    // Daftar Ulang
    Route::get('/daftar-ulang', [UserController::class, 'daftarUlang'])->name('user.daftar_ulang');
});

});

// =========================
// ⚠️ ROUTE FALLBACK (404)
// =========================
Route::fallback(function () {
    return response()->view('errors.404', [], 404);
});
