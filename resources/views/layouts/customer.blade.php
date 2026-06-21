<!DOCTYPE html>
<html>
<head>
    <title>@yield('title', 'Customer Panel')</title>

    <link href="https://fonts.googleapis.com/css2?family=Playfair+Display:wght@500;700&family=Mukta+Mahee:wght@300;400;600;700&display=swap" rel="stylesheet">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.11.3/font/bootstrap-icons.min.css">

    <style>
        body{
            margin:0;
            font-family:Arial, sans-serif;
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
        .menu-link.active{
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
    </style>
</head>

<body>

<div class="customer-wrapper">

    <aside class="sidebar">

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
                <button class="dropdown-btn" onclick="toggleMenu('bookingMenu')" style="display: flex; justify-content: space-between; align-items: center; width: 100%;">
                    <span class="menu-left">
                        <span class="icon"><i class="bi bi-calendar-check"></i></span>
                        Appointments
                    </span>
                    <span><i class="bi bi-chevron-down" style="font-size: 11px;"></i></span>
                </button>

                <div id="bookingMenu" class="submenu {{ request()->routeIs('customer.booking.*') ? 'show' : '' }}">
                    <a href="{{ route('customer.booking.create') }}" class="{{ request()->routeIs('customer.booking.create') ? 'active' : '' }}">
                        Book Appointment
                    </a>
                    <a href="{{ route('customer.booking.status') }}" class="{{ request()->routeIs('customer.booking.status') ? 'active' : '' }}">
                        Booking Status
                    </a>
                    <a href="{{ route('customer.booking.history') }}" class="{{ request()->routeIs('customer.booking.history') ? 'active' : '' }}">
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
    </main>

</div>

<script>
    function toggleMenu(id){
        document.getElementById(id).classList.toggle('show');
    }

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