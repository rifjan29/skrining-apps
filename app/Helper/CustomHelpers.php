<?php

use App\Models\SkriningPasienIGD;
use App\Models\SkriningPasienTB;

if (!function_exists('checkItemStatus')) {
    /**
     * Check item status and return corresponding HTML
     *
     * @param object $item
     * @return string
     */
    function checkItemStatus($item)
    {
        $current_igd = SkriningPasienIGD::where('pasien_id',$item->id)->get();
        $current_tb = SkriningPasienTB::where('pasien_id',$item->id)->get();
        if (is_null($item->keterangan)) {
            return '<span class="badge rounded-pill alert-success">SELESAI</span><br>
                    <hr>
                    <small class="fw-bold text-sm">Skor : ' . htmlspecialchars($item->total_skor_awal) . '</small>';
        } else {
            if ($item->keterangan === 'Triase COVID (IGD)') {
                if (count($current_igd) > 0) {
                    return '<span
                                class="badge rounded-pill alert-warning">Triase COVID (IGD)</span><br>
                            <hr>
                            <small class="fw-bold text-sm">Skor : ' . htmlspecialchars($item->total_skor_awal) . '</small>';
                }else{

                    return '<a href="' . route('skrining-pasien-igd.edit', $item->id) . '"
                               class="badge rounded-pill alert-warning">Diarahkan Ke IGD</a><br>
                            <hr>
                            <small class="fw-bold text-sm">Skor : ' . htmlspecialchars($item->total_skor_awal) . '</small>';
                }
            } else {
                if (count($current_tb) > 0) {
                    return '<span
                           class="badge rounded-pill alert-warning">Klinik TB</span><br>
                        <hr>
                        <small class="fw-bold text-sm">Skor : ' . htmlspecialchars($item->total_skor_awal) . '</small>';
                }
                return '<a href="' . route('skrining-tb.create', $item->id) . '"
                           class="badge rounded-pill alert-warning">POLI TB/Airbone IGD</a><br>
                        <hr>
                        <small class="fw-bold text-sm">Skor : ' . htmlspecialchars($item->total_skor_awal) . '</small>';
            }
        }
    }
}

