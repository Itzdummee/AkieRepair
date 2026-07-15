@extends('layouts.admin')

@section('content')
<style>
    .tech-list {
        display: flex;
        flex-direction: column;
        gap: 20px;
        margin-top: 25px;
    }
    .tech-item {
        background: #ffffff;
        border-radius: 16px;
        border: 1px solid #e5e7eb;
        padding: 24px;
        display: flex;
        flex-direction: row;
        gap: 24px;
        align-items: stretch;
        transition: all 0.3s cubic-bezier(0.4, 0, 0.2, 1);
        box-shadow: 0 4px 6px -1px rgba(0, 0, 0, 0.05);
    }
    .tech-item:hover {
        box-shadow: 0 20px 25px -5px rgba(0, 0, 0, 0.1);
        border-color: #3b82f6;
    }
    .tech-item-profile {
        display: flex;
        flex-direction: column;
        align-items: center;
        width: 160px;
        flex-shrink: 0;
        border-right: 1px solid #f3f4f6;
        padding-right: 24px;
    }
    .tech-avatar-container {
        position: relative;
        width: 110px;
        height: 110px;
        margin-bottom: 16px;
    }
    .tech-avatar {
        width: 100%;
        height: 100%;
        border-radius: 50%;
        object-fit: cover;
        border: 4px solid #f3f4f6;
        box-shadow: 0 4px 6px -1px rgba(0, 0, 0, 0.1);
    }
    .tech-avatar-placeholder {
        width: 100%;
        height: 100%;
        border-radius: 50%;
        background: linear-gradient(135deg, #3b82f6, #8b5cf6);
        color: white;
        display: flex;
        align-items: center;
        justify-content: center;
        font-size: 2.2rem;
        font-weight: 700;
        border: 4px solid #f3f4f6;
        box-shadow: 0 4px 6px -1px rgba(0, 0, 0, 0.1);
    }
    .tech-badge {
        position: absolute;
        bottom: 0;
        right: 0;
        background: #10b981;
        color: white;
        padding: 4px 10px;
        border-radius: 9999px;
        font-size: 0.7rem;
        font-weight: 700;
        text-transform: uppercase;
        border: 2px solid white;
        box-shadow: 0 2px 4px rgba(0,0,0,0.1);
    }
    .tech-id {
        font-size: 0.8rem;
        color: #9ca3af;
        font-weight: 600;
        margin-bottom: 6px;
        letter-spacing: 0.05em;
    }
    .tech-name {
        font-size: 1.15rem;
        font-weight: 700;
        color: #111827;
        margin: 0 0 6px 0;
        text-align: center;
    }
    .tech-actions {
        display: flex;
        width: 100%;
        gap: 10px;
        margin-top: auto;
        padding-top: 16px;
    }
    .tech-actions .btn {
        flex: 1;
        text-align: center;
        padding: 8px 12px;
        font-size: 11px;
        border-radius: 8px;
        letter-spacing: 0.05em;
        margin: 0;
        display: inline-flex;
        align-items: center;
        justify-content: center;
        gap: 4px;
    }
    .tech-item-details {
        flex: 1;
        display: grid;
        grid-template-columns: 1fr 1fr;
        gap: 24px;
    }
    .tech-section {
        display: flex;
        flex-direction: column;
    }
    .section-title {
        font-size: 0.95rem;
        font-weight: 700;
        color: #374151;
        margin: 0 0 16px 0;
        display: flex;
        align-items: center;
        gap: 8px;
        padding-bottom: 8px;
        border-bottom: 1px solid #f3f4f6;
    }
    .section-title i {
        color: #3b82f6;
        font-size: 1.1rem;
    }
    .info-row {
        display: flex;
        align-items: center;
        gap: 10px;
        color: #4b5563;
        font-size: 0.9rem;
        margin-bottom: 12px;
    }
    .info-row i {
        color: #9ca3af;
        font-size: 1.1rem;
        width: 20px;
        text-align: center;
    }
    .tech-specialties {
        display: flex;
        flex-wrap: wrap;
        gap: 8px;
        margin-top: 4px;
    }
    .specialty-pill {
        background: #eff6ff;
        color: #1e40af;
        border: 1px solid #bfdbfe;
        padding: 4px 12px;
        border-radius: 9999px;
        font-size: 0.75rem;
        font-weight: 600;
    }
    .no-specialty {
        color: #9ca3af;
        font-size: 0.8rem;
        font-style: italic;
    }
    .avail-list {
        margin: 0;
        padding: 0;
        list-style: none;
    }
    .avail-item {
        display: flex;
        flex-direction: column;
        padding: 10px 14px;
        background: #f9fafb;
        border-radius: 8px;
        border: 1px solid #f3f4f6;
        margin-bottom: 8px;
    }
    .avail-date {
        font-weight: 700;
        color: #111827;
        font-size: 0.85rem;
        margin-bottom: 2px;
    }
    .avail-reason {
        color: #6b7280;
        font-size: 0.8rem;
    }
    .empty-state-box {
        display: flex;
        flex-direction: column;
        align-items: center;
        justify-content: center;
        padding: 24px;
        background: #f9fafb;
        border-radius: 8px;
        border: 1px dashed #d1d5db;
        text-align: center;
        height: 100%;
    }
    .avail-pagination {
        display: flex;
        justify-content: space-between;
        align-items: center;
        margin-top: 12px;
    }
    .avail-pagination button {
        background: #eff6ff;
        border: none;
        color: #3b82f6;
        width: 28px;
        height: 28px;
        border-radius: 50%;
        cursor: pointer;
        display: flex;
        align-items: center;
        justify-content: center;
        transition: background 0.2s;
    }
    .avail-pagination button:hover {
        background: #dbeafe;
    }
    @media(max-width: 900px) {
        .tech-item {
            flex-direction: column;
            align-items: center;
            gap: 16px;
        }
        .tech-item-profile {
            width: 100%;
            border-right: none;
            border-bottom: 1px solid #f3f4f6;
            padding-right: 0;
            padding-bottom: 24px;
        }
        .tech-item-details {
            grid-template-columns: 1fr;
            width: 100%;
        }
    }
    /* Specialty options grid */
    .specialty-options-grid {
        display: grid;
        grid-template-columns: repeat(auto-fill, minmax(130px, 1fr));
        gap: 10px;
        margin-bottom: 20px;
        margin-top: 8px;
    }
    .specialty-option-card {
        cursor: pointer;
        display: block;
        margin: 0;
        height: 100%;
    }
    .specialty-checkbox {
        display: none;
    }
    .specialty-card-content {
        border: 1px solid #e2e8f0;
        border-radius: 8px;
        padding: 12px;
        display: flex;
        flex-direction: column;
        gap: 6px;
        transition: all 0.2s ease;
        background: #f8fafc;
        position: relative;
        height: 100%;
        box-sizing: border-box;
    }
    .specialty-checkbox:checked + .specialty-card-content {
        border-color: #2563eb;
        background: #eff6ff;
        box-shadow: 0 4px 6px -1px rgba(37, 99, 235, 0.1);
    }
    .specialty-checkbox:checked + .specialty-card-content .specialty-name {
        color: #1d4ed8;
    }
    .specialty-checkbox:checked + .specialty-card-content .checkbox-indicator {
        opacity: 1;
        transform: scale(1);
        color: #2563eb;
    }
    .specialty-name {
        font-weight: 600;
        color: #374151;
        font-size: 13px;
        line-height: 1.3;
        padding-right: 16px;
    }
    .checkbox-indicator {
        position: absolute;
        top: 10px;
        right: 10px;
        opacity: 0;
        transform: scale(0.5);
        transition: all 0.2s ease;
        font-size: 14px;
    }
</style>

<section>
    
        <div class="container">

            

            @if(session('delete'))
                <div id="popup" class="popup-message delete-popup">
                    {{ session('delete') }}
                </div>
            @endif

            @if($errors->any())
                <ul style="color:red; margin-bottom:20px; background:#fef2f2; border-left:4px solid #ef4444; padding:15px; list-style-position:inside; border-radius:8px;">
                    @foreach($errors->all() as $error)
                        <li>{{ $error }}</li>
                    @endforeach
                </ul>
            @endif

            <div class="panel" style="border-radius: 16px;">

                <div style="display:flex; justify-content:space-between; align-items:center; margin-bottom:25px;">
                    <h2 class="page-title" style="margin-bottom:0;">Technician Directory</h2>

                    <button type="button" class="btn green" onclick="openAddModal()" style="border-radius: 8px; padding: 10px 20px;">
                        + Add Technician
                    </button>
                </div>

                <div class="tech-list">
                    @forelse($technicians as $technician)
                        @php
                            $initials = '';
                            $names = explode(' ', $technician->name);
                            foreach ($names as $n) {
                                if($n) $initials .= substr($n, 0, 1);
                            }
                            $initials = strtoupper(substr($initials, 0, 2));
                            if(!$initials) $initials = 'T';
                        @endphp
                        <div class="tech-item">
                            <div class="tech-item-profile">
                                <div class="tech-avatar-container">
                                    @if($technician->profile_image)
                                        <img src="{{ str_starts_with($technician->profile_image, 'http') ? $technician->profile_image : asset($technician->profile_image) }}" alt="{{ $technician->name }}" class="tech-avatar">
                                    @else
                                        <div class="tech-avatar-placeholder">{{ $initials }}</div>
                                    @endif
                                    <span class="tech-badge" style="background-color: {{ $technician->is_active ? '#10b981' : '#dc2626' }}">
                                        {{ $technician->is_active ? ($technician->approval_status ?? 'Approved') : 'Inactive' }}
                                    </span>
                                </div>
                                <span class="tech-id">ID: {{ $technician->id }}</span>
                                <h3 class="tech-name">{{ $technician->name }}</h3>
                                
                                <div class="tech-actions">
                                    <button
                                        type="button"
                                        class="btn blue"
                                        onclick="openEditModal(
                                            '{{ $technician->id }}',
                                            @js($technician->name),
                                            @js($technician->email),
                                            @js($technician->phone_number),
                                            @js($technician->specialty),
                                            @js($technician->profile_image)
                                        )">
                                        <i class="bi bi-pencil-square"></i> Edit
                                    </button>

                                    <form
                                        method="POST"
                                        action="{{ route('admin.technicians.destroy', $technician->id) }}"
                                        style="display:inline; flex: 1; margin: 0;"
                                        onsubmit="return confirm('{{ $technician->is_active ? 'Deactivate' : 'Activate' }} this technician?')">
                                        @csrf
                                        @method('DELETE')
                                        <button type="submit" class="btn red" style="width: 100%;">
                                            <i class="bi {{ $technician->is_active ? 'bi-pause-circle-fill' : 'bi-play-circle-fill' }}"></i>
                                            {{ $technician->is_active ? 'Deactivate' : 'Activate' }}
                                        </button>
                                    </form>
                                </div>
                            </div>
                            
                            <div class="tech-item-details">
                                <div class="tech-section">
                                    <h4 class="section-title"><i class="bi bi-person-lines-fill"></i> Contact & Expertise</h4>
                                    
                                    <div class="info-row">
                                        <i class="bi bi-envelope-fill"></i>
                                        <span>{{ $technician->email }}</span>
                                    </div>
                                    <div class="info-row" style="margin-bottom: 24px;">
                                        <i class="bi bi-telephone-fill"></i>
                                        <span>{{ $technician->phone_number ?? '-' }}</span>
                                    </div>

                                    <h5 style="font-size: 0.8rem; color: #6b7280; text-transform: uppercase; letter-spacing: 0.05em; margin: 0 0 8px 0;">Specialties</h5>
                                    <div class="tech-specialties">
                                        @if($technician->specialty)
                                            @foreach(explode(',', $technician->specialty) as $specialtyItem)
                                                @if(trim($specialtyItem))
                                                    <span class="specialty-pill">{{ trim($specialtyItem) }}</span>
                                                @endif
                                            @endforeach
                                        @else
                                            <span class="no-specialty">No specialty specified</span>
                                        @endif
                                    </div>
                                </div>

                                <div class="tech-section">
                                    <h4 class="section-title"><i class="bi bi-calendar2-week-fill"></i> Availability Schedule</h4>
                                    
                                    @if($technician->availabilities->count() > 0)
                                        <div id="availability_{{ $technician->id }}" data-current-page="1" data-total-items="{{ $technician->availabilities->count() }}">
                                            <ul class="avail-list">
                                                @foreach($technician->availabilities as $index => $availability)
                                                    <li class="avail-item" style="{{ $index >= 3 ? 'display:none;' : '' }}">
                                                        <div class="avail-date">{{ $availability->display_date_range }}</div>
                                                        <div class="avail-reason">{{ $availability->reason }}</div>
                                                    </li>
                                                @endforeach
                                            </ul>
                                            @if($technician->availabilities->count() > 3)
                                                <div class="avail-pagination">
                                                    <button type="button" class="prev-btn" onclick="paginateAvailability('{{ $technician->id }}', -1)" style="display: none;"><i class="bi bi-chevron-left"></i></button>
                                                    <span class="page-indicator" style="font-size: 0.8rem; color: #6b7280; font-weight: 600;">1 / {{ ceil($technician->availabilities->count() / 3) }}</span>
                                                    <button type="button" class="next-btn" onclick="paginateAvailability('{{ $technician->id }}', 1)"><i class="bi bi-chevron-right"></i></button>
                                                </div>
                                            @endif
                                        </div>
                                    @else
                                        <div class="empty-state-box">
                                            <i class="bi bi-calendar-check" style="font-size: 2rem; color: #10b981; margin-bottom: 8px;"></i>
                                            <span style="font-weight: 600; color: #374151;">Technician is fully available</span>
                                            <span style="font-size: 0.8rem; color: #6b7280;">No unavailable dates recorded</span>
                                        </div>
                                    @endif
                                </div>
                            </div>
                        </div>
                    @empty
                        <div style="text-align: center; padding: 40px; color: #6b7280; font-size: 1.1rem;">
                            No technicians found. Click "Add Technician" to create one.
                        </div>
                    @endforelse
                </div>

            </div>

        </div>

</section>

<div id="technicianModal" class="modal-overlay hide">

    <div class="modal-box" style="border-radius: 16px;">

        <div style="display:flex; justify-content:space-between; align-items:center; margin-bottom: 20px;">
            <div>
                <span class="badge" style="background:#e0e7ff; color:#4338ca;">Technician Manager</span>
                <h3 id="formTitle" style="font-size:28px; margin-top:6px;">
                    Add Technician
                </h3>
            </div>

            <button type="button" class="modal-close" onclick="closeModal()">×</button>
        </div>

        <form id="technicianForm" method="POST" action="{{ route('admin.technicians.store') }}" enctype="multipart/form-data">
            @csrf

            <input type="hidden" id="methodField" name="_method" value="POST">

            <label>Name</label>
            <input type="text" name="name" id="name" placeholder="Example: Ahmad Technician" required style="border-radius: 8px;">

            <label>Email</label>
            <input type="email" name="email" id="email" placeholder="Example: technician@email.com" required style="border-radius: 8px;">

            <label>Phone Number</label>
            <input type="text" name="phone_number" id="phone_number" placeholder="Example: 60123456789" maxlength="11" pattern="[0-9]{1,11}" title="Phone number must be between 1 and 11 digits containing only numbers" oninput="this.value = this.value.replace(/[^0-9]/g, '')" style="border-radius: 8px;">

            <label>Specialties</label>
            <div class="specialty-options-grid">
                @foreach($services as $service)
                    <label class="specialty-option-card">
                        <input type="checkbox" name="specialties[]" value="{{ $service->service_type }}" class="specialty-checkbox">
                        <div class="specialty-card-content">
                            <div style="display:flex; justify-content: space-between; align-items: start;">
                                <span class="specialty-name">{{ $service->service_type }}</span>
                                <div class="checkbox-indicator">
                                    <i class="bi bi-check-circle-fill"></i>
                                </div>
                            </div>
                        </div>
                    </label>
                @endforeach
            </div>

            <label>Profile Image</label>
            <input type="file" name="profile_image" id="profile_image" accept="image/*" onchange="previewFile()" style="border-radius: 8px;">
            
            <div id="imagePreviewContainer" style="margin-top: 10px; margin-bottom: 20px; display: none; align-items: center; gap: 12px; background: #f8fafc; padding: 10px; border-radius: 12px; border: 1px solid #e2e8f0;">
                <img id="imagePreview" src="" style="width: 65px; height: 65px; border-radius: 50%; object-fit: cover; border: 2px solid #fff; box-shadow: 0 4px 6px -1px rgba(0,0,0,0.1);">
                <div>
                    <span style="font-size: 13px; font-weight: 600; color: #334155; display: block;">Profile Image Preview</span>
                    <span style="font-size: 11px; color: #64748b;">Selected image file</span>
                </div>
            </div>

            <label>Password</label>
            <input type="password" name="password" id="password" placeholder="Minimum 6 characters" style="border-radius: 8px;">

            <small id="passwordHelp" style="display:block; margin-top: -6px; margin-bottom:20px; color:#64748b; font-size: 12px;">
                Required for new technician. Leave empty when updating if password is unchanged.
            </small>

            <div style="display: flex; gap: 12px; margin-top: 20px;">
                <button type="submit" class="btn green" id="submitBtn" style="flex: 1; border-radius: 8px; padding: 12px;">
                    Add
                </button>

                <button type="button" class="btn gray" onclick="closeModal()" style="flex: 1; border-radius: 8px; padding: 12px;">
                    Cancel
                </button>
            </div>
        </form>

    </div>

</div>

<script>
    function openAddModal() {
        resetForm();
        document.getElementById('technicianModal').classList.remove('hide');
    }

    function openEditModal(id, name, email, phoneNumber, specialty, profileImage) {
        document.getElementById('technicianModal').classList.remove('hide');

        document.getElementById('formTitle').innerText = 'Update Technician';
        document.getElementById('submitBtn').innerText = 'Update';

        document.getElementById('name').value = name ?? '';
        document.getElementById('email').value = email ?? '';
        document.getElementById('phone_number').value = phoneNumber ?? '';
        document.getElementById('password').value = '';

        document.querySelectorAll('.specialty-checkbox').forEach(cb => cb.checked = false);
        if (specialty) {
            const selectedSpecialties = specialty.split(',').map(s => s.trim());
            document.querySelectorAll('.specialty-checkbox').forEach(cb => {
                if (selectedSpecialties.includes(cb.value)) {
                    cb.checked = true;
                }
            });
        }

        document.getElementById('password').required = false;

        document.getElementById('technicianForm').action = '/admin/technicians/' + id;
        document.getElementById('methodField').value = 'PUT';

        const previewContainer = document.getElementById('imagePreviewContainer');
        const previewImage = document.getElementById('imagePreview');
        if (profileImage) {
            previewImage.src = /^https?:\/\//i.test(profileImage) ? profileImage : '/' + profileImage;
            previewContainer.style.display = 'flex';
        } else {
            previewContainer.style.display = 'none';
            previewImage.src = '';
        }
        document.getElementById('profile_image').value = '';
    }

    function closeModal() {
        document.getElementById('technicianModal').classList.add('hide');
    }

    function resetForm() {
        document.getElementById('formTitle').innerText = 'Add Technician';
        document.getElementById('submitBtn').innerText = 'Add';

        document.getElementById('technicianForm').action = '{{ route('admin.technicians.store') }}';
        document.getElementById('methodField').value = 'POST';

        document.getElementById('name').value = '';
        document.getElementById('email').value = '';
        document.getElementById('phone_number').value = '';
        document.getElementById('password').value = '';

        document.querySelectorAll('.specialty-checkbox').forEach(cb => cb.checked = false);

        document.getElementById('password').required = true;

        document.getElementById('imagePreviewContainer').style.display = 'none';
        document.getElementById('imagePreview').src = '';
        document.getElementById('profile_image').value = '';
    }

    function previewFile() {
        const preview = document.getElementById('imagePreview');
        const container = document.getElementById('imagePreviewContainer');
        const file = document.getElementById('profile_image').files[0];
        const reader = new FileReader();

        reader.onloadend = function () {
            preview.src = reader.result;
            container.style.display = 'flex';
        }

        if (file) {
            reader.readAsDataURL(file);
        }
    }

    function paginateAvailability(techId, direction) {
        const container = document.getElementById('availability_' + techId);
        let currentPage = parseInt(container.getAttribute('data-current-page'));
        const totalItems = parseInt(container.getAttribute('data-total-items'));
        const itemsPerPage = 3;
        const totalPages = Math.ceil(totalItems / itemsPerPage);

        currentPage += direction;
        if (currentPage < 1) currentPage = 1;
        if (currentPage > totalPages) currentPage = totalPages;

        container.setAttribute('data-current-page', currentPage);

        const items = container.querySelectorAll('.avail-item');
        const startIndex = (currentPage - 1) * itemsPerPage;
        const endIndex = startIndex + itemsPerPage;

        items.forEach((item, index) => {
            if (index >= startIndex && index < endIndex) {
                item.style.display = 'list-item';
            } else {
                item.style.display = 'none';
            }
        });

        const prevBtn = container.querySelector('.prev-btn');
        const nextBtn = container.querySelector('.next-btn');
        const indicator = container.querySelector('.page-indicator');

        if (currentPage === 1) {
            prevBtn.style.display = 'none';
        } else {
            prevBtn.style.display = 'inline-block';
        }

        if (currentPage === totalPages) {
            nextBtn.style.display = 'none';
        } else {
            nextBtn.style.display = 'inline-block';
        }

        indicator.innerText = `${currentPage} / ${totalPages}`;
    }

    setTimeout(function(){
        const popup = document.getElementById('popup');

        if(popup){
            popup.style.display = 'none';
        }
    },2500);
</script>
@endsection
