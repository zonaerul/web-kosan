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
        //transaksi
        Schema::create('transaksi', function (Blueprint $table) {
            $table->id();
            $table->integer("id_kosan");
            $table->string('code');
            $table->string('email');
            $table->string('nama');
            $table->string('bank');
            $table->string('total');
            $table->string('tanggal');
            $table->foreignId('user_id')->constrained('users')->onDelete('cascade');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('transaksi');
    }
};
