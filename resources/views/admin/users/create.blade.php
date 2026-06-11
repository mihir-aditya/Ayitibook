@extends('admin.layouts.basic')

@section('title', 'Create New User')
@section('page-title', 'Create New User')

@section('content')
<div style="max-width: 800px;">
    <div class="stat-card">
        <h3 style="margin-top: 0; color: #374151; border-bottom: 2px solid #e5e7eb; padding-bottom: 10px;">
            <i class="fas fa-user-plus"></i> Create New User
        </h3>
        
        <form action="{{ route('admin.users.store') }}" method="POST">
            @csrf
            
            <div style="display: grid; grid-template-columns: 1fr 1fr; gap: 20px; margin-bottom: 20px;">
                <!-- Basic Information -->
                <div style="grid-column: span 2;">
                    <h4 style="color: #dc2626; margin-bottom: 15px; padding-bottom: 5px; border-bottom: 1px solid #e5e7eb;">
                        <i class="fas fa-info-circle"></i> Basic Information
                    </h4>
                </div>
                
                <div>
                    <label style="display: block; margin-bottom: 8px; font-weight: 600; color: #374151;">Full Name *</label>
                    <input type="text" name="name" value="{{ old('name') }}" 
                           style="width: 100%; padding: 10px; border: 1px solid #d1d5db; border-radius: 8px;"
                           required>
                    @error('name')
                        <div style="color: #ef4444; font-size: 12px; margin-top: 5px;">{{ $message }}</div>
                    @enderror
                </div>
                
                <div>
                    <label style="display: block; margin-bottom: 8px; font-weight: 600; color: #374151;">Email Address *</label>
                    <input type="email" name="email" value="{{ old('email') }}" 
                           style="width: 100%; padding: 10px; border: 1px solid #d1d5db; border-radius: 8px;"
                           required>
                    @error('email')
                        <div style="color: #ef4444; font-size: 12px; margin-top: 5px;">{{ $message }}</div>
                    @enderror
                </div>
                
                <div>
                    <label style="display: block; margin-bottom: 8px; font-weight: 600; color: #374151;">Phone Number</label>
                    <input type="text" name="phone" value="{{ old('phone') }}" 
                           style="width: 100%; padding: 10px; border: 1px solid #d1d5db; border-radius: 8px;">
                    @error('phone')
                        <div style="color: #ef4444; font-size: 12px; margin-top: 5px;">{{ $message }}</div>
                    @enderror
                </div>
                
                <div>
                    <label style="display: block; margin-bottom: 8px; font-weight: 600; color: #374151;">Status *</label>
                    <select name="status" style="width: 100%; padding: 10px; border: 1px solid #d1d5db; border-radius: 8px;">
                        <option value="1" {{ old('status') == '1' ? 'selected' : '' }}>Active</option>
                        <option value="0" {{ old('status') == '0' ? 'selected' : '' }}>Inactive</option>
                    </select>
                </div>
                
                <!-- Password -->
                <div style="grid-column: span 2; margin-top: 10px;">
                    <h4 style="color: #dc2626; margin-bottom: 15px; padding-bottom: 5px; border-bottom: 1px solid #e5e7eb;">
                        <i class="fas fa-key"></i> Password
                    </h4>
                </div>
                
                <div>
                    <label style="display: block; margin-bottom: 8px; font-weight: 600; color: #374151;">Password *</label>
                    <input type="password" name="password" 
                           style="width: 100%; padding: 10px; border: 1px solid #d1d5db; border-radius: 8px;"
                           required>
                    @error('password')
                        <div style="color: #ef4444; font-size: 12px; margin-top: 5px;">{{ $message }}</div>
                    @enderror
                    <div style="font-size: 12px; color: #6b7280; margin-top: 5px;">Minimum 8 characters</div>
                </div>
                
                <div>
                    <label style="display: block; margin-bottom: 8px; font-weight: 600; color: #374151;">Confirm Password *</label>
                    <input type="password" name="password_confirmation" 
                           style="width: 100%; padding: 10px; border: 1px solid #d1d5db; border-radius: 8px;"
                           required>
                </div>
                
                <!-- Email Verification -->
                <div style="margin-top: 10px;">
                    <label style="display: flex; align-items: center; gap: 8px; cursor: pointer;">
                        <input type="checkbox" name="verify_email" style="transform: scale(1.2);">
                        <span style="font-weight: 600; color: #374151;">Verify email immediately</span>
                    </label>
                    <div style="font-size: 12px; color: #6b7280; margin-top: 5px;">
                        User won't need to verify their email
                    </div>
                </div>
                
                <!-- Address Information -->
                <div style="grid-column: span 2; margin-top: 20px;">
                    <h4 style="color: #dc2626; margin-bottom: 15px; padding-bottom: 5px; border-bottom: 1px solid #e5e7eb;">
                        <i class="fas fa-map-marker-alt"></i> Address Information (Optional)
                    </h4>
                </div>
                
                <div style="grid-column: span 2;">
                    <label style="display: block; margin-bottom: 8px; font-weight: 600; color: #374151;">Address</label>
                    <input type="text" name="address" value="{{ old('address') }}" 
                           style="width: 100%; padding: 10px; border: 1px solid #d1d5db; border-radius: 8px;">
                </div>
                
                <div>
                    <label style="display: block; margin-bottom: 8px; font-weight: 600; color: #374151;">City</label>
                    <input type="text" name="city" value="{{ old('city') }}" 
                           style="width: 100%; padding: 10px; border: 1px solid #d1d5db; border-radius: 8px;">
                </div>
                
                <div>
                    <label style="display: block; margin-bottom: 8px; font-weight: 600; color: #374151;">State</label>
                    <input type="text" name="state" value="{{ old('state') }}" 
                           style="width: 100%; padding: 10px; border: 1px solid #d1d5db; border-radius: 8px;">
                </div>
                
                <div>
                    <label style="display: block; margin-bottom: 8px; font-weight: 600; color: #374151;">ZIP Code</label>
                    <input type="text" name="zip_code" value="{{ old('zip_code') }}" 
                           style="width: 100%; padding: 10px; border: 1px solid #d1d5db; border-radius: 8px;">
                </div>
                
                <div>
                    <label style="display: block; margin-bottom: 8px; font-weight: 600; color: #374151;">Country</label>
                    <input type="text" name="country" value="{{ old('country') }}" 
                           style="width: 100%; padding: 10px; border: 1px solid #d1d5db; border-radius: 8px;">
                </div>
            </div>
            
            <div style="display: flex; gap: 10px; margin-top: 20px;">
                <button type="submit" style="background: #dc2626; color: white; border: none; padding: 12px 24px; border-radius: 8px; cursor: pointer; font-weight: 600;">
                    <i class="fas fa-save"></i> Create User
                </button>
                <a href="{{ route('admin.users.index') }}" style="background: #f3f4f6; color: #374151; border: 1px solid #d1d5db; padding: 12px 24px; border-radius: 8px; text-decoration: none; display: inline-flex; align-items: center;">
                    <i class="fas fa-times"></i> Cancel
                </a>
            </div>
        </form>
    </div>
</div>

<script>
    // Password strength indicator
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