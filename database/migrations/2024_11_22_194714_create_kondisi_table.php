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
        Schema::create('kondisi', function (Blueprint $table) {
            $table->id();
            $table->bigInteger('pasien_id');
            $table->string('jenis');
            $table->string('perilaku');
            $table->enum('status_kondisi',[
                "Antrian Dipercepat",
                "Pelayanan Didahulukan",
                "Diarahkan ke IGD",
                "Poli TB / Airborne IGD"
            ])->default(null);

            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('kondisi');
    }
};
