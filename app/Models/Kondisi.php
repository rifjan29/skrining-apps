<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Kondisi extends Model
{
    protected $table = 'kondisi';
    protected $fillable = [
        'pasien_id',
        'jenis',
        'perilaku',
    ];
}
