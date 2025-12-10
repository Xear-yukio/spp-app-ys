<?php

namespace App\Http\Controllers;

use App\Models\User;
use App\Models\Siswa;
use App\Models\Kelas;
use App\Models\SPP;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;

class AuthController extends Controller
{
    /* ---------- LOGIN ---------- */
    public function showLogin()
    {
        return view('auth.login');
    }

    public function login(Request $request)
    {
        $credentials = $request->validate([
            'username' => 'required|string',
            'password' => 'required|string',
        ], [
            'username.required' => 'Username wajib diisi',
            'password.required' => 'Password wajib diisi',
        ]);

        if (Auth::attempt($credentials)) {
            $request->session()->regenerate();
            $level = Auth::user()->level;

            if ($level === 'siswa') {
                return redirect()->intended(route('siswa.dashboard'));
            }

            return redirect()->intended(route('dashboard'));
        }

        return back()->withErrors([
            'username' => 'Username atau password salah.',
        ])->onlyInput('username');
    }

    /* ---------- LOGOUT ---------- */
    public function logout(Request $request)
    {
        Auth::logout();
        $request->session()->invalidate();
        $request->session()->regenerateToken();
        return redirect('/login');
    }

    /* ---------- REGISTER (UMUM) ---------- */
    public function showRegister()
    {
        return view('auth.register');
    }

    public function register(Request $request)
    {
        $request->validate([
            'name'     => 'required|string|max:100',
            'username' => 'required|string|unique:users|max:50',
            'email'    => 'required|email|unique:users|max:100',
            'password' => 'required|min:6|confirmed',
        ], [
            'username.unique' => 'Username sudah digunakan',
            'email.unique'    => 'Email sudah terdaftar',
            'password.confirmed' => 'Konfirmasi password tidak cocok',
        ]);

        // 1. Buat user (default level = siswa)
        $user = User::create([
            'name'     => $request->name,
            'username' => $request->username,
            'email'    => $request->email,
            'password' => Hash::make($request->password),
            'level'    => 'siswa',
        ]);

        // 2. ➜ BUAT DATA SISWA SEKALIGUS (link ke user)
        //    Gunakan data default untuk kelas & spp (bisa diganti jika ada select di form)
        Siswa::create([
            'nis'       => $request->username, // pakai username sebagai NIS
            'nama'      => $request->name,
            'kelas_id'  => Kelas::first()->id ?? 1, // ambil kelas pertama (default)
            'spp_id'    => SPP::first()->id   ?? 1, // ambil SPP pertama (default)
            'user_id'   => $user->id,        // ➜ penting: link ke user
            'no_telp'   => null,
            'alamat'    => null,
        ]);

        // 3. Auto-login
        Auth::login($user);

        return redirect()->route('siswa.dashboard')->with('success', 'Registrasi berhasil, selamat datang!');
    }
}