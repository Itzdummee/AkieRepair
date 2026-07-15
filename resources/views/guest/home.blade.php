<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta name="theme-color" content="#f8fbff">
    <title>AkieRepair | Professional Device Repair</title>

    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.11.3/font/bootstrap-icons.min.css">
    <link href="https://fonts.googleapis.com/css2?family=Manrope:wght@400;500;600;700;800&display=swap" rel="stylesheet">

    <style>
        :root{
            --bg:#07111f;
            --bg-soft:#0c192b;
            --surface:#ffffff;
            --surface-soft:#f4f7fb;
            --text:#101828;
            --muted:#667085;
            --line:#e4e9f0;
            --primary:#45d483;
            --primary-dark:#20ad62;
            --blue:#4d7cff;
            --purple:#8a65ff;
            --cyan:#28c8d9;
            --orange:#ffad42;
            --shadow:0 24px 70px rgba(16,24,40,.12);
            --radius-xl:32px;
            --radius-lg:24px;
            --radius-md:16px;
        }

        *{
            margin:0;
            padding:0;
            box-sizing:border-box;
        }

        html{
            scroll-behavior:smooth;
            scroll-padding-top:100px;
        }

        body{
            font-family:'Manrope',sans-serif;
            color:var(--text);
            background:var(--surface-soft);
            overflow-x:hidden;
            text-rendering:optimizeLegibility;
        }

        a{text-decoration:none;color:inherit;}
        button{font:inherit;}
        img{display:block;max-width:100%;}

        .container{
            width:min(1180px, calc(100% - 40px));
            margin-inline:auto;
        }

        .navbar{
            position:fixed;
            inset:18px 0 auto;
            z-index:1000;
            width:min(1180px, calc(100% - 40px));
            margin-inline:auto;
            min-height:72px;
            display:flex;
            align-items:center;
            justify-content:space-between;
            gap:28px;
            padding:12px 14px 12px 22px;
            color:white;
            background:rgba(8,19,34,.76);
            border:1px solid rgba(255,255,255,.12);
            border-radius:20px;
            box-shadow:0 18px 60px rgba(0,0,0,.18);
            backdrop-filter:blur(20px);
            -webkit-backdrop-filter:blur(20px);
            transition:.3s ease;
        }

        .navbar.scrolled{
            inset:10px 0 auto;
            background:rgba(7,17,31,.94);
        }

        .logo{
            display:flex;
            align-items:center;
            gap:12px;
            font-size:1.12rem;
            font-weight:800;
            letter-spacing:-.03em;
            white-space:nowrap;
        }

        .logo-mark{
            width:42px;
            height:42px;
            display:grid;
            place-items:center;
            border-radius:13px;
            color:#07111f;
            background:linear-gradient(135deg,#7af0ab,var(--primary));
            box-shadow:0 10px 28px rgba(69,212,131,.3);
        }

        .logo span small{
            display:block;
            margin-top:1px;
            color:#9fb0c5;
            font-size:.65rem;
            font-weight:600;
            letter-spacing:.08em;
            text-transform:uppercase;
        }

        .nav-links{
            display:flex;
            align-items:center;
            gap:30px;
        }

        .nav-links a{
            position:relative;
            color:#c9d4e1;
            font-size:.9rem;
            font-weight:600;
            transition:.2s ease;
        }

        .nav-links a::after{
            content:"";
            position:absolute;
            left:0;
            right:100%;
            bottom:-8px;
            height:2px;
            border-radius:99px;
            background:var(--primary);
            transition:.25s ease;
        }

        .nav-links a:hover{color:white;}
        .nav-links a:hover::after{right:0;}

        .nav-auth-group{
            display:flex;
            align-items:center;
            gap:10px;
        }

        .nav-btn,
        .hero-btn,
        .repair-btn{
            display:inline-flex;
            align-items:center;
            justify-content:center;
            gap:9px;
            border-radius:13px;
            font-weight:800;
            transition:transform .2s ease, box-shadow .2s ease, background .2s ease;
        }

        .nav-btn{
            min-height:46px;
            padding:0 18px;
            font-size:.82rem;
        }

        .btn-customer,
        .btn-green{
            color:#06130c;
            background:linear-gradient(135deg,#7bf1ac,var(--primary));
            box-shadow:0 10px 28px rgba(69,212,131,.2);
        }

        .btn-staff{
            color:white;
            border:1px solid rgba(255,255,255,.16);
            background:rgba(255,255,255,.07);
        }

        .nav-btn:hover,
        .hero-btn:hover,
        .repair-btn:hover{
            transform:translateY(-2px);
        }

        .nav-toggle{
            display:none;
            width:44px;
            height:44px;
            border:1px solid rgba(255,255,255,.16);
            border-radius:12px;
            color:white;
            background:rgba(255,255,255,.08);
            font-size:1.4rem;
            cursor:pointer;
        }

        .hero{
            position:relative;
            min-height:100vh;
            display:flex;
            align-items:center;
            isolation:isolate;
            overflow:hidden;
            color:white;
            background:
                radial-gradient(circle at 78% 30%, rgba(77,124,255,.25), transparent 30%),
                radial-gradient(circle at 25% 74%, rgba(69,212,131,.18), transparent 28%),
                linear-gradient(135deg,#06101d 0%,#0b1a2e 55%,#10233d 100%);
        }

        .hero::before{
            content:"";
            position:absolute;
            inset:0;
            z-index:-2;
            opacity:.22;
            background-image:
                linear-gradient(rgba(255,255,255,.06) 1px, transparent 1px),
                linear-gradient(90deg,rgba(255,255,255,.06) 1px, transparent 1px);
            background-size:52px 52px;
            mask-image:linear-gradient(to bottom,black 35%,transparent 95%);
        }

        .orb{
            position:absolute;
            border-radius:50%;
            filter:blur(2px);
            pointer-events:none;
            animation:orbMove 8s ease-in-out infinite;
        }

        .orb-one{
            width:260px;
            height:260px;
            right:-80px;
            top:18%;
            background:rgba(69,212,131,.12);
        }

        .orb-two{
            width:180px;
            height:180px;
            left:-50px;
            bottom:8%;
            background:rgba(77,124,255,.14);
            animation-delay:-3s;
        }

        @keyframes orbMove{
            50%{transform:translate3d(18px,-24px,0) scale(1.06);}
        }

        .hero-inner{
            width:min(1180px, calc(100% - 40px));
            margin:auto;
            padding:150px 0 90px;
            display:grid;
            grid-template-columns:minmax(0,1.06fr) minmax(420px,.94fr);
            align-items:center;
            gap:70px;
        }

        .eyebrow{
            display:inline-flex;
            align-items:center;
            gap:10px;
            margin-bottom:24px;
            padding:9px 14px;
            border:1px solid rgba(255,255,255,.13);
            border-radius:999px;
            color:#d9e5f1;
            background:rgba(255,255,255,.06);
            font-size:.75rem;
            font-weight:800;
            letter-spacing:.08em;
            text-transform:uppercase;
        }

        .eyebrow-dot{
            width:8px;
            height:8px;
            border-radius:50%;
            background:var(--primary);
            box-shadow:0 0 0 6px rgba(69,212,131,.12);
            animation:pulse 2s ease-in-out infinite;
        }

        @keyframes pulse{
            50%{box-shadow:0 0 0 10px rgba(69,212,131,0);}
        }

        .hero-left h1{
            max-width:760px;
            font-size:clamp(3rem,6.2vw,5.5rem);
            line-height:.98;
            letter-spacing:-.065em;
        }

        .gradient-text{
            color:transparent;
            background:linear-gradient(90deg,#85f5b6 0%,#5edbff 55%,#97aaff 100%);
            background-clip:text;
            -webkit-background-clip:text;
        }

        .hero-left>p{
            max-width:650px;
            margin:28px 0 34px;
            color:#aebfd1;
            font-size:clamp(1rem,1.5vw,1.16rem);
            line-height:1.8;
        }

        .hero-buttons{
            display:flex;
            flex-wrap:wrap;
            gap:14px;
        }

        .hero-btn{
            min-height:56px;
            padding:0 24px;
            font-size:.92rem;
        }

        .btn-white{
            color:white;
            border:1px solid rgba(255,255,255,.16);
            background:rgba(255,255,255,.07);
            backdrop-filter:blur(10px);
        }

        .trust-row{
            display:flex;
            flex-wrap:wrap;
            gap:22px;
            margin-top:38px;
            color:#c5d0dc;
            font-size:.82rem;
            font-weight:700;
        }

        .trust-row span{
            display:flex;
            align-items:center;
            gap:8px;
        }

        .trust-row i{color:var(--primary);}

        .hero-visual{
            position:relative;
            min-height:570px;
            display:flex;
            align-items:center;
            justify-content:center;
            perspective:1200px;
        }

        .dashboard-card{
            position:relative;
            width:min(100%,510px);
            padding:20px;
            border:1px solid rgba(255,255,255,.13);
            border-radius:28px;
            background:linear-gradient(145deg,rgba(255,255,255,.13),rgba(255,255,255,.045));
            box-shadow:0 38px 90px rgba(0,0,0,.36);
            backdrop-filter:blur(22px);
            transform:rotateY(-7deg) rotateX(3deg);
            animation:dashboardFloat 5s ease-in-out infinite;
        }

        @keyframes dashboardFloat{
            50%{transform:translateY(-14px) rotateY(-3deg) rotateX(1deg);}
        }

        .window-bar{
            display:flex;
            align-items:center;
            justify-content:space-between;
            margin-bottom:16px;
        }

        .window-dots{display:flex;gap:7px;}
        .window-dots span{width:8px;height:8px;border-radius:50%;background:rgba(255,255,255,.28);}
        .window-title{font-size:.72rem;color:#94a9bd;font-weight:700;}

        .repair-preview{
            padding:22px;
            color:var(--text);
            border-radius:20px;
            background:#f8fbff;
            box-shadow:inset 0 0 0 1px rgba(16,24,40,.04);
        }

        .preview-head{
            display:flex;
            justify-content:space-between;
            align-items:flex-start;
            gap:16px;
            margin-bottom:20px;
        }

        .preview-head small{
            display:block;
            margin-bottom:6px;
            color:var(--muted);
            font-weight:700;
        }

        .preview-head h3{font-size:1.22rem;letter-spacing:-.03em;}

        .status-pill{
            display:flex;
            align-items:center;
            gap:7px;
            padding:8px 11px;
            color:#08783f;
            background:#e4faed;
            border-radius:999px;
            font-size:.68rem;
            font-weight:800;
            white-space:nowrap;
        }

        .device-panel{
            display:grid;
            grid-template-columns:145px 1fr;
            gap:18px;
            margin-bottom:18px;
        }

        .device-image{
            position:relative;
            min-height:170px;
            overflow:hidden;
            border-radius:16px;
            background:linear-gradient(145deg,#dce6f4,#f7f9fc);
        }

        .device-image img{
            width:100%;
            height:100%;
            object-fit:cover;
        }

        .device-image::after{
            content:"";
            position:absolute;
            inset:0;
            background:linear-gradient(to top,rgba(7,17,31,.22),transparent 55%);
        }

        .metric-stack{display:grid;gap:10px;}

        .metric{
            display:flex;
            align-items:center;
            gap:12px;
            padding:13px;
            border:1px solid #e8edf3;
            border-radius:14px;
            background:white;
        }

        .metric-icon{
            width:38px;
            height:38px;
            display:grid;
            place-items:center;
            flex:0 0 auto;
            border-radius:11px;
            color:#2857c8;
            background:#eaf0ff;
        }

        .metric small{display:block;color:var(--muted);font-size:.66rem;font-weight:700;}
        .metric strong{font-size:.78rem;}

        .timeline-mini{
            position:relative;
            display:grid;
            grid-template-columns:repeat(4,1fr);
            gap:8px;
            padding-top:12px;
        }

        .timeline-mini::before{
            content:"";
            position:absolute;
            left:10%;
            right:10%;
            top:27px;
            height:3px;
            background:linear-gradient(90deg,var(--primary) 0 68%,#dce4ed 68%);
        }

        .mini-step{position:relative;text-align:center;z-index:1;}
        .mini-step span{
            width:30px;
            height:30px;
            display:grid;
            place-items:center;
            margin:0 auto 8px;
            border:4px solid #f8fbff;
            border-radius:50%;
            color:white;
            background:var(--primary);
            font-size:.62rem;
        }
        .mini-step.pending span{background:#dce4ed;color:#8492a5;}
        .mini-step small{font-size:.6rem;color:var(--muted);font-weight:800;}

        .floating-card{
            position:absolute;
            z-index:3;
            display:flex;
            align-items:center;
            gap:12px;
            padding:13px 16px;
            color:var(--text);
            border:1px solid rgba(255,255,255,.8);
            border-radius:16px;
            background:rgba(255,255,255,.94);
            box-shadow:0 18px 45px rgba(0,0,0,.18);
            backdrop-filter:blur(14px);
            animation:badgeFloat 4s ease-in-out infinite;
        }

        .floating-card i{
            width:38px;height:38px;display:grid;place-items:center;border-radius:11px;
            color:#0c7842;background:#e6faee;font-size:1.05rem;
        }

        .floating-card small{display:block;color:var(--muted);font-size:.63rem;font-weight:700;}
        .floating-card strong{font-size:.76rem;}
        .float-one{top:72px;right:-24px;}
        .float-two{bottom:72px;left:-30px;animation-delay:-2s;}
        .float-two i{color:#315bc7;background:#e9efff;}

        @keyframes badgeFloat{50%{transform:translateY(-10px);}}

        .section{
            padding:105px 0;
        }

        .section-white{background:white;}
        .section-dark{color:white;background:var(--bg);}

        .section-heading{
            max-width:720px;
            margin:0 auto 58px;
            text-align:center;
        }

        .section-kicker{
            display:inline-block;
            margin-bottom:13px;
            color:var(--primary-dark);
            font-size:.76rem;
            font-weight:800;
            letter-spacing:.12em;
            text-transform:uppercase;
        }

        .section-dark .section-kicker{color:#72e8a5;}

        .section-heading h2{
            font-size:clamp(2.1rem,4.5vw,3.6rem);
            line-height:1.08;
            letter-spacing:-.055em;
        }

        .section-heading p{
            margin-top:16px;
            color:var(--muted);
            line-height:1.75;
            font-size:1rem;
        }

        .section-dark .section-heading p{color:#9eafc1;}

        .services-grid{
            display:grid;
            grid-template-columns:repeat(4,1fr);
            gap:18px;
        }

        .service-card{
            position:relative;
            min-height:310px;
            padding:28px;
            overflow:hidden;
            border:1px solid var(--line);
            border-radius:var(--radius-lg);
            background:white;
            box-shadow:0 14px 40px rgba(16,24,40,.06);
            transition:.35s ease;
        }

        .service-card::before{
            content:"";
            position:absolute;
            width:160px;
            height:160px;
            right:-90px;
            bottom:-90px;
            border-radius:50%;
            background:var(--service-soft);
            transition:.35s ease;
        }

        .service-card:hover{
            transform:translateY(-9px);
            box-shadow:var(--shadow);
        }

        .service-card:hover::before{transform:scale(1.5);}

        .service-icon{
            position:relative;
            z-index:1;
            width:62px;
            height:62px;
            display:grid;
            place-items:center;
            margin-bottom:42px;
            border-radius:17px;
            color:white;
            background:var(--service-color);
            box-shadow:0 13px 28px var(--service-shadow);
            font-size:1.55rem;
        }

        .service-card h3{
            position:relative;
            z-index:1;
            margin-bottom:12px;
            font-size:1.16rem;
            letter-spacing:-.03em;
        }

        .service-card p{
            position:relative;
            z-index:1;
            color:var(--muted);
            line-height:1.72;
            font-size:.88rem;
        }

        .service-link{
            position:absolute;
            left:28px;
            bottom:27px;
            z-index:1;
            display:flex;
            align-items:center;
            gap:8px;
            color:#344054;
            font-size:.78rem;
            font-weight:800;
        }

        .phone{--service-color:var(--blue);--service-soft:#eaf0ff;--service-shadow:rgba(77,124,255,.24);}
        .tv{--service-color:var(--purple);--service-soft:#f0ebff;--service-shadow:rgba(138,101,255,.24);}
        .fridge{--service-color:var(--cyan);--service-soft:#e6f9fb;--service-shadow:rgba(40,200,217,.24);}
        .washer{--service-color:var(--orange);--service-soft:#fff3df;--service-shadow:rgba(255,173,66,.24);}

        .pricing-shell{
            padding:26px;
            border:1px solid rgba(255,255,255,.1);
            border-radius:30px;
            background:rgba(255,255,255,.045);
        }

        .category-tabs{
            position:relative;
            display:flex;
            align-items:center;
            justify-content:center;
            flex-wrap:nowrap;
            gap:10px;
            margin-bottom:34px;
            padding:8px;
            border:1px solid rgba(255,255,255,.09);
            border-radius:17px;
            background:rgba(255,255,255,.04);
        }

        .tab-btn{
            min-height:44px;
            padding:0 18px;
            border:0;
            border-radius:11px;
            color:#9fb0c2;
            background:transparent;
            font-size:.8rem;
            font-weight:800;
            cursor:pointer;
            transition:.2s ease;
        }

        .tab-btn.active,
        .tab-btn:hover{
            color:#07111f;
            background:var(--primary);
            box-shadow:0 10px 25px rgba(69,212,131,.18);
        }

        .hide{display:none!important;}

        .repair-grid{
            display:grid;
            grid-template-columns:repeat(3,1fr);
            gap:18px;
        }

        .repair-card{
            overflow:hidden;
            border:1px solid rgba(255,255,255,.1);
            border-radius:22px;
            background:#fff;
            box-shadow:0 20px 50px rgba(0,0,0,.14);
            transition:.3s ease;
        }

        .repair-card:hover{transform:translateY(-7px);}

        .repair-top{
            position:relative;
            min-height:156px;
            padding:27px;
            overflow:hidden;
            background:
                radial-gradient(circle at 90% 15%,rgba(69,212,131,.22),transparent 28%),
                linear-gradient(135deg,#11243d,#0c1727);
        }

        .repair-top h3{
            position:relative;
            z-index:1;
            margin-bottom:9px;
            font-size:1.35rem;
            letter-spacing:-.04em;
        }

        .repair-top p,
        .repair-top small{
            position:relative;
            z-index:1;
            color:#aebfd0;
            line-height:1.55;
        }

        .repair-top small{display:inline-block;margin-top:8px;font-size:.72rem;}

        .repair-body{padding:24px;}

        .price-row{
            display:flex;
            justify-content:space-between;
            align-items:flex-start;
            gap:18px;
            padding:16px 0;
            border-bottom:1px solid var(--line);
        }

        .price-row:first-child{padding-top:0;}
        .price-row h4{margin-bottom:5px;font-size:.88rem;}
        .price-row p{color:var(--muted);font-size:.72rem;line-height:1.55;}
        .price-row strong{color:#139555;font-size:.9rem;white-space:nowrap;}

        .repair-btn{
            width:100%;
            min-height:50px;
            margin-top:20px;
            border:0;
            color:#06130c;
            background:linear-gradient(135deg,#7bf1ac,var(--primary));
            cursor:pointer;
        }

        .empty-state{
            grid-column:1/-1;
            padding:45px 24px;
            color:#9fb0c2;
            text-align:center;
            border:1px dashed rgba(255,255,255,.15);
            border-radius:18px;
            background:rgba(255,255,255,.03);
        }

        .comments-layout{
            display:grid;
            grid-template-columns:.75fr 1.25fr;
            align-items:center;
            gap:70px;
        }

        .comments-copy h2{
            max-width:500px;
            font-size:clamp(2.2rem,4.5vw,3.8rem);
            line-height:1.08;
            letter-spacing:-.06em;
        }

        .comments-copy>p{
            max-width:520px;
            margin:20px 0 28px;
            color:var(--muted);
            line-height:1.8;
        }

        .comments-highlight{
            display:flex;
            gap:14px;
            align-items:flex-start;
            padding:18px;
            border:1px solid #dfe7ef;
            border-radius:17px;
            background:#f8fafc;
        }

        .comments-highlight i{
            width:40px;height:40px;display:grid;place-items:center;flex:0 0 auto;
            border-radius:12px;color:#0d8247;background:#def8e8;
        }
        .comments-highlight strong{display:block;margin-bottom:4px;font-size:.85rem;}
        .comments-highlight span{color:var(--muted);font-size:.76rem;line-height:1.5;}

        .comments-slider{
            position:relative;
            min-width:0;
        }

        .comments-track{
            display:flex;
            gap:18px;
            overflow-x:auto;
            scroll-snap-type:x mandatory;
            scroll-behavior:smooth;
            padding:4px 2px 24px;
            scrollbar-width:none;
        }

        .comments-track::-webkit-scrollbar{display:none;}

        .comment-card{
            flex:0 0 min(86%, 430px);
            overflow:hidden;
            border:1px solid var(--line);
            border-radius:18px;
            background:white;
            box-shadow:0 12px 35px rgba(16,24,40,.05);
            scroll-snap-align:start;
        }

        .comment-image{
            height:235px;
            background:linear-gradient(135deg,#dbeafe,#ecfdf5);
        }

        .comment-image img{
            width:100%;
            height:100%;
            object-fit:cover;
        }

        .comment-image-empty{
            height:100%;
            display:grid;
            place-items:center;
            color:#2563eb;
            font-size:3rem;
        }

        .comment-body{
            padding:22px;
        }

        .comment-stars{
            display:flex;
            gap:3px;
            color:#f59e0b;
            margin-bottom:14px;
        }

        .comment-text{
            min-height:92px;
            color:#334155;
            font-size:.98rem;
            line-height:1.75;
        }

        .comment-meta{
            display:flex;
            align-items:center;
            justify-content:space-between;
            gap:14px;
            margin-top:20px;
            padding-top:18px;
            border-top:1px solid #e5e7eb;
        }

        .comment-customer{
            min-width:0;
        }

        .comment-customer strong{
            display:block;
            color:#0f172a;
            font-size:.92rem;
            white-space:nowrap;
            overflow:hidden;
            text-overflow:ellipsis;
        }

        .comment-customer span{
            display:block;
            color:var(--muted);
            font-size:.74rem;
            white-space:nowrap;
            overflow:hidden;
            text-overflow:ellipsis;
        }

        .comment-device{
            flex:0 0 auto;
            max-width:150px;
            padding:7px 10px;
            color:#075985;
            background:#e0f2fe;
            border-radius:999px;
            font-size:.72rem;
            font-weight:800;
            white-space:nowrap;
            overflow:hidden;
            text-overflow:ellipsis;
        }

        .comment-controls{
            display:flex;
            align-items:center;
            gap:10px;
            margin-top:10px;
        }

        .comment-control{
            width:44px;
            height:44px;
            display:grid;
            place-items:center;
            border:1px solid #dfe7ef;
            border-radius:13px;
            color:#0f172a;
            background:white;
            cursor:pointer;
            transition:.2s ease;
        }

        .comment-control:hover{
            color:#06130c;
            background:#def8e8;
            border-color:#b7ebcc;
        }

        .comments-empty{
            padding:42px 28px;
            border:1px dashed #cbd5e1;
            border-radius:18px;
            color:var(--muted);
            background:#f8fafc;
            text-align:center;
            line-height:1.7;
        }

        .footer{
            padding:34px 0;
            color:#8fa1b5;
            background:#06101d;
            border-top:1px solid rgba(255,255,255,.08);
        }

        .footer-inner{
            display:flex;
            align-items:center;
            justify-content:space-between;
            gap:20px;
            font-size:.78rem;
        }

        .footer-brand{display:flex;align-items:center;gap:10px;color:white;font-weight:800;}
        .footer-brand .logo-mark{width:34px;height:34px;border-radius:10px;}

        [data-reveal]{
            opacity:0;
            transform:translateY(28px);
            transition:opacity .7s ease,transform .7s cubic-bezier(.2,.7,.2,1);
        }

        [data-reveal].revealed{
            opacity:1;
            transform:none;
        }

        @media(max-width:1050px){
            .nav-links{display:none;}
            .hero-inner{grid-template-columns:1fr;gap:40px;padding-top:150px;}
            .hero-left{text-align:center;}
            .hero-left h1,.hero-left>p{margin-inline:auto;}
            .hero-buttons,.trust-row{justify-content:center;}
            .hero-visual{min-height:530px;}
            .services-grid{grid-template-columns:repeat(2,1fr);}
            .repair-grid{grid-template-columns:repeat(2,1fr);}
            .comments-layout{grid-template-columns:1fr;gap:42px;}
            .comments-copy{text-align:center;}
            .comments-copy h2,.comments-copy>p{margin-inline:auto;}
            .comments-highlight{max-width:560px;margin-inline:auto;text-align:left;}
        }

        @media(max-width:760px){
            .container,.hero-inner,.navbar{width:min(100% - 28px,1180px);}
            .navbar{inset:10px 0 auto;padding:10px 11px 10px 14px;flex-wrap:wrap;}
            .nav-toggle{display:grid;place-items:center;margin-left:auto;}
            .nav-auth-group{
                display:none;
                order:3;
                width:100%;
                padding-top:10px;
                grid-template-columns:1fr 1fr;
            }
            .navbar.nav-open .nav-auth-group{display:grid;}
            .nav-btn{width:100%;}
            .hero-inner{padding:135px 0 75px;}
            .hero-left h1{font-size:clamp(2.7rem,13vw,4rem);}
            .hero-visual{min-height:450px;}
            .dashboard-card{transform:none;padding:13px;border-radius:22px;animation:mobileFloat 5s ease-in-out infinite;}
            @keyframes mobileFloat{50%{transform:translateY(-10px);}}
            .repair-preview{padding:16px;}
            .device-panel{grid-template-columns:105px 1fr;gap:12px;}
            .device-image{min-height:156px;}
            .metric{padding:9px;gap:8px;}
            .metric-icon{width:32px;height:32px;}
            .float-one{right:-3px;top:20px;}
            .float-two{left:-3px;bottom:14px;}
            .floating-card{padding:10px 12px;}
            .section{padding:78px 0;}
            .services-grid,.repair-grid{grid-template-columns:1fr;}
            .pricing-shell{padding:14px;border-radius:22px;}
            .comment-card{flex-basis:88%;}
            .footer-inner{flex-direction:column;text-align:center;}
        }

        @media(max-width:520px){
            .logo span small{display:none;}
            .nav-auth-group{grid-template-columns:1fr;}
            .hero-buttons{flex-direction:column;}
            .hero-btn{width:100%;}
            .trust-row{gap:12px;flex-direction:column;align-items:center;}
            .hero-visual{min-height:410px;}
            .preview-head{flex-direction:column;}
            .device-panel{grid-template-columns:1fr;}
            .device-image{display:none;}
            .timeline-mini small{font-size:.52rem;}
            .floating-card{display:none;}
            .service-card{min-height:285px;}
            .category-tabs{justify-content:flex-start;overflow-x:auto;flex-wrap:nowrap;scrollbar-width:none;}
            .category-tabs::-webkit-scrollbar{display:none;}
            .tab-btn{white-space:nowrap;}
            .price-row{flex-direction:column;gap:8px;}
        }

        @media(prefers-reduced-motion:reduce){
            *,*::before,*::after{animation-duration:.01ms!important;animation-iteration-count:1!important;scroll-behavior:auto!important;transition-duration:.01ms!important;}
            [data-reveal]{opacity:1;transform:none;}
        }

        /* Light portfolio theme */
        :root{
            --bg:#edf7f4;
            --bg-soft:#f7fbfa;
            --surface:#ffffff;
            --surface-soft:#f4f9f8;
            --text:#172033;
            --muted:#66758c;
            --line:#dfe8f2;
            --primary:#35bd78;
            --primary-dark:#128451;
            --blue:#4f7fe8;
            --purple:#8a65ff;
            --cyan:#22b8c9;
            --orange:#f5a83d;
            --shadow:0 22px 60px rgba(61,82,112,.12);
        }

        body{
            background:#f4f9f8;
        }

        .navbar{
            color:var(--text);
            background:rgba(255,255,255,.86);
            border-color:rgba(207,220,235,.9);
            box-shadow:0 14px 45px rgba(61,82,112,.12);
        }

        .navbar.scrolled{
            background:rgba(255,255,255,.96);
        }

        .logo span small,
        .nav-links a{
            color:#66758c;
        }

        .nav-links a:hover{
            color:#172033;
        }

        .btn-staff{
            color:#31517d;
            border-color:#cad8e8;
            background:#f4f8fd;
        }

        .nav-toggle{
            color:#233650;
            border-color:#d6e1ec;
            background:#f5f8fc;
        }

        .hero{
            min-height:760px;
            color:var(--text);
            background:
                radial-gradient(circle at 78% 25%,rgba(79,127,232,.15),transparent 31%),
                radial-gradient(circle at 20% 78%,rgba(53,189,120,.14),transparent 30%),
                linear-gradient(135deg,#fbfefd 0%,#edf6ff 55%,#f2fbf6 100%);
        }

        .hero::before{
            opacity:.55;
            background-image:
                linear-gradient(rgba(75,108,145,.07) 1px,transparent 1px),
                linear-gradient(90deg,rgba(75,108,145,.07) 1px,transparent 1px);
        }

        .hero-inner{
            padding:136px 0 76px;
        }

        .eyebrow{
            color:#3a5878;
            border-color:#d7e3ef;
            background:rgba(255,255,255,.72);
        }

        .hero-left h1{
            font-size:clamp(2.75rem,5.6vw,5rem);
        }

        .hero-left>p{
            margin:24px 0 30px;
            color:#5f7189;
        }

        .gradient-text{
            background:linear-gradient(90deg,#15985a 0%,#2784d8 55%,#7256db 100%);
            background-clip:text;
            -webkit-background-clip:text;
        }

        .btn-white{
            color:#26415f;
            border-color:#ccd9e7;
            background:rgba(255,255,255,.78);
        }

        .trust-row{
            color:#53677f;
            margin-top:30px;
        }

        .dashboard-card{
            border-color:rgba(188,205,223,.9);
            background:linear-gradient(145deg,rgba(255,255,255,.94),rgba(239,246,253,.82));
            box-shadow:0 32px 80px rgba(68,92,122,.18);
        }

        .window-dots span{
            background:#c6d4e3;
        }

        .window-title{
            color:#74869c;
        }

        .floating-card{
            border-color:#e1e9f1;
            box-shadow:0 18px 45px rgba(68,92,122,.16);
        }

        .section-dark{
            color:var(--text);
            background:linear-gradient(180deg,#eef6ff 0%,#f8fbff 100%);
        }

        .section-dark .section-kicker{
            color:var(--primary-dark);
        }

        .section-dark .section-heading p{
            color:var(--muted);
        }

        .pricing-shell{
            border-color:#dbe6f1;
            background:rgba(255,255,255,.76);
            box-shadow:0 24px 70px rgba(61,82,112,.10);
        }

        .category-tabs{
            border-color:#dbe6f1;
            background:#f2f7fc;
        }

        .tab-btn{
            color:#60738b;
        }

        .tab-btn.active,
        .tab-btn:hover{
            color:#0c4428;
        }

        .repair-card{
            border-color:#dfe8f2;
            box-shadow:0 18px 45px rgba(61,82,112,.10);
        }

        .repair-top{
            background:
                radial-gradient(circle at 90% 15%,rgba(57,199,122,.18),transparent 28%),
                linear-gradient(135deg,#f1f7ff,#e7f1fb);
        }

        .repair-top h3{
            color:#1b2d44;
        }

        .repair-top p,
        .repair-top small{
            color:#60738b;
        }

        .empty-state{
            color:#66758c;
            border-color:#ccd9e7;
            background:#f8fbfe;
        }

        .footer{
            background:#eaf2fa;
            color:#61738a;
            border-top:1px solid #d9e4ef;
        }

        .footer-brand{
            color:#223650;
        }

        .repair-search-wrap{
            position:absolute;
            right:8px;
            top:50%;
            z-index:2;
            width:48px;
            min-width:48px;
            transform:translateY(-50%);
            transition:width .3s ease;
        }

        .repair-search-wrap.expanded{
            width:min(360px, calc(100% - 16px));
            min-width:260px;
        }

        .repair-search{
            min-height:48px;
            display:flex;
            align-items:center;
            justify-content:center;
            gap:0;
            padding:0;
            border:1px solid #d6e2ee;
            border-radius:17px;
            background:#fff;
            box-shadow:0 12px 35px rgba(61,82,112,.09);
            overflow:hidden;
            cursor:pointer;
            transition:border-color .2s ease,box-shadow .2s ease,transform .2s ease,padding .3s ease;
        }

        .repair-search-wrap.expanded .repair-search{
            justify-content:flex-start;
            gap:13px;
            padding:0 14px 0 20px;
            cursor:text;
        }

        .repair-search:focus-within{
            border-color:#71d9a3;
            box-shadow:0 0 0 5px rgba(57,199,122,.11),0 16px 40px rgba(61,82,112,.12);
            transform:translateY(-1px);
        }

        .repair-search>i{
            flex:0 0 auto;
            color:#63809d;
            font-size:1.08rem;
        }

        .repair-search input{
            width:0;
            min-width:0;
            opacity:0;
            pointer-events:none;
            border:0;
            outline:0;
            color:#172033;
            background:transparent;
            font:inherit;
            font-size:.94rem;
            transition:width .3s ease,opacity .18s ease;
        }

        .repair-search-wrap.expanded .repair-search input{
            width:100%;
            opacity:1;
            pointer-events:auto;
        }

        .repair-search input::placeholder{
            color:#94a3b5;
        }

        .clear-search{
            width:38px;
            height:38px;
            display:none;
            place-items:center;
            flex:0 0 auto;
            border:0;
            border-radius:11px;
            color:#60738b;
            background:#eef4fa;
            cursor:pointer;
        }

        .clear-search.visible{
            display:grid;
        }

        .search-status{
            min-height:22px;
            margin:-8px 0 14px;
            color:#526a84;
            text-align:center;
            font-size:.78rem;
            font-weight:700;
        }

        .search-empty{
            display:flex;
            flex-direction:column;
            align-items:center;
            gap:7px;
            margin-top:18px;
        }

        .search-empty i{
            font-size:1.7rem;
            color:#6f87a1;
        }

        .search-empty strong{
            color:#273c55;
        }

        .search-empty span{
            font-size:.78rem;
        }

        .repair-card.search-hidden{
            display:none!important;
        }

        .device-category.search-mode{
            display:block!important;
            margin-top:18px;
        }

        .device-category.search-mode .repair-grid:empty{
            display:none;
        }

        @media(max-width:900px){
            .navbar.nav-open .nav-links,
            .navbar.nav-open .nav-auth-group{
                background:rgba(255,255,255,.98);
            }

            .hero{
                min-height:auto;
            }

            .hero-inner{
                padding:125px 0 65px;
            }

            .category-tabs{
                flex-wrap:wrap;
            }

            .repair-search-wrap{
                position:static;
                width:48px;
                transform:none;
                margin-left:auto;
            }

            .repair-search-wrap.expanded{
                width:100%;
                order:-1;
                margin-left:0;
            }
        }

        @media(max-width:600px){
            .hero-inner{
                padding-top:112px;
            }

            .repair-search{
                min-height:56px;
                padding-left:16px;
            }
        }

    </style>
</head>
<body>

<nav class="navbar" aria-label="Main navigation">
    <a href="#about" class="logo">
        <span class="logo-mark"><i class="bi bi-tools"></i></span>
        <span>AkieRepair<small>Service Management</small></span>
    </a>

    <button type="button" class="nav-toggle" aria-label="Open navigation menu" aria-expanded="false">
        <i class="bi bi-list"></i>
    </button>

    <div class="nav-links">
        <a href="#about">About Us</a>
        <a href="#services">Services</a>
        <a href="#pricing">Repair Prices</a>
        <a href="#process">Comments</a>
    </div>

    <div class="nav-auth-group">
        <a href="{{ route('login') }}?role=customer" class="nav-btn btn-customer">
            <i class="bi bi-person"></i> Customer Login
        </a>
        <a href="{{ route('login') }}?role=staff" class="nav-btn btn-staff">
            <i class="bi bi-shield-lock"></i> Staff Login
        </a>
    </div>
</nav>

<header class="hero" id="about">
    <span class="orb orb-one"></span>
    <span class="orb orb-two"></span>

    <div class="hero-inner">
        <div class="hero-left" data-reveal>
            <div class="eyebrow"><span class="eyebrow-dot"></span> About AkieRepair Enterprise</div>
            <h1>Reliable repairs, managed in <span class="gradient-text">one simple platform.</span></h1>
            <p>
                AkieRepair Enterprise is a company gather all specialist technicians that are experts in their field to help you in repairing your devices. 
                smarthpones, televisions, refrigerators, washing machines and other home appliances name it all. 
                This website will help you navigate through the process of booking a repair, tracking the progress and getting your device back in working condition.
            </p>

            <div class="hero-buttons">
                @guest
                    <a href="{{ route('login') }}" class="hero-btn btn-green">
                        Book a Repair <i class="bi bi-arrow-up-right"></i>
                    </a>
                @endguest

                @auth
                    <a href="{{ route('customer.booking.create') }}" class="hero-btn btn-green">
                        Book a Repair <i class="bi bi-arrow-up-right"></i>
                    </a>
                @endauth

                <a href="#pricing" class="hero-btn btn-white">
                    Explore Pricing <i class="bi bi-chevron-down"></i>
                </a>
            </div>

            <div class="trust-row">
                <span><i class="bi bi-check-circle-fill"></i> Centralised booking</span>
                <span><i class="bi bi-check-circle-fill"></i> Transparent progress</span>
                <span><i class="bi bi-check-circle-fill"></i> Skilled technicians</span>
            </div>
        </div>

        <div class="hero-visual" data-reveal>
            <div class="dashboard-card">
                <div class="window-bar">
                    <div class="window-dots"><span></span><span></span><span></span></div>
                    <div class="window-title">AkieRepair customer portal</div>
                </div>

                <div class="repair-preview">
                    <div class="preview-head">
                        <div>
                            <small>Active repair request</small>
                            <h3>Samsung Smart TV</h3>
                        </div>
                        <span class="status-pill"><i class="bi bi-circle-fill"></i> In progress</span>
                    </div>

                    <div class="device-panel">
                        <div class="device-image">
                            <img src="https://images.unsplash.com/photo-1581092918056-0c4c3acd3789?q=80&w=700" alt="Technician repairing an electronic device">
                        </div>

                        <div class="metric-stack">
                            <div class="metric">
                                <span class="metric-icon"><i class="bi bi-person-check"></i></span>
                                <div><small>Technician</small><strong>Assigned</strong></div>
                            </div>
                            <div class="metric">
                                <span class="metric-icon"><i class="bi bi-file-earmark-text"></i></span>
                                <div><small>Quotation</small><strong>Approved</strong></div>
                            </div>
                            <div class="metric">
                                <span class="metric-icon"><i class="bi bi-clock-history"></i></span>
                                <div><small>Estimated update</small><strong>Today</strong></div>
                            </div>
                        </div>
                    </div>

                    <div class="timeline-mini">
                        <div class="mini-step"><span><i class="bi bi-check"></i></span><small>Booked</small></div>
                        <div class="mini-step"><span><i class="bi bi-check"></i></span><small>Inspected</small></div>
                        <div class="mini-step"><span><i class="bi bi-tools"></i></span><small>Repairing</small></div>
                        <div class="mini-step pending"><span><i class="bi bi-box-seam"></i></span><small>Complete</small></div>
                    </div>
                </div>
            </div>

            <div class="floating-card float-one">
                <i class="bi bi-bell"></i>
                <div><small>New update</small><strong>Repair status changed</strong></div>
            </div>

            <div class="floating-card float-two">
                <i class="bi bi-shield-check"></i>
                <div><small>Service guarantee</small><strong>Secure quotation approval</strong></div>
            </div>
        </div>
    </div>
</header>

<section class="section section-white" id="services">
    <div class="container">
        <div class="section-heading" data-reveal>
            <span class="section-kicker">Repair expertise</span>
            <h2>One platform for every device you depend on.</h2>
            <p>From personal electronics to essential home appliances, AkieRepair provides a structured and transparent repair experience.</p>
        </div>

        <div class="services-grid">
            <article class="service-card phone" data-reveal>
                <div class="service-icon"><i class="bi bi-phone"></i></div>
                <h3>Smartphone Repair</h3>
                <p>Battery replacement, LCD repair, charging port repair and other common mobile device issues.</p>
                <span class="service-link">Explore service <i class="bi bi-arrow-right"></i></span>
            </article>

            <article class="service-card tv" data-reveal>
                <div class="service-icon"><i class="bi bi-tv"></i></div>
                <h3>Television Repair</h3>
                <p>Professional diagnosis for display, sound, LED backlight and power supply problems.</p>
                <span class="service-link">Explore service <i class="bi bi-arrow-right"></i></span>
            </article>

            <article class="service-card fridge" data-reveal>
                <div class="service-icon"><i class="bi bi-snow"></i></div>
                <h3>Refrigerator Repair</h3>
                <p>Cooling system checks, compressor inspection, gas refill and preventive maintenance.</p>
                <span class="service-link">Explore service <i class="bi bi-arrow-right"></i></span>
            </article>

            <article class="service-card washer" data-reveal>
                <div class="service-icon"><i class="bi bi-water"></i></div>
                <h3>Washing Machine Repair</h3>
                <p>Solutions for water leakage, motor faults, spinning issues and electronic board repair.</p>
                <span class="service-link">Explore service <i class="bi bi-arrow-right"></i></span>
            </article>
        </div>
    </div>
</section>

<section class="section section-dark" id="pricing">
    <div class="container">
        <div class="section-heading" data-reveal>
            <span class="section-kicker">Transparent pricing</span>
            <h2>Review repair options before you book.</h2>
            <p>Choose a device category to view available models, estimated repair duration, warranty information and pricing.</p>
        </div>

        <div class="pricing-shell" data-reveal>
            <div class="category-tabs" role="group" aria-label="Device category filters and search">
                <button type="button" onclick="showCategory('Smartphone', this)" class="tab-btn active">Smartphone</button>
                <button type="button" onclick="showCategory('Television', this)" class="tab-btn">Television</button>
                <button type="button" onclick="showCategory('Refrigerator', this)" class="tab-btn">Refrigerator</button>
                <button type="button" onclick="showCategory('Washing Machine', this)" class="tab-btn">Washing Machine</button>
                <div class="repair-search-wrap">
                    <label class="repair-search" for="repairSearch">
                        <i class="bi bi-search" aria-hidden="true"></i>
                        <input
                            type="search"
                            id="repairSearch"
                            placeholder="Search device, brand, model or repair type..."
                            autocomplete="off"
                            aria-label="Search repair prices"
                        >
                        <button type="button" id="clearRepairSearch" class="clear-search" aria-label="Clear repair search">
                            <i class="bi bi-x-lg"></i>
                        </button>
                    </label>
                </div>
            </div>

            <div id="repairSearchStatus" class="search-status" aria-live="polite"></div>

            @foreach(['Smartphone', 'Television', 'Refrigerator', 'Washing Machine'] as $type)
                <div class="device-category {{ $type == 'Smartphone' ? '' : 'hide' }}" id="{{ str_replace(' ', '', $type) }}">
                    <div class="repair-grid">
                        @forelse($devices->where('type', $type) as $device)
                            <article class="repair-card">
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
                                                <p>{{ $repair->warranty_period ?? 'No warranty info' }} • {{ $repair->duration ?? '-' }}</p>
                                            </div>
                                            <strong>RM {{ number_format($repair->price, 2) }}</strong>
                                        </div>
                                    @empty
                                        <p>No repair price available yet.</p>
                                    @endforelse

                                    @guest
                                        <a href="{{ route('login') }}" class="repair-btn">Book This Repair <i class="bi bi-arrow-right"></i></a>
                                    @endguest

                                    @auth
                                        <a href="{{ route('customer.booking.create') }}" class="repair-btn">Book This Repair <i class="bi bi-arrow-right"></i></a>
                                    @endauth
                                </div>
                            </article>
                        @empty
                            <div class="empty-state">No {{ $type }} devices available.</div>
                        @endforelse
                    </div>
                </div>
            @endforeach

            <div class="empty-state search-empty hide" id="repairSearchEmpty">
                <i class="bi bi-search"></i>
                <strong>No matching repair price found.</strong>
                <span>Try another device name, brand, model or repair type.</span>
            </div>
        </div>
    </div>
</section>

<section class="section section-white" id="process">
    <div class="container comments-layout">
        <div class="comments-copy" data-reveal>
            <span class="section-kicker">Customer comments</span>
            <h2>Real feedback from completed repair services.</h2>
            <p>After payment, customers can rate their repair experience and leave a comment. Approved completed bookings appear here with the finished repair photo from the technician update.</p>

            <div class="comments-highlight">
                <i class="bi bi-star-fill"></i>
                <div>
                    <strong>{{ $reviews->count() }} service {{ $reviews->count() === 1 ? 'comment' : 'comments' }}</strong>
                    <span>Ratings are connected to paid, completed bookings so visitors can see genuine service feedback.</span>
                </div>
            </div>
        </div>

        <div class="comments-slider" data-reveal>
            @if($reviews->count())
                <div class="comments-track" id="commentsTrack" aria-label="Customer review slider">
                    @foreach($reviews as $review)
                        @php
                            $booking = $review->booking;
                            $finishedImage = optional($booking?->timelines?->first())->image;
                            $deviceLabel = trim(($booking?->device?->brand ?? '') . ' ' . ($booking?->device?->name ?? 'Device'));
                        @endphp

                        <article class="comment-card">
                            <div class="comment-image">
                                @if($finishedImage)
                                    <img src="{{ str_starts_with($finishedImage, 'http') ? $finishedImage : asset($finishedImage) }}" alt="Finished repair proof for {{ $deviceLabel }}">
                                @else
                                    <div class="comment-image-empty"><i class="bi bi-tools"></i></div>
                                @endif
                            </div>

                            <div class="comment-body">
                                <div class="comment-stars" aria-label="{{ $review->rating }} out of 5 stars">
                                    @for($i = 1; $i <= 5; $i++)
                                        <i class="bi {{ $i <= $review->rating ? 'bi-star-fill' : 'bi-star' }}"></i>
                                    @endfor
                                </div>

                                <p class="comment-text">"{{ $review->comment }}"</p>

                                <div class="comment-meta">
                                    <div class="comment-customer">
                                        <strong>{{ $review->customer->name ?? 'Customer' }}</strong>
                                        <span>Technician: {{ $booking?->technician?->name ?? 'AkieRepair team' }}</span>
                                    </div>
                                    <span class="comment-device">{{ $deviceLabel ?: 'Repair service' }}</span>
                                </div>
                            </div>
                        </article>
                    @endforeach
                </div>

                <div class="comment-controls" aria-label="Review slider controls">
                    <button type="button" class="comment-control" id="commentPrev" aria-label="Previous comment">
                        <i class="bi bi-chevron-left"></i>
                    </button>
                    <button type="button" class="comment-control" id="commentNext" aria-label="Next comment">
                        <i class="bi bi-chevron-right"></i>
                    </button>
                </div>
            @else
                <div class="comments-empty">
                    Customer comments will appear here after paid repair bookings are reviewed.
                </div>
            @endif
        </div>
    </div>
</section>

<footer class="footer">
    <div class="container footer-inner">
        <div class="footer-brand"><span class="logo-mark"><i class="bi bi-tools"></i></span> AkieRepair Enterprise</div>
        <p>© 2026 AkieRepair Enterprise. All Rights Reserved.</p>
        <p>Professional device & appliance repair management.</p>
    </div>
</footer>

<script>
    const mainNavbar = document.querySelector('.navbar');
    const navToggle = document.querySelector('.nav-toggle');

    if (navToggle && mainNavbar) {
        navToggle.addEventListener('click', function () {
            const isOpen = mainNavbar.classList.toggle('nav-open');
            navToggle.setAttribute('aria-expanded', isOpen ? 'true' : 'false');
            navToggle.innerHTML = isOpen ? '<i class="bi bi-x-lg"></i>' : '<i class="bi bi-list"></i>';
        });

        document.querySelectorAll('.nav-links a, .nav-auth-group a').forEach(function (link) {
            link.addEventListener('click', function () {
                mainNavbar.classList.remove('nav-open');
                navToggle.setAttribute('aria-expanded', 'false');
                navToggle.innerHTML = '<i class="bi bi-list"></i>';
            });
        });
    }

    window.addEventListener('scroll', function () {
        if (mainNavbar) mainNavbar.classList.toggle('scrolled', window.scrollY > 30);
    }, { passive: true });

    function showCategory(type, button) {
        const searchInput = document.getElementById('repairSearch');

        if (searchInput && searchInput.value.trim()) {
            searchInput.value = '';
            applyRepairSearch('');
        }

        document.querySelectorAll('.device-category').forEach(function (section) {
            section.classList.remove('search-mode');
            section.classList.add('hide');
        });

        const targetSection = document.getElementById(type.replaceAll(' ', ''));
        if (targetSection) targetSection.classList.remove('hide');

        document.querySelectorAll('.tab-btn').forEach(function (btn) {
            btn.classList.remove('active');
        });

        button.classList.add('active');
    }

    const repairSearch = document.getElementById('repairSearch');
    const repairSearchWrap = document.querySelector('.repair-search-wrap');
    const clearRepairSearch = document.getElementById('clearRepairSearch');
    const repairSearchStatus = document.getElementById('repairSearchStatus');
    const repairSearchEmpty = document.getElementById('repairSearchEmpty');

    function applyRepairSearch(rawQuery) {
        const query = rawQuery.trim().toLowerCase();
        const categories = document.querySelectorAll('.device-category');
        const cards = document.querySelectorAll('.repair-card');
        let matches = 0;

        if (!query) {
            cards.forEach(function (card) {
                card.classList.remove('search-hidden');
            });

            categories.forEach(function (section, index) {
                section.classList.remove('search-mode');
                section.classList.toggle('hide', index !== 0);
            });

            document.querySelectorAll('.tab-btn').forEach(function (btn, index) {
                btn.classList.toggle('active', index === 0);
            });

            if (repairSearchStatus) repairSearchStatus.textContent = '';
            if (repairSearchEmpty) repairSearchEmpty.classList.add('hide');
            if (clearRepairSearch) clearRepairSearch.classList.remove('visible');
            return;
        }

        categories.forEach(function (section) {
            section.classList.remove('hide');
            section.classList.add('search-mode');
        });

        cards.forEach(function (card) {
            const isMatch = card.textContent.toLowerCase().includes(query);
            card.classList.toggle('search-hidden', !isMatch);
            if (isMatch) matches++;
        });

        document.querySelectorAll('.tab-btn').forEach(function (btn) {
            btn.classList.remove('active');
        });
        if (clearRepairSearch) clearRepairSearch.classList.add('visible');
        if (repairSearchStatus) {
            repairSearchStatus.textContent = matches
                ? matches + (matches === 1 ? ' matching device found' : ' matching devices found')
                : '';
        }
        if (repairSearchEmpty) repairSearchEmpty.classList.toggle('hide', matches !== 0);
    }

    if (repairSearch) {
        repairSearch.addEventListener('focus', function () {
            if (repairSearchWrap) repairSearchWrap.classList.add('expanded');
        });

        repairSearch.addEventListener('input', function () {
            applyRepairSearch(this.value);
        });

        repairSearch.addEventListener('keydown', function (event) {
            if (event.key === 'Escape') {
                this.value = '';
                applyRepairSearch('');
                this.blur();
                if (repairSearchWrap) repairSearchWrap.classList.remove('expanded');
            }
        });
    }

    if (repairSearchWrap) {
        repairSearchWrap.addEventListener('click', function () {
            repairSearchWrap.classList.add('expanded');
            if (repairSearch) repairSearch.focus();
        });

        document.addEventListener('click', function (event) {
            if (!repairSearchWrap.contains(event.target) && repairSearch && !repairSearch.value.trim()) {
                repairSearchWrap.classList.remove('expanded');
            }
        });
    }

    if (clearRepairSearch) {
        clearRepairSearch.addEventListener('click', function () {
            if (!repairSearch) return;
            repairSearch.value = '';
            applyRepairSearch('');
            repairSearch.focus();
        });
    }

    const commentsTrack = document.getElementById('commentsTrack');
    const commentPrev = document.getElementById('commentPrev');
    const commentNext = document.getElementById('commentNext');

    function slideComments(direction) {
        if (!commentsTrack) return;

        const firstCard = commentsTrack.querySelector('.comment-card');
        const amount = firstCard ? firstCard.getBoundingClientRect().width + 18 : 420;
        commentsTrack.scrollBy({ left: amount * direction, behavior: 'smooth' });
    }

    if (commentPrev) commentPrev.addEventListener('click', function () {
        slideComments(-1);
    });

    if (commentNext) commentNext.addEventListener('click', function () {
        slideComments(1);
    });

    const revealObserver = new IntersectionObserver(function (entries) {
        entries.forEach(function (entry) {
            if (entry.isIntersecting) {
                entry.target.classList.add('revealed');
                revealObserver.unobserve(entry.target);
            }
        });
    }, { threshold: 0.12 });

    document.querySelectorAll('[data-reveal]').forEach(function (element, index) {
        element.style.transitionDelay = Math.min(index % 5, 4) * 70 + 'ms';
        revealObserver.observe(element);
    });
</script>
</body>
</html>
