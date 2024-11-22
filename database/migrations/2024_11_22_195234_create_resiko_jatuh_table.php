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
        Schema::create('resiko_jatuh', function (Blueprint $table) {
            $table->id();
            $table->bigInteger('pasien_id');
            $table->string('pertanyaan_satu')->default('Tidak');
            $table->string('pertanyaan_dua')->default('Tidak');
            $table->string('pertanyaan_tiga')->default('Tidak');
            $table->string('status_resiko')->nullable();
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('resiko_jatuh');
    }
};
