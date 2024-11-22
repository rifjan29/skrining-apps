<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class SkriningPasien extends Model
{
    protected $table = 'skrining_pasien';
    protected $fillable = [
        'kode_skrining',
        'pasien_id',
        'user_id',
        'tanggal_skrining',
        'status_skrining',
        'ttd',
    ];
}
