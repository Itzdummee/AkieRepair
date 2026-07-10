@extends('layouts.customer')

@section('title', 'Repair Prices & Services')

@section('content')

<style>
    .modern-header {
        position: relative;
        background: #0f172a;
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
        background: linear-gradient(135deg, #3b82f6, #8b5cf6);
        width: 72px;
        height: 72px;
        border-radius: 20px;
        display: flex;
        align-items: center;
        justify-content: center;
        font-size: 2rem;
        color: white;
        box-shadow: 0 10px 15px -3px rgba(59, 130, 246, 0.5);
        flex-shrink: 0;
    }
    .modern-header .header-title {
        font-size: 2.2rem;
        font-weight: 800;
        margin: 0 0 8px 0;
        letter-spacing: -0.025em;
    }
    .modern-header .header-subtitle {
        font-size: 1.05rem;
        color: #94a3b8;
        margin: 0;
        max-width: 600px;
        line-height: 1.5;
    }
    .modern-header .header-decoration {
        position: absolute;
        top: -50%;
        right: -10%;
        width: 400px;
        height: 400px;
        background: radial-gradient(circle, rgba(139,92,246,0.25) 0%, rgba(15,23,42,0) 70%);
        border-radius: 50%;
        z-index: 1;
        pointer-events: none;
    }
    @media(max-width: 600px) {
        .modern-header { padding: 24px; }
        .modern-header .header-content { flex-direction: column; text-align: center; gap: 16px; }
        .modern-header .header-title { font-size: 1.75rem; }
    }

    /* Filters Bar */
    .controls-bar {
        position: relative;
        display: flex;
        align-items: center;
        margin-bottom: 32px;
        background: white;
        padding: 16px 24px;
        border-radius: 20px;
        border: 1px solid #e2e8f0;
        box-shadow: 0 10px 15px -3px rgba(0, 0, 0, 0.04), 0 4px 6px -4px rgba(0, 0, 0, 0.04);
        min-height: 76px;
        box-sizing: border-box;
        overflow: visible;
        transition: all 0.3s cubic-bezier(0.4, 0, 0.2, 1);
    }
    .tabs-container {
        display: flex;
        align-items: center;
        gap: 16px;
        width: 100%;
        opacity: 1;
        visibility: visible;
        transform: translateY(0);
        transition: all 0.3s cubic-bezier(0.4, 0, 0.2, 1);
    }
    .search-bar-container {
        position: static;
        display: flex;
        align-items: center;
        flex: 1 1 280px;
        min-width: 220px;
    }
    .search-wrapper {
        position: relative;
        flex: 1;
        margin: 0;
    }
    .search-wrapper i {
        position: absolute;
        left: 16px;
        top: 50%;
        transform: translateY(-50%);
        color: #64748b;
        font-size: 1.15rem;
        transition: color 0.2s ease;
    }
    .search-input {
        width: 100%;
        padding: 12px 16px 12px 48px;
        border-radius: 12px;
        border: 1.5px solid #cbd5e1;
        background: #f8fafc;
        color: #0f172a;
        font-size: 0.95rem;
        box-sizing: border-box;
        transition: all 0.3s cubic-bezier(0.4, 0, 0.2, 1);
    }
    .search-input:focus {
        outline: none;
        border-color: #3b82f6;
        background: white;
        box-shadow: 0 0 0 4px rgba(59, 130, 246, 0.12);
    }
    .search-input:focus + i {
        color: #3b82f6;
    }
    .filter-tabs {
        display: flex;
        gap: 8px;
        flex: 1 1 auto;
        overflow-x: auto;
        scrollbar-width: thin;
    }
    .filter-tab {
        padding: 10px 20px;
        border-radius: 10px;
        font-weight: 700;
        font-size: 0.9rem;
        border: 1px solid #e2e8f0;
        background: white;
        color: #475569;
        cursor: pointer;
        transition: all 0.2s ease;
    }
    .filter-tab:hover {
        background: #f8fafc;
        color: #0f172a;
        transform: translateY(-1px);
    }
    .filter-tab.active {
        background: #0f172a;
        color: white;
        border-color: #0f172a;
    }

    @media(max-width: 600px) {
        .controls-bar {
            padding: 12px 16px;
            flex-direction: column;
            align-items: stretch;
        }
        .tabs-container { flex-direction: column; align-items: stretch; }
        .search-bar-container { min-width: 0; width: 100%; }
    }

    /* Device Section Card */
    .device-section-card {
        background: white;
        border-radius: 20px;
        padding: 32px;
        box-shadow: 0 4px 6px -1px rgba(0, 0, 0, 0.05), 0 2px 4px -1px rgba(0, 0, 0, 0.03);
        border: 1px solid #f3f4f6;
        margin-bottom: 32px;
        transition: transform 0.2s ease, box-shadow 0.2s ease;
    }
    .device-section-card:hover {
        box-shadow: 0 10px 15px -3px rgba(0, 0, 0, 0.08);
    }
    .device-header {
        display: flex;
        align-items: center;
        justify-content: space-between;
        border-bottom: 2px solid #f1f5f9;
        padding-bottom: 20px;
        margin-bottom: 24px;
        flex-wrap: wrap;
        gap: 12px;
    }
    .device-title-box h2 {
        margin: 0 0 6px 0;
        font-size: 1.5rem;
        font-weight: 800;
        color: #0f172a;
        letter-spacing: -0.025em;
    }
    .device-title-box p {
        margin: 0;
        color: #64748b;
        font-size: 0.95rem;
    }
    .device-badge {
        font-size: 0.75rem;
        font-weight: 800;
        text-transform: uppercase;
        letter-spacing: 0.05em;
        padding: 6px 14px;
        border-radius: 9999px;
    }
    .device-badge.smartphone {
        background: #eff6ff;
        color: #1d4ed8;
    }
    .device-badge.television {
        background: #f5f3ff;
        color: #6d28d9;
    }
    .device-badge.refrigerator {
        background: #e6fbf3;
        color: #047857;
    }
    .device-badge.washingmachine {
        background: #fffbeb;
        color: #b45309;
    }

    /* Services Grid inside Device */
    .services-stack {
        display: flex;
        flex-direction: column;
        gap: 24px;
    }
    .service-group {
        background: #f8fafc;
        border: 1px solid #e2e8f0;
        border-radius: 14px;
        padding: 24px;
    }
    .service-group h3 {
        margin: 0 0 8px 0;
        font-size: 1.15rem;
        font-weight: 800;
        color: #1e293b;
        display: flex;
        align-items: center;
        gap: 8px;
    }
    .service-group h3 i {
        color: #3b82f6;
    }
    .service-desc {
        margin: 0 0 20px 0;
        color: #64748b;
        font-size: 0.9rem;
        line-height: 1.5;
    }

    /* Repairs Table */
    .repairs-table-container {
        overflow-x: auto;
        border-radius: 10px;
        border: 1px solid #e2e8f0;
        background: white;
    }
    .repairs-table {
        width: 100%;
        border-collapse: collapse;
        text-align: left;
        font-size: 0.9rem;
    }
    .repairs-table th {
        background: #f1f5f9;
        color: #475569;
        font-weight: 700;
        padding: 14px 16px;
        text-transform: uppercase;
        font-size: 0.75rem;
        letter-spacing: 0.05em;
        border-bottom: 1px solid #e2e8f0;
    }
    .repairs-table td {
        padding: 16px;
        border-bottom: 1px solid #e2e8f0;
        color: #334155;
        vertical-align: middle;
    }
    .repairs-table tr:last-child td {
        border-bottom: none;
    }
    .repair-name {
        font-weight: 700;
        color: #0f172a;
        margin-bottom: 4px;
    }
    .repair-desc {
        color: #64748b;
        font-size: 0.85rem;
        margin: 0;
        line-height: 1.4;
    }
    .repair-price {
        font-size: 1.05rem;
        font-weight: 800;
        color: #10b981;
        white-space: nowrap;
    }
    .meta-badge {
        display: inline-block;
        padding: 4px 10px;
        border-radius: 8px;
        font-size: 0.75rem;
        font-weight: 700;
        background: #f1f5f9;
        color: #475569;
        border: 1px solid #e2e8f0;
        white-space: nowrap;
    }

    /* Book Button */
    .btn-book {
        display: inline-flex;
        align-items: center;
        gap: 6px;
        background: #2563eb;
        color: white;
        padding: 8px 16px;
        border-radius: 8px;
        font-weight: 700;
        font-size: 0.85rem;
        text-decoration: none;
        transition: all 0.2s ease;
        border: none;
        cursor: pointer;
        box-shadow: 0 2px 4px rgba(37, 99, 235, 0.1);
        white-space: nowrap;
    }
    .btn-book:hover {
        background: #1d4ed8;
        transform: translateY(-1px);
        box-shadow: 0 4px 8px rgba(37, 99, 235, 0.2);
    }
    .btn-book:active {
        transform: translateY(0);
    }

    /* No Results */
    .no-results {
        text-align: center;
        padding: 48px 24px;
        background: white;
        border-radius: 20px;
        border: 1px solid #e2e8f0;
        color: #64748b;
    }
    .no-results i {
        font-size: 3rem;
        color: #cbd5e1;
        margin-bottom: 16px;
        display: block;
    }
    .no-results h3 {
        margin: 0 0 8px 0;
        color: #0f172a;
        font-size: 1.25rem;
    }
</style>

<!-- Header Banner -->
<div class="modern-header">
    <div class="header-content">
        <div class="icon-wrapper">
            <i class="bi bi-tag"></i>
        </div>
        <div>
            <h1 class="header-title">Repair prices</h1>
            <p class="header-subtitle">Transparent pricing, warranty duration, and service intervals. Click 'Book Visit' on any repair action to start a booking immediately.</p>
        </div>
    </div>
    <div class="header-decoration"></div>
</div>

<!-- Controls Bar: Search & Category filter -->
<div class="controls-bar">
    <!-- Tabs Container (visible by default) -->
    <div class="tabs-container" id="tabsContainer">
        <div class="filter-tabs">
            <button class="filter-tab active" onclick="filterCategory('all', this)">Show All</button>
            <button class="filter-tab" onclick="filterCategory('smartphone', this)">Smartphones</button>
            <button class="filter-tab" onclick="filterCategory('television', this)">Televisions</button>
            <button class="filter-tab" onclick="filterCategory('refrigerator', this)">Refrigerators</button>
            <button class="filter-tab" onclick="filterCategory('washingmachine', this)">Washing Machines</button>
        </div>
        <div class="search-bar-container" id="searchBarContainer">
            <div class="search-wrapper">
                <i class="bi bi-search"></i>
                <input type="search" id="deviceSearch" placeholder="Search brand or model..." aria-label="Search devices by brand or model" class="search-input" oninput="filterDevices()">
            </div>
        </div>
    </div>
</div>

<!-- Devices Container -->
<div id="devicesContainer">
    @forelse($repairs as $deviceId => $deviceRepairs)
        @php
            $device = $deviceRepairs->first()->device;
            $deviceType = strtolower(str_replace(' ', '', $device->type ?? ''));
            // Group the repairs of this device by Service
            $repairsByService = $deviceRepairs->groupBy('service_id');
        @endphp

        <div class="device-section-card" data-device-type="{{ $deviceType }}" data-device-name="{{ strtolower($device->brand . ' ' . $device->name) }}">
            
            <div class="device-header">
                <div class="device-title-box">
                    <h2>{{ $device->name }}</h2>
                    <p>{{ $device->brand }}</p>
                </div>
                <span class="device-badge {{ $deviceType }}">
                    {{ $device->type }}
                </span>
            </div>

            <div class="services-stack">
                @foreach($repairsByService as $serviceId => $serviceRepairs)
                    @php
                        $service = $serviceRepairs->first()->service;
                    @endphp

                    @if($service)
                        <div class="service-group">
                            <h3><i class="bi bi-gear-wide-connected"></i> {{ $service->service_type }}</h3>
                            @if($service->description)
                                <p class="service-desc">{{ $service->description }}</p>
                            @endif

                            <div class="repairs-table-container">
                                <table class="repairs-table">
                                    <thead>
                                        <tr>
                                            <th>Repair Action</th>
                                            <th>Warranty</th>
                                            <th>Duration</th>
                                            <th>Price</th>
                                            <th style="width: 120px; text-align: right;">Action</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        @foreach($serviceRepairs as $repair)
                                            <tr>
                                                <td>
                                                    <div class="repair-name">{{ $repair->repair_type }}</div>
                                                    @if($repair->description)
                                                        <p class="repair-desc">{{ $repair->description }}</p>
                                                    @endif
                                                </td>
                                                <td>
                                                    <span class="meta-badge">
                                                        <i class="bi bi-shield-check"></i> {{ $repair->warranty_period ?? 'No Warranty' }}
                                                    </span>
                                                </td>
                                                <td>
                                                    <span class="meta-badge">
                                                        <i class="bi bi-hourglass-split"></i> {{ $repair->duration ?? 'Contact Staff' }}
                                                    </span>
                                                </td>
                                                <td>
                                                    <div class="repair-price">RM {{ number_format($repair->price, 2) }}</div>
                                                </td>
                                                <td style="text-align: right;">
                                                    @php
                                                        $problemMsg = 'Need ' . $repair->repair_type . ' for my ' . $device->brand . ' ' . $device->name . '. (Estimated Price: RM ' . number_format($repair->price, 2) . ')';
                                                    @endphp
                                                    <a href="{{ route('customer.booking.create', ['device_id' => $device->id, 'problem_description' => $problemMsg]) }}" 
                                                       class="btn-book">
                                                        <i class="bi bi-calendar-plus-fill"></i> Book Visit
                                                    </a>
                                                </td>
                                            </tr>
                                        @endforeach
                                    </tbody>
                                </table>
                            </div>
                        </div>
                    @endif
                @endforeach
            </div>

        </div>
    @empty
        <div class="no-results">
            <i class="bi bi-clipboard-x"></i>
            <h3>No repairs available</h3>
            <p>We are currently updating our price lists. Please check back later.</p>
        </div>
    @endforelse
</div>

<!-- No Matches message -->
<div id="noMatches" class="no-results" style="display: none; margin-top: 32px;">
    <i class="bi bi-search"></i>
    <h3>No matching devices found</h3>
    <p>Try searching for a different brand or model name.</p>
</div>

<script>
    let activeCategory = 'all';

    function filterDevices() {
        const query = document.getElementById('deviceSearch').value.toLowerCase();
        const cards = document.querySelectorAll('.device-section-card');
        let visibleCount = 0;

        cards.forEach(card => {
            const name = card.getAttribute('data-device-name') || '';
            const type = card.getAttribute('data-device-type') || '';
            
            const matchesSearch = name.includes(query);
            const matchesCategory = (activeCategory === 'all' || type === activeCategory);

            if (matchesSearch && matchesCategory) {
                card.style.display = 'block';
                visibleCount++;
            } else {
                card.style.display = 'none';
            }
        });

        const noMatchesDiv = document.getElementById('noMatches');
        if (visibleCount === 0 && cards.length > 0) {
            noMatchesDiv.style.display = 'block';
        } else {
            noMatchesDiv.style.display = 'none';
        }
    }

    function filterCategory(category, buttonEl) {
        // Toggle active tabs
        document.querySelectorAll('.filter-tab').forEach(tab => {
            tab.classList.remove('active');
        });
        buttonEl.classList.add('active');

        activeCategory = category;
        filterDevices();
    }
</script>

@endsection
