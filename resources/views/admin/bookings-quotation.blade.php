@extends('layouts.admin')

@section('title', 'Send Quotation')

@section('content')

<style>
    .quote-container {
        display: flex;
        flex-direction: column;
        gap: 30px;
    }
    
    /* Header & Tabs styling */
    .quote-header-panel {
        background: #ffffff;
        border: 1px solid rgba(229, 231, 235, 0.8);
        border-radius: 16px;
        padding: 24px;
        display: flex;
        justify-content: space-between;
        align-items: center;
        box-shadow: 0 4px 6px -1px rgba(0, 0, 0, 0.05);
    }
    
    .quote-title-area h1 {
        font-family: 'Playfair Display', serif;
        font-size: 28px;
        font-weight: 700;
        color: #111827;
        margin-bottom: 6px;
    }
    
    .quote-title-area p {
        font-size: 14px;
        color: #6b7280;
    }
    
    /* Elegant tabs selector */
    .quote-tabs {
        display: flex;
        background: #f3f4f6;
        padding: 6px;
        border-radius: 12px;
        gap: 4px;
    }
    
    .quote-tab-btn {
        border: none;
        background: transparent;
        color: #4b5563;
        font-family: inherit;
        font-size: 13px;
        font-weight: 700;
        padding: 10px 18px;
        border-radius: 8px;
        cursor: pointer;
        transition: all 0.2s ease;
        display: flex;
        align-items: center;
        gap: 8px;
    }
    
    .quote-tab-btn.active {
        background: #ffffff;
        color: #111827;
        box-shadow: 0 4px 6px -1px rgba(0,0,0,0.05), 0 2px 4px -1px rgba(0,0,0,0.03);
    }
    
    .quote-tab-badge {
        font-size: 10px;
        background: #e5e7eb;
        color: #4b5563;
        padding: 2px 6px;
        border-radius: 50px;
    }
    
    .quote-tab-btn.active .quote-tab-badge {
        background: #eff6ff;
        color: #2563eb;
    }

    /* Message styling */
    .alert-panel {
        padding: 16px 20px;
        border-radius: 12px;
        font-weight: 600;
        font-size: 14px;
        display: flex;
        align-items: center;
        gap: 12px;
        box-shadow: 0 4px 6px -1px rgba(0,0,0,0.03);
        background-color: #ecfdf5;
        border: 1px solid #a7f3d0;
        color: #065f46;
        margin-bottom: 10px;
    }

    /* Card items list */
    .quote-list {
        display: flex;
        flex-direction: column;
        gap: 20px;
    }
    
    .quote-card {
        background: #ffffff;
        border: 1px solid rgba(229, 231, 235, 0.8);
        border-radius: 18px;
        padding: 26px;
        box-shadow: 0 4px 6px -1px rgba(0, 0, 0, 0.04);
        transition: all 0.3s ease;
        display: flex;
        flex-direction: column;
        position: relative;
        overflow: hidden;
    }
    
    .quote-card:hover {
        box-shadow: 0 12px 20px -3px rgba(0, 0, 0, 0.05);
    }
    
    .quote-card-header {
        display: flex;
        justify-content: space-between;
        align-items: center;
        border-bottom: 1px solid #f3f4f6;
        padding-bottom: 16px;
        margin-bottom: 20px;
    }
    
    .quote-card-header h3 {
        font-family: 'Playfair Display', serif;
        font-size: 18px;
        font-weight: 700;
        color: #111827;
        display: flex;
        align-items: center;
        gap: 8px;
    }
    
    .quote-status-badge {
        font-size: 11px;
        font-weight: 700;
        text-transform: uppercase;
        padding: 5px 12px;
        border-radius: 50px;
        letter-spacing: 0.03em;
    }
    
    .badge-awaiting {
        background: #fdf2f8;
        color: #db2777;
        border: 1px solid #fce7f3;
    }
    
    .badge-sent {
        background: #ecfdf5;
        color: #059669;
        border: 1px solid #d1fae5;
    }
    
    /* Info grid */
    .quote-info-grid {
        display: grid;
        grid-template-columns: repeat(auto-fit, minmax(200px, 1fr));
        gap: 20px;
        margin-bottom: 20px;
    }
    
    .quote-info-item {
        display: flex;
        gap: 12px;
        font-size: 14px;
    }
    
    .quote-info-item i {
        color: #9ca3af;
        font-size: 18px;
        margin-top: 2px;
    }
    
    .quote-info-details {
        display: flex;
        flex-direction: column;
    }
    
    .quote-info-label {
        font-size: 11px;
        font-weight: 700;
        color: #9ca3af;
        text-transform: uppercase;
        letter-spacing: 0.05em;
    }
    
    .quote-info-value {
        color: #374151;
        font-weight: 600;
    }
    
    /* Inspection Report Alert block */
    .quote-inspection-report {
        background: #f8fafc;
        border-left: 4px solid #6366f1;
        border-radius: 0 10px 10px 0;
        padding: 16px 20px;
        margin-bottom: 24px;
        display: flex;
        gap: 12px;
        align-items: flex-start;
    }
    
    .quote-inspection-report i {
        font-size: 20px;
        color: #6366f1;
        margin-top: 2px;
    }
    
    .quote-inspection-text {
        font-size: 14px;
        color: #334155;
        font-weight: 500;
        line-height: 1.5;
    }
    
    .quote-inspection-title {
        font-size: 11px;
        font-weight: 700;
        color: #6366f1;
        text-transform: uppercase;
        letter-spacing: 0.05em;
        margin-bottom: 4px;
    }

    /* Currency inputs */
    .quote-form-section {
        border-top: 1px dashed #e5e7eb;
        padding-top: 24px;
        margin-top: 10px;
    }
    
    .quote-form-title {
        font-family: 'Playfair Display', serif;
        font-size: 16px;
        font-weight: 700;
        color: #111827;
        margin-bottom: 16px;
        display: flex;
        align-items: center;
        gap: 8px;
    }
    
    .quote-form-title i {
        color: #3b82f6;
    }
    
    .quote-form-row {
        display: grid;
        grid-template-columns: 240px 1fr;
        gap: 20px;
        margin-bottom: 20px;
    }
    
    @media(max-width: 768px) {
        .quote-form-row {
            grid-template-columns: 1fr;
        }
    }
    
    .quote-form-group {
        display: flex;
        flex-direction: column;
        gap: 6px;
    }
    
    .quote-form-group label {
        font-size: 12px;
        font-weight: 700;
        color: #4b5563;
        text-transform: uppercase;
        letter-spacing: 0.05em;
    }
    
    /* Currency Prepend Wrapper */
    .currency-wrapper {
        position: relative;
        display: flex;
        align-items: center;
    }
    
    .currency-prepend {
        position: absolute;
        left: 14px;
        font-weight: 700;
        color: #4b5563;
        font-size: 14px;
        pointer-events: none;
    }
    
    .quote-input-price {
        width: 100%;
        height: 46px;
        border: 1px solid #d1d5db;
        border-radius: 10px;
        padding: 0 12px 0 42px !important;
        font-family: inherit;
        font-size: 15px;
        font-weight: 700;
        color: #111827;
        outline: none;
        transition: all 0.2s ease;
    }
    
    .quote-input-price:focus {
        border-color: #3b82f6;
        box-shadow: 0 0 0 3px rgba(59, 130, 246, 0.12);
    }
    
    .quote-input-note {
        width: 100%;
        height: 46px;
        border: 1px solid #d1d5db;
        border-radius: 10px;
        padding: 0 14px !important;
        font-family: inherit;
        font-size: 14px;
        color: #374151;
        font-weight: 600;
        outline: none;
        transition: all 0.2s ease;
        margin-bottom: 0;
    }
    
    .quote-input-note:focus {
        border-color: #3b82f6;
        box-shadow: 0 0 0 3px rgba(59, 130, 246, 0.12);
    }
    
    /* Action Buttons styling */
    .quote-action-row {
        display: flex;
        gap: 12px;
        flex-wrap: wrap;
    }
    
    .btn-action {
        height: 46px;
        padding: 0 24px;
        border-radius: 10px;
        font-weight: 700;
        font-size: 13px;
        text-transform: uppercase;
        letter-spacing: 0.05em;
        display: inline-flex;
        align-items: center;
        justify-content: center;
        gap: 8px;
        cursor: pointer;
        transition: all 0.2s ease;
        border: none;
    }
    
    .btn-quote-send {
        background: linear-gradient(135deg, #10b981, #059669);
        color: #ffffff;
        box-shadow: 0 4px 10px rgba(16, 185, 129, 0.15);
    }
    
    .btn-quote-send:hover {
        background: linear-gradient(135deg, #059669, #047857);
        transform: translateY(-1px);
        box-shadow: 0 6px 14px rgba(16, 185, 129, 0.25);
    }
    
    .btn-quote-preview {
        background: transparent;
        border: 2px solid #3b82f6;
        color: #3b82f6;
    }
    
    .btn-quote-preview:hover {
        background: rgba(59, 130, 246, 0.05);
        transform: translateY(-1px);
    }

    /* Sent layout details */
    .quote-sent-banner {
        display: flex;
        align-items: center;
        justify-content: space-between;
        flex-wrap: wrap;
        background: #f0fdf4;
        border: 1px solid #bbf7d0;
        padding: 20px 24px;
        border-radius: 12px;
        gap: 20px;
    }
    
    .sent-price-box {
        display: flex;
        flex-direction: column;
    }
    
    .sent-price-label {
        font-size: 11px;
        font-weight: 700;
        color: #065f46;
        text-transform: uppercase;
        letter-spacing: 0.05em;
        margin-bottom: 2px;
    }
    
    .sent-price-value {
        font-size: 22px;
        font-weight: 800;
        color: #047857;
    }
    
    .sent-note-box {
        flex: 1;
        min-width: 200px;
        display: flex;
        flex-direction: column;
    }
    
    .sent-note-label {
        font-size: 11px;
        font-weight: 700;
        color: #065f46;
        text-transform: uppercase;
        letter-spacing: 0.05em;
        margin-bottom: 2px;
    }
    
    .sent-note-value {
        font-size: 14px;
        color: #0f172a;
        font-weight: 600;
    }
    
    .btn-pdf-view {
        background: linear-gradient(135deg, #3b82f6, #1d4ed8);
        color: #ffffff;
        box-shadow: 0 4px 10px rgba(59, 130, 246, 0.15);
    }
    
    .btn-pdf-view:hover {
        background: linear-gradient(135deg, #1d4ed8, #1e40af);
        transform: translateY(-1px);
        box-shadow: 0 6px 14px rgba(59, 130, 246, 0.25);
    }

    /* Empty state */
    .quote-empty-card {
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
    
    .quote-empty-icon {
        width: 72px;
        height: 72px;
        background: #f3f4f6;
        color: #9ca3af;
        border-radius: 50%;
        display: grid;
        place-items: center;
        font-size: 32px;
    }
    
    .quote-empty-card h3 {
        font-family: 'Playfair Display', serif;
        font-size: 22px;
        font-weight: 700;
        color: #374151;
        margin: 0;
    }
    
    .quote-empty-card p {
        color: #6b7280;
        font-size: 14px;
        max-width: 320px;
        margin: 0;
    }
</style>

<div class="quote-container">
    
    <!-- Header panel -->
    <div class="quote-header-panel">
        <div class="quote-title-area">
            <h1>Booking Quotations</h1>
            <p>Formulate and assign detailed pricing estimates to customers based on inspection results.</p>
        </div>
        
        <!-- Action Tabs Toggle -->
        <div class="quote-tabs">
            <button class="quote-tab-btn active" onclick="switchTab('awaiting', this)">
                <i class="bi bi-clock-history"></i> Awaiting Action
                <span class="quote-tab-badge" id="badge-awaiting-count">0</span>
            </button>
            <button class="quote-tab-btn" onclick="switchTab('sent', this)">
                <i class="bi bi-send-check"></i> Sent Quotations
                <span class="quote-tab-badge" id="badge-sent-count">0</span>
            </button>
        </div>
    </div>

    <!-- Alert Notifications -->
    

    <!-- Cards List -->
    <div class="quote-list" id="quotations-wrapper">
        @forelse($bookings as $booking)
            @php
                $statusType = ($booking->status === 'Inspection Completed') ? 'awaiting' : 'sent';
            @endphp
            <div class="quote-card booking-item" data-type="{{ $statusType }}">
                <!-- Card Header -->
                <div class="quote-card-header">
                    <h3>
                        <i class="bi bi-hash" style="color:#9ca3af; font-size: 16px;"></i>
                        Booking ID #{{ $booking->id }} &mdash; {{ $booking->customer->name ?? 'Guest Customer' }}
                    </h3>
                    <span class="quote-status-badge {{ $booking->status === 'Quotation Sent' ? 'badge-sent' : 'badge-awaiting' }}">
                        {{ $booking->status }}
                    </span>
                </div>

                <!-- Info Grid -->
                <div class="quote-info-grid">
                    <!-- Device detail -->
                    <div class="quote-info-item">
                        <i class="bi bi-phone"></i>
                        <div class="quote-info-details">
                            <span class="quote-info-label">Device Type</span>
                            <span class="quote-info-value">{{ $booking->device->name ?? '-' }} ({{ $booking->device->brand ?? '-' }})</span>
                        </div>
                    </div>

                    <!-- Assigned Tech -->
                    <div class="quote-info-item">
                        <i class="bi bi-person-gear"></i>
                        <div class="quote-info-details">
                            <span class="quote-info-label">Assigned Inspector</span>
                            <span class="quote-info-value">{{ $booking->technician->name ?? 'Not Assigned' }}</span>
                        </div>
                    </div>

                    <!-- Visit Date -->
                    <div class="quote-info-item">
                        <i class="bi bi-calendar-event"></i>
                        <div class="quote-info-details">
                            <span class="quote-info-label">Inspection Date</span>
                            <span class="quote-info-value">{{ $booking->visit_date ? \Carbon\Carbon::parse($booking->visit_date)->format('d M, Y') : '-' }}</span>
                        </div>
                    </div>
                </div>

                <!-- Detected Repairs Block -->
                <div class="quote-inspection-report">
                    <i class="bi bi-shield-exclamation"></i>
                    <div class="quote-inspection-text">
                        <div class="quote-inspection-title">Tech Inspection Diagnosed Report</div>
                        <strong>Issues / Required Parts:</strong> {{ $booking->inspection_report ?? 'No details submitted' }}
                    </div>
                </div>

                <!-- Quotation Sent Details -->
                @if($booking->status === 'Quotation Sent')
                    <div class="quote-sent-banner">
                        <div class="sent-price-box">
                            <span class="sent-price-label">Dispatched Cost Quote</span>
                            <span class="sent-price-value">RM {{ number_format($booking->quotation_price, 2) }}</span>
                        </div>
                        
                        @if($booking->quotation_note)
                            <div class="sent-note-box">
                                <span class="sent-note-label">Accompanying Statement / Note</span>
                                <span class="sent-note-value">"{{ $booking->quotation_note }}"</span>
                            </div>
                        @endif

                        <div>
                            <a href="{{ asset($booking->quotation_pdf) }}" target="_blank" class="btn-action btn-pdf-view">
                                <i class="bi bi-file-earmark-pdf"></i>
                                <span>Open PDF Document</span>
                            </a>
                        </div>
                    </div>
                @endif

                <!-- Awaiting Quotation form -->
                @if($booking->status === 'Inspection Completed')
                    <div class="quote-form-section">
                        <div class="quote-form-title">
                            <i class="bi bi-cash-coin"></i> Set Repair Estimation Cost
                        </div>

                        <form method="POST" action="{{ route('admin.bookings.sendQuotation', $booking->id) }}">
                            @csrf
                            @method('PUT')

                            <div class="quote-form-row">
                                <!-- Price input with RM Prepend -->
                                <div class="quote-form-group">
                                    <label for="price_{{ $booking->id }}">Quotation Price *</label>
                                    <div class="currency-wrapper">
                                        <span class="currency-prepend">RM</span>
                                        <input type="number" id="price_{{ $booking->id }}" name="quotation_price"
                                               class="quote-input-price" step="0.01" min="0"
                                               value="{{ $booking->quotation_price ?? '' }}"
                                               placeholder="0.00" required>
                                    </div>
                                </div>

                                <!-- Note input -->
                                <div class="quote-form-group">
                                    <label for="note_{{ $booking->id }}">Estimation Note / Remarks</label>
                                    <input type="text" id="note_{{ $booking->id }}" name="quotation_note"
                                           class="quote-input-note" value="{{ $booking->quotation_note ?? '' }}"
                                           placeholder="e.g. Includes original replacements, labour, and 3 months warranty coverage.">
                                </div>
                            </div>

                            <div class="quote-action-row">
                                <button type="submit" class="btn-action btn-quote-send">
                                    <i class="bi bi-send-check-fill"></i>
                                    <span>Send quotation to Customer & Generate PDF</span>
                                </button>
                                
                                <button type="button" class="btn-action btn-quote-preview" onclick="previewPdf({{ $booking->id }})">
                                    <i class="bi bi-file-earmark-pdf"></i>
                                    <span>Preview PDF Invoice</span>
                                </button>
                            </div>
                        </form>
                    </div>
                @endif
            </div>
        @empty
            <!-- General Empty State -->
            <div class="quote-empty-card" id="overall-empty">
                <div class="quote-empty-icon">
                    <i class="bi bi-inbox-fill"></i>
                </div>
                <h3>No Bookings Recorded</h3>
                <p>There are no inspection actions reported in the repair register.</p>
            </div>
        @endforelse

        <!-- Tabs Dynamic Empty States -->
        <div class="quote-empty-card" id="awaiting-empty" style="display: none;">
            <div class="quote-empty-icon" style="color: #db2777; background: #fdf2f8;">
                <i class="bi bi-check-circle"></i>
            </div>
            <h3>Everything Processed!</h3>
            <p>No new customer inspections are currently awaiting repair quotation rates.</p>
        </div>

        <div class="quote-empty-card" id="sent-empty" style="display: none;">
            <div class="quote-empty-icon">
                <i class="bi bi-cursor-fill"></i>
            </div>
            <h3>No Quotations Sent</h3>
            <p>No quotations have been Assigned to customers within this list segment.</p>
        </div>
    </div>
</div>

<script>
    // Tab switching controller
    function switchTab(type, button) {
        // Toggle Active Tab Style
        const tabButtons = document.querySelectorAll('.quote-tab-btn');
        tabButtons.forEach(btn => btn.classList.remove('active'));
        button.classList.add('active');

        // Toggle Items Display
        const items = document.querySelectorAll('.booking-item');
        let visibleCount = 0;

        items.forEach(item => {
            if (item.getAttribute('data-type') === type) {
                item.style.display = 'flex';
                visibleCount++;
            } else {
                item.style.display = 'none';
            }
        });

        // Toggle Tab-Specific Empty States
        const overallEmpty = document.getElementById('overall-empty');
        const awaitingEmpty = document.getElementById('awaiting-empty');
        const sentEmpty = document.getElementById('sent-empty');

        if (awaitingEmpty) awaitingEmpty.style.display = 'none';
        if (sentEmpty) sentEmpty.style.display = 'none';

        if (visibleCount === 0) {
            if (type === 'awaiting') {
                if (awaitingEmpty) awaitingEmpty.style.display = 'flex';
            } else {
                if (sentEmpty) sentEmpty.style.display = 'flex';
            }
        }
    }

    document.addEventListener("DOMContentLoaded", function() {
        // Dynamic Count Hydration
        const items = document.querySelectorAll('.booking-item');
        let awaitingCount = 0;
        let sentCount = 0;

        items.forEach(item => {
            if (item.getAttribute('data-type') === 'awaiting') awaitingCount++;
            if (item.getAttribute('data-type') === 'sent') sentCount++;
        });

        const awaitingBadge = document.getElementById('badge-awaiting-count');
        const sentBadge = document.getElementById('badge-sent-count');

        if (awaitingBadge) awaitingBadge.innerText = awaitingCount;
        if (sentBadge) sentBadge.innerText = sentCount;

        // Auto trigger first tab to filter properly
        const activeTab = document.querySelector('.quote-tab-btn.active');
        if (activeTab) {
            activeTab.click();
        }

        // Notification Timeout fading
        const successNotify = document.getElementById('popup-notification');
        if(successNotify) {
            setTimeout(function(){
                successNotify.style.transition = 'opacity 0.5s ease';
                successNotify.style.opacity = '0';
                setTimeout(() => successNotify.style.display = 'none', 500);
            }, 3500);
        }
    });

    function previewPdf(bookingId) {
        const formPrice = parseFloat(document.getElementById('price_' + bookingId).value || 0);
        const price = formPrice + 50;
        const note = document.getElementById('note_' + bookingId).value || '';
        
        let url = "{{ url('/admin/bookings') }}/" + bookingId + "/quotation-pdf";
        url += "?price=" + encodeURIComponent(price) + "&note=" + encodeURIComponent(note);
        
        window.open(url, '_blank');
    }
</script>

@endsection