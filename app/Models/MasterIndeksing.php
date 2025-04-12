<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class MasterIndeksing extends Model
{
    use HasFactory;
    protected $table = 'master_indeksing';

    protected $fillable = [
        'no_rm',
        'nama_pasien',
        'jk',
        'usia',
        'alamat',
        'tgl_kunjungan',
        'icd10primary',
        'icd10secondary',
        'icd9',
        'id_dokter',
        'id_poli',
        'jenis_kunjungan',
        'cara_keluar',
        'keterangan'
    ];
}
