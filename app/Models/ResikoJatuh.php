<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class ResikoJatuh extends Model
{
    protected $table = 'resiko_jatuh';
    protected $fillable = [
        'pasien_id',
        'pertanyaan_satu',
        'pertanyaan_dua',
        'pertanyaan_tiga',
        'status_resiko',
        'tindakan_satu',
        'tindakan_dua',
        'tindakan_tiga',
    ];
}
