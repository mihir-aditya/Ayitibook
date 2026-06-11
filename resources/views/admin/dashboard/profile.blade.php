@extends('admin.layouts.basic')

@section('title', 'Profile')
@section('page-title', 'My Profile')

@section('content')
<div style="max-width: 800px;">
    <div class="stat-card">
        <h3 style="margin-top: 0; color: #374151; border-bottom: 2px solid #e5e7eb; padding-bottom: 10px;">
            <i class="fas fa-user-cog"></i> Profile Information
        </h3>
        
        <form action="{{ route('admin.profile.update') }}" method="POST">
            @csrf
            <div style="display: grid; grid-template-columns: 1fr 1fr; gap: 20px; margin-bottom: 20px;">
                <div>
                    <label style="display: block; margin-bottom: 8px; font-weight: 600; color: #374151;">Full Name</label>
                    <input type="text" name="name" value="{{ $admin->name }}" 
                           style="width: 100%; padding: 10px; border: 1px solid #d1d5db; border-radius: 8px;"
                           required>
                </div>
                
                <div>
                    <label style="display: block; margin-bottom: 8px; font-weight: 600; color: #374151;">Email</label>
                    <input type="email" name="email" value="{{ $admin->email }}" 
                           style="width: 100%; padding: 10px; border: 1px solid #d1d5db; border-radius: 8px;"
                           required>
                </div>
                
                <div>
                    <label style="display: block; margin-bottom: 8px; font-weight: 600; color: #374151;">Username</label>
                    <input type="text" name="username" value="{{ $admin->username }}" 
                           style="width: 100%; padding: 10px; border: 1px solid #d1d5db; border-radius: 8px;">
                </div>
                
                <div>
                    <label style="display: block; margin-bottom: 8px; font-weight: 600; color: #374151;">Phone</label>
                    <input type="text" name="phone" value="{{ $admin->phone }}" 
                           style="width: 100%; padding: 10px; border: 1px solid #d1d5db; border-radius: 8px;">
                </div>
            </div>
            
            <div style="display: flex; gap: 10px;">
                <button type="submit" style="background: #dc2626; color: white; border: none; padding: 12px 24px; border-radius: 8px; cursor: pointer; font-weight: 600;">
                    <i class="fas fa-save"></i> Update Profile
                </button>
                <button type="reset" style="background: #f3f4f6; color: #374151; border: 1px solid #d1d5db; padding: 12px 24px; border-radius: 8px; cursor: pointer;">
                    <i class="fas fa-undo"></i> Reset
                </button>
            </div>
        </form>
    </div>
    
    <div class="stat-card" style="margin-top: 30px;">
        <h3 style="margin-top: 0; color: #374151; border-bottom: 2px solid #e5e7eb; padding-bottom: 10px;">
            <i class="fas fa-key"></i> Change Password
        </h3>
        
        <form action="{{ route('admin.profile.change-password') }}" method="POST">
            @csrf
            <div style="margin-bottom: 20px;">
                <div style="display: grid; grid-template-columns: 1fr 1fr; gap: 20px; margin-bottom: 20px;">
                    <div>
                        <label style="display: block; margin-bottom: 8px; font-weight: 600; color: #374151;">Current Password</label>
                        <input type="password" name="current_password" 
                               style="width: 100%; padding: 10px; border: 1px solid #d1d5db; border-radius: 8px;"
                               required>
                    </div>
                    
                    <div>
                        <label style="display: block; margin-bottom: 8px; font-weight: 600; color: #374151;">New Password</label>
                        <input type="password" name="new_password" 
                               style="width: 100%; padding: 10px; border: 1px solid #d1d5db; border-radius: 8px;"
                               required>
                    </div>
                </div>
                
                <div>
                    <label style="display: block; margin-bottom: 8px; font-weight: 600; color: #374151;">Confirm New Password</label>
                    <input type="password" name="new_password_confirmation" 
                           style="width: 100%; max-width: 400px; padding: 10px; border: 1px solid #d1d5db; border-radius: 8px;"
                           required>
                </div>
            </div>
            
            <button type="submit" style="background: #dc2626; color: white; border: none; padding: 12px 24px; border-radius: 8px; cursor: pointer; font-weight: 600;">
                <i class="fas fa-key"></i> Change Password
            </button>
        </form>
    </div>
    
    <div class="stat-card" style="margin-top: 30px;">
        <h3 style="margin-top: 0; color: #374151; border-bottom: 2px solid #e5e7eb; padding-bottom: 10px;">
            <i class="fas fa-info-circle"></i> Account Information
        </h3>
        
        <div style="display: flex; justify-content: space-between; align-items: center; margin-bottom: 15px;">
            <div>
                <div style="font-weight: 600; color: #374151;">Account Type</div>
                <div style="color: #6b7280;">
                    <i class="fas fa-user-shield"></i>
                    {{ $admin->super_admin ? 'Super Administrator' : 'Administrator' }}
                </div>
            </div>
            <div>
                @if($admin->status == 1)
                    <span style="background: #d1fae5; color: #10b981; padding: 5px 15px; border-radius: 20px; font-size: 14px; font-weight: 600;">
                        Active
                    </span>
                @else
                    <span style="background: #fee2e2; color: #ef4444; padding: 5px 15px; border-radius: 20px; font-size: 14px; font-weight: 600;">
                        Inactive
                    </span>
                @endif
            </div>
        </div>
        
        <div style="color: #6b7280; margin-bottom: 10px;">
            <i class="fas fa-calendar-alt"></i>
            Joined {{ $admin->created_at->format('F d, Y') }}
        </div>
        
        @if($admin->last_login_at)
        <div style="color: #6b7280;">
            <i class="fas fa-sign-in-alt"></i>
            Last login: {{ $admin->last_login_at->format('M d, Y h:i A') }}
        </div>
        @endif
    </div>
</div>
@endsection