<?php

namespace App\Http\Controllers;

use App\Models\ICD10Secondary;
use Illuminate\Http\Request;

class ICD10SecondaryController extends Controller
{
    public function index()
    {
        $data = ICD10Secondary::all();
        return view('icd10_secondary.index', compact('data'));
    }

    public function create()
    {
        return view('icd10_primary.create');
    }

    public function store(Request $request)
    {
        $request->validate([
            'nama' => 'required',
            'kode' => 'required|unique:icd10_primary',
        ]);

        ICD10Secondary::create($request->all());
        return redirect()->route('icd10_secondary.index')->with('success', 'Data berhasil ditambahkan.');
    }

    public function edit(ICD10Secondary $icd10Primary)
    {
        return view('icd10_primary.edit', compact('icd10Primary'));
    }

    public function update(Request $request, ICD10Secondary $icd10Primary)
    {
        $request->validate([
            'nama' => 'required',
            'kode' => 'required|unique:icd10_primary,kode,'.$icd10Primary->id,
        ]);

        $icd10Primary->update($request->all());
        return redirect()->route('icd10_secondary.index')->with('success', 'Data berhasil diperbarui.');
    }

    public function destroy(ICD10Secondary $icd10Primary)
    {
        $icd10Primary->delete();
        return redirect()->route('icd10_secondary.index')->with('success', 'Data berhasil dihapus.');
    }
}
