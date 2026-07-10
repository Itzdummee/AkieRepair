@extends('layouts.customer')

@section('title', 'Book Technician Visit')

@section('content')

{{-- Tom Select: searchable dropdown --}}
<link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/tom-select@2.3.1/dist/css/tom-select.bootstrap5.min.css">
<script src="https://cdn.jsdelivr.net/npm/tom-select@2.3.1/dist/js/tom-select.complete.min.js"></script>

<style>
    /* Override Tom Select to match existing form style */
    .ts-wrapper .ts-control {
        border: 1px solid #d1d5db;
        border-radius: 12px;
        padding: 10px 16px;
        font-size: 15px;
        font-family: inherit;
        color: #111827;
        background: #ffffff;
        box-shadow: none;
        min-height: 48px;
        transition: border-color 0.3s, box-shadow 0.3s;
    }
    .ts-wrapper.focus .ts-control {
        border-color: #2563eb;
        box-shadow: 0 0 0 3px rgba(37, 99, 235, 0.1);
    }
    .ts-wrapper .ts-dropdown {
        border-radius: 12px;
        border: 1px solid #e5e7eb;
        background: #ffffff;
        box-shadow: 0 12px 40px rgba(0, 0, 0, 0.15);
        font-family: inherit;
        font-size: 15px;
        overflow: hidden;
        z-index: 9999;
        position: absolute;
    }
    .ts-wrapper .ts-dropdown .ts-dropdown-content {
        background: #ffffff;
        max-height: 220px;
        overflow-y: auto;
    }
    .ts-wrapper .ts-dropdown .option {
        padding: 10px 16px;
        color: #111827;
        background: #ffffff;
    }
    .ts-wrapper .ts-dropdown .option:hover,
    .ts-wrapper .ts-dropdown .option.active {
        background: #eff6ff;
        color: #1d4ed8;
    }
    .ts-wrapper .ts-dropdown-content .no-results {
        padding: 12px 16px;
        color: #6b7280;
        background: #ffffff;
    }
    .ts-wrapper .ts-dropdown input.dropdown-input {
        background: #f9fafb;
        border-bottom: 1px solid #e5e7eb;
        padding: 10px 16px;
        font-family: inherit;
        font-size: 14px;
        width: 100%;
        box-sizing: border-box;
        outline: none;
    }
    /* Hide placeholder text when dropdown is open so it doesn't show behind the search input */
    .ts-wrapper.dropdown-active .ts-control .ts-placeholder,
    .ts-wrapper.input-active .ts-control .ts-placeholder {
        display: none !important;
    }
    .form-group {
        margin-bottom: 20px;
    }
    .form-label {
        display: block;
        font-weight: 600;
        margin-bottom: 8px;
        color: #374151;
    }
    .form-control {
        width: 100%;
        padding: 12px 16px;
        border: 1px solid #d1d5db;
        border-radius: 12px;
        font-size: 15px;
        color: #111827;
        box-sizing: border-box;
        transition: border-color 0.3s, box-shadow 0.3s;
        font-family: inherit;
    }
    .form-control:focus {
        outline: none;
        border-color: #2563eb;
        box-shadow: 0 0 0 3px rgba(37, 99, 235, 0.1);
    }
    select.form-control {
        appearance: auto;
    }
    /* Hide the original select so Tom Select renders cleanly */
    #device-select { display: none; }
    .submit-btn {
        background: #2563eb;
        color: white;
        border: none;
        padding: 14px 24px;
        border-radius: 12px;
        font-weight: 700;
        font-size: 16px;
        cursor: pointer;
        width: 100%;
        transition: background 0.3s, transform 0.1s;
        display: flex;
        justify-content: center;
        align-items: center;
        gap: 8px;
    }
    .submit-btn:hover {
        background: #1d4ed8;
    }
    .submit-btn:active {
        transform: scale(0.98);
    }
    .alert-danger {
        background: #fef2f2;
        border-left: 4px solid #ef4444;
        color: #991b1b;
        padding: 16px;
        border-radius: 8px;
        margin-bottom: 24px;
    }
    .alert-danger ul {
        margin: 0;
        padding-left: 20px;
    }
    .field-hint {
        display: block;
        color: #6b7280;
        font-size: 0.85rem;
        line-height: 1.4;
        margin-top: 8px;
    }
    .modern-header {
        position: relative;
        background: #0f172a;
        color: #ffffff;
        padding: 40px;
        border-radius: 24px;
        margin-bottom: 32px;
        overflow: hidden;
        box-shadow: 0 20px 25px -5px rgba(0, 0, 0, 0.1), 0 10px 10px -5px rgba(0, 0, 0, 0.04);
        max-width: 900px;
        margin-left: auto;
        margin-right: auto;
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
</style>

<div class="modern-header" style="max-width: 800px;">
    <div class="header-content">
        <div class="icon-wrapper">
            <i class="bi bi-tools"></i>
        </div>
        <div>
            <h1 class="header-title">Book an Appointment</h1>
            <p class="header-subtitle">Submit your device details and problem description. Our technician will review and provide a quotation.</p>
        </div>
    </div>
    <div class="header-decoration"></div>
</div>

<div class="panel" style="max-width: 800px; margin: 0 auto;">
    <h2 style="margin-top: 0; margin-bottom: 24px; border-bottom: 1px solid #f3f4f6; padding-bottom: 16px;">
        Fill out the Request Form
    </h2>

    @if($errors->any())
        <div class="alert-danger">
            <ul>
                @foreach($errors->all() as $error)
                    <li>{{ $error }}</li>
                @endforeach
            </ul>
        </div>
    @endif

    <form method="POST" action="{{ route('customer.booking.store') }}">
        @csrf

        <div class="form-group">
    <label class="form-label">Select Your Device</label>
    <select id="device-select" name="device_id" class="form-control" required>
        <option value="" disabled selected>-- Select a device --</option>
        @foreach($devices as $device)
            <option value="{{ $device->id }}" {{ (request('device_id') == $device->id || old('device_id') == $device->id) ? 'selected' : '' }}>
                {{ $device->name }} - {{ $device->brand }} ({{ $device->type }})
            </option>
        @endforeach
    </select>
</div>

        <div class="form-group">
            <label class="form-label">Problem Description</label>
            <textarea name="problem_description"
                      class="form-control"
                      rows="5"
                      placeholder="Example: Phone cannot charge, screen cracked, fridge not cold..."
                      required>{{ request('problem_description') ?? old('problem_description') }}</textarea>
        </div>

        <div class="form-group">
            <label class="form-label">Preferred Visit Date</label>
            <input type="date"
                   name="visit_date"
                   class="form-control"
                   value="{{ old('visit_date') }}"
                   min="{{ now()->toDateString() }}"
                   required>
            <span class="field-hint">If no technician is available on this date, you can provide another date below.</span>
        </div>

        <div class="form-group">
            <label class="form-label">Alternative Visit Date</label>
            <input type="date"
                   name="alternative_visit_date"
                   class="form-control"
                   value="{{ old('alternative_visit_date') }}"
                   min="{{ now()->toDateString() }}">
            <span class="field-hint">Optional. This date will only be used when the preferred date has no available technician.</span>
        </div>

        <div style="margin-top: 32px;">
            <button type="submit" class="submit-btn">
                <i class="bi bi-send"></i> Submit Visit Request
            </button>
        </div>
    </form>
</div>

<script>
    new TomSelect('#device-select', {
        // Remove or comment out the placeholder option
        // placeholder: 'Search or select a device...',  // REMOVE THIS LINE
        
        allowEmptyOption: false,  // Set to false since you have a disabled placeholder
        searchField: ['text'],
        sortField: [{ field: 'text', direction: 'asc' }],
        create: false,
        render: {
            no_results: function(data, escape) {
                return '<div class="no-results">No device found matching "' + escape(data.input) + '"</div>';
            },
        }
    });
</script>

@endsection
