// Export PDF Buku Tamu Bulanan
use App\Http\Controllers\ExportController;
Route::get('/admin/buku-tamu/export-pdf', [ExportController::class, 'exportBukuTamuPerBulan'])->name('admin.buku-tamu.export-pdf');
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
Route::delete('/tamu/{id}', [HomeController::class, 'destroy'])->name('tamu.destroy');



// Admin Auth Routes
Route::get('/admin/login', [AdminAuthController::class, 'showLoginForm'])->name('admin.login');
Route::post('/admin/login', [AdminAuthController::class, 'login'])->name('admin.login.submit');
Route::post('/admin/logout', [AdminAuthController::class, 'logout'])->name('admin.logout');

// Admin Panel (protected by middleware - gunakan class langsung, bukan alias)
Route::prefix('admin')->middleware(AdminMiddleware::class)->group(function () {
    Route::get('/', [AdminAuthController::class, 'dashboard'])->name('admin.dashboard');

    // Export PDF Buku Tamu Bulanan (harus di dalam group admin)
    Route::get('/buku-tamu/export-pdf', [ExportController::class, 'exportBukuTamuPerBulan'])->name('admin.buku-tamu.export-pdf');

    // Halaman status tamu
    Route::get('/statistik', [\App\Http\Controllers\HomeController::class, 'statistik'])->name('admin.statistik');
    Route::get('/accept', [\App\Http\Controllers\HomeController::class, 'acceptPage'])->name('tamu.accept.page');
    Route::get('/pending', [\App\Http\Controllers\HomeController::class, 'pendingPage'])->name('tamu.pending.page');
    Route::get('/reject', [\App\Http\Controllers\HomeController::class, 'rejectPage'])->name('tamu.reject.page');
});

// Aksi status tamu
Route::post('/tamu/{id}/accept', [HomeController::class, 'accept'])->name('tamu.accept');
Route::post('/tamu/{id}/pending', [HomeController::class, 'pending'])->name('tamu.pending');
Route::post('/tamu/{id}/reject', [HomeController::class, 'reject'])->name('tamu.reject');