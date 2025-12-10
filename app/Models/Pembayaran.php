<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Pembayaran extends Model
{
    use HasFactory;

    protected $table = 'pembayaran';

    protected $fillable = [
        'siswa_id',
        'petugas_id',
        'tanggal_bayar',
        'bulan_dibayar',
        'tahun_dibayar',
        'jumlah_bayar',
    ];

    protected $casts = [
        'tanggal_bayar' => 'date',
        'jumlah_bayar' => 'decimal:2',
    ];

    // Relasi ke Siswa
    public function siswa()
    {
        return $this->belongsTo(Siswa::class, 'siswa_id');
    }

    // Relasi ke Petugas (User)
    public function petugas()
    {
        return $this->belongsTo(User::class, 'petugas_id');
    }

    // Accessor untuk format tanggal
    public function getTanggalFormatAttribute()
    {
        return $this->tanggal_bayar->format('d/m/Y');
    }

    // Accessor untuk format jumlah
    public function getJumlahFormatAttribute()
    {
        return 'Rp ' . number_format($this->jumlah_bayar, 0, ',', '.');
    }

    // Accessor untuk periode pembayaran
    public function getPeriodeAttribute()
    {
        return $this->bulan_dibayar . ' ' . $this->tahun_dibayar;
    }
}