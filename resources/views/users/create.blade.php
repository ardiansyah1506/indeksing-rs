@extends('layouts.app')

@section('content')
<div class="max-w-3xl mx-auto py-6 px-4">
    <div class="flex items-center justify-between mb-6">
        <h2 class="text-2xl font-bold text-gray-800">Create New User</h2>
        <a href="{{ route('users.index') }}" class="bg-blue-600 hover:bg-blue-700 text-white px-4 py-2 rounded text-sm shadow">
            ← Back
        </a>
    </div>

    @if ($errors->any())
        <div class="bg-red-100 border border-red-400 text-red-700 px-4 py-3 rounded mb-6">
            <strong>Whoops!</strong> There were some problems with your input.
            <ul class="mt-2 list-disc list-inside text-sm">
                @foreach ($errors->all() as $error)
                    <li>{{ $error }}</li>
                @endforeach
            </ul>
        </div>
    @endif

    <form method="POST" action="{{ route('users.store') }}">
        @csrf
        <div class="grid grid-cols-1 gap-4">
            <div>
                <label class="block text-gray-700 font-medium mb-1">Name</label>
                <input type="text" name="name" placeholder="Name" class="w-full px-4 py-2 border rounded-md shadow-sm focus:ring focus:ring-blue-200 focus:outline-none">
            </div>

            <div>
                <label class="block text-gray-700 font-medium mb-1">Email</label>
                <input type="email" name="email" placeholder="Email" class="w-full px-4 py-2 border rounded-md shadow-sm focus:ring focus:ring-blue-200 focus:outline-none">
            </div>

            <div>
                <label class="block text-gray-700 font-medium mb-1">Password</label>
                <input type="password" name="password" placeholder="Password" class="w-full px-4 py-2 border rounded-md shadow-sm focus:ring focus:ring-blue-200 focus:outline-none">
            </div>

            <div>
                <label class="block text-gray-700 font-medium mb-1">Confirm Password</label>
                <input type="password" name="confirm-password" placeholder="Confirm Password" class="w-full px-4 py-2 border rounded-md shadow-sm focus:ring focus:ring-blue-200 focus:outline-none">
            </div>

            <div>
                <label class="block text-gray-700 font-medium mb-1">Roles</label>
                <select name="roles[]" multiple class="w-full px-4 py-2 border rounded-md shadow-sm focus:ring focus:ring-blue-200 focus:outline-none">
                    @foreach ($roles as $value => $label)
                        <option value="{{ $value }}">{{ $label }}</option>
                    @endforeach
                </select>
                <p class="text-sm text-gray-500 mt-1">Hold down Ctrl (Windows) or Command (Mac) to select multiple roles.</p>
            </div>

            <div class="flex justify-end mt-4">
                <button type="submit" class="bg-blue-600 hover:bg-blue-700 text-white px-5 py-2 rounded text-sm shadow">
                    💾 Submit
                </button>
            </div>
        </div>
    </form>

</div>
@endsection
