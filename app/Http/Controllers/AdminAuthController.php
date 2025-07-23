<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Session;
use Illuminate\Support\Facades\Hash;
use App\Models\Admin;
use App\Models\BukuTamu;

class AdminAuthController extends Controller
{
    public function showLoginForm()
    {
        return view('admin.login');
    }

    public function login(Request $request)
    {
        $request->validate([
            'email'    => 'required|email',
            'password' => 'required',
        ]);

        $admin = Admin::where('email', $request->email)->first();

        if (!$admin || !Hash::check($request->password, $admin->password)) {
            return back()->with('error', 'Email atau password salah.');
        }

        Session::put('is_admin_logged_in', true);
        Session::put('admin_id', $admin->id);

        return redirect()->route('admin.dashboard')->with('success', 'Selamat datang di Panel Admin PTUN Bandung');
    }

    public function logout()
    {
        Session::forget('is_admin_logged_in');
        Session::forget('admin_id');
        Session::forget('admin');

        return redirect()->route('admin.login')->with('success', 'Berhasil Logout dari sistem.');
    }

    public function dashboard()
    {
        $tamus = BukuTamu::latest()->get(); // ✅ FIX: ganti Tamu menjadi BukuTamu
        return view('admin.dashboard', compact('tamus'));
    }
}
