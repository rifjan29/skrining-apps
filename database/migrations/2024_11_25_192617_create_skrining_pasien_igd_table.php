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
        Schema::create('skrining_pasien_igd', function (Blueprint $table) {
            $table->id();
            $table->bigInteger('pasien_id');
            $table->date('tanggal')->nullable(); // Tanggal
            $table->time('jam')->nullable(); // Jam
            $table->text('primary_survey_a')->nullable(); // Primary Survey A (Airway)
            $table->text('primary_survey_b')->nullable(); // Primary Survey B (Breathing)
            $table->text('primary_survey_c')->nullable(); // Primary Survey C (Circulation)
            $table->text('primary_survey_d')->nullable(); // Primary Survey D (Disability)
            $table->text('primary_survey_e')->nullable(); // Primary Survey E (Exposure)
            $table->text('secondary_survey')->nullable(); // Secondary Survey
            $table->string('td')->nullable(); // Tekanan Darah
            $table->integer('nadi')->nullable(); // Nadi (/menit)
            $table->integer('frekuensi_pernapasan')->nullable(); // Frekuensi Pernapasan (/menit)
            $table->decimal('suhu', 5, 2)->nullable(); // Suhu (derajat celcius)
            $table->integer('saturasi_oksigen')->nullable(); // Saturasi Oksigen
            $table->text('riwayat_penyakit')->nullable(); // Riwayat Penyakit / Pengobatan Sebelumnya
            $table->enum('klasifikasi_pasien', ['IGD', 'Poliklinik'])->nullable(); // Klasifikasi Pasien
            $table->enum('triage', ['ATS 1', 'ATS 2', 'ATS 3', 'ATS 4', 'ATS 5'])->nullable(); // Triage
            $table->json('pemeriksaan_penunjang')->nullable(); // Pemeriksaan Penunjang (EKG, Laboratorium, Radiologi)
            $table->json('tindak_lanjut')->nullable(); // Tindak Lanjut (Rawat, Konsultasi, dsb.)
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('skrining_pasien_igd');
    }
};
