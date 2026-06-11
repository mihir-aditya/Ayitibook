<!doctype html>
<html lang="en">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Seller Registration</title>
    <link rel="stylesheet" href="{{ mix('resources/css/app.css') }}" />
    <style>
        /* Step indicator */
        .step-dot { transition: all .25s; }
        .step-dot.active   { background:#4f46e5; color:#fff; }
        .step-dot.done     { background:#22c55e; color:#fff; }
        .step-dot.inactive { background:#e5e7eb; color:#6b7280; }
        .step-line { flex:1; height:2px; background:#e5e7eb; transition: background .25s; }
        .step-line.done { background:#22c55e; }

        /* Hide/show steps */
        .form-step { display:none; }
        .form-step.active { display:block; }

        /* Category chips */
        .cat-chip input[type=checkbox] { display:none; }
        .cat-chip label {
            display:inline-block; cursor:pointer; padding:.35rem .85rem;
            border:1.5px solid #d1d5db; border-radius:9999px; font-size:.82rem;
            color:#374151; transition:all .2s;
        }
        .cat-chip input:checked + label {
            background:#4f46e5; border-color:#4f46e5; color:#fff;
        }
    </style>
</head>
<body class="min-h-screen bg-gray-50 flex items-center justify-center py-12 px-4">

<div class="max-w-2xl w-full bg-white shadow-xl rounded-2xl overflow-hidden">

    {{-- ── Sidebar header ── --}}
    <div class="bg-gradient-to-br from-indigo-700 to-indigo-500 text-white px-8 pt-8 pb-6">
        <h2 class="text-2xl font-bold">Become a Seller</h2>
        <p class="mt-1 text-sm opacity-80">Complete all 6 steps to activate your seller account.</p>

        {{-- Step progress bar --}}
        <div class="mt-5 flex items-center gap-1" id="step-indicator">
            @foreach(['Identity','Contact','Business','Products','Obligations','Payment'] as $i => $label)
                <div class="flex flex-col items-center">
                    <div class="step-dot w-7 h-7 rounded-full flex items-center justify-center text-xs font-bold
                                {{ $i === 0 ? 'active' : 'inactive' }}"
                         id="dot-{{ $i+1 }}">{{ $i+1 }}</div>
                    <span class="text-xs mt-1 opacity-75 hidden sm:block">{{ $label }}</span>
                </div>
                @if($i < 5)
                    <div class="step-line {{ $i === 0 ? '' : '' }}" id="line-{{ $i+1 }}"></div>
                @endif
            @endforeach
        </div>
    </div>

    {{-- ── Alerts ── --}}
    <div class="px-8 pt-5">
        @if(session('status'))
            <div class="mb-4 px-4 py-3 rounded-lg bg-green-50 border border-green-200 text-green-800 text-sm">
                {{ session('status') }}
            </div>
        @endif
        @if($errors->any())
            <div class="mb-4 px-4 py-3 rounded-lg bg-red-50 border border-red-200 text-red-700 text-sm">
                <p class="font-semibold mb-1">Please fix the following errors:</p>
                <ul class="list-disc pl-5 space-y-0.5">
                    @foreach($errors->all() as $error)
                        <li>{{ $error }}</li>
                    @endforeach
                </ul>
            </div>
        @endif
    </div>

    {{-- ── Form ── --}}
    <form method="POST" action="{{ route('seller.register.submit') }}" id="reg-form" class="px-8 pb-8">
        @csrf

        {{-- ════════════════════════════════════════
             STEP 1 — Identity
        ════════════════════════════════════════ --}}
        <div class="form-step active" id="step-1">
            <h3 class="text-base font-semibold text-gray-800 mb-4 mt-2">Step 1 — Identity</h3>
            <div class="space-y-4">

                <div>
                    <label class="block text-sm font-medium text-gray-700">Full Name <span class="text-red-500">*</span></label>
                    <input name="name" value="{{ old('name') }}" required
                           class="mt-1 block w-full rounded-lg border-gray-300 shadow-sm focus:border-indigo-500 focus:ring-indigo-500 text-sm"
                           placeholder="John Doe">
                </div>

                <div>
                    <label class="block text-sm font-medium text-gray-700">Business / Shop Name <span class="text-red-500">*</span></label>
                    <input name="shop_name" value="{{ old('shop_name') }}" required
                           class="mt-1 block w-full rounded-lg border-gray-300 shadow-sm focus:border-indigo-500 focus:ring-indigo-500 text-sm"
                           placeholder="My Awesome Shop">
                </div>

                <div>
                    <label class="block text-sm font-medium text-gray-700">National ID Number <span class="text-red-500">*</span></label>
                    <input name="national_id" value="{{ old('national_id') }}" required
                           class="mt-1 block w-full rounded-lg border-gray-300 shadow-sm focus:border-indigo-500 focus:ring-indigo-500 text-sm"
                           placeholder="ID / NIN / Passport number">
                    <p class="mt-1 text-xs text-gray-500">Used for identity verification only. Kept securely.</p>
                </div>

            </div>
        </div>

        {{-- ════════════════════════════════════════
             STEP 2 — Contact & Auth
        ════════════════════════════════════════ --}}
        <div class="form-step" id="step-2">
            <h3 class="text-base font-semibold text-gray-800 mb-4 mt-2">Step 2 — Contact &amp; Account</h3>
            <div class="space-y-4">

                <div>
                    <label class="block text-sm font-medium text-gray-700">Phone Number <span class="text-red-500">*</span></label>
                    <div class="mt-1 flex gap-2">
                        <input name="phone" id="phone-input" value="{{ old('phone') }}" required
                               class="flex-1 rounded-lg border-gray-300 shadow-sm focus:border-indigo-500 focus:ring-indigo-500 text-sm"
                               placeholder="+1 555 555 5555">
                        <button type="button" onclick="sendOtp()"
                                class="px-3 py-2 bg-indigo-600 hover:bg-indigo-700 text-white text-xs font-medium rounded-lg whitespace-nowrap">
                            Send OTP
                        </button>
                    </div>
                </div>

                <div id="otp-box" class="hidden">
                    <label class="block text-sm font-medium text-gray-700">Enter OTP</label>
                    <div class="mt-1 flex gap-2">
                        <input type="text" id="otp-input" maxlength="6"
                               class="flex-1 rounded-lg border-gray-300 shadow-sm focus:border-indigo-500 focus:ring-indigo-500 text-sm tracking-widest"
                               placeholder="• • • • • •">
                        <button type="button" onclick="verifyOtp()"
                                class="px-3 py-2 bg-green-600 hover:bg-green-700 text-white text-xs font-medium rounded-lg">
                            Verify
                        </button>
                    </div>
                    <p id="otp-status" class="mt-1 text-xs"></p>
                </div>

                <div>
                    <label class="block text-sm font-medium text-gray-700">Email Address <span class="text-red-500">*</span></label>
                    <input type="email" name="email" value="{{ old('email') }}" required
                           class="mt-1 block w-full rounded-lg border-gray-300 shadow-sm focus:border-indigo-500 focus:ring-indigo-500 text-sm"
                           placeholder="you@example.com">
                </div>

                <div class="grid grid-cols-1 sm:grid-cols-2 gap-4">
                    <div>
                        <label class="block text-sm font-medium text-gray-700">Password <span class="text-red-500">*</span></label>
                        <input type="password" name="password" required
                               class="mt-1 block w-full rounded-lg border-gray-300 shadow-sm focus:border-indigo-500 focus:ring-indigo-500 text-sm"
                               placeholder="Min. 6 characters">
                    </div>
                    <div>
                        <label class="block text-sm font-medium text-gray-700">Confirm Password <span class="text-red-500">*</span></label>
                        <input type="password" name="password_confirmation" required
                               class="mt-1 block w-full rounded-lg border-gray-300 shadow-sm focus:border-indigo-500 focus:ring-indigo-500 text-sm"
                               placeholder="Repeat password">
                    </div>
                </div>

            </div>
        </div>

        {{-- ════════════════════════════════════════
             STEP 3 — Business Location
        ════════════════════════════════════════ --}}
        <div class="form-step" id="step-3">
            <h3 class="text-base font-semibold text-gray-800 mb-4 mt-2">Step 3 — Business Location</h3>
            <div class="space-y-4">

                <div>
                    <label class="block text-sm font-medium text-gray-700">Pickup / Shop Address <span class="text-red-500">*</span></label>
                    <textarea name="shop_address" rows="3" required
                              class="mt-1 block w-full rounded-lg border-gray-300 shadow-sm focus:border-indigo-500 focus:ring-indigo-500 text-sm"
                              placeholder="123 Market Street, City">{{ old('shop_address') }}</textarea>
                </div>

                <div>
                    <label class="block text-sm font-medium text-gray-700">Municipality / Delivery Zone <span class="text-red-500">*</span></label>
                    <input name="municipality" value="{{ old('municipality') }}" required
                           class="mt-1 block w-full rounded-lg border-gray-300 shadow-sm focus:border-indigo-500 focus:ring-indigo-500 text-sm"
                           placeholder="e.g. Lagos Island, Lekki Zone">
                    <p class="mt-1 text-xs text-gray-500">This determines your delivery coverage area.</p>
                </div>

            </div>
        </div>

        {{-- ════════════════════════════════════════
             STEP 4 — Products
        ════════════════════════════════════════ --}}
        <div class="form-step" id="step-4">
            <h3 class="text-base font-semibold text-gray-800 mb-4 mt-2">Step 4 — Products</h3>
            <div class="space-y-5">

                <div>
                    <label class="block text-sm font-medium text-gray-700 mb-2">
                        Product Categories <span class="text-red-500">*</span>
                        <span class="font-normal text-gray-500">(select all that apply)</span>
                    </label>
                    <div class="flex flex-wrap gap-2">
                        @php
                            $categories = [
                                'Electronics','Fashion & Apparel','Health & Beauty',
                                'Home & Kitchen','Food & Groceries','Sports & Outdoors',
                                'Books & Stationery','Toys & Games','Automotive',
                                'Agriculture','Industrial & Tools','Other',
                            ];
                        @endphp
                        @foreach($categories as $cat)
                            <span class="cat-chip">
                                <input type="checkbox" name="product_categories[]"
                                       value="{{ $cat }}" id="cat-{{ Str::slug($cat) }}"
                                       {{ in_array($cat, old('product_categories', [])) ? 'checked' : '' }}>
                                <label for="cat-{{ Str::slug($cat) }}">{{ $cat }}</label>
                            </span>
                        @endforeach
                    </div>
                </div>

                <div>
                    <label class="block text-sm font-medium text-gray-700 mb-2">
                        Serial / Lot Number Handling <span class="text-red-500">*</span>
                    </label>
                    <div class="space-y-2">
                        @foreach([
                            'has_sn'        => ['My products already have Serial Numbers (SN)', 'Each unit has a manufacturer serial number.'],
                            'has_lot'        => ['My products have LOT / Batch numbers',          'Products are tracked by batch/lot.'],
                            'auto_generate' => ['Auto-generate Serial Numbers for me',            'Platform will assign SN automatically at listing.'],
                        ] as $val => [$title, $hint])
                            <label class="flex items-start gap-3 p-3 rounded-lg border border-gray-200 cursor-pointer hover:border-indigo-400 has-[:checked]:border-indigo-500 has-[:checked]:bg-indigo-50 transition">
                                <input type="radio" name="serial_number_type" value="{{ $val }}"
                                       {{ old('serial_number_type') === $val ? 'checked' : '' }}
                                       class="mt-0.5 text-indigo-600 focus:ring-indigo-500">
                                <div>
                                    <span class="text-sm font-medium text-gray-800">{{ $title }}</span>
                                    <p class="text-xs text-gray-500">{{ $hint }}</p>
                                </div>
                            </label>
                        @endforeach
                    </div>
                </div>

                <div>
                    <label class="block text-sm font-medium text-gray-700 mb-2">
                        Do you accept Cash on Delivery (COD)? <span class="text-red-500">*</span>
                    </label>
                    <div class="flex gap-4">
                        <label class="flex items-center gap-2 cursor-pointer">
                            <input type="radio" name="accepts_cod" value="1"
                                   {{ old('accepts_cod') === '1' ? 'checked' : '' }}
                                   class="text-indigo-600 focus:ring-indigo-500">
                            <span class="text-sm text-gray-700">Yes, I accept COD</span>
                        </label>
                        <label class="flex items-center gap-2 cursor-pointer">
                            <input type="radio" name="accepts_cod" value="0"
                                   {{ old('accepts_cod') === '0' ? 'checked' : '' }}
                                   class="text-indigo-600 focus:ring-indigo-500">
                            <span class="text-sm text-gray-700">No, online payment only</span>
                        </label>
                    </div>
                </div>

            </div>
        </div>

        {{-- ════════════════════════════════════════
             STEP 5 — Seller Obligations
        ════════════════════════════════════════ --}}
        <div class="form-step" id="step-5">
            <h3 class="text-base font-semibold text-gray-800 mb-1 mt-2">Step 5 — Seller Obligations</h3>
            <p class="text-xs text-gray-500 mb-4">You must confirm each obligation before proceeding.</p>

            <div class="space-y-3">

                @php
                    $obligations = [
                        ['agreed_video_before_shipping', '🎥 Product Video Before Shipping',
                         'I agree to record a real-time video of the product and packaging before every shipment, to protect both parties in case of disputes.'],
                        ['agreed_qr_otp_validation', '📱 QR Code & OTP Validation',
                         'I agree to scan the delivery QR code and confirm delivery using OTP validation as required by the platform.'],
                        ['agreed_returns_48hrs', '↩️ 48-Hour Return Response',
                         'I agree to acknowledge and process any return or complaint requests within 48 hours of notification.'],
                        ['agreed_insurance_fund', '🛡️ Insurance Fund Contribution',
                         'I agree to contribute to the seller insurance fund as per the platform\'s fee schedule, which protects buyers from fraud.'],
                        ['agreed_rating_penalty', '⭐ Rating & Penalty Rules',
                         'I agree to abide by the platform\'s seller rating system, and accept penalties (including temporary suspension) for poor performance or violations.'],
                    ];
                @endphp

                @foreach($obligations as [$name, $title, $desc])
                    <label class="flex items-start gap-3 p-4 rounded-xl border border-gray-200 cursor-pointer
                                  hover:border-indigo-400 has-[:checked]:border-indigo-500 has-[:checked]:bg-indigo-50 transition">
                        <input type="checkbox" name="{{ $name }}" value="1"
                               {{ old($name) ? 'checked' : '' }}
                               class="mt-0.5 rounded text-indigo-600 focus:ring-indigo-500">
                        <div>
                            <span class="text-sm font-semibold text-gray-800">{{ $title }}</span>
                            <p class="text-xs text-gray-500 mt-0.5">{{ $desc }}</p>
                        </div>
                    </label>
                @endforeach

            </div>
        </div>

        {{-- ════════════════════════════════════════
             STEP 6 — Payment & Agreement
        ════════════════════════════════════════ --}}
        <div class="form-step" id="step-6">
            <h3 class="text-base font-semibold text-gray-800 mb-4 mt-2">Step 6 — Payment &amp; Final Agreement</h3>
            <div class="space-y-5">

                <div>
                    <label class="block text-sm font-medium text-gray-700 mb-2">
                        Preferred Payout Method <span class="text-red-500">*</span>
                    </label>
                    <div class="grid grid-cols-2 gap-3">
                        <label class="flex items-center gap-3 p-4 rounded-xl border border-gray-200 cursor-pointer
                                      hover:border-indigo-400 has-[:checked]:border-indigo-500 has-[:checked]:bg-indigo-50 transition">
                            <input type="radio" name="payment_method" value="bank"
                                   {{ old('payment_method') === 'bank' ? 'checked' : '' }}
                                   class="text-indigo-600 focus:ring-indigo-500">
                            <div>
                                <span class="text-sm font-semibold text-gray-800">🏦 Bank Transfer</span>
                                <p class="text-xs text-gray-500">Funds sent to your bank account</p>
                            </div>
                        </label>
                        <label class="flex items-center gap-3 p-4 rounded-xl border border-gray-200 cursor-pointer
                                      hover:border-indigo-400 has-[:checked]:border-indigo-500 has-[:checked]:bg-indigo-50 transition">
                            <input type="radio" name="payment_method" value="wallet"
                                   {{ old('payment_method') === 'wallet' ? 'checked' : '' }}
                                   class="text-indigo-600 focus:ring-indigo-500">
                            <div>
                                <span class="text-sm font-semibold text-gray-800">👛 Platform Wallet</span>
                                <p class="text-xs text-gray-500">Hold balance in your seller wallet</p>
                            </div>
                        </label>
                    </div>
                </div>

                {{-- T&C summary box --}}
                <div class="rounded-xl border border-gray-200 bg-gray-50 p-4 text-xs text-gray-600 max-h-40 overflow-y-auto leading-relaxed">
                    <p class="font-semibold text-gray-800 mb-2">Summary of Terms &amp; Conditions</p>
                    <p>By registering as a seller you confirm that all information provided is accurate and truthful. You agree to list only genuine products, honour all accepted orders, maintain the quality standards set by the platform, and comply with applicable laws and regulations in your jurisdiction.</p>
                    <p class="mt-2">The platform reserves the right to suspend or permanently ban accounts that violate these terms, and to withhold funds pending dispute resolution. Seller ratings are calculated from buyer feedback, fulfilment rate, and return handling. Falling below the minimum rating threshold may result in automatic account suspension until remediation steps are completed.</p>
                    <p class="mt-2">All seller data is handled in accordance with our Privacy Policy. You may request account deletion at any time; however, active orders must be fulfilled before deletion can be processed.</p>
                </div>

                <label class="flex items-start gap-3 p-4 rounded-xl border-2 border-indigo-300 bg-indigo-50 cursor-pointer hover:border-indigo-500 transition">
                    <input type="checkbox" name="agreed_to_terms" value="1"
                           {{ old('agreed_to_terms') ? 'checked' : '' }}
                           class="mt-0.5 rounded text-indigo-600 focus:ring-indigo-500" required>
                    <div>
                        <span class="text-sm font-semibold text-gray-800">I have read and agree to the Terms &amp; Conditions</span>
                        <p class="text-xs text-gray-500 mt-0.5">
                            This constitutes a digital agreement. Your name, date, and IP address will be recorded.
                        </p>
                    </div>
                </label>

            </div>
        </div>

        {{-- ── Navigation buttons ── --}}
        <div class="mt-6 flex items-center justify-between border-t border-gray-100 pt-5">
            <button type="button" id="btn-prev" onclick="changeStep(-1)"
                    class="hidden px-5 py-2 rounded-lg border border-gray-300 text-sm text-gray-700 hover:bg-gray-50">
                ← Back
            </button>
            <span></span>{{-- spacer --}}

            <div class="flex items-center gap-3">
                <span class="text-xs text-gray-400" id="step-counter">Step 1 of 6</span>
                <button type="button" id="btn-next" onclick="changeStep(1)"
                        class="px-6 py-2 bg-indigo-600 hover:bg-indigo-700 text-white text-sm font-medium rounded-lg shadow-sm">
                    Next →
                </button>
                <button type="submit" id="btn-submit"
                        class="hidden px-6 py-2 bg-green-600 hover:bg-green-700 text-white text-sm font-medium rounded-lg shadow-sm">
                    Submit Application ✓
                </button>
            </div>
        </div>

        <p class="mt-4 text-center text-sm text-gray-500">
            Already have an account?
            <a href="{{ route('seller.login') }}" class="text-indigo-600 hover:underline">Sign in</a>
        </p>
    </form>
</div>

<script>
    let currentStep = 1;
    const totalSteps = 6;

    function changeStep(direction) {
        const next = currentStep + direction;
        if (next < 1 || next > totalSteps) return;

        document.getElementById('step-' + currentStep).classList.remove('active');
        document.getElementById('step-' + next).classList.add('active');

        // Update dots
        const prev = document.getElementById('dot-' + currentStep);
        prev.classList.remove('active');
        prev.classList.add(direction > 0 ? 'done' : 'inactive');

        const nextDot = document.getElementById('dot-' + next);
        nextDot.classList.remove('inactive', 'done');
        nextDot.classList.add('active');

        // Update lines
        if (direction > 0 && currentStep <= totalSteps - 1) {
            const line = document.getElementById('line-' + currentStep);
            if (line) line.classList.add('done');
        } else if (direction < 0) {
            const line = document.getElementById('line-' + next);
            if (line) line.classList.remove('done');
        }

        currentStep = next;

        // Show / hide buttons
        document.getElementById('btn-prev').classList.toggle('hidden', currentStep === 1);
        document.getElementById('btn-next').classList.toggle('hidden', currentStep === totalSteps);
        document.getElementById('btn-submit').classList.toggle('hidden', currentStep !== totalSteps);
        document.getElementById('step-counter').textContent = 'Step ' + currentStep + ' of ' + totalSteps;

        window.scrollTo({ top: 0, behavior: 'smooth' });
    }

    // Fake OTP flow (replace with real AJAX calls to your backend)
    function sendOtp() {
        const phone = document.getElementById('phone-input').value.trim();
        if (!phone) { alert('Please enter your phone number first.'); return; }
        document.getElementById('otp-box').classList.remove('hidden');
        document.getElementById('otp-status').textContent = 'OTP sent to ' + phone + '. (Demo: use 123456)';
        document.getElementById('otp-status').className = 'mt-1 text-xs text-indigo-600';
    }

    function verifyOtp() {
        const code = document.getElementById('otp-input').value.trim();
        const statusEl = document.getElementById('otp-status');
        if (code === '123456') { // Replace with real server-side validation
            statusEl.textContent = '✅ Phone number verified!';
            statusEl.className = 'mt-1 text-xs text-green-600 font-semibold';
        } else {
            statusEl.textContent = '❌ Invalid OTP. Please try again.';
            statusEl.className = 'mt-1 text-xs text-red-600';
        }
    }

    // If there are validation errors from the server, jump to step 6 (last) so all errors show.
    @if($errors->any())
        // Re-activate all steps up to the last so server errors display correctly.
        // Simple approach: show step 1 but display the error panel (already rendered above).
    @endif
</script>
</body>
</html>