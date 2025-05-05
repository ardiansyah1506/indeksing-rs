@extends('layouts.app')
@section('css-custom')
    @endsection

@section('content')
    <div class="max-w-full mx-auto bg-gray-100 p-4 min-h-screen">
        <div class="bg-gray-100 p-4 rounded-lg">
            <div class="flex justify-between items-center mb-6">
                <h2 class="text-2xl font-bold text-gray-800">INDEKS TINDAKAN</h2>
                <div class="flex items-center">
                    <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5 mr-2 text-gray-600" fill="none"
                        viewBox="0 0 24 24" stroke="currentColor">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                            d="M8 7V3m8 4V3m-9 8h10M5 21h14a2 2 0 002-2V7a2 2 0 00-2-2H5a2 2 0 00-2 2v12a2 2 0 002 2z" />
                    </svg>
                    <span class="text-gray-600">Periode Rawat Jalan</span>
                </div>
            </div>
            <form action="{{ route('penyakit.index') }}" id="form" method="GET">
                @csrf
                <div class="grid grid-cols-1 md:grid-cols-2 gap-x-[4vw] justify-center items-center">
                    <div>
                        <label class="block text-sm font-medium text-gray-700 mb-1">Jenis Kunjungan*</label>
                        <select name="jenis_kunjungan" required
                            class="border border-gray-300 p-2 rounded w-full bg-white appearance-none">
                            <option value="" disabled selected>Pilih Jenis Kunjungan</option>
                            <option value="">Pilih Semua Kunjungan</option>
                            <option value="2">Lama</option>
                            <option value="1">Baru</option>
                        </select>
                    </div>
                    <div>
                        <label class="block text-sm font-medium text-gray-700 mb-1">Tanggal Awal*</label>
                        <input type="date" name="tgl_awal" required
                            class="border border-gray-300 p-2 rounded w-full bg-white">
                    </div>
                    <div>
                        <label class="block text-sm font-medium text-gray-700 mb-1">Nama Tindakan / Kode*</label>
                        <input type="text" name="tindakan" required
                            class="border border-gray-300 p-2 rounded w-full bg-white">
                    </div>
                    <div>
                        <label class="block text-sm font-medium text-gray-700 mb-1">Tanggal Akhir*</label>
                        <input type="date" name="tgl_akhir" required
                            class="border border-gray-300 p-2 rounded w-full bg-white">
                    </div>
                </div>

                <div class="flex justify-center mt-6 space-x-4 mb-10">
                    <button type="reset" id="resetFormButton"
                        class="bg-yellow-500 text-white px-6 py-2 rounded flex items-center">Reset</button>
                    <button type="submit"
                        class="bg-blue-500 text-white px-6 py-2 rounded flex items-center">Search</button>
                </div>
            </form>



            <div class="bg-blue-600 text-white p-3 rounded-t-lg flex justify-between items-center">
                <span class="font-bold">Total: {{ $dataCount }}</span>
                @can('cetak-indeks')
                <button id="printPdfBtn" class="bg-blue-600 text-white font-bold px-6 py-2 rounded flex items-center">
                    <svg xmlns="http://www.w3.org/2000/svg" class="h-6 w-6 mr-2 text-white" viewBox="0 0 24 24" fill="currentColor">
                        <path d="M6 2a1 1 0 00-1 1v5H4a2 2 0 00-2 2v7a2 2 0 002 2h2v3a1 1 0 001 1h10a1 1 0 001-1v-3h2a2 2 0 002-2v-7a2 2 0 00-2-2h-1V3a1 1 0 00-1-1H6zm1 2h10v4H7V4zm10 16H7v-5h10v5zm-3-2H10v-1h4v1z"/>
                      </svg>
                    Cetak
                </button>
                @endcan
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
                            <th class="p-3 border-b">Tindakan</th>
                            <th class="p-3 border-b">Kode ICD</th>
                            <th class="p-3 border-b">Cara Keluar</th>
                            <th class="p-3 border-b">Keterangan</th>
                        </tr>
                    </thead>
                    <tbody>
                        @forelse ($data as $item)
                            <tr class="hover:bg-gray-50">
                                <td class="p-3 border-b">{{ $loop->iteration }}</td>
                                <td class="p-3 border-b">
                                    <div class="flex items-center">
                                        <span>{{ str_pad($item->no_rm, 6, '0', STR_PAD_LEFT) }}</span>
                                        <svg xmlns="http://www.w3.org/2000/svg" class="h-4 w-4 ml-1 text-gray-500"
                                            fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                                d="M19 9l-7 7-7-7" />
                                        </svg>
                                    </div>
                                </td>
                                <td class="p-3 border-b">{{ $item->nama_pasien }}</td>
                                <td class="p-3 border-b">{{ $item->tgl_kunjungan }}</td>
                                <td class="p-3 border-b">{{ $item->umur }}</td>
                                <td class="p-3 border-b">{{ $item->jk == 1 ? 'Laki-Laki' : 'Perempuan' }}</td>
                                <td class="p-3 border-b">{{ $item->jenis_kunjungan == 1 ? 'Lama' : 'Baru' }}</td>
                                <td class="p-3 border-b">{{ $item->diagnosa }}</td>
                                <td class="p-3 border-b">{{ $item->kode }}</td>
                                <td class="p-3 border-b">{{ $item->cara_keluar == 1 ? 'Hidup' : 'Mati' }}</td>
                                <td class="p-3 border-b" data-keterangan="{{ $item->keterangan }}">
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
                            <input type="date" name="tgl_kunjungan" id="edit_tgl_kunjungan"
                                class="border p-2 rounded w-full">
                        </div>
                    </div>
                    <div class="flex justify-end gap-2">
                        <button type="button" onclick="closeModal()"
                            class="bg-gray-500 text-white px-4 py-2 rounded">Batal</button>
                        <button type="submit" class="bg-green-500 text-white px-4 py-2 rounded">Simpan</button>
                    </div>
                </form>
            </div>
        </div>
    </div>

    @include('modal-keterangan')
@endsection
@section('js-custom')
<script>
    $(document).ready(function() {
        $('#resetFormButton').on('click', function() {
            $('#form')[0].forformeset();
        });
        $('table').on('click', 'button', function() {
            let keterangan = $(this).closest('td').data('keterangan');
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
        $('#printPdfBtn').on('click', function(e) {
            e.preventDefault();
            // console.log('test')
            // Ambil data dari form
            var jenis_kunjungan = $('select[name="jenis_kunjungan"]').val();
            var tgl_awal = $('input[name="tgl_awal"]').val();
            var tgl_akhir = $('input[name="tgl_akhir"]').val();
            var tindakan = $('input[name="tindakan"]').val();

            // Bangun query string untuk URL cetak PDF
            var queryString = $.param({
                jenis_kunjungan: jenis_kunjungan,
                tgl_awal: tgl_awal,
                tgl_akhir: tgl_akhir,
                tindakan: tindakan
            });
            window.open('/indeksing-tindakan/pdf?' + queryString, '_blank');
        });
    });
</script>
@endsection
