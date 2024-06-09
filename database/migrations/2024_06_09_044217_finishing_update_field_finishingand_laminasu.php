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
        Schema::table('finishing', function (Blueprint $table) {
            $table->json('finishing');
            $table->json('laminasi');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        // Schema::table('finishing', function (Blueprint $table) {
        //     $table->dropColumn('finishing');
        //     $table->dropColumn('laminasi');
        // });
    }
};
