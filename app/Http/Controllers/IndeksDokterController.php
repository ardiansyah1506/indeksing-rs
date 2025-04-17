<?php

namespace App\Http\Controllers;

use App\Models\Dokter;
use App\Models\MasterIndeksing;
use Barryvdh\DomPDF\Facade\Pdf;
use Carbon\Carbon;
use Illuminate\Http\Request;

class IndeksDokterController extends Controller
{
    public function index(Request $request)
    {
        $data = MasterIndeksing::join('icd10_primary','icd10_primary.id','master_indeksing.icd10primary')
        ->join('icd9','icd9.id','master_indeksing.icd9')
        ->join('poli','poli.id','master_indeksing.id_poli');
        $dokter = Dokter::all();

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
        $data = $data->select('master_indeksing.*','poli.nama as poli','icd10_primary.nama AS diagnosa','icd10_primary.kode AS kode_icd10','icd9.kode as kode_icd9');
        $data = $data->get();
        foreach ($data as $item) {
            // Asumsikan $item->usia adalah tanggal lahir, misalnya: '2000-04-08'
            $tanggalLahir = Carbon::parse($item->usia);
            $item->umur = $tanggalLahir->age;
        }
        
        
        $dataCount = $data->count();
    // if(empty($request->all())){
    //     return view('rawat-jalan.indeksing-dokter.index', compact('data','dataCount','dokter'))->withInput();
    // }
    return view('rawat-jalan.indeksing-dokter.index', compact('data','dataCount','dokter'));
    }


public function printPdf(Request $request)
{
    // Bangun query awal
    $query = MasterIndeksing::join('icd10_primary','icd10_primary.id','master_indeksing.icd10primary')
    ->join('dokter','dokter.id', 'master_indeksing.id_dokter')
    ->join('icd9','icd9.id', 'master_indeksing.icd9')
    ->join('poli','poli.id','master_indeksing.id_poli');

    if ($request->filled('id_dokter')) {
        $query->where('id_dokter', $request->id_dokter );
    }

    if ($request->filled('tgl_awal') && $request->filled('tgl_akhir')) {
        $query->whereBetween('tgl_kunjungan', [$request->tgl_awal, $request->tgl_akhir]);
    }

    // Clone query untuk dataIcd (sebelum get)
    $queryDokter = clone $query;

    // Ambil semua data
    $data = $query->select(
        'master_indeksing.*'
        ,'icd10_primary.nama AS diagnosa'
        ,'poli.nama as poli'
        ,'icd10_primary.kode AS icd10'
        ,'icd9.kode AS icd9'
        ,'dokter.nama AS dokter'
    )->get();
    foreach ($data as $item) {
        // Asumsikan $item->usia adalah tanggal lahir, misalnya: '2000-04-08'
        $tanggalLahir = Carbon::parse($item->usia);
        $item->umur = $tanggalLahir->age;
    }
    // Ambil hanya nama & kode ICD dari data pertama
    $dataDokter = $queryDokter->select('dokter.nama as dokter')->first();

    // Ambil bulan & tahun
    $dataWaktu = Carbon::parse($request->tgl_awal)->format('F Y');

    // Siapkan data tambahan
    $dokter        = $dataDokter->dokter ?? '-';
    $currentDate = now()->format('d/m/Y');
    $total       = $data->count();

    // Generate PDF
    $pdf = Pdf::loadView('rawat-jalan.indeksing-dokter.pdf', [
        'data'        => $data,
        'dokter'        => $dokter,
        'dataWaktu'   => $dataWaktu,
        'image'       => public_path('/logo/logo-udinus.png'),
        'total'       => $total,
        'currentDate' => $currentDate,
    ]);
    // return view(
    //     'rawat-jalan.indeksing-dokter.pdf', [
    //     'data'        => $data,
    //     'nama'        => $nama,
    //     'kode'        => $kode,
    //     'dataWaktu'   => $dataWaktu,
    //     'image'       => public_path('/logo/logo-udinus.png'),
    //     'total'       => $total,
    //     'currentDate' => $currentDate,
    // ]
    // );

    $pdf->setPaper('a4', 'landscape');
    return $pdf->stream('laporan-indeks-penyakit' . now()->format('Y-m-d') . '.pdf');
}
   
}
