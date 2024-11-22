<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class FastTrack extends Model
{
    protected $table = 'fast_track';
    protected $fillable = [
        'pasien_id',
        'jenis_fast',
        'kategori_fast',
        'status_fast',
        'rujukan',
    ];
}
