<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\AdminController;
use App\Http\Controllers\HomeController;
use App\Http\Controllers\UserController;

Route::get('/', function () {
    return view('admin.dashboard');
})->name('admin');

// User form routes
Route::get('/form', [UserController::class, 'form'])->name('user.form');

Route::post('/tamu', [HomeController::class, 'store'])->name('tamu.store');

Route::prefix('admin')->group(function () {
    Route::get('/', [AdminController::class, 'index'])->name('admin.dashboard');
});
