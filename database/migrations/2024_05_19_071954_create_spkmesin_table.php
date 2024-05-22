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
        Schema::create('spkmesin', function (Blueprint $table) {
            $table->id();
            $table->string('spk_id')->unique()->nullable();
            // $table->unsignedBigInteger('order_id');
            // $table->integer('mesin_id');
            // $table->string('nama_order');
            $table->date('deadline_produksi');
            $table->string('lokasi_produksi');
            $table->string('kirim');
            $table->string('ekspedisi');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('spkmesin');
    }
};
