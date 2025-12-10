<?php

namespace App\Http\Controllers;

use App\Models\Pembayaran;
use App\Models\Siswa;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;
use Illuminate\Support\Facades\Auth;

class PembayaranController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $pembayaran = Pembayaran::with(['siswa.kelas', 'petugas'])
            ->orderBy('tanggal_bayar', 'desc')
            ->orderBy('created_at', 'desc')
            ->get();

        return view('pembayaran.index', compact('pembayaran'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        // Ambil semua siswa dengan relasi kelas dan spp
        $siswa = Siswa::with(['kelas', 'spp'])
            ->orderBy('nama', 'asc')
            ->get();

        // Daftar bulan dalam Bahasa Indonesia
        $bulan = [
            'Januari', 'Februari', 'Maret', 'April', 'Mei', 'Juni',
            'Juli', 'Agustus', 'September', 'Oktober', 'November', 'Desember'
        ];

        return view('pembayaran.create', compact('siswa', 'bulan'));
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        // Validasi input
        $validator = Validator::make($request->all(), [
            'siswa_id' => 'required|exists:siswa,id',
            'tanggal_bayar' => 'required|date',
            'bulan_dibayar' => 'required|string|max:20',
            'tahun_dibayar' => 'required|integer|digits:4',
            'jumlah_bayar' => 'required|numeric|min:0',
        ], [
            'siswa_id.required' => 'Siswa wajib dipilih',
            'siswa_id.exists' => 'Siswa tidak valid',
            'tanggal_bayar.required' => 'Tanggal bayar wajib diisi',
            'tanggal_bayar.date' => 'Format tanggal tidak valid',
            'bulan_dibayar.required' => 'Bulan dibayar wajib dipilih',
            'tahun_dibayar.required' => 'Tahun dibayar wajib diisi',
            'tahun_dibayar.digits' => 'Tahun harus 4 digit',
            'jumlah_bayar.required' => 'Jumlah bayar wajib diisi',
            'jumlah_bayar.numeric' => 'Jumlah bayar harus berupa angka',
            'jumlah_bayar.min' => 'Jumlah bayar minimal 0',
        ]);

        if ($validator->fails()) {
            return redirect()->back()
                ->withErrors($validator)
                ->withInput();
        }

        try {
            // Cek apakah pembayaran untuk bulan/tahun ini sudah ada
            $existing = Pembayaran::where('siswa_id', $request->siswa_id)
                ->where('bulan_dibayar', $request->bulan_dibayar)
                ->where('tahun_dibayar', $request->tahun_dibayar)
                ->first();

            if ($existing) {
                return redirect()->back()
                    ->with('error', 'Pembayaran untuk bulan ' . $request->bulan_dibayar . ' ' . $request->tahun_dibayar . ' sudah ada!')
                    ->withInput();
            }

            // Simpan pembayaran
            Pembayaran::create([
                'siswa_id' => $request->siswa_id,
                'petugas_id' => Auth::id(),
                'tanggal_bayar' => $request->tanggal_bayar,
                'bulan_dibayar' => $request->bulan_dibayar,
                'tahun_dibayar' => $request->tahun_dibayar,
                'jumlah_bayar' => $request->jumlah_bayar,
            ]);

            return redirect()->route('pembayaran.index')
                ->with('success', 'Pembayaran berhasil disimpan!');
        } catch (\Exception $e) {
            return redirect()->back()
                ->with('error', 'Gagal menyimpan pembayaran: ' . $e->getMessage())
                ->withInput();
        }
    }

    /**
     * Display the specified resource.
     */
    public function show(Pembayaran $pembayaran)
    {
        // Load relasi
        $pembayaran->load(['siswa.kelas', 'siswa.spp', 'petugas']);

        return view('pembayaran.show', compact('pembayaran'));
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Pembayaran $pembayaran)
    {
        $siswa = Siswa::with(['kelas', 'spp'])
            ->orderBy('nama', 'asc')
            ->get();

        $bulan = [
            'Januari', 'Februari', 'Maret', 'April', 'Mei', 'Juni',
            'Juli', 'Agustus', 'September', 'Oktober', 'November', 'Desember'
        ];

        return view('pembayaran.edit', compact('pembayaran', 'siswa', 'bulan'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, Pembayaran $pembayaran)
    {
        // Validasi input
        $validator = Validator::make($request->all(), [
            'siswa_id' => 'required|exists:siswa,id',
            'tanggal_bayar' => 'required|date',
            'bulan_dibayar' => 'required|string|max:20',
            'tahun_dibayar' => 'required|integer|digits:4',
            'jumlah_bayar' => 'required|numeric|min:0',
        ], [
            'siswa_id.required' => 'Siswa wajib dipilih',
            'tanggal_bayar.required' => 'Tanggal bayar wajib diisi',
            'bulan_dibayar.required' => 'Bulan dibayar wajib dipilih',
            'tahun_dibayar.required' => 'Tahun dibayar wajib diisi',
            'jumlah_bayar.required' => 'Jumlah bayar wajib diisi',
        ]);

        if ($validator->fails()) {
            return redirect()->back()
                ->withErrors($validator)
                ->withInput();
        }

        try {
            // Cek duplikasi (kecuali data yang sedang diedit)
            $existing = Pembayaran::where('siswa_id', $request->siswa_id)
                ->where('bulan_dibayar', $request->bulan_dibayar)
                ->where('tahun_dibayar', $request->tahun_dibayar)
                ->where('id', '!=', $pembayaran->id)
                ->first();

            if ($existing) {
                return redirect()->back()
                    ->with('error', 'Pembayaran untuk bulan ' . $request->bulan_dibayar . ' ' . $request->tahun_dibayar . ' sudah ada!')
                    ->withInput();
            }

            // Update pembayaran
            $pembayaran->update([
                'siswa_id' => $request->siswa_id,
                'tanggal_bayar' => $request->tanggal_bayar,
                'bulan_dibayar' => $request->bulan_dibayar,
                'tahun_dibayar' => $request->tahun_dibayar,
                'jumlah_bayar' => $request->jumlah_bayar,
            ]);

            return redirect()->route('pembayaran.index')
                ->with('success', 'Pembayaran berhasil diupdate!');
        } catch (\Exception $e) {
            return redirect()->back()
                ->with('error', 'Gagal mengupdate pembayaran: ' . $e->getMessage())
                ->withInput();
        }
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Pembayaran $pembayaran)
    {
        try {
            $pembayaran->delete();

            return redirect()->route('pembayaran.index')
                ->with('success', 'Pembayaran berhasil dihapus!');
        } catch (\Exception $e) {
            return redirect()->back()
                ->with('error', 'Gagal menghapus pembayaran: ' . $e->getMessage());
        }
    }

    /**
     * Laporan pembayaran (optional)
     */
    public function laporan(Request $request)
    {
        $query = Pembayaran::with(['siswa.kelas', 'petugas']);

        // Filter berdasarkan bulan
        if ($request->filled('bulan')) {
            $query->where('bulan_dibayar', $request->bulan);
        }

        // Filter berdasarkan tahun
        if ($request->filled('tahun')) {
            $query->where('tahun_dibayar', $request->tahun);
        }

        // Filter berdasarkan kelas
        if ($request->filled('kelas_id')) {
            $query->whereHas('siswa', function($q) use ($request) {
                $q->where('kelas_id', $request->kelas_id);
            });
        }

        $pembayaran = $query->orderBy('tanggal_bayar', 'desc')->get();
        $totalPembayaran = $pembayaran->sum('jumlah_bayar');

        return view('pembayaran.laporan', compact('pembayaran', 'totalPembayaran'));
    }
}