<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class SkriningPasien extends Model
{
    protected $table = 'skrining_pasien';
    protected $fillable = [
        'kode_skrining',
        'pasien_id',
        'user_id',
        'tanggal_skrining',
        'status_skrining',
        'ttd',
    ];

    public static function generateTransactionCode()
    {
        $prefix = 'KS';
        $latestTransaction = self::where('kode_skrining', 'LIKE', "{$prefix}%")
            ->orderBy('id', 'desc')
            ->first();

        if ($latestTransaction) {
            $lastNumber = (int) substr($latestTransaction->kode_skrining, 2); // Ambil angka setelah prefix
            $newNumber = $lastNumber + 1;
        } else {
            $newNumber = 1; // Jika belum ada transaksi
        }

        return $prefix . str_pad($newNumber, 3, '0', STR_PAD_LEFT); // Tambahkan padding 0
    }

    public function pasien() {
        return $this->belongsTo(Pasien::class,'pasien_id','id');
    }
}
