<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>@yield('title', 'AkieRepair Admin')</title>
    <meta name="viewport" content="width=device-width, initial-scale=1.0">

    <link href="https://fonts.googleapis.com/css2?family=Playfair+Display:wght@500;700&family=Mukta+Mahee:wght@300;400;600;700&display=swap" rel="stylesheet">

    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.11.3/font/bootstrap-icons.min.css">

    <link rel="stylesheet" href="https://cdn.datatables.net/1.13.8/css/jquery.dataTables.min.css">

    <script src="https://code.jquery.com/jquery-3.7.1.min.js"></script>
    <script src="https://cdn.datatables.net/1.13.8/js/jquery.dataTables.min.js"></script>

    <style>
        .dashboard-header{
    margin-bottom:30px;
}

.dashboard-header h1{
    font-size:38px;
    color:#111827;
}

.dashboard-header p{
    color:#6b7280;
    font-size:16px;
}

.dashboard-grid{
    display:grid;
    grid-template-columns:repeat(3,1fr);
    gap:22px;
}

.dash-card{
    min-height:150px;
    border-radius:10px;
    padding:25px;
    display:flex;
    align-items:center;
    gap:22px;
    border:1px solid #e5e7eb;
}

.dash-card p{
    color:#4b5563;
    font-size:17px;
}

.dash-card h2{
    font-family:Arial, sans-serif;
    font-size:34px;
    color:#111827;
    margin:6px 0;
}

.dash-card span{
    font-size:15px;
    font-weight:700;
}

.dash-icon{
    width:60px;
    height:60px;
    border-radius:10px;
    display:grid;
    place-items:center;
    color:white;
    font-size:26px;
}

.red-card{background:#fff1ed;border-color:#fecaca}
.green-card{background:#eafff3;border-color:#bbf7d0}
.blue-card{background:#e8f8ff;border-color:#bae6fd}
.yellow-card{background:#fff8e1;border-color:#fde68a}
.purple-card{background:#f4edff;border-color:#ddd6fe}
.cyan-card{background:#e6fffb;border-color:#99f6e4}

.red-icon{background:#ef4444}
.green-icon{background:#22c55e}
.blue-icon{background:#06b6d4}
.yellow-icon{background:#f5b400}
.purple-icon{background:#8b5cf6}
.cyan-icon{background:#14b8a6}

@media(max-width:1000px){
    .dashboard-grid{
        grid-template-columns:1fr;
    }
}
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

        .admin-wrapper{
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
        }

        .menu-link:hover,
        .dropdown-btn:hover{
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
            border-left:1px solid var(--line);
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
        }

        .submenu a:hover{
            background:var(--yellow);
            color:#000;
        }

        .submenu.show{
            display:block;
        }

        .user-box{
            margin-top:35px;
            padding-top:20px;
            border-top:1px solid var(--line);
        }

        .user-info{
            display:flex;
            align-items:center;
            gap:12px;
        }

        .user-info h4{
            font-family:'Mukta Mahee',sans-serif;
            font-size:15px;
            margin:0;
        }

        .user-info p{
            font-family:'Mukta Mahee',sans-serif;
            font-size:13px;
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


        .main-content{
            margin-left:285px;
            width:calc(100% - 285px);
        }

        .page-content{
            padding:40px;
        }

        .hero{
            background:
                linear-gradient(rgba(0,0,0,.45),rgba(0,0,0,.45)),
                url('https://images.unsplash.com/photo-1581092160607-ee22621dd758?auto=format&fit=crop&w=1600&q=80')
                center/cover;
            height:330px;
            display:flex;
            justify-content:center;
            align-items:center;
            text-align:center;
            color:white;
        }

        .hero h1{
            color:white;
            font-size:64px;
        }

        .hero p{
            color:white;
            font-size:19px;
        }

        .section{
            padding:70px 0;
        }

        .container{
            max-width:1350px;
            margin:auto;
        }

        .panel{
            background:white;
            padding:35px;
            box-shadow:var(--shadow);
        }

        .page-title{
            font-size:42px;
            margin-bottom:25px;
        }

        .table-wrap{
            width:100%;
            overflow:auto;
        }

        table{
            width:100%;
            border-collapse:collapse;
        }

        th,td{
            padding:14px;
            border-bottom:1px solid var(--line);
            text-align:left;
            white-space:nowrap;
        }

        th{
            color:#000;
            font-size:12px;
            text-transform:uppercase;
            letter-spacing:.12em;
        }

        .btn{
            border:none;
            padding:12px 24px;
            border-radius:50px;
            color:white;
            cursor:pointer;
            font-weight:700;
            letter-spacing:.1em;
            text-transform:uppercase;
            font-size:12px;
            display:inline-block;
        }

        .blue{background:var(--blue)}
        .green{background:var(--green)}
        .red{background:var(--red)}
        .gray{background:#6b7280}

        .badge{
            display:inline-block;
            padding:5px 12px;
            border-radius:50px;
            background:#fde8f0;
            color:var(--pink);
            font-size:12px;
            font-weight:700;
            text-transform:uppercase;
            letter-spacing:.1em;
        }

        .hide{display:none!important}

        input,select,textarea{
            width:100%;
            padding:13px 14px;
            border:2px solid var(--line);
            font-size:15px;
            margin-bottom:12px;
        }

        label{
            display:block;
            color:#000;
            font-weight:700;
            margin-bottom:6px;
        }

        .modal-overlay{
            position:fixed;
            inset:0;
            background:rgba(0,0,0,.55);
            display:flex;
            justify-content:center;
            align-items:center;
            z-index:9998;
        }

        .modal-box{
            width:520px;
            max-width:92%;
            max-height:90vh;
            overflow:auto;
            background:white;
            padding:35px;
            box-shadow:0 20px 60px rgba(0,0,0,.25);
        }

        .modal-close{
            border:none;
            background:#dc2626;
            color:white;
            width:38px;
            height:38px;
            border-radius:50%;
            font-size:24px;
            cursor:pointer;
        }

        .popup-message{
            position:fixed;
            top:100px;
            right:30px;
            color:white;
            padding:16px 24px;
            border-radius:12px;
            font-weight:700;
            box-shadow:0 12px 30px rgba(0,0,0,.2);
            z-index:9999;
        }

        .success-popup{background:#16a34a}
        .delete-popup{background:#dc2626}

        @media(max-width:900px){
            .sidebar{
                position:relative;
                width:100%;
                min-height:auto;
            }

            .admin-wrapper{
                display:block;
            }

            .main-content{
                margin-left:0;
                width:100%;
            }

            .topbar{
                padding:0 20px;
            }

            .page-content{
                padding:20px;
            }
        }
        .dataTables_wrapper{
    margin-top:20px;
}

.dataTables_filter input,
.dataTables_length select{
    border:1px solid #ddd;
    border-radius:8px;
    padding:8px 12px;
}

.dataTables_wrapper .dataTables_paginate .paginate_button.current{
    background:#111827 !important;
    color:white !important;
    border:none !important;
    border-radius:8px;
}

.device-summary{
    display:grid;
    grid-template-columns:repeat(4,1fr);
    gap:20px;
    margin-bottom:30px;
}

.summary-card{
    background:white;
    padding:24px;
    box-shadow:0 10px 30px rgba(0,0,0,.06);
    border-left:5px solid #e61c5d;
}
.dataTables_wrapper{
    width:100%;
    overflow-x:hidden;
}

.dataTables_filter input{
    width:180px !important;
    max-width:180px !important;
}

#deviceTable{
    width:100% !important;
    table-layout:auto;
}

#deviceTable th,
#deviceTable td{
    padding:12px 10px;
    font-size:14px;
}
.summary-card h3{
    font-size:28px;
    margin-bottom:5px;
}

.summary-card p{
    color:#6b7280;
}
.stats-grid{
    display:grid;
    grid-template-columns:repeat(4, 1fr);
    gap:24px;
    margin:30px 0;
}

.stat-card{
    background:#fff;
    border:1px solid #e5e7eb;
    border-radius:10px;
    padding:18px 22px;
    min-height:135px;
    display:flex;
    align-items:flex-start;
    justify-content:space-between;
    box-shadow:0 8px 18px rgba(0,0,0,.06);
}

.stat-card p{
    color:#6b7280;
    font-size:16px;
    margin:0 0 8px;
}

.stat-card h3{
    font-family:Arial, sans-serif;
    font-size:30px;
    color:#111827;
    margin:0 0 14px;
}

.green-text{
    color:#16a34a;
    font-weight:700;
    font-size:14px;
}

.stat-icon{
    width:60px;
    height:60px;
    background:#202126;
    color:white;
    border-radius:10px;
    display:flex;
    align-items:center;
    justify-content:center;
    font-size:25px;
    box-shadow:0 10px 18px rgba(0,0,0,.25);
    flex-shrink:0;
}

        /* Red Notification Badge for Sidebar Submenu Links */
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

        /* Small Notification Dot for Dropdown Headers */
        .badge-dot-header {
            width: 7px;
            height: 7px;
            background-color: #ef4444;
            border-radius: 50%;
            display: inline-block;
            margin-left: 6px;
            vertical-align: middle;
            box-shadow: 0 0 0 1.5px #ffffff, 0 2px 4px rgba(239, 68, 68, 0.3);
            animation: badgePulse 2s infinite;
        }

        html,
        body{
            max-width:100%;
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

        .main-content,
        .page-content{
            min-width:0;
        }

        .sidebar{
            overflow-y:auto;
        }

        .table-wrap{
            width:100%;
            overflow-x:auto;
            -webkit-overflow-scrolling:touch;
        }

        .table-wrap table{
            width:100% !important;
            min-width:0;
        }

        .table-wrap .dataTables_wrapper{
            width:100% !important;
            min-width:0;
            overflow-x:visible !important;
            max-width:100%;
        }

        .dataTables_wrapper{
            width:100% !important;
            max-width:100%;
            overflow-x:visible !important;
        }

        .dataTables_wrapper .dataTables_length,
        .dataTables_wrapper .dataTables_filter{
            float:none !important;
            margin:0 0 18px !important;
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

        .dataTables_wrapper .dataTables_filter{
            text-align:right !important;
        }

        .dataTables_wrapper .dataTables_filter input{
            box-sizing:border-box;
            margin-left:0 !important;
        }

        .dataTables_wrapper .dataTables_info,
        .dataTables_wrapper .dataTables_paginate{
            float:none !important;
            margin-top:16px !important;
        }

        .dataTables_wrapper .dataTables_paginate{
            text-align:right !important;
        }

        .dataTables_wrapper::after{
            content:"";
            display:block;
            clear:both;
        }

        .modal-overlay{
            padding:20px;
        }

        .modal-box{
            max-height:calc(100vh - 40px);
            overflow:auto;
        }

        .action-row,
        .form-actions{
            flex-wrap:wrap;
        }

        @media(max-width:1200px){
            .dashboard-grid,
            .stats-grid,
            .device-summary,
            .dev-metrics-grid,
            .cust-metrics-grid,
            .rep-metrics-strip{
                grid-template-columns:repeat(2, minmax(0, 1fr)) !important;
            }

            .pro-analytics-grid{
                grid-template-columns:1fr !important;
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

            .admin-wrapper{
                display:block;
            }

            .main-content{
                margin-left:0;
                width:100%;
            }

            .page-content{
                padding:20px;
            }

            .logout-box{
                margin-top:20px;
            }

            .brand-box{
                padding-bottom:16px;
                margin-bottom:12px;
            }

            .dev-header,
            .cust-header,
            .rep-header,
            .pending-cust-header,
            .pending-header-panel,
            .quote-header-panel,
            .history-header-panel,
            .pro-card-header,
            .column-header{
                flex-direction:column;
                align-items:flex-start !important;
                gap:16px;
            }

            .quote-tabs{
                width:100%;
                overflow-x:auto;
                justify-content:flex-start;
            }

            .quote-tab-btn{
                flex:0 0 auto;
            }

            .pending-grid{
                grid-template-columns:repeat(auto-fill, minmax(min(100%, 320px), 1fr)) !important;
            }

            .service-card-list{
                grid-template-columns:repeat(auto-fill, minmax(min(100%, 240px), 1fr));
            }

            .hero{
                height:auto;
                min-height:220px;
                padding:50px 20px;
            }

            .hero h1{
                font-size:clamp(2.2rem, 10vw, 4rem);
            }
        }

        @media(max-width:640px){
            .page-content{
                padding:16px;
            }

            .dashboard-grid,
            .stats-grid,
            .device-summary,
            .dev-metrics-grid,
            .cust-metrics-grid,
            .rep-metrics-strip{
                grid-template-columns:1fr !important;
            }

            .panel,
            .pro-card,
            .dev-table-panel,
            .cust-table-panel,
            .rep-table-panel,
            .pending-table-panel,
            .history-table-panel,
            .pending-card,
            .quote-card,
            .metric-card-premium,
            .dev-metric-card,
            .cust-metric-card,
            .summary-card,
            .stat-card,
            .dash-card{
                border-radius:14px !important;
                padding:20px !important;
            }

            .page-title,
            .dashboard-header h1,
            .dev-title h1,
            .cust-title h1,
            .rep-title h1,
            .pending-cust-title h1,
            .pending-title-area h1,
            .quote-title-area h1,
            .history-title-area h1{
                font-size:clamp(1.75rem, 8vw, 2.25rem) !important;
                line-height:1.15;
            }

            .btn,
            .btn-create-new,
            .btn-action,
            .btn-action-small,
            .btn-modal,
            .pending-assign-btn,
            .btn-pdf-link{
                width:100%;
                justify-content:center;
                white-space:normal;
                text-align:center;
            }

            .action-row,
            .form-actions,
            .quote-action-row,
            .quote-sent-banner,
            .pending-card-header,
            .card-header{
                flex-direction:column;
                align-items:stretch !important;
            }

            .customer-flex,
            .user-row{
                align-items:flex-start;
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
                align-items:flex-start;
                padding:12px;
            }

            .modal-box{
                width:100% !important;
                max-width:100% !important;
                max-height:calc(100vh - 24px);
                border-radius:16px !important;
                padding:22px !important;
            }

            .modal-box [style*="grid-template-columns"]{
                grid-template-columns:1fr !important;
            }

            .popup-message{
                left:16px;
                right:16px;
                top:16px;
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

            .admin-wrapper .sidebar{
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

            .admin-wrapper.nav-open .sidebar{
                transform:translateX(0);
            }

            .admin-wrapper.nav-open .mobile-nav-backdrop{
                display:block;
            }

            .admin-wrapper .main-content{
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
            <span>Admin Management</span>
        </div>
    </div>
    <button type="button" class="mobile-nav-toggle" data-panel-toggle="admin-wrapper" aria-label="Open admin navigation" aria-expanded="false">
        <i class="bi bi-list"></i>
    </button>
</div>

<div class="admin-wrapper">
    <button type="button" class="mobile-nav-backdrop" data-panel-close="admin-wrapper" aria-label="Close admin navigation"></button>

    <aside class="sidebar">
        <button type="button" class="mobile-nav-close" data-panel-close="admin-wrapper" aria-label="Close admin navigation">
            <i class="bi bi-x-lg"></i>
        </button>

        <div>
            <div class="brand-box">
                <div class="brand-icon">AR</div>
                <div>
                    <h3>AkieRepair</h3>
                    <p>Admin Management</p>
                </div>
            </div>

            <div class="menu-section">
                <a href="{{ route('admin.dashboard') }}" class="menu-link">
                    <span class="menu-left">
                        <span class="icon"><i class="bi bi-grid"></i></span>
                        Dashboard
                    </span>
                </a>
            </div>

            <div class="menu-section">
                <button class="dropdown-btn" onclick="toggleMenu('serviceMenu')">
                    <span class="menu-left">
                        <span class="icon">▣</span>
                        Service
                    </span>
                    <span>⌄</span>
                </button>

                <div id="serviceMenu" class="submenu">
                    <a href="{{ route('admin.repairs') }}">Repair Prices</a>
                    <a href="{{ route('admin.devices') }}">Devices</a>
                </div>
            </div>

            <div class="menu-section">
                <button class="dropdown-btn" onclick="toggleMenu('customerMenu')" style="display: flex; justify-content: space-between; align-items: center; width: 100%;">
                    <span class="menu-left">
                        <span class="icon">◎</span>
                        Customer
                        @if(isset($pendingCustomersCount) && $pendingCustomersCount > 0)
                            <span class="badge-dot-header"></span>
                        @endif
                    </span>
                    <span>⌄</span>
                </button>

                <div id="customerMenu" class="submenu">
                    <a href="{{ route('admin.customers.pending') }}" style="display: flex; justify-content: space-between; align-items: center;">
                        <span>Pending Customer</span>
                        @if(isset($pendingCustomersCount) && $pendingCustomersCount > 0)
                            <span class="badge-notify">{{ $pendingCustomersCount }}</span>
                        @endif
                    </a>
                    <a href="{{ route('admin.customers.index') }}">Total Customer</a>
                </div>
            </div>

            <div class="menu-section">
                <button class="dropdown-btn" onclick="toggleMenu('bookingMenu')" style="display: flex; justify-content: space-between; align-items: center; width: 100%;">
                    <span class="menu-left">
                        <span class="icon">▤</span>
                        Booking
                        @if((isset($pendingBookingsCount) && $pendingBookingsCount > 0) || (isset($pendingQuotationsCount) && $pendingQuotationsCount > 0))
                            <span class="badge-dot-header"></span>
                        @endif
                    </span>
                    <span>⌄</span>
                </button>

                <div id="bookingMenu" class="submenu">
                    <a href="{{ route('admin.bookings.pending') }}" style="display: flex; justify-content: space-between; align-items: center;">
                        <span>Pending Booking</span>
                        @if(isset($pendingBookingsCount) && $pendingBookingsCount > 0)
                            <span class="badge-notify">{{ $pendingBookingsCount }}</span>
                        @endif
                    </a>
                    <a href="{{ route('admin.bookings.quotation') }}" style="display: flex; justify-content: space-between; align-items: center;">
                        <span>Quotation</span>
                        @if(isset($pendingQuotationsCount) && $pendingQuotationsCount > 0)
                            <span class="badge-notify">{{ $pendingQuotationsCount }}</span>
                        @endif
                    </a>
                    <a href="{{ route('admin.bookings.history') }}">Booking History</a>
                </div>
            </div>

            <div class="menu-section">
                <a href="{{ route('admin.technicians') }}" class="menu-link">
                    <span class="menu-left">
                        <span class="icon">⚙</span>
                        Technician
                    </span>
                </a>
            </div>
        </div>

        <div class="logout-box">
            <div class="user-row">
                <div class="avatar">
                    {{ strtoupper(substr(Auth::user()->name ?? 'A', 0, 1)) }}
                </div>

                <div class="user-text">
                    <strong>{{ Auth::user()->name ?? 'Admin User' }}</strong>
                    <span>{{ Auth::user()->role ?? 'admin' }}</span>
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

    <main class="main-content">
        <div class="page-content">
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
                    --ui-red:#dc2626;
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

                .main-content,
                .page-content{
                    background:var(--ui-bg);
                }

                .page-content{
                    max-width:1680px;
                    margin:0 auto;
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

                :where(.page-title, .dashboard-header h1, .dev-title h1, .cust-title h1, .rep-title h1, .pending-cust-title h1, .pending-title-area h1, .quote-title-area h1, .history-title-area h1, .pro-card-title, .column-title){
                    font-family:'Mukta Mahee', system-ui, sans-serif !important;
                    color:var(--ui-text) !important;
                    font-size:clamp(1.8rem, 2.5vw, 2.55rem) !important;
                    font-weight:800 !important;
                    letter-spacing:0 !important;
                    line-height:1.12 !important;
                }

                :where(.dashboard-header p, .dev-title p, .cust-title p, .rep-title p, .pending-cust-title p, .pending-title-area p, .quote-title-area p, .history-title-area p){
                    color:var(--ui-muted) !important;
                    font-size:clamp(.98rem, 1.1vw, 1.08rem) !important;
                    line-height:1.6 !important;
                }

                :where(.panel, .pro-card, .dev-table-panel, .cust-table-panel, .rep-table-panel, .pending-table-panel, .history-table-panel, .pending-card, .quote-card, .modal-box){
                    background:var(--ui-surface) !important;
                    border:1px solid var(--ui-line) !important;
                    border-radius:14px !important;
                    box-shadow:var(--ui-shadow) !important;
                }

                :where(.dash-card, .stat-card, .summary-card, .metric-card-premium, .dev-metric-card, .cust-metric-card){
                    border-radius:14px !important;
                    box-shadow:0 12px 32px rgba(15, 23, 42, .055) !important;
                }

                .dash-card h2{
                    font-family:'Mukta Mahee', system-ui, sans-serif !important;
                    letter-spacing:0 !important;
                }

                :where(.btn, .btn-create-new, .btn-action, .btn-action-small, .btn-modal, .pending-assign-btn, .btn-pdf-link, .edit-btn, .delete-btn, .add-btn, .save-btn):not(.mobile-nav-toggle):not(.mobile-nav-close):not(.logout-icon):not(.dropdown-btn){
                    border-radius:10px !important;
                    font-family:'Mukta Mahee', system-ui, sans-serif !important;
                    font-weight:700 !important;
                    min-height:42px;
                    letter-spacing:0;
                    transition:transform .16s ease, box-shadow .16s ease, background-color .16s ease, border-color .16s ease;
                }

                :where(.btn, .btn-create-new, .btn-action, .btn-action-small, .btn-modal, .pending-assign-btn, .btn-pdf-link, .edit-btn, .delete-btn, .add-btn, .save-btn):not(.mobile-nav-toggle):not(.mobile-nav-close):not(.logout-icon):not(.dropdown-btn):hover{
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

                :where(.table-wrap){
                    border-radius:14px;
                }

                :where(.table-wrap table, table.dataTable){
                    border-collapse:separate !important;
                    border-spacing:0 !important;
                    color:#334155;
                }

                :where(.table-wrap table thead th, table.dataTable thead th){
                    background:var(--ui-soft) !important;
                    color:#334155 !important;
                    font-size:.76rem !important;
                    font-weight:800 !important;
                    letter-spacing:.04em;
                    padding:14px 16px !important;
                    text-transform:uppercase;
                    border-bottom:1px solid var(--ui-line) !important;
                }

                :where(.table-wrap table tbody td, table.dataTable tbody td){
                    color:#334155 !important;
                    font-size:.95rem !important;
                    padding:14px 16px !important;
                    border-bottom:1px solid #edf2f7 !important;
                    vertical-align:middle;
                }

                :where(.table-wrap table tbody tr, table.dataTable tbody tr){
                    transition:background-color .16s ease;
                }

                :where(.table-wrap table tbody tr:hover, table.dataTable tbody tr:hover){
                    background:#f8fafc !important;
                }

                .dataTables_wrapper .dataTables_length label,
                .dataTables_wrapper .dataTables_filter label,
                .dataTables_wrapper .dataTables_info,
                .dataTables_wrapper .dataTables_paginate{
                    color:var(--ui-muted) !important;
                    font-family:'Mukta Mahee', system-ui, sans-serif !important;
                    font-size:.9rem !important;
                }

                .dataTables_wrapper .dataTables_filter input,
                .dataTables_wrapper .dataTables_length select{
                    min-height:38px;
                    background:#fff;
                }

                .dataTables_wrapper .dataTables_paginate .paginate_button{
                    border-radius:9px !important;
                    border:1px solid transparent !important;
                }

                @media(max-width:1200px){
                    .dashboard-grid,
                    .stats-grid,
                    .device-summary,
                    .dev-metrics-grid,
                    .cust-metrics-grid,
                    .rep-metrics-strip{
                        grid-template-columns:repeat(2, minmax(0, 1fr)) !important;
                    }

                    .pro-analytics-grid{
                        grid-template-columns:1fr !important;
                    }
                }

                @media(max-width:900px){
                    .dev-header,
                    .cust-header,
                    .rep-header,
                    .pending-cust-header,
                    .pending-header-panel,
                    .quote-header-panel,
                    .history-header-panel,
                    .pro-card-header,
                    .column-header{
                        flex-direction:column !important;
                        align-items:flex-start !important;
                        gap:16px !important;
                    }

                    .quote-tabs{
                        width:100%;
                        overflow-x:auto;
                        justify-content:flex-start;
                    }

                    .pending-grid{
                        grid-template-columns:repeat(auto-fill, minmax(min(100%, 320px), 1fr)) !important;
                    }

                    .table-wrap{
                        overflow-x:auto !important;
                        -webkit-overflow-scrolling:touch;
                    }

                    .table-wrap table{
                        min-width:760px !important;
                    }
                }

                @media(max-width:640px){
                    .page-content{
                        padding:16px !important;
                    }

                    .dashboard-grid,
                    .stats-grid,
                    .device-summary,
                    .dev-metrics-grid,
                    .cust-metrics-grid,
                    .rep-metrics-strip,
                    .service-card-list{
                        grid-template-columns:1fr !important;
                    }

                    .panel,
                    .pro-card,
                    .dev-table-panel,
                    .cust-table-panel,
                    .rep-table-panel,
                    .pending-table-panel,
                    .history-table-panel,
                    .pending-card,
                    .quote-card,
                    .metric-card-premium,
                    .dev-metric-card,
                    .cust-metric-card,
                    .summary-card,
                    .stat-card,
                    .dash-card{
                        border-radius:14px !important;
                        padding:20px !important;
                    }

                    .page-title,
                    .dashboard-header h1,
                    .dev-title h1,
                    .cust-title h1,
                    .rep-title h1,
                    .pending-cust-title h1,
                    .pending-title-area h1,
                    .quote-title-area h1,
                    .history-title-area h1{
                        font-size:clamp(1.75rem, 8vw, 2.25rem) !important;
                        line-height:1.15 !important;
                    }

                    .table-wrap{
                        overflow-x:auto !important;
                        -webkit-overflow-scrolling:touch;
                    }

                    .table-wrap table{
                        width:100% !important;
                        min-width:760px !important;
                    }

                    .table-wrap .dataTables_wrapper{
                        width:100% !important;
                        min-width:0 !important;
                        max-width:100% !important;
                    }

                    .dataTables_wrapper{
                        overflow-x:visible !important;
                        width:100% !important;
                        max-width:100% !important;
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

                    .action-row,
                    .form-actions,
                    .quote-action-row,
                    .quote-sent-banner,
                    .pending-card-header,
                    .card-header{
                        flex-direction:column !important;
                        align-items:stretch !important;
                    }

                    .btn,
                    .btn-create-new,
                    .btn-action,
                    .btn-action-small,
                    .btn-modal,
                    .pending-assign-btn,
                    .btn-pdf-link{
                        width:100% !important;
                        justify-content:center !important;
                        white-space:normal !important;
                        text-align:center !important;
                    }

                    .modal-overlay{
                        align-items:flex-start !important;
                        padding:12px !important;
                    }

                    .modal-box{
                        width:100% !important;
                        max-width:100% !important;
                        max-height:calc(100vh - 24px) !important;
                        border-radius:16px !important;
                        padding:22px !important;
                        overflow:auto !important;
                    }

                    .modal-box [style*="grid-template-columns"]{
                        grid-template-columns:1fr !important;
                    }
                }
            </style>
        </div>
    </main>

</div>

<script>
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

    document.querySelectorAll('.admin-wrapper .sidebar a').forEach(function(link){
        link.addEventListener('click', function(){
            if(window.innerWidth <= 900){
                setPanelNav('admin-wrapper', false);
            }
        });
    });

    document.addEventListener('keydown', function(event){
        if(event.key === 'Escape'){
            setPanelNav('admin-wrapper', false);
        }
    });
</script>

@include('components.toast')
</body>
</html>
