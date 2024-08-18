<?php

namespace App\Http\Controllers;

use App\Models\Jabatan;
use App\Models\Karyawan;
use App\Models\Penugasan;
use App\Models\Absensi;
use App\Models\SPeringatan;
use App\Models\Evaluasi;
use App\Models\ProfileMatching;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;

class AdminController extends Controller
{
    


    public function DataKaryawan(){
        //$jumlahUser=User::count();
        $kry = Karyawan::with('jabatan')->get();
        $jbt = Jabatan::all();
        return view('halaman.datakaryawan', compact('kry', 'jbt'));
    }

    public function DataJabatan(){
        //$jumlahUser=User::count();
        //$jumlahLaporan=Laporan::count();
        $jbt = Jabatan::all();
        return view('halaman.datajabatan', compact('jbt'));
    }

    // C R U D ADMIN ==========================================================
    public function DataAdmin(){
        // Mengambil data user terbaru beserta karyawan dan jabatan mereka
        $adm = User::with(['karyawan.jabatan'])->get();
        $kry = Karyawan::with('jabatan')->get();
        $jbt = Jabatan::all();
        return view('halaman.dataadmin', compact('adm', 'kry', 'jbt'));
    }

    public function TambahAdmin(){
        // Mengambil data user terbaru beserta karyawan dan jabatan mereka
        $adm = User::with(['karyawan.jabatan'])->get();
        $kry = Karyawan::with('jabatan')->get();
        return view('halaman.tambahadmin', compact('adm', 'kry'));
    }

    public function SimpanAdmin(Request $request)
    {
        // Membuat instance baru User dengan data dari request
        $user = new User([
            'id_karyawan' => $request->id_karyawan,
            'id_jabatan' => $request->id_jabatan,
            'level' => $request->level,
            'email' => $request->email,
            'password' => $request->password,
        ]);

        // Menonaktifkan timestamps
        $user->timestamps = false;

        // Menyimpan data ke database
        $user->save();

        // Redirect ke halaman data admin
        return redirect('dataadmin');
    }

    public function EditAdmin($id)
    {
        $adm = User::with('karyawan.jabatan')->findOrFail($id);
        $kry = Karyawan::all();
        return view('halaman.editadmin', compact('adm', 'kry'));
    }

    public function PerubahanAdmin(Request $request, $id)
    {
        if ($request->id) {
            $adm = User::findOrFail($id);

            $dt = [
                'id_karyawan'=>$request->id_karyawan,
                'id_jabatan'=>$request->id_jabatan,
                'level'=>$request->level,
                'email'=>$request->email,
                'password'=>$request->password,
            ];
            $adm->timestamps = false;
            $adm->update($dt);
            return redirect('dataadmin');
        }else{
            return back();
        }
    }

 

    // ========================================================================


    public function DataPenilai(){
        //$jumlahUser=User::count();
        //$jumlahLaporan=Laporan::count();
        return view('halaman.datapenilai');
    }

    public function HapusAdmin($id)
    {
        try {
            $adm = User::findOrFail($id);
            $adm->delete();

            return redirect()->route('dataadmin')->with('success', 'Data berhasil dihapus.');
        } catch (\Exception $e) {
            return redirect()->route('dataadmin')->with('error', 'Terjadi kesalahan saat menghapus data.');
        }
    }

    
    public function DataPenugasan(){
        //$jumlahUser=User::count();
        //$jumlahLaporan=Laporan::count();
        $pen = Penugasan::all();
        return view('halaman.datapenugasan', compact('pen'));
    }

    public function DataAbsensi(){
        //$jumlahUser=User::count();
        //$jumlahLaporan=Laporan::count();
        $abs = Absensi::with('karyawan')->get();
        $kry = Karyawan::all();
        return view('halaman.dataabsensi', compact('abs', 'kry'));
    }

    public function DataSP(){
        //$jumlahUser=User::count();
        //$jumlahLaporan=Laporan::count();
        $sp = SPeringatan::all();
        return view('halaman.datasp', compact('sp'));
    }
}
