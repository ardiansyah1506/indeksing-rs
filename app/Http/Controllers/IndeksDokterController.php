<?php

namespace App\Http\Controllers;

use App\Models\Dokter;
use App\Models\MasterIndeksing;
use Illuminate\Http\Request;

class IndeksDokterController extends Controller
{
    public function index(Request $request)
    {
        $data = MasterIndeksing::query();
        $dokter = Dokter::all();
        // Filter berdasarkan nama penyakit pada kolom 'icd10primary'
        if ($request->filled('id_dokter')) {
            $data->where('id_dokter', '=', $request->id_dokter );
        }
    
        // Filter berdasarkan range tanggal kunjungan
        if ($request->filled('tgl_awal') && $request->filled('tgl_akhir')) {
            $data->whereBetween('tgl_kunjungan', [$request->tgl_awal, $request->tgl_akhir]);
        }
        $data = $data->get();
        $dataCount = $data->count();
    // if(empty($request->all())){
    //     return view('rawat-jalan.indeksing-dokter.index', compact('data','dataCount','dokter'))->withInput();
    // }
    return view('rawat-jalan.indeksing-dokter.index', compact('data','dataCount','dokter'));
    }
}
