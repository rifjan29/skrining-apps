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
        Schema::table('pasien_covid', function (Blueprint $table) {
            $table->string('keterangan')->nullable();
            $table->string('keterangan_lanjutan')->nullable();
            $table->bigInteger('total_skor_awal')->default(0);
            $table->bigInteger('total_skor_lanjutan')->default(0);
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('pasien_covid', function (Blueprint $table) {
            //
        });
    }
};
