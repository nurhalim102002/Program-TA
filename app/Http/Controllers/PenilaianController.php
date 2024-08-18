<?php

namespace App\Http\Controllers;

use App\Models\Jabatan;
use App\Models\Karyawan;
use App\Models\Penugasan;
use App\Models\Absensi;
use App\Models\SPeringatan;
use App\Models\ProfileMatching;
use App\Models\Evaluasi;
use Illuminate\Http\Request;

class PenilaianController extends Controller
{
    public function DataPenilaian2(Request $request)
    {
        $periodeOptions = Evaluasi::select('periode')
            ->distinct()
            ->orderBy('periode', 'desc')
            ->pluck('periode', 'periode')
            ->prepend('Semua', '');

        $queryRasio = Evaluasi::with(['karyawan', 'karyawan.evaluasi']);

        // Hanya filter jika periode bukan "Semua"
        if ($request->has('periode') && $request->periode != '') { 
            $queryRasio->where('periode', $request->periode);
        }

        // Terapkan pengurutan langsung pada $queryRasio
        $rasio = $queryRasio->orderBy('rata_rata', 'desc')->get();

        // Mengambil data yang mungkin dibutuhkan di view
        $uniquePeriode = Evaluasi::distinct()->pluck('periode');
        $evaluasi = Evaluasi::all();

        return view('halaman.datapenilaian2', compact('rasio', 'periodeOptions', 'uniquePeriode', 'evaluasi'));
    }
}

