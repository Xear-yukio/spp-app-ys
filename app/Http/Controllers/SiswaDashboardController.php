<?php

namespace App\Http\Controllers;

use App\Models\Pembayaran;
use App\Models\Siswa;
use App\Models\SPP;
use Illuminate\Support\Facades\DB;

class SiswaDashboardController extends Controller
{
    public function index()
    {
        $siswa = auth()->user()->siswa;
        $spp   = $siswa->spp; // relasi spp

        // Ambil semua bulan & tahun SPP yang seharusnya dibayar
        $bulanList = [
            'Januari', 'Februari', 'Maret', 'April', 'Mei', 'Juni',
            'Juli', 'Agustus', 'September', 'Oktober', 'November', 'Desember'
        ];

        // List bulan yang SUDAH dibayar
        $sudahBayar = Pembayaran::where('siswa_id', $siswa->id)
            ->where('tahun_dibayar', $spp->tahun)
            ->pluck('bulan_dibayar')
            ->toArray();

        // Bangun tagihan (belum bayar)
        $tagihan = [];
        foreach ($bulanList as $bln) {
            if (!in_array($bln, $sudahBayar)) {
                $tagihan[] = [
                    'bulan'   => $bln,
                    'tahun'   => $spp->tahun,
                    'nominal' => $spp->nominal,
                ];
            }
        }

        // Histori yang sudah dibayar
        $histori = Pembayaran::with(['petugas'])
            ->where('siswa_id', $siswa->id)
            ->latest()
            ->get();

        return view('siswa.dashboard', compact('siswa', 'tagihan', 'histori'));
    }

    public function histori()
    {
        return $this->index(); // pakai view yang sama
    }
}