<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class ICD10Secondary extends Model
{
    use HasFactory;

    protected $table = 'icd10_secondary';
    protected $fillable = ['nama','kode'];
}
