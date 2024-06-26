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
        Schema::create('spknota', function (Blueprint $table) {
            $table->id();
            $table->string('spk_id')->unique()->nullable();
            $table->string('nama_bahan');
            $table->string('tebal_bahan');
            $table->string('ukuran');
            $table->integer('jumlah_cetak');
            $table->string('ukuran_jadi');
            $table->integer('rangkap');
            $table->string('warna_rangkap');
            $table->string('cetak');
            $table->string('warna');
            $table->string('finishing');
            $table->integer('numerator');
            $table->string('keterangan');
            $table->timestamps();

            $table->foreign('spk_id')->references('spk_id')->on('spk')->onDelete('cascade');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('spknota');
    }
};
