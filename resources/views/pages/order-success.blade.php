<!DOCTYPE html>
<html lang="en">
<head>
    <title>Order Placed! - AyitiBook</title>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">

    <!-- CSS -->
    <link rel="stylesheet" type="text/css" href="{{ asset('assets/vendor/fontawesome/css/all.min.css') }}">
    <link rel="stylesheet" type="text/css" href="{{ asset('assets/css/style.css') }}">
    <link rel="stylesheet" type="text/css" href="{{ asset('assets/css/custom.css') }}">
    <link rel="stylesheet" type="text/css" href="{{ asset('assets/css/footer.css') }}">
    <link rel="stylesheet" type="text/css" href="{{ asset('assets/css/header.css') }}">
    <link href="https://fonts.googleapis.com/css2?family=DM+Serif+Display:ital@0;1&family=DM+Sans:wght@300;400;500;600&display=swap" rel="stylesheet">

    <style>
        :root {
            --ink:      #1a1a2e;
            --forest:   #1b4332;
            --leaf:     #2d6a4f;
            --mint:     #52b788;
            --mist:     #d8f3dc;
            --cream:    #f8f5f0;
            --warm:     #e9c46a;
            --radius:   14px;
        }

        * { box-sizing: border-box; margin: 0; padding: 0; }

        body {
            background: var(--cream);
            font-family: 'DM Sans', sans-serif;
            color: var(--ink);
            min-height: 100vh;
        }

        /* ── Success Stage ─────────────────────────────── */
        .success-stage {
            min-height: calc(100vh - 160px);
            display: flex;
            align-items: center;
            justify-content: center;
            padding: 60px 20px;
        }

        .success-card {
            background: #fff;
            border-radius: 24px;
            box-shadow: 0 8px 48px rgba(26,26,46,.08), 0 2px 8px rgba(26,26,46,.04);
            max-width: 640px;
            width: 100%;
            overflow: hidden;
            animation: cardRise .6s cubic-bezier(.22,.68,0,1.2) both;
        }

        @keyframes cardRise {
            from { opacity: 0; transform: translateY(32px) scale(.97); }
            to   { opacity: 1; transform: none; }
        }

        /* ── Green Hero Banner ─────────────────────────── */
        .success-hero {
            background: linear-gradient(135deg, var(--forest) 0%, var(--leaf) 60%, var(--mint) 100%);
            padding: 52px 40px 40px;
            text-align: center;
            position: relative;
            overflow: hidden;
        }

        .success-hero::before {
            content: '';
            position: absolute;
            inset: 0;
            background: url("data:image/svg+xml,%3Csvg width='60' height='60' viewBox='0 0 60 60' xmlns='http://www.w3.org/2000/svg'%3E%3Cg fill='none' fill-rule='evenodd'%3E%3Cg fill='%23ffffff' fill-opacity='0.04'%3E%3Ccircle cx='30' cy='30' r='28'/%3E%3C/g%3E%3C/g%3E%3C/svg%3E") repeat;
            pointer-events: none;
        }

        /* Animated checkmark circle */
        .check-wrap {
            width: 88px;
            height: 88px;
            margin: 0 auto 24px;
            position: relative;
        }

        .check-wrap svg {
            width: 88px;
            height: 88px;
        }

        .check-circle {
            fill: none;
            stroke: rgba(255,255,255,.25);
            stroke-width: 3;
        }

        .check-progress {
            fill: none;
            stroke: #fff;
            stroke-width: 3;
            stroke-linecap: round;
            stroke-dasharray: 251;
            stroke-dashoffset: 251;
            animation: drawCircle .7s .2s ease forwards;
        }

        @keyframes drawCircle {
            to { stroke-dashoffset: 0; }
        }

        .check-tick {
            stroke: #fff;
            stroke-width: 4;
            stroke-linecap: round;
            stroke-linejoin: round;
            fill: none;
            stroke-dasharray: 60;
            stroke-dashoffset: 60;
            animation: drawTick .4s .9s ease forwards;
        }

        @keyframes drawTick {
            to { stroke-dashoffset: 0; }
        }

        .success-hero h1 {
            font-family: 'DM Serif Display', serif;
            font-size: clamp(1.8rem, 4vw, 2.4rem);
            color: #fff;
            letter-spacing: -.01em;
            margin-bottom: 8px;
            animation: fadeUp .5s .5s both;
        }

        .success-hero p {
            color: rgba(255,255,255,.8);
            font-size: .95rem;
            animation: fadeUp .5s .65s both;
        }

        @keyframes fadeUp {
            from { opacity: 0; transform: translateY(10px); }
            to   { opacity: 1; transform: none; }
        }

        /* ── Card Body ─────────────────────────────────── */
        .success-body {
            padding: 36px 40px 40px;
        }

        /* Order ID pill */
        .order-id-row {
            display: flex;
            align-items: center;
            justify-content: space-between;
            background: var(--mist);
            border-radius: 10px;
            padding: 14px 18px;
            margin-bottom: 28px;
            animation: fadeUp .5s .75s both;
        }

        .order-id-row .label {
            font-size: .8rem;
            font-weight: 600;
            text-transform: uppercase;
            letter-spacing: .08em;
            color: var(--leaf);
        }

        .order-id-row .value {
            font-family: 'DM Serif Display', serif;
            font-size: 1.05rem;
            color: var(--forest);
        }

        .copy-btn {
            background: none;
            border: none;
            cursor: pointer;
            color: var(--mint);
            font-size: .9rem;
            padding: 4px 8px;
            border-radius: 6px;
            transition: background .15s, color .15s;
        }
        .copy-btn:hover { background: var(--mist); color: var(--forest); }
        .copy-btn.copied { color: var(--forest); }

        /* Info rows */
        .info-grid {
            display: grid;
            grid-template-columns: 1fr 1fr;
            gap: 16px;
            margin-bottom: 28px;
            animation: fadeUp .5s .85s both;
        }

        @media (max-width: 480px) {
            .info-grid { grid-template-columns: 1fr; }
        }

        .info-tile {
            background: var(--cream);
            border-radius: var(--radius);
            padding: 14px 16px;
        }

        .info-tile .tile-label {
            font-size: .75rem;
            font-weight: 600;
            text-transform: uppercase;
            letter-spacing: .07em;
            color: #888;
            margin-bottom: 4px;
        }

        .info-tile .tile-value {
            font-size: .95rem;
            font-weight: 500;
            color: var(--ink);
        }

        /* Status timeline */
        .timeline {
            display: flex;
            align-items: flex-start;
            gap: 0;
            margin-bottom: 32px;
            position: relative;
            animation: fadeUp .5s .95s both;
        }

        .timeline-step {
            flex: 1;
            text-align: center;
            position: relative;
        }

        .timeline-step:not(:last-child)::after {
            content: '';
            position: absolute;
            top: 17px;
            left: 50%;
            width: 100%;
            height: 2px;
            background: var(--mist);
            z-index: 0;
        }

        .timeline-step.active:not(:last-child)::after {
            background: linear-gradient(90deg, var(--mint), var(--mist));
        }

        .step-dot {
            width: 36px;
            height: 36px;
            border-radius: 50%;
            background: var(--mist);
            border: 2px solid #e0ede4;
            display: flex;
            align-items: center;
            justify-content: center;
            margin: 0 auto 8px;
            font-size: .75rem;
            color: #aaa;
            position: relative;
            z-index: 1;
            transition: all .3s;
        }

        .timeline-step.active .step-dot {
            background: var(--mint);
            border-color: var(--leaf);
            color: #fff;
            box-shadow: 0 0 0 4px rgba(82,183,136,.2);
        }

        .step-label {
            font-size: .72rem;
            font-weight: 500;
            color: #aaa;
            line-height: 1.3;
        }

        .timeline-step.active .step-label {
            color: var(--leaf);
            font-weight: 600;
        }

        /* CTA Buttons */
        .cta-row {
            display: flex;
            gap: 12px;
            animation: fadeUp .5s 1.05s both;
        }

        @media (max-width: 480px) {
            .cta-row { flex-direction: column; }
            .success-body { padding: 28px 24px 32px; }
            .success-hero { padding: 40px 24px 32px; }
        }

        .btn-primary-green {
            flex: 1;
            background: linear-gradient(135deg, var(--forest), var(--leaf));
            color: #fff;
            border: none;
            border-radius: 10px;
            padding: 14px 24px;
            font-family: 'DM Sans', sans-serif;
            font-size: .95rem;
            font-weight: 600;
            cursor: pointer;
            text-align: center;
            text-decoration: none;
            display: flex;
            align-items: center;
            justify-content: center;
            gap: 8px;
            transition: transform .15s, box-shadow .15s;
            box-shadow: 0 4px 16px rgba(27,67,50,.25);
        }

        .btn-primary-green:hover {
            transform: translateY(-2px);
            box-shadow: 0 6px 20px rgba(27,67,50,.35);
            color: #fff;
            text-decoration: none;
        }

        .btn-outline-green {
            flex: 1;
            background: transparent;
            color: var(--leaf);
            border: 2px solid var(--mist);
            border-radius: 10px;
            padding: 14px 24px;
            font-family: 'DM Sans', sans-serif;
            font-size: .95rem;
            font-weight: 600;
            cursor: pointer;
            text-align: center;
            text-decoration: none;
            display: flex;
            align-items: center;
            justify-content: center;
            gap: 8px;
            transition: border-color .15s, background .15s, transform .15s;
        }

        .btn-outline-green:hover {
            border-color: var(--mint);
            background: var(--mist);
            transform: translateY(-2px);
            color: var(--forest);
            text-decoration: none;
        }

        /* Confetti burst */
        .confetti-wrap {
            position: fixed;
            inset: 0;
            pointer-events: none;
            z-index: 9999;
            overflow: hidden;
        }

        .confetti-piece {
            position: absolute;
            top: -10px;
            width: 8px;
            height: 8px;
            border-radius: 2px;
            opacity: 0;
            animation: confettiFall linear forwards;
        }

        @keyframes confettiFall {
            0%   { opacity: 1; transform: translateY(0) rotate(0deg); }
            100% { opacity: 0; transform: translateY(100vh) rotate(720deg); }
        }
    </style>
</head>

<body>
    {{-- @include('includes.top-header') --}}
    @include('includes.header')

    <!-- Confetti container (populated by JS) -->
    <div class="confetti-wrap" id="confetti-wrap"></div>

    <div class="page-wrapper">
        <main class="main-wrapper">
            <div class="success-stage">
                <div class="success-card">

                    <!-- Hero Banner -->
                    <div class="success-hero">
                        <div class="check-wrap">
                            <svg viewBox="0 0 88 88">
                                <circle class="check-circle"  cx="44" cy="44" r="40"/>
                                <circle class="check-progress" cx="44" cy="44" r="40"
                                        transform="rotate(-90 44 44)"/>
                                <polyline class="check-tick" points="26,44 38,56 62,32"/>
                            </svg>
                        </div>
                        <h1>Order Confirmed!</h1>
                        <p>Thank you for your purchase. We're getting things ready.</p>
                    </div>

                    <!-- Card Body -->
                    <div class="success-body">

                        <!-- Order ID -->
                        <div class="order-id-row">
                            <div>
                                <div class="label">Order ID</div>
                                <div class="value" id="order-id-text">{{ request('order_id') ?? session('order_id') ?? '—' }}</div>
                            </div>
                            <button class="copy-btn" id="copy-btn" title="Copy order ID"
                                    onclick="copyOrderId()">
                                <i class="fa fa-copy"></i>
                            </button>
                        </div>

                        <!-- Info tiles -->
                        <div class="info-grid">
                            <div class="info-tile">
                                <div class="tile-label">Payment</div>
                                <div class="tile-value">
                                    @if(session('payment_method') === 'cod')
                                        <i class="fa fa-money-bill-wave me-1" style="color:var(--mint)"></i> Cash on Delivery
                                    @elseif(session('payment_method') === 'card')
                                        <i class="fa fa-credit-card me-1" style="color:var(--mint)"></i> Card Payment
                                    @else
                                        <i class="fa fa-receipt me-1" style="color:var(--mint)"></i> Confirmed
                                    @endif
                                </div>
                            </div>
                            <div class="info-tile">
                                <div class="tile-label">Estimated Delivery</div>
                                <div class="tile-value">
                                    {{ now()->addDays(3)->format('D, M j') }} – {{ now()->addDays(6)->format('D, M j') }}
                                </div>
                            </div>
                            <div class="info-tile">
                                <div class="tile-label">Placed At</div>
                                <div class="tile-value">{{ now()->format('M j, Y · g:i A') }}</div>
                            </div>
                            <div class="info-tile">
                                <div class="tile-label">Status</div>
                                <div class="tile-value" style="color:var(--leaf);">
                                    <i class="fa fa-circle-dot me-1"></i> Processing
                                </div>
                            </div>
                        </div>

                        <!-- Order status timeline -->
                        <div class="timeline">
                            <div class="timeline-step active">
                                <div class="step-dot"><i class="fa fa-check"></i></div>
                                <div class="step-label">Order<br>Placed</div>
                            </div>
                            <div class="timeline-step">
                                <div class="step-dot"><i class="fa fa-box-open"></i></div>
                                <div class="step-label">Being<br>Packed</div>
                            </div>
                            <div class="timeline-step">
                                <div class="step-dot"><i class="fa fa-truck"></i></div>
                                <div class="step-label">Out for<br>Delivery</div>
                            </div>
                            <div class="timeline-step">
                                <div class="step-dot"><i class="fa fa-house"></i></div>
                                <div class="step-label">Delivered</div>
                            </div>
                        </div>

                        <!-- CTAs -->
                        <div class="cta-row">
                            <a href="{{ route('dashboard') }}" class="btn-outline-green">
                                <i class="fa fa-arrow-left"></i> Continue Shopping
                            </a>
                            <a href="{{ route('my-orders') }}" class="btn-primary-green">
                                <i class="fa fa-bag-shopping"></i> View My Orders
                            </a>
                        </div>

                    </div>
                </div>
            </div>
        </main>
    </div>

    @include('includes.footer')

    <!-- JS -->
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.6.4/jquery.min.js"></script>
    <script src="{{ asset('assets/js/main.js') }}"></script>

    <script>
        /* ── Copy order ID ───────────────────────────── */
        function copyOrderId() {
            const id  = document.getElementById('order-id-text').textContent.trim();
            const btn = document.getElementById('copy-btn');
            navigator.clipboard.writeText(id).then(() => {
                btn.innerHTML = '<i class="fa fa-check"></i>';
                btn.classList.add('copied');
                setTimeout(() => {
                    btn.innerHTML = '<i class="fa fa-copy"></i>';
                    btn.classList.remove('copied');
                }, 2000);
            });
        }

        /* ── Confetti burst ──────────────────────────── */
        const COLORS = ['#52b788','#2d6a4f','#e9c46a','#f4a261','#d8f3dc','#b7e4c7'];

        function randomBetween(a, b) { return a + Math.random() * (b - a); }

        function launchConfetti() {
            const wrap = document.getElementById('confetti-wrap');
            const count = 80;
            for (let i = 0; i < count; i++) {
                const el = document.createElement('div');
                el.className = 'confetti-piece';
                const size = randomBetween(6, 12);
                el.style.cssText = `
                    left: ${randomBetween(5, 95)}%;
                    width: ${size}px;
                    height: ${size}px;
                    background: ${COLORS[Math.floor(Math.random() * COLORS.length)]};
                    border-radius: ${Math.random() > .5 ? '50%' : '2px'};
                    animation-duration: ${randomBetween(1.8, 3.2)}s;
                    animation-delay: ${randomBetween(0, .8)}s;
                `;
                wrap.appendChild(el);
            }
            // Clean up after animation
            setTimeout(() => wrap.innerHTML = '', 4200);
        }

        // Fire confetti after card animation settles
        setTimeout(launchConfetti, 500);
    </script>
</body>
</html>