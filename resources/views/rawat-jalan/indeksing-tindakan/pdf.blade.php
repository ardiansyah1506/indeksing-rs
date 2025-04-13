<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="Content-Type" content="text/html; charset=utf-8"/>
    <title>Kartu Indeks Dokter - RSU Dian Nuswantoro Semarang</title>
    <style>
        @page {
            margin: 10px;
        }
        
        body {
            font-family: "DejaVu Sans", sans-serif;
            margin: 0;
            padding: 0;
            font-size: 12px;
        }
        
        .container {
            width: 100%;
        }
        
        /* Header styling with table instead of flexbox */
        .header-table {
            width: 100%;
            border-collapse: collapse;
        }
        
        .header-table td {
            border: 1px solid #999;
            padding: 5px;
        }
        
        .logo {
            width: 80px;
            height: 80px;
            text-align: center;
        }
        
        .logo-img {
            width: 80px;
            height: auto;
        }
        
        .hospital-name {
            text-align: center;
            font-weight: bold;
            font-size: 16px;
        }
        
        .form-info {
            width: 250px;
        }
        
        .form-group {
            margin-bottom: 5px;
        }
        
        .form-label {
            font-weight: bold;
            display: inline-block;
            width: 100px;
        }
        
        .title {
            text-align: center;
            font-weight: bold;
            padding: 8px 0;
            border: 1px solid #999;
            background-color: #7775f1;
            margin-top: -1px;
        }
        
        .instructions {
            padding: 5px 10px;
            border: 1px solid #999;
            margin-top: -1px;
        }
        
        .instruction-label {
            font-weight: bold;
            display: inline-block;
            vertical-align: top;
        }
        
        .instruction-list {
            display: inline-block;
            color: red;
            margin-left: 10px;
            vertical-align: top;
        }
        
        .instruction-item {
            margin-bottom: 3px;
        }
        
        table.data-table {
            width: 100%;
            border-collapse: collapse;
            margin-top: -1px;
        }
        
        table.data-table th, 
        table.data-table td {
            border: 1px solid #999;
            padding: 5px;
            text-align: center;
            font-size: 10px;
        }
        
        table.data-table th {
            font-weight: bold;
            background-color: #f5f5f5;
        }
        
        .document-id {
            font-size: 9px;
            text-align: right;
            padding: 5px;
            margin-top: 5px;
        }
    </style>
</head>
<body>
    <div class="container">
        <!-- Header using table instead of flexbox -->
        <table class="header-table">
            <tr>
                <td class="logo">
                    <img src="{{ $image }}" class="logo-img" alt="Logo RSU Dian Nuswantoro">
                </td>
                <td class="hospital-name">
                    RSU DIAN NUSWANTORO SEMARANG
                </td>
                <td class="form-info">
                    <div class="form-group">
                        <span class="form-label">No.RS</span>
                        <span>: ...........................</span>
                    </div>
                    <div class="form-group">
                        <span class="form-label">Nama Dokter</span>
                        <span>: ...........................</span>
                    </div>
                    <div class="form-group">
                        <span class="form-label">Bulan/Tahun</span>
                        <span>: ...........................</span>
                    </div>
                </td>
            </tr>
        </table>
        
        <div class="title">
            KARTU INDEKS DOKTER (RAWAT JALAN)
        </div>
        
        <div class="instructions">
            <span class="instruction-label">Instruksi</span>
            <div class="instruction-list">
                <div class="instruction-item">1. Golongan umur dituliskan umur pasien</div>
                <div class="instruction-item">2. Pada jenis kunjungan dan tindak lanjut perawatan diberi tanda (✓)</div>
                <div class="instruction-item">3. Keterangan : H : Hidup → H    Mati → &lt;48jam (+)    Mati → &gt;48jam (+)</div>
            </div>
        </div>
        
        <table class="data-table">
            <thead>
                <tr>
                    <th rowspan="3">No.</th>
                    <th rowspan="3">No. Rekam Medis</th>
                    <th rowspan="3">Nama</th>
                    <th rowspan="3">Poliklinik</th>
                    <th colspan="16">Golongan umur (Tahun)</th>
                    <th rowspan="3">Kode ICD 9 Tindakan</th>
                    <th rowspan="3">Kode ICD 10</th>
                    <th colspan="2">Tanggal Kunjungan</th>
                    <th rowspan="3">Keterangan</th>
                </tr>
                <tr>
                    <th colspan="2">0-28h</th>
                    <th colspan="2">&lt;1</th>
                    <th colspan="2">1-5</th>
                    <th colspan="2">5-14</th>
                    <th colspan="2">15-24</th>
                    <th colspan="2">25-44</th>
                    <th colspan="2">45-64</th>
                    <th colspan="2">&gt;65</th>
                    <th rowspan="2">Baru</th>
                    <th rowspan="2">Lama</th>
                </tr>
                <tr>
                    <th>L</th>
                    <th>P</th>
                    <th>L</th>
                    <th>P</th>
                    <th>L</th>
                    <th>P</th>
                    <th>L</th>
                    <th>P</th>
                    <th>L</th>
                    <th>P</th>
                    <th>L</th>
                    <th>P</th>
                    <th>L</th>
                    <th>P</th>
                    <th>L</th>
                    <th>P</th>
                </tr>
            </thead>
            <tbody>
                @foreach ($data as $item)
                <tr>
                    <td>{{ $loop->iteration }}</td>
                    <td>{{ $item->no_rm }}</td>
                    <td>{{ $item->nama_pasien }}</td>
                    <td>{{ $item->poli ?? '-' }}</td>
                    
                    <!-- Age group 0-28h -->
                    <td>{{ ($item->usia == '0-28h' && $item->jk == 1) ? '✓' : '' }}</td>
                    <td>{{ ($item->usia == '0-28h' && $item->jk == 0) ? '✓' : '' }}</td>
                    
                    <!-- Age group <1 -->
                    <td>{{ ($item->usia < 1 && $item->usia != '0-28h' && $item->jk == 1) ? '✓' : '' }}</td>
                    <td>{{ ($item->usia < 1 && $item->usia != '0-28h' && $item->jk == 0) ? '✓' : '' }}</td>
                    
                    <!-- Age group 1-5 -->
                    <td>{{ ($item->usia >= 1 && $item->usia <= 5 && $item->jk == 1) ? '✓' : '' }}</td>
                    <td>{{ ($item->usia >= 1 && $item->usia <= 5 && $item->jk == 0) ? '✓' : '' }}</td>
                    
                    <!-- Age group 5-14 -->
                    <td>{{ ($item->usia > 5 && $item->usia <= 14 && $item->jk == 1) ? '✓' : '' }}</td>
                    <td>{{ ($item->usia > 5 && $item->usia <= 14 && $item->jk == 0) ? '✓' : '' }}</td>
                    
                    <!-- Age group 15-24 -->
                    <td>{{ ($item->usia >= 15 && $item->usia <= 24 && $item->jk == 1) ? '✓' : '' }}</td>
                    <td>{{ ($item->usia >= 15 && $item->usia <= 24 && $item->jk == 0) ? '✓' : '' }}</td>
                    
                    <!-- Age group 25-44 -->
                    <td>{{ ($item->usia >= 25 && $item->usia <= 44 && $item->jk == 1) ? '✓' : '' }}</td>
                    <td>{{ ($item->usia >= 25 && $item->usia <= 44 && $item->jk == 0) ? '✓' : '' }}</td>
                    
                    <!-- Age group 45-64 -->
                    <td>{{ ($item->usia >= 45 && $item->usia <= 64 && $item->jk == 1) ? '✓' : '' }}</td>
                    <td>{{ ($item->usia >= 45 && $item->usia <= 64 && $item->jk == 0) ? '✓' : '' }}</td>
                    
                    <!-- Age group >65 -->
                    <td>{{ ($item->usia > 65 && $item->jk == 1) ? '✓' : '' }}</td>
                    <td>{{ ($item->usia > 65 && $item->jk == 0) ? '✓' : '' }}</td>
                    <td>{{ $item->kode_icd9 ?? '-' }}</td>
                    <td>{{ $item->kode_icd10 }}</td>
                    <td>{{ $item->jenis_kunjungan == 1 ? '✓' : '' }}</td>
                    <td>{{ $item->jenis_kunjungan == 2 ? '✓' : '' }}</td>
                    <td>{{ $item->keterangan }}</td>
                </tr>
                @endforeach
                
                <!-- Add empty rows to fill the table -->
                @for ($i = count($data); $i < 20; $i++)
                <tr>
                    <td>&nbsp;</td>
                    <td>&nbsp;</td>
                    <td>&nbsp;</td>
                    <td>&nbsp;</td>
                    <td>&nbsp;</td>
                    <td>&nbsp;</td>
                    <td>&nbsp;</td>
                    <td>&nbsp;</td>
                    <td>&nbsp;</td>
                    <td>&nbsp;</td>
                    <td>&nbsp;</td>
                    <td>&nbsp;</td>
                    <td>&nbsp;</td>
                    <td>&nbsp;</td>
                    <td>&nbsp;</td>
                    <td>&nbsp;</td>
                    <td>&nbsp;</td>
                    <td>&nbsp;</td>
                    <td>&nbsp;</td>
                    <td>&nbsp;</td>
                    <td>&nbsp;</td>
                    <td>&nbsp;</td>
                    <td>&nbsp;</td>
                    <td>&nbsp;</td>
                    <td>&nbsp;</td>
                </tr>
                @endfor
            </tbody>
        </table>
        
        <div class="document-id">
            RMJINDEKS2-REV0-Lab.RM-02/22
        </div>
    </div>
</body>
</html>