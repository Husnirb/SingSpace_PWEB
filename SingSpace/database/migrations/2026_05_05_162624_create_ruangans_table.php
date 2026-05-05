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
        Schema::create('ruangans', function (Blueprint $table) {
            $table->id();
            $table->string('kode_ruangan')->unique(); // Pengganti NIM
            $table->string('nama');                   // Nama Ruangan
            $table->text('deskripsi');                // Pengganti Email
            $table->enum('tipe', ['Regular', 'Family', 'VIP', 'VVIP']); // Pengganti Jurusan
            $table->decimal('harga', 10, 2);          // Pengganti IPK
            $table->integer('kapasitas');             // Pengganti Semester
            $table->boolean('is_aktif')->default(true); // Pengganti Status Aktif
            $table->string('foto')->nullable();       // Foto Ruangan
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('ruangans');
    }
};
