<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class SkriningPasienTB extends Model
{
    protected $table = 'skrining_pasien_tb';
    protected $fillable = [
        'pasien_id',
        'tanggal_kedatangan',
        'tanggal_periksa',
        'jam_datang',
        'jam_periksa',
        'pertanyaan_satu',
        'pertanyaan_dua',
        'pertanyaan_tiga',
        'pertanyaan_empat',
        'pertanyaan_lima',
        'pertanyaan_enam',
        'pertanyaan_tujuh',
        'pertanyaan_delapan',
        'pertanyaan_sembilan',
        'pertanyaan_sepuluh',
    ];
}
