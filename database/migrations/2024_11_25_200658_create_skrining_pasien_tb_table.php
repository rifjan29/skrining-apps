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
        Schema::create('skrining_pasien_tb', function (Blueprint $table) {
            $table->id();
            $table->bigInteger('pasien_id');
            $table->date('tanggal_kedatangan');
            $table->date('tanggal_periksa');
            $table->time('jam_datang');
            $table->time('jam_periksa');
            $table->string('pertanyaan_satu')->nullable();
            $table->string('pertanyaan_dua')->nullable();
            $table->string('pertanyaan_tiga')->nullable();
            $table->string('pertanyaan_empat')->nullable();
            $table->string('pertanyaan_lima')->nullable();
            $table->string('pertanyaan_enam')->nullable();
            $table->string('pertanyaan_tujuh')->nullable();
            $table->string('pertanyaan_delapan')->nullable();
            $table->string('pertanyaan_sembilan')->nullable();
            $table->string('pertanyaan_sepuluh')->nullable();
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('skrining_pasien_tb');
    }
};
