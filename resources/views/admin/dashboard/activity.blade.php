@extends('admin.layouts.basic')

@section('title', 'Activity Log')
@section('page-title', 'Activity Log')

@section('content')
<div class="stat-card">
    <div style="display: flex; justify-content: space-between; align-items: center; margin-bottom: 20px;">
        <h3 style="margin: 0; color: #374151;">
            <i class="fas fa-history"></i> Recent Activities
        </h3>
        <button onclick="location.reload()" style="background: #f3f4f6; color: #374151; border: 1px solid #d1d5db; padding: 10px 20px; border-radius: 8px; cursor: pointer;">
            <i class="fas fa-sync-alt"></i> Refresh
        </button>
    </div>
    
    <div style="overflow-x: auto;">
        <table style="width: 100%; border-collapse: collapse;">
            <thead>
                <tr style="background: #f9fafb;">
                    <th style="padding: 12px; text-align: left; color: #374151;">ID</th>
                    <th style="padding: 12px; text-align: left; color: #374151;">Admin</th>
                    <th style="padding: 12px; text-align: left; color: #374151;">Action</th>
                    <th style="padding: 12px; text-align: left; color: #374151;">IP Address</th>
                    <th style="padding: 12px; text-align: left; color: #374151;">Timestamp</th>
                </tr>
            </thead>
            <tbody>
                @forelse($activities as $activity)
                <tr style="border-bottom: 1px solid #e5e7eb;">
                    <td style="padding: 12px;">#{{ $activity->id }}</td>
                    <td style="padding: 12px;">{{ $activity->admin_name ?? 'System' }}</td>
                    <td style="padding: 12px;">
                        <span style="background: #fee2e2; color: #dc2626; padding: 5px 12px; border-radius: 20px; font-size: 12px; font-weight: 600;">
                            {{ $activity->action }}
                        </span>
                    </td>
                    <td style="padding: 12px;">{{ $activity->ip_address ?? 'N/A' }}</td>
                    <td style="padding: 12px;">
                        @if($activity->created_at)
                            {{ \Carbon\Carbon::parse($activity->created_at)->format('Y-m-d H:i') }}
                        @else
                            N/A
                        @endif
                    </td>
                </tr>
                @empty
                <tr>
                    <td colspan="5" style="padding: 40px; text-align: center; color: #9ca3af;">
                        <i class="fas fa-clipboard-list" style="font-size: 48px; margin-bottom: 10px;"></i>
                        <p>No activities found</p>
                        <p style="font-size: 14px;">Run the activity logs migration to enable this feature</p>
                    </td>
                </tr>
                @endforelse
            </tbody>
        </table>
    </div>
</div>
@endsection