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
        Schema::create('mesin', function (Blueprint $table) {
            $table->id();
            $table->string('id_mesin')->unique();
            $table->string('user_id');
            $table->foreign('user_id')->references('user_id')->on('users');
            $table->string('nama_mesin');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('mesin');
    }
};
