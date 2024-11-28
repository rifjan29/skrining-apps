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
        Schema::table('pasien_covid', function (Blueprint $table) {
            $table->string('tempat_lahir')->nullable();
            $table->enum('jenis_kelamin',['0','1'])->nullable();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('pasien_covid', function (Blueprint $table) {
            //
        });
    }
};
