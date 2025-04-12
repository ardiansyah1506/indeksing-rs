<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class ICD10Primary extends Model
{
    use HasFactory;

    protected $table = 'icd10_primary';
    protected $fillable = ['nama','kode'];

}
