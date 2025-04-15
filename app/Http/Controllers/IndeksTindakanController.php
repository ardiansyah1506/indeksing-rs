<?php
namespace App\Http\Controllers;

use App\Models\MasterIndeksing;
use Barryvdh\DomPDF\Facade\Pdf;
use Carbon\Carbon;
use Illuminate\Http\Request;

class IndeksTindakanController extends Controller
{
    public function index(Request $request)
    {
        $data = MasterIndeksing::join('icd9', 'icd9.id', 'master_indeksing.icd9');

        if ($request->filled('jenis_kunjungan')) {
            $data->where('jenis_kunjungan', $request->jenis_kunjungan);
        }

        if ($request->filled('tindakan')) {
            $data->where(function ($q) use ($request) {
                $q->where('icd9.nama', 'like', '%' . $request->tindakan . '%')
                    ->orWhere('icd9.kode', 'like', '%' . $request->tindakan . '%');
            });
        }

        if ($request->filled('tgl_awal') && $request->filled('tgl_akhir')) {
            $data->whereBetween('tgl_kunjungan', [$request->tgl_awal, $request->tgl_akhir]);
        }
        $data      = $data->select('master_indeksing.*', 'icd9.nama AS diagnosa', 'icd9.kode AS kode');
        $data      = $data->get();
        foreach ($data as $item) {
            // Asumsikan $item->usia adalah tanggal lahir, misalnya: '2000-04-08'
            $tanggalLahir = Carbon::parse($item->usia);
            $item->umur = $tanggalLahir->age;
        }
        $dataCount = $data->count();

        return view('rawat-jalan.indeksing-tindakan.index', compact('data', 'dataCount'));
    }

    public function printPdf(Request $request)
    {
        // Bangun query awal
        $query = MasterIndeksing::join('icd9', 'icd9.id', 'master_indeksing.icd9')
            ->join('poli', 'poli.id', 'master_indeksing.id_poli')
            ->join('icd10_primary', 'icd10_primary.id', 'master_indeksing.icd10primary')
            ->join('dokter', 'dokter.id', 'master_indeksing.id_dokter');

        // Filter
        if ($request->filled('jenis_kunjungan')) {
            $query->where('jenis_kunjungan', $request->jenis_kunjungan);
        }

        if ($request->filled('tindakan')) {
            $query->where(function ($q) use ($request) {
                $q->where('icd9.nama', 'like', '%' . $request->tindakan . '%')
                    ->orWhere('icd9.kode', 'like', '%' . $request->tindakan . '%');
            });
        }

        if ($request->filled('tgl_awal') && $request->filled('tgl_akhir')) {
            $query->whereBetween('tgl_kunjungan', [$request->tgl_awal, $request->tgl_akhir]);
        }

        // Clone query untuk dataIcd (sebelum get)
        $queryIcd = clone $query;

        // Ambil semua data
        $data = $query->select(
            'master_indeksing.*',
            'poli.nama as poli',
            'icd9.nama AS tindakan',
            'icd9.kode AS kode_icd9',
            'icd10_primary.nama AS diagnosa',
            'icd10_primary.kode AS kode_icd10',
            'dokter.nama AS dokter'
        )->get();
        foreach ($data as $item) {
            // Asumsikan $item->usia adalah tanggal lahir, misalnya: '2000-04-08'
            $tanggalLahir = Carbon::parse($item->usia);
            $item->umur = $tanggalLahir->age;
        }
        // Ambil hanya nama & kode ICD dari data pertama
        $dataIcd = $queryIcd->select('icd9.nama AS nama', 'icd9.kode AS kode')->first();

        // Ambil bulan & tahun
        $dataWaktu = Carbon::parse($request->tgl_awal)->format('F Y');

        // Siapkan data tambahan
        $nama        = $dataIcd->nama ?? '-';
        $kode        = $dataIcd->kode ?? '-';
        $currentDate = now()->format('d/m/Y');
        $total       = $data->count();

        // Generate PDF
        $pdf = Pdf::loadView('rawat-jalan.indeksing-tindakan.pdf', [
            'data'        => $data,
            'nama'        => $nama,
            'kode'        => $kode,
            'dataWaktu'   => $dataWaktu,
            'image'       => public_path('/logo/logo-udinus.png'),
            'total'       => $total,
            'currentDate' => $currentDate,
        ]);

        $pdf->setPaper('a4', 'landscape');
        return $pdf->stream('laporan-indeks-tindakan-' . now()->format('Y-m-d') . '.pdf');
    }

}
