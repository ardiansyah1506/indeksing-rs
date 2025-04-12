@extends('layouts.app')

@section('content')
<div class="container mx-auto p-4">
    <h1 class="text-2xl font-bold mb-4">Data Dokter</h1>

    {{-- Alpine.js untuk toggle edit mode --}}
    <div x-data="{ editMode: false, editData: { id: '', nama: ''} }">

        {{-- Form Create & Edit --}}
        <div class="bg-white p-4 rounded-lg shadow-md mb-6">
            <h2 x-text="editMode ? 'Edit Data Dokter' : 'Tambah Data Dokter'" class="text-xl font-semibold mb-4"></h2>

            <form :action="editMode ? `/dokter/${editData.id}` : '{{ route('dokter.store') }}'" method="POST" class="space-y-4">
                @csrf
                <template x-if="editMode">
                    <input type="hidden" name="_method" value="PUT">
                </template>

                <div>
                    <label class="block font-medium">Nama</label>
                    <input type="text" name="nama" class="w-full border px-2 py-1 rounded" x-model="editData.nama" required>
                </div>

               

                <div class="flex space-x-2">
                    <button type="submit" class="bg-green-500 text-white px-4 py-2 rounded" x-text="editMode ? 'Update' : 'Simpan'"></button>
                    <button type="button" @click="editMode = false; editData = { id: '', nama: '' }" class="bg-gray-500 text-white px-4 py-2 rounded" x-show="editMode">Batal</button>
                </div>
            </form>
        </div>

        {{-- Table Data --}}
        <table class="min-w-full bg-white border mt-4">
            <thead>
                <tr class="w-full bg-gray-200">
                    <th class="border px-4 py-2">ID</th>
                    <th class="border px-4 py-2">Nama</th>
                    <th class="border px-4 py-2">Aksi</th>
                </tr>
            </thead>
            <tbody>
                @foreach($data as $item)
                <tr>
                    <td class="border px-4 py-2">{{ $item->id }}</td>
                    <td class="border px-4 py-2">{{ $item->nama }}</td>
                    <td class="border px-4 py-2">
                        <button @click="editMode = true; editData = { id: '{{ $item->id }}', nama: '{{ $item->nama }}'}"
                            class="bg-yellow-500 text-white px-2 py-1 rounded">Edit</button>
                        <form action="{{ route('dokter.destroy', $item->id) }}" method="POST" class="inline">
                            @csrf
                            @method('DELETE')
                            <button type="submit" class="bg-red-500 text-white px-2 py-1 rounded" onclick="return confirm('Yakin ingin menghapus?')">Hapus</button>
                        </form>
                    </td>
                </tr>
                @endforeach
            </tbody>
        </table>
    </div>
</div>
@endsection
