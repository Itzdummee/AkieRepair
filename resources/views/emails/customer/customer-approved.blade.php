<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Account Approved - AkieRepair Enterprise</title>
    <style>
        body {
            font-family: 'Segoe UI', Tahoma, Geneva, Verdana, sans-serif;
            line-height: 1.6;
            color: #1f2937;
            background: linear-gradient(135deg, #667eea 0%, #764ba2 100%);
            margin: 0;
            padding: 20px;
        }
        .container {
            max-width: 600px;
            margin: 0 auto;
            background-color: #ffffff;
            border-radius: 20px;
            box-shadow: 0 20px 40px rgba(0,0,0,0.1);
            overflow: hidden;
        }
        .header {
            background: linear-gradient(135deg, #1e3c72 0%, #2a5298 100%);
            text-align: center;
            padding: 40px 20px;
            position: relative;
        }
        .header h1 {
            color: #ffffff;
            margin: 0;
            font-size: 32px;
            font-weight: 700;
            letter-spacing: 1px;
        }
        .header p {
            color: rgba(255,255,255,0.9);
            margin: 10px 0 0;
            font-size: 14px;
        }
        .logo-icon {
            width: 60px;
            height: 60px;
            background: rgba(255,255,255,0.2);
            border-radius: 50%;
            display: flex;
            align-items: center;
            justify-content: center;
            margin: 0 auto 15px;
            font-size: 30px;
        }
        .content {
            padding: 40px 35px;
        }
        .welcome-text {
            font-size: 24px;
            font-weight: 600;
            margin-bottom: 20px;
            color: #1e3c72;
        }
        .welcome-text strong {
            background: linear-gradient(135deg, #1e3c72, #2a5298);
            background-clip: text;
            -webkit-background-clip: text;
            -webkit-text-fill-color: transparent;
        }
        .message-box {
            background: linear-gradient(135deg, #f0f9ff 0%, #e0f2fe 100%);
            border-radius: 12px;
            padding: 20px;
            margin: 25px 0;
            border-left: 4px solid #2a5298;
        }
        .features-list {
            background: #f8fafc;
            border-radius: 12px;
            padding: 20px 25px;
            margin: 20px 0;
        }
        .features-list ul {
            margin: 0;
            padding-left: 20px;
        }
        .features-list li {
            margin: 12px 0;
            color: #334155;
        }
        .features-list li:before {
            content: "✓";
            color: #2a5298;
            font-weight: bold;
            margin-right: 10px;
        }
        .button {
            display: inline-block;
            padding: 14px 35px;
            background: linear-gradient(135deg, #1e3c72, #2a5298);
            color: #ffffff !important;
            text-decoration: none;
            border-radius: 50px;
            font-weight: 600;
            margin: 20px 0;
            text-align: center;
            transition: transform 0.3s ease, box-shadow 0.3s ease;
            box-shadow: 0 4px 15px rgba(30,60,114,0.3);
        }
        .button:hover {
            transform: translateY(-2px);
            box-shadow: 0 6px 20px rgba(30,60,114,0.4);
        }
        .support-box {
            background: #fefce8;
            border-radius: 12px;
            padding: 15px 20px;
            margin: 25px 0;
            text-align: center;
            border: 1px solid #fde047;
        }
        .support-box a {
            color: #2a5298;
            text-decoration: none;
            font-weight: 600;
        }
        .footer {
            text-align: center;
            padding: 30px 20px;
            background: #f8fafc;
            border-top: 1px solid #e2e8f0;
        }
        .footer p {
            margin: 8px 0;
            font-size: 12px;
            color: #64748b;
        }
        .social-links {
            margin-top: 20px;
        }
        .social-links a {
            display: inline-block;
            margin: 0 8px;
            color: #64748b;
            text-decoration: none;
            font-size: 20px;
            transition: color 0.3s ease;
        }
        .social-links a:hover {
            color: #1e3c72;
        }
        .divider {
            height: 1px;
            background: linear-gradient(90deg, transparent, #cbd5e1, transparent);
            margin: 20px 0;
        }
        @media only screen and (max-width: 600px) {
            body {
                padding: 10px;
            }
            .content {
                padding: 25px 20px;
            }
            .welcome-text {
                font-size: 20px;
            }
            .button {
                padding: 12px 25px;
                font-size: 14px;
            }
        }
    </style>
</head>
<body>
    <div class="container">
        <div class="header">
            <div class="logo-icon">
                🔧
            </div>
            <h1>AkieRepair Enterprise</h1>
            <p>Professional Repair Services Excellence</p>
        </div>

        <div class="content">
            <div class="welcome-text">
                Dear <strong>{{ $user->name }}</strong>,
            </div>

            <div class="message-box">
                <p style="margin: 0; font-size: 16px;">
                    🎉 <strong>Great news!</strong> Your account registration has been 
                    <strong style="color: #10b981;">APPROVED</strong> successfully.
                </p>
            </div>

            <p style="color: #475569;">Welcome to AkieRepair Enterprise! You can now access all the features of our professional repair service platform:</p>

            <div class="features-list">
                <ul style="list-style: none; padding-left: 0;">
                    <li>🔧 Book repair services online</li>
                    <li>📊 Track your repair status in real-time</li>
                    <li>📱 Manage all your devices in one place</li>
                    <li>💰 Get instant quotations</li>
                    <li>💳 Secure online payments</li>
                    <li>⭐ Rate and review our services</li>
                </ul>
            </div>

            <div style="text-align: center;">
                <a href="{{ url('/login') }}" class="button">
                    🚀 Login to Your Account
                </a>
            </div>

            <div class="support-box">
                <p style="margin: 0; color: #854d0e;">
                    💬 <strong>Need assistance?</strong><br>
                    Contact our support team at 
                    <a href="mailto:support@akierepair.com">support@akierepair.com</a><br>
                    or call us at <strong>+60 12-345 6789</strong>
                </p>
            </div>
        </div>

        <div class="footer">
            <p><strong>AkieRepair Enterprise</strong><br>Your Trusted Repair Partner</p>
            <div class="divider"></div>
            <p>&copy; {{ date('Y') }} AkieRepair Enterprise. All rights reserved.</p>
            <p>This is an automated message, please do not reply to this email.</p>
            <div class="social-links">
                <a href="#" style="margin: 0 8px;">📘 Facebook</a>
                <a href="#" style="margin: 0 8px;">🐦 Twitter</a>
                <a href="#" style="margin: 0 8px;">📷 Instagram</a>
                <a href="#" style="margin: 0 8px;">💼 LinkedIn</a>
            </div>
        </div>
    </div>
</body>
</html>