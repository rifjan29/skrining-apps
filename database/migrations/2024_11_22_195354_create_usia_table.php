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
        Schema::create('usia', function (Blueprint $table) {
            $table->id();
            $table->bigInteger('pasien_id');
            $table->string('jenis_usia')->default('lansia');
            $table->boolean('status_usia')->default(false)->comment('true = antrian dipercepat');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('usia');
    }
};
