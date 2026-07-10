@extends('layouts.admin')

@section('title', 'Send Quotation')

@section('content')

<style>
    .quote-page {
        display: flex;
        flex-direction: column;
        gap: 18px;
    }

    .quote-header-panel {
        background: #ffffff;
        border: 1px solid #e5e7eb;
        border-radius: 18px;
        padding: 22px 24px;
        display: grid;
        grid-template-columns: 1fr auto;
        gap: 18px;
        align-items: center;
        box-shadow: 0 10px 28px rgba(15, 23, 42, 0.06);
    }

    .quote-title-area h1 {
        font-family: 'Playfair Display', serif;
        font-size: 28px;
        font-weight: 800;
        color: #111827;
        margin: 0 0 6px;
    }

    .quote-title-area p {
        color: #6b7280;
        font-size: 14px;
        margin: 0;
    }

    .quote-summary {
        display: flex;
        gap: 12px;
        flex-wrap: wrap;
        justify-content: flex-end;
    }

    .quote-summary-card {
        min-width: 124px;
        padding: 13px 16px;
        border-radius: 15px;
        background: #f8fafc;
        border: 1px solid #e5e7eb;
    }

    .quote-summary-card span {
        display: block;
        font-size: 11px;
        font-weight: 800;
        color: #94a3b8;
        text-transform: uppercase;
        letter-spacing: .06em;
    }

    .quote-summary-card strong {
        display: block;
        margin-top: 3px;
        color: #111827;
        font-size: 22px;
        line-height: 1;
    }

    .quote-toolbar {
        background: #ffffff;
        border: 1px solid #e5e7eb;
        border-radius: 16px;
        padding: 14px;
        display: grid;
        grid-template-columns: 1fr auto;
        gap: 14px;
        align-items: center;
    }

    .quote-filter-group {
        display: flex;
        flex-wrap: wrap;
        gap: 10px;
    }

    .quote-filter-btn {
        border: 1px solid #e5e7eb;
        background: #ffffff;
        color: #475569;
        border-radius: 999px;
        padding: 10px 15px;
        font-size: 13px;
        font-weight: 800;
        cursor: pointer;
        transition: .2s ease;
        display: inline-flex;
        align-items: center;
        gap: 7px;
    }

    .quote-filter-btn:hover,
    .quote-filter-btn.active {
        background: #111827;
        border-color: #111827;
        color: #ffffff;
    }

    .quote-search-box {
        position: relative;
        width: 300px;
    }

    .quote-search-box i {
        position: absolute;
        left: 13px;
        top: 50%;
        transform: translateY(-50%);
        color: #94a3b8;
        pointer-events: none;
    }

    .quote-search-box input {
        width: 100%;
        height: 42px;
        border: 1px solid #e5e7eb;
        border-radius: 12px;
        padding: 0 13px 0 38px;
        outline: none;
        font-weight: 600;
        color: #334155;
    }

    .quote-search-box input:focus {
        border-color: #2563eb;
        box-shadow: 0 0 0 3px rgba(37, 99, 235, .10);
    }

    .quote-table-panel {
        background: #ffffff;
        border: 1px solid #e5e7eb;
        border-radius: 18px;
        padding: 14px;
        box-shadow: 0 8px 22px rgba(15, 23, 42, 0.045);
        overflow: hidden;
    }

    .quote-table-wrap {
        width: 100%;
        overflow-x: visible;
    }

    .quote-table {
        width: 100% !important;
        table-layout: fixed;
        border-collapse: separate !important;
        border-spacing: 0 !important;
    }

    .quote-table,
    .quote-table * {
        box-sizing: border-box;
    }

    .quote-table th {
        background: #f8fafc !important;
        padding: 12px 14px !important;
        font-size: 11px !important;
        font-weight: 900 !important;
        color: #64748b !important;
        text-transform: uppercase !important;
        letter-spacing: .06em !important;
        border-bottom: 1px solid #e5e7eb !important;
        white-space: nowrap;
    }

    .quote-table td {
        padding: 14px !important;
        border-bottom: 1px solid #f1f5f9 !important;
        color: #334155 !important;
        font-size: 13px !important;
        vertical-align: top !important;
        background: transparent !important;
        overflow-wrap: anywhere;
    }

    .quote-table tr:hover td {
        background: #f8fafc !important;
    }

    .quote-booking-id {
        font-family: 'Playfair Display', serif;
        color: #111827;
        font-size: 19px;
        font-weight: 800;
        white-space: nowrap;
    }

    .quote-customer,
    .quote-device,
    .quote-tech {
        display: flex;
        flex-direction: column;
        gap: 3px;
        min-width: 0;
    }

    .quote-primary-text {
        color: #111827;
        font-weight: 800;
    }

    .quote-muted-text {
        color: #94a3b8;
        font-size: 12px;
        font-weight: 700;
    }

    .quote-device-type {
        width: fit-content;
        margin-top: 3px;
        background: #eff6ff;
        color: #2563eb;
        border: 1px solid #bfdbfe;
        font-size: 10px;
        font-weight: 900;
        text-transform: uppercase;
        padding: 5px 9px;
        border-radius: 999px;
        letter-spacing: .05em;
    }

    .quote-report-text {
        min-width: 0;
        max-width: none;
        color: #475569;
        font-weight: 600;
        line-height: 1.45;
    }

    .quote-problem-list {
        margin: 0;
        padding: 0;
        list-style: none;
        display: grid;
        gap: 8px;
    }

    .quote-problem-list li {
        display: flex;
        align-items: flex-start;
        gap: 8px;
        color: #334155;
        font-size: 13px;
        font-weight: 700;
        line-height: 1.4;
    }

    .quote-problem-list li::before {
        content: "";
        width: 7px;
        height: 7px;
        margin-top: 6px;
        border-radius: 999px;
        background: #2563eb;
        flex: 0 0 auto;
    }

    .quote-form {
        min-width: 0;
    }

    .quote-form-grid {
        display: grid;
        grid-template-columns: 1fr;
        gap: 8px;
        align-items: center;
        margin-bottom: 9px;
    }

    .currency-wrapper {
        position: relative;
        display: flex;
        align-items: center;
    }

    .currency-prepend {
        position: absolute;
        left: 11px;
        color: #64748b;
        font-size: 12px;
        font-weight: 900;
        pointer-events: none;
    }

    .quote-input-price,
    .quote-input-note {
        width: 100%;
        height: 38px;
        border: 1px solid #dbe3ef;
        border-radius: 10px;
        background: #ffffff;
        color: #334155;
        font-size: 13px;
        font-weight: 700;
        outline: none;
    }

    .quote-input-price {
        padding: 0 10px 0 36px !important;
    }

    .quote-inspected-price {
        min-height: 38px;
        border: 1px solid #bbf7d0;
        border-radius: 10px;
        background: #ecfdf5;
        color: #047857;
        font-size: 15px;
        font-weight: 900;
        display: flex;
        align-items: center;
        padding: 0 12px;
    }

    .quote-input-note {
        padding: 0 11px !important;
    }

    .quote-input-price:focus,
    .quote-input-note:focus {
        border-color: #2563eb;
        box-shadow: 0 0 0 3px rgba(37, 99, 235, .10);
    }

    .quote-actions {
        display: flex;
        gap: 8px;
        flex-wrap: nowrap;
    }

    .btn-action {
        min-height: 38px;
        padding: 0 13px;
        border-radius: 10px;
        font-weight: 900;
        font-size: 11px;
        text-transform: uppercase;
        letter-spacing: .04em;
        display: inline-flex;
        align-items: center;
        justify-content: center;
        gap: 7px;
        cursor: pointer;
        transition: .2s ease;
        border: none;
        text-decoration: none;
        white-space: nowrap;
    }

    .btn-quote-send {
        background: #059669;
        color: #ffffff;
    }

    .btn-quote-send:hover {
        background: #047857;
        transform: translateY(-1px);
        box-shadow: 0 8px 16px rgba(5, 150, 105, .18);
    }

    .btn-quote-preview {
        background: #ffffff;
        border: 1px solid #bfdbfe;
        color: #2563eb;
    }

    .btn-quote-preview:hover {
        background: #eff6ff;
    }

    .quote-sent-details {
        min-width: 0;
        display: flex;
        flex-direction: column;
        gap: 7px;
    }

    .quote-price {
        color: #047857;
        font-size: 18px;
        font-weight: 900;
    }

    .quote-note {
        color: #475569;
        font-weight: 600;
        line-height: 1.4;
        max-width: 100%;
        max-height: 56px;
        overflow: auto;
    }

    .quote-meta-list {
        display: grid;
        gap: 7px;
        margin-top: 10px;
    }

    .quote-meta-item {
        display: flex;
        align-items: flex-start;
        gap: 7px;
        color: #64748b;
        font-size: 12px;
        font-weight: 700;
        line-height: 1.35;
    }

    .quote-meta-item i {
        color: #94a3b8;
        font-size: 13px;
        margin-top: 1px;
    }

    .btn-pdf-view {
        width: fit-content;
        background: #2563eb;
        color: #ffffff;
    }

    .btn-pdf-view:hover {
        background: #1d4ed8;
        color: #ffffff;
    }

    .quote-empty-card {
        background: #ffffff;
        border: 1px dashed #cbd5e1;
        border-radius: 18px;
        padding: 55px 20px;
        text-align: center;
        display: flex;
        flex-direction: column;
        align-items: center;
        gap: 14px;
    }

    .quote-empty-icon {
        width: 70px;
        height: 70px;
        background: #f1f5f9;
        color: #94a3b8;
        border-radius: 50%;
        display: grid;
        place-items: center;
        font-size: 30px;
    }

    .quote-empty-card h3 {
        font-family: 'Playfair Display', serif;
        font-size: 22px;
        font-weight: 800;
        color: #334155;
        margin: 0;
    }

    .quote-empty-card p {
        color: #64748b;
        font-size: 14px;
        margin: 0;
    }

    .alert-panel {
        padding: 14px 18px;
        border-radius: 14px;
        font-weight: 700;
        font-size: 14px;
        display: flex;
        align-items: center;
        gap: 10px;
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

    .dataTables_wrapper .dataTables_filter,
    .dataTables_wrapper .dataTables_length {
        display: none;
    }

    .dataTables_wrapper .dataTables_info {
        color: #64748b;
        font-weight: 700;
        font-size: 12px;
        padding-top: 16px;
    }

    .dataTables_wrapper .dataTables_paginate {
        padding-top: 12px;
    }

    .dataTables_wrapper .dataTables_paginate .paginate_button {
        border-radius: 9px !important;
        border: 1px solid #e5e7eb !important;
        color: #475569 !important;
        font-weight: 800;
    }

    .dataTables_wrapper .dataTables_paginate .paginate_button.current,
    .dataTables_wrapper .dataTables_paginate .paginate_button.current:hover {
        background: #111827 !important;
        color: #ffffff !important;
        border-color: #111827 !important;
    }

    @media (max-width: 980px) {
        .quote-header-panel,
        .quote-toolbar {
            grid-template-columns: 1fr;
        }

        .quote-summary {
            justify-content: flex-start;
        }

        .quote-search-box {
            width: 100%;
        }
    }
</style>

@php
    $getQuotationDeviceCategory = function ($booking) {
        $deviceType = strtolower($booking->device->type ?? '');
        $deviceName = strtolower($booking->device->name ?? '');
        $deviceBrand = strtolower($booking->device->brand ?? '');
        $text = $deviceType.' '.$deviceName.' '.$deviceBrand;

        return match (true) {
            str_contains($text, 'smartphone') || str_contains($text, 'phone') => 'smartphone',
            str_contains($text, 'refrigerator') || str_contains($text, 'fridge') => 'refrigerator',
            str_contains($text, 'washing') || str_contains($text, 'washer') => 'washing-machine',
            str_contains($text, 'television') || str_contains($text, 'tv') => 'television',
            default => 'other',
        };
    };

    $awaitingCount = $bookings->where('status', 'Inspection Completed')->count();
    $sentCount = $bookings->where('status', 'Quotation Sent')->count();
    $smartphoneCount = $bookings->filter(fn ($booking) => $getQuotationDeviceCategory($booking) === 'smartphone')->count();
    $refrigeratorCount = $bookings->filter(fn ($booking) => $getQuotationDeviceCategory($booking) === 'refrigerator')->count();
    $washingMachineCount = $bookings->filter(fn ($booking) => $getQuotationDeviceCategory($booking) === 'washing-machine')->count();
    $televisionCount = $bookings->filter(fn ($booking) => $getQuotationDeviceCategory($booking) === 'television')->count();
@endphp

<div class="quote-page">
    <div class="quote-header-panel">
        <div class="quote-title-area">
            <h1>Booking Quotations</h1>
            <p>Review inspection results, search by customer or booking, filter by device type, and send repair quotations from one table.</p>
        </div>

        <div class="quote-summary">
            <div class="quote-summary-card">
                <span>Total</span>
                <strong>{{ $bookings->count() }}</strong>
            </div>
            <div class="quote-summary-card">
                <span>Awaiting</span>
                <strong>{{ $awaitingCount }}</strong>
            </div>
            <div class="quote-summary-card">
                <span>Sent</span>
                <strong>{{ $sentCount }}</strong>
            </div>
        </div>
    </div>

    <div class="quote-toolbar">
        <div class="quote-filter-group" aria-label="Quotation filters">
            <button type="button" class="quote-filter-btn active" data-filter-value="all">
                <i class="bi bi-grid"></i> All
            </button>
            <button type="button" class="quote-filter-btn" data-filter-value="smartphone">
                <i class="bi bi-phone"></i> Smartphone <span>{{ $smartphoneCount }}</span>
            </button>
            <button type="button" class="quote-filter-btn" data-filter-value="refrigerator">
                <i class="bi bi-snow"></i> Refrigerator <span>{{ $refrigeratorCount }}</span>
            </button>
            <button type="button" class="quote-filter-btn" data-filter-value="washing-machine">
                <i class="bi bi-droplet"></i> Washing Machine <span>{{ $washingMachineCount }}</span>
            </button>
            <button type="button" class="quote-filter-btn" data-filter-value="television">
                <i class="bi bi-tv"></i> Television <span>{{ $televisionCount }}</span>
            </button>
        </div>

        <div class="quote-search-box">
            <i class="bi bi-search"></i>
            <input type="text" id="quotationSearch" placeholder="Search booking, customer, device...">
        </div>
    </div>

    @if(session('success'))
        <div class="alert-panel alert-success-panel" id="popup-notification">
            <i class="bi bi-check-circle-fill"></i>
            <span>{{ session('success') }}</span>
        </div>
    @endif

    @if($errors->any())
        <div class="alert-panel alert-error-panel" id="popup-notification-error">
            <i class="bi bi-exclamation-triangle-fill"></i>
            <span>{{ $errors->first() }}</span>
        </div>
    @endif

    @if($bookings->count())
        <div class="quote-table-panel">
            <div class="quote-table-wrap">
                <table id="quotationTable" class="quote-table display">
                    <colgroup>
                        <col style="width: 24%;">
                        <col style="width: 24%;">
                        <col style="width: 27%;">
                        <col style="width: 25%;">
                    </colgroup>
                    <thead>
                        <tr>
                            <th>Booking & Customer</th>
                            <th>Device & Schedule</th>
                            <th>Inspection Report</th>
                            <th>Quotation</th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach($bookings as $booking)
                            @php
                                $statusType = $booking->status === 'Inspection Completed' ? 'awaiting' : 'sent';
                                $deviceCategory = $getQuotationDeviceCategory($booking);
                                $customerName = $booking->customer->name ?? 'Guest Customer';
                                $deviceModel = $booking->device->model ?? null;
                                $visitDateSort = $booking->visit_date ? \Carbon\Carbon::parse($booking->visit_date)->format('Y-m-d') : '';
                                $quotePriceSort = $booking->quotation_price ?? 0;
                                $reportLines = preg_split('/\r\n|\r|\n/', $booking->inspection_report ?? '');
                                $problemItems = [];

                                foreach ($reportLines as $reportLine) {
                                    $cleanLine = trim($reportLine);

                                    if ($cleanLine === '') {
                                        continue;
                                    }

                                    $cleanLine = preg_replace('/^Covered repair\(s\):\s*/i', '', $cleanLine);
                                    $cleanLine = preg_replace('/^Uncovered problem remark:\s*/i', '', $cleanLine);

                                    foreach (array_filter(array_map('trim', explode(',', $cleanLine))) as $problemItem) {
                                        $problemItems[] = $problemItem;
                                    }
                                }
                            @endphp

                            <tr data-status="{{ $statusType }}" data-device-category="{{ $deviceCategory }}">
                                <td data-order="{{ $booking->id }}">
                                    <div class="quote-booking-id">#{{ $booking->id }}</div>
                                    <div class="quote-customer">
                                        <span class="quote-primary-text">{{ $customerName }}</span>
                                        <span class="quote-muted-text">{{ $booking->customer->phone_number ?? 'No phone' }}</span>
                                    </div>
                                </td>

                                <td data-order="{{ $booking->device->type ?? 'Other' }} {{ $booking->device->name ?? '-' }} {{ $visitDateSort }}">
                                    <div class="quote-device">
                                        <span class="quote-primary-text">{{ $booking->device->name ?? '-' }}</span>
                                        <span class="quote-muted-text">{{ $booking->device->brand ?? '-' }}{{ $deviceModel ? ' - '.$deviceModel : '' }}</span>
                                        <span class="quote-device-type">{{ $booking->device->type ?? 'Other' }}</span>
                                    </div>
                                    <div class="quote-meta-list">
                                        <div class="quote-meta-item">
                                            <i class="bi bi-person-gear"></i>
                                            <span>{{ $booking->technician->name ?? 'Not Assigned' }}</span>
                                        </div>
                                        <div class="quote-meta-item">
                                            <i class="bi bi-calendar2-event"></i>
                                            <span>{{ $booking->visit_date ? \Carbon\Carbon::parse($booking->visit_date)->format('d M Y') : '-' }}</span>
                                        </div>
                                    </div>
                                </td>

                                <td>
                                    <div class="quote-report-text">
                                        @if(count($problemItems))
                                            <ul class="quote-problem-list">
                                                @foreach($problemItems as $problemItem)
                                                    <li>{{ $problemItem }}</li>
                                                @endforeach
                                            </ul>
                                        @else
                                            <span>No details submitted</span>
                                        @endif
                                    </div>
                                </td>

                                <td data-order="{{ $quotePriceSort }}">
                                    @if($booking->status === 'Quotation Sent')
                                        <div class="quote-sent-details">
                                            <div class="quote-price">RM {{ number_format($booking->quotation_price, 2) }}</div>
                                            @if($booking->quotation_note)
                                                <div class="quote-note">{{ $booking->quotation_note }}</div>
                                            @endif

                                            @if($booking->quotation_pdf)
                                                <a href="{{ asset($booking->quotation_pdf) }}" target="_blank" class="btn-action btn-pdf-view">
                                                    <i class="bi bi-file-earmark-pdf"></i>
                                                    PDF
                                                </a>
                                            @endif
                                        </div>
                                    @else
                                        <form method="POST" action="{{ route('admin.bookings.sendQuotation', $booking->id) }}" class="quote-form">
                                            @csrf
                                            @method('PUT')

                                            <div class="quote-form-grid">
                                                <div class="quote-inspected-price" id="price_{{ $booking->id }}" data-price="{{ $booking->quotation_price ?? 0 }}">
                                                    RM {{ number_format($booking->quotation_price ?? 0, 2) }}
                                                </div>

                                                <input type="text" id="note_{{ $booking->id }}" name="quotation_note"
                                                       class="quote-input-note" value="{{ $booking->quotation_note ?? '' }}"
                                                       placeholder="Quotation note / remarks">
                                            </div>

                                            <div class="quote-actions">
                                                <button type="submit" class="btn-action btn-quote-send">
                                                    <i class="bi bi-send-check-fill"></i>
                                                    Send
                                                </button>

                                                <button type="button" class="btn-action btn-quote-preview" onclick="previewPdf({{ $booking->id }})">
                                                    <i class="bi bi-file-earmark-pdf"></i>
                                                    Preview
                                                </button>
                                            </div>
                                        </form>
                                    @endif
                                </td>
                            </tr>
                        @endforeach
                    </tbody>
                </table>
            </div>
        </div>
    @else
        <div class="quote-empty-card">
            <div class="quote-empty-icon">
                <i class="bi bi-inbox-fill"></i>
            </div>
            <h3>No Bookings Recorded</h3>
            <p>There are no completed inspections or sent quotations to display yet.</p>
        </div>
    @endif
</div>

<script>
    document.addEventListener("DOMContentLoaded", function() {
        const successNotify = document.getElementById('popup-notification');
        const errorNotify = document.getElementById('popup-notification-error');

        function hideNotification(element) {
            if (!element) return;

            setTimeout(function() {
                element.style.transition = 'opacity 0.5s ease';
                element.style.opacity = '0';
                setTimeout(() => element.style.display = 'none', 500);
            }, 3500);
        }

        hideNotification(successNotify);
        hideNotification(errorNotify);
    });

    $(document).ready(function () {
        if (!$('#quotationTable').length) return;

        let activeDeviceFilter = 'all';

        const quotationFilter = function(settings, data, dataIndex) {
            if (settings.nTable.id !== 'quotationTable') {
                return true;
            }

            const row = settings.aoData[dataIndex].nTr;
            const deviceCategory = row.dataset.deviceCategory;

            return activeDeviceFilter === 'all' || deviceCategory === activeDeviceFilter;
        };

        $.fn.dataTable.ext.search.push(quotationFilter);

        const table = $('#quotationTable').DataTable({
            pageLength: 10,
            ordering: true,
            searching: true,
            responsive: false,
            order: [[0, 'desc']],
            columnDefs: [
                { orderable: false, targets: [2] }
            ],
            language: {
                emptyTable: "No quotations match the selected filters.",
                zeroRecords: "No quotations match the selected filters or search keyword.",
                info: "Showing _START_ to _END_ of _TOTAL_ quotations",
                infoEmpty: "Showing 0 quotations",
                infoFiltered: "(filtered from _MAX_ total)",
                paginate: {
                    first: "<<",
                    previous: "<",
                    next: ">",
                    last: ">>"
                }
            }
        });

        $('#quotationSearch').on('input', function() {
            table.search(this.value).draw();
        });

        $('.quote-filter-btn').on('click', function() {
            activeDeviceFilter = this.dataset.filterValue;

            $('.quote-filter-btn').removeClass('active');
            $(this).addClass('active');
            table.draw();
        });

        $(window).on('unload', function() {
            const filterIndex = $.fn.dataTable.ext.search.indexOf(quotationFilter);
            if (filterIndex !== -1) {
                $.fn.dataTable.ext.search.splice(filterIndex, 1);
            }
        });
    });

    function previewPdf(bookingId) {
        const noteInput = document.getElementById('note_' + bookingId);
        const note = noteInput?.value || '';

        let url = "{{ url('/admin/bookings') }}/" + bookingId + "/quotation-pdf";
        url += "?note=" + encodeURIComponent(note);

        window.open(url, '_blank');
    }
</script>

@endsection
