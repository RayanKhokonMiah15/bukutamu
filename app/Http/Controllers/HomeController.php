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
            'alamat' => 'required|string|max:255',
            'no_telepon' => 'nullable|string|max:20',
            'keperluan' => 'required|string',
            'waktu_datang' => 'required|string',
            'foto_wajah' => 'required|string'
        ]);

        $data = $request->except('foto_wajah');

        // Proses foto wajah base64
        $fotoPath = null;
        if ($request->filled('foto_wajah')) {
            $base64 = $request->input('foto_wajah');
            if (preg_match('/^data:image\/(\w+);base64,/', $base64, $type)) {
                $base64 = substr($base64, strpos($base64, ',') + 1);
                $type = strtolower($type[1]); // jpg, png, etc
                $base64 = base64_decode($base64);
                if ($base64 === false) {
                    return back()->withErrors(['foto_wajah' => 'Gagal decode gambar.']);
                }
                $fileName = 'foto_' . uniqid() . '.' . $type;
                $filePath = 'foto_tamu/' . $fileName;
                Storage::disk('public')->put($filePath, $base64);
                $fotoPath = $filePath;
            } else {
                return back()->withErrors(['foto_wajah' => 'Format gambar tidak valid.']);
            }
        }
        $data['foto_wajah'] = $fotoPath;

        BukuTamu::create($data);

        return redirect()->route('home')
            ->with('success', 'Data tamu berhasil disimpan!');
    }

    public function destroy($id)
    {
        $tamu = BukuTamu::findOrFail($id);
        // Hapus foto jika ada
        if ($tamu->foto_wajah) {
            \Storage::disk('public')->delete($tamu->foto_wajah);
        }
        $tamu->delete();
        return redirect()->back()->with('success', 'Data tamu berhasil dihapus!');
    }
}
