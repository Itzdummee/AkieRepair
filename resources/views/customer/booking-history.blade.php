@extends('layouts.customer')

@section('title', 'Booking History')

@section('content')

<style>
    .hist-header {
        position: relative;
        background: linear-gradient(135deg, #1e1b4b 0%, #312e81 50%, #4c1d95 100%);
        padding: 44px 40px;
        border-radius: 24px;
        margin-bottom: 28px;
        overflow: hidden;
    }

    .hist-header::before {
        content: '';
        position: absolute;
        top: -80px;
        right: -80px;
        width: 320px;
        height: 320px;
        background: radial-gradient(circle, rgba(167,139,250,.35) 0%, transparent 70%);
        border-radius: 50%;
        pointer-events: none;
    }

    .hist-hdr-inner {
        position: relative;
        z-index: 2;
        display: flex;
        align-items: center;
        gap: 22px;
    }

    .hist-hdr-icon {
        width: 68px;
        height: 68px;
        background: rgba(255,255,255,.12);
        backdrop-filter: blur(6px);
        border: 1px solid rgba(255,255,255,.2);
        border-radius: 18px;
        display: flex;
        align-items: center;
        justify-content: center;
        font-size: 1.9rem;
        color: #a78bfa;
        flex-shrink: 0;
    }

    .hist-hdr-title {
        font-size: 2rem;
        font-weight: 800;
        color: #fff;
        margin: 0 0 5px;
    }

    .hist-hdr-sub {
        font-size: 0.95rem;
        color: #c4b5fd;
        margin: 0;
    }

    .hist-hdr-stats {
        margin-left: auto;
        display: flex;
        gap: 16px;
    }

    .hist-stat {
        background: rgba(255,255,255,.1);
        border: 1px solid rgba(255,255,255,.15);
        border-radius: 12px;
        padding: 12px 18px;
        text-align: center;
        min-width: 80px;
    }

    .hist-stat-val {
        font-size: 1.5rem;
        font-weight: 800;
        color: #fff;
        display: block;
    }

    .hist-stat-lbl {
        font-size: 0.72rem;
        color: #c4b5fd;
        text-transform: uppercase;
        letter-spacing: .08em;
    }

    .hist-filter-card {
        background: #fff;
        border: 1px solid #e5e7eb;
        border-radius: 14px;
        padding: 16px 20px;
        margin-bottom: 20px;
        display: flex;
        flex-wrap: wrap;
        gap: 10px;
        align-items: center;
        box-shadow: 0 2px 8px rgba(0,0,0,.04);
    }

    .hist-search-wrap {
        position: relative;
        flex: 1;
        min-width: 200px;
    }

    .hist-search-wrap i {
        position: absolute;
        left: 12px;
        top: 50%;
        transform: translateY(-50%);
        color: #9ca3af;
        pointer-events: none;
    }

    .hist-search-wrap input {
        width: 100%;
        height: 40px;
        border: 1.5px solid #e5e7eb;
        border-radius: 10px;
        padding: 0 12px 0 36px;
        font-size: 0.88rem;
        color: #111827;
        background: #f9fafb;
        margin: 0;
        box-sizing: border-box;
    }

    .hist-search-wrap input:focus {
        outline: none;
        border-color: #7c3aed;
        background: #fff;
    }

    .hist-chip-wrap {
        display: flex;
        gap: 6px;
        flex-wrap: wrap;
    }

    .hist-chip {
        padding: 6px 14px;
        border: 1.5px solid #e5e7eb;
        border-radius: 50px;
        font-size: 0.8rem;
        font-weight: 600;
        color: #6b7280;
        background: #f9fafb;
        cursor: pointer;
    }

    .hist-chip:hover {
        border-color: #7c3aed;
        color: #7c3aed;
    }

    .hist-chip.active {
        border-color: #7c3aed;
        color: #7c3aed;
        background: #ede9fe;
    }

    .hist-sort-select {
        height: 40px;
        border: 1.5px solid #e5e7eb;
        border-radius: 10px;
        padding: 0 12px;
        font-size: 0.85rem;
        color: #374151;
        background: #f9fafb;
        min-width: 160px;
        margin: 0;
    }

    .hist-sort-select:focus {
        outline: none;
        border-color: #7c3aed;
    }

    .hist-reset-btn {
        height: 40px;
        padding: 0 14px;
        border: 1.5px solid #e5e7eb;
        border-radius: 10px;
        background: #fff;
        color: #6b7280;
        font-size: 0.82rem;
        font-weight: 600;
        cursor: pointer;
        display: flex;
        align-items: center;
        gap: 6px;
    }

    .hist-reset-btn:hover {
        border-color: #ef4444;
        color: #ef4444;
    }

    .hist-result-info {
        font-size: 0.84rem;
        color: #6b7280;
        margin-bottom: 12px;
    }

    .hist-result-info b {
        color: #111827;
    }

    .hist-table-wrap {
        background: #fff;
        border: 1px solid #e5e7eb;
        border-radius: 16px;
        overflow-x: auto;
        box-shadow: 0 4px 16px rgba(0,0,0,.05);
    }

    .hist-table {
        width: 100%;
        min-width: 980px;
        border-collapse: collapse;
        table-layout: fixed;
    }

    .hist-table th,
    .hist-table td {
        box-sizing: border-box;
        vertical-align: middle;
    }

    .hist-table thead {
        background: #f5f3ff;
    }

    .hist-table th {
        padding: 14px 12px;
        font-size: 0.73rem;
        font-weight: 800;
        color: #7c3aed;
        text-transform: uppercase;
        letter-spacing: .08em;
        white-space: nowrap;
        border-bottom: 2px solid #ede9fe;
        line-height: 1.2;
    }

    .hist-table td {
        padding: 13px 12px;
        font-size: 0.86rem;
        color: #374151;
        border-bottom: 1px solid #f3f4f6;
        line-height: 1.35;
        overflow: hidden;
    }

    .hist-table tbody tr:last-child td {
        border-bottom: none;
    }

    .hist-table tbody tr:hover {
        background: #faf9ff;
    }

    .hist-table tbody tr.history-row {
        display: table-row;
    }

    .hist-col-id {
        width: 75px;
    }

    .hist-col-device {
        width: 300px;
    }

    .hist-col-date {
        width: 140px;
    }

    .hist-col-amount {
        width: 145px;
    }

    .hist-col-tech {
        width: 180px;
    }

    .hist-col-status {
        width: 170px;
    }

    .hist-col-action {
        width: 190px;
    }

    .hist-text-left {
        text-align: left !important;
    }

    .hist-text-center {
        text-align: center !important;
    }

    .hist-cell-stack {
        display: flex;
        flex-direction: column;
        align-items: flex-start;
        gap: 5px;
        min-width: 0;
        width: 100%;
    }

    .hist-dev-name {
        font-weight: 700;
        color: #111827;
        line-height: 1.2;
        max-width: 100%;
        overflow: hidden;
        text-overflow: ellipsis;
        white-space: nowrap;
        display: block;
    }

    .hist-dev-brand {
        display: inline-flex;
        align-items: center;
        font-size: 0.78rem;
        color: #7c3aed;
        background: #ede9fe;
        padding: 2px 8px;
        border-radius: 50px;
        font-weight: 600;
        max-width: 100%;
        overflow: hidden;
        text-overflow: ellipsis;
        white-space: nowrap;
    }

    .hist-tech-name {
        display: block;
        max-width: 100%;
        overflow: hidden;
        text-overflow: ellipsis;
        white-space: nowrap;
    }

    .hist-amt-paid {
        font-weight: 800;
        color: #15803d;
        white-space: nowrap;
    }

    .hist-status-badge {
        display: inline-flex;
        align-items: center;
        justify-content: center;
        gap: 5px;
        padding: 5px 11px;
        border-radius: 50px;
        font-size: 0.74rem;
        font-weight: 700;
        white-space: nowrap;
        max-width: 100%;
    }

    .hist-status-green {
        background: #dcfce7;
        color: #166534;
    }

    .hist-status-red {
        background: #fee2e2;
        color: #991b1b;
    }

    .hist-status-gray {
        background: #f3f4f6;
        color: #4b5563;
    }

    .hist-action-stack {
        display: flex;
        justify-content: center;
        gap: 8px;
        flex-wrap: wrap;
    }

    .hist-detail-btn {
        display: inline-flex;
        align-items: center;
        justify-content: center;
        gap: 5px;
        background: #ede9fe;
        color: #6d28d9;
        border: 1px solid #ddd6fe;
        border-radius: 8px;
        padding: 7px 12px;
        font-size: 0.8rem;
        font-weight: 700;
        text-decoration: none;
        white-space: nowrap;
    }

    .hist-detail-btn:hover {
        background: #7c3aed;
        color: #fff;
        border-color: #7c3aed;
    }

    .hist-review-btn {
        display: inline-flex;
        align-items: center;
        justify-content: center;
        gap: 5px;
        background: #dcfce7;
        color: #166534;
        border: 1px solid #bbf7d0;
        border-radius: 8px;
        padding: 7px 12px;
        font-size: 0.8rem;
        font-weight: 700;
        text-decoration: none;
        white-space: nowrap;
    }

    .hist-review-btn:hover {
        background: #16a34a;
        color: #fff;
        border-color: #16a34a;
    }

    .hist-empty-block {
        text-align: center;
        padding: 60px 24px;
        color: #9ca3af;
    }

    .hist-empty-block i {
        font-size: 2.5rem;
        display: block;
        margin-bottom: 14px;
        color: #d1d5db;
    }

    .hist-empty-block h3 {
        color: #374151;
        margin: 0 0 8px;
    }

    .hist-empty-block p {
        margin: 0;
        font-size: 0.88rem;
    }

    @media(max-width: 768px) {
        .hist-header {
            padding: 28px 24px;
        }

        .hist-hdr-inner {
            align-items: flex-start;
        }

        .hist-hdr-stats {
            display: none;
        }

        .hist-hdr-title {
            font-size: 1.6rem;
        }

        .hist-filter-card {
            flex-direction: column;
            align-items: stretch;
        }

        .hist-search-wrap,
        .hist-sort-select,
        .hist-reset-btn {
            width: 100%;
        }

        .hist-chip-wrap {
            width: 100%;
        }
    }
</style>

@php
    $totalCompleted = $bookings->where('status', 'Repair Completed')->count();
    $totalRejected  = $bookings->where('status', 'Quotation Rejected')->count();
    $totalAmount    = $bookings->where('payment_status', 'Paid')->sum('amount_paid');
@endphp

<div class="hist-header">
    <div class="hist-hdr-inner">
        <div class="hist-hdr-icon">
            <i class="bi bi-clock-history"></i>
        </div>

        <div>
            <h1 class="hist-hdr-title">Booking History</h1>
            <p class="hist-hdr-sub">All your past repair records in one place.</p>
        </div>

        <div class="hist-hdr-stats">
            <div class="hist-stat">
                <span class="hist-stat-val">{{ $totalCompleted }}</span>
                <span class="hist-stat-lbl">Completed</span>
            </div>

            <div class="hist-stat">
                <span class="hist-stat-val">{{ $totalRejected }}</span>
                <span class="hist-stat-lbl">Rejected</span>
            </div>

            <div class="hist-stat">
                <span class="hist-stat-val">RM {{ number_format($totalAmount, 0) }}</span>
                <span class="hist-stat-lbl">Total Paid</span>
            </div>
        </div>
    </div>
</div>

@if($bookings->count())

<div class="hist-filter-card">
    <div class="hist-search-wrap">
        <i class="bi bi-search"></i>
        <input type="search" id="historySearchInput" placeholder="Search device, technician, amount..." autocomplete="off">
    </div>

    <div class="hist-chip-wrap">
        <button type="button" class="hist-chip active" data-status="">All</button>
        <button type="button" class="hist-chip" data-status="Repair Completed">✅ Completed</button>
        <button type="button" class="hist-chip" data-status="Quotation Rejected">❌ Rejected</button>
    </div>

    <select id="historySortSelect" class="hist-sort-select">
        <option value="newest">Newest First</option>
        <option value="oldest">Oldest First</option>
        <option value="amount_high">Amount (High)</option>
        <option value="amount_low">Amount (Low)</option>
    </select>

    <button type="button" class="hist-reset-btn" id="historyResetBtn">
        <i class="bi bi-x-lg"></i> Clear
    </button>
</div>

<div class="hist-result-info" id="historyFilterInfo"></div>

<div class="hist-table-wrap">
    <table class="hist-table">
        <colgroup>
            <col class="hist-col-id">
            <col class="hist-col-device">
            <col class="hist-col-date">
            <col class="hist-col-amount">
            <col class="hist-col-tech">
            <col class="hist-col-status">
            <col class="hist-col-action">
        </colgroup>

        <thead>
            <tr>
                <th class="hist-text-center">#</th>
                <th class="hist-text-left">Device</th>
                <th class="hist-text-center">Date</th>
                <th class="hist-text-center">Amount</th>
                <th class="hist-text-center">Technician</th>
                <th class="hist-text-center">Status</th>
                <th class="hist-text-center">Action</th>
            </tr>
        </thead>

        <tbody id="historyTableBody">
            @foreach($bookings as $booking)
                @php
                    $s = $booking->status ?? '';
                    $lowerStatus = strtolower($s);

                    if (str_contains($lowerStatus, 'reject') || str_contains($lowerStatus, 'cancel')) {
                        [$cls, $sicon, $slabel] = ['hist-status-red', 'bi-x-circle-fill', 'Rejected'];
                    } elseif (str_contains($lowerStatus, 'complet') || str_contains($lowerStatus, 'paid')) {
                        [$cls, $sicon, $slabel] = ['hist-status-green', 'bi-patch-check-fill', 'Completed'];
                    } else {
                        [$cls, $sicon, $slabel] = ['hist-status-gray', 'bi-circle', $s ?: 'Pending'];
                    }
                @endphp

                <tr class="history-row"
                    data-status="{{ $booking->status }}"
                    data-date="{{ $booking->created_at->timestamp }}"
                    data-amount="{{ $booking->amount_paid ?? 0 }}"
                    data-search="{{ strtolower(($booking->device->name ?? '') . ' ' . ($booking->device->brand ?? '') . ' ' . ($booking->technician->name ?? '') . ' ' . ($booking->amount_paid ?? '') . ' ' . $booking->id) }}">

                    <td class="hist-text-center" style="font-weight:800; color:#4c1d95;">
                        #{{ $booking->id }}
                    </td>

                    <td class="hist-text-left">
                        <div class="hist-cell-stack">
                            <span class="hist-dev-name">{{ $booking->device->name ?? '—' }}</span>

                            @if($booking->device->brand ?? false)
                                <span class="hist-dev-brand">{{ $booking->device->brand }}</span>
                            @endif
                        </div>
                    </td>

                    <td class="hist-text-center">
                        {{ $booking->created_at->format('d M Y') }}
                    </td>

                    <td class="hist-text-center">
                        @if($booking->payment_status === 'Paid')
                            <span class="hist-amt-paid">RM {{ number_format($booking->amount_paid, 2) }}</span>
                        @else
                            <span style="color:#d1d5db;">—</span>
                        @endif
                    </td>

                    <td class="hist-text-center">
                        <span class="hist-tech-name">{{ $booking->technician->name ?? '—' }}</span>
                    </td>

                    <td class="hist-text-center">
                        <span class="hist-status-badge {{ $cls }}">
                            <i class="bi {{ $sicon }}"></i> {{ $slabel }}
                        </span>
                    </td>

                    <td class="hist-text-center">
                        <div class="hist-action-stack">
                            <a href="{{ route('customer.booking.show', $booking->id) }}" class="hist-detail-btn">
                                <i class="bi bi-eye-fill"></i> View
                            </a>

                            @if($booking->status === 'Repair Completed' && $booking->payment_status === 'Paid' && ! $booking->review)
                                <a href="{{ route('customer.review.create', $booking->id) }}" class="hist-review-btn">
                                    <i class="bi bi-star-fill"></i> Review
                                </a>
                            @endif
                        </div>
                    </td>
                </tr>
            @endforeach

            <tr id="historyNoResultsRow" style="display:none;">
                <td colspan="7">
                    <div class="hist-empty-block">
                        <i class="bi bi-search"></i>
                        <h3>No results found</h3>
                        <p>Try adjusting your search or filter.</p>
                    </div>
                </td>
            </tr>
        </tbody>
    </table>
</div>

<script>
    (() => {
        const searchInput = document.getElementById('historySearchInput');
        const sortSelect  = document.getElementById('historySortSelect');
        const resetBtn    = document.getElementById('historyResetBtn');
        const tbody       = document.getElementById('historyTableBody');
        const filterInfo  = document.getElementById('historyFilterInfo');
        const noResults   = document.getElementById('historyNoResultsRow');
        const chips       = document.querySelectorAll('.hist-chip');

        let activeStatus = '';

        chips.forEach(chip => {
            chip.addEventListener('click', () => {
                chips.forEach(c => c.classList.remove('active'));
                chip.classList.add('active');

                activeStatus = chip.dataset.status;
                applyHistoryFilters();
            });
        });

        function applyHistoryFilters() {
            const search = searchInput.value.toLowerCase().trim();
            const sort = sortSelect.value;
            const rows = Array.from(tbody.querySelectorAll('tr.history-row'));

            let visibleRows = rows.filter(row => {
                const matchStatus = !activeStatus || row.dataset.status === activeStatus;
                const matchSearch = !search || row.dataset.search.includes(search);

                return matchStatus && matchSearch;
            });

            visibleRows.sort((a, b) => {
                const dateA = Number(a.dataset.date);
                const dateB = Number(b.dataset.date);
                const amountA = Number(a.dataset.amount);
                const amountB = Number(b.dataset.amount);

                if (sort === 'newest') return dateB - dateA;
                if (sort === 'oldest') return dateA - dateB;
                if (sort === 'amount_high') return amountB - amountA;
                if (sort === 'amount_low') return amountA - amountB;

                return 0;
            });

            rows.forEach(row => {
                row.style.display = 'none';
            });

            visibleRows.forEach(row => {
                row.style.display = '';
                tbody.appendChild(row);
            });

            tbody.appendChild(noResults);
            noResults.style.display = visibleRows.length === 0 ? '' : 'none';

            const totalRows = rows.length;

            filterInfo.innerHTML = (search || activeStatus)
                ? `Showing <b>${visibleRows.length}</b> of <b>${totalRows}</b> records`
                : `<b>${totalRows}</b> total records`;
        }

        searchInput.addEventListener('input', applyHistoryFilters);
        sortSelect.addEventListener('change', applyHistoryFilters);

        resetBtn.addEventListener('click', () => {
            searchInput.value = '';
            activeStatus = '';
            sortSelect.value = 'newest';

            chips.forEach(chip => chip.classList.remove('active'));
            chips[0].classList.add('active');

            applyHistoryFilters();
        });

        applyHistoryFilters();
    })();
</script>

@else

<div class="hist-table-wrap">
    <div class="hist-empty-block" style="padding:80px 24px;">
        <i class="bi bi-clock-history"></i>
        <h3>No booking history yet</h3>
        <p>Once your repairs are completed, they'll appear here.</p>
    </div>
</div>

@endif

@endsection
