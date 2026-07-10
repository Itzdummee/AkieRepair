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
        display: flex;
        align-items: flex-end;
        justify-content: space-between;
        gap: 24px;
        margin-bottom: 26px;
    }

    .account-eyebrow {
        display: block;
        color: var(--account-blue);
        font-size: .78rem;
        font-weight: 800;
        letter-spacing: .1em;
        margin-bottom: 5px;
        text-transform: uppercase;
    }

    .account-heading h1 {
        color: var(--account-ink);
        font-size: clamp(2rem, 4vw, 2.7rem);
        line-height: 1.1;
        margin: 0 0 7px;
    }

    .account-heading p {
        color: var(--account-muted);
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
        display: grid;
        grid-template-columns: minmax(0, 1.55fr) minmax(300px, .85fr);
        gap: 24px;
        align-items: start;
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

    .account-profile-summary {
        background: linear-gradient(145deg, #172033, #26395f);
        color: #fff;
        padding: 27px 24px;
    }

    .account-avatar {
        align-items: center;
        background: #fff;
        border: 4px solid rgba(255, 255, 255, .2);
        border-radius: 16px;
        color: #1d4ed8;
        display: flex;
        font-size: 1.75rem;
        font-weight: 800;
        height: 68px;
        justify-content: center;
        margin-bottom: 18px;
        width: 68px;
    }

    .account-profile-summary h2 {
        color: #fff;
        font-size: 1.35rem;
        line-height: 1.25;
        margin: 0 0 4px;
    }

    .account-profile-summary p {
        color: #cbd5e1;
        font-size: .92rem;
        margin: 0;
        overflow-wrap: anywhere;
    }

    .account-meta {
        border-top: 1px solid rgba(255, 255, 255, .13);
        display: flex;
        gap: 8px;
        margin-top: 20px;
        padding-top: 17px;
    }

    .account-meta i { color: #93c5fd; }
    .account-meta span { color: #e2e8f0; font-size: .88rem; }

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
        .account-shell { grid-template-columns: 1fr; }
        .account-side { display: grid; grid-template-columns: 1fr 1.35fr; gap: 20px; }
        .account-card + .account-card { margin-top: 0; }
    }

    @media (max-width: 680px) {
        .account-heading { align-items: flex-start; flex-direction: column; gap: 13px; }
        .account-status { font-size: .8rem; }
        .account-form-grid, .account-side { grid-template-columns: 1fr; }
        .account-field.full { grid-column: auto; }
        .account-card-header, .account-card-body { padding-left: 19px; padding-right: 19px; }
        .account-actions { margin-left: -19px; margin-right: -19px; padding-left: 19px; padding-right: 19px; }
        .account-button { width: 100%; }
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

    <div class="account-shell">
        <section class="account-card" aria-labelledby="profile-heading">
            <div class="account-card-header">
                <span class="account-card-icon"><i class="bi bi-person"></i></span>
                <div>
                    <h2 id="profile-heading">Personal details</h2>
                    <p>We use these details for booking and repair updates.</p>
                </div>
            </div>

            <form action="{{ route('customer.account.update') }}" method="POST">
                @csrf
                @method('PUT')
                <div class="account-card-body">
                    <div class="account-form-grid">
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
            <section class="account-card" aria-label="Customer profile summary">
                <div class="account-profile-summary">
                    <div class="account-avatar">{{ strtoupper(substr($user->name ?? 'C', 0, 1)) }}</div>
                    <h2>{{ $user->name }}</h2>
                    <p>{{ $user->email }}</p>
                    <div class="account-meta">
                        <i class="bi bi-person-check"></i>
                        <span>Customer account</span>
                    </div>
                </div>
            </section>

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
</div>

<script>
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
