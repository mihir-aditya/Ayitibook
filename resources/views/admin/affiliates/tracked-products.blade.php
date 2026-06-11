@extends('admin.layouts.basic')

@section('title', 'Tracked Products')
@section('page-title', 'Affiliate Tracked Products')

@section('content')
<div class="stat-card" style="margin-bottom: 30px;">
    <div style="display: flex; justify-content: space-between; align-items: center; margin-bottom: 20px;">
        <h3 style="margin: 0; color: #111827;">Products Being Tracked by Affiliates</h3>
        <div style="display: flex; gap: 10px;">
            <a href="{{ route('admin.affiliate.index') }}" style="background: #6b7280; color: white; padding: 10px 20px; border-radius: 5px; text-decoration: none;">
                <i class="fas fa-arrow-left"></i> Back to Affiliates
            </a>
        </div>
    </div>

    <div style="overflow-x: auto;">
        <table style="width: 100%; border-collapse: collapse; background: white;">
            <thead>
                <tr style="background: #f9fafb; border-bottom: 1px solid #e5e7eb;">
                    <th style="padding: 12px; text-align: left; font-weight: 600; color: #374151;">Product</th>
                    <th style="padding: 12px; text-align: left; font-weight: 600; color: #374151;">Price</th>
                    <th style="padding: 12px; text-align: left; font-weight: 600; color: #374151;">Total Links</th>
                    <th style="padding: 12px; text-align: left; font-weight: 600; color: #374151;">Total Clicks</th>
                    <th style="padding: 12px; text-align: left; font-weight: 600; color: #374151;">Active Affiliates</th>
                    <th style="padding: 12px; text-align: left; font-weight: 600; color: #374151;">Top Performer</th>
                    <th style="padding: 12px; text-align: left; font-weight: 600; color: #374151;">Actions</th>
                </tr>
            </thead>
            <tbody>
                @forelse($trackedProducts as $product)
                    <tr style="border-bottom: 1px solid #e5e7eb;">
                        <td style="padding: 12px;">
                            <div style="display: flex; align-items: center; gap: 12px;">
                                @if($product->image)
                                    <img src="{{ asset('storage/' . $product->image) }}"
                                         alt="{{ $product->name }}"
                                         style="width: 48px; height: 48px; object-fit: cover; border-radius: 6px;">
                                @else
                                    <div style="width: 48px; height: 48px; background: #f3f4f6; border-radius: 6px; display: flex; align-items: center; justify-content: center; color: #6b7280;">
                                        <i class="fas fa-image"></i>
                                    </div>
                                @endif
                                <div>
                                    <div style="font-weight: 500; color: #111827;">{{ $product->name }}</div>
                                    <div style="font-size: 12px; color: #6b7280;">ID: {{ $product->id }}</div>
                                </div>
                            </div>
                        </td>
                        <td style="padding: 12px; font-weight: 600; color: #059669;">
                            Rs. {{ number_format($product->price, 2) }}
                        </td>
                        <td style="padding: 12px;">
                            <span style="background: #dbeafe; color: #1e40af; padding: 4px 8px; border-radius: 12px; font-size: 12px; font-weight: 500;">
                                {{ $product->total_links }}
                            </span>
                        </td>
                        <td style="padding: 12px;">
                            <span style="background: #fef3c7; color: #92400e; padding: 4px 8px; border-radius: 12px; font-size: 12px; font-weight: 500;">
                                {{ $product->affiliateLinks->sum('affiliate_clicks_count') }}
                            </span>
                        </td>
                        <td style="padding: 12px;">
                            <div style="display: flex; flex-wrap: wrap; gap: 4px;">
                                @foreach($product->affiliateLinks->take(3) as $link)
                                    <span style="background: #d1fae5; color: #065f46; padding: 2px 6px; border-radius: 8px; font-size: 11px; font-weight: 500;">
                                        {{ $link->affiliate->user->name ?? 'Unknown' }}
                                    </span>
                                @endforeach
                                @if($product->affiliateLinks->count() > 3)
                                    <span style="background: #f3f4f6; color: #374151; padding: 2px 6px; border-radius: 8px; font-size: 11px; font-weight: 500;">
                                        +{{ $product->affiliateLinks->count() - 3 }} more
                                    </span>
                                @endif
                            </div>
                        </td>
                        <td style="padding: 12px;">
                            @php
                                $topLink = $product->affiliateLinks->sortByDesc('affiliate_clicks_count')->first();
                            @endphp
                            @if($topLink)
                                <div>
                                    <div style="font-weight: 500; font-size: 12px;">{{ $topLink->affiliate->user->name ?? 'Unknown' }}</div>
                                    <div style="color: #6b7280; font-size: 11px;">{{ $topLink->affiliate_clicks_count }} clicks</div>
                                </div>
                            @else
                                <span style="color: #6b7280; font-size: 12px;">No clicks yet</span>
                            @endif
                        </td>
                        <td style="padding: 12px;">
                            <a href="{{ route('admin.products.show', $product->id) }}"
                               style="color: #3b82f6; text-decoration: none; padding: 4px 8px; border-radius: 3px; border: 1px solid #3b82f6; display: inline-block; margin-bottom: 4px;">
                                <i class="fas fa-eye"></i> View Product
                            </a>
                        </td>
                    </tr>
                @empty
                    <tr>
                        <td colspan="7" style="padding: 40px; text-align: center; color: #6b7280;">
                            <i class="fas fa-box-open" style="font-size: 48px; color: #d1d5db; margin-bottom: 16px;"></i>
                            <div>No products are currently being tracked by affiliates</div>
                            <div style="font-size: 14px; margin-top: 8px;">Products will appear here once affiliates create links for them</div>
                        </td>
                    </tr>
                @endforelse
            </tbody>
        </table>
    </div>

    @if($trackedProducts->hasPages())
    <div style="margin-top: 20px; display: flex; justify-content: center;">
        {{ $trackedProducts->links() }}
    </div>
    @endif
</div>

<!-- Tracking Statistics -->
<div style="display: grid; grid-template-columns: repeat(auto-fill, minmax(250px, 1fr)); gap: 20px; margin-bottom: 30px;">
    <div class="stat-card">
        <div style="display: flex; align-items: center; gap: 15px; margin-bottom: 10px;">
            <div style="width: 50px; height: 50px; background: #fee2e2; border-radius: 10px; display: flex; align-items: center; justify-content: center; color: #dc2626; font-size: 20px;">
                <i class="fas fa-box"></i>
            </div>
            <div>
                <div style="font-size: 12px; color: #6b7280; text-transform: uppercase; letter-spacing: 0.5px;">Tracked Products</div>
                <div style="font-size: 28px; font-weight: bold; color: #111827;">{{ $trackedProducts->total() }}</div>
            </div>
        </div>
    </div>

    <div class="stat-card">
        <div style="display: flex; align-items: center; gap: 15px; margin-bottom: 10px;">
            <div style="width: 50px; height: 50px; background: #d1fae5; border-radius: 10px; display: flex; align-items: center; justify-content: center; color: #10b981; font-size: 20px;">
                <i class="fas fa-link"></i>
            </div>
            <div>
                <div style="font-size: 12px; color: #6b7280; text-transform: uppercase; letter-spacing: 0.5px;">Total Links</div>
                <div style="font-size: 28px; font-weight: bold; color: #111827;">{{ $trackedProducts->sum('total_links') }}</div>
            </div>
        </div>
    </div>

    <div class="stat-card">
        <div style="display: flex; align-items: center; gap: 15px; margin-bottom: 10px;">
            <div style="width: 50px; height: 50px; background: #fef3c7; border-radius: 10px; display: flex; align-items: center; justify-content: center; color: #f59e0b; font-size: 20px;">
                <i class="fas fa-mouse-pointer"></i>
            </div>
            <div>
                <div style="font-size: 12px; color: #6b7280; text-transform: uppercase; letter-spacing: 0.5px;">Total Clicks</div>
                <div style="font-size: 28px; font-weight: bold; color: #111827;">{{ $trackedProducts->sum(function($product) { return $product->affiliateLinks->sum('affiliate_clicks_count'); }) }}</div>
            </div>
        </div>
    </div>

    <div class="stat-card">
        <div style="display: flex; align-items: center; gap: 15px; margin-bottom: 10px;">
            <div style="width: 50px; height: 50px; background: #dbeafe; border-radius: 10px; display: flex; align-items: center; justify-content: center; color: #3b82f6; font-size: 20px;">
                <i class="fas fa-handshake"></i>
            </div>
            <div>
                <div style="font-size: 12px; color: #6b7280; text-transform: uppercase; letter-spacing: 0.5px;">Active Affiliates</div>
                <div style="font-size: 28px; font-weight: bold; color: #111827;">
                    {{ collect($trackedProducts->items())->pluck('affiliateLinks')->flatten()->pluck('affiliate.user.name')->unique()->count() }}
                </div>
            </div>
        </div>
    </div>
</div>
@endsection