@extends('admin.layouts.basic')

@section('title', 'Users Management')
@section('page-title', 'Users Management')

@section('content')
<style>
    /* Custom Styles for Users Page */
    .stats-grid {
        display: grid;
        grid-template-columns: repeat(auto-fit, minmax(220px, 1fr));
        gap: 1.5rem;
        margin-bottom: 2rem;
    }
    
    .stat-card {
        background: white;
        border-radius: 12px;
        padding: 1.5rem;
        box-shadow: 0 4px 6px -1px rgba(0, 0, 0, 0.1), 0 2px 4px -1px rgba(0, 0, 0, 0.06);
        border-left: 4px solid;
        transition: transform 0.3s ease, box-shadow 0.3s ease;
    }
    
    .stat-card:hover {
        transform: translateY(-4px);
        box-shadow: 0 10px 25px rgba(0, 0, 0, 0.1);
    }
    
    .stat-card.blue {
        border-left-color: #3b82f6;
        background: linear-gradient(135deg, #3b82f6 0%, #1d4ed8 100%);
        color: white;
    }
    
    .stat-card.green {
        border-left-color: #10b981;
        background: linear-gradient(135deg, #10b981 0%, #047857 100%);
        color: white;
    }
    
    .stat-card.orange {
        border-left-color: #f59e0b;
        background: linear-gradient(135deg, #f59e0b 0%, #d97706 100%);
        color: white;
    }
    
    .stat-card.purple {
        border-left-color: #8b5cf6;
        background: linear-gradient(135deg, #8b5cf6 0%, #7c3aed 100%);
        color: white;
    }
    
    .stat-icon {
        font-size: 2.5rem;
        opacity: 0.9;
    }
    
    .stat-label {
        font-size: 0.875rem;
        opacity: 0.9;
        margin-bottom: 0.5rem;
        text-transform: uppercase;
        letter-spacing: 0.5px;
    }
    
    .stat-value {
        font-size: 2rem;
        font-weight: 700;
        margin: 0;
    }
    
    /* Filter Card */
    .filter-card {
        background: white;
        border-radius: 12px;
        padding: 1.5rem;
        box-shadow: 0 4px 6px -1px rgba(0, 0, 0, 0.1), 0 2px 4px -1px rgba(0, 0, 0, 0.06);
        margin-bottom: 1.5rem;
        border: 1px solid #e5e7eb;
    }
    
    .filter-header {
        display: flex;
        justify-content: space-between;
        align-items: center;
        margin-bottom: 1.5rem;
        flex-wrap: wrap;
        gap: 1rem;
    }
    
    .filter-title {
        font-size: 1.25rem;
        font-weight: 600;
        color: #111827;
        margin: 0;
        display: flex;
        align-items: center;
        gap: 0.5rem;
    }
    
    .btn-primary {
        background: linear-gradient(135deg, #dc2626 0%, #b91c1c 100%);
        color: white;
        border: none;
        padding: 0.75rem 1.5rem;
        border-radius: 8px;
        font-weight: 600;
        cursor: pointer;
        text-decoration: none;
        display: inline-flex;
        align-items: center;
        gap: 0.5rem;
        transition: all 0.3s ease;
    }
    
    .btn-primary:hover {
        transform: translateY(-2px);
        box-shadow: 0 8px 20px rgba(220, 38, 38, 0.3);
    }
    
    .filter-grid {
        display: grid;
        grid-template-columns: repeat(auto-fit, minmax(200px, 1fr));
        gap: 1rem;
        margin-bottom: 1.5rem;
    }
    
    .filter-group {
        display: flex;
        flex-direction: column;
    }
    
    .filter-label {
        font-size: 0.875rem;
        font-weight: 600;
        color: #374151;
        margin-bottom: 0.5rem;
    }
    
    .filter-input, .filter-select {
        padding: 0.75rem 1rem;
        border: 1px solid #d1d5db;
        border-radius: 8px;
        font-size: 0.875rem;
        width: 100%;
        transition: border-color 0.3s;
    }
    
    .filter-input:focus, .filter-select:focus {
        outline: none;
        border-color: #dc2626;
        box-shadow: 0 0 0 3px rgba(220, 38, 38, 0.1);
    }
    
    .search-wrapper {
        position: relative;
    }
    
    .search-icon {
        position: absolute;
        left: 1rem;
        top: 50%;
        transform: translateY(-50%);
        color: #9ca3af;
    }
    
    .search-input {
        padding-left: 3rem !important;
    }
    
    .action-buttons {
        display: flex;
        gap: 0.75rem;
        flex-wrap: wrap;
    }
    
    .btn-secondary {
        background: #f3f4f6;
        color: #374151;
        border: 1px solid #d1d5db;
        padding: 0.75rem 1.5rem;
        border-radius: 8px;
        font-weight: 500;
        cursor: pointer;
        transition: all 0.3s ease;
    }
    
    .btn-secondary:hover {
        background: #e5e7eb;
    }
    
    .btn-success {
        background: linear-gradient(135deg, #10b981 0%, #047857 100%);
        color: white;
        border: none;
        padding: 0.75rem 1.5rem;
        border-radius: 8px;
        font-weight: 600;
        cursor: pointer;
        transition: all 0.3s ease;
    }
    
    .btn-success:hover {
        transform: translateY(-2px);
        box-shadow: 0 8px 20px rgba(16, 185, 129, 0.3);
    }
    
    /* Bulk Actions */
    .bulk-card {
        background: #f8fafc;
        border-radius: 12px;
        padding: 1.5rem;
        margin-bottom: 1.5rem;
        border-left: 4px solid #dc2626;
        border: 1px solid #e5e7eb;
    }
    
    .bulk-header {
        font-size: 1.125rem;
        font-weight: 600;
        color: #111827;
        margin-bottom: 1rem;
        display: flex;
        align-items: center;
        gap: 0.5rem;
    }
    
    .bulk-form {
        display: flex;
        align-items: center;
        gap: 1rem;
        flex-wrap: wrap;
    }
    
    .bulk-select {
        min-width: 180px;
        padding: 0.75rem;
        border: 1px solid #d1d5db;
        border-radius: 6px;
        font-size: 0.875rem;
    }
    
    .selected-count {
        font-size: 0.875rem;
        color: #6b7280;
        margin-left: auto;
    }
    
    /* Users Table */
    .table-card {
        background: white;
        border-radius: 12px;
        padding: 1.5rem;
        box-shadow: 0 4px 6px -1px rgba(0, 0, 0, 0.1), 0 2px 4px -1px rgba(0, 0, 0, 0.06);
        overflow: hidden;
        border: 1px solid #e5e7eb;
    }
    
    .table-header {
        display: flex;
        justify-content: space-between;
        align-items: center;
        margin-bottom: 1.5rem;
        flex-wrap: wrap;
        gap: 1rem;
    }
    
    .table-title {
        font-size: 1.25rem;
        font-weight: 600;
        color: #111827;
        margin: 0;
        display: flex;
        align-items: center;
        gap: 0.5rem;
    }
    
    .table-info {
        font-size: 0.875rem;
        color: #6b7280;
    }
    
    .table-responsive {
        overflow-x: auto;
        -webkit-overflow-scrolling: touch;
    }
    
    .users-table {
        width: 100%;
        border-collapse: collapse;
        min-width: 1000px;
    }
    
    .users-table th {
        padding: 1rem;
        text-align: left;
        font-weight: 600;
        color: #374151;
        border-bottom: 2px solid #e5e7eb;
        background: #f9fafb;
        white-space: nowrap;
    }
    
    .users-table td {
        padding: 1rem;
        border-bottom: 1px solid #e5e7eb;
        color: #4b5563;
        vertical-align: middle;
    }
    
    .users-table tr:hover td {
        background: #f9fafb;
    }
    
    .user-avatar {
        width: 40px;
        height: 40px;
        background: linear-gradient(135deg, #dc2626, #b91c1c);
        border-radius: 50%;
        display: flex;
        align-items: center;
        justify-content: center;
        color: white;
        font-weight: 600;
        font-size: 1rem;
    }
    
    .user-info {
        display: flex;
        align-items: center;
        gap: 0.75rem;
    }
    
    .user-name {
        font-weight: 600;
        color: #111827;
    }
    
    .user-id {
        font-size: 0.75rem;
        color: #6b7280;
    }
    
    .badge {
        display: inline-block;
        padding: 0.25rem 0.75rem;
        border-radius: 9999px;
        font-size: 0.75rem;
        font-weight: 600;
        white-space: nowrap;
    }
    
    .badge-success {
        background: #d1fae5;
        color: #10b981;
    }
    
    .badge-danger {
        background: #fee2e2;
        color: #ef4444;
    }
    
    .badge-warning {
        background: #fef3c7;
        color: #f59e0b;
    }
    
    .status-active {
        color: #10b981;
        font-weight: 600;
    }
    
    .status-inactive {
        color: #ef4444;
        font-weight: 600;
    }
    
    .action-buttons-group {
        display: flex;
        gap: 0.5rem;
    }
    
    .btn-action {
        width: 32px;
        height: 32px;
        border-radius: 6px;
        display: flex;
        align-items: center;
        justify-content: center;
        text-decoration: none;
        transition: all 0.3s ease;
        border: none;
        cursor: pointer;
        font-size: 0.875rem;
    }
    
    .btn-view {
        background: #3b82f6;
        color: white;
    }
    
    .btn-edit {
        background: #f59e0b;
        color: white;
    }
    
    .btn-delete {
        background: #ef4444;
        color: white;
    }
    
    .btn-action:hover {
        transform: translateY(-2px);
    }
    
    /* Empty State */
    .empty-state {
        padding: 3rem 1rem;
        text-align: center;
        color: #9ca3af;
    }
    
    .empty-icon {
        font-size: 3rem;
        margin-bottom: 1rem;
        color: #e5e7eb;
    }
    
    /* Pagination */
    .pagination {
        display: flex;
        justify-content: space-between;
        align-items: center;
        padding-top: 1.5rem;
        margin-top: 1.5rem;
        border-top: 1px solid #e5e7eb;
        flex-wrap: wrap;
        gap: 1rem;
    }
    
    .pagination-info {
        font-size: 0.875rem;
        color: #6b7280;
    }
    
    .pagination-links {
        display: flex;
        gap: 0.5rem;
    }
    
    .page-link {
        padding: 0.5rem 0.75rem;
        border-radius: 6px;
        text-decoration: none;
        font-size: 0.875rem;
        min-width: 40px;
        text-align: center;
        transition: all 0.3s ease;
    }
    
    .page-link.active {
        background: #dc2626;
        color: white;
        font-weight: 600;
    }
    
    .page-link:not(.active) {
        background: #f3f4f6;
        color: #374151;
    }
    
    .page-link:not(.active):hover {
        background: #e5e7eb;
    }
    
    .page-link.disabled {
        background: #f3f4f6;
        color: #9ca3af;
        cursor: not-allowed;
    }
    
    /* Checkbox */
    .checkbox-cell {
        width: 50px;
    }
    
    .checkbox {
        transform: scale(1.2);
        cursor: pointer;
    }
    
    /* Mobile Responsive */
    @media (max-width: 768px) {
        .stats-grid {
            grid-template-columns: repeat(2, 1fr);
        }
        
        .filter-grid {
            grid-template-columns: 1fr;
        }
        
        .filter-header, .table-header {
            flex-direction: column;
            align-items: stretch;
        }
        
        .action-buttons {
            justify-content: center;
        }
        
        .bulk-form {
            flex-direction: column;
            align-items: stretch;
        }
        
        .bulk-select {
            width: 100%;
        }
        
        .selected-count {
            margin-left: 0;
            text-align: center;
        }
        
        .pagination {
            flex-direction: column;
            text-align: center;
        }
        
        .user-info {
            flex-direction: column;
            align-items: flex-start;
            gap: 0.25rem;
        }
        
        .action-buttons-group {
            flex-wrap: wrap;
        }
    }
    
    @media (max-width: 480px) {
        .stats-grid {
            grid-template-columns: 1fr;
        }
        
        .stat-card {
            padding: 1.25rem;
        }
        
        .table-card, .filter-card, .bulk-card {
            padding: 1rem;
        }
        
        .btn-primary, .btn-secondary, .btn-success {
            padding: 0.5rem 1rem;
            font-size: 0.875rem;
        }
    }
</style>

<!-- Stats Section -->
<div class="stats-grid">
    <div class="stat-card blue">
        <div style="display: flex; align-items: center; justify-content: space-between;">
            <div>
                <div class="stat-label">TOTAL USERS</div>
                <div class="stat-value">{{ number_format($stats['total']) }}</div>
            </div>
            <div class="stat-icon">
                <i class="fas fa-users"></i>
            </div>
        </div>
    </div>
    
    <div class="stat-card green">
        <div style="display: flex; align-items: center; justify-content: space-between;">
            <div>
                <div class="stat-label">ACTIVE USERS</div>
                <div class="stat-value">{{ number_format($stats['active']) }}</div>
            </div>
            <div class="stat-icon">
                <i class="fas fa-user-check"></i>
            </div>
        </div>
    </div>
    
    <div class="stat-card orange">
        <div style="display: flex; align-items: center; justify-content: space-between;">
            <div>
                <div class="stat-label">VERIFIED</div>
                <div class="stat-value">{{ number_format($stats['verified']) }}</div>
            </div>
            <div class="stat-icon">
                <i class="fas fa-shield-alt"></i>
            </div>
        </div>
    </div>
    
    <div class="stat-card purple">
        <div style="display: flex; align-items: center; justify-content: space-between;">
            <div>
                <div class="stat-label">NEW THIS MONTH</div>
                <div class="stat-value">{{ number_format($stats['month']) }}</div>
            </div>
            <div class="stat-icon">
                <i class="fas fa-user-plus"></i>
            </div>
        </div>
    </div>
</div>

<!-- Filters and Actions -->
<div class="filter-card">
    <div class="filter-header">
        <h3 class="filter-title">
            <i class="fas fa-filter"></i> Filters & Actions
        </h3>
        <a href="{{ route('admin.users.create') }}" class="btn-primary">
            <i class="fas fa-plus"></i> Add New User
        </a>
    </div>
    
    <form method="GET" action="{{ route('admin.users.index') }}" id="filterForm">
        <div class="filter-grid">
            <!-- Search -->
            <div class="filter-group">
                <label class="filter-label">Search</label>
                <div class="search-wrapper">
                    <i class="fas fa-search search-icon"></i>
                    <input type="text" name="search" value="{{ request('search') }}" 
                           placeholder="Search by name, email, phone..."
                           class="filter-input search-input">
                </div>
            </div>
            
            <!-- Status Filter -->
            <div class="filter-group">
                <label class="filter-label">Status</label>
                <select name="status" class="filter-select">
                    <option value="all" {{ request('status') == 'all' ? 'selected' : '' }}>All Status</option>
                    <option value="1" {{ request('status') == '1' ? 'selected' : '' }}>Active</option>
                    <option value="0" {{ request('status') == '0' ? 'selected' : '' }}>Inactive</option>
                </select>
            </div>
            
            <!-- Email Verified Filter -->
            <div class="filter-group">
                <label class="filter-label">Email Verified</label>
                <select name="email_verified" class="filter-select">
                    <option value="all" {{ request('email_verified') == 'all' ? 'selected' : '' }}>All</option>
                    <option value="verified" {{ request('email_verified') == 'verified' ? 'selected' : '' }}>Verified</option>
                    <option value="unverified" {{ request('email_verified') == 'unverified' ? 'selected' : '' }}>Unverified</option>
                </select>
            </div>
            
            <!-- Date Range -->
            <div class="filter-group">
                <label class="filter-label">Date From</label>
                <input type="date" name="date_from" value="{{ request('date_from') }}" 
                       class="filter-input">
            </div>
            
            <div class="filter-group">
                <label class="filter-label">Date To</label>
                <input type="date" name="date_to" value="{{ request('date_to') }}" 
                       class="filter-input">
            </div>
        </div>
        
        <div class="action-buttons">
            <button type="submit" class="btn-primary">
                <i class="fas fa-filter"></i> Apply Filters
            </button>
            <button type="button" onclick="resetFilters()" class="btn-secondary">
                <i class="fas fa-redo"></i> Reset
            </button>
            <button type="button" onclick="exportUsers('csv')" class="btn-success">
                <i class="fas fa-download"></i> Export CSV
            </button>
        </div>
    </form>
</div>

<!-- Bulk Actions -->
<div class="bulk-card">
    <div class="bulk-header">
        <i class="fas fa-tasks"></i> Bulk Actions
    </div>
    <form method="POST" action="{{ route('admin.users.bulk-action') }}" id="bulkActionForm">
        @csrf
        <div class="bulk-form">
            <select name="action" class="bulk-select">
                <option value="">Select Action</option>
                <option value="activate">Activate Selected</option>
                <option value="deactivate">Deactivate Selected</option>
                <option value="delete">Delete Selected</option>
            </select>
            <button type="button" onclick="applyBulkAction()" class="btn-primary" style="padding: 0.75rem 1.5rem;">
                <i class="fas fa-play"></i> Apply
            </button>
            <div class="selected-count">
                <span id="selectedCount">0</span> users selected
            </div>
        </div>
    </form>
</div>

<!-- Users Table -->
<div class="table-card">
    <div class="table-header">
        <h3 class="table-title">
            <i class="fas fa-list"></i> Users List
        </h3>
        <div class="table-info">
            Showing {{ $users->firstItem() }} - {{ $users->lastItem() }} of {{ $users->total() }} users
        </div>
    </div>
    
    <div class="table-responsive">
        <table class="users-table">
            <thead>
                <tr>
                    <th class="checkbox-cell">
                        <input type="checkbox" id="selectAll" class="checkbox">
                    </th>
                    <th>User</th>
                    <th>Email</th>
                    <th>Phone</th>
                    <th>Status</th>
                    <th>Verified</th>
                    <th>Joined</th>
                    <th>Actions</th>
                </tr>
            </thead>
            <tbody>
                @forelse($users as $user)
                <tr>
                    <td class="checkbox-cell">
                        <input type="checkbox" name="user_ids[]" value="{{ $user->id }}" class="user-checkbox checkbox">
                    </td>
                    <td>
                        <div class="user-info">
                            <div class="user-avatar">
                                {{ strtoupper(substr($user->name, 0, 1)) }}
                            </div>
                            <div>
                                <div class="user-name">{{ $user->name }}</div>
                                <div class="user-id">ID: {{ $user->id }}</div>
                            </div>
                        </div>
                    </td>
                    <td>
                        {{ $user->email }}<br>
                        <small style="color: #6b7280;">
                            @if($user->email_verified_at)
                                <i class="fas fa-check-circle" style="color: #10b981;"></i> Verified
                            @else
                                <i class="fas fa-times-circle" style="color: #ef4444;"></i> Unverified
                            @endif
                        </small>
                    </td>
                    <td>
                        {{ $user->phone ?? 'N/A' }}
                    </td>
                    <td>
                        @if($user->status == 1)
                            <span class="badge badge-success">
                                <i class="fas fa-check-circle"></i> Active
                            </span>
                        @else
                            <span class="badge badge-danger">
                                <i class="fas fa-times-circle"></i> Inactive
                            </span>
                        @endif
                    </td>
                    <td>
                        @if($user->email_verified_at)
                            <span style="color: #10b981; font-weight: 600;">
                                <i class="fas fa-check"></i> Yes
                            </span>
                        @else
                            <span style="color: #ef4444; font-weight: 600;">
                                <i class="fas fa-times"></i> No
                            </span>
                        @endif
                    </td>
                    <td>
                        {{ $user->created_at->format('M d, Y') }}<br>
                        <small style="color: #6b7280;">{{ $user->created_at->diffForHumans() }}</small>
                    </td>
                    <td>
                        <div class="action-buttons-group">
                            <a href="{{ route('admin.users.show', $user) }}" class="btn-action btn-view" title="View">
                                <i class="fas fa-eye"></i>
                            </a>
                            <a href="{{ route('admin.users.edit', $user) }}" class="btn-action btn-edit" title="Edit">
                                <i class="fas fa-edit"></i>
                            </a>
                            <form action="{{ route('admin.users.destroy', $user) }}" method="POST" style="display: inline;" 
                                  onsubmit="return confirm('Are you sure you want to delete this user?')">
                                @csrf
                                @method('DELETE')
                                <button type="submit" class="btn-action btn-delete" title="Delete">
                                    <i class="fas fa-trash"></i>
                                </button>
                            </form>
                        </div>
                    </td>
                </tr>
                @empty
                <tr>
                    <td colspan="8">
                        <div class="empty-state">
                            <div class="empty-icon">
                                <i class="fas fa-users-slash"></i>
                            </div>
                            <h4 style="color: #6b7280; margin-bottom: 0.5rem;">No users found</h4>
                            @if(request()->hasAny(['search', 'status', 'email_verified', 'date_from', 'date_to']))
                                <p style="font-size: 0.875rem;">Try adjusting your filters</p>
                            @endif
                        </div>
                    </td>
                </tr>
                @endforelse
            </tbody>
        </table>
    </div>
    
    <!-- Pagination -->
    @if($users->hasPages())
    <div class="pagination">
        <div class="pagination-info">
            Page {{ $users->currentPage() }} of {{ $users->lastPage() }}
        </div>
        <div class="pagination-links">
            {{-- Previous Page Link --}}
            @if($users->onFirstPage())
                <span class="page-link disabled">
                    <i class="fas fa-chevron-left"></i>
                </span>
            @else
                <a href="{{ $users->previousPageUrl() }}" class="page-link">
                    <i class="fas fa-chevron-left"></i>
                </a>
            @endif

            {{-- Pagination Elements --}}
            @php
                $start = max(1, $users->currentPage() - 2);
                $end = min($users->lastPage(), $users->currentPage() + 2);
            @endphp

            @if($start > 1)
                <a href="{{ $users->url(1) }}" class="page-link">1</a>
                @if($start > 2)
                    <span class="page-link disabled">...</span>
                @endif
            @endif

            @for($page = $start; $page <= $end; $page++)
                @if($page == $users->currentPage())
                    <span class="page-link active">{{ $page }}</span>
                @else
                    <a href="{{ $users->url($page) }}" class="page-link">{{ $page }}</a>
                @endif
            @endfor

            @if($end < $users->lastPage())
                @if($end < $users->lastPage() - 1)
                    <span class="page-link disabled">...</span>
                @endif
                <a href="{{ $users->url($users->lastPage()) }}" class="page-link">{{ $users->lastPage() }}</a>
            @endif

            {{-- Next Page Link --}}
            @if($users->hasMorePages())
                <a href="{{ $users->nextPageUrl() }}" class="page-link">
                    <i class="fas fa-chevron-right"></i>
                </a>
            @else
                <span class="page-link disabled">
                    <i class="fas fa-chevron-right"></i>
                </span>
            @endif
        </div>
    </div>
    @endif
</div>

<script>
    // Bulk selection
    document.addEventListener('DOMContentLoaded', function() {
        const selectAll = document.getElementById('selectAll');
        const userCheckboxes = document.querySelectorAll('.user-checkbox');
        const selectedCount = document.getElementById('selectedCount');
        
        // Select all checkbox
        selectAll.addEventListener('change', function() {
            userCheckboxes.forEach(checkbox => {
                checkbox.checked = this.checked;
            });
            updateSelectedCount();
        });
        
        // Individual checkbox change
        userCheckboxes.forEach(checkbox => {
            checkbox.addEventListener('change', function() {
                updateSelectedCount();
                // If all are checked, check select all
                const allChecked = Array.from(userCheckboxes).every(cb => cb.checked);
                selectAll.checked = allChecked;
            });
        });
        
        // Update selected count
        function updateSelectedCount() {
            const checkedCount = Array.from(userCheckboxes).filter(cb => cb.checked).length;
            selectedCount.textContent = checkedCount;
        }
        
        updateSelectedCount();
    });
    
    // Reset filters
    function resetFilters() {
        window.location.href = "{{ route('admin.users.index') }}";
    }
    
    // Export users
    function exportUsers(type) {
        window.location.href = "{{ route('admin.users.export') }}?type=" + type;
    }
    
    // Apply bulk action
    function applyBulkAction() {
        const form = document.getElementById('bulkActionForm');
        const actionSelect = form.querySelector('select[name="action"]');
        const action = actionSelect.value;
        const checkedBoxes = document.querySelectorAll('.user-checkbox:checked');
        
        if (!action) {
            alert('Please select an action');
            return;
        }
        
        if (checkedBoxes.length === 0) {
            alert('Please select at least one user');
            return;
        }
        
        // Add checked user IDs to form
        const userIdsInput = document.createElement('input');
        userIdsInput.type = 'hidden';
        userIdsInput.name = 'user_ids[]';
        
        checkedBoxes.forEach(checkbox => {
            const input = userIdsInput.cloneNode();
            input.value = checkbox.value;
            form.appendChild(input);
        });
        
        if (action === 'delete') {
            if (!confirm('Are you sure you want to delete the selected users?')) {
                return;
            }
        }
        
        form.submit();
    }
    
    // Auto-submit filters on enter in search
    document.querySelector('input[name="search"]').addEventListener('keypress', function(e) {
        if (e.key === 'Enter') {
            document.getElementById('filterForm').submit();
        }
    });
    
    // Add some interactive effects
    document.querySelectorAll('.stat-card').forEach(card => {
        card.addEventListener('mouseenter', function() {
            this.style.transform = 'translateY(-4px)';
        });
        
        card.addEventListener('mouseleave', function() {
            this.style.transform = 'translateY(0)';
        });
    });
</script>
@endsection