@extends('layouts.customer')

@section('title', 'Booking Status')

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
        color: #fff;
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
    .modern-header .header-right {
        position: relative;
        z-index: 2;
        margin-left: auto;
    }
    @media(max-width: 600px) {
        .modern-header { padding: 24px; }
        .modern-header .header-content { flex-direction: column; text-align: center; gap: 16px; }
        .modern-header .header-title { font-size: 1.75rem; }
        .modern-header .header-right { margin-left: 0; }
    }

    .bookings-table-wrap {
        background: #fff;
        border-radius: 16px;
        border: 1px solid #e5e7eb;
        box-shadow: 0 4px 6px -1px rgba(0,0,0,0.06);
        overflow: hidden;
    }

    .bookings-table {
        width: 100%;
        border-collapse: collapse;
    }
    .bookings-table thead {
        background: #f9fafb;
        border-bottom: 2px solid #e5e7eb;
    }
    .bookings-table th {
        padding: 14px 18px;
        text-align: left;
        font-size: 0.75rem;
        font-weight: 700;
        color: #6b7280;
        text-transform: uppercase;
        letter-spacing: 0.07em;
        white-space: nowrap;
    }
    .bookings-table td {
        padding: 16px 18px;
        font-size: 0.9rem;
        color: #374151;
        border-bottom: 1px solid #f3f4f6;
        vertical-align: middle;
    }
    .bookings-table tbody tr:last-child td {
        border-bottom: none;
    }
    .bookings-table tbody tr:hover {
        background: #fafafa;
    }

    .status-badge {
        display: inline-flex;
        align-items: center;
        gap: 5px;
        padding: 5px 11px;
        border-radius: 9999px;
        font-size: 0.73rem;
        font-weight: 700;
        white-space: nowrap;
    }
    .status-badge i { font-size: 0.8rem; }

    .s-yellow  { background: #fef3c7; color: #92400e; }
    .s-blue    { background: #dbeafe; color: #1d4ed8; }
    .s-orange  { background: #fff7ed; color: #c2410c; }
    .s-purple  { background: #ede9fe; color: #6d28d9; }
    .s-green   { background: #dcfce7; color: #15803d; }
    .s-red     { background: #fee2e2; color: #b91c1c; }
    .s-gray    { background: #f3f4f6; color: #4b5563; }

    .btn-view-detail {
        display: inline-flex;
        align-items: center;
        gap: 6px;
        background: #eff6ff;
        color: #2563eb;
        border: 1px solid #bfdbfe;
        border-radius: 8px;
        padding: 7px 13px;
        font-size: 0.82rem;
        font-weight: 600;
        text-decoration: none;
        transition: background 0.2s, transform 0.1s;
        cursor: pointer;
    }
    .btn-view-detail:hover {
        background: #dbeafe;
        transform: translateY(-1px);
    }

    .btn-pay-now {
        display: inline-flex;
        align-items: center;
        gap: 6px;
        background: #635bff;
        color: #fff;
        border: none;
        border-radius: 8px;
        padding: 7px 13px;
        font-size: 0.82rem;
        font-weight: 700;
        text-decoration: none;
        transition: background 0.2s;
        cursor: pointer;
    }
    .btn-pay-now:hover { background: #4f46e5; }

    .empty-state {
        text-align: center;
        padding: 56px 24px;
        color: #9ca3af;
    }
    .empty-state i {
        font-size: 3rem;
        display: block;
        margin-bottom: 14px;
    }
    .empty-state h3 { color: #374151; margin: 0 0 8px; }
    .empty-state p { margin: 0 0 20px; font-size: 0.9rem; }

    .new-booking-btn {
        display: inline-flex;
        align-items: center;
        gap: 8px;
        background: #2563eb;
        color: #fff;
        border: none;
        border-radius: 10px;
        padding: 11px 22px;
        font-weight: 700;
        font-size: 0.9rem;
        text-decoration: none;
        transition: background 0.2s;
    }
    .new-booking-btn:hover { background: #1d4ed8; }

    @media(max-width: 680px) {
        .bookings-table th:nth-child(3),
        .bookings-table td:nth-child(3),
        .bookings-table th:nth-child(4),
        .bookings-table td:nth-child(4) { display: none; }
    }
</style>

<div class="modern-header">
    <div class="header-content">
        <div class="icon-wrapper">
            <i class="bi bi-clipboard2-pulse-fill"></i>
        </div>
        <div>
            <h1 class="header-title">Booking Status</h1>
            <p class="header-subtitle">Track your active repair requests and their current status.</p>
        </div>
        <div class="header-right">
            <a href="{{ route('customer.booking.create') }}" class="new-booking-btn">
                <i class="bi bi-plus-circle-fill"></i> New Booking
            </a>
        </div>
    </div>
    <div class="header-decoration"></div>
</div>

<div class="bookings-table-wrap">
    @if($bookings->count())
        <table class="bookings-table">
            <thead>
                <tr>
                    <th>#</th>
                    <th>Device</th>
                    <th>Submitted</th>
                    <th>Visit Date</th>
                    <th>Technician</th>
                    <th>Status</th>
                    <th style="text-align:center;">Action</th>
                </tr>
            </thead>
            <tbody>
                @foreach($bookings as $booking)
                    @php
                        switch($booking->status) {
                            case 'Pending':
                                $label = 'Waiting Admin Review'; $icon = 'bi-hourglass-split'; $cls = 's-yellow'; break;
                            case 'Technician Assigned':
                                $label = 'Waiting Technician'; $icon = 'bi-person-gear'; $cls = 's-blue'; break;
                            case 'Inspection Completed':
                                $label = 'Waiting Admin Review'; $icon = 'bi-clipboard-check'; $cls = 's-purple'; break;
                            case 'Quotation Sent':
                                $label = 'Review Quotation'; $icon = 'bi-file-earmark-text'; $cls = 's-orange'; break;
                            case 'Quotation Accepted':
                                $label = 'In Repair'; $icon = 'bi-tools'; $cls = 's-blue'; break;
                            case 'Repair In Progress':
                                $label = 'Repair In Progress'; $icon = 'bi-gear-wide-connected'; $cls = 's-blue'; break;
                            case 'Repair Finished':
                                $label = 'Need Payment'; $icon = 'bi-credit-card-fill'; $cls = 's-orange'; break;
                            case 'Repair Completed':
                                $label = 'Completed'; $icon = 'bi-patch-check-fill'; $cls = 's-green'; break;
                            case 'Quotation Rejected':
                                $label = 'Quotation Rejected'; $icon = 'bi-x-circle-fill'; $cls = 's-red'; break;
                            default:
                                $label = $booking->status; $icon = 'bi-circle'; $cls = 's-gray';
                        }
                    @endphp
                    <tr>
                        <td style="font-weight:700; color:#111827;">#{{ $booking->id }}</td>
                        <td>
                            <div style="font-weight:600; color:#111827;">{{ $booking->device->name ?? '-' }}</div>
                            <div style="font-size:0.8rem; color:#9ca3af;">{{ $booking->device->brand ?? '' }}</div>
                        </td>
                        <td>{{ $booking->created_at->format('d M Y') }}</td>
                        <td>{{ $booking->visit_date ? \Carbon\Carbon::parse($booking->visit_date)->format('d M Y') : '-' }}</td>
                        <td>{{ $booking->technician->name ?? 'Not assigned yet' }}</td>
                        <td>
                            <span class="status-badge {{ $cls }}">
                                <i class="bi {{ $icon }}"></i> {{ $label }}
                            </span>
                        </td>
                        <td style="text-align:center;">
                            @if($booking->status === 'Repair Finished')
                                <a href="{{ route('customer.payment.show', $booking->id) }}" class="btn-pay-now">
                                    <i class="bi bi-lock-fill"></i> Pay Now
                                </a>
                            @else
                                <a href="{{ route('customer.booking.show', $booking->id) }}" class="btn-view-detail">
                                    <i class="bi bi-eye-fill"></i> View
                                </a>
                            @endif
                        </td>
                    </tr>
                @endforeach
            </tbody>
        </table>
    @else
        <div class="empty-state">
            <i class="bi bi-clipboard-x"></i>
            <h3>No active bookings</h3>
            <p>You haven't submitted any repair requests yet.</p>
            <a href="{{ route('customer.booking.create') }}" class="new-booking-btn">
                <i class="bi bi-plus-circle-fill"></i> Create a Booking
            </a>
        </div>
    @endif
</div>

@endsection