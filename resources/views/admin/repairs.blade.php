@extends('layouts.admin')

@section('title', 'Repair Prices')

@section('content')

<style>
    .rep-container {
        display: flex;
        flex-direction: column;
        gap: 30px;
    }
    
    /* Header & Panel styling */
    .rep-header {
        background: #ffffff;
        border: 1px solid rgba(229, 231, 235, 0.8);
        border-radius: 16px;
        padding: 24px;
        display: flex;
        justify-content: space-between;
        align-items: center;
        box-shadow: 0 4px 6px -1px rgba(0, 0, 0, 0.05);
    }
    
    .rep-title h1 {
        font-family: 'Playfair Display', serif;
        font-size: 28px;
        font-weight: 700;
        color: #111827;
        margin-bottom: 6px;
    }
    
    .rep-title p {
        font-size: 14px;
        color: #6b7280;
    }

    /* Stacked Layout Container */
    .rep-dashboard-grid {
        display: flex;
        flex-direction: column;
        gap: 32px;
    }

    /* Column Headers */
    .column-header {
        display: flex;
        justify-content: space-between;
        align-items: center;
        margin-bottom: 18px;
    }

    .column-header h2 {
        font-family: 'Playfair Display', serif;
        font-size: 22px;
        font-weight: 700;
        color: #111827;
        display: flex;
        align-items: center;
        gap: 8px;
    }
    
    .btn-create-new {
        background: linear-gradient(135deg, #111827, #374151);
        color: #ffffff !important;
        padding: 8px 16px;
        border-radius: 10px;
        font-weight: 700;
        font-size: 12px;
        display: inline-flex;
        align-items: center;
        gap: 6px;
        box-shadow: 0 3px 8px rgba(17, 24, 39, 0.1);
        border: none;
        cursor: pointer;
        transition: all 0.25s cubic-bezier(0.4, 0, 0.2, 1);
        text-transform: uppercase;
        letter-spacing: 0.05em;
    }
    
    .btn-create-new:hover {
        background: linear-gradient(135deg, #374151, #4b5563);
        transform: translateY(-1px);
        box-shadow: 0 4px 12px rgba(17, 24, 39, 0.15);
    }

    /* Service Cards (Horizontal Grid Layout) */
    .service-card-list {
        display: grid;
        grid-template-columns: repeat(auto-fill, minmax(280px, 1fr));
        gap: 18px;
    }

    .service-category-card {
        background: #ffffff;
        border: 1px solid rgba(229, 231, 235, 0.8);
        border-radius: 14px;
        padding: 16px 20px;
        display: flex;
        justify-content: space-between;
        align-items: center;
        box-shadow: 0 2px 4px rgba(0,0,0,0.02);
        transition: all 0.3s cubic-bezier(0.4, 0, 0.2, 1);
    }

    .service-category-card:hover {
        transform: translateY(-2px);
        box-shadow: 0 8px 15px -3px rgba(0,0,0,0.05);
        border-color: rgba(59, 130, 246, 0.3);
    }

    .service-meta-flex {
        display: flex;
        align-items: center;
        gap: 12px;
    }

    .service-card-icon {
        width: 40px;
        height: 40px;
        border-radius: 10px;
        display: grid;
        place-items: center;
        font-size: 18px;
    }

    .service-card-details {
        display: flex;
        flex-direction: column;
    }

    .service-card-name {
        font-weight: 700;
        color: #111827;
        font-size: 15px;
    }

    .service-card-subtitle {
        font-size: 12px;
        color: #9ca3af;
    }

    /* Alert Notifications */
    .alert-panel {
        padding: 16px 20px;
        border-radius: 12px;
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
    
    .alert-delete-panel {
        background-color: #fef2f2;
        border: 1px solid #fca5a5;
        color: #991b1b;
    }

    /* SaaS style table panel (Right Column) */
    .rep-table-panel {
        background: #ffffff;
        border: 1px solid rgba(229, 231, 235, 0.8);
        border-radius: 18px;
        padding: 24px;
        box-shadow: 0 4px 6px -1px rgba(0, 0, 0, 0.04);
    }

    /* High-Fidelity Table custom styling */
    .rep-table {
        width: 100% !important;
        border-collapse: separate !important;
        border-spacing: 0 !important;
        margin-top: 10px;
    }
    
    .rep-table th {
        background: #f9fafb !important;
        padding: 14px 16px !important;
        font-size: 11px !important;
        font-weight: 700 !important;
        color: #4b5563 !important;
        text-transform: uppercase !important;
        letter-spacing: 0.05em !important;
        border-bottom: 1px solid #e5e7eb !important;
        border-top: none !important;
    }
    
    .rep-table th:first-child { border-top-left-radius: 10px; }
    .rep-table th:last-child { border-top-right-radius: 10px; }
    
    .rep-table td {
        padding: 14px 16px !important;
        border-bottom: 1px solid #f3f4f6 !important;
        color: #374151 !important;
        font-size: 14px !important;
        vertical-align: middle !important;
        background: transparent !important;
    }
    
    .rep-table tr:hover td {
        background: #f9fafb !important;
    }
    
    .rep-table tr:last-child td {
        border-bottom: none !important;
    }

    /* Color Badges */
    .type-badge-pill {
        display: inline-flex;
        align-items: center;
        gap: 5px;
        padding: 4px 10px;
        border-radius: 50px;
        font-size: 10px;
        font-weight: 700;
        text-transform: uppercase;
        letter-spacing: 0.03em;
    }
    
    .badge-phone { border: 1px solid #d1fae5; background-color: #ecfdf5; color: #065f46; }
    .badge-tv { border: 1px solid #e0f2fe; background-color: #f0f9ff; color: #0369a1; }
    .badge-fridge { border: 1px solid #dbeafe; background-color: #eff6ff; color: #1d4ed8; }
    .badge-washer { border: 1px solid #fef3c7; background-color: #fffbeb; color: #92400e; }
    .badge-generic { border: 1px solid #f3e8ff; background-color: #faf5ff; color: #6b21a8; }

    /* Actions styling */
    .action-row {
        display: flex;
        gap: 6px;
    }
    
    .btn-action-small {
        height: 30px;
        padding: 0 10px;
        border-radius: 6px;
        font-weight: 700;
        font-size: 10px;
        text-transform: uppercase;
        letter-spacing: 0.05em;
        display: inline-flex;
        align-items: center;
        justify-content: center;
        gap: 4px;
        cursor: pointer;
        transition: all 0.2s ease;
        border: none;
        color: #ffffff;
    }

    .btn-action-icon {
        width: 30px;
        height: 30px;
        border-radius: 6px;
        display: inline-flex;
        align-items: center;
        justify-content: center;
        cursor: pointer;
        transition: all 0.2s ease;
        border: none;
    }
    
    .btn-edit {
        background: #eff6ff;
        color: #1d4ed8;
    }
    
    .btn-edit:hover {
        background: #dbeafe;
        transform: translateY(-1px);
    }
    
    .btn-delete {
        background: #fef2f2;
        color: #b91c1c;
    }
    
    .btn-delete:hover {
        background: #fee2e2;
        transform: translateY(-1px);
    }

    /* Modal styling overhauls */
    .modal-overlay {
        position: fixed;
        inset: 0;
        background: rgba(17, 24, 39, 0.6);
        backdrop-filter: blur(4px);
        display: flex;
        justify-content: center;
        align-items: center;
        z-index: 9998;
        transition: opacity 0.3s ease;
    }
    
    .modal-box {
        width: 560px;
        max-width: 92%;
        background: #ffffff;
        border-radius: 20px;
        padding: 35px;
        box-shadow: 0 25px 50px -12px rgba(0, 0, 0, 0.25);
        border: 1px solid rgba(229, 231, 235, 0.5);
        transform: scale(0.95);
        transition: transform 0.3s cubic-bezier(0.34, 1.56, 0.64, 1);
    }
    
    .modal-overlay:not(.hide) .modal-box {
        transform: scale(1);
    }
    
    .modal-header {
        display: flex;
        justify-content: space-between;
        align-items: center;
        margin-bottom: 24px;
    }
    
    .modal-title {
        font-family: 'Playfair Display', serif;
        font-size: 24px;
        font-weight: 700;
        color: #111827;
    }
    
    .modal-close {
        border: none;
        background: #f3f4f6;
        color: #4b5563;
        width: 36px;
        height: 36px;
        border-radius: 50%;
        font-size: 20px;
        cursor: pointer;
        display: grid;
        place-items: center;
        transition: all 0.2s ease;
    }
    
    .modal-close:hover {
        background: #fee2e2;
        color: #ef4444;
    }
    
    .form-group {
        margin-bottom: 16px;
    }
    
    .form-group label {
        display: block;
        font-size: 12px;
        font-weight: 700;
        color: #374151;
        margin-bottom: 6px;
        text-transform: uppercase;
        letter-spacing: 0.05em;
    }
    
    .form-control {
        width: 100%;
        padding: 10px 14px;
        border: 1.5px solid #e5e7eb;
        border-radius: 10px;
        font-size: 14px;
        color: #111827;
        background-color: #f9fafb;
        transition: all 0.2s ease;
        margin-bottom: 0;
    }
    
    .form-control:focus {
        border-color: #3b82f6;
        background-color: #ffffff;
        box-shadow: 0 0 0 3px rgba(59, 130, 246, 0.15);
        outline: none;
    }
    
    .form-actions {
        display: flex;
        justify-content: flex-end;
        gap: 12px;
        margin-top: 24px;
        padding-top: 18px;
        border-top: 1px solid #f3f4f6;
    }
    
    .btn-modal {
        padding: 10px 20px;
        border-radius: 10px;
        font-weight: 700;
        font-size: 13px;
        cursor: pointer;
        transition: all 0.2s ease;
        text-transform: uppercase;
        letter-spacing: 0.05em;
        border: none;
    }
    
    .btn-modal-cancel {
        background: #f3f4f6;
        color: #4b5563;
    }
    
    .btn-modal-cancel:hover {
        background: #e5e7eb;
        color: #1f2937;
    }
    
    .btn-modal-submit {
        background: linear-gradient(135deg, #111827, #374151);
        color: #ffffff;
        box-shadow: 0 4px 10px rgba(0, 0, 0, 0.15);
    }
    
    .btn-modal-submit:hover {
        background: linear-gradient(135deg, #374151, #4b5563);
        transform: translateY(-1px);
    }

    /* DataTable Overrides */
    .dataTables_wrapper .dataTables_filter {
        margin-bottom: 15px;
    }
    .dataTables_wrapper .dataTables_filter input {
        border: 1.5px solid #e5e7eb !important;
        border-radius: 10px !important;
        padding: 7px 12px !important;
        background-color: #f9fafb !important;
        width: 200px !important;
        max-width: 200px !important;
        font-size: 13px !important;
    }
    .dataTables_wrapper .dataTables_filter input:focus {
        outline: none !important;
        border-color: #3b82f6 !important;
        background-color: #ffffff !important;
        box-shadow: 0 0 0 3px rgba(59, 130, 246, 0.15) !important;
    }
    .dataTables_wrapper .dataTables_length select {
        border: 1.5px solid #e5e7eb !important;
        border-radius: 8px !important;
        padding: 5px 10px !important;
        font-size: 13px !important;
    }
    .dataTables_wrapper .dataTables_info {
        font-size: 12px;
        color: #6b7280;
        margin-top: 10px;
    }
    .dataTables_wrapper .dataTables_paginate {
        margin-top: 10px;
    }
    .dataTables_wrapper .dataTables_paginate .paginate_button {
        padding: 4px 10px !important;
        border-radius: 6px !important;
        border: 1px solid transparent !important;
        font-size: 12px !important;
        font-weight: 600 !important;
    }
    .dataTables_wrapper .dataTables_paginate .paginate_button.current {
        background: linear-gradient(135deg, #111827, #374151) !important;
        color: white !important;
        border: none !important;
    }

    @media(max-width: 1024px) {
        .rep-dashboard-grid {
            grid-template-columns: 1fr;
        }
    }

    /* Modern Premium Metrics Strip */
    .rep-metrics-strip {
        display: grid;
        grid-template-columns: repeat(4, 1fr);
        gap: 20px;
        margin-top: 10px;
        margin-bottom: 5px;
    }
    
    .metric-card-premium {
        background: #ffffff;
        border: 1px solid rgba(229, 231, 235, 0.8);
        border-radius: 16px;
        padding: 20px;
        display: flex;
        align-items: center;
        gap: 16px;
        box-shadow: 0 4px 6px -1px rgba(0, 0, 0, 0.02);
        transition: all 0.25s cubic-bezier(0.4, 0, 0.2, 1);
    }
    
    .metric-card-premium:hover {
        transform: translateY(-2px);
        box-shadow: 0 10px 15px -3px rgba(0, 0, 0, 0.05);
        border-color: rgba(59, 130, 246, 0.2);
    }
    
    .metric-icon-wrap {
        width: 48px;
        height: 48px;
        border-radius: 12px;
        display: grid;
        place-items: center;
        font-size: 22px;
    }
    
    .metric-info-premium {
        display: flex;
        flex-direction: column;
    }
    
    .metric-label-premium {
        font-size: 11px;
        font-weight: 700;
        color: #6b7280;
        text-transform: uppercase;
        letter-spacing: 0.05em;
        margin-bottom: 2px;
    }
    
    .metric-value-premium {
        font-size: 22px;
        font-weight: 800;
        color: #111827;
        line-height: 1.2;
    }

    @media(max-width: 900px) {
        .rep-metrics-strip {
            grid-template-columns: repeat(2, 1fr);
        }
    }
    @media(max-width: 500px) {
        .rep-metrics-strip {
            grid-template-columns: 1fr;
        }
    }
</style>

<div class="rep-container">
    
    <!-- Header panel -->
    <div class="rep-header">
        <div class="rep-title">
            <h1>Repair Prices</h1>
            <p>Manage repair service categories and granular hardware replacement pricing in one streamlined workspace.</p>
        </div>
        <div style="display: flex; gap: 12px;">
            <button type="button" class="btn-create-new" onclick="openServiceModal()" style="background: linear-gradient(135deg, #2563eb, #1d4ed8);">
                <i class="bi bi-folder-plus"></i>
                <span>Add Category</span>
            </button>
            <button type="button" class="btn-create-new" onclick="openRepairModal()">
                <i class="bi bi-tools"></i>
                <span>Add Repair Price</span>
            </button>
        </div>
    </div>

    <!-- Overview Metrics Strip -->
    <div class="rep-metrics-strip">
        <div class="metric-card-premium">
            <div class="metric-icon-wrap" style="background: #eff6ff; color: #2563eb;">
                <i class="bi bi-collection"></i>
            </div>
            <div class="metric-info-premium">
                <span class="metric-label-premium">Categories</span>
                <span class="metric-value-premium">{{ $totalServices }} Fields</span>
            </div>
        </div>

        <div class="metric-card-premium">
            <div class="metric-icon-wrap" style="background: #ecfdf5; color: #10b981;">
                <i class="bi bi-tools"></i>
            </div>
            <div class="metric-info-premium">
                <span class="metric-label-premium">Repair Rules</span>
                <span class="metric-value-premium">{{ $totalRepairs }} Records</span>
            </div>
        </div>

        <div class="metric-card-premium">
            <div class="metric-icon-wrap" style="background: #faf5ff; color: #7c3aed;">
                <i class="bi bi-tags"></i>
            </div>
            <div class="metric-info-premium">
                <span class="metric-label-premium">Avg Pricing</span>
                <span class="metric-value-premium">RM {{ number_format($avgRepairPrice, 2) }}</span>
            </div>
        </div>

        <div class="metric-card-premium">
            <div class="metric-icon-wrap" style="background: #fffbeb; color: #d97706;">
                <i class="bi bi-star"></i>
            </div>
            <div class="metric-info-premium">
                <span class="metric-label-premium">Primary Field</span>
                <span class="metric-value-premium" style="font-size: 15px; font-weight: 800; padding-top: 4px;">{{ $popularServiceName }}</span>
            </div>
        </div>
    </div>

    <!-- Alert Notifications -->
    

    @if(session('delete'))
        <div class="alert-panel alert-delete-panel" id="popup-notification-delete">
            <i class="bi bi-trash3-fill" style="font-size: 18px;"></i>
            <span>{{ session('delete') }}</span>
        </div>
    @endif

    @if($errors->any())
        <div class="alert-panel alert-delete-panel" id="popup-notification-errors">
            <i class="bi bi-exclamation-triangle-fill" style="font-size: 18px;"></i>
            <div style="flex: 1;">
                <span style="font-weight: 700; display: block; margin-bottom: 4px;">Please correct the errors below:</span>
                <ul style="margin: 0; padding-left: 20px; font-weight: 500;">
                    @foreach($errors->all() as $error)
                        <li>{{ $error }}</li>
                    @endforeach
                </ul>
            </div>
        </div>
    @endif

    <!-- Split Grid Dashboard -->
    <div class="rep-dashboard-grid">
        
        <!-- Left Column: Service Categories -->
        <div>
            <div class="column-header">
                <h2>
                    <i class="bi bi-collection-fill" style="color: #2563eb;"></i>
                    <span>Service Categories</span>
                </h2>
                <span style="font-size: 13px; font-weight: 700; background: #e0f2fe; color: #0369a1; padding: 4px 10px; border-radius: 8px;">
                    {{ $services->count() }} main fields
                </span>
            </div>

            <div class="service-card-list">
                @forelse($services as $service)
                    @php
                        // Assign background gradients & icons based on service names
                        $bgGradient = 'linear-gradient(135deg, #f0fdf4, #dcfce7)';
                        $iconColor = '#10b981';
                        $iconClass = 'bi-phone';
                        $iconBg = '#d1fae5';
                        
                        $sName = strtolower($service->service_type);
                        if (str_contains($sName, 'tv')) {
                            $bgGradient = 'linear-gradient(135deg, #f0f9ff, #e0f2fe)';
                            $iconColor = '#0284c7';
                            $iconClass = 'bi-tv';
                            $iconBg = '#e0f2fe';
                        } elseif (str_contains($sName, 'refrigerator') || str_contains($sName, 'fridge')) {
                            $bgGradient = 'linear-gradient(135deg, #eff6ff, #dbeafe)';
                            $iconColor = '#2563eb';
                            $iconClass = 'bi-snow';
                            $iconBg = '#dbeafe';
                        } elseif (str_contains($sName, 'washing') || str_contains($sName, 'washer')) {
                            $bgGradient = 'linear-gradient(135deg, #fffbeb, #fef3c7)';
                            $iconColor = '#d97706';
                            $iconClass = 'bi-water';
                            $iconBg = '#fef3c7';
                        } elseif (str_contains($sName, 'phone') || str_contains($sName, 'mobile') || str_contains($sName, 'smartphone')) {
                            $bgGradient = 'linear-gradient(135deg, #f0fdf4, #dcfce7)';
                            $iconColor = '#10b981';
                            $iconClass = 'bi-phone';
                            $iconBg = '#d1fae5';
                        } else {
                            $bgGradient = 'linear-gradient(135deg, #faf5ff, #f3e8ff)';
                            $iconColor = '#7c3aed';
                            $iconClass = 'bi-box-seam';
                            $iconBg = '#f3e8ff';
                        }
                    @endphp
                    
                    <div class="service-category-card" style="background: {{ $bgGradient }};">
                        <div class="service-meta-flex">
                            <div class="service-card-icon" style="background: {{ $iconBg }}; color: {{ $iconColor }};">
                                <i class="bi {{ $iconClass }}"></i>
                            </div>
                            <div class="service-card-details">
                                <span class="service-card-name">{{ $service->service_type }}</span>
                                <span class="service-card-subtitle">
                                    {{ $service->repairs->count() }} repairs registered · {{ $service->is_active ? 'Active' : 'Inactive' }}
                                </span>
                            </div>
                        </div>

                        <div class="action-row">
                            <button
                                type="button"
                                class="btn-action-icon btn-edit"
                                onclick="openServiceEditModal(
                                    '{{ $service->id }}',
                                    @js($service->service_type)
                                )"
                                title="Edit Service Name">
                                <i class="bi bi-pencil-square"></i>
                            </button>

                            <form method="POST" action="{{ route('admin.services.destroy', $service->id) }}" style="margin: 0;" onsubmit="return confirm('{{ $service->is_active ? 'Deactivate' : 'Activate' }} service category \'{{ $service->service_type }}\'?')">
                                @csrf
                                @method('DELETE')
                                <button type="submit" class="btn-action-icon btn-delete" title="{{ $service->is_active ? 'Deactivate Service Category' : 'Activate Service Category' }}">
                                    <i class="bi {{ $service->is_active ? 'bi-pause-circle-fill' : 'bi-play-circle-fill' }}"></i>
                                </button>
                            </form>
                        </div>
                    </div>
                @empty
                    <div style="background: #ffffff; border: 1px dashed #d1d5db; padding: 40px 20px; text-align: center; border-radius: 14px;">
                        <i class="bi bi-folder-x" style="font-size: 32px; color: #9ca3af; display: block; margin-bottom: 8px;"></i>
                        <span style="font-weight: 700; color: #4b5563; display: block;">No Service Categories</span>
                        <p style="color: #6b7280; font-size: 13px; margin: 4px 0 0;">Add your first main service type (e.g. Phone Repair).</p>
                    </div>
                @endforelse
            </div>
        </div>

        <!-- Right Column: Repair Pricing Registry -->
        <div>
            <div class="column-header">
                <h2>
                    <i class="bi bi-tools" style="color: #111827;"></i>
                    <span>Repair Pricing Rules</span>
                </h2>
                <span style="font-size: 13px; font-weight: 700; background: #f3f4f6; color: #1f2937; padding: 4px 10px; border-radius: 8px;">
                    {{ $repairs->count() }} records
                </span>
            </div>

            <div class="rep-table-panel">
                <div class="table-wrap">
                    <table class="rep-table" id="repairPricingTable">
                        <thead>
                            <tr>
                                <th>Repair Type</th>
                                <th>Service Category</th>
                                <th>Applicable Device</th>
                                <th style="text-align: right; width: 100px;">Base Price</th>
                                <th style="text-align: center; width: 140px;">Warranty & Time</th>
                                <th style="text-align: center; width: 100px;">Status</th>
                                <th style="width: 100px; text-align: center;">Actions</th>
                            </tr>
                        </thead>

                        <tbody>
                            @foreach($repairs as $repair)
                                <tr>
                                    <!-- Repair Type Name -->
                                    <td style="font-weight: 700; color: #111827;">{{ $repair->repair_type }}</td>
                                    
                                    <!-- Service Badge -->
                                    <td>
                                        @php
                                            $sBadgeClass = 'badge-generic';
                                            $sName = strtolower($repair->service->service_type ?? '');
                                            if (str_contains($sName, 'phone') || str_contains($sName, 'mobile') || str_contains($sName, 'smartphone')) {
                                                $sBadgeClass = 'badge-phone';
                                            } elseif (str_contains($sName, 'tv')) {
                                                $sBadgeClass = 'badge-tv';
                                            } elseif (str_contains($sName, 'refrigerator') || str_contains($sName, 'fridge')) {
                                                $sBadgeClass = 'badge-fridge';
                                            } elseif (str_contains($sName, 'washing') || str_contains($sName, 'washer')) {
                                                $sBadgeClass = 'badge-washer';
                                            }
                                        @endphp
                                        <span class="type-badge-pill {{ $sBadgeClass }}">
                                            {{ $repair->service->service_type ?? '&mdash;' }}
                                        </span>
                                    </td>
                                    
                                    <!-- Device Reference -->
                                    <td>
                                        <div style="display: flex; flex-direction: column;">
                                            <span style="font-weight: 700; color: #111827;">{{ $repair->device->name ?? '&mdash;' }}</span>
                                            <span style="font-size: 11px; color: #6b7280; font-weight: 600;">{{ $repair->device->brand ?? '' }} ({{ $repair->device->model ?? '' }})</span>
                                        </div>
                                    </td>

                                    <!-- Price -->
                                    <td style="text-align: right; font-weight: 800; color: #059669;">
                                        RM {{ number_format($repair->price, 2) }}
                                    </td>

                                    <!-- Warranty / Duration -->
                                    <td style="text-align: center; font-size: 12px; font-weight: 600; color: #4b5563;">
                                        <div style="display: flex; flex-direction: column; gap: 2px; align-items: center;">
                                            <span style="background: #f3f4f6; padding: 2px 6px; border-radius: 4px;" title="Warranty">
                                                <i class="bi bi-shield-check"></i> {{ $repair->warranty_period ?? 'No Warranty' }}
                                            </span>
                                            <span style="background: #f0fdf4; color: #16a34a; padding: 2px 6px; border-radius: 4px;" title="Estimated Duration">
                                                <i class="bi bi-clock"></i> {{ $repair->duration ?? '&mdash;' }}
                                            </span>
                                        </div>
                                    </td>

                                    <td style="text-align: center;">
                                        <span class="type-badge-pill" style="border: 1px solid {{ $repair->is_active ? '#d1fae5' : '#fee2e2' }}; background: {{ $repair->is_active ? '#ecfdf5' : '#fef2f2' }}; color: {{ $repair->is_active ? '#065f46' : '#991b1b' }};">
                                            {{ $repair->is_active ? 'Active' : 'Inactive' }}
                                        </span>
                                    </td>
                                    
                                    <!-- Action buttons -->
                                    <td>
                                        <div class="action-row" style="justify-content: center;">
                                            <button
                                                type="button"
                                                class="btn-action-icon btn-edit"
                                                onclick="openRepairEditModal(
                                                    '{{ $repair->id }}',
                                                    '{{ $repair->service_id }}',
                                                    '{{ $repair->device_id }}',
                                                    @js($repair->repair_type),
                                                    '{{ $repair->price }}',
                                                    @js($repair->warranty_period),
                                                    @js($repair->duration),
                                                    @js($repair->description),
                                                    @js($repair->image)
                                                )"
                                                title="Edit Repair Price">
                                                <i class="bi bi-pencil-square"></i>
                                            </button>

                                            <form method="POST" action="{{ route('admin.repairs.destroy', $repair->id) }}" style="margin: 0;" onsubmit="return confirm('{{ $repair->is_active ? 'Deactivate' : 'Activate' }} this repair pricing record?')">
                                                @csrf
                                                @method('DELETE')
                                                <button type="submit" class="btn-action-icon btn-delete" title="{{ $repair->is_active ? 'Deactivate Repair Pricing' : 'Activate Repair Pricing' }}">
                                                    <i class="bi {{ $repair->is_active ? 'bi-pause-circle-fill' : 'bi-play-circle-fill' }}"></i>
                                                </button>
                                            </form>
                                        </div>
                                    </td>
                                </tr>
                            @endforeach
                        </tbody>
                    </table>
                </div>
            </div>
        </div>

    </div>
</div>

<!-- Add/Edit Service Category Modal -->
<div id="serviceModal" class="modal-overlay hide">
    <div class="modal-box">
        <div class="modal-header">
            <div>
                <span class="status-badge-pill badge-generic" style="font-size: 10px; margin-bottom: 6px;">Service Category</span>
                <h3 class="modal-title" id="serviceModalTitle">Add Service Category</h3>
            </div>
            <button type="button" class="modal-close" onclick="closeServiceModal()">
                <i class="bi bi-x"></i>
            </button>
        </div>

        <form id="serviceForm" method="POST" action="{{ route('admin.services.store') }}">
            @csrf
            <input type="hidden" id="serviceMethodField" name="_method" value="POST">

            <!-- Service Type Name -->
            <div class="form-group">
                <label for="service_type">Category Name</label>
                <input type="text" name="service_type" id="service_type" class="form-control" placeholder="e.g. Phone Repair" required>
            </div>

            <div class="form-actions">
                <button type="button" class="btn-modal btn-modal-cancel" onclick="closeServiceModal()">Cancel</button>
                <button type="submit" class="btn-modal btn-modal-submit" id="serviceSubmitBtn">Add Category</button>
            </div>
        </form>
    </div>
</div>

<!-- Add/Edit Repair Modal -->
<div id="repairModal" class="modal-overlay hide">
    <div class="modal-box">
        <div class="modal-header">
            <div>
                <span class="status-badge-pill badge-phone" style="font-size: 10px; margin-bottom: 6px;">Pricing Rule</span>
                <h3 class="modal-title" id="repairModalTitle">Add Repair pricing</h3>
            </div>
            <button type="button" class="modal-close" onclick="closeRepairModal()">
                <i class="bi bi-x"></i>
            </button>
        </div>

        <form id="repairForm" method="POST" action="{{ route('admin.repairs.store') }}">
            @csrf
            <input type="hidden" id="repairMethodField" name="_method" value="POST">
            <input type="hidden" name="section" value="repair">

            <!-- Service selection -->
            <div class="form-group">
                <label for="rep_service_id">Service Category</label>
                <select name="service_id" id="rep_service_id" class="form-control" required>
                    <option value="">Select Service Category</option>
                    @foreach($services as $service)
                        <option value="{{ $service->id }}">
                            {{ $service->service_type }}{{ $service->is_active ? '' : ' (Inactive)' }}
                        </option>
                    @endforeach
                </select>
            </div>

            <!-- Device selection -->
            <div class="form-group">
                <label for="rep_device_id">Applicable Device</label>
                <select name="device_id" id="rep_device_id" class="form-control" required>
                    <option value="">Select Device Model</option>
                    @foreach($devices as $device)
                        <option value="{{ $device->id }}">
                            {{ $device->name }} - {{ $device->brand }} ({{ $device->type }}){{ $device->is_active ? '' : ' (Inactive)' }}
                        </option>
                    @endforeach
                </select>
            </div>

            <!-- Repair Type Name -->
            <div class="form-group">
                <label for="rep_repair_type">Repair / Fault Type</label>
                <input type="text" name="repair_type" id="rep_repair_type" class="form-control" placeholder="e.g. Screen Replacement" required>
            </div>

            <!-- Price & Specs Grid -->
            <div style="display: grid; grid-template-columns: 1fr 1fr; gap: 15px;">
                <!-- Price -->
                <div class="form-group">
                    <label for="rep_price">Price (RM)</label>
                    <input type="number" step="0.01" name="price" id="rep_price" class="form-control" placeholder="e.g. 150.00" required>
                </div>

                <!-- Warranty -->
                <div class="form-group">
                    <label for="rep_warranty">Warranty Period</label>
                    <input type="text" name="warranty_period" id="rep_warranty" class="form-control" placeholder="e.g. 3 Months">
                </div>
            </div>

            <div style="display: grid; grid-template-columns: 1fr 1fr; gap: 15px;">
                <!-- Duration -->
                <div class="form-group">
                    <label for="rep_duration">Estimated Duration</label>
                    <input type="text" name="duration" id="rep_duration" class="form-control" placeholder="e.g. 1 Hour">
                </div>

                <!-- Image URL -->
                <div class="form-group">
                    <label for="rep_image">Image URL (Optional)</label>
                    <input type="text" name="image" id="rep_image" class="form-control" placeholder="Optional image reference URL">
                </div>
            </div>

            <!-- Description -->
            <div class="form-group">
                <label for="rep_desc">Repair Details / Description</label>
                <textarea name="description" id="rep_desc" class="form-control" style="height: 80px; resize: none;" placeholder="Provide brief repair specifications..."></textarea>
            </div>

            <div class="form-actions">
                <button type="button" class="btn-modal btn-modal-cancel" onclick="closeRepairModal()">Cancel</button>
                <button type="submit" class="btn-modal btn-modal-submit" id="repairSubmitBtn">Add Pricing</button>
            </div>
        </form>
    </div>
</div>

<script>
    document.addEventListener("DOMContentLoaded", function() {
        // Auto-dismiss banners
        const successNotify = document.getElementById('popup-notification');
        const deleteNotify = document.getElementById('popup-notification-delete');
        const errorNotify = document.getElementById('popup-notification-errors');

        if(successNotify) {
            setTimeout(function(){
                successNotify.style.transition = 'opacity 0.5s ease';
                successNotify.style.opacity = '0';
                setTimeout(() => successNotify.style.display = 'none', 500);
            }, 3000);
        }

        if(deleteNotify) {
            setTimeout(function(){
                deleteNotify.style.transition = 'opacity 0.5s ease';
                deleteNotify.style.opacity = '0';
                setTimeout(() => deleteNotify.style.display = 'none', 500);
            }, 3000);
        }

        if(errorNotify) {
            setTimeout(function(){
                errorNotify.style.transition = 'opacity 0.5s ease';
                errorNotify.style.opacity = '0';
                setTimeout(() => errorNotify.style.display = 'none', 500);
            }, 5000);
        }

        // Initialize DataTable
        $('#repairPricingTable').DataTable({
            pageLength: 10,
            lengthMenu: [5, 10, 25, 50],
            order: [],
            ordering: true,
            searching: true,
            language: {
                search: "",
                searchPlaceholder: "Search repairs..."
            }
        });
    });

    /* Service Modal Handlers */
    function openServiceModal() {
        resetServiceForm();
        document.getElementById('serviceModal').classList.remove('hide');
    }

    function openServiceEditModal(id, serviceType) {
        document.getElementById('serviceModal').classList.remove('hide');
        document.getElementById('serviceModalTitle').innerText = 'Update Service Category';
        document.getElementById('serviceSubmitBtn').innerText = 'Save Changes';

        document.getElementById('service_type').value = serviceType ?? '';
        document.getElementById('serviceForm').action = '/admin/services/' + id;
        document.getElementById('serviceMethodField').value = 'PUT';
    }

    function closeServiceModal() {
        document.getElementById('serviceModal').classList.add('hide');
    }

    function resetServiceForm() {
        document.getElementById('serviceModalTitle').innerText = 'Add Service Category';
        document.getElementById('serviceSubmitBtn').innerText = 'Add Category';

        document.getElementById('serviceForm').action = '{{ route('admin.services.store') }}';
        document.getElementById('serviceMethodField').value = 'POST';
        document.getElementById('service_type').value = '';
    }

    /* Repair Modal Handlers */
    function openRepairModal() {
        resetRepairForm();
        document.getElementById('repairModal').classList.remove('hide');
    }

    function openRepairEditModal(id, serviceId, deviceId, repairType, price, warranty, duration, desc, image) {
        document.getElementById('repairModal').classList.remove('hide');
        document.getElementById('repairModalTitle').innerText = 'Update Pricing Rule';
        document.getElementById('repairSubmitBtn').innerText = 'Save Changes';

        document.getElementById('rep_service_id').value = serviceId ?? '';
        document.getElementById('rep_device_id').value = deviceId ?? '';
        document.getElementById('rep_repair_type').value = repairType ?? '';
        document.getElementById('rep_price').value = price ?? '';
        document.getElementById('rep_warranty').value = warranty ?? '';
        document.getElementById('rep_duration').value = duration ?? '';
        document.getElementById('rep_desc').value = desc ?? '';
        document.getElementById('rep_image').value = image ?? '';

        document.getElementById('repairForm').action = '/admin/repairs/' + id;
        document.getElementById('repairMethodField').value = 'PUT';
    }

    function closeRepairModal() {
        document.getElementById('repairModal').classList.add('hide');
    }

    function resetRepairForm() {
        document.getElementById('repairModalTitle').innerText = 'Add Repair Pricing';
        document.getElementById('repairSubmitBtn').innerText = 'Add Pricing';

        document.getElementById('repairForm').action = '{{ route('admin.repairs.store') }}';
        document.getElementById('repairMethodField').value = 'POST';

        document.getElementById('rep_service_id').value = '';
        document.getElementById('rep_device_id').value = '';
        document.getElementById('rep_repair_type').value = '';
        document.getElementById('rep_price').value = '';
        document.getElementById('rep_warranty').value = '';
        document.getElementById('rep_duration').value = '';
        document.getElementById('rep_desc').value = '';
        document.getElementById('rep_image').value = '';
    }
</script>

@endsection
