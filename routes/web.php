<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\AdminController;
use App\Http\Controllers\HomeController;

Route::get('/', function () {
    return view('home/welcome');
})->name('home');

Route::get('/form', function () {
    return view('home/form');
})->name('form');

Route::post('/tamu', [HomeController::class, 'store'])->name('tamu.store');

Route::prefix('admin')->group(function () {
    Route::get('/', [AdminController::class, 'index'])->name('admin.dashboard');
});
