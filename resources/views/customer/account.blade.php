@extends('layouts.customer')

@section('title', 'My Account')

@section('content')
<style>
    .account-page {
        --account-ink: #172033;
        --account-muted: #64748b;
        --account-line: #e2e8f0;
        --account-soft: #f8fafc;
        --account-blue: #2563eb;
        max-width: 1120px;
        margin: 0 auto;
    }

    .account-heading {
        background: #0f172a;
        border-radius: 24px;
        box-shadow: 0 20px 25px -5px rgba(0, 0, 0, .1), 0 10px 10px -5px rgba(0, 0, 0, .04);
        display: flex;
        align-items: flex-end;
        justify-content: space-between;
        gap: 24px;
        margin-bottom: 26px;
        overflow: hidden;
        padding: 40px;
        position: relative;
    }

    .account-heading::after {
        background: radial-gradient(circle, rgba(139, 92, 246, .25) 0%, rgba(15, 23, 42, 0) 70%);
        border-radius: 50%;
        content: '';
        height: 400px;
        pointer-events: none;
        position: absolute;
        right: -10%;
        top: -50%;
        width: 400px;
    }

    .account-heading > * {
        position: relative;
        z-index: 1;
    }

    .account-eyebrow {
        display: block;
        color: #60a5fa;
        font-size: .78rem;
        font-weight: 800;
        letter-spacing: .1em;
        margin-bottom: 5px;
        text-transform: uppercase;
    }

    .account-heading h1 {
        color: #fff;
        font-size: clamp(2rem, 4vw, 2.7rem);
        line-height: 1.1;
        margin: 0 0 7px;
    }

    .account-heading p {
        color: #94a3b8;
        font-size: 1.03rem;
        margin: 0;
    }

    .account-status {
        align-items: center;
        background: #ecfdf5;
        border: 1px solid #bbf7d0;
        border-radius: 999px;
        color: #166534;
        display: inline-flex;
        flex: 0 0 auto;
        font-size: .86rem;
        font-weight: 700;
        gap: 7px;
        padding: 8px 13px;
    }

    .account-status i { font-size: .72rem; }

    .account-shell {
        align-items: start;
        background: rgba(0, 0, 0, .58);
        backdrop-filter: blur(7px);
        display: none;
        gap: 22px;
        grid-template-columns: minmax(0, 680px) minmax(320px, 430px);
        inset: 0;
        justify-content: center;
        overflow-y: auto;
        padding: 30px 18px;
        position: fixed;
        z-index: 1100;
    }

    .account-shell.is-open { display: grid; }

    .account-shell > .account-card,
    .account-shell > .account-side > .account-card {
        border-radius: 28px;
        box-shadow: 0 24px 65px rgba(0, 0, 0, .22);
    }

    .account-modal-heading {
        align-items: center;
        display: flex;
        grid-column: 1 / -1;
        justify-content: space-between;
        width: 100%;
    }

    .account-modal-heading h2 { color: #fff; font-size: 1.35rem; margin: 0; }

    .account-modal-close {
        align-items: center;
        background: rgba(255,255,255,.16);
        border: 1px solid rgba(255,255,255,.28);
        border-radius: 50%;
        color: #fff;
        cursor: pointer;
        display: flex;
        font-size: 1.15rem;
        height: 42px;
        justify-content: center;
        width: 42px;
    }

    .account-card {
        background: #fff;
        border: 1px solid var(--account-line);
        border-radius: 18px;
        box-shadow: 0 12px 35px rgba(15, 23, 42, .055);
        overflow: hidden;
    }

    .account-card + .account-card { margin-top: 20px; }

    .account-card-header {
        align-items: center;
        border-bottom: 1px solid #edf2f7;
        display: flex;
        gap: 13px;
        padding: 22px 25px;
    }

    .account-card-icon {
        align-items: center;
        background: #eff6ff;
        border-radius: 10px;
        color: var(--account-blue);
        display: inline-flex;
        flex: 0 0 auto;
        font-size: 1.1rem;
        height: 40px;
        justify-content: center;
        width: 40px;
    }

    .account-card-header h2 {
        color: var(--account-ink);
        font-size: 1.1rem;
        line-height: 1.25;
        margin: 0 0 2px;
    }

    .account-card-header p {
        color: var(--account-muted);
        font-size: .9rem;
        line-height: 1.4;
        margin: 0;
    }

    .account-card-body { padding: 25px; }

    .account-photo-field {
        align-items: center;
        background: #f8fafc;
        border: 1px solid var(--account-line);
        border-radius: 14px;
        display: flex;
        gap: 18px;
        grid-column: 1 / -1;
        padding: 16px;
    }

    .account-photo-preview {
        align-items: center;
        background: #dbeafe;
        border: 3px solid #fff;
        border-radius: 50%;
        box-shadow: 0 0 0 1px #cbd5e1;
        color: #1d4ed8;
        display: flex;
        flex: 0 0 82px;
        font-size: 1.65rem;
        font-weight: 800;
        height: 82px;
        justify-content: center;
        object-fit: cover;
        overflow: hidden;
        width: 82px;
    }

    .account-photo-copy { min-width: 0; }
    .account-photo-copy label { margin-bottom: 4px; }

    .account-file-input {
        font-size: .84rem;
        margin-top: 10px;
        max-width: 100%;
    }

    .account-file-input::file-selector-button {
        background: #fff;
        border: 1px solid #cbd5e1;
        border-radius: 8px;
        color: #334155;
        cursor: pointer;
        font-weight: 700;
        margin-right: 10px;
        padding: 8px 11px;
    }

    .account-profile-summary {
        color: #0f172a;
    }

    .account-avatar {
        align-items: center;
        background: #f1f5f9;
        border: 1px solid #d7dce2;
        border-radius: 50%;
        color: #262626;
        display: flex;
        font-size: 1.75rem;
        font-weight: 800;
        height: 150px;
        justify-content: center;
        width: 150px;
        object-fit: cover;
        overflow: hidden;
    }

    .account-profile-summary h2 {
        color: #262626;
        font-size: 1.25rem;
        font-weight: 500;
        line-height: 1.25;
        margin: 0 0 4px;
    }

    .account-profile-summary p {
        color: #737373;
        font-size: .92rem;
        margin: 0;
        overflow-wrap: anywhere;
    }

    .account-meta {
        border-top: 1px solid #dbdbdb;
        display: flex;
        gap: 8px;
        margin-top: 20px;
        padding-top: 17px;
    }

    .account-meta i { color: #0095f6; }
    .account-meta span { color: #262626; font-size: .88rem; }

    .instagram-profile {
        background: linear-gradient(135deg, #ffffff 0%, #eff6ff 55%, #f5f3ff 100%);
        border: 1px solid #dbeafe;
        border-radius: 22px;
        box-shadow: 0 12px 30px rgba(37, 99, 235, .08);
        margin: 0 auto;
        max-width: 880px;
        padding: 32px 38px 42px;
    }

    .instagram-profile-main { align-items: center; display: grid; gap: 64px; grid-template-columns: 170px 1fr; }
    .instagram-avatar-wrap { align-items: center; display: flex; justify-content: center; }
    .instagram-profile-info { min-width: 0; }
    .instagram-profile-top { align-items: center; display: flex; flex-wrap: wrap; gap: 14px; }
    .instagram-profile-top h2 { font-size: 1.35rem; font-weight: 400; margin: 0; overflow-wrap: anywhere; }

    .instagram-edit-button {
        background: linear-gradient(135deg, #2563eb, #3b82f6);
        border: 0;
        border-radius: 8px;
        box-shadow: 0 6px 14px rgba(37, 99, 235, .22);
        color: #fff;
        cursor: pointer;
        font: inherit;
        font-size: .88rem;
        font-weight: 700;
        padding: 8px 16px;
    }

    .instagram-edit-button:hover {
        background: linear-gradient(135deg, #1d4ed8, #2563eb);
        box-shadow: 0 8px 18px rgba(37, 99, 235, .3);
        transform: translateY(-1px);
    }

    .instagram-status-button {
        background: {{ $user->is_active ? '#fff1f2' : '#ecfdf5' }};
        border: 1px solid {{ $user->is_active ? '#fecdd3' : '#a7f3d0' }};
        border-radius: 8px;
        color: {{ $user->is_active ? '#be123c' : '#047857' }};
        cursor: pointer;
        font: inherit;
        font-size: .88rem;
        font-weight: 700;
        padding: 8px 16px;
    }

    .instagram-status-button:hover { filter: brightness(.97); }

    .status-confirm-overlay {
        align-items: center;
        background: rgba(15, 23, 42, .58);
        backdrop-filter: blur(6px);
        display: none;
        inset: 0;
        justify-content: center;
        padding: 20px;
        position: fixed;
        z-index: 1200;
    }

    .status-confirm-overlay.is-open { display: flex; }

    .status-confirm-box {
        background: #fff;
        border-radius: 26px;
        box-shadow: 0 28px 70px rgba(15, 23, 42, .28);
        max-width: 430px;
        padding: 30px;
        text-align: center;
        width: 100%;
    }

    .status-confirm-icon {
        align-items: center;
        background: {{ $user->is_active ? '#fff1f2' : '#ecfdf5' }};
        border-radius: 50%;
        color: {{ $user->is_active ? '#e11d48' : '#059669' }};
        display: inline-flex;
        font-size: 1.55rem;
        height: 62px;
        justify-content: center;
        margin-bottom: 17px;
        width: 62px;
    }

    .status-confirm-box h3 { color: #172033; font-size: 1.25rem; margin: 0 0 9px; }
    .status-confirm-box p { color: #64748b; font-size: .92rem; line-height: 1.55; margin: 0 0 24px; }
    .status-confirm-actions { display: flex; gap: 10px; justify-content: center; }
    .status-confirm-actions button { border: 0; border-radius: 10px; cursor: pointer; font: inherit; font-weight: 700; min-width: 110px; padding: 11px 17px; }
    .status-cancel { background: #f1f5f9; color: #334155; }
    .status-submit { background: {{ $user->is_active ? '#e11d48' : '#059669' }}; color: #fff; }
    .instagram-stats { display: flex; gap: 38px; margin: 24px 0; }
    .instagram-stat { color: #262626; font-size: .93rem; }
    .instagram-stat strong { font-weight: 700; margin-right: 4px; }
    .instagram-bio strong { display: block; font-size: .92rem; margin-bottom: 5px; }
    .instagram-bio p { color: #262626; font-size: .9rem; line-height: 1.55; margin: 0; overflow-wrap: anywhere; }

    .account-form-grid {
        display: grid;
        grid-template-columns: 1fr 1fr;
        gap: 20px;
    }

    .account-field.full { grid-column: 1 / -1; }

    .account-field label {
        color: #334155;
        display: block;
        font-size: .88rem;
        font-weight: 700;
        margin-bottom: 7px;
    }

    .account-input-wrap { position: relative; }

    .account-input-icon {
        color: #94a3b8;
        left: 14px;
        pointer-events: none;
        position: absolute;
        top: 50%;
        transform: translateY(-50%);
    }

    .account-input {
        background: var(--account-soft);
        border: 1px solid #cbd5e1;
        border-radius: 10px;
        box-sizing: border-box;
        color: var(--account-ink);
        font: inherit;
        height: 48px;
        padding: 10px 43px;
        width: 100%;
    }

    .account-input:focus {
        background: #fff;
        border-color: var(--account-blue) !important;
        box-shadow: 0 0 0 4px rgba(37, 99, 235, .1) !important;
        outline: none;
    }

    .account-input.is-invalid { border-color: #dc2626; }

    .account-hint, .account-error {
        display: block;
        font-size: .8rem;
        line-height: 1.4;
        margin-top: 6px;
    }

    .account-hint { color: var(--account-muted); }
    .account-error { color: #b91c1c; font-weight: 600; }

    .password-toggle {
        align-items: center;
        background: transparent;
        border: 0;
        color: #64748b;
        cursor: pointer;
        display: flex;
        height: 42px;
        justify-content: center;
        padding: 0;
        position: absolute;
        right: 4px;
        top: 3px;
        width: 40px;
    }

    .account-actions {
        align-items: center;
        border-top: 1px solid #edf2f7;
        display: flex;
        justify-content: flex-end;
        margin: 25px -25px -25px;
        padding: 18px 25px;
    }

    .account-button {
        align-items: center;
        background: var(--account-blue);
        border: 0;
        border-radius: 10px;
        color: #fff;
        cursor: pointer;
        display: inline-flex;
        font: inherit;
        font-size: .92rem;
        font-weight: 700;
        gap: 9px;
        justify-content: center;
        min-height: 44px;
        padding: 10px 18px;
        transition: background .18s ease, box-shadow .18s ease, transform .18s ease;
    }

    .account-button:hover {
        background: #1d4ed8;
        box-shadow: 0 8px 18px rgba(37, 99, 235, .2);
        transform: translateY(-1px);
    }

    .security-note {
        align-items: flex-start;
        background: #fffbeb;
        border: 1px solid #fde68a;
        border-radius: 10px;
        color: #854d0e;
        display: flex;
        font-size: .84rem;
        gap: 9px;
        line-height: 1.45;
        margin-bottom: 20px;
        padding: 11px 12px;
    }

    .security-note i { margin-top: 1px; }

    @media (max-width: 980px) {
        .account-shell.is-open { grid-template-columns: minmax(0, 680px); }
        .account-modal-heading { grid-column: auto; }
        .account-side { display: block; }
        .account-card + .account-card { margin-top: 0; }
    }

    @media (max-width: 680px) {
        .account-heading { align-items: flex-start; flex-direction: column; gap: 13px; padding: 24px; }
        .account-status { font-size: .8rem; }
        .account-form-grid, .account-side { grid-template-columns: 1fr; }
        .account-field.full { grid-column: auto; }
        .account-card-header, .account-card-body { padding-left: 19px; padding-right: 19px; }
        .account-actions { margin-left: -19px; margin-right: -19px; padding-left: 19px; padding-right: 19px; }
        .account-button { width: 100%; }
        .account-photo-field { align-items: flex-start; }
        .account-photo-preview { flex-basis: 68px; height: 68px; width: 68px; }
        .instagram-profile { padding: 24px 16px 30px; }
        .instagram-profile-main { align-items: start; gap: 20px; grid-template-columns: 86px 1fr; }
        .instagram-profile .account-avatar { height: 82px; width: 82px; }
        .instagram-profile-top { gap: 10px; }
        .instagram-profile-top h2 { flex-basis: 100%; font-size: 1.15rem; }
        .instagram-stats { gap: 16px; margin: 18px 0; }
    }
</style>

<div class="account-page">
    <header class="account-heading">
        <div>
            <span class="account-eyebrow">Account</span>
            <h1>My account</h1>
            <p>Keep your contact details up to date and manage your password.</p>
        </div>
        <span class="account-status"><i class="bi bi-circle-fill"></i> Active customer</span>
    </header>

    <section class="instagram-profile" aria-label="Customer profile">
        <div class="instagram-profile-main">
            <div class="instagram-avatar-wrap">
                @if($user->profile_image)
                    <img class="account-avatar" src="{{ $user->profile_image }}" alt="{{ $user->name }} profile picture">
                @else
                    <div class="account-avatar">{{ strtoupper(substr($user->name ?? 'C', 0, 1)) }}</div>
                @endif
            </div>
            <div class="instagram-profile-info">
                <div class="instagram-profile-top">
                    <h2>{{ $user->name }}</h2>
                    <button class="instagram-edit-button" type="button" data-account-modal-open>Edit profile</button>
                    <button class="instagram-status-button" type="button" data-status-confirm-open>
                        {{ $user->is_active ? 'Deactivate' : 'Activate' }}
                    </button>
                </div>
                <div class="instagram-stats">
                    <span class="instagram-stat"><strong>1</strong> profile</span>
                    <span class="instagram-stat"><strong>{{ $user->is_active ? 'Active' : 'Inactive' }}</strong> customer</span>
                </div>
                <div class="instagram-bio">
                    <strong>{{ $user->name }}</strong>
                    <p><i class="bi bi-envelope"></i> {{ $user->email }}</p>
                    <p><i class="bi bi-telephone"></i> {{ $user->phone_number ?: 'No phone number added' }}</p>
                </div>
            </div>
        </div>
    </section>

    <div class="account-shell" id="account-edit-modal" role="dialog" aria-modal="true" aria-labelledby="account-modal-title" aria-hidden="true">
        <div class="account-modal-heading">
            <h2 id="account-modal-title">Edit profile and security</h2>
            <button class="account-modal-close" type="button" data-account-modal-close aria-label="Close editor"><i class="bi bi-x-lg"></i></button>
        </div>
        <section class="account-card" aria-labelledby="profile-heading">
            <div class="account-card-header">
                <span class="account-card-icon"><i class="bi bi-person"></i></span>
                <div>
                    <h2 id="profile-heading">Personal details</h2>
                    <p>We use these details for booking and repair updates.</p>
                </div>
            </div>

            <form action="{{ route('customer.account.update') }}" method="POST" enctype="multipart/form-data">
                @csrf
                @method('PUT')
                <div class="account-card-body">
                    <div class="account-form-grid">
                        <div class="account-photo-field">
                            @if($user->profile_image)
                                <img class="account-photo-preview" id="profile-image-preview" src="{{ $user->profile_image }}" alt="{{ $user->name }} profile picture">
                            @else
                                <div class="account-photo-preview" id="profile-image-preview">{{ strtoupper(substr($user->name ?? 'C', 0, 1)) }}</div>
                            @endif
                            <div class="account-photo-copy">
                                <label for="profile_image">Profile picture</label>
                                <span class="account-hint">Upload a JPG, PNG, or WebP image up to 2 MB.</span>
                                <input class="account-file-input @error('profile_image') is-invalid @enderror" type="file"
                                    name="profile_image" id="profile_image" accept="image/jpeg,image/png,image/webp">
                                @error('profile_image')<span class="account-error">{{ $message }}</span>@enderror
                            </div>
                        </div>

                        <div class="account-field full">
                            <label for="name">Full name</label>
                            <div class="account-input-wrap">
                                <i class="bi bi-person account-input-icon"></i>
                                <input class="account-input @error('name') is-invalid @enderror" type="text" name="name" id="name"
                                    value="{{ old('name', $user->name) }}" required autocomplete="name">
                            </div>
                            @error('name')<span class="account-error">{{ $message }}</span>@enderror
                        </div>

                        <div class="account-field">
                            <label for="email">Email address</label>
                            <div class="account-input-wrap">
                                <i class="bi bi-envelope account-input-icon"></i>
                                <input class="account-input @error('email') is-invalid @enderror" type="email" name="email" id="email"
                                    value="{{ old('email', $user->email) }}" required autocomplete="email">
                            </div>
                            @error('email')<span class="account-error">{{ $message }}</span>@enderror
                        </div>

                        <div class="account-field">
                            <label for="phone_number">Phone number</label>
                            <div class="account-input-wrap">
                                <i class="bi bi-telephone account-input-icon"></i>
                                <input class="account-input @error('phone_number') is-invalid @enderror" type="tel" name="phone_number" id="phone_number"
                                    value="{{ old('phone_number', $user->phone_number) }}" required inputmode="numeric" autocomplete="tel"
                                    maxlength="11" pattern="[0-9]{1,11}" oninput="this.value = this.value.replace(/[^0-9]/g, '')">
                            </div>
                            <span class="account-hint">Up to 11 digits, without spaces or hyphens.</span>
                            @error('phone_number')<span class="account-error">{{ $message }}</span>@enderror
                        </div>
                    </div>

                    <div class="account-actions">
                        <button type="submit" class="account-button">
                            <i class="bi bi-check2"></i> Save changes
                        </button>
                    </div>
                </div>
            </form>
        </section>

        <aside class="account-side">
            <section class="account-card" aria-labelledby="security-heading">
                <div class="account-card-header">
                    <span class="account-card-icon"><i class="bi bi-shield-lock"></i></span>
                    <div>
                        <h2 id="security-heading">Password & security</h2>
                        <p>Update your sign-in password.</p>
                    </div>
                </div>

                <form action="{{ route('customer.account.password') }}" method="POST">
                    @csrf
                    @method('PUT')
                    <div class="account-card-body">
                        <div class="security-note">
                            <i class="bi bi-info-circle"></i>
                            <span>Use at least 6 characters and avoid passwords you use elsewhere.</span>
                        </div>

                        <div class="account-field">
                            <label for="current_password">Current password</label>
                            <div class="account-input-wrap">
                                <i class="bi bi-lock account-input-icon"></i>
                                <input class="account-input @error('current_password') is-invalid @enderror" type="password"
                                    name="current_password" id="current_password" required autocomplete="current-password">
                                <button class="password-toggle" type="button" data-password-toggle="current_password" aria-label="Show current password">
                                    <i class="bi bi-eye"></i>
                                </button>
                            </div>
                            @error('current_password')<span class="account-error">{{ $message }}</span>@enderror
                        </div>

                        <div class="account-field" style="margin-top: 17px;">
                            <label for="password">New password</label>
                            <div class="account-input-wrap">
                                <i class="bi bi-key account-input-icon"></i>
                                <input class="account-input @error('password') is-invalid @enderror" type="password"
                                    name="password" id="password" required minlength="6" autocomplete="new-password">
                                <button class="password-toggle" type="button" data-password-toggle="password" aria-label="Show new password">
                                    <i class="bi bi-eye"></i>
                                </button>
                            </div>
                            @error('password')<span class="account-error">{{ $message }}</span>@enderror
                        </div>

                        <div class="account-field" style="margin-top: 17px;">
                            <label for="password_confirmation">Confirm new password</label>
                            <div class="account-input-wrap">
                                <i class="bi bi-key account-input-icon"></i>
                                <input class="account-input" type="password" name="password_confirmation" id="password_confirmation"
                                    required minlength="6" autocomplete="new-password">
                                <button class="password-toggle" type="button" data-password-toggle="password_confirmation" aria-label="Show password confirmation">
                                    <i class="bi bi-eye"></i>
                                </button>
                            </div>
                        </div>

                        <div class="account-actions">
                            <button type="submit" class="account-button">
                                <i class="bi bi-shield-check"></i> Update password
                            </button>
                        </div>
                    </div>
                </form>
            </section>
        </aside>
    </div>

    <div class="status-confirm-overlay" id="status-confirm-modal" role="dialog" aria-modal="true" aria-labelledby="status-confirm-title" aria-hidden="true">
        <div class="status-confirm-box">
            <span class="status-confirm-icon"><i class="bi {{ $user->is_active ? 'bi-person-x' : 'bi-person-check' }}"></i></span>
            <h3 id="status-confirm-title">{{ $user->is_active ? 'Deactivate your account?' : 'Activate your account?' }}</h3>
            <p>
                {{ $user->is_active
                    ? 'You will not be able to sign in again after signing out unless an administrator reactivates your account.'
                    : 'Your customer account will become active and available for normal use again.' }}
            </p>
            <form action="{{ route('customer.account.status') }}" method="POST">
                @csrf
                @method('PUT')
                <div class="status-confirm-actions">
                    <button class="status-cancel" type="button" data-status-confirm-close>Cancel</button>
                    <button class="status-submit" type="submit">Yes, {{ $user->is_active ? 'deactivate' : 'activate' }}</button>
                </div>
            </form>
        </div>
    </div>
</div>

<script>
    const statusConfirmModal = document.getElementById('status-confirm-modal');

    function setStatusConfirmModal(open) {
        statusConfirmModal?.classList.toggle('is-open', open);
        statusConfirmModal?.setAttribute('aria-hidden', open ? 'false' : 'true');
        document.body.style.overflow = open ? 'hidden' : '';
    }

    document.querySelector('[data-status-confirm-open]')?.addEventListener('click', () => setStatusConfirmModal(true));
    document.querySelectorAll('[data-status-confirm-close]').forEach(button => button.addEventListener('click', () => setStatusConfirmModal(false)));
    statusConfirmModal?.addEventListener('click', event => { if (event.target === statusConfirmModal) setStatusConfirmModal(false); });

    const accountModal = document.getElementById('account-edit-modal');

    function setAccountModal(open) {
        accountModal?.classList.toggle('is-open', open);
        accountModal?.setAttribute('aria-hidden', open ? 'false' : 'true');
        document.body.style.overflow = open ? 'hidden' : '';
    }

    document.querySelector('[data-account-modal-open]')?.addEventListener('click', () => setAccountModal(true));
    document.querySelectorAll('[data-account-modal-close]').forEach(button => button.addEventListener('click', () => setAccountModal(false)));
    accountModal?.addEventListener('click', event => { if (event.target === accountModal) setAccountModal(false); });
    document.addEventListener('keydown', event => {
        if (event.key === 'Escape') {
            setAccountModal(false);
            setStatusConfirmModal(false);
        }
    });

    @if($errors->any())
        setAccountModal(true);
    @endif

    const profileInput = document.getElementById('profile_image');

    profileInput?.addEventListener('change', function () {
        const file = this.files && this.files[0];
        if (!file) return;

        const currentPreview = document.getElementById('profile-image-preview');
        const preview = currentPreview.tagName === 'IMG' ? currentPreview : document.createElement('img');
        preview.className = 'account-photo-preview';
        preview.id = 'profile-image-preview';
        preview.alt = 'Selected profile picture preview';
        preview.src = URL.createObjectURL(file);

        if (preview !== currentPreview) currentPreview.replaceWith(preview);
        preview.onload = () => URL.revokeObjectURL(preview.src);
    });

    document.querySelectorAll('[data-password-toggle]').forEach(function (button) {
        button.addEventListener('click', function () {
            const input = document.getElementById(this.dataset.passwordToggle);
            const isHidden = input.type === 'password';
            input.type = isHidden ? 'text' : 'password';
            this.innerHTML = isHidden ? '<i class="bi bi-eye-slash"></i>' : '<i class="bi bi-eye"></i>';
            this.setAttribute('aria-label', isHidden ? 'Hide password' : 'Show password');
        });
    });
</script>
@endsection
