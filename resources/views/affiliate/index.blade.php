@extends('layouts.app')

@section('content')
<div class="container mx-auto px-4 py-8">
    <div class="flex justify-between items-center mb-6">
        <h1 class="text-3xl font-bold">Affiliates</h1>
        <a href="{{ route('admin.affiliate.create') }}" class="bg-blue-500 text-white px-4 py-2 rounded hover:bg-blue-600">
            Create Affiliate
        </a>
    </div>

    @if(session('success'))
        <div class="bg-green-100 border border-green-400 text-green-700 px-4 py-3 rounded mb-4">
            {{ session('success') }}
        </div>
    @endif

    <div class="bg-white rounded-lg shadow overflow-hidden">
        <table class="min-w-full divide-y divide-gray-200">
            <thead class="bg-gray-50">
                <tr>
                    <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">User</th>
                    <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Affiliate Code</th>
                    <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Status</th>
                    <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Total Earnings</th>
                    <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Links</th>
                    <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Actions</th>
                </tr>
            </thead>
            <tbody class="bg-white divide-y divide-gray-200">
                @forelse($affiliates as $affiliate)
                    <tr>
                        <td class="px-6 py-4 whitespace-nowrap">{{ $affiliate->user->name ?? 'N/A' }}</td>
                        <td class="px-6 py-4 whitespace-nowrap text-sm">{{ $affiliate->affiliate_code }}</td>
                        <td class="px-6 py-4 whitespace-nowrap">
                            <span class="px-2 py-1 inline-flex text-xs leading-5 font-semibold rounded-full 
                                {{ $affiliate->status === 'active' ? 'bg-green-100 text-green-800' : 'bg-red-100 text-red-800' }}">
                                {{ ucfirst($affiliate->status) }}
                            </span>
                        </td>
                        <td class="px-6 py-4 whitespace-nowrap">Rs. {{ number_format($affiliate->total_earnings, 2) }}</td>
                        <td class="px-6 py-4 whitespace-nowrap">{{ $affiliate->affiliateLinks->count() }}</td>
                        <td class="px-6 py-4 whitespace-nowrap text-sm space-x-2">
                            <a href="{{ route('affiliate.show', $affiliate->id) }}" class="text-blue-600 hover:text-blue-900">View</a>
                            @if(auth('admin')->check())
                                <a href="{{ route('admin.affiliate.edit', $affiliate->id) }}" class="text-yellow-600 hover:text-yellow-900">Edit</a>
                                <form action="{{ route('admin.affiliate.destroy', $affiliate->id) }}" method="POST" style="display:inline;">
                                    @csrf
                                    @method('DELETE')
                                    <button type="submit" class="text-red-600 hover:text-red-900" onclick="return confirm('Are you sure?')">Delete</button>
                                </form>
                            @endif
                        </td>
                    </tr>
                @empty
                    <tr>
                        <td colspan="6" class="px-6 py-4 text-center text-gray-500">No affiliates found</td>
                    </tr>
                @endforelse
            </tbody>
        </table>
    </div>

    <div class="mt-6">
        {{ $affiliates->links() }}
    </div>
</div>
@endsection
