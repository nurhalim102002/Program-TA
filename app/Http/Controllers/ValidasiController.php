<?php

namespace App\Http\Controllers;

use App\Models\Karyawan;
use App\Models\ProfileMatching;
use Illuminate\Http\Request;

class ValidasiController extends Controller
{
    public function ValidasiHasil(Request $request, $id)
    {
        // Temukan ProfileMatching berdasarkan ID yang diberikan
        $profilPencocokan = ProfileMatching::findOrFail($id);

        // Data yang akan diperbarui
        $dataUpdate = [
            'status_validasi' => 'Tervalidasi'
        ];

        // Perbarui data
        $profilPencocokan->update($dataUpdate);

        // Redirect kembali ke halaman data penilaian dengan pesan sukses
        return redirect('hasilalgoritma2')->with('success', 'Status validasi berhasil diperbarui menjadi Tervalidasi.');
    }

    public function BatalValidasiHasil(Request $request, $id)
    {
        // Temukan ProfileMatching berdasarkan ID yang diberikan
        $profilPencocokan = ProfileMatching::findOrFail($id);

        // Data yang akan diperbarui
        $dataUpdate = [
            'status_validasi' => 'Belum Tervalidasi'
        ];

        // Perbarui data
        $profilPencocokan->update($dataUpdate);

        // Redirect kembali ke halaman data penilaian dengan pesan sukses
        return redirect('hasilalgoritma2')->with('success', 'Status validasi berhasil diperbarui menjadi Tervalidasi.');
    }

}
