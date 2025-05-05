@extends('layouts.app')

@section('content')
<div class="max-w-full mx-auto bg-gray-100 p-4 min-h-screen">
    <div class="bg-gray-100 p-4 rounded-lg">
        <div class="flex justify-between items-center mb-6">
            <h2 class="text-2xl font-bold text-gray-800">INDEKS RAWAT JALAN</h2>
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
        <form action="{{ route('indeksing.store') }}" id="form" method="POST" class="mb-6">
            @csrf
            <div class="grid grid-cols-1 md:grid-cols-2 gap-x-[2vw]">
                <!-- Kolom Kiri -->
                <div class="grid grid-cols-1 md:grid-cols-2 gap-4">
                    <div>
                        <label class="block text-sm font-medium text-gray-400 mb-1">No Reg</label>
                        <input type="text" name="no_reg" value="{{ $id }}" disabled placeholder="Masukkan Nomor RM" required class="border border-gray-400 p-2 rounded w-full bg-gray-400">
                    </div>
                    <div>
                        <label class="block text-sm font-medium text-gray-700 mb-1">No RM*</label>
                        <input type="text" name="no_rm" placeholder="Masukkan Nomor RM" required class="border border-gray-300 p-2 rounded w-full bg-white">
                    </div>
                    <div class="col-span-2">
                        <label class="block text-sm font-medium text-gray-700 mb-1">Nama Pasien*</label>
                        <input type="text" name="nama_pasien" placeholder="Masukkan Nama Pasien" required class="border border-gray-300 p-2 rounded w-full bg-white">
                    </div>
                    <div>
                        <label class="block text-sm font-medium text-gray-700 mb-1">Jenis Kelamin*</label>
                        <select name="jk" required class="border border-gray-300 p-2 rounded w-full bg-white appearance-none">
                            <option value="">Pilih Jenis Kelamin</option>
                            <option value="1">Laki-laki</option>
                            <option value="0">Perempuan</option>
                        </select>
                    </div>
                    <div>
                        <label class="block text-sm font-medium text-gray-700 mb-1">Usia*</label>
                        <input type="date" name="usia" placeholder="Masukkan Usia" required class="border border-gray-300 p-2 rounded w-full bg-white">
                    </div>
                    <div class="md:col-span-2">
                        <label class="block text-sm font-medium text-gray-700 mb-1">Alamat*</label>
                        <input type="text" name="alamat" placeholder="Masukkan Alamat" required class="border border-gray-300 p-2 rounded w-full bg-white">
                    </div>
                    <div class="md:col-span-2">
                        <label class="block text-sm font-medium text-gray-700 mb-1">Tanggal Kunjungan*</label>
                        <input type="date" name="tgl_kunjungan" required class="border border-gray-300 p-2 rounded w-full bg-white">
                    </div>
                </div>
        
                <!-- Kolom Kanan -->
                <div class="grid grid-cols-1 md:grid-cols-2 gap-4">
                    <div>
                        <label class="block text-sm font-medium text-gray-700 mb-1">Kode ICD 10 (Utama)</label>
                        <select name="icd10primary" required class="icd10Select border border-gray-300 p-2 rounded w-full bg-white appearance-none">
                            {{-- <option value="">Pilih Kode</option>
                         @foreach ($dataIcd10Primary as $item)
                         <option value="{{ $item->id }} ">{{ $item->kode }} - {{ $item->nama }}</option>
                         @endforeach --}}
                        </select>
                    </div>
                    <div>
                        <label class="block text-sm font-medium text-gray-700 mb-1">Kode ICD 10 (Sekunder)</label>
                        <select name="icd10secondary" class=" icd10Select border border-gray-300 p-2 rounded w-full bg-white appearance-none">
                            {{-- <option value="">Pilih Kode</option>
                         @foreach ($dataIcd10Primary as $item)
                         <option value="{{ $item->id }} ">{{ $item->kode }} - {{ $item->nama }}</option>
                         @endforeach --}}
                        </select>
                    </div>
                    <div class="col-span-2">
                        <label class="block text-sm font-medium text-gray-700 mb-1">Kode ICD 9 CM</label>
                        <select name="icd9" class="icd9Select border border-gray-300 p-2 rounded w-full bg-white appearance-none">
                            {{-- <option value="">Pilih Kode</option>
                         @foreach ($dataIcd9 as $item)
                         <option value="{{ $item->id }} ">{{ $item->kode }} - {{ $item->nama }}</option>
                         @endforeach --}}
                        </select>
                    </div>
                    <div>
                        <label class="block text-sm font-medium text-gray-700 mb-1">Dokter*</label>
                        <select name="id_dokter" required class="border border-gray-300 p-2 rounded w-full bg-white">
                            <option value="">Pilih Dokter</option>
                                @foreach ($dataDokter as $dokter)
                                <option value="{{ $dokter->id }}">{{ $dokter->nama }}</option>
                            @endforeach
                        </select>
                    </div>
                    <div>
                        <label class="block text-sm font-medium text-gray-700 mb-1">Poli*</label>
                        <select name="id_poli" required class="border border-gray-300 p-2 rounded w-full bg-white">
                            <option value="">Pilih Poli</option>
                                @foreach ($dataPoli as $poli) --}}
                                <option value="{{ $poli->id }}">{{ $poli->nama }}</option>
                            @endforeach 
                        </select>
                    </div>
                    <div>
                        <label class="block text-sm font-medium text-gray-700 mb-1">Jenis Kunjungan*</label>
                        <select name="jenis_kunjungan" required class="border border-gray-300 p-2 rounded w-full bg-white appearance-none">
                            <option value="">Pilih Jenis Kunjungan</option>
                            <option value="1">Baru</option>
                            <option value="2">Lama</option>
                        </select>
                    </div>
                    <div>
                        <label class="block text-sm font-medium text-gray-700 mb-1">Cara Keluar</label>
                        <select name="cara_keluar" required class="border border-gray-300 p-2 rounded w-full bg-white appearance-none">
                            <option value="">Pilih Cara Keluar</option>
                            <option value="2">Mati</option>
                            <option value="1">Hidup</option>
                        </select>
                    </div>
                    <div class="md:col-span-2">
                        <label class="block text-sm font-medium text-gray-700 mb-1">Keterangan</label>
                        <textarea name="keterangan" placeholder="Masukkan Keterangan" class="border border-gray-300 p-2 rounded w-full bg-white"></textarea>
                    </div>
                </div>
            </div>
            
            <div class="flex justify-center mt-6 space-x-4">
                
                <button type="reset" id="resetFormButton" class="bg-yellow-500 text-white px-6 py-2 rounded flex items-center">
                    <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5 mr-2" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4 4v5h.582m15.356 2A8.001 8.001 0 004.582 9m0 0H9m11 11v-5h-.581m0 0a8.003 8.003 0 01-15.357-2m15.357 2H15" />
                    </svg>
                    Reset
                </button>
                <button type="submit" class="bg-blue-500 text-white px-6 py-2 rounded flex items-center">
                    <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5 mr-2" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M8 7H5a2 2 0 00-2 2v9a2 2 0 002 2h14a2 2 0 002-2V9a2 2 0 00-2-2h-3m-1 4l-3 3m0 0l-3-3m3 3V4" />
                    </svg>
                    Simpan
                </button>
            </div>
        </form>
        

        <div class="bg-blue-600 text-white p-3 rounded-t-lg flex justify-between items-center">
            <span class="font-bold">Total: {{ $dataCount }}</span>
            <input type="text" placeholder="Search" class="border border-gray-300 p-2 rounded w-48 text-black">
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
                    @foreach ($data as $item )
                    <tr class="hover:bg-gray-50">
                        <td class="p-3 border-b">{{ $loop->iteration }}</td>
                        <td class="p-3 border-b">
                            <div class="flex items-center">
                                <span>{{ str_pad($item->no_rm, 6, '0', STR_PAD_LEFT) }}</span>
                                <svg xmlns="http://www.w3.org/2000/svg" class="h-4 w-4 ml-1 text-gray-500" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 9l-7 7-7-7" />
                                </svg>
                            </div>
                        </td>
                        <td class="p-3 border-b">{{ $item->nama_pasien }}</td>
                        <td class="p-3 border-b">{{ $item->tgl_kunjungan }}</td>
                        <td class="p-3 border-b">{{ $item->umur }}</td>
                        <td class="p-3 border-b">{{ $item->jk == 1 ? 'Laki-Laki' : 'Perempuan' }}</td>                      
                        <td class="p-3 border-b">{{ $item->jenis_kunjungan == 2 ? 'Lama' : 'Baru' }}</td>                      
                        <td class="p-3 border-b">{{ $item->nama_icd10p }}</td>
                        <td class="p-3 border-b">{{ $item->kode_icd10p }}</td>
                        <td class="p-3 border-b">{{ $item->cara_keluar == 1 ? 'Hidup' : 'Mati' }}</td>                      
                        <td class="p-3 border-b flex gap-2">
                                <button  data-keterangan="{{ $item->keterangan }}"  class="btn-show bg-blue-500 text-white px-4 py-1 rounded">Lihat</button>
                           @can('delete-indeks')
                                <form action="{{ route('indeksing.destroy', $item->id) }}" method="POST" class="inline">
                                @csrf
                                @method('DELETE')
                                <button type="submit" class="bg-red-500 text-white px-4 py-1 rounded" onclick="return confirm('Apakah Anda yakin ingin menghapus data ini?')">Hapus</button>
                            </form>
                            @endcan
                            @can('edit-indeks')
                            <a href="{{ route('indeksing.show',$item->id) }}" class="bg-yellow-500 text-white px-4 py-1 rounded">Edit</a>
                            @endcan
                        </td>
                    </tr>
                    @endforeach
                </tbody>
            </table>
        </div>
    </div>
</div>
    @include('modal-keterangan')
    @endsection

@section('css-custom')
<link href="https://cdn.jsdelivr.net/npm/select2@4.1.0-rc.0/dist/css/select2.min.css" rel="stylesheet" />
<script src="https://cdn.jsdelivr.net/npm/select2@4.1.0-rc.0/dist/js/select2.min.js"></script>
@endsection

@section('js-custom')
<script>
    $(document).ready(function() {
        $('#resetFormButton').on('click', function() {
            $('#form')[0].forformeset();
        });
        $('.btn-show').on('click', function () {
        let keterangan = $(this).data('keterangan');
        $('#isiKeterangan').text(keterangan);
        $('#modalKeterangan').removeClass('hidden').addClass('flex');
    });
    $('#closeModal').on('click', function() {
        $('#modalKeterangan').removeClass('flex').addClass('hidden');
    });

    // Klik luar modal juga menutup modal
    $('#modalKeterangan').on('click', function(e) {
        if ($(e.target).is('#modalKeterangan')) {
            $(this).removeClass('flex').addClass('hidden');
        }
    });
    $(document).ready(function() {
        $('.icd9Select').select2({
            ajax: {
                url: '{{ route("search.icd", ["number" => 9]) }}', 
                dataType: 'json',
                type: 'GET',  
                delay: 250,  
                data: function (params) {
                    return {
                        query: params.term
                    };
                },
                processResults: function (data) {
                    const results = data.data.map(item => {
                        return {
                            id: item.id,
                            text: `${item.kode} - ${item.nama}`
                        };
                    });

                    return {
                        results: results 
                    };
                },
                cache: true 
            },
            placeholder: 'Pilih ICD 9 CM',
            minimumInputLength: 1,
            allowClear: true 
        });

        $('.icd10Select').select2({
            ajax: {
                url: '{{ route("search.icd", ["number" => 10]) }}', 
                dataType: 'json',
                type: 'GET',  
                delay: 250,  
                data: function (params) {
                    return {
                        query: params.term
                    };
                },
                processResults: function (data) {
                    const results = data.data.map(item => {
                        return {
                            id: item.id,
                            text: `${item.kode} - ${item.nama}`
                        };
                    });

                    return {
                        results: results 
                    };
                },
                cache: true 
            },
            placeholder: 'Pilih ICD 10',
            minimumInputLength: 1,
            allowClear: true 
        });
    });
    });

</script>
@endsection



