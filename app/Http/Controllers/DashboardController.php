<?php

namespace App\Http\Controllers;

use App\Models\Pembayaran;
use App\Models\Siswa;
use App\Models\User;
use Carbon\Carbon;

class DashboardController extends Controller
{
    public function index()
    {
        $totalSiswa   = Siswa::count();
        $totalPetugas = User::where('level', 'petugas')->count();
        $totalPembayaran = Pembayaran::sum('jumlah_bayar');

        // Tambahkan ini
        $pembayaranBulanIni = Pembayaran::whereMonth('tanggal_bayar', Carbon::now()->month)
                                        ->whereYear('tanggal_bayar', Carbon::now()->year)
                                        ->sum('jumlah_bayar');

        $pembayaranTerakhir = Pembayaran::with(['siswa.kelas', 'petugas'])
            ->latest()
            ->take(5)
            ->get();

        if (auth()->user()->level === 'admin') {
            return view('dashboard.admin', compact(
                'totalSiswa',
                'totalPetugas',
                'totalPembayaran',
                'pembayaranTerakhir',
                'pembayaranBulanIni' // jangan lupa
            ));
        }

        if (auth()->user()->level === 'siswa') {
            return view('dashboard.siswa', compact(
                'totalSiswa',
                'totalPembayaran',
                'pembayaranTerakhir',
                'pembayaranBulanIni'
            ));
        }

        // Petugas pakai view yang sama dengan admin
        return view('dashboard.admin', compact(
            'totalSiswa',
            'totalPetugas',
            'totalPembayaran',
            'pembayaranTerakhir',
            'pembayaranBulanIni'
        ));
    }
}