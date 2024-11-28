<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class PasienCovid extends Model
{
    protected $table = 'pasien_covid';
    protected $fillable = [
        'kode_transaksi',
        'no_rm',
        'nama_lengkap',
        'tempat_lahir',
        'jenis_kelamin',
        'tanggal_lahir',
        'pekerjaan',
        'alamat',
        'komorbid',
        'jenis_pasien',
        'penjamin_biaya',
        'lainnya_penjamin',
        'tujuan',
        'poli_tujuan',
        'user_id',
        'keterangan',
        'keterangan_lanjutan',
        'total_skor_awal',
        'total_skor_lanjutan'
    ];

    public static function generateTransactionCode()
    {
        $prefix = 'KC';
        $latestTransaction = self::where('kode_transaksi', 'LIKE', "{$prefix}%")
            ->orderBy('id', 'desc')
            ->first();

        if ($latestTransaction) {
            $lastNumber = (int) substr($latestTransaction->kode_transaksi, 2); // Ambil angka setelah prefix
            $newNumber = $lastNumber + 1;
        } else {
            $newNumber = 1; // Jika belum ada transaksi
        }

        return $prefix . str_pad($newNumber, 3, '0', STR_PAD_LEFT); // Tambahkan padding 0
    }
}
