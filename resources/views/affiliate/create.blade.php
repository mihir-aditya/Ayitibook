@extends('layouts.app')

@section('content')
<div class="container mx-auto px-4 py-8 max-w-md">
    <h1 class="text-3xl font-bold mb-6">Create New Affiliate</h1>

    @if($errors->any())
        <div class="bg-red-100 border border-red-400 text-red-700 px-4 py-3 rounded mb-4">
            <ul>
                @foreach($errors->all() as $error)
                    <li>{{ $error }}</li>
                @endforeach
            </ul>
        </div>
    @endif

    <form action="{{ route('affiliate.store') }}" method="POST" class="bg-white rounded-lg shadow p-6">
        @csrf

        <div class="mb-4">
            <label for="user_id" class="block text-gray-700 font-bold mb-2">User</label>
            <select name="user_id" id="user_id" class="w-full border border-gray-300 rounded px-3 py-2 @error('user_id') border-red-500 @enderror">
                <option value="">Select User</option>
                @foreach(\App\Models\User::all() as $user)
                    <option value="{{ $user->id }}" {{ old('user_id') == $user->id ? 'selected' : '' }}>
                        {{ $user->name }} ({{ $user->email }})
                    </option>
                @endforeach
            </select>
            @error('user_id')
                <p class="text-red-500 text-sm mt-1">{{ $message }}</p>
            @enderror
        </div>

        <div class="mb-4">
            <label for="affiliate_code" class="block text-gray-700 font-bold mb-2">Affiliate Code</label>
            <input type="text" name="affiliate_code" id="affiliate_code" value="{{ old('affiliate_code') }}" 
                   class="w-full border border-gray-300 rounded px-3 py-2 @error('affiliate_code') border-red-500 @enderror"
                   placeholder="e.g., AFF001">
            @error('affiliate_code')
                <p class="text-red-500 text-sm mt-1">{{ $message }}</p>
            @enderror
        </div>

        <div class="mb-6">
            <label for="status" class="block text-gray-700 font-bold mb-2">Status</label>
            <select name="status" id="status" class="w-full border border-gray-300 rounded px-3 py-2 @error('status') border-red-500 @enderror">
                <option value="active" {{ old('status') == 'active' ? 'selected' : '' }}>Active</option>
                <option value="suspended" {{ old('status') == 'suspended' ? 'selected' : '' }}>Suspended</option>
            </select>
            @error('status')
                <p class="text-red-500 text-sm mt-1">{{ $message }}</p>
            @enderror
        </div>

        <div class="flex gap-2">
            <button type="submit" class="flex-1 bg-blue-500 text-white px-4 py-2 rounded hover:bg-blue-600">
                Create
            </button>
            <a href="{{ route('affiliate.index') }}" class="flex-1 bg-gray-500 text-white px-4 py-2 rounded hover:bg-gray-600 text-center">
                Cancel
            </a>
        </div>
    </form>
</div>
@endsection
