@extends('layouts.technician')

@section('title', 'Inspection Booking #' . $booking->id)

@section('content')

<style>
    .inspection-header {
        position: relative;
        background: linear-gradient(135deg, #0f5132, #145c45);
        color: #ffffff;
        padding: 36px;
        border-radius: 24px;
        margin-bottom: 28px;
        overflow: hidden;
        box-shadow: 0 20px 25px -5px rgba(0, 0, 0, 0.1), 0 10px 10px -5px rgba(0, 0, 0, 0.04);
    }
    .inspection-header::after {
        content: "";
        position: absolute;
        top: -120px;
        right: -90px;
        width: 320px;
        height: 320px;
        border-radius: 50%;
        background: radial-gradient(circle, rgba(52, 211, 153, 0.2) 0%, rgba(15, 81, 50, 0) 70%);
        pointer-events: none;
    }
    .inspection-header-content {
        position: relative;
        z-index: 1;
        display: flex;
        align-items: center;
        justify-content: space-between;
        gap: 20px;
    }
    .inspection-title-wrap {
        display: flex;
        align-items: center;
        gap: 18px;
    }
    .inspection-icon {
        width: 64px;
        height: 64px;
        border-radius: 18px;
        display: grid;
        place-items: center;
        background: linear-gradient(135deg, #34d399, #0f5132);
        box-shadow: 0 10px 15px -3px rgba(15, 81, 50, 0.4);
        font-size: 28px;
        flex-shrink: 0;
    }
    .inspection-header h1 {
        margin: 0 0 7px;
        font-size: 2rem;
        font-weight: 800;
        color: #ffffff;
        letter-spacing: -0.025em;
    }
    .inspection-header p {
        margin: 0;
        color: #d1fae5;
        line-height: 1.5;
    }
    .back-link {
        display: inline-flex;
        align-items: center;
        gap: 8px;
        color: #ffffff;
        text-decoration: none;
        border: 1px solid rgba(255,255,255,0.35);
        border-radius: 10px;
        padding: 10px 14px;
        font-weight: 800;
        font-size: 13px;
        text-transform: uppercase;
        letter-spacing: 0.05em;
        background: rgba(255,255,255,0.08);
        white-space: nowrap;
    }
    .back-link:hover {
        background: rgba(255,255,255,0.16);
    }

    .inspection-grid {
        display: grid;
        grid-template-columns: minmax(0, 1fr) 340px;
        gap: 24px;
        align-items: start;
    }
    .inspection-panel {
        background: #ffffff;
        border: 1px solid #e5e7eb;
        border-radius: 16px;
        padding: 26px;
        box-shadow: var(--shadow);
    }
    .inspection-panel + .inspection-panel {
        margin-top: 22px;
    }
    .panel-title {
        display: flex;
        align-items: center;
        gap: 10px;
        margin-bottom: 18px;
    }
    .panel-title span {
        width: 32px;
        height: 32px;
        border-radius: 8px;
        display: inline-flex;
        align-items: center;
        justify-content: center;
        color: #ffffff;
        background: #2563eb;
    }
    .panel-title h2 {
        margin: 0;
        color: #111827;
        font-size: 22px;
        font-family: 'Playfair Display', serif;
    }
    .booking-summary {
        display: grid;
        grid-template-columns: repeat(2, minmax(0, 1fr));
        gap: 14px;
    }
    .summary-item {
        background: #f8fafc;
        border: 1px solid #e2e8f0;
        border-radius: 12px;
        padding: 14px;
    }
    .summary-item small {
        display: block;
        color: #64748b;
        font-size: 12px;
        font-weight: 800;
        text-transform: uppercase;
        letter-spacing: 0.06em;
        margin-bottom: 5px;
    }
    .summary-item strong,
    .summary-item span {
        color: #111827;
        font-size: 15px;
        line-height: 1.35;
    }
    .summary-item.full {
        grid-column: 1 / -1;
    }
    .repair-options-grid {
        display: grid;
        grid-template-columns: repeat(auto-fill, minmax(210px, 1fr));
        gap: 12px;
        margin-top: 14px;
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
        min-height: 116px;
        border: 1px solid #e2e8f0;
        border-radius: 12px;
        padding: 16px;
        display: flex;
        flex-direction: column;
        gap: 10px;
        transition: all 0.2s ease;
        background: #f8fafc;
        position: relative;
    }
    .repair-option-card:hover .repair-card-content {
        border-color: #bfdbfe;
        background: #f8fbff;
    }
    .repair-checkbox:checked + .repair-card-content {
        border-color: #2563eb;
        background: #eff6ff;
        box-shadow: inset 0 0 0 1px #bfdbfe;
    }
    .repair-name {
        color: #111827;
        font-size: 15px;
        font-weight: 800;
        line-height: 1.3;
        padding-right: 24px;
    }
    .repair-price {
        color: #15803d;
        font-size: 15px;
        font-weight: 800;
        margin-top: auto;
    }
    .checkbox-indicator {
        position: absolute;
        top: 14px;
        right: 14px;
        color: #2563eb;
        opacity: 0;
        transform: scale(0.6);
        transition: all 0.2s ease;
    }
    .repair-checkbox:checked + .repair-card-content .checkbox-indicator {
        opacity: 1;
        transform: scale(1);
    }
    .remark-box {
        margin-top: 22px;
        background: #fffbeb;
        border: 1px solid #fde68a;
        border-radius: 14px;
        padding: 18px;
    }
    label {
        display: block;
        color: #111827;
        font-size: 14px;
        font-weight: 800;
        margin-bottom: 8px;
    }
    textarea {
        width: 100%;
        min-height: 125px;
        border: 1px solid #cbd5e1;
        border-radius: 10px;
        padding: 12px;
        resize: vertical;
        color: #1f2937;
        font-family: 'Mukta Mahee', sans-serif;
        font-size: 15px;
        background: #ffffff;
    }
    textarea:focus {
        outline: none;
        border-color: #2563eb;
        box-shadow: 0 0 0 3px rgba(37, 99, 235, 0.15);
    }
    .field-help {
        color: #92400e;
        font-size: 13px;
        line-height: 1.4;
        margin: 0 0 12px;
    }
    .form-error {
        color: #b91c1c;
        font-size: 13px;
        font-weight: 700;
        margin: 10px 0 0;
    }
    .submit-row {
        display: flex;
        align-items: center;
        justify-content: flex-end;
        gap: 12px;
        margin-top: 22px;
        padding-top: 20px;
        border-top: 1px solid #f1f5f9;
    }
    .btn-submit {
        border: none;
        border-radius: 10px;
        padding: 12px 18px;
        display: inline-flex;
        align-items: center;
        gap: 9px;
        color: #ffffff;
        background: #2563eb;
        font-weight: 800;
        font-size: 13px;
        text-transform: uppercase;
        letter-spacing: 0.05em;
        cursor: pointer;
        transition: all 0.2s ease;
    }
    .btn-submit:hover {
        background: #1d4ed8;
        transform: translateY(-1px);
        box-shadow: 0 8px 16px rgba(37, 99, 235, 0.18);
    }
    .quote-box {
        background: #ecfdf5;
        border: 1px solid #bbf7d0;
        border-radius: 16px;
        padding: 22px;
    }
    .quote-box small {
        display: block;
        color: #166534;
        font-size: 12px;
        font-weight: 800;
        text-transform: uppercase;
        letter-spacing: 0.06em;
        margin-bottom: 6px;
    }
    .quote-total {
        color: #14532d;
        font-family: Arial, sans-serif;
        font-size: 34px;
        font-weight: 800;
    }
    .quote-box p {
        color: #166534;
        margin: 8px 0 0;
        font-size: 13px;
        line-height: 1.45;
    }
    .status-chip {
        display: inline-flex;
        align-items: center;
        gap: 7px;
        background: #dbeafe;
        color: #1e40af;
        border-radius: 999px;
        padding: 7px 12px;
        font-size: 12px;
        font-weight: 800;
        text-transform: uppercase;
        letter-spacing: 0.05em;
        margin-bottom: 16px;
    }
    .empty-repairs {
        color: #b91c1c;
        background: #fef2f2;
        border: 1px solid #fecaca;
        border-radius: 12px;
        padding: 14px;
        font-size: 14px;
        font-weight: 700;
        margin-top: 12px;
    }

    @media(max-width: 980px) {
        .inspection-grid {
            grid-template-columns: 1fr;
        }
    }
    @media(max-width: 640px) {
        .inspection-header {
            padding: 24px;
        }
        .inspection-header-content,
        .inspection-title-wrap {
            align-items: flex-start;
            flex-direction: column;
        }
        .inspection-header h1 {
            font-size: 1.65rem;
        }
        .booking-summary {
            grid-template-columns: 1fr;
        }
        .submit-row {
            justify-content: stretch;
        }
        .btn-submit,
        .back-link {
            width: 100%;
            justify-content: center;
        }
    }
</style>

<div class="inspection-header">
    <div class="inspection-header-content">
        <div class="inspection-title-wrap">
            <div class="inspection-icon">
                <i class="bi bi-clipboard2-pulse-fill"></i>
            </div>
            <div>
                <h1>Inspection Booking #{{ $booking->id }}</h1>
                <p>Check priced repairs that match the diagnosis, then add a remark for any uncovered problem.</p>
            </div>
        </div>

        <a href="{{ route('technician.dashboard') }}" class="back-link">
            <i class="bi bi-arrow-left"></i> Back
        </a>
    </div>
</div>

<div class="inspection-grid">
    <main>
        <section class="inspection-panel">
            <div class="panel-title">
                <span><i class="bi bi-person-lines-fill"></i></span>
                <h2>Booking Details</h2>
            </div>

            <div class="booking-summary">
                <div class="summary-item">
                    <small>Customer</small>
                    <strong>{{ $booking->customer->name ?? '-' }}</strong>
                </div>
                <div class="summary-item">
                    <small>Phone</small>
                    <strong>{{ $booking->customer->phone_number ?? '-' }}</strong>
                </div>
                <div class="summary-item">
                    <small>Device</small>
                    <strong>{{ $booking->device->name ?? '-' }} - {{ $booking->device->brand ?? '-' }}</strong>
                </div>
                <div class="summary-item">
                    <small>Visit Date</small>
                    <strong>{{ $booking->visit_date ? \Carbon\Carbon::parse($booking->visit_date)->format('d M Y') : '-' }}</strong>
                </div>
                <div class="summary-item full">
                    <small>Customer Problem</small>
                    <span>{{ $booking->problem_description ?: '-' }}</span>
                </div>
            </div>
        </section>

        <section class="inspection-panel">
            <div class="panel-title">
                <span><i class="bi bi-tools"></i></span>
                <h2>Diagnostic Result</h2>
            </div>

            <form method="POST" action="{{ route('technician.bookings.inspection', $booking->id) }}" id="inspectionForm">
                @csrf
                @method('PUT')

                <label>Select covered repair problem(s)</label>

                @if($booking->device && $booking->device->repairs->count() > 0)
                    <div class="repair-options-grid">
                        @foreach($booking->device->repairs as $repair)
                            <label class="repair-option-card">
                                <input
                                    type="checkbox"
                                    name="repair_ids[]"
                                    value="{{ $repair->id }}"
                                    data-price="{{ $repair->price }}"
                                    class="repair-checkbox"
                                    {{ in_array($repair->id, old('repair_ids', [])) ? 'checked' : '' }}
                                >
                                <div class="repair-card-content">
                                    <span class="checkbox-indicator"><i class="bi bi-check-circle-fill"></i></span>
                                    <span class="repair-name">{{ $repair->repair_type }}</span>
                                    <span class="repair-price">RM {{ number_format($repair->price, 2) }}</span>
                                </div>
                            </label>
                        @endforeach
                    </div>
                @else
                    <div class="empty-repairs">
                        No priced repair options are configured for this device. Add a remark below before submitting.
                    </div>
                @endif

                <div class="remark-box">
                    <label for="uncovered_problem_remark">Remark for uncovered problem</label>
                    <p class="field-help">Use this when the detected issue is not in the priced repair list, needs admin review, or requires custom quotation.</p>
                    <textarea
                        id="uncovered_problem_remark"
                        name="uncovered_problem_remark"
                        placeholder="Example: Mainboard corrosion found. Price is not available in current repair list and needs admin quotation review."
                    >{{ old('uncovered_problem_remark') }}</textarea>
                </div>

                @error('repair_ids')
                    <p class="form-error">{{ $message }}</p>
                @enderror
                @error('uncovered_problem_remark')
                    <p class="form-error">{{ $message }}</p>
                @enderror

                <div class="submit-row">
                    <button type="submit" class="btn-submit">
                        <i class="bi bi-file-earmark-check-fill"></i>
                        Submit Inspection Report
                    </button>
                </div>
            </form>
        </section>
    </main>

    <aside>
        <section class="inspection-panel">
            <span class="status-chip"><i class="bi bi-search"></i> {{ $booking->status }}</span>

            <div class="quote-box">
                <small>Covered Repair Total</small>
                <div class="quote-total">RM <span id="coveredTotal">0.00</span></div>
                <p>This total only includes selected priced repairs. Uncovered remarks will be visible to admin for quotation review.</p>
            </div>
        </section>
    </aside>
</div>

<script>
    const inspectionForm = document.getElementById('inspectionForm');
    const checkboxes = document.querySelectorAll('.repair-checkbox');
    const totalOutput = document.getElementById('coveredTotal');
    const remarkInput = document.getElementById('uncovered_problem_remark');

    function updateCoveredTotal() {
        let total = 0;

        checkboxes.forEach(checkbox => {
            if (checkbox.checked) {
                total += Number(checkbox.dataset.price || 0);
            }
        });

        totalOutput.textContent = total.toFixed(2);
    }

    checkboxes.forEach(checkbox => {
        checkbox.addEventListener('change', updateCoveredTotal);
    });

    inspectionForm.addEventListener('submit', function (event) {
        const hasRepair = Array.from(checkboxes).some(checkbox => checkbox.checked);
        const hasRemark = remarkInput.value.trim().length > 0;

        if (!hasRepair && !hasRemark) {
            event.preventDefault();
            alert('Please select a priced repair or add a remark for an uncovered problem.');
        }
    });

    updateCoveredTotal();
</script>

@endsection
