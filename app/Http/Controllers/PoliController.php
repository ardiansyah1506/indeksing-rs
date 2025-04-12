<?php

namespace App\Http\Controllers;

use App\Models\Poli;
use Illuminate\Http\Request;

class PoliController extends Controller
{
    public function index()
    {
        $data = Poli::all();
        return view('poli.index', compact('data'));
    }

    public function store(Request $request)
    {
        $request->validate([
            'nama' => 'required',
        ]);

        Poli::create($request->all());
        return redirect()->route('poli.index')->with('success', 'Data berhasil ditambahkan.');
    }

    public function update(Request $request, Poli $poli)
    {
        $request->validate([
            'nama' => 'required',
        ]);

        $poli->update($request->all());
        return redirect()->route('poli.index')->with('success', 'Data berhasil diperbarui.');
    }

    public function destroy(Poli $poli)
    {
        $poli->delete();
        return redirect()->route('poli.index')->with('success', 'Data berhasil dihapus.');
    }
}
