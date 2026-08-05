@extends('layouts.admin')

@section('title', 'Pending Bookings')

@section('content')
<style>
    .pending-page {
        display: flex;
        flex-direction: column;
        gap: 18px;
    }

    .pending-topbar {
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

    .pending-title h1 {
        font-family: 'Playfair Display', serif;
        font-size: 28px;
        font-weight: 800;
        color: #111827;
        margin: 0 0 6px;
    }

    .pending-title p {
        color: #6b7280;
        font-size: 14px;
        margin: 0;
    }

    .pending-summary {
        display: flex;
        gap: 12px;
        flex-wrap: wrap;
        justify-content: flex-end;
    }

    .summary-card {
        min-width: 132px;
        padding: 13px 16px;
        border-radius: 15px;
        background: #f8fafc;
        border: 1px solid #e5e7eb;
    }

    .summary-card span {
        display: block;
        font-size: 11px;
        font-weight: 800;
        color: #94a3b8;
        text-transform: uppercase;
        letter-spacing: .06em;
    }

    .summary-card strong {
        display: block;
        margin-top: 3px;
        color: #111827;
        font-size: 22px;
        line-height: 1;
    }

    .pending-toolbar {
        background: #ffffff;
        border: 1px solid #e5e7eb;
        border-radius: 16px;
        padding: 14px;
        display: grid;
        grid-template-columns: 1fr auto;
        gap: 14px;
        align-items: center;
    }

    .filter-buttons {
        display: flex;
        flex-wrap: wrap;
        gap: 10px;
    }

    .filter-btn {
        border: 1px solid #e5e7eb;
        background: #ffffff;
        color: #475569;
        border-radius: 999px;
        padding: 10px 15px;
        font-size: 13px;
        font-weight: 800;
        cursor: pointer;
        transition: .2s ease;
    }

    .filter-btn:hover,
    .filter-btn.active {
        background: #111827;
        border-color: #111827;
        color: #ffffff;
    }

    .search-box {
        position: relative;
        width: 280px;
    }

    .search-box i {
        position: absolute;
        left: 13px;
        top: 50%;
        transform: translateY(-50%);
        color: #94a3b8;
    }

    .search-box input {
        width: 100%;
        height: 42px;
        border: 1px solid #e5e7eb;
        border-radius: 12px;
        padding: 0 13px 0 38px;
        outline: none;
        font-weight: 600;
        color: #334155;
    }

    .search-box input:focus {
        border-color: #2563eb;
        box-shadow: 0 0 0 3px rgba(37, 99, 235, .10);
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

    .booking-list {
        display: grid;
        grid-template-columns: 1fr;
        gap: 12px;
    }

    .booking-card {
        background: #ffffff;
        border: 1px solid #e5e7eb;
        border-radius: 18px;
        padding: 16px;
        display: grid;
        grid-template-columns: 240px 1fr 260px;
        gap: 18px;
        align-items: stretch;
        box-shadow: 0 8px 22px rgba(15, 23, 42, 0.045);
        transition: .2s ease;
    }

    .booking-card:hover {
        border-color: #cbd5e1;
        transform: translateY(-2px);
        box-shadow: 0 14px 30px rgba(15, 23, 42, 0.08);
    }

    .booking-identity {
        border-right: 1px dashed #e5e7eb;
        padding-right: 16px;
        display: flex;
        flex-direction: column;
        gap: 12px;
    }

    .status-row {
        display: flex;
        align-items: center;
        gap: 8px;
        flex-wrap: wrap;
    }

    .status-badge {
        width: fit-content;
        background: #fff7ed;
        color: #ea580c;
        border: 1px solid #fed7aa;
        font-size: 10px;
        font-weight: 900;
        text-transform: uppercase;
        padding: 6px 10px;
        border-radius: 999px;
        letter-spacing: .05em;
    }

    .device-type-pill {
        width: fit-content;
        background: #eff6ff;
        color: #2563eb;
        border: 1px solid #bfdbfe;
        font-size: 10px;
        font-weight: 900;
        text-transform: uppercase;
        padding: 6px 10px;
        border-radius: 999px;
        letter-spacing: .05em;
    }

    .booking-id {
        font-family: 'Playfair Display', serif;
        font-size: 24px;
        color: #111827;
        font-weight: 800;
        margin: 0;
    }

    .customer-line {
        display: flex;
        align-items: center;
        gap: 10px;
    }

    .customer-avatar {
        width: 38px;
        height: 38px;
        border-radius: 13px;
        background: linear-gradient(135deg, #2563eb, #1e40af);
        color: #ffffff;
        display: grid;
        place-items: center;
        font-weight: 900;
        text-transform: uppercase;
        overflow: hidden;
        flex-shrink: 0;
    }


    .customer-avatar img {
        width: 100%;
        height: 100%;
        object-fit: cover;
        border-radius: inherit;
        display: block;
    }

    .customer-line span {
        display: block;
        color: #94a3b8;
        font-size: 11px;
        font-weight: 800;
        text-transform: uppercase;
    }

    .customer-line strong {
        display: block;
        color: #334155;
        font-size: 14px;
    }

    .booking-details {
        display: grid;
        grid-template-columns: repeat(4, minmax(140px, 1fr));
        gap: 12px;
        align-content: start;
    }

    .detail-box {
        background: #f8fafc;
        border: 1px solid #eef2f7;
        border-radius: 14px;
        padding: 12px;
        min-height: 72px;
    }

    .detail-box.full {
        grid-column: 1 / -1;
    }

    .detail-label {
        display: flex;
        align-items: center;
        gap: 7px;
        font-size: 10px;
        color: #94a3b8;
        font-weight: 900;
        text-transform: uppercase;
        letter-spacing: .06em;
        margin-bottom: 6px;
    }

    .detail-value {
        color: #334155;
        font-weight: 800;
        font-size: 13px;
        word-break: break-word;
    }

    .problem-text {
        color: #475569;
        font-style: italic;
        font-weight: 600;
        line-height: 1.5;
        max-height: 42px;
        overflow: auto;
    }

    .assign-panel {
        background: #f8fafc;
        border: 1px solid #eef2f7;
        border-radius: 16px;
        padding: 14px;
        display: flex;
        flex-direction: column;
        justify-content: center;
        gap: 10px;
    }

    .assign-panel label {
        font-size: 11px;
        font-weight: 900;
        color: #64748b;
        text-transform: uppercase;
        letter-spacing: .06em;
        margin: 0;
    }

    .pending-select {
        width: 100%;
        height: 42px;
        border: 1px solid #dbe3ef;
        border-radius: 12px;
        padding: 0 12px;
        background: #ffffff;
        font-size: 13px;
        color: #334155;
        font-weight: 700;
        outline: none;
    }

    .pending-select:focus {
        border-color: #2563eb;
        box-shadow: 0 0 0 3px rgba(37, 99, 235, .10);
    }

    .pending-assign-btn {
        width: 100%;
        height: 42px;
        background: linear-gradient(135deg, #2563eb, #1d4ed8);
        color: #ffffff;
        border: none;
        border-radius: 12px;
        font-weight: 900;
        font-size: 12px;
        text-transform: uppercase;
        letter-spacing: .05em;
        cursor: pointer;
        display: flex;
        align-items: center;
        justify-content: center;
        gap: 8px;
        transition: .2s ease;
    }

    .pending-assign-btn:hover {
        transform: translateY(-1px);
        box-shadow: 0 8px 16px rgba(37, 99, 235, .22);
    }

    .pending-empty-card {
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

    .pending-empty-icon {
        width: 70px;
        height: 70px;
        background: #f1f5f9;
        color: #94a3b8;
        border-radius: 50%;
        display: grid;
        place-items: center;
        font-size: 30px;
    }

    .pending-empty-card h3 {
        font-family: 'Playfair Display', serif;
        font-size: 22px;
        font-weight: 800;
        color: #334155;
        margin: 0;
    }

    .pending-empty-card p {
        color: #64748b;
        font-size: 14px;
        margin: 0;
    }

    .no-filter-result {
        display: none;
    }

    @media (max-width: 1180px) {
        .booking-card {
            grid-template-columns: 1fr;
        }

        .booking-identity {
            border-right: 0;
            border-bottom: 1px dashed #e5e7eb;
            padding-right: 0;
            padding-bottom: 14px;
        }

        .booking-details {
            grid-template-columns: repeat(2, minmax(150px, 1fr));
        }
    }

    @media (max-width: 760px) {
        .pending-topbar,
        .pending-toolbar {
            grid-template-columns: 1fr;
        }

        .pending-summary {
            justify-content: flex-start;
        }

        .search-box {
            width: 100%;
        }

        .booking-details {
            grid-template-columns: 1fr;
        }
    }
</style>

@php
    function bookingMatchesDeviceCategory($booking, $category) {
        $deviceType = strtolower($booking->device->type ?? '');
        $deviceName = strtolower($booking->device->name ?? '');
        $deviceBrand = strtolower($booking->device->brand ?? '');
        $text = $deviceType.' '.$deviceName.' '.$deviceBrand;

        return match ($category) {
            'smartphone' => str_contains($text, 'smartphone') || str_contains($text, 'phone'),
            'refrigerator' => str_contains($text, 'refrigerator') || str_contains($text, 'fridge'),
            'washing-machine' => str_contains($text, 'washing') || str_contains($text, 'washer'),
            'television' => str_contains($text, 'television') || str_contains($text, 'tv'),
            default => false,
        };
    }

    $smartphoneCount = $bookings->filter(fn ($booking) => bookingMatchesDeviceCategory($booking, 'smartphone'))->count();
    $refrigeratorCount = $bookings->filter(fn ($booking) => bookingMatchesDeviceCategory($booking, 'refrigerator'))->count();
    $washingMachineCount = $bookings->filter(fn ($booking) => bookingMatchesDeviceCategory($booking, 'washing-machine'))->count();
    $televisionCount = $bookings->filter(fn ($booking) => bookingMatchesDeviceCategory($booking, 'television'))->count();
@endphp

<div class="pending-page">

    <div class="pending-topbar">
        <div class="pending-title">
            <h1>Pending Bookings</h1>
            <p>View all pending booking requests in one organized list and assign suitable technicians faster.</p>
        </div>

        <div class="pending-summary">
            <div class="summary-card">
                <span>Total Pending</span>
                <strong>{{ $bookings->count() }}</strong>
            </div>
            <div class="summary-card">
                <span>Smartphone</span>
                <strong>{{ $smartphoneCount }}</strong>
            </div>
            <div class="summary-card">
                <span>Refrigerator</span>
                <strong>{{ $refrigeratorCount }}</strong>
            </div>
            <div class="summary-card">
                <span>Washing Machine</span>
                <strong>{{ $washingMachineCount }}</strong>
            </div>
            <div class="summary-card">
                <span>Television</span>
                <strong>{{ $televisionCount }}</strong>
            </div>
        </div>
    </div>

    <div class="pending-toolbar">
        <div class="filter-buttons">
            <button type="button" class="filter-btn active" data-filter="all">
                <i class="bi bi-grid"></i> All Bookings
            </button>
            <button type="button" class="filter-btn" data-filter="smartphone">
                <i class="bi bi-phone"></i> Smartphone
            </button>
            <button type="button" class="filter-btn" data-filter="refrigerator">
                <i class="bi bi-snow"></i> Refrigerator
            </button>
            <button type="button" class="filter-btn" data-filter="washing-machine">
                <i class="bi bi-droplet"></i> Washing Machine
            </button>
            <button type="button" class="filter-btn" data-filter="television">
                <i class="bi bi-tv"></i> Television
            </button>
        </div>

        <div class="search-box">
            <i class="bi bi-search"></i>
            <input type="text" id="bookingSearch" placeholder="Search customer, booking ID, phone...">
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

    <div class="booking-list" id="bookingList">
        @forelse($bookings as $booking)
            @php
                $deviceCategory = 'other';

                foreach (['smartphone', 'refrigerator', 'washing-machine', 'television'] as $category) {
                    if (bookingMatchesDeviceCategory($booking, $category)) {
                        $deviceCategory = $category;
                        break;
                    }
                }

                $customerName = $booking->customer->name ?? 'Guest User';
                $initial = strtoupper(substr($customerName, 0, 1));
                $profilePicture = $booking->customer->profile_picture
                    ?? $booking->customer->profile_photo
                    ?? $booking->customer->avatar
                    ?? $booking->customer->image
                    ?? null;

                if ($profilePicture && !str_starts_with($profilePicture, 'http')) {
                    $profilePicture = asset('storage/' . ltrim($profilePicture, '/'));
                }
            @endphp

            <div class="booking-card"
                 data-device-category="{{ $deviceCategory }}"
                 data-search="{{ strtolower($booking->id.' '.$customerName.' '.($booking->customer->phone_number ?? '').' '.($booking->device->name ?? '').' '.($booking->device->brand ?? '').' '.($booking->status ?? '')) }}">

                <div class="booking-identity">
                    <h2 class="booking-id">Booking #{{ $booking->id }}</h2>

                    <div class="customer-line">
                        <div class="customer-avatar">
                            @if($profilePicture)
                                <img src="{{ $profilePicture }}" alt="{{ $customerName }} profile picture">
                            @else
                                {{ $initial }}
                            @endif
                        </div>
                        <div>
                            <span>Customer</span>
                            <strong>{{ $customerName }}</strong>
                        </div>
                    </div>
                </div>

                <div class="booking-details">
                    <div class="detail-box">
                        <div class="detail-label"><i class="bi bi-telephone"></i> Phone</div>
                        <div class="detail-value">{{ $booking->customer->phone_number ?? '-' }}</div>
                    </div>

                    <div class="detail-box">
                        <div class="detail-label"><i class="bi bi-phone"></i> Device</div>
                        <div class="detail-value">{{ $booking->device->name ?? '-' }}</div>
                    </div>

                    <div class="detail-box">
                        <div class="detail-label"><i class="bi bi-bookmark"></i> Brand</div>
                        <div class="detail-value">{{ $booking->device->brand ?? '-' }}</div>
                    </div>

                    <div class="detail-box">
                        <div class="detail-label"><i class="bi bi-calendar2-event"></i> Visit Date</div>
                        <div class="detail-value" style="color:#2563eb;">
                            {{ $booking->visit_date ? \Carbon\Carbon::parse($booking->visit_date)->format('d M Y') : 'Not Specified' }}
                        </div>
                    </div>

                    <div class="detail-box full">
                        <div class="detail-label"><i class="bi bi-chat-left-text"></i> Problem Statement</div>
                        <div class="problem-text">"{{ $booking->problem_description }}"</div>
                    </div>
                </div>

                <div class="assign-panel">
                    <form method="POST" action="{{ route('admin.bookings.assign', $booking->id) }}">
                        @csrf
                        @method('PUT')

                        <label><i class="bi bi-tools"></i> Assign Technician</label>

                        @php
                            $availableTechnicians = $technicians->filter(function ($technician) use ($booking) {
                                $isUnavailable = $technician->availabilities
                                    ->contains(function ($availability) use ($booking) {
                                        return $booking->visit_date && $availability->isUnavailableOn($booking->visit_date);
                                    });

                                $deviceType = $booking->device->type ?? null;
                                $isSpecialized = true;

                                if ($deviceType) {
                                    $specialties = array_map('trim', explode(',', strtolower($technician->specialty ?? '')));
                                    $isSpecialized = collect($specialties)
                                        ->contains(fn ($specialty) => str_contains($specialty, strtolower($deviceType)));
                                }

                                return ! $isUnavailable && $isSpecialized;
                            });

                            // The controller orders this collection by active repair count, then name and ID.
                            $recommendedTechnicianId = $availableTechnicians->first()?->id;
                            $selectedTechnicianId = old('technician_id', $booking->technician_id ?: $recommendedTechnicianId);
                        @endphp

                        <select name="technician_id" class="pending-select" required>
                            <option value="">Select available technician</option>

                            @foreach($availableTechnicians as $technician)
                                <option value="{{ $technician->id }}"
                                    {{ (string) $selectedTechnicianId === (string) $technician->id ? 'selected' : '' }}>
                                    {{ $technician->name }}
                                </option>
                            @endforeach
                        </select>

                        <button type="submit" class="pending-assign-btn">
                            <i class="bi bi-person-check-fill"></i>
                            Assign
                        </button>
                    </form>
                </div>
            </div>
        @empty
            <div class="pending-empty-card">
                <div class="pending-empty-icon">
                    <i class="bi bi-folder-check"></i>
                </div>
                <h3>All Bookings Assigned</h3>
                <p>There are currently no outstanding visit requests awaiting technician assignments.</p>
            </div>
        @endforelse

        <div class="pending-empty-card no-filter-result" id="noFilterResult">
            <div class="pending-empty-icon">
                <i class="bi bi-search"></i>
            </div>
            <h3>No Matching Bookings</h3>
            <p>No bookings match the selected filter or search keyword.</p>
        </div>
    </div>
</div>

<script>
    document.addEventListener("DOMContentLoaded", function() {
        const successNotify = document.getElementById('popup-notification');
        const errorNotify = document.getElementById('popup-notification-error');
        const filterButtons = document.querySelectorAll('.filter-btn');
        const searchInput = document.getElementById('bookingSearch');
        const cards = document.querySelectorAll('.booking-card');
        const noFilterResult = document.getElementById('noFilterResult');

        let activeFilter = 'all';

        function hideNotification(element) {
            if (!element) return;

            setTimeout(function() {
                element.style.transition = 'opacity 0.5s ease';
                element.style.opacity = '0';
                setTimeout(() => element.style.display = 'none', 500);
            }, 3500);
        }

        function applyBookingFilter() {
            const keyword = (searchInput?.value || '').toLowerCase().trim();
            let visibleCount = 0;

            cards.forEach(card => {
                const category = card.dataset.deviceCategory;
                const searchText = card.dataset.search || '';

                const matchFilter = activeFilter === 'all' || category === activeFilter;
                const matchSearch = keyword === '' || searchText.includes(keyword);

                if (matchFilter && matchSearch) {
                    card.style.display = 'grid';
                    visibleCount++;
                } else {
                    card.style.display = 'none';
                }
            });

            if (noFilterResult) {
                noFilterResult.style.display = visibleCount === 0 && cards.length > 0 ? 'flex' : 'none';
            }
        }

        filterButtons.forEach(button => {
            button.addEventListener('click', function() {
                filterButtons.forEach(btn => btn.classList.remove('active'));
                this.classList.add('active');
                activeFilter = this.dataset.filter;
                applyBookingFilter();
            });
        });

        if (searchInput) {
            searchInput.addEventListener('input', applyBookingFilter);
        }

        hideNotification(successNotify);
        hideNotification(errorNotify);
        applyBookingFilter();
    });
</script>
@endsection
