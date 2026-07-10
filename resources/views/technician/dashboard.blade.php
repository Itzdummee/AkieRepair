@extends('layouts.technician')

@section('title', 'Technician Dashboard')

@section('content')

<style>
    .modern-header {
        position: relative;
        background: linear-gradient(135deg, #0f5132, #145c45);
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
        background: linear-gradient(135deg, #34d399, #0f5132);
        width: 72px;
        height: 72px;
        border-radius: 20px;
        display: flex;
        align-items: center;
        justify-content: center;
        font-size: 2rem;
        color: white;
        box-shadow: 0 10px 15px -3px rgba(15, 81, 50, 0.4);
        flex-shrink: 0;
    }
    .modern-header .header-title {
        font-size: 2.2rem;
        font-weight: 800;
        margin: 0 0 8px 0;
        letter-spacing: -0.025em;
        color: #ffffff;
    }
    .modern-header .header-subtitle {
        font-size: 1.05rem;
        color: #d1fae5;
        margin: 0;
        max-width: 650px;
        line-height: 1.5;
    }
    .modern-header .header-decoration {
        position: absolute;
        top: -50%;
        right: -10%;
        width: 400px;
        height: 400px;
        background: radial-gradient(circle, rgba(52, 211, 153, 0.18) 0%, rgba(15, 81, 50, 0) 70%);
        border-radius: 50%;
        z-index: 1;
        pointer-events: none;
    }

    .stats-grid {
        display: grid;
        grid-template-columns: repeat(4, 1fr);
        gap: 24px;
        margin-bottom: 35px;
    }
    .stat-card {
        background: white;
        border: 1px solid #e5e7eb;
        border-radius: 12px;
        padding: 24px;
        display: flex;
        align-items: center;
        justify-content: space-between;
        box-shadow: var(--shadow);
        position: relative;
        overflow: hidden;
    }
    
    /* Bottom accent lines matching the color coding */
    .stat-card::after {
        content: "";
        position: absolute;
        bottom: 0;
        left: 0;
        right: 0;
        height: 4px;
    }
    .stat-card.blue::after { background: var(--blue); }
    .stat-card.orange::after { background: #f97316; }
    .stat-card.purple::after { background: #8b5cf6; }
    .stat-card.green::after { background: var(--green); }

    .stat-card p {
        color: var(--muted);
        font-size: 14px;
        text-transform: uppercase;
        letter-spacing: 0.05em;
        font-weight: 600;
        margin-bottom: 4px;
    }
    .stat-card h3 {
        font-family: Arial, sans-serif;
        font-size: 34px;
        color: #111827;
        font-weight: 700;
    }
    .stat-icon {
        width: 52px;
        height: 52px;
        border-radius: 10px;
        display: grid;
        place-items: center;
        color: white;
        font-size: 22px;
        box-shadow: 0 8px 16px rgba(0,0,0,0.1);
    }
    .stat-icon.blue { background: var(--blue); }
    .stat-icon.orange { background: #f97316; }
    .stat-icon.purple { background: #8b5cf6; }
    .stat-icon.green { background: var(--green); }

    .content-grid {
        display: grid;
        grid-template-columns: 2fr 1fr;
        gap: 30px;
        align-items: start;
    }

    .panel {
        background: white;
        border-radius: 16px;
        padding: 30px;
        box-shadow: var(--shadow);
        border: 1px solid #e5e7eb;
        margin-bottom: 30px;
    }
    .panel h2 {
        font-size: 24px;
        color: #111827;
        margin-bottom: 25px;
        font-family: 'Playfair Display', serif;
    }

    .inspection-layout {
        display: grid;
        grid-template-columns: 320px minmax(0, 1fr);
        gap: 18px;
        align-items: start;
    }
    .booking-list-panel {
        background: #f8fafc;
        border: 1px solid #e2e8f0;
        border-radius: 14px;
        padding: 12px;
    }
    .booking-list {
        display: flex;
        flex-direction: column;
        gap: 10px;
        max-height: 640px;
        overflow-y: auto;
        padding-right: 4px;
    }
    .booking-list-item {
        width: 100%;
        border: 1px solid #e2e8f0;
        background: white;
        border-radius: 12px;
        padding: 14px;
        text-align: left;
        cursor: pointer;
        transition: all 0.2s ease;
        display: flex;
        align-items: center;
        justify-content: space-between;
        gap: 10px;
    }
    .booking-list-item:hover {
        border-color: #bfdbfe;
        background: #f8fbff;
    }
    .booking-list-item.active {
        background: #eff6ff;
        border-color: #93c5fd;
        box-shadow: inset 0 0 0 1px #bfdbfe;
    }
    .booking-list-left {
        display: flex;
        flex-direction: column;
        gap: 3px;
        min-width: 0;
    }
    .booking-list-id {
        font-size: 11px;
        font-weight: 800;
        text-transform: uppercase;
        letter-spacing: 0.08em;
        color: #2563eb;
    }
    .booking-list-left strong {
        font-size: 14px;
        color: #111827;
        white-space: nowrap;
        overflow: hidden;
        text-overflow: ellipsis;
    }
    .booking-list-left span {
        font-size: 13px;
        color: #64748b;
        white-space: nowrap;
        overflow: hidden;
        text-overflow: ellipsis;
    }
    .booking-list-right {
        display: flex;
        align-items: center;
        gap: 8px;
        color: #64748b;
        font-size: 12px;
        flex-shrink: 0;
    }

    .assigned-bookings-grid {
        display: grid;
        grid-template-columns: repeat(auto-fill, minmax(260px, 1fr));
        gap: 16px;
    }
    .assigned-booking-card {
        display: flex;
        flex-direction: column;
        min-height: 240px;
        color: inherit;
        text-decoration: none;
        background: #ffffff;
        border: 1px solid #e2e8f0;
        border-radius: 14px;
        padding: 18px;
        transition: transform 0.2s ease, box-shadow 0.2s ease, border-color 0.2s ease;
        position: relative;
        overflow: hidden;
    }
    .assigned-booking-card::before {
        content: "";
        position: absolute;
        top: 0;
        left: 0;
        right: 0;
        height: 4px;
        background: linear-gradient(90deg, #2563eb, #10b981);
    }
    .assigned-booking-card:hover {
        transform: translateY(-3px);
        border-color: #93c5fd;
        box-shadow: 0 14px 24px rgba(15, 23, 42, 0.08);
    }
    .assigned-booking-top {
        display: flex;
        align-items: flex-start;
        justify-content: space-between;
        gap: 12px;
        margin-bottom: 18px;
    }
    .assigned-booking-id {
        color: #2563eb;
        font-size: 12px;
        font-weight: 800;
        letter-spacing: 0.08em;
        text-transform: uppercase;
    }
    .assigned-booking-card h3 {
        color: #111827;
        font-size: 19px;
        margin: 5px 0 0;
        font-family: 'Mukta Mahee', sans-serif;
        line-height: 1.2;
    }
    .assigned-booking-icon {
        width: 42px;
        height: 42px;
        border-radius: 10px;
        display: grid;
        place-items: center;
        background: #eff6ff;
        color: #2563eb;
        flex-shrink: 0;
    }
    .assigned-booking-meta {
        display: grid;
        gap: 10px;
        margin-bottom: 18px;
    }
    .assigned-booking-meta div {
        display: flex;
        gap: 8px;
        color: #475569;
        font-size: 14px;
        line-height: 1.35;
    }
    .assigned-booking-meta i {
        color: #64748b;
        margin-top: 2px;
        flex-shrink: 0;
    }
    .assigned-booking-action {
        margin-top: auto;
        display: flex;
        align-items: center;
        justify-content: space-between;
        gap: 12px;
        padding-top: 16px;
        border-top: 1px solid #f1f5f9;
        color: #2563eb;
        font-size: 13px;
        font-weight: 800;
        text-transform: uppercase;
        letter-spacing: 0.05em;
    }
    .inspection-pager {
        display: flex;
        align-items: center;
        justify-content: space-between;
        gap: 14px;
        margin-top: 18px;
        padding-top: 18px;
        border-top: 1px solid #e2e8f0;
    }
    .inspection-page-status {
        color: #64748b;
        font-size: 14px;
        font-weight: 700;
    }
    .inspection-pager-actions {
        display: flex;
        gap: 8px;
    }
    .inspection-pager-btn {
        width: 42px;
        height: 42px;
        border: 1px solid #cbd5e1;
        border-radius: 10px;
        display: inline-flex;
        align-items: center;
        justify-content: center;
        background: #ffffff;
        color: #0f5132;
        cursor: pointer;
        transition: all 0.2s ease;
        font-size: 18px;
    }
    .inspection-pager-btn:hover:not(:disabled) {
        background: #ecfdf5;
        border-color: #86efac;
        transform: translateY(-1px);
    }
    .inspection-pager-btn:disabled {
        opacity: 0.45;
        cursor: not-allowed;
    }
    .inspection-card-paged.is-hidden {
        display: none;
    }

    .booking-card {
        border: 1px solid #e5e7eb;
        border-radius: 14px;
        padding: 24px;
        background: #ffffff;
        transition: .3s;
        box-shadow: 0 4px 6px rgba(0,0,0,0.02);
        display: none;
    }
    .booking-card.active {
        display: block;
    }
    .booking-top {
        display: flex;
        justify-content: space-between;
        align-items: center;
        margin-bottom: 18px;
        gap: 12px;
    }
    .badge {
        padding: 6px 12px;
        border-radius: 50px;
        font-size: 11px;
        font-weight: 700;
        text-transform: uppercase;
        letter-spacing: .05em;
    }
    
    .booking-info p {
        margin-bottom: 10px;
        font-size: 15px;
        color: #4b5563;
        display: flex;
        align-items: flex-start;
        gap: 8px;
    }
    .booking-info p strong {
        color: #111827;
        font-weight: 600;
        width: 140px;
        flex-shrink: 0;
    }


    /* Form Styles */
    label {
        display: block;
        font-weight: 700;
        color: #111827;
        margin-bottom: 8px;
        font-size: 14px;
    }
    textarea, select, input {
        width: 100%;
        border: 1px solid #cbd5e1;
        border-radius: 8px;
        padding: 12px;
        font-family: 'Mukta Mahee', sans-serif;
        font-size: 15px;
        color: #1f2937;
        background-color: #fff;
        transition: border-color 0.2s, box-shadow 0.2s;
        margin-bottom: 12px;
    }
    textarea:focus, select:focus, input:focus {
        outline: none;
        border-color: var(--blue);
        box-shadow: 0 0 0 3px rgba(37, 99, 235, 0.15);
    }

    .btn {
        border: none;
        border-radius: 8px;
        padding: 10px 20px;
        font-weight: 700;
        color: white;
        cursor: pointer;
        transition: all 0.2s ease;
        display: inline-flex;
        align-items: center;
        gap: 8px;
        font-size: 13px;
        text-transform: uppercase;
        letter-spacing: 0.05em;
    }
    .btn:hover {
        transform: translateY(-1px);
        box-shadow: 0 4px 12px rgba(0,0,0,0.1);
    }
    .btn-blue { background: var(--blue); }
    .btn-blue:hover { background: #1d4ed8; }
    .btn-green { background: var(--green); }
    .btn-green:hover { background: #15803d; }
    .btn-red { background: var(--red); }
    .btn-red:hover { background: #b91c1c; }

    /* Repair options grid (inspection checklist) */
    .repair-options-grid {
        display: grid;
        grid-template-columns: repeat(auto-fill, minmax(190px, 1fr));
        gap: 12px;
        margin-bottom: 20px;
        margin-top: 8px;
    }
    .repair-option-card {
        cursor: pointer;
        display: block;
        margin: 0;
    }
    .repair-checkbox {
        display: none;
    }
    .repair-card-content {
        border: 1px solid #e2e8f0;
        border-radius: 8px;
        padding: 14px;
        display: flex;
        flex-direction: column;
        gap: 8px;
        transition: all 0.2s ease;
        background: #f8fafc;
        position: relative;
        height: 100%;
        box-sizing: border-box;
    }
    .repair-checkbox:checked + .repair-card-content {
        border-color: var(--blue);
        background: #eff6ff;
        box-shadow: 0 4px 6px -1px rgba(59, 130, 246, 0.1);
    }
    .repair-checkbox:checked + .repair-card-content .repair-name {
        color: #1d4ed8;
    }
    .repair-checkbox:checked + .repair-card-content .checkbox-indicator {
        opacity: 1;
        transform: scale(1);
        color: var(--blue);
    }
    .repair-name {
        font-weight: 700;
        color: #374151;
        font-size: 14px;
        line-height: 1.3;
        padding-right: 20px;
    }
    .repair-price {
        color: var(--green);
        font-weight: 700;
        font-size: 14px;
        margin-top: auto;
    }
    .checkbox-indicator {
        position: absolute;
        top: 14px;
        right: 14px;
        opacity: 0;
        transform: scale(0.5);
        transition: all 0.2s ease;
        font-size: 16px;
    }

    .availability-item {
        display: flex;
        justify-content: space-between;
        align-items: center;
        padding: 14px 18px;
        border-radius: 10px;
        background: #fff8e1;
        border: 1px solid #ffe082;
        margin-bottom: 12px;
        color: #795548;
    }

    @media(max-width: 1100px) {
        .stats-grid {
            grid-template-columns: repeat(2, 1fr);
        }
        .content-grid {
            grid-template-columns: 1fr;
        }
    }
    @media(max-width: 600px) {
        .stats-grid {
            grid-template-columns: 1fr;
        }
    }
</style>

<div class="modern-header">
    <div class="header-content">
        <div class="icon-wrapper">
            <i class="bi bi-person-badge-fill"></i>
        </div>
        <div>
            <h1 class="header-title">Welcome back, {{ Auth::user()->name ?? 'Technician' }}</h1>
            <p class="header-subtitle">System overview, inspection sheets, active repairs and calendar status.</p>
        </div>
    </div>
    <div class="header-decoration"></div>
</div>

<div class="stats-grid">

    <div class="stat-card blue">
        <div>
            <p>Total Assigned</p>
            <h3>{{ $totalAssigned }}</h3>
        </div>
        <div class="stat-icon blue">
            <i class="bi bi-clipboard-check"></i>
        </div>
    </div>

    <div class="stat-card orange">
        <div>
            <p>Inspection Pending</p>
            <h3>{{ $inspectionPending }}</h3>
        </div>
        <div class="stat-icon orange">
            <i class="bi bi-search"></i>
        </div>
    </div>

    <div class="stat-card purple">
        <div>
            <p>In Progress</p>
            <h3>{{ $inProgress }}</h3>
        </div>
        <div class="stat-icon purple">
            <i class="bi bi-wrench-adjustable"></i>
        </div>
    </div>

    <div class="stat-card green">
        <div>
            <p>Completed</p>
            <h3>{{ $completed }}</h3>
        </div>
        <div class="stat-icon green">
            <i class="bi bi-check-circle"></i>
        </div>
    </div>

</div>



{{-- ============================================================
     INSPECTION BOOKINGS (Technician Assigned)
     ============================================================ --}}
<div class="content-grid">

    <section class="panel">
        <h2 style="display:flex; align-items:center; gap:10px;">
            <span style="background:#2563eb; color:white; border-radius:8px; width:32px; height:32px; display:inline-flex; align-items:center; justify-content:center;">
                <i class="bi bi-search" style="font-size:16px;"></i>
            </span>
            Inspection Bookings
        </h2>

        @php
            $inspectionBookings = $bookings->where('status', 'Technician Assigned');
        @endphp

        @if($inspectionBookings->isEmpty())
            <div style="text-align:center; padding:45px 20px; color:#9ca3af; border:1px dashed #cbd5e1; border-radius:12px;">
                <i class="bi bi-inbox" style="font-size:2.5rem; margin-bottom:12px; display:block; color:#9ca3af;"></i>
                <p style="margin:0; font-weight:600;">No inspection bookings assigned.</p>
            </div>
        @else
            <div class="assigned-bookings-grid" id="inspectionBookingsGrid">
                @foreach($inspectionBookings->values() as $index => $booking)
                    <a href="{{ route('technician.bookings.inspection.show', $booking->id) }}"
                       class="assigned-booking-card inspection-card-paged {{ $index >= 4 ? 'is-hidden' : '' }}"
                       data-inspection-card>
                        <div class="assigned-booking-top">
                            <div>
                                <span class="assigned-booking-id">Booking #{{ $booking->id }}</span>
                                <h3>{{ $booking->customer->name ?? '-' }}</h3>
                            </div>
                            <div class="assigned-booking-icon">
                                <i class="bi bi-clipboard-pulse"></i>
                            </div>
                        </div>

                        <div class="assigned-booking-meta">
                            <div>
                                <i class="bi bi-phone"></i>
                                <span>{{ $booking->device->name ?? '-' }} - {{ $booking->device->brand ?? '-' }}</span>
                            </div>
                            <div>
                                <i class="bi bi-calendar-event"></i>
                                <span>{{ $booking->visit_date ? \Carbon\Carbon::parse($booking->visit_date)->format('d M Y') : '-' }}</span>
                            </div>
                            <div>
                                <i class="bi bi-chat-left-text"></i>
                                <span>{{ \Illuminate\Support\Str::limit($booking->problem_description, 95) }}</span>
                            </div>
                        </div>

                        <div class="assigned-booking-action">
                            <span>Set inspection problem</span>
                            <i class="bi bi-arrow-right-circle-fill"></i>
                        </div>
                    </a>
                @endforeach
            </div>

            @if($inspectionBookings->count() > 4)
                <div class="inspection-pager" data-inspection-pager>
                    <div class="inspection-page-status" data-inspection-page-status></div>
                    <div class="inspection-pager-actions">
                        <button type="button" class="inspection-pager-btn" data-inspection-prev aria-label="Previous inspection bookings">
                            <i class="bi bi-arrow-left"></i>
                        </button>
                        <button type="button" class="inspection-pager-btn" data-inspection-next aria-label="Next inspection bookings">
                            <i class="bi bi-arrow-right"></i>
                        </button>
                    </div>
                </div>
            @endif
        @endif
    </section>

    <aside>
        <section class="panel">
            <h2 style="font-size:20px; font-family:'Playfair Display', serif;"><i class="bi bi-calendar2-x"></i> Unavailable Dates</h2>

            <div style="max-height: 280px; overflow-y: auto; padding-right: 4px;">
                @forelse($unavailableDates as $availability)
                    <div class="availability-item">
                        <div>
                            <strong style="font-size: 14px;">
                                <i class="bi bi-calendar-x" style="margin-right: 6px; color: #e65100;"></i>
                                {{ $availability->display_date_range }}
                            </strong>
                            <p style="font-size:12px; color:#8d6e63; margin-top:2px; margin-bottom:0;">
                                {{ $availability->reason ?? 'No reason specified' }}
                            </p>
                        </div>
                    </div>
                @empty
                    <p style="color:#6b7280; font-size: 14px; text-align: center; padding: 20px 0;">
                        <i class="bi bi-calendar-check" style="font-size:1.5rem; display:block; margin-bottom:6px; color:#9ca3af;"></i>
                        No off-days set.
                    </p>
                @endforelse
            </div>

            <div style="margin-top: 20px;">
                <a href="{{ route('technician.availability') }}"
                   style="display: flex; align-items: center; justify-content: center; gap: 8px;
                          background: #2563eb; color: white; padding: 10px 16px; border-radius: 8px;
                          font-weight: 700; font-size: 13px; text-decoration: none; text-transform: uppercase;
                          letter-spacing: 0.05em; transition: background 0.2s;"
                   onmouseover="this.style.background='#1d4ed8'"
                   onmouseout="this.style.background='#2563eb'">
                    <i class="bi bi-calendar-week"></i> Manage Availability
                </a>
            </div>
        </section>
    </aside>

</div>

<script>
document.addEventListener('DOMContentLoaded', function () {
    const cards = Array.from(document.querySelectorAll('[data-inspection-card]'));
    const pager = document.querySelector('[data-inspection-pager]');

    if (!pager || cards.length <= 4) {
        return;
    }

    const pageSize = 4;
    let page = 0;
    const totalPages = Math.ceil(cards.length / pageSize);
    const prevButton = document.querySelector('[data-inspection-prev]');
    const nextButton = document.querySelector('[data-inspection-next]');
    const status = document.querySelector('[data-inspection-page-status]');

    function renderInspectionPage() {
        const start = page * pageSize;
        const end = start + pageSize;

        cards.forEach((card, index) => {
            card.classList.toggle('is-hidden', index < start || index >= end);
        });

        prevButton.disabled = page === 0;
        nextButton.disabled = page === totalPages - 1;
        status.textContent = 'Showing ' + (start + 1) + '-' + Math.min(end, cards.length) + ' of ' + cards.length + ' assigned bookings';
    }

    prevButton.addEventListener('click', function () {
        if (page > 0) {
            page -= 1;
            renderInspectionPage();
        }
    });

    nextButton.addEventListener('click', function () {
        if (page < totalPages - 1) {
            page += 1;
            renderInspectionPage();
        }
    });

    renderInspectionPage();
});
</script>

@endsection
