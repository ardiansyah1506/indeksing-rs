@extends('layouts.app')

@section('content')
<div class="mb-6">
    <div class="flex items-center justify-between mb-4">
        <h2 class="text-2xl font-bold text-gray-800">Users Management</h2>
        <a href="{{ route('users.create') }}" class="inline-flex items-center bg-green-600 hover:bg-green-700 text-white px-4 py-2 rounded text-sm shadow">
            <i class="fa fa-plus mr-2"></i> Create New User
        </a>
    </div>

    @session('success')
        <div class="bg-green-100 border border-green-400 text-green-700 px-4 py-3 rounded mb-4" role="alert">
            {{ $value }}
        </div>
    @endsession

    <div class="overflow-x-auto">
        <table class="min-w-full bg-white border border-gray-200 rounded shadow">
            <thead class="bg-gray-100 text-gray-700 text-sm">
                <tr>
                    <th class="px-4 py-2 border">No</th>
                    <th class="px-4 py-2 border">Name</th>
                    <th class="px-4 py-2 border">Email</th>
                    <th class="px-4 py-2 border">Roles</th>
                    <th class="px-4 py-2 border" width="280px">Action</th>
                </tr>
            </thead>
            <tbody class="text-sm text-gray-700">
                @foreach ($data as $key => $user)
                <tr class="border-t">
                    <td class="px-4 py-2 border">{{ ++$i }}</td>
                    <td class="px-4 py-2 border">{{ $user->name }}</td>
                    <td class="px-4 py-2 border">{{ $user->email }}</td>
                    <td class="px-4 py-2 border">
                        @if(!empty($user->getRoleNames()))
                            <div class="flex flex-wrap gap-1">
                                @foreach($user->getRoleNames() as $v)
                                    <span class="bg-green-100 text-green-800 text-xs font-semibold px-2.5 py-0.5 rounded">
                                        {{ $v }}
                                    </span>
                                @endforeach
                            </div>
                        @endif
                    </td>
                    <td class="px-4 py-2 border space-x-1">
                        <a href="{{ route('users.show',$user->id) }}" class="bg-blue-500 hover:bg-blue-600 text-white px-3 py-1 rounded text-xs">
                            <i class="fa-solid fa-list mr-1"></i> Show
                        </a>
                        <a href="{{ route('users.edit',$user->id) }}" class="bg-indigo-500 hover:bg-indigo-600 text-white px-3 py-1 rounded text-xs">
                            <i class="fa-solid fa-pen-to-square mr-1"></i> Edit
                        </a>
                        <form action="{{ route('users.destroy', $user->id) }}" method="POST" class="inline-block" onsubmit="return confirm('Are you sure?')">
                            @csrf
                            @method('DELETE')
                            <button type="submit" class="bg-red-500 hover:bg-red-600 text-white px-3 py-1 rounded text-xs">
                                <i class="fa-solid fa-trash mr-1"></i> Delete
                            </button>
                        </form>
                    </td>
                </tr>
                @endforeach
            </tbody>
        </table>
    </div>

    <div class="mt-4">
        {!! $data->links('pagination::tailwind') !!}
    </div>

</div>
@endsection
