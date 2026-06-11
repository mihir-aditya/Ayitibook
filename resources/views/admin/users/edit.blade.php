@extends('admin.layouts.basic')

@section('title', 'Edit User: ' . $user->name)
@section('page-title', 'Edit User: ' . $user->name)

@section('content')
<div style="max-width: 800px;">
    <!-- Edit Form -->
    <div class="stat-card">
        <h3 style="margin-top: 0; color: #374151; border-bottom: 2px solid #e5e7eb; padding-bottom: 10px;">
            <i class="fas fa-user-edit"></i> Edit User Information
        </h3>
        
        <form action="{{ route('admin.users.update', $user) }}" method="POST">
            @csrf
            @method('PUT')
            
            <div style="display: grid; grid-template-columns: 1fr 1fr; gap: 20px; margin-bottom: 20px;">
                <!-- Basic Information -->
                <div style="grid-column: span 2;">
                    <h4 style="color: #dc2626; margin-bottom: 15px; padding-bottom: 5px; border-bottom: 1px solid #e5e7eb;">
                        <i class="fas fa-info-circle"></i> Basic Information
                    </h4>
                </div>
                
                <div>
                    <label style="display: block; margin-bottom: 8px; font-weight: 600; color: #374151;">Full Name *</label>
                    <input type="text" name="name" value="{{ old('name', $user->name) }}" 
                           style="width: 100%; padding: 10px; border: 1px solid #d1d5db; border-radius: 8px;"
                           required>
                    @error('name')
                        <div style="color: #ef4444; font-size: 12px; margin-top: 5px;">{{ $message }}</div>
                    @enderror
                </div>
                
                <div>
                    <label style="display: block; margin-bottom: 8px; font-weight: 600; color: #374151;">Email Address *</label>
                    <input type="email" name="email" value="{{ old('email', $user->email) }}" 
                           style="width: 100%; padding: 10px; border: 1px solid #d1d5db; border-radius: 8px;"
                           required>
                    @error('email')
                        <div style="color: #ef4444; font-size: 12px; margin-top: 5px;">{{ $message }}</div>
                    @enderror
                </div>
                
                <div>
                    <label style="display: block; margin-bottom: 8px; font-weight: 600; color: #374151;">Phone Number</label>
                    <input type="text" name="phone" value="{{ old('phone', $user->phone) }}" 
                           style="width: 100%; padding: 10px; border: 1px solid #d1d5db; border-radius: 8px;">
                    @error('phone')
                        <div style="color: #ef4444; font-size: 12px; margin-top: 5px;">{{ $message }}</div>
                    @enderror
                </div>
                
                <div>
                    <label style="display: block; margin-bottom: 8px; font-weight: 600; color: #374151;">Status *</label>
                    <select name="status" style="width: 100%; padding: 10px; border: 1px solid #d1d5db; border-radius: 8px;">
                        <option value="1" {{ old('status', $user->status) == '1' ? 'selected' : '' }}>Active</option>
                        <option value="0" {{ old('status', $user->status) == '0' ? 'selected' : '' }}>Inactive</option>
                    </select>
                </div>
                
                <!-- Email Verification -->
                <div style="margin-top: 10px;">
                    <label style="display: flex; align-items: center; gap: 8px; cursor: pointer;">
                        <input type="checkbox" name="verify_email" {{ $user->email_verified_at ? 'checked disabled' : '' }} style="transform: scale(1.2);">
                        <span style="font-weight: 600; color: #374151;">
                            Verify email
                            @if($user->email_verified_at)
                                <span style="color: #10b981;">(Already verified on {{ $user->email_verified_at->format('M d, Y') }})</span>
                            @endif
                        </span>
                    </label>
                    <div style="font-size: 12px; color: #6b7280; margin-top: 5px;">
                        Mark email as verified
                    </div>
                </div>
                
                <!-- Address Information -->
                <div style="grid-column: span 2; margin-top: 20px;">
                    <h4 style="color: #dc2626; margin-bottom: 15px; padding-bottom: 5px; border-bottom: 1px solid #e5e7eb;">
                        <i class="fas fa-map-marker-alt"></i> Address Information
                    </h4>
                </div>
                
                <div style="grid-column: span 2;">
                    <label style="display: block; margin-bottom: 8px; font-weight: 600; color: #374151;">Address</label>
                    <input type="text" name="address" value="{{ old('address', $user->address) }}" 
                           style="width: 100%; padding: 10px; border: 1px solid #d1d5db; border-radius: 8px;">
                </div>
                
                <div>
                    <label style="display: block; margin-bottom: 8px; font-weight: 600; color: #374151;">City</label>
                    <input type="text" name="city" value="{{ old('city', $user->city) }}" 
                           style="width: 100%; padding: 10px; border: 1px solid #d1d5db; border-radius: 8px;">
                </div>
                
                <div>
                    <label style="display: block; margin-bottom: 8px; font-weight: 600; color: #374151;">State</label>
                    <input type="text" name="state" value="{{ old('state', $user->state) }}" 
                           style="width: 100%; padding: 10px; border: 1px solid #d1d5db; border-radius: 8px;">
                </div>
                
                <div>
                    <label style="display: block; margin-bottom: 8px; font-weight: 600; color: #374151;">ZIP Code</label>
                    <input type="text" name="zip_code" value="{{ old('zip_code', $user->zip_code) }}" 
                           style="width: 100%; padding: 10px; border: 1px solid #d1d5db; border-radius: 8px;">
                </div>
                
                <div>
                    <label style="display: block; margin-bottom: 8px; font-weight: 600; color: #374151;">Country</label>
                    <input type="text" name="country" value="{{ old('country', $user->country) }}" 
                           style="width: 100%; padding: 10px; border: 1px solid #d1d5db; border-radius: 8px;">
                </div>
            </div>
            
            <div style="display: flex; gap: 10px; margin-top: 20px;">
                <button type="submit" style="background: #dc2626; color: white; border: none; padding: 12px 24px; border-radius: 8px; cursor: pointer; font-weight: 600;">
                    <i class="fas fa-save"></i> Update User
                </button>
                <a href="{{ route('admin.users.show', $user) }}" style="background: #f3f4f6; color: #374151; border: 1px solid #d1d5db; padding: 12px 24px; border-radius: 8px; text-decoration: none; display: inline-flex; align-items: center;">
                    <i class="fas fa-times"></i> Cancel
                </a>
            </div>
        </form>
    </div>
    
    <!-- Change Password Form -->
    <div class="stat-card" style="margin-top: 20px;">
        <h3 style="margin-top: 0; color: #374151; border-bottom: 2px solid #e5e7eb; padding-bottom: 10px;">
            <i class="fas fa-key"></i> Change Password
        </h3>
        
        <form action="{{ route('admin.users.update-password', $user) }}" method="POST">
            @csrf
            @method('PUT')
            
            <div style="display: grid; grid-template-columns: 1fr 1fr; gap: 20px; margin-bottom: 20px;">
                <div>
                    <label style="display: block; margin-bottom: 8px; font-weight: 600; color: #374151;">New Password *</label>
                    <input type="password" name="password" 
                           style="width: 100%; padding: 10px; border: 1px solid #d1d5db; border-radius: 8px;"
                           required>
                    @error('password')
                        <div style="color: #ef4444; font-size: 12px; margin-top: 5px;">{{ $message }}</div>
                    @enderror
                </div>
                
                <div>
                    <label style="display: block; margin-bottom: 8px; font-weight: 600; color: #374151;">Confirm Password *</label>
                    <input type="password" name="password_confirmation" 
                           style="width: 100%; padding: 10px; border: 1px solid #d1d5db; border-radius: 8px;"
                           required>
                </div>
            </div>
            
            <button type="submit" style="background: #dc2626; color: white; border: none; padding: 12px 24px; border-radius: 8px; cursor: pointer; font-weight: 600;">
                <i class="fas fa-key"></i> Change Password
            </button>
        </form>
    </div>
    
    <!-- Danger Zone -->
    <div class="stat-card" style="margin-top: 20px; border: 2px solid #fee2e2; background: #fef2f2;">
        <h3 style="margin-top: 0; color: #dc2626; border-bottom: 2px solid #fecaca; padding-bottom: 10px;">
            <i class="fas fa-exclamation-triangle"></i> Danger Zone
        </h3>
        
        <div style="display: flex; justify-content: space-between; align-items: center;">
            <div>
                <h4 style="margin: 0; color: #374151;">Delete User Account</h4>
                <p style="margin: 5px 0 0 0; color: #6b7280; font-size: 14px;">
                    Once deleted, the user account cannot be recovered.
                    @if($user->orders()->count() > 0)
                        <br><strong>Warning:</strong> This user has {{ $user->orders()->count() }} orders. Cannot delete users with existing orders.
                    @endif
                </p>
            </div>
            
            @if($user->orders()->count() == 0)
            <form action="{{ route('admin.users.destroy', $user) }}" method="POST" onsubmit="return confirm('Are you sure you want to delete this user? This action cannot be undone.')">
                @csrf
                @method('DELETE')
                <button type="submit" style="background: #ef4444; color: white; border: none; padding: 10px 20px; border-radius: 8px; cursor: pointer; font-weight: 600;">
                    <i class="fas fa-trash"></i> Delete User
                </button>
            </form>
            @else
            <button style="background: #9ca3af; color: white; border: none; padding: 10px 20px; border-radius: 8px; cursor: not-allowed;" disabled>
                <i class="fas fa-trash"></i> Cannot Delete
            </button>
            @endif
        </div>
    </div>
</div>

<script>
    // Password strength indicator for change password form
    document.querySelector('input[name="password"]').addEventListener('input', function(e) {
        const password = e.target.value;
        const strength = checkPasswordStrength(password);
        
        // Remove existing indicator
        const existingIndicator = document.getElementById('password-strength');
        if (existingIndicator) existingIndicator.remove();
        
        // Create new indicator
        const indicator = document.createElement('div');
        indicator.id = 'password-strength';
        indicator.style.marginTop = '5px';
        indicator.style.fontSize = '12px';
        
        if (password.length === 0) {
            indicator.style.color = '#6b7280';
            indicator.innerHTML = 'Enter a password';
        } else if (strength === 'weak') {
            indicator.style.color = '#ef4444';
            indicator.innerHTML = 'Weak password';
        } else if (strength === 'medium') {
            indicator.style.color = '#f59e0b';
            indicator.innerHTML = 'Medium strength';
        } else if (strength === 'strong') {
            indicator.style.color = '#10b981';
            indicator.innerHTML = 'Strong password';
        }
        
        e.target.parentNode.appendChild(indicator);
    });
    
    function checkPasswordStrength(password) {
        if (password.length < 6) return 'weak';
        if (password.length < 8) return 'medium';
        
        const hasUpperCase = /[A-Z]/.test(password);
        const hasLowerCase = /[a-z]/.test(password);
        const hasNumbers = /\d/.test(password);
        const hasSpecial = /[!@#$%^&*(),.?":{}|<>]/.test(password);
        
        let score = 0;
        if (hasUpperCase) score++;
        if (hasLowerCase) score++;
        if (hasNumbers) score++;
        if (hasSpecial) score++;
        
        if (score < 2) return 'weak';
        if (score < 4) return 'medium';
        return 'strong';
    }
</script>
@endsection