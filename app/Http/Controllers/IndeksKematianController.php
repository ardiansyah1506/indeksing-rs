<?php

namespace App\Http\Controllers;

use App\Models\MasterIndeksing;
use Barryvdh\DomPDF\Facade\Pdf;
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
        $dataCount = $data->count();
    
        return view('rawat-jalan.indeksing-kematian.index', compact('data','dataCount'));
    }

    public function printPdf()
    {
                                        // Get data - adjust the query based on your actual data structure
        $data = MasterIndeksing::all(); // Or use your existing query to get the data

        // You can add filters based on request parameters if needed
        // For example: if($request->has('date_from')) { ... }

        // Count total records
        $total = $data->count();

        // Get current date for the report
        $currentDate = now()->format('d/m/Y');

        // Generate PDF
        $pdf = Pdf::loadView('welcome', [
            'data'        => $data,
            'image'       => public_path('/logo/logo-udinus.png'),
            'total'       => $total,
            'currentDate' => $currentDate,
        ]);

        // Set paper to landscape A4
        $pdf->setPaper('a4', 'landscape');

        // Download the PDF with a specific filename
        return $pdf->stream('laporan-indeks-penyakit-' . now()->format('Y-m-d') . '.pdf');

    }

    public function viewPdf()
    {
        $data  = MasterIndeksing::get();
        $image = public_path('/logo/logo-udinus.png');

        return view('welcome', compact('data', 'image'));

    }
}
