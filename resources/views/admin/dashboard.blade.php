@extends('layouts.admin')

@section('title', 'Admin Dashboard Overview')

@section('content')
<!-- Custom Modern CSS styles directly in dashboard to provide high visual grade premium style -->
<style>
    .pro-dashboard {
        display: flex;
        flex-direction: column;
        gap: 30px;
    }
    
    /* Stats Grid styling */
    .pro-stats-grid {
        display: grid;
        grid-template-columns: repeat(auto-fit, minmax(240px, 1fr));
        gap: 20px;
    }
    
    .pro-stat-card {
        background: #ffffff;
        border: 1px solid rgba(229, 231, 235, 0.8);
        border-radius: 16px;
        padding: 24px;
        display: flex;
        align-items: center;
        justify-content: space-between;
        box-shadow: 0 4px 6px -1px rgba(0, 0, 0, 0.05), 0 2px 4px -1px rgba(0, 0, 0, 0.02);
        transition: all 0.3s cubic-bezier(0.4, 0, 0.2, 1);
        position: relative;
        overflow: hidden;
    }
    
    .pro-stat-card:hover {
        transform: translateY(-4px);
        box-shadow: 0 20px 25px -5px rgba(0, 0, 0, 0.06), 0 10px 10px -5px rgba(0, 0, 0, 0.03);
        border-color: rgba(99, 102, 241, 0.3);
    }
    
    .pro-stat-card::before {
        content: '';
        position: absolute;
        bottom: 0;
        left: 0;
        width: 100%;
        height: 4px;
        background: transparent;
        transition: background 0.3s ease;
    }
    
    .pro-stat-card.sales::before { background: linear-gradient(90deg, #10b981, #059669); }
    .pro-stat-card.active-repairs::before { background: linear-gradient(90deg, #3b82f6, #1d4ed8); }
    .pro-stat-card.completed::before { background: linear-gradient(90deg, #8b5cf6, #6d28d9); }
    .pro-stat-card.ticket::before { background: linear-gradient(90deg, #f59e0b, #d97706); }
    
    .pro-stat-info {
        display: flex;
        flex-direction: column;
        gap: 6px;
    }
    
    .pro-stat-label {
        font-size: 13px;
        font-weight: 700;
        color: #6b7280;
        text-transform: uppercase;
        letter-spacing: 0.05em;
    }
    
    .pro-stat-value {
        font-family: 'Mukta Mahee', sans-serif;
        font-size: 28px;
        font-weight: 700;
        color: #111827;
        line-height: 1;
    }
    
    .pro-stat-desc {
        font-size: 12px;
        color: #9ca3af;
    }
    
    .pro-stat-icon-box {
        width: 56px;
        height: 56px;
        border-radius: 12px;
        display: grid;
        place-items: center;
        font-size: 24px;
        transition: all 0.3s ease;
    }
    
    .pro-stat-card:hover .pro-stat-icon-box {
        transform: scale(1.1) rotate(5deg);
    }
    
    .icon-sales { background: #e6fbf3; color: #10b981; }
    .icon-active-repairs { background: #eff6ff; color: #3b82f6; }
    .icon-completed { background: #f5f3ff; color: #8b5cf6; }
    .icon-ticket { background: #fffbeb; color: #f59e0b; }
    
    /* Analytics & Trends layout */
    .pro-analytics-grid {
        display: grid;
        grid-template-columns: 2fr 1fr;
        gap: 24px;
    }
    
    @media(max-width: 1024px) {
        .pro-analytics-grid {
            grid-template-columns: 1fr;
        }
    }
    
    .pro-card {
        background: #ffffff;
        border: 1px solid rgba(229, 231, 235, 0.8);
        border-radius: 16px;
        padding: 24px;
        box-shadow: 0 4px 6px -1px rgba(0, 0, 0, 0.05);
    }
    
    .pro-card-header {
        display: flex;
        justify-content: space-between;
        align-items: center;
        margin-bottom: 20px;
        padding-bottom: 12px;
        border-bottom: 1px solid #f3f4f6;
    }
    
    .pro-card-title {
        font-family: 'Playfair Display', serif;
        font-size: 20px;
        font-weight: 700;
        color: #111827;
        display: flex;
        align-items: center;
        gap: 10px;
    }
    
    .pro-card-title i {
        color: #6366f1;
        font-size: 22px;
    }
    
    .pro-chart-container {
        position: relative;
        height: 320px;
        width: 100%;
    }
    
    /* Table Styling */
    .pro-table {
        width: 100%;
        border-collapse: separate;
        border-spacing: 0;
        margin-top: 10px;
    }
    
    .pro-table th {
        background: #f9fafb;
        padding: 14px 18px;
        font-size: 12px;
        font-weight: 700;
        color: #4b5563;
        text-transform: uppercase;
        letter-spacing: 0.05em;
        border-bottom: 1px solid #e5e7eb;
    }
    
    .pro-table th:first-child { border-top-left-radius: 8px; }
    .pro-table th:last-child { border-top-right-radius: 8px; }
    
    .pro-table td {
        padding: 16px 18px;
        border-bottom: 1px solid #f3f4f6;
        color: #374151;
        font-size: 14px;
        vertical-align: middle;
    }
    
    .pro-table tr:last-child td {
        border-bottom: none;
    }
    
    .pro-table tr {
        transition: background 0.2s ease;
    }
    
    .pro-table tr:hover td {
        background: #f9fafb;
    }
    
    /* Elegant Badges */
    .pro-badge {
        display: inline-flex;
        align-items: center;
        gap: 6px;
        padding: 4px 12px;
        border-radius: 50px;
        font-size: 11px;
        font-weight: 700;
        text-transform: uppercase;
        letter-spacing: 0.03em;
    }
    
    .badge-completed { background-color: #d1fae5; color: #065f46; }
    .badge-progress { background-color: #dbeafe; color: #1e40af; }
    .badge-pending { background-color: #fef3c7; color: #92400e; }
    .badge-danger { background-color: #fee2e2; color: #991b1b; }
    
    .customer-profile {
        display: flex;
        align-items: center;
        gap: 12px;
    }
    
    .customer-avatar {
        width: 36px;
        height: 36px;
        border-radius: 50%;
        background: linear-gradient(135deg, #6366f1, #a855f7);
        color: #ffffff;
        font-weight: 700;
        display: grid;
        place-items: center;
        font-size: 14px;
    }
</style>

<div class="pro-dashboard">
    <!-- Header Area -->
    <!-- Core Business Stats Grid -->
    <div class="pro-stats-grid">
        <!-- Sales Card -->
        <div class="pro-stat-card sales">
            <div class="pro-stat-info">
                <span class="pro-stat-label">Total Sales</span>
                <span class="pro-stat-value">RM {{ number_format($totalSales, 2) }}</span>
                <span class="pro-stat-desc">From completed repairs</span>
            </div>
            <div class="pro-stat-icon-box icon-sales">
                <i class="bi bi-cash-stack"></i>
            </div>
        </div>

        <!-- Ticket Card -->
        <div class="pro-stat-card ticket">
            <div class="pro-stat-info">
                <span class="pro-stat-label">Average Ticket</span>
                <span class="pro-stat-value">RM {{ number_format($averageTicketValue, 2) }}</span>
                <span class="pro-stat-desc">Per completed repair job</span>
            </div>
            <div class="pro-stat-icon-box icon-ticket">
                <i class="bi bi-graph-up-arrow"></i>
            </div>
        </div>

        <!-- Active Card -->
        <div class="pro-stat-card active-repairs">
            <div class="pro-stat-info">
                <span class="pro-stat-label">Active Repairs</span>
                <span class="pro-stat-value">{{ $activeRepairs }}</span>
                <span class="pro-stat-desc">Repairs currently in progress</span>
            </div>
            <div class="pro-stat-icon-box icon-active-repairs">
                <i class="bi bi-wrench-adjustable"></i>
            </div>
        </div>

        <!-- Completed Card -->
        <div class="pro-stat-card completed">
            <div class="pro-stat-info">
                <span class="pro-stat-label">Completed Repairs</span>
                <span class="pro-stat-value">{{ $completedRepairsCount }}</span>
                <span class="pro-stat-desc">Total successful repair jobs</span>
            </div>
            <div class="pro-stat-icon-box icon-completed">
                <i class="bi bi-patch-check-fill"></i>
            </div>
        </div>
    </div>

    <!-- Charts & Analytics Section -->
    <div class="pro-analytics-grid">
        <!-- Repair & Sales Trends -->
        <div class="pro-card">
            <div class="pro-card-header">
                <span class="pro-card-title">
                    <i class="bi bi-activity"></i> Repair & Sales Trends (6-Month Activity)
                </span>
                <span style="font-size: 12px; color: #9ca3af; font-weight: 600;">Live Feed</span>
            </div>
            <div class="pro-chart-container">
                <canvas id="trendsChart"></canvas>
            </div>
        </div>

        <!-- Repair Device Type Breakdown -->
        <div class="pro-card">
            <div class="pro-card-header">
                <span class="pro-card-title">
                    <i class="bi bi-pie-chart-fill"></i> Repair Device Type Breakdown
                </span>
            </div>
            <div class="pro-chart-container" style="height: 230px;">
                <canvas id="deviceBreakdownChart"></canvas>
            </div>
            <div style="margin-top: 20px; display: flex; flex-direction: column; gap: 10px; font-size: 13px; color: #4b5563;">
                <div style="display: flex; justify-content: space-between; align-items: center; border-bottom: 1px dashed #f3f4f6; padding-bottom: 6px;">
                    <span>Total Repair Requests</span>
                    <strong>{{ $totalRepairDeviceBookings }} Jobs</strong>
                </div>
                <div style="display: flex; justify-content: space-between; align-items: center;">
                    <span>Device Types Repaired</span>
                    <strong>{{ $totalRepairDeviceTypes }} Types</strong>
                </div>
            </div>
        </div>
    </div>

    <!-- Bookings and System Registry Totals -->
    <div class="pro-analytics-grid" style="grid-template-columns: 1fr 300px;">
        <!-- Recent Booking Activities -->
        <div class="pro-card">
            <div class="pro-card-header">
                <span class="pro-card-title">
                    <i class="bi bi-calendar3"></i> Recent Booking Activities
                </span>
                <a href="{{ route('admin.bookings.history') }}" class="btn blue" style="padding: 6px 14px; font-size: 11px; border-radius: 6px;">View History</a>
            </div>
            <div class="table-wrap">
                <table class="pro-table">
                    <thead>
                        <tr>
                            <th>Customer</th>
                            <th>Device / Model</th>
                            <th>Visit Date</th>
                            <th>Quoted Cost</th>
                            <th>Status</th>
                        </tr>
                    </thead>
                    <tbody>
                        @forelse($recentBookings as $booking)
                            <tr>
                                <td>
                                    <div class="customer-profile">
                                        <div class="customer-avatar">
                                            {{ strtoupper(substr($booking->customer->name ?? 'C', 0, 1)) }}
                                        </div>
                                        <div>
                                            <div style="font-weight: 700; color: #111827;">{{ $booking->customer->name ?? 'Guest Customer' }}</div>
                                            <div style="font-size: 12px; color: #6b7280;">{{ $booking->customer->email ?? '-' }}</div>
                                        </div>
                                    </div>
                                </td>
                                <td>
                                    <div style="font-weight: 600; color: #374151;">{{ $booking->device->name ?? 'Generic Device' }}</div>
                                    <div style="font-size: 12px; color: #9ca3af;">{{ $booking->device->brand ?? '' }} - {{ $booking->device->model ?? '' }}</div>
                                </td>
                                <td style="font-weight: 500; color: #4b5563;">
                                    {{ $booking->visit_date ? \Carbon\Carbon::parse($booking->visit_date)->format('d M, Y') : '-' }}
                                </td>
                                <td style="font-weight: 700; color: #111827;">
                                    {{ $booking->quotation_price ? 'RM ' . number_format($booking->quotation_price, 2) : '-' }}
                                </td>
                                <td>
                                    @php
                                        $badgeClass = 'badge-pending';
                                        if ($booking->status === 'Repair Completed') {
                                            $badgeClass = 'badge-completed';
                                        } elseif (in_array($booking->status, ['Repair In Progress', 'Technician Assigned', 'Inspection Completed', 'Quotation Sent'])) {
                                            $badgeClass = 'badge-progress';
                                        } elseif (in_array($booking->status, ['Quotation Rejected', 'Cancelled'])) {
                                            $badgeClass = 'badge-danger';
                                        }
                                    @endphp
                                    <span class="pro-badge {{ $badgeClass }}">
                                        {{ $booking->status }}
                                    </span>
                                </td>
                            </tr>
                        @empty
                            <tr>
                                <td colspan="5" style="text-align: center; color: #9ca3af; padding: 40px 10px;">
                                    <i class="bi bi-folder-x" style="font-size: 32px; display: block; margin-bottom: 8px; color: #9ca3af;"></i>
                                    No booking activities recorded yet.
                                </td>
                            </tr>
                        @endforelse
                    </tbody>
                </table>
            </div>
        </div>

        <!-- Registry Side Column -->
        <div style="display: flex; flex-direction: column; gap: 20px;">
            <div class="pro-card">
                <div class="pro-card-header" style="margin-bottom: 15px; padding-bottom: 8px;">
                    <span class="pro-card-title" style="font-size: 16px;">
                        <i class="bi bi-database"></i> Registry Overview
                    </span>
                </div>
                <div style="display: flex; flex-direction: column; gap: 14px;">
                    <div style="display: flex; align-items: center; justify-content: space-between;">
                        <div style="display: flex; align-items: center; gap: 8px; font-size: 13px; color: #4b5563;">
                            <span style="width: 8px; height: 8px; border-radius: 50%; background: #ec4899; display: inline-block;"></span>
                            Total Customers
                        </div>
                        <span style="font-weight: 700; color: #111827;">{{ $totalCustomers }}</span>
                    </div>
                    <div style="display: flex; align-items: center; justify-content: space-between;">
                        <div style="display: flex; align-items: center; gap: 8px; font-size: 13px; color: #4b5563;">
                            <span style="width: 8px; height: 8px; border-radius: 50%; background: #06b6d4; display: inline-block;"></span>
                            Approved Technicians
                        </div>
                        <span style="font-weight: 700; color: #111827;">{{ $totalTechnicians }}</span>
                    </div>
                    <div style="display: flex; align-items: center; justify-content: space-between;">
                        <div style="display: flex; align-items: center; gap: 8px; font-size: 13px; color: #4b5563;">
                            <span style="width: 8px; height: 8px; border-radius: 50%; background: #8b5cf6; display: inline-block;"></span>
                            Repair Categories
                        </div>
                        <span style="font-weight: 700; color: #111827;">{{ $totalServices }}</span>
                    </div>
                    <div style="display: flex; align-items: center; justify-content: space-between; border-bottom: 1px solid #f3f4f6; padding-bottom: 12px;">
                        <div style="display: flex; align-items: center; gap: 8px; font-size: 13px; color: #4b5563;">
                            <span style="width: 8px; height: 8px; border-radius: 50%; background: #14b8a6; display: inline-block;"></span>
                            Specific Repair Rates
                        </div>
                        <span style="font-weight: 700; color: #111827;">{{ $totalRepairs }}</span>
                    </div>
                    
                    @if($pendingCustomers > 0)
                        <div style="background: #fdf2f8; border: 1px dashed #fbcfe8; border-radius: 8px; padding: 12px; font-size: 12px; color: #9d174d; text-align: center; font-weight: 600;">
                            <i class="bi bi-exclamation-circle-fill" style="margin-right: 4px;"></i> Action: <a href="{{ route('admin.customers.pending') }}" style="text-decoration: underline; color: #be185d;">{{ $pendingCustomers }} Customers Pending Approval</a>
                        </div>
                    @else
                        <div style="background: #f0fdf4; border: 1px dashed #bbf7d0; border-radius: 8px; padding: 12px; font-size: 12px; color: #15803d; text-align: center; font-weight: 600;">
                            <i class="bi bi-check-circle-fill" style="margin-right: 4px;"></i> System Registry Healthy
                        </div>
                    @endif
                </div>
            </div>
        </div>
    </div>
</div>

<!-- Chart.js CDN -->
<script src="https://cdn.jsdelivr.net/npm/chart.js"></script>
<script>
    document.addEventListener("DOMContentLoaded", function() {
        // Hydrate data from Controller
        const months = @json($months);
        const bookingCounts = @json($bookingCounts);
        const salesRevenue = @json($salesRevenue);

        // 1. Repair Trends Dual Scale Line Chart
        const ctxTrends = document.getElementById('trendsChart').getContext('2d');
        new Chart(ctxTrends, {
            type: 'line',
            data: {
                labels: months,
                datasets: [
                    {
                        label: 'Revenue (RM)',
                        data: salesRevenue,
                        borderColor: '#10b981',
                        backgroundColor: 'rgba(16, 185, 129, 0.06)',
                        borderWidth: 3,
                        pointBackgroundColor: '#10b981',
                        pointBorderColor: '#ffffff',
                        pointHoverRadius: 8,
                        tension: 0.35,
                        fill: true,
                        yAxisID: 'yRevenue'
                    },
                    {
                        label: 'Repair Requests (Qty)',
                        data: bookingCounts,
                        borderColor: '#6366f1',
                        backgroundColor: 'transparent',
                        borderWidth: 2.5,
                        pointBackgroundColor: '#6366f1',
                        pointBorderColor: '#ffffff',
                        pointStyle: 'rectRot',
                        pointHoverRadius: 8,
                        tension: 0.35,
                        yAxisID: 'yBookings'
                    }
                ]
            },
            options: {
                responsive: true,
                maintainAspectRatio: false,
                plugins: {
                    legend: {
                        position: 'top',
                        labels: {
                            font: { family: "'Mukta Mahee', sans-serif", weight: '600', size: 12 },
                            usePointStyle: true,
                            padding: 20
                        }
                    },
                    tooltip: {
                        padding: 12,
                        backgroundColor: 'rgba(17, 24, 39, 0.95)',
                        titleFont: { family: "'Mukta Mahee', sans-serif", size: 14, weight: '700' },
                        bodyFont: { family: "'Mukta Mahee', sans-serif", size: 13 },
                        cornerRadius: 8
                    }
                },
                scales: {
                    x: {
                        grid: { display: false },
                        ticks: { font: { family: "'Mukta Mahee', sans-serif", size: 12, weight: '500' } }
                    },
                    yRevenue: {
                        type: 'linear',
                        position: 'left',
                        grid: { color: 'rgba(243, 244, 246, 0.8)' },
                        ticks: {
                            font: { family: "'Mukta Mahee', sans-serif", size: 11 },
                            callback: function(value) { return 'RM ' + value; }
                        },
                        title: {
                            display: true,
                            text: 'Completed Revenue (RM)',
                            font: { family: "'Mukta Mahee', sans-serif", weight: '700', size: 12 }
                        }
                    },
                    yBookings: {
                        type: 'linear',
                        position: 'right',
                        grid: { display: false },
                        ticks: { font: { family: "'Mukta Mahee', sans-serif", size: 11 } },
                        title: {
                            display: true,
                            text: 'Requests Count',
                            font: { family: "'Mukta Mahee', sans-serif", weight: '700', size: 12 }
                        }
                    }
                }
            }
        });

        // 2. Repair Device Type Breakdown Doughnut Chart
        const deviceData = @json($repairDeviceDistribution);
        const deviceLabels = deviceData.map(item => item.type);
        const deviceCounts = deviceData.map(item => item.count);

        const ctxDevice = document.getElementById('deviceBreakdownChart').getContext('2d');
        new Chart(ctxDevice, {
            type: 'doughnut',
            data: {
                labels: deviceLabels,
                datasets: [{
                    data: deviceCounts,
                    backgroundColor: ['#6366f1', '#14b8a6', '#f59e0b', '#ec4899', '#8b5cf6', '#10b981'],
                    borderWidth: 2,
                    borderColor: '#ffffff',
                    hoverOffset: 6
                }]
            },
            options: {
                responsive: true,
                maintainAspectRatio: false,
                plugins: {
                    legend: {
                        position: 'bottom',
                        labels: {
                            font: { family: "'Mukta Mahee', sans-serif", weight: '600', size: 11 },
                            boxWidth: 8,
                            usePointStyle: true,
                            padding: 12
                        }
                    },
                    tooltip: {
                        padding: 10,
                        backgroundColor: 'rgba(17, 24, 39, 0.95)',
                        callbacks: {
                            label: function(context) {
                                let label = context.label || '';
                                if (label) { label += ': '; }
                                label += context.raw + ' Repair Jobs';
                                return label;
                            }
                        }
                    }
                },
                cutout: '65%'
            }
        });
    });
</script>
@endsection
