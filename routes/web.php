<?php

use App\Models\Karyawan;
use App\Models\User;

use App\Http\Controllers\HomeController;
use App\Http\Controllers\AdminController;
use App\Http\Controllers\KaryawanController;
use App\Http\Controllers\JabatanController;
use App\Http\Controllers\PenugasanController;
use App\Http\Controllers\AbsensiController;
use App\Http\Controllers\SPController;
use App\Http\Controllers\EvaluasiController;
use App\Http\Controllers\LoginController;
use App\Http\Controllers\PenilaianController;
use App\Http\Controllers\CetakController;
use App\Http\Controllers\ValidasiController;
use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider and all of them will
| be assigned to the "web" middleware group. Make something great!
|
*/


// LOGIN ===============================================================================
route::get('/login',[ LoginController::class,'tampilLogin' ])->name('login');
route::get('/register',[ LoginController::class,'tampilHalamanRegister' ]);

route::post('/post-login',[ LoginController::class,'postLogin' ])->name('post-login');
route::get('/logout',[ LoginController::class,'logout' ]);







Route::middleware(['auth', 'CekLevel:Admin'])->group(function () {
    
    Route::get('/', function () {
        $totalKaryawan = Karyawan::count();
        $totalAdmin = User::where('level', 'admin')->count();
        $totalPenilai = User::where('level', 'penilai')->count();
    return view('welcome', compact('totalKaryawan', 'totalAdmin', 'totalPenilai'));
    });

    route::get('/datapenilaian',[ HomeController::class,'DataPenilaian' ]);
    
    route::get('/datakaryawan',[ AdminController::class,'DataKaryawan' ]);
    route::get('/datajabatan',[ AdminController::class,'DataJabatan' ]);
    // route::get('/dataadmin',[ AdminController::class,'DataAdmin' ]);
    Route::get('/dataadmin', [AdminController::class, 'DataAdmin'])->name('dataadmin');

    // KARYAWAN ===========================================================================
    route::get('/tambahkaryawan',[ KaryawanController::class,'TambahKaryawan' ]);
    route::post('/simpankaryawan',[ KaryawanController::class,'SimpanKaryawan' ]);
    route::get('/editkaryawan/{id}',[ KaryawanController::class,'EditKaryawan' ]);
    route::post('/perubahankaryawan/{id}',[ KaryawanController::class,'PerubahanKaryawan' ]);
    route::get('/hapuskaryawan/{id}',[ KaryawanController::class,'HapusKaryawan' ]);

    // DATA ADMIN==================================================================================
    route::get('/tambahadmin',[ AdminController::class,'TambahAdmin' ]);
    route::post('/simpanadmin',[ AdminController::class,'SimpanAdmin' ]);
    route::get('/editadmin/{id}',[ AdminController::class,'EditAdmin' ]);
    route::post('/perubahanadmin/{id}',[ AdminController::class,'PerubahanAdmin' ]);
    route::get('/hapusadmin/{id}',[ AdminController::class,'HapusAdmin' ]);
    // Route::delete('/hapusadmin/{id}', 'AdminController@HapusAdmin')->name('hapusadmin');

    route::get('/datapenilai',[ AdminController::class,'DataPenilai' ]);
    route::get('/datapenugasan',[ HomeController::class,'DataPenugasan' ]);
    route::get('/dataabsensi',[ HomeController::class,'DataAbsensi' ]);
    route::get('/datasp',[ AdminController::class,'DataSP' ]);

    // JABATAN ============================================================================
    route::get('/tambahjabatan',[ JabatanController::class,'TambahJabatan' ]);
    route::post('/simpanjabatan',[ JabatanController::class,'SimpanJabatan' ]);
    route::get('/hapusjabatan/{id}',[ JabatanController::class,'HapusJabatan' ]);
    route::get('/editjabatan/{id}',[ JabatanController::class,'EditJabatan' ]);
    route::post('/perubahanjabatan/{id}',[ JabatanController::class,'PerubahanJabatan' ]);

    // PENUGASAN ===========================================================================
    route::get('/tambahpenugasan',[ PenugasanController::class,'TambahPenugasan' ]);
    route::post('/simpanpenugasan',[ PenugasanController::class,'SimpanPenugasan' ]);
    route::get('/editpenugasan/{id}',[ PenugasanController::class,'EditPenugasan' ]);
    route::post('/perubahanpenugasan/{id}',[ PenugasanController::class,'PerubahanPenugasan' ]);
    route::get('/hapuspenugasan/{id}',[ PenugasanController::class,'HapusPenugasan' ]);

    // ABSENSI ============================================================================
    route::get('/tambahabsensi',[ AbsensiController::class,'TambahAbsensi' ]);
    route::post('/simpanabsensi',[ AbsensiController::class,'SimpanAbsensi' ]);
    route::get('/editabsensi/{id}',[ AbsensiController::class,'EditAbsensi' ]);
    route::post('/perubahanabsensi/{id}',[ AbsensiController::class,'PerubahanAbsensi' ]);
    route::get('/hapusabsensi/{id}',[ AbsensiController::class,'HapusAbsensi' ]);

    // DATA SP ============================================================================
    route::get('/tambahsp',[ SPController::class,'TambahSP' ]);
    route::post('/simpansp',[ SPController::class,'SimpanSP' ]);
    route::get('/editsp/{id}',[ SPController::class,'EditSP' ]);
    route::post('/perubahansp/{id}',[ SPController::class,'PerubahanSP' ]);
    route::get('/hapussp/{id}',[ SPController::class,'HapusSP' ]);

    // CETAK DATA ============================================================================
    route::get('/cetakhasilindividu',[ CetakController::class,'HasilIndividu' ]);
    // route::get('/cetaknilaiindividu',[ CetakController::class,'NilaiIndividu' ]);

    Route::get('/cetakhasilindividu/{karyawanId}/{periode}', [CetakController::class, 'cetakHasilIndividu']);
    Route::get('/cetaknilaiindividu/{karyawanId}/{periode}', [CetakController::class, 'cetakNilaiIndividu']);
    route::get('/cetakranking',[ CetakController::class,'cetakPerangkingan' ]);

    // Di web.php
    Route::get('/karyawan/data/{id}', [KaryawanController::class, 'getKaryawanData']);
    // Route::get('/karyawan/ranking/{id}', [KaryawanController::class, 'getKaryawanRanking']);
    Route::get('/getKaryawanRanking', [KaryawanController::class, 'getKaryawanRanking']);

    Route::get('/detail/{id}', 'DetailController@show')->name('detail.show');

});

Route::middleware(['auth', 'CekLevel:Penilai'])->group(function () {
    
    Route::get('/homepenilai', [HomeController::class, 'HomePenilai']);
    route::get('/datapenilaian2',[ PenilaianController::class,'DataPenilaian2' ]);

    route::get('/formpenilaian',[ HomeController::class,'FormPenilaian' ]);
    route::post('/simpannilai',[ EvaluasiController::class,'SimpanNilai' ]);

    route::post('/validasihasil/{id}',[ ValidasiController::class,'ValidasiHasil' ]);
    route::post('/batalkanvalidasihasil/{id}',[ ValidasiController::class,'BatalValidasiHasil' ]);
    route::get('/hasilalgoritma2',[ HomeController::class,'HasilAlgoritma2']);
    // Route::get('/hasilalgoritma2', [HomeController::class,'HasilAlgoritma2'])->middleware('cekJabatan:Manager');

});

Route::middleware(['auth', 'CekLevel:Admin,Penilai'])->group(function () {

    route::get('/hasilalgoritma',[ HomeController::class,'HasilAlgoritma' ]);
    
    // Di web.php
    Route::get('/karyawan/data/{id}', [KaryawanController::class, 'getKaryawanData']);
    // Route::get('/karyawan/data/{id}', [KaryawanController::class, 'getKaryawanData']);

    Route::get('/karyawan/detail/{id}/{periode}', [KaryawanController::class, 'getKaryawanData'])->name('karyawan.getKaryawanData');

    // Route::get('/karyawan/ranking/{id}', [KaryawanController::class, 'getKaryawanRanking']);
    Route::get('/getKaryawanRanking', [KaryawanController::class, 'getKaryawanRanking']);

    Route::get('/detail/{id}', 'DetailController@show')->name('detail.show');


    Route::get('/karyawan/data/{id}', [KaryawanController::class, 'getData']);

});
