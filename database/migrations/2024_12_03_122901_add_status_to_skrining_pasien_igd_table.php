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
        Schema::table('skrining_pasien_igd', function (Blueprint $table) {
            $table->enum('status_skrining',['skrining_pasien','skrining_pasien_covid'])->default('skrining_pasien');
        });

        Schema::table('skrining_pasien_tb', function (Blueprint $table) {
            $table->enum('status_skrining',['skrining_pasien','skrining_pasien_covid'])->default('skrining_pasien');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('skrining_pasien_igd', function (Blueprint $table) {
            //
        });
    }
};
