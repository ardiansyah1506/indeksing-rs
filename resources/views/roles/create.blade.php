@extends('layouts.app')

@section('content')
<div class="mb-6">
    <div class="flex items-center justify-between mb-4">
        <h2 class="text-2xl font-bold text-gray-800">Create New Role</h2>
        <a href="{{ route('roles.index') }}" class="bg-blue-500 hover:bg-blue-600 text-white px-4 py-2 rounded text-sm">
            <i class="fa fa-arrow-left"></i> Back
        </a>
    </div>

    @if (count($errors) > 0)
        <div class="bg-red-100 border border-red-400 text-red-700 px-4 py-3 rounded mb-4">
            <strong>Whoops!</strong> There were some problems with your input.
            <ul class="mt-2 list-disc list-inside">
                @foreach ($errors->all() as $error)
                    <li>{{ $error }}</li>
                @endforeach
            </ul>
        </div>
    @endif

    <form method="POST" action="{{ route('roles.store') }}" class="space-y-6">
        @csrf

        <div>
            <label for="name" class="block text-sm font-medium text-gray-700 mb-1">Name:</label>
            <input type="text" name="name" id="name" placeholder="Name"
                   class="w-full border-gray-300 rounded-md shadow-sm focus:ring-blue-500 focus:border-blue-500">
        </div>

        <div>
            <label class="block text-sm font-medium text-gray-700 mb-2">Permissions:</label>
            <div class="grid grid-cols-1 sm:grid-cols-2 md:grid-cols-3 gap-2">
                @foreach($permission as $value)
                    <label class="flex items-center space-x-2 text-sm">
                        <input type="checkbox" name="permission[{{$value->id}}]" value="{{ $value->id }}"
                               class="text-blue-600 border-gray-300 rounded shadow-sm focus:ring focus:ring-blue-500">
                        <span>{{ $value->name }}</span>
                    </label>
                @endforeach
            </div>
        </div>

        <div class="text-center">
            <button type="submit" class="bg-blue-600 hover:bg-blue-700 text-white px-6 py-2 rounded text-sm">
                <i class="fa-solid fa-floppy-disk"></i> Submit
            </button>
        </div>
    </form>

   
</div>
@endsection
