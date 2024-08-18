<?php

namespace App\Http\Controllers;
use Illuminate\Support\Facades\DB;
use App\Models\Speringatan;
use App\Models\Karyawan;
use Illuminate\Http\Request;

class SPController extends Controller
{
    public function TambahSP(){
        //$jumlahUser=User::count();
        //$jumlahLaporan=Laporan::count();
        $sp = Speringatan::with('karyawan')->get();
        $kry = Karyawan::all();
        return view('halaman.tambahsp', compact('sp', 'kry'));
    }

    public function SimpanSP(Request $request){

            Speringatan::create([
                'id_karyawan'=>$request->id_karyawan,
                'sp_ke'=>$request->sp_ke,
                'masa_berlaku'=>$request->masa_berlaku,
                'perihal'=>$request->perihal,
            ]);
            return redirect('datasp');

        }

    // public function SimpanSP2(Request $request) 
    //     {
    //         $request->validate([
    //             'lampiran' => 'required|file|mimes:pdf,doc,jpg,png,jpeg,docx|max:2048',
    //         ]);

    //         // Mulai transaksi
    //         DB::beginTransaction();

    //         try {
    //             $lmp = $request->file('lampiran');
    //             $nmfile = time().rand(100,999).'.'.$lmp->getClientOriginalName();
    //             $lmp->move(public_path().'/file-sp', $nmfile);

    //             // Simpan data ke tabel 'laporan'
    //             Speringatan::create([
    //                 'id_karyawan' => $request->id_karyawan,
    //                 'sp_ke' => $request->sp_ke,
    //                 'masa_berlaku' => $request->masa_berlaku,
    //                 'perihal' => $request->perihal,
    //                 'lampiran' => $nmfile,
    //                 'periode' => $request->periode,
    //             ]);

    //             // Commit transaksi jika berhasil
    //             DB::commit();
                
    //             return redirect('datasp');
    //         } catch (\Exception $e) {
    //             // Rollback transaksi jika ada kesalahan
    //             DB::rollBack();

    //             // Log error
    //             Log::error('Terjadi kesalahan: ' . $e->getMessage());

    //             // Handle kesalahan atau tampilkan pesan kesalahan
    //             return back()->with('error', 'Terjadi kesalahan saat menyimpan data.');
    //         }
    //     }


    public function EditSP($id) {
        // Mengambil data penugasan berdasarkan id yang diberikan
        $sp = Speringatan::with('karyawan')->findOrFail($id);
    
        // Mengambil semua data karyawan untuk dropdown
        $kry = Karyawan::all();
    
        // Mengambil id karyawan dari penugasan yang saat ini
        $selectedId = $sp->id_karyawan;
    
        return view('halaman.editsp', compact('sp', 'kry', 'selectedId'));
    }
    
    public function PerubahanSP(Request $request, $id)
    {
        if ($request->id) {
            $sp = Speringatan::findOrFail($id);

            $dt = [
                'id_karyawan'=>$request->id_karyawan,
                'sp_ke'=>$request->sp_ke,
                'masa_berlaku'=>$request->masa_berlaku,
                'perihal'=>$request->perihal,
            ];
            $sp->update($dt);
            return redirect('datasp');
        }else{
            return back();
        }
    }

    public function HapusSP($id){
        $sp = Speringatan::findOrFail($id);
        $sp->delete($sp);
        return redirect('datasp');
    }
}
