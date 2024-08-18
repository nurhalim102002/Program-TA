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
        Schema::create('speringatans', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('id_karyawan');
            $table->tinyInteger('sp_ke');
            $table->string('masa_berlaku');
            $table->text('perihal');
            $table->timestamps();

            $table->string('periode')->nullable(); // Misalnya, '2024-01' untuk Januari 2024
            
            $table->foreign('id_karyawan')->references('id')->on('karyawans');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('speringatans');
    }
};
