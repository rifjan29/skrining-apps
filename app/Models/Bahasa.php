<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Bahasa extends Model
{
    protected $table = 'bahasa';
    protected $fillable = [
        'pasien_id',
        'jenis_bahasa',
        'status_bahasa'
    ];
}
