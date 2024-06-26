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
        Schema::create('finishing', function (Blueprint $table) {
            $table->id();
            $table->string('spk_id')->unique()->nullable();
            $table->json('finishing');
            $table->json('laminasi');
            $table->string('potong_jadi');
            $table->string('keterangan');
            $table->timestamps();

            $table->foreign('spk_id')->references('spk_id')->on('spkmesin')->onDelete('cascade');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('finishing');
    }
};
