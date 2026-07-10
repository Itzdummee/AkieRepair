@extends('layouts.technician')

@section('title', 'Assigned Jobs')

@section('content')

<style>
    .modern-header {
        position: relative;
        background: linear-gradient(135deg, #0f5132, #145c45);
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
        color: #d1fae5;
        font-weight: 800;
        margin: 0 0 8px 0;
        letter-spacing: -0.025em;
    }
    .modern-header .header-subtitle {
        font-size: 1.05rem;
        color: #d1fae5;
        margin: 0;
        max-width: 500px;
        line-height: 1.5;
    }
    .modern-header .header-decoration {
        position: absolute;
        top: -50%;
        right: -10%;
        width: 400px;
        height: 400px;
        background: radial-gradient(circle, rgba(52, 211, 153, 0.18) 0%, rgba(15, 81, 50, 0) 70%);
        border-radius: 50%;
        z-index: 1;
        pointer-events: none;
    }
    @media(max-width: 600px) {
        .modern-header { padding: 24px; }
        .modern-header .header-content { flex-direction: column; text-align: center; gap: 16px; }
        .modern-header .header-title { font-size: 1.75rem; }
    }

    .jobs-stats-grid {
        display: grid;
        grid-template-columns: repeat(3, 1fr);
        gap: 24px;
        margin-bottom: 35px;
    }
    .jobs-stat-card {
        background: white;
        border: 1px solid #e5e7eb;
        border-radius: 12px;
        padding: 24px;
        display: flex;
        align-items: center;
        justify-content: space-between;
        box-shadow: var(--shadow);
        position: relative;
        overflow: hidden;
    }
    .jobs-stat-card::after {
        content: "";
        position: absolute;
        bottom: 0;
        left: 0;
        right: 0;
        height: 4px;
    }
    .jobs-stat-card.active::after { background: var(--blue); }
    .jobs-stat-card.progress::after { background: #f97316; }
    .jobs-stat-card.completed::after { background: var(--green); }

    .jobs-stat-card p {
        color: var(--muted);
        font-size: 14px;
        text-transform: uppercase;
        letter-spacing: 0.05em;
        font-weight: 600;
        margin-bottom: 4px;
    }
    .jobs-stat-card h3 {
        font-family: Arial, sans-serif;
        font-size: 34px;
        color: #111827;
        font-weight: 700;
    }
    .jobs-stat-icon {
        width: 52px;
        height: 52px;
        border-radius: 10px;
        display: grid;
        place-items: center;
        color: white;
        font-size: 22px;
        box-shadow: 0 8px 16px rgba(0,0,0,0.08);
    }
    .jobs-stat-icon.active { background: var(--blue); }
    .jobs-stat-icon.progress { background: #f97316; }
    .jobs-stat-icon.completed { background: var(--green); }

    .bookings-table-wrap {
        background: #fff;
        border-radius: 16px;
        border: 1px solid #e5e7eb;
        box-shadow: 0 4px 6px -1px rgba(0,0,0,0.06);
        overflow: hidden;
    }
    .bookings-table { width:100%; border-collapse:collapse; }
    .bookings-table thead {
        background: #f9fafb;
        border-bottom: 2px solid #e5e7eb;
    }
    .bookings-table th {
        padding: 14px 18px;
        text-align: left;
        font-size: 0.75rem;
        font-weight: 700;
        color: #6b7280;
        text-transform: uppercase;
        letter-spacing: 0.07em;
        white-space: nowrap;
    }
    .bookings-table td {
        padding: 16px 18px;
        font-size: 0.9rem;
        color: #374151;
        border-bottom: 1px solid #f3f4f6;
        vertical-align: middle;
    }
    .bookings-table tbody tr:last-child td { border-bottom: none; }
    .bookings-table tbody tr:hover { background: #fafafa; }

    .status-badge {
        padding: 4px 10px;
        border-radius: 9999px;
        font-size: 0.75rem;
        font-weight: 700;
        text-transform: capitalize;
        display: inline-block;
        white-space: nowrap;
    }
    .status-pending  { background: #fef3c7; color: #b45309; }
    .status-approved { background: #dcfce7; color: #15803d; }
    .status-rejected { background: #fee2e2; color: #b91c1c; }
    .status-completed{ background: #e0e7ff; color: #4338ca; }
    .status-default  { background: #f3f4f6; color: #4b5563; }

    .btn-view-detail {
        display: inline-flex;
        align-items: center;
        gap: 6px;
        background: #eff6ff;
        color: #2563eb;
        border: 1px solid #bfdbfe;
        border-radius: 8px;
        padding: 7px 13px;
        font-size: 0.82rem;
        font-weight: 600;
        text-decoration: none;
        transition: background 0.2s, transform 0.1s;
    }
    .btn-view-detail:hover { background: #dbeafe; transform: translateY(-1px); }

    .empty-state {
        text-align: center;
        padding: 56px 24px;
        color: #9ca3af;
    }
    .empty-state i { font-size: 3rem; display: block; margin-bottom: 14px; }
    .empty-state h3 { color: #374151; margin: 0 0 8px; font-family: 'Playfair Display', serif; font-size: 1.5rem; }
    .empty-state p  { margin: 0; font-size: 0.9rem; }

    /* DataTable Overrides */
    .dataTables_wrapper .dataTables_filter {
        margin-bottom: 20px;
        padding: 0 20px;
        padding-top: 20px;
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
    .dataTables_wrapper .dataTables_length {
        padding: 0 20px;
        padding-top: 20px;
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
        padding-left: 20px;
        padding-bottom: 20px;
    }
    .dataTables_wrapper .dataTables_paginate {
        margin-top: 15px;
        padding-right: 20px;
        padding-bottom: 20px;
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

    @media(max-width: 900px) {
        .jobs-stats-grid {
            grid-template-columns: 1fr;
        }
    }
</style>

<div class="modern-header">
    <div class="header-content">
        <div class="icon-wrapper">
            <i class="bi bi-briefcase-fill"></i>
        </div>
        <div>
            <h1 class="header-title">Assigned Jobs</h1>
            <p class="header-subtitle">Manage your assigned inspections, repairs, and timelines.</p>
        </div>
    </div>
    <div class="header-decoration"></div>
</div>

<div class="jobs-stats-grid">
    <div class="jobs-stat-card active">
        <div>
            <p>Total Active Jobs</p>
            <h3>{{ $jobs->count() }}</h3>
        </div>
        <div class="jobs-stat-icon active">
            <i class="bi bi-tools"></i>
        </div>
    </div>
    
    <div class="jobs-stat-card progress">
        <div>
            <p>In Progress</p>
            <h3>{{ $jobs->where('status', 'Repair In Progress')->count() }}</h3>
        </div>
        <div class="jobs-stat-icon progress">
            <i class="bi bi-hourglass-split"></i>
        </div>
    </div>
    
    <div class="jobs-stat-card completed">
        <div>
            <p>Completed</p>
            <h3>{{ $completedCount }}</h3>
        </div>
        <div class="jobs-stat-icon completed">
            <i class="bi bi-check2-all"></i>
        </div>
    </div>
</div>

<div class="bookings-table-wrap">
    @if($jobs->count())
        <table class="bookings-table" id="assignedJobsTable">
            <thead>
                <tr>
                    <th>#</th>
                    <th>Customer</th>
                    <th>Device</th>
                    <th>Assigned On</th>
                    <th>Status</th>
                    <th style="text-align:center;">Action</th>
                </tr>
            </thead>
            <tbody>
                @foreach($jobs as $job)
                    @php
                        $statusLower = strtolower($job->status);
                        if(str_contains($statusLower,'progress'))
                            $sc = 'status-pending'; // Orange
                        elseif(str_contains($statusLower,'finish') || str_contains($statusLower,'completed'))
                            $sc = 'status-completed'; // Greenish/Blueish
                        elseif(str_contains($statusLower,'inspection') || str_contains($statusLower,'approval'))
                            $sc = 'status-approved';
                        else
                            $sc = 'status-default';
                    @endphp
                    <tr>
                        <td style="font-weight:700; color:#111827;">#{{ $job->id }}</td>
                        <td style="font-weight:600; color:#111827;">
                            {{ $job->customer->name ?? '-' }}
                        </td>
                        <td>
                            <div style="font-weight:600; color:#111827;">{{ $job->device->name ?? '-' }}</div>
                            <div style="font-size:0.8rem; color:#9ca3af;">{{ $job->device->brand ?? '' }}</div>
                        </td>
                        <td>{{ $job->created_at->format('d M Y') }}</td>
                        <td><span class="status-badge {{ $sc }}">{{ $job->status }}</span></td>
                        <td style="text-align:center;">
                            <a href="{{ route('technician.assigned.show', $job->id) }}" class="btn-view-detail">
                                <i class="bi bi-eye-fill"></i> View Details
                            </a>
                        </td>
                    </tr>
                @endforeach
            </tbody>
        </table>
    @else
        <div class="empty-state">
            <i class="bi bi-wrench"></i>
            <h3>No active repair jobs</h3>
            <p>Jobs appear here automatically when they are assigned to you.</p>
        </div>
    @endif
</div>

<!-- jQuery and DataTables -->
<script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
<link rel="stylesheet" href="https://cdn.datatables.net/1.13.6/css/jquery.dataTables.min.css">
<script src="https://cdn.datatables.net/1.13.6/js/jquery.dataTables.min.js"></script>

<script>
    $(document).ready(function() {
        $('#assignedJobsTable').DataTable({
            pageLength: 10,
            lengthMenu: [5, 10, 25, 50],
            order: [[0, 'desc']],
            ordering: true,
            searching: true,
            language: {
                search: "",
                searchPlaceholder: "Search jobs..."
            }
        });
    });
</script>

@endsection
