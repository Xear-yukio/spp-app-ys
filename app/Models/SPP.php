<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class SPP extends Model
{
    use HasFactory;

    protected $table = 'spp';

    protected $fillable = [
        'tahun',
        'nominal',
    ];

    protected $casts = [
        'nominal' => 'decimal:2',
    ];

    // Relasi ke Siswa
    public function siswa()
    {
        return $this->hasMany(Siswa::class, 'spp_id');
    }

    // Accessor untuk format nominal
    public function getNominalFormatAttribute()
    {
        return 'Rp ' . number_format($this->nominal, 0, ',', '.');
    }
}
