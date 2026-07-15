@extends('layouts.customer')

@section('title', 'Customer Dashboard')

@section('content')

<style>
    .modern-header {
        position: relative;
        background: #0f172a;
        color: #ffffff;
        padding: 40px;
        border-radius: 24px;
        margin-bottom: 32px;
        overflow: hidden;
        box-shadow: 0 20px 25px -5px rgba(0, 0, 0, 0.1), 0 10px 10px -5px rgba(0, 0, 0, 0.04);
    }
    .modern-header .header-content {
        position: relative;
        z-index: 2;
        display: flex;
        align-items: center;
        gap: 24px;
    }
    .modern-header .icon-wrapper {
        background: linear-gradient(135deg, #3b82f6, #8b5cf6);
        width: 72px;
        height: 72px;
        border-radius: 20px;
        display: flex;
        align-items: center;
        justify-content: center;
        font-size: 2rem;
        color: white;
        box-shadow: 0 10px 15px -3px rgba(59, 130, 246, 0.5);
        flex-shrink: 0;
    }
    .modern-header .header-title {
        font-size: 2.2rem;
        font-weight: 800;
        margin: 0 0 8px 0;
        letter-spacing: -0.025em;
    }
    .modern-header .header-subtitle {
        font-size: 1.05rem;
        color: #94a3b8;
        margin: 0;
        max-width: 500px;
        line-height: 1.5;
    }
    .modern-header .header-decoration {
        position: absolute;
        top: -50%;
        right: -10%;
        width: 400px;
        height: 400px;
        background: radial-gradient(circle, rgba(139,92,246,0.25) 0%, rgba(15,23,42,0) 70%);
        border-radius: 50%;
        z-index: 1;
        pointer-events: none;
    }
    @media(max-width: 600px) {
        .modern-header { padding: 24px; }
        .modern-header .header-content { flex-direction: column; text-align: center; gap: 16px; }
        .modern-header .header-title { font-size: 1.75rem; }
    }
    
    /* Stats Grid Custom Style */
    .dashboard-stats {
        display: grid;
        grid-template-columns: repeat(auto-fit, minmax(220px, 1fr));
        gap: 24px;
        margin-bottom: 32px;
    }
    .dashboard-stat-card {
        background: white;
        border-radius: 20px;
        padding: 24px;
        display: flex;
        align-items: center;
        justify-content: space-between;
        box-shadow: 0 4px 6px -1px rgba(0, 0, 0, 0.1), 0 2px 4px -1px rgba(0, 0, 0, 0.06);
        border: 1px solid #f3f4f6;
        transition: transform 0.2s ease;
    }
    .dashboard-stat-card:hover {
        transform: translateY(-2px);
    }
    .stat-info p {
        color: #6b7280;
        font-size: 0.85rem;
        font-weight: 700;
        margin: 0 0 8px 0;
        text-transform: uppercase;
        letter-spacing: 0.05em;
    }
    .stat-info h2 {
        font-size: 1.75rem;
        font-weight: 800;
        color: #111827;
        margin: 0;
    }
    .icon-box {
        width: 56px;
        height: 56px;
        border-radius: 16px;
        display: flex;
        align-items: center;
        justify-content: center;
        font-size: 1.5rem;
    }
    .icon-box.green { background: #dcfce7; color: #16a34a; }
    .icon-box.blue { background: #dbeafe; color: #2563eb; }
    .icon-box.orange { background: #ffedd5; color: #ea580c; }
    .icon-box.purple { background: #f3e8ff; color: #9333ea; }

    /* Layout Grid */
    .dashboard-layout {
        display: grid;
        grid-template-columns: 2fr 1fr;
        gap: 24px;
    }
    @media(max-width: 1024px) {
        .dashboard-layout {
            grid-template-columns: 1fr;
        }
    }

    .modern-panel {
        background: white;
        border-radius: 20px;
        padding: 28px;
        box-shadow: 0 4px 6px -1px rgba(0, 0, 0, 0.1), 0 2px 4px -1px rgba(0, 0, 0, 0.06);
        border: 1px solid #f3f4f6;
    }
    .modern-panel h2 {
        margin-top: 0;
        font-size: 1.25rem;
        font-weight: 700;
        color: #111827;
        margin-bottom: 20px;
        display: flex;
        align-items: center;
        gap: 8px;
        border-bottom: 1px solid #f3f4f6;
        padding-bottom: 16px;
    }

    .booking-list-item {
        display: flex;
        align-items: center;
        justify-content: space-between;
        padding: 16px 0;
        border-bottom: 1px solid #f3f4f6;
    }
    .booking-list-item:last-child {
        border-bottom: none;
        padding-bottom: 0;
    }
    .booking-detail h4 {
        margin: 0 0 4px 0;
        font-size: 1rem;
        color: #1f2937;
    }
    .booking-detail p {
        margin: 0;
        color: #6b7280;
        font-size: 0.875rem;
    }
    .status-badge {
        padding: 6px 12px;
        border-radius: 9999px;
        font-size: 0.75rem;
        font-weight: 700;
        text-transform: uppercase;
        letter-spacing: 0.05em;
    }
    
    .action-item {
        background: #f8fafc;
        border: 1px solid #e2e8f0;
        border-radius: 12px;
        padding: 16px;
        margin-bottom: 16px;
    }
    .action-item:last-child { margin-bottom: 0; }
    .action-item p { margin: 0 0 12px 0; font-size: 0.95rem; color: #334155; }
    .action-item strong { color: #0f172a; }
    .action-btn {
        display: inline-flex;
        align-items: center;
        gap: 6px;
        color: white;
        padding: 7px 13px;
        border-radius: 8px;
        text-decoration: none;
        font-size: 0.85rem;
        font-weight: 600;
    }
    .action-btn.quote { background: #3b82f6; }
    .action-btn.payment { background: #ea580c; }
</style>

<div class="modern-header">
    <div class="header-content">
        <div class="icon-wrapper">
            <i class="bi bi-person-circle"></i>
        </div>
        <div>
            <h1 class="header-title">Welcome back, {{ Auth::user()->name }}</h1>
            <p class="header-subtitle">Track your bookings, quotation status, repair progress, and total repair spending.</p>
        </div>
    </div>
    <div class="header-decoration"></div>
</div>

<div class="dashboard-stats">
    <div class="dashboard-stat-card">
        <div class="stat-info">
            <p>Total Spent</p>
            <h2>RM {{ number_format($totalSpent, 2) }}</h2>
        </div>
        <div class="icon-box green">
            <i class="bi bi-wallet2"></i>
        </div>
    </div>

    <div class="dashboard-stat-card">
        <div class="stat-info">
            <p>Total Bookings</p>
            <h2>{{ $totalBookings }}</h2>
        </div>
        <div class="icon-box blue">
            <i class="bi bi-calendar-check"></i>
        </div>
    </div>

    <div class="dashboard-stat-card">
        <div class="stat-info">
            <p>Pending Quotes</p>
            <h2>{{ $pendingQuotations }}</h2>
        </div>
        <div class="icon-box orange">
            <i class="bi bi-receipt"></i>
        </div>
    </div>

    <div class="dashboard-stat-card">
        <div class="stat-info">
            <p>Completed</p>
            <h2>{{ $completedRepairs }}</h2>
        </div>
        <div class="icon-box purple">
            <i class="bi bi-check2-circle"></i>
        </div>
    </div>
</div>

<div class="dashboard-layout">
    <!-- Left Column: Recent Bookings -->
    <div class="modern-panel">
        <h2><i class="bi bi-clock-history"></i> Recent Bookings</h2>

        @forelse($bookings->take(5) as $booking)
            <div class="booking-list-item">
                <div class="booking-detail">
                    <h4>Booking #{{ $booking->id }}</h4>
                    <p>{{ $booking->device->name ?? '-' }} ({{ $booking->device->brand ?? '-' }})</p>
                </div>
                
                @php
                    $statusClass = 'background: #f3f4f6; color: #4b5563;';
                    $statusLower = strtolower($booking->status);
                    if(str_contains($statusLower, 'pending') || str_contains($statusLower, 'waiting')) $statusClass = 'background: #fef3c7; color: #b45309;';
                    elseif(str_contains($statusLower, 'accept') || str_contains($statusLower, 'approved')) $statusClass = 'background: #dcfce7; color: #15803d;';
                    elseif(str_contains($statusLower, 'reject') || str_contains($statusLower, 'cancel')) $statusClass = 'background: #fee2e2; color: #b91c1c;';
                    elseif(str_contains($statusLower, 'complet') || str_contains($statusLower, 'done')) $statusClass = 'background: #e0e7ff; color: #4338ca;';
                @endphp

                <div style="text-align: right;">
                    <div class="status-badge" style="{{ $statusClass }} margin-bottom: 4px; display: inline-block;">
                        {{ $booking->status }}
                    </div>
                    @if($booking->quotation_price)
                        <div style="font-size: 0.85rem; font-weight: 600; color: #10b981;">
                            RM {{ number_format($booking->quotation_price, 2) }}
                        </div>
                    @endif
                </div>
            </div>
        @empty
            <div style="text-align: center; padding: 32px 0; color: #6b7280;">
                <i class="bi bi-inbox" style="font-size: 2rem; margin-bottom: 12px; display: block; color: #9ca3af;"></i>
                <p>No recent bookings found.</p>
            </div>
        @endforelse
        
        @if($bookings->count() > 5)
            <div style="text-align: center; margin-top: 20px;">
                <a href="{{ route('customer.booking.status') }}" style="color: #3b82f6; text-decoration: none; font-weight: 600; font-size: 0.9rem;">
                    View All Bookings <i class="bi bi-arrow-right"></i>
                </a>
            </div>
        @endif
    </div>

    <!-- Right Column: Action Required -->
    <div class="modern-panel">
        <h2><i class="bi bi-exclamation-circle"></i> Action Required</h2>
        
        @forelse($actionableBookings as $booking)
            <div class="action-item">
                @if($booking->status === 'Quotation Sent')
                    <p>Quotation is ready for <strong>Booking #{{ $booking->id }}</strong> (RM {{ number_format($booking->quotation_price, 2) }}). Please approve or reject it so the repair can proceed.</p>
                    <a href="{{ route('customer.booking.show', $booking->id) }}" class="action-btn quote">
                        <i class="bi bi-file-earmark-check"></i> Review Quotation
                    </a>
                @else
                    <p>Payment is required for <strong>Booking #{{ $booking->id }}</strong> (RM {{ number_format($booking->quotation_price, 2) }}). The repair is finished and ready for payment.</p>
                    <a href="{{ route('customer.payment.show', $booking->id) }}" class="action-btn payment">
                        <i class="bi bi-credit-card"></i> Make Payment
                    </a>
                @endif
            </div>
        @empty
            <div style="text-align: center; padding: 24px 0; color: #6b7280;">
                <i class="bi bi-check-circle" style="font-size: 2rem; margin-bottom: 12px; display: block; color: #10b981;"></i>
                <p style="margin: 0;">You're all caught up!<br>No pending actions needed.</p>
            </div>
        @endforelse

        <div style="margin-top: 32px;">
            <h2 style="font-size: 1rem;"><i class="bi bi-info-circle"></i> Need Help?</h2>
            <div style="background: #eff6ff; padding: 16px; border-radius: 12px; color: #1e3a8a; font-size: 0.9rem; line-height: 1.5;">
                Have questions about your repair? Contact our support team for immediate assistance.
                <br><br>
                <strong><i class="bi bi-telephone"></i> +60 12-345 6789</strong>
            </div>
        </div>
    </div>
</div>

@endsection
