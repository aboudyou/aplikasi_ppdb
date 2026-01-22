<?php

use Illuminate\Support\Facades\Route;

// =======================
// AUTH
// =======================
use App\Http\Controllers\AuthController;
use App\Http\Controllers\OrangTuaController;
// use App\Http\Controllers\Auth\SSOController;

// =======================
// DASHBOARD
// =======================
use App\Http\Controllers\DashboardController;
use App\Http\Controllers\Admin\DashboardController as AdminDashboardController;

// =======================
// ADMIN CONTROLLER
// =======================
use App\Http\Controllers\Admin\VerifikasiController;
use App\Http\Controllers\Admin\VerifikasiPembayaranController;
use App\Http\Controllers\Admin\SeleksiController as AdminSeleksiController;
use App\Http\Controllers\Admin\PengumumanController as AdminPengumumanController;
use App\Http\Controllers\Admin\LaporanController;
use App\Http\Controllers\Admin\GelombangController;
use App\Http\Controllers\Admin\JurusanController;
use App\Http\Controllers\Admin\DokumenController;
use App\Http\Controllers\LogAktivitasController;

// =======================
// USER CONTROLLER
// =======================
use App\Http\Controllers\UserController;
use App\Http\Controllers\BiodataController;
use App\Http\Controllers\Siswa\FormulirController;
use App\Http\Controllers\Siswa\SiswaDokumenController;
use App\Http\Controllers\Siswa\PembayaranController;
use App\Http\Controllers\Siswa\SeleksiController;
use App\Http\Controllers\StatusSeleksiController;

/*
|--------------------------------------------------------------------------
| HOMEPAGE
|--------------------------------------------------------------------------
*/
Route::get('/', fn () => view('welcome'))->name('home');
Route::view('/contact-us', 'contact')->name('contact');

/*
|--------------------------------------------------------------------------
| DASHBOARD REDIRECT
|--------------------------------------------------------------------------
*/
Route::get('/dashboard', function () {
    if (!auth()->check()) {
        return redirect()->route('login');
    }

    return auth()->user()->role === 'admin'
        ? redirect()->route('admin.dashboard')
        : redirect()->route('user.dashboard');
})->name('dashboard');

/*
|--------------------------------------------------------------------------
| AUTH (GUEST)
|--------------------------------------------------------------------------
*/
Route::middleware('guest')->group(function () {
    Route::controller(AuthController::class)->group(function () {
        Route::get('/login', 'showLoginForm')->name('login');
        Route::post('/login', 'login')->middleware('throttle:5,1')->name('login.post');

        Route::get('/register', 'showRegistrationForm')->name('register');
        Route::post('/register', 'register')->name('register.post');

        Route::get('/forgot-password', 'showRequestForm')->name('forgot_password.email_form');
        Route::post('/forgot-password', 'sendResetLink')->name('forgot_password.send_link');
        
        // Routes untuk OTP forgot password
        Route::get('/forgot-password/otp', 'showOtpForm')->name('forgot_password.otp_form');
        Route::post('/forgot-password/otp/verify', 'verifyOtpForgotPassword')->name('forgot_password.verify_otp');
        Route::post('/forgot-password/otp/resend', 'resendOtpForgotPassword')->name('forgot_password.resend_otp');

        Route::get('/password-reset/{token}', 'showResetForm')->name('password.reset');
        Route::post('/password-reset', 'resetPassword')->name('password.update');
    });

    // SSO (disabled - controller not yet created)
    // Route::controller(SSOController::class)->group(function () {
    //     Route::get('/auth/{provider}/redirect', 'redirect')->name('sso.redirect');
    //     Route::get('/auth/{provider}/callback', 'callback')->name('sso.callback');
    // });
});

/*
|--------------------------------------------------------------------------
| PROTECTED (AUTH REQUIRED)
|--------------------------------------------------------------------------
*/
Route::middleware('auth')->group(function () {

    Route::post('/logout', [AuthController::class, 'logout'])->name('logout');

    // ===== PROFILE USER (untuk edit data Profil) =====
    // Tidak ada GET /myprofile lagi, cukup ini saja
    // Dipindahkan ke dalam user area

    /*
    |--------------------------------------------------------------------------
    | ADMIN AREA
    |--------------------------------------------------------------------------
    */
    Route::prefix('admin')
        ->middleware('cekRole:admin')
        ->name('admin.')
        ->group(function () {

            // Dashboard
            Route::get('/dashboard', [AdminDashboardController::class, 'index'])->name('dashboard');

            // VERIFIKASI
            Route::prefix('verifikasi')->name('verifikasi.')->group(function () {
                Route::get('/', [VerifikasiController::class, 'index'])->name('index');
                Route::get('/{id}', [VerifikasiController::class, 'show'])->name('show');
                Route::post('/{id}/approve', [VerifikasiController::class, 'approve'])->name('approve');
                Route::post('/{id}/reject', [VerifikasiController::class, 'reject'])->name('reject');
            });

            // DOKUMEN
            Route::prefix('dokumen')->name('dokumen.')->group(function () {
                Route::get('/download/{id}', [DokumenController::class, 'download'])->name('download');
                Route::get('/view/{id}', [DokumenController::class, 'view'])->name('view');
                Route::get('/', [DokumenController::class, 'index'])->name('index');
                Route::get('/{id}', [DokumenController::class, 'show'])->name('show');
                Route::post('/{id}/approve', [DokumenController::class, 'approve'])->name('approve');
                Route::post('/{id}/reject', [DokumenController::class, 'reject'])->name('reject');
            });

            // SELEKSI
            Route::prefix('seleksi')->name('seleksi.')->group(function () {
                Route::get('/', [AdminSeleksiController::class, 'index'])->name('index');
                Route::post('/{id}', [AdminSeleksiController::class, 'update'])->name('update');
            });

            // PEMBAYARAN (VERIFIKASI PEMBAYARAN OLEH ADMIN)
            Route::prefix('pembayaran')->name('pembayaran.')->group(function () {
                Route::get('/', [VerifikasiPembayaranController::class, 'index'])->name('index');
                Route::get('/{id}', [VerifikasiPembayaranController::class, 'show'])->name('show');
                Route::post('/{id}/approve', [VerifikasiPembayaranController::class, 'approve'])->name('approve');
                Route::post('/{id}/reject', [VerifikasiPembayaranController::class, 'reject'])->name('reject');
            });

            // PENGUMUMAN
            Route::prefix('pengumuman')->name('pengumuman.')->group(function () {
                Route::get('/', [AdminPengumumanController::class, 'index'])->name('index');
                Route::get('/create', [AdminPengumumanController::class, 'create'])->name('create');
                Route::post('/', [AdminPengumumanController::class, 'store'])->name('store');
                Route::delete('/{id}', [AdminPengumumanController::class, 'destroy'])->name('destroy');
            });

            // LAPORAN
            Route::get('/laporan', [LaporanController::class, 'index'])->name('laporan.index');
            Route::get('/laporan/export-csv', [LaporanController::class, 'exportCsv'])->name('laporan.export.csv');

            // GELOMBANG
            Route::prefix('gelombang')->name('gelombang.')->group(function () {
                Route::get('/', [GelombangController::class, 'index'])->name('index');
                Route::get('/create', [GelombangController::class, 'create'])->name('create');
                Route::post('/', [GelombangController::class, 'store'])->name('store');
                Route::get('/{id}/edit', [GelombangController::class, 'edit'])->name('edit');
                Route::put('/{id}', [GelombangController::class, 'update'])->name('update');
                Route::delete('/{id}', [GelombangController::class, 'destroy'])->name('destroy');
            });

            // JURUSAN
            Route::prefix('jurusan')->name('jurusan.')->group(function () {
                Route::get('/', [JurusanController::class, 'index'])->name('index');
                Route::get('/create', [JurusanController::class, 'create'])->name('create');
                Route::post('/', [JurusanController::class, 'store'])->name('store');
                Route::get('/{id}/edit', [JurusanController::class, 'edit'])->name('edit');
                Route::put('/{id}', [JurusanController::class, 'update'])->name('update');
                Route::delete('/{id}', [JurusanController::class, 'destroy'])->name('destroy');
            });

            // LOG AKTIVITAS
            Route::get('/log-aktivitas', [LogAktivitasController::class, 'index'])->name('log_aktivitas.index');
        });

    /*
    |--------------------------------------------------------------------------
    | USER AREA
    |--------------------------------------------------------------------------
    */
    Route::prefix('user')
        ->middleware('cekRole:user')
        ->name('user.')
        ->group(function () {

            Route::get('/dashboard', [UserController::class, 'dashboard'])->name('dashboard');

            // BIODATA (Multi-step)
            Route::get('/biodata', [UserController::class, 'biodata'])->name('biodata');
            Route::get('/biodata/step1', [UserController::class, 'biodataStep1'])->name('biodata.step1');
            Route::post('/biodata/step1/store', [UserController::class, 'storeStep1'])->name('biodata.store.step1');
            Route::get('/biodata/step2', [UserController::class, 'biodataStep2'])->name('biodata.step2');
            Route::post('/biodata/step2/store', [UserController::class, 'storeStep2'])->name('biodata.store.step2');
            
            // Legacy route untuk backward compatibility
            Route::post('/biodata/save', [UserController::class, 'storeBiodata'])->name('biodata.save');

            // ORANG TUA (Multi-step)
            Route::get('/orangtua', [OrangTuaController::class, 'index'])->name('orangtua');
            Route::get('/orangtua/step1', [OrangTuaController::class, 'step1'])->name('orangtua.step1');
            Route::post('/orangtua/step1/store', [OrangTuaController::class, 'storeStep1'])->name('orangtua.store.step1');
            Route::get('/orangtua/step2', [OrangTuaController::class, 'step2'])->name('orangtua.step2');
            Route::post('/orangtua/step2/store', [OrangTuaController::class, 'storeStep2'])->name('orangtua.store.step2');
            
            // Legacy route untuk backward compatibility
            Route::post('/orangtua/save', [OrangTuaController::class, 'store'])->name('orangtua.save');

            // PROFILE
            Route::get('/profile', [BiodataController::class, 'index'])->name('profile.index');
            Route::get('/profile/edit', [BiodataController::class, 'edit'])->name('profile.edit');
            Route::put('/profile', [BiodataController::class, 'update'])->name('profile.update');
            Route::delete('/profile/biodata', [BiodataController::class, 'destroy'])->name('profile.destroy');

            // FORMULIR
            Route::resource('/formulir', FormulirController::class);

            // DOKUMEN
            Route::get('/dokumen', [SiswaDokumenController::class, 'index'])->name('dokumen.index');
            Route::post('/dokumen/upload', [SiswaDokumenController::class, 'store'])->name('dokumen.store');
            Route::get('/dokumen/{id}', [SiswaDokumenController::class, 'show'])->name('dokumen.show');
            Route::delete('/dokumen/{id}', [SiswaDokumenController::class, 'destroy'])->name('dokumen.destroy');

            // PEMBAYARAN
            Route::get('/pembayaran', [PembayaranController::class, 'index'])->name('pembayaran');
            Route::post('/pembayaran/upload', [PembayaranController::class, 'store'])->name('pembayaran.upload');
            Route::get('/pembayaran/kuitansi', [PembayaranController::class, 'kuitansi'])->name('pembayaran.kuitansi');

            // STATUS SELEKSI
            Route::get('/status', [StatusSeleksiController::class, 'index'])->name('status');
            Route::get('/seleksi', [SeleksiController::class, 'index'])->name('seleksi');
            Route::get('/surat-penerimaan', [SeleksiController::class, 'suratPenerimaan'])->name('surat_penerimaan');

            // DAFTAR ULANG
            Route::get('/daftar-ulang', [UserController::class, 'daftarUlang'])->name('daftar_ulang');

            // Pengumuman untuk user
            Route::get('/pengumuman', [\App\Http\Controllers\UserPengumumanController::class, 'index'])->name('pengumuman');
        });

    // (Route pengumuman-saya dihapus, gunakan /user/pengumuman)

});
