<?php

namespace App\Http\Controllers;

use App\Models\BukuTamu;
use Illuminate\Http\Request;

class AdminController extends Controller
{
    public function index()
    {
        $tamus = BukuTamu::orderBy('waktu_datang', 'desc')->get();
        return view('admin.dashboard', compact('tamus'));
    }
}
