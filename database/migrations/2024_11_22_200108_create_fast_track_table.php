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
        Schema::create('fast_track', function (Blueprint $table) {
            $table->id();
            $table->bigInteger('pasien_id');
            $table->boolean('jenis_fast')->default(false);
            $table->string('kategori_fast');
            $table->enum('status_fast',['diterima','tidak dianjurkan','dirujuk']);
            $table->string('rujukan');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('fast_track');
    }
};
