<?php

namespace App\Http\Controllers;

use App\Models\Penugasan;
use App\Models\Karyawan;
use Illuminate\Http\Request;

class PenugasanController extends Controller
{
    public function TambahPenugasan(){
        //$jumlahUser=User::count();
        //$jumlahLaporan=Laporan::count();
        $pen = Penugasan::with('karyawan')->get();
        $kry = Karyawan::all();
        return view('halaman.tambahpenugasan', compact('pen', 'kry'));
    }

    public function SimpanPenugasan(Request $request){

        Penugasan::create([
            'id_karyawan'=>$request->id_karyawan,
            'periode_penugasan'=>$request->periode_penugasan,
            'lokasi'=>$request->lokasi,
        ]);
        return redirect('datapenugasan');

    }

    public function EditPenugasan($id) {
        // Mengambil data penugasan berdasarkan id yang diberikan
        $pen = Penugasan::with('karyawan')->findOrFail($id);
    
        // Mengambil semua data karyawan untuk dropdown
        $kry = Karyawan::all();
    
        // Mengambil id karyawan dari penugasan yang saat ini
        $selectedId = $pen->id_karyawan;
    
        return view('halaman.editpenugasan', compact('pen', 'kry', 'selectedId'));
    }
    
    public function PerubahanPenugasan(Request $request, $id)
    {
        if ($request->id) {
            $pen = Penugasan::findOrFail($id);

            $dt = [
                'id_karyawan'=>$request->id_karyawan,
                'periode_penugasan'=>$request->periode_penugasan,
                'lokasi'=>$request->lokasi,
            ];
            $pen->update($dt);
            return redirect('datapenugasan');
        }else{
            return back();
        }
    }

    public function HapusPenugasan($id){
        $pen = Penugasan::findOrFail($id);
        $pen->delete($pen);
        return redirect('datapenugasan');
    }
}
