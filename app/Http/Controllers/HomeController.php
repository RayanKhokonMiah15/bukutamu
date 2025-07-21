<?php

namespace App\Http\Controllers;

use App\Models\BukuTamu;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;

class HomeController extends Controller
{
    public function store(Request $request)
    {
        $request->validate([
            'nama' => 'required|string|max:255',
            'instansi' => 'required|string|max:255',
            'no_telepon' => 'nullable|string|max:20',
            'keperluan' => 'required|string',
            'waktu_datang' => 'required|date',
            'foto_wajah' => 'nullable|image|mimes:jpeg,png,jpg|max:2048'
        ]);

        $data = $request->except('foto_wajah');

        if ($request->hasFile('foto_wajah')) {
            $file = $request->file('foto_wajah');
            $path = $file->store('public/foto-tamu');
            $data['foto_wajah'] = str_replace('public/', '', $path);
        }

        BukuTamu::create($data);

        return redirect()->route('home')
            ->with('success', 'Data tamu berhasil disimpan!');
    }
}
