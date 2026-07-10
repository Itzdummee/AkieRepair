@extends('layouts.admin')

@section('title', 'Booking History')

@section('content')

<style>
    .history-container {
        display: flex;
        flex-direction: column;
        gap: 30px;
    }
    
    /* Header & Panel styling */
    .history-header-panel {
        background: #ffffff;
        border: 1px solid rgba(229, 231, 235, 0.8);
        border-radius: 16px;
        padding: 24px;
        display: flex;
        justify-content: space-between;
        align-items: center;
        box-shadow: 0 4px 6px -1px rgba(0, 0, 0, 0.05);
    }
    
    .history-title-area h1 {
        font-family: 'Playfair Display', serif;
        font-size: 28px;
        font-weight: 700;
        color: #111827;
        margin-bottom: 6px;
    }
    
    .history-title-area p {
        font-size: 14px;
        color: #6b7280;
    }
    
    .history-count-badge {
        background: #111827;
        color: #ffffff;
        padding: 10px 20px;
        border-radius: 99px;
        font-weight: 700;
        font-size: 14px;
        box-shadow: 0 4px 10px rgba(17, 24, 39, 0.15);
        display: flex;
        align-items: center;
        gap: 8px;
    }

    /* SaaS style table panel */
    .history-table-panel {
        background: #ffffff;
        border: 1px solid rgba(229, 231, 235, 0.8);
        border-radius: 18px;
        padding: 30px;
        box-shadow: 0 4px 6px -1px rgba(0, 0, 0, 0.04);
    }

    /* High-Fidelity Table custom styling */
    .history-table {
        width: 100% !important;
        border-collapse: separate !important;
        border-spacing: 0 !important;
        margin-top: 15px;
    }
    
    .history-table th {
        background: #f9fafb !important;
        padding: 16px 20px !important;
        font-size: 12px !important;
        font-weight: 700 !important;
        color: #4b5563 !important;
        text-transform: uppercase !important;
        letter-spacing: 0.05em !important;
        border-bottom: 1px solid #e5e7eb !important;
        border-top: none !important;
    }
    
    .history-table th:first-child { border-top-left-radius: 10px; }
    .history-table th:last-child { border-top-right-radius: 10px; }
    
    .history-table td {
        padding: 16px 20px !important;
        border-bottom: 1px solid #f3f4f6 !important;
        color: #374151 !important;
        font-size: 14px !important;
        vertical-align: middle !important;
        background: transparent !important;
    }
    
    .history-table tr:hover td {
        background: #f9fafb !important;
    }
    
    .history-table tr:last-child td {
        border-bottom: none !important;
    }

    /* Customer details avatar styling */
    .customer-flex {
        display: flex;
        align-items: center;
        gap: 12px;
    }
    
    .customer-avatar {
        width: 34px;
        height: 34px;
        border-radius: 50%;
        background: linear-gradient(135deg, #4f46e5, #06b6d4);
        color: #ffffff;
        font-weight: 700;
        display: grid;
        place-items: center;
        font-size: 13px;
        box-shadow: 0 2px 5px rgba(79, 70, 229, 0.15);
    }
    
    .customer-name-sub {
        display: flex;
        flex-direction: column;
    }
    
    .customer-main-name {
        font-weight: 700;
        color: #111827;
    }
    
    .customer-phone-sub {
        font-size: 12px;
        color: #6b7280;
    }

    /* Device detail column styling */
    .device-info-col {
        display: flex;
        flex-direction: column;
    }
    
    .device-main-name {
        font-weight: 600;
        color: #374151;
    }
    
    .device-brand-sub {
        font-size: 12px;
        color: #9ca3af;
    }

    /* Status badges styling */
    .status-badge-pill {
        display: inline-flex;
        align-items: center;
        gap: 5px;
        padding: 5px 12px;
        border-radius: 50px;
        font-size: 11px;
        font-weight: 700;
        text-transform: uppercase;
        letter-spacing: 0.03em;
        border: 1px solid transparent;
    }
    
    .status-badge-pill i {
        font-size: 8px;
    }
    
    /* Unique colors for all booking states */
    .badge-assigned {
        background-color: #eff6ff;
        color: #2563eb;
        border-color: #dbeafe;
    }
    
    .badge-inspected {
        background-color: #faf5ff;
        color: #7c3aed;
        border-color: #f3e8ff;
    }
    
    .badge-sent {
        background-color: #ecfeff;
        color: #0891b2;
        border-color: #cffafe;
    }
    
    .badge-accepted {
        background-color: #f0fdf4;
        color: #16a34a;
        border-color: #dcfce7;
    }
    
    .badge-inprogress {
        background-color: #eef2ff;
        color: #4f46e5;
        border-color: #e0e7ff;
    }
    
    .badge-completed {
        background-color: #ecfdf5;
        color: #059669;
        border-color: #a7f3d0;
        box-shadow: 0 2px 6px rgba(5, 150, 105, 0.08);
    }
    
    .badge-scheduled {
        background-color: #fffbeb;
        color: #d97706;
        border-color: #fef3c7;
    }
    
    .badge-rejected {
        background-color: #fdf2f8;
        color: #db2777;
        border-color: #fce7f3;
    }
    
    .badge-cancelled {
        background-color: #fef2f2;
        color: #dc2626;
        border-color: #fee2e2;
    }
    
    .badge-default {
        background-color: #f9fafb;
        color: #4b5563;
        border-color: #e5e7eb;
    }

    /* Action icon buttons */
    .btn-pdf-link {
        display: inline-flex;
        align-items: center;
        gap: 6px;
        background: #f0fdf4;
        color: #16a34a;
        border: 1px solid #bbf7d0;
        padding: 6px 12px;
        border-radius: 8px;
        font-size: 12px;
        font-weight: 700;
        text-transform: uppercase;
        letter-spacing: 0.03em;
        transition: all 0.2s ease;
    }
    
    .btn-pdf-link:hover {
        background: #16a34a;
        color: #ffffff;
        border-color: #16a34a;
        box-shadow: 0 2px 6px rgba(22, 163, 74, 0.15);
    }
</style>

<div class="history-container">
    
    <!-- Header Panel -->
    <div class="history-header-panel">
        <div class="history-title-area">
            <h1>Booking History Archive</h1>
            <p>Comprehensive historical registry of completed site visits, diagnosed inspections, active repairs, and closed cases.</p>
        </div>
        <div class="history-count-badge">
            <i class="bi bi-archive"></i>
            <span>{{ $bookings->count() }} Records Total</span>
        </div>
    </div>

    <!-- DataTables Table Card -->
    <div class="history-table-panel">
        <div class="table-wrap">
            <table id="bookingHistoryTable" class="history-table display">
                <thead>
                    <tr>
                        <th style="width: 80px;">ID</th>
                        <th>Customer</th>
                        <th>Device Details</th>
                        <th>Assigned Inspector</th>
                        <th>Visit Date</th>
                        <th>Finished Date</th>
                        <th>Workflow Status</th>
                        <th>Quote Price</th>
                        <th style="width: 120px; text-align: center;">Actions</th>
                    </tr>
                </thead>

                <tbody>
                    @foreach($bookings as $booking)
                        <tr>
                            <!-- Booking ID -->
                            <td style="font-weight: 700; color: #111827;">#{{ $booking->id }}</td>
                            
                            <!-- Customer Contact info -->
                            <td>
                                <div class="customer-flex">
                                    <div class="customer-avatar">
                                        {{ strtoupper(substr($booking->customer->name ?? 'G', 0, 1)) }}
                                    </div>
                                    <div class="customer-name-sub">
                                        <span class="customer-main-name">{{ $booking->customer->name ?? 'Guest Customer' }}</span>
                                        <span class="customer-phone-sub">{{ $booking->customer->phone_number ?? 'No Phone' }}</span>
                                    </div>
                                </div>
                            </td>
                            
                            <!-- Device Brand and Name -->
                            <td>
                                <div class="device-info-col">
                                    <span class="device-main-name">{{ $booking->device->name ?? '-' }}</span>
                                    <span class="device-brand-sub">{{ $booking->device->brand ?? '' }} &bull; {{ $booking->device->type ?? '' }}</span>
                                </div>
                            </td>
                            
                            <!-- Assigned Inspector -->
                            <td style="font-weight: 600; color: #4b5563;">
                                {{ $booking->technician->name ?? 'Not Assigned' }}
                            </td>
                            
                            <!-- Scheduled Date -->
                            <td style="font-weight: 500; color: #4b5563;">
                                {{ $booking->visit_date ? \Carbon\Carbon::parse($booking->visit_date)->format('d M, Y') : '-' }}
                            </td>

                            <!-- Repair Finished Date -->
                            <td style="font-weight: 500; color: #4b5563;">
                                {{ $booking->repair_finished_date ? \Carbon\Carbon::parse($booking->repair_finished_date)->format('d M, Y') : '-' }}
                            </td>
                            
                            <!-- State Color Badges -->
                            <td>
                                @php
                                    $badgeClass = 'badge-default';
                                    $statusVal = $booking->status;
                                    
                                    if ($statusVal === 'Technician Assigned') {
                                        $badgeClass = 'badge-assigned';
                                    } elseif ($statusVal === 'Inspection Completed') {
                                        $badgeClass = 'badge-inspected';
                                    } elseif ($statusVal === 'Quotation Sent') {
                                        $badgeClass = 'badge-sent';
                                    } elseif ($statusVal === 'Quotation Accepted') {
                                        $badgeClass = 'badge-accepted';
                                    } elseif ($statusVal === 'Repair In Progress') {
                                        $badgeClass = 'badge-inprogress';
                                    } elseif (in_array($statusVal, ['Repair Finished', 'Repair Completed'])) {
                                        $badgeClass = 'badge-completed';
                                    } elseif ($statusVal === 'Pickup Scheduled') {
                                        $badgeClass = 'badge-scheduled';
                                    } elseif ($statusVal === 'Quotation Rejected') {
                                        $badgeClass = 'badge-rejected';
                                    } elseif ($statusVal === 'Cancelled') {
                                        $badgeClass = 'badge-cancelled';
                                    }
                                @endphp
                                <span class="status-badge-pill {{ $badgeClass }}">
                                    <i class="bi bi-circle-fill"></i>
                                    {{ $statusVal }}
                                </span>
                            </td>
                            
                            <!-- Formatted Price -->
                            <td style="font-weight: 700; color: #111827;">
                                @if($booking->quotation_price)
                                    RM {{ number_format($booking->quotation_price, 2) }}
                                @else
                                    &mdash;
                                @endif
                            </td>
                            
                            <!-- Custom PDF open action -->
                            <td style="text-align: center;">
                                @if($booking->quotation_pdf)
                                    <a href="{{ asset($booking->quotation_pdf) }}" target="_blank" class="btn-pdf-link" title="Open PDF Invoice">
                                        <i class="bi bi-file-earmark-pdf-fill"></i>
                                        <span>Invoice</span>
                                    </a>
                                @else
                                    <span style="color: #cbd5e1; font-size: 13px; font-weight: 500;">No PDF</span>
                                @endif
                            </td>
                        </tr>
                    @endforeach
                </tbody>
            </table>
        </div>
    </div>
</div>

<script>
    $(document).ready(function () {
        $('#bookingHistoryTable').DataTable({
            pageLength: 10,
            order: [[0, 'desc']],
            ordering: true,
            searching: true,
            responsive: true,
            language: {
                search: "_INPUT_",
                searchPlaceholder: "Search history...",
                lengthMenu: "Show _MENU_ records",
                paginate: {
                    first: "«",
                    previous: "‹",
                    next: "›",
                    last: "»"
                }
            }
        });
    });
</script>

@endsection
