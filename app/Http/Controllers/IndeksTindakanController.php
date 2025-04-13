<?php

namespace App\Http\Controllers;

use App\Models\MasterIndeksing;
use Illuminate\Http\Request;

class IndeksTindakanController extends Controller
{
    public function index(Request $request)
{
    $data = MasterIndeksing::join('icd9','icd9.id','master_indeksing.icd9');

    if ($request->filled('jenis_kunjungan')) {
        $data->where('jenis_kunjungan', $request->jenis_kunjungan );
    }

    if ($request->filled('tindakan')) {
        $data->where(function($q) use ($request) {
            $q->where('icd9.nama', 'like', '%' . $request->tindakan . '%')
              ->orWhere('icd9.kode', 'like', '%' . $request->tindakan . '%');
        });
    }
    
    if ($request->filled('tgl_awal') && $request->filled('tgl_akhir')) {
        $data->whereBetween('tgl_kunjungan', [$request->tgl_awal, $request->tgl_akhir]);
    }
    $data = $data->select('master_indeksing.*','icd9.nama AS diagnosa','icd9.nama AS kode');
    $data = $data->get();
    $dataCount = $data->count();

    return view('rawat-jalan.indeksing-tindakan.index', compact('data','dataCount'));
}
}
