<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Hash;
use App\Models\User;
use App\Models\Kelas;
use App\Models\SPP;
use App\Models\Siswa;
use App\Models\Pembayaran;

class DatabaseSeeder extends Seeder
{
    public function run()
    {
        // 1. Buat User Admin & Petugas
        $admin1 = User::create([
            'name' => 'Administrator',
            'username' => 'admin',
            'email' => 'admin@spp.com',
            'level' => 'admin',
            'password' => Hash::make('admin123')
        ]);

        $admin2 = User::create([
            'name' => 'Admin 2',
            'username' => 'admin2',
            'email' => 'admin2@spp.com',
            'level' => 'admin',
            'password' => Hash::make('admin123')
        ]);

        $petugas = User::create([
            'name' => 'Petugas 1',
            'username' => 'petugas',
            'email' => 'petugas@spp.com',
            'level' => 'petugas',
            'password' => Hash::make('petugas123')
        ]);

        // 2. Buat Kelas
        $kelas1 = Kelas::create(['nama_kelas' => 'X', 'jurusan' => 'IPA']);
        $kelas2 = Kelas::create(['nama_kelas' => 'XI', 'jurusan' => 'IPS']);
        $kelas3 = Kelas::create(['nama_kelas' => 'XII', 'jurusan' => 'RPL']);

        // 3. Buat SPP
        $spp2024 = SPP::create(['tahun' => 2024, 'nominal' => 350000]);
        $spp2025 = SPP::create(['tahun' => 2025, 'nominal' => 400000]);

        // 4. Buat Siswa + User Siswa (link user_id)
        $siswaData = [
            ['nis' => '2024001', 'nama' => 'Ahmad Fauzi', 'kelas' => $kelas1, 'spp' => $spp2024],
            ['nis' => '2024002', 'nama' => 'Siti Nurhaliza', 'kelas' => $kelas2, 'spp' => $spp2024],
            ['nis' => '2024003', 'nama' => 'Budi Santoso', 'kelas' => $kelas3, 'spp' => $spp2025],
        ];

        foreach ($siswaData as $data) {
            // Buat user siswa
            $userSiswa = User::create([
                'name' => $data['nama'],
                'username' => $data['nis'],
                'email' => $data['nis'] . '@siswa.com',
                'level' => 'siswa',
                'password' => Hash::make('siswa123')
            ]);

            // Buat siswa + link ke user
            $siswa = Siswa::create([
                'nis' => $data['nis'],
                'nama' => $data['nama'],
                'kelas_id' => $data['kelas']->id,
                'spp_id' => $data['spp']->id,
                'user_id' => $userSiswa->id, // LINK KE USER
                'no_telp' => '0812345678' . substr($data['nis'], -1),
                'alamat' => 'Jl. Contoh No. ' . substr($data['nis'], -1)
            ]);

            // 5. Tambahkan pembayaran contoh per siswa
            Pembayaran::create([
                'siswa_id' => $siswa->id,
                'petugas_id' => $petugas->id,
                'tanggal_bayar' => '2024-01-10',
                'bulan_dibayar' => 'Januari',
                'tahun_dibayar' => 2024,
                'jumlah_bayar' => $data['spp']->nominal
            ]);

            Pembayaran::create([
                'siswa_id' => $siswa->id,
                'petugas_id' => $petugas->id,
                'tanggal_bayar' => '2024-02-10',
                'bulan_dibayar' => 'Februari',
                'tahun_dibayar' => 2024,
                'jumlah_bayar' => $data['spp']->nominal
            ]);
        }
    }
}