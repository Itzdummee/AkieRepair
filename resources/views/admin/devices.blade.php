@extends('layouts.admin')

@section('title', 'Device Directory')

@section('content')

<style>
    .dev-container {
        display: flex;
        flex-direction: column;
        gap: 30px;
    }
    
    /* Header & Panel styling */
    .dev-header {
        background: #ffffff;
        border: 1px solid rgba(229, 231, 235, 0.8);
        border-radius: 16px;
        padding: 24px;
        display: flex;
        justify-content: space-between;
        align-items: center;
        box-shadow: 0 4px 6px -1px rgba(0, 0, 0, 0.05);
    }
    
    .dev-title h1 {
        font-family: 'Playfair Display', serif;
        font-size: 28px;
        font-weight: 700;
        color: #111827;
        margin-bottom: 6px;
    }
    
    .dev-title p {
        font-size: 14px;
        color: #6b7280;
    }
    
    .btn-create-new {
        background: linear-gradient(135deg, #111827, #374151);
        color: #ffffff !important;
        padding: 12px 24px;
        border-radius: 12px;
        font-weight: 700;
        font-size: 14px;
        display: inline-flex;
        align-items: center;
        gap: 8px;
        box-shadow: 0 4px 12px rgba(17, 24, 39, 0.15);
        border: none;
        cursor: pointer;
        transition: all 0.25s cubic-bezier(0.4, 0, 0.2, 1);
    }
    
    .btn-create-new:hover {
        background: linear-gradient(135deg, #374151, #4b5563);
        transform: translateY(-2px);
        box-shadow: 0 6px 16px rgba(17, 24, 39, 0.25);
    }

    /* Modern metrics grid */
    .dev-metrics-grid {
        display: grid;
        grid-template-columns: repeat(4, 1fr);
        gap: 20px;
    }
    
    .dev-metric-card {
        background: #ffffff;
        border: 1px solid rgba(229, 231, 235, 0.8);
        border-radius: 16px;
        padding: 20px 24px;
        display: flex;
        align-items: center;
        justify-content: space-between;
        box-shadow: 0 4px 6px -1px rgba(0, 0, 0, 0.03);
        position: relative;
        overflow: hidden;
        transition: all 0.3s cubic-bezier(0.4, 0, 0.2, 1);
    }
    
    .dev-metric-card:hover {
        transform: translateY(-3px);
        box-shadow: 0 12px 20px -5px rgba(0, 0, 0, 0.08);
    }
    
    .dev-metric-card::before {
        content: '';
        position: absolute;
        bottom: 0;
        left: 0;
        width: 100%;
        height: 4px;
    }
    
    .dev-metric-card.smartphones::before { background: linear-gradient(90deg, #3b82f6, #1d4ed8); }
    .dev-metric-card.televisions::before { background: linear-gradient(90deg, #8b5cf6, #6d28d9); }
    .dev-metric-card.refrigerators::before { background: linear-gradient(90deg, #10b981, #059669); }
    .dev-metric-card.washers::before { background: linear-gradient(90deg, #f59e0b, #d97706); }
    
    .dev-metric-info {
        display: flex;
        flex-direction: column;
        gap: 4px;
    }
    
    .dev-metric-label {
        font-size: 12px;
        font-weight: 700;
        color: #6b7280;
        text-transform: uppercase;
        letter-spacing: 0.05em;
    }
    
    .dev-metric-value {
        font-size: 32px;
        font-weight: 800;
        color: #111827;
        line-height: 1.1;
    }
    
    .dev-metric-icon {
        width: 48px;
        height: 48px;
        border-radius: 12px;
        display: grid;
        place-items: center;
        font-size: 20px;
    }
    
    .icon-smartphones { background: #eff6ff; color: #3b82f6; }
    .icon-televisions { background: #f5f3ff; color: #8b5cf6; }
    .icon-refrigerators { background: #e6fbf3; color: #10b981; }
    .icon-washers { background: #fffbeb; color: #f59e0b; }

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

    /* SaaS style table panel */
    .dev-table-panel {
        background: #ffffff;
        border: 1px solid rgba(229, 231, 235, 0.8);
        border-radius: 18px;
        padding: 30px;
        box-shadow: 0 4px 6px -1px rgba(0, 0, 0, 0.04);
    }

    /* High-Fidelity Table custom styling */
    .dev-table {
        width: 100% !important;
        border-collapse: separate !important;
        border-spacing: 0 !important;
        margin-top: 15px;
    }
    
    .dev-table th {
        background: #f9fafb !important;
        padding: 16px 20px !important;
        font-size: 12px !important;
        font-weight: 700 !important;
        color: #4b5563 !important;
        text-transform: uppercase !important;
        letter-spacing: 0.05em !important;
        border-bottom: 1px solid #e5e7eb !important;
        border-top: none !important;
    }
    
    .dev-table th:first-child { border-top-left-radius: 10px; }
    .dev-table th:last-child { border-top-right-radius: 10px; }
    
    .dev-table td {
        padding: 16px 20px !important;
        border-bottom: 1px solid #f3f4f6 !important;
        color: #374151 !important;
        font-size: 14px !important;
        vertical-align: middle !important;
        background: transparent !important;
    }
    
    .dev-table tr:hover td {
        background: #f9fafb !important;
    }
    
    .dev-table tr:last-child td {
        border-bottom: none !important;
    }

    /* Image styling */
    .device-thumb-container {
        width: 60px;
        height: 44px;
        border-radius: 8px;
        overflow: hidden;
        border: 1px solid #e5e7eb;
        background-color: #f9fafb;
        display: flex;
        align-items: center;
        justify-content: center;
        box-shadow: 0 2px 4px rgba(0,0,0,0.03);
    }
    
    .device-thumb {
        width: 100%;
        height: 100%;
        object-fit: cover;
    }
    
    .device-no-image {
        color: #9ca3af;
        font-size: 14px;
        font-weight: 600;
    }

    /* Type badges styling */
    .type-badge-pill {
        display: inline-flex;
        align-items: center;
        gap: 6px;
        padding: 5px 12px;
        border-radius: 50px;
        font-size: 11px;
        font-weight: 700;
        text-transform: uppercase;
        letter-spacing: 0.03em;
    }
    
    .badge-smartphone {
        border: 1px solid #d1fae5;
        background-color: #ecfdf5;
        color: #065f46;
    }
    
    .badge-television {
        border: 1px solid #e0f2fe;
        background-color: #f0f9ff;
        color: #0369a1;
    }
    
    .badge-refrigerator {
        border: 1px solid #dbeafe;
        background-color: #eff6ff;
        color: #1d4ed8;
    }
    
    .badge-washing {
        border: 1px solid #fef3c7;
        background-color: #fffbeb;
        color: #92400e;
    }

    /* Actions styling */
    .action-row {
        display: flex;
        gap: 8px;
    }
    
    .btn-action-small {
        height: 34px;
        padding: 0 14px;
        border-radius: 8px;
        font-weight: 700;
        font-size: 11px;
        text-transform: uppercase;
        letter-spacing: 0.05em;
        display: inline-flex;
        align-items: center;
        justify-content: center;
        gap: 6px;
        cursor: pointer;
        transition: all 0.2s ease;
        border: none;
        color: #ffffff;
    }
    
    .btn-edit {
        background: linear-gradient(135deg, #3b82f6, #1d4ed8);
        box-shadow: 0 2px 5px rgba(59, 130, 246, 0.15);
    }
    
    .btn-edit:hover {
        background: linear-gradient(135deg, #1d4ed8, #1e40af);
        transform: translateY(-1px);
    }
    
    .btn-delete {
        background: linear-gradient(135deg, #f43f5e, #e11d48);
        box-shadow: 0 2px 5px rgba(244, 63, 94, 0.15);
    }
    
    .btn-delete:hover {
        background: linear-gradient(135deg, #e11d48, #be123c);
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
        width: 540px;
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
        font-size: 26px;
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
        margin-bottom: 18px;
    }
    
    .form-group label {
        display: block;
        font-size: 13px;
        font-weight: 700;
        color: #374151;
        margin-bottom: 6px;
        text-transform: uppercase;
        letter-spacing: 0.05em;
    }
    
    .form-control {
        width: 100%;
        padding: 11px 16px;
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
        margin-top: 28px;
        padding-top: 20px;
        border-top: 1px solid #f3f4f6;
    }
    
    .btn-modal {
        padding: 11px 22px;
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
        margin-bottom: 20px;
    }
    .dataTables_wrapper .dataTables_filter input {
        border: 1.5px solid #e5e7eb !important;
        border-radius: 10px !important;
        padding: 8px 14px !important;
        background-color: #f9fafb !important;
        width: 240px !important;
        max-width: 240px !important;
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
        padding: 6px 12px !important;
        font-size: 13px !important;
    }
    .dataTables_wrapper .dataTables_info {
        font-size: 13px;
        color: #6b7280;
        margin-top: 15px;
    }
    .dataTables_wrapper .dataTables_paginate {
        margin-top: 15px;
    }
    .dataTables_wrapper .dataTables_paginate .paginate_button {
        padding: 6px 12px !important;
        border-radius: 8px !important;
        border: 1px solid transparent !important;
        font-size: 13px !important;
        font-weight: 600 !important;
        transition: all 0.2s ease;
    }
    .dataTables_wrapper .dataTables_paginate .paginate_button:hover {
        background: #f3f4f6 !important;
        color: #111827 !important;
    }
    .dataTables_wrapper .dataTables_paginate .paginate_button.current {
        background: linear-gradient(135deg, #111827, #374151) !important;
        color: white !important;
        border: none !important;
    }
</style>

<div class="dev-container">
    
    <!-- Header panel -->
    <div class="dev-header">
        <div class="dev-title">
            <h1>Device Directory</h1>
            <p>Manage television, refrigerator, washing machine, and smartphone hardware categories in the repair pool.</p>
        </div>
        <button type="button" class="btn-create-new" onclick="openAddModal()">
            <i class="bi bi-plus-lg" style="font-size: 16px;"></i>
            <span>Add Device</span>
        </button>
    </div>

    <!-- Metrics strip -->
    <div class="dev-metrics-grid">
        <!-- Smartphones Card -->
        <div class="dev-metric-card smartphones">
            <div class="dev-metric-info">
                <span class="dev-metric-label">Smartphones</span>
                <span class="dev-metric-value">{{ $devices->where('type', 'Smartphone')->count() }}</span>
            </div>
            <div class="dev-metric-icon icon-smartphones">
                <i class="bi bi-phone"></i>
            </div>
        </div>

        <!-- Televisions Card -->
        <div class="dev-metric-card televisions">
            <div class="dev-metric-info">
                <span class="dev-metric-label">Televisions</span>
                <span class="dev-metric-value">{{ $devices->where('type', 'Television')->count() }}</span>
            </div>
            <div class="dev-metric-icon icon-televisions">
                <i class="bi bi-tv"></i>
            </div>
        </div>

        <!-- Refrigerators Card -->
        <div class="dev-metric-card refrigerators">
            <div class="dev-metric-info">
                <span class="dev-metric-label">Refrigerators</span>
                <span class="dev-metric-value">{{ $devices->where('type', 'Refrigerator')->count() }}</span>
            </div>
            <div class="dev-metric-icon icon-refrigerators">
                <i class="bi bi-snow"></i>
            </div>
        </div>

        <!-- Washing Machines Card -->
        <div class="dev-metric-card washers">
            <div class="dev-metric-info">
                <span class="dev-metric-label">Washing Machines</span>
                <span class="dev-metric-value">{{ $devices->where('type', 'Washing Machine')->count() }}</span>
            </div>
            <div class="dev-metric-icon icon-washers">
                <i class="bi bi-water"></i>
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

    <!-- SaaS List Card -->
    <div class="dev-table-panel">
        <div class="table-wrap">
            <table class="dev-table" id="deviceRegistryTable">
                <thead>
                    <tr>
                        <th>Device Name</th>
                        <th>Brand Reference</th>
                        <th>Device Type</th>
                        <th>Model Identifier</th>
                        <th style="text-align: center; width: 120px;">Capacity Specs</th>
                        <th style="width: 180px; text-align: center;">Actions</th>
                    </tr>
                </thead>

                <tbody>
                    @foreach($devices as $device)
                        <tr>
                            <!-- Device Name -->
                            <td style="font-weight: 700; color: #111827;">{{ $device->name }}</td>
                            
                            <!-- Brand -->
                            <td style="font-weight: 600; color: #374151;">{{ $device->brand }}</td>
                            
                            <!-- Device Type Badge -->
                            <td>
                                @php
                                    $typeBadgeClass = 'badge-smartphone';
                                    $typeIcon = 'bi-phone';
                                    if ($device->type === 'Television') {
                                        $typeBadgeClass = 'badge-television';
                                        $typeIcon = 'bi-tv';
                                    } elseif ($device->type === 'Refrigerator') {
                                        $typeBadgeClass = 'badge-refrigerator';
                                        $typeIcon = 'bi-snow';
                                    } elseif ($device->type === 'Washing Machine') {
                                        $typeBadgeClass = 'badge-washing';
                                        $typeIcon = 'bi-water';
                                    }
                                @endphp
                                <span class="type-badge-pill {{ $typeBadgeClass }}">
                                    <i class="bi {{ $typeIcon }}"></i>
                                    {{ $device->type }}
                                </span>
                            </td>
                            
                            <!-- Model -->
                            <td style="font-family: monospace; font-size: 13px; font-weight: 700; color: #4b5563;">{{ $device->model }}</td>
                            
                            <!-- Capacity Specs -->
                            <td style="text-align: center; font-weight: 700; color: #111827;">
                                <span style="background-color: #f3f4f6; padding: 4px 10px; border-radius: 8px; font-size: 13px;">
                                    {{ $device->capacity }} {{ $device->capacity_unit }}
                                </span>
                            </td>
                            
                            <!-- Action buttons -->
                            <td>
                                <div class="action-row" style="justify-content: center;">
                                    <button
                                        type="button"
                                        class="btn-action-small btn-edit"
                                        onclick="openEditModal(
                                            '{{ $device->id }}',
                                            @js($device->name),
                                            @js($device->brand),
                                            @js($device->type),
                                            @js($device->model),
                                            '{{ $device->capacity }}',
                                            @js($device->capacity_unit)
                                        )">
                                        <i class="bi bi-pencil-square"></i>
                                        <span>Edit</span>
                                    </button>

                                    <form method="POST" action="{{ route('admin.devices.destroy', $device->id) }}" style="margin: 0;" onsubmit="return confirm('Are you sure you want to delete this device permanent records?')">
                                        @csrf
                                        @method('DELETE')
                                        <button type="submit" class="btn-action-small btn-delete">
                                            <i class="bi bi-trash-fill"></i>
                                            <span>Delete</span>
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

<!-- Add/Edit Device Modal -->
<div id="deviceModal" class="modal-overlay hide">
    <div class="modal-box">
        
        <div class="modal-header">
            <div>
                <span class="status-badge-pill badge-smartphone" style="font-size: 10px; margin-bottom: 6px;">Hardware Profile</span>
                <h3 class="modal-title" id="formTitle">Add Device</h3>
            </div>
            <button type="button" class="modal-close" onclick="closeModal()">
                <i class="bi bi-x"></i>
            </button>
        </div>

        <form id="deviceForm" method="POST" action="{{ route('admin.devices.store') }}">
            @csrf
            
            <input type="hidden" id="methodField" name="_method" value="POST">

            <!-- Name -->
            <div class="form-group">
                <label for="name">Device Name</label>
                <input type="text" name="name" id="name" class="form-control" placeholder="e.g. iPhone 11" required>
            </div>

            <!-- Brand -->
            <div class="form-group">
                <label for="brand">Brand Reference</label>
                <input type="text" name="brand" id="brand" class="form-control" placeholder="e.g. Apple" required>
            </div>

            <!-- Type -->
            <div class="form-group">
                <label for="type">Device Type</label>
                <select name="type" id="type" class="form-control" required>
                    <option value="">Select Type</option>
                    <option value="Smartphone">Smartphone</option>
                    <option value="Television">Television</option>
                    <option value="Refrigerator">Refrigerator</option>
                    <option value="Washing Machine">Washing Machine</option>
                </select>
            </div>

            <!-- Model -->
            <div class="form-group">
                <label for="model">Model Identifier</label>
                <input type="text" name="model" id="model" class="form-control" placeholder="e.g. A2221" required>
            </div>

            <!-- Capacity Grid -->
            <div style="display: grid; grid-template-columns: 1fr 1fr; gap: 15px;">
                <div class="form-group">
                    <label for="capacity">Capacity Value</label>
                    <input type="number" name="capacity" id="capacity" class="form-control" placeholder="e.g. 128" required>
                </div>

                <div class="form-group">
                    <label for="capacity_unit">Capacity Unit</label>
                    <select name="capacity_unit" id="capacity_unit" class="form-control" required>
                        <option value="">Select Unit</option>
                        <option value="GB">GB</option>
                        <option value="KG">KG</option>
                        <option value="Litre">Litre</option>
                        <option value="Inch">Inch</option>
                    </select>
                </div>
            </div>

            <div class="form-actions">
                <button type="button" class="btn-modal btn-modal-cancel" onclick="closeModal()">Cancel</button>
                <button type="submit" class="btn-modal btn-modal-submit" id="submitBtn">Add Device</button>
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
            }, 2500);
        }

        if(deleteNotify) {
            setTimeout(function(){
                deleteNotify.style.transition = 'opacity 0.5s ease';
                deleteNotify.style.opacity = '0';
                setTimeout(() => deleteNotify.style.display = 'none', 500);
            }, 2500);
        }

        if(errorNotify) {
            setTimeout(function(){
                errorNotify.style.transition = 'opacity 0.5s ease';
                errorNotify.style.opacity = '0';
                setTimeout(() => errorNotify.style.display = 'none', 500);
            }, 5000);
        }

        // Initialize DataTable
        $('#deviceRegistryTable').DataTable({
            pageLength: 10,
            lengthMenu: [5, 10, 25, 50],
            ordering: true,
            searching: true,
            language: {
                search: "",
                searchPlaceholder: "Search devices..."
            }
        });
    });

    function openAddModal() {
        resetForm();
        document.getElementById('deviceModal').classList.remove('hide');
    }

    function openEditModal(id, name, brand, type, model, capacity, capacityUnit) {
        document.getElementById('deviceModal').classList.remove('hide');

        document.getElementById('formTitle').innerText = 'Update Device';
        document.getElementById('submitBtn').innerText = 'Save Changes';

        document.getElementById('name').value = name ?? '';
        document.getElementById('brand').value = brand ?? '';
        document.getElementById('type').value = type ?? '';
        document.getElementById('model').value = model ?? '';
        document.getElementById('capacity').value = capacity ?? '';
        document.getElementById('capacity_unit').value = capacityUnit ?? '';

        document.getElementById('deviceForm').action = '/admin/devices/' + id;
        document.getElementById('methodField').value = 'PUT';
    }

    function closeModal() {
        document.getElementById('deviceModal').classList.add('hide');
    }

    function resetForm() {
        document.getElementById('formTitle').innerText = 'Add Device';
        document.getElementById('submitBtn').innerText = 'Add Device';

        document.getElementById('deviceForm').action = '{{ route('admin.devices.store') }}';
        document.getElementById('methodField').value = 'POST';

        document.getElementById('name').value = '';
        document.getElementById('brand').value = '';
        document.getElementById('type').value = '';
        document.getElementById('model').value = '';
        document.getElementById('capacity').value = '';
        document.getElementById('capacity_unit').value = '';
    }
</script>

@endsection