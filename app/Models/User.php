<?php
// File: app/Models/User.php
namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;

class User extends Authenticatable
{
    use HasFactory, Notifiable;

    protected $fillable = [
        'name',
        'username',
        'email',
        'password',
        'level',
    ];

    protected $hidden = [
        'password',
        'remember_token',
    ];

    protected function casts(): array
    {
        return [
            'email_verified_at' => 'datetime',
            'password' => 'hashed',
        ];
    }

    // Relasi ke Pembayaran (sebagai petugas)
    public function pembayaran()
    {
        return $this->hasMany(Pembayaran::class, 'petugas_id');
    }

    // Helper method untuk cek role
    public function isAdmin()
    {
        return $this->level === 'admin';
    }

    public function isPetugas()
    {
        return $this->level === 'petugas';
    }

    public function isSiswa()
    {
        return $this->level === 'siswa';
    }
    public function siswa()
    {
        return $this->hasOne(Siswa::class);
    }
}
