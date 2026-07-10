<!DOCTYPE html>
<html>
<head>
    <title>Repair Payment | AkieRepair</title>
    <meta name="viewport" content="width=device-width, initial-scale=1.0">

    <link href="https://fonts.googleapis.com/css2?family=Playfair+Display:wght@500;700&family=Mukta+Mahee:wght@300;400;600;700&display=swap" rel="stylesheet">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.11.3/font/bootstrap-icons.min.css">
    <meta name="csrf-token" content="{{ csrf_token() }}">

    <style>
        /* Base Styles from Layout */
        body{
            margin:0;
            font-family:'Mukta Mahee', sans-serif;
            background:#f5f7fb;
            color:#111827;
        }

        .customer-wrapper{
            display:block;
            min-height:100vh;
        }

        /* Sidebar Styles (Kept for structural consistency but not duplicated) */
        .sidebar{
            width:270px;
            background:white;
            height:100vh;
            position:fixed;
            left:0;
            top:0;
            border-right:1px solid #e5e7eb;
            display:flex;
            flex-direction:column;
            padding:25px 20px;
            box-sizing:border-box;
            z-index:100;
            font-family:'Mukta Mahee', sans-serif;
        }

        .brand-box{
            display:flex;
            align-items:center;
            gap:12px;
            padding-bottom:22px;
            border-bottom:1px solid #e5e7eb;
            margin-bottom:18px;
        }

        .brand-icon{
            width:42px;
            height:42px;
            border-radius:12px;
            background:#111;
            color:white;
            display:grid;
            place-items:center;
            font-weight:700;
            font-family:'Mukta Mahee', sans-serif;
        }

        .brand-box h3{
            font-family:'Playfair Display', serif;
            font-size:20px;
            font-weight:700;
            margin-bottom:0;
            color:#000;
        }

        .brand-box p{
            font-family:'Mukta Mahee', sans-serif;
            font-size:13px;
            color:#6b7280;
            margin:0;
        }

        .menu-section{
            margin:12px 0;
        }

        .menu-link,
        .dropdown-btn{
            width:100%;
            display:flex;
            align-items:center;
            justify-content:space-between;
            padding:12px 14px;
            border-radius:8px;
            color:#374151;
            font-family:'Mukta Mahee', sans-serif;
            font-weight:700;
            font-size:15px;
            background:transparent;
            border:none;
            cursor:pointer;
            text-align:left;
            text-decoration:none;
        }

        .menu-link:hover,
        .dropdown-btn:hover,
        .menu-link.active{
            background:#f3f4f6;
            color:#000;
        }

        .menu-left{
            display:flex;
            align-items:center;
            gap:12px;
        }

        .icon{
            width:22px;
            text-align:center;
        }

        .logout-box{
            margin-top:auto;
            padding-top:20px;
            border-top:1px solid #eee;
        }

        .user-row{
            display:flex;
            align-items:center;
            gap:14px;
        }

        .avatar{
            width:50px;
            height:50px;
            border-radius:50%;
            background:#111827;
            color:white;
            display:flex;
            align-items:center;
            justify-content:center;
            font-size:18px;
            font-weight:700;
            flex-shrink:0;
        }

        .user-text{
            flex:1;
        }

        .user-text strong{
            display:block;
            font-family:'Mukta Mahee', sans-serif;
            font-size:16px;
            font-weight:700;
            color:#111827;
            margin-bottom:3px;
        }

        .user-text span{
            font-family:'Mukta Mahee', sans-serif;
            color:#6b7280;
            font-size:14px;
        }

        .logout-icon{
            border:none;
            background:transparent;
            color:#dc2626;
            font-size:26px;
            font-weight:bold;
            cursor:pointer;
            transition:0.2s;
            padding:5px;
            display:flex;
            align-items:center;
        }

        .logout-icon:hover{
            color:#991b1b;
            transform:scale(1.15);
        }

        .customer-main{
            margin-left:0;
            width:100%;
            padding:35px;
            box-sizing:border-box;
        }

        /* Payment specific styles (converted from Tailwind) */
        .payment-container {
            max-width: 672px;
            margin: 0 auto;
        }
        .payment-card {
            background: white;
            border-radius: 1rem;
            box-shadow: 0 10px 25px rgba(0,0,0,0.05);
            overflow: hidden;
            border: 1px solid #e5e7eb;
        }
        .card-header {
            background: linear-gradient(135deg, #2563eb, #1d4ed8);
            padding: 1.25rem 1.5rem;
        }
        .card-header h1 {
            font-size: 1.5rem;
            font-weight: 700;
            color: white;
            margin: 0;
            font-family: 'Playfair Display', serif;
        }
        .card-body {
            padding: 2rem 1.5rem;
        }
        .section-title {
            font-size: 1.125rem;
            font-weight: 600;
            margin-bottom: 1rem;
            color: #111827;
        }
        .divider {
            border-bottom: 1px solid #e5e7eb;
            margin-bottom: 2rem;
        }
        .details-grid {
            display: grid;
            grid-template-columns: repeat(2, 1fr);
            gap: 1rem;
            margin-bottom: 1.5rem;
        }
        .detail-label {
            font-size: 0.875rem;
            color: #6b7280;
            margin-bottom: 0.25rem;
        }
        .detail-value {
            font-weight: 600;
            color: #111827;
        }
        .summary-row {
            display: flex;
            justify-content: space-between;
            align-items: center;
            margin-bottom: 0.75rem;
        }
        .total-row {
            border-top: 1px solid #e5e7eb;
            padding-top: 0.75rem;
            margin-top: 0.5rem;
        }
        .total-label {
            font-size: 1.125rem;
            font-weight: 700;
        }
        .total-amount {
            font-size: 1.5rem;
            font-weight: 700;
            color: #2563eb;
        }
        .info-banner {
            background-color: #eff6ff;
            border: 1px solid #bfdbfe;
            border-radius: 0.5rem;
            padding: 1rem;
            margin: 1.5rem 0;
            display: flex;
            align-items: flex-start;
            gap: 0.75rem;
        }
        .info-banner svg {
            width: 1.25rem;
            height: 1.25rem;
            color: #2563eb;
            flex-shrink: 0;
            margin-top: 0.125rem;
        }
        .info-banner strong {
            font-weight: 700;
            color: #1e3a8a;
            display: block;
        }
        .info-banner p {
            font-size: 0.875rem;
            color: #1e40af;
            margin: 0;
        }
        .action-buttons {
            display: flex;
            gap: 1rem;
            margin-top: 1rem;
        }
        .btn-cancel {
            flex: 1;
            background: white;
            border: 1px solid #d1d5db;
            color: #374151;
            padding: 0.75rem 1rem;
            border-radius: 0.5rem;
            font-weight: 600;
            text-align: center;
            text-decoration: none;
            transition: all 0.2s;
        }
        .btn-cancel:hover {
            background: #f9fafb;
        }
        .btn-pay {
            flex: 1;
            background: #2563eb;
            border: none;
            color: white;
            padding: 0.75rem 1rem;
            border-radius: 0.5rem;
            font-weight: 600;
            cursor: pointer;
            transition: background 0.2s;
        }
        .btn-pay:hover {
            background: #1d4ed8;
        }
        .btn-pay:disabled {
            background: #93c5fd;
            cursor: not-allowed;
        }
        @media (max-width: 900px) {
            .sidebar {
                position: relative;
                width: 100%;
                height: auto;
            }
            .customer-wrapper {
                flex-direction: column;
            }
            .customer-main {
                margin-left: 0;
                width: 100%;
                padding: 20px;
            }
            .details-grid {
                grid-template-columns: 1fr;
            }
            .action-buttons {
                flex-direction: column;
            }
        }

        @media (max-width: 560px) {
            .customer-main {
                padding: 16px;
            }

            .payment-card {
                border-radius: 0.85rem;
            }

            .card-header {
                padding: 1rem;
            }

            .card-header h1 {
                font-size: 1.25rem;
            }

            .card-body {
                padding: 1.25rem 1rem;
            }

            .summary-row {
                align-items: flex-start;
                flex-direction: column;
                gap: 0.25rem;
            }

            .total-amount {
                font-size: 1.3rem;
            }

            .info-banner {
                flex-direction: column;
            }
        }

        :root {
            --ui-bg: #f4f6f9;
            --ui-text: #0f172a;
            --ui-muted: #64748b;
            --ui-line: #e2e8f0;
            --ui-soft: #f8fafc;
            --ui-accent: #16a34a;
            --ui-blue: #2563eb;
        }

        body {
            background: var(--ui-bg);
            color: var(--ui-text);
            text-rendering: optimizeLegibility;
        }

        .customer-main {
            padding: clamp(18px, 4vw, 42px);
        }

        .payment-container {
            max-width: min(760px, 100%);
        }

        .payment-card {
            border: 1px solid var(--ui-line);
            border-radius: 18px;
            box-shadow: 0 18px 48px rgba(15, 23, 42, .08);
        }

        .card-header {
            background: linear-gradient(135deg, #0f172a, #2563eb);
            padding: clamp(1.15rem, 3vw, 1.65rem);
        }

        .card-header h1 {
            font-family: 'Mukta Mahee', system-ui, sans-serif;
            font-size: clamp(1.35rem, 3vw, 1.7rem);
            letter-spacing: 0;
            line-height: 1.15;
        }

        .card-body {
            padding: clamp(1.25rem, 4vw, 2.25rem);
        }

        .section-title {
            color: var(--ui-text);
            font-size: 1.05rem;
            letter-spacing: 0;
        }

        .detail-label {
            color: var(--ui-muted);
        }

        .detail-value,
        .total-label {
            color: var(--ui-text);
        }

        .total-amount {
            color: var(--ui-blue);
            font-size: clamp(1.35rem, 4vw, 1.75rem);
        }

        .info-banner {
            background: #eff6ff;
            border-color: #bfdbfe;
            border-radius: 12px;
        }

        .btn-cancel,
        .btn-pay {
            border-radius: 10px;
            font-family: 'Mukta Mahee', system-ui, sans-serif;
            font-weight: 700;
            min-height: 46px;
            transition: transform .16s ease, box-shadow .16s ease, background-color .16s ease, border-color .16s ease;
        }

        .btn-cancel:hover,
        .btn-pay:hover {
            transform: translateY(-1px);
        }

        .btn-pay {
            background: var(--ui-blue);
            box-shadow: 0 12px 24px rgba(37, 99, 235, .18);
        }

        .btn-pay:hover {
            background: #1d4ed8;
        }

        @media (max-width: 560px) {
            .customer-main {
                padding: 14px;
            }

            .payment-card {
                border-radius: 16px;
            }

            .details-grid {
                gap: .85rem;
            }

            .summary-row {
                align-items: stretch;
            }
        }
    </style>
</head>
<body>

<div class="customer-wrapper">
    <!-- Sidebar (identical to original layout, ensures full customer panel experience) -->


    <!-- Main Content: Payment Page Integrated (removed any redundant sidebar or duplicate layouts) -->
    <main class="customer-main">
        <div class="payment-container">
            <div class="payment-card">
                <!-- Header -->
                <div class="card-header">
                    <h1><i class="bi bi-credit-card me-2"></i> Repair Payment</h1>
                </div>

                <!-- Content -->
                <div class="card-body">
                    <!-- Booking Details Section -->
                    <div class="divider">
                        <div class="section-title">Booking Details</div>
                        <div class="details-grid">
                            <div>
                                <div class="detail-label">Device</div>
                                <div class="detail-value">{{ $booking->device->name ?? '-' }} ({{ $booking->device->brand ?? '-' }}) </div>
                            </div>
                            <div>
                                <div class="detail-label">Booking ID</div>
                                <div class="detail-value">#{{ $booking->id ?? 'N/A' }}</div>
                            </div>
                            <div>
                                <div class="detail-label">Problem</div>
                                <div class="detail-value">{{ $booking->problem_description ?? 'Not specified' }}</div>
                            </div>
                            <div>
                                <div class="detail-label">Inspection Report</div>
                                <div class="detail-value">{{ $booking->inspection_report ?? 'Awaiting inspection' }}</div>
                            </div>
                            <div>
                                <div class="detail-label">Repair Finished Date</div>
                                <div class="detail-value">{{ $booking->repair_finished_date ? \Carbon\Carbon::parse($booking->repair_finished_date)->format('d M Y') : '-' }}</div>
                            </div>
                        </div>
                    </div>

                    <!-- Payment Summary -->
                    <div class="divider">
                        <div class="section-title">Payment Summary</div>
                        <div class="summary-row">
                            <span class="text-gray-700">Repair Service</span>
                            <span class="font-semibold">RM {{ number_format($booking->quotation_price ?? 0, 2) }}</span>
                        </div>
                        <div class="summary-row total-row">
                            <span class="total-label">Total Amount Due</span>
                            <span class="total-amount">RM {{ number_format($booking->quotation_price ?? 0, 2) }}</span>
                        </div>
                    </div>

                    <!-- Status Info Banner -->
                    <div class="info-banner">
                        <svg fill="currentColor" viewBox="0 0 20 20">
                            <path fill-rule="evenodd" d="M18 5v8a2 2 0 01-2 2h-5l-5 4v-4H4a2 2 0 01-2-2V5a2 2 0 012-2h12a2 2 0 012 2zm-11-1a1 1 0 11-2 0 1 1 0 012 0z" clip-rule="evenodd" />
                        </svg>
                        <div>
                            <strong>Repair Work Completed</strong>
                            <p>The technician has completed the repair work. Please proceed with payment to finalize the service.</p>
                        </div>
                    </div>

                    <!-- Stripe Info Banner -->
                    <div class="info-banner" style="background:#f0fdf4; border-color:#bbf7d0;">
                        <svg fill="none" viewBox="0 0 24 24" stroke="#16a34a" style="width:22px;height:22px;flex-shrink:0;margin-top:2px;">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 12l2 2 4-4m6 2a9 9 0 11-18 0 9 9 0 0118 0z"/>
                        </svg>
                        <div>
                            <strong style="color:#15803d;">Secure Payment via Stripe</strong>
                            <p style="color:#166534;">You will be redirected to Stripe's secure checkout to complete your payment safely.</p>
                        </div>
                    </div>

                    <!-- Action Buttons -->
                    <div class="action-buttons">
                        <a href="{{ route('customer.booking.status') }}" class="btn-cancel">
                            Cancel
                        </a>
                        <button id="paymentBtn" class="btn-pay" style="background:#635bff;">
                            <i class="bi bi-lock-fill"></i> Pay with Stripe
                        </button>
                    </div>
                </div>
            </div>
        </div>
    </main>
</div>

<script>
    const paymentInitiateUrl = @json(route('customer.payment.initiate', ['booking' => $booking->id], false));

    document.getElementById('paymentBtn').addEventListener('click', async function() {
        const btn = this;
        btn.disabled = true;
        btn.innerHTML = '<i class="bi bi-arrow-repeat"></i> Redirecting to Stripe...';

        try {
            const response = await fetch(paymentInitiateUrl, {
                method: 'POST',
                headers: {
                    'Accept': 'application/json',
                    'Content-Type': 'application/json',
                    'X-CSRF-TOKEN': document.querySelector('meta[name="csrf-token"]').content,
                    'X-Requested-With': 'XMLHttpRequest',
                },
            });

            const contentType = response.headers.get('content-type') || '';
            const data = contentType.includes('application/json') ? await response.json() : {};

            if (!response.ok) {
                throw new Error(data.error || `Payment request failed (${response.status}). Please refresh and try again.`);
            }

            if (data.success && data.paymentUrl) {
                window.location.href = data.paymentUrl;
            } else {
                throw new Error(data.error || 'Failed to initiate payment');
            }
        } catch (error) {
            console.error('Error:', error);
            alert(error.message || 'An error occurred while processing payment');
            btn.disabled = false;
            btn.innerHTML = '<i class="bi bi-lock-fill"></i> Pay with Stripe';
        }
    });
</script>
</body>
</html>
