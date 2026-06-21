@extends('layouts.technician')

@section('title', 'Job #' . $booking->id)

@section('content')

@php
    $statusLower = strtolower($booking->status);
    if(str_contains($statusLower,'progress'))
        $sc = 'status-pending'; // Orange
    elseif(str_contains($statusLower,'finish') || str_contains($statusLower,'completed'))
        $sc = 'status-completed'; // Greenish/Blueish
    elseif(str_contains($statusLower,'inspection') || str_contains($statusLower,'approval'))
        $sc = 'status-approved';
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

    .job-form-group {
        margin-bottom: 16px;
    }
    .job-form-group label {
        display: block;
        font-weight: 700;
        font-size: 13px;
        color: #111827;
        margin-bottom: 6px;
        text-transform: uppercase;
        letter-spacing: 0.05em;
    }

    .job-select, .job-textarea {
        width: 100%;
        border: 1px solid #cbd5e1;
        border-radius: 8px;
        padding: 10px 12px;
        font-family: 'Mukta Mahee', sans-serif;
        font-size: 14px;
        color: #1f2937;
        background-color: #fff;
        transition: border-color 0.2s, box-shadow 0.2s;
    }
    .job-select:focus, .job-textarea:focus {
        outline: none;
        border-color: #2563eb;
        box-shadow: 0 0 0 3px rgba(37, 99, 235, 0.15);
    }
    
    .btn-job-submit {
        border: none;
        background: linear-gradient(135deg, #10b981 0%, #059669 100%);
        color: white;
        padding: 12px;
        border-radius: 8px;
        font-weight: 700;
        cursor: pointer;
        transition: all 0.2s ease;
        display: inline-flex;
        align-items: center;
        justify-content: center;
        gap: 8px;
        font-size: 13px;
        text-transform: uppercase;
        letter-spacing: 0.05em;
    }
    .btn-job-submit:hover {
        transform: translateY(-1px);
        box-shadow: 0 4px 12px rgba(16, 185, 129, 0.2);
    }

    .job-status-banner {
        padding: 14px;
        border-radius: 8px;
        text-align: center;
        font-weight: 600;
        font-size: 14px;
    }
    .job-status-banner.accepted {
        background: #eff6ff;
        border: 1px solid #bfdbfe;
        color: #1e40af;
    }
    .job-status-banner.completed {
        background: #eafff3;
        border: 1px solid #bbf7d0;
        color: #065f46;
    }

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

<a href="{{ route('technician.assigned.jobs') }}" class="back-btn">
    <i class="bi bi-arrow-left"></i> Back to Assigned Jobs
</a>



<div class="booking-main-title">
    <h1>Job #{{ $booking->id }}</h1>
    <span class="status-badge {{ $sc }}">{{ $booking->status }}</span>
</div>

{{-- Job Info --}}
<div class="detail-card">
    <div class="detail-card-header">
        <h3><i class="bi bi-info-circle-fill" style="color:#3b82f6;"></i> Job Details</h3>
    </div>
    <div class="detail-card-body">
        <div class="info-grid">
            <div class="info-item">
                <span class="info-label">Customer</span>
                <span class="info-value">{{ $booking->customer->name ?? '-' }}</span>
            </div>
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
        </div>

        <div style="margin-top:20px;">
            <div class="info-label" style="margin-bottom:8px;">Problem Description</div>
            <div class="problem-box">{{ $booking->problem_description }}</div>
        </div>

        @if($booking->inspection_report)
            <div style="margin-top:16px;">
                <div class="info-label" style="margin-bottom:8px;">Your Inspection Report</div>
                <div class="problem-box purple">{{ $booking->inspection_report }}</div>
            </div>
        @endif
        
        @if($booking->quotation_price)
            <div style="margin-top:16px;">
                <div class="info-label" style="margin-bottom:8px;">Quotation Value</div>
                <div class="info-value" style="color: #10b981; font-size: 1.2rem;">RM {{ number_format($booking->quotation_price, 2) }}</div>
            </div>
        @endif
    </div>
</div>

{{-- Action Form --}}
<div class="detail-card">
    <div class="detail-card-header">
        <h3><i class="bi bi-gear-fill" style="color:#f59e0b;"></i> Update Repair Progress</h3>
    </div>
    <div class="detail-card-body">
        @if($booking->status == 'Repair In Progress')
            <form method="POST" class="job-form-section" enctype="multipart/form-data" style="margin-top:0; border-top:none; padding-top:0;">
                @csrf
                @method('PUT')
                
                <div class="job-form-group">
                    <label>Repair Update / Completion Note</label>
                    <textarea name="note" class="job-textarea" rows="4" placeholder="Describe the repair progress or completion details..." required></textarea>
                </div>
                
                <div class="job-form-group" style="margin-bottom: 20px;">
                    <label>Proof Image (optional - for completion)</label>
                    <input type="file" name="proof_image" accept="image/*" class="job-select">
                    <small style="color:#6b7280; font-size: 11px;">Upload a picture as proof of completion. This will be shown to the customer.</small>
                </div>

                <div style="display: flex; gap: 10px;">
                    <button type="submit" formaction="{{ route('technician.bookings.progress', $booking->id) }}" class="btn-job-submit" style="flex: 1; background: linear-gradient(135deg, #3b82f6 0%, #1d4ed8 100%);">
                        <i class="bi bi-arrow-repeat"></i> Send Update
                    </button>
                    <button type="submit" formaction="{{ route('technician.bookings.finish', $booking->id) }}" class="btn-job-submit" style="flex: 1; background: linear-gradient(135deg, #10b981 0%, #059669 100%);">
                        <i class="bi bi-check-circle-fill"></i> Mark as Finished
                    </button>
                </div>
            </form>
        @elseif($booking->status == 'Repair Finished')
            <div class="job-status-banner completed">
                <i class="bi bi-check-circle-fill"></i> Repair finished. Waiting for customer payment.
            </div>
        @else
            <div class="job-status-banner accepted">
                <i class="bi bi-info-circle-fill"></i> This job is currently in "{{ $booking->status }}" status and cannot be updated yet.
            </div>
        @endif
    </div>
</div>



@endsection
