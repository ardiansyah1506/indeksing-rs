@extends('layouts.app')

@section('content')
<div class="max-w-full mx-auto bg-gray-100 p-4 min-h-screen">
    <div class="bg-gray-100 p-4 rounded-lg">
        <div class="flex justify-between items-center mb-6">
            <h2 class="text-2xl font-bold text-gray-800">EDIT INDEKS RAWAT JALAN</h2>
            <div class="flex items-center">
                <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5 mr-2 text-gray-600" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M8 7V3m8 4V3m-9 8h10M5 21h14a2 2 0 002-2V7a2 2 0 00-2-2H5a2 2 0 00-2 2v12a2 2 0 002 2z" />
                </svg>
                <span class="text-gray-600">Periode Rawat Jalan</span>
            </div>
        </div>

        @if(session('success'))
            <div class="bg-green-200 text-green-800 p-3 rounded mb-4">
                {{ session('success') }}
            </div>
        @endif
        <form action="{{ route('indeksing.update', $data->id) }}" method="POST" class="mb-6" id="editForm">
            @csrf
            @method('PUT')
            <div class="grid grid-cols-1 md:grid-cols-2 gap-x-[2vw]">
                <!-- Kolom Kiri -->
                <div class="grid grid-cols-1 md:grid-cols-2 gap-4">
                    <div>
                        <label class="block text-sm font-medium text-gray-400 mb-1">No Reg</label>
                        <input type="text" name="no_reg" value="{{ $data->no_reg }}" disabled placeholder="Masukkan Nomor RM" required class="border border-gray-400 p-2 rounded w-full bg-gray-400">
                    </div>
                    <div>
                        <label class="block text-sm font-medium text-gray-700 mb-1">No RM*</label>
                        <input type="text" name="no_rm" value="{{ $data->no_rm }}" placeholder="Masukkan Nomor RM" required class="border border-gray-300 p-2 rounded w-full bg-white">
                    </div>
                    <div class="col-span-2">
                        <label class="block text-sm font-medium text-gray-700 mb-1">Nama Pasien*</label>
                        <input type="text" name="nama_pasien" value="{{ $data->nama_pasien }}" placeholder="Masukkan Nama Pasien" required class="border border-gray-300 p-2 rounded w-full bg-white">
                    </div>
                    <div>
                        <label class="block text-sm font-medium text-gray-700 mb-1">Jenis Kelamin*</label>
                        <select name="jk" required class="border border-gray-300 p-2 rounded w-full bg-white appearance-none">
                            <option value="">Pilih Jenis Kelamin</option>
                            <option value="1" {{ $data->jk == 1 ? 'selected' : '' }}>Laki-laki</option>
                            <option value="0" {{ $data->jk == 0 ? 'selected' : '' }}>Perempuan</option>
                        </select>
                    </div>
                    <div>
                        <label class="block text-sm font-medium text-gray-700 mb-1">Usia*</label>
                        <input type="date" name="usia" value="{{ $data->usia }}" placeholder="Masukkan Usia" required class="border border-gray-300 p-2 rounded w-full bg-white">
                    </div>
                    <div class="md:col-span-2">
                        <label class="block text-sm font-medium text-gray-700 mb-1">Alamat*</label>
                        <input type="text" name="alamat" value="{{ $data->alamat }}" placeholder="Masukkan Alamat" required class="border border-gray-300 p-2 rounded w-full bg-white">
                    </div>
                    <div class="md:col-span-2">
                        <label class="block text-sm font-medium text-gray-700 mb-1">Tanggal Kunjungan*</label>
                        <input type="date" name="tgl_kunjungan" value="{{ $data->tgl_kunjungan }}" required class="border border-gray-300 p-2 rounded w-full bg-white">
                    </div>
                </div>
        
                <!-- Kolom Kanan -->
                <div class="grid grid-cols-1 md:grid-cols-2 gap-4">
                    <div>
                        <label class="block text-sm font-medium text-gray-700 mb-1">Kode ICD 10 (Utama)</label>
                        <select name="icd10primary" required class="border border-gray-300 p-2 rounded w-full bg-white appearance-none">
                            <option value="">Pilih Kode</option>
                         @foreach ($dataIcd10Primary as $item)
                         <option value="{{ $item->id }}" {{ $data->icd10primary == $item->id ? 'selected' : '' }}>{{ $item->kode }} - {{ $item->nama }}</option>
                         @endforeach
                        </select>
                    </div>
                    <div>
                        <label class="block text-sm font-medium text-gray-700 mb-1">Kode ICD 10 (Sekunder)</label>
                        <select name="icd10secondary" class="border border-gray-300 p-2 rounded w-full bg-white appearance-none">
                            <option value="">Pilih Kode</option>
                         @foreach ($dataIcd10Secondary as $item)
                         <option value="{{ $item->id }}" {{ $data->icd10secondary == $item->id ? 'selected' : '' }}>{{ $item->kode }} - {{ $item->nama }}</option>
                         @endforeach
                        </select>
                    </div>
                    <div class="col-span-2">
                        <label class="block text-sm font-medium text-gray-700 mb-1">Kode ICD 9 CM</label>
                        <select name="icd9" required class="border border-gray-300 p-2 rounded w-full bg-white appearance-none">
                            <option value="">Pilih Kode</option>
                         @foreach ($dataIcd9 as $item)
                         <option value="{{ $item->id }}" {{ $data->icd9 == $item->id ? 'selected' : '' }}>{{ $item->kode }} - {{ $item->nama }}</option>
                         @endforeach
                        </select>
                    </div>
                    <div>
                        <label class="block text-sm font-medium text-gray-700 mb-1">Dokter*</label>
                        <select name="id_dokter" required class="border border-gray-300 p-2 rounded w-full bg-white">
                            <option value="">Pilih Dokter</option>
                                @foreach ($dataDokter as $dokter)
                                <option value="{{ $dokter->id }}" {{ $data->id_dokter == $dokter->id ? 'selected' : '' }}>{{ $dokter->nama }}</option>
                            @endforeach
                        </select>
                    </div>
                    <div>
                        <label class="block text-sm font-medium text-gray-700 mb-1">Poli*</label>
                        <select name="id_poli" required class="border border-gray-300 p-2 rounded w-full bg-white">
                            <option value="">Pilih Poli</option>
                                @foreach ($dataPoli as $poli)
                                <option value="{{ $poli->id }}" {{ $data->id_poli == $poli->id ? 'selected' : '' }}>{{ $poli->nama }}</option>
                            @endforeach 
                        </select>
                    </div>
                    <div>
                        <label class="block text-sm font-medium text-gray-700 mb-1">Jenis Kunjungan*</label>
                        <select name="jenis_kunjungan" required class="border border-gray-300 p-2 rounded w-full bg-white appearance-none">
                            <option value="">Pilih Jenis Kunjungan</option>
                            <option value="1" {{ $data->jenis_kunjungan == 1 ? 'selected' : '' }}>Baru</option>
                            <option value="2" {{ $data->jenis_kunjungan == 2 ? 'selected' : '' }}>Lama</option>
                        </select>
                    </div>
                    <div>
                        <label class="block text-sm font-medium text-gray-700 mb-1">Cara Keluar</label>
                        <select name="cara_keluar" required class="border border-gray-300 p-2 rounded w-full bg-white appearance-none">
                            <option value="">Pilih Cara Keluar</option>
                            <option value="2" {{ $data->cara_keluar == 2 ? 'selected' : '' }}>Mati</option>
                            <option value="1" {{ $data->cara_keluar == 1 ? 'selected' : '' }}>Hidup</option>
                        </select>
                    </div>
                    <div class="md:col-span-2">
                        <label class="block text-sm font-medium text-gray-700 mb-1">Keterangan</label>
                        <textarea name="keterangan" placeholder="Masukkan Keterangan" class="border border-gray-300 p-2 rounded w-full bg-white">{{ $data->keterangan }}</textarea>
                    </div>
                </div>
            </div>
            
            <div class="flex justify-center mt-6 space-x-4">
                <button type="button" id="resetForm" class="bg-yellow-500 text-white px-6 py-2 rounded flex items-center">
                    <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5 mr-2" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4 4v5h.582m15.356 2A8.001 8.001 0 004.582 9m0 0H9m11 11v-5h-.581m0 0a8.003 8.003 0 01-15.357-2m15.357 2H15" />
                    </svg>
                    Reset
                </button>
                <button type="submit" class="bg-blue-500 text-white px-6 py-2 rounded flex items-center">
                    <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5 mr-2" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M8 7H5a2 2 0 00-2 2v9a2 2 0 002 2h14a2 2 0 002-2V9a2 2 0 00-2-2h-3m-1 4l-3 3m0 0l-3-3m3 3V4" />
                    </svg>
                    Update
                </button>
                <a href="{{ route('indeksing.index') }}" class="bg-gray-500 text-white px-6 py-2 rounded flex items-center">
                    <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5 mr-2" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M11 19l-7-7 7-7m8 14l-7-7 7-7" />
                    </svg>
                    Kembali
                </a>
            </div>
        </form>
    </div>
</div>
@endsection

@section('js-custom')
<script>
    $(document).ready(function() {
        // Reset form dengan jQuery
        $('#resetForm').on('click', function() {
            $('#editForm')[0].reset();
        });
    });
</script>
@endsection