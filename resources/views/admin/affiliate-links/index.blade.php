{{-- resources/views/admin/affiliate-links/index.blade.php --}}
@extends('admin.layouts.affiliate')

@section('content')
<div class="container-fluid">
    <div class="d-flex justify-content-between align-items-center mb-4">
        <h1>Affiliate Links</h1>
        <a href="{{ route('admin.affiliate.links.create') }}" class="btn btn-primary">
            <i class="fas fa-plus"></i> Create New Link
        </a>
    </div>

    {{-- Filters --}}
    <div class="card mb-4">
        <div class="card-body">
            <form method="GET" action="{{ route('admin.affiliate.links.index') }}" class="row">
                <div class="col-md-4">
                    <select name="affiliate_id" class="form-control">
                        <option value="">All Affiliates</option>
                        @foreach($affiliates as $aff)
                            <option value="{{ $aff->id }}" {{ request('affiliate_id') == $aff->id ? 'selected' : '' }}>
                                {{ $aff->user->name }} ({{ $aff->affiliate_code }})
                            </option>
                        @endforeach
                    </select>
                </div>
                <div class="col-md-4">
                    <input type="text" name="search" class="form-control"
                           placeholder="Search by link code"
                           value="{{ request('search') }}">
                </div>
                <div class="col-md-2">
                    <button type="submit" class="btn btn-primary">Filter</button>
                    <a href="{{ route('admin.affiliate.links.index') }}" class="btn btn-secondary">Reset</a>
                </div>
            </form>
        </div>
    </div>

    {{-- Links Table --}}
    <div class="card">
        <div class="card-body">
            <table class="table table-hover">
                <thead>
                    <tr>
                        <th>ID</th>
                        <th>Affiliate</th>
                        <th>Product</th>
                        <th>Link Code</th>
                        <th>Clicks</th>
                        <th>Created</th>
                        <th>Actions</th>
                    </tr>
                </thead>
                <tbody>
                    @forelse($links as $link)
                    <tr>
                        <td>{{ $link->id }}</td>
                        <td>
                            <strong>{{ $link->affiliate->user->name }}</strong><br>
                            <small>{{ $link->affiliate->affiliate_code }}</small>
                        </td>
                        <td>
                            @if($link->product)
                                {{ $link->product->name }}
                            @else
                                <em>General Link</em>
                            @endif
                        </td>
                        <td><code>{{ $link->link_code }}</code></td>
                        <td>{{ $link->clicks_count }}</td>
                        <td>{{ $link->created_at->format('M d, Y') }}</td>
                        <td>
                            <a href="{{ route('admin.affiliate.links.show', $link) }}"
                               class="btn btn-sm btn-info" title="View">
                                <i class="fas fa-eye"></i>
                            </a>
                            <a href="{{ route('admin.affiliate.links.edit', $link) }}"
                               class="btn btn-sm btn-warning" title="Edit">
                                <i class="fas fa-edit"></i>
                            </a>
                            <form action="{{ route('admin.affiliate.links.destroy', $link) }}"
                                  method="POST" class="d-inline">
                                @csrf
                                @method('DELETE')
                                <button type="submit" class="btn btn-sm btn-danger"
                                        onclick="return confirm('Are you sure?')" title="Delete">
                                    <i class="fas fa-trash"></i>
                                </button>
                            </form>
                        </td>
                    </tr>
                    @empty
                    <tr>
                        <td colspan="7" class="text-center">No affiliate links found.</td>
                    </tr>
                    @endforelse
                </tbody>
            </table>

            <div class="mt-3">
                {{ $links->withQueryString()->links() }}
            </div>
        </div>
    </div>
</div>
@endsection