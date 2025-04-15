@extends('layouts.app')

@section('content')
<div class="mb-6">
    <div class="flex items-center justify-between mb-4">
        <h2 class="text-2xl font-bold text-gray-800">Show Role</h2>
        <a href="{{ route('roles.index') }}" class="bg-blue-500 hover:bg-blue-600 text-white px-4 py-2 rounded text-sm">
            Back
        </a>
    </div>

    <div class="space-y-4">
        <div>
            <h3 class="text-sm font-semibold text-gray-700">Name:</h3>
            <p class="text-gray-900 mt-1">{{ $role->name }}</p>
        </div>

        <div>
            <h3 class="text-sm font-semibold text-gray-700">Permissions:</h3>
            <div class="flex flex-wrap gap-2 mt-2">
                @if(!empty($rolePermissions))
                    @foreach($rolePermissions as $v)
                        <span class="inline-block bg-green-100 text-green-800 text-xs font-medium px-2.5 py-0.5 rounded">
                            {{ $v->name }}
                        </span>
                    @endforeach
                @endif
            </div>
        </div>
    </div>
</div>
@endsection
