@extends('layouts.technician')

@section('title', 'Availability')

@section('content')

<style>
    .availability-dashboard {
        max-width: 1300px;
        margin: 0 auto;
    }

    .modern-header {
        position: relative;
        background: linear-gradient(135deg, #0f5132, #145c45);
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
        flex-wrap: wrap;
    }
    .modern-header .icon-wrapper {
        background: linear-gradient(135deg, #34d399, #0f5132);
        width: 72px;
        height: 72px;
        border-radius: 20px;
        display: flex;
        align-items: center;
        justify-content: center;
        font-size: 2rem;
        color: white;
        box-shadow: 0 10px 15px -3px rgba(15, 81, 50, 0.4);
        flex-shrink: 0;
    }
    .modern-header .header-title {
        font-size: 2.2rem;
        font-weight: 800;
        margin: 0 0 8px 0;
        letter-spacing: -0.025em;
        color: #ffffff;
    }
    .modern-header .header-subtitle {
        font-size: 1.05rem;
        color: #d1fae5;
        margin: 0;
        max-width: 650px;
        line-height: 1.5;
    }
    .modern-header .header-decoration {
        position: absolute;
        top: -50%;
        right: -10%;
        width: 400px;
        height: 400px;
        background: radial-gradient(circle, rgba(52, 211, 153, 0.18) 0%, rgba(15, 81, 50, 0) 70%);
        border-radius: 50%;
        z-index: 1;
        pointer-events: none;
    }

    .badge-tech {
        background: white;
        padding: 8px 16px;
        border-radius: 40px;
        font-size: 13px;
        font-weight: 700;
        color: #374151;
        border: 1px solid #e5e7eb;
        box-shadow: var(--shadow);
    }

    .add-card {
        background: white;
        border-radius: 16px;
        padding: 30px;
        margin-bottom: 35px;
        box-shadow: var(--shadow);
        border: 1px solid #e5e7eb;
    }

    .form-grid {
        display: grid;
        grid-template-columns: 1.5fr 1.5fr 2fr 1fr;
        gap: 20px;
        align-items: flex-end;
    }

    .input-group {
        display: flex;
        flex-direction: column;
    }

    .input-group label {
        display: block;
        font-size: 12px;
        font-weight: 700;
        text-transform: uppercase;
        letter-spacing: .05em;
        color: #111827;
        margin-bottom: 8px;
    }

    .input-group input,
    .input-group select {
        width: 100%;
        padding: 12px;
        border-radius: 8px;
        border: 1px solid #cbd5e1;
        background: white;
        font-weight: 500;
        font-size: 14px;
        color: #1f2937;
        font-family: 'Mukta Mahee', sans-serif;
        transition: border-color 0.2s, box-shadow 0.2s;
    }
    .input-group input:focus,
    .input-group select:focus {
        outline: none;
        border-color: var(--blue);
        box-shadow: 0 0 0 3px rgba(37, 99, 235, 0.15);
    }

    .btn-primary {
        background: linear-gradient(135deg, var(--green) 0%, #15803d 100%);
        border: none;
        padding: 13px 20px;
        border-radius: 8px;
        font-weight: 700;
        color: white;
        cursor: pointer;
        transition: all 0.2s ease;
        display: flex;
        align-items: center;
        justify-content: center;
        gap: 8px;
        text-transform: uppercase;
        font-size: 13px;
        letter-spacing: 0.05em;
    }

    .btn-primary:hover {
        transform: translateY(-1px);
        box-shadow: 0 4px 12px rgba(22, 163, 74, 0.2);
    }

    .availability-section {
        background: white;
        border-radius: 16px;
        padding: 30px;
        box-shadow: var(--shadow);
        border: 1px solid #e5e7eb;
    }

    .section-header {
        display: flex;
        justify-content: space-between;
        align-items: center;
        flex-wrap: wrap;
        margin-bottom: 25px;
        border-bottom: 1px solid #e5e7eb;
        padding-bottom: 15px;
    }

    .section-header h2 {
        font-size: 24px;
        color: #111827;
        display: flex;
        align-items: center;
        gap: 10px;
    }

    .days-count {
        background: #eff6ff;
        padding: 4px 14px;
        border-radius: 40px;
        font-size: 12px;
        font-weight: 700;
        color: var(--blue);
    }

    .cards-grid {
        display: grid;
        grid-template-columns: repeat(auto-fill, minmax(280px, 1fr));
        gap: 20px;
    }

    .unavailable-card {
        background: #fff;
        border-radius: 12px;
        box-shadow: 0 4px 6px rgba(0,0,0,0.02);
        border: 1px solid #e5e7eb;
        overflow: hidden;
        transition: .25s;
        display: flex;
        flex-direction: column;
    }

    .unavailable-card:hover {
        transform: translateY(-4px);
        box-shadow: 0 15px 25px rgba(0,0,0,0.05);
        border-color: #cbd5e1;
    }

    .card-header {
        background: #f8fafc;
        padding: 16px 20px;
        border-bottom: 1px solid #e2e8f0;
        display: flex;
        justify-content: space-between;
        align-items: center;
        gap: 10px;
    }

    .day-badge {
        font-weight: 700;
        font-size: 14px;
        color: #1e293b;
        display: flex;
        align-items: center;
        gap: 6px;
    }

    .reason-badge {
        background: #f1f5f9;
        padding: 4px 10px;
        border-radius: 20px;
        font-size: 12px;
        font-weight: 700;
        color: #475569;
    }

    .card-body {
        padding: 20px;
        flex-grow: 1;
    }

    .info-row {
        display: flex;
        align-items: center;
        gap: 10px;
        font-size: 14px;
        color: #4b5563;
        margin-bottom: 8px;
    }

    .info-row i {
        color: #64748b;
        font-size: 16px;
    }

    .card-actions {
        display: flex;
        justify-content: flex-end;
        gap: 8px;
        padding: 15px 20px;
        border-top: 1px solid #f1f5f9;
        background: #fafafa;
    }

    .edit-btn,
    .delete-btn {
        border: none;
        font-size: 11px;
        font-weight: 700;
        padding: 6px 12px;
        border-radius: 6px;
        cursor: pointer;
        display: flex;
        align-items: center;
        gap: 6px;
        text-transform: uppercase;
        letter-spacing: 0.05em;
        transition: all 0.2s ease;
    }

    .edit-btn {
        color: var(--blue);
        background: #eff6ff;
        border: 1px solid #bfdbfe;
    }
    .edit-btn:hover {
        background: #dbeafe;
    }

    .delete-btn {
        color: var(--red);
        background: #fff1ed;
        border: 1px solid #fecaca;
    }
    .delete-btn:hover {
        background: #fee2e2;
    }

    .empty-message {
        grid-column: 1 / -1;
        text-align: center;
        padding: 45px 20px;
        background: #fafafa;
        border-radius: 12px;
        color: #64748b;
        border: 1px dashed #cbd5e1;
    }

    /* Modal Overlay with Blur */
    .modal-overlay {
        position: fixed;
        inset: 0;
        background: rgba(15, 23, 42, 0.4);
        backdrop-filter: blur(8px);
        display: none;
        align-items: center;
        justify-content: center;
        z-index: 2000;
        opacity: 0;
        transition: opacity 0.3s ease;
    }

    .modal-overlay.active {
        opacity: 1;
    }

    .modal {
        background: white;
        max-width: 440px;
        width: 90%;
        border-radius: 16px;
        padding: 30px;
        box-shadow: 0 25px 50px -12px rgba(0, 0, 0, 0.25);
        border: 1px solid #cbd5e1;
        transform: translateY(-20px);
        transition: transform 0.3s ease;
    }

    .modal-overlay.active .modal {
        transform: translateY(0);
    }

    .modal h3 {
        font-size: 22px;
        margin-bottom: 20px;
        color: #111827;
        font-family: 'Playfair Display', serif;
    }

    .modal-buttons {
        display: flex;
        justify-content: flex-end;
        gap: 12px;
        margin-top: 24px;
    }

    .btn-secondary {
        background: #f1f5f9;
        border: 1px solid #cbd5e1;
        padding: 8px 16px;
        border-radius: 8px;
        font-weight: 700;
        cursor: pointer;
        color: #475569;
        transition: all 0.2s ease;
        text-transform: uppercase;
        font-size: 11px;
        letter-spacing: 0.05em;
    }
    .btn-secondary:hover {
        background: #e2e8f0;
    }

    .btn-save {
        background: var(--blue);
        color: white;
        border: none;
        padding: 8px 20px;
        border-radius: 8px;
        font-weight: 700;
        cursor: pointer;
        transition: all 0.2s ease;
        text-transform: uppercase;
        font-size: 11px;
        letter-spacing: 0.05em;
    }
    .btn-save:hover {
        background: #1d4ed8;
    }

    @media(max-width: 900px) {
        .form-grid {
            grid-template-columns: 1fr;
            gap: 15px;
        }
        .btn-primary {
            width: 100%;
        }
    }
</style>

<div class="availability-dashboard">

    <div class="modern-header">
        <div class="header-content">
            <div class="icon-wrapper">
                <i class="bi bi-calendar-x-fill"></i>
            </div>
            <div>
                <h1 class="header-title">Unavailability Manager</h1>
                <p class="header-subtitle">Block days you cannot work to keep your repair schedule clear.</p>
            </div>
        </div>
        <div class="header-decoration"></div>
    </div>

    <div class="add-card">
        <form method="POST" action="{{ route('technician.availability.store') }}">
            @csrf

            <div class="form-grid">
                <div class="input-group">
                    <label>Start Date</label>
                    <input type="date" name="unavailable_date" id="startDate" min="{{ date('Y-m-d') }}" required>
                </div>

                <div class="input-group">
                    <label>End Date</label>
                    <input type="date" name="unavailable_end_date" id="endDate" min="{{ date('Y-m-d') }}">
                </div>

                <div class="input-group">
                    <label>Reason</label>
                    <select name="reason">
                        <option value="Personal day off">Personal day off</option>
                        <option value="Sick leave">Sick leave</option>
                        <option value="Training / Certification">Training / Certification</option>
                        <option value="Holiday">Holiday</option>
                        <option value="Family emergency">Family emergency</option>
                        <option value="Other">Other</option>
                    </select>
                </div>

                <button type="submit" class="btn-primary">
                    <i class="bi bi-plus-circle"></i> Block Days
                </button>
            </div>
        </form>
    </div>

    <div class="availability-section">
        <div class="section-header">
            <h2><i class="bi bi-calendar-x"></i> Blocked Days</h2>
            <div class="days-count">{{ $availabilities->count() }} blocked period(s)</div>
        </div>

        <div class="cards-grid">
            @forelse($availabilities as $availability)
                <div class="unavailable-card">
                    <div class="card-header">
                        <span class="day-badge">
                            <i class="bi bi-calendar-event" style="color: var(--blue);"></i>
                            {{ $availability->display_date_range }}
                        </span>

                        <span class="reason-badge">
                            {{ $availability->reason ?? 'No reason specified' }}
                        </span>
                    </div>

                    <div class="card-body">
                        <div class="info-row">
                            <i class="bi bi-info-circle"></i>
                            <span>Status: <strong>Unavailable</strong> (Full day)</span>
                        </div>

                        <div class="info-row">
                            <i class="bi bi-clock-history"></i>
                            <span>No customer visits allocated</span>
                        </div>
                    </div>

                    <div class="card-actions">
                        <button type="button" class="edit-btn"
                                onclick="openEditModal(
                                    @js($availability->id),
                                    @js($availability->unavailable_date->format('Y-m-d')),
                                    @js(($availability->unavailable_end_date ?? $availability->unavailable_date)->format('Y-m-d')),
                                    @js($availability->reason)
                                )">
                            <i class="bi bi-pencil-square"></i> Edit
                        </button>

                        <form method="POST"
                              action="{{ route('technician.availability.delete', $availability->id) }}"
                              onsubmit="return confirm('Remove this blocked day?')">
                            @csrf
                            @method('DELETE')

                            <button type="submit" class="delete-btn">
                                <i class="bi bi-trash3-fill"></i> Delete
                            </button>
                        </form>
                    </div>
                </div>
            @empty
                <div class="empty-message">
                    <i class="bi bi-emoji-smile" style="font-size:36px; color: var(--green); display: block; margin-bottom: 12px;"></i>
                    <p style="margin: 0; font-weight: 600;">No blocked days — you are fully available! 🟢</p>
                    <p style="color: #6b7280; font-size: 13px; margin-top: 4px;">Use the scheduler above to add days you cannot accept repairs.</p>
                </div>
            @endforelse
        </div>
    </div>

</div>

<div id="editModal" class="modal-overlay">
    <div class="modal">
        <h3><i class="bi bi-pencil-square"></i> Edit Blocked Day</h3>

        <form id="editForm" method="POST">
            @csrf
            @method('PUT')

            <div class="input-group" style="width:100%; margin-bottom:18px;">
                <label>Start Date</label>
                <input type="date" name="unavailable_date" id="editDate" min="{{ date('Y-m-d') }}" required>
            </div>

            <div class="input-group" style="width:100%; margin-bottom:18px;">
                <label>End Date</label>
                <input type="date" name="unavailable_end_date" id="editEndDate" min="{{ date('Y-m-d') }}">
            </div>

            <div class="input-group" style="width:100%; margin-bottom:18px;">
                <label>Reason</label>
                <select name="reason" id="editReason">
                    <option value="Personal day off">Personal day off</option>
                    <option value="Sick leave">Sick leave</option>
                    <option value="Training / Certification">Training / Certification</option>
                    <option value="Holiday">Holiday</option>
                    <option value="Family emergency">Family emergency</option>
                    <option value="Other">Other</option>
                </select>
            </div>

            <div class="modal-buttons">
                <button type="button" class="btn-secondary" onclick="closeEditModal()">Cancel</button>
                <button type="submit" class="btn-save">Save Changes</button>
            </div>
        </form>
    </div>
</div>

<script>
    const startDateInput = document.getElementById('startDate');
    const endDateInput = document.getElementById('endDate');
    const editDateInput = document.getElementById('editDate');
    const editEndDateInput = document.getElementById('editEndDate');

    function syncEndDateMin(startInput, endInput) {
        if (!startInput || !endInput) {
            return;
        }

        endInput.min = startInput.value || startInput.min;
        if (endInput.value && startInput.value && endInput.value < startInput.value) {
            endInput.value = startInput.value;
        }
    }

    startDateInput?.addEventListener('change', function () {
        syncEndDateMin(startDateInput, endDateInput);
    });

    editDateInput?.addEventListener('change', function () {
        syncEndDateMin(editDateInput, editEndDateInput);
    });

    function openEditModal(id, date, endDate, reason){
        editDateInput.value = date;
        editEndDateInput.value = endDate || date;
        syncEndDateMin(editDateInput, editEndDateInput);
        document.getElementById('editReason').value = reason || 'Other';

        document.getElementById('editForm').action = '/technician/availability/' + id;
        
        const overlay = document.getElementById('editModal');
        overlay.style.display = 'flex';
        // force reflow
        overlay.offsetHeight;
        overlay.classList.add('active');
    }

    function closeEditModal(){
        const overlay = document.getElementById('editModal');
        overlay.classList.remove('active');
        setTimeout(() => {
            overlay.style.display = 'none';
        }, 300);
    }

    document.getElementById('editModal').addEventListener('click', function(e){
        if(e.target === this){
            closeEditModal();
        }
    });
</script>

@endsection
