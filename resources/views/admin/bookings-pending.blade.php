@extends('layouts.admin')

@section('title', 'Pending Bookings')

@section('content')
<!-- Custom Modern CSS styles directly in dashboard to provide high visual grade premium style -->
<style>
    .pending-container {
        display: flex;
        flex-direction: column;
        gap: 30px;
    }
    
    /* Header & Metrics styling */
    .pending-header-panel {
        background: #ffffff;
        border: 1px solid rgba(229, 231, 235, 0.8);
        border-radius: 16px;
        padding: 24px;
        display: flex;
        justify-content: space-between;
        align-items: center;
        box-shadow: 0 4px 6px -1px rgba(0, 0, 0, 0.05);
    }
    
    .pending-title-area h1 {
        font-family: 'Playfair Display', serif;
        font-size: 28px;
        font-weight: 700;
        color: #111827;
        margin-bottom: 6px;
    }
    
    .pending-title-area p {
        font-size: 14px;
        color: #6b7280;
    }
    
    .pending-count-badge {
        background: linear-gradient(135deg, #f59e0b, #d97706);
        color: #ffffff;
        padding: 10px 20px;
        border-radius: 99px;
        font-weight: 700;
        font-size: 14px;
        box-shadow: 0 4px 10px rgba(245, 158, 11, 0.25);
        display: flex;
        align-items: center;
        gap: 8px;
    }

    /* Message styling */
    .alert-panel {
        padding: 16px 20px;
        border-radius: 12px;
        margin-bottom: 10px;
        font-weight: 600;
        font-size: 14px;
        display: flex;
        align-items: center;
        gap: 12px;
        box-shadow: 0 4px 6px -1px rgba(0,0,0,0.03);
    }
    
    .alert-success-panel {
        background-color: #ecfdf5;
        border: 1px solid #a7f3d0;
        color: #065f46;
    }
    
    .alert-error-panel {
        background-color: #fef2f2;
        border: 1px solid #fca5a5;
        color: #991b1b;
    }

    /* Grid layout */
    .pending-grid {
        display: grid;
        grid-template-columns: repeat(auto-fill, minmax(420px, 1fr));
        gap: 24px;
    }
    
    @media(max-width: 640px) {
        .pending-grid {
            grid-template-columns: 1fr;
        }
    }
    
    /* Card design */
    .pending-card {
        background: #ffffff;
        border: 1px solid rgba(229, 231, 235, 0.8);
        border-radius: 18px;
        padding: 26px;
        box-shadow: 0 4px 6px -1px rgba(0, 0, 0, 0.04), 0 2px 4px -1px rgba(0, 0, 0, 0.01);
        transition: all 0.3s cubic-bezier(0.4, 0, 0.2, 1);
        display: flex;
        flex-direction: column;
        justify-content: space-between;
        position: relative;
        overflow: hidden;
    }
    
    .pending-card:hover {
        transform: translateY(-5px);
        box-shadow: 0 20px 25px -5px rgba(0, 0, 0, 0.06), 0 10px 10px -5px rgba(0, 0, 0, 0.02);
        border-color: rgba(245, 158, 11, 0.3);
    }
    
    .pending-card::before {
        content: '';
        position: absolute;
        top: 0;
        left: 0;
        width: 4px;
        height: 100%;
        background: linear-gradient(180deg, #f59e0b, #d97706);
    }
    
    .pending-card-header {
        display: flex;
        justify-content: space-between;
        align-items: start;
        margin-bottom: 20px;
    }
    
    .pending-card-title {
        display: flex;
        flex-direction: column;
        gap: 4px;
    }
    
    .pending-badge {
        align-self: flex-start;
        background: #fffbeb;
        color: #d97706;
        border: 1px solid #fef3c7;
        font-size: 11px;
        font-weight: 700;
        text-transform: uppercase;
        padding: 4px 10px;
        border-radius: 50px;
        letter-spacing: 0.03em;
    }
    
    .pending-card-header h2 {
        font-family: 'Playfair Display', serif;
        font-size: 20px;
        font-weight: 700;
        color: #111827;
        margin-top: 4px;
    }
    
    .pending-icon-box {
        width: 48px;
        height: 48px;
        background: #fffbeb;
        color: #d97706;
        border-radius: 12px;
        display: grid;
        place-items: center;
        font-size: 20px;
        flex-shrink: 0;
    }
    
    /* Info Panel details */
    .pending-card-body {
        margin-bottom: 24px;
        display: flex;
        flex-direction: column;
        gap: 12px;
    }
    
    .pending-info-row {
        display: flex;
        gap: 12px;
        font-size: 14px;
        line-height: 1.5;
    }
    
    .pending-info-row i {
        color: #9ca3af;
        font-size: 16px;
        margin-top: 2px;
        width: 18px;
        text-align: center;
    }
    
    .pending-info-content {
        display: flex;
        flex-direction: column;
    }
    
    .pending-info-label {
        font-size: 11px;
        font-weight: 700;
        color: #9ca3af;
        text-transform: uppercase;
        letter-spacing: 0.05em;
    }
    
    .pending-info-value {
        color: #374151;
        font-weight: 600;
    }
    
    .pending-info-value.problem-desc {
        background: #f9fafb;
        border: 1px solid #f3f4f6;
        border-radius: 8px;
        padding: 10px 12px;
        color: #4b5563;
        font-style: italic;
        font-weight: 500;
        margin-top: 4px;
    }
    
    /* Form inputs styling */
    .pending-card-footer {
        border-top: 1px dashed #e5e7eb;
        padding-top: 20px;
    }
    
    .pending-form-group {
        display: flex;
        flex-direction: column;
        gap: 8px;
    }
    
    .pending-form-group label {
        font-size: 12px;
        font-weight: 700;
        color: #4b5563;
        text-transform: uppercase;
        letter-spacing: 0.05em;
        margin-bottom: 0;
    }
    
    .pending-select {
        width: 100%;
        height: 46px;
        border: 1px solid #d1d5db;
        border-radius: 10px;
        padding: 0 12px;
        background: #ffffff;
        font-family: inherit;
        font-size: 14px;
        color: #374151;
        font-weight: 600;
        outline: none;
        transition: all 0.2s ease;
    }
    
    .pending-select:focus {
        border-color: #f59e0b;
        box-shadow: 0 0 0 3px rgba(245, 158, 11, 0.12);
    }
    
    .pending-assign-btn {
        width: 100%;
        height: 46px;
        margin-top: 12px;
        background: linear-gradient(135deg, #2563eb, #1d4ed8);
        color: #ffffff;
        border: none;
        border-radius: 10px;
        font-weight: 700;
        font-size: 13px;
        text-transform: uppercase;
        letter-spacing: 0.05em;
        cursor: pointer;
        transition: all 0.3s ease;
        display: flex;
        align-items: center;
        justify-content: center;
        gap: 8px;
        box-shadow: 0 4px 10px rgba(37, 99, 235, 0.15);
    }
    
    .pending-assign-btn:hover {
        background: linear-gradient(135deg, #1d4ed8, #1e40af);
        transform: translateY(-1px);
        box-shadow: 0 6px 14px rgba(37, 99, 235, 0.25);
    }
    
    /* Empty state */
    .pending-empty-card {
        grid-column: 1 / -1;
        background: #ffffff;
        border: 1px dashed #d1d5db;
        border-radius: 18px;
        padding: 60px 20px;
        text-align: center;
        display: flex;
        flex-direction: column;
        align-items: center;
        justify-content: center;
        gap: 16px;
    }
    
    .pending-empty-icon {
        width: 72px;
        height: 72px;
        background: #f3f4f6;
        color: #9ca3af;
        border-radius: 50%;
        display: grid;
        place-items: center;
        font-size: 32px;
    }
    
    .pending-empty-card h3 {
        font-family: 'Playfair Display', serif;
        font-size: 22px;
        font-weight: 700;
        color: #374151;
        margin: 0;
    }
    
    .pending-empty-card p {
        color: #6b7280;
        font-size: 14px;
        max-width: 320px;
        margin: 0;
    }
</style>

<div class="pending-container">
    
    <!-- Header panel -->
    <div class="pending-header-panel">
        <div class="pending-title-area">
            <h1>Pending Visit Bookings</h1>
            <p>Assign qualified available technicians to handle initial system diagnostics and inspection visits.</p>
        </div>
        <div class="pending-count-badge">
            <i class="bi bi-clock-history"></i>
            <span>{{ $bookings->count() }} Booking Requests</span>
        </div>
    </div>

    <!-- Alert Notifications -->
    

    @if($errors->any())
        <div class="alert-panel alert-error-panel" id="popup-notification-error">
            <i class="bi bi-exclamation-triangle-fill" style="font-size: 18px;"></i>
            <span>{{ $errors->first() }}</span>
        </div>
    @endif

    <!-- Cards Grid -->
    <div class="pending-grid">
        @forelse($bookings as $booking)
            <div class="pending-card">
                <div>
                    <!-- Card Top Header -->
                    <div class="pending-card-header">
                        <div class="pending-card-title">
                            <span class="pending-badge">{{ $booking->status }}</span>
                            <h2>Booking ID #{{ $booking->id }}</h2>
                        </div>
                        <div class="pending-icon-box">
                            <i class="bi bi-calendar-range"></i>
                        </div>
                    </div>

                    <!-- Customer & Request Data -->
                    <div class="pending-card-body">
                        <!-- Customer Name -->
                        <div class="pending-info-row">
                            <i class="bi bi-person-circle"></i>
                            <div class="pending-info-content">
                                <span class="pending-info-label">Customer</span>
                                <span class="pending-info-value">{{ $booking->customer->name ?? 'Guest User' }}</span>
                            </div>
                        </div>

                        <!-- Phone Number -->
                        <div class="pending-info-row">
                            <i class="bi bi-telephone"></i>
                            <div class="pending-info-content">
                                <span class="pending-info-label">Phone Reference</span>
                                <span class="pending-info-value">{{ $booking->customer->phone_number ?? '-' }}</span>
                            </div>
                        </div>

                        <!-- Device Detail -->
                        <div class="pending-info-row">
                            <i class="bi bi-phone"></i>
                            <div class="pending-info-content">
                                <span class="pending-info-label">Device Type</span>
                                <span class="pending-info-value">{{ $booking->device->name ?? '-' }} ({{ $booking->device->brand ?? '-' }})</span>
                            </div>
                        </div>

                        <!-- Scheduled Visit Date -->
                        <div class="pending-info-row">
                            <i class="bi bi-calendar2-event"></i>
                            <div class="pending-info-content">
                                <span class="pending-info-label">Scheduled Date</span>
                                <span class="pending-info-value" style="color: #2563eb;">
                                    {{ $booking->visit_date ? \Carbon\Carbon::parse($booking->visit_date)->format('l, d M Y') : 'Not Specified' }}
                                </span>
                            </div>
                        </div>

                        <!-- Problem Description -->
                        <div class="pending-info-row">
                            <i class="bi bi-chat-left-text"></i>
                            <div class="pending-info-content" style="width: 100%;">
                                <span class="pending-info-label">Problem Statement</span>
                                <div class="pending-info-value problem-desc">"{{ $booking->problem_description }}"</div>
                            </div>
                        </div>
                    </div>
                </div>

                <!-- Technician Assignment Form -->
                <div class="pending-card-footer">
                    <form method="POST" action="{{ route('admin.bookings.assign', $booking->id) }}">
                        @csrf
                        @method('PUT')

                        <div class="pending-form-group">
                            <label><i class="bi bi-tools" style="margin-right: 4px;"></i> Assign Field Technician</label>

                            <select name="technician_id" class="pending-select" required>
                                <option value="">Select available technician</option>

                                @foreach($technicians as $technician)
                                    @php
                                        $isUnavailable = $technician->availabilities
                                            ->where('unavailable_date', $booking->visit_date)
                                            ->count() > 0;
                                        
                                        $deviceType = $booking->device->type ?? null;
                                        $isSpecialized = true;
                                        if ($deviceType) {
                                            $specialties = array_map('trim', explode(',', strtolower($technician->specialty ?? '')));
                                            $isSpecialized = false;
                                            foreach ($specialties as $specialty) {
                                                if (str_contains($specialty, strtolower($deviceType))) {
                                                    $isSpecialized = true;
                                                    break;
                                                }
                                            }
                                        }
                                    @endphp

                                    @if(!$isUnavailable && $isSpecialized)
                                        <option value="{{ $technician->id }}"
                                            {{ $booking->technician_id == $technician->id ? 'selected' : '' }}>
                                            {{ $technician->name }}
                                        </option>
                                    @endif
                                @endforeach
                            </select>

                            <button type="submit" class="pending-assign-btn">
                                <i class="bi bi-person-check-fill"></i>
                                <span>Assign</span>
                            </button>
                        </div>
                    </form>
                </div>
            </div>
        @empty
            <!-- Beautiful Empty box state -->
            <div class="pending-empty-card">
                <div class="pending-empty-icon">
                    <i class="bi bi-folder-check"></i>
                </div>
                <h3>All Bookings Assigned</h3>
                <p>There are currently no outstanding visit requests awaiting technician assignments.</p>
            </div>
        @endforelse
    </div>
</div>

<script>
    document.addEventListener("DOMContentLoaded", function() {
        const successNotify = document.getElementById('popup-notification');
        const errorNotify = document.getElementById('popup-notification-error');

        if(successNotify) {
            setTimeout(function(){
                successNotify.style.transition = 'opacity 0.5s ease';
                successNotify.style.opacity = '0';
                setTimeout(() => successNotify.style.display = 'none', 500);
            }, 3500);
        }

        if(errorNotify) {
            setTimeout(function(){
                errorNotify.style.transition = 'opacity 0.5s ease';
                errorNotify.style.opacity = '0';
                setTimeout(() => errorNotify.style.display = 'none', 500);
            }, 3500);
        }
    });
</script>
@endsection