<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\ProfileMatching;
use App\Models\Karyawan;
use App\Models\Evaluasi;

class CetakController extends Controller
{

    public function cetakNilaiIndividu($karyawanId, $periode)
    {
        // Mengambil data karyawan berdasarkan ID
        $karyawan = Karyawan::find($karyawanId);

        // Mengambil data penilaian berdasarkan karyawan ID dan periode
        $rasio = Evaluasi::where('id_karyawan', $karyawanId)
                      ->where('periode', $periode)
                      ->first();

        if (!$karyawan || !$rasio) {
            return redirect()->back()->with('error', 'Data tidak ditemukan');
        }

        // Menyiapkan data untuk ditampilkan di view
        $data = [
            'karyawan' => $karyawan,
            'periode' => $rasio->periode,
            'tanggal_penilaian' => $rasio->tanggal_penilaian,
            'kemampuan'=> $rasio->kemampuan,
            'tanggung_jawab'=> $rasio->tanggung_jawab,
            'prestasi_kerja'=> $rasio->prestasi_kerja,
            'kejujuran'=> $rasio->kejujuran,
            'disiplin'=> $rasio->disiplin,
            'loyalitas'=> $rasio->loyalitas,
            'kerja_keras'=> $rasio->kerja_keras,
            'rasa_memiliki'=> $rasio->rasa_memiliki,
            'total_nilai'=> $rasio->total_nilai
        ];

        // Memanggil view cetak_penilaian dengan data
        return view('halaman-cetak.cetaknilaiindividu', $data);
    }
    
    public function cetakHasilIndividu($karyawanId, $periode)
    {
        // Mengambil data karyawan berdasarkan ID
        $karyawan = Karyawan::find($karyawanId);

        // Mengambil data penilaian berdasarkan karyawan ID dan periode
        $rasio = ProfileMatching::where('id_karyawan', $karyawanId)
                      ->where('periode', $periode)
                      ->first();

        if (!$karyawan || !$rasio) {
            return redirect()->back()->with('error', 'Data tidak ditemukan');
        }

        // Menyiapkan data untuk ditampilkan di view
        $data = [
            'karyawan' => $karyawan,
            'periode' => $rasio->periode,
            'tanggal_penilaian' => $rasio->tanggal_penilaian,
            'nilai_penugasan' => $rasio->nilai_penugasan,
            'nilai_absensi' => $rasio->nilai_absensi,
            'nilai_peringatan' => $rasio->nilai_peringatan,
            'nilai_evaluasi' => $rasio->nilai_evaluasi,
            'nilai_akhir' => $rasio->nilai_akhir,
            'rekomendasi' => $rasio->rekomendasi
        ];

        // Memanggil view cetak_penilaian dengan data
        return view('halaman-cetak.cetakhasilindividu', $data);
    }

    // Controller
    public function cetakPerangkingan(Request $request) {
        $periode = $request->input('periode'); // Mengambil periode dari permintaan
    
        // Query untuk mendapatkan data yang hanya tervalidasi dan sesuai dengan periode yang dipilih
        $rasio = ProfileMatching::with('karyawan')
                    ->where('status_validasi', 'Tervalidasi')
                    ->where('periode', $periode) // Filter berdasarkan periode
                    ->orderBy('nilai_akhir', 'desc')
                    ->get();
    
        return view('halaman-cetak.cetakranking', compact('rasio', 'periode'));
    }
    
    

}


