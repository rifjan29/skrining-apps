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
        Schema::table('resiko_jatuh', function (Blueprint $table) {
            // $table->string('tindakan_satu')->nullable();
            // $table->string('tindakan_dua')->nullable();
            // $table->string('tindakan_tiga')->nullable();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('resiko_jatuh', function (Blueprint $table) {
            //
        });
    }
};
