<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class PrivasiTertentu extends Model
{
    protected $table = 'privasi_tertentu';
    protected $fillable = [
        'pasien_id',
        'jenis_privasi',
        'status_privasi',
    ];
}
