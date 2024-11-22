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
        Schema::create('privasi_tertentu', function (Blueprint $table) {
            $table->id();
            $table->bigInteger('pasien_id');
            $table->string('jenis_privasi')->nullable();
            $table->boolean('status_privasi')->default(false)->comment('true = pelayanan didahulukan');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('privasi_tertentu');
    }
};
