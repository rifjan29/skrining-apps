<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Kebutuhan extends Model
{
    protected $table = 'kebutuhan';
    protected $fillable = [
        'pasien_id',
        'status_kebutuhan',
        'jenis_kebutuhan',
    ];
}
