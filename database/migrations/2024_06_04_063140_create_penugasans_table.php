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
    Schema::create('penugasans', function (Blueprint $table) {
        $table->id();
        $table->unsignedBigInteger('id_karyawan');
        $table->string('periode', 20);
        $table->string('lokasi', 100);
        $table->timestamps();

        $table->string('periode')->nullable(); // Misalnya, '2024-01' untuk Januari 2024

        // Jika ada relasi dengan tabel karyawan, bisa tambahkan foreign key
        $table->foreign('id_karyawan')->references('id')->on('karyawans')->onDelete('cascade');
    });
}


    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('penugasans');
    }
};
