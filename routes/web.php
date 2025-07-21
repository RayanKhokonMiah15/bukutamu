<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\AdminController;

Route::get('/home', function () {
    return view('home/welcome');
});

Route::get('/', [AdminController::class, 'index'])->name('admin.dashboard');
