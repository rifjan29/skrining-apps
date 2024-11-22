<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Keluhan extends Model
{
    protected $table = 'keluhan';
    protected $fillable = [
        'pasien_id',
        'gejala',
        'skala',
    ];
}
