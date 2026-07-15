<!DOCTYPE html>
<html>
<head>
    <title>@yield('title', 'Customer Panel')</title>
    <meta name="viewport" content="width=device-width, initial-scale=1.0">

    <link href="https://fonts.googleapis.com/css2?family=Playfair+Display:wght@500;700&family=Mukta+Mahee:wght@300;400;600;700&display=swap" rel="stylesheet">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.11.3/font/bootstrap-icons.min.css">

    <style>
        body{
            margin:0;
            font-family:'Mukta Mahee', system-ui, -apple-system, BlinkMacSystemFont, "Segoe UI", sans-serif;
            background:#f5f7fb;
            color:#111827;
        }

        .customer-wrapper{
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
            border-bottom:1px solid #e5e7eb;
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
            margin-bottom:0;
            color:#000;
        }

        .brand-box p{
            font-family:'Mukta Mahee', sans-serif;
            font-size:13px;
            color:#6b7280;
            margin:0;
        }

        .menu-section{
            margin:12px 0;
        }

        .menu-link,
        .dropdown-btn{
            width:100%;
            display:flex;
            align-items:center;
            justify-content:space-between;
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
            text-decoration:none;
        }

        .menu-link:hover,
        .dropdown-btn:hover,
        .menu-link.active,
        .dropdown-btn.active{
            background:#f3f4f6;
            color:#000;
        }

        .menu-left{
            display:flex;
            align-items:center;
            gap:12px;
        }

        .icon{
            width:22px;
            text-align:center;
        }

        .submenu{
            display:none;
            margin-left:25px;
            padding-left:14px;
            border-left:1px solid #e5e7eb;
            margin-top:5px;
        }

        .submenu a{
            display:block;
            padding:9px 12px;
            border-radius:7px;
            font-family:'Mukta Mahee', sans-serif;
            font-size:14px;
            font-weight:400;
            color:#4b5563;
            text-decoration:none;
        }

        .submenu a:hover,
        .submenu a.active{
            background:#f3f4f6;
            color:#000;
            font-weight:600;
        }

        .submenu.show{
            display:block;
        }

        .badge-notify{
            min-width:16px;
            height:16px;
            padding:2px 6px;
            border-radius:999px;
            background:#ef4444;
            color:#fff;
            display:inline-flex;
            align-items:center;
            justify-content:center;
            font-size:10px;
            font-weight:700;
            line-height:1;
            box-shadow:0 2px 4px rgba(239,68,68,.2);
            animation:badgePulse 2s infinite;
        }

        @keyframes badgePulse{
            0%,100%{box-shadow:0 0 0 0 rgba(239,68,68,.35)}
            50%{box-shadow:0 0 0 4px rgba(239,68,68,0)}
        }

        .logout-box{
            margin-top:auto;
            padding-top:20px;
            border-top:1px solid #eee;
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
            color:#6b7280;
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
            display:flex;
            align-items:center;
        }

        .logout-icon:hover{
            color:#991b1b;
            transform:scale(1.15);
        }

        .customer-main{
            margin-left:270px;
            width:calc(100% - 270px);
            padding:35px;
        }

        .sidebar,.customer-main{transition:width .25s ease,margin-left .25s ease,padding .25s ease}
        .sidebar-minimize-toggle{position:absolute;top:8px;right:8px;width:30px;height:30px;padding:0;border:1px solid #e2e8f0;border-radius:50%;background:#fff;color:#334155;display:grid;place-items:center;cursor:pointer;box-shadow:0 4px 12px rgba(15,23,42,.12);z-index:3}
        .customer-wrapper.sidebar-minimized .sidebar{width:84px;padding-left:14px;padding-right:14px}
        .customer-wrapper.sidebar-minimized .customer-main{margin-left:84px;width:calc(100% - 84px)}
        .customer-wrapper.sidebar-minimized .brand-box{justify-content:center;margin-top:20px}
        .customer-wrapper.sidebar-minimized .brand-box>div:last-child,.customer-wrapper.sidebar-minimized .dropdown-btn>span:last-child,.customer-wrapper.sidebar-minimized .submenu,.customer-wrapper.sidebar-minimized .user-text,.customer-wrapper.sidebar-minimized .logout-icon,.customer-wrapper.sidebar-minimized .badge-notify{display:none!important}
        .customer-wrapper.sidebar-minimized .menu-link,.customer-wrapper.sidebar-minimized .dropdown-btn{justify-content:center!important;padding-left:8px;padding-right:8px;font-size:0}
        .customer-wrapper.sidebar-minimized .menu-left{width:100%;justify-content:center;gap:0}
        .customer-wrapper.sidebar-minimized .menu-left .icon{font-size:18px;display:grid;place-items:center;margin:0 auto}
        .customer-wrapper.sidebar-minimized .user-row{justify-content:center}
        .customer-wrapper.sidebar-minimized .avatar{width:42px;height:42px}

        .hero-card{
            background:linear-gradient(135deg,#7c3aed,#2563eb,#06b6d4);
            color:white;
            padding:35px;
            border-radius:28px;
            margin-bottom:30px;
        }

        .hero-card h1{
            font-size:38px;
            margin-bottom:8px;
        }

        .stats-grid{
            display:grid;
            grid-template-columns:repeat(4,1fr);
            gap:20px;
            margin-bottom:30px;
        }

        .stat-card{
            background:white;
            padding:24px;
            border-radius:20px;
            display:flex;
            justify-content:space-between;
            align-items:center;
            box-shadow:0 10px 25px rgba(0,0,0,.06);
            border:1px solid #e5e7eb;
        }

        .stat-card p{
            color:#6b7280;
            margin-bottom:8px;
        }

        .stat-card h2{
            font-size:32px;
            margin:0;
        }

        .stat-icon{
            width:58px;
            height:58px;
            border-radius:16px;
            display:grid;
            place-items:center;
            color:white;
            font-size:25px;
        }

        .blue{background:#2563eb;}
        .green{background:#16a34a;}
        .orange{background:#f97316;}
        .purple{background:#7c3aed;}

        .panel{
            background:white;
            border-radius:22px;
            padding:28px;
            box-shadow:0 10px 25px rgba(0,0,0,.06);
            border:1px solid #e5e7eb;
            margin-bottom:25px;
        }

        .booking-row{
            display:flex;
            justify-content:space-between;
            gap:15px;
            padding:16px 0;
            border-bottom:1px solid #e5e7eb;
        }

        .badge{
            padding:7px 13px;
            border-radius:999px;
            background:#e0f2fe;
            color:#0369a1;
            font-weight:700;
            font-size:13px;
        }

        @media(max-width:900px){
            .sidebar-minimize-toggle{display:none}
            .sidebar{
                position:relative;
                width:100%;
                height:auto;
            }

            .customer-wrapper{
                flex-direction:column;
            }

            .customer-main{
                margin-left:0;
                width:100%;
                box-sizing:border-box;
                padding:20px;
            }

            .stats-grid{
                grid-template-columns:1fr;
            }

            .booking-row{
                flex-direction:column;
            }
        }

        /* Auto-capitalize first letter of all free-text inputs */
        input[type="text"]::first-letter,
        textarea::first-letter {
            text-transform: uppercase;
        }

        html{
            overflow-x:hidden;
        }

        *,
        *::before,
        *::after{
            box-sizing:border-box;
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

        .customer-main{
            min-width:0;
        }

        .sidebar{
            overflow-y:auto;
        }

        .container{
            width:min(100%, 1180px);
            margin:0 auto;
        }

        .center{
            text-align:center;
        }

        .section{
            padding:60px 0;
        }

        .section.light{
            background:#eef2f7;
            margin-left:-35px;
            margin-right:-35px;
            padding-left:35px;
            padding-right:35px;
        }

        .title{
            font-size:clamp(2rem, 5vw, 4.2rem);
            line-height:1.05;
            margin:16px 0;
        }

        .lead{
            max-width:780px;
            margin:0 auto;
            color:#667085;
            font-size:1.05rem;
            line-height:1.75;
        }

        .hero{
            min-height:360px;
            display:flex;
            align-items:center;
            background:
                linear-gradient(135deg, rgba(15,23,42,.86), rgba(37,99,235,.72)),
                url('https://images.unsplash.com/photo-1581092921461-eab62e97a780?auto=format&fit=crop&w=1400&q=80')
                center/cover;
            color:white;
            border-radius:28px;
            padding:48px;
            margin-bottom:30px;
            overflow:hidden;
        }

        .hero.small{
            min-height:250px;
        }

        .hero h1{
            color:white;
            font-size:clamp(2.2rem, 6vw, 5rem);
            line-height:1.02;
            margin:0 0 16px;
        }

        .hero em{
            color:#93c5fd;
            font-style:normal;
        }

        .hero p{
            max-width:720px;
            color:#e5e7eb;
            font-size:1.08rem;
            line-height:1.7;
            margin:0;
        }

        .grid{
            display:grid;
            gap:24px;
        }

        .grid-4{
            grid-template-columns:repeat(4, minmax(0, 1fr));
        }

        .grid-3{
            grid-template-columns:repeat(3, minmax(0, 1fr));
        }

        .room-card,
        .blog-card,
        .model-card{
            background:white;
            border:1px solid #e5e7eb;
            border-radius:22px;
            overflow:hidden;
            box-shadow:0 10px 25px rgba(0,0,0,.06);
        }

        .room-card .body,
        .blog-card .body{
            padding:28px;
        }

        .room-img,
        .blog-img{
            width:100%;
            height:240px;
            object-fit:cover;
            display:block;
        }

        .blog-card{
            display:grid;
            grid-template-columns:minmax(260px, 420px) minmax(0, 1fr);
            align-items:stretch;
            margin-bottom:30px;
        }

        .blog-card .blog-img{
            height:100%;
            min-height:280px;
        }

        .model-box{
            display:none;
            margin-top:24px;
        }

        .model-box.active{
            display:block;
        }

        .model-list{
            display:grid;
            grid-template-columns:repeat(auto-fit, minmax(210px, 1fr));
            gap:16px;
        }

        .model-card{
            padding:18px;
            box-shadow:none;
            border-radius:14px;
        }

        .model-card h4{
            margin:0 0 8px;
        }

        .price{
            color:#16a34a;
            font-size:1.45rem;
            font-weight:800;
            margin:18px 0 10px;
        }

        .btn{
            border:none;
            border-radius:10px;
            color:white;
            cursor:pointer;
            display:inline-flex;
            align-items:center;
            justify-content:center;
            gap:8px;
            padding:12px 20px;
            font-weight:800;
            font-size:13px;
            letter-spacing:.04em;
            text-decoration:none;
            text-transform:uppercase;
            transition:background .2s ease, transform .2s ease;
        }

        .btn:hover{
            transform:translateY(-1px);
        }

        .btn.small{
            padding:9px 14px;
            font-size:12px;
        }

        .btn.blue,
        .blue.btn{
            background:#2563eb;
        }

        .btn.blue:hover,
        .blue.btn:hover{
            background:#1d4ed8;
        }

        @media(max-width:1200px){
            .grid-4{
                grid-template-columns:repeat(2, minmax(0, 1fr));
            }
        }

        @media(max-width:900px){
            .sidebar{
                height:auto;
                max-height:none;
                border-right:none;
                border-bottom:1px solid #e5e7eb;
            }

            .logout-box{
                margin-top:20px;
            }

            .section.light{
                margin-left:-20px;
                margin-right:-20px;
                padding-left:20px;
                padding-right:20px;
            }

            .grid-3,
            .blog-card{
                grid-template-columns:1fr;
            }

            .blog-card .blog-img{
                min-height:220px;
                height:220px;
            }

            .modern-header .header-content{
                flex-wrap:wrap;
            }
        }

        @media(max-width:640px){
            body{
                overflow-x:hidden;
            }

            .customer-main{
                padding:16px;
            }

            .sidebar{
                padding:18px 16px;
            }

            .brand-box{
                padding-bottom:16px;
                margin-bottom:12px;
            }

            .menu-section{
                margin:6px 0;
            }

            .menu-link,
            .dropdown-btn{
                padding:10px 12px;
            }

            .user-row{
                align-items:flex-start;
            }

            .section{
                padding:42px 0;
            }

            .section.light{
                margin-left:-16px;
                margin-right:-16px;
                padding-left:16px;
                padding-right:16px;
            }

            .hero,
            .hero.small{
                min-height:auto;
                border-radius:18px;
                padding:30px 20px;
            }

            .hero p{
                font-size:1rem;
            }

            .grid-4,
            .grid-3,
            .dashboard-stats,
            .stats-grid{
                grid-template-columns:1fr !important;
            }

            .panel,
            .modern-panel,
            .device-section-card,
            .service-group{
                border-radius:16px;
                padding:20px !important;
            }

            .room-card .body,
            .blog-card .body{
                padding:20px;
            }

            .room-img,
            .blog-img{
                height:200px;
            }

            .booking-list-item,
            .booking-row,
            .summary-row,
            .detail-card-header,
            .device-header,
            .controls-bar,
            .tabs-container,
            .action-buttons,
            .form-actions{
                flex-direction:column;
                align-items:stretch !important;
            }

            .modern-header,
            .hist-header{
                border-radius:18px;
                padding:24px 20px !important;
            }

            .modern-header .header-content,
            .hist-hdr-inner{
                flex-direction:column;
                text-align:center;
                align-items:center;
            }

            .modern-header .icon-wrapper,
            .hist-hdr-icon{
                width:58px;
                height:58px;
                font-size:1.55rem;
            }

            .modern-header .header-title,
            .hist-hdr-title{
                font-size:1.65rem !important;
            }

            .table-wrap,
            .bookings-table-wrap,
            .hist-table-wrap,
            .repairs-table-container{
                overflow-x:auto;
                -webkit-overflow-scrolling:touch;
            }

            .bookings-table,
            .repairs-table{
                min-width:720px;
            }

            .hist-table{
                min-width:980px;
            }

            .btn,
            .new-booking-btn,
            .btn-view-detail,
            .btn-pay-now,
            .btn-book,
            .hist-detail-btn,
            .action-btn,
            .submit-btn,
            .btn-submit{
                width:100%;
                white-space:normal;
                text-align:center;
            }

            .modal-box{
                width:calc(100vw - 24px);
                max-width:calc(100vw - 24px);
                max-height:calc(100vh - 24px);
                padding:22px !important;
                overflow:auto;
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
                border-bottom:1px solid #e5e7eb;
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

            .customer-wrapper .sidebar{
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

            .customer-wrapper.nav-open .sidebar{
                transform:translateX(0);
            }

            .customer-wrapper.nav-open .mobile-nav-backdrop{
                display:block;
            }

            .customer-wrapper .customer-main{
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
            <span>Customer Panel</span>
        </div>
    </div>
    <button type="button" class="mobile-nav-toggle" data-panel-toggle="customer-wrapper" aria-label="Open customer navigation" aria-expanded="false">
        <i class="bi bi-list"></i>
    </button>
</div>

<div class="customer-wrapper">
    <button type="button" class="mobile-nav-backdrop" data-panel-close="customer-wrapper" aria-label="Close customer navigation"></button>

    <aside class="sidebar">
        <button type="button" class="sidebar-minimize-toggle" id="customerSidebarMinimizeToggle" aria-label="Minimize sidebar" aria-expanded="true" title="Minimize sidebar"><i class="bi bi-list"></i></button>
        <button type="button" class="mobile-nav-close" data-panel-close="customer-wrapper" aria-label="Close customer navigation">
            <i class="bi bi-x-lg"></i>
        </button>

        <div>
            <div class="brand-box">
                <div class="brand-icon">AR</div>
                <div>
                    <h3>AkieRepair</h3>
                    <p>Customer Panel</p>
                </div>
            </div>

            <div class="menu-section">
                <a href="{{ route('customer.dashboard') }}" class="menu-link {{ request()->routeIs('customer.dashboard') ? 'active' : '' }}">
                    <span class="menu-left">
                        <span class="icon"><i class="bi bi-grid"></i></span>
                        Dashboard
                    </span>
                </a>
            </div>

            <div class="menu-section">
                <button class="dropdown-btn {{ request()->routeIs('customer.booking.*', 'customer.payment.*', 'customer.review.*') ? 'active' : '' }}" onclick="toggleMenu('bookingMenu')" style="display: flex; justify-content: space-between; align-items: center; width: 100%;">
                    <span class="menu-left">
                        <span class="icon"><i class="bi bi-calendar-check"></i></span>
                        Appointments
                    </span>
                    <span style="display:flex;align-items:center;gap:8px;">
                        @if(isset($actionNeededCount) && $actionNeededCount > 0)
                            <span class="badge-notify" title="{{ $actionNeededCount }} action needed">{{ $actionNeededCount }}</span>
                        @endif
                        <i class="bi bi-chevron-down" style="font-size:11px;"></i>
                    </span>
                </button>

                <div id="bookingMenu" class="submenu {{ request()->routeIs('customer.booking.*', 'customer.payment.*', 'customer.review.*') ? 'show' : '' }}">
                    <a href="{{ route('customer.booking.create') }}" class="{{ request()->routeIs('customer.booking.create') ? 'active' : '' }}">
                        Book Appointment
                    </a>
                    <a href="{{ route('customer.booking.status') }}" class="{{ request()->routeIs('customer.booking.status', 'customer.booking.show', 'customer.payment.*') ? 'active' : '' }}" style="display:flex;justify-content:space-between;align-items:center;gap:8px;">
                        <span>Booking Status</span>
                        @if(isset($actionNeededCount) && $actionNeededCount > 0)
                            <span class="badge-notify" aria-label="{{ $actionNeededCount }} action needed">{{ $actionNeededCount }}</span>
                        @endif
                    </a>
                    <a href="{{ route('customer.booking.history') }}" class="{{ request()->routeIs('customer.booking.history', 'customer.review.*') ? 'active' : '' }}">
                        Booking History
                    </a>
                </div>
            </div>

            <div class="menu-section">
                <a href="{{ route('customer.repairs.all') }}" class="menu-link {{ request()->routeIs('customer.repairs.all') ? 'active' : '' }}">
                    <span class="menu-left">
                        <span class="icon"><i class="bi bi-tag"></i></span>
                        Repair Prices
                    </span>
                </a>
            </div>

            <div class="menu-section">
                <a href="{{ route('customer.account') }}" class="menu-link {{ request()->routeIs('customer.account') ? 'active' : '' }}">
                    <span class="menu-left">
                        <span class="icon"><i class="bi bi-person"></i></span>
                        My Account
                    </span>
                </a>
            </div>
        </div>

        <div class="logout-box">
            <div class="user-row">
                <div class="avatar">
                    {{ strtoupper(substr(Auth::user()->name ?? 'C', 0, 1)) }}
                </div>

                <div class="user-text">
                    <strong>{{ Auth::user()->name ?? 'Customer' }}</strong>
                    <span>Customer</span>
                </div>

                <form action="{{ route('logout') }}" method="POST">
                    @csrf
                    <button type="submit" class="logout-icon" title="Logout">
                        <i class="bi bi-box-arrow-right"></i>
                    </button>
                </form>
            </div>
        </div>

    </aside>

    <main class="customer-main">
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

            .customer-main{
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

            .menu-link,
            .dropdown-btn,
            .submenu a{
                letter-spacing:0;
                transition:background-color .18s ease, color .18s ease, transform .18s ease;
            }

            .menu-link:hover,
            .dropdown-btn:hover,
            .submenu a:hover,
            .menu-link.active,
            .dropdown-btn.active,
            .submenu a.active{
                background:#eef6ff !important;
                color:#0f172a !important;
            }

            .mobile-shellbar{
                background:rgba(255, 255, 255, .94) !important;
                border-bottom:1px solid var(--ui-line) !important;
                box-shadow:0 10px 28px rgba(15, 23, 42, .07) !important;
                backdrop-filter:blur(14px);
            }

            :where(.hero h1, .modern-header .header-title, .hist-hdr-title, .section-title h2, .service-content h3, .page-title){
                color:var(--ui-text) !important;
                letter-spacing:0 !important;
                line-height:1.12 !important;
            }

            :where(.modern-header .header-title, .hist-hdr-title, .section-title h2, .page-title){
                font-size:clamp(1.8rem, 3.2vw, 2.7rem) !important;
            }

            :where(.hero p, .modern-header p, .hist-header p, .section-title p, .service-content p){
                color:var(--ui-muted) !important;
                font-size:clamp(.98rem, 1.3vw, 1.08rem) !important;
            }

            :where(.hero h1, .modern-header .header-title, .hist-hdr-title){
                color:#ffffff !important;
                text-shadow:0 2px 12px rgba(15, 23, 42, .18);
            }

            :where(.hero p, .modern-header .header-subtitle, .modern-header p, .hist-header p){
                color:#dbeafe !important;
            }

            :where(.hero, .hero.small, .modern-header, .hist-header){
                border:1px solid rgba(226, 232, 240, .78) !important;
                box-shadow:var(--ui-shadow) !important;
            }

            :where(.panel, .modern-panel, .device-section-card, .service-group, .blog-card, .model-card, .detail-card, .summary-card, .booking-list-item, .room-card, .service-card){
                border:1px solid var(--ui-line) !important;
                border-radius:14px !important;
                box-shadow:0 12px 32px rgba(15, 23, 42, .055) !important;
            }

            :where(.panel, .modern-panel, .device-section-card, .service-group, .detail-card, .summary-card){
                background:var(--ui-surface) !important;
            }

            :where(.btn, .new-booking-btn, .btn-view-detail, .btn-pay-now, .btn-book, .hist-detail-btn, .action-btn, .submit-btn, .btn-submit, .search-trigger-btn, .close-search-btn):not(.mobile-nav-toggle):not(.mobile-nav-close):not(.logout-icon){
                border-radius:10px !important;
                font-family:'Mukta Mahee', system-ui, sans-serif !important;
                font-weight:700 !important;
                min-height:42px;
                transition:transform .16s ease, box-shadow .16s ease, background-color .16s ease, border-color .16s ease;
            }

            :where(.btn, .new-booking-btn, .btn-view-detail, .btn-pay-now, .btn-book, .hist-detail-btn, .action-btn, .submit-btn, .btn-submit, .search-trigger-btn, .close-search-btn):not(.mobile-nav-toggle):not(.mobile-nav-close):not(.logout-icon):hover{
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

            :where(.table-wrap, .bookings-table-wrap, .hist-table-wrap, .repairs-table-container){
                border-radius:14px;
            }

            :where(.bookings-table, .repairs-table, .hist-table, table.dataTable){
                border-collapse:separate !important;
                border-spacing:0 !important;
                color:#334155;
            }

            :where(.bookings-table thead th, .repairs-table thead th, .hist-table thead th, table.dataTable thead th){
                background:var(--ui-soft) !important;
                color:#334155 !important;
                font-size:.78rem !important;
                font-weight:800 !important;
                letter-spacing:.04em;
                padding:14px 16px !important;
                text-transform:uppercase;
                border-bottom:1px solid var(--ui-line) !important;
            }

            :where(.bookings-table tbody td, .repairs-table tbody td, .hist-table tbody td, table.dataTable tbody td){
                color:#334155 !important;
                font-size:.95rem !important;
                padding:14px 16px !important;
                border-bottom:1px solid #edf2f7 !important;
                vertical-align:middle;
            }

            :where(.bookings-table tbody tr, .repairs-table tbody tr, .hist-table tbody tr, table.dataTable tbody tr){
                transition:background-color .16s ease;
            }

            :where(.bookings-table tbody tr:hover, .repairs-table tbody tr:hover, .hist-table tbody tr:hover, table.dataTable tbody tr:hover){
                background:#f8fafc !important;
            }

            @media(max-width:900px){
                .blog-card,
                .dashboard-layout,
                .account-layout{
                    grid-template-columns:1fr !important;
                }

                .blog-card .blog-img{
                    min-height:220px !important;
                    height:220px !important;
                }

                .section.light{
                    margin-left:-20px !important;
                    margin-right:-20px !important;
                    padding-left:20px !important;
                    padding-right:20px !important;
                }

                .table-wrap,
                .bookings-table-wrap,
                .hist-table-wrap,
                .repairs-table-container{
                    overflow-x:auto !important;
                    -webkit-overflow-scrolling:touch;
                }

                .bookings-table,
                .repairs-table{
                    min-width:760px !important;
                }

                .hist-table{
                    min-width:980px !important;
                }
            }

            @media(max-width:640px){
                .customer-main{
                    padding:16px !important;
                }

                .hero,
                .hero.small,
                .modern-header,
                .hist-header{
                    border-radius:18px !important;
                    padding:24px 20px !important;
                }

                .hero{
                    min-height:auto !important;
                }

                .hero h1,
                .modern-header .header-title,
                .hist-hdr-title{
                    font-size:clamp(1.65rem, 9vw, 2.35rem) !important;
                    line-height:1.12 !important;
                }

                .grid,
                .grid-3,
                .grid-4,
                .service-grid,
                .model-list,
                .dashboard-stats,
                .stats-grid,
                .account-layout,
                .dashboard-layout{
                    grid-template-columns:1fr !important;
                }

                .service-content h3{
                    font-size:clamp(1.75rem, 10vw, 2.5rem) !important;
                }

                .panel,
                .modern-panel,
                .device-section-card,
                .service-group{
                    padding:20px !important;
                    border-radius:16px !important;
                }

                .controls-bar{
                    height:auto !important;
                    min-height:68px;
                    overflow:visible !important;
                }

                .tabs-container,
                .filter-tabs,
                .booking-list-item,
                .booking-row,
                .summary-row,
                .detail-card-header,
                .device-header,
                .action-buttons,
                .form-actions{
                    flex-direction:column !important;
                    align-items:stretch !important;
                }

                .filter-tabs{
                    width:100%;
                    flex-wrap:wrap;
                }

                .filter-tab{
                    width:100%;
                }

                .search-trigger-btn,
                .close-search-btn{
                    width:100% !important;
                }

                .search-bar-container{
                    position:static !important;
                    width:100% !important;
                    transform:none !important;
                    display:none;
                    margin-top:12px;
                }

                .controls-bar.search-active .search-bar-container{
                    display:flex;
                    opacity:1 !important;
                    visibility:visible !important;
                    pointer-events:auto !important;
                    transform:none !important;
                }

                .controls-bar.search-active .tabs-container{
                    display:none;
                }

                .table-wrap,
                .bookings-table-wrap,
                .hist-table-wrap,
                .repairs-table-container{
                    overflow-x:auto !important;
                    -webkit-overflow-scrolling:touch;
                }

                .bookings-table,
                .repairs-table{
                    min-width:720px !important;
                }

                .hist-table{
                    min-width:980px !important;
                }

                .btn,
                .new-booking-btn,
                .btn-view-detail,
                .btn-pay-now,
                .btn-book,
                .hist-detail-btn,
                .action-btn,
                .submit-btn,
                .btn-submit{
                    width:100% !important;
                    justify-content:center !important;
                    white-space:normal !important;
                    text-align:center !important;
                }
            }
        </style>
    </main>

</div>

<script>
    (function(){
        const wrapper=document.querySelector('.customer-wrapper');
        const toggle=document.getElementById('customerSidebarMinimizeToggle');
        if(!wrapper||!toggle)return;
        function applyState(minimized){wrapper.classList.toggle('sidebar-minimized',minimized);toggle.setAttribute('aria-expanded',minimized?'false':'true');toggle.setAttribute('aria-label',minimized?'Expand sidebar':'Minimize sidebar');toggle.title=minimized?'Expand sidebar':'Minimize sidebar'}
        applyState(localStorage.getItem('customerSidebarMinimized')==='true');
        toggle.addEventListener('click',function(){const minimized=!wrapper.classList.contains('sidebar-minimized');applyState(minimized);localStorage.setItem('customerSidebarMinimized',minimized?'true':'false')});
        wrapper.querySelectorAll('.dropdown-btn').forEach(function(button){
            button.addEventListener('click',function(){
                if(wrapper.classList.contains('sidebar-minimized')){
                    applyState(false);
                    localStorage.setItem('customerSidebarMinimized','false');
                }
            });
        });
    })();

    function toggleMenu(id){
        document.getElementById(id).classList.toggle('show');
    }

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

    document.querySelectorAll('.customer-wrapper .sidebar a').forEach(function(link){
        link.addEventListener('click', function(){
            if(window.innerWidth <= 900){
                setPanelNav('customer-wrapper', false);
            }
        });
    });

    document.addEventListener('keydown', function(event){
        if(event.key === 'Escape'){
            setPanelNav('customer-wrapper', false);
        }
    });

    // Auto-capitalize first letter of all free-text inputs and textareas
    document.addEventListener('DOMContentLoaded', function () {
        const selectors = 'input[type="text"], input[type="email"], input[type="tel"], textarea';
        document.querySelectorAll(selectors).forEach(function (el) {
            el.addEventListener('input', function () {
                const val = this.value;
                if (val.length > 0 && val[0] !== val[0].toUpperCase()) {
                    const pos = this.selectionStart;
                    this.value = val.charAt(0).toUpperCase() + val.slice(1);
                    this.setSelectionRange(pos, pos);
                }
            });
        });
    });
</script>

@include('components.toast')
</body>
</html>
