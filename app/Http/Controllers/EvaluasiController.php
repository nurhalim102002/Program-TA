<?php

namespace App\Http\Controllers;

use App\Models\Evaluasi;
use App\Models\ProfileMatching; // Ganti 'ProfileMatching' dengan 'ProfilPencocokan' jika model sudah siap
use Illuminate\Http\Request;

class EvaluasiController extends Controller
{
    public function simpanNilai(Request $request)
    {
        // Validasi input permintaan termasuk memastikan ID karyawan ada di database
        $dataValidasi = $request->validate([
            'id_karyawan' => 'required|exists:karyawans,id', // Memastikan ID karyawan ada di tabel 'karyawans'
            'kemampuan' => 'required|numeric|min:0|max:5',
            'tanggung_jawab' => 'required|numeric|min:0|max:5',
            'prestasi_kerja' => 'required|numeric|min:0|max:5',
            'kejujuran' => 'required|numeric|min:0|max:5',
            'disiplin' => 'required|numeric|min:0|max:5',
            'loyalitas' => 'required|numeric|min:0|max:5',
            'kerja_keras' => 'required|numeric|min:0|max:5',
            'rasa_memiliki' => 'required|numeric|min:0|max:5',
            'jumlah_penugasan' => 'required|numeric|min:0|max:10',
            'mangkir' => 'required|numeric|min:0',
            'izin_p1' => 'required|numeric|min:0',
            'sp_ke' => 'required|numeric|min:0',
            'periode' => ['required', 'regex:/^\d{4}$/'] // Menambahkan validasi periode sebagai tahun (YYYY)
        ]);
        

        // Menghitung rata-rata nilai aktual dan rekomendasi
        [$nilaiRataRata] = $this->hitungNilaiRataRata($dataValidasi);

        // Mengonversi nilai rata-rata sesuai dengan tabel
        $nilaiRataRataKonversi = $this->konversiNilaiRataRata($nilaiRataRata);

        // Mengonversi nilai sebelum menyimpan
        $nilaiPenugasan = $this->konversiPenugasan($dataValidasi['jumlah_penugasan']);
        $nilaiAbsensi = $this->konversiAbsensi($dataValidasi['mangkir'], $dataValidasi['izin_p1']);
        $nilaiPeringatan = $this->konversiPeringatan($dataValidasi['sp_ke']);

        // Membuat instance baru Evaluasi dan menyimpan data
        $evaluasi = new Evaluasi([
            'id_karyawan' => $dataValidasi['id_karyawan'],
            'periode' => $dataValidasi['periode'],
            'kemampuan' => $dataValidasi['kemampuan'],
            'tanggung_jawab' => $dataValidasi['tanggung_jawab'],
            'prestasi_kerja' => $dataValidasi['prestasi_kerja'],
            'kejujuran' => $dataValidasi['kejujuran'],
            'disiplin' => $dataValidasi['disiplin'],
            'loyalitas' => $dataValidasi['loyalitas'],
            'kerja_keras' => $dataValidasi['kerja_keras'],
            'rasa_memiliki' => $dataValidasi['rasa_memiliki'],
            'rata_rata' => $nilaiRataRata,
            'tanggal_penilaian' => now()
        ]);
        $evaluasi->timestamps = false; // Menonaktifkan timestamps
        $evaluasi->save();

        // Menghitung GAP
        $targetProfilPencocokan = [
            'nilai_penugasan' => 2,
            'nilai_absensi' => 4,
            'nilai_peringatan' => 4,
            'nilai_evaluasi' => 5,
        ];

        $nilaiGap = [
            'gap_evaluasi' => $nilaiRataRataKonversi - $targetProfilPencocokan['nilai_evaluasi'],
            'gap_penugasan' => $nilaiPenugasan - $targetProfilPencocokan['nilai_penugasan'],
            'gap_absensi' => $nilaiAbsensi - $targetProfilPencocokan['nilai_absensi'],
            'gap_peringatan' => $nilaiPeringatan - $targetProfilPencocokan['nilai_peringatan']
        ];

        // Definisikan tabel pembobotan
        $tabelPembobotan = [
            0 => 5,
            1 => 4.5,
            -1 => 4,
            2 => 3.5,
            -2 => 3,
            3 => 2.5,
            -3 => 2,
            4 => 1.5,
            -4 => 1
        ];

        // Lakukan pembobotan untuk setiap kriteria
        $bobotEvaluasi = $tabelPembobotan[$nilaiGap['gap_evaluasi']];
        $bobotPenugasan = $tabelPembobotan[$nilaiGap['gap_penugasan']];
        $bobotAbsensi = $tabelPembobotan[$nilaiGap['gap_absensi']];
        $bobotPeringatan = $tabelPembobotan[$nilaiGap['gap_peringatan']];

        // Hitung Faktor Inti (CF) dan Faktor Sekunder (SF)
        $faktorInti = ($bobotEvaluasi + $bobotPenugasan) / 2;
        $faktorSekunder = ($bobotAbsensi + $bobotPeringatan) / 2;

        // Hitung nilai akhir (N)
        $nilaiAkhir = ($faktorInti * 0.6) + ($faktorSekunder * 0.4);

        // Format nilai akhir menjadi dua angka di belakang koma
        $nilaiAkhir = number_format($nilaiAkhir, 2, '.', '');

        // Tentukan rekomendasi berdasarkan nilai akhir
        $rekomendasiAkhir = $this->tentukanRekomendasi($nilaiAkhir);

        // Simpan ke model ProfilPencocokan
        $profilPencocokan = new ProfileMatching([
            'tanggal_penilaian' => now(),
            'id_karyawan' => $dataValidasi['id_karyawan'],
            'id_evaluasi' => $evaluasi->id,
            'periode' => $dataValidasi['periode'],
            'nilai_evaluasi' => $nilaiRataRataKonversi,
            'nilai_penugasan' => $nilaiPenugasan,
            'nilai_absensi' => $nilaiAbsensi,
            'nilai_peringatan' => $nilaiPeringatan,
            'nilai_akhir' => $nilaiAkhir,
            'rekomendasi' => $rekomendasiAkhir,
            'status_validasi' => 'Belum Tervalidasi' // Nilai tetap "Belum Tervalidasi"
        ]);
        $profilPencocokan->timestamps = false; // Menonaktifkan timestamps
        $profilPencocokan->save();
        

        // Alihkan ke halaman penilaian dengan pesan sukses
        return redirect('datapenilaian2')->with('success', 'Evaluasi berhasil disimpan dengan ID karyawan: ' . $dataValidasi['id_karyawan'] . ', rata-rata nilai aktual: ' . $nilaiRataRata . ', dan rekomendasi: ' . $rekomendasiAkhir);
    }

    private function hitungNilaiRataRata($data)
    {
        $totalNilaiAktual = 0.0;
        $jumlahAtribut = 8; // Jumlah atribut yang digunakan dalam perhitungan

        foreach (['kemampuan', 'tanggung_jawab', 'prestasi_kerja', 'kejujuran', 'disiplin', 'loyalitas', 'kerja_keras', 'rasa_memiliki'] as $atribut) {
            $totalNilaiAktual += (float)$data[$atribut]; // Menambahkan nilai aktual ke total
        }

        $nilaiRataRata = $totalNilaiAktual / $jumlahAtribut; // Menghitung rata-rata nilai aktual

        return [$nilaiRataRata]; // Mengembalikan rata-rata nilai aktual
    }


    private function tentukanRekomendasi($nilaiAkhir)
    {
        if ($nilaiAkhir >= 1.00 && $nilaiAkhir <= 1.55) {
            return 'Diturunkan ke dua grade sebelumnya';
        } elseif ($nilaiAkhir >= 1.56 && $nilaiAkhir <= 2.55) {
            return 'Diturunkan ke grade sebelumnya';
        } elseif ($nilaiAkhir >= 2.56 && $nilaiAkhir <= 3.55) {
            return 'Dipertahankan pada grade saat ini';
        } elseif ($nilaiAkhir >= 3.56 && $nilaiAkhir <= 4.55) {
            return 'Dinaikkan ke grade setelahnya';
        } elseif ($nilaiAkhir >= 4.56 && $nilaiAkhir <= 5.00) {
            return 'Dinaikkan ke dua grade setelahnya';
        } else {
            return 'Error: Nilai di luar rentang';
        }
    }

    // Fungsi konversi nilai penugasan sesuai tabel
    private function konversiPenugasan($jumlahPenugasan)
    {
        switch ($jumlahPenugasan) {
            case 4:
                return 5; // A
            case 3:
                return 4; // B
            case 2:
                return 3; // C
            case 1:
                return 2; // D
            case 0:
                return 1; // E
            default:
                return 0;
        }
    }

    // Fungsi konversi nilai absensi sesuai tabel
    private function konversiAbsensi($mangkir, $izin)
    {
        $total = $mangkir + $izin;
        if ($total == 0) {
            return 5;
        } elseif ($total == 1) {
            return 4;
        } elseif ($total >= 2 && $total <= 3) {
            return 3;
        } elseif ($total >= 3 && $total <= 5) {
            return 2;
        } else {
            return 1;
        }
    }

    // Fungsi konversi nilai peringatan sesuai tabel
    private function konversiPeringatan($spKe)
    {
        switch ($spKe) {
            case 0:
                return 5;
            case 1:
                return 4;
            case 2:
                return 3;
            case 3:
                return 2;
            default:
                return 1;
        }
    }

    // Fungsi konversi nilai rata-rata sesuai tabel
    private function konversiNilaiRataRata($nilaiRataRata)
    {
        switch (true) {
            case $nilaiRataRata >= 0 && $nilaiRataRata <= 1.55:
                return 1;
            case $nilaiRataRata >= 1.56 && $nilaiRataRata <= 2.55:
                return 2;
            case $nilaiRataRata >= 2.56 && $nilaiRataRata <= 3.55:
                return 3;
            case $nilaiRataRata >= 3.56 && $nilaiRataRata <= 4.55:
                return 4;
            case $nilaiRataRata >= 4.56 && $nilaiRataRata <= 5.00:
                return 5;
            default:
                return 0;
        }
    }
}
