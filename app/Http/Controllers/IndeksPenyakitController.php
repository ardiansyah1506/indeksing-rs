<?php

namespace App\Http\Controllers;

use App\Models\MasterIndeksing;
use Illuminate\Http\Request;

class IndeksPenyakitController extends Controller
{
    public function index(Request $request)
    {
        $data = MasterIndeksing::query();
    
        // Filter jenis kunjungan
        if ($request->filled('jenis_kunjungan')) {
            $data->where('jenis_kunjungan', '=', $request->jenis_kunjungan);
        }
    
        // Filter nama penyakit dari dua tabel
        if ($request->filled('nama_penyakit')) {
            $data->join('icd10_primary', 'master_indeksing.icd10primary', '=', 'icd10_primary.id')
                 ->join('icd10_secondary', 'master_indeksing.icd10secondary', '=', 'icd10_secondary.id')
                 ->where(function ($query) use ($request) {
                     $query->where('icd10_primary.nama', 'like', '%' . $request->nama_penyakit . '%')
                           ->orWhere('icd10_secondary.nama', 'like', '%' . $request->nama_penyakit . '%');
                 });
        }
    
        // Filter berdasarkan range tanggal kunjungan
        if ($request->filled('tgl_awal') && $request->filled('tgl_akhir')) {
            $data->whereBetween('tgl_kunjungan', [$request->tgl_awal, $request->tgl_akhir]);
        }
    
        $data = $data->get();
        $dataCount = $data->count();
    
        return view('rawat-jalan.indeksing-penyakit.index', compact('data', 'dataCount'));
    }
    

   
}
