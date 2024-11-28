<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class SkriningAwal extends Model
{
    protected $table = 'skrining_awal';
    protected $fillable = [
        'pasien_id',
        'pilihan',
        'skor'
    ];
}
