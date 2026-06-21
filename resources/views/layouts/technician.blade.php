<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>@yield('title', 'Technician Panel')</title>
    <meta name="viewport" content="width=device-width, initial-scale=1.0">

    <link href="https://fonts.googleapis.com/css2?family=Playfair+Display:wght@500;700&family=Mukta+Mahee:wght@300;400;600;700&display=swap" rel="stylesheet">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.11.3/font/bootstrap-icons.min.css">

    <style>
        :root{
            --pink:#e61c5d;
            --dark:#111827;
            --muted:#6b7280;
            --light:#f8f9fa;
            --line:#e5e7eb;
            --green:#16a34a;
            --blue:#2563eb;
            --red:#dc2626;
            --yellow:#f3ff6b;
            --shadow:0 15px 45px rgba(0,0,0,.08);
        }

        *{box-sizing:border-box;margin:0;padding:0}

        body{
            font-family:'Mukta Mahee',sans-serif;
            background:#f5f6f8;
            color:var(--muted);
            line-height:1.7;
        }

        h1,h2,h3,h4{
            font-family:'Playfair Display',serif;
            color:#000;
        }

        a{text-decoration:none;color:inherit}

        .tech-wrapper{
            display:flex;
            min-height:100vh;
        }

        .sidebar{
            width:270px;
            background:white;
            height:100vh;
            position:fixed;
            left:0;
            top:0;
            border-right:1px solid #e5e7eb;
            display:flex;
            flex-direction:column;
            padding:25px 20px;
            box-sizing:border-box;
            z-index:100;
            font-family:'Mukta Mahee', sans-serif;
        }

        .brand-box{
            display:flex;
            align-items:center;
            gap:12px;
            padding-bottom:22px;
            border-bottom:1px solid var(--line);
            margin-bottom:18px;
        }

        .brand-icon{
            width:42px;
            height:42px;
            border-radius:12px;
            background:#111;
            color:white;
            display:grid;
            place-items:center;
            font-weight:700;
            font-family:'Mukta Mahee', sans-serif;
        }

        .brand-box h3{
            font-family:'Playfair Display', serif;
            font-size:20px;
            font-weight:700;
            color:#000;
            margin-bottom:0;
        }

        .brand-box p{
            font-family:'Mukta Mahee', sans-serif;
            font-size:13px;
            color:var(--muted);
            margin:0;
        }

        .menu-section{
            margin:6px 0;
        }

        .menu a{
            display:flex;
            align-items:center;
            gap:12px;
            padding:12px 14px;
            border-radius:8px;
            color:#374151;
            font-family:'Mukta Mahee', sans-serif;
            font-weight:700;
            font-size:15px;
            background:transparent;
            border:none;
            cursor:pointer;
            text-align:left;
            transition:.2s;
            margin-bottom:8px;
            text-decoration:none;
        }

        .menu a:hover{
            background:#f3f4f6;
            color:#000;
        }

        .menu a.active{
            background:#f3f4f6;
            color:#000;
            border-left: 4px solid var(--pink);
            border-radius: 0 8px 8px 0;
            padding-left: 10px;
        }

        .menu a i{
            font-size:16px;
            width:20px;
            text-align:center;
        }

        .logout-box{
            margin-top:auto;
            padding-top:20px;
            border-top:1px solid var(--line);
        }

        .user-row{
            display:flex;
            align-items:center;
            gap:14px;
        }

        .avatar{
            width:50px;
            height:50px;
            border-radius:50%;
            background:#111827;
            color:white;
            display:flex;
            align-items:center;
            justify-content:center;
            font-size:18px;
            font-weight:700;
            flex-shrink:0;
        }

        .user-text{
            flex:1;
        }

        .user-text strong{
            display:block;
            font-family:'Mukta Mahee', sans-serif;
            font-size:16px;
            font-weight:700;
            color:#111827;
            margin-bottom:3px;
        }

        .user-text span{
            font-family:'Mukta Mahee', sans-serif;
            color:var(--muted);
            font-size:14px;
        }

        .logout-icon{
            border:none;
            background:transparent;
            color:#dc2626;
            font-size:26px;
            font-weight:bold;
            cursor:pointer;
            transition:0.2s;
            padding:5px;
            display: flex;
            align-items: center;
        }

        .logout-icon:hover{
            color:#991b1b;
            transform:scale(1.15);
        }

        .main{
            margin-left:270px;
            width:calc(100% - 270px);
            padding:40px;
        }

        .success {
            background:#eafff3;
            border:1px solid #bbf7d0;
            color:#16a34a;
            padding:15px 20px;
            border-radius:10px;
            margin-bottom:25px;
            font-weight:600;
            transition:.4s ease;
        }

        .delete {
            background:#fff1ed;
            border:1px solid #fecaca;
            color:#dc2626;
            padding:15px 20px;
            border-radius:10px;
            margin-bottom:25px;
            font-weight:600;
            transition:.4s ease;
        }

        @media(max-width:900px){
            .sidebar{
                position:relative;
                width:100%;
                height:auto;
                border-right:none;
                border-bottom:1px solid #e5e7eb;
            }

            .main{
                margin-left:0;
                width:100%;
                padding:20px;
            }

            .tech-wrapper{
                flex-direction:column;
            }

            .logout-box{
                margin-top:20px;
            }
        }

        /* Red Notification Badge for Sidebar Links */
        .badge-notify {
            background-color: #ef4444;
            color: #ffffff;
            font-size: 10px;
            font-weight: 700;
            padding: 2px 6px;
            border-radius: 50px;
            min-width: 16px;
            height: 16px;
            display: inline-flex;
            align-items: center;
            justify-content: center;
            line-height: 1;
            box-shadow: 0 2px 4px rgba(239, 68, 68, 0.2);
            animation: badgePulse 2s infinite;
        }

        /* Pulsing animation for active indicators */
        @keyframes badgePulse {
            0% { transform: scale(1); box-shadow: 0 0 0 0 rgba(239, 68, 68, 0.4); }
            70% { transform: scale(1.05); box-shadow: 0 0 0 6px rgba(239, 68, 68, 0); }
            100% { transform: scale(1); box-shadow: 0 0 0 0 rgba(239, 68, 68, 0); }
        }

        html,
        body{
            max-width:100%;
            overflow-x:hidden;
        }

        img,
        svg,
        video,
        canvas{
            max-width:100%;
        }

        img{
            height:auto;
        }

        .main{
            min-width:0;
        }

        .sidebar{
            overflow-y:auto;
        }

        .bookings-table-wrap,
        .table-wrap{
            width:100%;
            overflow-x:auto;
            -webkit-overflow-scrolling:touch;
        }

        .bookings-table-wrap table,
        .table-wrap table{
            width:100% !important;
            min-width:0;
        }

        .bookings-table-wrap .dataTables_wrapper{
            width:100% !important;
            min-width:0;
            max-width:100%;
        }

        .dataTables_wrapper .dataTables_length label,
        .dataTables_wrapper .dataTables_filter label{
            display:inline-flex;
            align-items:center;
            gap:8px;
            flex-wrap:wrap;
            color:#111827;
            font-weight:700;
        }

        .dataTables_wrapper .dataTables_length select{
            width:auto !important;
            min-width:70px;
            margin:0 !important;
        }

        .dataTables_wrapper .dataTables_filter input{
            box-sizing:border-box;
            margin-left:0 !important;
        }

        .dataTables_wrapper::after{
            content:"";
            display:block;
            clear:both;
        }

        @media(max-width:1100px){
            .content-grid,
            .inspection-layout{
                grid-template-columns:1fr !important;
            }

            .stats-grid,
            .jobs-stats-grid{
                grid-template-columns:repeat(2, minmax(0, 1fr)) !important;
            }
        }

        @media(max-width:900px){
            .sidebar{
                height:auto;
                max-height:none;
                border-right:none;
                border-bottom:1px solid var(--line);
                padding:18px 16px;
            }

            .logout-box{
                margin-top:20px;
            }

            .main{
                margin-left:0;
                width:100%;
                padding:20px;
            }

            .modern-header .header-content,
            .booking-top,
            .detail-card-header,
            .section-header,
            .card-header{
                flex-wrap:wrap;
            }

            .availability-dashboard{
                max-width:100%;
            }

            .booking-list{
                max-height:360px;
            }
        }

        @media(max-width:640px){
            .main{
                padding:16px;
            }

            .stats-grid,
            .jobs-stats-grid,
            .cards-grid,
            .repair-options-grid,
            .info-grid,
            .form-grid{
                grid-template-columns:1fr !important;
            }

            .modern-header,
            .panel,
            .add-card,
            .availability-section,
            .detail-card,
            .jobs-stat-card,
            .stat-card,
            .booking-card,
            .unavailable-card{
                border-radius:16px !important;
            }

            .modern-header{
                padding:24px 20px !important;
            }

            .modern-header .header-content{
                flex-direction:column;
                text-align:center;
                align-items:center;
            }

            .modern-header .icon-wrapper{
                width:58px;
                height:58px;
                font-size:1.55rem;
            }

            .modern-header .header-title{
                font-size:1.65rem !important;
                line-height:1.15;
            }

            .panel,
            .add-card,
            .availability-section,
            .detail-card-body{
                padding:20px !important;
            }

            .detail-card-header,
            .booking-top,
            .availability-item,
            .card-header,
            .card-actions,
            .modal-buttons,
            .section-header{
                flex-direction:column;
                align-items:stretch !important;
            }

            .booking-info p{
                flex-direction:column;
                gap:2px;
            }

            .booking-info p strong{
                width:auto;
            }

            .btn,
            .btn-view-detail,
            .btn-job-submit,
            .btn-primary,
            .edit-btn,
            .delete-btn,
            .btn-save,
            .btn-secondary,
            .back-btn{
                width:100%;
                justify-content:center;
                white-space:normal;
                text-align:center;
            }

            .dataTables_wrapper .dataTables_length,
            .dataTables_wrapper .dataTables_filter,
            .dataTables_wrapper .dataTables_info,
            .dataTables_wrapper .dataTables_paginate{
                float:none !important;
                width:100%;
                text-align:left !important;
                padding-left:0 !important;
                padding-right:0 !important;
            }

            .dataTables_wrapper .dataTables_filter input{
                width:100% !important;
                max-width:none !important;
                margin-left:0 !important;
                margin-top:8px;
            }

            .dataTables_wrapper .dataTables_paginate{
                display:flex;
                flex-wrap:wrap;
                gap:6px;
            }

            .modal-overlay{
                padding:12px;
            }

            .modal{
                width:100% !important;
                max-width:100% !important;
                max-height:calc(100vh - 24px);
                overflow:auto;
                padding:22px !important;
            }
        }

        body.nav-lock{
            overflow:hidden;
        }

        .mobile-shellbar,
        .mobile-nav-close,
        .mobile-nav-backdrop{
            display:none;
        }

        @media(max-width:900px){
            .mobile-shellbar{
                position:sticky;
                top:0;
                z-index:900;
                display:flex;
                align-items:center;
                justify-content:space-between;
                gap:14px;
                min-height:64px;
                padding:12px 18px;
                background:#ffffff;
                border-bottom:1px solid var(--line);
                box-shadow:0 6px 18px rgba(15,23,42,.08);
            }

            .mobile-shellbar-brand{
                display:flex;
                align-items:center;
                gap:10px;
                min-width:0;
            }

            .mobile-shellbar-brand strong{
                display:block;
                color:#111827;
                font-size:16px;
                line-height:1.15;
            }

            .mobile-shellbar-brand span{
                display:block;
                color:#6b7280;
                font-size:12px;
                line-height:1.15;
            }

            .mobile-nav-toggle,
            .mobile-nav-close{
                width:42px;
                height:42px;
                border:1px solid #e5e7eb;
                border-radius:10px;
                background:#f9fafb;
                color:#111827;
                display:inline-flex;
                align-items:center;
                justify-content:center;
                font-size:22px;
                cursor:pointer;
            }

            .mobile-nav-close{
                position:absolute;
                top:16px;
                right:16px;
                z-index:2;
            }

            .mobile-nav-backdrop{
                position:fixed;
                inset:0;
                z-index:980;
                border:0;
                padding:0;
                background:rgba(15,23,42,.45);
                backdrop-filter:blur(2px);
                cursor:pointer;
            }

            .tech-wrapper .sidebar{
                position:fixed !important;
                top:0 !important;
                left:0 !important;
                z-index:1000;
                width:min(86vw, 320px) !important;
                height:100dvh !important;
                max-height:100dvh !important;
                padding:74px 18px 20px !important;
                transform:translateX(-105%);
                transition:transform .25s ease;
                box-shadow:22px 0 42px rgba(15,23,42,.18);
            }

            .tech-wrapper.nav-open .sidebar{
                transform:translateX(0);
            }

            .tech-wrapper.nav-open .mobile-nav-backdrop{
                display:block;
            }

            .tech-wrapper .main{
                margin-left:0 !important;
                width:100% !important;
            }
        }
    </style>
</head>

<body>

<div class="mobile-shellbar">
    <div class="mobile-shellbar-brand">
        <div class="brand-icon">AR</div>
        <div>
            <strong>AkieRepair</strong>
            <span>Technician Panel</span>
        </div>
    </div>
    <button type="button" class="mobile-nav-toggle" data-panel-toggle="tech-wrapper" aria-label="Open technician navigation" aria-expanded="false">
        <i class="bi bi-list"></i>
    </button>
</div>

<div class="tech-wrapper">
    <button type="button" class="mobile-nav-backdrop" data-panel-close="tech-wrapper" aria-label="Close technician navigation"></button>

    <aside class="sidebar">
        <button type="button" class="mobile-nav-close" data-panel-close="tech-wrapper" aria-label="Close technician navigation">
            <i class="bi bi-x-lg"></i>
        </button>

        <div class="brand-box">
            <div class="brand-icon">AR</div>
            <div>
                <h3>AkieRepair</h3>
                <p>Technician Panel</p>
            </div>
        </div>

        <nav class="menu">
            <a href="{{ route('technician.dashboard') }}"
               class="{{ request()->routeIs('technician.dashboard') ? 'active' : '' }}"
               style="display: flex; justify-content: space-between; align-items: center; width: 100%;">
                <span style="display: flex; align-items: center; gap: 12px;">
                    <i class="bi bi-grid"></i> Dashboard
                </span>
                @if(isset($pendingInspectionsCount) && $pendingInspectionsCount > 0)
                    <span class="badge-notify">{{ $pendingInspectionsCount }}</span>
                @endif
            </a>

            <a href="{{ route('technician.assigned.jobs') }}"
               class="{{ request()->routeIs('technician.assigned.jobs') ? 'active' : '' }}"
               style="display: flex; justify-content: space-between; align-items: center; width: 100%;">
                <span style="display: flex; align-items: center; gap: 12px;">
                    <i class="bi bi-tools"></i> Assigned Jobs
                </span>
                @if(isset($activeRepairsCount) && $activeRepairsCount > 0)
                    <span class="badge-notify">{{ $activeRepairsCount }}</span>
                @endif
            </a>

            <a href="{{ route('technician.availability') }}"
               class="{{ request()->routeIs('technician.availability') ? 'active' : '' }}">
                <i class="bi bi-calendar-x"></i> Availability
            </a>
        </nav>

        <div class="logout-box">
            <div class="user-row">
                <div class="avatar">
                    {{ strtoupper(substr(Auth::user()->name ?? 'T', 0, 1)) }}
                </div>
                <div class="user-text">
                    <strong>{{ Auth::user()->name ?? 'Technician' }}</strong>
                    <span>technician</span>
                </div>

                <form method="POST" action="{{ route('logout') }}">
                    @csrf
                    <button class="logout-icon" title="Logout">
                        <i class="bi bi-box-arrow-right"></i>
                    </button>
                </form>
            </div>
        </div>
    </aside>

    <main class="main">

        

        @if(session('delete'))
            <div class="delete">{{ session('delete') }}</div>
        @endif

        @yield('content')
        <style>
            :root{
                --ui-bg:#f4f6f9;
                --ui-surface:#ffffff;
                --ui-text:#0f172a;
                --ui-muted:#64748b;
                --ui-soft:#f8fafc;
                --ui-line:#e2e8f0;
                --ui-accent:#16a34a;
                --ui-blue:#2563eb;
                --ui-shadow:0 16px 40px rgba(15, 23, 42, .07);
            }

            html{
                background:var(--ui-bg);
            }

            body{
                font-family:'Mukta Mahee', system-ui, -apple-system, BlinkMacSystemFont, "Segoe UI", sans-serif !important;
                background:var(--ui-bg) !important;
                color:var(--ui-text);
                font-size:16px;
                line-height:1.65;
            }

            .main{
                background:var(--ui-bg);
            }

            .sidebar{
                border-right:1px solid var(--ui-line) !important;
                box-shadow:8px 0 30px rgba(15, 23, 42, .035);
            }

            .brand-icon,
            .avatar{
                background:linear-gradient(135deg, #0f172a, #2563eb) !important;
            }

            .brand-box h3,
            .user-text strong{
                color:var(--ui-text) !important;
            }

            .menu a{
                letter-spacing:0;
                transition:background-color .18s ease, color .18s ease, transform .18s ease;
            }

            .menu a:hover,
            .menu a.active{
                background:#eef6ff !important;
                color:#0f172a !important;
            }

            .mobile-shellbar{
                background:rgba(255, 255, 255, .94) !important;
                border-bottom:1px solid var(--ui-line) !important;
                box-shadow:0 10px 28px rgba(15, 23, 42, .07) !important;
                backdrop-filter:blur(14px);
            }

            :where(.modern-header .header-title, .page-title, .section-title, .panel-title, .card-title){
                font-family:'Mukta Mahee', system-ui, sans-serif !important;
                color:var(--ui-text) !important;
                font-size:clamp(1.7rem, 2.5vw, 2.45rem) !important;
                font-weight:800 !important;
                letter-spacing:0 !important;
                line-height:1.12 !important;
            }

            :where(.modern-header p, .section-subtitle, .panel-subtitle){
                color:var(--ui-muted) !important;
                font-size:clamp(.98rem, 1.1vw, 1.08rem) !important;
                line-height:1.6 !important;
            }

            :where(.modern-header, .panel, .add-card, .availability-section, .detail-card, .booking-card, .job-card, .modal){
                background:var(--ui-surface) !important;
                border:1px solid var(--ui-line) !important;
                border-radius:14px !important;
                box-shadow:var(--ui-shadow) !important;
            }

            :where(.stat-card, .job-stat-card, .summary-card, .info-card){
                border-radius:14px !important;
                box-shadow:0 12px 32px rgba(15, 23, 42, .055) !important;
            }

            :where(.btn, .btn-view-detail, .btn-job-submit, .btn-primary, .edit-btn, .delete-btn, .btn-save, .btn-secondary, .back-btn):not(.mobile-nav-toggle):not(.mobile-nav-close):not(.logout-icon){
                border-radius:10px !important;
                font-family:'Mukta Mahee', system-ui, sans-serif !important;
                font-weight:700 !important;
                min-height:42px;
                letter-spacing:0;
                transition:transform .16s ease, box-shadow .16s ease, background-color .16s ease, border-color .16s ease;
            }

            :where(.btn, .btn-view-detail, .btn-job-submit, .btn-primary, .edit-btn, .delete-btn, .btn-save, .btn-secondary, .back-btn):not(.mobile-nav-toggle):not(.mobile-nav-close):not(.logout-icon):hover{
                transform:translateY(-1px);
            }

            :where(input:not([type="checkbox"]):not([type="radio"]):not([type="hidden"]), select, textarea){
                border:1px solid #cbd5e1;
                border-radius:10px;
                color:var(--ui-text);
                font-family:'Mukta Mahee', system-ui, sans-serif;
                outline:none;
                transition:border-color .16s ease, box-shadow .16s ease, background-color .16s ease;
            }

            :where(input:not([type="checkbox"]):not([type="radio"]):not([type="hidden"]), select, textarea):focus{
                border-color:var(--ui-accent) !important;
                box-shadow:0 0 0 4px rgba(22, 163, 74, .12) !important;
                background:#fff;
            }

            :where(.bookings-table-wrap, .table-wrap){
                border-radius:14px;
            }

            :where(.bookings-table-wrap table, .table-wrap table, table.dataTable){
                border-collapse:separate !important;
                border-spacing:0 !important;
                color:#334155;
            }

            :where(.bookings-table-wrap table thead th, .table-wrap table thead th, table.dataTable thead th){
                background:var(--ui-soft) !important;
                color:#334155 !important;
                font-size:.76rem !important;
                font-weight:800 !important;
                letter-spacing:.04em;
                padding:14px 16px !important;
                text-transform:uppercase;
                border-bottom:1px solid var(--ui-line) !important;
            }

            :where(.bookings-table-wrap table tbody td, .table-wrap table tbody td, table.dataTable tbody td){
                color:#334155 !important;
                font-size:.95rem !important;
                padding:14px 16px !important;
                border-bottom:1px solid #edf2f7 !important;
                vertical-align:middle;
            }

            :where(.bookings-table-wrap table tbody tr:hover, .table-wrap table tbody tr:hover, table.dataTable tbody tr:hover){
                background:#f8fafc !important;
            }

            @media(max-width:1100px){
                .content-grid,
                .inspection-layout{
                    grid-template-columns:1fr !important;
                }

                .stats-grid,
                .jobs-stats-grid{
                    grid-template-columns:repeat(2, minmax(0, 1fr)) !important;
                }
            }

            @media(max-width:900px){
                .booking-list{
                    max-height:360px !important;
                }

                .bookings-table-wrap,
                .table-wrap{
                    overflow-x:auto !important;
                    -webkit-overflow-scrolling:touch;
                }

                .bookings-table-wrap table,
                .table-wrap table{
                    min-width:720px !important;
                }
            }

            @media(max-width:640px){
                .main{
                    padding:16px !important;
                }

                .stats-grid,
                .jobs-stats-grid,
                .cards-grid,
                .repair-options-grid,
                .info-grid,
                .form-grid{
                    grid-template-columns:1fr !important;
                }

                .modern-header{
                    padding:24px 20px !important;
                    border-radius:16px !important;
                }

                .modern-header .header-content{
                    flex-direction:column !important;
                    text-align:center;
                    align-items:center !important;
                }

                .modern-header .icon-wrapper{
                    width:58px !important;
                    height:58px !important;
                    font-size:1.55rem !important;
                }

                .modern-header .header-title{
                    font-size:1.65rem !important;
                    line-height:1.15 !important;
                }

                .panel,
                .add-card,
                .availability-section,
                .detail-card-body{
                    padding:20px !important;
                }

                .bookings-table-wrap,
                .table-wrap{
                    overflow-x:auto !important;
                    -webkit-overflow-scrolling:touch;
                }

                .bookings-table-wrap table,
                .table-wrap table{
                    min-width:720px !important;
                }

                .dataTables_wrapper .dataTables_length,
                .dataTables_wrapper .dataTables_filter,
                .dataTables_wrapper .dataTables_info,
                .dataTables_wrapper .dataTables_paginate{
                    float:none !important;
                    width:100% !important;
                    text-align:left !important;
                    padding-left:0 !important;
                    padding-right:0 !important;
                }

                .dataTables_wrapper .dataTables_length label,
                .dataTables_wrapper .dataTables_filter label{
                    display:flex !important;
                    align-items:center !important;
                    gap:8px;
                    flex-wrap:wrap;
                    width:100%;
                }

                .dataTables_wrapper .dataTables_length select{
                    width:auto !important;
                    min-width:70px;
                }

                .dataTables_wrapper .dataTables_filter input{
                    width:100% !important;
                    max-width:none !important;
                    margin-left:0 !important;
                    margin-top:8px;
                }

                .detail-card-header,
                .booking-top,
                .availability-item,
                .card-header,
                .card-actions,
                .modal-buttons,
                .section-header{
                    flex-direction:column !important;
                    align-items:stretch !important;
                }

                .booking-info p{
                    flex-direction:column !important;
                    gap:2px !important;
                }

                .booking-info p strong{
                    width:auto !important;
                }

                .btn,
                .btn-view-detail,
                .btn-job-submit,
                .btn-primary,
                .edit-btn,
                .delete-btn,
                .btn-save,
                .btn-secondary,
                .back-btn{
                    width:100% !important;
                    justify-content:center !important;
                    white-space:normal !important;
                    text-align:center !important;
                }

                .modal{
                    width:100% !important;
                    max-width:100% !important;
                    max-height:calc(100vh - 24px) !important;
                    overflow:auto !important;
                    padding:22px !important;
                }
            }
        </style>

    </main>

</div>

<script>
    function setPanelNav(wrapperClass, shouldOpen){
        const wrapper = document.querySelector('.' + wrapperClass);
        if(!wrapper) return;

        wrapper.classList.toggle('nav-open', shouldOpen);
        document.body.classList.toggle('nav-lock', shouldOpen);

        document.querySelectorAll('[data-panel-toggle="' + wrapperClass + '"]').forEach(function(button){
            button.setAttribute('aria-expanded', shouldOpen ? 'true' : 'false');
        });
    }

    document.querySelectorAll('[data-panel-toggle]').forEach(function(button){
        button.addEventListener('click', function(){
            const wrapperClass = this.getAttribute('data-panel-toggle');
            const wrapper = document.querySelector('.' + wrapperClass);
            setPanelNav(wrapperClass, !wrapper.classList.contains('nav-open'));
        });
    });

    document.querySelectorAll('[data-panel-close]').forEach(function(button){
        button.addEventListener('click', function(){
            setPanelNav(this.getAttribute('data-panel-close'), false);
        });
    });

    document.querySelectorAll('.tech-wrapper .sidebar a').forEach(function(link){
        link.addEventListener('click', function(){
            if(window.innerWidth <= 900){
                setPanelNav('tech-wrapper', false);
            }
        });
    });

    document.addEventListener('keydown', function(event){
        if(event.key === 'Escape'){
            setPanelNav('tech-wrapper', false);
        }
    });

    setTimeout(function () {
        document.querySelectorAll('.success, .delete').forEach(function (alert) {
            alert.style.opacity = '0';
            alert.style.transform = 'translateY(-10px)';

            setTimeout(function () {
                alert.style.display = 'none';
            }, 400);
        });
    }, 2500);
</script>
@include('components.toast')
</body>
</html>
