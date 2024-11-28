<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class SkriningLanjutan extends Model
{
    protected $table = 'skrining_lanjutan';
    protected $fillable = [
        'pasien_id',
        'pilihan',
        'skor',
    ];
}
