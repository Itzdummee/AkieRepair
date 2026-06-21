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
    </style>
</head>
<body>

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

                        <div class="input-box">
                            <i class="bi bi-lock"></i>
                            <input type="password" name="password" placeholder="Password" required>
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

                            <div class="input-box">
                                <i class="bi bi-lock"></i>
                                <input type="password" name="password" placeholder="Password" required>
                            </div>

                            <div class="input-box">
                                <i class="bi bi-shield-lock"></i>
                                <input type="password" name="password_confirmation" placeholder="Confirm Password" required>
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
</script>

</body>
</html>