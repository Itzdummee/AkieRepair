<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>Login - AkieRepair</title>
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.11.3/font/bootstrap-icons.min.css">
    <link href="https://fonts.googleapis.com/css2?family=Poppins:wght@300;400;500;600;700&display=swap" rel="stylesheet">
    
    <style>
        * {
            box-sizing: border-box;
            margin: 0;
            padding: 0;
        }

        body { 
            margin: 0; 
            padding: 0; 
            font-family: 'Poppins', sans-serif; 
            background: #f5f7fb; 
        }

        .auth-bg {
            min-height: 100vh;
            background: linear-gradient(135deg, #111827 0%, #1e3a8a 50%, #22c55e 100%);
            display: flex;
            align-items: center;
            justify-content: center;
            padding: 40px 20px;
        }

        .auth-card {
            width: 1000px;
            max-width: 100%;
            min-height: 600px;
            background: white;
            border-radius: 24px;
            display: grid;
            grid-template-columns: 1.1fr 0.9fr;
            overflow: hidden;
            box-shadow: 0 25px 50px -12px rgba(0, 0, 0, 0.25);
        }

        .auth-left {
            background: linear-gradient(135deg, #111827 0%, #1e3a8a 100%);
            padding: 60px;
            color: white;
            display: flex;
            flex-direction: column;
            justify-content: space-between;
            position: relative;
        }

        .auth-left::before {
            content: '';
            position: absolute;
            top: 0;
            left: 0;
            right: 0;
            bottom: 0;
            background: radial-gradient(circle at 80% 20%, rgba(34, 197, 94, 0.15) 0%, transparent 50%);
            pointer-events: none;
        }

        .brand-info .logo {
            font-size: 28px;
            font-weight: 700;
            letter-spacing: -0.5px;
            color: white;
        }

        .welcome-section {
            margin: 40px 0;
        }

        .welcome-section h1 {
            font-size: 38px;
            line-height: 1.2;
            font-weight: 700;
            margin-bottom: 20px;
            color: white;
        }

        .welcome-section p {
            font-size: 16px;
            line-height: 1.7;
            color: #d1d5db;
            font-weight: 300;
        }

        .feature-tags {
            display: flex;
            flex-direction: column;
            gap: 15px;
            z-index: 2;
        }

        .feature-tag {
            display: flex;
            align-items: center;
            gap: 12px;
            font-size: 15px;
            color: #e5e7eb;
        }

        .feature-tag i {
            color: #22c55e;
            font-size: 20px;
        }

        .auth-right {
            padding: 60px 50px;
            display: flex;
            flex-direction: column;
            justify-content: center;
            background: white;
        }

        .auth-form-container {
            width: 100%;
            max-width: 380px;
            margin: 0 auto;
        }

        .auth-form-container h2 {
            font-size: 28px;
            font-weight: 700;
            color: #111827;
            margin-bottom: 8px;
        }

        .auth-form-container p.subtitle {
            font-size: 14px;
            color: #6b7280;
            margin-bottom: 30px;
        }

        .input-box {
            position: relative;
            margin-bottom: 16px;
            width: 100%;
        }

        .input-box i {
            position: absolute;
            left: 16px;
            top: 50%;
            transform: translateY(-50%);
            color: #9ca3af;
            font-size: 18px;
            pointer-events: none;
            transition: color 0.2s;
        }

        .input-box input {
            width: 100%;
            height: 52px;
            padding: 0 16px 0 48px;
            border: 1px solid #e5e7eb;
            border-radius: 12px;
            outline: none;
            font-family: 'Poppins', sans-serif;
            font-size: 14px;
            color: #111827;
            background: #f9fafb;
            transition: border-color 0.2s, box-shadow 0.2s, background-color 0.2s;
        }

        .input-box.has-password-toggle input {
            padding-right: 48px;
        }

        .password-toggle {
            position: absolute;
            right: 8px;
            top: 50%;
            transform: translateY(-50%);
            width: 38px;
            height: 38px;
            display: grid;
            place-items: center;
            border: 0;
            border-radius: 9px;
            color: #64748b;
            background: transparent;
            cursor: pointer;
            transition: color .2s, background-color .2s;
        }

        .password-toggle i {
            position: static;
            transform: none;
            color: inherit;
            pointer-events: none;
        }

        .password-toggle:hover,
        .password-toggle:focus-visible {
            color: #15985a;
            background: #e7f8ef;
            outline: none;
        }

        .input-box input:focus {
            border-color: #22c55e;
            background-color: white;
            box-shadow: 0 0 0 4px rgba(34, 197, 94, 0.12);
        }

        .input-box input:focus + i {
            color: #22c55e;
        }

        .login-btn {
            width: 100%;
            height: 52px;
            border: none;
            border-radius: 12px;
            background: #22c55e;
            color: white;
            font-family: 'Poppins', sans-serif;
            font-weight: 600;
            font-size: 15px;
            cursor: pointer;
            transition: background-color 0.2s, transform 0.1s;
            margin-top: 10px;
            display: flex;
            align-items: center;
            justify-content: center;
        }

        .login-btn:hover {
            background: #16a34a;
        }

        .login-btn:active {
            transform: scale(0.98);
        }

        .home-btn {
            width: 100%;
            height: 52px;
            border: 1px solid #d1d5db;
            border-radius: 12px;
            background: transparent;
            color: #374151;
            font-family: 'Poppins', sans-serif;
            font-weight: 600;
            font-size: 15px;
            text-decoration: none;
            display: flex;
            align-items: center;
            justify-content: center;
            margin-top: 12px;
            transition: background-color 0.2s, border-color 0.2s;
        }

        .home-btn:hover {
            background: #f9fafb;
            border-color: #9ca3af;
        }

        .switch-link {
            display: block;
            margin: 25px auto 0;
            border: none;
            background: none;
            color: #22c55e;
            font-family: 'Poppins', sans-serif;
            font-size: 14px;
            font-weight: 600;
            cursor: pointer;
            transition: color 0.2s;
            text-align: center;
        }

        .switch-link:hover {
            color: #16a34a;
            text-decoration: underline;
        }

        .error-text {
            color: #ef4444;
            font-size: 14px;
            margin-bottom: 20px;
            background: #fee2e2;
            padding: 12px 16px;
            border-radius: 8px;
            text-align: left;
            border-left: 4px solid #ef4444;
            font-weight: 500;
        }

        .success-text {
            color: #16a34a;
            font-size: 14px;
            margin-bottom: 20px;
            background: #dcfce7;
            padding: 12px 16px;
            border-radius: 8px;
            text-align: left;
            border-left: 4px solid #16a34a;
            font-weight: 500;
        }

        .auth-toast {
            position: fixed;
            top: 22px;
            left: 50%;
            transform: translateX(-50%);
            z-index: 10000;
            width: min(460px, calc(100% - 32px));
            padding: 14px 18px;
            border-radius: 10px;
            color: #fff;
            font-size: 14px;
            font-weight: 600;
            line-height: 1.45;
            box-shadow: 0 16px 36px rgba(15, 23, 42, .22);
            display: flex;
            align-items: flex-start;
            gap: 10px;
            animation: authToastIn .25s ease-out both;
        }

        .auth-toast.success {
            background: #16a34a;
        }

        .auth-toast.error {
            background: #dc2626;
        }

        .auth-toast i {
            font-size: 18px;
            line-height: 1.4;
            flex-shrink: 0;
        }

        @keyframes authToastIn {
            from {
                opacity: 0;
                transform: translateX(-50%) translateY(-12px);
            }
            to {
                opacity: 1;
                transform: translateX(-50%) translateY(0);
            }
        }

        .hide {
            display: none !important;
        }

        @media(max-width: 900px) {
            .auth-card {
                grid-template-columns: 1fr;
                border-radius: 16px;
            }

            .auth-left {
                padding: 40px 30px;
                min-height: auto;
            }

            .welcome-section h1 {
                font-size: 28px;
            }

            .auth-right {
                padding: 40px 30px;
            }
        }

        @media(max-width: 560px) {
            .auth-bg {
                align-items: flex-start;
                padding: 16px;
            }

            .auth-card {
                min-height: auto;
                border-radius: 14px;
            }

            .auth-left {
                padding: 28px 22px;
                gap: 24px;
            }

            .brand-info .logo {
                font-size: 24px;
            }

            .welcome-section {
                margin: 20px 0;
            }

            .welcome-section h1 {
                font-size: 24px;
            }

            .welcome-section p,
            .feature-tag {
                font-size: 14px;
            }

            .auth-right {
                padding: 30px 20px;
            }

            .auth-form-container h2 {
                font-size: 24px;
            }

            .input-box input,
            .login-btn,
            .home-btn {
                height: 48px;
            }
        }

        :root {
            --ui-text: #0f172a;
            --ui-muted: #64748b;
            --ui-line: #e2e8f0;
            --ui-soft: #f8fafc;
            --ui-accent: #16a34a;
            --ui-blue: #2563eb;
        }

        body {
            color: var(--ui-text);
            text-rendering: optimizeLegibility;
        }

        .auth-bg {
            background:
                radial-gradient(circle at 82% 18%, rgba(79, 127, 232, .17), transparent 32%),
                radial-gradient(circle at 18% 82%, rgba(53, 189, 120, .16), transparent 30%),
                linear-gradient(135deg, #fbfefd 0%, #edf6ff 55%, #f2fbf6 100%);
            padding: clamp(22px, 5vw, 48px);
        }

        .auth-card {
            width: min(1000px, 100%);
            border: 1px solid #d6e2ee;
            border-radius: 22px;
            box-shadow: 0 28px 70px rgba(61, 82, 112, .18);
        }

        .auth-left {
            color: #172033;
            background: linear-gradient(145deg, #eaf3ff 0%, #f4fbff 52%, #e9faef 100%);
            border-right: 1px solid #dfe8f2;
        }

        .auth-left::before {
            background: radial-gradient(circle at 80% 20%, rgba(53, 189, 120, .16) 0%, transparent 52%);
        }

        .brand-info .logo,
        .welcome-section h1 {
            color: #172033;
        }

        .brand-info .logo {
            letter-spacing: 0;
        }

        .welcome-section h1,
        .auth-form-container h2 {
            letter-spacing: 0;
            line-height: 1.15;
        }

        .welcome-section h1 {
            font-size: clamp(1.8rem, 3.2vw, 2.45rem);
        }

        .welcome-section p {
            color: #5f7189;
        }

        .auth-form-container h2 {
            color: var(--ui-text);
            font-size: clamp(1.55rem, 2.2vw, 1.85rem);
        }

        .auth-form-container p.subtitle {
            color: var(--ui-muted);
            line-height: 1.55;
        }

        .feature-tag {
            color: #3a5878;
        }

        .feature-tag i {
            color: #15985a;
        }

        .input-box input {
            border-color: var(--ui-line);
            border-radius: 10px;
            background: var(--ui-soft);
        }

        .input-box input:focus {
            border-color: var(--ui-accent);
            box-shadow: 0 0 0 4px rgba(22, 163, 74, .12);
        }

        .login-btn,
        .home-btn {
            border-radius: 10px;
            letter-spacing: 0;
        }

        .login-btn {
            background: var(--ui-accent);
        }

        .login-btn:hover {
            background: #15803d;
        }

        .home-btn {
            border-color: var(--ui-line);
            color: #334155;
            background: white;
        }

        .switch-link {
            color: var(--ui-accent);
        }

        .error-text,
        .success-text {
            border-radius: 10px;
            line-height: 1.45;
        }

        @media(max-width: 900px) {
            .auth-card {
                min-height: auto;
            }
        }

        @media(max-width: 560px) {
            .auth-bg {
                min-height: 100svh;
                padding: 14px;
            }

            .auth-card {
                border-radius: 16px;
            }

            .auth-left,
            .auth-right {
                padding: 28px 20px;
            }
        }
    </style>
</head>
<body>

@if(session('success'))
    <div class="auth-toast success" id="authToast">
        <i class="bi bi-check-circle-fill"></i>
        <span>{{ session('success') }}</span>
    </div>
@elseif($errors->any())
    <div class="auth-toast error" id="authToast">
        <i class="bi bi-exclamation-triangle-fill"></i>
        <span>{{ $errors->first() }}</span>
    </div>
@endif

<section class="auth-bg">

    <div class="auth-card">

        <div class="auth-left">
            <div class="brand-info">
                <div class="logo">AkieRepair</div>
            </div>
            
            @if(request('role') === 'staff')
                <div class="welcome-section">
                    <h1>AkieRepair Staff Portal</h1>
                    <p>Log in to manage bookings, coordinate technicians, update repair statuses, and service customers efficiently.</p>
                </div>
                
                <div class="feature-tags">
                    <div class="feature-tag">
                        <i class="bi bi-briefcase"></i>
                        <span>Manage Bookings & Jobs</span>
                    </div>
                    <div class="feature-tag">
                        <i class="bi bi-wrench-adjustable"></i>
                        <span>Update Diagnostic Progress</span>
                    </div>
                    <div class="feature-tag">
                        <i class="bi bi-people"></i>
                        <span>Staff Coordination System</span>
                    </div>
                </div>
            @else
                <div class="welcome-section">
                    <h1>Professional Device & Appliance Repair</h1>
                    <p>Access your portal to view repair status, get instant pricing, and coordinate bookings with expert technicians.</p>
                </div>
                
                <div class="feature-tags">
                    <div class="feature-tag">
                        <i class="bi bi-patch-check"></i>
                        <span>Trusted & Certified Technicians</span>
                    </div>
                    <div class="feature-tag">
                        <i class="bi bi-lightning-charge"></i>
                        <span>Instant Price Estimations</span>
                    </div>
                    <div class="feature-tag">
                        <i class="bi bi-clock-history"></i>
                        <span>Real-time Timeline Tracking</span>
                    </div>
                </div>
            @endif
        </div>

        <div class="auth-right">
            <div class="auth-form-container">

                <div id="loginForm">
                    @if(request('role') === 'staff')
                        <h2>Staff Login</h2>
                        <p class="subtitle">Enter your credentials to access your staff portal</p>
                    @else
                        <h2>Customer Login</h2>
                        <p class="subtitle">Enter your credentials to access your account</p>
                    @endif

                    

                    @error('email')
                        <p class="error-text">{{ $message }}</p>
                    @enderror

                    <form method="POST" action="{{ route('login.store', ['role' => request('role')]) }}" autocomplete="off">
                        @csrf

                        <div class="input-box">
                            <i class="bi bi-envelope"></i>
                            <input type="email" name="email" placeholder="Email Address" required>
                        </div>

                        <div class="input-box has-password-toggle">
                            <i class="bi bi-lock"></i>
                            <input type="password" name="password" placeholder="Password" required>
                            <button type="button" class="password-toggle" aria-label="Show password" aria-pressed="false" title="Show password">
                                <i class="bi bi-eye"></i>
                            </button>
                        </div>

                        <button type="submit" class="login-btn">
                            Login
                        </button>
                        
                        <a href="{{ route('customer.home') }}" class="home-btn">
                            Back to Home
                        </a>
                    </form>

                    @if(request('role') !== 'staff')
                        <button class="switch-link" onclick="showRegister()">
                            Create your Account →
                        </button>
                    @endif
                </div>

                @if(request('role') !== 'staff')
                    <div id="registerForm" class="hide">
                        <h2>Create Account</h2>
                        <p class="subtitle">Join AkieRepair and schedule your repairs today</p>

                        <form method="POST" action="{{ route('register.store', ['role' => request('role')]) }}">
                            @csrf

                            <div class="input-box">
                                <i class="bi bi-person"></i>
                                <input type="text" name="name" placeholder="Full Name" required>
                            </div>

                            <div class="input-box">
                                <i class="bi bi-envelope"></i>
                                <input type="email" name="email" placeholder="Email Address" required>
                            </div>

                            <div class="input-box">
                                <i class="bi bi-telephone"></i>
                                <input type="text" name="phone_number" placeholder="Phone Number (e.g. 601234567890)" maxlength="11" pattern="[0-9]{1,11}" title="Phone number must be between 1 and 11 digits containing only numbers" oninput="this.value = this.value.replace(/[^0-9]/g, '')">
                            </div>

                            <div class="input-box has-password-toggle">
                                <i class="bi bi-lock"></i>
                                <input type="password" name="password" placeholder="Password" required>
                                <button type="button" class="password-toggle" aria-label="Show password" aria-pressed="false" title="Show password">
                                    <i class="bi bi-eye"></i>
                                </button>
                            </div>

                            <div class="input-box has-password-toggle">
                                <i class="bi bi-shield-lock"></i>
                                <input type="password" name="password_confirmation" placeholder="Confirm Password" required>
                                <button type="button" class="password-toggle" aria-label="Show password" aria-pressed="false" title="Show password">
                                    <i class="bi bi-eye"></i>
                                </button>
                            </div>

                            <button type="submit" class="login-btn">
                                Register
                            </button>
                        </form>

                        <button class="switch-link" onclick="showLogin()">
                            ← Back to Login
                        </button>
                    </div>
                @endif

            </div>
        </div>

    </div>

</section>

<script>
function showRegister(){
    document.getElementById('loginForm').classList.add('hide');
    document.getElementById('registerForm').classList.remove('hide');
}

function showLogin(){
    document.getElementById('registerForm').classList.add('hide');
    document.getElementById('loginForm').classList.remove('hide');
}

document.addEventListener('DOMContentLoaded', function(){
    document.querySelectorAll('.password-toggle').forEach(function(button){
        button.addEventListener('click', function(){
            const input = button.parentElement.querySelector('input');
            const isVisible = input.type === 'text';
            input.type = isVisible ? 'password' : 'text';
            button.setAttribute('aria-label', isVisible ? 'Show password' : 'Hide password');
            button.setAttribute('aria-pressed', String(!isVisible));
            button.setAttribute('title', isVisible ? 'Show password' : 'Hide password');
            button.querySelector('i').className = isVisible ? 'bi bi-eye' : 'bi bi-eye-slash';
        });
    });

    const toast = document.getElementById('authToast');
    if(toast) {
        setTimeout(function(){
            toast.style.transition = 'opacity .35s ease, transform .35s ease';
            toast.style.opacity = '0';
            toast.style.transform = 'translateX(-50%) translateY(-12px)';
            setTimeout(function(){ toast.remove(); }, 350);
        }, 4200);
    }

    @if($errors->has('name') || $errors->has('phone_number') || $errors->has('password') || old('name') || old('phone_number'))
        if(document.getElementById('registerForm')) {
            showRegister();
        }
    @endif
});
</script>

</body>
</html>
