<?php

namespace App\Http\Controllers;

use App\Models\Jabatan;
use Illuminate\Http\Request;

class JabatanController extends Controller
{
    public function TambahJabatan(){
        //$jumlahUser=User::count();
        //$jumlahLaporan=Laporan::count();
        return view('halaman.tambahjabatan');
    }

    public function SimpanJabatan(Request $request){

        Jabatan::create([
            'jabatan'=>$request->jabatan,
        ]);
        return redirect('datajabatan');

    }

    public function EditJabatan($id){

        $jbt = Jabatan::findOrFail($id);
        return view('halaman.editjabatan', compact('jbt'));
    }

    public function PerubahanJabatan(Request $request, $id)
    {
        if ($request->id) {
            $jbt = Jabatan::findOrFail($id);

            $dt = [
                'jabatan'=>$request->jabatan,
            ];
            $jbt->update($dt);
            return redirect('datajabatan');
        }else{
            return back();
        }
    }

    public function HapusJabatan($id){
        $jbt = Jabatan::findOrFail($id);
        $jbt->delete($jbt);
        return redirect('datajabatan');
    }
}
