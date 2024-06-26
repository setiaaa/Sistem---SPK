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
        Schema::create('produksi', function (Blueprint $table) {
            $table->id();
            $table->string('spk_id')->unique()->nullable();
            $table->string('id_mesin')->default('none');
            $table->foreign('id_mesin')->references('id_mesin')->on('mesin');
            $table->json('cetak');
            $table->string('ukuran_bahan');
            $table->string('set');
            $table->string('keterangan');
            $table->integer('jumlah_cetak');
            $table->integer('hasil_cetak');
            $table->string('tempat_cetak');
            $table->string('acuan_cetak');
            $table->integer('jumlah_order');
            $table->timestamps();

            $table->foreign('spk_id')->references('spk_id')->on('spkmesin')->onDelete('cascade');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('produk');
    }
};
