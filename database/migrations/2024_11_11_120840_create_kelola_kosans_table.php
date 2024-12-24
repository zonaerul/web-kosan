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
        Schema::create('kosan', function (Blueprint $table) {
            $table->id();
            $table->string('nama_kosan');
            $table->string('upload_file');  // Pastikan validasi file upload dilakukan di controller atau di Filament
            $table->string('lokasi');
            $table->string('nomer_whatsapp');  // Gunakan string untuk nomor telepon
            $table->integer('harga')->default(0);
            $table->enum('category', ['cewe', 'cowo', 'campur']);
            $table->enum('kamar', [1, 2, 3, 4])->default(1);
            $table->string('fasilitas');
            $table->string('deskripsi');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('kosan');
    }
};
