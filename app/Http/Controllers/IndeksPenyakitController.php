<?php

namespace App\Http\Controllers;

use App\Models\MasterIndeksing;
use Illuminate\Http\Request;

class IndeksPenyakitController extends Controller
{
    public function index(Request $request)
{
    $data = MasterIndeksing::join('icd10_primary','icd10_primary.id','master_indeksing.icd10primary');

    if ($request->filled('jenis_kunjungan')) {
        $data->where('jenis_kunjungan', $request->jenis_kunjungan );
    }

    if ($request->filled('nama_penyakit')) {
        $data->where(function($q) use ($request) {
            $q->where('icd10_primary.nama', 'like', '%' . $request->nama_penyakit . '%')
              ->orWhere('icd10_primary.kode', 'like', '%' . $request->nama_penyakit . '%');
        });
    }
    
    if ($request->filled('tgl_awal') && $request->filled('tgl_akhir')) {
        $data->whereBetween('tgl_kunjungan', [$request->tgl_awal, $request->tgl_akhir]);
    }
    $data = $data->select('master_indeksing.*','icd10_primary.nama AS diagnosa','icd10_primary.nama AS kode');
    $data = $data->get();
    $dataCount = $data->count();

    return view('rawat-jalan.indeksing-penyakit.index', compact('data','dataCount'));
}


   
}
