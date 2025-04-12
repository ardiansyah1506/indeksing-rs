<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class ICD9 extends Model
{
    use HasFactory;

    protected $table = 'icd9';
    protected $fillable = ['nama','kode'];

}
