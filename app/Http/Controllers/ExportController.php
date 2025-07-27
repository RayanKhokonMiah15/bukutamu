<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\BukuTamu;
use Barryvdh\DomPDF\Facade\Pdf;

class ExportController extends Controller
{
    public function exportBukuTamuPerBulan(Request $request)
    {
        $bulan = $request->input('bulan') ?? now()->format('m');
        $tahun = $request->input('tahun') ?? now()->format('Y');
        $monthYear = $tahun . '-' . $bulan;
        $guestsMonth = BukuTamu::whereRaw("DATE_FORMAT(waktu_datang, '%Y-%m') = ?", [$monthYear])->orderBy('waktu_datang', 'desc')->get();
        $pdf = PDF::loadView('admin.pdf_buku_tamu', [
            'guestsMonth' => $guestsMonth,
            'bulan' => $bulan,
            'tahun' => $tahun
        ]);
        $filename = 'buku_tamu_' . $bulan . '_' . $tahun . '.pdf';
        return $pdf->stream($filename);
    }
}
