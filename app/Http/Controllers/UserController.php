<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\BukuTamu;

class UserController extends Controller
{
    public function form()
    {
        return view('home.form');
    }

    public function store(Request $request)
    {
        $validated = $request->validate([
            'nama' => 'required|string|max:255',
            'instansi' => 'required|string|max:255',
            'no_telepon' => 'nullable|string|max:20',
            'keperluan' => 'required|string',
            'foto_wajah' => 'nullable|image|mimes:jpeg,png,jpg|max:2048'
        ]);

        if ($request->hasFile('foto_wajah')) {
            $foto = $request->file('foto_wajah');
            $filename = time() . '.' . $foto->getClientOriginalExtension();
            $foto->storeAs('public/foto_tamu', $filename);
            $validated['foto_wajah'] = 'foto_tamu/' . $filename;
        }

        BukuTamu::create($validated);

        return redirect()->route('user.form')->with('success', 'Data berhasil disimpan!');
    }
}
