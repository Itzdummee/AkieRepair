<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>AkieRepair</title>

    <link rel="stylesheet"
          href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.11.3/font/bootstrap-icons.min.css">

    <link href="https://fonts.googleapis.com/css2?family=Poppins:wght@300;400;500;600;700&display=swap"
          rel="stylesheet">

    <style>
        *{
            margin:0;
            padding:0;
            box-sizing:border-box;
            scroll-behavior:smooth;
        }

        body{
            font-family:'Poppins', sans-serif;
            background:#f5f7fb;
            color:#111827;
        }

        .navbar{
            position:fixed;
            top:0;
            left:0;
            width:100%;
            height:80px;
            background:white;
            box-shadow:0 2px 15px rgba(0,0,0,0.05);
            display:flex;
            align-items:center;
            justify-content:space-between;
            padding:0 70px;
            z-index:1000;
        }

        .logo{
            font-size:30px;
            font-weight:700;
            color:#111827;
        }

        .nav-links{
            display:flex;
            gap:40px;
        }

        .nav-links a{
            text-decoration:none;
            color:#374151;
            font-weight:500;
        }

        .nav-links a:hover{
            color:#22c55e;
        }

        .nav-auth-group{
            display:flex;
            gap:15px;
            align-items:center;
        }

        .nav-btn{
            padding:10px 22px;
            border-radius:30px;
            text-decoration:none;
            font-weight:600;
            font-size:14px;
            transition:0.3s;
        }

        .btn-customer{
            background:#22c55e;
            color:white;
            border:2px solid #22c55e;
        }

        .btn-customer:hover{
            background:#16a34a;
            border-color:#16a34a;
        }

        .btn-staff{
            background:transparent;
            color:#1e3a8a;
            border:2px solid #1e3a8a;
        }

        .btn-staff:hover{
            background:#1e3a8a;
            color:white;
        }

        .hero{
            min-height:100vh;
            display:flex;
            align-items:center;
            justify-content:space-between;
            padding:140px 90px 80px;
            background:linear-gradient(135deg,#111827 0%,#1e3a8a 50%,#22c55e 100%);
        }

        .hero-left{
            width:50%;
            color:white;
        }

        .hero-left h1{
            font-size:65px;
            line-height:1.1;
            margin-bottom:25px;
        }

        .hero-left p{
            font-size:20px;
            line-height:1.8;
            margin-bottom:40px;
            color:#d1d5db;
        }

        .hero-buttons{
            display:flex;
            gap:20px;
        }

        .hero-btn{
            padding:16px 35px;
            border-radius:35px;
            text-decoration:none;
            font-weight:600;
        }

        .btn-green{
            background:#22c55e;
            color:white;
        }

        .btn-white{
            background:white;
            color:#111827;
        }

        .hero-right{
            width:45%;
            display:flex;
            justify-content:center;
        }

        .hero-card{
            width:450px;
            background:white;
            border-radius:30px;
            padding:40px;
            box-shadow:0 20px 50px rgba(0,0,0,0.2);
            animation:float 3s ease-in-out infinite;
        }

        @keyframes float{
            0%{transform:translateY(0);}
            50%{transform:translateY(-15px);}
            100%{transform:translateY(0);}
        }

        .hero-card img{
            width:100%;
            border-radius:20px;
        }

        section{
            padding:100px 90px;
        }

        .section-title{
            text-align:center;
            margin-bottom:60px;
        }

        .section-title h2{
            font-size:50px;
            margin-bottom:15px;
        }

        .section-title p{
            color:#6b7280;
            font-size:18px;
        }

        .services-grid{
            display:grid;
            grid-template-columns:repeat(4,1fr);
            gap:30px;
        }

        .service-card{
            background:white;
            padding:40px 30px;
            border-radius:25px;
            text-align:center;
            box-shadow:0 10px 30px rgba(0,0,0,0.05);
            transition:0.3s;
        }

        .service-card:hover{
            transform:translateY(-10px);
        }

        .service-icon{
            width:90px;
            height:90px;
            margin:auto;
            margin-bottom:25px;
            border-radius:20px;
            display:flex;
            align-items:center;
            justify-content:center;
            font-size:38px;
            color:white;
        }

        .phone{background:#3b82f6;}
        .tv{background:#8b5cf6;}
        .fridge{background:#06b6d4;}
        .washer{background:#f59e0b;}

        .service-card h3{
            margin-bottom:15px;
            font-size:24px;
        }

        .service-card p{
            color:#6b7280;
            line-height:1.7;
        }

        .category-tabs{
            display:flex;
            justify-content:center;
            gap:15px;
            flex-wrap:wrap;
            margin-bottom:50px;
        }

        .tab-btn{
            border:none;
            padding:14px 26px;
            border-radius:50px;
            background:white;
            color:#111827;
            font-weight:700;
            cursor:pointer;
            box-shadow:0 8px 20px rgba(0,0,0,.08);
            transition:.3s;
        }

        .tab-btn.active,
        .tab-btn:hover{
            background:#22c55e;
            color:white;
            transform:translateY(-3px);
        }

        .hide{
            display:none;
        }

        .repair-grid{
            display:grid;
            grid-template-columns:repeat(3,1fr);
            gap:30px;
        }

        .repair-card{
            background:white;
            border-radius:25px;
            overflow:hidden;
            box-shadow:0 10px 30px rgba(0,0,0,0.05);
            transition:0.3s;
        }

        .repair-card:hover{
            transform:translateY(-8px);
        }

        .repair-top{
            background:#111827;
            color:white;
            padding:30px;
        }

        .repair-top h3{
            font-size:28px;
            margin-bottom:8px;
        }

        .repair-top p,
        .repair-top small{
            color:#d1d5db;
        }

        .repair-body{
            padding:30px;
        }

        .price-row{
            display:flex;
            justify-content:space-between;
            align-items:center;
            padding:16px 0;
            border-bottom:1px solid #e5e7eb;
        }

        .price-row h4{
            font-size:18px;
            margin-bottom:4px;
        }

        .price-row p{
            color:#6b7280;
            font-size:14px;
        }

        .price-row strong{
            color:#22c55e;
            font-size:20px;
            white-space:nowrap;
        }

        .repair-btn{
            width:100%;
            height:55px;
            margin-top:25px;
            border:none;
            border-radius:15px;
            background:#22c55e;
            color:white;
            font-size:16px;
            font-weight:600;
            cursor:pointer;
        }

        .process-grid{
            display:grid;
            grid-template-columns:repeat(5,1fr);
            gap:25px;
        }

        .process-card{
            background:white;
            border-radius:25px;
            padding:35px 25px;
            text-align:center;
            box-shadow:0 10px 25px rgba(0,0,0,0.05);
        }

        .process-number{
            width:55px;
            height:55px;
            margin:auto;
            margin-bottom:20px;
            border-radius:50%;
            background:#22c55e;
            color:white;
            display:flex;
            align-items:center;
            justify-content:center;
            font-weight:700;
            font-size:20px;
        }

        .process-card p{
            color:#6b7280;
            line-height:1.6;
            font-size:14px;
        }

        footer{
            background:#111827;
            color:white;
            text-align:center;
            padding:40px;
        }

        @media(max-width:1000px){
            .hero{
                flex-direction:column;
                gap:50px;
            }

            .hero-left,
            .hero-right{
                width:100%;
            }

            .services-grid,
            .repair-grid,
            .process-grid{
                grid-template-columns:1fr;
            }
        }

        html,
        body{
            max-width:100%;
            overflow-x:hidden;
        }

        img{
            max-width:100%;
            height:auto;
        }

        @media(max-width:900px){
            .navbar{
                height:auto;
                min-height:72px;
                padding:14px 24px;
                flex-wrap:wrap;
                gap:14px;
            }

            .logo{
                font-size:24px;
            }

            .nav-links{
                order:3;
                width:100%;
                gap:22px;
                overflow-x:auto;
                padding:4px 0 2px;
                scrollbar-width:none;
            }

            .nav-links::-webkit-scrollbar{
                display:none;
            }

            .nav-links a{
                white-space:nowrap;
                font-size:14px;
            }

            .nav-auth-group{
                gap:10px;
                flex-wrap:wrap;
                justify-content:flex-end;
            }

            .nav-btn{
                padding:9px 16px;
                font-size:13px;
            }

            .hero{
                min-height:auto;
                padding:150px 32px 70px;
                text-align:left;
            }

            .hero-left h1{
                font-size:clamp(2.6rem, 9vw, 4.2rem);
            }

            .hero-left p{
                font-size:17px;
            }

            .hero-card{
                width:min(100%, 430px);
                padding:24px;
                border-radius:22px;
            }

            section{
                padding:70px 32px;
            }

            .section-title{
                margin-bottom:40px;
            }

            .section-title h2{
                font-size:clamp(2rem, 7vw, 3.2rem);
            }

            .price-row{
                align-items:flex-start;
                gap:8px;
            }
        }

        @media(max-width:600px){
            .navbar{
                position:sticky;
                padding:12px 16px;
            }

            .nav-auth-group{
                width:100%;
                justify-content:stretch;
            }

            .nav-btn{
                flex:1;
                text-align:center;
                padding:9px 10px;
            }

            .hero{
                padding:42px 20px 56px;
                gap:34px;
            }

            .hero-left h1{
                font-size:2.35rem;
            }

            .hero-left p{
                font-size:16px;
                margin-bottom:28px;
            }

            .hero-buttons{
                flex-direction:column;
                width:100%;
            }

            .hero-btn,
            .repair-btn{
                width:100%;
                box-sizing:border-box;
                text-align:center;
            }

            .hero-card{
                padding:16px;
                border-radius:18px;
            }

            section{
                padding:52px 20px;
            }

            .service-card,
            .repair-card,
            .process-card{
                border-radius:18px;
                padding:28px 20px;
            }

            .repair-card{
                padding:0;
            }

            .repair-top,
            .repair-body{
                padding:24px 20px;
            }

            .price-row{
                flex-direction:column;
                align-items:flex-start;
            }

            footer{
                padding:28px 20px;
            }
        }

        .nav-toggle{
            display:none;
        }

        @media(max-width:900px){
            .nav-toggle{
                width:42px;
                height:42px;
                border:1px solid #e5e7eb;
                border-radius:10px;
                background:#f9fafb;
                color:#111827;
                display:inline-flex;
                align-items:center;
                justify-content:center;
                font-size:24px;
                cursor:pointer;
                margin-left:auto;
            }

            .navbar{
                align-items:flex-start;
            }

            .nav-links,
            .nav-auth-group{
                display:none;
                width:100%;
            }

            .navbar.nav-open .nav-links,
            .navbar.nav-open .nav-auth-group{
                display:flex;
            }

            .nav-links{
                order:3;
                flex-direction:column;
                gap:0;
                padding-top:8px;
                overflow:visible;
            }

            .nav-links a{
                padding:12px 0;
                border-top:1px solid #f3f4f6;
            }

            .nav-auth-group{
                order:4;
                flex-direction:column;
                gap:10px;
                padding-top:12px;
                align-items:stretch;
            }

            .nav-btn{
                width:100%;
                text-align:center;
                box-sizing:border-box;
            }
        }

        @media(max-width:600px){
            .nav-toggle{
                width:40px;
                height:40px;
                font-size:22px;
            }

            .navbar{
                position:sticky;
                top:0;
            }
        }

        :root{
            --ui-text:#0f172a;
            --ui-muted:#64748b;
            --ui-line:#e2e8f0;
            --ui-soft:#f8fafc;
            --ui-accent:#16a34a;
            --ui-blue:#2563eb;
            --ui-shadow:0 18px 45px rgba(15, 23, 42, .08);
        }

        body{
            background:#f4f7fb;
            color:var(--ui-text);
            text-rendering:optimizeLegibility;
        }

        .navbar{
            height:auto;
            min-height:76px;
            padding:0 clamp(20px, 5vw, 70px);
            background:rgba(255, 255, 255, .94);
            border-bottom:1px solid rgba(226, 232, 240, .9);
            box-shadow:0 12px 35px rgba(15, 23, 42, .055);
            backdrop-filter:blur(14px);
        }

        .logo{
            color:var(--ui-text);
            font-size:clamp(1.45rem, 2.2vw, 1.9rem);
            letter-spacing:0;
        }

        .nav-links{
            gap:clamp(18px, 3vw, 36px);
        }

        .nav-links a{
            color:#334155;
            font-size:.95rem;
            transition:color .16s ease;
        }

        .nav-btn,
        .hero-btn,
        .tab-btn,
        .repair-btn{
            border-radius:12px;
            box-shadow:none;
            transition:transform .16s ease, box-shadow .16s ease, background-color .16s ease, border-color .16s ease;
        }

        .nav-btn:hover,
        .hero-btn:hover,
        .tab-btn:hover,
        .repair-btn:hover{
            transform:translateY(-1px);
        }

        .btn-customer,
        .btn-green,
        .tab-btn.active,
        .tab-btn:hover,
        .repair-btn{
            background:var(--ui-accent);
            border-color:var(--ui-accent);
        }

        .hero{
            min-height:calc(100vh - 20px);
            padding:clamp(120px, 13vw, 150px) clamp(22px, 6vw, 90px) clamp(68px, 8vw, 90px);
            background:linear-gradient(135deg, #0f172a 0%, #1d4ed8 58%, #16a34a 100%);
            gap:clamp(32px, 5vw, 72px);
        }

        .hero-left h1{
            font-size:clamp(2.45rem, 5.4vw, 4.25rem);
            letter-spacing:0;
        }

        .hero-left p{
            max-width:650px;
            color:#dbeafe;
            font-size:clamp(1rem, 1.45vw, 1.18rem);
        }

        .hero-card{
            width:min(100%, 460px);
            border:1px solid rgba(255, 255, 255, .75);
            border-radius:22px;
            box-shadow:0 24px 60px rgba(15, 23, 42, .25);
        }

        .hero-card img{
            border-radius:16px;
        }

        section{
            padding:clamp(58px, 8vw, 96px) clamp(20px, 6vw, 90px);
        }

        .section-title{
            margin-bottom:clamp(34px, 5vw, 56px);
        }

        .section-title h2{
            color:var(--ui-text);
            font-size:clamp(2rem, 4.3vw, 3.1rem);
            line-height:1.1;
            letter-spacing:0;
        }

        .section-title p{
            color:var(--ui-muted);
            font-size:clamp(.98rem, 1.25vw, 1.08rem);
        }

        .services-grid,
        .repair-grid,
        .process-grid{
            gap:clamp(18px, 2.5vw, 30px);
        }

        .service-card,
        .repair-card,
        .process-card{
            border:1px solid var(--ui-line);
            border-radius:18px;
            box-shadow:var(--ui-shadow);
        }

        .service-card:hover,
        .repair-card:hover{
            transform:translateY(-4px);
        }

        .service-icon{
            border-radius:16px;
        }

        .service-card h3{
            color:var(--ui-text);
            letter-spacing:0;
        }

        .repair-top h3{
            color:white;
            letter-spacing:0;
        }

        .repair-top{
            background:linear-gradient(135deg, #0f172a, #1e293b);
        }

        .price-row{
            gap:16px;
        }

        .price-row h4{
            color:var(--ui-text);
        }

        .process-number{
            background:var(--ui-accent);
        }

        @media(max-width:900px){
            .navbar{
                padding:14px 22px;
            }

            .hero{
                padding:118px 28px 64px;
            }
        }

        @media(max-width:600px){
            .navbar{
                padding:12px 16px;
            }

            .hero{
                padding:44px 20px 56px;
            }

            .hero-left h1{
                font-size:clamp(2.1rem, 11vw, 2.6rem);
            }

            .service-card,
            .process-card{
                padding:26px 20px;
            }
        }
    </style>
</head>

<body>

<div class="navbar">
    <div class="logo">AkieRepair</div>
    <button type="button" class="nav-toggle" aria-label="Open navigation menu" aria-expanded="false">
        <i class="bi bi-list"></i>
    </button>

    <div class="nav-links">
        <a href="#home">Home</a>
        <a href="#services">Services</a>
        <a href="#pricing">Repair Prices</a>
        <a href="#process">Process</a>
    </div>

    <div class="nav-auth-group">
        <a href="{{ route('login') }}?role=customer" class="nav-btn btn-customer">Customer Login</a>
        <a href="{{ route('login') }}?role=staff" class="nav-btn btn-staff">Staff Login</a>
    </div>
</div>

<section class="hero" id="home">
    <div class="hero-left">
        <h1>Professional Device & Appliance Repair</h1>

        <p>
            Repair smartphones, televisions, refrigerators and washing machines
            with trusted technicians, quotation approval and repair tracking.
        </p>

        <div class="hero-buttons">
            @guest
                <a href="{{ route('login') }}" class="hero-btn btn-green">Book Now</a>
            @endguest

            @auth
                <a href="{{ route('customer.booking.create') }}" class="hero-btn btn-green">Book Now</a>
            @endauth

            <a href="#pricing" class="hero-btn btn-white">View Prices</a>
        </div>
    </div>

    <div class="hero-right">
        <div class="hero-card">
            <img src="https://images.unsplash.com/photo-1581092921461-eab62e97a780?q=80&w=1200"
                 alt="Repair">
        </div>
    </div>
</section>

<section id="services">
    <div class="section-title">
        <h2>Our Services</h2>
        <p>Choose your repair category</p>
    </div>

    <div class="services-grid">
        <div class="service-card">
            <div class="service-icon phone">
                <i class="bi bi-phone"></i>
            </div>
            <h3>Smartphone Repair</h3>
            <p>Battery replacement, LCD repair, charging port repair and more.</p>
        </div>

        <div class="service-card">
            <div class="service-icon tv">
                <i class="bi bi-tv"></i>
            </div>
            <h3>Television Repair</h3>
            <p>Display issue, sound issue, LED problem and power repair.</p>
        </div>

        <div class="service-card">
            <div class="service-icon fridge">
                <i class="bi bi-snow"></i>
            </div>
            <h3>Refrigerator Repair</h3>
            <p>Cooling issue, compressor checking, gas refill and maintenance.</p>
        </div>

        <div class="service-card">
            <div class="service-icon washer">
                <i class="bi bi-water"></i>
            </div>
            <h3>Washing Machine Repair</h3>
            <p>Water leakage, motor problem, spin issue and board repair.</p>
        </div>
    </div>
</section>

<section id="pricing">
    <div class="section-title">
        <h2>Repair Pricing</h2>
        <p>Select device category to view available models and repair prices.</p>
    </div>

    <div class="category-tabs">
        <button onclick="showCategory('Smartphone', this)" class="tab-btn active">Smartphone</button>
        <button onclick="showCategory('Television', this)" class="tab-btn">Television</button>
        <button onclick="showCategory('Refrigerator', this)" class="tab-btn">Refrigerator</button>
        <button onclick="showCategory('Washing Machine', this)" class="tab-btn">Washing Machine</button>
    </div>

    @foreach(['Smartphone', 'Television', 'Refrigerator', 'Washing Machine'] as $type)
        <div class="device-category {{ $type == 'Smartphone' ? '' : 'hide' }}"
             id="{{ str_replace(' ', '', $type) }}">

            <div class="repair-grid">

                @forelse($devices->where('type', $type) as $device)
                    <div class="repair-card">

                        <div class="repair-top">
                            <h3>{{ $device->name }}</h3>
                            <p>{{ $device->brand }} • {{ $device->model }}</p>
                            <small>{{ $device->capacity }} {{ $device->capacity_unit }}</small>
                        </div>

                        <div class="repair-body">
                            @forelse($device->repairs as $repair)
                                <div class="price-row">
                                    <div>
                                        <h4>{{ $repair->repair_type }}</h4>
                                        <p>
                                            {{ $repair->warranty_period ?? 'No warranty info' }}
                                            •
                                            {{ $repair->duration ?? '-' }}
                                        </p>
                                    </div>

                                    <strong>
                                        RM {{ number_format($repair->price, 2) }}
                                    </strong>
                                </div>
                            @empty
                                <p>No repair price available yet.</p>
                            @endforelse

                            @guest
                                <a href="{{ route('login') }}">
                                    <button class="repair-btn">Book Now</button>
                                </a>
                            @endguest

                            @auth
                                <a href="{{ route('customer.booking.create') }}">
                                    <button class="repair-btn">Book Now</button>
                                </a>
                            @endauth
                        </div>

                    </div>
                @empty
                    <p>No {{ $type }} devices available.</p>
                @endforelse

            </div>
        </div>
    @endforeach
</section>

<section id="process">
    <div class="section-title">
        <h2>How Booking Works</h2>
        <p>Easy repair process with quotation tracking</p>
    </div>

    <div class="process-grid">
        <div class="process-card">
            <div class="process-number">1</div>
            <h4>Book Visit</h4>
            <p>Customer submits repair visit request.</p>
        </div>

        <div class="process-card">
            <div class="process-number">2</div>
            <h4>Assign Technician</h4>
            <p>Admin assigns available technician.</p>
        </div>

        <div class="process-card">
            <div class="process-number">3</div>
            <h4>Inspection</h4>
            <p>Technician checks device problem.</p>
        </div>

        <div class="process-card">
            <div class="process-number">4</div>
            <h4>Quotation</h4>
            <p>Admin sends repair quotation.</p>
        </div>

        <div class="process-card">
            <div class="process-number">5</div>
            <h4>Repair Complete</h4>
            <p>Customer tracks repair progress timeline.</p>
        </div>
    </div>
</section>

<footer>
    © 2026 AkieRepair Enterprise. All Rights Reserved.
</footer>

<script>
    const mainNavbar = document.querySelector('.navbar');
    const navToggle = document.querySelector('.nav-toggle');

    if(navToggle && mainNavbar){
        navToggle.addEventListener('click', function(){
            const isOpen = mainNavbar.classList.toggle('nav-open');
            navToggle.setAttribute('aria-expanded', isOpen ? 'true' : 'false');
            navToggle.innerHTML = isOpen ? '<i class="bi bi-x-lg"></i>' : '<i class="bi bi-list"></i>';
        });

        document.querySelectorAll('.nav-links a, .nav-auth-group a').forEach(function(link){
            link.addEventListener('click', function(){
                mainNavbar.classList.remove('nav-open');
                navToggle.setAttribute('aria-expanded', 'false');
                navToggle.innerHTML = '<i class="bi bi-list"></i>';
            });
        });

        document.addEventListener('keydown', function(event){
            if(event.key === 'Escape'){
                mainNavbar.classList.remove('nav-open');
                navToggle.setAttribute('aria-expanded', 'false');
                navToggle.innerHTML = '<i class="bi bi-list"></i>';
            }
        });
    }

    function showCategory(type, button){
        document.querySelectorAll('.device-category').forEach(section => {
            section.classList.add('hide');
        });

        document.getElementById(type.replaceAll(' ', '')).classList.remove('hide');

        document.querySelectorAll('.tab-btn').forEach(btn => {
            btn.classList.remove('active');
        });

        button.classList.add('active');
    }
</script>

</body>
</html>
