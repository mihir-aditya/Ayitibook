{{-- resources/views/admin/layouts/affiliate.blade.php --}}
@extends('admin.layouts.app')

@section('sidebar')
    <div class="sidebar-nav">
        <ul class="nav flex-column">
            <li class="nav-item">
                <a class="nav-link {{ request()->routeIs('admin.affiliate.*') ? 'active' : '' }}"
                   href="{{ route('admin.affiliate.index') }}">
                    <i class="fas fa-users"></i> Affiliates
                </a>
            </li>
            <li class="nav-item">
                <a class="nav-link {{ request()->routeIs('admin.affiliate.links.*') ? 'active' : '' }}"
                   href="{{ route('admin.affiliate.links.index') }}">
                    <i class="fas fa-link"></i> Affiliate Links
                </a>
            </li>
            <li class="nav-item">
                <a class="nav-link {{ request()->routeIs('admin.affiliate.clicks.*') ? 'active' : '' }}"
                   href="{{ route('admin.affiliate.clicks.index') }}">
                    <i class="fas fa-mouse-pointer"></i> Clicks
                </a>
            </li>
            <li class="nav-item">
                <a class="nav-link {{ request()->routeIs('admin.affiliate.commissions.*') ? 'active' : '' }}"
                   href="{{ route('admin.affiliate.commissions.index') }}">
                    <i class="fas fa-dollar-sign"></i> Commissions
                </a>
            </li>
        </ul>
    </div>
@endsection