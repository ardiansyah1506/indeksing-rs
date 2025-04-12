<?php

namespace App\Http\Controllers;

use App\Models\ICD10Secondary;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Log;

class ICD10SecondaryController extends Controller
{
    public function index()
    {
        $data = ICD10Secondary::all();
        return view('icd10_secondary.index', compact('data'));
    }

    public function create()
    {
        return view('icd10_secondary.create');
    }

    public function store(Request $request)
{
    $request->validate([
        'nama' => 'required',
        'kode' => 'required|unique:icd10_secondary',
    ]);

    try {
        ICD10Secondary::create($request->all());
        return redirect()->route('icd10_secondary.index')->with('success', 'Data berhasil ditambahkan.');
    } catch (\Exception $e) {
        Log::error('Gagal menambahkan data ICD10Secondary: ' . $e->getMessage(), [
            'data' => $request->all(),
            'trace' => $e->getTraceAsString()
        ]);

        return redirect()->back()->withInput()->with('error', 'Terjadi kesalahan saat menyimpan data.');
    }
}

    public function edit(ICD10Secondary $icd10secondary)
    {
        return view('icd10_secondary.edit', compact('icd10secondary'));
    }

    public function update(Request $request, ICD10Secondary $icd10secondary)
    {
        $request->validate([
            'nama' => 'required',
            'kode' => 'required|unique:icd10_secondary,kode,'.$icd10secondary->id,
        ]);

        $icd10secondary->update($request->all());
        return redirect()->route('icd10_secondary.index')->with('success', 'Data berhasil diperbarui.');
    }

    public function destroy(ICD10Secondary $icd10secondary)
    {
        $icd10secondary->delete();
        return redirect()->route('icd10_secondary.index')->with('success', 'Data berhasil dihapus.');
    }
}
