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
        'jenis_kelamin',
        'tempat_lahir',
    ];

    public function Keluhan() {
        return $this->belongsTo(Keluhan::class,'id','pasien_id');
    }

    public function Kondisi() {
        return $this->belongsTo(Kondisi::class,'id','pasien_id');
    }

    public function ResikoJatuh(){
        return $this->belongsTo(ResikoJatuh::class,'id','pasien_id');

    }

    public function Usia(){
        return $this->belongsTo(Usia::class,'id','pasien_id');

    }

    public function GangguanFungsiOrgan(){
        return $this->belongsTo(GangguanFungsiOrgan::class,'id','pasien_id');

    }

    public function PrivasiTertentu(){
        return $this->belongsTo(PrivasiTertentu::class,'id','pasien_id');

    }

    public function Bahasa(){
        return $this->belongsTo(Bahasa::class,'id','pasien_id');

    }

    public function FastTrack(){
        return $this->belongsTo(FastTrack::class,'id','pasien_id');

    }

    public function Kebutuhan(){
        return $this->belongsTo(Kebutuhan::class,'id','pasien_id');

    }
}
