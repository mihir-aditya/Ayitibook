@extends('layouts.app')

@section('content')
<div class="container mx-auto px-4 py-8 max-w-md">
    <h1 class="text-3xl font-bold mb-6">Edit Affiliate</h1>

    @if($errors->any())
        <div class="bg-red-100 border border-red-400 text-red-700 px-4 py-3 rounded mb-4">
            <ul>
                @foreach($errors->all() as $error)
                    <li>{{ $error }}</li>
                @endforeach
            </ul>
        </div>
    @endif

    <form action="{{ route('affiliate.update', $affiliate->id) }}" method="POST" class="bg-white rounded-lg shadow p-6">
        @csrf
        @method('PUT')

        <div class="mb-4">
            <label for="user" class="block text-gray-700 font-bold mb-2">User</label>
            <input type="text" value="{{ $affiliate->user->name }}" disabled class="w-full border border-gray-300 rounded px-3 py-2 bg-gray-100">
        </div>

        <div class="mb-4">
            <label for="affiliate_code" class="block text-gray-700 font-bold mb-2">Affiliate Code</label>
            <input type="text" name="affiliate_code" id="affiliate_code" value="{{ old('affiliate_code', $affiliate->affiliate_code) }}" 
                   class="w-full border border-gray-300 rounded px-3 py-2 @error('affiliate_code') border-red-500 @enderror">
            @error('affiliate_code')
                <p class="text-red-500 text-sm mt-1">{{ $message }}</p>
            @enderror
        </div>

        <div class="mb-4">
            <label for="status" class="block text-gray-700 font-bold mb-2">Status</label>
            <select name="status" id="status" class="w-full border border-gray-300 rounded px-3 py-2 @error('status') border-red-500 @enderror">
                <option value="active" {{ old('status', $affiliate->status) == 'active' ? 'selected' : '' }}>Active</option>
                <option value="suspended" {{ old('status', $affiliate->status) == 'suspended' ? 'selected' : '' }}>Suspended</option>
            </select>
            @error('status')
                <p class="text-red-500 text-sm mt-1">{{ $message }}</p>
            @enderror
        </div>

        <div class="mb-6">
            <label for="total_earnings" class="block text-gray-700 font-bold mb-2">Total Earnings (Auto-calculated)</label>
            <input type="number" name="total_earnings" id="total_earnings" value="{{ old('total_earnings', $affiliate->total_earnings) }}" 
                   class="w-full border border-gray-300 rounded px-3 py-2" step="0.01" min="0">
        </div>

        <div class="flex gap-2">
            <button type="submit" class="flex-1 bg-blue-500 text-white px-4 py-2 rounded hover:bg-blue-600">
                Update
            </button>
            <a href="{{ route('affiliate.show', $affiliate->id) }}" class="flex-1 bg-gray-500 text-white px-4 py-2 rounded hover:bg-gray-600 text-center">
                Cancel
            </a>
        </div>
    </form>
</div>
@endsection
