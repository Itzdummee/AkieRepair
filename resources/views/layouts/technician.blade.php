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
    </style>
</head>

<body>

<div class="tech-wrapper">

    <aside class="sidebar">
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

    </main>

</div>

<script>
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