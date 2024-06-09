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
        Schema::create('bahan', function (Blueprint $table) {
            $table->id();
            $table->string('spk_id')->unique()->nullable();
            $table->string('nama_bahan');
            $table->string('ukuran_plano');
            $table->string('jumlah_bahan');
            $table->string('ukuran_potong');
            $table->string('satu_plano');
            $table->timestamps();

            $table->foreign('spk_id')->references('spk_id')->on('spkmesin')->onDelete('cascade');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('bahan');
    }
};
