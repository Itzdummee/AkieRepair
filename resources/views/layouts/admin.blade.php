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
    </style>
</head>

<body>

<div class="admin-wrapper">

    <aside class="sidebar">

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
        </div>
    </main>

</div>

<script>
    function toggleMenu(id){
        document.getElementById(id).classList.toggle('show');
    }
</script>

@include('components.toast')
</body>
</html>