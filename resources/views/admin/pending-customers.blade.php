@extends('layouts.admin')

@section('title', 'Pending Customers')

@section('content')

<style>
    .pending-cust-container {
        display: flex;
        flex-direction: column;
        gap: 30px;
    }
    
    /* Header & Panel styling */
    .pending-cust-header {
        background: #ffffff;
        border: 1px solid rgba(229, 231, 235, 0.8);
        border-radius: 16px;
        padding: 24px;
        display: flex;
        justify-content: space-between;
        align-items: center;
        box-shadow: 0 4px 6px -1px rgba(0, 0, 0, 0.05);
    }
    
    .pending-cust-title h1 {
        font-family: 'Playfair Display', serif;
        font-size: 28px;
        font-weight: 700;
        color: #111827;
        margin-bottom: 6px;
    }
    
    .pending-cust-title p {
        font-size: 14px;
        color: #6b7280;
    }
    
    .pending-cust-badge {
        background: linear-gradient(135deg, #f59e0b, #d97706);
        color: #ffffff;
        padding: 10px 20px;
        border-radius: 99px;
        font-weight: 700;
        font-size: 14px;
        box-shadow: 0 4px 10px rgba(245, 158, 11, 0.25);
        display: flex;
        align-items: center;
        gap: 8px;
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
        margin-bottom: 10px;
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
    .pending-table-panel {
        background: #ffffff;
        border: 1px solid rgba(229, 231, 235, 0.8);
        border-radius: 18px;
        padding: 30px;
        box-shadow: 0 4px 6px -1px rgba(0, 0, 0, 0.04);
    }

    /* High-Fidelity Table custom styling */
    .pending-table {
        width: 100% !important;
        border-collapse: separate !important;
        border-spacing: 0 !important;
    }
    
    .pending-table th {
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
    
    .pending-table th:first-child { border-top-left-radius: 10px; }
    .pending-table th:last-child { border-top-right-radius: 10px; }
    
    .pending-table td {
        padding: 16px 20px !important;
        border-bottom: 1px solid #f3f4f6 !important;
        color: #374151 !important;
        font-size: 14px !important;
        vertical-align: middle !important;
        background: transparent !important;
    }
    
    .pending-table tr:hover td {
        background: #f9fafb !important;
    }
    
    .pending-table tr:last-child td {
        border-bottom: none !important;
    }

    /* Customer details avatar styling */
    .customer-flex {
        display: flex;
        align-items: center;
        gap: 12px;
    }
    
    .customer-avatar {
        width: 34px;
        height: 34px;
        border-radius: 50%;
        background: linear-gradient(135deg, #f59e0b, #e11d48);
        color: #ffffff;
        font-weight: 700;
        display: grid;
        place-items: center;
        font-size: 13px;
        box-shadow: 0 2px 5px rgba(245, 158, 11, 0.15);
    }
    
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
        border: 1px solid #fce7f3;
        background-color: #fdf2f8;
        color: #db2777;
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
    
    .btn-approve {
        background: linear-gradient(135deg, #10b981, #059669);
        box-shadow: 0 2px 5px rgba(16, 185, 129, 0.15);
    }
    
    .btn-approve:hover {
        background: linear-gradient(135deg, #059669, #047857);
        transform: translateY(-1px);
    }
    
    .btn-reject {
        background: linear-gradient(135deg, #f43f5e, #e11d48);
        box-shadow: 0 2px 5px rgba(244, 63, 94, 0.15);
    }
    
    .btn-reject:hover {
        background: linear-gradient(135deg, #e11d48, #be123c);
        transform: translateY(-1px);
    }

    /* Empty state */
    .empty-card {
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
    
    .empty-icon {
        width: 72px;
        height: 72px;
        background: #f3f4f6;
        color: #9ca3af;
        border-radius: 50%;
        display: grid;
        place-items: center;
        font-size: 32px;
    }
    
    .empty-card h3 {
        font-family: 'Playfair Display', serif;
        font-size: 22px;
        font-weight: 700;
        color: #374151;
        margin: 0;
    }
    
    .empty-card p {
        color: #6b7280;
        font-size: 14px;
        max-width: 320px;
        margin: 0;
    }
</style>

<div class="pending-cust-container">
    
    <!-- Header panel -->
    <div class="pending-cust-header">
        <div class="pending-cust-title">
            <h1>Pending Registrations</h1>
            <p>Review new customer account signups. Approve to grant access, or reject to decline.</p>
        </div>
        <div class="pending-cust-badge">
            <i class="bi bi-person-exclamation"></i>
            <span>{{ $customers->count() }} Accounts Awaiting Approval</span>
        </div>
    </div>

    <!-- Alert Notifications -->
    

    @if(session('delete'))
        <div class="alert-panel alert-delete-panel" id="popup-notification-delete">
            <i class="bi bi-x-circle-fill" style="font-size: 18px;"></i>
            <span>{{ session('delete') }}</span>
        </div>
    @endif

    <!-- SaaS List Card -->
    <div class="pending-table-panel">
        <div class="table-wrap">
            <table class="pending-table">
                <thead>
                    <tr>
                        <th style="width: 120px;">Customer ID</th>
                        <th>Customer Profile</th>
                        <th>Email Address</th>
                        <th>Phone Reference</th>
                        <th>Verification Status</th>
                        <th style="width: 220px; text-align: center;">Decision Action</th>
                    </tr>
                </thead>

                <tbody>
                    @forelse($customers as $customer)
                        <tr>
                            <!-- Customer ID -->
                            <td style="font-weight: 700; color: #111827;">{{ $customer->id }}</td>
                            
                            <!-- Profile details -->
                            <td>
                                <div class="customer-flex">
                                    <div class="customer-avatar">
                                        {{ strtoupper(substr($customer->name ?? 'C', 0, 1)) }}
                                    </div>
                                    <div class="customer-name-sub">
                                        <span class="customer-main-name">{{ $customer->name }}</span>
                                        <span class="customer-date-sub">Joined on {{ $customer->created_at->format('d M, Y') }}</span>
                                    </div>
                                </div>
                            </td>
                            
                            <!-- Email -->
                            <td style="font-weight: 500; color: #4b5563;">{{ $customer->email }}</td>
                            
                            <!-- Phone -->
                            <td style="font-weight: 600; color: #374151;">{{ $customer->phone_number ?? '&mdash;' }}</td>
                            
                            <!-- Status Badges -->
                            <td>
                                <span class="status-badge-pill">
                                    <i class="bi bi-circle-fill"></i>
                                    {{ $customer->approval_status }}
                                </span>
                            </td>
                            
                            <!-- Decision actions -->
                            <td>
                                <div class="action-row" style="justify-content: center;">
                                    <form method="POST" action="{{ route('admin.customers.approve', $customer->id) }}" style="margin: 0;">
                                        @csrf
                                        @method('PUT')
                                        <button type="submit" class="btn-action-small btn-approve">
                                            <i class="bi bi-check-lg"></i>
                                            <span>Approve</span>
                                        </button>
                                    </form>

                                    <form method="POST" action="{{ route('admin.customers.reject', $customer->id) }}" style="margin: 0;" onsubmit="return confirm('Are you sure you want to reject registration request for {{ $customer->name }}?')">
                                        @csrf
                                        @method('PUT')
                                        <button type="submit" class="btn-action-small btn-reject">
                                            <i class="bi bi-x-lg"></i>
                                            <span>Reject</span>
                                        </button>
                                    </form>
                                </div>
                            </td>
                        </tr>
                    @empty
                        <tr>
                            <td colspan="6" style="padding: 0;">
                                <div class="empty-card" style="border: none;">
                                    <div class="empty-icon" style="background: #ecfdf5; color: #10b981;">
                                        <i class="bi bi-person-check-fill"></i>
                                    </div>
                                    <h3>Registry Fully Approved</h3>
                                    <p>All registered customers are verified. There are no pending signups needing immediate approval.</p>
                                </div>
                            </td>
                        </tr>
                    @endforelse
                </tbody>
            </table>
        </div>
    </div>
</div>

<script>
    document.addEventListener("DOMContentLoaded", function() {
        const successNotify = document.getElementById('popup-notification');
        const deleteNotify = document.getElementById('popup-notification-delete');

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
    });
</script>

@endsection