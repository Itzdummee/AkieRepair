@extends('layouts.admin')

@section('title', 'Customer Registry')

@section('content')

<style>
    .cust-container {
        display: flex;
        flex-direction: column;
        gap: 30px;
    }
    
    /* Header & Panel styling */
    .cust-header {
        background: #ffffff;
        border: 1px solid rgba(229, 231, 235, 0.8);
        border-radius: 16px;
        padding: 24px;
        display: flex;
        justify-content: space-between;
        align-items: center;
        box-shadow: 0 4px 6px -1px rgba(0, 0, 0, 0.05);
    }
    
    .cust-title h1 {
        font-family: 'Playfair Display', serif;
        font-size: 28px;
        font-weight: 700;
        color: #111827;
        margin-bottom: 6px;
    }
    
    .cust-title p {
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
    .cust-metrics-grid {
        display: grid;
        grid-template-columns: repeat(4, 1fr);
        gap: 20px;
    }
    
    .cust-metric-card {
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
    
    .cust-metric-card:hover {
        transform: translateY(-3px);
        box-shadow: 0 12px 20px -5px rgba(0, 0, 0, 0.08);
    }
    
    .cust-metric-card::before {
        content: '';
        position: absolute;
        bottom: 0;
        left: 0;
        width: 100%;
        height: 4px;
    }
    
    .cust-metric-card.all::before { background: linear-gradient(90deg, #3b82f6, #1d4ed8); }
    .cust-metric-card.approved::before { background: linear-gradient(90deg, #10b981, #059669); }
    .cust-metric-card.pending::before { background: linear-gradient(90deg, #f59e0b, #d97706); }
    .cust-metric-card.rejected::before { background: linear-gradient(90deg, #f43f5e, #e11d48); }
    
    .cust-metric-info {
        display: flex;
        flex-direction: column;
        gap: 4px;
    }
    
    .cust-metric-label {
        font-size: 12px;
        font-weight: 700;
        color: #6b7280;
        text-transform: uppercase;
        letter-spacing: 0.05em;
    }
    
    .cust-metric-value {
        font-size: 32px;
        font-weight: 800;
        color: #111827;
        line-height: 1.1;
    }
    
    .cust-metric-icon {
        width: 48px;
        height: 48px;
        border-radius: 12px;
        display: grid;
        place-items: center;
        font-size: 20px;
    }
    
    .icon-all { background: #eff6ff; color: #3b82f6; }
    .icon-approved { background: #e6fbf3; color: #10b981; }
    .icon-pending { background: #fffbeb; color: #f59e0b; }
    .icon-rejected { background: #fff5f5; color: #f43f5e; }

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
    .cust-table-panel {
        background: #ffffff;
        border: 1px solid rgba(229, 231, 235, 0.8);
        border-radius: 18px;
        padding: 30px;
        box-shadow: 0 4px 6px -1px rgba(0, 0, 0, 0.04);
    }

    /* High-Fidelity Table custom styling */
    .cust-table {
        width: 100% !important;
        border-collapse: separate !important;
        border-spacing: 0 !important;
        margin-top: 15px;
    }
    
    .cust-table th {
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
    
    .cust-table th:first-child { border-top-left-radius: 10px; }
    .cust-table th:last-child { border-top-right-radius: 10px; }
    
    .cust-table td {
        padding: 16px 20px !important;
        border-bottom: 1px solid #f3f4f6 !important;
        color: #374151 !important;
        font-size: 14px !important;
        vertical-align: middle !important;
        background: transparent !important;
    }
    
    .cust-table tr:hover td {
        background: #f9fafb !important;
    }
    
    .cust-table tr:last-child td {
        border-bottom: none !important;
    }

    /* Customer details avatar styling */
    .customer-flex {
        display: flex;
        align-items: center;
        gap: 12px;
    }
    
    .customer-avatar {
        width: 38px;
        height: 38px;
        border-radius: 50%;
        color: #ffffff;
        font-weight: 700;
        display: grid;
        place-items: center;
        font-size: 14px;
        box-shadow: 0 2px 5px rgba(0,0,0,0.06);
    }
    
    .avatar-approved { background: linear-gradient(135deg, #10b981, #059669); }
    .avatar-pending { background: linear-gradient(135deg, #f59e0b, #d97706); }
    .avatar-rejected { background: linear-gradient(135deg, #f43f5e, #e11d48); }
    
    .customer-name-sub {
        display: flex;
        flex-direction: column;
    }
    
    .customer-main-name {
        font-weight: 700;
        color: #111827;
    }
    
    .customer-date-sub {
        font-size: 12px;
        color: #9ca3af;
    }

    /* Status badges styling */
    .status-badge-pill {
        display: inline-flex;
        align-items: center;
        gap: 5px;
        padding: 5px 12px;
        border-radius: 50px;
        font-size: 11px;
        font-weight: 700;
        text-transform: uppercase;
        letter-spacing: 0.03em;
    }
    
    .status-approved {
        border: 1px solid #d1fae5;
        background-color: #ecfdf5;
        color: #065f46;
    }
    
    .status-pending {
        border: 1px solid #fef3c7;
        background-color: #fffbeb;
        color: #92400e;
    }
    
    .status-rejected {
        border: 1px solid #fee2e2;
        background-color: #fef2f2;
        color: #991b1b;
    }
    
    .status-badge-pill i {
        font-size: 8px;
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

<div class="cust-container">
    
    <!-- Header panel -->
    <div class="cust-header">
        <div class="cust-title">
            <h1>Customer Directory</h1>
            <p>Manage all customer profiles, check account verification, and track diagnostic booking statuses.</p>
        </div>
    </div>

    <!-- Metrics strip -->
    <div class="cust-metrics-grid">
        <!-- All Card -->
        <div class="cust-metric-card all">
            <div class="cust-metric-info">
                <span class="cust-metric-label">Total Customers</span>
                <span class="cust-metric-value">{{ $totalCount }}</span>
            </div>
            <div class="cust-metric-icon icon-all">
                <i class="bi bi-people-fill"></i>
            </div>
        </div>

        <!-- Approved Card -->
        <div class="cust-metric-card approved">
            <div class="cust-metric-info">
                <span class="cust-metric-label">Approved</span>
                <span class="cust-metric-value">{{ $approvedCount }}</span>
            </div>
            <div class="cust-metric-icon icon-approved">
                <i class="bi bi-shield-check"></i>
            </div>
        </div>

        <!-- Pending Card -->
        <div class="cust-metric-card pending">
            <div class="cust-metric-info">
                <span class="cust-metric-label">Pending Review</span>
                <span class="cust-metric-value">{{ $pendingCount }}</span>
            </div>
            <div class="cust-metric-icon icon-pending">
                <i class="bi bi-shield-exclamation"></i>
            </div>
        </div>

        <!-- Rejected Card -->
        <div class="cust-metric-card rejected">
            <div class="cust-metric-info">
                <span class="cust-metric-label">Rejected / Blocked</span>
                <span class="cust-metric-value">{{ $rejectedCount }}</span>
            </div>
            <div class="cust-metric-icon icon-rejected">
                <i class="bi bi-shield-slash"></i>
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
    <div class="cust-table-panel">
        <div class="table-wrap">
            <table class="cust-table" id="customerRegistryTable">
                <thead>
                    <tr>
                        <th style="width: 110px;">ID</th>
                        <th>Customer Name</th>
                        <th>Email Address</th>
                        <th>Phone Number</th>
                        <th style="text-align: center; width: 100px;">Bookings</th>
                        <th style="text-align: right; width: 120px;">Total Spent</th>
                        <th style="width: 140px; text-align: center;">Status</th>
                        <th style="width: 160px; text-align: center;">Actions</th>
                    </tr>
                </thead>

                <tbody>
                    @foreach($customers as $customer)
                        <tr>
                            <!-- Customer ID -->
                            <td style="font-weight: 700; color: #111827;">{{ $customer->id }}</td>
                            
                            <!-- Profile details -->
                            <td>
                                <div class="customer-flex">
                                    @php
                                        $avatarClass = 'avatar-pending';
                                        if ($customer->approval_status === 'approved') {
                                            $avatarClass = 'avatar-approved';
                                        } elseif ($customer->approval_status === 'rejected') {
                                            $avatarClass = 'avatar-rejected';
                                        }
                                    @endphp
                                    <div class="customer-avatar {{ $avatarClass }}">
                                        {{ strtoupper(substr($customer->name ?? 'C', 0, 1)) }}
                                    </div>
                                    <div class="customer-name-sub">
                                        <span class="customer-main-name">{{ $customer->name }}</span>
                                        <span class="customer-date-sub">Joined {{ $customer->created_at->format('d M, Y') }}</span>
                                    </div>
                                </div>
                            </td>
                            
                            <!-- Email -->
                            <td style="font-weight: 500; color: #4b5563;">{{ $customer->email }}</td>
                            
                            <!-- Phone -->
                            <td style="font-weight: 600; color: #374151;">{{ $customer->phone_number ?? '&mdash;' }}</td>
                            
                            <!-- Booking Count -->
                            <td style="text-align: center; font-weight: 700; color: #111827;">
                                <span style="background-color: #f3f4f6; padding: 4px 10px; border-radius: 8px; font-size: 13px;">
                                    {{ $customer->bookings->count() }}
                                </span>
                            </td>

                            <!-- Total Spent -->
                            <td style="text-align: right; font-weight: 700; color: #059669;">
                                RM {{ number_format($customer->bookings->where('status', 'Repair Completed')->sum('quotation_price'), 2) }}
                            </td>
                            
                            <!-- Status Badges -->
                            <td style="text-align: center;">
                                @php
                                    $badgeClass = 'status-pending';
                                    $iconClass = 'bi-circle-fill';
                                    if (! $customer->is_active) {
                                        $badgeClass = 'status-rejected';
                                    } elseif ($customer->approval_status === 'approved') {
                                        $badgeClass = 'status-approved';
                                    } elseif ($customer->approval_status === 'rejected') {
                                        $badgeClass = 'status-rejected';
                                    }
                                @endphp
                                <span class="status-badge-pill {{ $badgeClass }}">
                                    <i class="bi {{ $iconClass }}"></i>
                                    {{ $customer->is_active ? $customer->approval_status : 'deactivated' }}
                                </span>
                            </td>
                            
                            <!-- Action buttons -->
                            <td>
                                <div class="action-row" style="justify-content: center;">
                                    <button
                                        type="button"
                                        class="btn-action-small btn-edit"
                                        onclick="openEditModal(
                                            '{{ $customer->id }}',
                                            @js($customer->name),
                                            @js($customer->email),
                                            @js($customer->phone_number),
                                            '{{ $customer->approval_status }}'
                                        )">
                                        <i class="bi bi-pencil-square"></i>
                                        <!-- <span>Edit</span> -->
                                    </button>

                                    <form method="POST" action="{{ route('admin.customers.destroy', $customer->id) }}" style="margin: 0;" onsubmit="return confirm('{{ $customer->is_active ? 'Deactivate' : 'Activate' }} customer {{ $customer->name }}?')">
                                        @csrf
                                        @method('DELETE')
                                        <button type="submit" class="btn-action-small btn-delete" title="{{ $customer->is_active ? 'Deactivate Customer' : 'Activate Customer' }}">
                                            <i class="bi {{ $customer->is_active ? 'bi-pause-circle-fill' : 'bi-play-circle-fill' }}"></i>
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

<!-- Edit Customer Modal -->
<div id="customerModal" class="modal-overlay hide">
    <div class="modal-box">
        
        <div class="modal-header">
            <div>
                <span class="status-badge-pill status-approved" style="font-size: 10px; margin-bottom: 6px;">Customer Profile</span>
                <h3 class="modal-title" id="modalFormTitle">Update Profile</h3>
            </div>
            <button type="button" class="modal-close" onclick="closeModal()">
                <i class="bi bi-x"></i>
            </button>
        </div>

        <form id="customerForm" method="POST" action="">
            @csrf
            
            <input type="hidden" id="methodField" name="_method" value="PUT">

            <!-- Name -->
            <div class="form-group">
                <label for="cust_name">Full Name</label>
                <input type="text" name="name" id="cust_name" class="form-control" placeholder="e.g. John Doe" required>
            </div>

            <!-- Email -->
            <div class="form-group">
                <label for="cust_email">Email Address</label>
                <input type="email" name="email" id="cust_email" class="form-control" placeholder="e.g. john@example.com" required>
            </div>

            <!-- Phone -->
            <div class="form-group">
                <label for="cust_phone">Phone Reference</label>
                <input type="text" name="phone_number" id="cust_phone" class="form-control" placeholder="e.g. 60123456789" maxlength="11" pattern="[0-9]{1,11}" title="Phone number must be between 1 and 11 digits containing only numbers" oninput="this.value = this.value.replace(/[^0-9]/g, '')">
            </div>

            <!-- Status Selection -->
            <div class="form-group">
                <label for="cust_status">Approval / Registry Status</label>
                <select name="approval_status" id="cust_status" class="form-control" required>
                    <option value="approved">Approved (Active Profile)</option>
                    <option value="pending">Pending Review (Limited Access)</option>
                    <option value="rejected">Rejected (Blocked Account)</option>
                </select>
            </div>

            <div class="form-actions">
                <button type="button" class="btn-modal btn-modal-cancel" onclick="closeModal()">Cancel</button>
                <button type="submit" class="btn-modal btn-modal-submit" id="submitFormBtn">Save Changes</button>
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
            }, 3500);
        }

        if(deleteNotify) {
            setTimeout(function(){
                deleteNotify.style.transition = 'opacity 0.5s ease';
                deleteNotify.style.opacity = '0';
                setTimeout(() => deleteNotify.style.display = 'none', 500);
            }, 3500);
        }

        if(errorNotify) {
            setTimeout(function(){
                errorNotify.style.transition = 'opacity 0.5s ease';
                errorNotify.style.opacity = '0';
                setTimeout(() => errorNotify.style.display = 'none', 500);
            }, 6000);
        }

        // Initialize DataTable
        $('#customerRegistryTable').DataTable({
            pageLength: 10,
            lengthMenu: [5, 10, 25, 50],
            order: [[0, 'desc']],
            ordering: true,
            searching: true,
            language: {
                search: "",
                searchPlaceholder: "Search registry..."
            }
        });
    });

    function openEditModal(id, name, email, phone, approvalStatus) {
        document.getElementById('customerModal').classList.remove('hide');

        document.getElementById('cust_name').value = name ?? '';
        document.getElementById('cust_email').value = email ?? '';
        document.getElementById('cust_phone').value = phone ?? '';
        document.getElementById('cust_status').value = approvalStatus ?? 'approved';

        document.getElementById('customerForm').action = '/admin/customers/' + id;
        document.getElementById('methodField').value = 'PUT';
    }

    function closeModal() {
        document.getElementById('customerModal').classList.add('hide');
    }
</script>

@endsection
