<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     */
    public function up(): void
{
    Schema::create('evaluasis', function (Blueprint $table) {
        $table->id();
        $table->unsignedBigInteger('id_karyawan');
        $table->date('tanggal_penilaian');
        $table->integer('kemampuan');
        $table->integer('tanggung_jawab');
        $table->integer('prestasi_kerja');
        $table->integer('kejujuran');
        $table->integer('disiplin');
        $table->integer('loyalitas');
        $table->integer('kerja_keras');
        $table->integer('rasa_memiliki');
        $table->integer('total_nilai');
        $table->string('rekomendasi', 255);
        $table->timestamps();
        
        // Jika ada relasi dengan tabel karyawan, bisa tambahkan foreign key
        // $table->foreign('id_karyawan')->references('id')->on('karyawans')->onDelete('cascade');
    });
}


    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('evaluasis');
    }
};
