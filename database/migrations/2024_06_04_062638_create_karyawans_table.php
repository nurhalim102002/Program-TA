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
        Schema::create('karyawans', function (Blueprint $table) {
            $table->id();
            $table->string('nik', 20);
            $table->string('nama', 100);
            $table->string('ttl', 100);  // 'ttl' bisa dipecah menjadi dua kolom: tempat_lahir dan tanggal_lahir jika perlu lebih spesifik
            $table->unsignedBigInteger('id_jabatan');
            $table->string('tgl_masuk', 50);  // Pertimbangkan menggunakan tipe data 'date' untuk tanggal
            $table->string('lama_bekerja');  // Perlu diklarifikasi apakah ini akan diupdate secara otomatis atau manual
            $table->string('jenis_kelamin', 10);
            $table->string('pendidikan_terakhir', 50);
            $table->timestamps();

            // Menambahkan foreign key
            $table->foreign('id_jabatan')->references('id')->on('jabatans')->onDelete('cascade');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('karyawans', function (Blueprint $table) {
            $table->dropForeign(['id_jabatan']);  // Pastikan ini sesuai dengan penamaan foreign key
        });

        Schema::dropIfExists('karyawans');
    }
};
