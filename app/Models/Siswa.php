<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Siswa extends Model
{
    use HasFactory;

    protected $table = 'siswa';

    protected $fillable = [
        'nis',
        'nama',
        'kelas_id',
        'spp_id',
        'user_id', // TAMBAHKAN INI
        'no_telp',
        'alamat',
    ];

    // Relasi ke User
    public function user()
    {
        return $this->belongsTo(User::class);
    }

    // Relasi ke Kelas
    public function kelas()
    {
        return $this->belongsTo(Kelas::class);
    }

    // Relasi ke SPP
    public function spp()
    {
        return $this->belongsTo(SPP::class);
    }

    // Relasi ke Pembayaran
    public function pembayaran()
    {
        return $this->hasMany(Pembayaran::class, 'siswa_id');
    }

    // Accessor
    public function getNamaLengkapAttribute()
    {
        return $this->nis . ' - ' . $this->nama;
    }
}