@extends('layouts.app')

@section('content')
<div class="mb-6">
    <div class="flex items-center justify-between mb-4">
        <h2 class="text-2xl font-bold text-gray-800">Role Management</h2>
        @can('role-create')
            <a href="{{ route('roles.create') }}" class="bg-green-500 hover:bg-green-600 text-white px-4 py-2 rounded text-sm flex items-center gap-2">
                <i class="fa fa-plus"></i> Create New Role
            </a>
        @endcan
    </div>

    @session('success')
        <div class="bg-green-100 text-green-800 px-4 py-2 rounded mb-4">
            {{ $value }}
        </div>
    @endsession

    <div class="overflow-x-auto">
        <table class="min-w-full bg-white shadow rounded border border-gray-200">
            <thead class="bg-gray-100 text-gray-700">
                <tr>
                    <th class="px-4 py-2 text-left w-24">No</th>
                    <th class="px-4 py-2 text-left">Name</th>
                    <th class="px-4 py-2 text-left w-72">Action</th>
                </tr>
            </thead>
            <tbody class="divide-y divide-gray-200 text-gray-700">
                @foreach ($roles as $key => $role)
                    <tr>
                        <td class="px-4 py-2">{{ ++$i }}</td>
                        <td class="px-4 py-2">{{ $role->name }}</td>
                        <td class="px-4 py-2 flex flex-wrap gap-2">
                            <a href="{{ route('roles.show',$role->id) }}" class="bg-blue-500 hover:bg-blue-600 text-white px-3 py-1 rounded text-sm">
                                <i class="fa-solid fa-list"></i> Show
                            </a>
                            @can('role-edit')
                                <a href="{{ route('roles.edit',$role->id) }}" class="bg-yellow-500 hover:bg-yellow-600 text-white px-3 py-1 rounded text-sm">
                                    <i class="fa-solid fa-pen-to-square"></i> Edit
                                </a>
                            @endcan

                            @can('role-delete')
                                <form action="{{ route('roles.destroy', $role->id) }}" method="POST" onsubmit="return confirm('Are you sure?')">
                                    @csrf
                                    @method('DELETE')
                                    <button type="submit" class="bg-red-500 hover:bg-red-600 text-white px-3 py-1 rounded text-sm">
                                        <i class="fa-solid fa-trash"></i> Delete
                                    </button>
                                </form>
                            @endcan
                        </td>
                    </tr>
                @endforeach
            </tbody>
        </table>
    </div>

    <div class="mt-4">
        {!! $roles->links('pagination::bootstrap-5') !!}
    </div>

   
</div>
@endsection
