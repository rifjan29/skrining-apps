<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class GangguanFungsiOrgan extends Model
{
    protected $table = 'gangguan_fungsi_organ';
    protected $fillable = [
        'pasien_id',
        'jenis_gangguan',
        'status_gangguan',
    ];
}
