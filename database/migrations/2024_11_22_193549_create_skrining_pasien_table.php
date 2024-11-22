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
        Schema::create('skrining_pasien', function (Blueprint $table) {
            $table->id();
            $table->string('kode_skrining');
            $table->bigInteger('pasien_id');
            $table->bigInteger('user_id');
            $table->date('tanggal_skrining');
            $table->enum('status_skrining',['pending','pending_igd','pending_tb','selesai','batal'])->default('pending');
            $table->string('ttd')->nullable();
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('skrining_pasien');
    }
};
