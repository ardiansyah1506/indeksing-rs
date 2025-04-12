<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\ICD9;

class ICD9Controller extends Controller
{
    public function index()
    {
        $data = ICD9::all();
        return view('icd9.index', compact('data'));
    }

    public function create()
    {
        return view('icd9.create');
    }

    public function store(Request $request)
    {
        $request->validate([
            'nama' => 'required',
            'kode' => 'required|unique:icd9',
        ]);

        ICD9::create($request->all());
        return redirect()->route('icd9.index')->with('success', 'Data berhasil ditambahkan.');
    }

    public function edit(ICD9 $icd9)
    {
        return view('icd9.edit', compact('icd9$icd9'));
    }

    public function update(Request $request, ICD9 $icd9)
    {
        $request->validate([
            'nama' => 'required',
            'kode' => 'required|unique:icd9,kode,'.$icd9->id,
        ]);

        $icd9->update($request->all());
        return redirect()->route('icd9.index')->with('success', 'Data berhasil diperbarui.');
    }

    public function destroy(ICD9 $icd9)
    {
        $icd9->delete();
        return redirect()->route('icd9.index')->with('success', 'Data berhasil dihapus.');
    }
}
