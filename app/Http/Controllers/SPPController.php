<?php

namespace App\Http\Controllers;

use App\Models\SPP;
use Illuminate\Http\Request;

class SPPController extends Controller
{
    public function index()
    {
        $spp = SPP::all();
        return view('spp.index', compact('spp'));
    }

    public function create()
    {
        return view('spp.create');
    }

    public function store(Request $request)
    {
        $request->validate([
            'tahun' => 'required|integer|digits:4',
            'nominal' => 'required|numeric|min:0',
        ]);

        SPP::create($request->all());
        return redirect()->route('spp.index')->with('success', 'SPP berhasil ditambahkan.');
    }

    public function edit(SPP $spp)
    {
        return view('spp.edit', compact('spp'));
    }

    public function update(Request $request, SPP $spp)
    {
        $request->validate([
            'tahun' => 'required|integer|digits:4',
            'nominal' => 'required|numeric|min:0',
        ]);

        $spp->update($request->all());
        return redirect()->route('spp.index')->with('success', 'SPP berhasil diupdate.');
    }

    public function destroy(SPP $spp)
    {
        $spp->delete();
        return redirect()->route('spp.index')->with('success', 'SPP berhasil dihapus.');
    }
}