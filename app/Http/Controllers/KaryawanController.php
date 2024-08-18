<?php

namespace App\Http\Controllers;

use App\Models\Karyawan;
use App\Models\Jabatan;
use App\Models\Penugasan;
use App\Models\Absensi;
use App\Models\Speringatan;
use App\Models\ProfileMatching;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Session;
use Illuminate\Support\Facades\Redirect;

class KaryawanController extends Controller
{
    public function TambahKaryawan()
    {
        $kry = Karyawan::with('jabatan')->get();
        $jbt = Jabatan::all();
        return view('halaman.tambahkaryawan', compact('kry', 'jbt'));
    }

    public function SimpanKaryawan(Request $request)
    {
        Karyawan::create([
            'nik' => $request->nik,
            'nama' => $request->nama,
            'ttl' => $request->ttl,
            'id_jabatan' => $request->id_jabatan,
            'tgl_masuk' => $request->tgl_masuk,
            'lama_bekerja' => $request->lama_bekerja,
            'jenis_kelamin' => $request->jenis_kelamin,
            'pendidikan_terakhir' => $request->pendidikan_terakhir,
        ]);
        return redirect('datakaryawan')->with('success', 'Data karyawan berhasil disimpan');
    }

    public function EditKaryawan($id)
    {
        $kry = Karyawan::with('jabatan')->findOrFail($id);
        $jbt = Jabatan::all();
        return view('halaman.editkaryawan', compact('kry', 'jbt'));
    }

    public function PerubahanKaryawan(Request $request, $id)
    {
        $kry = Karyawan::findOrFail($id);

        $dt = [
            'nik' => $request->nik,
            'nama' => $request->nama,
            'ttl' => $request->ttl,
            'id_jabatan' => $request->id_jabatan,
            'tgl_masuk' => $request->tgl_masuk,
            'lama_bekerja' => $request->lama_bekerja,
            'jenis_kelamin' => $request->jenis_kelamin,
            'pendidikan_terakhir' => $request->pendidikan_terakhir,
        ];

        $kry->update($dt);
        return redirect('datakaryawan')->with('success', 'Data karyawan berhasil diperbarui');
    }

    public function HapusKaryawan($id)
    {
        try {
            $kry = Karyawan::findOrFail($id);
            $kry->delete();
            
            // Tambahkan SweetAlert untuk memberi konfirmasi penghapusan
            return redirect('datakaryawan')->with('success', 'Data karyawan berhasil dihapus');
        } catch (\Exception $e) {
            return redirect()->back()->with('error', 'Gagal menghapus data karyawan');
        }
    }

    public function getData($id)
    {
        // Ambil data karyawan berdasarkan ID
        $karyawan = Karyawan::find($id);

        // Ambil data penugasan
        $penugasan = Penugasan::where('id_karyawan', $id)->get();

        // Ambil data absensi
        $absensi = Absensi::where('id_karyawan', $id)->first();

        // Ambil data surat peringatan
        $speringatan = Speringatan::where('id_karyawan', $id)->first();

        // Struktur data yang akan dikembalikan
        $data = [
            'karyawan' => $karyawan,
            'penugasan' => $penugasan,
            'absensi' => $absensi,
            'speringatan' => $speringatan
        ];

        // Kembalikan data sebagai JSON
        return response()->json($data);
    }

    public function getKaryawanData($id, $periode)
    {
        // ... (validasi karyawan) ...

        // ... (pengambilan data penugasan, absensi, speringatan) ...

        $profileMatching = ProfileMatching::where('id_karyawan', $id)
                                        ->where('periode', $periode)
                                        ->first(); // Ambil satu data saja

        // Kirim semua data ke view, termasuk data untuk modal
        return view('karyawan.detail', compact('karyawan', 'penugasan', 'absensi', 'speringatan', 'profileMatching')); 
    }



    public function getKaryawanRanking(Request $request)
    {
        // Ambil data karyawan dan penilaian
        $periode = $request->input('periode');
        $rasio = Karyawan::with('profilematching')
            ->when($periode, function ($query, $periode) {
                return $query->where('periode', $periode);
            })
            ->get();

        // Hitung nilai akhir dan urutkan
        $ranking = $rasio->map(function ($item) {
            $item->nilai_akhir = ($item->nilai_penugasan * 0.25) + ($item->nilai_absensi * 0.25) + ($item->nilai_peringatan * 0.25) + ($item->nilai_evaluasi * 0.25);
            return $item;
        })->sortByDesc('nilai_akhir');

        return view('karyawan.index', [
            'rasio' => $rasio,
            'ranking' => $ranking,
            'periodeOptions' => $this->getPeriodeOptions(),
        ]);
    }

    private function getPeriodeOptions()
    {
        // Buat opsi periode di sini
        return [
            '2021' => '2021',
            '2022' => '2022',
            '2023' => '2023',
        ];
    }

    public function showDetail($id, $periode)
    {
        $karyawan = Karyawan::findOrFail($id);

        // Ambil data profile matching karyawan berdasarkan ID dan tahun
        $profileMatching = ProfileMatching::where('id_karyawan', $id)
                                        ->where('periode', $periode)
                                        ->first(); // Atau gunakan ->get() jika ingin mengambil banyak data

        return view('karyawan.detail', compact('karyawan', 'profileMatching'));
    }


}