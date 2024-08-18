<?php

namespace App\Http\Controllers;

use App\Models\ProfileMatching;
use Illuminate\Http\Request;
use App\Models\Karyawan;
use App\Models\Penugasan;
use App\Models\Absensi;
use App\Models\Speringatan;

class DetailkaryawanController extends Controller
{
    public function show($id)
    {
        try {
            // Ambil data karyawan dari database
            $employee = Karyawan::findOrFail($id);

            // Ambil data profile matching terkait
            $profileMatching = ProfileMatching::where('karyawan_id', $id)->get();

            // Data tambahan yang dibutuhkan
            $additionalData = [
                'nik' => $employee->nik,
                'nama' => $employee->nama,
                // Tambahkan lebih banyak sesuai kebutuhan
            ];

            // Jika ingin menambahkan lebih banyak informasi dari profile_matching
            $profileMatchingData = [];
            foreach ($profileMatching as $profile) {
                $profileMatchingData[] = [
                    'nilai_penugasan' => $profile->nilai_penugasan,
                    'nilai_absensi' => $profile->nilai_absensi,
                    'nilai_peringatan' => $profile->nilai_peringatan,
                    'nilai_evaluasi' => $profile->nilai_evaluasi,
                    'nilai_akhir' => $profile->nilai_akhir,
                    'rekomendasi' => $profile->rekomendasi,
                    // Tambahkan kolom profile matching lainnya di sini
                ];
            }

            return response()->json([
                'employee' => $employee,
                'additionalData' => $additionalData,
                'profileMatching' => $profileMatchingData,
            ]);
        } catch (\Exception $e) {
            return response()->json(['error' => 'Data not found.'], 404);
        }
    }


    public function getKaryawanData($id)
{
    // Validasi karyawan
    $karyawan = Karyawan::find($id);
    if (!$karyawan) {
        return response()->json(['error' => 'Karyawan tidak ditemukan'], 404);
    }

    // Pengambilan data penugasan, absensi, dan peringatan
    $penugasan = Penugasan::where('id_karyawan', $id)->get();
    $absensi = Absensi::where('id_karyawan', $id)->first();
    $speringatan = Speringatan::where('id_karyawan', $id)->first();
    
    // Kumpulkan semua data yang akan dikirim sebagai JSON
    $data = [
        'karyawan' => $karyawan,
        'penugasan' => $penugasan,
        'absensi' => $absensi,
        'speringatan' => $speringatan
    ];

    return response()->json($data);
}

}
