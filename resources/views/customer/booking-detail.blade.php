@extends('layouts.customer')

@section('title', 'Booking #' . $booking->id)

@section('content')

@php
    $statusLower = strtolower($booking->status);
    if(str_contains($statusLower,'pending') || str_contains($statusLower,'waiting') || str_contains($statusLower,'requested'))
        $sc = 'status-pending';
    elseif(str_contains($statusLower,'accept') || str_contains($statusLower,'approved') || str_contains($statusLower,'progress') || str_contains($statusLower,'finished'))
        $sc = 'status-approved';
    elseif(str_contains($statusLower,'reject') || str_contains($statusLower,'cancel'))
        $sc = 'status-rejected';
    elseif(str_contains($statusLower,'complet') || str_contains($statusLower,'done') || str_contains($statusLower,'paid'))
        $sc = 'status-completed';
    else
        $sc = 'status-default';
@endphp

<style>
    .back-btn {
        display: inline-flex;
        align-items: center;
        gap: 7px;
        background: #f3f4f6;
        color: #374151;
        border: 1px solid #e5e7eb;
        border-radius: 9px;
        padding: 9px 18px;
        font-size: 0.9rem;
        font-weight: 600;
        text-decoration: none;
        margin-bottom: 24px;
        transition: background 0.2s;
    }
    .back-btn:hover { background: #e5e7eb; }

    .detail-card {
        background: #fff;
        border-radius: 16px;
        border: 1px solid #e5e7eb;
        box-shadow: 0 4px 6px -1px rgba(0,0,0,0.06);
        margin-bottom: 24px;
        overflow: hidden;
    }
    .detail-card-header {
        padding: 20px 28px;
        border-bottom: 1px solid #f3f4f6;
        display: flex;
        justify-content: space-between;
        align-items: center;
        background: #fafafa;
    }
    .detail-card-header h3 {
        margin: 0;
        font-size: 1rem;
        font-weight: 700;
        color: #111827;
        display: flex;
        align-items: center;
        gap: 9px;
    }
    .detail-card-body { padding: 24px 28px; }

    .info-grid {
        display: grid;
        grid-template-columns: repeat(auto-fit, minmax(200px, 1fr));
        gap: 20px;
    }
    .info-item { display: flex; flex-direction: column; gap: 4px; }
    .info-label { font-size: 0.78rem; color: #9ca3af; font-weight: 600; text-transform: uppercase; letter-spacing: 0.05em; }
    .info-value { font-size: 0.95rem; color: #111827; font-weight: 600; }

    .status-badge {
        padding: 5px 12px;
        border-radius: 9999px;
        font-size: 0.78rem;
        font-weight: 700;
        text-transform: capitalize;
        display: inline-block;
    }
    .status-pending  { background: #fef3c7; color: #b45309; }
    .status-approved { background: #dcfce7; color: #15803d; }
    .status-rejected { background: #fee2e2; color: #b91c1c; }
    .status-completed{ background: #e0e7ff; color: #4338ca; }
    .status-default  { background: #f3f4f6; color: #4b5563; }

    .problem-box {
        background: #f9fafb;
        border-left: 4px solid #3b82f6;
        border-radius: 8px;
        padding: 16px 20px;
        color: #374151;
        font-size: 0.95rem;
        line-height: 1.6;
    }
    .problem-box.purple { border-left-color: #8b5cf6; background: #f5f3ff; }

    .quotation-box {
        background: linear-gradient(to right, #f8fafc, #f1f5f9);
        border: 1px solid #e2e8f0;
        border-radius: 12px;
        padding: 20px 24px;
    }

    /* Timeline */
    .timeline { position: relative; padding-left: 26px; }
    .timeline::before {
        content: '';
        position: absolute;
        left: 7px; top: 0; bottom: 0;
        width: 2px;
        background: #e5e7eb;
    }
    .timeline-item { position: relative; padding-bottom: 24px; }
    .timeline-item:last-child { padding-bottom: 0; }
    .timeline-item::before {
        content: '';
        position: absolute;
        left: -24px; top: 5px;
        width: 12px; height: 12px;
        border-radius: 50%;
        background: #3b82f6;
        border: 2px solid #fff;
        box-shadow: 0 0 0 2px #e5e7eb;
        z-index: 1;
    }
    .timeline-item:first-child::before { background: #10b981; box-shadow: 0 0 0 2px #dcfce7; }
    .timeline-content h4 { margin: 0 0 4px; font-size: 0.95rem; color: #111827; }
    .timeline-content p  { margin: 0 0 6px; color: #6b7280; font-size: 0.875rem; line-height: 1.5; }
    .timeline-time { font-size: 0.78rem; color: #9ca3af; display: flex; align-items: center; gap: 4px; }

    .proof-img {
        max-width: 220px;
        border-radius: 10px;
        border: 1px solid #e5e7eb;
        margin-top: 8px;
        display: block;
        transition: transform 0.2s;
    }
    .proof-img:hover { transform: scale(1.02); }

    .action-btn {
        display: inline-flex;
        align-items: center;
        gap: 8px;
        padding: 11px 22px;
        border-radius: 9px;
        font-weight: 700;
        font-size: 0.88rem;
        text-decoration: none;
        border: none;
        cursor: pointer;
        transition: opacity 0.2s, transform 0.1s;
    }
    .action-btn:hover { opacity: 0.9; transform: translateY(-1px); }
    .btn-accept  { background: #10b981; color: white; }
    .btn-reject  { background: #ef4444; color: white; }
    .btn-pay     { background: #f59e0b; color: white; }
    .btn-pdf     { background: #3b82f6; color: white; }
    .btn-review  { background: #16a34a; color: white; }

    .booking-main-title {
        display: flex;
        justify-content: space-between;
        align-items: center;
        margin-bottom: 24px;
        flex-wrap: wrap;
        gap: 12px;
    }
    .booking-main-title h1 {
        font-size: 1.7rem;
        font-weight: 800;
        color: #111827;
        margin: 0;
    }
</style>

<a href="{{ $from === 'history' ? route('customer.booking.history') : route('customer.booking.status') }}" class="back-btn">
    <i class="bi bi-arrow-left"></i> Back to {{ $from === 'history' ? 'Booking History' : 'Booking Status' }}
</a>


@if(session('delete'))
    <div style="background:#fee2e2; border-left:4px solid #ef4444; color:#991b1b; padding:14px 18px; border-radius:10px; margin-bottom:20px; font-weight:500; display:flex; align-items:center; gap:8px;">
        <i class="bi bi-x-circle-fill"></i> {{ session('delete') }}
    </div>
@endif

<div class="booking-main-title">
    <h1>Booking #{{ $booking->id }}</h1>
    <span class="status-badge {{ $sc }}">{{ $booking->status }}</span>
</div>

{{-- Booking Info --}}
<div class="detail-card">
    <div class="detail-card-header">
        <h3><i class="bi bi-info-circle-fill" style="color:#3b82f6;"></i> Booking Details</h3>
    </div>
    <div class="detail-card-body">
        <div class="info-grid">
            <div class="info-item">
                <span class="info-label">Device</span>
                <span class="info-value">{{ $booking->device->name ?? '-' }} ({{ $booking->device->brand ?? '-' }})</span>
            </div>
            <div class="info-item">
                <span class="info-label">Model</span>
                <span class="info-value">{{ $booking->device->model ?? '-' }}</span>
            </div>
            <div class="info-item">
                <span class="info-label">Submitted On</span>
                <span class="info-value">{{ $booking->created_at->format('d M Y, h:i A') }}</span>
            </div>
            <div class="info-item">
                <span class="info-label">Visit Date</span>
                <span class="info-value">{{ $booking->visit_date ? \Carbon\Carbon::parse($booking->visit_date)->format('d M Y') : '-' }}</span>
            </div>
            <div class="info-item">
                <span class="info-label">Repair Finished Date</span>
                <span class="info-value">{{ $booking->repair_finished_date ? \Carbon\Carbon::parse($booking->repair_finished_date)->format('d M Y') : '-' }}</span>
            </div>
            <div class="info-item">
                <span class="info-label">Technician</span>
                <span class="info-value">{{ $booking->technician->name ?? 'Not assigned yet' }}</span>
            </div>
            <div class="info-item">
                <span class="info-label">Payment Status</span>
                <span class="info-value">{{ $booking->payment_status ?? 'Unpaid' }}</span>
            </div>
        </div>

        <div style="margin-top:20px;">
            <div class="info-label" style="margin-bottom:8px;">Problem Description</div>
            <div class="problem-box">{{ $booking->problem_description }}</div>
        </div>

        @if($booking->inspection_report)
            <div style="margin-top:16px;">
                <div class="info-label" style="margin-bottom:8px;">Technician Inspection Report</div>
                <div class="problem-box purple">{{ $booking->inspection_report }}</div>
            </div>
        @endif
    </div>
</div>

{{-- Quotation --}}
@if($booking->quotation_price)
    <div class="detail-card">
        <div class="detail-card-header">
            <h3><i class="bi bi-receipt" style="color:#3b82f6;"></i> Quotation</h3>
        </div>
        <div class="detail-card-body">
            <div class="quotation-box">
                <div class="info-grid" style="margin-bottom:0;">
                    <div class="info-item">
                        <span class="info-label">Quoted Price</span>
                        <span class="info-value" style="color:#059669; font-size:1.25rem;">RM {{ number_format($booking->quotation_price, 2) }}</span>
                    </div>
                    <div class="info-item">
                        <span class="info-label">Quotation Status</span>
                        <span class="info-value">{{ $booking->quotation_status ?? 'Pending' }}</span>
                    </div>
                    @if($booking->quotation_note)
                        <div class="info-item" style="grid-column: 1 / -1;">
                            <span class="info-label">Note from Admin</span>
                            <span class="info-value" style="font-weight:400;">{{ $booking->quotation_note }}</span>
                        </div>
                    @endif
                </div>
            </div>

            {{-- Quotation action buttons --}}
            <div style="display:flex; gap:12px; margin-top:20px; flex-wrap:wrap; align-items:center;">
                @if($booking->quotation_status === 'Pending Customer Approval' && !in_array($booking->status, ['Repair In Progress', 'Repair Finished', 'Repair Completed']))
                    <form method="POST" action="{{ route('customer.booking.accept', $booking->id) }}">
                        @csrf @method('PUT')
                        <button type="submit" class="action-btn btn-accept">
                            <i class="bi bi-check-circle-fill"></i> Accept Quotation
                        </button>
                    </form>
                    <form method="POST" action="{{ route('customer.booking.reject', $booking->id) }}" onsubmit="return confirm('Reject this quotation?')">
                        @csrf @method('PUT')
                        <button type="submit" class="action-btn btn-reject">
                            <i class="bi bi-x-circle-fill"></i> Reject Quotation
                        </button>
                    </form>
                @endif

                @if($booking->quotation_pdf)
                    <a href="{{ asset($booking->quotation_pdf) }}" target="_blank" class="action-btn btn-pdf">
                        <i class="bi bi-file-earmark-pdf"></i> View Quotation PDF
                    </a>
                @endif
            </div>
        </div>
        @if($booking->payment_status === 'Paid' && $booking->status === 'Repair Completed' && ! $booking->review)
            <div style="margin-top:18px;">
                <a href="{{ route('customer.review.create', $booking->id) }}" class="action-btn btn-review">
                    <i class="bi bi-star-fill"></i> Rate This Service
                </a>
            </div>
        @elseif($booking->review)
            <div style="margin-top:18px; padding:16px 18px; border-radius:12px; background:#f8fafc; border:1px solid #e2e8f0;">
                <div class="info-label" style="margin-bottom:8px;">Your Review</div>
                <div style="color:#f59e0b; margin-bottom:8px;">
                    @for($i = 1; $i <= 5; $i++)
                        <i class="bi {{ $i <= $booking->review->rating ? 'bi-star-fill' : 'bi-star' }}"></i>
                    @endfor
                </div>
                <p style="margin:0; color:#475569;">{{ $booking->review->comment }}</p>
            </div>
        @endif
    </div>
@endif

{{-- Payment --}}
@if($booking->status === 'Repair Finished' && $booking->payment_status !== 'Paid')
    <div class="detail-card" style="border-color:#fcd34d;">
        <div class="detail-card-header" style="background:#fffbeb;">
            <h3><i class="bi bi-credit-card" style="color:#f59e0b;"></i> Payment Required</h3>
        </div>
        <div class="detail-card-body">
            <div class="info-grid" style="margin-bottom:16px;">
                <div class="info-item">
                    <span class="info-label">Amount Due</span>
                    <span class="info-value" style="color:#b91c1c; font-size:1.2rem;">RM {{ number_format($booking->quotation_price, 2) }}</span>
                </div>
                <div class="info-item">
                    <span class="info-label">Finished On</span>
                    <span class="info-value">{{ $booking->repair_finished_date ? \Carbon\Carbon::parse($booking->repair_finished_date)->format('d M Y') : '-' }}</span>
                </div>
            </div>
            <p style="color:#92400e; margin:0 0 16px; font-size:0.9rem;">
                <i class="bi bi-info-circle"></i> The repair has been completed. Please proceed with payment to finalize the service.
            </p>
            <a href="{{ route('customer.payment.show', $booking->id) }}" class="action-btn btn-pay">
                <i class="bi bi-credit-card-fill"></i> Pay Now
            </a>
        </div>
    </div>
@elseif($booking->payment_status === 'Paid')
    <div class="detail-card" style="border-color:#86efac;">
        <div class="detail-card-header" style="background:#f0fdf4;">
            <h3><i class="bi bi-check-circle-fill" style="color:#22c55e;"></i> Payment Completed</h3>
        </div>
        <div class="detail-card-body">
            <div class="info-grid">
                <div class="info-item">
                    <span class="info-label">Amount Paid</span>
                    <span class="info-value" style="color:#15803d; font-size:1.2rem;">RM {{ number_format($booking->amount_paid, 2) }}</span>
                </div>
                <div class="info-item">
                    <span class="info-label">Payment Date</span>
                    <span class="info-value">
                        @if($booking->payment_date)
                            {{ \Carbon\Carbon::parse($booking->payment_date)->format('d M Y, h:i A') }}
                        @else N/A @endif
                    </span>
                </div>
            </div>
        </div>
    </div>
@endif

{{-- Timeline --}}
<div class="detail-card">
    <div class="detail-card-header">
        <h3><i class="bi bi-clock-history" style="color:#3b82f6;"></i> Status Timeline</h3>
    </div>
    <div class="detail-card-body">
        @if($booking->timelines && $booking->timelines->count() > 0)
            @php $sortedTimelines = $booking->timelines->sortByDesc('created_at'); @endphp
            <div class="timeline">
                @foreach($sortedTimelines as $timeline)
                    <div class="timeline-item">
                        <div class="timeline-content">
                            <h4>{{ $timeline->title }}</h4>
                            <p>{{ $timeline->description }}</p>
                            @if($timeline->image)
                                <a href="{{ asset($timeline->image) }}" target="_blank">
                                    <img src="{{ asset($timeline->image) }}" alt="Proof Image" class="proof-img">
                                </a>
                            @endif
                            <div class="timeline-time">
                                <i class="bi bi-clock"></i> {{ $timeline->created_at->format('d M Y, h:i A') }}
                            </div>
                        </div>
                    </div>
                @endforeach
            </div>
        @else
            <p style="color:#9ca3af; font-size:0.9rem;">No timeline events recorded yet.</p>
        @endif
    </div>
</div>

@endsection
