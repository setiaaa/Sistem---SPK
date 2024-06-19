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
        Schema::table('produksi', function (Blueprint $table) {
            $table->string('id_mesin')->default('MSN-001');
            $table->foreign('id_mesin')->references('id_mesin')->on('mesin');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        // Schema::table('produksi', function (Blueprint $table) {
        //     $table->dropColumn('nama_mesin');
            // $table->dropForeign('id_mesin');
            // $table->dropColumn('id_mesin');

        // });
    }
};
