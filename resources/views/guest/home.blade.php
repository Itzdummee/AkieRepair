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
    </style>
</head>

<body>

<div class="navbar">
    <div class="logo">AkieRepair</div>

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