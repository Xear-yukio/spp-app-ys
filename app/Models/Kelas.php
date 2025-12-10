<?php
namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Kelas extends Model
{
    use HasFactory;

    protected $table = 'kelas';

    protected $fillable = [
        'nama_kelas',
        'jurusan',
    ];

    // Relasi ke Siswa
    public function siswa()
    {
        return $this->hasMany(Siswa::class, 'kelas_id');
    }

    // Accessor untuk menampilkan nama lengkap kelas
    public function getNamaLengkapAttribute()
    {
        return $this->nama_kelas . ' - ' . $this->jurusan;
    }
}