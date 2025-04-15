@extends('layouts.app')

@section('content')
<div class="max-w-4xl mx-auto py-6 px-4">
    <div class="flex items-center justify-between mb-6">
        <h2 class="text-2xl font-bold text-gray-800">Show User</h2>
        <a href="{{ route('users.index') }}" class="bg-blue-600 hover:bg-blue-700 text-white px-4 py-2 rounded text-sm shadow">
            ← Back
        </a>
    </div>

    <div class="bg-white shadow rounded-lg p-6 space-y-4">
        <div>
            <h3 class="text-gray-700 font-semibold">Name:</h3>
            <p class="text-gray-900">{{ $user->name }}</p>
        </div>
        <div>
            <h3 class="text-gray-700 font-semibold">Email:</h3>
            <p class="text-gray-900">{{ $user->email }}</p>
        </div>
        <div>
            <h3 class="text-gray-700 font-semibold">Roles:</h3>
            <div class="flex flex-wrap gap-2 mt-1">
                @if(!empty($user->getRoleNames()))
                    @foreach($user->getRoleNames() as $v)
                        <span class="bg-green-100 text-green-800 text-xs font-medium px-3 py-1 rounded-full">
                            {{ $v }}
                        </span>
                    @endforeach
                @else
                    <span class="text-gray-500 text-sm italic">No roles assigned</span>
                @endif
            </div>
        </div>
    </div>
</div>
@endsection
