<?php

namespace App\Http\Controllers;

use App\Models\MasterIndeksing;
use Illuminate\Http\Request;

class IndeksPenyakitController extends Controller
{
    public function index(Request $request)
    {
        $data = MasterIndeksing::join('icd10_primary','icd10_primary.id','master_indeksing.icd10primary')->query();

        if ($request->filled('jenis_kunjungan')) {
            $data->where('jenis_kunjungan', '=', $request->jenis_kunjungan );
        }

        if ($request->filled('nama_penyakit')) {
            $data->orWhere('icd10_primary.nama', 'like', '%' . $request->nama_penyakit . '%');
            $data->orWhere('icd10_secondary.kode', 'like', '%' . $request->nama_penyakit . '%');
        }
    
        // Filter berdasarkan range tanggal kunjungan
        if ($request->filled('tgl_awal') && $request->filled('tgl_akhir')) {
            $data->whereBetween('tgl_kunjungan', [$request->tgl_awal, $request->tgl_akhir]);
        }
        $data = $data->get();
        $dataCount = $data->count();
    if(empty($request->all())){
        return view('rawat-jalan.indeksing-penyakit.index', compact('data','dataCount'));
    }
    return view('rawat-jalan.indeksing-penyakit.index', compact('data','dataCount'));
     }

   
}
