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
        Schema::create('bahasa', function (Blueprint $table) {
            $table->id();
            $table->bigInteger('pasien_id');
            $table->string('jenis_bahasa');
            $table->boolean('status_bahasa')->default(false)->comment('false = dibantu penerjemah');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('bahasa');
    }
};
