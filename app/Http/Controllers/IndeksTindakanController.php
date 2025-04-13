<?php

namespace App\Http\Controllers;

use App\Models\MasterIndeksing;
use Barryvdh\DomPDF\Facade\Pdf;
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
    $data = $data->select('master_indeksing.*','icd9.nama AS diagnosa','icd9.kode AS kode');
    $data = $data->get();
    $dataCount = $data->count();

    return view('rawat-jalan.indeksing-tindakan.index', compact('data','dataCount'));
}

public function printPdf(Request $request)
{
                                    // Get data - adjust the query based on your actual data structure
                                    $data = MasterIndeksing::join('icd9','icd9.id','master_indeksing.icd9')
                                    ->join('poli','poli.id','master_indeksing.id_poli')
                                    ->join('icd10_primary','icd10_primary.id','master_indeksing.icd10primary');

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
                                    $data = $data->select('master_indeksing.*','poli.nama as poli','icd9.nama AS diagnosa_icd9','icd9.kode AS kode_icd9','icd9.nama AS diagnosa','icd10_primary.nama AS nama_icd10','icd10_primary.kode AS kode_icd10');
                                    $data = $data->get();
    $total = $data->count();

    // Get current date for the report
    $currentDate = now()->format('d/m/Y');

    // Generate PDF
    $pdf = Pdf::loadView('rawat-jalan.indeksing-tindakan.pdf', [
        'data'        => $data,
        'image'       => public_path('/logo/logo-udinus.png'),
        'total'       => $total,
        'currentDate' => $currentDate,
    ]);

    // Set paper to landscape A4
    $pdf->setPaper('a4', 'landscape');

    // Download the PDF with a specific filename
    return $pdf->stream('laporan-indeks-tindakan-' . now()->format('Y-m-d') . '.pdf');

}
}
