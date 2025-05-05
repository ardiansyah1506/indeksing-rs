<?php

namespace App\Http\Controllers;

use App\Models\Dokter;
use App\Models\ICD10Primary;
use App\Models\ICD10Secondary;
use App\Models\ICD9;
use App\Models\MasterIndeksing;
use App\Models\Poli;
use Carbon\Carbon;
use Illuminate\Http\Request;
use Log;

class IndeksingController extends Controller
{
    public function index()
    {
        $data = MasterIndeksing::select('master_indeksing.*','icd10_primary.nama AS nama_icd10p','icd10_primary.kode AS kode_icd10p','icd10_secondary.nama AS nama_icd10s','icd9.nama AS nama_icd9')->join('icd10_primary','icd10_primary.id','master_indeksing.icd10primary')
        ->leftJoin('icd10_secondary','icd10_secondary.id','master_indeksing.icd10secondary')
        ->join('icd9','icd9.id','master_indeksing.icd9')
        ->get();
        $dataIcd10Primary = ICD10Primary::get();
        $dataIcd10Secondary = ICD10Secondary::get();
        $dataIcd9 = ICD9::get();
    $dataCount = $data->count();
    $dataDokter = Dokter::get();
        $dataPoli = Poli::get();
        $id = MasterIndeksing::latest()->value('id') + 1;
        foreach ($data as $item) {
            // Asumsikan $item->usia adalah tanggal lahir, misalnya: '2000-04-08'
            $tanggalLahir = Carbon::parse($item->usia);
            $item->umur = $tanggalLahir->age;
        }
        // dd($data);
        return view('master-indeksing.index', compact('data','id','dataIcd10Primary','dataIcd10Secondary','dataIcd9','dataPoli','dataDokter','dataCount'));
    }

    public function store(Request $request)
    {
        try {
            $request->validate([
                'no_rm' => 'required|string|max:50',
                'nama_pasien' => 'required|string|max:255',
                'jk' => 'required',
                'usia' => 'required|min:0',
                'alamat' => 'required|string|max:500',
                'tgl_kunjungan' => 'required|date',
                'icd10primary' => 'nullable|string|max:50',
                'icd10secondary' => 'nullable|string|max:50',
                'icd9' => 'nullable|string|max:50',
                'id_dokter' => 'required|integer',
                'id_poli' => 'required|integer',
                'jenis_kunjungan' => 'required|in:1,2',
                'cara_keluar' => 'nullable|in:1,2',
                'keterangan' => 'nullable|string|max:500',
            ]);
    
            MasterIndeksing::create([
                'no_rm' => $request->no_rm,
                'nama_pasien' => $request->nama_pasien,
                'jk' => $request->jk,
                'usia' => $request->usia,
                'alamat' => $request->alamat,
                'tgl_kunjungan' => $request->tgl_kunjungan,
                'icd10primary' => $request->icd10primary,
                'icd10secondary' => $request->icd10secondary ,
                'icd9' => $request->icd9,
                'id_dokter' => $request->id_dokter,
                'id_poli' => $request->id_poli,
                'jenis_kunjungan' => $request->jenis_kunjungan,
                'cara_keluar' => $request->cara_keluar,
                'keterangan' => $request->keterangan,
            ]);
    
            return redirect()->back()->with('success', 'Data berhasil ditambahkan!');
    
        } catch (\Exception $e) {
            // Log error ke Laravel log
            Log::error('Error saat menyimpan data ke MasterIndeksing: ' . $e->getMessage(), [
                'trace' => $e->getTraceAsString(),
                'input' => $request->all()
            ]);
    
            // Redirect kembali dengan pesan error
            return redirect()->back()->with('error', 'Terjadi kesalahan saat menyimpan data. Silakan coba lagi.');
        }
    }

    public function show($id){
        $data = MasterIndeksing::select('master_indeksing.*','icd10_primary.nama AS nama_icd10p','icd10_primary.kode AS kode_icd10p','icd10_secondary.nama AS nama_icd10s','icd9.nama AS nama_icd9')->join('icd10_primary','icd10_primary.id','master_indeksing.icd10primary')
        ->leftJoin('icd10_secondary','icd10_secondary.id','master_indeksing.icd10secondary')
        ->join('icd9','icd9.id','master_indeksing.icd9')
        ->where('master_indeksing.id',$id)
        ->first();
        $dataIcd10Primary = ICD10Primary::get();
        $dataIcd10Secondary = ICD10Secondary::get();
        $dataIcd9 = ICD9::get();
      $dataDokter = Dokter::get();
        $dataPoli = Poli::get();
        $id = MasterIndeksing::latest()->value('id') + 1;
        // foreach ($data as $item) {
        //     // Asumsikan $item->usia adalah tanggal lahir, misalnya: '2000-04-08'
        //     $tanggalLahir = Carbon::parse($item->usia);
        //     $item->umur = $tanggalLahir->age;
        // }
        // dd($data);
        return view('master-indeksing.edit', compact('data','id'
        ,'dataIcd10Primary'
        ,'dataIcd10Secondary','dataIcd9','dataPoli','dataDokter'));
   
    }
    public function update(Request $request, $id)
    {
        $request->validate([
            'nama_pasien' => 'required|string',
            'jk' => 'required|in:1,0',
            'usia' => 'required|date',
            'alamat' => 'required|string',
            'tgl_kunjungan' => 'required|date',
            'id_dokter' => 'required|integer',
            'id_poli' => 'required|integer',
        ]);

        $masterIndeksing = MasterIndeksing::findOrFail($id);
        $masterIndeksing->update($request->all());

        return redirect()->route('indeksing.index')->with('success', 'Data berhasil diperbarui!');
    }

    public function destroy($id)
    {
        MasterIndeksing::destroy($id);
        return redirect()->route('indeksing.index')->with('success', 'Data berhasil dihapus!');
    }
}
