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
        Schema::create('spk', function (Blueprint $table) {
            $table->id();
            $table->string('spk_id')->unique();
            $table->unsignedBigInteger('order_id');
            $table->string('user_id');
            $table->foreign('user_id')->references('user_id')->on('users');
            $table->foreign('order_id')->references('order_id')->on('orders');
            $table->string('status', 32)->notnull();
            $table->date('tanggal')->notnull();
            $table->date('deadline_produksi');
            $table->string('lokasi_produksi');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('spk1');
    }
};
