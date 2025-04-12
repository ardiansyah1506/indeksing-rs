@extends('layouts.app')
@section('css-custom')
<script src="https://code.jquery.com/jquery-3.6.4.min.js"></script>

<!-- Load Plugin printThis -->

@endsection

@section('content')
<div class="max-w-full mx-auto bg-gray-100 p-4 min-h-screen">
    <div class="bg-gray-100 p-4 rounded-lg">
        <div class="flex justify-between items-center mb-6">
            <h2 class="text-2xl font-bold text-gray-800">INDEKS DOKTER</h2>
            <div class="flex items-center">
                <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5 mr-2 text-gray-600" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M8 7V3m8 4V3m-9 8h10M5 21h14a2 2 0 002-2V7a2 2 0 00-2-2H5a2 2 0 00-2 2v12a2 2 0 002 2z" />
                </svg>
                <span class="text-gray-600">Periode Rawat Jalan</span>
            </div>
        </div>
        <form action="{{ route('indeksing-dokter.index') }}" method="GET">
            @csrf
            <div class="grid grid-cols-1 md:grid-cols-2 gap-x-[4vw] justify-center items-center">
                <div>
                    <label class="block text-sm font-medium text-gray-700 mb-1">Nama Dokter*</label>
                    <select name="id_dokter" required class="border border-gray-300 p-2 rounded w-full bg-white">
                        <option value="">Pilih Dokter</option>
                        @foreach ($dokter as $dokters)
                            <option value="{{ $dokters->id }}" {{ request('id_dokter') == $dokters->id ? 'selected' : '' }}>
                                {{ $dokters->nama }}
                            </option>
                        @endforeach
                    </select>
                    
                </div>
                <div>
                    <label class="block text-sm font-medium text-gray-700 mb-1">Tanggal Awal*</label>
                    <input type="date" name="tgl_awal" required class="border border-gray-300 p-2 rounded w-full bg-white"
                    value="{{ request('tgl_awal') }}">
                </div>
                <div>
                    <label class="block text-sm font-medium text-gray-700 mb-1">Tanggal Akhir*</label>
                   
<input type="date" name="tgl_akhir" required class="border border-gray-300 p-2 rounded w-full bg-white"
value="{{ request('tgl_akhir') }}">
                </div>
            </div>
        
            <div class="flex justify-center mt-6 space-x-4 mb-10">
                <button type="reset" class="bg-yellow-500 text-white px-6 py-2 rounded flex items-center">Reset</button>
                <button type="submit" class="bg-blue-500 text-white px-6 py-2 rounded flex items-center">Search</button>
            </div>
        </form>
        
        

        <div class="bg-blue-600 text-white p-3 rounded-t-lg flex justify-between items-center">
            <span class="font-bold">Total: {{ $dataCount }}</span>
            <a href="/pdf" class="bg-blue-600 text-white font-bold px-6 py-2 rounded flex items-center">
                <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5 mr-2" width="100" height="100" viewBox="0,0,256,256">
                    <g fill="#fffefe" fill-rule="nonzero" stroke="none" stroke-width="1" stroke-linecap="butt" stroke-linejoin="miter" stroke-miterlimit="10" stroke-dasharray="" stroke-dashoffset="0" font-family="none" font-weight="none" font-size="none" text-anchor="none" style="mix-blend-mode: normal">
                        <g transform="scale(5.12,5.12)">
                            <path d="M21,3c-9.37891,0 -17,7.62109 -17,17c0,9.37891 7.62109,17 17,17c3.71094,0 7.14063,-1.19531 9.9375,-3.21875l13.15625,13.125l2.8125,-2.8125l-13,-13.03125c2.55469,-2.97656 4.09375,-6.83984 4.09375,-11.0625c0,-9.37891 -7.62109,-17 -17,-17zM21,5c8.29688,0 15,6.70313 15,15c0,8.29688 -6.70312,15 -15,15c-8.29687,0 -15,-6.70312 -15,-15c0,-8.29687 6.70313,-15 15,-15z"></path>
                        </g>
                    </g>
                </svg>
                Cetak
            </a>
        </div>

        <div class="overflow-x-auto bg-white rounded-b-lg">
            <table class="w-full">
                <thead>
                    <tr class="bg-gray-100 text-left">
                        <th class="p-3 border-b">No</th>
                        <th class="p-3 border-b">No. RM</th>
                        <th class="p-3 border-b">Nama</th>
                        <th class="p-3 border-b">Tgl Kunjungan</th>
                        <th class="p-3 border-b">Umur</th>
                        <th class="p-3 border-b">Jenis Kelamin</th>
                        <th class="p-3 border-b">Jenis Kunjungan</th>
                        <th class="p-3 border-b">Diagnosa</th>
                        <th class="p-3 border-b">Kode ICD</th>
                        <th class="p-3 border-b">Cara Keluar</th>
                        <th class="p-3 border-b">Keterangan</th>
                    </tr>
                </thead>
                <tbody>
                    @forelse ($data as $item )
                    <tr class="hover:bg-gray-50">
                        <td class="p-3 border-b">{{ $loop->iteration }}</td>
                        <td class="p-3 border-b">
                            <div class="flex items-center">
                                <span>{{ $item->no_rm }}</span>
                                <svg xmlns="http://www.w3.org/2000/svg" class="h-4 w-4 ml-1 text-gray-500" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 9l-7 7-7-7" />
                                </svg>
                            </div>
                        </td>
                        <td class="p-3 border-b">{{ $item->nama_pasien }}</td>
                        <td class="p-3 border-b">{{ $item->tgl_kunjungan }}</td>
                        <td class="p-3 border-b">{{ $item->usia }}</td>
                        <td class="p-3 border-b">{{ $item->jk == 1 ? 'Laki-Laki' : 'Perempuan' }}</td>                      
                        <td class="p-3 border-b">{{ $item->jenis_kunjungan == 1 ? 'Lama' : 'Baru' }}</td>                      
                        <td class="p-3 border-b">{{ $item->icd10primary }}</td>
                        <td class="p-3 border-b">{{ $item->icd10secondary }}</td>
                        <td class="p-3 border-b">{{ $item->cara_keluar == 1 ? 'Hidup' : 'Mati' }}</td>                      
                        <td class="p-3 border-b">
                            <button class="bg-blue-500 text-white px-4 py-1 rounded">Lihat</button>
                        </td>
                    </tr>
                    @empty
    <tr>
        <td colspan="5">Tidak ada data ditemukan.</td>
    </tr>
                    @endforelse 
                </tbody>
            </table>
        </div>
    </div>

    <!-- Form Edit -->
    <div id="editModal" class="hidden fixed inset-0 bg-gray-800 bg-opacity-50 flex items-center justify-center z-50">
        <div class="bg-white p-6 rounded-lg shadow-md max-w-2xl w-full">
            <h2 class="text-lg font-bold mb-4">Edit Data</h2>
            <form id="editForm" method="POST">
                @csrf
                @method('PUT')
                <input type="hidden" name="id" id="edit_id">
                <div class="grid grid-cols-1 md:grid-cols-2 gap-4 mb-4">
                    <div>
                        <label class="block text-sm font-medium text-gray-700 mb-1">Nama Pasien</label>
                        <input type="text" name="nama_pasien" id="edit_nama" class="border p-2 rounded w-full">
                    </div>
                    <div>
                        <label class="block text-sm font-medium text-gray-700 mb-1">Usia</label>
                        <input type="text" name="usia" id="edit_usia" class="border p-2 rounded w-full">
                    </div>
                    <div class="md:col-span-2">
                        <label class="block text-sm font-medium text-gray-700 mb-1">Alamat</label>
                        <input type="text" name="alamat" id="edit_alamat" class="border p-2 rounded w-full">
                    </div>
                    <div>
                        <label class="block text-sm font-medium text-gray-700 mb-1">Tanggal Kunjungan</label>
                        <input type="date" name="tgl_kunjungan" id="edit_tgl_kunjungan" class="border p-2 rounded w-full">
                    </div>
                </div>
                <div class="flex justify-end gap-2">
                    <button type="button" onclick="closeModal()" class="bg-gray-500 text-white px-4 py-2 rounded">Batal</button>
                    <button type="submit" class="bg-green-500 text-white px-4 py-2 rounded">Simpan</button>
                </div>
            </form>
        </div>
    </div>
</div>

@endsection


