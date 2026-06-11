<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Create Affiliate Link | Corporate Partner Portal</title>
    <script src="https://cdn.tailwindcss.com"></script>
    <link href="https://fonts.googleapis.com/css2?family=Inter:wght@400;500;600;700&display=swap" rel="stylesheet">
    <style>
        * { font-family: 'Inter', sans-serif; }
        body { 
            background: linear-gradient(135deg, #667eea 0%, #764ba2 100%);
            min-height: 100vh;
            display: flex;
            align-items: center;
            justify-content: center;
        }
        .form-card { 
            background: #ffffff;
            border-radius: 8px;
            box-shadow: 0 20px 40px rgba(0,0,0,0.1);
            width: 100%;
            max-width: 520px;
        }
        .form-header {
            background: #f8fafc;
            border-bottom: 1px solid #e9ecef;
            padding: 1.5rem;
        }
        .form-body {
            padding: 2rem;
        }
        .form-label {
            display: block;
            font-size: 0.875rem;
            font-weight: 600;
            color: #334155;
            margin-bottom: 0.5rem;
        }
        .form-input, .form-select {
            width: 100%;
            padding: 0.625rem 0.875rem;
            border: 1px solid #cbd5e1;
            border-radius: 6px;
            font-size: 0.875rem;
            color: #1e293b;
            transition: all 0.2s;
        }
        .form-input:focus, .form-select:focus {
            outline: none;
            border-color: #4f46e5;
            box-shadow: 0 0 0 3px rgba(79, 70, 229, 0.1);
        }
        .btn-primary {
            background: #4f46e5;
            color: white;
            font-weight: 500;
            font-size: 0.875rem;
            padding: 0.75rem 1.5rem;
            border-radius: 6px;
            border: none;
            cursor: pointer;
            transition: background 0.2s;
        }
        .btn-primary:hover {
            background: #4338ca;
        }
        .btn-secondary {
            background: white;
            color: #475569;
            font-weight: 500;
            font-size: 0.875rem;
            padding: 0.75rem 1.5rem;
            border-radius: 6px;
            border: 1px solid #cbd5e1;
            cursor: pointer;
            transition: all 0.2s;
            text-align: center;
            text-decoration: none;
            display: inline-block;
        }
        .btn-secondary:hover {
            background: #f8fafc;
            border-color: #94a3b8;
        }
        .error-box {
            background: #fef2f2;
            border-left: 4px solid #dc2626;
            border-radius: 4px;
            padding: 1rem;
            margin-bottom: 1.5rem;
        }
        .help-text {
            font-size: 0.75rem;
            color: #64748b;
            margin-top: 0.25rem;
        }
        .required-field::after {
            content: "*";
            color: #dc2626;
            margin-left: 0.25rem;
        }
    </style>
</head>
<body>
    <div class="form-card">
        <!-- Header -->
        <div class="form-header">
            <div class="flex items-center space-x-3">
                <div class="w-10 h-10 bg-indigo-100 rounded flex items-center justify-center">
                    <span class="text-indigo-700 font-bold text-lg">+</span>
                </div>
                <div>
                    <h1 class="text-xl font-bold text-gray-800">Create Affiliate Link</h1>
                    <p class="text-sm text-gray-500">For {{ $affiliate->user->name }}</p>
                </div>
            </div>
        </div>

        <!-- Error Messages -->
        @if($errors->any())
            <div class="error-box mx-8 mt-6">
                <p class="text-sm font-medium text-red-800 mb-1">Please correct the following:</p>
                <ul class="text-xs text-red-700 list-disc list-inside">
                    @foreach($errors->all() as $error)
                        <li>{{ $error }}</li>
                    @endforeach
                </ul>
            </div>
        @endif

        <!-- Form -->
        <form action="{{ route('affiliate.links.store', $affiliate->id , $affiliate->affiliate_code) }}" method="POST" class="form-body">
            @csrf

            <!-- Product Selection -->
            <div class="mb-5">
                <label for="product_id" class="form-label required-field">Product</label>
                <select name="product_id" id="product_id" class="form-select" required>
                    <option value="">-- Select a product --</option>
                    @foreach($products as $product)
                        <option value="{{ $product->id }}" {{ old('product_id') == $product->id ? 'selected' : '' }}>
                            {{ $product->name }}
                        </option>
                    @endforeach
                </select>
                @error('product_id')
                    <p class="text-xs text-red-600 mt-1">{{ $message }}</p>
                @enderror
                <p class="help-text">Choose the product you want to promote</p>
            </div>

            <!-- Optional Link Code -->
            <div class="mb-6">
                <label for="link_code" class="form-label">Custom Link Code (Optional)</label>
                <input type="text" 
                       name="link_code" 
                       id="link_code" 
                       class="form-input @error('link_code') border-red-500 @enderror"
                       placeholder="e.g., summer-promo-2024"
                       value="{{ old('link_code') }}">
                @error('link_code')
                    <p class="text-xs text-red-600 mt-1">{{ $message }}</p>
                @enderror
                <p class="help-text">Leave empty for auto-generated unique code. Minimum 6 characters if custom.</p>
            </div>

            <!-- Info Box -->
            <div class="bg-blue-50 border border-blue-200 rounded p-3 mb-6">
                <p class="text-xs text-blue-700 flex items-start">
                    <span class="font-medium mr-1">Note:</span>
                    Each link is unique and tracks clicks and conversions automatically. 
                    The link will be formatted as: <code class="bg-blue-100 px-1 rounded">{{ url('/') }}/ref/[affiliate_code]/[product-code]</code>
                </p>
            </div>

            <!-- Actions -->
            <div class="flex space-x-3">
                <button type="submit" class="btn-primary flex-1">
                    Create Link
                </button>
                <a href="{{ route('affiliate.links', $affiliate->affiliate_code) }}" class="btn-secondary flex-1">
                    Cancel
                </a>
            </div>
        </form>

        <!-- Footer -->
        <div class="border-t border-gray-200 px-8 py-4 bg-gray-50 rounded-b-lg">
            <p class="text-xs text-gray-500 text-center">
                Need help? Contact partner support at support@affiliatepro.com
            </p>
        </div>
    </div>

    <script>
        // Live validation for custom link code
        document.getElementById('link_code')?.addEventListener('input', function(e) {
            if (this.value.length > 0) {
                if (this.value.length < 6) {
                    this.classList.add('border-red-500');
                    this.classList.remove('border-green-500');
                } else {
                    this.classList.remove('border-red-500');
                    this.classList.add('border-green-500');
                }
            } else {
                this.classList.remove('border-red-500', 'border-green-500');
            }
        });

        // Prevent form double submission
        document.querySelector('form').addEventListener('submit', function(e) {
            const submitBtn = this.querySelector('button[type="submit"]');
            if (submitBtn.disabled) {
                e.preventDefault();
                return;
            }
            submitBtn.disabled = true;
            submitBtn.innerHTML = 'Creating...';
        });
    </script>
</body>
</html>