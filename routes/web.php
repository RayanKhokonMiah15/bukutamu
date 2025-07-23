<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\AdminAuthController;
use App\Http\Controllers\HomeController;
use App\Http\Controllers\UserController;
use App\Http\Middleware\AdminMiddleware; // ⬅️ Tambahkan ini untuk pakai class middleware langsung

// Welcome page
Route::get('/', function () {
    return view('home.welcome');
})->name('home');

Route::get('/about', function () { 
    return view('home.about');
})->name('about');

Route::get('/kontak', function () {
    return view('home.kontak');
})->name('kontak');

// Admin logout route
Route::post('/admin/logout', [AdminAuthController::class, 'logout'])->name('admin.logout');

// User form routes
Route::get('/form', [UserController::class, 'form'])->name('user.form');
Route::post('/tamu', [HomeController::class, 'store'])->name('tamu.store');



// Admin Auth Routes
Route::get('/admin/login', [AdminAuthController::class, 'showLoginForm'])->name('admin.login');
Route::post('/admin/login', [AdminAuthController::class, 'login'])->name('admin.login.submit');
Route::post('/admin/logout', [AdminAuthController::class, 'logout'])->name('admin.logout');

// Admin Panel (protected by middleware - gunakan class langsung, bukan alias)
Route::prefix('admin')->middleware(AdminMiddleware::class)->group(function () {
    Route::get('/', [AdminAuthController::class, 'dashboard'])->name('admin.dashboard');
});
