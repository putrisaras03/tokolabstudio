<?php

use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\AuthController;
use App\Http\Controllers\Auth\ForgotPasswordController;
use App\Http\Controllers\ProfileController;
use App\Http\Controllers\DashboardController;
use App\Http\Controllers\ProductController;

// Route utama login
Route::get('/', function () {
    return view('login'); 
});

// Login
Route::get('/login', [AuthController::class, 'showLogin'])->name('login'); 
Route::post('/login', [AuthController::class, 'login'])->name('login');  

// Logout
Route::post('/logout', [AuthController::class, 'logout'])->name('logout'); 


// Menampilkan form awal (input WhatsApp / OTP)
Route::get('/forgot-password', [ForgotPasswordController::class, 'showForm'])->name('password.request');

// Proses kirim OTP via WhatsApp
Route::post('/forgot-password/send-otp', [ForgotPasswordController::class, 'sendOtp'])->name('password.sendOtp');

// Proses verifikasi OTP
Route::post('/forgot-password/verify-otp', [ForgotPasswordController::class, 'verifyOtp'])->name('password.verifyOtp');

// Menampilkan form reset password
Route::get('/reset-password', [ForgotPasswordController::class, 'showResetForm'])
    ->name('password.reset.form');

// Menyimpan password baru
Route::post('/reset-password', [ForgotPasswordController::class, 'resetPassword'])->name('password.reset');

// halaman setelah login
Route::get('/dashboard', [DashboardController::class, 'index'])->middleware('auth');


Route::middleware('auth')->group(function () {
    // Halaman profil
    Route::get('/profile', [ProfileController::class, 'showProfile'])->name('profile');
    Route::post('/profile/update', [ProfileController::class, 'updateProfile'])->name('profile.update');

    // Ganti password
    Route::get('/profile/password', [ProfileController::class, 'showPasswordForm'])->name('profile.password');
    Route::post('/profile/password', [ProfileController::class, 'updatePassword'])->name('password.update');
});

Route::get('/produk', [ProductController::class, 'index'])->middleware('auth');

Route::get('akun', function () {
    return view('akun');
});


Route::get('/analitik', function () {
    return view('analitik');
});

// Route untuk membuka modal lupa password via session
Route::post('/modal/forgot-password', function () {
    session(['show_modal' => true]);
    return redirect()->route('login');
})->name('modal.forgot-password');

// (Opsional) Route untuk reset ulang proses jika user klik "ulangi proses dari awal"
Route::get('/forgot-password/reset', function () {
    session()->forget(['otp_phase', 'otp_phone', 'verified_phone']);
    session(['show_modal' => true]);
    return redirect()->route('login');
})->name('modal.forgot-password.reset');