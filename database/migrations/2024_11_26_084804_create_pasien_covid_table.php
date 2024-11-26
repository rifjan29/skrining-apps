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
        Schema::create('pasien_covid', function (Blueprint $table) {
            $table->id();
            $table->string('no_rm');
            $table->string('nama_lengkap');
            $table->date('tanggal_lahir');
            $table->string('pekerjaan');
            $table->text('alamat');
            $table->string('komorbid');
            $table->enum('jenis_pasien',['baru','lama']);
            $table->enum('penjamin_biaya',['umum','bpjs','spm','jasa raharja','lainnya']);
            $table->string('lainnya_penjamin')->nullable();
            $table->enum('tujuan',['igd','airbone','poli klinik']);
            $table->string('poli_tujuan')->nullable();
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('pasien_covid');
    }
};
