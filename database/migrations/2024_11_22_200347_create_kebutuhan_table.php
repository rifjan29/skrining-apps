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
        Schema::create('kebutuhan', function (Blueprint $table) {
            $table->id();
            $table->bigInteger('pasien_id');
            $table->string('status_kebutuhan');
            $table->string('jenis_kebutuhan');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('kebutuhan');
    }
};
