<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\AuthController;


Route::get('/', function () {
    return view('login');
});
Route::get('/login', [AuthController::class, 'showLogin'])->name('login');
Route::post('/login', [AuthController::class, 'login']);
Route::get('/login', [AuthController::class, 'logout']);
Route::post('/logout', [AuthController::class, 'logout'])->name('logout');
// halaman setelah login
Route::get('/dashboard', function () {
    return view('dashboard');
})->middleware('auth');


Route::get('akun', function () {
    return view('akun');
});

Route::get('/produk', function () {
    return view('produk');
});

Route::get('/analitik', function () {
    return view('analitik');
});
