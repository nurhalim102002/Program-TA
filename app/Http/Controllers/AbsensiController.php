<?php

namespace App\Http\Controllers;

use App\Models\Absensi;
use App\Models\Karyawan;
use Illuminate\Http\Request;

class AbsensiController extends Controller
{
    public function TambahAbsensi(){
        //$jumlahUser=User::count();
        //$jumlahLaporan=Laporan::count();
        $abs = Absensi::with('karyawan')->get();
        $kry = Karyawan::all();
        return view('halaman.tambahabsensi', compact('abs', 'kry'));
    }

    public function SimpanAbsensi(Request $request){

        Absensi::create([
            'id_karyawan'=>$request->id_karyawan,
            'mangkir'=>$request->mangkir,
            'izin_p1'=>$request->izin_p1,
        ]);
        return redirect('dataabsensi');

    }

    public function EditAbsensi($id) {
        // Mengambil data penugasan berdasarkan id yang diberikan
        $abs = Absensi::with('karyawan')->findOrFail($id);
    
        // Mengambil semua data karyawan untuk dropdown
        $kry = Karyawan::all();
    
        // Mengambil id karyawan dari penugasan yang saat ini
        $selectedId = $abs->id_karyawan;
    
        return view('halaman.editabsensi', compact('abs', 'kry', 'selectedId'));
    }
    
    public function PerubahanAbsensi(Request $request, $id)
    {
        if ($request->id) {
            $abs = Absensi::findOrFail($id);

            $dt = [
                'id_karyawan'=>$request->id_karyawan,
                'mangkir'=>$request->mangkir,
                'izin_p1'=>$request->izin_p1,
            ];
            $abs->update($dt);
            return redirect('dataabsensi');
        }else{
            return back();
        }
    }

    public function HapusAbsensi($id){
        $abs = Absensi::findOrFail($id);
        $abs->delete($abs);
        return redirect('dataabsensi');
    }
}
