@extends('admin.layouts.basic')

@section('title', 'Create New Seller')
@section('page-title', 'Create New Seller')

@section('content')
    <style>
        .form-container {
            max-width: 900px;
            margin: 0 auto;
        }

        .form-card {
            background: white;
            border-radius: 12px;
            padding: 2rem;
            box-shadow: 0 4px 6px -1px rgba(0, 0, 0, 0.1);
            border: 1px solid #e5e7eb;
        }

        .form-title {
            font-size: 1.5rem;
            font-weight: 600;
            color: #111827;
            margin: 0 0 1.5rem 0;
            padding-bottom: 1rem;
            border-bottom: 2px solid #e5e7eb;
            display: flex;
            align-items: center;
            gap: 0.5rem;
        }

        .form-section {
            margin-bottom: 2rem;
        }

        .section-title {
            font-size: 1.125rem;
            font-weight: 600;
            color: #dc2626;
            margin: 0 0 1rem 0;
            padding-bottom: 0.5rem;
            border-bottom: 1px solid #e5e7eb;
            display: flex;
            align-items: center;
            gap: 0.5rem;
        }

        .form-grid {
            display: grid;
            grid-template-columns: repeat(auto-fit, minmax(250px, 1fr));
            gap: 1.5rem;
        }

        .form-group {
            display: flex;
            flex-direction: column;
        }

        .form-label {
            font-size: 0.875rem;
            font-weight: 600;
            color: #374151;
            margin-bottom: 0.5rem;
        }

        .form-label.required::after {
            content: ' *';
            color: #dc2626;
        }

        .form-input,
        .form-select,
        .form-textarea {
            padding: 0.75rem 1rem;
            border: 1px solid #d1d5db;
            border-radius: 8px;
            font-size: 0.875rem;
            width: 100%;
            transition: border-color 0.3s;
        }

        .form-input:focus,
        .form-select:focus,
        .form-textarea:focus {
            outline: none;
            border-color: #dc2626;
            box-shadow: 0 0 0 3px rgba(220, 38, 38, 0.1);
        }

        .form-textarea {
            min-height: 100px;
            resize: vertical;
        }

        .checkbox-group {
            display: flex;
            align-items: center;
            gap: 0.5rem;
            margin-bottom: 0.5rem;
        }

        .checkbox-label {
            font-size: 0.875rem;
            font-weight: 500;
            color: #374151;
            cursor: pointer;
        }

        .form-checkbox {
            width: 18px;
            height: 18px;
            border-radius: 4px;
            border: 1px solid #d1d5db;
            cursor: pointer;
        }

        .form-help {
            font-size: 0.75rem;
            color: #6b7280;
            margin-top: 0.25rem;
        }

        .error-message {
            font-size: 0.75rem;
            color: #dc2626;
            margin-top: 0.25rem;
        }

        .form-actions {
            display: flex;
            gap: 1rem;
            margin-top: 2rem;
            padding-top: 1.5rem;
            border-top: 1px solid #e5e7eb;
        }

        @media (max-width: 768px) {
            .form-card {
                padding: 1.5rem;
            }

            .form-grid {
                grid-template-columns: 1fr;
            }

            .form-actions {
                flex-direction: column;
            }
        }
    </style>

    <div class="form-container">
        <div class="form-card">
            <h2 class="form-title">
                <i class="fas fa-user-plus"></i> Create New Seller
            </h2>

            <form action="{{ route('admin.sellers.store') }}" method="POST">
                @csrf

                <!-- Basic Information -->
                <div class="form-section">
                    <h3 class="section-title">
                        <i class="fas fa-info-circle"></i> Basic Information
                    </h3>
                    <div class="form-grid">
                        <div class="form-group">
                            <label class="form-label required">Full Name</label>
                            <input type="text" name="name" value="{{ old('name') }}" class="form-input" required>
                            @error('name')
                                <div class="error-message">{{ $message }}</div>
                            @enderror
                        </div>

                        <div class="form-group">
                            <label class="form-label required">Username</label>
                            <input type="text" name="username" value="{{ old('username') }}" class="form-input" required>
                            @error('username')
                                <div class="error-message">{{ $message }}</div>
                            @enderror
                        </div>

                        <div class="form-group">
                            <label class="form-label required">Email Address</label>
                            <input type="email" name="email" value="{{ old('email') }}" class="form-input" required>
                            @error('email')
                                <div class="error-message">{{ $message }}</div>
                            @enderror
                        </div>

                        <div class="form-group">
                            <label class="form-label">Phone Number</label>
                            <input type="text" name="phone" value="{{ old('phone') }}" class="form-input">
                            @error('phone')
                                <div class="error-message">{{ $message }}</div>
                            @enderror
                        </div>

                        <div class="form-group">
                            <label class="form-label required">Password</label>
                            <input type="password" name="password" class="form-input" required>
                            @error('password')
                                <div class="error-message">{{ $message }}</div>
                            @enderror
                            <div class="form-help">Minimum 8 characters</div>
                        </div>

                        <div class="form-group">
                            <label class="form-label required">Confirm Password</label>
                            <input type="password" name="password_confirmation" class="form-input" required>
                        </div>
                    </div>
                </div>

                <!-- Shop Information -->
                <div class="form-section">
                    <h3 class="section-title">
                        <i class="fas fa-store"></i> Shop Information
                    </h3>
                    <div class="form-grid">
                        <div class="form-group">
                            <label class="form-label required">Shop Name</label>
                            <input type="text" name="shop_name" value="{{ old('shop_name') }}" class="form-input"
                                required>
                            @error('shop_name')
                                <div class="error-message">{{ $message }}</div>
                            @enderror
                        </div>

                        <div class="form-group">
                            <label class="form-label required">Shop Slug</label>
                            <input type="text" name="shop_slug" value="{{ old('shop_slug') }}" class="form-input"
                                required>
                            <div class="form-help">Unique identifier for the shop URL</div>
                            @error('shop_slug')
                                <div class="error-message">{{ $message }}</div>
                            @enderror
                        </div>

                        <div class="form-group" style="grid-column: span 2;">
                            <label class="form-label">Shop Address</label>
                            <textarea name="shop_address" class="form-textarea">{{ old('shop_address') }}</textarea>
                            @error('shop_address')
                                <div class="error-message">{{ $message }}</div>
                            @enderror
                        </div>
                    </div>
                </div>

                <!-- Business Information -->
                <div class="form-section">
                    <h3 class="section-title">
                        <i class="fas fa-building"></i> Business Information
                    </h3>
                    <div class="form-grid">
                        <div class="form-group">
                            <label class="form-label">GST Number</label>
                            <input type="text" name="gst_number" value="{{ old('gst_number') }}" class="form-input">
                            @error('gst_number')
                                <div class="error-message">{{ $message }}</div>
                            @enderror
                        </div>

                        <div class="form-group">
                            <label class="form-label">PAN Number</label>
                            <input type="text" name="pan_number" value="{{ old('pan_number') }}" class="form-input">
                            @error('pan_number')
                                <div class="error-message">{{ $message }}</div>
                            @enderror
                        </div>
                    </div>
                </div>

                <!-- Status & Settings -->
                <div class="form-section">
                    <h3 class="section-title">
                        <i class="fas fa-cog"></i> Status & Settings
                    </h3>
                    <div class="form-grid">
                        <div class="form-group">
                            <label class="form-label required">Status</label>
                            <select name="status" class="form-select" required>
                                <option value="pending" {{ old('status') == 'pending' ? 'selected' : '' }}>Pending
                                </option>
                                <option value="approved" {{ old('status') == 'approved' ? 'selected' : '' }}>Approved
                                </option>
                                <option value="rejected" {{ old('status') == 'rejected' ? 'selected' : '' }}>Rejected
                                </option>
                            </select>
                            @error('status')
                                <div class="error-message">{{ $message }}</div>
                            @enderror
                        </div>

                        <div class="form-group">
                            <div class="checkbox-group">
                                <input type="checkbox" name="is_verified" value="1" id="is_verified"
                                    class="form-checkbox" {{ old('is_verified') ? 'checked' : '' }}>
                                <label for="is_verified" class="checkbox-label">Mark as Verified</label>
                            </div>
                            <div class="form-help">Verified sellers gain customer trust</div>
                            @error('is_verified')
                                <div class="error-message">{{ $message }}</div>
                            @enderror
                        </div>
                    </div>
                </div>
                <!-- Address Information -->
                <div class="form-section">
                    <h3 class="section-title">
                        <i class="fas fa-map-marker-alt"></i> Address Information
                    </h3>
                    <div class="form-grid">
                        <div class="form-group" style="grid-column: span 2;">
                            <label class="form-label">Address</label>
                            <input type="text" name="address" value="{{ old('address') }}" class="form-input">
                            @error('address')
                                <div class="error-message">{{ $message }}</div>
                            @enderror
                        </div>

                        <div class="form-group">
                            <label class="form-label">City</label>
                            <input type="text" name="city" value="{{ old('city') }}" class="form-input">
                            @error('city')
                                <div class="error-message">{{ $message }}</div>
                            @enderror
                        </div>

                        <div class="form-group">
                            <label class="form-label">State</label>
                            <input type="text" name="state" value="{{ old('state') }}" class="form-input">
                            @error('state')
                                <div class="error-message">{{ $message }}</div>
                            @enderror
                        </div>

                        <div class="form-group">
                            <label class="form-label">ZIP Code</label>
                            <input type="text" name="zip_code" value="{{ old('zip_code') }}" class="form-input">
                            @error('zip_code')
                                <div class="error-message">{{ $message }}</div>
                            @enderror
                        </div>

                        <div class="form-group">
                            <label class="form-label">Country</label>
                            <input type="text" name="country" value="{{ old('country') }}" class="form-input">
                            @error('country')
                                <div class="error-message">{{ $message }}</div>
                            @enderror
                        </div>
                    </div>
                </div>

                <!-- Business Information -->
                <div class="form-section">
                    <h3 class="section-title">
                        <i class="fas fa-building"></i> Business Information
                    </h3>
                    <div class="form-grid">
                        <div class="form-group">
                            <label class="form-label">Tax Number</label>
                            <input type="text" name="tax_number" value="{{ old('tax_number') }}" class="form-input">
                            @error('tax_number')
                                <div class="error-message">{{ $message }}</div>
                            @enderror
                        </div>

                        <div class="form-group">
                            <label class="form-label">Bank Name</label>
                            <input type="text" name="bank_name" value="{{ old('bank_name') }}" class="form-input">
                            @error('bank_name')
                                <div class="error-message">{{ $message }}</div>
                            @enderror
                        </div>

                        <div class="form-group">
                            <label class="form-label">Bank Account Number</label>
                            <input type="text" name="bank_account" value="{{ old('bank_account') }}"
                                class="form-input">
                            @error('bank_account')
                                <div class="error-message">{{ $message }}</div>
                            @enderror
                        </div>
                    </div>
                </div>

                <!-- Form Actions -->
                <div class="form-actions">
                    <button type="submit"
                        style="background: linear-gradient(135deg, #dc2626 0%, #b91c1c 100%); color: white; border: none; padding: 0.75rem 1.5rem; border-radius: 8px; font-weight: 600; cursor: pointer; display: inline-flex; align-items: center; gap: 0.5rem;">
                        <i class="fas fa-save"></i> Create Seller
                    </button>
                    <a href="{{ route('admin.sellers.index') }}"
                        style="background: #f3f4f6; color: #374151; border: 1px solid #d1d5db; padding: 0.75rem 1.5rem; border-radius: 8px; text-decoration: none; display: inline-flex; align-items: center; gap: 0.5rem;">
                        <i class="fas fa-times"></i> Cancel
                    </a>
                </div>
            </form>
        </div>
    </div>

    <script>
        // Auto-generate slug from shop name
        document.querySelector('input[name="shop_name"]').addEventListener('input', function(e) {
            const slugInput = document.querySelector('input[name="shop_slug"]');
            if (!slugInput.value || slugInput.dataset.autoGenerated === 'true') {
                const slug = e.target.value
                    .toLowerCase()
                    .replace(/[^\w\s-]/g, '')
                    .replace(/\s+/g, '-')
                    .replace(/--+/g, '-')
                    .trim();
                slugInput.value = slug;
                slugInput.dataset.autoGenerated = 'true';
            }
        });

        // Reset auto-generated flag when user manually edits slug
        document.querySelector('input[name="shop_slug"]').addEventListener('input', function(e) {
            if (e.target.value) {
                e.target.dataset.autoGenerated = 'false';
            }
        });

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
    @endsection@extends('admin.layouts.basic')

@section('title', 'Create New Seller')
@section('page-title', 'Create New Seller')

@section('content')
    <style>
        .form-container {
            max-width: 900px;
            margin: 0 auto;
        }

        .form-card {
            background: white;
            border-radius: 12px;
            padding: 2rem;
            box-shadow: 0 4px 6px -1px rgba(0, 0, 0, 0.1);
            border: 1px solid #e5e7eb;
        }

        .form-title {
            font-size: 1.5rem;
            font-weight: 600;
            color: #111827;
            margin: 0 0 1.5rem 0;
            padding-bottom: 1rem;
            border-bottom: 2px solid #e5e7eb;
            display: flex;
            align-items: center;
            gap: 0.5rem;
        }

        .form-section {
            margin-bottom: 2rem;
        }

        .section-title {
            font-size: 1.125rem;
            font-weight: 600;
            color: #dc2626;
            margin: 0 0 1rem 0;
            padding-bottom: 0.5rem;
            border-bottom: 1px solid #e5e7eb;
            display: flex;
            align-items: center;
            gap: 0.5rem;
        }

        .form-grid {
            display: grid;
            grid-template-columns: repeat(auto-fit, minmax(250px, 1fr));
            gap: 1.5rem;
        }

        .form-group {
            display: flex;
            flex-direction: column;
        }

        .form-label {
            font-size: 0.875rem;
            font-weight: 600;
            color: #374151;
            margin-bottom: 0.5rem;
        }

        .form-label.required::after {
            content: ' *';
            color: #dc2626;
        }

        .form-input,
        .form-select,
        .form-textarea {
            padding: 0.75rem 1rem;
            border: 1px solid #d1d5db;
            border-radius: 8px;
            font-size: 0.875rem;
            width: 100%;
            transition: border-color 0.3s;
        }

        .form-input:focus,
        .form-select:focus,
        .form-textarea:focus {
            outline: none;
            border-color: #dc2626;
            box-shadow: 0 0 0 3px rgba(220, 38, 38, 0.1);
        }

        .form-textarea {
            min-height: 100px;
            resize: vertical;
        }

        .checkbox-group {
            display: flex;
            align-items: center;
            gap: 0.5rem;
            margin-bottom: 0.5rem;
        }

        .checkbox-label {
            font-size: 0.875rem;
            font-weight: 500;
            color: #374151;
            cursor: pointer;
        }

        .form-checkbox {
            width: 18px;
            height: 18px;
            border-radius: 4px;
            border: 1px solid #d1d5db;
            cursor: pointer;
        }

        .form-help {
            font-size: 0.75rem;
            color: #6b7280;
            margin-top: 0.25rem;
        }

        .error-message {
            font-size: 0.75rem;
            color: #dc2626;
            margin-top: 0.25rem;
        }

        .form-actions {
            display: flex;
            gap: 1rem;
            margin-top: 2rem;
            padding-top: 1.5rem;
            border-top: 1px solid #e5e7eb;
        }

        @media (max-width: 768px) {
            .form-card {
                padding: 1.5rem;
            }

            .form-grid {
                grid-template-columns: 1fr;
            }

            .form-actions {
                flex-direction: column;
            }
        }
    </style>

    <div class="form-container">
        <div class="form-card">
            <h2 class="form-title">
                <i class="fas fa-user-plus"></i> Create New Seller
            </h2>

            <form action="{{ route('admin.sellers.store') }}" method="POST">
                @csrf

                <!-- Basic Information -->
                <div class="form-section">
                    <h3 class="section-title">
                        <i class="fas fa-info-circle"></i> Basic Information
                    </h3>
                    <div class="form-grid">
                        <div class="form-group">
                            <label class="form-label required">Full Name</label>
                            <input type="text" name="name" value="{{ old('name') }}" class="form-input"
                                required>
                            @error('name')
                                <div class="error-message">{{ $message }}</div>
                            @enderror
                        </div>

                        <div class="form-group">
                            <label class="form-label required">Email Address</label>
                            <input type="email" name="email" value="{{ old('email') }}" class="form-input"
                                required>
                            @error('email')
                                <div class="error-message">{{ $message }}</div>
                            @enderror
                        </div>

                        <div class="form-group">
                            <label class="form-label">Phone Number</label>
                            <input type="text" name="phone" value="{{ old('phone') }}" class="form-input">
                            @error('phone')
                                <div class="error-message">{{ $message }}</div>
                            @enderror
                        </div>

                        <div class="form-group">
                            <label class="form-label required">Password</label>
                            <input type="password" name="password" class="form-input" required>
                            @error('password')
                                <div class="error-message">{{ $message }}</div>
                            @enderror
                            <div class="form-help">Minimum 8 characters</div>
                        </div>

                        <div class="form-group">
                            <label class="form-label required">Confirm Password</label>
                            <input type="password" name="password_confirmation" class="form-input" required>
                        </div>
                    </div>
                </div>

                <!-- Shop Information -->
                <div class="form-section">
                    <h3 class="section-title">
                        <i class="fas fa-store"></i> Shop Information
                    </h3>
                    <div class="form-grid">
                        <div class="form-group">
                            <label class="form-label required">Shop Name</label>
                            <input type="text" name="shop_name" value="{{ old('shop_name') }}" class="form-input"
                                required>
                            @error('shop_name')
                                <div class="error-message">{{ $message }}</div>
                            @enderror
                        </div>

                        <div class="form-group">
                            <label class="form-label">Shop Slug</label>
                            <input type="text" name="shop_slug" value="{{ old('shop_slug') }}" class="form-input">
                            <div class="form-help">Leave empty to auto-generate from shop name</div>
                            @error('shop_slug')
                                <div class="error-message">{{ $message }}</div>
                            @enderror
                        </div>

                        <div class="form-group" style="grid-column: span 2;">
                            <label class="form-label">Shop Description</label>
                            <textarea name="shop_description" class="form-textarea">{{ old('shop_description') }}</textarea>
                            @error('shop_description')
                                <div class="error-message">{{ $message }}</div>
                            @enderror
                        </div>
                    </div>
                </div>

                <!-- Status & Settings -->
                <div class="form-section">
                    <h3 class="section-title">
                        <i class="fas fa-cog"></i> Status & Settings
                    </h3>
                    <div class="form-grid">
                        <div class="form-group">
                            <label class="form-label required">Status</label>
                            <select name="status" class="form-select" required>
                                <option value="1" {{ old('status') == '1' ? 'selected' : '' }}>Active</option>
                                <option value="0" {{ old('status') == '0' ? 'selected' : '' }}>Inactive</option>
                            </select>
                            @error('status')
                                <div class="error-message">{{ $message }}</div>
                            @enderror
                        </div>

                        <div class="form-group">
                            <div class="checkbox-group">
                                <input type="checkbox" name="is_featured" value="1" id="is_featured"
                                    class="form-checkbox" {{ old('is_featured') ? 'checked' : '' }}>
                                <label for="is_featured" class="checkbox-label">Mark as Featured Seller</label>
                            </div>
                            <div class="form-help">Featured sellers appear prominently on the site</div>
                            @error('is_featured')
                                <div class="error-message">{{ $message }}</div>
                            @enderror
                        </div>

                        <div class="form-group">
                            <div class="checkbox-group">
                                <input type="checkbox" name="verify_email" value="1" id="verify_email"
                                    class="form-checkbox" {{ old('verify_email') ? 'checked' : '' }}>
                                <label for="verify_email" class="checkbox-label">Verify email immediately</label>
                            </div>
                            <div class="form-help">Seller won't need to verify their email</div>
                        </div>
                    </div>
                </div>

                <!-- Address Information -->
                <div class="form-section">
                    <h3 class="section-title">
                        <i class="fas fa-map-marker-alt"></i> Address Information
                    </h3>
                    <div class="form-grid">
                        <div class="form-group" style="grid-column: span 2;">
                            <label class="form-label">Address</label>
                            <input type="text" name="address" value="{{ old('address') }}" class="form-input">
                            @error('address')
                                <div class="error-message">{{ $message }}</div>
                            @enderror
                        </div>

                        <div class="form-group">
                            <label class="form-label">City</label>
                            <input type="text" name="city" value="{{ old('city') }}" class="form-input">
                            @error('city')
                                <div class="error-message">{{ $message }}</div>
                            @enderror
                        </div>

                        <div class="form-group">
                            <label class="form-label">State</label>
                            <input type="text" name="state" value="{{ old('state') }}" class="form-input">
                            @error('state')
                                <div class="error-message">{{ $message }}</div>
                            @enderror
                        </div>

                        <div class="form-group">
                            <label class="form-label">ZIP Code</label>
                            <input type="text" name="zip_code" value="{{ old('zip_code') }}" class="form-input">
                            @error('zip_code')
                                <div class="error-message">{{ $message }}</div>
                            @enderror
                        </div>

                        <div class="form-group">
                            <label class="form-label">Country</label>
                            <input type="text" name="country" value="{{ old('country') }}" class="form-input">
                            @error('country')
                                <div class="error-message">{{ $message }}</div>
                            @enderror
                        </div>
                    </div>
                </div>

                <!-- Business Information -->
                <div class="form-section">
                    <h3 class="section-title">
                        <i class="fas fa-building"></i> Business Information
                    </h3>
                    <div class="form-grid">
                        <div class="form-group">
                            <label class="form-label">Tax Number</label>
                            <input type="text" name="tax_number" value="{{ old('tax_number') }}" class="form-input">
                            @error('tax_number')
                                <div class="error-message">{{ $message }}</div>
                            @enderror
                        </div>

                        <div class="form-group">
                            <label class="form-label">Bank Name</label>
                            <input type="text" name="bank_name" value="{{ old('bank_name') }}" class="form-input">
                            @error('bank_name')
                                <div class="error-message">{{ $message }}</div>
                            @enderror
                        </div>

                        <div class="form-group">
                            <label class="form-label">Bank Account Number</label>
                            <input type="text" name="bank_account" value="{{ old('bank_account') }}"
                                class="form-input">
                            @error('bank_account')
                                <div class="error-message">{{ $message }}</div>
                            @enderror
                        </div>
                    </div>
                </div>

                <!-- Form Actions -->
                <div class="form-actions">
                    <button type="submit"
                        style="background: linear-gradient(135deg, #dc2626 0%, #b91c1c 100%); color: white; border: none; padding: 0.75rem 1.5rem; border-radius: 8px; font-weight: 600; cursor: pointer; display: inline-flex; align-items: center; gap: 0.5rem;">
                        <i class="fas fa-save"></i> Create Seller
                    </button>
                    <a href="{{ route('admin.sellers.index') }}"
                        style="background: #f3f4f6; color: #374151; border: 1px solid #d1d5db; padding: 0.75rem 1.5rem; border-radius: 8px; text-decoration: none; display: inline-flex; align-items: center; gap: 0.5rem;">
                        <i class="fas fa-times"></i> Cancel
                    </a>
                </div>
            </form>
        </div>
    </div>

    <script>
        // Auto-generate slug from shop name
        document.querySelector('input[name="shop_name"]').addEventListener('input', function(e) {
            const slugInput = document.querySelector('input[name="shop_slug"]');
            if (!slugInput.value || slugInput.dataset.autoGenerated === 'true') {
                const slug = e.target.value
                    .toLowerCase()
                    .replace(/[^\w\s-]/g, '')
                    .replace(/\s+/g, '-')
                    .replace(/--+/g, '-')
                    .trim();
                slugInput.value = slug;
                slugInput.dataset.autoGenerated = 'true';
            }
        });

        // Reset auto-generated flag when user manually edits slug
        document.querySelector('input[name="shop_slug"]').addEventListener('input', function(e) {
            if (e.target.value) {
                e.target.dataset.autoGenerated = 'false';
            }
        });

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
