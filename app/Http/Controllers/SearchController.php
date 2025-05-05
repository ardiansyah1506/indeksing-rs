<?php

namespace App\Http\Controllers;

use App\Models\ICD9;
use App\Models\ICD10Primary;
use Illuminate\Http\Request;

class SearchController extends Controller
{
        
    public function icd(Request $request, $number)
    {
        $querySearch = $request->input('query');

        if ($number == 9) {
            $data = ICD9::where('kode', 'like', '%' . $querySearch . '%')
                ->orWhere('nama', 'like', '%' . $querySearch . '%')
                ->limit(10)
                ->get();
        } else if ($number == 10) {
            $data = ICD10Primary::where('kode', 'like', '%' . $querySearch . '%')
                ->orWhere('nama', 'like', '%' . $querySearch . '%')
                ->limit(10)
                ->get();
        }

        return response()->json([
            'status' => 'success',
            'data' => $data,
        ]);

    }
}
