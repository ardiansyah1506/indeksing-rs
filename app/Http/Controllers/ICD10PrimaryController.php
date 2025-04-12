<?php

namespace App\Http\Controllers;

use App\Models\ICD10Primary;
use Illuminate\Http\Request;

class ICD10PrimaryController extends Controller
{
    public function index()
    {
        $data = ICD10Primary::all();
        return view('icd10_primary.index', compact('data'));
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

        ICD10Primary::create($request->all());
        return redirect()->route('icd10_primary.index')->with('success', 'Data berhasil ditambahkan.');
    }

    public function edit(ICD10Primary $icd10Primary)
    {
        return view('icd10_primary.edit', compact('icd10Primary'));
    }

    public function update(Request $request, ICD10Primary $ICD10Primary)
    {
        $request->validate([
            'nama' => 'required',
            'kode' => 'required|unique:icd10_primary,kode,'.$ICD10Primary->id,
        ]);

        $ICD10Primary->update($request->all());
        return redirect()->route('icd10_primary.index')->with('success', 'Data berhasil diperbarui.');
    }

    public function destroy(ICD10Primary $ICD10Primary)
    {
        $ICD10Primary->delete();
        return redirect()->route('icd10_primary.index')->with('success', 'Data berhasil dihapus.');
    }
}
