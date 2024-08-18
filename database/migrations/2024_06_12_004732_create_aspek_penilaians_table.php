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
        Schema::create('aspek_penilaians', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('id_karyawan'); // Foreign key untuk tabel karyawan
            $table->unsignedBigInteger('id_penugasan'); // Foreign key untuk tabel penugasan
            $table->unsignedBigInteger('id_absensi'); // Foreign key untuk tabel absensi
            $table->unsignedBigInteger('id_speringatan'); // Foreign key untuk tabel speringatan
            $table->unsignedBigInteger('id_evaluasi'); // Foreign key untuk tabel evaluasi

            // Definisi foreign key constraints
            $table->foreign('id_karyawan')->references('id')->on('karyawans')->onDelete('cascade');
            $table->foreign('id_penugasan')->references('id')->on('penugasans')->onDelete('cascade');
            $table->foreign('id_absensi')->references('id')->on('absensis')->onDelete('cascade');
            $table->foreign('id_speringatan')->references('id')->on('speringatans')->onDelete('cascade');
            $table->foreign('id_evaluasi')->references('id')->on('evaluasis')->onDelete('cascade');

            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('aspek_penilaians');
    }
};
