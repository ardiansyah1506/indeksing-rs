@extends('layouts.app')

@section('content')
<div class="container mx-auto p-4">
    <h1 class="text-2xl font-bold mb-4">Data ICD10 Secondary</h1>

    {{-- Alpine.js untuk toggle edit mode --}}
    <div x-data="{ editMode: false, editData: { id: '', nama: '', kode: '' } }">

        {{-- Form Create & Edit --}}
        <div class="bg-white p-4 rounded-lg shadow-md mb-6">
            <h2 x-text="editMode ? 'Edit Data ICD10 Secondary' : 'Tambah Data ICD10 Secondary'" class="text-xl font-semibold mb-4"></h2>

            <form :action="editMode ? `/icd10_secondary/${editData.id}` : '{{ route('icd10_secondary.store') }}'" method="POST" class="space-y-4">
                @csrf
                <template x-if="editMode">
                    <input type="hidden" name="_method" value="PUT">
                </template>

                <div>
                    <label class="block font-medium">Nama</label>
                    <input type="text" name="nama" class="w-full border px-2 py-1 rounded" x-model="editData.nama" required>
                </div>

                <div>
                    <label class="block font-medium">Kode</label>
                    <input type="text" name="kode" class="w-full border px-2 py-1 rounded" x-model="editData.kode" required>
                </div>

                <div class="flex space-x-2">
                    <button type="submit" class="bg-green-500 text-white px-4 py-2 rounded" x-text="editMode ? 'Update' : 'Simpan'"></button>
                    <button type="button" @click="editMode = false; editData = { id: '', nama: '', kode: '' }" class="bg-gray-500 text-white px-4 py-2 rounded" x-show="editMode">Batal</button>
                </div>
            </form>
        </div>

        {{-- Table Data --}}
        <table class="min-w-full bg-white border mt-4">
            <thead>
                <tr class="w-full bg-gray-200">
                    <th class="border px-4 py-2">ID</th>
                    <th class="border px-4 py-2">Nama</th>
                    <th class="border px-4 py-2">Kode</th>
                    <th class="border px-4 py-2">Aksi</th>
                </tr>
            </thead>
            <tbody>
                @foreach($data as $item)
                <tr>
                    <td class="border px-4 py-2">{{ $item->id }}</td>
                    <td class="border px-4 py-2">{{ $item->nama }}</td>
                    <td class="border px-4 py-2">{{ $item->kode }}</td>
                    <td class="border px-4 py-2">
                        <button @click="editMode = true; editData = { id: '{{ $item->id }}', nama: '{{ $item->nama }}', kode: '{{ $item->kode }}' }"
                            class="bg-yellow-500 text-white px-2 py-1 rounded">Edit</button>
                        <form action="{{ route('icd10_secondary.destroy', $item->id) }}" method="POST" class="inline">
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
