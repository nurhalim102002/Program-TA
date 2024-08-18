<?php

namespace App\Http\Controllers;

use App\Models\Karyawan;
use App\Models\Penugasan;
use App\Models\Absensi;
use App\Models\Jabatan;
use App\Models\User;
use App\Models\Evaluasi;
use App\Models\ProfileMatching;
use Illuminate\Http\Request;

class HomeController extends Controller
{
    public function HomePenilai()
    {
        $totalKaryawan = Karyawan::count();
        $totalAdmin = User::where('level', 'admin')->count();
        $totalPenilai = User::where('level', 'penilai')->count();
        return view('homepenilai', compact('totalKaryawan', 'totalAdmin', 'totalPenilai'));
    }

    public function DataKaryawan()
    {
        // $PM = ProfileMatching::with(['evaluasi', 'karyawan'])->get();
        $kry = Karyawan::all();
        return view('halaman.datakaryawan', compact('kry'));
    }

    public function DataAbsensi()
    {
        // $PM = ProfileMatching::with(['evaluasi', 'karyawan'])->get();
        $abs = Absensi::all();
        return view('halaman.dataabsensi', compact('abs'));
    }

    public function DataPenugasan()
    {
        // $PM = ProfileMatching::with(['evaluasi', 'karyawan'])->get();
        $pen = Penugasan::all();
        return view('halaman.datapenugasan', compact('pen'));
    }

    public function DataJabatan()
    {
        // $kry = Karyawan::all();
        return view('halaman.datajabatan');
    }

    public function DataAdmin()
    {
        // $kry = Karyawan::all();
        return view('halaman.dataadmin');
    }

    public function DataPenilaian(Request $request)
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

        return view('halaman.datapenilaian', compact('rasio', 'periodeOptions', 'uniquePeriode', 'evaluasi'));
    }

    public function HasilAlgoritma(Request $request)
    {
        $periodeOptions = ProfileMatching::select('periode')
            ->distinct()
            ->orderBy('periode', 'desc')
            ->pluck('periode', 'periode')
            ->prepend('Semua', '');

        $queryRasio = ProfileMatching::with('karyawan');

        // Hanya filter jika periode bukan "Semua"
        if ($request->has('periode') && $request->periode != '') { 
            $queryRasio->where('periode', $request->periode);
        }

        // Terapkan pengurutan langsung pada $queryRasio
        $rasio = $queryRasio->orderBy('nilai_akhir', 'desc')->get();

        // Mengambil data yang mungkin dibutuhkan di view
        $uniquePeriode = ProfileMatching::distinct()->pluck('periode');
        $evaluasi = Evaluasi::all();

        return view('halaman.hasilalgoritma', compact('rasio', 'periodeOptions', 'uniquePeriode', 'evaluasi'));
    }

    public function HasilAlgoritma2(Request $request)
    {
        $periodeOptions = ProfileMatching::select('periode')
            ->distinct()
            ->orderBy('periode', 'desc')
            ->pluck('periode', 'periode')
            ->prepend('Semua', '');

        $queryRasio = ProfileMatching::with('karyawan');

        // Hanya filter jika periode bukan "Semua"
        if ($request->has('periode') && $request->periode != '') { 
            $queryRasio->where('periode', $request->periode);
        }

        // Terapkan pengurutan langsung pada $queryRasio
        $rasio = $queryRasio->orderBy('nilai_akhir', 'desc')->get();

        // Mengambil data yang mungkin dibutuhkan di view
        $uniquePeriode = ProfileMatching::distinct()->pluck('periode');
        $evaluasi = Evaluasi::all();

        return view('halaman.hasilalgoritma2', compact('rasio', 'periodeOptions', 'uniquePeriode', 'evaluasi'));
    }

    // public function DataPenilaian()
    // {
    //     $periodeOptions = ProfileMatching::select('periode')
    //     ->distinct()
    //     ->orderBy('periode', 'desc')
    //     ->pluck('periode', 'periode')
    //     ->prepend('Semua', '');

    //     $queryRasio = ProfileMatching::with('karyawan')->where('delstatus', true);

    //     // Hanya filter jika periode bukan "Semua"
    //     if ($request->has('periode') && $request->periode != '') { 
    //         $queryRasio->where('periode', $request->periode);
    //     }

    //     $rasio = $queryRasio->get();

    //     // $PM = ProfileMatching::with(['evaluasi', 'karyawan'])->get();
    //     // $uniquePeriode = ProfileMatching::distinct()->pluck('periode');
    //     // $evaluasi = Evaluasi::all();
    //     return view('halaman.datapenilaian', compact('PM', 'uniquePeriode', 'evaluasi'));
    // }

    public function FormPenilaian() {
        // Mungkin Anda juga ingin menggunakan evaluasi dengan data karyawan yang telah difilter
        $eval = Evaluasi::with(['karyawan' => function($query) {
            $query->whereDoesntHave('jabatan', function ($q) {
                $q->whereIn('jabatan', ['Manager', 'Asisten']); // Mengecualikan Manager dan Asisten
            });
        }])->get();
    
        // Menggunakan logika yang sama untuk mendapatkan daftar karyawan tanpa 'Manager' dan 'Asisten'
        $kry = Karyawan::whereDoesntHave('jabatan', function ($query) {
            $query->whereIn('jabatan', ['Manager', 'Asisten']); // Mengecualikan Manager dan Asisten
        })->get();
    
        return view('halaman.formpenilaian', compact('eval', 'kry'));
    }

}
