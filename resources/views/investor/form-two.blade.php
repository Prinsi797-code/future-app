@extends('layouts.app')
<link href="https://cdn.jsdelivr.net/npm/select2@4.1.0-rc.0/dist/css/select2.min.css" rel="stylesheet" />
<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/flatpickr/4.6.13/flatpickr.min.css">
<script src="https://cdnjs.cloudflare.com/ajax/libs/flatpickr/4.6.13/flatpickr.min.js"></script>
@section('title', 'Investor Registration - Future Taikun')
<style>
    /* Form Step Styles */
    .form-step {
        display: none;
    }

    .form-step.active {
        display: block;
    }

    /* Original styles from your template */
    .business-stage-toggle {
        display: flex;
        gap: 8px;
    }

    .business-stage-toggle .btn {
        border-radius: 12px !important;
        padding: 0.375rem 1rem;
    }

    .error-message {
        color: #dc3545;
        font-size: 12px;
        margin-top: 5px;
    }

    .form-group {
        margin-bottom: 20px;
    }

    .form-group label {
        display: block;
        margin-bottom: 5px;
        font-weight: 500;
        color: #6c757d;
    }

    .hero-image {
        background: url('/register-banner1.jpg') no-repeat center center;
        background-size: cover;
        min-height: 300px;
        position: relative;
        display: flex;
        align-items: center;
        justify-content: center;
    }

    .hero-image::before {
        content: '';
        position: absolute;
        top: 0;
        left: 0;
        right: 0;
        bottom: 0;
        background: rgba(128, 127, 127, 0.3);
    }

    .hero-content {
        position: relative;
        z-index: 2;
        text-align: center;
    }

    .hero-content h4 {
        color: white;
    }

    .step-navigation {
        display: flex;
        justify-content: space-between;
        margin-top: 30px;
    }

    .btn-step {
        min-width: 120px;
        border-radius: 50px;
    }

    #prevBtn:hover {
        color: white;
        background-color: rgb(108, 117, 125);
    }

    /* Select2 Bootstrap 5 Theme Fix */
    .select2-container {
        width: 100% !important;
    }

    .select2-container--default .select2-selection--single {
        height: calc(3.5rem + 2px) !important;
        padding: 1rem 0.75rem !important;
        border: 1px solid #ced4da !important;
        border-radius: 0.5rem !important;
        background-color: #fff !important;
        font-size: 1rem !important;
        line-height: 1.5 !important;
    }

    .select2-container--default .select2-selection--single .select2-selection__rendered {
        color: #212529 !important;
        padding-left: 0 !important;
        padding-right: 0 !important;
        line-height: 1.5 !important;
    }

    .select2-container--default .select2-selection--single .select2-selection__arrow {
        height: calc(3.5rem + 2px) !important;
        right: 0.75rem !important;
    }

    .select2-container--default .select2-selection--single .select2-selection__placeholder {
        color: #6c757d !important;
    }

    /* Multiple Select Fix */
    .select2-container--default .select2-selection--multiple {
        min-height: calc(3.5rem + 2px) !important;
        padding: 0.5rem 0.75rem !important;
        border: 1px solid #ced4da !important;
        border-radius: 0.5rem !important;
        background-color: #fff !important;
        font-size: 1rem !important;
    }

    .select2-container--default .select2-selection--multiple .select2-selection__choice {
        background-color: #e9ecef !important;
        border: 1px solid #ced4da !important;
        border-radius: 0.375rem !important;
        padding: 0.25rem 0.5rem !important;
        margin: 0.125rem !important;
        font-size: 0.875rem !important;
        color: #212529 !important;
    }

    .select2-container--default .select2-selection--multiple .select2-selection__choice__remove {
        color: #6c757d !important;
        margin-right: 0.5rem !important;
    }

    .select2-container--default .select2-selection--multiple .select2-selection__choice__remove:hover {
        color: #dc3545 !important;
    }

    /* Dropdown styling */
    .select2-dropdown {
        border: 1px solid #ced4da !important;
        border-radius: 0.5rem !important;
        box-shadow: 0 0.5rem 1rem rgba(0, 0, 0, 0.15) !important;
    }

    .select2-container--default .select2-results__option {
        padding: 0.5rem 0.75rem !important;
        font-size: 1rem !important;
        color: #212529 !important;
    }

    .select2-container--default .select2-results__option--highlighted[aria-selected] {
        background-color: #0d6efd !important;
        color: #fff !important;
    }

    .select2-container--default .select2-results__option[aria-selected=true] {
        background-color: #e9ecef !important;
        color: #212529 !important;
    }

    /* Focus states */
    .select2-container--default.select2-container--focus .select2-selection--single,
    .select2-container--default.select2-container--focus .select2-selection--multiple {
        border-color: #86b7fe !important;
        box-shadow: 0 0 0 0.25rem rgba(13, 110, 253, 0.25) !important;
    }

    /* Search input styling */
    .select2-search--dropdown .select2-search__field {
        padding: 0.5rem 0.75rem !important;
        border: 1px solid #ced4da !important;
        border-radius: 0.375rem !important;
        font-size: 1rem !important;
        margin: 0.5rem !important;
        width: calc(100% - 1rem) !important;
    }

    .select2-search--inline .select2-search__field {
        padding: 0.25rem 0.5rem !important;
        border: none !important;
        font-size: 1rem !important;
        margin: 0.125rem !important;
        min-width: 150px !important;
    }

    /* Radio button styling */
    .business-stage-toggle {
        display: flex;
        gap: 0.5rem;
        margin-top: 0.5rem;
    }

    .business-stage-toggle input[type="radio"] {
        display: none;
    }

    .business-stage-toggle label {
        padding: 0.5rem 1rem;
        border: 2px solid #dee2e6;
        border-radius: 0.375rem;
        cursor: pointer;
        transition: all 0.2s ease;
        font-weight: 500;
    }

    .business-stage-toggle input[type="radio"]:checked+label {
        background-color: #0d6efd;
        border-color: #0d6efd;
        color: #fff;
    }

    .business-stage-toggle label:hover {
        border-color: #0d6efd;
        background-color: #e7f1ff;
    }

    .business-stage-toggle input[type="radio"]:checked+label:hover {
        background-color: #0d6efd;
        color: #fff;
    }

    /* Card styling */
    .card {
        border: none;
        box-shadow: 0 0.125rem 0.25rem rgba(0, 0, 0, 0.075);
        border-radius: 1rem;
    }

    .card-body {
        padding: 2rem;
    }

    /* Form styling improvements */
    .form-check {
        margin-bottom: 1rem;
    }

    .form-check-input:checked {
        background-color: #0d6efd;
        border-color: #0d6efd;
    }

    .btn {
        padding: 0.75rem 1.5rem;
        border-radius: 0.5rem;
        font-weight: 500;
        transition: all 0.2s ease;
    }

    .btn-outline-secondary:hover {
        background-color: #6c757d;
        border-color: #6c757d;
        color: #fff;
    }

    /* Responsive fixes */
    @media (max-width: 768px) {
        .card-body {
            padding: 1.5rem;
        }

        .select2-container--default .select2-selection--single {
            height: calc(3rem + 2px) !important;
            padding: 0.75rem !important;
        }

        .select2-container--default .select2-selection--multiple {
            min-height: calc(3rem + 2px) !important;
            padding: 0.5rem !important;
        }
    }

    /* Error styling */
    .text-danger {
        font-size: 0.875rem;
        margin-top: 0.25rem;
    }

    /* Remove default select appearance in floating labels */
    .form-floating-custom .form-select {
        appearance: none;
        background-image: url("data:image/svg+xml,%3csvg xmlns='http://www.w3.org/2000/svg' viewBox='0 0 16 16'%3e%3cpath fill='none' stroke='%23343a40' stroke-linecap='round' stroke-linejoin='round' stroke-width='2' d='m1 6 7 7 7-7'/%3e%3c/svg%3e");
        background-repeat: no-repeat;
        background-position: right 0.75rem center;
        background-size: 16px 12px;
        padding-right: 2.5rem;
    }

    .select2-container--default .select2-selection--multiple .select2-selection__choice__display {
        padding-left: 15px !important;
    }

    .btn[type="submit"] {
        display: inline-block !important;
        visibility: visible !important;
    }

    .select2-search__field {
        height: 26px !important;
    }

    .upload-section {
        margin-bottom: 40px;
        padding: 20px;
        border: 1px solid #e9ecef;
        border-radius: 8px;
    }

    .remove-image {
        position: absolute;
        top: 2px;
        right: 4px;
        background: rgba(255, 0, 0, 0.8);
        color: white;
        border: none;
        border-radius: 50%;
        font-size: 14px;
        width: 20px;
        height: 20px;
        cursor: pointer;
        text-align: center;
        line-height: 17px;
        z-index: 2;
    }

    .upload-container {
        max-width: 800px;
        margin: 0 auto;
        background: white;
        padding: 30px;
        border-radius: 12px;
        box-shadow: 0 4px 6px rgba(0, 0, 0, 0.1);
    }

    .file-upload-wrapper {
        position: relative;
        overflow: hidden;
    }

    .file-upload-wrapper input[type="file"] {
        position: absolute;
        top: 0;
        left: 0;
        width: 100%;
        height: 100%;
        opacity: 0;
        cursor: pointer;
    }

    .placeholder-container {
        display: flex;
        gap: 15px;
        margin-top: 15px;
        flex-wrap: wrap;
    }

    .placeholder-box {
        width: 120px;
        height: 120px;
        border: 2px dashed #ddd;
        border-radius: 8px;
        display: flex;
        align-items: center;
        justify-content: center;
        background-color: #f8f9fa;
        cursor: pointer;
        transition: all 0.3s ease;
        position: relative;
        overflow: hidden;
    }

    .placeholder-box:hover {
        border-color: #007bff;
        background-color: #e7f3ff;
    }

    .placeholder-box.active {
        border-color: #28a745;
        background-color: #e8f5e8;
    }

    .placeholder-icon {
        font-size: 24px;
        color: #6c757d;
    }

    .placeholder-box img {
        width: 100%;
        height: 100%;
        object-fit: cover;
        border-radius: 6px;
    }

    .remove-btn {
        position: absolute;
        top: 5px;
        right: 5px;
        background: rgba(220, 53, 69, 0.9);
        color: white;
        border: none;
        border-radius: 50%;
        width: 20px;
        height: 20px;
        font-size: 12px;
        cursor: pointer;
        display: none;
        align-items: center;
        justify-content: center;
        z-index: 2;
    }

    .placeholder-box.has-image .remove-btn {
        display: flex;
    }

    .placeholder-box.has-image .placeholder-icon {
        display: none;
    }

    .upload-text {
        font-size: 12px;
        color: #6c757d;
        text-align: center;
        margin-top: 5px;
    }

    .business-logo-container {
        display: flex;
        justify-content: center;
    }

    /* .business-logo-placeholder {
        width: 150px;
        height: 150px;
    } */

    .form-label {
        font-weight: 600;
        color: #333;
        margin-bottom: 10px;
    }

    .text-muted {
        font-size: 13px;
        margin-top: 8px;
    }

    .success-message {
        color: #28a745;
        font-size: 12px;
        margin-top: 5px;
    }

    .error-message {
        color: #dc3545;
        font-size: 12px;
        margin-top: 5px;
    }

    .upload-section {
        margin-bottom: 40px;
        padding: 20px;
        border: 1px solid #e9ecef;
        border-radius: 8px;
    }

    /* file upload ui */
    .file-upload-area {
        position: relative;
        border: 2px dashed #e0e0e0;
        border-radius: 8px;
        padding: 3rem 2rem;
        text-align: center;
        background-color: #fafafa;
        transition: all 0.3s ease;
        cursor: pointer;
    }

    .file-upload-area:hover {
        border-color: #dc3545;
        background-color: #fff5f5;
    }

    .file-upload-area.drag-over {
        border-color: #dc3545;
        background-color: #fff5f5;
        transform: scale(1.02);
    }

    .file-upload-area.has-file {
        border-color: #28a745;
        background-color: #f8fff9;
    }

    .upload-icon {
        width: 48px;
        height: 48px;
        margin: 0 auto 1rem;
        background-color: #dc3545;
        border-radius: 50%;
        display: flex;
        align-items: center;
        justify-content: center;
        color: white;
        font-size: 20px;
    }

    .upload-text {
        color: #666;
        font-size: 16px;
        margin-bottom: 1rem;
    }

    .browse-btn {
        background-color: #dc3545;
        color: white;
        border: none;
        padding: 10px 20px;
        border-radius: 6px;
        font-size: 14px;
        cursor: pointer;
        transition: background-color 0.3s ease;
    }

    .browse-btn:hover {
        background-color: #c82333;
    }

    .file-input {
        display: none;
    }

    .file-info {
        margin-top: 1rem;
        display: none;
    }

    .file-item {
        background: #f8f9fa;
        border: 1px solid #dee2e6;
        border-radius: 6px;
        padding: 1rem;
        display: flex;
        align-items: center;
        justify-content: space-between;
    }

    .file-details {
        display: flex;
        align-items: center;
    }

    .file-icon {
        width: 32px;
        height: 32px;
        background-color: #dc3545;
        border-radius: 4px;
        display: flex;
        align-items: center;
        justify-content: center;
        color: white;
        font-size: 12px;
        font-weight: bold;
        margin-right: 12px;
    }

    .file-meta {
        flex: 1;
    }

    .file-name {
        font-weight: 600;
        color: #333;
        margin-bottom: 4px;
    }

    .file-size {
        font-size: 12px;
        color: #666;
    }

    .remove-btn {
        background: none;
        border: none;
        color: #dc3545;
        cursor: pointer;
        font-size: 18px;
        padding: 4px;
        border-radius: 4px;
        transition: background-color 0.3s ease;
    }

    .remove-btn:hover {
        background-color: #f8d7da;
    }

    .help-text {
        font-size: 12px;
        color: #6c757d;
        margin-top: 0.5rem;
    }

    .current-file {
        margin-top: 1rem;
        padding: 0.5rem;
        background-color: #e7f3ff;
        border-radius: 4px;
        font-size: 12px;
    }

    .current-file a {
        color: #007bff;
        text-decoration: none;
    }

    .current-file a:hover {
        text-decoration: underline;
    }

    .pdf-preview {
        margin-top: 1rem;
        border: 1px solid #dee2e6;
        border-radius: 8px;
        overflow: hidden;
        background: white;
    }

    .pdf-preview-header {
        background-color: #f8f9fa;
        padding: 12px 16px;
        display: flex;
        justify-content: space-between;
        align-items: center;
        border-bottom: 1px solid #dee2e6;
        font-weight: 600;
        color: #333;
    }

    .preview-close-btn {
        background: none;
        border: none;
        color: #666;
        cursor: pointer;
        font-size: 18px;
        padding: 0;
        width: 24px;
        height: 24px;
        border-radius: 50%;
        display: flex;
        align-items: center;
        justify-content: center;
        transition: background-color 0.3s ease;
    }

    .preview-close-btn:hover {
        background-color: #e9ecef;
        color: #333;
    }
</style>
@section('content')
    <div class="row justify-content-center">
        <div class="hero-image">
            <div class="hero-content">
                <h4 class="">
                    We're Connecting Entrepreneur With Investor-Shaping The Future Taikun
                </h4>
            </div>
        </div>

        <div class="col-md-10 col-lg-8">
            <div class="card">
                <div class="card-body p-5">
                    <form action="{{ route('investor.store') }}" method="POST" enctype="multipart/form-data"
                        class="mt-2">
                        @csrf
                        <input type="hidden" name="user_id" value="{{ $user->id }}">

                        <!-- Step 2: Personal Information -->
                        <div class="form-step active" data-step="2">
                            <div class="row mb-4">
                                <div class="text-center mb-4">
                                    <h3 style="font-family:mat; font-weight: bold; margin-left: 5px;">Personal Information
                                        of Investor
                                    </h3>
                                </div>
                                <div class="col-12 mb-4">
                                </div>

                                <div class="col-md-6 mb-3">
                                    <div class="form-floating-custom">
                                        <label class="form-label">Full Name </label>
                                        <input type="text" class="form-control" name="full_name" id="full_name"
                                            value="{{ old('full_name', $investo->full_name ?? '') }}"
                                            placeholder="Joey Tucker">
                                        <div class="text-danger mt-1 d-none" id="full_name_error"></div>
                                    </div>
                                </div>

                                <div class="col-md-6 mb-3">
                                    <div class="form-floating-custom">
                                        <label class="form-label">Email Address </label>
                                        <input type="email" class="form-control" name="email"
                                            value="{{ $userEmail }}" readonly placeholder="joey@gmail.com">
                                        <div class="text-danger mt-1 d-none" id="email_error"></div>
                                    </div>
                                </div>

                                <div class="col-md-6 mb-3">
                                    <div class="form-floating-custom">
                                        <div class="input-group">
                                            <select name="country_code" class="form-select" style="max-width: 120px;">
                                                @foreach ($countries as $country)
                                                    <option value="{{ $country['code'] }}"
                                                        {{ $country['code'] == old('country_code', $investo->country_code ?? '+91') ? 'selected' : '' }}>
                                                        {{ $country['name'] }} ({{ $country['code'] }})
                                                    </option>
                                                @endforeach
                                            </select>
                                            <input type="tel" class="form-control" name="phone_number"
                                                placeholder="8529637410"
                                                value="{{ old('phone_number', $investo->phone_number ?? '') }}"
                                                maxlength="12" required>
                                        </div>
                                        <div class="text-danger mt-1 d-none" id="phone_number_error"></div>
                                        <div class="text-danger mt-1 d-none" id="country_code_error"></div>
                                    </div>
                                </div>

                                <div class="col-md-6 mb-3">
                                    <div class="form-floating-custom">
                                        <input type="text" class="form-control" name="current_address"
                                            id="current_address"
                                            value="{{ old('current_address', $investo->current_address ?? '') }}"
                                            placeholder="Nexora Ventures Inc.123 Market Street, Suite 200 San Francisco, CA 94105 United States">
                                        <label for="current_address">Residentail Address</label>
                                        <div class="text-danger mt-1 d-none" id="current_address_error"></div>
                                    </div>
                                </div>

                                <div class="col-md-6 mb-3">
                                    <div class="form-floating-custom">
                                        <select name="country" class="form-select" id="country" required>
                                            <option value="">Select a country</option>
                                        </select>
                                        <label for="country">Country</label>
                                        <div class="text-danger mt-1 d-none" id="country_error"></div>
                                    </div>
                                </div>

                                <div class="col-md-6 mb-3">
                                    <div class="form-floating-custom">
                                        <select class="form-control" name="state" id="state" required>
                                            <option value="">Select State</option>
                                            {{-- Dynamically filled via JS --}}
                                        </select>
                                        <label class="state">State</label>
                                        <div class="text-danger mt-1 d-none" id="state_error"></div>
                                    </div>
                                </div>

                                <div class="col-md-6 mb-3">
                                    <div class="form-floating-custom">
                                        <select class="form-control" name="city" id="city" required>
                                            <option value="">Select City</option>
                                            {{-- Dynamically filled via JS --}}
                                        </select>
                                        <label class="city">City *</label>
                                        <div class="text-danger mt-1 d-none" id="city_error"></div>
                                    </div>
                                </div>

                                <div class="col-md-6 mb-3">
                                    <div class="form-floating-custom">
                                        <input type="text" pattern="[0-9]{5,6}" inputmode="numeric" maxlength="6"
                                            id="pin_code" class="form-control" name="pin_code"
                                            value="{{ old('pin_code', $investo->pin_code ?? '') }}" placeholder="852741">
                                        <label class="from-label">Pin/Zip Code</label>
                                        <div class="text-danger mt-1 d-done" id="pin_code_error"></div>
                                    </div>
                                </div>

                                <div class="col-md-6 mb-3">
                                    <div class="form-floating-custom">
                                        <label class="form-label">Social Media Profile</label>
                                        <input type="url" class="form-control" name="linkedin_profile"
                                            id="linkedin_profile"
                                            value="{{ old('linkedin_profile', $investo->linkedin_profile ?? '') }}"
                                            placeholder="https://linkedin.com/in/your-profile">
                                    </div>
                                </div>

                                <div class="col-md-6 mb-3">
                                    <div class="form-floating-custom">
                                        <label class="form-label">Date of Birth </label>
                                        <input type="text" class="form-control" name="dob" id="dob"
                                            value="{{ old('dob', $investo->dob ?? '') }}" placeholder="Select date"
                                            readonly>
                                        <div class="text-danger mt-1 d-none" id="dob_error"></div>
                                    </div>
                                </div>

                                <div class="col-md-6 mb-3">
                                    <div class="form-group">
                                        <div class="form-floating-custom">
                                            <select class="form-select" name="qualification" id="qualification">
                                                <option value="">Select Qualification</option>
                                                @foreach ($qualifications as $qualification)
                                                    <option value="{{ $qualification }}"
                                                        {{ old('qualification', $investo->qualification ?? '') == $qualification ? 'selected' : '' }}>
                                                        {{ $qualification }}
                                                    </option>
                                                @endforeach
                                            </select>
                                            <label for="qualification">Select Qualification</label>
                                        </div>
                                        <div class="text-danger mt-1 d-none" id="qualification_error"></div>
                                    </div>
                                </div>

                                <div class="col-md-6 mb-3">
                                    <div class="form-floating-custom">
                                        <label class="form-label">Age</label>
                                        <input type="text" class="form-control" name="age" id="age"
                                            value="{{ old('age', $investo->age ?? '') }}" placeholder="29" readonly>
                                    </div>
                                </div>

                                <div class="upload-section">
                                    <label for="photo" class="form-label">Upload Passport Size Photo</label>
                                    <div class="file-upload-wrapper">
                                        <input class="form-control" type="file" id="photo" name="photo"
                                            accept=".jpg,.jpeg,.png">
                                        <div class="business-logo-container">
                                            <div class="placeholder-box business-photo-placeholder"
                                                id="photo-placeholder">
                                                <div class="placeholder-icon">📷</div>
                                                <button class="remove-btn"
                                                    onclick="removeImage('photo', 'photo-placeholder')">×</button>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="upload-text">Click to upload Photo</div>
                                    <div id="photo_error" class="error-message d-none"></div>
                                    <small class="text-muted">Select 1 image (JPG, JPEG, PNG only, max 5MB)</small>
                                </div>
                            </div>
                        </div>
                        <div class="row mb-4">
                            <div class="col-12">

                            </div>
                            <div class="col-12 mb-3">
                                <div class="form-group">
                                    <label class="form-label fw-bold text-center">Do you have an existing
                                        company?</label>
                                    <div class="d-flex gap-3 mt-2 justify-content-center">
                                        <div class="form-check form-check-inline">
                                            <input type="radio" class="form-check-input" name="existing_company"
                                                value="0" id="existing_company_no"
                                                {{ old('existing_company', $investo->existing_company ?? '0') == '0' ? 'checked' : '' }}>

                                            <label class="form-check-label" for="existing_company_no">No</label>
                                        </div>
                                        <div class="form-check form-check-inline">
                                            <input type="radio" class="form-check-input" name="existing_company"
                                                value="1" id="existing_company_yes"
                                                {{ old('existing_company', $investo->existing_company ?? '0') == '1' ? 'checked' : '' }}>
                                            <label class="form-check-label" for="existing_company_yes">Yes</label>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <div class="company-fields"
                                style="display: {{ old('existing_company', $investo->existing_company ?? '0') == '1' ? 'block' : 'none' }};">
                                <div class="row">
                                    <div class="col-md-6 mb-3">
                                        <div class="form-floating-custom">
                                            <label class="form-label">Company Name </label>
                                            <input type="text" class="form-control" name="organization_name"
                                                value="{{ old('organization_name', $investo->organization_name ?? '') }}"
                                                placeholder="XYZ Enterprises">
                                            <div class="text-danger mt-1 d-none" id="organization_name_error"></div>
                                        </div>
                                    </div>
                                    <div class="col-md-6 mb-3">
                                        <div class="form-floating-custom">
                                            <input type="text" class="form-control" name="company_address"
                                                value="{{ old('company_address', $investo->company_address ?? '') }}"
                                                placeholder="Nexora Ventures Inc.123 Market Street, Suite 200 San Francisco, CA 94105 United States">
                                            <label class="form-label" id="company_address">Business Address </label>
                                            <div class="text-danger mt-1 d-none" id="company_address_error">
                                            </div>
                                        </div>
                                    </div>

                                    <div class="col-md-6 mb-3">
                                        <div class="form-floating-custom">
                                            <select name="company_country" class="form-select" id="company_country">
                                                <option value="">Select a country</option>
                                                @foreach ($countries as $country)
                                                    <option value="{{ $country['name'] }}"
                                                        {{ old('company_country', $investo->company_country ?? $autoDetectedCountry) == $country['name'] ? 'selected' : '' }}>
                                                        {{ $country['name'] }}
                                                    </option>
                                                @endforeach
                                            </select>
                                            <label for="company_country">Business Country</label>
                                            <div class="text-danger mt-1 d-none" id="company_country_error"></div>
                                        </div>
                                    </div>

                                    <div class="col-md-6 mb-3">
                                        <div class="form-floating-custom">
                                            <select class="form-control" name="company_state" id="company_state">
                                                <option value="">Select State</option>
                                            </select>
                                            <label for="company_state">Business State</label>
                                            <div class="text-danger mt-1 d-none" id="company_state_error"></div>
                                        </div>
                                    </div>

                                    <div class="col-md-6 mb-3">
                                        <div class="form-floating-custom">
                                            <select class="form-control" name="company_city" id="company_city">
                                                <option value="">Select City</option>
                                            </select>
                                            <label for="company_city">Business City</label>
                                            <div class="text-danger mt-1 d-none" id="company_city_error"></div>
                                        </div>
                                    </div>

                                    <div class="col-md-6 mb-3">
                                        <div class="form-floating-custom">
                                            <input type="text" class="form-control" name="company_zipcode"
                                                value="{{ old('company_zipcode', $investo->company_zipcode ?? '') }}"
                                                placeholder="852741">
                                            <label class="form-label" id="company_zipcode_label">Business Pin / Zip
                                                Code</label>
                                            <div class="text-danger mt-1 d-none" id="company_zipcode_error"></div>
                                        </div>
                                    </div>

                                    <div class="col-md-6 mb-3">
                                        <div class="form-floating-custom">
                                            <label class="form-label">Email Address</label>
                                            <input type="email" class="form-control" name="professional_email"
                                                value="{{ old('professional_email', $investo->professional_email ?? '') }}"
                                                placeholder="xyz@gmail.com">
                                            <div class="text-danger mt-1 d-none" id="professional_email_error"></div>
                                        </div>
                                    </div>

                                    <div class="col-md-6 mb-3">
                                        <div class="form-floating-custom">
                                            <label class="form-label">Website </label>
                                            <input type="text" class="form-control" name="website"
                                                placeholder="https://xyz.com"
                                                value="{{ old('website', $investo->website ?? '') }}">
                                        </div>
                                    </div>

                                    <div class="col-md-6 mb-3">
                                        <div class="form-floating-custom">
                                            <label class="form-label">Business Tax Registration Number</label>
                                            <input type="text" class="form-control" name="tax_registration_number"
                                                id="tax_registration_number" placeholder="SC123456"
                                                value="{{ old('tax_registration_number', $investo->tax_registration_number ?? '') }}">
                                            <div class="text-danger mt-1 d-none" id="tax_registration_number_error">
                                            </div>
                                        </div>
                                    </div>
                                    <div class="col-md-6 mb-3">
                                        <div class="form-floating-custom">
                                            <label class="form-label">Your Postion</label>

                                            <select class="form-select" name="designation" id="designation">
                                                <option value="">Select Your Postion</option>
                                                @foreach ($designations as $designation)
                                                    <option value="{{ $designation }}"
                                                        {{ old('designation', $investo->designation ?? '') == $designation ? 'selected' : '' }}>
                                                        {{ $designation }}
                                                    </option>
                                                @endforeach
                                            </select>
                                            <div class="text-danger mt-1 d-none" id="designation_error"></div>
                                        </div>
                                    </div>
                                    {{-- <div class="col-md-6 mb-3">
                                        <label for="pitch_deck" class="form-label">Upload Business Logo *</label>
                                        <div class="file-upload-wrapper">
                                            <input class="form-control" type="file" id="business_logo"
                                                name="business_logo">
                                            <label for="business_logo" class="file-upload-label w-100">
                                            </label>
                                        </div>
                                        <div id="business_logo_preview" class="image-preview-container mt-2">
                                            @if ($investo && $investo->business_logo)
                                                <img src="{{ Storage::url($investo->business_logo) }}"
                                                    alt="Business Logo" style="max-width: 100px;">
                                                <small class="form-text text-muted">
                                                    Current logo: <a href="{{ Storage::url($investo->business_logo) }}"
                                                        target="_blank">View</a>
                                                </small>
                                            @endif
                                        </div>
                                        <div class="text-danger mt-1 d-none" id="business_logo_error"></div>
                                        <small class="text-muted">Select 1 image (JPG, JPEG, PNG only, max 5MB)</small>
                                    </div> --}}
                                    <div class="col-md-6 mb-3">
                                        <div class="upload-section">
                                            <label for="business_logo" class="form-label">Upload Business Logo </label>
                                            <div class="file-upload-wrapper">
                                                <input class="form-control" type="file" id="business_logo"
                                                    name="business_logo" accept=".jpg,.jpeg,.png">
                                                <div class="business-logo-container">
                                                    <div class="placeholder-box business-logo-placeholder"
                                                        id="logo-placeholder">
                                                        <div class="placeholder-icon">📷</div>
                                                        <button class="remove-btn"
                                                            onclick="removeImage('business_logo', 'logo-placeholder')">×</button>
                                                    </div>
                                                </div>
                                            </div>
                                            <div class="upload-text">Click to upload logo</div>
                                            <div id="business_logo_error" class="error-message d-none"></div>
                                            <small class="text-muted">Select 1 image (JPG, JPEG, PNG only, max 5MB)</small>
                                        </div>
                                    </div>

                                    {{-- 
                                    <div class="col-md-6 mb-3">
                                        <label for="investor_profile" class="form-label">Upload Business
                                            Profile</label>
                                        <input class="form-control" type="file" id="investor_profile"
                                            name="investor_profile" accept=".pdf"
                                            value="{{ old('investor_profile') }}">
                                        <label for="investor_profile" class="file-upload-label w-100">
                                        </label>
                                        <div id="investor_profile_preview" class="pdf-preview-container mt-2">
                                            @if ($investo && $investo->investor_profile)
                                                <small class="form-text text-muted">
                                                    Current profile: <a
                                                        href="{{ Storage::url($investo->investor_profile) }}"
                                                        target="_blank">View</a>
                                                </small>
                                            @endif
                                        </div>
                                        <div class="text-danger mt-1 d-none" id="investor_profile_error"></div>
                                        <small class="text-muted">Select 1 PDF (pdf) </small>
                                    </div> --}}
                                    <div class="col-md-6 mb-3">
                                        <div class="form-group">
                                            <label for="investor_profile" class="form-label">Upload Business
                                                Profile</label>

                                            <div class="file-upload-area" id="uploadArea">
                                                <div class="upload-icon">
                                                    <span>☁</span>
                                                </div>
                                                <div class="upload-text">Drag and drop to upload</div>
                                                <button type="button" class="browse-btn"
                                                    onclick="document.getElementById('investor_profile').click()">
                                                    browse computer
                                                </button>
                                            </div>

                                            <input class="file-input" type="file" id="investor_profile"
                                                name="investor_profile" accept=".pdf">

                                            <div class="file-info" id="fileInfo">
                                                <div class="file-item">
                                                    <div class="file-details">
                                                        <div class="file-icon">PDF</div>
                                                        <div class="file-meta">
                                                            <div class="file-name" id="fileName"></div>
                                                            <div class="file-size" id="fileSize"></div>
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>
                                            <div class="error-message" id="errorMessage"></div>
                                            <div class="help-text">Select 1 PDF (pdf)</div>
                                        </div>
                                    </div>
                                </div>
                            </div>

                            <div class="col-md-6 mb-3">
                                <div class="form-floating-custom">
                                    <div class="input-group">
                                        <select name="company_country_code" class="form-select"
                                            style="max-width: 120px;">
                                            @foreach ($countries as $country)
                                                <option value="{{ $country['code'] }}"
                                                    {{ old('company_country_code', $investo->company_country_code ?? '+91') == $country['code'] ? 'selected' : '' }}>
                                                    {{ $country['name'] }} ({{ $country['code'] }})
                                                </option>
                                            @endforeach
                                        </select>
                                        <input type="tel" class="form-control" name="professional_phone"
                                            placeholder="9638527410"
                                            value="{{ old('professional_phone', $investo->professional_phone ?? '') }}"
                                            maxlength="12">
                                    </div>
                                    <div class="text-danger mt-1 d-none" id="professional_phone_error"></div>
                                    <div class="text-danger mt-1 d-none" id="company_country_code_error"></div>
                                </div>
                            </div>

                            <div class="col-md-6 mb-3">
                                <div class="form-floating-custom">
                                    <label class="form-label">Years of an Investment Experience</label>

                                    <select class="form-select" name="investment_experince" id="investment_experince">
                                        <option value="">Years of an Investment Experience</option>
                                        @foreach ($investmentExperince as $experince)
                                            <option value="{{ $experince }}"
                                                {{ old('investment_experince', $investo->investment_experince ?? '') == $experince ? 'selected' : '' }}>
                                                {{ $experince }}
                                            </option>
                                        @endforeach
                                    </select>
                                    <div class="text-danger mt-1 d-none" id="investment_experince_error"></div>
                                </div>
                            </div>

                            <div class="col-md-6 mb-3">
                                <div class="form-floating-custom">
                                    <label class="form-label">Investor Type </label>

                                    <select class="form-select" name="investor_type" id="investor_type">
                                        <option value="">Select Investor</option>
                                        @foreach ($investorTypes as $type)
                                            <option value="{{ $type }}"
                                                {{ old('investor_type', $investo->investor_type ?? '') == $type ? 'selected' : '' }}>
                                                {{ $type }}
                                            </option>
                                        @endforeach
                                    </select>
                                    <label for="industry">Select Investor Type</label>
                                    <div class="text-danger mt-1 d-none" id="investor_type_error"></div>
                                </div>
                            </div>

                            <div class="col-md-6 mb-3">
                                <div class="form-floating-custom">

                                    <select class="form-select" name="investment_range" id="investment_range">
                                        <option value="">Select Investment Range</option>
                                        @foreach ($investmentRanges as $range)
                                            <option value="{{ $range }}"
                                                {{ old('investment_range', $investo->investment_range ?? '') == $range ? 'selected' : '' }}>
                                                {{ $range }}
                                            </option>
                                        @endforeach
                                    </select>
                                    <label for="industry">Investment Range<span class="funding_currency_label"
                                            id="funding_currency_label">()</span></label>
                                    <div class="text-danger mt-1 d-none" id="investment_range_error"></div>
                                </div>
                            </div>
                            {{-- </div> --}}
                        </div>
                        <div class="row">
                            <div class="col-md-6 mb-3">
                                <div class="form-floating-custom">
                                    <label class="form-label" for="preferred_startup_stage">Preferred Investment
                                        Stage </label>
                                    <select class="form-select" name="preferred_startup_stage[]"
                                        id="preferred_startup_stage" multiple>
                                        <option value="">Select Stages</option>
                                        @foreach ($startupStages as $stage)
                                            <option value="{{ $stage }}"
                                                {{ in_array($stage, old('preferred_startup_stage', $investo ? ($investo->preferred_startup_stage ? json_decode($investo->preferred_startup_stage, true) : []) : [])) ? 'selected' : '' }}>
                                                {{ $stage }}
                                            </option>
                                        @endforeach
                                    </select>
                                    <div class="text-danger mt-1 d-none" id="preferred_startup_stage_error"></div>
                                </div>
                            </div>
                            <div class="col-md-6 mb-3">
                                <div class="form-floating-custom">
                                    <label class="form-label">Preferred Industries (Select multiple)</label>
                                    <select class="form-select" name="preferred_industries[]" id="preferred_industries"
                                        multiple>
                                        <option value="">Preferred Industries (Select multiple)</option>
                                        @foreach ($industries as $industry)
                                            <option value="{{ $industry }}"
                                                {{ in_array($industry, old('preferred_industries', $investo ? ($investo->preferred_industries ? json_decode($investo->preferred_industries, true) : []) : [])) ? 'selected' : '' }}>
                                                {{ $industry }}
                                            </option>
                                        @endforeach
                                    </select>
                                    <div class="text-danger mt-1 d-none" id="preferred_industries_error"></div>
                                </div>
                            </div>

                            <div class="col-md-6 mb-3">
                                <div class="form-floating-custom">
                                    <label class="form-label">Preferred Geographies (Select multiple)</label>
                                    <select class="form-select" name="preferred_geographies[]" id="preferred_geographies"
                                        multiple>
                                        <option value="">Preferred Industries (Select multiple)</option>
                                        @foreach ($geographies as $geography)
                                            <option value="{{ $geography }}"
                                                {{ in_array($geography, old('preferred_geographies', $investo ? ($investo->preferred_geographies ? json_decode($investo->preferred_geographies, true) : []) : [])) ? 'selected' : '' }}>
                                                {{ $geography }}
                                            </option>
                                        @endforeach
                                    </select>
                                    <div class="text-danger mt-1 d-none" id="preferred_geographies_error"></div>
                                </div>
                            </div>
                        </div>

                        <div class="col-md-12 mb-3">
                            <div class="form-check mt-4">
                                <input class="form-check-input" type="checkbox" name="actively_investing"
                                    id="actively_investing" {{ old('actively_investing') ? 'checked' : '' }}>
                                <label class="form-check-label" for="actively_investing">
                                    Present Investment Company Details (Add Multiple)
                                </label>
                            </div>
                        </div>

                        {{-- Conditionally visible fields --}}
                        <div id="investment-fields" style="display: none;">
                            <div class="col-12">
                                {{-- <h5 class="text-black mb-3">
                                            <i class="fas fa-chart-line me-2"></i>Company Details
                                        </h5> --}}
                            </div>
                            <div id="company-wrapper">
                                <!-- First Set -->
                                <div class="company-group border rounded p-3 mb-3">
                                    <div class="row">
                                        <div class="col-md-6 mb-3">
                                            <label class="form-label">Company Name </label>
                                            <input type="text" class="form-control" name="company_name[]"
                                                placeholder="Company Name">
                                        </div>
                                        <div class="col-md-6 mb-3">
                                            <label class="form-label">Investment in This Company <span
                                                    class="funding_currency_label"
                                                    id="funding_currency_label">()</span></label>
                                            <input type="number" class="form-control investment" name="market_capital[]"
                                                placeholder="Numeric Input">
                                        </div>

                                        <div class="col-md-6 mb-3">
                                            <label class="form-label">Equity Holding in This Company (in
                                                %)</label>
                                            <input type="number" class="form-control equity" name="your_stake[]"
                                                min="0" max="100" step="0.01" placeholder="00.00"
                                                oninput="validateEquityPercentage(this)" onblur="formatEquityValue(this)">
                                            <div class="text-danger mt-1 d-none equity-error"></div>
                                        </div>

                                        <div class="col-md-6 mb-3">
                                            <label class="form-label">Company Valuation <span
                                                    class="funding_currency_label"
                                                    id="funding_currency_label">()</span></label>
                                            <input type="text" class="form-control valuation" name="stake_funding[]"
                                                readonly>
                                        </div>
                                    </div>
                                </div>
                            </div>

                            <div class="text-end mb-3 d-flex justify-content-center">
                                <button type="button" class="btn btn-outline-success" id="add-more-company"
                                    title="Add Company">
                                    <i class="fas fa-plus"></i>
                                </button>
                            </div>
                        </div>

                        <div class="col-12 mb-3">
                            <div class="alert alert-info">
                                <i class="fas fa-info-circle me-2"></i>
                                <strong>Review your information:</strong> Please review all the information
                                you've
                                provided
                                before submitting your registration.
                            </div>
                        </div>

                        <div class="step-navigation">
                            {{-- <div></div> --}}
                            <button type="button" class="btn btn-danger btn-step" id="clearBtn">
                                <i class="fas fa-eraser me-2"></i>Clear
                            </button>

                            <button type="submit" class="btn btn-primary btn-step" id="submitBtn">
                                <i class="fas fa-check me-2"></i>Submit
                            </button>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
@endsection

@section('scripts')
    <script src="https://code.jquery.com/jquery-3.6.0.min.js"
        integrity="sha256-/xUj+3OJU5yExlq6GSYGSHk7tPXikynS7ogEvDej/m4=" crossorigin="anonymous"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/bootstrap/5.3.0/js/bootstrap.bundle.min.js"></script>
    <link href="https://cdn.jsdelivr.net/npm/select2@4.1.0-rc.0/dist/css/select2.min.css" rel="stylesheet" />
    <script src="https://cdn.jsdelivr.net/npm/select2@4.1.0-rc.0/dist/js/select2.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/flatpickr"></script>
    <script>
        document.addEventListener('DOMContentLoaded', function() {
            const API_KEY = 'WmtRc2MzTzhLRnltNGNmSjljT3RqakROckhSOFFQSTZqMXBGbVlNUw==';
            const BASE_URL = 'https://api.countrystatecity.in/v1';
            const MAX_FILE_SIZE = 5 * 1024 * 1024; // 5MB in bytes

            // Elements for personal information fields
            const fullNameInput = document.getElementById('full_name');
            const countrySelect = document.getElementById('country');
            const stateSelect = document.getElementById('state');
            const citySelect = document.getElementById('city');
            const pinCodeInput = document.getElementById('pin_code');
            const dobInput = document.getElementById('dob');
            const ageInput = document.getElementById('age');
            const phoneNumberInput = document.querySelector('input[name="phone_number"]');
            const professionalPhoneInput = document.querySelector('input[name="professional_phone"]');
            const investmentRangeSelect = document.getElementById('investment_range');
            const existingCompanyYes = document.getElementById('existing_company_yes');
            const existingCompanyNo = document.getElementById('existing_company_no');
            const companyFields = document.querySelector('.company-fields');
            const activelyInvestingCheckbox = document.getElementById('actively_investing');
            const investmentFields = document.getElementById('investment-fields');
            const addMoreCompanyBtn = document.getElementById('add-more-company');
            const companyWrapper = document.getElementById('company-wrapper');

            const fullNameError = document.getElementById('full_name_error');
            const countryError = document.getElementById('country_error');
            const stateError = document.getElementById('state_error');
            const cityError = document.getElementById('city_error');
            const pinCodeError = document.getElementById('pin_code_error');
            const dobError = document.getElementById('dob_error');
            const phoneNumberError = document.getElementById('phone_number_error');
            const professionalPhoneError = document.getElementById('professional_phone_error');
            const investmentRangeError = document.getElementById('investment_range_error');
            const organizationNameError = document.getElementById('organization_name_error');
            const companyCountryError = document.getElementById('company_country_error');
            const companyStateError = document.getElementById('company_state_error');
            const companyCityError = document.getElementById('company_city_error');
            const companyZipcodeError = document.getElementById('company_zipcode_error');
            const professionalEmailError = document.getElementById('professional_email_error');
            const taxRegistrationNumberError = document.getElementById('tax_registration_number_error');
            const designationError = document.getElementById('designation_error');
            const businessLogoError = document.getElementById('business_logo_error');
            const photoError = document.getElementById('photo_error');

            const fundingCurrencyLabels = document.querySelectorAll('.funding_currency_label');

            // Initialize Select2 for multi-select fields
            $('#preferred_industries').select2({
                placeholder: 'Select Industries',
                allowClear: true,
                width: '100%'
            });
            $('#preferred_geographies').select2({
                placeholder: 'Select Geographies',
                allowClear: true,
                width: '100%'
            });
            $('#preferred_startup_stage').select2({
                placeholder: 'Select Stages',
                allowClear: true,
                width: '100%'
            });

            // Initialize Flatpickr for DOB
            if (dobInput) {
                flatpickr(dobInput, {
                    dateFormat: 'Y-m-d',
                    maxDate: new Date(new Date().setFullYear(new Date().getFullYear() - 18)),
                    onChange: function(selectedDates) {
                        if (selectedDates.length > 0) {
                            const dob = selectedDates[0];
                            const today = new Date();
                            let age = today.getFullYear() - dob.getFullYear();
                            const monthDiff = today.getMonth() - dob.getMonth();
                            if (monthDiff < 0 || (monthDiff === 0 && today.getDate() < dob.getDate())) {
                                age--;
                            }
                            if (age < 18) {
                                dobError.textContent = 'You must be at least 18 years old';
                                dobError.classList.remove('d-none');
                                ageInput.value = '';
                            } else {
                                ageInput.value = age;
                                dobError.classList.add('d-none');
                                dobError.textContent = '';
                            }
                        }
                    }
                });
            }

            // Format number in Indian numbering system
            function formatIndianNumber(number) {
                if (isNaN(number) || number === 0) return '0.00';

                const parts = parseFloat(number).toFixed(2).toString().split('.');
                let integerPart = parts[0];
                const decimalPart = parts[1];

                // Handle Indian numbering system (lakhs, crores)
                let lastThree = integerPart.substring(integerPart.length - 3);
                let otherNumbers = integerPart.substring(0, integerPart.length - 3);

                if (otherNumbers !== '') {
                    lastThree = ',' + lastThree;
                }

                const formattedInteger = otherNumbers.replace(/\B(?=(\d{2})+(?!\d))/g, ',') + lastThree;
                return `${formattedInteger}.${decimalPart}`;
            }

            // Handle existing company fields calculation
            function initializeExistingCompanyCalculation() {
                const existingMarketCapitalInput = document.querySelector('input[name="market_capital[]"]');
                const existingYourStakeInput = document.querySelector('input[name="your_stake[]"]');
                const existingStakeFundingInput = document.querySelector('input[name="stake_funding[]"]');

                if (existingMarketCapitalInput && existingYourStakeInput && existingStakeFundingInput) {
                    function updateExistingStakeFunding() {
                        const marketValue = parseFloat(existingMarketCapitalInput.value) || 0;
                        const stakePercentage = parseFloat(existingYourStakeInput.value) || 0;

                        if (stakePercentage > 0 && marketValue > 0) {
                            const totalValuation = marketValue / (stakePercentage / 100);
                            existingStakeFundingInput.value = formatIndianNumber(totalValuation);
                        } else {
                            existingStakeFundingInput.value = '';
                        }
                    }

                    existingMarketCapitalInput.addEventListener('input', updateExistingStakeFunding);
                    existingYourStakeInput.addEventListener('input', updateExistingStakeFunding);

                    // Initial calculation for pre-filled values
                    updateExistingStakeFunding();
                }
            }

            // Initialize existing company calculation
            initializeExistingCompanyCalculation();

            // Toggle company fields visibility based on existing_company
            function toggleCompanyFields() {
                if (existingCompanyYes.checked) {
                    companyFields.style.display = 'block';
                } else {
                    companyFields.style.display = 'none';
                }
            }

            existingCompanyYes.addEventListener('change', toggleCompanyFields);
            existingCompanyNo.addEventListener('change', toggleCompanyFields);

            // Toggle investment fields visibility based on actively_investing
            activelyInvestingCheckbox.addEventListener('change', function() {
                investmentFields.style.display = this.checked ? 'block' : 'none';
            });

            // Add new company fields dynamically
            addMoreCompanyBtn.addEventListener('click', function() {
                const companyGroup = document.createElement('div');
                companyGroup.classList.add('company-group', 'border', 'rounded', 'p-3', 'mb-3');
                companyGroup.innerHTML = `
                    <div class="row">
                        <div class="col-md-6 mb-3">
                            <label class="form-label">Company Name *</label>
                            <input type="text" class="form-control" name="company_name[]" placeholder="Company Name">
                            <div class="text-danger mt-1 d-none company-name-error"></div>
                        </div>
                        <div class="col-md-6 mb-3">
                            <label class="form-label">Investment in This Company <span class="funding_currency_label">()</span></label>
                            <input type="number" class="form-control investment" name="market_capital[]" placeholder="Numeric Input">
                            <div class="text-danger mt-1 d-none market-capital-error"></div>
                        </div>
                        <div class="col-md-6 mb-3">
                            <label class="form-label">Equity Holding in This Company (in %)*</label>
                            <input type="number" class="form-control equity" name="your_stake[]" min="0" max="100" step="0.01" placeholder="00.00">
                            <div class="text-danger mt-1 d-none equity-error"></div>
                        </div>
                        <div class="col-md-6 mb-3">
                            <label class="form-label">Company Valuation <span class="funding_currency_label">()</span>*</label>
                            <input type="text" class="form-control valuation" name="stake_funding[]" readonly>
                            <div class="text-danger mt-1 d-none valuation-error"></div>
                        </div>
                        <div class="col-md-12 text-end">
                            <button type="button" class="btn btn-outline-danger remove-company">Remove</button>
                        </div>
                    </div>
                `;
                companyWrapper.appendChild(companyGroup);

                // Add event listener for remove button
                companyGroup.querySelector('.remove-company').addEventListener('click', function() {
                    companyGroup.remove();
                });

                // Add event listeners for valuation calculation
                const marketCapitalInput = companyGroup.querySelector('input[name="market_capital[]"]');
                const yourStakeInput = companyGroup.querySelector('input[name="your_stake[]"]');
                const stakeFundingInput = companyGroup.querySelector('input[name="stake_funding[]"]');

                function updateStakeFunding() {
                    const marketValue = parseFloat(marketCapitalInput.value) || 0;
                    const stakePercentage = parseFloat(yourStakeInput.value) || 0;

                    if (stakePercentage > 0 && marketValue > 0) {
                        // Company Valuation = Investment Amount / (Equity Percentage / 100)
                        const totalValuation = marketValue / (stakePercentage / 100);
                        stakeFundingInput.value = formatIndianNumber(totalValuation);
                    } else {
                        stakeFundingInput.value = '';
                    }
                }

                marketCapitalInput.addEventListener('input', updateStakeFunding);
                yourStakeInput.addEventListener('input', updateStakeFunding);

                // Initial call to update valuation if pre-filled values exist
                updateStakeFunding();
            });

            // Business Logo upload and preview
            const businessLogoInput = document.getElementById('business_logo');
            const logoPlaceholder = document.getElementById('logo-placeholder');

            if (businessLogoInput) {
                businessLogoInput.addEventListener('change', function(e) {
                    const file = e.target.files[0];
                    if (!file) {
                        console.error('No file selected for business logo');
                        return;
                    }

                    // Validate file
                    if (!validateFile(file, businessLogoError, MAX_FILE_SIZE, ['image/jpeg', 'image/jpg',
                            'image/png'
                        ])) {
                        e.target.value = ''; // Clear the input if validation fails
                        return;
                    }

                    const reader = new FileReader();
                    reader.onload = function(e) {
                        if (logoPlaceholder) {
                            logoPlaceholder.innerHTML = `
                                <img src="${e.target.result}" alt="Business Logo" style="max-width: 100px; max-height: 100px;">
                                <button class="remove-btn" onclick="removeImage('business_logo', 'logo-placeholder')">×</button>
                            `;
                            logoPlaceholder.classList.add('has-image');
                            businessLogoError.classList.add('d-none');
                        } else {
                            console.error('Logo placeholder element not found');
                        }
                    };
                    reader.readAsDataURL(file);
                });

                // Click placeholder to trigger file input
                logoPlaceholder.addEventListener('click', function() {
                    if (!logoPlaceholder.classList.contains('has-image')) {
                        businessLogoInput.click();
                    }
                });
            } else {
                console.error('Business logo input element not found');
            }

            // Passport Size Photo upload and preview
            const photoInput = document.getElementById('photo');
            const photoPlaceholder = document.getElementById('photo-placeholder');

            if (photoInput) {
                photoInput.addEventListener('change', function(e) {
                    const file = e.target.files[0];
                    if (!file) {
                        console.error('No file selected for passport photo');
                        return;
                    }

                    // Validate file
                    if (!validateFile(file, photoError, MAX_FILE_SIZE, ['image/jpeg', 'image/jpg',
                            'image/png'
                        ])) {
                        e.target.value = ''; // Clear the input if validation fails
                        return;
                    }

                    const reader = new FileReader();
                    reader.onload = function(e) {
                        if (photoPlaceholder) {
                            photoPlaceholder.innerHTML = `
                                <img src="${e.target.result}" alt="Passport Photo" style="max-width: 100px; max-height: 100px;">
                                <button class="remove-btn" onclick="removeImage('photo', 'photo-placeholder')">×</button>
                            `;
                            photoPlaceholder.classList.add('has-image');
                            photoError.classList.add('d-none');
                        } else {
                            console.error('Photo placeholder element not found');
                        }
                    };
                    reader.readAsDataURL(file);
                });

                // Click placeholder to trigger file input
                photoPlaceholder.addEventListener('click', function() {
                    if (!photoPlaceholder.classList.contains('has-image')) {
                        photoInput.click();
                    }
                });
            } else {
                console.error('Photo input element not found');
            }

            // Remove image function
            window.removeImage = function(inputId, placeholderId) {
                const input = document.getElementById(inputId);
                const placeholder = document.getElementById(placeholderId);
                if (input && placeholder) {
                    input.value = '';
                    placeholder.innerHTML = `
                        <div class="placeholder-icon">📷</div>
                        <button class="remove-btn" onclick="removeImage('${inputId}', '${placeholderId}')">×</button>
                    `;
                    placeholder.classList.remove('has-image');
                }
            };

            // Equity validation
            window.validateEquityPercentage = function(input) {
                const value = parseFloat(input.value);
                if (value < 0 || value > 100) {
                    input.value = '';
                }
            };

            window.formatEquityValue = function(input) {
                if (input.value) {
                    input.value = parseFloat(input.value).toFixed(2);
                }
            };

            // Validation function with scroll to first error
            function validateForm() {
                let isValid = true;
                let firstErrorElement = null;

                // Helper function to set error and track first error
                function setError(input, errorElement, message) {
                    errorElement.textContent = message;
                    errorElement.classList.remove('d-none');
                    if (!firstErrorElement) {
                        firstErrorElement = input;
                    }
                }

                // Clear previous errors
                const errorElements = document.querySelectorAll('.text-danger');
                errorElements.forEach(error => {
                    error.textContent = '';
                    error.classList.add('d-none');
                });

                // Personal Information Validation
                if (!fullNameInput.value.trim()) {
                    setError(fullNameInput, fullNameError, 'Full Name is required');
                    isValid = false;
                }

                if (!countrySelect.value) {
                    setError(countrySelect, countryError, 'Country is required');
                    isValid = false;
                }

                if (!stateSelect.value) {
                    setError(stateSelect, stateError, 'State is required');
                    isValid = false;
                }

                if (!citySelect.value) {
                    setError(citySelect, cityError, 'City is required');
                    isValid = false;
                }

                if (!pinCodeInput.value.trim()) {
                    setError(pinCodeInput, pinCodeError, 'Pin/Zip Code is required');
                    isValid = false;
                } else if (countrySelect.value === 'IN' && !/^\d{6}$/.test(pinCodeInput.value.trim())) {
                    setError(pinCodeInput, pinCodeError, 'Indian pin code must be exactly 6 digits');
                    isValid = false;
                } else if (countrySelect.value === 'US' && !/^\d{5}$/.test(pinCodeInput.value.trim())) {
                    setError(pinCodeInput, pinCodeError, 'US zip code must be exactly 5 digits');
                    isValid = false;
                }

                if (!phoneNumberInput.value.trim()) {
                    setError(phoneNumberInput, phoneNumberError, 'Phone number is required');
                    isValid = false;
                } else if (!/^\d{10,12}$/.test(phoneNumberInput.value.trim())) {
                    setError(phoneNumberInput, phoneNumberError, 'Phone number must be 10-12 digits');
                    isValid = false;
                }

                if (dobInput.value) {
                    const dob = new Date(dobInput.value);
                    const today = new Date();
                    let age = today.getFullYear() - dob.getFullYear();
                    const monthDiff = today.getMonth() - dob.getMonth();
                    if (monthDiff < 0 || (monthDiff === 0 && today.getDate() < dob.getDate())) {
                        age--;
                    }
                    if (age < 18) {
                        setError(dobInput, dobError, 'You must be at least 18 years old');
                        isValid = false;
                    }
                }

                // Required fields when existing_company_no or existing_company_yes
                if (!investmentRangeSelect.value) {
                    setError(investmentRangeSelect, investmentRangeError, 'Investment Range is required');
                    isValid = false;
                }

                if (!professionalPhoneInput.value.trim()) {
                    setError(professionalPhoneInput, professionalPhoneError,
                        'Professional phone number is required');
                    isValid = false;
                } else if (!/^\d{10,12}$/.test(professionalPhoneInput.value.trim())) {
                    setError(professionalPhoneInput, professionalPhoneError,
                        'Professional phone number must be 10-12 digits');
                    isValid = false;
                }

                // Validate company fields if existing_company_yes is selected
                if (existingCompanyYes.checked) {
                    const organizationNameInput = document.querySelector('input[name="organization_name"]');
                    const companyCountrySelect = document.getElementById('company_country');
                    const companyStateSelect = document.getElementById('company_state');
                    const companyCitySelect = document.getElementById('company_city');
                    const companyZipcodeInput = document.querySelector('input[name="company_zipcode"]');
                    const professionalEmailInput = document.querySelector('input[name="professional_email"]');
                    const taxRegistrationNumberInput = document.querySelector(
                        'input[name="tax_registration_number"]');
                    const designationSelect = document.getElementById('designation');
                    const businessLogoInput = document.getElementById('business_logo');

                    if (!organizationNameInput.value.trim()) {
                        setError(organizationNameInput, organizationNameError, 'Company Name is required');
                        isValid = false;
                    }

                    if (!companyCountrySelect.value) {
                        setError(companyCountrySelect, companyCountryError, 'Business Country is required');
                        isValid = false;
                    }

                    if (!companyStateSelect.value) {
                        setError(companyStateSelect, companyStateError, 'Business State is required');
                        isValid = false;
                    }

                    if (!companyCitySelect.value) {
                        setError(companyCitySelect, companyCityError, 'Business City is required');
                        isValid = false;
                    }

                    if (!companyZipcodeInput.value.trim()) {
                        setError(companyZipcodeInput, companyZipcodeError, 'Business Pin/Zip Code is required');
                        isValid = false;
                    } else if (companyCountrySelect.value === 'India' && !/^\d{6}$/.test(companyZipcodeInput.value
                            .trim())) {
                        setError(companyZipcodeInput, companyZipcodeError,
                            'Indian pin code must be exactly 6 digits');
                        isValid = false;
                    } else if (companyCountrySelect.value === 'United States' && !/^\d{5}$/.test(companyZipcodeInput
                            .value.trim())) {
                        setError(companyZipcodeInput, companyZipcodeError, 'US zip code must be exactly 5 digits');
                        isValid = false;
                    }

                    if (professionalEmailInput.value.trim() && !/^[^\s@]+@[^\s@]+\.[^\s@]+$/.test(
                            professionalEmailInput.value.trim())) {
                        setError(professionalEmailInput, professionalEmailError, 'Invalid email format');
                        isValid = false;
                    }

                    if (!taxRegistrationNumberInput.value.trim()) {
                        setError(taxRegistrationNumberInput, taxRegistrationNumberError,
                            'Tax Registration Number is required');
                        isValid = false;
                    }

                    if (!designationSelect.value) {
                        setError(designationSelect, designationError, 'Designation is required');
                        isValid = false;
                    }

                    if (!businessLogoInput.files.length && !document.querySelector('#business_logo_preview img')) {
                        setError(businessLogoInput, businessLogoError, 'Business Logo is required');
                        isValid = false;
                    }
                }

                // Validate investment fields if actively_investing is checked
                if (activelyInvestingCheckbox.checked) {
                    const companyGroups = companyWrapper.querySelectorAll('.company-group');
                    companyGroups.forEach((group, index) => {
                        const companyNameInput = group.querySelector('input[name="company_name[]"]');
                        const marketCapitalInput = group.querySelector('input[name="market_capital[]"]');
                        const yourStakeInput = group.querySelector('input[name="your_stake[]"]');
                        const stakeFundingInput = group.querySelector('input[name="stake_funding[]"]');
                        const companyNameError = group.querySelector('.company-name-error');
                        const marketCapitalError = group.querySelector('.market-capital-error');
                        const equityError = group.querySelector('.equity-error');
                        const valuationError = group.querySelector('.valuation-error');

                        if (!companyNameInput.value.trim()) {
                            setError(companyNameInput, companyNameError,
                                `Company Name ${index + 1} is required`);
                            isValid = false;
                        }

                        if (!marketCapitalInput.value) {
                            setError(marketCapitalInput, marketCapitalError,
                                `Investment Amount ${index + 1} is required`);
                            isValid = false;
                        } else if (marketCapitalInput.value <= 0) {
                            setError(marketCapitalInput, marketCapitalError,
                                `Investment Amount ${index + 1} must be greater than 0`);
                            isValid = false;
                        }

                        if (!yourStakeInput.value) {
                            setError(yourStakeInput, equityError,
                                `Equity Holding ${index + 1} is required`);
                            isValid = false;
                        } else if (yourStakeInput.value <= 0 || yourStakeInput.value > 100) {
                            setError(yourStakeInput, equityError,
                                `Equity Holding ${index + 1} must be between 0 and 100`);
                            isValid = false;
                        }

                        if (!stakeFundingInput.value) {
                            setError(stakeFundingInput, valuationError,
                                `Company Valuation ${index + 1} is required`);
                            isValid = false;
                        }
                    });
                }

                // Validate photo field
                const photoInput = document.getElementById('photo');
                if (!photoInput.files.length && !document.querySelector('#photo-placeholder img')) {
                    setError(photoInput, photoError, 'Passport Size Photo is required');
                    isValid = false;
                }

                // Scroll to the first error if validation fails
                if (!isValid && firstErrorElement) {
                    firstErrorElement.scrollIntoView({
                        behavior: 'smooth',
                        block: 'center'
                    });
                }

                return isValid;
            }

            // Submit button event listener
            const submitBtn = document.getElementById('submitBtn');
            if (submitBtn) {
                submitBtn.addEventListener('click', function(e) {
                    if (!validateForm()) {
                        e.preventDefault();
                    }
                });
            }

            // Fetch data from API
            async function fetchData(url) {
                try {
                    const response = await fetch(url, {
                        headers: {
                            'X-CSCAPI-KEY': API_KEY
                        }
                    });
                    if (!response.ok) throw new Error('Network response was not ok');
                    return await response.json();
                } catch (error) {
                    console.error('Error fetching data:', error);
                    return [];
                }
            }

            // Populate dropdown
            function populateDropdown(selectElement, data, defaultText) {
                selectElement.innerHTML = `<option value="">${defaultText}</option>`;
                data.forEach(item => {
                    const option = document.createElement('option');
                    option.value = item.iso2 || item.name;
                    option.textContent = item.name;
                    selectElement.appendChild(option);
                });
            }

            // Initialize country dropdowns
            async function initCountryDropdown(selectElement, stateSelect, citySelect, prefilledCountry = '',
                prefilledState = '') {
                const countries = await fetchData(`${BASE_URL}/countries`);
                populateDropdown(selectElement, countries, 'Select a country');

                if (prefilledCountry) {
                    selectElement.value = prefilledCountry;
                    const countryCode = prefilledCountry;
                    const states = await fetchData(`${BASE_URL}/countries/${countryCode}/states`);
                    populateDropdown(stateSelect, states, 'Select State');

                    if (prefilledState) {
                        stateSelect.value = prefilledState;
                        const stateCode = prefilledState;
                        const cities = await fetchData(
                            `${BASE_URL}/countries/${countryCode}/states/${stateCode}/cities`);
                        populateDropdown(citySelect, cities, 'Select City');
                    }
                }

                selectElement.addEventListener('change', async function() {
                    const countryCode = this.value;
                    stateSelect.innerHTML = '<option value="">Select State</option>';
                    citySelect.innerHTML = '<option value="">Select City</option>';

                    if (countryCode) {
                        console.log(`Populating states for country: ${countryCode}`);
                        const states = await fetchData(
                            `${BASE_URL}/countries/${countryCode}/states`);
                        populateDropdown(stateSelect, states, 'Select State');

                        stateSelect.addEventListener('change', async function() {
                            const stateCode = this.value;
                            citySelect.innerHTML =
                                '<option value="">Select City</option>';

                            if (stateCode) {
                                const cities = await fetchData(
                                    `${BASE_URL}/countries/${countryCode}/states/${stateCode}/cities`
                                );
                                populateDropdown(citySelect, cities, 'Select City');
                            }
                        });
                    }
                });
            }

            // Initialize dropdowns with pre-filled values from Blade
            initCountryDropdown(countrySelect, stateSelect, citySelect,
                '{{ old('country', $investo->country ?? '') }}',
                '{{ old('state', $investo->state ?? '') }}');

            // Initialize company country dropdown
            const companyCountrySelect = document.getElementById('company_country');
            const companyStateSelect = document.getElementById('company_state');
            const companyCitySelect = document.getElementById('company_city');
            initCountryDropdown(companyCountrySelect, companyStateSelect, companyCitySelect,
                '{{ old('company_country', $investo->company_country ?? '') }}',
                '{{ old('company_state', $investo->company_state ?? '') }}');


            function updateFundingCurrencyLabel() {
                const selectedCountry = (countrySelect?.value || '').trim().toUpperCase();
                let label = '';

                if (selectedCountry === 'IN') {
                    label = '(INR)';
                } else if (selectedCountry !== '') {
                    label = '(USD)';
                }

                fundingCurrencyLabels.forEach(el => {
                    el.textContent = label;
                });
            }

            // Initialize currency label on page load
            updateFundingCurrencyLabel();

            // Add event listeners for country selection changes
            countrySelect?.addEventListener('change', updateFundingCurrencyLabel);
            // File upload validation
            function validateFile(file, errorElement, maxSize, allowedTypes) {
                if (file.size > maxSize) {
                    setError(document.getElementById('business_logo'), errorElement,
                        `File size must not exceed ${maxSize / (1024 * 1024)}MB`);
                    return false;
                }
                if (!allowedTypes.includes(file.type)) {
                    setError(document.getElementById('business_logo'), errorElement,
                        `File type must be ${allowedTypes.join(', ')}`);
                    return false;
                }
                return true;
            }

            // Business Logo validation
            if (businessLogoInput) {
                businessLogoInput.addEventListener('change', function(e) {
                    const file = e.target.files[0];
                    if (!file) {
                        console.error('No file selected for business logo');
                        return;
                    }

                    // Validate file
                    if (!validateFile(file, businessLogoError, MAX_FILE_SIZE, ['image/jpeg', 'image/jpg',
                            'image/png'
                        ])) {
                        e.target.value = ''; // Clear the input if validation fails
                        return;
                    }

                    const reader = new FileReader();
                    reader.onload = function(e) {
                        const logoPlaceholder = document.getElementById('logo-placeholder');
                        if (logoPlaceholder) {
                            logoPlaceholder.innerHTML = `
                                <img src="${e.target.result}" alt="Business Logo" style="max-width: 100px; max-height: 100px;">
                                <button class="remove-btn" onclick="removeImage('business_logo', 'logo-placeholder')">×</button>
                            `;
                            logoPlaceholder.classList.add('has-image');
                            businessLogoError.classList.add('d-none');
                        } else {
                            console.error('Logo placeholder element not found');
                        }
                    };
                    reader.readAsDataURL(file);
                });
            } else {
                console.error('Business logo input element not found');
            }

            // Passport Size Photo validation
            if (photoInput) {
                photoInput.addEventListener('change', function(e) {
                    const file = e.target.files[0];
                    if (!file) {
                        console.error('No file selected for passport photo');
                        return;
                    }

                    // Validate file
                    if (!validateFile(file, photoError, MAX_FILE_SIZE, ['image/jpeg', 'image/jpg',
                            'image/png'
                        ])) {
                        e.target.value = ''; // Clear the input if validation fails
                        return;
                    }

                    const reader = new FileReader();
                    reader.onload = function(e) {
                        const photoPlaceholder = document.getElementById('photo-placeholder');
                        if (photoPlaceholder) {
                            photoPlaceholder.innerHTML = `
                                <img src="${e.target.result}" alt="Passport Photo" style="max-width: 100px; max-height: 100px;">
                                <button class="remove-btn" onclick="removeImage('photo', 'photo-placeholder')">×</button>
                            `;
                            photoPlaceholder.classList.add('has-image');
                            photoError.classList.add('d-none');
                        } else {
                            console.error('Photo placeholder element not found');
                        }
                    };
                    reader.readAsDataURL(file);
                });
            } else {
                console.error('Photo input element not found');
            }

            // Investor Profile validation
            const investorProfileInput = document.getElementById('investor_profile');
            investorProfileInput.addEventListener('change', function() {
                validateFile(this.files[0], document.getElementById('investor_profile_error'),
                    MAX_FILE_SIZE, ['application/pdf']);
            });

            // Format number in Indian numbering system
            function formatIndianNumber(number) {
                const parts = parseFloat(number).toFixed(2).toString().split('.');
                let integerPart = parts[0];
                const decimalPart = parts[1];
                let lastThree = integerPart.substring(integerPart.length - 3);
                let otherNumbers = integerPart.substring(0, integerPart.length - 3);
                if (otherNumbers !== '') {
                    lastThree = ',' + lastThree;
                }
                const formattedInteger = otherNumbers.replace(/\B(?=(\d{2})+(?!\d))/g, ',') + lastThree;
                return `${formattedInteger}.${decimalPart}`;
            }
        });

        /* file upload*/
        const uploadArea = document.getElementById('uploadArea');
        const fileInput = document.getElementById('investor_profile');
        const fileInfo = document.getElementById('fileInfo');
        const fileName = document.getElementById('fileName');
        const fileSize = document.getElementById('fileSize');
        const errorMessage = document.getElementById('errorMessage');
        const progressBar = document.getElementById('progressBar');
        const progressFill = document.getElementById('progressFill');

        // Drag and drop events
        uploadArea.addEventListener('dragover', (e) => {
            e.preventDefault();
            uploadArea.classList.add('drag-over');
        });

        uploadArea.addEventListener('dragleave', (e) => {
            e.preventDefault();
            uploadArea.classList.remove('drag-over');
        });

        uploadArea.addEventListener('drop', (e) => {
            e.preventDefault();
            uploadArea.classList.remove('drag-over');

            const files = e.dataTransfer.files;
            if (files.length > 0) {
                handleFile(files[0]);
            }
        });

        // File input change event
        fileInput.addEventListener('change', (e) => {
            if (e.target.files.length > 0) {
                handleFile(e.target.files[0]);
            }
        });

        // Handle file selection
        function handleFile(file) {
            // Reset error message
            errorMessage.style.display = 'none';
            errorMessage.textContent = '';

            // Validate file type
            if (file.type !== 'application/pdf') {
                showError('Please select a PDF file only.');
                return;
            }

            // Validate file size (e.g., max 10MB)
            const maxSize = 10 * 1024 * 1024; // 10MB
            if (file.size > maxSize) {
                showError('File size should not exceed 10MB.');
                return;
            }

            // Update UI
            fileName.textContent = file.name;
            fileSize.textContent = formatFileSize(file.size);

            fileInfo.style.display = 'block';
            uploadArea.classList.add('has-file')
        }

        // Format file size
        function formatFileSize(bytes) {
            if (bytes === 0) return '0 Bytes';

            const k = 1024;
            const sizes = ['Bytes', 'KB', 'MB', 'GB'];
            const i = Math.floor(Math.log(bytes) / Math.log(k));

            return parseFloat((bytes / Math.pow(k, i)).toFixed(2)) + ' ' + sizes[i];
        }

        // Simulate upload progress
        function simulateUpload() {
            progressBar.style.display = 'block';
            let progress = 0;

            const interval = setInterval(() => {
                progress += Math.random() * 15;
                if (progress >= 100) {
                    progress = 100;
                    clearInterval(interval);
                    setTimeout(() => {
                        progressBar.style.display = 'none';
                    }, 1000);
                }
                progressFill.style.width = progress + '%';
            }, 200);
        }

        // Click on upload area to trigger file selection
        uploadArea.addEventListener('click', (e) => {
            if (e.target !== document.querySelector('.browse-btn')) {
                fileInput.click();
            }
        });
    </script>
@endsection
