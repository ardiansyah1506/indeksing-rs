<?php

namespace App\Http\Controllers;

use App\Models\MasterIndeksing;
use Barryvdh\DomPDF\Facade\Pdf;
use Carbon\Carbon;
use Illuminate\Http\Request;

class IndeksPenyakitController extends Controller
{
    public function index(Request $request)
{
    $data = MasterIndeksing::join('icd10_primary','icd10_primary.id','master_indeksing.icd10primary')
    ->join('dokter','dokter.id', 'master_indeksing.id_dokter')
    ->join('icd9','icd9.id', 'master_indeksing.icd9')
    ->join('poli','poli.id', 'master_indeksing.id_poli');

    if ($request->filled('jenis_kunjungan')) {
        $data->where('jenis_kunjungan', $request->jenis_kunjungan );
    }

    if ($request->filled('nama_penyakit')) {
        $data->where(function($q) use ($request) {
            $q->where('icd9.nama', 'like', '%' . $request->nama_penyakit . '%')
              ->orWhere('icd9.kode', 'like', '%' . $request->nama_penyakit . '%');
        });
    }
    
    if ($request->filled('tgl_awal') && $request->filled('tgl_akhir')) {
        $data->whereBetween('tgl_kunjungan', [$request->tgl_awal, $request->tgl_akhir]);
    }
    $data = $data->select('master_indeksing.*','icd10_primary.nama AS diagnosa','icd10_primary.kode AS kode','icd9.kode AS icd9');
    $data = $data->get();
    foreach ($data as $item) {
        // Asumsikan $item->usia adalah tanggal lahir, misalnya: '2000-04-08'
        $tanggalLahir = Carbon::parse($item->usia);
        $item->umur = $tanggalLahir->age;
    }
    $dataCount = $data->count();

    return view('rawat-jalan.indeksing-penyakit.index', compact('data','dataCount'));
}

public function printPdf(Request $request)
{
    // Bangun query awal
    $query = MasterIndeksing::join('icd10_primary','icd10_primary.id','master_indeksing.icd10primary')
    ->leftJoin('icd10_secondary','icd10_secondary.id', 'master_indeksing.icd10secondary')
    ->join('dokter','dokter.id', 'master_indeksing.id_dokter')
    ->join('poli','poli.id', 'master_indeksing.id_poli');

    if ($request->filled('jenis_kunjungan')) {
        $query->where('jenis_kunjungan', $request->jenis_kunjungan );
    }

    if ($request->filled('nama_penyakit')) {
        $query->where(function($q) use ($request) {
            $q->where('icd10_primary.nama', 'like', '%' . $request->nama_penyakit . '%')
              ->orWhere('icd10_primary.kode', 'like', '%' . $request->nama_penyakit . '%');
        });
    }
    
    if ($request->filled('tgl_awal') && $request->filled('tgl_akhir')) {
        $query->whereBetween('tgl_kunjungan', [$request->tgl_awal, $request->tgl_akhir]);
    }

    // Clone query untuk dataIcd (sebelum get)
    $queryIcd = clone $query;

    // Ambil semua data
    $data = $query->select(
        'master_indeksing.*'
        ,'icd10_primary.nama AS diagnosa'
        ,'icd10_primary.kode AS kode'
        ,'icd9.kode AS icd9'
        ,'dokter.nama AS dokter'
        ,'poli.nama AS poli'
    )->get();
    foreach ($data as $item) {
        // Asumsikan $item->usia adalah tanggal lahir, misalnya: '2000-04-08'
        $tanggalLahir = Carbon::parse($item->usia);
        $item->umur = $tanggalLahir->age;
    }
    // Ambil hanya nama & kode ICD dari data pertama
    $dataIcd = $queryIcd->select('icd10_primary.nama AS nama', 'icd10_primary.kode AS kode')->first();
    $dataIcdSec = $queryIcd->select('icd10_secondary.nama AS nama', 'icd10_secondary.kode AS kode')->first();

    $tglAwal = Carbon::parse($request->tgl_awal);
$tglAkhir = Carbon::parse($request->tgl_akhir);

    // Ambil bulan & tahun
    $dataWaktu = Carbon::parse($request->tgl_awal)->format('F Y');
    if ($tglAwal->diffInMonths($tglAkhir) > 1) {
        $dataWaktu = $tglAwal->format('Y');
    }
    // Siapkan data tambahan
    $nama        = $dataIcd->nama ?? '-';
    $kode        = $dataIcd->kode ?? '-';
    $kodeSec        = $dataIcdSec->kode ?? '-';
    $currentDate = now()->format('d/m/Y');
    $total       = $data->count();
    // Generate PDF
    $pdf = Pdf::loadView('rawat-jalan.indeksing-penyakit.pdf', [
        'data'        => $data,
        'nama'        => $nama,
        'kode'        => $kode,
        'dataWaktu'   => $dataWaktu,
        'image'       => public_path('/logo/logo-udinus.png'),
        'total'       => $total,
        'currentDate' => $currentDate,
    ]);
    // return view(
    //     'rawat-jalan.indeksing-penyakit.pdf', [
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
