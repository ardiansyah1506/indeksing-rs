<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Dokter;

class DokterController extends Controller
{
    public function index()
    {
        $data = Dokter::all();
        return view('dokter.index', compact('data'));
    }

    public function store(Request $request)
    {
        $request->validate([
            'nama' => 'required',
        ]);

        Dokter::create($request->all());
        return redirect()->route('dokter.index')->with('success', 'Data berhasil ditambahkan.');
    }

    public function update(Request $request, Dokter $dokter)
    {
        $request->validate([
            'nama' => 'required',
        ]);

        $dokter->update($request->all());
        return redirect()->route('dokter.index')->with('success', 'Data berhasil diperbarui.');
    }

    public function destroy(Dokter $dokter)
    {
        $dokter->delete();
        return redirect()->route('dokter.index')->with('success', 'Data berhasil dihapus.');
    }
}
