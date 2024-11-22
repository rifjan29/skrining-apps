<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Pasien extends Model
{
    protected $table = 'pasien';
    protected $fillable = [
        'no_rm',
        'nama_lengkap',
        'tanggal_lahir',
        'alamat',
    ];
}
