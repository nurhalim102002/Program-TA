<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateProfileMatchingsTable extends Migration
{
    public function up()
    {
        Schema::create('profile_matchings', function (Blueprint $table) {
            $table->id();
            $table->date('tanggal_penilaian');
            $table->unsignedBigInteger('id_karyawan');
            $table->unsignedBigInteger('id_evaluasi');
            $table->float('nilai_penugasan', 8, 2);
            $table->float('nilai_absensi', 8, 2);
            $table->float('nilai_peringatan', 8, 2);
            $table->float('nilai_evaluasi', 8, 2);
            $table->float('nilai_akhir', 8, 2);
            $table->string('rekomendasi', 225);
            $table->string('status_validasi', 50);
            $table->timestamps();

            // Tambahkan kolom periode
            $table->string('periode')->nullable(); // Misalnya, '2024-01' untuk Januari 2024

            // Menambahkan foreign key
            $table->foreign('id_karyawan')->references('id')->on('karyawans')->onDelete('cascade');
            $table->foreign('id_evaluasi')->references('id')->on('evaluasis')->onDelete('cascade');
        });
    }

    public function down()
    {
        Schema::dropIfExists('profile_matchings');
    }
}
