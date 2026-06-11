{{-- resources/views/admin/affiliate-clicks/index.blade.php --}}
@extends('admin.layouts.affiliate')

@section('content')
<div class="container-fluid">
    <div class="d-flex justify-content-between align-items-center mb-4">
        <h1>Affiliate Clicks</h1>
    </div>

    {{-- Filters --}}
    <div class="card mb-4">
        <div class="card-body">
            <form method="GET" action="{{ route('admin.affiliate.clicks.index') }}" class="row">
                <div class="col-md-3">
                    <input type="date" name="from_date" class="form-control"
                           value="{{ request('from_date') }}">
                </div>
                <div class="col-md-3">
                    <input type="date" name="to_date" class="form-control"
                           value="{{ request('to_date') }}">
                </div>
                <div class="col-md-3">
                    <select name="status" class="form-control">
                        <option value="">All Status</option>
                        <option value="converted" {{ request('status') == 'converted' ? 'selected' : '' }}>Converted</option>
                        <option value="not_converted" {{ request('status') == 'not_converted' ? 'selected' : '' }}>Not Converted</option>
                    </select>
                </div>
                <div class="col-md-3">
                    <button type="submit" class="btn btn-primary">Filter</button>
                    <a href="{{ route('admin.affiliate.clicks.index') }}" class="btn btn-secondary">Reset</a>
                </div>
            </form>
        </div>
    </div>

    {{-- Clicks Table --}}
    <div class="card">
        <div class="card-body">
            <table class="table table-hover">
                <thead>
                    <tr>
                        <th>ID</th>
                        <th>Affiliate</th>
                        <th>Product</th>
                        <th>Customer</th>
                        <th>IP Address</th>
                        <th>Status</th>
                        <th>Clicked At</th>
                        <th>Actions</th>
                    </tr>
                </thead>
                <tbody>
                    @forelse($clicks as $click)
                    <tr>
                        <td>{{ $click->id }}</td>
                        <td>
                            <strong>{{ $click->affiliate->user->name }}</strong><br>
                            <small>{{ $click->affiliate->affiliate_code }}</small>
                        </td>
                        <td>
                            @if($click->affiliateLink && $click->affiliateLink->product)
                                {{ $click->affiliateLink->product->name }}
                            @else
                                <em>General</em>
                            @endif
                        </td>
                        <td>
                            @if($click->customer)
                                {{ $click->customer->name }}<br>
                                <small>{{ $click->customer->email }}</small>
                            @else
                                <em>Anonymous</em>
                            @endif
                        </td>
                        <td>{{ $click->ip_address }}</td>
                        <td>
                            <span class="badge badge-{{ $click->status === 'converted' ? 'success' : 'secondary' }}">
                                {{ ucfirst(str_replace('_', ' ', $click->status)) }}
                            </span>
                        </td>
                        <td>{{ $click->click_timestamp->format('M d, Y H:i') }}</td>
                        <td>
                            <a href="{{ route('admin.affiliate.clicks.show', $click) }}"
                               class="btn btn-sm btn-info" title="View">
                                <i class="fas fa-eye"></i>
                            </a>
                        </td>
                    </tr>
                    @empty
                    <tr>
                        <td colspan="8" class="text-center">No clicks found.</td>
                    </tr>
                    @endforelse
                </tbody>
            </table>

            <div class="mt-3">
                {{ $clicks->withQueryString()->links() }}
            </div>
        </div>
    </div>
</div>
@endsection