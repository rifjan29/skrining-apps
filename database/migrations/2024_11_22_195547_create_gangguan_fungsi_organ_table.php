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
        Schema::create('gangguan_fungsi_organ', function (Blueprint $table) {
            $table->id();
            $table->bigInteger('pasien_id');
            $table->string('jenis_gangguan')->nullable();
            $table->boolean('status_gangguan')->default(false)->comment('true = butuh pendampingan');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('gangguan_fungsi_organ');
    }
};
