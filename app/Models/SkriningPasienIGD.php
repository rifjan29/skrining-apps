<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class SkriningPasienIGD extends Model
{
    protected $table = 'skrining_pasien_igd';
    protected $fillable = [
        'pasien_id',
        'tanggal',
        'jam',
        'primary_survey_a',
        'primary_survey_b',
        'primary_survey_c',
        'primary_survey_d',
        'primary_survey_e',
        'secondary_survey',
        'td',
        'nadi',
        'frekuensi_pernapasan',
        'suhu',
        'saturasi_oksigen',
        'riwayat_penyakit',
        'klasifikasi_pasien',
        'triage',
        'pemeriksaan_penunjang',
        'tindak_lanjut',
    ];
}
