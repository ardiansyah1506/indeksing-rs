<?php

namespace App\Http\Controllers;

use App\Models\MasterIndeksing;
use Barryvdh\DomPDF\Facade\Pdf;
use Carbon\Carbon;
use Illuminate\Http\Request;

class IndeksKematianController extends Controller
{
    public function index(Request $request)
    {
        $data = MasterIndeksing::join('icd10_primary','icd10_primary.id','master_indeksing.icd10primary');
    
        
        if ($request->filled('tgl_awal') && $request->filled('tgl_akhir')) {
            $data->whereBetween('tgl_kunjungan', [$request->tgl_awal, $request->tgl_akhir]);
        }
        $data = $data->select('master_indeksing.*','icd10_primary.nama AS diagnosa','icd10_primary.nama AS kode');
        $data = $data->get();
        foreach ($data as $item) {
            // Asumsikan $item->usia adalah tanggal lahir, misalnya: '2000-04-08'
            $tanggalLahir = Carbon::parse($item->usia);
            $item->umur = $tanggalLahir->age;
        }
        $dataCount = $data->count();
    
        return view('rawat-jalan.indeksing-kematian.index', compact('data','dataCount'));
    }

    public function printPdf(Request $request)
    {
        // Bangun query awal
        $query = MasterIndeksing::join('icd10_primary','icd10_primary.id','master_indeksing.icd10primary')
        ->join('dokter','dokter.id', 'master_indeksing.id_dokter');
    
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
            ,'icd10_primary.nama AS kode'
            ,'dokter.nama AS dokter'
        )->get();
        foreach ($data as $item) {
            // Asumsikan $item->usia adalah tanggal lahir, misalnya: '2000-04-08'
            $tanggalLahir = Carbon::parse($item->usia);
            $item->umur = $tanggalLahir->age;
        }
        // Ambil hanya nama & kode ICD dari data pertama
        $dataIcd = $queryIcd->select('icd10_primary.nama AS nama', 'icd10_primary.kode AS kode')->first();
    
        // Ambil bulan & tahun
        $dataWaktu = Carbon::parse($request->tgl_awal)->format('F Y');
    
        // Siapkan data tambahan
        $nama        = $dataIcd->nama ?? '-';
        $kode        = $dataIcd->kode ?? '-';
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

    public function viewPdf()
    {
        $data  = MasterIndeksing::get();
        $image = public_path('/logo/logo-udinus.png');

        return view('welcome', compact('data', 'image'));

    }
}
