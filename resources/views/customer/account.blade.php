@extends('layouts.customer')

@section('title', 'My Account')

@section('content')

<style>
    .modern-header {
        position: relative;
        background: #0f172a;
        color: #ffffff;
        padding: 40px;
        border-radius: 24px;
        margin-bottom: 32px;
        overflow: hidden;
        box-shadow: 0 20px 25px -5px rgba(0, 0, 0, 0.1), 0 10px 10px -5px rgba(0, 0, 0, 0.04);
    }
    .modern-header .header-content {
        position: relative;
        z-index: 2;
        display: flex;
        align-items: center;
        gap: 24px;
    }
    .modern-header .icon-wrapper {
        background: linear-gradient(135deg, #3b82f6, #8b5cf6);
        width: 72px;
        height: 72px;
        border-radius: 20px;
        display: flex;
        align-items: center;
        justify-content: center;
        font-size: 2rem;
        color: white;
        box-shadow: 0 10px 15px -3px rgba(59, 130, 246, 0.5);
        flex-shrink: 0;
    }
    .modern-header .header-title {
        font-size: 2.2rem;
        font-weight: 800;
        margin: 0 0 8px 0;
        letter-spacing: -0.025em;
    }
    .modern-header .header-subtitle {
        font-size: 1.05rem;
        color: #94a3b8;
        margin: 0;
        max-width: 500px;
        line-height: 1.5;
    }
    .modern-header .header-decoration {
        position: absolute;
        top: -50%;
        right: -10%;
        width: 400px;
        height: 400px;
        background: radial-gradient(circle, rgba(139,92,246,0.25) 0%, rgba(15,23,42,0) 70%);
        border-radius: 50%;
        z-index: 1;
        pointer-events: none;
    }
    @media(max-width: 600px) {
        .modern-header { padding: 24px; }
        .modern-header .header-content { flex-direction: column; text-align: center; gap: 16px; }
        .modern-header .header-title { font-size: 1.75rem; }
    }

    /* Layout Grid */
    .account-layout {
        display: grid;
        grid-template-columns: 1.8fr 1.2fr;
        gap: 32px;
        align-items: start;
    }
    @media(max-width: 1024px) {
        .account-layout {
            grid-template-columns: 1fr;
        }
    }

    .modern-panel {
        background: white;
        border-radius: 20px;
        padding: 32px;
        box-shadow: 0 4px 6px -1px rgba(0, 0, 0, 0.05), 0 2px 4px -1px rgba(0, 0, 0, 0.03);
        border: 1px solid #f3f4f6;
        transition: transform 0.2s ease, box-shadow 0.2s ease;
    }
    .modern-panel:hover {
        box-shadow: 0 10px 15px -3px rgba(0, 0, 0, 0.08), 0 4px 6px -2px rgba(0, 0, 0, 0.05);
    }
    .modern-panel h2 {
        margin-top: 0;
        font-size: 1.3rem;
        font-weight: 800;
        color: #0f172a;
        margin-bottom: 24px;
        display: flex;
        align-items: center;
        gap: 12px;
        border-bottom: 1px solid #f1f5f9;
        padding-bottom: 18px;
        letter-spacing: -0.02em;
    }

    /* Form Styles */
    .form-group {
        margin-bottom: 24px;
    }
    .form-group label {
        display: block;
        font-size: 0.85rem;
        font-weight: 700;
        color: #475569;
        margin-bottom: 8px;
        text-transform: uppercase;
        letter-spacing: 0.05em;
    }
    .form-input {
        width: 100%;
        padding: 14px 18px;
        border-radius: 12px;
        border: 1px solid #cbd5e1;
        background: #f8fafc;
        color: #0f172a;
        font-size: 0.95rem;
        font-family: inherit;
        font-weight: 500;
        box-sizing: border-box;
        transition: all 0.2s ease;
    }
    .form-input:focus {
        outline: none;
        border-color: #3b82f6;
        background: #ffffff;
        box-shadow: 0 0 0 4px rgba(59, 130, 246, 0.12);
    }
    .form-input:disabled {
        background: #e2e8f0;
        color: #64748b;
        cursor: not-allowed;
        border-color: #e2e8f0;
    }

    /* Action Buttons */
    .btn-submit {
        display: inline-flex;
        align-items: center;
        justify-content: center;
        gap: 10px;
        background: linear-gradient(135deg, #3b82f6, #2563eb);
        color: white;
        padding: 14px 28px;
        border-radius: 12px;
        font-weight: 700;
        font-size: 0.95rem;
        border: none;
        cursor: pointer;
        transition: all 0.2s cubic-bezier(0.4, 0, 0.2, 1);
        box-shadow: 0 4px 12px rgba(37, 99, 235, 0.2);
    }
    .btn-submit:hover {
        transform: translateY(-2px);
        box-shadow: 0 8px 16px rgba(37, 99, 235, 0.3);
    }
    .btn-submit:active {
        transform: translateY(0);
    }

    .btn-submit.purple-gradient {
        background: linear-gradient(135deg, #7c3aed, #6d28d9);
        box-shadow: 0 4px 12px rgba(109, 40, 217, 0.2);
    }
    .btn-submit.purple-gradient:hover {
        box-shadow: 0 8px 16px rgba(109, 40, 217, 0.3);
    }

    /* Alerts */
    .alert {
        padding: 16px 20px;
        border-radius: 14px;
        margin-bottom: 28px;
        font-size: 0.95rem;
        display: flex;
        align-items: flex-start;
        gap: 14px;
        line-height: 1.5;
        border: 1px solid transparent;
        animation: fadeIn 0.3s ease;
    }
    @keyframes fadeIn {
        from { opacity: 0; transform: translateY(-10px); }
        to { opacity: 1; transform: translateY(0); }
    }
    .alert-success {
        background: #ecfdf5;
        color: #065f46;
        border-color: #a7f3d0;
    }
    .alert-success i {
        color: #10b981;
        font-size: 1.25rem;
        flex-shrink: 0;
    }
    .alert-danger {
        background: #fef2f2;
        color: #991b1b;
        border-color: #fca5a5;
    }
    .alert-danger i {
        color: #ef4444;
        font-size: 1.25rem;
        flex-shrink: 0;
    }
    .alert ul {
        margin: 6px 0 0 0;
        padding-left: 20px;
    }
    .alert li {
        margin-bottom: 4px;
    }

    /* Profile Avatar Badge Widget */
    .profile-avatar-card {
        text-align: center;
        padding: 36px 24px;
        background: linear-gradient(135deg, #f8fafc, #f1f5f9);
        border-radius: 16px;
        border: 1px solid #e2e8f0;
        margin-bottom: 28px;
    }
    .profile-avatar-card .avatar-large {
        width: 96px;
        height: 96px;
        border-radius: 50%;
        background: linear-gradient(135deg, #3b82f6, #7c3aed);
        color: white;
        display: flex;
        align-items: center;
        justify-content: center;
        font-size: 2.4rem;
        font-weight: 800;
        margin: 0 auto 18px auto;
        box-shadow: 0 10px 20px rgba(59, 130, 246, 0.25);
    }
    .profile-avatar-card h3 {
        margin: 0 0 6px 0;
        font-size: 1.3rem;
        font-weight: 800;
        color: #0f172a;
    }
    .profile-avatar-card p {
        margin: 0 0 12px 0;
        color: #64748b;
        font-size: 0.9rem;
        word-break: break-all;
    }
    .profile-avatar-card .badge-role {
        display: inline-block;
        background: #e2e8f0;
        color: #475569;
        font-weight: 800;
        font-size: 0.75rem;
        padding: 5px 12px;
        border-radius: 9999px;
        text-transform: uppercase;
        letter-spacing: 0.05em;
    }
</style>

<!-- Modern Premium Header -->
<div class="modern-header">
    <div class="header-content">
        <div class="icon-wrapper">
            <i class="bi bi-person-gear"></i>
        </div>
        <div>
            <h1 class="header-title">Account Settings</h1>
            <p class="header-subtitle">Manage your personal profile information, registered credentials, and secure your access.</p>
        </div>
    </div>
    <div class="header-decoration"></div>
</div>

<!-- Alerts Panel -->


@if($errors->any())
    <div class="alert alert-danger">
        <i class="bi bi-exclamation-triangle-fill"></i>
        <div>
            <strong>We encountered some issues:</strong>
            <ul>
                @foreach($errors->all() as $error)
                    <li>{{ $error }}</li>
                @endforeach
            </ul>
        </div>
    </div>
@endif

<!-- Dynamic Grid Layout -->
<div class="account-layout">
    
    <!-- Left Column: Personal Profile Details -->
    <div class="modern-panel">
        <h2><i class="bi bi-person-lines-fill"></i> Personal Profile Details</h2>
        
        <form action="{{ route('customer.account.update') }}" method="POST">
            @csrf
            @method('PUT')
            
            <div class="form-group">
                <label for="name">Full Name</label>
                <input type="text" name="name" id="name" class="form-input" 
                       value="{{ old('name', $user->name) }}" required autocomplete="name" 
                       placeholder="e.g. John Doe">
            </div>

            <div class="form-group">
                <label for="email">Email Address</label>
                <input type="email" name="email" id="email" class="form-input" 
                       value="{{ old('email', $user->email) }}" required autocomplete="email" 
                       placeholder="e.g. johndoe@example.com">
            </div>

            <div class="form-group">
                <label for="phone_number">Phone Number</label>
                <input type="text" name="phone_number" id="phone_number" class="form-input" 
                       value="{{ old('phone_number', $user->phone_number) }}" required 
                       placeholder="e.g. 60123456789" maxlength="11" pattern="[0-9]{1,11}" 
                       title="Phone number must be between 1 and 11 digits containing only numbers" 
                       oninput="this.value = this.value.replace(/[^0-9]/g, '')">
                <span style="font-size: 0.8rem; color: #64748b; margin-top: 6px; display: block;">
                    Must be between 1 and 11 numeric digits without spaces or hyphens.
                </span>
            </div>

            <div style="margin-top: 32px; border-top: 1px solid #f1f5f9; padding-top: 24px;">
                <button type="submit" class="btn-submit">
                    <i class="bi bi-save2"></i> Update Profile Settings
                </button>
            </div>
        </form>
    </div>

    <!-- Right Column: Avatar Widget & Security Settings -->
    <div>
        
        <!-- Interactive Profile Card Widget -->
        <div class="profile-avatar-card">
            <div class="avatar-large">
                {{ strtoupper(substr($user->name ?? 'C', 0, 1)) }}
            </div>
            <h3>{{ $user->name }}</h3>
            <p>{{ $user->email }}</p>
            <span class="badge-role">Customer Account</span>
        </div>

        <!-- Change Password Card Panel -->
        <div class="modern-panel">
            <h2><i class="bi bi-shield-lock"></i> Security & Password</h2>
            
            <form action="{{ route('customer.account.password') }}" method="POST">
                @csrf
                @method('PUT')
                
                <div class="form-group">
                    <label for="current_password">Current Password</label>
                    <input type="password" name="current_password" id="current_password" class="form-input" 
                           required autocomplete="current-password" placeholder="••••••••">
                </div>

                <div class="form-group">
                    <label for="password">New Password</label>
                    <input type="password" name="password" id="password" class="form-input" 
                           required autocomplete="new-password" placeholder="Min. 6 characters">
                </div>

                <div class="form-group">
                    <label for="password_confirmation">Confirm New Password</label>
                    <input type="password" name="password_confirmation" id="password_confirmation" class="form-input" 
                           required autocomplete="new-password" placeholder="Confirm new password">
                </div>

                <div style="margin-top: 28px; border-top: 1px solid #f1f5f9; padding-top: 20px;">
                    <button type="submit" class="btn-submit purple-gradient" style="width: 100%;">
                        <i class="bi bi-key"></i> Update Password
                    </button>
                </div>
            </form>
        </div>

    </div>

</div>

@endsection