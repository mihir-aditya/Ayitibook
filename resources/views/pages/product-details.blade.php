<!doctype html>
<html lang="en">

<head>
    <meta charset="utf-8" />
    <meta name="viewport" content="width=device-width,initial-scale=1" />
    <title>{{ $product->name }} — Ayitibook</title>

    <!-- Bootstrap 5 -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet">

    <!-- Font Awesome -->
    <link href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.0/css/all.min.css" rel="stylesheet">

    <!-- Toastify CSS -->
    <link rel="stylesheet" type="text/css" href="https://cdn.jsdelivr.net/npm/toastify-js/src/toastify.min.css">

    <!-- Include Chart.js -->
    <script src="https://cdn.jsdelivr.net/npm/chart.js"></script>

    <style>
        :root {
            --primary: #0b7285;
            --accent: #8a385c;
            --muted: #f5f6f8;
            --card-bg: #ffffff;
            --outline: #e6e6e6;
            --btn-green: #0aa05a;
            --btn-green-dark: #007f4f;
        }

        body {
            font-family: "Poppins", "Inter", system-ui, -apple-system, "Segoe UI", Roboto, "Helvetica Neue", Arial;
            background: #f1f3f6;
            color: #222;
            margin: 0;
            padding: 0;
        }

        .container-page {
            max-width: 2300px;
            margin: 0 auto;
        }

        .breadcrumb {
            background: transparent;
            padding-left: 0;
            margin-bottom: 10px;
        }

        .product-panel {
            background: var(--card-bg);
            border-radius: 20px;
            padding: 38px;
            box-shadow: 0 6px 28px rgba(16, 24, 40, 0.06);
            transform: scale(1.04);
        }

        .thumbs-vertical {
            display: flex;
            flex-direction: column;
            align-items: flex-start;
            gap: 12px;
        }

        .thumb-btn,
        .video-thumb {
            width: 78px;
            height: 78px;
            border-radius: 8px;
            display: flex;
            align-items: center;
            justify-content: center;
            background: var(--muted);
            border: 2px solid transparent;
            cursor: pointer;
            overflow: hidden;
            transition: 0.2s ease;
        }

        .thumb-btn.active {
            border-color: #d98a8f;
            box-shadow: 0 0 0 4px rgba(217, 138, 143, 0.06);
        }

        .thumb-btn img {
            width: 100%;
            height: 100%;
            object-fit: cover;
        }

        .video-thumb {
            flex-direction: column;
            color: #444;
            font-size: 12px;
        }

        .video-thumb:hover {
            background: #e9e9e9;
            border-color: #ccc;
        }

        .image-card {
            background: var(--card-bg);
            border-radius: 10px;
            padding: 26px;
            height: 450px;
            border: 1px solid var(--outline);
            box-shadow: 0 8px 24px rgba(20, 20, 40, 0.04);
            display: flex;
            align-items: center;
            justify-content: center;
            position: relative;
        }

        .image-card img {
            width: 100%;
            max-width: 420px;
            max-height: 340px;
            object-fit: contain;
            border-radius: 8px;
            background-color: #f9f9f9;
            padding: 10px;
            transition: opacity .25s ease;
        }

        .image-card img.fading {
            opacity: 0;
        }

        .product-title {
            font-size: 28px !important;
            font-weight: 700;
            margin-bottom: 6px;
        }

        .price-row {
            display: flex;
            align-items: center;
            gap: 12px;
            flex-wrap: wrap;
            margin-bottom: 10px;
        }

        .price-container {
            display: flex;
            align-items: flex-end;
            position: relative;
            gap: 2px;
        }

        .currency {
            font-size: 20px;
            font-weight: 500;
            margin-right: 4px;
            line-height: 1;
            align-self: flex-start;
            padding-bottom: 2px;
            color: #222;
        }

        .price-big {
            font-size: 38px !important;
            font-weight: 800;
            line-height: 1;
            align-self: flex-start;
            color: #222;
        }

        .price-small {
            font-size: 18px;
            font-weight: 500;
            margin-left: 2px;
            line-height: 1;
            align-self: flex-start;
            padding-top: 4px;
            color: #222;
        }

        .price-info {
            display: flex;
            flex-direction: column;
            align-items: flex-start;
            justify-content: center;
            gap: 2px;
            margin-left: 6px;
            margin-right: 6px;
        }

        .badge-discount {
            background: #ff2d2d;
            color: #fff;
            font-weight: 700;
            padding: 2px 8px 2px 8px;
            border-radius: 4px;
            font-size: 13px;
            margin-bottom: 0;
            display: inline-block;
            letter-spacing: 0.5px;
        }

        .price-dec {
            color: #777;
            font-size: 16px;
            text-decoration: line-through;
            font-weight: 600;
            margin-top: 0;
            display: inline-block;
            padding-left: 2px;
        }

        .rating {
            display: flex;
            flex-direction: column;
            align-items: flex-start;
            gap: 2px;
            margin-left: 10px;
        }

        .rating .stars i {
            color: #ffc107;
            font-size: 16px;
        }

        #reviewCount {
            font-size: 14px;
            font-weight: 800;
            color: #777;
        }

        .stock {
            color: #d93636;
            font-weight: 700;
            margin-bottom: 14px;
            font-size: 15px;
        }

        .delivery-label {
            font-weight: 700;
            color: #444;
            margin-bottom: 6px;
        }

        .postal-input {
            width: 330px;
            max-width: 100%;
            display: flex;
            align-items: center;
            gap: 10px;
            margin-bottom: 18px;
        }

        .postal-input input {
            flex: 1;
            border-radius: 30px;
            border: 1px solid var(--outline);
            padding: 10px 16px;
            background: white;
        }

        .colors-grid {
            display: flex;
            gap: 18px;
            align-items: flex-start;
            margin-bottom: 18px;
            flex-wrap: wrap;
        }

        .color-circle {
            width: 96px;
            height: 96px;
            border-radius: 50%;
            background: white;
            display: flex;
            align-items: center;
            justify-content: center;
            flex-direction: column;
            border: 4px solid #222;
            box-shadow: 0 6px 20px rgba(10, 10, 20, 0.03);
            cursor: pointer;
            text-align: center;
            transition: transform .12s;
        }

        .color-circle:hover {
            transform: translateY(-4px);
        }

        .color-circle.active {
            outline: 6px solid rgba(11, 114, 133, 0.06);
            border-color: var(--primary);
        }

        .color-circle.out-of-stock-variant {
            opacity: 0.5;
            cursor: not-allowed;
            text-decoration: line-through;
        }

        .color-circle img {
            width: 62px;
            height: 46px;
            object-fit: contain;
            margin-bottom: 6px;
        }

        .color-label {
            font-size: 14px;
            font-weight: 600;
            color: #222;
        }

        .sizes {
            display: flex;
            gap: 10px;
            align-items: center;
            margin-bottom: 18px;
            margin-top: 6px;
            flex-wrap: wrap;
        }

        .size-pill {
            padding: 6px 14px;
            border-radius: 16px;
            border: 1.6px solid #b8b0b0;
            font-weight: 600;
            font-size: 14px;
            background: white;
            cursor: pointer;
            transition: all .12s;
        }

        .size-pill.active {
            background: transparent;
            border-color: #0b7285;
            color: #0b7285;
            font-weight: 700;
        }

        .action-buttons {
            display: flex;
            align-items: center;
            gap: 12px;
            margin-top: 15px;
        }

        .add-to-cart-btn {
            background-color: #2ecc71;
            /* Green */
            color: #fff;
            border: none;
            border-radius: 50px;
            padding: 14px 28px;
            font-size: 16px;
            font-weight: 600;
            cursor: pointer;
            transition: all 0.3s ease;
        }

        .add-to-cart-btn:hover {
            background-color: #28b862;
        }

        .buy-now-area {
            display: flex;
            flex-direction: column;
            align-items: flex-end;
            position: relative;
        }

        .buy-now-btn {
            background: #fff;
            color: #0aa05a;
            border: 2px solid #0aa05a;
            border-radius: 50px;
            padding: 12px 32px 12px 26px;
            font-size: 18px;
            font-weight: 700;
            cursor: pointer;
            display: inline-flex;
            align-items: center;
            gap: 15px;
            box-shadow: 0 4px 16px rgba(10, 160, 90, 0.08);
            transition: background 0.2s, color 0.2s;
        }

        .buy-now-btn:hover {
            background: #0aa05a;
            color: #fff;
        }

        .buy-now-icon {
            display: inline-flex;
            align-items: center;
            justify-content: center;
            width: 32px;
            height: 32px;
            border-radius: 50%;
            background: #0aa05a;
            margin-left: 10px;
        }

        .buy-now-btn .buy-now-icon i {
            color: #fff;
            font-size: 18px;
        }

        .qty-box {
            display: flex;
            align-items: center;
            border: 1px solid #ccc;
            border-radius: 8px;
            overflow: hidden;
        }

        .qty-btn {
            background: #fff;
            color: #0aa05a;
            border: none;
            width: 36px;
            height: 36px;
            font-weight: 700;
            cursor: pointer;
            transition: all 0.3s ease;
        }

        .qty-btn:hover {
            background: #0aa05a;
            color: #fff;
        }

        .qty-box input {
            width: 50px;
            text-align: center;
            border: none;
            outline: none;
        }

        .product-action-row {
            display: flex;
            align-items: center;
            justify-content: space-between;
            gap: 8px;
            margin-top: 1px;
            flex-wrap: wrap;
        }

        .wallet-pill {
            display: inline-block;
            margin-top: 10px;
            background: #d8bfd8;
            color: #333333;
            padding: 10px 14px;
            border-radius: 18px;
            font-weight: 600;
            margin-bottom: 10px;
        }

        .guarantee {
            border-radius: 12px;
            padding: 18px;
            margin-top: 18px;
            background: #f5f5f5;
            border: 1px solid #eaeaea;
        }

        .guar-head {
            display: flex;
            align-items: center;
            gap: 12px;
            margin-bottom: 8px;
        }

        .guar-icon {
            width: 44px;
            height: 44px;
            border-radius: 8px;
            background: #e9f8f3;
            display: flex;
            align-items: center;
            justify-content: center;
            color: var(--primary);
            font-size: 20px;
        }

        @media (max-width: 767px) {
            .thumbs-vertical {
                flex-direction: row;
                justify-content: center;
                margin-bottom: 12px;
            }

            .thumb-btn,
            .video-thumb {
                width: 60px;
                height: 60px;
            }

            .image-card {
                height: auto;
            }

            .product-panel {
                padding: 18px;
            }
        }

        .guar-list {
            list-style-type: disc !important;
            list-style-position: outside !important;
            margin-left: 25px !important;
            padding-left: 20px !important;
        }

        .guar-list li {
            display: list-item !important;
            list-style-type: disc !important;
        }

        .floating-heart {
            position: absolute;
            top: 66px;
            right: 14px;
            z-index: 10;
            background-color: rgba(255, 255, 255, 0.85);
            color: #e74c3c;
            border: 1.5px solid #e74c3c;
            height: 44px;
            width: 44px;
            border-radius: 50%;
            display: flex;
            align-items: center;
            justify-content: center;
            transition: all 0.3s ease;
            cursor: pointer;
        }

        .floating-heart:hover {
            background-color: #e74c3c;
            color: #fff;
        }

        .active_wish {
            background-color: #e74c3c !important;
            color: #fff !important;
        }

        /* ── Affiliate Share Button ── */
        .floating-share {
            position: absolute;
            top: 14px;
            /* just below the heart */
            right: 14px;
            z-index: 10;
            background-color: rgba(255, 255, 255, 0.85);
            color: #0b7285;
            border: 1.5px solid #0b7285;
            height: 44px;
            width: 44px;
            border-radius: 50%;
            display: flex;
            align-items: center;
            justify-content: center;
            transition: all 0.3s ease;
            cursor: pointer;
            font-size: 16px;
        }

        .floating-share:hover {
            background-color: #0b7285;
            color: #fff;
        }

        .floating-share.loading {
            pointer-events: none;
            opacity: .65;
        }

        /* ── Affiliate Share Panel ── */
        .affiliate-share-panel {
            display: none;
            margin-top: 14px;
            background: linear-gradient(135deg, #f0fbfd 0%, #e8f7f9 100%);
            border: 1.5px solid #b2e0e8;
            border-radius: 14px;
            padding: 18px 20px;
            animation: slideDown .25s ease;
        }

        .affiliate-share-panel.show {
            display: block;
        }

        @keyframes slideDown {
            from {
                opacity: 0;
                transform: translateY(-8px);
            }

            to {
                opacity: 1;
                transform: translateY(0);
            }
        }

        .aff-panel-title {
            font-size: 13px;
            font-weight: 700;
            color: #0b7285;
            margin-bottom: 10px;
            display: flex;
            align-items: center;
            gap: 6px;
        }

        .aff-commission-badge {
            display: inline-block;
            background: #0b7285;
            color: #fff;
            font-size: 11px;
            font-weight: 700;
            padding: 2px 8px;
            border-radius: 20px;
            margin-left: 4px;
        }

        .aff-link-box {
            display: flex;
            align-items: center;
            gap: 8px;
            background: #fff;
            border: 1px solid #c8e8ee;
            border-radius: 8px;
            padding: 8px 12px;
            margin-bottom: 12px;
        }

        .aff-link-box input {
            flex: 1;
            border: none;
            outline: none;
            font-size: 13px;
            color: #333;
            background: transparent;
            overflow: hidden;
            text-overflow: ellipsis;
            white-space: nowrap;
        }

        .aff-copy-btn {
            background: #0b7285;
            color: #fff;
            border: none;
            border-radius: 6px;
            padding: 5px 12px;
            font-size: 12px;
            font-weight: 600;
            cursor: pointer;
            white-space: nowrap;
            transition: background .2s;
        }

        .aff-copy-btn:hover {
            background: #085f70;
        }

        .aff-copy-btn.copied {
            background: #0aa05a;
        }

        .aff-socials {
            display: flex;
            gap: 8px;
            flex-wrap: wrap;
        }

        .aff-social-btn {
            display: inline-flex;
            align-items: center;
            gap: 6px;
            border: none;
            border-radius: 20px;
            padding: 6px 14px;
            font-size: 12px;
            font-weight: 600;
            cursor: pointer;
            text-decoration: none;
            transition: opacity .2s, transform .1s;
        }

        .aff-social-btn:hover {
            opacity: .85;
            transform: translateY(-1px);
        }

        .aff-social-btn.whatsapp {
            background: #25d366;
            color: #fff;
        }

        .aff-social-btn.facebook {
            background: #1877f2;
            color: #fff;
        }

        .aff-social-btn.twitter {
            background: #1da1f2;
            color: #fff;
        }

        .aff-social-btn.copy-native {
            background: #6c757d;
            color: #fff;
        }

        .aff-not-affiliate {
            font-size: 13px;
            color: #555;
            text-align: center;
            padding: 4px 0;
        }

        .aff-not-affiliate a {
            color: #0b7285;
            font-weight: 700;
        }

        .more-sellers[data-tooltip]:hover:after {
            content: attr(data-tooltip);
            position: absolute;
            left: 0;
            top: 120%;
            background: #212121;
            color: #fff;
            padding: 5px 12px;
            border-radius: 6px;
            font-size: 13px;
            white-space: nowrap;
            z-index: 5;
        }

        .ratings {
            display: flex;
            align-items: center;
            gap: 5px;
        }

        .stars {
            color: #ffc107;
        }

        .star-empty {
            color: #ddd;
        }

        .review-count {
            color: #666;
            font-size: 14px;
        }

        @media only screen and (max-width:991px) {
            .review-count {
                font-size: 12px !important;
            }
        }

        /* Tooltip style */
        .caution-icon {
            margin-left: 6px;
            cursor: pointer;
            position: relative;
        }

        .caution-icon::after {
            content: attr(data-tooltip);
            position: absolute;
            bottom: 125%;
            left: 50%;
            transform: translateX(-50%);
            background: #000;
            color: #fff;
            padding: 6px 10px;
            border-radius: 4px;
            white-space: nowrap;
            font-size: 13px;
            opacity: 0;
            pointer-events: none;
            transition: opacity 0.3s;
        }

        .caution-icon:hover::after {
            opacity: 1;
        }

        .reviews-with-images {
            position: relative;
        }

        .review-images-slider {
            scroll-behavior: smooth;
            white-space: nowrap;
        }

        .review-images-slider img {
            width: 120px;
            height: 120px;
            object-fit: cover;
            border-radius: 6px;
            flex-shrink: 0;
        }

        .scroll-btn {
            position: absolute;
            top: 50%;
            transform: translateY(-50%);
            background: #fff;
            border: 1px solid #ccc;
            border-radius: 50%;
            width: 32px;
            height: 32px;
            cursor: pointer;
            font-weight: bold;
            display: flex;
            align-items: center;
            justify-content: center;
            z-index: 10;
        }

        .scroll-btn.left {
            left: -10px;
        }

        .scroll-btn.right {
            right: -10px;
        }

        .rating-summary .progress {
            height: 10px !important;
            width: 250px;
        }

        .rating-circle {
            width: 100px;
            height: 100px;
            position: relative;
        }

        .rating-circle canvas {
            position: absolute;
            top: 0;
            left: 0;
        }

        .rating-circle span {
            position: absolute;
            top: 50%;
            left: 50%;
            transform: translate(-50%, -50%);
            font-weight: bold;
            font-size: 20px;
        }

        .postal-text {
            cursor: pointer;
            color: black;
            transition: color 0.3s ease;
        }

        .postal-text:hover {
            color: #e74c3c;
        }

        .popup-overlay {
            display: none;
            position: fixed;
            top: 0;
            left: 0;
            width: 100%;
            height: 100%;
            background: rgba(0, 0, 0, 0.5);
            z-index: 9999;
            justify-content: center;
            align-items: center;
        }

        .popup-box {
            background: #fff;
            padding: 20px;
            border-radius: 8px;
            width: 350px;
            text-align: center;
            position: relative;
            box-shadow: 0px 4px 10px rgba(0, 0, 0, 0.2);
        }

        .close-btn {
            position: absolute;
            top: 10px;
            right: 15px;
            font-size: 22px;
            cursor: pointer;
        }

        .check-btn {
            background: #e74c3c;
            color: white;
            border: none;
            padding: 8px 15px;
            border-radius: 5px;
            cursor: pointer;
        }

        .check-btn:hover {
            background: #c0392b;
        }

        .selected-variant-info {
            display: inline-flex;
            align-items: center;
            gap: 6px;
            background: #f0f7ff;
            border: 1px solid #b8d4f0;
            border-radius: 6px;
            padding: 4px 10px;
            font-size: 13px;
            margin-bottom: 14px;
        }

        /* Review Section Styles */
        .review-section {
            margin-top: 60px;
            margin-bottom: 60px;
        }

        .rating-summary-card {
            background: #fff;
            border: 1px solid #f0f0f0;
            border-radius: 16px;
            padding: 28px 32px;
            display: flex;
            gap: 40px;
            align-items: center;
            flex-wrap: wrap;
            margin-bottom: 32px;
            box-shadow: 0 2px 12px rgba(0, 0, 0, .05);
        }

        .rating-big-score {
            text-align: center;
            min-width: 110px;
        }

        .rating-big-score .score {
            font-size: 3.5rem;
            font-weight: 800;
            color: #111;
            line-height: 1;
        }

        .rating-breakdown {
            flex: 1;
            min-width: 200px;
        }

        .rating-bar-row {
            display: flex;
            align-items: center;
            gap: 10px;
            margin-bottom: 7px;
            font-size: .8rem;
        }

        .rating-bar-row .bar-label {
            min-width: 30px;
            color: #555;
            font-weight: 500;
        }

        .rating-bar-row .bar-track {
            flex: 1;
            height: 8px;
            background: #f0f0f0;
            border-radius: 99px;
            overflow: hidden;
        }

        .rating-bar-row .bar-fill {
            height: 100%;
            background: #f5a623;
            border-radius: 99px;
            transition: width .4s ease;
        }

        .rating-bar-row .bar-count {
            min-width: 24px;
            text-align: right;
            color: #888;
        }

        .write-review-card {
            background: #fff;
            border: 1px solid #f0f0f0;
            border-radius: 16px;
            padding: 28px 32px;
            margin-bottom: 32px;
            box-shadow: 0 2px 12px rgba(0, 0, 0, .05);
        }

        .star-picker {
            display: flex;
            gap: 6px;
            margin-bottom: 16px;
            flex-direction: row-reverse;
            justify-content: flex-end;
        }

        .star-picker input[type="radio"] {
            display: none;
        }

        .star-picker label {
            font-size: 2rem;
            color: #ddd;
            cursor: pointer;
            transition: color .15s, transform .1s;
        }

        .star-picker label:hover,
        .star-picker label:hover~label,
        .star-picker input[type="radio"]:checked~label {
            color: #f5a623;
        }

        .review-textarea {
            width: 100%;
            min-height: 110px;
            border: 1.5px solid #e5e7eb;
            border-radius: 10px;
            padding: 12px 14px;
            font-size: .875rem;
            resize: vertical;
            outline: none;
        }

        .image-upload-label {
            display: inline-flex;
            align-items: center;
            gap: 7px;
            cursor: pointer;
            font-size: .83rem;
            font-weight: 500;
            color: var(--primary);
            border: 1.5px dashed var(--primary);
            border-radius: 8px;
            padding: 7px 14px;
            transition: background .13s;
        }

        .review-card {
            background: #fff;
            border: 1px solid #f0f0f0;
            border-radius: 14px;
            padding: 22px 26px;
            margin-bottom: 18px;
            box-shadow: 0 1px 6px rgba(0, 0, 0, .04);
        }

        .reviewer-avatar {
            width: 40px;
            height: 40px;
            border-radius: 50%;
            background: linear-gradient(135deg, var(--primary), #9333ea);
            color: #fff;
            font-weight: 700;
            font-size: .9rem;
            display: flex;
            align-items: center;
            justify-content: center;
            flex-shrink: 0;
        }

        .review-photos {
            display: flex;
            flex-wrap: wrap;
            gap: 8px;
            margin-top: 12px;
        }

        .review-photos img {
            width: 72px;
            height: 72px;
            object-fit: cover;
            border-radius: 8px;
            border: 1px solid #eee;
        }

        .btn-delete-review {
            display: inline-flex;
            align-items: center;
            gap: 5px;
            font-size: .78rem;
            font-weight: 500;
            color: #dc2626;
            background: #fff0f0;
            border: 1px solid #fecaca;
            border-radius: 6px;
            padding: 4px 10px;
            cursor: pointer;
        }

        .img-preview-wrap {
            position: relative;
            width: 72px;
            height: 72px;
            border-radius: 8px;
            overflow: hidden;
            border: 1px solid #e5e7eb;
        }

        .img-preview-wrap img {
            width: 100%;
            height: 100%;
            object-fit: cover;
        }

        .img-preview-wrap .remove-img {
            position: absolute;
            top: 2px;
            right: 2px;
            background: rgba(0, 0, 0, .55);
            color: #fff;
            border: none;
            border-radius: 50%;
            width: 18px;
            height: 18px;
            font-size: 11px;
            cursor: pointer;
        }

        .login-to-review {
            background: #fdf8ff;
            border: 1.5px dashed #d8b4fe;
            border-radius: 12px;
            padding: 22px 28px;
            text-align: center;
            margin-bottom: 32px;
        }

        .already-reviewed-banner {
            background: #f0fdf4;
            border: 1.5px solid #86efac;
            border-radius: 12px;
            padding: 16px 22px;
            margin-bottom: 32px;
            display: flex;
            align-items: center;
            gap: 10px;
        }

        .review-alert {
            border-radius: 10px;
            padding: 13px 18px;
            font-size: .875rem;
            margin-bottom: 20px;
            display: flex;
            align-items: center;
            gap: 10px;
        }

        .review-alert.success {
            background: #f0fdf4;
            border: 1px solid #86efac;
            color: #166534;
        }

        .review-alert.error {
            background: #fff1f2;
            border: 1px solid #fecaca;
            color: #991b1b;
        }

        .subscribe-icon {
            position: relative;
            display: inline-block;
            cursor: pointer;
        }

        @keyframes ring {
            0% {
                transform: rotate(0);
            }

            1% {
                transform: rotate(30deg);
            }

            3% {
                transform: rotate(-28deg);
            }

            5% {
                transform: rotate(34deg);
            }

            7% {
                transform: rotate(-32deg);
            }

            9% {
                transform: rotate(30deg);
            }

            11% {
                transform: rotate(-28deg);
            }

            13% {
                transform: rotate(26deg);
            }

            15% {
                transform: rotate(-24deg);
            }

            41% {
                transform: rotate(0);
            }
        }

        .ringing {
            color: goldenrod !important;
            animation: ring .6s ease-in-out;
        }

        /* Additional styles for recommendation sections */
        .frequently-bought-section {
            background: #fff8f0;
            border-radius: 16px;
            padding: 25px;
            border: 1px solid #ffe0b5;
        }

        .bundle-total {
            margin-top: 20px;
            padding-top: 15px;
            border-top: 1px solid #ffe0b5;
            text-align: right;
        }

        @keyframes pulse {
            0% {
                transform: scale(1);
            }

            50% {
                transform: scale(1.05);
            }

            100% {
                transform: scale(1);
            }
        }

        .flash-sale-swiper .swiper-button-next,
        .flash-sale-swiper .swiper-button-prev,
        .best-selling-swiper .swiper-button-next,
        .best-selling-swiper .swiper-button-prev,
        .top-rated-swiper .swiper-button-next,
        .top-rated-swiper .swiper-button-prev,
        .new-arrivals-swiper .swiper-button-next,
        .new-arrivals-swiper .swiper-button-prev,
        .discounted-swiper .swiper-button-next,
        .discounted-swiper .swiper-button-prev,
        .same-seller-swiper .swiper-button-next,
        .same-seller-swiper .swiper-button-prev,
        .low-stock-swiper .swiper-button-next,
        .low-stock-swiper .swiper-button-prev {
            background: rgba(0, 0, 0, 0.5);
            color: white;
            width: 35px;
            height: 35px;
            border-radius: 50%;
        }

        .flash-sale-swiper .swiper-button-next:hover,
        .flash-sale-swiper .swiper-button-prev:hover {
            background: rgba(0, 0, 0, 0.8);
        }
    </style>

</head>

<body>

    @include('includes.header')

    @php
        /* ── Images ── */
        $productImages = $product->images;
        if (is_string($productImages)) {
            $productImages = json_decode($productImages, true);
        }
        $productImages = is_array($productImages) ? array_filter($productImages) : [];

        /* ── Videos ── */
        $productVideos = $product->videos;
        if (is_string($productVideos)) {
            $productVideos = json_decode($productVideos, true);
        }
        $productVideos = is_array($productVideos) ? array_filter($productVideos) : [];

        /* ── Pricing ── */
        $finalPrice = $product->final_price ?? $product->price;
        $hasDiscount = $product->discount_price && $product->discount_type;
        $discountPct = $product->discount_percentage ?? 0;

        /* ── Variants ── */
        $variants = $product->variants ?? collect();

        /* ── Reviews ── */
        $reviews = $product->reviews ?? collect();
        $totalReviews = $reviews->count();
        $avgRating = $totalReviews > 0 ? round($reviews->avg('rating'), 1) : 0;
        $userReview = auth()->check() ? $reviews->firstWhere('user_id', auth()->id()) : null;
        $ratingCounts = [];
        for ($s = 5; $s >= 1; $s--) {
            $ratingCounts[$s] = $reviews->where('rating', $s)->count();
        }
        $allReviewImages = $reviews->flatMap(fn($r) => !empty($r->image_urls) ? $r->image_urls : []);

        $relatedProducts = $product->relatedProducts ?? collect();

        // Get all recommendation collections from controller
        $suggestedProducts = $suggestedProducts ?? collect();
        $recommendedProducts = $recommendedProducts ?? collect();
        $bestSellingProducts = $bestSellingProducts ?? collect();
        $newArrivals = $newArrivals ?? collect();
        $frequentlyBoughtTogether = $frequentlyBoughtTogether ?? collect();
        $similarPriceProducts = $similarPriceProducts ?? collect();
        $topRatedProducts = $topRatedProducts ?? collect();
        $flashSaleProducts = $flashSaleProducts ?? collect();
        $sameSellerProducts = $sameSellerProducts ?? collect();
        $discountedProducts = $discountedProducts ?? collect();
        $lowStockProducts = $lowStockProducts ?? collect();
    @endphp

    <div class="container container-page">
        <nav aria-label="breadcrumb">
            <ol class="breadcrumb ps-0">
                <li class="breadcrumb-item"><a href="./" class="text-decoration-none text-muted">Home</a></li>
                @if ($product->category)
                    <li class="breadcrumb-item"><a href="#"
                            class="text-decoration-none text-muted">{{ $product->category->name }}</a></li>
                @endif
                <li class="breadcrumb-item active" aria-current="page">{{ $product->name }}</li>
            </ol>
        </nav>

        <div class="product-panel">
            <div class="row gx-4">
                <!-- LEFT -->
                <div class="col-lg-6">
                    <div class="d-flex align-items-start">
                        <div class="me-3 d-none d-md-flex thumbs-vertical">
                            <div class="thumb-btn active"
                                onclick="switchMainImage('{{ $product->thumbnail ? asset('storage/' . $product->thumbnail) : asset('assets/images/no-image.png') }}', this)">
                                <img src="{{ $product->thumbnail ? asset('storage/' . $product->thumbnail) : asset('assets/images/no-image.png') }}"
                                    alt="{{ $product->name }}">
                            </div>
                            @foreach ($productVideos as $i => $video)
                                <div class="video-thumb" data-bs-toggle="modal"
                                    data-bs-target="#videoModal{{ $i }}">
                                    <i class="fa fa-play-circle" style="font-size:20px;"></i>
                                    <small>Video {{ $i + 1 }}</small>
                                </div>
                            @endforeach
                            @foreach ($productImages as $i => $image)
                                <div class="thumb-btn"
                                    onclick="switchMainImage('{{ asset('storage/' . $image) }}', this)">
                                    <img src="{{ asset('storage/' . $image) }}"
                                        alt="{{ $product->name }} {{ $i + 1 }}">
                                </div>
                            @endforeach
                        </div>
                        <div class="flex-fill">
                            <div class="image-card position-relative">
                                {{-- Affiliate Share Button --}}

                                <button id="affShareBtn" class="floating-share"
                                    onclick="toggleAffiliatePanel({{ $product->id }})"
                                    title="Share & Earn Commission">
                                    <i class="fas fa-share-alt"></i>
                                </button>
                                {{-- Wishlist Heart --}}
                                <button id="wishlist-btn-{{ $product->id }}"
                                    class="heart-btn floating-heart {{ isset($product->is_wishlist) && $product->is_wishlist ? 'active_wish' : '' }}"
                                    onclick="addWishlist({{ $product->id }})">
                                    <i
                                        class="{{ isset($product->is_wishlist) && $product->is_wishlist ? 'fas' : 'far' }} fa-heart"></i>
                                </button>




                                <img id="mainImage"
                                    src="{{ $product->thumbnail ? asset('storage/' . $product->thumbnail) : asset('assets/images/no-image.png') }}"
                                    alt="{{ $product->name }}">
                            </div>

                            {{-- Affiliate Share Panel --}}
                            <div id="affiliateSharePanel" class="affiliate-share-panel">
                                <div id="affPanelContent">
                                    {{-- filled by JS --}}
                                </div>
                            </div>
                        </div>
                    </div>

                    <div class="desc-box mt-3">
                        <h5 style="font-weight:800;">Description</h5>
                        <p style="color:var(--primary); font-weight:700;">Listed by a verified partner store:
                            {{ $product->seller->shop_name ?? 'Unknown Seller' }}
                        </p>
                       
                        <p>{!! nl2br(e($product->description)) !!}</p>
                    </div>
                </div>

                <!-- RIGHT -->
                <div class="col-lg-6">
                    <h2 class="product-title">{{ $product->name }}</h2>

                    <div class="d-flex align-items-center gap-2 mb-2">
                        @if ($product->seller)
                            <h6 class="product-seller mb-0" style="color: blue;">Listed by a verified partner store:
                                {{ $product->seller->shop_name ?? 'Unknown Seller' }}
                            </h6>
                            <span class="subscribe-icon" data-tooltip="Subscribe this Seller" id="subscribeIcon">
                            <i class="fas fa-bell fa-lg text-primary" style="cursor:pointer;"></i>
                        </span>
                            
                        
                            
                        @endif

                        
                    </div>
                    <h6 class="product-seller mb-0" style="color: blue;">
                            <a href="{{ route('seller.store', $product->seller->id) }}" target="_blank" class="product-seller mb-0" style="color: blue;">
                             Visit Store:
                                {{ $product->seller->shop_name ?? 'Unknown Seller' }}
                            </a>
                    </h6>
                    
                    <br>

                    <div class="price-row mb-2">
                        <div class="price-container">
                            <span class="currency">{{ $product->currency ?? '$' }}</span>
                            <span class="price-big" id="current-price">{{ number_format($finalPrice, 2) }}</span>
                            <span class="price-small"></span>
                        </div>
                        @if ($hasDiscount)
                            <div class="price-info">
                                <span class="badge-discount">{{ number_format($product->discount * 100, 0) }}%
                                    off</span>
                                <span
                                    class="price-dec">{{ $product->currency ?? '$' }}{{ number_format($product->price, 2) }}</span>
                            </div>
                        @endif
                        <div class="rating">
                            <span class="stars" id="starsContainer"></span>
                            <span id="reviewCount">{{ $totalReviews }} Reviews</span>
                        </div>
                    </div>

                    <div class="stock-status-row" style="display: flex; align-items: center;">
                        <span id="stockText" class="in-stock" style="font-weight: 600;">
                            <span id="stock-status"
                                class="{{ $product->stock_quantity > 0 ? 'in-stock' : 'out-of-stock' }}">
                                {{ $product->stock_quantity > 0 ? 'In Stock' : 'Out of Stock' }}
                            </span>
                            <span id="stock-count">({{ $product->stock_quantity }} stocks)</span>
                        </span>
                    </div>

                    <div class="delivery-label">Delivery: <span>$6 USD (5 Days estimated)</span></div>

                    @if ($product->sku)
                        <span><strong>SKU:</strong> <span id="display-sku">{{ $product->sku }}</span></span>
                        &nbsp;|&nbsp;
                    @endif
                    @if ($product->brand)
                        <span><strong>Brand:</strong> {{ $product->brand->name }}</span> &nbsp;|&nbsp;
                    @endif
                    @if ($product->category)
                        <span><strong>Category:</strong> {{ $product->category->name }}</span>
                    @endif

                    @if ($variants->count() > 0)
                        <div style="font-weight:700; margin-top:15px;">Variants:</div>
                        <div class="colors-grid" id="colorsGrid">
                            <button class="color-circle active" data-variant-id="base" data-variant-name="Base"
                                data-variant-price="{{ $finalPrice }}" data-variant-sku="{{ $product->sku }}"
                                data-variant-qty="{{ $product->stock_quantity }}"
                                data-variant-images='@json(array_values(array_map(fn($img) => asset("storage/$img"), $productImages)))'
                                data-variant-thumb="{{ $product->thumbnail ? asset('storage/' . $product->thumbnail) : '' }}"
                                onclick="selectVariant(this)">
                                <div class="color-label">Default</div>
                            </button>

                            @foreach ($variants as $variant)
                                @php
                                    $vImgs = $variant->images;
                                    if (is_string($vImgs)) {
                                        $vImgs = json_decode($vImgs, true);
                                    }
                                    $vImgs = is_array($vImgs) ? array_filter(array_values($vImgs)) : [];
                                    $firstThumb = !empty($vImgs)
                                        ? asset('storage/' . reset($vImgs))
                                        : ($product->thumbnail
                                            ? asset('storage/' . $product->thumbnail)
                                            : '');
                                @endphp
                                <button
                                    class="color-circle {{ $variant->quantity <= 0 ? 'out-of-stock-variant' : '' }}"
                                    data-variant-id="{{ $variant->id }}"
                                    data-variant-name="{{ $variant->variant_name }}"
                                    data-variant-price="{{ $variant->price }}"
                                    data-variant-sku="{{ $variant->sku }}"
                                    data-variant-qty="{{ $variant->quantity }}"
                                    data-variant-images='@json(array_values(array_map(fn($img) => asset("storage/$img"), $vImgs)))'
                                    data-variant-thumb="{{ $firstThumb }}"
                                    {{ $variant->quantity <= 0 ? 'disabled' : '' }} onclick="selectVariant(this)">
                                    <div class="color-label">{{ $variant->variant_name }}</div>
                                    @if ($variant->quantity <= 0)
                                        <small>(Out)</small>
                                    @endif
                                </button>
                            @endforeach
                        </div>

                        <div id="variant-info-badge" class="selected-variant-info mt-2" style="display:none;">
                            <i class="fas fa-check-circle text-success"></i>
                            <span id="variant-badge-text"></span>
                        </div>

                        <div class="size-section d-flex align-items-center gap-2">
                            <div style="font-weight:700;">Size:</div>
                            <div class="sizes" id="sizeOptions">
                                @foreach ($product->sizes as $size)
                                    <div class="size-pill" data-size="{{ $size->size }}"
                                        onclick="selectSize(this)">
                                        {{ $size->size }}
                                    </div>
                                @endforeach
                            </div>
                        </div>
                    @endif

                    <!-- Unified Button Row -->
                    <div class="product-action-row">
                        <div class="qty-section d-flex align-items-center gap-2">
                            <div style="font-weight:700;">QTY:</div>
                            <div class="qty-box">
                                <button id="minus" class="qty-btn" onclick="changeQuantity(-1)">-</button>
                                <input id="qtyInput" type="number" value="1" min="1"
                                    max="{{ $product->maximum_purchase_quantity ?? 999 }}">
                                <button id="plus" class="qty-btn" onclick="changeQuantity(1)">+</button>
                            </div>
                        </div>
                        <div class="action-buttons">
                            @if (isset($product->is_cart) && $product->is_cart)
                                <button class="add-to-cart-btn"
                                    onclick="window.location.href='{{ route('cart.index') }}'">Go To Cart</button>
                            @else
                                <button class="add-to-cart-btn" onclick="addToCart({{ $product->id }})">Add to
                                    Cart</button>
                            @endif
                            <button class="buy-now-btn" onclick="buyNow({{ $product->id }})">
                                Buy Now
                            </button>
                        </div>
                    </div>

                    <div class="wallet-pill">Earn 50🪙 AyitiCash for buying with your wallet</div>

                    <div style="margin-top: 12px;">
                        <a href="#" style="color:#0b7285; font-weight:600; text-decoration:none;">
                            <i class="fa-regular fa-comment-dots"></i> Ask a question about this product
                        </a>
                    </div>

                    <div class="guarantee">
                        <div class="guar-head">
                            <div class="guar-icon"><i class="fa fa-shield-alt"></i></div>
                            <div>
                                <div style="font-weight:800; font-size:16px;">Guaranteed by Ayitibook</div>
                                <div style="font-size:13px; color:#666;">Delivery & Return Promise</div>
                            </div>
                        </div>
                        <ul class="guar-list mt-2">
                            <li>30 Day Money-Back</li>
                            <li>Real-time Tracking</li>
                            <li>Local Customer Support</li>
                        </ul>

                        <div style="margin-top:12px;">
                            <a href="#"
                                style="text-decoration:none; color:var(--primary); font-weight:700;">Delivery & Return
                                Policy</a>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <!-- Video Modals -->
    @foreach ($productVideos as $i => $video)
        <div class="modal fade" id="videoModal{{ $i }}" tabindex="-1" aria-hidden="true">
            <div class="modal-dialog modal-dialog-centered modal-lg">
                <div class="modal-content">
                    <div class="modal-body p-0">
                        <video controls class="w-100" style="max-height:500px;">
                            <source src="{{ asset('storage/' . $video) }}" type="video/mp4">
                        </video>
                    </div>
                    <button type="button" class="btn btn-secondary position-absolute top-0 end-0 m-2"
                        data-bs-dismiss="modal"><i class="fa fa-times"></i></button>
                </div>
            </div>
        </div>
    @endforeach

    <div class="container container-page">

        <!-- related product -->
        <div class="d-flex align-items-end gap-xl-5 gap-2 mb-3 flex-wrap position-relative mt-5">
            <div class="section-head mb-0">
                <span class="sub-title text-capitalize">Related Product</span>
            </div>
        </div>

        <div class="swiper related-product-swiper pt-3">
            <div class="swiper-wrapper">
                @forelse($relatedProducts as $related)
                    <div class="swiper-slide">
                        <div class="related-product mb-4">
                            <div class="media-box">
                                <div class="product-img">
                                    <a href="{{ route('products.show', $related) }}">
                                        <img src="{{ $related->thumbnail_url ?? asset('assets/images/no-image.png') }}"
                                            alt="{{ $related->name }}">
                                    </a>
                                    <div class="hover-btn">
                                        <button class="btn add-cart add-cart2"
                                            onclick="addToCart({{ $related->id }})">Add To Cart</button>
                                    </div>
                                </div>
                                @if ($related->discount_price)
                                    <span
                                        class="badge style1 badge-primary">-{{ round($related->discount_percentage) }}%</span>
                                @endif
                            </div>
                            <div class="content-box">
                                <h6 class="title">
                                    <a href="{{ route('products.show', $related) }}">{{ $related->name }}</a>
                                </h6>
                                <div class="meta-div">
                                    <span class="text1 text-danger">{{ $related->currency ?? '$' }}
                                        {{ number_format($related->final_price ?? $related->price, 2) }}</span>
                                    @if ($related->discount_price)
                                        <p class="text1 text-gray"><strike>{{ $related->currency ?? '$' }}
                                                {{ number_format($related->price, 2) }}</strike></p>
                                    @endif
                                </div>
                            </div>
                        </div>
                    </div>
                @empty
                    @for ($p = 0; $p < 4; $p++)
                        <div class="swiper-slide">
                            <div class="related-product mb-4" style="opacity:.4;">
                                <div class="media-box">
                                    <div class="product-img" style="background:#f5f5f5;height:200px;"></div>
                                </div>
                                <div class="content-box">
                                    <h6 class="title">No related products</h6>
                                </div>
                            </div>
                        </div>
                    @endfor
                @endforelse
            </div>
        </div>

        <!-- Suggested product -->
        <div class="d-flex align-items-end gap-xl-5 gap-2 mb-3 flex-wrap position-relative mt-5">
            <div class="section-head mb-0">
                <span class="sub-title text-capitalize">Suggested Product</span>
            </div>
        </div>

        <div class="swiper suggest-product-swiper pt-3">
            <div class="swiper-wrapper">
                @forelse($suggestedProducts->take(8) as $suggested)
                    <div class="swiper-slide">
                        <div class="suggested-product mb-4">
                            <div class="media-box">
                                <div class="product-img">
                                    <a href="{{ route('products.show', $suggested) }}">
                                        <img src="{{ $suggested->thumbnail_url ?? asset('assets/images/no-image.png') }}"
                                            alt="{{ $suggested->name }}">
                                    </a>
                                    <div class="hover-btn">
                                        <button class="btn add-cart add-cart2"
                                            onclick="addToCart({{ $suggested->id }})">Add To Cart</button>
                                    </div>
                                </div>
                                @if ($suggested->discount_price)
                                    <span
                                        class="badge style1 badge-primary">-{{ round($suggested->discount_percentage) }}%</span>
                                @endif
                            </div>
                            <div class="content-box">
                                <h6 class="title">
                                    <a href="{{ route('products.show', $suggested) }}">{{ $suggested->name }}</a>
                                </h6>
                                <div class="meta-div">
                                    <span class="text1 text-danger">{{ $suggested->currency ?? '$' }}
                                        {{ number_format($suggested->final_price ?? $suggested->price, 2) }}</span>
                                </div>
                            </div>
                        </div>
                    </div>
                @empty
                    @for ($p = 0; $p < 4; $p++)
                        <div class="swiper-slide">
                            <div class="suggested-product mb-4" style="opacity:.4;">
                                <div class="media-box">
                                    <div class="product-img" style="background:#f5f5f5;height:200px;"></div>
                                </div>
                                <div class="content-box">
                                    <h6 class="title">No suggested products</h6>
                                </div>
                            </div>
                        </div>
                    @endfor
                @endforelse
            </div>
        </div>

        <!-- Review Section -->
        <div class="review-section mb-5 mt-5" id="review-section">
            <div
                class="d-flex align-items-center justify-content-between gap-xl-5 gap-2 mb-3 flex-wrap position-relative">
                <div class="section-head mb-0">
                    <span class="sub-title text-capitalize text-dark mb-0">Ratings & Reviews</span>
                </div>
                @auth
                    @if (!$userReview)
                        <a href="#write-review" class="btn btn-primary btn-sm">Post Your Reviews</a>
                    @endif
                @endauth
            </div>

            <!-- Flash messages -->
            @if (session('review_success'))
                <div class="review-alert success">
                    <i class="fas fa-check-circle"></i> {{ session('review_success') }}
                </div>
            @endif
            @if (session('review_error'))
                <div class="review-alert error">
                    <i class="fas fa-exclamation-circle"></i> {{ session('review_error') }}
                </div>
            @endif

            <!-- Ratings Summary Section -->
            @if ($totalReviews > 0)
                <div class="rating-summary-card">
                    <div class="rating-big-score">
                        <div class="score">{{ number_format($avgRating, 1) }}</div>
                        <div class="rev-stars lg mt-1">
                            @for ($s = 1; $s <= 5; $s++)
                                @if ($s <= floor($avgRating))
                                    <i class="fas fa-star"></i>
                                @elseif($s - $avgRating < 1)
                                    <i class="fas fa-star-half-alt"></i>
                                @else
                                    <i class="far fa-star"></i>
                                @endif
                            @endfor
                        </div>
                        <div class="out-of">out of 5</div>
                        <div class="total-reviews">{{ $totalReviews }} {{ Str::plural('review', $totalReviews) }}
                        </div>
                    </div>

                    <div class="rating-breakdown">
                        @foreach ($ratingCounts as $star => $count)
                            <div class="rating-bar-row">
                                <span class="bar-label">{{ $star }} <i class="fas fa-star"
                                        style="color:#f5a623;font-size:.7rem;"></i></span>
                                <div class="bar-track">
                                    <div class="bar-fill"
                                        style="width: {{ $totalReviews > 0 ? round(($count / $totalReviews) * 100) : 0 }}%">
                                    </div>
                                </div>
                                <span class="bar-count">{{ $count }}</span>
                            </div>
                        @endforeach
                    </div>
                </div>
            @endif

            <!-- Write review form / login prompt / already-reviewed -->
            @auth
                @if ($userReview)
                    <div class="already-reviewed-banner">
                        <i class="fas fa-check-circle fa-lg"></i>
                        <div>
                            <strong>You've already reviewed this product.</strong>
                            Your {{ $userReview->rating }}-star review is shown below.
                        </div>
                    </div>
                @else
                    <div class="write-review-card" id="write-review">
                        <h5>
                            <i class="fas fa-pen-alt" style="color:var(--primary);"></i>
                            Share your experience
                        </h5>

                        @if ($errors->any())
                            <div class="review-alert error mb-3">
                                <i class="fas fa-exclamation-circle"></i>
                                <div>
                                    @foreach ($errors->all() as $err)
                                        <div>{{ $err }}</div>
                                    @endforeach
                                </div>
                            </div>
                        @endif

                        <form action="{{ route('reviews.store', $product) }}" method="POST"
                            enctype="multipart/form-data" id="reviewForm">
                            @csrf

                            <label class="form-label fw-semibold mb-1">Your Rating <span
                                    class="text-danger">*</span></label>
                            <div class="star-picker" id="starPicker">
                                @for ($s = 5; $s >= 1; $s--)
                                    <input type="radio" name="rating" id="star{{ $s }}"
                                        value="{{ $s }}" {{ old('rating') == $s ? 'checked' : '' }} required>
                                    <label for="star{{ $s }}"
                                        title="{{ $s }} star{{ $s > 1 ? 's' : '' }}">&#9733;</label>
                                @endfor
                            </div>
                            <p class="text-muted" id="star-hint"
                                style="font-size:.78rem;margin-top:-8px;margin-bottom:14px;">Click a star to rate</p>

                            <div class="mb-3">
                                <label class="form-label fw-semibold" for="reviewBody">Your Review <span
                                        class="text-danger">*</span></label>
                                <textarea id="reviewBody" name="body" class="review-textarea"
                                    placeholder="What did you like or dislike? How was the quality, packaging, delivery…" minlength="10"
                                    maxlength="2000" required>{{ old('body') }}</textarea>
                                <div class="d-flex justify-content-between mt-1">
                                    <span style="font-size:.72rem;color:#aaa;">Min 10 characters</span>
                                    <span id="charCount" style="font-size:.72rem;color:#aaa;">0 / 2000</span>
                                </div>
                            </div>

                            <div class="mb-4">
                                <label class="form-label fw-semibold">Photos <span class="text-muted fw-normal">(optional,
                                        up to 5)</span></label>
                                <div>
                                    <label for="reviewImagesTrigger" class="image-upload-label">
                                        <i class="fas fa-camera"></i> Add Photos
                                    </label>
                                    <div id="fileInputsContainer"></div>
                                    <input type="file" id="reviewImagesTrigger"
                                        accept="image/jpeg,image/png,image/jpg,image/webp" class="d-none"
                                        onchange="previewImages(this)">
                                </div>
                                <div id="review-image-previews"></div>
                            </div>

                            <button type="submit" class="btn btn-primary px-4">
                                <i class="fas fa-paper-plane me-1"></i> Submit Review
                            </button>
                        </form>
                    </div>
                @endif
            @else
                <div class="login-to-review">
                    <i class="fas fa-lock mb-2 d-block" style="font-size:1.5rem;color:#c084fc;"></i>
                    <strong>Want to share your experience?</strong><br>
                    <a href="{{ route('login') }}">Log in</a> or <a href="{{ route('register') }}">create an account</a>
                    to write a review.
                </div>
            @endauth

            <!-- Review list -->
            @if ($totalReviews > 0)
                <h6 class="fw-bold mb-3"
                    style="color:#555;font-size:.85rem;text-transform:uppercase;letter-spacing:.05em;">
                    {{ $totalReviews }} {{ Str::plural('Review', $totalReviews) }}
                </h6>

                @foreach ($reviews as $review)
                    <div class="review-card" id="review-{{ $review->id }}">
                        <div class="d-flex align-items-flex-start justify-content-between gap-3 flex-wrap">
                            <div class="d-flex align-items-center gap-3">
                                <div class="reviewer-avatar">
                                    {{ strtoupper(substr($review->user->name ?? 'A', 0, 2)) }}
                                </div>
                                <div>
                                    <div class="reviewer-name">
                                        {{ $review->user->name ?? 'Anonymous' }}
                                        @if (auth()->check() && $review->user_id === auth()->id())
                                            <span class="ms-1"
                                                style="font-size:.72rem;color:#9ca3af;font-weight:400;">(you)</span>
                                        @endif
                                    </div>
                                    <div class="review-date">{{ $review->created_at->format('d M Y') }}</div>
                                </div>
                            </div>

                            <div class="d-flex align-items-center gap-3 flex-wrap">
                                <span class="rev-stars">
                                    @for ($s = 1; $s <= 5; $s++)
                                        <i class="fa{{ $s <= $review->rating ? 's' : 'r' }} fa-star"></i>
                                    @endfor
                                    <span
                                        style="font-size:.78rem;color:#888;margin-left:4px;">{{ $review->rating }}/5</span>
                                </span>

                                @auth
                                    @if ($review->user_id === auth()->id())
                                        <button class="btn-delete-review" onclick="confirmDelete({{ $review->id }})">
                                            <i class="fas fa-trash-alt"></i> Delete
                                        </button>
                                    @endif
                                @endauth
                            </div>
                        </div>

                        <p class="review-body">{{ $review->body }}</p>

                        @if (!empty($review->images))
                            <div class="review-photos">
                                @foreach ($review->image_urls as $imgUrl)
                                    <a href="{{ $imgUrl }}" target="_blank" rel="noopener">
                                        <img src="{{ $imgUrl }}" alt="Review photo">
                                    </a>
                                @endforeach
                            </div>
                        @endif
                    </div>
                @endforeach
            @else
                <div class="text-center py-5" style="color:#bbb;">
                    <i class="far fa-comment-dots fa-3x mb-3 d-block"></i>
                    <p class="mb-0" style="font-size:.95rem;">No reviews yet. Be the first to review this product!
                    </p>
                </div>
            @endif
        </div>
    </div>

    <!-- ========== FREQUENTLY BOUGHT TOGETHER ========== -->
    @if (isset($frequentlyBoughtTogether) && $frequentlyBoughtTogether->count() > 0)
        <div class="container container-page mt-5">
            <div class="frequently-bought-section">
                <h4 style="color: #333; margin-bottom: 20px; font-weight: 700;">
                    <i class="fas fa-shopping-basket me-2"></i> Frequently Bought Together
                </h4>
                <div class="row">
                    <div class="col-md-12">
                        <div class="row align-items-center">
                            <!-- Current product -->
                            <div class="col-md-3">
                                <div class="d-flex align-items-center">
                                    <img src="{{ $product->thumbnail ? asset('storage/' . $product->thumbnail) : asset('assets/images/no-image.png') }}"
                                        alt="{{ $product->name }}"
                                        style="width: 80px; height: 80px; object-fit: contain;">
                                    <div class="ms-3">
                                        <strong>{{ Str::limit($product->name, 40) }}</strong>
                                        <div class="current-price" style="color: var(--primary); font-weight: 700;">
                                            {{ $product->currency ?? '$' }} {{ number_format($finalPrice, 2) }}
                                        </div>
                                    </div>
                                </div>
                            </div>

                            @foreach ($frequentlyBoughtTogether as $index => $item)
                                <div class="col-md-3">
                                    <div class="d-flex align-items-center">
                                        @if ($index == 0)
                                            <div class="me-2"><i class="fas fa-plus-circle text-muted"></i></div>
                                        @endif
                                        <div>
                                            <img src="{{ $item->thumbnail_url ?? asset('assets/images/no-image.png') }}"
                                                alt="{{ $item->name }}"
                                                style="width: 80px; height: 80px; object-fit: contain;">
                                        </div>
                                        <div class="ms-3">
                                            <strong>{{ Str::limit($item->name, 35) }}</strong>
                                            <div class="current-price"
                                                style="color: var(--primary); font-weight: 700;">
                                                {{ $item->currency ?? '$' }}
                                                {{ number_format($item->final_price ?? $item->price, 2) }}</div>
                                            <label class="mt-1">
                                                <input type="checkbox" class="bundle-item"
                                                    data-price="{{ $item->final_price ?? $item->price }}"
                                                    data-id="{{ $item->id }}" checked> Add
                                            </label>
                                        </div>
                                    </div>
                                </div>
                            @endforeach
                        </div>

                        <div class="bundle-total">
                            <span>Total: <span class="total-price" id="bundleTotal"
                                    style="font-size: 20px; font-weight: 700; color: var(--primary);">{{ $product->currency ?? '$' }}
                                    {{ number_format($finalPrice + $frequentlyBoughtTogether->sum(fn($i) => $i->final_price ?? $i->price), 2) }}</span></span>
                            <button class="btn-add-bundle" onclick="addBundleToCart()"
                                style="background: var(--primary); color: white; border: none; padding: 10px 25px; border-radius: 8px; margin-left: 15px; cursor: pointer;">
                                <i class="fas fa-shopping-cart me-1"></i> Add All to Cart
                            </button>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    @endif

    <!-- ========== FLASH SALE SECTION ========== -->
    @if (isset($flashSaleProducts) && $flashSaleProducts->count() > 0)
        <div class="container container-page mt-5">
            <div class="d-flex align-items-end gap-xl-5 gap-2 mb-3 flex-wrap position-relative">
                <div class="section-head mb-0">
                    <span class="sub-title text-capitalize">
                        <i class="fas fa-bolt me-2" style="color: #ff4757;"></i> Flash Sale
                        <span class="badge bg-danger ms-2" style="animation: pulse 1.5s infinite;">Limited
                            Time!</span>
                    </span>
                </div>
                <a href="{{ route('products.index', ['flash_sale' => 1]) }}" class="text-primary">View All →</a>
            </div>

            <div class="swiper flash-sale-swiper pt-3">
                <div class="swiper-wrapper">
                    @foreach ($flashSaleProducts as $item)
                        <div class="swiper-slide">
                            <div class="related-product mb-4">
                                <div class="media-box">
                                    <div class="product-img position-relative">
                                        <a href="{{ route('products.show', $item) }}">
                                            <img src="{{ $item->thumbnail_url ?? asset('assets/images/no-image.png') }}"
                                                alt="{{ $item->name }}">
                                        </a>
                                        <span class="badge bg-danger position-absolute top-0 start-0 m-2">FLASH
                                            SALE</span>
                                        @if ($item->discount_percentage > 0)
                                            <span
                                                class="badge bg-warning position-absolute top-0 end-0 m-2">-{{ round($item->discount_percentage) }}%</span>
                                        @endif
                                    </div>
                                </div>
                                <div class="content-box">
                                    <h6 class="title">
                                        <a href="{{ route('products.show', $item) }}">{{ $item->name }}</a>
                                    </h6>
                                    <div class="meta-div">
                                        <span class="text1 text-danger">{{ $item->currency ?? '$' }}
                                            {{ number_format($item->final_price ?? $item->price, 2) }}</span>
                                        @if ($item->price > ($item->final_price ?? $item->price))
                                            <p class="text1 text-gray"><strike>{{ $item->currency ?? '$' }}
                                                    {{ number_format($item->price, 2) }}</strike></p>
                                        @endif
                                    </div>
                                    <button class="btn btn-sm btn-primary w-100 mt-2"
                                        onclick="addToCart({{ $item->id }})">
                                        <i class="fas fa-shopping-cart me-1"></i> Add to Cart
                                    </button>
                                </div>
                            </div>
                        </div>
                    @endforeach
                </div>
                <div class="swiper-pagination"></div>
                <div class="swiper-button-next"></div>
                <div class="swiper-button-prev"></div>
            </div>
        </div>
    @endif

    <!-- ========== BEST SELLING PRODUCTS ========== -->
    @if (isset($bestSellingProducts) && $bestSellingProducts->count() > 0)
        <div class="container container-page mt-5">
            <div class="d-flex align-items-end gap-xl-5 gap-2 mb-3 flex-wrap position-relative">
                <div class="section-head mb-0">
                    <span class="sub-title text-capitalize">
                        <i class="fas fa-trophy me-2" style="color: #f39c12;"></i> Best Sellers
                    </span>
                </div>
                <a href="{{ route('products.index', ['sort' => 'best_selling']) }}" class="text-primary">View All
                    →</a>
            </div>

            <div class="swiper best-selling-swiper pt-3">
                <div class="swiper-wrapper">
                    @foreach ($bestSellingProducts as $item)
                        <div class="swiper-slide">
                            <div class="related-product mb-4">
                                <div class="media-box">
                                    <div class="product-img">
                                        <a href="{{ route('products.show', $item) }}">
                                            <img src="{{ $item->thumbnail_url ?? asset('assets/images/no-image.png') }}"
                                                alt="{{ $item->name }}">
                                        </a>
                                        <div class="hover-btn">
                                            <button class="btn add-cart add-cart2"
                                                onclick="addToCart({{ $item->id }})">Add To Cart</button>
                                        </div>
                                    </div>
                                    <span class="badge"
                                        style="background: #f39c12; position: absolute; top: 10px; left: 10px;">Best
                                        Seller</span>
                                </div>
                                <div class="content-box">
                                    <h6 class="title">
                                        <a href="{{ route('products.show', $item) }}">{{ $item->name }}</a>
                                    </h6>
                                    <div class="meta-div">
                                        <span class="text1 text-danger">{{ $item->currency ?? '$' }}
                                            {{ number_format($item->final_price ?? $item->price, 2) }}</span>
                                    </div>
                                    <div class="bottom-box d-flex align-items-center">
                                        <div class="d-flex align-items-center rating-icon">
                                            @for ($i = 1; $i <= 5; $i++)
                                                <i class="fa{{ $i <= round($item->avg_rating ?? 0) ? 's' : 'r' }} fa-star"
                                                    style="color: #ffc107;"></i>
                                            @endfor
                                        </div>
                                        <p class="rating-num mb-0"> ({{ $item->reviews_count ?? 0 }})</p>
                                    </div>
                                </div>
                            </div>
                        </div>
                    @endforeach
                </div>
                <div class="swiper-pagination"></div>
                <div class="swiper-button-next"></div>
                <div class="swiper-button-prev"></div>
            </div>
        </div>
    @endif

    <!-- ========== TOP RATED PRODUCTS ========== -->
    @if (isset($topRatedProducts) && $topRatedProducts->count() > 0)
        <div class="container container-page mt-5">
            <div class="d-flex align-items-end gap-xl-5 gap-2 mb-3 flex-wrap position-relative">
                <div class="section-head mb-0">
                    <span class="sub-title text-capitalize">
                        <i class="fas fa-star me-2" style="color: #ffc107;"></i> Top Rated Products
                    </span>
                </div>
                <a href="{{ route('products.index', ['min_rating' => 4]) }}" class="text-primary">View All →</a>
            </div>

            <div class="swiper top-rated-swiper pt-3">
                <div class="swiper-wrapper">
                    @foreach ($topRatedProducts as $item)
                        <div class="swiper-slide">
                            <div class="related-product mb-4">
                                <div class="media-box">
                                    <div class="product-img">
                                        <a href="{{ route('products.show', $item) }}">
                                            <img src="{{ $item->thumbnail_url ?? asset('assets/images/no-image.png') }}"
                                                alt="{{ $item->name }}">
                                        </a>
                                        <div class="hover-btn">
                                            <button class="btn add-cart add-cart2"
                                                onclick="addToCart({{ $item->id }})">Add To Cart</button>
                                        </div>
                                    </div>
                                    <span class="badge"
                                        style="background: #ffc107; position: absolute; top: 10px; left: 10px;">
                                        <i class="fas fa-star"></i> {{ number_format($item->avg_rating ?? 0, 1) }}
                                    </span>
                                </div>
                                <div class="content-box">
                                    <h6 class="title">
                                        <a href="{{ route('products.show', $item) }}">{{ $item->name }}</a>
                                    </h6>
                                    <div class="meta-div">
                                        <span class="text1 text-danger">{{ $item->currency ?? '$' }}
                                            {{ number_format($item->final_price ?? $item->price, 2) }}</span>
                                    </div>
                                    <div class="bottom-box d-flex align-items-center">
                                        <div class="d-flex align-items-center rating-icon">
                                            @for ($i = 1; $i <= 5; $i++)
                                                <i class="fa{{ $i <= round($item->avg_rating ?? 0) ? 's' : 'r' }} fa-star"
                                                    style="color: #ffc107;"></i>
                                            @endfor
                                        </div>
                                        <p class="rating-num mb-0"> ({{ $item->reviews_count ?? 0 }})</p>
                                    </div>
                                </div>
                            </div>
                        </div>
                    @endforeach
                </div>
                <div class="swiper-pagination"></div>
                <div class="swiper-button-next"></div>
                <div class="swiper-button-prev"></div>
            </div>
        </div>
    @endif

    <!-- ========== NEW ARRIVALS ========== -->
    @if (isset($newArrivals) && $newArrivals->count() > 0)
        <div class="container container-page mt-5">
            <div class="d-flex align-items-end gap-xl-5 gap-2 mb-3 flex-wrap position-relative">
                <div class="section-head mb-0">
                    <span class="sub-title text-capitalize">
                        <i class="fas fa-clock me-2" style="color: #3498db;"></i> New Arrivals
                    </span>
                </div>
                <a href="{{ route('products.index', ['sort' => 'newest']) }}" class="text-primary">View All →</a>
            </div>

            <div class="swiper new-arrivals-swiper pt-3">
                <div class="swiper-wrapper">
                    @foreach ($newArrivals as $item)
                        <div class="swiper-slide">
                            <div class="related-product mb-4">
                                <div class="media-box">
                                    <div class="product-img">
                                        <a href="{{ route('products.show', $item) }}">
                                            <img src="{{ $item->thumbnail_url ?? asset('assets/images/no-image.png') }}"
                                                alt="{{ $item->name }}">
                                        </a>
                                        <div class="hover-btn">
                                            <button class="btn add-cart add-cart2"
                                                onclick="addToCart({{ $item->id }})">Add To Cart</button>
                                        </div>
                                    </div>
                                    <span class="badge"
                                        style="background: #3498db; position: absolute; top: 10px; left: 10px;">NEW</span>
                                </div>
                                <div class="content-box">
                                    <h6 class="title">
                                        <a href="{{ route('products.show', $item) }}">{{ $item->name }}</a>
                                    </h6>
                                    <div class="meta-div">
                                        <span class="text1 text-danger">{{ $item->currency ?? '$' }}
                                            {{ number_format($item->final_price ?? $item->price, 2) }}</span>
                                    </div>
                                </div>
                            </div>
                        </div>
                    @endforeach
                </div>
                <div class="swiper-pagination"></div>
                <div class="swiper-button-next"></div>
                <div class="swiper-button-prev"></div>
            </div>
        </div>
    @endif

    <!-- ========== DISCOUNTED PRODUCTS ========== -->
    @if (isset($discountedProducts) && $discountedProducts->count() > 0)
        <div class="container container-page mt-5">
            <div class="d-flex align-items-end gap-xl-5 gap-2 mb-3 flex-wrap position-relative">
                <div class="section-head mb-0">
                    <span class="sub-title text-capitalize">
                        <i class="fas fa-tags me-2" style="color: #e74c3c;"></i> Special Offers
                    </span>
                </div>
                <a href="{{ route('products.index') }}" class="text-primary">View All →</a>
            </div>

            <div class="swiper discounted-swiper pt-3">
                <div class="swiper-wrapper">
                    @foreach ($discountedProducts as $item)
                        <div class="swiper-slide">
                            <div class="related-product mb-4">
                                <div class="media-box">
                                    <div class="product-img">
                                        <a href="{{ route('products.show', $item) }}">
                                            <img src="{{ $item->thumbnail_url ?? asset('assets/images/no-image.png') }}"
                                                alt="{{ $item->name }}">
                                        </a>
                                        <div class="hover-btn">
                                            <button class="btn add-cart add-cart2"
                                                onclick="addToCart({{ $item->id }})">Add To Cart</button>
                                        </div>
                                    </div>
                                    <span
                                        class="badge style1 badge-primary">-{{ round($item->discount_percentage ?? 0) }}%</span>
                                </div>
                                <div class="content-box">
                                    <h6 class="title">
                                        <a href="{{ route('products.show', $item) }}">{{ $item->name }}</a>
                                    </h6>
                                    <div class="meta-div">
                                        <span class="text1 text-danger">{{ $item->currency ?? '$' }}
                                            {{ number_format($item->final_price ?? $item->price, 2) }}</span>
                                        <p class="text1 text-gray"><strike>{{ $item->currency ?? '$' }}
                                                {{ number_format($item->price, 2) }}</strike></p>
                                    </div>
                                </div>
                            </div>
                        </div>
                    @endforeach
                </div>
                <div class="swiper-pagination"></div>
                <div class="swiper-button-next"></div>
                <div class="swiper-button-prev"></div>
            </div>
        </div>
    @endif

    <!-- ========== SAME SELLER PRODUCTS ========== -->
    @if (isset($sameSellerProducts) && $sameSellerProducts->count() > 0)
        <div class="container container-page mt-5">
            <div class="d-flex align-items-end gap-xl-5 gap-2 mb-3 flex-wrap position-relative">
                <div class="section-head mb-0">
                    <span class="sub-title text-capitalize">
                        <i class="fas fa-store me-2" style="color: #8e44ad;"></i> More from
                        {{ $product->seller->shop_name ?? 'this seller' }}
                    </span>
                </div>
            </div>

            <div class="swiper same-seller-swiper pt-3">
                <div class="swiper-wrapper">
                    @foreach ($sameSellerProducts as $item)
                        <div class="swiper-slide">
                            <div class="related-product mb-4">
                                <div class="media-box">
                                    <div class="product-img">
                                        <a href="{{ route('products.show', $item) }}">
                                            <img src="{{ $item->thumbnail_url ?? asset('assets/images/no-image.png') }}"
                                                alt="{{ $item->name }}">
                                        </a>
                                        <div class="hover-btn">
                                            <button class="btn add-cart add-cart2"
                                                onclick="addToCart({{ $item->id }})">Add To Cart</button>
                                        </div>
                                    </div>
                                </div>
                                <div class="content-box">
                                    <h6 class="title">
                                        <a href="{{ route('products.show', $item) }}">{{ $item->name }}</a>
                                    </h6>
                                    <div class="meta-div">
                                        <span class="text1 text-danger">{{ $item->currency ?? '$' }}
                                            {{ number_format($item->final_price ?? $item->price, 2) }}</span>
                                    </div>
                                </div>
                            </div>
                        </div>
                    @endforeach
                </div>
                <div class="swiper-pagination"></div>
                <div class="swiper-button-next"></div>
                <div class="swiper-button-prev"></div>
            </div>
        </div>
    @endif

    <!-- ========== LOW STOCK ALERT ========== -->
    @if (isset($lowStockProducts) && $lowStockProducts->count() > 0)
        <div class="container container-page mt-5">
            <div class="d-flex align-items-end gap-xl-5 gap-2 mb-3 flex-wrap position-relative">
                <div class="section-head mb-0">
                    <span class="sub-title text-capitalize">
                        <i class="fas fa-exclamation-triangle me-2" style="color: #e67e22;"></i> Almost Gone! Low
                        Stock
                    </span>
                </div>
            </div>

            <div class="swiper low-stock-swiper pt-3">
                <div class="swiper-wrapper">
                    @foreach ($lowStockProducts as $item)
                        <div class="swiper-slide">
                            <div class="related-product mb-4">
                                <div class="media-box">
                                    <div class="product-img">
                                        <a href="{{ route('products.show', $item) }}">
                                            <img src="{{ $item->thumbnail_url ?? asset('assets/images/no-image.png') }}"
                                                alt="{{ $item->name }}">
                                        </a>
                                        <div class="hover-btn">
                                            <button class="btn add-cart add-cart2"
                                                onclick="addToCart({{ $item->id }})">Buy Now</button>
                                        </div>
                                    </div>
                                    <span class="badge" style="background: #e67e22;">Only
                                        {{ $item->stock_quantity }} left!</span>
                                </div>
                                <div class="content-box">
                                    <h6 class="title">
                                        <a href="{{ route('products.show', $item) }}">{{ $item->name }}</a>
                                    </h6>
                                    <div class="meta-div">
                                        <span class="text1 text-danger">{{ $item->currency ?? '$' }}
                                            {{ number_format($item->final_price ?? $item->price, 2) }}</span>
                                    </div>
                                </div>
                            </div>
                        </div>
                    @endforeach
                </div>
                <div class="swiper-pagination"></div>
                <div class="swiper-button-next"></div>
                <div class="swiper-button-prev"></div>
            </div>
        </div>
    @endif

    <!-- Delete Review Modal -->
    <div class="modal fade" id="deleteReviewModal" tabindex="-1" aria-hidden="true">
        <div class="modal-dialog modal-dialog-centered">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title"><i class="fas fa-trash-alt me-2"></i>Delete Review</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal"></button>
                </div>
                <div class="modal-body py-4 text-center">
                    <i class="fas fa-exclamation-triangle fa-2x text-warning mb-3 d-block"></i>
                    <p class="mb-1 fw-semibold">Are you sure you want to delete your review?</p>
                    <p class="text-muted" style="font-size:.85rem;">This action cannot be undone.</p>
                </div>
                <div class="modal-footer border-0 justify-content-center gap-3">
                    <button type="button" class="btn btn-light px-4" data-bs-dismiss="modal">Cancel</button>
                    <form id="deleteReviewForm" method="POST">
                        @csrf
                        @method('DELETE')
                        <button type="submit" class="btn btn-danger px-4">
                            <i class="fas fa-trash-alt me-1"></i> Yes, Delete
                        </button>
                    </form>
                </div>
            </div>
        </div>
    </div>

    @include('includes.footer')

    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.6.4/jquery.min.js"></script>
    <script src="assets/vendor/swiper/swiper-bundle.min.js"></script>
    <script src="assets/js/custom-swiper.js"></script>
    <script src="assets/js/main.js"></script>
    <script src="assets/js/mobile.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha1/dist/js/bootstrap.bundle.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js"></script>
    <script type="text/javascript" src="https://cdn.jsdelivr.net/npm/toastify-js"></script>
    <script>
        // Base data
        const BASE_CURRENCY = "{{ $product->currency ?? '$' }}";
        const BASE_PRICE = {{ $finalPrice }};
        const BASE_QTY = {{ $product->stock_quantity }};
        const BASE_SKU = "{{ $product->sku }}";
        const BASE_THUMB = "{{ $product->thumbnail ? asset('storage/' . $product->thumbnail) : '' }}";
        const BASE_IMAGES = @json(array_values(array_map(fn($img) => asset("storage/$img"), $productImages)));

        let imageCount = 0;
        let selectedVariantId = null;
        let selectedSize = null;

        // Thumbnail switching
        function switchMainImage(src, element) {
            document.querySelectorAll('.thumb-btn').forEach(btn => btn.classList.remove('active'));
            element.classList.add('active');
            const mainImg = document.getElementById('mainImage');
            mainImg.classList.add('fading');
            setTimeout(() => {
                mainImg.src = src;
                mainImg.classList.remove('fading');
            }, 150);
        }

        // Size selection - UPDATED to store selected size
        function selectSize(element) {
            document.querySelectorAll('.size-pill').forEach(p => p.classList.remove('active'));
            element.classList.add('active');
            selectedSize = element.dataset.size;
        }

        // Quantity change
        function changeQuantity(change) {
            const input = document.getElementById('qtyInput');
            let val = parseInt(input.value) || 1;
            const max = parseInt(input.max) || 999;
            val = Math.min(Math.max(val + change, 1), max);
            input.value = val;
        }

        // Subscribe bell animation
        document.getElementById('subscribeIcon')?.addEventListener('click', function() {
            this.classList.add('ringing');
            setTimeout(() => this.classList.remove('ringing'), 600);
            this.classList.toggle('subscribed');
            this.style.color = this.classList.contains('subscribed') ? 'goldenrod' : '#0d6efd';
        });

        // Variant selector - UPDATED to store selected variant
        function selectVariant(btn) {
            if (btn.disabled) return;

            document.querySelectorAll('.color-circle').forEach(b => b.classList.remove('active'));
            btn.classList.add('active');

            // Store selected variant ID
            selectedVariantId = btn.dataset.variantId === 'base' ? null : btn.dataset.variantId;

            const price = parseFloat(btn.dataset.variantPrice);
            const sku = btn.dataset.variantSku;
            const qty = parseInt(btn.dataset.variantQty);
            const thumb = btn.dataset.variantThumb;
            let images = [];
            try {
                images = JSON.parse(btn.dataset.variantImages || '[]');
            } catch (e) {}

            // Update price
            document.getElementById('current-price').textContent = price.toFixed(2);

            // Update SKU
            const skuEl = document.getElementById('display-sku');
            if (skuEl) skuEl.textContent = sku || '—';

            // Update stock
            const stockStatus = document.getElementById('stock-status');
            const stockCount = document.getElementById('stock-count');
            stockStatus.textContent = qty > 0 ? 'In Stock' : 'Out of Stock';
            stockStatus.className = qty > 0 ? 'in-stock' : 'out-of-stock';
            stockCount.textContent = '(' + qty + ' stocks)';

            // Update quantity max
            document.getElementById('qtyInput').max = qty > 0 ? qty : 1;

            // Update variant badge
            const badge = document.getElementById('variant-info-badge');
            if (btn.dataset.variantId === 'base') {
                badge.style.display = 'none';
            } else {
                badge.style.display = 'inline-flex';
                document.getElementById('variant-badge-text').textContent = btn.dataset.variantName + (sku ? ' · SKU: ' +
                    sku : '');
            }

            // Update main image
            const mainImg = document.getElementById('mainImage');
            const newThumb = thumb || (images.length > 0 ? images[0] : BASE_THUMB);
            if (newThumb) {
                mainImg.classList.add('fading');
                setTimeout(() => {
                    mainImg.src = newThumb;
                    mainImg.classList.remove('fading');
                }, 150);
            }

            // Update thumbnails
            const galleryImages = images.length > 0 ? images : (thumb ? [thumb] : BASE_IMAGES);
            updateThumbnails(galleryImages, thumb);
        }

        function updateThumbnails(images, activeThumb) {
            const thumbContainer = document.querySelector('.thumbs-vertical');
            if (!thumbContainer) return;

            // Keep video thumbnails
            const videoThumbs = thumbContainer.querySelectorAll('.video-thumb');

            // Clear existing image thumbnails
            const existingThumbs = thumbContainer.querySelectorAll('.thumb-btn:not(.video-thumb)');
            existingThumbs.forEach(thumb => thumb.remove());

            // Add new image thumbnails
            images.forEach((img, i) => {
                if (!img) return;
                const thumbBtn = document.createElement('div');
                thumbBtn.className = 'thumb-btn' + (activeThumb === img ? ' active' : '');
                thumbBtn.innerHTML = `<img src="${img}" alt="Product image ${i+1}">`;
                thumbBtn.onclick = () => switchMainImage(img, thumbBtn);
                thumbContainer.appendChild(thumbBtn);
            });
        }

        // Star rating render
        function renderStars(rating) {
            const starsContainer = document.getElementById('starsContainer');
            if (!starsContainer) return;
            starsContainer.innerHTML = '';
            const fullStars = Math.floor(rating);
            const hasHalf = rating % 1 >= 0.5;
            const emptyStars = 5 - fullStars - (hasHalf ? 1 : 0);
            for (let i = 0; i < fullStars; i++) starsContainer.innerHTML += '<i class="fa fa-star"></i>';
            if (hasHalf) starsContainer.innerHTML += '<i class="fa fa-star-half-alt"></i>';
            for (let i = 0; i < emptyStars; i++) starsContainer.innerHTML += '<i class="fa-regular fa-star"></i>';
        }

        renderStars({{ $avgRating }});

        // Get selected variant ID
        function getSelectedVariantId() {
            return selectedVariantId;
        }

        // Get selected size - NEW FUNCTION
        function getSelectedSize() {
            return selectedSize;
        }

        // Toast notification
        function toast(msg, type) {
            Toastify({
                text: msg,
                duration: 3000,
                gravity: "top",
                position: "right",
                backgroundColor: type === "success" ? "linear-gradient(to right,#00b09b,#96c93d)" :
                    "linear-gradient(to right,#ff5f6d,#ffc371)"
            }).showToast();
        }

        // Add to cart - UPDATED to include size
        function addToCart(productId) {
            @guest
            window.location.href = "{{ route('login') }}";
            return;
        @endguest
        const variantId = getSelectedVariantId();
        const size = getSelectedSize();
        const quantity = document.getElementById('qtyInput').value;

        // Check if size is required (if size options exist)
        const sizeOptions = document.getElementById('sizeOptions');
        if (sizeOptions && sizeOptions.children.length > 0 && !size) {
            toast("Please select a size", "error");
            return;
        }

        $.ajax({
            url: "{{ route('cart.add') }}",
            type: "POST",
            data: {
                product_id: productId,
                variant_id: variantId,
                size: size,
                quantity: quantity,
                _token: "{{ csrf_token() }}"
            },
            success: function(r) {
                toast(r.message || "Added to cart!", "success");
                refreshCartCount();
            },
            error: function(xhr) {
                toast(xhr.responseJSON?.message || "Something went wrong!", "error");
            }
        });
        }

        // Buy now - UPDATED to include size
        function buyNow(productId) {
            @guest
            window.location.href = "{{ route('login') }}";
            return;
        @endguest
        const variantId = getSelectedVariantId();
        const size = getSelectedSize();
        const quantity = document.getElementById('qtyInput').value;

        // Check if size is required (if size options exist)
        const sizeOptions = document.getElementById('sizeOptions');
        if (sizeOptions && sizeOptions.children.length > 0 && !size) {
            toast("Please select a size", "error");
            return;
        }

        $.ajax({
            url: "{{ route('cart.add') }}",
            type: "POST",
            data: {
                product_id: productId,
                variant_id: variantId,
                size: size,
                quantity: quantity,
                _token: "{{ csrf_token() }}"
            },
            success: function(r) {
                toast(r.message || "Added!", "success");
                refreshCartCount();
                // Pass cart_item_id so cart page can select ONLY this item
                const cartItemId = r.cart_item_id || '';
                window.location.href = "{{ route('cart.index') }}" + (cartItemId ? '?buy_now=' +
                    cartItemId : '');
            },
            error: function(xhr) {
                toast(xhr.responseJSON?.message || "Something went wrong!", "error");
            }
        });
        }

        // Add to wishlist
        function addWishlist(productId) {
            $.ajax({
                url: "/wishlist/add",
                type: "POST",
                data: {
                    product_id: productId,
                    _token: "{{ csrf_token() }}"
                },
                success: function(r) {
                    toast(r.message || "Added to wishlist!", "success");
                    const btn = document.getElementById('wishlist-btn-' + productId);
                    if (btn) {
                        btn.classList.toggle('active_wish');
                        const icon = btn.querySelector('i');
                        if (icon) {
                            icon.classList.toggle('far');
                            icon.classList.toggle('fas');
                        }
                    }
                    refreshWishlistCount();
                },
                error: function(xhr) {
                    toast(xhr.responseJSON?.message || "Error", "error");
                }
            });
        }

        function refreshCartCount() {
            $.get("{{ route('cart.count') }}", function(d) {
                $("#cart-count").text(d.count);
            });
        }

        function refreshWishlistCount() {
            $.get("{{ route('wishlist.count') }}", function(d) {
                $("#wishlist-count").text(d.count);
            });
        }

        // Stock warning logic
        document.addEventListener('DOMContentLoaded', function() {
            var stockCount = {{ $product->stock_quantity }};
            var stockText = document.getElementById('stockText');

            if (stockCount === 0) {
                if (stockText) {
                    stockText.innerHTML = '<span style="color:#d93636;">Out of Stock</span>';
                }
            } else if (stockCount <= 7) {
                if (stockText) {
                    stockText.innerHTML = `
                    <span style="color:#d93636;">In Stock</span>
                    <span style="color:#d93636; font-weight:700;">
                        <i class="fa fa-exclamation-triangle stock-warning-icon" style="color:#ffc107; cursor:pointer" title="Stocks are getting exhausted, make it yours as soon as possible!"></i>
                    </span>
                `;
                }
            }

            // Initialize selected size from any pre-selected size pill
            const activeSize = document.querySelector('.size-pill.active');
            if (activeSize) {
                selectedSize = activeSize.dataset.size;
            }

            // Initialize selected variant from any pre-selected variant
            const activeVariant = document.querySelector('.color-circle.active');
            if (activeVariant && activeVariant.dataset.variantId !== 'base') {
                selectedVariantId = activeVariant.dataset.variantId;
            }
        });

        // Swiper initialization
        var relatedSwiper = new Swiper(".related-product-swiper", {
            slidesPerView: 4,
            spaceBetween: 30,
            pagination: {
                el: ".swiper-pagination",
                clickable: true
            },
            navigation: {
                nextEl: '.swiper-button-next',
                prevEl: '.swiper-button-prev'
            },
            breakpoints: {
                320: {
                    slidesPerView: 1
                },
                480: {
                    slidesPerView: 2
                },
                768: {
                    slidesPerView: 2
                },
                991: {
                    slidesPerView: 3
                },
                1024: {
                    slidesPerView: 3
                },
                1200: {
                    slidesPerView: 4
                }
            }
        });

        var suggestSwiper = new Swiper(".suggest-product-swiper", {
            slidesPerView: 4,
            spaceBetween: 30,
            pagination: {
                el: ".swiper-pagination",
                clickable: true
            },
            navigation: {
                nextEl: '.swiper-button-next',
                prevEl: '.swiper-button-prev'
            },
            breakpoints: {
                320: {
                    slidesPerView: 1
                },
                480: {
                    slidesPerView: 2
                },
                768: {
                    slidesPerView: 2
                },
                991: {
                    slidesPerView: 3
                },
                1024: {
                    slidesPerView: 3
                },
                1200: {
                    slidesPerView: 4
                }
            }
        });

        // Bundle total calculation
        function calculateBundleTotal() {
            let total = {{ $finalPrice }};
            document.querySelectorAll('.bundle-item').forEach(checkbox => {
                if (checkbox.checked) {
                    total += parseFloat(checkbox.dataset.price);
                }
            });
            const bundleTotal = document.getElementById('bundleTotal');
            if (bundleTotal) {
                bundleTotal.textContent = BASE_CURRENCY + ' ' + total.toFixed(2);
            }
        }

        // Add bundle to cart - UPDATED to handle size and variant for main product
        function addBundleToCart() {
            const variantId = getSelectedVariantId();
            const size = getSelectedSize();
            const quantity = document.getElementById('qtyInput').value;

            // Check if size is required for main product
            const sizeOptions = document.getElementById('sizeOptions');
            if (sizeOptions && sizeOptions.children.length > 0 && !size) {
                toast("Please select a size for the main product", "error");
                return;
            }

            // First add the main product with its selected options
            const productIds = [];

            // Add main product with selected options
            $.ajax({
                url: "{{ route('cart.add') }}",
                type: "POST",
                async: false,
                data: {
                    product_id: {{ $product->id }},
                    variant_id: variantId,
                    size: size,
                    quantity: quantity,
                    _token: "{{ csrf_token() }}"
                },
                success: function(r) {
                    productIds.push({{ $product->id }});
                },
                error: function(xhr) {
                    toast("Failed to add main product: " + (xhr.responseJSON?.message || "Error"), "error");
                    return;
                }
            });

            // Add bundle items
            document.querySelectorAll('.bundle-item').forEach(checkbox => {
                if (checkbox.checked) {
                    const itemId = parseInt(checkbox.dataset.id);
                    $.ajax({
                        url: "{{ route('cart.add') }}",
                        type: "POST",
                        async: false,
                        data: {
                            product_id: itemId,
                            quantity: 1,
                            _token: "{{ csrf_token() }}"
                        },
                        success: function(r) {
                            productIds.push(itemId);
                        }
                    });
                }
            });

            toast(productIds.length + ' items added to cart!', 'success');
            refreshCartCount();
            setTimeout(() => {
                window.location.href = "{{ route('cart.index') }}";
            }, 1000);
        }

        // Review star hints
        const starHints = {
            1: 'Terrible',
            2: 'Poor',
            3: 'Average',
            4: 'Good',
            5: 'Excellent'
        };
        document.querySelectorAll('.star-picker input[type="radio"]').forEach(radio => {
            radio.addEventListener('change', function() {
                const hint = document.getElementById('star-hint');
                if (hint) hint.textContent = starHints[this.value] || '';
            });
        });

        // Character counter
        const bodyEl = document.getElementById('reviewBody');
        const countEl = document.getElementById('charCount');
        if (bodyEl && countEl) {
            bodyEl.addEventListener('input', function() {
                countEl.textContent = this.value.length + ' / 2000';
                countEl.style.color = this.value.length > 1900 ? '#dc2626' : '#aaa';
            });
        }

        // Image preview for review
        function previewImages(trigger) {
            const maxFiles = 5;
            const container = document.getElementById('review-image-previews');
            const hiddenBox = document.getElementById('fileInputsContainer');
            const file = trigger.files[0];

            if (!file) return;

            const existing = hiddenBox.querySelectorAll('input[type="file"]').length;
            if (existing >= maxFiles) {
                toast('You can upload a maximum of 5 photos.', 'error');
                trigger.value = '';
                return;
            }

            const idx = imageCount++;

            const hiddenInput = document.createElement('input');
            hiddenInput.type = 'file';
            hiddenInput.name = 'images[]';
            hiddenInput.id = 'hiddenImg_' + idx;
            hiddenInput.style.display = 'none';
            hiddenInput.accept = 'image/jpeg,image/png,image/jpg,image/webp';

            try {
                const dt = new DataTransfer();
                dt.items.add(file);
                hiddenInput.files = dt.files;
            } catch (e) {
                trigger.name = 'images[]';
                trigger.id = 'hiddenImg_' + idx;
                hiddenBox.appendChild(trigger);

                const newTrigger = document.createElement('input');
                newTrigger.type = 'file';
                newTrigger.id = 'reviewImagesTrigger';
                newTrigger.accept = 'image/jpeg,image/png,image/jpg,image/webp';
                newTrigger.className = 'd-none';
                newTrigger.onchange = function() {
                    previewImages(this);
                };
                document.querySelector('label[for="reviewImagesTrigger"]').after(newTrigger);
                document.querySelector('label[for="reviewImagesTrigger"]').setAttribute('for', 'reviewImagesTrigger');

                showPreview(file, idx, container);
                return;
            }

            hiddenBox.appendChild(hiddenInput);
            showPreview(file, idx, container);
            trigger.value = '';
        }

        function showPreview(file, idx, container) {
            const reader = new FileReader();
            reader.onload = e => {
                const wrap = document.createElement('div');
                wrap.className = 'img-preview-wrap';
                wrap.setAttribute('data-img-idx', idx);
                wrap.innerHTML = `
                <img src="${e.target.result}" alt="Preview">
                <button type="button" class="remove-img" onclick="removePreview(${idx})">×</button>`;
                container.appendChild(wrap);
            };
            reader.readAsDataURL(file);
        }

        function removePreview(idx) {
            const inp = document.getElementById('hiddenImg_' + idx);
            if (inp) inp.remove();
            const wrap = document.querySelector(`.img-preview-wrap[data-img-idx="${idx}"]`);
            if (wrap) wrap.remove();
        }

        // Delete review confirm
        function confirmDelete(reviewId) {
            document.getElementById('deleteReviewForm').action = `/reviews/${reviewId}`;
            const modal = new bootstrap.Modal(document.getElementById('deleteReviewModal'));
            modal.show();
        }

        // Auto-scroll to review section if flash message present
        @if (session('review_success') || session('review_error'))
            document.addEventListener('DOMContentLoaded', () => {
                document.getElementById('review-section')?.scrollIntoView({
                    behavior: 'smooth',
                    block: 'start'
                });
            });
        @endif

        // Review images slider scroll buttons
        const slider = document.querySelector(".review-images-slider");
        const leftBtn = document.querySelector(".scroll-btn.left");
        const rightBtn = document.querySelector(".scroll-btn.right");

        if (leftBtn && rightBtn && slider) {
            leftBtn.addEventListener("click", () => {
                slider.scrollBy({
                    left: -150,
                    behavior: "smooth"
                });
            });
            rightBtn.addEventListener("click", () => {
                slider.scrollBy({
                    left: 150,
                    behavior: "smooth"
                });
            });
        }

        // =============================================================
        // Affiliate Share Panel
        // Uses $.ajax so Laravel session cookie is sent automatically,
        // same pattern as addToCart / addWishlist in this file.
        // =============================================================
        var affPanelOpen = false;
        var affLinkCache = null;

        function toggleAffiliatePanel(productId) {
            var panel = document.getElementById('affiliateSharePanel');
            var content = document.getElementById('affPanelContent');

            // Toggle closed
            if (affPanelOpen) {
                panel.classList.remove('show');
                affPanelOpen = false;
                return;
            }

            // Reuse cached link
            if (affLinkCache) {
                affRenderLink(content, affLinkCache);
                panel.classList.add('show');
                affPanelOpen = true;
                return;
            }

            // Open immediately with loading state
            content.innerHTML =
                '<div style="text-align:center;padding:14px 0;color:#0b7285;font-size:13px;font-weight:600;"><i class=\"fas fa-spinner fa-spin me-2\"></i> Generating your affiliate link...</div>';
            panel.classList.add('show');
            affPanelOpen = true;

            // jQuery ajax - sends session cookie automatically (same as addToCart)
            $.ajax({
                url: "{{ route('affiliate.generate-link') }}",
                type: "POST",
                data: {
                    product_id: productId,
                    _token: "{{ csrf_token() }}"
                },
                success: function(data) {
                    affLinkCache = data;
                    affRenderLink(content, data);
                },
                error: function(xhr) {
                    var resp = xhr.responseJSON || {};
                    if (xhr.status === 403 || resp.not_affiliate) {
                        affRenderNotAffiliate(content);
                    } else {
                        affRenderPlain(content);
                    }
                }
            });
        }

        function affRenderLink(container, data) {
            var url = data.url;
            var pct = data.commission_percentage;
            var text = encodeURIComponent('Check out this product! ' + url);
            var badge = pct ? '<span class=\"aff-commission-badge\">Earn ' + pct + '%</span>' : '';
            container.innerHTML =
                '<div class=\"aff-panel-title\"><i class=\"fas fa-link\"></i> Your Affiliate Link ' + badge + '</div>' +
                '<div class=\"aff-link-box\">' +
                '<input id=\"affLinkInput\" type=\"text\" value=\"' + url + '\" readonly>' +
                '<button class=\"aff-copy-btn\" id=\"affCopyBtn\" onclick=\"affCopy()\"><i class=\"fas fa-copy\"></i> Copy</button>' +
                '</div>' +
                '<div class=\"aff-socials\">' +
                '<a href=\"https://wa.me/?text=' + text +
                '\" target=\"_blank\" class=\"aff-social-btn whatsapp\"><i class=\"fab fa-whatsapp\"></i> WhatsApp</a>' +
                '<a href=\"https://www.facebook.com/sharer/sharer.php?u=' + encodeURIComponent(url) +
                '\" target=\"_blank\" class=\"aff-social-btn facebook\"><i class=\"fab fa-facebook-f\"></i> Facebook</a>' +
                '<a href=\"https://twitter.com/intent/tweet?text=' + text +
                '\" target=\"_blank\" class=\"aff-social-btn twitter\"><i class=\"fab fa-twitter\"></i> Twitter</a>' +
                '</div>';
        }

        function affRenderNotAffiliate(container) {
            container.innerHTML =
                '<div class=\"aff-not-affiliate\">' +
                '<i class=\"fas fa-info-circle text-primary me-1\"></i>' +
                ' You are not an affiliate yet. ' +
                "<a href=\"{{ route('dashboard') }}\">Join our affiliate program</a>" +
                ' to earn commissions by sharing products.' +
                '</div>';
        }

        function affRenderPlain(container) {
            var url = window.location.href;
            var text = encodeURIComponent('Check out this product! ' + url);
            container.innerHTML =
                '<div class=\"aff-panel-title\"><i class=\"fas fa-share-alt\"></i> Share this product</div>' +
                '<div class=\"aff-link-box\">' +
                '<input id=\"affLinkInput\" type=\"text\" value=\"' + url + '\" readonly>' +
                '<button class=\"aff-copy-btn\" id=\"affCopyBtn\" onclick=\"affCopy()\"><i class=\"fas fa-copy\"></i> Copy</button>' +
                '</div>' +
                '<div class=\"aff-socials\">' +
                '<a href=\"https://wa.me/?text=' + text +
                '\" target=\"_blank\" class=\"aff-social-btn whatsapp\"><i class=\"fab fa-whatsapp\"></i> WhatsApp</a>' +
                '<a href=\"https://www.facebook.com/sharer/sharer.php?u=' + encodeURIComponent(url) +
                '\" target=\"_blank\" class=\"aff-social-btn facebook\"><i class=\"fab fa-facebook-f\"></i> Facebook</a>' +
                '</div>';
        }

        function affCopy() {
            var input = document.getElementById('affLinkInput');
            var btn = document.getElementById('affCopyBtn');
            if (!input) return;
            if (navigator.clipboard && navigator.clipboard.writeText) {
                navigator.clipboard.writeText(input.value).then(function() {
                    btn.innerHTML = '<i class=\"fas fa-check\"></i> Copied!';
                    btn.classList.add('copied');
                    setTimeout(function() {
                        btn.innerHTML = '<i class=\"fas fa-copy\"></i> Copy';
                        btn.classList.remove('copied');
                    }, 2000);
                });
            } else {
                input.select();
                document.execCommand('copy');
                btn.innerHTML = '<i class=\"fas fa-check\"></i> Copied!';
                setTimeout(function() {
                    btn.innerHTML = '<i class=\"fas fa-copy\"></i> Copy';
                }, 2000);
            }
        }

        // Initialize all additional swipers
        document.addEventListener('DOMContentLoaded', function() {
            // Bundle checkboxes
            document.querySelectorAll('.bundle-item').forEach(checkbox => {
                checkbox.addEventListener('change', calculateBundleTotal);
            });

            // Flash Sale Swiper
            if (document.querySelector('.flash-sale-swiper')) {
                new Swiper(".flash-sale-swiper", {
                    slidesPerView: 4,
                    spaceBetween: 30,
                    autoplay: {
                        delay: 3000,
                        disableOnInteraction: false
                    },
                    pagination: {
                        el: ".swiper-pagination",
                        clickable: true
                    },
                    navigation: {
                        nextEl: '.swiper-button-next',
                        prevEl: '.swiper-button-prev'
                    },
                    breakpoints: {
                        320: {
                            slidesPerView: 1
                        },
                        480: {
                            slidesPerView: 2
                        },
                        768: {
                            slidesPerView: 2
                        },
                        991: {
                            slidesPerView: 3
                        },
                        1200: {
                            slidesPerView: 4
                        }
                    }
                });
            }

            // Best Selling Swiper
            if (document.querySelector('.best-selling-swiper')) {
                new Swiper(".best-selling-swiper", {
                    slidesPerView: 4,
                    spaceBetween: 30,
                    pagination: {
                        el: ".swiper-pagination",
                        clickable: true
                    },
                    navigation: {
                        nextEl: '.swiper-button-next',
                        prevEl: '.swiper-button-prev'
                    },
                    breakpoints: {
                        320: {
                            slidesPerView: 1
                        },
                        480: {
                            slidesPerView: 2
                        },
                        768: {
                            slidesPerView: 2
                        },
                        991: {
                            slidesPerView: 3
                        },
                        1200: {
                            slidesPerView: 4
                        }
                    }
                });
            }

            // Top Rated Swiper
            if (document.querySelector('.top-rated-swiper')) {
                new Swiper(".top-rated-swiper", {
                    slidesPerView: 4,
                    spaceBetween: 30,
                    pagination: {
                        el: ".swiper-pagination",
                        clickable: true
                    },
                    navigation: {
                        nextEl: '.swiper-button-next',
                        prevEl: '.swiper-button-prev'
                    },
                    breakpoints: {
                        320: {
                            slidesPerView: 1
                        },
                        480: {
                            slidesPerView: 2
                        },
                        768: {
                            slidesPerView: 2
                        },
                        991: {
                            slidesPerView: 3
                        },
                        1200: {
                            slidesPerView: 4
                        }
                    }
                });
            }

            // New Arrivals Swiper
            if (document.querySelector('.new-arrivals-swiper')) {
                new Swiper(".new-arrivals-swiper", {
                    slidesPerView: 4,
                    spaceBetween: 30,
                    autoplay: {
                        delay: 4000,
                        disableOnInteraction: false
                    },
                    pagination: {
                        el: ".swiper-pagination",
                        clickable: true
                    },
                    navigation: {
                        nextEl: '.swiper-button-next',
                        prevEl: '.swiper-button-prev'
                    },
                    breakpoints: {
                        320: {
                            slidesPerView: 1
                        },
                        480: {
                            slidesPerView: 2
                        },
                        768: {
                            slidesPerView: 2
                        },
                        991: {
                            slidesPerView: 3
                        },
                        1200: {
                            slidesPerView: 4
                        }
                    }
                });
            }

            // Discounted Products Swiper
            if (document.querySelector('.discounted-swiper')) {
                new Swiper(".discounted-swiper", {
                    slidesPerView: 4,
                    spaceBetween: 30,
                    pagination: {
                        el: ".swiper-pagination",
                        clickable: true
                    },
                    navigation: {
                        nextEl: '.swiper-button-next',
                        prevEl: '.swiper-button-prev'
                    },
                    breakpoints: {
                        320: {
                            slidesPerView: 1
                        },
                        480: {
                            slidesPerView: 2
                        },
                        768: {
                            slidesPerView: 2
                        },
                        991: {
                            slidesPerView: 3
                        },
                        1200: {
                            slidesPerView: 4
                        }
                    }
                });
            }

            // Same Seller Swiper
            if (document.querySelector('.same-seller-swiper')) {
                new Swiper(".same-seller-swiper", {
                    slidesPerView: 4,
                    spaceBetween: 30,
                    pagination: {
                        el: ".swiper-pagination",
                        clickable: true
                    },
                    navigation: {
                        nextEl: '.swiper-button-next',
                        prevEl: '.swiper-button-prev'
                    },
                    breakpoints: {
                        320: {
                            slidesPerView: 1
                        },
                        480: {
                            slidesPerView: 2
                        },
                        768: {
                            slidesPerView: 2
                        },
                        991: {
                            slidesPerView: 3
                        },
                        1200: {
                            slidesPerView: 4
                        }
                    }
                });
            }

            // Low Stock Swiper
            if (document.querySelector('.low-stock-swiper')) {
                new Swiper(".low-stock-swiper", {
                    slidesPerView: 4,
                    spaceBetween: 30,
                    pagination: {
                        el: ".swiper-pagination",
                        clickable: true
                    },
                    navigation: {
                        nextEl: '.swiper-button-next',
                        prevEl: '.swiper-button-prev'
                    },
                    breakpoints: {
                        320: {
                            slidesPerView: 1
                        },
                        480: {
                            slidesPerView: 2
                        },
                        768: {
                            slidesPerView: 2
                        },
                        991: {
                            slidesPerView: 3
                        },
                        1200: {
                            slidesPerView: 4
                        }
                    }
                });
            }
        });
    </script>
</body>

</html>
