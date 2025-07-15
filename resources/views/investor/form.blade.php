@extends('layouts.app')
<link href="https://cdn.jsdelivr.net/npm/select2@4.1.0-rc.0/dist/css/select2.min.css" rel="stylesheet" />
<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/flatpickr/4.6.13/flatpickr.min.css">
<script src="https://cdnjs.cloudflare.com/ajax/libs/flatpickr/4.6.13/flatpickr.min.js"></script>
@section('title', 'Investor Registration - Future Taikun')
<style>
    .step-progress {
        display: flex;
        justify-content: space-between;
        align-items: center;
        margin: 30px 0;
        padding: 0 20px;
    }

    .step {
        display: flex;
        flex-direction: column;
        align-items: center;
        flex: 1;
        position: relative;
    }

    .step:not(:last-child)::after {
        content: '';
        position: absolute;
        top: 15px;
        right: -50%;
        width: 100%;
        height: 2px;
        background-color: #e9ecef;
        z-index: 1;
    }

    .step.completed:not(:last-child)::after {
        background-color: #007bff;
    }

    .step.active:not(:last-child)::after {
        background-color: #ffc107;
    }

    .step-number {
        width: 30px;
        height: 30px;
        border-radius: 50%;
        display: flex;
        align-items: center;
        justify-content: center;
        font-weight: bold;
        font-size: 14px;
        position: relative;
        z-index: 2;
        margin-bottom: 8px;
    }

    .step.completed .step-number {
        background-color: #007bff;
        color: white;
    }

    .step.active .step-number {
        background-color: #ffc107;
        color: white;
    }

    .step.pending .step-number {
        background-color: #6c757d;
        color: white;
    }

    .step-label {
        font-size: 12px;
        text-align: center;
        max-width: 100px;
        line-height: 1.2;
    }

    .step.completed .step-label {
        color: #007bff;
        font-weight: 500;
    }

    .step.active .step-label {
        color: #ffc107;
        font-weight: 500;
    }

    .step.pending .step-label {
        color: #6c757d;
    }

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

    .industry-options,
    .geography-options,
    .investor-type-options,
    .investment-range-options,
    .startup-stage-options {
        display: flex;
        flex-wrap: wrap;
        gap: 10px;
        margin-top: 10px;
    }

    .industry-option,
    .geography-option,
    .investor-type-option,
    .investment-range-option,
    .startup-stage-option {
        display: inline-block;
    }

    .industry-label,
    .geography-label,
    .investor-type-label,
    .investment-range-label,
    .startup-stage-label {
        display: inline-block;
        padding: 8px 16px;
        background-color: #f8f9fa;
        border: 2px solid #e9ecef;
        border-radius: 25px;
        cursor: pointer;
        font-size: 14px;
        font-weight: 500;
        color: #6c757d;
        transition: all 0.3s ease;
        margin: 0;
        user-select: none;
    }

    .industry-label:hover,
    .geography-label:hover,
    .investor-type-label:hover,
    .investment-range-label:hover,
    .startup-stage-label:hover {
        background-color: #e9ecef;
        border-color: #FFE7EA;
        color: #495057;
        transform: translateY(-1px);
    }

    input[type="checkbox"]:checked+.industry-label,
    input[type="checkbox"]:checked+.geography-label,
    input[type="radio"]:checked+.investor-type-label,
    input[type="radio"]:checked+.investment-range-label,
    input[type="checkbox"]:checked+.startup-stage-label {
        background-color: #FFE7EA;
        border-color: #FFE7EA;
        color: black;
        box-shadow: 0 2px 4px rgba(40, 167, 69, 0.3);
    }

    input[type="checkbox"]:checked+.industry-label:hover,
    input[type="checkbox"]:checked+.geography-label:hover,
    input[type="radio"]:checked+.investor-type-label:hover,
    input[type="radio"]:checked+.investment-range-label:hover,
    input[type="checkbox"]:checked+.startup-stage-label:hover {
        background-color: #FFE7EA;
        border-color: #FFE7EA;
        color: black;
    }

    .select2-container {
        width: 100% !important;
    }

    .select2-selection--multiple {
        min-height: 38px;
        border: 1px solid #ced4da !important;
        border-radius: 0.25rem;
    }

    .select2-selection__choice {
        background-color: #e9ecef;
        border: 1px solid #ced4da;
    }

    .select2-selection__clear {
        cursor: pointer;
    }

    .form-select[multiple] {
        height: auto !important;
        /* Dynamic height for multi-select */
        min-height: 120px;
        /* Minimum height for visibility */
        padding: 0.5rem 1rem !important;
    }

    /* Select2 specific styling */
    .select2-container--default .select2-selection--multiple {
        border-radius: 0.5rem !important;
        /* Match rounded corners */
        border: 1px solid #ced4da !important;
        /* Match border color */
        padding: 0.25rem 0.5rem !important;
        /* Adjust padding inside Select2 */
        min-height: 44px !important;
        /* Match input height */
    }

    .select2-container {
        width: 100% !important;
        /* Full width */
    }

    .select2-selection__rendered {
        padding: 0.25rem 0 !important;
        /* Adjust padding for selected items */
    }

    .select2-selection__choice {
        background-color: #ced4da !important;
        /* Light gray background for selected items */
        border: 1px solid #ced4da !important;
        border-radius: 0.25rem !important;
        padding: 0.25rem 0.5rem !important;
        margin: 0.25rem !important;
    }

    .select2-selection__choice__remove {
        margin-right: 0.5rem !important;
        color: #6c757d !important;
    }

    .select2-container--default .select2-selection--multiple:focus {
        border-color: #007bff !important;
        box-shadow: 0 0 0 0.25rem rgba(0, 123, 255, 0.25) !important;
    }

    .select2-container--default .select2-selection--multiple .select2-selection__choice__display {
        padding-left: 15px !important;
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
            <div class="step-progress">
                <div class="step completed" data-step="1">
                    <div class="step-number">
                        <i class="fas fa-check"></i>
                    </div>
                    <div class="step-label">Register</div>
                </div>
                <div class="step active" data-step="2">
                    <div class="step-number">2</div>
                    <div class="step-label">Personal Information</div>
                </div>
                {{-- <div class="step pending" data-step="3">
                        <div class="step-number">3</div>
                        <div class="step-label">Investment Information</div>
                    </div> --}}
                <div class="step pending" data-step="3">
                    <div class="step-number">3</div>
                    <div class="step-label">Professional Information</div>
                </div>
                <div class="step pending" data-step="4">
                    <div class="step-number">4</div>
                    <div class="step-label">Documents</div>
                </div>
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
                                        <label class="form-label">Full Name *</label>
                                        <input type="text" class="form-control" name="full_name"
                                            value="{{ old('full_name', $investo->full_name ?? '') }}"
                                            placeholder="Joey Tucker" required>
                                        <div class="text-danger mt-1 d-none" id="full_name_error"></div>
                                    </div>
                                </div>

                                <div class="col-md-6 mb-3">
                                    <div class="form-floating-custom">
                                        <label class="form-label">Email Address *</label>
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
                                        <label for="current_address">Residentail Address *</label>
                                        <div class="text-danger mt-1 d-none" id="current_address_error"></div>
                                    </div>
                                </div>

                                {{-- <div class="col-md-6 mb-3">
                                    <div class="form-floating-custom">
                                        <select name="country" class="form-select" id="country" required>
                                            <option value="">Select a country</option>
                                            @foreach ($countries as $country)
                                                <option value="{{ $country['name'] }}"
                                                    {{ old('country', $investo->country ?? $autoDetectedCountry) == $country['name'] ? 'selected' : '' }}>
                                                    {{ $country['name'] }}
                                                </option>
                                            @endforeach
                                        </select>
                                        <label for="form-label">Country *</label>
                                        <div class="text-danger mt-1 d-none" id="country_error"></div>
                                    </div>
                                </div>

                                <div class="col-md-6 mb-3">
                                    <div class="form-floating-custom">
                                        <select class="form-control" name="state" id="state" required>
                                            <option value="">Select State</option>
                                        </select>
                                        <label class="form-label">State *</label>
                                        <div class="text-danger mt-1 d-none" id="state_error"></div>
                                    </div>
                                </div>

                                <div class="col-md-6 mb-3">
                                    <div class="form-floating-custom">
                                        <select class="form-control" name="city" id="city" required>
                                            <option value="">Select City</option>
                                        </select>
                                        <label class="form-label">City *</label>
                                        <div class="text-danger mt-1 d-none" id="city_error"></div>
                                    </div>
                                </div> --}}

                                <div class="col-md-6 mb-3">
                                    <div class="form-floating-custom">
                                        <select name="country" class="form-select" id="country" required>
                                            <option value="">Select a country</option>
                                        </select>
                                        <label for="country">Country *</label>
                                        <div class="text-danger mt-1 d-none" id="country_error"></div>
                                    </div>
                                </div>

                                <div class="col-md-6 mb-3">
                                    <div class="form-floating-custom">
                                        <select class="form-control" name="state" id="state" required>
                                            <option value="">Select State</option>
                                            {{-- Dynamically filled via JS --}}
                                        </select>
                                        <label class="state">State *</label>
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
                                            class="form-control" name="pin_code"
                                            value="{{ old('pin_code', $investo->pin_code ?? '') }}" placeholder="852741">
                                        <label class="from-label">Pin/Zip Code *</label>
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
                                        <label class="form-label">Date of Birth *</label>
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
                                            <label for="qualification">Select Qualification *</label>
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

                                <div class="col-12 mb-3">
                                    {{-- <div class="form-floating-custom"> --}}
                                    <label for="y_pitch_deck" class="form-label">Upload Passport Size Photo</label>
                                    <div class="file-upload-wrapper">
                                        <input class="form-control" type="file" id="photo" name="photo">
                                        <label for="photo" class="file-upload-label w-100">
                                            {{-- <i class="fas fa-upload me-2"></i>Choose Image file...(jpg,png,jpeg) --}}
                                        </label>
                                    </div>
                                    <div id="photo_preview" class="image-preview-container mt-2">
                                        @if ($investo && $investo->photo)
                                            <img src="{{ Storage::url($investo->photo) }}" alt="Saved Photo"
                                                style="max-width: 100px;">
                                            <small class="form-text text-muted">
                                                Current photo: <a href="{{ Storage::url($investo->photo) }}"
                                                    target="_blank">View</a>
                                            </small>
                                        @endif
                                    </div>
                                    <div class="text-danger mt-1 d-none" id="photo_error"></div>
                                    <small class="text-muted">Select 1 image (JPG, JPEG, PNG only, max 2MB)</small>
                                    {{-- </div> --}}
                                </div>
                            </div>
                        </div>
                        <!-- Step 4: Legal and Funding Information -->
                        <div class="form-step" data-step="3">
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
                                                <label class="form-label">Company Name *</label>
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
                                                <label class="form-label" id="company_address">Business Address *</label>
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
                                                <label for="company_country">Business Country *</label>
                                                <div class="text-danger mt-1 d-none" id="company_country_error"></div>
                                            </div>
                                        </div>

                                        <div class="col-md-6 mb-3">
                                            <div class="form-floating-custom">
                                                <select class="form-control" name="company_state" id="company_state">
                                                    <option value="">Select State</option>
                                                </select>
                                                <label for="company_state">Business State *</label>
                                                <div class="text-danger mt-1 d-none" id="company_state_error"></div>
                                            </div>
                                        </div>

                                        <div class="col-md-6 mb-3">
                                            <div class="form-floating-custom">
                                                <select class="form-control" name="company_city" id="company_city">
                                                    <option value="">Select City</option>
                                                </select>
                                                <label for="company_city">Business City *</label>
                                                <div class="text-danger mt-1 d-none" id="company_city_error"></div>
                                            </div>
                                        </div>

                                        <div class="col-md-6 mb-3">
                                            <div class="form-floating-custom">
                                                <input type="text" class="form-control" name="company_zipcode"
                                                    value="{{ old('company_zipcode', $investo->company_zipcode ?? '') }}"
                                                    placeholder="852741">
                                                <label class="form-label" id="company_zipcode_label">Business Pin / Zip
                                                    Code
                                                    *</label>
                                                <div class="text-danger mt-1 d-none" id="company_zipcode_error"></div>
                                            </div>
                                        </div>

                                        <div class="col-md-6 mb-3">
                                            <div class="form-floating-custom">
                                                <label class="form-label">Email Address *</label>
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
                                                <label class="form-label">Business Tax Registration Number *</label>
                                                <input type="text" class="form-control" name="tax_registration_number"
                                                    id="tax_registration_number" placeholder="SC123456"
                                                    value="{{ old('tax_registration_number', $investo->tax_registration_number ?? '') }}">
                                                <div class="text-danger mt-1 d-none" id="tax_registration_number_error">
                                                </div>
                                            </div>
                                        </div>
                                        <div class="col-md-6 mb-3">
                                            <div class="form-floating-custom">
                                                <label class="form-label">Your Postion *</label>

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
                                        <div class="col-md-6 mb-3">
                                            {{-- <div class="form-floating-custom"> --}}
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
                                                        Current logo: <a
                                                            href="{{ Storage::url($investo->business_logo) }}"
                                                            target="_blank">View</a>
                                                    </small>
                                                @endif
                                            </div>
                                            <div class="text-danger mt-1 d-none" id="business_logo_error"></div>
                                            <small class="text-muted">Select 1 image (JPG, JPEG, PNG only, max 5MB)</small>
                                            {{-- </div> --}}
                                        </div>

                                        <div class="col-md-6 mb-3">
                                            {{-- <div class="form-floating-custom"> --}}
                                            <label for="investor_profile" class="form-label">Upload Business
                                                Profile</label>
                                            <div class="file-upload-wrapper">
                                                <input class="form-control" type="file" id="investor_profile"
                                                    name="investor_profile" accept=".pdf"
                                                    value="{{ old('investor_profile') }}">
                                                <label for="investor_profile" class="file-upload-label w-100">
                                                </label>
                                            </div>
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
                                        <label class="form-label">Years of an Investment Experience *</label>

                                        <select class="form-select" name="investment_experince"
                                            id="investment_experince">
                                            <option value="">Years of an Investment Experience *</option>
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
                                        <label class="form-label">Investor Type *</label>

                                        <select class="form-select" name="investor_type" id="investor_type">
                                            <option value="">Select Investor</option>
                                            @foreach ($investorTypes as $type)
                                                <option value="{{ $type }}"
                                                    {{ old('investor_type', $investo->investor_type ?? '') == $type ? 'selected' : '' }}>
                                                    {{ $type }}
                                                </option>
                                            @endforeach
                                        </select>
                                        <label for="industry">Select Investor Type *</label>
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
                                        <label for="industry">Investment Range *<span class="funding_currency_label"
                                                id="funding_currency_label">()</span></label>
                                        <div class="text-danger mt-1 d-none" id="investment_range_error"></div>
                                    </div>
                                </div>

                                <div class="col-md-6 mb-3">
                                    <div class="form-floating-custom">
                                        <label class="form-label" for="preferred_startup_stage">Preferred Investment
                                            Stage
                                            *</label>
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
                                {{-- </div> --}}
                            </div>
                        </div>
                        {{-- //// --}}
                        <!-- Step 5: Documents -->
                        <div class="form-step" data-step="4">
                            <div class="row mb-4">
                                <div class="col-12">
                                    {{-- <h5 class="mb-3" style="color: black; font-family:mat; font-weight:bold;">
                                            <i class="fas fa-file me-2"></i>Investment Preferences
                                        </h5> --}}
                                </div>

                                <div class="col-md-6 mb-3">
                                    <div class="form-floating-custom">
                                        <label class="form-label">Preferred Industries * (Select multiple)</label>
                                        {{-- <div class="industry-options">
                                        @foreach ($industries as $industry)
                                            <div class="industry-option">
                                                <input class="form-check-input d-none" type="checkbox"
                                                    name="preferred_industries[]" value="{{ $industry }}"
                                                    id="industry_{{ $loop->index }}"
                                                    {{ in_array($industry, old('preferred_industries', [])) ? 'checked' : '' }}>
                                                <label class="industry-label" for="industry_{{ $loop->index }}">
                                                    {{ $industry }}
                                                </label>
                                            </div>
                                        @endforeach
                                    </div> --}}
                                        <select class="form-select" name="preferred_industries[]"
                                            id="preferred_industries" multiple>
                                            <option value="">Preferred Industries * (Select multiple)</option>
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
                                        <label class="form-label">Preferred Geographies * (Select multiple)</label>
                                        {{-- <div class="industry-options">
                                        @foreach ($geographies as $geography)
                                            <div class="industry-option">
                                                <input class="form-check-input d-none" type="checkbox"
                                                    name="preferred_geographies[]" value="{{ $geography }}"
                                                    id="geography_{{ $loop->index }}"
                                                    {{ in_array($geography, old('preferred_geographies', [])) ? 'checked' : '' }}>
                                                <label class="industry-label" for="geography_{{ $loop->index }}">
                                                    {{ $geography }}
                                                </label>
                                            </div>
                                        @endforeach
                                    </div> --}}
                                        <select class="form-select" name="preferred_geographies[]"
                                            id="preferred_geographies" multiple>
                                            <option value="">Preferred Industries * (Select multiple)</option>
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
                                                    <label class="form-label">Company Name *</label>
                                                    <input type="text" class="form-control" name="company_name[]"
                                                        placeholder="Company Name">
                                                </div>
                                                <div class="col-md-6 mb-3">
                                                    <label class="form-label">Investment in This Company <span
                                                            class="funding_currency_label"
                                                            id="funding_currency_label">()</span></label>
                                                    <input type="number" class="form-control investment"
                                                        name="market_capital[]" placeholder="Numeric Input">
                                                </div>
                                                {{-- <div class="col-md-6 mb-3">
                                                        <label class="form-label">Equity Holding in This Company (in
                                                            %)*</label>
                                                        <input type="number" class="form-control equity" name="your_stake[]"
                                                            placeholder="00.00">
                                                    </div> --}}
                                                <div class="col-md-6 mb-3">
                                                    <label class="form-label">Equity Holding in This Company (in
                                                        %)*</label>
                                                    <input type="number" class="form-control equity" name="your_stake[]"
                                                        min="0" max="100" step="0.01" placeholder="00.00"
                                                        oninput="validateEquityPercentage(this)"
                                                        onblur="formatEquityValue(this)">
                                                    <div class="text-danger mt-1 d-none equity-error"></div>
                                                </div>

                                                <div class="col-md-6 mb-3">
                                                    <label class="form-label">Company Valuation <span
                                                            class="funding_currency_label"
                                                            id="funding_currency_label">()</span>*</label>
                                                    <input type="text" class="form-control valuation"
                                                        name="stake_funding[]" readonly>
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
                            </div>
                        </div>

                        <div class="step-navigation">
                            <button type="button" class="btn btn-outline-secondary btn-step" id="prevBtn"
                                onclick="changeStep(-1)" style="display: none;">
                                <i class="fas fa-arrow-left me-2"></i>Previous
                            </button>
                            {{-- <div></div> --}}
                            <button type="button" class="btn btn-danger btn-step" id="clearBtn"
                                onclick="clearCurrentStep()">
                                <i class="fas fa-eraser me-2"></i>Clear
                            </button>
                            <button type="button" class="btn btn-primary btn-step" id="nextBtn"
                                onclick="changeStep(1)">
                                Next<i class="fas fa-arrow-right ms-2"></i>
                            </button>
                            <button type="submit" class="btn btn-primary btn-step" id="submitBtn"
                                style="display: none;">
                                <i class="fas fa-check me-2"></i>Complete
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
    <script>
        function clearCurrentStep() {
            const currentStepEl = document.querySelector(`.form-step[data-step="${currentStep}"]`);

            // Clear text, email, tel, number, and URL inputs
            currentStepEl.querySelectorAll(
                    'input[type="text"], input[type="email"], input[type="tel"], input[type="number"], input[type="url"]')
                .forEach(input => {
                    input.value = '';
                });

            // Reset select elements to their default option
            currentStepEl.querySelectorAll('select').forEach(select => {
                select.selectedIndex = 0; // Reset to first option (usually the placeholder)
                // If using Select2, trigger change to update UI
                if (typeof $(select).select2 === 'function') {
                    $(select).val(null).trigger('change');
                }
            });

            // Clear file inputs and their previews
            currentStepEl.querySelectorAll('input[type="file"]').forEach(fileInput => {
                fileInput.value = ''; // Clear file input
                const previewId = fileInput.id + '_preview';
                const previewContainer = document.getElementById(previewId);
                if (previewContainer) {
                    previewContainer.innerHTML = ''; // Clear preview
                }
            });

            // Reset radio buttons
            currentStepEl.querySelectorAll('input[type="radio"]').forEach(radio => {
                if (radio.id === 'existing_company_no') {
                    radio.checked = true; // Default to "No" for existing_company
                } else {
                    radio.checked = false;
                }
            });

            // Reset checkboxes
            currentStepEl.querySelectorAll('input[type="checkbox"]').forEach(checkbox => {
                checkbox.checked = false;
            });

            // Clear dynamically added company groups in Step 4 (if any)
            if (currentStep === 4) {
                const companyWrapper = document.getElementById('company-wrapper');
                if (companyWrapper) {
                    // Keep only the first company group, reset its fields
                    const companyGroups = companyWrapper.querySelectorAll('.company-group');
                    companyGroups.forEach((group, index) => {
                        if (index > 0) {
                            group.remove(); // Remove additional company groups
                        } else {
                            // Reset fields in the first company group
                            group.querySelectorAll('input').forEach(input => {
                                input.value = '';
                            });
                        }
                    });
                }
                // Hide investment fields if actively investing is unchecked
                const investmentFields = document.getElementById('investment-fields');
                if (investmentFields) {
                    investmentFields.style.display = 'none';
                }
            }

            // Hide company fields in Step 3 if they were shown
            if (currentStep === 3) {
                const companyFields = currentStepEl.querySelector('.company-fields');
                if (companyFields) {
                    companyFields.style.display = 'none';
                }
            }

            // Clear all error messages
            currentStepEl.querySelectorAll('.text-danger').forEach(error => {
                error.textContent = '';
                error.classList.add('d-none');
            });

            // Update form validation state
            isFormValid = false;
            updateCompleteButton();

            // Trigger any necessary UI updates (e.g., hide/show conditional fields)
            if (currentStep === 3) {
                // Trigger change event for existing_company radio to reset visibility
                const existingCompanyRadio = currentStepEl.querySelector('input[name="existing_company"]:checked');
                if (existingCompanyRadio) {
                    existingCompanyRadio.dispatchEvent(new Event('change'));
                }
            }
        }
        $(document).ready(function() {
            $('#preferred_startup_stage').select2({
                placeholder: "Select Stages",
                allowClear: true
            });
        });
        $(document).ready(function() {
            $('#preferred_industries').select2({
                placeholder: "Select Industries",
                allowClear: true
            })
        });
        $(document).ready(function() {
            $('#preferred_geographies').select2({
                placeholder: "Select Geographies",
                allowClear: true
            })
        })
    </script>
    <script>
        function validateEquityPercentage(input) {
            let value = input.value;

            // Remove any non-numeric characters except decimal point
            value = value.replace(/[^0-9.]/g, '');

            // Ensure only one decimal point
            const parts = value.split('.');
            if (parts.length > 2) {
                value = parts[0] + '.' + parts.slice(1).join('');
            }

            // Limit decimal places to 2
            if (parts[1] && parts[1].length > 2) {
                value = parts[0] + '.' + parts[1].substring(0, 2);
            }

            // Convert to number for range check
            const numValue = parseFloat(value);

            // Check range (0-100)
            if (numValue > 100) {
                value = '100.00';
            } else if (numValue < 0) {
                value = '0.00';
            }

            input.value = value;

            // Show/hide error
            const errorDiv = input.nextElementSibling;
            if (errorDiv && errorDiv.classList.contains('equity-error')) {
                if (value === '' || (numValue >= 0 && numValue <= 100)) {
                    errorDiv.classList.add('d-none');
                } else {
                    errorDiv.textContent = 'Please enter a valid percentage (0-100)';
                    errorDiv.classList.remove('d-none');
                }
            }
        }

        // Function to format value on blur (focus out)
        function formatEquityValue(input) {
            let value = input.value;

            if (value !== '') {
                const numValue = parseFloat(value);
                if (!isNaN(numValue)) {
                    // Format to 2 decimal places
                    input.value = numValue.toFixed(2);
                }
            }
        }

        let currentStep = 2; // Starting from step 2 (Personal Information)
        const totalSteps = 4;
        let isFormValid = false; // Track overall form validity

        // Store form data
        let formData = {};

        function showStep(step) {
            // Hide all steps
            document.querySelectorAll('.form-step').forEach(el => {
                el.classList.remove('active');
            });

            // Show current step
            document.querySelector(`.form-step[data-step="${step}"]`).classList.add('active');

            // Update progress bar
            updateProgressBar(step);

            // Update navigation buttons
            updateNavigationButtons(step);
        }

        function updateProgressBar(step) {
            document.querySelectorAll('.step').forEach((el, index) => {
                const stepNumber = index + 1;
                el.classList.remove('completed', 'active', 'pending');

                if (stepNumber < step) {
                    el.classList.add('completed');
                    el.querySelector('.step-number').innerHTML = '<i class="fas fa-check"></i>';
                } else if (stepNumber === step) {
                    el.classList.add('active');
                    el.querySelector('.step-number').textContent = stepNumber;
                } else {
                    el.classList.add('pending');
                    el.querySelector('.step-number').textContent = stepNumber;
                }
            });
        }

        function updateNavigationButtons(step) {
            const prevBtn = document.getElementById('prevBtn');
            const nextBtn = document.getElementById('nextBtn');
            const submitBtn = document.getElementById('submitBtn');

            // Show/hide and style previous button
            if (step > 2) {
                prevBtn.style.display = 'block';
                prevBtn.style.borderRadius = '50px';
            } else {
                prevBtn.style.display = 'none';
                prevBtn.style.borderRadius = '0';
            }

            // Show/hide next and submit buttons
            if (step === totalSteps) {
                nextBtn.style.display = 'none';
                submitBtn.style.display = 'block';
            } else {
                nextBtn.style.display = 'block';
                submitBtn.style.display = 'none';
            }
        }

        document.addEventListener('DOMContentLoaded', function() {
            const existingCompanyRadios = document.querySelectorAll('input[name="existing_company"]');
            const companyFields = document.querySelectorAll('.company-fields');
            const professionalPhone = document.querySelector(
                'input[name="professional_phone"]'); // Separate reference

            // Set initial state - hide fields when "No" is selected (default)
            const initialValue = document.querySelector('input[name="existing_company"]:checked').value;
            companyFields.forEach(field => {
                field.style.display = initialValue === '0' ? 'none' : 'block';
            });

            // Add event listeners for radio button changes
            existingCompanyRadios.forEach(radio => {
                radio.addEventListener('change', function() {
                    if (this.value === '1') {
                        // Show company fields when "Yes" is selected
                        companyFields.forEach(field => {
                            field.style.display = 'block';

                            // Add required attribute back to company fields
                            const requiredFields = field.querySelectorAll(
                                //  'input[name="organization_name"], input[name="company_address"], input[name="company_zipcode"], ' +
                                //'select[name="company_country"], select[name="company_state"], select[name="company_city"], ' +
                                //  'input[name="tax_registration_number"], input[name="business_logo"], ' +
                                //  'select[name="company_country_code"], input[name="investor_profile"], ' +
                                //  'input[name="professional_email"], input[name="website"], select[name="designation"]'
                            );
                            requiredFields.forEach(reqField => {
                                reqField.setAttribute('required', 'required');
                            });
                        });
                    } else {
                        // Hide company fields when "No" is selected
                        companyFields.forEach(field => {
                            field.style.display = 'none';

                            // Remove required attribute from company fields to prevent validation errors
                            const requiredFields = field.querySelectorAll(
                                // 'input[name="organization_name"], input[name="company_address"], input[name="company_zipcode"], ' +
                                //  'select[name="company_country"], select[name="company_state"], select[name="company_city"], ' +
                                //  'input[name="tax_registration_number"], input[name="business_logo"], ' +
                                //  'select[name="company_country_code"], input[name="investor_profile"], ' +
                                //  'input[name="professional_email"], input[name="website"], select[name="designation"]'
                            );
                            requiredFields.forEach(reqField => {
                                reqField.removeAttribute('required');
                                reqField.value = ''; // Clear the value as well
                            });
                        });

                        // Optionally clear professional_phone value if desired, but keep it enabled
                        if (professionalPhone) {
                            professionalPhone.removeAttribute(
                                'required'); // Remove required if it was added elsewhere
                            // Do not clear value unless intended: professionalPhone.value = '';
                        }

                        // Clear error messages when fields are hidden
                        const errorIds = [
                            'organization_name_error',
                            'company_address_error',
                            'company_country_error',
                            'company_state_error',
                            'company_city_error',
                            'website_error',
                            'professional_email_error',
                            'tax_registration_number_error',
                            'business_logo_error',
                            'investor_profile_error',
                            'designation_error'
                        ];

                        errorIds.forEach(id => {
                            const errorElement = document.getElementById(id);
                            if (errorElement) {
                                errorElement.classList.add('d-none');
                            }
                        });
                    }
                });
            });

            // Set initial state for required attributes
            if (initialValue === '0') {
                companyFields.forEach(field => {
                    const requiredFields = field.querySelectorAll(
                        // 'input[name="organization_name"], input[name="company_address"], input[name="company_zipcode"], ' +
                        //  'select[name="company_country"], select[name="company_state"], select[name="company_city"], ' +
                        //  'input[name="tax_registration_number"], input[name="business_logo"], ' +
                        //  'select[name="company_country_code"], input[name="investor_profile"], ' +
                        //  'input[name="professional_email"], input[name="website"], select[name="designation"]'
                    );
                    requiredFields.forEach(reqField => {
                        reqField.removeAttribute('required');
                    });
                });

                if (professionalPhone) {
                    professionalPhone.removeAttribute(
                        'required'); // Ensure it’s not required initially if not company-specific
                }
            }
        });

        document.addEventListener('DOMContentLoaded', function() {
            const countrySelect = document.getElementById('country');
            const stateSelect = document.getElementById('state');
            const citySelect = document.getElementById('city');
            const API_KEY = 'WmtRc2MzTzhLRnltNGNmSjljT3RqakROckhSOFFQSTZqMXBGbVlNUw==';
            const BASE_URL = 'https://api.countrystatecity.in/v1';

            // Get database or old values for pre-selection
            const dbCountry = "{{ old('country', $investo->country ?? '') }}";
            const dbState = "{{ old('state', $investo->state ?? '') }}";
            const dbCity = "{{ old('city', $investo->city ?? '') }}";

            console.log('Database Values:', {
                country: dbCountry,
                state: dbState,
                city: dbCity
            });

            // Store mapping for later use
            let countryMapping = {};
            let stateMapping = {};

            async function fetchCountries() {
                try {
                    const response = await fetch(`${BASE_URL}/countries`, {
                        headers: {
                            'X-CSCAPI-KEY': API_KEY
                        }
                    });
                    if (!response.ok) throw new Error('Failed to fetch countries');
                    const countries = await response.json();
                    console.log('Countries API response:', countries);

                    countrySelect.innerHTML = '<option value="">Select a country</option>';
                    countries.forEach(country => {
                        const option = document.createElement('option');
                        option.value = country.iso2;
                        option.textContent = country.name;
                        countrySelect.appendChild(option);
                        countryMapping[country.iso2] = country.name;
                    });
                } catch (error) {
                    console.error('Error fetching countries:', error);
                    countrySelect.innerHTML = '<option value="">Error loading countries</option>';
                }
            }

            async function populateStates(countryIso2, preselectedState = null, preselectedCity = null) {
                console.log('Populating states for country:', countryIso2);
                stateSelect.innerHTML = '<option value="">Select State</option>';
                citySelect.innerHTML = '<option value="">Select City</option>';

                if (!countryIso2) {
                    console.warn('No country selected');
                    return;
                }

                try {
                    const response = await fetch(`${BASE_URL}/countries/${countryIso2}/states`, {
                        headers: {
                            'X-CSCAPI-KEY': API_KEY
                        }
                    });
                    if (!response.ok) throw new Error('Failed to fetch states');
                    const states = await response.json();
                    console.log('States found:', states);

                    states.sort((a, b) => a.name.localeCompare(b.name, 'en', {
                        sensitivity: 'base'
                    }));
                    states.forEach(state => {
                        const option = document.createElement('option');
                        option.value = state.iso2;
                        option.textContent = state.name;
                        stateSelect.appendChild(option);
                        stateMapping[state.iso2] = state.name;
                    });

                    if (preselectedState) {
                        console.log('Pre-selecting state:', preselectedState);
                        stateSelect.value = preselectedState;
                        if (stateSelect.value === preselectedState) {
                            console.log('State pre-selected successfully:', preselectedState);
                            await populateCities(countryIso2, preselectedState, preselectedCity);
                        } else {
                            console.warn('State not found in dropdown:', preselectedState);
                            // Fallback: Try to find the state by name
                            const stateOption = Array.from(stateSelect.options).find(
                                option => option.textContent === preselectedState
                            );
                            if (stateOption) {
                                stateSelect.value = stateOption.value;
                                console.log('Fallback: State set to:', stateOption.value);
                                await populateCities(countryIso2, stateOption.value, preselectedCity);
                            }
                        }
                    }
                } catch (error) {
                    console.error('Error fetching states:', error);
                    stateSelect.innerHTML = '<option value="">No states available</option>';
                }
            }

            async function populateCities(countryIso2, stateIso2, preselectedCity = null) {
                console.log('Populating cities for state:', stateIso2);
                citySelect.innerHTML = '<option value="">Select City</option>';

                if (!countryIso2 || !stateIso2) {
                    console.warn('No country or state selected');
                    return;
                }

                try {
                    const response = await fetch(
                        `${BASE_URL}/countries/${countryIso2}/states/${stateIso2}/cities`, {
                            headers: {
                                'X-CSCAPI-KEY': API_KEY
                            }
                        });
                    if (!response.ok) throw new Error('Failed to fetch cities');
                    const cities = await response.json();
                    console.log('Cities found:', cities);

                    cities.forEach(city => {
                        const option = document.createElement('option');
                        option.value = city.name;
                        option.textContent = city.name;
                        citySelect.appendChild(option);
                    });

                    if (preselectedCity) {
                        console.log('Pre-selecting city:', preselectedCity);
                        citySelect.value = preselectedCity;
                        if (citySelect.value === preselectedCity) {
                            console.log('City pre-selected successfully:', preselectedCity);
                        } else {
                            console.warn('City not found in dropdown:', preselectedCity);
                        }
                    }
                } catch (error) {
                    console.error('Error fetching cities:', error);
                    citySelect.innerHTML = '<option value="">No cities available</option>';
                }
            }

            // Event Listeners
            countrySelect?.addEventListener('change', () => {
                const countryIso2 = countrySelect.value;
                console.log('Country changed to:', countryIso2);
                populateStates(countryIso2);
                stateSelect.value = '';
                citySelect.value = '';

                const countryError = document.getElementById('country_error');
                if (countryIso2 && countryError) countryError.classList.add('d-none');
            });

            stateSelect?.addEventListener('change', () => {
                const countryIso2 = countrySelect.value;
                const stateIso2 = stateSelect.value;
                console.log('State changed to:', stateIso2);
                populateCities(countryIso2, stateIso2);
                citySelect.value = '';
            });

            // Initialize form
            async function initializeForm() {
                if (countrySelect) {
                    await fetchCountries();
                    if (dbCountry) {
                        console.log('Pre-selecting country:', dbCountry);
                        countrySelect.value = dbCountry;
                        if (countrySelect.value === dbCountry) {
                            console.log('Country pre-selected successfully:', dbCountry);
                            await populateStates(dbCountry, dbState, dbCity);
                        } else {
                            console.warn('Country not found in dropdown:', dbCountry);
                            // Fallback: Try to find the country by name
                            const countryOption = Array.from(countrySelect.options).find(
                                option => option.textContent === dbCountry
                            );
                            if (countryOption) {
                                countrySelect.value = countryOption.value;
                                console.log('Fallback: Country set to:', countryOption.value);
                                await populateStates(countryOption.value, dbState, dbCity);
                            }
                        }
                    }
                }
            }

            initializeForm();
        });

        // On page load, populate countries and states if country is preselected
        document.addEventListener('DOMContentLoaded', () => {
            if (countrySelect) {
                fetchCountries();
                if (countrySelect.value && countrySelect.value !== '') {
                    populateStates(countrySelect.value.trim());
                }
            }
        });
        // dob age
        document.addEventListener('DOMContentLoaded', function() {

            const dobInput = document.getElementById('dob');
            const ageInput = document.getElementById('age');
            const dobError = document.getElementById('dob_error');

            // Initialize Flatpickr
            flatpickr("#dob", {
                dateFormat: "d/m/Y",
                maxDate: "today",
                yearSelectorRange: 100,
                disableMobile: "true",
                clickOpens: true,
                allowInput: false,
                onChange: function(selectedDates, dateStr, instance) {
                    // selectedDates[0] is already a Date object
                    if (selectedDates.length > 0) {
                        const dob = selectedDates[0];
                        const today = new Date();
                        let age = today.getFullYear() - dob.getFullYear();
                        const m = today.getMonth() - dob.getMonth();
                        if (m < 0 || (m === 0 && today.getDate() < dob.getDate())) {
                            age--;
                        }

                        if (isNaN(age) || age < 18) {
                            dobError.textContent = 'You must be at least 18 years old.';
                            dobError.classList.remove('d-none');
                            dobInput.value = ''; // Clear invalid value
                            ageInput.value = '';
                        } else {
                            dobError.classList.add('d-none');
                            ageInput.value = age;
                        }
                    }
                },
            });

            const businessYearSelect = document.getElementById('business_year');
            const businessYearCountInput = document.getElementById('business_year_count');

            if (dobInput) {
                // Prevent manual input
                dobInput.addEventListener('keydown', function(e) {
                    e.preventDefault();
                });
            }

            // Validation function for step 2
            if (typeof validateStep2 === 'undefined') {
                window.validateStep2 = function() {
                    const dobVal = dobInput.value;
                    if (!dobVal) {
                        dobError.textContent = 'Date of Birth is Required';
                        dobError.classList.remove('d-none');
                        return false;
                    }

                    // Parse DD/MM/YYYY to a Date object
                    const parts = dobVal.split('/');
                    const dob = new Date(
                        `${parts[2]}-${parts[1].padStart(2, '0')}-${parts[0].padStart(2, '0')}`);
                    const today = new Date();
                    let age = today.getFullYear() - dob.getFullYear();
                    const m = today.getMonth() - dob.getMonth();
                    if (m < 0 || (m === 0 && today.getDate() < dob.getDate())) {
                        age--;
                    }

                    if (isNaN(age) || age < 18) {
                        dobError.textContent = 'You must be at least 18 years old.';
                        dobError.classList.remove('d-none');
                        return false;
                    }

                    dobError.classList.add('d-none');
                    return true;
                };
            }

            function updateYearsInBusiness() {
                const selectedYear = parseInt(businessYearSelect.value);
                const currentYear = new Date().getFullYear();
                if (!isNaN(selectedYear)) {
                    const yearsInBusiness = currentYear - selectedYear;
                    businessYearCountInput.value = yearsInBusiness >= 0 ? yearsInBusiness :
                        0; // Ensure non-negative
                } else {
                    businessYearCountInput.value = ''; // Clear if no year is selected
                }
            }
            // Event listener for the business year dropdown
            if (businessYearSelect) {
                businessYearSelect.addEventListener('change', updateYearsInBusiness);
            }

            //const fundingCurrencyLabel = document.querySelectorAll('.funding_currency_label');
            //  const countryInput = document.getElementById('business_country');

            // function updateFundingCurrencyLabel() {
            //  const selectedCountry = (countryInput?.value || '').trim().toLowerCase();
            //         let label = '';

            //    if (selectedCountry === 'in') {
            //        label = '(INR)';
            //   } else if (selectedCountry !== '') {
            //         label = '(USD)';
            //       }
            // fundingCurrencyLabel.forEach(el => {
            //  el.textContent = label;
            // });
            // }

            // updateFundingCurrencyLabel();

            // countryInput?.addEventListener('input', updateFundingCurrencyLabel);
        });
        //

        function validateStep(step) {
            let isValid = true;
            const currentStepEl = document.querySelector(`.form-step[data-step="${step}"]`);

            // Clear previous errors
            currentStepEl.querySelectorAll('.text-danger').forEach(el => el.classList.add('d-none'));

            if (step === 2) {
                // Validate Personal Information
                const fullName = currentStepEl.querySelector('input[name="full_name"]');
                const phoneNumber = currentStepEl.querySelector('input[name="phone_number"]');
                const countryCode = currentStepEl.querySelector('select[name="country_code"]');
                const country = currentStepEl.querySelector('select[name="country"]');
                const linkedinProfile = currentStepEl.querySelector('input[name="linkedin_profile"]');
                const countryError = document.getElementById('country_error');

                const qualification = currentStepEl.querySelector('select[name="qualification"]');
                const dob = currentStepEl.querySelector('input[name="dob"]');
                const age = currentStepEl.querySelector('input[name="age"]');
                const current_address = currentStepEl.querySelector('input[name="current_address"]');
                const pin_code = currentStepEl.querySelector('input[name="pin_code"]');
                const state = currentStepEl.querySelector('select[name="state"]');
                const city = currentStepEl.querySelector('select[name="city"]');
                const photo = currentStepEl.querySelector('input[name="photo"]');
                document.getElementById('photo_error').classList.add('d-none');

                const pinCodeError = document.getElementById('pin_code_error');

                const errorElement = document.createElement('div');
                errorElement.className = 'text-danger mt-1 d-none';
                errorElement.id = 'linkedin_profile_error';
                linkedinProfile.parentNode.appendChild(errorElement);

                const phoneLengthMap = {
                    '+91': 10, // India
                    '+1': 10, // USA
                    '+44': 10, // UK
                    '+971': 9, // UAE
                    '+65': 8, // Singapore
                    '+61': 9, // Australia
                    '+81': 10, // Japan
                    '+86': 11, // China
                    '+49': 11, // Germany
                    '+33': 9, // France
                    '+39': 10, // Italy
                    '+7': 10, // Russia
                    '+34': 9, // Spain
                    '+82': 10, // South Korea
                    '+66': 9, // Thailand
                    '+92': 10, // Pakistan
                    '+880': 10, // Bangladesh
                    '+94': 9, // Sri Lanka
                    '+60': 9, // Malaysia
                    '+62': 10, // Indonesia
                    '+63': 10, // Philippines
                    '+20': 10, // Egypt
                    '+234': 10, // Nigeria
                    '+27': 9, // South Africa
                    '+974': 8 // Qatar
                };

                if (!fullName?.value.trim()) {
                    document.getElementById('full_name_error').textContent = 'Full name is required';
                    document.getElementById('full_name_error').classList.remove('d-none');
                    isValid = false;
                }

                // Required: phone_number
                if (!phoneNumber?.value.trim()) {
                    document.getElementById('phone_number_error').textContent = 'Phone number is required';
                    document.getElementById('phone_number_error').classList.remove('d-none');
                    isValid = false;
                } else {
                    const phone = phoneNumber.value.trim();
                    const expectedLength = phoneLengthMap[countryCode?.value] || 10;
                    const phonePattern = new RegExp(`^\\d{${expectedLength}}$`);
                    if (!phonePattern.test(phone)) {
                        document.getElementById('phone_number_error').textContent =
                            `Phone number must be exactly ${expectedLength} digits for ${countryCode?.value || 'selected country'}`;
                        document.getElementById('phone_number_error').classList.remove('d-none');
                        isValid = false;
                    } else {
                        document.getElementById('phone_number_error')?.classList.add('d-none');
                    }
                }

                // Required: country
                const countryValue = country?.value.trim() || '';
                if (!countryValue) {
                    if (countryError) {
                        countryError.textContent = 'Country is required';
                        countryError.classList.remove('d-none');
                    }
                    isValid = false;
                } else {
                    if (countryError) {
                        countryError.classList.add('d-none');
                    }
                }

                // Required: state
                if (!state?.value) {
                    document.getElementById('state_error').textContent = 'State is required';
                    document.getElementById('state_error').classList.remove('d-none');
                    isValid = false;
                } else {
                    document.getElementById('state_error')?.classList.add('d-none');
                }

                // Required: city
                if (!city?.value) {
                    document.getElementById('city_error').textContent = 'City is required';
                    document.getElementById('city_error').classList.remove('d-none');
                    isValid = false;
                } else {
                    document.getElementById('city_error')?.classList.add('d-none');
                }

                // Required: pin_code
                if (!pin_code || !pin_code.value.trim()) {
                    document.getElementById('pin_code_error').textContent = 'Pin/Zip code is required';
                    document.getElementById('pin_code_error').classList.remove('d-none');
                    isValid = false;
                } else if (!/^\d{5,6}$/.test(pin_code.value.trim())) { // Basic validation for 5-6 digit zip code
                    document.getElementById('pin_code_error').textContent = 'Enter a valid 5-6 digit pin/zip code';
                    document.getElementById('pin_code_error').classList.remove('d-none');
                    isValid = false;
                }

                // Optional: linkedin_profile
                if (linkedinProfile && linkedinProfile.value.trim()) {
                    const urlValue = linkedinProfile.value.trim();
                    let url;
                    try {
                        url = new URL(urlValue.startsWith('http://') || urlValue.startsWith('https://') ? urlValue :
                            `https://${urlValue}`);
                        if (!url.hostname.endsWith('.com')) {
                            errorElement.textContent =
                                'Please provide a valid Socialmedia URL ending with .com (e.g., https://linkedin.com/in/your-profile)';
                            errorElement.classList.remove('d-none');
                            isValid = false;
                        } else {
                            errorElement.classList.add('d-none');
                        }
                    } catch {
                        errorElement.textContent =
                            'Please provide a valid LinkedIn URL ending with .com (e.g., https://linkedin.com/in/your-profile)';
                        errorElement.classList.remove('d-none');
                        isValid = false;
                    }
                } else {
                    errorElement.classList.add('d-none');
                }

                // Optional: country_code (but validate if phone_number is provided)
                if (phoneNumber?.value.trim() && !countryCode?.value.trim()) {
                    document.getElementById('country_code_error').textContent =
                        'Country code is required when phone number is provided';
                    document.getElementById('country_code_error').classList.remove('d-none');
                    isValid = false;
                } else {
                    document.getElementById('country_code_error')?.classList.add('d-none');
                }

                // Optional: photo
                if (photo && photo.files.length > 0) {
                    const file = photo.files[0];
                    const validImage = ['image/jpeg', 'image/png', 'image/jpg'].includes(file.type);
                    if (!validImage) {
                        document.getElementById('photo_error').textContent = 'Only JPG, JPEG, or PNG files allowed.';
                        document.getElementById('photo_error').classList.remove('d-none');
                        isValid = false;
                    } else {
                        document.getElementById('photo_error')?.classList.add('d-none');
                    }
                } else {
                    document.getElementById('photo_error')?.classList.add('d-none');
                }

                // Optional: current_address, qualification, dob, age
                // No required validation, just clear any previous errors
                ['current_address_error', 'qualification_error', 'dob_error', 'age_error'].forEach(id => {
                    const errorEl = document.getElementById(id);
                    if (errorEl) {
                        errorEl.classList.add('d-none');
                    }
                });


            } else if (step === 3) {
                // Validate Professional Information
                const organizationName = currentStepEl.querySelector('input[name="organization_name"]');
                const designation = currentStepEl.querySelector('select[name="designation"]');
                const website = currentStepEl.querySelector('input[name="website"]');
                const professionalEmail = currentStepEl.querySelector('input[name="professional_email"]');
                const professionalPhone = currentStepEl.querySelector('input[name="professional_phone"]');
                const investmentExperience = currentStepEl.querySelector('select[name="investment_experince"]');

                const investorType = currentStepEl.querySelector('select[name="investor_type"]');
                const investmentRange = currentStepEl.querySelector('select[name="investment_range"]');
                //const startupStage = currentStepEl.querySelector('input[name="preferred_startup_stage[]"]:checked');
                const startupStages = currentStepEl.querySelector('select[name="preferred_startup_stage[]"]');
                const companyAddress = currentStepEl.querySelector('input[name="company_address"]');

                const companyCountry = currentStepEl.querySelector('select[name="company_country"]');
                const companyCountryError = document.getElementById('company_country_error');

                const companyState = currentStepEl.querySelector('select[name="company_state"]');
                const companyCity = currentStepEl.querySelector('select[name="company_city"]');
                const zipcode = currentStepEl.querySelector('input[name="company_zipcode"]');
                const taxRegistrationNumber = currentStepEl.querySelector('input[name="tax_registration_number"]');
                const businessLogo = currentStepEl.querySelector('input[name="business_logo"]');

                const companyCountryCode = currentStepEl.querySelector('select[name="company_country_code"]');
                const investorProfile = currentStepEl.querySelector('input[name="investor_profile"]');


                const allErrorIds = [
                    'organization_name_error', 'company_address_error', 'company_country_error',
                    'company_state_error', 'company_city_error', 'company_zipcode_error',
                    'business_logo_error', 'tax_registration_number_error', 'company_country_code_error',
                    'professional_phone_error', 'website_error', 'designation_error',
                    'investor_type_error', 'investment_range_error', 'preferred_startup_stage_error',
                    'investor_profile_error',
                    'professional_email_error', 'investment_experince_error'
                ];

                allErrorIds.forEach(id => {
                    const errorElement = document.getElementById(id);
                    if (errorElement) {
                        errorElement.classList.add('d-none');
                    }
                });


                //let isValid = true;

                // Validate existing_company
                const existingCompany = currentStepEl.querySelector('input[name="existing_company"]:checked');
                if (!existingCompany) {
                    isValid = false; // Handle if no radio is selected (optional)
                }

                const websiteErrorElement = document.createElement('div');
                websiteErrorElement.className = 'text-danger mt-1 d-none';
                websiteErrorElement.id = 'website_error';
                website.parentNode.appendChild(websiteErrorElement);

                const phoneLengthMapbusiness = {
                    '+91': 10, // India
                    '+1': 10, // USA
                    '+44': 10, // UK
                    '+971': 9, // UAE
                    '+65': 8, // Singapore
                    '+61': 9, // Australia
                    '+81': 10, // Japan
                    '+86': 11, // China
                    '+49': 11, // Germany
                    '+33': 9, // France
                    '+39': 10, // Italy
                    '+7': 10, // Russia
                    '+34': 9, // Spain
                    '+82': 10, // South Korea
                    '+66': 9, // Thailand
                    '+92': 10, // Pakistan
                    '+880': 10, // Bangladesh
                    '+94': 9, // Sri Lanka
                    '+60': 9, // Malaysia
                    '+62': 10, // Indonesia
                    '+63': 10, // Philippines
                    '+20': 10, // Egypt
                    '+234': 10, // Nigeria
                    '+27': 9, // South Africa
                    '+974': 8 // Qatar
                };

                if (existingCompany && existingCompany.value === '1') {

                    const companyCountryValue = companyCountry && companyCountry.value ? companyCountry.value.trim() : '';
                    const zipcodeValue = zipcode.value.trim();

                    if (zipcodeValue !== '') {
                        if (!/^\d{5,6}$/.test(zipcodeValue)) {
                            document.getElementById('company_zipcode_error').textContent =
                                'Enter a valid 5-6 digit pin/zip code';
                            document.getElementById('company_zipcode_error').classList.remove('d-none');
                            isValid = false;
                        } else {
                            document.getElementById('company_zipcode_error').classList.add('d-none');
                        }
                    } else {
                        // Optional and empty — clear any previous error
                        document.getElementById('company_zipcode_error').classList.add('d-none');
                    }

                    if (website && website.value.trim()) {
                        const urlValue = website.value.trim();
                        let url;

                        try {
                            url = new URL(urlValue.startsWith('http://') || urlValue.startsWith('https://') ? urlValue :
                                `https://${urlValue}`);

                            // Check if the URL ends with .com
                            if (!url.hostname.endsWith('.com')) {
                                websiteErrorElement.textContent =
                                    'Please provide a valid website URL ending with .com (e.g., https://example.com)';
                                websiteErrorElement.classList.remove('d-none');
                                isValid = false;
                            } else {
                                websiteErrorElement.classList.add('d-none');
                                // Normalize to https:// and update the input value
                                website.value = `https://${url.hostname}`;
                            }
                        } catch {
                            websiteErrorElement.textContent =
                                'Please provide a valid website URL ending with .com (e.g., https://example.com)';
                            websiteErrorElement.classList.remove('d-none');
                            isValid = false;
                        }
                    } else {
                        websiteErrorElement.classList.add('d-none'); // Hide error if empty
                    }


                    if (businessLogo && businessLogo.files.length > 0) {
                        const file = businessLogo.files[0];
                        const validImage = ['image/jpeg', 'image/png', 'image/jpg'].includes(file.type);
                        if (!validImage) {
                            document.getElementById('business_logo_error').textContent =
                                'Only JPG, JPEG, or PNG files allowed.';
                            document.getElementById('business_logo_error').classList.remove('d-none');
                            isValid = false;
                        } else {
                            document.getElementById('business_logo_error')?.classList.add('d-none');
                        }
                    } else {
                        document.getElementById('business_logo_error')?.classList.add('d-none');
                    }


                    if (investorProfile.files.length > 0) {
                        const file = investorProfile.files[0];
                        const validMime = file.type === "application/pdf";
                        const validExtension = file.name.toLowerCase().endsWith(".pdf");

                        if (!validMime || !validExtension) {
                            document.getElementById('investor_profile_error').textContent =
                                'Only PDF files are allowed.';
                            document.getElementById('investor_profile_error').classList.remove('d-none');
                            isValid = false;
                        } else if (file.size > 10 * 1024 * 1024) { // 10MB size check
                            document.getElementById('investor_profile_error').textContent =
                                'File size must be less than 10MB.';
                            document.getElementById('investor_profile_error').classList.remove('d-none');
                            isValid = false;
                        }
                    }
                }
                const mobile = professionalPhone.value.trim();

                if (mobile !== '') {
                    const expectedLengthMobile = phoneLengthMapbusiness[companyCountryCode.value] || 10;
                    const mobilePattern = new RegExp(`^\\d{${expectedLengthMobile}}$`);

                    if (!mobilePattern.test(mobile)) {
                        document.getElementById('professional_phone_error').textContent =
                            `Phone number must be exactly ${expectedLengthMobile} digits for ${companyCountryCode.value}`;
                        document.getElementById('professional_phone_error').classList.remove('d-none');
                        isValid = false;
                    } else {
                        document.getElementById('professional_phone_error').classList.add('d-none');
                    }
                } else {
                    // Field is optional and empty — clear any previous error
                    document.getElementById('professional_phone_error').classList.add('d-none');
                }

                if (startupStages) {
                    const selectedValues = Array.from(startupStages.selectedOptions).map(opt => opt.value);

                    // Optional: If you want to log the selected values
                    console.log('Selected startup stages:', selectedValues);

                    // Clear previous error if any
                    const errorPreferredStartup = document.getElementById('preferred_startup_stage_error');
                    if (errorPreferredStartup) {
                        errorPreferredStartup.classList.add('d-none');
                    }
                }
            } else if (step === 4) {
                // Validate Investment Preferences
                const preferredIndustries = currentStepEl.querySelector('select[name="preferred_industries[]"]');
                const preferredGeographies = currentStepEl.querySelector('select[name="preferred_geographies[]"]');
                const errorIndustries = document.getElementById('preferred_industries_error');
                const errorGeographies = document.getElementById('preferred_geographies_error');

                // Initialize error elements if not present
                if (!errorIndustries) {
                    const newErrorIndustries = document.createElement('div');
                    newErrorIndustries.id = 'preferred_industries_error';
                    newErrorIndustries.className = 'text-danger mt-1 d-none';
                    preferredIndustries.parentNode.appendChild(newErrorIndustries);
                }
                if (!errorGeographies) {
                    const newErrorGeographies = document.createElement('div');
                    newErrorGeographies.id = 'preferred_geographies_error';
                    newErrorGeographies.className = 'text-danger mt-1 d-none';
                    preferredGeographies.parentNode.appendChild(newErrorGeographies);
                }

                // Validate with Select2 (assuming Select2 is initialized)


                // If actively investing checkbox is checked, validate company details
                const activelyInvesting = document.getElementById('actively_investing');
                if (activelyInvesting && activelyInvesting.checked) {
                    const companyGroups = document.querySelectorAll('.company-group');
                    let companyValid = true;

                    companyGroups.forEach((group, index) => {
                        const companyName = group.querySelector('input[name="company_name[]"]');
                        const marketCapital = group.querySelector('input[name="market_capital[]"]');
                        const yourStake = group.querySelector('input[name="your_stake[]"]');
                        const marketCapitalError = group.querySelector(`#market_capital_error_${index}`) ||
                            createErrorElement(`market_capital_error_${index}`, marketCapital);

                        // Add event listener for formatting and updating stake_funding
                        marketCapital.addEventListener('input', function() {
                            const rawValue = this.value.replace(/,/g, ''); // Remove commas for validation
                            if (rawValue && !isNaN(rawValue)) {
                                this.value = formatIndianNumber(rawValue);
                                updateStakeFunding(group);
                            }
                        });

                        yourStake.addEventListener('input', function() {
                            updateStakeFunding(group);
                        });

                        // Validate each field
                        if (!companyName.value.trim()) {
                            companyValid = false;
                            // Add error handling for company name if needed
                        }
                        if (!marketCapital.value.trim()) {
                            marketCapitalError.textContent = 'Market Capital is required';
                            marketCapitalError.classList.remove('d-none');
                            companyValid = false;
                        } else {
                            marketCapitalError.classList.add('d-none');
                        }
                        if (!yourStake.value.trim()) {
                            companyValid = false;
                            // Add error handling for your stake if needed
                        }
                    });

                    if (!companyValid) {
                        isValid = false;
                    }
                }
                isFormValid = isValid;
                //updateCompleteButton();
                return isValid;
            }
            return isValid;
        }


        function collectStepData(step) {
            const currentStepEl = document.querySelector(`.form-step[data-step="${step}"]`);
            const formDataStep = {};

            if (step === 2) {
                formDataStep.full_name = currentStepEl.querySelector('input[name="full_name"]')?.value || '';
                formDataStep.email = currentStepEl.querySelector('input[name="email"]')?.value || '';
                formDataStep.phone_number = currentStepEl.querySelector('input[name="phone_number"]')?.value || '';
                formDataStep.country_code = currentStepEl.querySelector('select[name="country_code"]')?.value || '';
                formDataStep.country = currentStepEl.querySelector('select[name="country"]')?.value || '';
                formDataStep.state = currentStepEl.querySelector('select[name="state"]')?.value || '';
                formDataStep.city = currentStepEl.querySelector('select[name="city"]')?.value || '';
                formDataStep.current_address = currentStepEl.querySelector('input[name="current_address"]')?.value || '';
                formDataStep.pin_code = currentStepEl.querySelector('input[name="pin_code"]')?.value || '';
                formDataStep.linkedin_profile = currentStepEl.querySelector('input[name="linkedin_profile"]')?.value || '';
                formDataStep.dob = currentStepEl.querySelector('input[name="dob"]')?.value || '';
                formDataStep.age = currentStepEl.querySelector('input[name="age"]')?.value || '';
                formDataStep.qualification = currentStepEl.querySelector('select[name="qualification"]')?.value || '';
                formDataStep.photo = currentStepEl.querySelector('input[name="photo"]')?.files[0] || null;
            } else if (step === 3) {
                const existingCompany = currentStepEl.querySelector('input[name="existing_company"]:checked')?.value;
                formDataStep.existing_company = existingCompany || '0';

                if (existingCompany === '1') {
                    formDataStep.organization_name = currentStepEl.querySelector('input[name="organization_name"]')
                        ?.value || '';
                    formDataStep.company_address = currentStepEl.querySelector('input[name="company_address"]')?.value ||
                        '';
                    formDataStep.company_country = currentStepEl.querySelector('select[name="company_country"]')?.value ||
                        '';
                    formDataStep.company_state = currentStepEl.querySelector('select[name="company_state"]')?.value || '';
                    formDataStep.company_city = currentStepEl.querySelector('select[name="company_city"]')?.value || '';
                    formDataStep.company_zipcode = currentStepEl.querySelector('input[name="company_zipcode"]')?.value ||
                        '';
                    formDataStep.professional_email = currentStepEl.querySelector('input[name="professional_email"]')
                        ?.value || '';
                    formDataStep.website = currentStepEl.querySelector('input[name="website"]')?.value || '';
                    formDataStep.tax_registration_number = currentStepEl.querySelector(
                        'input[name="tax_registration_number"]')?.value || '';
                    formDataStep.designation = currentStepEl.querySelector('select[name="designation"]')?.value || '';
                    formDataStep.professional_phone = currentStepEl.querySelector('input[name="professional_phone"]')
                        ?.value || '';
                    formDataStep.company_country_code = currentStepEl.querySelector('select[name="company_country_code"]')
                        ?.value || '';
                    formDataStep.business_logo = currentStepEl.querySelector('input[name="business_logo"]')?.files[0] ||
                        null;
                    formDataStep.investor_profile = currentStepEl.querySelector('input[name="investor_profile"]')?.files[
                        0] || null;
                }

                formDataStep.investment_experince = currentStepEl.querySelector('select[name="investment_experince"]')
                    ?.value || '';
                formDataStep.investor_type = currentStepEl.querySelector('select[name="investor_type"]')?.value || '';
                formDataStep.investment_range = currentStepEl.querySelector('select[name="investment_range"]')?.value || '';
                formDataStep.preferred_startup_stage = Array.from(currentStepEl.querySelector(
                    'select[name="preferred_startup_stage[]"]')?.selectedOptions || []).map(option => option.value);
            } else if (step === 4) {
                formDataStep.preferred_industries = Array.from(currentStepEl.querySelector(
                    'select[name="preferred_industries[]"]')?.selectedOptions || []).map(option => option.value);
                formDataStep.preferred_geographies = Array.from(currentStepEl.querySelector(
                    'select[name="preferred_geographies[]"]')?.selectedOptions || []).map(option => option.value);

            }

            formData[`step${step}`] = formDataStep;
            return formDataStep;
        }

        document.getElementById('nextBtn').addEventListener('click', async function() {

            console.log("=== Next Button Clicked ===");
            console.log("Current step:", currentStep);

            if (currentStep > 1) {
                const stepToSave = currentStep - 1;
                console.log("First saving data for previous step:", stepToSave);

                const stepData = collectStepData(stepToSave);
                console.log("Collected step data for step", stepToSave, ":", stepData);

                try {
                    const formDataToSend = new FormData();
                    const userIdInput = document.querySelector('input[name="user_id"]');
                    const userId = userIdInput ? userIdInput.value : null;

                    if (!userId) {
                        throw new Error('User ID is missing');
                    }

                    formDataToSend.append('user_id', userId);
                    formDataToSend.append('step', stepToSave);

                    Object.keys(stepData).forEach(key => {
                        if (stepData[key] instanceof File) {
                            formDataToSend.append(key, stepData[key]);
                        } else if (Array.isArray(stepData[key])) {
                            stepData[key].forEach((item, index) => {
                                formDataToSend.append(`${key}[${index}]`, item);
                            });
                        } else {
                            formDataToSend.append(key, stepData[key]);
                        }
                    });

                    console.log('Sending FormData for Step', stepToSave);
                    for (let pair of formDataToSend.entries()) {
                        console.log(`${pair[0]}: ${pair[1]}`);
                    }

                    let csrfToken;
                    const csrfTokenElement = document.querySelector('meta[name="csrf-token"]');
                    if (csrfTokenElement) {
                        csrfToken = csrfTokenElement.content;
                    } else {
                        const tokenInput = document.querySelector('input[name="_token"]');
                        if (tokenInput) {
                            csrfToken = tokenInput.value;
                        } else {
                            throw new Error('CSRF token not found in meta tag or form');
                        }
                    }

                    if (!csrfToken) {
                        throw new Error('CSRF token is empty');
                    }

                    const response = await fetch('{{ route('investor-save-step-data') }}', {
                        method: 'POST',
                        body: formDataToSend,
                        headers: {
                            'X-CSRF-TOKEN': csrfToken
                        }
                    });

                    const responseText = await response.text();
                    console.log('Raw Server Response:', responseText);
                    const responseData = response.ok ? JSON.parse(responseText) : {
                        message: responseText
                    };

                    console.log('Parsed Server Response:', responseData);

                    if (!response.ok) {
                        throw new Error(responseData.message || 'Failed to save step data');
                    }

                    formData[`step${stepToSave}`] = stepData;
                    console.log('Previous step data saved successfully:', formData);

                } catch (error) {
                    console.error('Error saving previous step data:', error);
                    //alert('Failed to save previous step data: ' + error.message);

                }
            }

            const stepToValidate = currentStep;
            console.log("Now validating current step:", stepToValidate);

            const isValidStep = validateStep(stepToValidate);
            console.log("Step validation result:", isValidStep);

            if (isValidStep) {
                console.log("Current step validation passed, moving to next step");

                if (currentStep < totalSteps) {
                    currentStep++;
                    showStep(currentStep);
                    console.log('Moved to step:', currentStep);
                }
            } else {
                console.log("Current step validation failed, staying on current step");
                const firstError = document.querySelector('.text-danger:not(.d-none)');
                if (firstError) {
                    firstError.scrollIntoView({
                        behavior: 'smooth',
                        block: 'center'
                    });
                }
            }

        });

        document.addEventListener('DOMContentLoaded', async function() { // Changed to async
            console.log("=== Loading Saved Step Data ===");
            try {
                const csrfToken = document.querySelector('meta[name="csrf-token"]')?.content || document
                    .querySelector('input[name="_token"]')?.value;
                if (!csrfToken) {
                    console.error('CSRF token not found');
                    showStep(2);
                    return;
                }

                const response = await fetch('{{ route('investor-get-step-data') }}', {
                    method: 'GET',
                    headers: {
                        'X-CSRF-TOKEN': csrfToken
                    }
                });

                const responseData = await response.json();
                console.log('Retrieved Step Data:', responseData);

                // If response is successful and data exists, populate the form
                if (response.ok && responseData.data) {
                    formData = responseData;
                    currentStep = determineCurrentStep();
                    showStep(currentStep);
                    populateFormFields(currentStep);

                    // Ensure investment-fields visibility for step 4
                    if (currentStep === 4 && responseData.data.step4 && responseData.data.step4
                        .actively_investing === '1') {
                        const checkbox = document.getElementById('actively_investing');
                        const investmentFields = document.getElementById('investment-fields');
                        if (checkbox && investmentFields) {
                            checkbox.checked = true;
                            investmentFields.style.display = 'block';
                        }
                    }
                } else {
                    console.log('No saved data found, starting from step 2');
                    showStep(2);
                }
            } catch (error) {
                console.error('Error loading step data:', error);
                showStep(2);
            }

            // Existing DOMContentLoaded logic for other elements
            const equityInputs = document.querySelectorAll('input[name="your_stake[]"]');
            const checkbox = document.getElementById('actively_investing');
            const investmentFields = document.getElementById('investment-fields');
            const wrapper = document.getElementById('company-wrapper');
            const addBtn = document.getElementById('add-more-company');

            const currencyLabel = document.getElementById('currency_label');
            const countryInput = document.getElementById('country');

            addSelectAllButton('.col-md-6:first-of-type .border', 'preferred_industries[]',
                'Select All Industries');
            addSelectAllButton('.col-md-6:last-of-type .border', 'preferred_geographies[]',
                'Select All Geographies');

            equityInputs.forEach(input => {
                input.addEventListener('keypress', function(e) {
                    const char = String.fromCharCode(e.which);
                    if (!/[0-9.]/.test(char) && [8, 9, 27, 13, 46, 37, 38, 39, 40].indexOf(e
                            .keyCode) === -1) {
                        e.preventDefault();
                    }
                    if (char === '.' && this.value.indexOf('.') !== -1) {
                        e.preventDefault();
                    }
                });

                input.addEventListener('paste', function(e) {
                    setTimeout(() => {
                        validateEquityPercentage(this);
                    }, 0);
                });
            });

            function updateCurrencyLabel() {
                const selectedCountry = (countryInput?.value || '').trim().toLowerCase();
                let label = '';
                if (selectedCountry === 'in') {
                    label = '(₹)';
                } else if (selectedCountry !== '') {
                    label = '($)';
                }
                if (currencyLabel) {
                    currencyLabel.textContent = label;
                }
            }

            updateCurrencyLabel();
            countryInput?.addEventListener('input', updateCurrencyLabel);

            function toggleInvestmentFields() {
                if (checkbox && investmentFields) {
                    console.log('Toggling investment fields, checkbox checked:', checkbox.checked);
                    investmentFields.style.display = checkbox.checked ? 'block' : 'none';
                }
            }

            checkbox?.addEventListener('change', toggleInvestmentFields);
            toggleInvestmentFields();

            function calculateValuation(group) {
                const investment = parseFloat(group.querySelector('.investment').value);
                const equity = parseFloat(group.querySelector('.equity').value);
                const valuationField = group.querySelector('.valuation');

                if (!isNaN(investment) && !isNaN(equity) && equity > 0) {
                    valuationField.value = ((investment / equity) * 100).toFixed(2);
                } else {
                    valuationField.value = '';
                }
            }

            function bindValuationEvents(group) {
                group.querySelector('.investment')?.addEventListener('input', () => calculateValuation(group));
                group.querySelector('.equity')?.addEventListener('input', () => calculateValuation(group));
            }

            const fundingCurrencyLabel = document.querySelectorAll('.funding_currency_label');

            function updateFundingCurrencyLabel() {
                const selectedCountry = (countryInput?.value || '').trim().toLowerCase();
                let label = '';

                if (selectedCountry === 'india') {
                    label = '(₹)';
                } else if (selectedCountry !== '') {
                    label = '($)';
                }

                fundingCurrencyLabel.forEach(el => {
                    el.textContent = label;
                });
            }

            updateFundingCurrencyLabel();
            countryInput?.addEventListener('input', updateFundingCurrencyLabel);

            // Initial binding
            wrapper?.querySelectorAll('.company-group').forEach(bindValuationEvents);

            addBtn?.addEventListener('click', function() {
                const lastGroup = wrapper.querySelector('.company-group:last-child');
                const newGroup = lastGroup.cloneNode(true);

                // Clear inputs
                newGroup.querySelectorAll('input').forEach(input => input.value = '');

                // Remove any existing delete button from the new group
                const existingRemoveBtn = newGroup.querySelector('.btn-outline-danger');
                if (existingRemoveBtn) {
                    existingRemoveBtn.remove();
                }

                // Add remove button to new group
                const removeBtn = document.createElement('button');
                removeBtn.type = 'button';
                removeBtn.className = 'btn btn-outline-danger btn-sm mt-2 d-block mx-auto';
                removeBtn.innerHTML = '<i class="fas fa-trash"></i>';
                removeBtn.addEventListener('click', function() {
                    newGroup.remove();
                });
                const btnWrapper = document.createElement('div');
                btnWrapper.className = 'text-center mt-2';
                btnWrapper.appendChild(removeBtn);

                newGroup.querySelector('.row').appendChild(btnWrapper);
                wrapper.appendChild(newGroup);
                bindValuationEvents(newGroup);
            });
        });


        function createErrorElement(id, parent) {
            const errorElement = document.createElement('div');
            errorElement.id = id;
            errorElement.className = 'text-danger mt-1 d-none';
            parent.parentNode.appendChild(errorElement);
            return errorElement;
        }
        document.querySelectorAll('input[name="preferred_startup_stage[]"]').forEach(input => {
            input.addEventListener('change', function() {
                const label = document.querySelector(`label[for="${this.id}"]`);
                if (this.checked) {
                    label.classList.add('active');
                } else {
                    label.classList.remove('active');
                }
            });
        });

        // Function to format number in Indian numbering system (e.g., 4000000 -> 40,00,000)
        function formatIndianNumber(value) {
            if (!value || isNaN(value)) return '';
            const num = parseInt(value.replace(/,/g, '')); // Remove existing commas
            if (isNaN(num)) return value;

            let result = num.toString().split('.');
            let lastThree = result[0].substring(result[0].length - 3);
            let otherNumbers = result[0].substring(0, result[0].length - 3);

            if (otherNumbers !== '') {
                lastThree = ',' + lastThree;
            }
            const formatted = otherNumbers.replace(/\B(?=(\d{2})+(?!\d))/g, ",") + lastThree;
            return result[1] ? formatted + '.' + result[1] : formatted;
        }

        function updateStakeFunding(group) {
            const marketCapital = group.querySelector('input[name="market_capital[]"]');
            const yourStake = group.querySelector('input[name="your_stake[]"]');
            const stakeFunding = group.querySelector('input[name="stake_funding[]"]');

            if (marketCapital && yourStake && stakeFunding) {
                const marketValue = parseFloat(marketCapital.value.replace(/,/g, '')) || 0;
                const stakePercentage = parseFloat(yourStake.value) || 0;
                if (stakePercentage > 0) {
                    const fundingValue = (marketValue * stakePercentage) / 100;
                    stakeFunding.value = formatIndianNumber(fundingValue.toFixed(2));
                } else {
                    stakeFunding.value = '';
                }
            }
        }

        function changeStep(direction) {
            if (direction === 1) {
                // Moving forward - validate current step
                if (!validateStep(currentStep)) {
                    return;
                }

                // Store current step data
                storeStepData(currentStep);
            }

            const newStep = currentStep + direction;

            if (newStep >= 2 && newStep <= totalSteps) {
                // setTimeout(() => {
                currentStep = newStep;
                showStep(currentStep);
                // }, 2000);
            }
        }

        function storeStepData(step) {
            const currentStepEl = document.querySelector(`.form-step[data-step="${step}"]`);
            const inputs = currentStepEl.querySelectorAll('input, select, textarea');

            inputs.forEach(input => {
                if (input.type === 'radio' || input.type === 'checkbox') {
                    if (input.checked) {
                        formData[input.name] = input.value;
                    }
                } else {
                    formData[input.name] = input.value;
                }
            });
        }

        document.addEventListener('DOMContentLoaded', function() {
            const equityInputs = document.querySelectorAll('input[name="your_stake[]"]');
            const checkbox = document.getElementById('actively_investing');
            const investmentFields = document.getElementById('investment-fields');
            const wrapper = document.getElementById('company-wrapper');
            const addBtn = document.getElementById('add-more-company');

            const currencyLabel = document.getElementById('currency_label');
            const countryInput = document.getElementById('country');

            addSelectAllButton('.col-md-6:first-of-type .border', 'preferred_industries[]',
                'Select All Industries');
            addSelectAllButton('.col-md-6:last-of-type .border', 'preferred_geographies[]',
                'Select All Geographies');

            equityInputs.forEach(input => {
                input.addEventListener('keypress', function(e) {
                    const char = String.fromCharCode(e.which);
                    if (!/[0-9.]/.test(char) && [8, 9, 27, 13, 46, 37, 38, 39, 40].indexOf(e
                            .keyCode) === -1) {
                        e.preventDefault();
                    }
                    if (char === '.' && this.value.indexOf('.') !== -1) {
                        e.preventDefault();
                    }
                });

                input.addEventListener('paste', function(e) {
                    setTimeout(() => {
                        validateEquityPercentage(this);
                    }, 0);
                });
            });

            function updateCurrencyLabel() {
                const selectedCountry = (countryInput?.value || '').trim().toLowerCase();
                if (selectedCountry === 'in') {
                    label = '(₹)';
                } else if (selectedCountry !== '') {
                    label = '($)';
                }
            }

            updateCurrencyLabel();
            countryInput?.addEventListener('input', updateCurrencyLabel);

            function toggleInvestmentFields() {
                investmentFields.style.display = checkbox.checked ? 'block' : 'none';
            }

            checkbox?.addEventListener('change', toggleInvestmentFields);
            toggleInvestmentFields();

            function calculateValuation(group) {
                const investment = parseFloat(group.querySelector('.investment').value);
                const equity = parseFloat(group.querySelector('.equity').value);
                const valuationField = group.querySelector('.valuation');

                if (!isNaN(investment) && !isNaN(equity) && equity > 0) {
                    valuationField.value = ((investment / equity) * 100).toFixed(2);
                } else {
                    valuationField.value = '';
                }
            }

            function bindValuationEvents(group) {
                group.querySelector('.investment')?.addEventListener('input', () => calculateValuation(group));
                group.querySelector('.equity')?.addEventListener('input', () => calculateValuation(group));
            }

            const fundingCurrencyLabel = document.querySelectorAll('.funding_currency_label');

            function updateFundingCurrencyLabel() {
                const selectedCountry = (countryInput?.value || '').trim().toLowerCase();
                let label = '';

                if (selectedCountry === 'india') {
                    label = '(₹)';
                } else if (selectedCountry !== '') {
                    label = '($)';
                }

                fundingCurrencyLabel.forEach(el => {
                    el.textContent = label;
                });
            }

            updateFundingCurrencyLabel();
            countryInput?.addEventListener('input', updateFundingCurrencyLabel);

            // Initial binding
            wrapper?.querySelectorAll('.company-group').forEach(bindValuationEvents);

            addBtn?.addEventListener('click', function() {
                const lastGroup = wrapper.querySelector('.company-group:last-child');
                const newGroup = lastGroup.cloneNode(true);

                // Clear inputs
                newGroup.querySelectorAll('input').forEach(input => input.value = '');

                // Remove any existing delete button from the new group
                const existingRemoveBtn = newGroup.querySelector('.btn-outline-danger');
                if (existingRemoveBtn) {
                    existingRemoveBtn.remove();
                }

                // Add remove button to new group
                const removeBtn = document.createElement('button');
                removeBtn.type = 'button';
                removeBtn.className = 'btn btn-outline-danger btn-sm mt-2 d-block mx-auto';
                removeBtn.innerHTML = '<i class="fas fa-trash"></i>';
                removeBtn.addEventListener('click', function() {
                    newGroup.remove();
                });
                const btnWrapper = document.createElement('div');
                btnWrapper.className = 'text-center mt-2';
                btnWrapper.appendChild(removeBtn);

                newGroup.querySelector('.row').appendChild(btnWrapper);
                wrapper.appendChild(newGroup);
                bindValuationEvents(newGroup);
            });
        });
        // Form validation and debugging

        // Add "Select All" functionality for checkboxes
        function addSelectAllButton(containerSelector, checkboxName, labelText) {
            const container = document.querySelector(containerSelector);
            if (!container) return; // Prevent crash if element doesn't exist

            const selectAllBtn = document.createElement('button');
            selectAllBtn.type = 'button';
            selectAllBtn.className = 'btn btn-sm btn-outline-secondary mb-2';
            selectAllBtn.textContent = labelText;

            selectAllBtn.addEventListener('click', function() {
                const checkboxes = container.querySelectorAll(`input[name="${checkboxName}"]`);
                const allChecked = Array.from(checkboxes).every(cb => cb.checked);

                checkboxes.forEach(cb => cb.checked = !allChecked);
                this.textContent = allChecked ?
                    labelText.replace('Deselect', 'Select') :
                    labelText.replace('Select', 'Deselect');
            });

            container.insertBefore(selectAllBtn, container.firstChild);
        }
        // Add select all buttons
        const countryToStates = {
            IN: {
                "Andhra Pradesh": ["Visakhapatnam", "Vijayawada", "Guntur", "Nellore", "Kurnool", "Rajahmundry",
                    "Tirupati", "Kakinada", "Anantapur", "Kadapa (Cuddapah)", "Chittoor", "Eluru", "Ongole",
                    "Machilipatnam", "Nizamabad"
                ],
                "Arunachal Pradesh": ["Itanagar", "Naharlagun", "Pasighat", "Tezpur", "Bomdila", "Tawang", "Ziro",
                    "Along", "Basar", "Roing", "Namsai", "Changlang", "Khonsa", "Longding", "Koloriang", "Daporijo",
                    "Yingkiong", "Mechuka", "Anini", "Hawai", "Seppa", "Chayang Tajo", "Aalo", "Tezu", "Nampong",
                ],
                "Assam": ["Guwahati", "Silchar", "Dibrugarh", "Jorhat", "Nagaon", "Tinsukia", "Tezpur", "Bongaigaon",
                    "Golaghat", "Karimganj", "Haflong", "Dhubri", "North Lakhimpur", "Sivasagar", "Barpeta",
                    "Mangaldoi", "Hailakandi", "Kokrajhar", "Goalpara", "Nalbari", "Majuli", "Kaziranga", "Manas",
                    "Sualkuchi",
                ],
                "Bihar": ["Patna", "Gaya", "Bhagalpur", "Muzaffarpur", "Purnia", "Darbhanga", "Bihar Sharif", "Arrah",
                    "Begusarai", "Katihar", "Bagaha", "Buxar", "Kishanganj", "Sitamarhi", "Jamalpur", "Jehanabad",
                    "Aurangabad",
                    "Siwan", "Motihari", "Nawada", "Sasaram", "Munger", "Chhapra", "Bettiah", "Saharsa", "Hajipur"
                ],
                "Chhattisgarh": ["Raipur", "Bhilai", "Korba", "Bilaspur", "Durg", "Rajnandgaon", "Jagdalpur",
                    "Ambikapur", "Raigarh", "Jashpur", "Kanker", "Mahasamund", "Dhamtari", "Gariaband", "Balod",
                    "Bemetara", "Mungeli", "Chirmiri", "Champa", "Bemetara", "Baikunthpur", "Kondagaon",
                    "Tilda Neora", "Naila Janjgir", "Mahasamund", "Dalli-Rajhara", "Janjgir-cahmpa"
                ],
                "Goa": ["Panaji", "Margao", "Vasco da Gama", "Mapusa", "Ponda", "canacona", "Calangute",
                    "Mormugao",
                    "Bardez", "Arpora", "Tiswadi", "pernem", "Rajbag", "Patnem", "Cavelossim", "Valpoi",
                    "Cuncolim", "Quepem", "Curchorem–Cacora", "Sanguem", "Aldona", "Anjuna", "Aquem",
                    "Bandora", "Benaulim", "Borim", "Calapor", "Chicalim", "Chimbel", "Chinchinim",
                    "Colvale", "Corlim", "Cortalim", "Davorlim", "Goa Velha", "Guirim", "Mandrem", "Murda",
                    "Navelim", "Nerul", "Nuvem", "Onda", "Orgao", "Pale", "Parcem", "Penha-de-Franca",
                    "Pilerne", "Priol", "Raia", "Reis Magos", "Saligao", "Sanvordem", "São José de Areal",
                    "Siolim", "Socorro (Serula)", "Usgao", "Varca", "Verna", "Xeldem"
                ],
                "Gujarat": ["Ahmedabad", "Surat", "Vadodara", "Rajkot", "Bhavnagar", "Jamnagar", "Junagadh",
                    "Gandhinagar", "Veraval", "Vadali", "Songadh", "Talaja", "Dwarka", "Ankleshwar", "Ahwa",
                    "Amreli", "Bharuch", "Porbandar", "Godhra", "Navsari", "Anand", "Surendranagar", "Vapi",
                    "Navsari", "Mehsana", "Palanpur", "Patan", "Godhra", "Dahod",
                    "Himmatnagar", "Modasa", "Idar", "Veraval", "Porbandar", "Dwarka", "Botad", "Amreli",
                    "Mahuva", "Khambhat", "Ankleshwar", "Kalol", "Gandhidham", "Mundra", "Kutch (Bhuj)",
                    "Valasad"
                ],
                "Haryana": [
                    "Gurugram", "Faridabad", "Panipat", "Ambala", "Yamunanagar", "Rohtak", "Hisar",
                    "Chandigarh", "Karnal", "Sonipat", "Sirsa", "Bahadurgarh", "Jind", "Thanesar",
                    "Kaithal", "Rewari", "Bhiwani", "Palwal", "Pinjore", "Panchkula", "Kurukshetra",
                    "Fatehabad", "Narnaul", "Mahendragarh", "Charkhi Dadri",
                    "Jhajjar", "Gohana", "Hansi", "Jagadhri", "Kalka", "Ballabgarh", "Sohna", "Tauru", "Hathin",
                    "Hodal"
                ],
                "Himachal Pradesh": [
                    "Shimla", "Dharamshala", "Solan", "Mandi", "Kullu", "Manali", "Palampur", "Bilaspur",
                    "Hamirpur", "Una", "Kangra", "Chamba", "Kinnaur", "Lahaul and Spiti", "Sirmaur",
                    "Nahan", "Baddi", "Parwanoo", "Kasauli", "Dalhousie", "Mcleodganj", "Jogindernagar",
                    "Sundernagar", "Baijnath", "Nurpur", "Pathankot", "Nalagarh",
                    "Amb", "Gagret", "Bharwain", "Nadaun", "Sujanpur", "Rampur", "Rekong Peo", "Kalpa",
                    "Keylong", "Kaza", "Rohru", "Theog", "Chopal", "Arki", "Rajgarh",
                    "Pachhad", "Paonta Sahib", "Renuka", "Sarahan"
                ],
                "Jharkhand": ["Ranchi", "Jamshedpur", "Dhanbad", "Bokaro", "Deoghar", "Hazaribagh", "Giridih",
                    "Ramgarh", "Medininagar", "Chaibasa", "Rajmahal", "Sahibganj", "Pakur", "Dumka", "Godda",
                    "Sahebganj", "Lohardaga", "Gumla", "Simdega", "Khunti", "Saraikela", "Chakradharpur",
                    "Manoharpur", "Adityapur", "Jugsalai", "Bistupur", "Sakchi", "Kadma", "Sonari", "Jharia",
                    "Sindri", "Nirsa", "Katras", "Govindpur", "Chas", "Bermo", "Phusro", "Gomoh", "Topchanchi",
                    "Tundi", "Baghmara", "Bagodar", "Pirtand", "Bansjor", "Tisri", "Koderma", "Dhanwar",
                    "Chatra", "Hunterganj", "Simaria", "Tandwa", "Lathehar", "Manika", "Chandwa", "Balumath",
                    "Satbarwa", "Daltonganj", "Garhwa", "Bishrampur", "Bhandaria", "Ranka", "Bhawanathpur",
                    "Hussainabad", "Chinia", "Mahagama"
                ],
                "Karnataka": ["Bangalore", "Mysore", "Mangalore", "Hubli", "Belgaum", "Gulbarga", "Davanagere",
                    "Bellary", "Tumkur", "Shimoga", "Bijapur", "Raichur", "Bidar", "Hassan", "Udupi",
                    "Chikmagalur", "Mandya", "Kolar", "Chitradurga", "Bagalkot", "Dharwad", "Gadag", "Haveri",
                    "Uttara Kannada", "Dakshina Kannada", "Kodagu", "Chamarajanagar", "Chikkaballapur",
                    "Ramanagara", "Yadgir", "Koppal", "Vijayanagara", "Karwar", "Bhatkal", "Sirsi", "Sagar",
                    "Thirthahalli", "Hosanagar", "Kundapura", "Brahmavar", "Karkala", "Puttur", "Sullia",
                    "Madikeri", "Virajpet", "Somvarpet", "Kushalanagar", "Gokarna", "Kumta", "Honnavar",
                    "Ankola", "Yellapur", "Mundgod", "Haliyal", "Joida", "Siddapur", "Sirsi", "Sagar",
                    "Hosanagar", "Thirthahalli", "Shimoga", "Bhadravati", "Tarikere", "Channagiri", "Harihar",
                    "Ranebennur", "Hirekerur", "Shiggaon", "Savanur", "Byadgi", "Hangal", "Kundgol",
                    "Navalgund", "Shirhatti", "Mundargi", "Nargund", "Gajendragad", "Ron", "Lakshmeshwar",
                    "Gadag", "Betgeri", "Hulkoti", "Shirhatti", "Mundargi", "Nargund", "Gajendragad", "Ron",
                    "Lakshmeshwar", "Gadag", "Betgeri", "Hulkoti", "Kalaghatgi", "Kundgol", "Dharwad", "Hubli",
                    "Kalghatgi", "Navalgund", "Alnavar", "Belgaum", "Chikodi", "Gokak", "Athani", "Raibag",
                    "Soundatti", "Savadatti", "Parasgad", "Khanapur", "Bailhongal", "Mudalgi", "Jamkhandi",
                    "Biljapur", "Muddebihal", "Bagewadi", "Hungund", "Ilkal", "Narayanpet", "Bagalkot",
                    "Badami", "Hunagund", "Mudhol", "Terdal", "Guledgudda", "Kerur", "Lokapur", "Mahalingpur",
                    "Rabkavi Banhatti", "Saundatti", "Terdal", "Vijayapura", "Indi", "Sindgi",
                    "Basavana Bagewadi", "Chadchan", "Muddebihal", "Talikota", "Nidagundi", "Tikota",
                    "B Bagewadi", "Kolhar", "Devar Hippargi", "Talikota", "Gulbarga", "Afzalpur", "Aland",
                    "Chincholi", "Chitapur", "Gulbarga", "Jevargi", "Kalagi", "Sedam", "Shahabad", "Shorapur",
                    "Yadgir", "Hunagunda", "Surpur", "Shorapur", "Raichur", "Devadurga", "Lingsugur", "Manvi",
                    "Sindhanur", "Sirwar", "Koppal", "Gangavathi", "Karatagi", "Kushtagi", "Yelburga", "Hospet",
                    "Hagaribommanahalli", "Hoovina Hadagali", "Kudligi", "Sandur", "Siruguppa", "Toranagallu",
                    "Kampli", "Ballari", "Hadagalli", "Harappanahalli", "Harpanhalli", "Hosdurga", "Jagalur",
                    "Molakalmuru", "Chitradurga", "Bharamasagara", "Challakere", "Hiriyur", "Holalkere",
                    "Hosadurga", "Tumkur", "Chikkanayakanahalli", "Cnhalli", "Gubbi", "Hiriyur", "Koratagere",
                    "Kunigal", "Madhugiri", "Pavagada", "Sira", "Tiptur", "Turuvekere", "Kolar", "Bangarpet",
                    "Chikkaballapur", "Chintamani", "Gauribidanur", "Gudibanda", "Malur", "Mulbagal",
                    "Sidlaghatta", "Srinivaspur", "Chikkaballapur", "Bagepalli", "Chickballapur",
                    "Gowribidanur", "Gudibande", "Sidlaghatta", "Ramanagara", "Channapatna", "Kanakapura",
                    "Magadi", "Ramanagara", "Hassan", "Alur", "Arkalgud", "Arsikere", "Belur",
                    "Channarayapatna", "Hassan", "Holenarsipur", "Sakleshpur", "Mandya", "Krishnarajpet",
                    "Maddur", "Malavalli", "Mandya", "Nagamangala", "Pandavapura", "Shrirangapattana", "Mysore",
                    "Bannur", "Chamarajanagar", "Gundlupet", "Hanur", "Kollegal", "Mysore", "Nanjangud",
                    "Piriyapatna", "Sargur", "Suttur", "T Narasipur", "Yelandur", "Kodagu", "Madikeri",
                    "Somvarpet", "Virajpet", "Chikmagalur", "Kadur", "Koppa", "Mudigere", "Narasimharajapura",
                    "Sringeri", "Tarikere", "Dakshina Kannada", "Bantwal", "Belthangady", "Mangalore",
                    "Moodbidri", "Puttur", "Sullia", "Udupi", "Brahmavar", "Byndoor", "Hebri", "Karkala",
                    "Kaup", "Kundapur", "Udupi"
                ],
                "Kerala": ["Thiruvananthapuram", "Kochi", "Kozhikode", "Thrissur", "Kollam", "Palakkad",
                    "Alappuzha", "Kannur", "Kottayam", "Malappuram", "Kasaragod", "Pathanamthitta", "Idukki",
                    "Ernakulam", "Wayanad", "Attingal", "Varkala", "Neyyattinkara", "Parassala", "Kazhakuttom",
                    "Poovar", "Kovalam", "Vizhinjam", "Balaramapuram", "Nedumangad", "Karakulam", "Munnar",
                    "Thekkady", "Kumily", "Devikulam", "Udumbanchola", "Thodupuzha", "Adimali", "Rajakumari",
                    "Kattappana", "Peerumade", "Vandanmedu", "Marayoor", "Kanjirappally", "Changanassery",
                    "Vaikom", "Ettumanoor", "Pala", "Teekoy", "Kumarakom", "Erattupetta", "Mundakayam",
                    "Ponkunnam", "Ranni", "Kozhencherry", "Thiruvalla", "Adoor", "Pathanamthitta",
                    "Mallappally", "Konni", "Pandalam", "Aranmula", "Chengannur", "Mavelikara", "Kayamkulam",
                    "Haripad", "Ambalappuzha", "Cherthala", "Mararikulam", "Kumbakonam", "Kuttanad",
                    "Changanacherry", "Quilon", "Karunagappally", "Kottarakkara", "Punalur", "Anchal",
                    "Kunnathur", "Sasthamcotta", "Kundara", "Chavara", "Ochira", "Chadayamangalam", "Paravur",
                    "Vettoor", "Ayoor", "Ernakulam", "Fort Kochi", "Mattancherry", "Aluva", "Perumbavoor",
                    "Muvattupuzha", "Kothamangalam", "Angamaly", "Kalamassery", "Tripunithura", "Edappally",
                    "Kakkanad", "Cheranalloor", "Chottanikkara", "Piravom", "Kolenchery", "Mulanthuruthy",
                    "Paippad", "Kodanad", "Malayattoor", "Kalady", "Njarakkal", "Vypin", "Guruvayur",
                    "Kodungallur", "Irinjalakuda", "Chalakudy", "Kunnamkulam", "Wadakkanchery", "Ollur",
                    "Cherpu", "Mathilakam", "Mala", "Kodakara", "Thrissur", "Chavakkad", "Ponnani", "Tirur",
                    "Tanur", "Parappanangadi", "Kondotty", "Wandoor", "Nilambur", "Manjeri", "Perinthalmanna",
                    "Areekode", "Kottakkal", "Valanchery", "Tirurangadi", "Vengara", "Marakkara", "Edappal",
                    "Perumpadappu", "Ottapalam", "Shoranur", "Cherpulassery", "Kongad", "Mannarkad", "Alathur",
                    "Chittur", "Nemmara", "Kollengode", "Pattambi", "Thrithala", "Kuzhalmannam", "Shornur",
                    "Lakkidi", "Calicut", "Vadakara", "Koyilandy", "Ramanattukara", "Feroke", "Beypore",
                    "Elathur", "Mukkam", "Thiruvambady", "Balussery", "Panthalayani", "Payyoli", "Cheruvannur",
                    "Chathamangalam", "Koduvally", "Perambra", "Quilandy", "Thaliparamba", "Iritty", "Peravoor",
                    "Kuthuparamba", "Mattannur", "Kalliassery", "Anthoor", "Valapattanam", "Azhikode",
                    "Dharmadam", "Muzhappilangad", "Payyanur", "Cheruthazham", "Irikkur", "Sreekandapuram",
                    "Taliparamba", "Chirakkal", "Brasilia", "Pazhayangadi", "Kanhangad", "Bekal", "Manjeshwar",
                    "Uppala", "Kasaragod", "Chemnad", "Badiyadukka", "Pullur", "Kayyur", "Bedadka", "Balal",
                    "Perla", "Delampady", "Kuttikol", "Nileshwar", "Vellarikundu", "Trikkarippur",
                    "Cheruvathur", "Pilicode", "Manjeswaram", "Kumbla", "Parappa", "Bakel", "Sulthan Bathery",
                    "Kalpetta", "Mananthavady", "Vythiri", "Meppadi", "Ambalavayal", "Thirunelli", "Pulpally",
                    "Panamaram", "Vellamunda", "Pozhuthana", "Wayanad"
                ],
                "Madhya Pradesh": ["Bhopal", "Indore", "Gwalior", "Jabalpur", "Ujjain", "Sagar", "Dewas",
                    "Satna", "Ratlam", "Rewa", "Katni", "Singrauli", "Burhanpur", "Khandwa", "Bhind",
                    "Chhindwara", "Guna", "Shivpuri", "Vidisha", "Chhatarpur", "Damoh", "Mandsaur", "Khargone",
                    "Neemuch", "Pithampur", "Morena", "Betul", "Harda", "Hoshangabad", "Raisen", "Sehore",
                    "Rajgarh", "Shajapur", "Agar Malwa", "Alirajpur", "Anuppur", "Ashoknagar", "Balaghat",
                    "Barwani", "Datia", "Dhar", "Dindori", "East Nimar", "Gwalior", "Harda", "Hoshangabad",
                    "Jhabua", "Katni", "Khandwa", "Khargone", "Mandla", "Mandsaur", "Morena", "Narsinghpur",
                    "Neemuch", "Panna", "Raisen", "Rajgarh", "Ratlam", "Rewa", "Sagar", "Satna", "Sehore",
                    "Seoni", "Shahdol", "Shajapur", "Sheopur", "Shivpuri", "Sidhi", "Singrauli", "Tikamgarh",
                    "Ujjain", "Umaria", "Vidisha", "West Nimar", "Itarsi", "Sanchi", "Orchha", "Khajuraho",
                    "Pachmarhi", "Omkareshwar", "Maheshwar", "Mandu", "Chanderi", "Shivpuri", "Datia", "Jhansi",
                    "Lalitpur", "Tikamgarh", "Chhatarpur", "Panna", "Damoh", "Sagar", "Vidisha", "Raisen",
                    "Sehore", "Rajgarh", "Shajapur", "Agar", "Dewas", "Indore", "Dhar", "Jhabua", "Alirajpur",
                    "Barwani", "Khargone", "Burhanpur", "Khandwa", "Harda", "Hoshangabad", "Betul",
                    "Chhindwara", "Seoni", "Mandla", "Dindori", "Balaghat", "Gondia", "Jabalpur", "Katni",
                    "Narsinghpur", "Chhindwara", "Seoni", "Mandla", "Dindori", "Umaria", "Shahdol", "Anuppur",
                    "Sidhi", "Singrauli", "Rewa", "Satna", "Maihar", "Nagod", "Amarpatan", "Mauganj",
                    "Chitrakoot", "Banda", "Hamirpur", "Mahoba", "Jalaun", "Jhansi", "Lalitpur", "Sagar",
                    "Damoh", "Panna", "Chhatarpur", "Tikamgarh", "Niwari", "Orchha", "Prithvipur", "Niwari",
                    "Khurai", "Banda", "Deori", "Rehli", "Khurai", "Banda", "Deori", "Rehli", "Bina", "Kurwai",
                    "Vidisha", "Basoda", "Gyaraspur", "Lateri", "Sironj", "Gulabganj", "Berasia",
                    "Obedullaganj", "Raisen", "Bareli", "Begamganj", "Gairatganj", "Sanchi", "Silwani",
                    "Udaipura", "Budhni", "Ichhawar", "Hoshangabad", "Babai", "Kesla", "Seoni Malwa",
                    "Sohagpur", "Pipariya", "Bankhedi", "Timarni", "Susner", "Agar", "Nalkheda", "Barod",
                    "Dewas", "Sonkatch", "Khategaon", "Kannod", "Hatpipalya", "Satwas", "Tonk Khurd", "Bagli",
                    "Mhow", "Sanwer", "Hatod", "Depalpur", "Indore", "Dhar", "Kukshi", "Manawar", "Sardarpur",
                    "Gandhwani", "Nisarpur", "Jhabua", "Petlawad", "Thandla", "Meghnagar", "Jobat", "Alirajpur",
                    "Sondwa", "Udaygarh", "Katthiwara", "Pansemal", "Sendhwa", "Barwani", "Rajpur", "Thikri",
                    "Niwali", "Bhagvanpura", "Khargone", "Gogawan", "Kasrawad", "Bhikangaon", "Maheshwar",
                    "Mandleshwar", "Omkareshwar", "Punasa", "Burhanpur", "Nepanagar", "Khandwa", "Pandhana",
                    "Punasa", "Khalwa", "Harda", "Khirkiya", "Timarni", "Hoshangabad", "Sohagpur", "Kesla",
                    "Seoni Malwa", "Babai", "Itarsi", "Bankhedi", "Pipariya", "Pachmarhi", "Betul", "Multai",
                    "Bhainsdehi", "Shahpur", "Amla", "Ghoradongri", "Chicholi", "Chhindwara", "Sausar",
                    "Amarwara", "Chourai", "Harrai", "Junnardeo", "Parasia", "Pandhurna", "Mohkhed", "Seoni",
                    "Lakhnadon", "Barghat", "Keolari", "Ghansaur", "Mandla", "Bichhiya", "Narayanganj", "Niwas",
                    "Dindori", "Shahpura", "Karanjia", "Mehandwani", "Samnapur", "Balaghat", "Birsa",
                    "Waraseoni", "Katangi", "Khairlanji", "Paraswada", "Lanji", "Baihar", "Malajkhand",
                    "Kirnapur", "Jabalpur", "Sihora", "Katni", "Rithi", "Dhimarkheda", "Bargi", "Shahpura",
                    "Majholi", "Panagar", "Narsinghpur", "Gadarwara", "Kareli", "Gotegaon", "Tendukheda",
                    "Babina", "Narsimhapur", "Umaria", "Manpur", "Nowrozabad", "Shahdol", "Beohari",
                    "Jaisinghnagar", "Jaitpur", "Anuppur", "Jaithari", "Kotma", "Venkatnagar", "Pushprajgarh",
                    "Sidhi", "Gopad Banas", "Majhauli", "Kusmi", "Churhat", "Chitrangi", "Singrauli", "Waidhan",
                    "Deosar", "Sarai", "Devsar", "Rewa", "Sirmour", "Hanumana", "Jawa", "Gurh", "Mangawan",
                    "Teonthar", "Satna", "Raghurajnagar", "Amarpatan", "Maihar", "Nagod", "Unchehra", "Kotar",
                    "Sohawal"
                ],
                "Maharashtra": ["Mumbai", "Pune", "Nagpur", "Nashik", "Aurangabad", "Solapur", "Thane",
                    "Kolhapur", "Amravati", "Navi Mumbai", "Kalyan", "Dombivli", "Sangli",
                    "Jalgaon", "Akola", "Latur", "Ahmednagar", "Chandrapur", "Parbhani", "Dhule",
                    "Ichalkaranji", "Panvel", "Beed", "Osmanabad", "Wardha", "Satara",
                    "Yavatmal", "Nanded", "Bhiwandi", "Malegaon", "Gondia", "Thane", "Pimpri-Chinchwad",
                    "Badlapur", "Gondia", "Satara", "Barshi", "Yavatmal", "Achalpur", "Nandurbar", "Udgir",
                    "Ahmednagar", "Miraj", "Kamptee", "Parli", "Chiplun", "Ratnagiri", "Ichalkaranji", "Jalna",
                    "Ambarnath", "Bhusawal", "Sangli‑Miraj‑Kupwad", "Malegaon", "Jalgaon",
                ],
                "Manipur": [
                    "Imphal", "Thoubal", "Bishnupur", "Churachandpur", "Kakching", "Ukhrul", "Senapati",
                    "Tamenglong", "Chandel", "Jiribam",
                    "Kangpokpi", "Moreh", "Noney", "Pherzawl", "Mayang Imphal", "Moirang", "Nambol", "Samurou",
                    "Lilong", "Heirok", "Wangjing", "Yairipok", "Sekmai Bazar", "Khongman",
                    "Thoibang (Hill Town)", "Sikhong Sekmai", "Tengnoupal", "Rengkai", "Zenhang Lamka",
                    "Hill Town", "Nambol", "Porompat", "Khurai Sajor Leikai", "Thongju", "Kshetrigao",
                ],
                "Meghalaya": [
                    "Shillong", "Tura", "Jowai", "Nongstoin", "Baghmara", "Williamnagar", "Resubelpara",
                    "Mawkyrwat", "Ampati", "Khliehriat", "Sohra (Cherrapunji)", "Mairang", "Nongpoh",
                    "Nongthymmai", "Mawlai", "Mawpat", "Nongmynsong", "Pynthorumkhrah", "Umlyngka", "Lawsohtun",
                    "Nongkseh", "Umpling", "Madanrting", "Cherrapunji", "Pynursla", "Cherrapunji", "Riwai",
                    "Mawlyngot", "Mawlynnong", "Mawsynram",
                ],
                "Mizoram": [
                    "Aizawl", "Lunglei", "Saiha", "Champhai", "Kolasib", "Serchhip", "Lawngtlai", "Mamit",
                    "Saitual",
                    "Hnahthial", "North Vanlaiphai", "Biate", "Thenzawl", "Zawlnuam", "Bairabi", "Sairang",
                    "Zawlnuam", "Thenzawl", "Khawzawl", "Hnahthial", "Lengpui", "North Vanlaiphai", "Tlabung",
                    "Vairengte", "Biate", "Darlawn", "Hnahthial", "Khawhai", "N. Kawnpui", "Khawzawl",
                    "Zokhawthar"
                ],
                //end
                "Nagaland": ["Kohima", "Dimapur", "Mokokchung", "Tuensang", "Wokha", "Mon", "Zunheboto",
                    "Chumukedima", "Longleng", "Kiphire", "Phek", "Changtongya", "Tsudikong", "Jalukie", "Tuli",
                    "Pughoboto", "Ahthibung", "Kuda",
                    "Chizami", "Chinglong", "Chungtia", "Chozumi", "Jotsama", "Ghaspani", "Henima", "Chimakudi",
                    "Chipoketami", "Lazami", "Longching", "Lakhuti", "Laruri", "Litim"
                ],
                "Odisha": ["Bhubaneswar", "Cuttack", "Rourkela", "Brahmapur", "Sambalpur", "Puri", "Balasore",
                    "Baripada", "Bhadrak", "Angul", "Talcher", "Athmallik", "Chhendipada", "Pallahara",
                    "Jaleswar", "Soro", "Baliapal", "Basta", "Nilagiri", "Remuna", "Simulia", "Bargarh",
                    "Attabira", "Barapali", "Bheden", "Bijepur", "Padmapur", "Paikamal", "Sohela", "Basudevpur",
                    "Agarpada", "Chandabali", "Dhamnagar", "Dhamra", "Jagatsinghpur", "Paradeep", "Kujang",
                    "Jajpur", "Vyasanagar", "Belpahar", "Brajarajnagar", "Jharsuguda", "Bhawanipatna",
                    "Dharamgarh"
                ],
                "Punjab": ["Chandigarh", "Ludhiana", "Amritsar", "Jalandhar", "Patiala", "Bathinda", "Mohali",
                    "Hoshiarpur", "Pathankot", "Moga", "Batala", "Abohar", "Malerkotla", "Khanna", "Muktsar",
                    "Barnala", "Firozpur", "Kapurthala", "Phagwara", "Zirakpur", "Rajpura", "Dera Bassi",
                    "Lalru", "Banur", "Sangrur", "Sunam", "Dhuri", "Ahmedgarh", "Longowal", "Lehragaga",
                    "Bhawanigarh", "Moonak", "Dirba", "Khem Karan", "Tarn Taran", "Patti", "Bhikhiwind",
                    "Amritsar Cantonment", "Firozpur Cantonment", "Jalandhar Cantonment", "Daper", "Mubarakpur",
                    "Balongi", "Bhankharpur", "Sohana", "Mullanpur Garib Dass", "Mirpur", "Nangli",
                    "Budha Theh", "Kathanian", "Baba Bakala", "Chogawan", "Khilchian", "Mudal", "Mehna",
                    "Bhisiana", "Korianwali", "Satyewala", "Tibri", "Fateh Nangal", "Behrampur", "Shikar",
                    "Baryar", "Chohal", "Hazipur", "Rakri", "Sufipind", "Jandiala", "Sarai Khas", "Apra",
                    "Dhin", "Khambra", "Sansarpur", "Raipur Rasulpur", "Chomon", "Phagwara Sharki",
                    "Hussainpur", "Chachoki", "Gill", "Bhamian Kalan", "Tharike", "Bhattian",
                    "Partap Singhwala", "Halwara", "Akalgarh", "Baddowal", "Jodhan", "Rail", "Khothran",
                    "Saloh", "Aur", "Mamun", "Jugial", "Daulatpur", "Narot Mehra", "Ghoh", "Manwal", "Sarna",
                    "Kot", "Bungal", "Tharial", "Malikpur", "Dhaki", "Rurki Kasba", "Alhoran", "Nilpur",
                    "Nehon", "Nawan Sujanpur"
                ],
                "Rajasthan": ["Jaipur", "Jodhpur", "Kota", "Bikaner", "Ajmer", "Udaipur", "Bhilwara", "Alwar",
                    "Beawar", "Bhilwara", "Churu", "Sri Ganganagar", "Hanumangarh", "Jhunjhunu", "Kishangarh",
                    "Pali", "Sikar", "Sirohi", "Tonk", "Kotputli", "Gangapur City", "Dausa", "Nagaur",
                    "Bhiwadi", "Sawai Madhopur", "Kekri", "Sikar", "Bharatpur", "Pali", "Nawalgarh",
                    "Vijainagar", "Nasirabad", "Sujangarh", "Chirawa", "Bidasar", "Ratangarh", "Chhapar",
                    "Mandawa", "Pilani", "Mukandgarh", "Reengus", "Phulera", "Jobner", "Bagru", "Chaksu",
                    "Deoli", "Deshnoke", "Dhariawad", "Didwana", "Dungargarh", "Falna", "Fatehnagar",
                    "Fatehpur", "Gajsinghpur", "Goredi Chancha", "Govindgarh", "Gulabpura", "Hindaun",
                    "Jahazpur", "Jalore", "Jhalawar", "Jhalrapatan"
                ],
                "Sikkim": ["Gangtok", "Namchi", "Gyalshing", "Mangan", "Pakyong", "Jorethang", "Rangpo",
                    "Singtam", "Ravangla", "Mangan", "Pelling", "Chungthang", "Lachen", "Lachung", "Rhenock",
                    "Rongli", "Yuksom", "Melli", "Sherathang", "Legship", "Majitar", "Namthang", "Yangang",
                    "Damthang", "Nayabazar", "Singhik", "Tashiding", "Makha", "Rorathang", "Tumlong",
                    "Ranipool", "Hee Burmiok", "Kumrek", "Richenpong", "Thambi Viewpoint (Zuluk)", "Sherathang",
                    "Naya Bazar", "Chidam"
                ],
                "Tamil Nadu": ["Chennai", "Coimbatore", "Madurai", "Tiruchirappalli", "Salem", "Tirunelveli",
                    "Erode",
                    "Vellore", "Tiruppur", "Vellore", "Thoothukudi", "Dindigul", "Thanjavur", "Hosur",
                    "Nagercoil", "Avadi", "Tambaram", "Kanchipuram", "Cuddalore", "Karur", "Kumbakonam",
                    "Sivakasi", "Pudukottai", "Karaikudi", "Tiruvannamalai", "Namakkal", "Ambattur",
                    "Tiruvottiyur", "Pallavaram", "Madavaram", "Alandur", "Kurichi", "Rajapalayam", "Neyveli",
                    "Nagapattinam",
                    "Mettunasuvanpalayam", "Thottipalayam", "Thevaram", "Tiruppattur", "Devakottai", "Lalgudi",
                    "Milavittan", "Mappilaiurani", "Muttayyapuram", "Athimarapatti", "Sankaraperi",
                    "Kumaragiri", "Nanjikottai", "Vallam", "Neelagiri", "Pudupattinam", "Vilar"
                ],
                "Telangana": ["Hyderabad", "Warangal", "Nizamabad", "Khammam", "Karimnagar", "Ramagundam",
                    "Secunderabad", "Greater Warangal", "Mahabubnagar", "Nalgonda", "Adilabad", "Suryapet",
                    "Miryalaguda", "Siddipet", "Jagtial", "Bhainsa", "Boduppal", "Jawaharnagar", "Medak",
                    "Shamshabad", "Mahabubabad", "Bhupalpally", "Narayanpet", "Dundigal", "Huzurnagar",
                    "Medchal", "Bandlaguda Jagir", "Kyathanpally", "Manuguru", "Naspur", "Narsampet",
                    "Devarakonda", "Dubbaka", "Nakrekal", "Banswada", "Kalwakurthy", "Parigi", "Thumkunta",
                    "Neredcherla", "Nagaram", "Gajwel", "Chennur", "Asifabad", "Madhira", "Ghatkesar",
                    "Kompally", "Pocharam", "Dammaiguda", "Achampet", "Choutuppal", "Yenugonda", "Boyapalle",
                    "Allipur", "Eddumailaram", "Dharmaram", "Pothreddipalle", "Kamalapuram", "Luxettipet",
                    "Chandur", "Medipalle", "Kothur", "Ramannapeta", "Narsingi", "Jallaram", "Bibinagar",
                    "Isnapur", "Asifabad"
                ],
                "Tripura": ["Agartala", "Dharmanagar", "Udaipur", "Kailashahar", "Bishalgarh", "Teliamura",
                    "Khowai", "Belonia", "Melaghar", "Mohanpur", "Ambassa", "Ranirbazar", "Santirbazar",
                    "Kumarghat", "Sonamura", "Panisagar", "Amarpur", "Jirania", "Kamalpur", "Sabroom",
                    "Badharghat", "Gakulnagar", "Gandhigram", "Indranagar", "Jogendranagar", "Kanchanpur",
                    "Narsingarh", "Pratapgarh", "Dharmanagar (CT)", "Khowai (CT)", "Chandigarh (CT)",
                    "Madhupur", "Madhuban", "Fulkumari", "Lebachhara", "Manu Bazar", "Mairuhabari",
                    "Manoharpur", "Manpui", "Meltraipara", "Moghiyabari", "Mukhachariduar", "Muktasinghpara",
                    "Nakraihapara", "Navanchanarabari"
                ],
                "Uttar Pradesh": ["Lucknow", "Kanpur", "Ghaziabad", "Agra", "Varanasi", "Meerut", "Allahabad",
                    "Bareilly", "Prayagraj", "Moradabad", "Aligarh", "Saharanpur", "Meerut", "Muzaffarnagar",
                    "Gorakhpur", "Basti", "Jhansi", "Noida", "Greater Noida", "Gautam Buddha Nagar",
                    "Firozabad", "Ghaziabad", "Ghazipur", "Sitapur", "Raebareli", "Pratapgarh", "Rampur",
                    "Shamli", "Bijnor", "Ballia", "Azamgarh", "Basti", "Farrukhabad", "Shikohabad", "Akbarpur",
                    "Tanda", "Basti", "Chandausi", "Bijnor", "Kasganj", "Awagarh", "Ballia", "Gonda",
                    "Farrukhabad", "Fatehpur", "Firozabad", "Sambhal", "Shahjahanpur", "Jaunpur", "Ambedkar Nagar",
                    "Raebareli", "Mau", "Saharsa", "Aligarh", "Hapur", "Achalganj", "Bangarmau", "Ganj Muradabad",
                    "Safipur", "Kursath", "Auras", "Hyderabad(Unnao)", "Rasulabad", "Mohan(Unnao)",
                    "Nawabganj(Unnao)",
                    "Purwa ", "Maurawan", "Bighapur", "Bhagwant Nagar", "Katri Piper Khera", "Achalganj(CT)",
                    "Majhara Pipar Ahatmali"
                ],
                "Uttarakhand": ["Dehradun", "Haridwar", "Roorkee", "Haldwani", "Rudrapur", "Kashipur",
                    "Rishikesh", "Kotdwar", "Pithoragarh", "Almora", "Chakrata", "Landour", "Ramnagar",
                    "Manglaur", "Jaspur", "Kichha", "Nainital", "Mussoorie", "Sitarganj", "Bajpur", "Pauri",
                    "Tehri", "Gopeshwar", "Srinagar", "Gadarpur", "Tanakpur", "Uttarkashi", "Jyotirmath",
                    "Rudraprayag", "Bageshwar", "Bhowali", "Narendranagar", "Dugadda", "Laksar", "Landhaura",
                    "Mahua Kheraganj", "Dineshpur", "Jhabrera", "Kela Khera", "Muni Ki Reti", "Sultanpur",
                    "Herbertpur", "Gauchar", "Doiwala", "Karnaprayag", "Lohaghat", "Chamba", "Bhimtal",
                    "Lalkuan", "Kaladhungi", "Dharchula", "Barkot", "Didihat", "Garur", "Kapkot"
                ],
                "West Bengal": ["Kolkata", "Howrah", "Durgapur", "Asansol", "Siliguri", "Bardhaman", "Malda",
                    "Barijhati", "Barjora",
                    "Alipurduar", "Arambag", "Ashoknagar Kalyangarh", "Baduria", "Baharampur", "Baidyabati",
                    "Bally", "Balurghat", "Bangaon", "Bankura", "Bansberia", "Baranagar", "Barasat", "Begampur",
                    "Bikrampur", "Barrackpore", "Baruipur", "Basirhat", "Beldanga", "Bhadreswar", "Bhatpara",
                    "Birnagar", "Bishnupur", "Bolpur", "Budge Budge", "Buniadpur", "Chakdaha", "Champdani",
                    "Chandrakona", "Contai", "Dainhat", "Dalkhola", "Dankuni", "Darjeeling", "Dhulian",
                    "Dhupguri", "Diamond Harbour", "Dinhata", "Domkal", "Dubrajpur", "Dum Dum", "Egra",
                    "English Bazar", "Falakata", "Gangarampur", "Garulia", "Gayespur", "Ghatal", "Gobardanga",
                    "Guskara", "Habra", "Haldia", "Haldibari", "Halisahar", "Hooghly‑Chinsurah", "Islampur",
                    "Jalpaiguri", "Jangipur", "Jaynagar Majilpur", "Jhalda", "Jhargram", "Jiaganj‑Azimganj",
                    "Kaliaganj", "Kalimpong", "Kalna", "Kalyani", "Kamarhati", "Kanchrapara", "Kandi", "Katwa",
                    "Kharagpur", "Maheshtala", "Mainaguri", "Mal", "Midnapore", "Murshidabad", "Nabadwip",
                    "Naihati", "New Barrackpur", "North Barrackpur", "North Dumdum", "Old Malda", "Panskura",
                    "Panihati", "Pujali", "Purulia", "Raghunathpur", "Raiganj", "Rajpur Sonarpur",
                    "Ramjibanpur", "Rampurhat", "Ranaghat", "Rishra", "Sainthia", "Santipur", "Serampore",
                    "South Dumdum", "Suri", "Taki", "Tamluk", "Tarakeswar", "Titiksha",
                    "Bilandapur", "Chak Enayetnagar", "Chak Kashipur", "Chakdaha", "Chachanda", "Birlapur",
                    "Bowali", "Char Brahmanganj", "Char Majidia", "Kalaria", "Kulberia", "Chaltia", "Gopjan",
                    "Kasim Bazar", "Sibdanga Badarpur", "Banjetia", "Ajodhya Nagar", "Haridasmati",
                    "Gora Bazar", "Goaljan"

                ],
                "Delhi": ["New Delhi", "Dwarka", "Rohini", "Janakpuri", "Lajpat Nagar", "Karol Bagh",
                    "Connaught Place", "North Delhi", "South Delhi", "East Delhi", "West Delhi",
                    "Central Delhi", "Shahdara", "Pitampura", "Karol Bagh", "Lajpat Nagar", "Saket",
                    "Connaught Place", "Chanakyapuri", "Mayur Vihar", "Vasant Kunj", "Janakpuri",
                    "Rajouri Garden", "Laxmi Nagar", "Narela", "Okhla", "Badarpur", "Mehrauli", "Najafgarh",
                    "Ashok Vihar", "Burari", "Vikaspuri", "Tilak Nagar", "Jangpura", "Greater Kailash",
                    "Kalkaji", "Tughlakabad", "Dwarka Mor", "Uttam Nagar"
                ],
                "Jammu and Kashmir": ["Srinagar", "Jammu", "Anantnag", "Baramulla", "Udhampur", "Kathua",
                    "Sopore", "Kupwara", "Rajouri", "Poonch", "Pulwama", "Kulgam", "Budgam", "Bandipora",
                    "Ganderbal", "Reasi", "Handwara", "Doda", "Kishtwar", "Ramban", "Shopian", "Awantipora",
                    "Bijbehara", "Leh", "Kargil", "Akhnur", "Banihal", "Bhadarwah", "Batote", "Bari Brahmana",
                    "Qazigund", "Tral", "Charar-i-Sharief", "Thanamandi", "Uri", "Nowshera", "Chenani",
                    "Billawar", "Katra", "Verinag"
                ],
                "Ladakh": ["Leh", "Kargil", "Nubra", "Zanskar", "Diskit", "Hemis", "Padum", "Turtuk", "Drass",
                    "Tangtse", "Nyoma", "Hanle", "Chuchot", "Shey", "Spituk", "Lamayuru", "Basgo",
                ]
            },
            USA: {
                "Alabama": ["Birmingham", "Montgomery", "Mobile", "Huntsville", "Tuscaloosa", "Hoover", "Dothan",
                    "Auburn", "Decatur", "Madison", "Florence", "Gadsden", "Phenix City", "Enterprise",
                    "Vestavia Hills", "Prattville", "Alabaster", "Opelika", "Bessemer", "Homewood"
                ],
                "Alaska": ["Anchorage", "Fairbanks", "Juneau", "Sitka", "Ketchikan", "Wasilla", "Palmer", "Kenai",
                    "Kodiak", "Bethel", "Homer", "Nome", "Seward", "Valdez", "Barrow (Utqiaġvik)", "Petersburg",
                    "Wrangell", "Craig", "Cordova",
                ],
                "Arizona": ["Phoenix", "Tucson", "Mesa", "Chandler", "Glendale", "Scottsdale", "Gilbert", "Tempe",
                    "Peoria", "Surprise", "Yuma", "Flagstaff", "Prescott", "Sierra Vista", "Avondale",
                    "Goodyear", "Lake Havasu City", "Casa Grande", "Kingman", "Maricopa", "Nogales", "Show Low",
                    "Sedona", "Winslow", "Page",
                ],
                "Arkansas": ["Little Rock", "Fort Smith", "Fayetteville", "Springdale", "Jonesboro",
                    "North Little Rock", "Conway", "Rogers", "Bentonville", "Pine Bluff", "Hot Springs",
                    "Benton", "Texarkana", "Searcy", "Russellville", "Bella Vista", "Van Buren", "Cabot",
                    "El Dorado", "Paragould",
                ],
                "California": ["Los Angeles", "San Francisco", "San Diego", "San Jose", "Fresno", "Sacramento",
                    "Oakland", "Long Beach", "Bakersfield", "Anaheim", "Santa Ana", "Riverside", "Stockton",
                    "Irvine",
                    "Chula Vista", "Fremont", "Modesto", "San Bernardino", "Oxnard", "Fontana", "Moreno Valley",
                    "Huntington Beach", "Glendale", "Santa Clarita", "Garden Grove",
                ],
                "Colorado": ["Denver", "Colorado Springs", "Aurora", "Fort Collins", "Lakewood", "Thornton",
                    "Arvada", "Westminster", "Pueblo", "Greeley", "Boulder", "Longmont", "Castle Rock",
                    "Loveland", "Broomfield", "Grand Junction", "Commerce City", "Littleton", "Parker",
                    "Brighton",
                ],
                "Connecticut": ["Bridgeport", "New Haven", "Hartford", "Stamford", "Waterbury", "Norwalk",
                    "Danbury", "New Britain", "West Hartford", "Greenwich", "Manchester", "Meriden", "Bristol",
                    "Milford", "Middletown", "Shelton", "Torrington", "Stratford", "East Hartford", "Groton",
                ],
                "Delaware": ["Wilmington", "Dover", "Newark", "Middletown", "Smyrna", "Milford", "Seaford",
                    "Georgetown", "Elsmere", "New Castle", "Lewes", "Harrington", "Camden", "Claymont", "Bear",
                    "Millsboro", "Bridgeville", "Delmar",
                ],
                "Florida": ["Jacksonville", "Miami", "Tampa", "Orlando", "St. Petersburg", "Hialeah", "Tallahassee",
                    "Fort Lauderdale", "Port St. Lucie", "Cape Coral", "Pembroke Pines", "Hollywood",
                    "Gainesville", "Miramar", "Coral Springs", "Lehigh Acres", "Clearwater", "Palm Bay",
                    "Brandon", "West Palm Beach", "Lakeland", "Pompano Beach", "Deltona", "Boca Raton",
                    "Daytona Beach", "Ocala", "Sarasota", "Bonita Springs", "Panama City",
                ],
                "Georgia": ["Atlanta", "Augusta", "Columbus", "Macon", "Savannah", "Athens", "Sandy Springs",
                    "Roswell", "Johns Creek", "Albany", "Warner Robins", "Alpharetta", "Marietta", "Valdosta",
                    "Smyrna", "Dunwoody", "Peachtree City", "Gainesville", "Newnan", "Dalton", "Cartersville",
                    "Douglasville", "Statesboro", "Canton", "Rome",
                ],
                "Hawaii": ["Honolulu", "Pearl City", "Hilo", "Kailua", "Waipahu", "Kihei", "Kahului", "Lahaina",
                    "Wailuku", "Mililani Town", "Ewa Beach", "Makakilo", "Waimea", "Kapaʻa", "Līhue", "Hanalei",
                    "Volcano", "Pāhoa", "Hāna",
                ],
                "Idaho": ["Boise", "Nampa", "Meridian", "Idaho Falls", "Pocatello", "Caldwell", "Twin Falls",
                    "Coeur d'Alene", "Lewiston", "Moscow", "Rexburg", "Post Falls", "Eagle", "Kuna",
                    "Mountain Home", "Burley", "Ammon", "Chubbuck", "Hailey", "Sandpoint",
                ],
                "Illinois": ["Chicago", "Aurora", "Rockford", "Joliet", "Naperville", "Springfield", "Elgin",
                    "Peoria", "Champaign", "Waukegan", "Cicero", "Bloomington",
                    "Decatur", "Evanston", "Schaumburg", "Arlington Heights", "Bolingbrook", "Palatine",
                    "Skokie", "Des Plaines", "Orland Park", "Berwyn", "Tinley Park", "Oak Lawn", "Normal",
                ],
                "Indiana": ["Indianapolis", "Fort Wayne", "Evansville", "South Bend", "Carmel", "Bloomington",
                    "Lafayette", "Gary", "Fishers", "Muncie", "Terre Haute", "Noblesville", "Anderson",
                    "Elkhart", "Greenwood", "Mishawaka", "Jeffersonville", "Columbus", "Columbus", "Valparaiso",
                ],
                "Iowa": ["Des Moines", "Cedar Rapids", "Davenport", "Sioux City", "Waterloo", "Ames",
                    "West Des Moines", "Council Bluffs", "Ankeny", "Dubuque", "Urbandale", "Cedar Falls",
                    "Bettendorf", "Mason City", "Mason City", "Marshalltown", "Ottumwa", "Fort Dodge",
                    "Clinton", "Muscatine"
                ],
                "Kansas": ["Wichita", "Overland Park", "Kansas City", "Topeka", "Olathe", "Lawrence", "Shawnee",
                    "Manhattan", "Lenexa", "Salina", "Hutchinson", "Leavenworth", "Garden City", "Emporia",
                    "Emporia", "Dodge City", "Derby", "Newton", "Great Bend	",
                ],
                "Kentucky": ["Louisville", "Lexington", "Bowling Green", "Owensboro", "Covington", "Richmond",
                    "Florence", "Georgetown", "Hopkinsville", "Nicholasville", "Elizabethtown", "Henderson",
                    "Paducah", "Frankfort", "Ashland", "Berea", "Winchester", "Danville", "Madisonville",
                    "Murray"
                ],
                "Louisiana": ["New Orleans", "Baton Rouge", "Shreveport", "Lafayette", "Lake Charles", "Kenner",
                    "Bossier City", "Monroe", "Alexandria", "Houma", "Slidell", "Central", "Ruston",
                    "Natchitoches", "Opelousas", "Zachary", "Thibodaux", "Gretna", "Morgan City", "Hammond",
                ],
                "Maine": ["Portland", "Lewiston", "Bangor", "South Portland", "Auburn", "Biddeford", "Sanford",
                    "Saco", "Westbrook", "Augusta", "Waterville", "Brunswick", "Scarborough", "Orono", "Bath",
                    "Presque Isle", "Ellsworth", "York", "Old Town", "Camden"
                ],
                "Maryland": ["Baltimore", "Frederick", "Rockville", "Gaithersburg", "Bowie", "Hagerstown",
                    "Annapolis", "Salisbury", "Laurel", "Greenbelt", "Germantown", "Bel Air", "Bel Air",
                    "Cumberland", "Takoma Park", "Ellicott City", "Waldorf", "Hyattsville", "Mount Airy",
                    "Ocean City",
                ],
                "Massachusetts": ["Boston", "Worcester", "Springfield", "Lowell", "Cambridge", "Lowell", "Brockton",
                    "New Bedford", "Quincy", "Lynn", "Fall River", "Newton", "Somerville", "Framingham",
                    "Lawrence", "Medford", "Waltham", "Malden", "Chelsea", "Revere", "Peabody", "Pittsfield",
                    "Holyoke", "Beverly", "Attleboro",
                ],
                "Michigan": ["Detroit", "Grand Rapids", "Warren", "Sterling Heights", "Lansing", "Flint",
                    "Dearborn", "Livonia", "Troy", "Westland", "Farmington Hills", "Kalamazoo", "Wyoming",
                    "Southfield", "Rochester Hills", "Taylor", "Pontiac", "Novi", "Royal Oak", "Saginaw",
                    "Muskegon", "Ypsilanti", "Battle Creek", "Portage", "East Lansing", "Traverse City",
                    "Jackson", "Midland", "Holland", "Mount Pleasant",
                ],
                "Minnesota": ["Minneapolis", "Saint Paul", "Rochester", "Duluth", "Bloomington", "Brooklyn Park",
                    "Plymouth", "Maple Grove", "Woodbury", "St. Cloud", "Eagan", "Blaine", "Lakeville",
                    "Coon Rapids", "Eden Prairie", "Burnsville", "Apple Valley", "Minnetonka", "Edina",
                    "Inver Grove Heights", "Mankato", "Savage", "Shakopee"
                ],
                "Mississippi": ["Jackson", "Gulfport", "Southaven", "Hattiesburg", "Biloxi", "Meridian", "Tupelo",
                    "Olive Branch", "Greenville", "Horn Lake", "Pearl", "Madison", "Starkville", "Clinton",
                    "Brandon", "Vicksburg", "Columbus", "Pascagoula", "Laurel", "Ridgeland"
                ],
                "Missouri": ["Kansas City", "Saint Louis", "Springfield", "Independence", "Columbia",
                    "Lee's Summit", "O'Fallon", "St. Joseph", "St. Charles", "Blue Springs", "Blue Springs",
                    "Florissant", "Joplin", "Chesterfield", "Jefferson City", "Wentzville", "Ballwin",
                    "Raytown", "Gladstone", "Kirkwood", "Maryville",
                ],
                "Montana": ["Billings", "Missoula", "Great Falls", "Bozeman", "Butte", "Helena", "Kalispell",
                    "Havre", "Miles City", "Miles City", "Belgrade", "Livingston", "Laurel", "Whitefish",
                    "Sidney", "Lewistown", "Columbia Falls", "Glendive", "Polson", "Libby", "Deer Lodge"
                ],
                "Nebraska": ["Omaha", "Lincoln", "Bellevue", "Grand Island", "Kearney", "Fremont", "Hastings",
                    "North Platte", "Norfolk", "Columbus", "Papillion", "La Vista", "Scottsbluff",
                    "South Sioux City", "Beatrice", "Lexington", "Alliance", "Gering", "York", "McCook"
                ],
                "Nevada": ["Las Vegas", "Henderson", "Reno", "North Las Vegas", "Sparks", "Carson City", "Elko",
                    "Mesquite", "Boulder City", "Fernley", "Pahrump", "Fallon", "Winnemucca", "Ely",
                    "Incline Village", "Laughlin", "Yerington", "Battle Mountain", "Tonopah", "Caliente"
                ],
                "New Hampshire": ["Manchester", "Nashua", "Concord", "Derry", "Rochester", "Keene", "Portsmouth",
                    "Laconia", "Lebanon", "Claremont", "Somersworth", "Berlin", "Hanover",
                    "Exeter", "Milford", "Franklin", "Raymond", "Goffstown", "Plymouth"
                ],
                "New Jersey": ["Newark", "Jersey City", "Paterson", "Elizabeth", "Edison", "Woodbridge", "Lakewood",
                    "Toms River", "Hamilton", "Trenton", "Clifton", "Camden", "Brick", "Cherry Hill", "Passaic",
                    "Union City", "Bayonne", "East Orange", "Hackensack", "Atlantic City"
                ],
                "New Mexico": ["Albuquerque", "Las Cruces", "Rio Rancho", "Santa Fe", "Roswell", "Farmington",
                    "Clovis", "Hobbs", "Alamogordo", "Carlsbad", "Gallup", "Los Lunas", "Deming", "Grants",
                    "Artesia", "Silver City", "Lovington", "Ruidoso", "Socorro", "Espanola"
                ],
                "New York": ["New York City", "Buffalo", "Rochester", "Yonkers", "Syracuse", "Albany",
                    "New Rochelle", "Mount Vernon", "Schenectady", "Utica", "White Plains", "Troy",
                    "Binghamton", "Ithaca", "Niagara Falls", "Poughkeepsie", "Jamestown", "Rome", "Elmira",
                    "Kingston", "Saratoga Springs", "Beacon", "Middletown", "Glens Falls"
                ],
                "North Carolina": ["Charlotte", "Raleigh", "Greensboro", "Durham", "Winston-Salem", "Cary",
                    "High Point", "Greenville", "Asheville", "Concord", "Gastonia", "Jacksonville",
                    "Jacksonville", "Chapel Hill", "Rocky Mount", "Huntersville", "Apex", "Burlington",
                    "Kannapolis"
                ],
                "North Dakota": ["Fargo", "Bismarck", "Grand Forks", "Minot", "West Fargo", "Williston",
                    "Dickinson", "Mandan", "Jamestown", "Wahpeton", "Devils Lake", "Valley City", "Grafton",
                    "Bottineau", "Beulah", "Rugby", "Horace", "Lincoln", "Carrington", "Stanley"
                ],
                "Ohio": ["Columbus", "Cleveland", "Cincinnati", "Toledo", "Akron", "Dayton", "Canton", "Youngstown",
                    "Lorain", "Parma", "Hamilton", "Kettering", "Elyria", "Lakewood", "Cuyahoga Falls",
                    "Mansfield", "Dublin", "Beavercreek", "Delaware", "Marion",
                ],
                "Oklahoma": ["Oklahoma City", "Tulsa", "Norman", "Broken Arrow", "Lawton", "Edmond", "Moore",
                    "Midwest City", "Enid", "Stillwater", "Muskogee", "Bartlesville", "Shawnee", "Owasso",
                    "Ponca City", "Ardmore", "Duncan", "Sapulpa", "Bixby", "Bixby",
                ],
                "Oregon": ["Portland", "Eugene", "Salem", "Gresham", "Hillsboro", "Beaverton", "Bend", "Medford",
                    "Springfield", "Corvallis", "Albany", "Tigard", "Lake Oswego", "Keizer", "Grants Pass",
                    "Oregon City", "Redmond", "Milwaukie", "Tualatin", "Newberg",
                ],
                "Pennsylvania": ["Philadelphia", "Pittsburgh", "Allentown", "Erie", "Reading", "Scranton",
                    "Bethlehem", "Lancaster", "Harrisburg", "York", "State College", "Wilkes-Barre", "Altoona",
                    "Chester", "Johnstown", "Johnstown", "Easton", "Lebanon", "Hazleton", "Williamsport",
                    "New Castle",
                ],
                "Rhode Island": ["Providence", "Warwick", "Cranston", "Pawtucket", "East Providence", "Woonsocket",
                    "Newport", "Central Falls", "Westerly", "North Providence", "Coventry", "Johnston",
                    "Lincoln", "Barrington", "Smithfield", "Smithfield", "Narragansett", "Bristol",
                    "South Kingstown", "North Kingstown",
                ],
                "South Carolina": ["Charleston", "Columbia", "North Charleston", "Mount Pleasant", "Rock Hill",
                    "Greenville", "Summerville", "Sumter", "Florence", "Spartanburg", "Goose Creek",
                    "Hilton Head Island", "Hilton Head Island", "Myrtle Beach", "Anderson", "Greer", "Aiken",
                    "Easley", "Conway", "West Columbia", "Mauldin"
                ],
                "South Dakota": ["Sioux Falls", "Rapid City", "Aberdeen", "Brookings", "Watertown", "Mitchell",
                    "Yankton", "Pierre", "Huron", "Vermillion", "Spearfish", "Box Elder", "Brandon", "Sturgis",
                    "Madison", "Belle Fourche", "Tea", "Canton", "Hot Springs", "Dell Rapids"
                ],
                "Tennessee": ["Nashville", "Memphis", "Knoxville", "Chattanooga", "Clarksville", "Murfreesboro",
                    "Franklin", "Johnson City", "Jackson", "Bartlett", "Hendersonville", "Kingsport",
                    "Collierville", "Smyrna", "Cleveland", "Brentwood", "Cookeville", "Gallatin", "La Vergne",
                    "Germantown", "Oak Ridge", "Spring Hill", "Columbia", "Tullahoma", "Morristown"
                ],
                "Texas": ["Houston", "Dallas", "San Antonio", "Austin", "Fort Worth", "El Paso", "Arlington",
                    "Corpus Christi", "Plano", "Lubbock", "Laredo", "Irving", "Garland", "Frisco", "McKinney",
                    "Amarillo", "Grand Prairie", "Brownsville", "Killeen", "Pasadena", "Mesquite", "Midland",
                    "Waco", "Carrollton", "Denton", "Beaumont", "Odessa", "Round Rock", "Abilene",
                    "College Station"
                ],
                "Utah": ["Salt Lake City", "West Valley City", "Provo", "West Jordan", "Orem", "Sandy", "Ogden",
                    "St. George", "Layton", "Taylorsville", "South Jordan", "Lehi", "Logan", "Murray", "Draper",
                    "Bountiful", "Herriman", "Tooele", "Cedar City", "Spanish Fork"
                ],
                "Vermont": ["Burlington", "Essex", "South Burlington", "Colchester", "Rutland", "Barre",
                    "Montpelier", "St. Albans", "Winooski", "Brattleboro", "Bennington", "Middlebury",
                    "Newport", "St. Johnsbury", "Springfield", "Springfield", "Vergennes", "Hartford", "Milton",
                    "Shelburne"
                ],
                "Virginia": ["Virginia Beach", "Norfolk", "Chesapeake", "Richmond", "Newport News", "Alexandria",
                    "Hampton", "Roanoke",
                    "Portsmouth", "Suffolk",
                    "Lynchburg", "Harrisonburg", "Charlottesville", "Danville", "Blacksburg", "Manassas",
                    "Petersburg", "Winchester", "Leesburg", "Fairfax", "Falls Church", "Waynesboro",
                    "Martinsville", "Colonial Heights"
                ],
                "Washington": ["Seattle", "Spokane", "Tacoma", "Vancouver", "Bellevue", "Everett", "Kent", "Yakima",
                    "Yakima", "Renton", "Spokane Valley", "Federal Way", "Bellingham", "Kennewick", "Auburn",
                    "Pasco", "Richland", "Marysville", "Lakewood", "Redmond", "Shoreline", "Lacey", "Olympia",
                    "Mount Vernon", "Walla Walla"
                ],
                "West Virginia": ["Charleston", "Huntington", "Parkersburg", "Morgantown", "Wheeling", "Weirton",
                    "Fairmont", "Beckley", "Martinsburg", "Clarksburg", "Bluefield", "Elkins", "Princeton",
                    "Bridgeport", "South Charleston",
                    "Nitro", "St.Albans", "Ripley", "Lewisburg", "Summersville",
                ],
                "Wisconsin": ["Milwaukee", "Madison", "Green Bay", "Kenosha", "Racine", "Appleton", "Waukesha",
                    "Oshkosh", "Eau Claire", "Janesville", "West Allis", "La Crosse", "Sheboygan", "Wausau",
                    "Fond du Lac", "Brookfield", "New Berlin", "Beloit", "Menomonee Falls", "Manitowoc",
                    "Superior",
                    "Stevens Point", "Franklin", "Mount Pleasant",
                ],
                "Wyoming": ["Cheyenne", "Casper", "Laramie", "Gillette", "Rock Springs", "Sheridan", "Green River",
                    "Evanston", "Riverton", "Jackson", "Cody", "Rawlins", "Douglas", "Buffalo", "Torrington",
                    "Worland", "Thermopolis", "Lander", "Newcastle", "Powell"
                ],
            },
            UK: {
                "England": ["London", "Manchester", "Liverpool", "Birmingham", "Leeds", "Sheffield", "Bristol",
                    "Newcastle", "Nottingham", "Leicester", "Coventry", "Bradford", "Brighton", "Hull",
                    "Plymouth", "Southampton", "Portsmouth", "Derby", "Stoke-on-Trent", "Wolverhampton", "York",
                    "Cambridge", "Oxford", "Bath", "Exeter", "Canterbury", "Lancaster", "Chester", "Durham",
                    "Sunderland",
                ],
                "Scotland": ["Edinburgh", "Glasgow", "Aberdeen", "Dundee", "Stirling", "Perth", "Ayr", "Falkirk",
                    "Paisley", "Kirkcaldy", "East Kilbride", "Livingston", "Dumfries", "Motherwell",
                    "Cumbernauld", "Greenock", "Arbroath", "Elgin", "Oban"
                ],
                "Wales": ["Cardiff", "Swansea", "Newport", "Wrexham", "Barry", "Caerphilly", "Bangor", "St Davids",
                    "Aberystwyth", "Llandudno", "Caernarfon", "Conwy", "Rhyl", "Colwyn Bay", "Merthyr Tydfil",
                    "Pontypridd", "Carmarthen", "Llanelli", "Neath", "Bridgend", "Holyhead", "Haverfordwest",
                ],
                "Northern Ireland": ["Belfast", "Londonderry", "Lisburn", "Newtownabbey", "Bangor", "Craigavon",
                    "Armagh", "Antrim", "Ballymena", "Coleraine", "Carrickfergus", "Newtownabbey",
                    "Enniskillen", "Omagh", "Cookstown", "Banbridge", "Dungannon", "Larne", "Strabane"
                ]
            },
            UAE: {
                "Abu Dhabi": ["Abu Dhabi City", "Al Ain", "Ruwais", "Liwa", "Madinat Zayed", "Ghayathi",
                    "Liwa Oasis", "Mirfa", "Sila", "Bani Yas", "Shahama", "Mussafah", "Khalifa City",
                    "Mohammed Bin Zayed City", "Al Reef", "Al Falah", "Yas Island", "Saadiyat Island",
                    "Reem Island"
                ],
                "Dubai": ["Dubai City", "Deira", "Bur Dubai", "Jumeirah", "Marina", "Downtown Dubai",
                    "Palm Jumeirah", "Jumeirah Beach Residence (JBR)", "Business Bay", "Al Barsha", "Al Quoz",
                    "Dubai Silicon Oasis", "Dubai Investment Park", "Mirdif", "Dubai International City",
                    "Arabian Ranches", "The Springs", "The Meadows", "Jumeirah Village Circle (JVC)",
                    "Jumeirah Lakes Towers (JLT)", "Al Nahda", "Satwa", "Umm Suqeim", "Al Safa", "Al Rashidiya",
                ],
                "Sharjah": ["Sharjah City", "Khorfakkan", "Kalba", "Dibba Al-Hisn", "Al Dhaid", "Al Madam",
                    "Al Bataeh", "Mleiha", "Hamriyah", "Al Nahda, Sharjah", "Muwaileh", "Al Qasimia ", "Al Majaz ",
                    "Al Khan",
                    "Al Taawun", "Al Layyah"
                ],
                "Ajman": ["Ajman City", "Manama", "Masfout", "Al Jurf", "Al Nuaimiya", "Al Rashidiya",
                    "Al Mowaihat", "Ajman Industrial Area", "Helio", "Al Hamidiya", "Ajman Free Zone",
                ],
                "Ras Al Khaimah": ["Ras Al Khaimah City", "Rams", "Dhayah", "Al Jazirah Al Hamra", "Khatt",
                    "Masafi", "Al Ghail", "Digdaga", "Al Hamra Village", "Julphar", "Sha'am", "Al Qusaidat",
                    "Al Dhait", "Mina Al Arab", "Al Uraibi", "Ghalilah"
                ],
                "Fujairah": ["Fujairah City", "Dibba", "Qidfa", "Mirbah", "Masafi", "Al Bidiyah", "Al Faqeet",
                    "Gurfah", "Sakamkam", "Al Hala", "Rughaylat", "Al Aqah", "Thuban"
                ],
                "Umm Al Quwain": ["Umm Al Quwain City", "Falaj Al Mualla", "Al Rafaah", "Al Salamah", "Al Haditha",
                    "Al Abraq", "Al Dar Al Baida", "Al Maqtaa", "Al Khor", "Al Humrah", "Al Raas",
                ]
            },
            SG: {
                "Central Region": ["Downtown Core", "Museum", "Newton", "Orchard", "Outram", "River Valley",
                    "Bukit Merah", "Queenstown", "Bishan", "Toa Payoh", "Novena", "Kallang", "Rochor",
                    "Tanglin", "Marine Parade", "Museum Planning Area", "Singapore River",
                ],
                "East Region": ["Bedok", "Changi", "Pasir Ris", "Tampines", "Changi", "Simei", "Loyang",
                    "East Coast", "Kaki Bukit", "Upper Changi", "Expo Area",
                ],
                "North Region": ["Sembawang", "Simpang", "Woodlands", "Yishun", "Canberra", "Admiralty",
                    "Marsiling", "Mandai", "Springleaf", "Kranji", "Sungei Kadut", "Yew Tee"
                ],
                "Northeast Region": ["Ang Mo Kio", "Hougang", "Punggol", "Sengkang", "Serangoon", "Seletar",
                    "Buangkok", "Kovan", "Lorong Chuan", "Compassvale", "Anchorvale", "Rivervale", "Fernvale",
                    "Punggol East", "Punggol North", "Punggol West", "Hougang Central", "Kangkar", "Defu",
                    "Serangoon North", "Rosyth", "Charlton", "Yio Chu Kang", "Jalan Kayu",
                    "Seletar Aerospace Park", "Sengkang West", "Lorong Halus", "Coney Island"
                ],
                "West Region": ["Boon Lay", "Bukit Batok", "Bukit Panj",
                    "Al Khan", "ang", "Choa Chu Kang", "Clementi", "Jurong East",
                    "Jurong West", "Tuas", "Tengah", "Pioneer", "Teban Gardens", "West Coast", "Dover",
                    "Nanyang", "Hillview", "Toh Guan",
                ]
            },
            CN: {
                "Beijing": ["Dongcheng", "Xicheng", "Chaoyang", "Fengtai", "Shijingshan", "Haidian",
                    "Tongzhou District", "Daxing District", "Changping  District", "Shunyi District",
                    "Mentougou District", "Fangshan District", "Pinggu District", "Huairou District",
                    "Miyun District", "Yanqing District"
                ],
                "Shanghai": ["Huangpu", "Xuhui", "Changning", "Jing'an", "Putuo", "Hongkou", "Yangpu District",
                    "Minhang District", "Baoshan District", "Pudong New Area", "Jiading District",
                    "Jinshan District", "Songjiang District", "Qingpu District", "Fengxian District",
                    "Chongming District"
                ],
                "Guangdong": ["Guangzhou", "Shenzhen", "Dongguan", "Foshan", "Zhongshan", "Zhuhai", "Jiangmen",
                    "Huizhou", "Zhaoqing", "Shaoguan", "Heyuan", "Meizhou", "Shantou", "Shantou", "Jieyang",
                    "Maoming", "Yangjiang", "Zhanjiang", "Yunfu", "Qingyuan"
                ],
                "Jiangsu": ["Nanjing", "Suzhou", "Wuxi", "Changzhou", "Nantong", "Xuzhou", "Zhenjiang", "Yangzhou",
                    "Nantong", "Taizhou", "Yancheng", "Huai'an", "Lianyungang", "Suqian"
                ],
                "Zhejiang": ["Hangzhou", "Ningbo", "Wenzhou", "Jiaxing", "Huzhou", "Shaoxing", "Jinhua", "Quzhou",
                    "Zhoushan", "Taizhou", "Lishui", "Yiwu", "Yueqing", "Cixi", "Yuyao", "Tongxiang", "Haining",
                    "Lin'an", "Fuyang", "Wenling", "Luqiao", "Dongyang", "Lanxi", "Longquan", "Rui'an",
                    "Pinghu", "Changxing", "Deqing", "Anji", "Sanmen", "Xinchang", "Tiantai", "Xianju",
                    "Jingning", "Qingtian", "Wuyi",
                ],
                "Shandong": ["Jinan", "Qingdao", "Zibo", "Zaozhuang", "Dongying", "Yantai", "Dezhou", "Dongying",
                    "Heze", "Jining", "Liaocheng", "Rizhao", "Taian", "Weifang", "Binzhou", "Zaozhuang",
                    "Laixi", "Laizhou", "Penglai", "Qixia"
                ],
                "Henan": ["Zhengzhou", "Kaifeng", "Luoyang", "Pingdingshan", "Anyang", "Hebi", "Xinxiang",
                    "Nanyang", "Xinyang", "Shangqiu", "Zhoukou", "Zhumadian", "Sanmenxia", "Hebi", "Jiaozuo",
                    "Puyang", "Luohe", "Pingdingshan",
                ],
                "Sichuan": ["Chengdu", "Zigong", "Panzhihua", "Luzhou", "Deyang", "Mianyang", "Luzhou", "Neijiang",
                    "Leshan", "Nanchong", "Yibin", "Guang'an", "Suining", "Meishan", "Ziyang", "Bazhong",
                    "Dazhou",
                    "Ya'an", "Aba Tibetan and Qiang Autonomous Prefecture",
                    "Ganzi Tibetan Autonomous Prefecture", "Liangshan Yi Autonomous Prefecture"
                ]
            },
            JP: {
                "Tokyo": ["Shibuya", "Shinjuku", "Harajuku", "Ginza", "Akihabara", "Roppongi", "Adachi", "Arakawa",
                    "Bunkyō", "Chiyoda", "Chūō", "Edogawa", "Itabashi", "Katsushika", "Kita", "Kōtō", "Meguro",
                    "Minato", "Nakano", "Nerima", "Ōta", "Setagaya", "Shinagawa", "Suginami", "Sumida", "Taitō"
                ],
                "Osaka": ["Osaka City", "Sakai", "Higashiosaka", "Hirakata", "Toyonaka", "Takatsuki", "Ibaraki",
                    "Suita", "Kadoma", "Moriguchi", "Hirakata", "Yao", "Kishiwada", "Izumi", "Izumisano",
                    "Kawachinagano", "Tondabayashi", "Daitō", "Kashiwara", "Habikino", "Matsubara", "Sennan",
                    "Kaizuka", "Shijōnawate"
                ],
                "Kyoto": ["Kyoto City", "Uji", "Kameoka", "Joyo", "Mukō", "Maizuru", "Fukuchiyama", "Miyazu",
                    "Nagaokakyō", "Yawata", "Kyōtanabe", "Kyōtango", "Muko", "Nantan"
                ],
                "Kanagawa": ["Yokohama", "Kawasaki", "Sagamihara", "Fujisawa", "Chigasaki", "Kamakura", "Zushi",
                    "Odawara", "Atsugi", "Ebina", "Isehara", "Hadano", "Hadano", "Yamato", "Ayase", "Miura",
                    "Minamiashigara", "Kōza District"
                ],
                "Aichi": ["Nagoya", "Toyohashi", "Okazaki", "Ichinomiya", "Seto", "Toyota", "Kasugai", "Toyokawa",
                    "Anjō", "Kariya", "Handa", "Tōkai", "Inazawa", "Komaki", "Inuyama", "Tokoname", "Nisshin",
                    "Owariasahi", "Konan", "Chita", "Takahama", "Aisai", "Tōgō", "Nagakute", "Shinshiro",
                    "Agui", "Obu", "Ama",
                    "Gamagōri"
                ],
                "Hokkaido": ["Sapporo", "Asahikawa", "Hakodate", "Kushiro", "Tomakomai", "Obihiro", "Otaru",
                    "Kitami", "Ebetsu", "Chitose", "Iwamizawa", "Muroran", "Abashiri", "Wakkanai", "Nayoro",
                    "Biei", "Furano", "Shibetsu", "Rumoi", "Bibai", "Nemuro", "Tōbetsu", "Yubari", "Monbetsu"
                ]
            },
            DE: {
                "Bavaria": ["Munich", "Nuremberg", "Augsburg", "Würzburg", "Regensburg", "Ingolstadt", "Fürth",
                    "Erlangen", "Bamberg", "Bayreuth", "Aschaffenburg", "Landshut", "Amberg", "Kempten",
                    "Rosenheim", "Coburg", "Passau", "Schweinfurt", "Weiden in der Oberpfalz", "Deggendorf",
                    "Freising",
                ],
                "North Rhine-Westphalia": ["Cologne", "Düsseldorf", "Dortmund", "Essen", "Duisburg"],
                "Baden-Württemberg": ["Stuttgart", "Mannheim", "Karlsruhe", "Freiburg", "Heidelberg", "Cologne",
                    "Düsseldorf", "Dortmund", "Essen", "Duisburg", "Bochum", "Wuppertal", "Bielefeld", "Bonn",
                    "Münster", "Aachen", "Gelsenkirchen", "Mönchengladbach", "Krefeld", "Leverkusen", "Siegen",
                    "Paderborn", "Herne", "Hagen", "Remscheid", "Oberhausen", "Recklinghausen", "Solingen",
                    "Witten", "Lüdenscheid",
                ],
                "Lower Saxony": ["Hanover", "Braunschweig", "Oldenburg", "Osnabrück", "Wolfsburg", "Göttingen",
                    "Lüneburg", "Celle", "Emden", "Delmenhorst", "Cuxhaven", "Wilhelmshaven", "Aurich",
                    "Nordhorn", "Stade", "Hameln", "Verden (Aller)", "Peine",
                ],
                "Hesse": ["Frankfurt", "Wiesbaden", "Kassel", "Darmstadt", "Offenbach", "Hanau", "Gießen",
                    "Marburg", "Fulda", "Limburg an der Lahn", "Wetzlar", "Bad Homburg", "Rüsselsheim",
                    "Baunatal", "Butzbach", "Bensheim", "Bad Hersfeld", "Bad Nauheim"
                ],
                "Berlin": ["Mitte", "Charlottenburg", "Spandau", "Tempelhof", "Neukölln", "Friedrichshain",
                    "Kreuzberg", "Pankow", "Tempelhof-Schöneberg", "Tempelhof-Schöneberg",
                    "Marzahn-Hellersdorf", "Reinickendorf", "Steglitz-Zehlendorf"
                ]
            },
            FR: {
                "Île-de-France": ["Paris", "Boulogne-Billancourt", "Saint-Denis", "Argenteuil", "Montreuil",
                    "Versailles", "Nanterre", "Créteil", "Courbevoie", "Courbevoie", "Colombes",
                    "Asnières-sur-Seine", "Levallois-Perret", "Neuilly-sur-Seine", "Argenteuil",
                    "Rueil-Malmaison", "Montreuil", "Aulnay-sous-Bois", "Antony", "Cergy", "Suresnes",
                    "Maisons-Alfort",
                ],
                "Provence-Alpes-Côte d'Azur": ["Marseille", "Nice", "Toulon", "Aix-en-Provence", "Avignon",
                    "Cannes", "Antibes", "Arles", "Grasse", "Fréjus", "Salon-de-Provence", "La Seyne-sur-Mer",
                    "Hyères", "Menton", "Gap", "Manosque", "Draguignan", "Briançon", "Cavaillon",
                    "Digne-les-Bains"
                ],
                "Auvergne-Rhône-Alpes": ["Lyon", "Saint-Étienne", "Grenoble", "Villeurbanne", "Clermont-Ferrand",
                    "Chambéry", "Annecy", "Valence", "Vienne", "Le Puy-en-Velay", "Thonon-les-Bains",
                    "Villeurbanne", "Roanne", "Montluçon", "Aurillac", "Albertville", "Bourg-en-Bresse",
                    "Annemasse", "Moulins", "Oyonnax", "Issoire",
                ],
                "Nouvelle-Aquitaine": ["Bordeaux", "Limoges", "Poitiers", "Pau", "La Rochelle", "Angoulême",
                    "Périgueux", "Bayonne", "Biarritz", "Brive-la-Gaillarde", "Bergerac", "Saintes", "Niort",
                    "Marmande", "Rochefort", "Guéret", "Arcachon", "Cognac", "Oloron-Sainte-Marie", "Libourne"
                ],
                "Occitanie": ["Toulouse", "Montpellier", "Nîmes", "Perpignan", "Béziers", "Carcassonne", "Albi",
                    "Tarbes", "Rodez", "Mende", "Castres", "Sète", "Colomiers", "Blagnac", "AgdeAgde",
                    "Narbonne", "Foix", "Lourdes", "Auch", "Millau"
                ],
                "Hauts-de-France": ["Lille", "Amiens", "Tourcoing", "Roubaix", "Dunkirk", "Calais",
                    "Dunkerque (Dunkirk)", "Roubaix", "Tourcoing", "Arras", "Boulogne-sur-Mer", "Saint-Quentin",
                    "Lens", "Beauvais", "Compiègne", "Cambrai", "Maubeuge", "Soissons", "Creil", "Abbeville",
                    "Laon", "Montreuil-sur-Mer", "Douai"
                ],
            },
            AU: {
                "New South Wales": ["Sydney", "Newcastle", "Wollongong", "Maitland", "Albury", "Wagga Wagga",
                    "Wagga Wagga", "Coffs Harbour", "Tamworth", "Port Macquarie", "Dubbo", "Orange", "Bathurst",
                    "Lismore", "Goulburn", "Nowra", "Armidale", "Griffith", "Tweed Heads", "Tweed Heads",
                    "Broken Hill", "Queanbeyan"
                ],
                "Victoria": ["Melbourne", "Geelong", "Ballarat", "Bendigo", "Shepparton", "Mildura", "Warrnambool",
                    "Traralgon", "Wodonga", "Wangaratta", "Sale", "Bairnsdale", "Moe", "Morwell", "Horsham",
                    "Colac", "Leongatha", "Portland", "Maryboroug", "Benalla"
                ],
                "Queensland": ["Brisbane", "Gold Coast", "Townsville", "Cairns", "Toowoomba", "Mackay",
                    "Rockhampton", "Bundaberg", "Hervey Bay", "Gladstone", "Mount Isa", "Roma", "Emerald",
                    "Maryborough", "Gympie", "Warwick", "Goondiwindi", "Innisfail", "Charters Towers"
                ],
                "Western Australia": ["Perth", "Fremantle", "Rockingham", "Mandurah", "Bunbury", "Albany",
                    "Kalgoorlie", "Broome", "Geraldton", "Esperance", "Karratha", "Port Hedland", "Busselton",
                    "Margaret River", "Exmouth", "Carnarvon", "Derby", "Kununurra", "Northam", "Dunsborough",
                    "Collie"
                ],
                "South Australia": ["Adelaide", "Mount Gambier", "Whyalla", "Murray Bridge", "Port Lincoln",
                    "Port Pirie", "Gawler", "Murray Bridge", "Victor Harbor", "Port Lincoln", "Port Elliot",
                    "Roxby Downs", "Coober Pedy", "Clare", "Naracoorte", "Berri", "Loxton", "Kadina",
                    "Wallaroo", "Tanunda", "Renmark"
                ],
                "Tasmania": ["Hobart", "Launceston", "Devonport", "Burnie", "Ulverstone", "Glenorchy", "Kingston",
                    "New Norfolk", "Huonville", "George Town", "Sorell", "Wynyard", "Smithton", "Scottsdale",
                    "Queenstown", "Zeehan", "Deloraine", "St Helens", "Bicheno", "Orford"
                ],
                "Australian Capital Territory": ["Canberra", "Queanbeyan", "Gungahlin", "Tuggeranong", "Belconnen",
                    "Woden Valley", "Weston Creek", "Molonglo Valley", "Inner North", "Inner South", "Hall",
                    "Tharwa", "Majura", "Pialligo", "Fyshwick", "Greenway", "Calwell", "Kaleen", "Ngunnawal",
                    "Charnwood"
                ],
                "Northern Territory": ["Darwin", "Alice Springs", "Palmerston", "Katherine", "Nhulunbuy", "Yulara",
                    "Jabiru", "Batchelor", "Howard Springs", "Humpty Doo", "Wadeye", "Maningrida", "Gunbalanya",
                    "Galiwin'ku", "Nauiyu", "Borroloola", "Timber Creek", "Barunga", "Milingimbi"
                ]
            },
            Brazil: {
                "São Paulo": ["São Paulo", "Guarulhos", "Campinas", "São Bernardo do Campo", "Santo André",
                    "Ribeirão Preto", "Sorocaba", "Santo André", "Osasco", "Barueri", "Taubaté",
                    "Mogi das Cruzes", "Bauru", "Piracicaba", "Jundiaí", "Franca", "Marília", "Itu",
                    "Caraguatatuba", "Ilhabela", "Praia Grande", "São Vicente", "Suzano", "Bragança Paulista"
                ],
                "Rio de Janeiro": ["Rio de Janeiro", "São Gonçalo", "Duque de Caxias", "Nova Iguaçu", "Niterói",
                    "Petrópolis", "Teresópolis", "Volta Redonda", "Barra Mansa", "Campos dos Goytacazes",
                    "Macaé", "Cabo Frio", "Angra dos Reis", "Resende", "Itaboraí", "Belford Roxo", "Queimados",
                    "Mesquita", "Nilópolis", "Paraty", "Rio das Ostras", "Saquarema", "Arraial do Cabo",
                    "Nova Friburgo", "Miguel Pereira"
                ],
                "Minas Gerais": ["Belo Horizonte", "Uberlândia", "Contagem", "Juiz de Fora", "Betim",
                    "Montes Claros", "Uberaba", "Governador Valadares", "Divinópolis", "Ipatinga",
                    "Teófilo Otoni", "Sete Lagoas", "Patos de Minas", "Varginha", "Poços de Caldas",
                    "Barbacena", "Itabira", "Sabará", "Ouro Preto", "Mariana", "Lavras", "Araxá",
                    "São João del-Rei", "Diamantina", "Congonhas",
                ],
                "Bahia": ["Salvador", "Feira de Santana", "Vitória da Conquista", "Camaçari", "Juazeiro",
                    "Barreiras", "Alagoinhas", "Lauro de Freitas", "Teixeira de Freitas", "Jequié",
                    "Paulo Afonso", "Paulo Afonso", "Eunápolis", "Simões Filho", "Santo Antônio de Jesus",
                    "Guanambi", "Jacobina", "Itapetinga", "Irecê", "Valença", "Porto Seguro",
                    "Senhor do Bonfim", "Cruz das Almas"
                ],
                "Paraná": ["Curitiba", "Londrina", "Maringá", "Ponta Grossa", "Cascavel", "São José dos Pinhais",
                    "Foz do Iguaçu", "Colombo", "Guarapuava", "Paranaguá", "Toledo", "Araucária", "Campo Largo",
                    "Apucarana", "Arapongas", "Cambé", "Rolândia", "Sarandi", "Umuarama", "Palmas",
                    "Francisco Beltrão", "Pinhais", "Cianorte"
                ],
                "Rio Grande do Sul": ["Porto Alegre", "Caxias do Sul", "Pelotas", "Canoas", "Santa Maria",
                    "Gravataí", "Viamão", "Novo Hamburgo", "São Leopoldo", "Passo Fundo", "Rio Grande", "Bagé",
                    "Uruguaiana", "Bento Gonçalves", "Santa Cruz do Sul", "Alvorada", "Erechim",
                    "Sapucaia do Sul", "Esteio", "Guaíba", "Lajeado", "Ijuí", "Cachoeirinha", "Farroupilha",
                ]
            },
            RU: {
                "Moscow": ["Moscow City", "Zelenograd", "Troitsk", "Shcherbinka", "Tverskoy District",
                    "Arbat District", "Zamoskvorechye District", "Khamovniki District", "Presnensky District",
                    "Basmanny District", "Yakimanka District", "Tagansky District", "Krylatskoye", "Strogino",
                    "Fili-Davydkovo", "Butovo District", "Zelenograd",
                    "Novokosino", "Kuzminki",
                ],
                "Saint Petersburg": ["Saint Petersburg City", "Kronstadt", "Kolpino", "Pushkin",
                    "Admiralteysky District", "Central District", "Vasileostrovsky District",
                    "Vasileostrovsky District", "Petrogradsky District", "Moskovsky District",
                    "Nevsky District", "Frunzensky District", "Kirovsky District", "Krasnogvardeysky District",
                    "Kalininsky District", "Primorsky District", "Krasnoselsky District", "Pushkinsky District",
                    "Petrodvortsovy District", "Kolpinsky District", "Kronshtadtsky District",
                    "Vsevolozhsk (adjacent city)",
                ],
                "Moscow Oblast": ["Balashikha", "Khimki", "Podolsk", "Mytishchi", "Korolev", "Lyubertsy", "Reutov",
                    "Zheleznodorozhny", "Elektrostal", "Domodedovo", "Odintsovo", "Serpukhov", "Noginsk",
                    "Pushkino", "Shchyolkovo", "Zhukovsky", "Lobnya", "Dolgoprudny", "Ivanteyevka",
                    "Krasnogorsk", "Chekhov", "Klin", "Voskresensk", "Dubna",
                ],
                "Krasnodar Krai": ["Krasnodar", "Sochi", "Novorossiysk", "Armavir", "Yeisk", "Anapa", "Gelendzhik",
                    "Slavyansk-na-Kubani", "Tikhoretsk", "Kropotkin", "Labinsk", "Tuapse", "Belorechensk",
                    "Kurganinsk", "Temryuk", "Goryachy Klyuch", "Apsheronsk", "Bryukhovetskaya", "Kanevskaya"
                ],
                "Sverdlovsk Oblast": ["Yekaterinburg", "Nizhny Tagil", "Kamensk-Uralsky", "Pervouralsk", "Serov",
                    "Asbest", "Revda", "Polevskoy", "Severouralsk", "Krasnoturyinsk", "Alapayevsk", "Nevyansk",
                    "Verkhnyaya Pyshma", "Bogdanovich", "Turinsk", "Artyomovsky", "Verkhny Tagil", "Irbit"
                ],
                "Tatarstan": ["Kazan", "Naberezhnye Chelny", "Nizhnekamsk", "Almetyevsk", "Zelenodolsk", "Bugulma",
                    "Chistopol", "Leninogorsk", "Yelabuga", "Aznakayevo", "Arsk", "Bavly", "Mendeleyevsk",
                    "Mamadysh", "Kukmor", "Laishevo"
                ]
            },
            IT: {
                "Lazio": ["Rome", "Latina", "Frosinone", "Rieti", "Viterbo", "Civitavecchia", "Anzio", "Nettuno",
                    "Tivoli", "Pomezia", "Cassino", "Terracina", "Gaeta", "Formia", "Albano Laziale",
                    "Frascati", "Velletri", "Cisterna di Latina"
                ],
                "Lombardy": ["Milan", "Bergamo", "Brescia", "Como", "Cremona", "Pavia", "Monza", "Varese",
                    "Cremona", "Lodi", "Lecco", "Mantua (Mantova)", "Sondrio", "Desio", "Legnano", "Rho",
                    "Gallarate", "Busto Arsizio", "Abbiategrasso", "Cernusco sul Naviglio"
                ],
                "Campania": ["Naples", "Salerno", "Giugliano in Campania", "Torre del Greco", "Pozzuoli", "Caserta",
                    "Avellino", "Benevento", "Pompeii", "Herculaneum (Ercolano)", "Torre del Greco",
                    "Torre Annunziata", "Pozzuoli", "Nocera Inferiore", "Scafati", "Pagani", "Battipaglia",
                    "Acerra", "Afragola", "Portici", "Giugliano in Campania", "Marano di Napoli", "Ischia",
                    "Procida", "Capri"
                ],
                "Sicily": ["Palermo", "Catania", "Messina", "Syracuse", "Marsala", "Trapani", "Agrigento", "Enna",
                    "Ragusa", "Modica", "Noto", "Marsala", "Gela", "Caltanissetta", "Acireale", "Avola",
                    "Piazza Armerina", "Licata", "Sciacca", "Milazzo", "Taormina", "Erice", "Cefalù"
                ],
                "Veneto": ["Venice", "Verona", "Padua", "Vicenza", "Treviso", "Belluno", "Rovigo", "Chioggia",
                    "Mestre", "Marghera", "Castelfranco Veneto", "Conegliano", "Feltre", "Bassano del Grappa",
                    "Este", "Cittadella", "Portogruaro", "San Donà di Piave", "Adria", "Montebelluna", "Schio",
                ],
                "Piedmont": ["Turin", "Novara", "Alessandria", "Asti", "Cuneo", "Novara", "Verbania", "Vercelli",
                    "Moncalieri", "Chieri", "Ivrea", "Pinerolo", "Domodossola", "Acqui Terme",
                    "Casale Monferrato", "Savigliano", "Fossano", "Saluzzo", "Omegna", "Borgosesia"
                ]
            },
            ES: {
                "Madrid": ["Madrid", "Móstoles", "Alcalá de Henares", "Fuenlabrada", "Leganés", "Getafe",
                    "Alcorcón", "Torrejón de Ardoz", "Parla", "Coslada", "San Sebastián de los Reyes",
                    "Pozuelo de Alarcón", "Las Rozas de Madrid", "Majadahonda", "Rivas-Vaciamadrid",
                    "Collado Villalba", "Arganda del Rey", "Pinto", "Valdemoro", "Tres Cantos"
                ],
                "Catalonia": ["Barcelona", "Hospitalet de Llobregat", "Terrassa", "Badalona", "Sabadell", "Reus",
                    "Girona", "Manresa", "Manresa", "Sabadell", "Mataró", "Granollers", "Sant Cugat del Vallès",
                    "Castelldefels", "Cornellà de Llobregat", "Vic", "Vilanova i la Geltrú", "Figueres",
                    "El Prat de Llobregat", "Blanes", "Roses"
                ],
                "Andalusia": ["Seville", "Málaga", "Córdoba", "Granada", "Almería", "Huelva", "Jaén", "Cádiz",
                    "Marbella", "Jerez de la Frontera", "Estepona", "Ronda", "Torremolinos", "Benalmádena",
                    "Nerja", "Motril", "Linares", "Ubeda", "Baeza", "El Puerto de Santa María"
                ],
                "Valencia": ["Valencia", "Alicante", "Elche", "Castellón de la Plana", "Torrevieja", "Gandia",
                    "Torrent", "Sagunto (Sagunt)", "Paterna", "Alzira", "Ontinyent", "Xàtiva", "Cullera",
                    "Sueca", "Carcaixent", "Burjassot", "Mislata", "Picassent", "Requena", "Manises", "Buñol",
                    "Almussafes", "Bétera", "Llíria"
                ],
                "Galicia": ["A Coruña", "Vigo", "Ourense", "Lugo", "Santiago de Compostela", "Pontevedra", "Ferrol",
                    "Vilagarcía de Arousa", "Ribeira", "Redondela", "Monforte de Lemos", "Carballo", "Narón",
                    "Cangas", "O Barco de Valdeorras", "Noia", "Burela", "Betanzos", "Tui", "A Estrada"
                ],
                "Basque Country": ["Bilbao", "Vitoria-Gasteiz", "San Sebastián", "Barakaldo", "Getxo",
                    "Portugalete", "Irún", "Eibar", "Durango", "Basauri", "Hernani", "Tolosa", "Leioa",
                    "Zarautz", "Ondarroa", "Bermeo", "Amorebieta-Etxano", "Gernika-Lumo", "Lasarte-Oria",
                    "Errenteria",
                ]
            },
            Netherlands: {
                "North Holland": ["Amsterdam", "Haarlem", "Zaanstad", "Haarlemmermeer", "Alkmaar", "Hilversum",
                    "Hoofddorp", "Purmerend", "Amstelveen", "Hoorn", "Beverwijk", "Heemskerk", "IJmuiden",
                    "Den Helder", "Enkhuizen", "Weesp", "Landsmeer", "Bloemendaal", "Naarden", "Laren",
                    "Volendam", "Edam", "Monnickendam", "Zandvoort",
                ],
                "South Holland": ["The Hague", "Rotterdam", "Leiden", "Zoetermeer", "Dordrecht", "Gouda",
                    "Schiedam", "Spijkenisse", "Alphen aan den Rijn", "Vlaardingen", "Katwijk", "Noordwijk",
                    "Wassenaar", "Naaldwijk", "Maassluis", "Leidschendam", "Voorburg", "Oegstgeest", "Rijswijk",
                    "Hillegom", "Lisse"
                ],
                "North Brabant": ["Eindhoven", "Tilburg", "Breda", "'s-Hertogenbosch", "Helmond", "Roosendaal",
                    "Oss", "Veghel", "Uden", "Waalwijk", "Veldhoven", "Boxtel", "Etten-Leur", "Bergen op Zoom",
                    "Steenbergen", "Gilze en Rijen", "Gilze en Rijen", "Drunen", "Haaren", "Bladel"
                ],
                "Utrecht": ["Utrecht", "Amersfoort", "Nieuwegein", "Veenendaal", "Houten", "Soest", "Baarn",
                    "Woerden", "De Bilt", "IJsselstein", "Maarssen", "Leusden", "Bunnik", "Doorn",
                    "Driebergen-Rijsenburg", "Wijk bij Duurstede", "Rhenen", "Montfoort", "Lopik"
                ],
                "Gelderland": ["Nijmegen", "Arnhem", "Apeldoorn", "Ede", "Zutphen", "Doetinchem", "Harderwijk",
                    "Tiel", "Zevenaar", "Winterswijk", "Barneveld", "Culemborg", "Nunspeet", "Wageningen",
                    "Lochem", "Elburg", "Druten", "Bemmel", "Putten", "Beuningen", "Doesburg", "Hattem"
                ],
                "Overijssel": ["Enschede", "Zwolle", "Deventer", "Almelo", "Hengelo", "Kampen", "Oldenzaal",
                    "Steenwijk", "Rijssen", "Hasselt", "Genemuiden", "Ommen", "Haaksbergen", "Dalfsen",
                    "Losser", "Borne", "Vriezenveen", "Wierden", "Staphorst", "Nieuwleusen"
                ]
            },
            Switzerland: {
                "Zurich": ["Zurich", "Winterthur", "Uster", "Dübendorf", "Dietikon", "Wetzikon", "Wallisellen",
                    "Kloten", "Regensdorf", "Opfikon", "Schlieren", "Meilen", "Horgen", "Thalwil", "Bülach",
                    "Volketswil", "Affoltern am Albis", "Adliswil", "Richterswil", "Erlenbach"
                ],
                "Bern": ["Bern", "Biel/Bienne", "Thun", "Köniz", "Burgdorf", "Spiez", "Interlaken", "Worb",
                    "Zollikofen", "Köniz", "Münsingen", "Ostermundigen", "Lyss", "Moutier", "La Neuveville",
                    "Brienz", "Meiringen", "Grindelwald", "Adelboden", "Gstaad"
                ],
                "Vaud": ["Lausanne", "Yverdon-les-Bains", "Montreux", "Renens", "Nyon", "Vevey", "Pully",
                    "Ecublens", "Morges", "Aigle", "Rolle", "Échallens", "Prilly", "Crissier", "Gland",
                    "Le Mont-sur-Lausanne", "Orbe", "Cossonay", "Saint-Prex", "Chavannes-près-Renens"
                ],
                "Geneva": ["Geneva", "Vernier", "Lancy", "Meyrin", "Carouge", "Onex", "Thônex", "Chêne-Bougeries",
                    "Le Grand-Saconnex", "Cologny", "Versoix", "Plan-les-Ouates", "Pregny-Chambésy", "Satigny",
                    "Confignon", "Bernex", "Troinex", "Veyrier"
                ],
                "Basel-Stadt": ["Basel", "Riehen", "Bettingen", "Altstadt Grossbasel", "St. Alban", "Gundeldingen",
                    "Iselin", "St. Johann", "Clara", "Matthäus", "Wettstein", "Bachletten", "Hirzbrunnen",
                    "Breite", "Klybeck", "Rosental", "Am Ring",
                ],
                "Aargau": ["Aarau", "Baden", "Wettingen", "Wohlen", "Rheinfelden", "Brugg", "Zofingen", "Lenzburg",
                    "Oftringen", "Kaiseraugst", "Spreitenbach", "Mellingen", "Reinach (AG)", "Buchs (AG)",
                    "Suhr", "Seon", "Rupperswil", "Leibstadt", "Birr",
                ]
            },
            Sweden: {
                "Stockholm": ["Stockholm", "Södermalm", "Östermalm", "Norrmalm", "Vasastan", "Solna", "Sundbyberg",
                    "Nacka", "Täby", "Danderyd", "Lidingö", "Lidingö", "Botkyrka", "Södertälje", "Järfälla",
                    "Värmdö", "Tyresö", "Upplands Väsby", "Ekerö", "Salem", "Sigtuna", "Sollentuna"
                ],
                "Västra Götaland": ["Gothenburg", "Borås", "Trollhättan", "Uddevalla", "Skövde", "Falköping",
                    "Lidköping", "Alingsås", "Mariestad", "Vänersborg", "Kungälv", "Lerum", "Mölndal",
                    "Partille", "Åmål", "Strömstad", "Lysekil", "Tjörn", "Orust", "Mark",
                ],
                "Skåne": ["Malmö", "Helsingborg", "Lund", "Kristianstad", "Landskrona", "Trelleborg", "Ängelholm",
                    "Ystad", "Eslöv", "Hässleholm", "Hässleholm", "Simrishamn", "Landskrona", "Höganäs",
                    "Svedala", "Skurup", "Tomelilla", "Båstad", "Kävlinge", "Staffanstorp", "Burlöv",
                ],
                "Uppsala": ["Uppsala", "Enköping", "Håbo", "Knivsta", "Tierp", "Heby", "Heby", "Öregrund", "Alunda",
                    "Storvreta", "Bälinge", "Gimo", "Älvkarleby", "Gränby", "Luthagen", "Sunnersta", "Vänge",
                    "Jälla", "Ramstalund", "Gunsta", "Danmark", "Björklinge", "Lövstalöt", "Vattholma",
                    "Skyttorp",
                ],
                "Östergötland": ["Linköping", "Norrköping", "Motala", "Mjölby", "Finspång", "Söderköping",
                    "Vadstena", "Åtvidaberg", "Kisa", "Boxholm", "Valdemarsvik", "Ödeshög", "Borghamn",
                    "Rejmyre", "Gusum", "Kimstad", "Skärblacka", "Vikbolandet", "Hovetorp", "Linghem",
                    "Malmslätt", "Östra Ryd", "Horn", "Brokind", "Tjällmo", "Grebo", "Östra Husby"
                ],
                "Värmland": ["Karlstad", "Arvika", "Kristinehamn", "Filipstad", "Hagfors", "Säffle", "Torsby",
                    "Sunne", "Grums", "Munkfors", "Forshaga", "Kil", "Årjäng", "Storfors", "Ekshärad",
                    "Sysslebäck", "Brunskog", "Skoghall", "Deje", "Charlottenberg", "Lesjöfors", "Molkom",
                    "Edane", "Åmotfors", "Vålberg", "Bäckalund", "Ransäter", "Norra Råda"
                ]
            },
            Norway: {
                "Oslo": ["Oslo", "Bærum", "Asker", "Lørenskog", "Oppegård", "Sentrum", "Grünerløkka", "Majorstuen",
                    "Frogner", "St. Hanshaugen", "Gamle Oslo", "Sagene", "Bjerke", "Nordre Aker", "Østensjø",
                    "Grorud", "Stovner", "Alna", "Ullern", "Vestre Aker", "Søndre Nordstrand"
                ],
                "Hordaland": ["Bergen", "Askøy", "Øygarden", "Os", "Sund", "Fana", "Knarrevik", "Straume", "Voss",
                    "Stord", "Odda", "Norheimsund", "Leirvik", "Bømlo", "Knarvik", "Eidfjord", "Ulvik", "Etne",
                    "Rosendal", "Ålvik", "Jondal", "Tysnes", "Uskedalen", "Røldal", "Fitjar", "Masfjorden",
                    "Øystese", "Granvin", "Kinsarvik", "Lindås", "Meland", "Fusa",
                ],
                "Rogaland": ["Stavanger", "Sandnes", "Haugesund", "Strand", "Randaberg", "Egersund", "Bryne",
                    "Sauda", "Jørpeland", "Åkrehamn", "Kopervik", "Skudeneshavn", "Vikeså", "Varhaug",
                    "Sokndal", "Sola", "Randaberg", "Tananger", "Hommersåk"
                ],
                "Akershus": ["Lillestrøm", "Rælingen", "Lørenskog", "Nittedal", "Gjerdrum", "Bærum", "Asker", "Ski",
                    "Jessheim", "Ås", "Nesoddtangen", "Frogn (Drøbak)", "Enebakk", "Lørenskog", "Nittedal",
                    "Gjerdrum", "Oppegård (Kolbotn)", "Sørumsand", "Kløfta", "Vestby",
                ],
                "Trøndelag": ["Trondheim", "Steinkjer", "Levanger", "Namsos", "Verdal", "Stjørdal", "Orkanger",
                    "Røros", "Melhus", "Oppdal", "Malvik", "Selbu", "Brekstad", "Snåsa", "Tydal", "Åfjord",
                    "Inderøy", "Meråker", "Leka", "Namsskogan", "Høylandet", "Flatanger", "Grong", "Rindal",
                    "Frosta", "Lundamo", "Ålen",
                    "Hitra", "Frøya", "Bjugn", "Rennebu", "Skaun", "Midtre Gauldal", "Osen",
                ],
                "Nordland": ["Bodø", "Narvik", "Mo i Rana", "Fauske", "Rana", "Mosjøen", "Sandnessjøen", "Sortland",
                    "Svolvær", "Leknes", "Fauske", "Brønnøysund", "Rognan", "Ballangen", "Stokmarknes",
                    "Andenes", "Melbu", "Hamarøy", "Ørnes", "Inndyr", "Lødingen", "Henningsvær", "Reine",
                    "Å i Lofoten", "Kabelvåg", "Alstahaug", "Bø i Vesterålen", "Myre", "Vestvågøy", "Hadsel",
                    "Tysfjord", "Gildeskål", "Meløy", "Røst", "Værøy", "Moskenes", "Træna", "Vega", "Vevelstad",
                    "Hemnes", "Saltdal"
                ]
            },
            Denmark: {
                "Capital Region": ["Copenhagen", "Frederiksberg", "Gentofte", "Gladsaxe", "Lyngby-Taarbæk",
                    "Helsingør", "Hillerød", "Lyngby", "Klampenborg", "Gladsaxe", "Ballerup", "Herlev",
                    "Tårnby", "Rødovre", "Albertslund", "Hvidovre", "Hvidovre",
                    "Brøndby", "Ishøj", "Vallensbæk", "Dragør", "Greve", "Ølstykke-Stenløse", "Farum",
                    "Birkerød", "Holte", "Skodsborg", "Kongens Lyngby", "Charlottenlund",
                ],
                "Central Jutland": ["Aarhus", "Randers", "Horsens", "Vejle", "Silkeborg", "Herning", "Viborg",
                    "Skanderborg", "Holstebro", "Ikast", "Ringkøbing", "Struer", "Grenaa", "Hedensted",
                    "Lemvig", "Ebeltoft", "Skive", "Brande", "Odder", "Samsø", "Hammel", "Bjerringbro",
                    "Hadsten", "Give", "Hinnerup", "Tarm"
                ],
                "Southern Denmark": ["Odense", "Esbjerg", "Kolding", "Vejle", "Fredericia", "Svendborg", "Nyborg",
                    "Middelfart", "Aabenraa", "Haderslev", "Faaborg", "Assens", "Ringe", "Nordborg", "Tønder",
                    "Grindsted", "Rødekro", "Otterup", "Bogense", "Vamdrup", "Brørup", "Løgumkloster", "Ejby",
                    "Guderup"
                ],
                "Zealand": ["Roskilde", "Næstved", "Holbæk", "Køge", "Slagelse", "Ringsted", "Kalundborg", "Sorø",
                    "Vordingborg", "Haslev", "Skælskør", "Helsinge", "Faxe", "Nakskov", "Maribo",
                    "Nykøbing Falster", "Slangerup", "Stege", "Store Heddinge", "Tølløse", "Præstø",
                    "Høng", "Stenlille",
                ],
                "North Jutland": ["Aalborg", "Hjørring", "Frederikshavn", "Thisted", "Skagen", "Brønderslev",
                    "Hobro", "Nørresundby", "Sæby", "Løgstør", "Farsø", "Støvring", "Sindal", "Aars", "Brovst",
                    "Pandrup", "Hirtshals", "Tårs", "Nibe", "Østervrå", "Aabybro", "Vodskov",
                ]
            },
            Finland: {
                "Uusimaa": ["Helsinki", "Espoo", "Vantaa", "Kauniainen", "Kerava", "Porvoo", "Lohja", "Hyvinkää",
                    "Järvenpää", "Kerava", "Tuusula", "Nurmijärvi", "Vihti", "Sipoo", "Karkkila", "Askola",
                    "Mäntsälä", "Pornainen", "Lapinjärvi", "Pukkila", "Myrskylä"
                ],
                "Pirkanmaa": ["Tampere", "Nokia", "Ylöjärvi", "Orivesi", "Lempäälä", "Pirkkala", "Valkeakoski",
                    "Akaa", "Ikaalinen", "Mänttä-Vilppula", "Ruovesi", "Pälkäne", "Juupajoki", "Vesilahti",
                    "Parkano", "Kihniö", "Sastamala"
                ],
                "Southwest Finland": ["Turku", "Kaarina", "Raisio", "Naantali", "Mynämäki", "Salo",
                    "Parainen (Pargas)", "Uusikaupunki", "Loimaa", "Paimio", "Kemiönsaari", "Mynämäki",
                    "Somero", "Laitila", "Vehmaa", "Masku", "Nousiainen", "Taivassalo", "Askainen", "Sauvo",
                    "Aura", "Oripää", "Pöytyä", "Koski Tl", "Tarvasjoki"
                ],
                "Northern Ostrobothnia": ["Oulu", "Raahe", "Ylivieska", "Oulainen", "Haapajärvi", "Nivala",
                    "Kuusamo", "Pudasjärvi", "Muhos", "Kempele", "Liminka", "Siikalatva", "Haapavesi",
                    "Pyhäjärvi", "Taivalkoski", "Tyrnävä", "Lumijoki", "Ii", "Vaala", "Utajärvi", "Merijärvi",
                    "Reisjärvi", "Oulainen"
                ],
                "Kymenlaakso": ["Kotka", "Kouvola", "Hamina", "Anjalankoski", "Kuusankoski", "Pyhtää", "Miehikkälä",
                    "Virolahti", "Inkeroisten", "Kuusankoski", "Elimäki", "Anjala", "Jaalan kirkonkylä",
                    "Keltakangas", "Huruksela", "Langinkoski", "Karhula", "Sutelankylä", "Sippola", "Tommola",
                    "Myllykoski", "Koria", "Ahvionkoski"
                ],
                "Central Finland": ["Jyväskylä", "Äänekoski", "Suolahti", "Jämsä", "Keuruu", "Saarijärvi", "Laukaa",
                    "Hankasalmi", "Toivakka", "Uurainen", "Multia", "Petäjävesi", "Kannonkoski", "Kinnula",
                    "Karstula", "Kivijärvi",
                    "Kyyjärvi", "Pihtipudas", "Viitasaari", "Muurame", "Luhanka",
                ]
            },
            KR: {
                "Seoul": ["Jung-gu", "Gangnam-gu", "Songpa-gu", "Gangdong-gu", "Mapo-gu", "Jongno-gu", "Seocho-gu",
                    "Yongsan-gu", "Gwangjin-gu", "Seodaemun-gu", "Dongdaemun-gu", "Nowon-gu", "Gangbuk-gu",
                    "Dobong-gu", "Jungnang-gu", "Eunpyeong-gu", "Seongbuk-gu", "Gwanak-gu", "Dongjak-gu",
                    "Yangcheon-gu", "Yeongdeungpo-gu", "Geumcheon-gu", "Guro-gu", "Gangseo-gu", "Songpa-gu",
                    "Songpa-gu", "Dongjak-gu"
                ],
                "Busan": ["Haeundae-gu", "Busanjin-gu", "Dongnae-gu", "Nam-gu", "Buk-gu", "Suyeong-gu", "Yeonje-gu",
                    "Sasang-gu", "Seo-gu", "Jung-gu", "Saha-gu", "Geumjeong-gu", "Dong-gu", "Gangseo-gu",
                    "Yeongdo-gu", "Gijang-gun",
                ],
                "Incheon": ["Yeonsu-gu", "Namdong-gu", "Bupyeong-gu", "Seo-gu", "Jung-gu", "Dong-gu", "Michuhol-gu",
                    "Michuhol-gu", "Ganghwa-gun", "Bupyeong-gu", "Ongjin-gun", "Ganghwa-gun", "Chinatown",
                    "Wolmido", "Yeongjongdo", "Songdo", "Central Park", "Bupyeong Underground Market",
                    "Incheon Grand Park", "Cheongna City", "Ganghwa Town", "Dolmen Sites", "Manisan",
                    "Baengnyeongdo", "Yeonpyeongdo", "Deokjeokdo", "Jakyakdo",
                ],
                "Daegu": ["Suseong-gu", "Dalseo-gu", "Buk-gu", "Dong-gu", "Nam-gu", "Jung-gu", "Dalseong-gun",
                    "Dongseongno", "Gyesan-dong", "Seomun Market", "Bangchon-dong", "Ansim-dong", "Sinam-dong",
                    "Naedang-dong", "Gamsam-dong", "Daemyeong-dong", "Anjirang", "Hyeonchungno", "Chilgok",
                    "Beomeo-dong", "Manchon-dong", "Siji-dong", "Wolbae-dong", "Hwawon-eup", "Okpo-myeon",
                    "Gachang-myeon",
                ],
                "Daejeon": ["Yuseong-gu", "Seo-gu", "Dong-gu", "Daedeok-gu", "Jung-gu", "Eunhaeng-dong",
                    "Dunsan-dong", "Tanbang-dong", "Gwanjeo-dong", "Yuseong Hot Springs", "KAIST",
                    "Techno Valley", "Sintanjin", "Yongun-dong", "Hyo-dong", "Sannae-dong", "Inhyeon-dong",
                    "Boramae-dong", "Seokgyo-dong", "Taepyeong-dong", "Yucheon-dong", "Gwanjeo 1-dong",
                    "Gwanjeo 2-dong", "Tanbang 1-dong", "Tanbang 2-dong", "Wolpyeong-dong", "Giseong-dong",
                    "Oncheon 1-dong", "Oncheon 2-dong", "Bongmyeong-dong", "Noeun-dong", "Sincheon-dong",
                    "Songchon-dong", "Sintanjin-dong", "Wolmyeong-dong", "Ojeong-dong", "Panam-dong",
                ],
                "Gwangju": ["Buk-gu", "Dong-gu", "Seo-gu", "Nam-gu", "Gwangsan-gu", "Chungjang-dong", "Hakdong",
                    "Geumnamno", "Naejang-dong", "Chipyeong-dong", "Ssangchon-dong", "Hwajeong-dong",
                    "Bongseon-dong", "Yangrim-dong", "Jiwon-dong", "Yongbong-dong", "Unam-dong", "Juknang-dong",
                    "Ilgok-dong", "Ochi-dong", "Baekun-dong", "Wolsan-dong",
                ]

            }
        };
    </script>
    <script>
        document.addEventListener('DOMContentLoaded', function() {
            const bizCountrySelect = document.getElementById('company_country');
            const bizStateSelect = document.getElementById('company_state');
            const bizCitySelect = document.getElementById('company_city');
            const fundingCurrencyLabels = document.querySelectorAll('.funding_currency_label');
            const API_KEY = 'WmtRc2MzTzhLRnltNGNmSjljT3RqakROckhSOFFQSTZqMXBGbVlNUw==';
            const BASE_URL = 'https://api.countrystatecity.in/v1';

            // Preloaded values from Blade
            const yDbCountry = "{{ old('company_country', $investo->company_country ?? '') }}";
            const yDbState = "{{ old('company_state', $investo->company_state ?? '') }}";
            const yDbCity = "{{ old('company_city', $investo->company_city ?? '') }}";

            let countryMapping = {};
            let stateMapping = {};

            async function fetchCountries() {
                try {
                    const response = await fetch(`${BASE_URL}/countries`, {
                        headers: {
                            'X-CSCAPI-KEY': API_KEY
                        }
                    });
                    if (!response.ok) throw new Error('Failed to fetch countries');
                    const countries = await response.json();
                    bizCountrySelect.innerHTML = '<option value="">Select a country</option>';
                    countries.forEach(country => {
                        countryMapping[country.iso2] = country.name; // Map ISO2 to name
                        const option = document.createElement('option');
                        option.value = country.iso2;
                        option.textContent = country.name;
                        bizCountrySelect.appendChild(option);
                    });

                    // Set preselected country if available
                    if (yDbCountry && countryMapping[yDbCountry]) {
                        bizCountrySelect.value = yDbCountry;
                        populateStates(yDbCountry); // Trigger state population
                    }
                } catch (error) {
                    console.error('Error fetching countries:', error);
                    bizCountrySelect.innerHTML = '<option value="">Error loading countries</option>';
                }
            }

            async function populateStates(countryIso2) {
                console.log('Populating states for country:', countryIso2);
                bizStateSelect.innerHTML = '<option value="">Select State</option>';
                bizCitySelect.innerHTML = '<option value="">Select City</option>';

                if (!countryIso2) {
                    console.warn('No country selected');
                    return;
                }

                try {
                    const response = await fetch(`${BASE_URL}/countries/${countryIso2}/states`, {
                        headers: {
                            'X-CSCAPI-KEY': API_KEY
                        }
                    });
                    if (!response.ok) throw new Error('Failed to fetch states');
                    const states = await response.json();
                    console.log('States found:', states);
                    states.sort((a, b) => a.name.localeCompare(b.name, 'en', {
                        sensitivity: 'base'
                    }));
                    bizStateSelect.innerHTML = '<option value="">Select State</option>';
                    states.forEach(state => {
                        stateMapping[state.iso2] = state.name; // Map ISO2 to name
                        const option = document.createElement('option');
                        option.value = state.iso2;
                        option.textContent = state.name;
                        bizStateSelect.appendChild(option);
                    });

                    // Set preselected state if available
                    if (yDbState && stateMapping[yDbState]) {
                        bizStateSelect.value = yDbState;
                        populateCities(countryIso2, yDbState); // Trigger city population
                    }
                } catch (error) {
                    console.error('Error fetching states:', error);
                    bizStateSelect.innerHTML = '<option value="">No states available</option>';
                }
            }

            async function populateCities(countryIso2, stateIso2) {
                console.log('Populating cities for state:', stateIso2);
                bizCitySelect.innerHTML = '<option value="">Select City</option>';

                if (!countryIso2 || !stateIso2) {
                    console.warn('No country or state selected');
                    return;
                }

                try {
                    const response = await fetch(
                        `${BASE_URL}/countries/${countryIso2}/states/${stateIso2}/cities`, {
                            headers: {
                                'X-CSCAPI-KEY': API_KEY
                            }
                        });
                    if (!response.ok) throw new Error('Failed to fetch cities');
                    const cities = await response.json();
                    console.log('Cities found:', cities);
                    bizCitySelect.innerHTML = '<option value="">Select City</option>';
                    cities.forEach(city => {
                        const option = document.createElement('option');
                        option.value = city.name;
                        option.textContent = city.name;
                        bizCitySelect.appendChild(option);
                    });

                    // Set preselected city if available
                    if (yDbCity) {
                        bizCitySelect.value = yDbCity;
                    }
                } catch (error) {
                    console.error('Error fetching cities:', error);
                    bizCitySelect.innerHTML = '<option value="">No cities available</option>';
                }
            }

            function updateFundingCurrencyLabel() {
                const selectedCountry = (bizCountrySelect?.value || '').trim().toLowerCase();
                let label = '';

                if (selectedCountry === 'in') {
                    label = '(₹)';
                } else if (selectedCountry !== '') {
                    label = '($)';
                }

                fundingCurrencyLabels.forEach(el => {
                    el.textContent = label;
                });
            }

            // Event Listeners for Country and State
            bizCountrySelect?.addEventListener('change', () => {
                const countryCode = bizCountrySelect.value.trim();
                console.log('Country changed to:', countryCode);
                populateStates(countryCode);
                bizStateSelect.value = '';
                bizCitySelect.value = '';
                updateFundingCurrencyLabel();

                const countryError = document.getElementById('business_country_error');
                if (countryCode && countryCode !== '') {
                    if (countryError) {
                        countryError.classList.add('d-none');
                    }
                }
            });

            bizStateSelect?.addEventListener('change', () => {
                const countryCode = bizCountrySelect.value.trim();
                const stateName = bizStateSelect.value;
                populateCities(countryCode, stateName);
                bizCitySelect.value = '';
            });

            // On page load, populate countries and states if country is preselected
            if (bizCountrySelect) {
                fetchCountries();
                updateFundingCurrencyLabel(); // Update currency label initially
            }
        });
    </script>
    <script>
        // Global variables for all file uploads
        let isProcessing = false;

        // Generic function to clear container
        function clearContainer(container) {
            while (container && container.firstChild) {
                container.removeChild(container.firstChild);
            }
        }

        // Generic function to create image thumbnail
        function createImageThumbnail(src, altText, removeCallback) {
            const wrapper = document.createElement('div');
            wrapper.className = 'image-thumbnail';
            wrapper.style.position = 'relative';
            wrapper.style.width = '100px';
            wrapper.style.height = '100px';
            wrapper.style.overflow = 'hidden';
            wrapper.style.borderRadius = '8px';
            wrapper.style.border = '1px solid #ccc';
            wrapper.style.display = 'inline-block';
            wrapper.style.margin = '5px';

            const img = document.createElement('img');
            img.src = src;
            img.alt = altText;
            img.style.width = '100%';
            img.style.height = '100%';
            img.style.objectFit = 'cover';
            img.style.display = 'block';

            const removeBtn = document.createElement('button');
            removeBtn.type = 'button';
            removeBtn.className = 'remove-image';
            removeBtn.innerHTML = '×';
            removeBtn.style.position = 'absolute';
            removeBtn.style.top = '2px';
            removeBtn.style.right = '4px';
            removeBtn.style.background = 'rgba(255, 0, 0, 0.8)';
            removeBtn.style.color = 'white';
            removeBtn.style.border = 'none';
            removeBtn.style.borderRadius = '50%';
            removeBtn.style.fontSize = '14px';
            removeBtn.style.width = '20px';
            removeBtn.style.height = '20px';
            removeBtn.style.cursor = 'pointer';
            removeBtn.style.textAlign = 'center';
            removeBtn.style.lineHeight = '17px';
            removeBtn.style.zIndex = '2';
            removeBtn.onclick = removeCallback;

            wrapper.appendChild(img);
            wrapper.appendChild(removeBtn);

            return wrapper;
        }

        // Generic function to create PDF preview
        function createPDFPreview(fileName, fileSize, removeCallback) {
            const wrapper = document.createElement('div');
            wrapper.className = 'pdf-preview';
            wrapper.style.position = 'relative';
            wrapper.style.width = '200px';
            wrapper.style.height = '80px';
            wrapper.style.border = '2px solid #007bff';
            wrapper.style.borderRadius = '8px';
            wrapper.style.backgroundColor = '#f8f9fa';
            wrapper.style.display = 'flex';
            wrapper.style.alignItems = 'center';
            wrapper.style.padding = '10px';
            wrapper.style.margin = '5px';

            // PDF Icon
            const pdfIcon = document.createElement('div');
            pdfIcon.innerHTML =
                '<i class="fas fa-file-pdf" style="font-size: 24px; color: #dc3545; margin-right: 10px;"></i>';

            // File Info
            const fileInfo = document.createElement('div');
            fileInfo.style.flex = '1';
            fileInfo.style.overflow = 'hidden';

            const fileNameDiv = document.createElement('div');
            fileNameDiv.textContent = fileName;
            fileNameDiv.style.fontWeight = 'bold';
            fileNameDiv.style.fontSize = '12px';
            fileNameDiv.style.whiteSpace = 'nowrap';
            fileNameDiv.style.overflow = 'hidden';
            fileNameDiv.style.textOverflow = 'ellipsis';

            const fileSizeDiv = document.createElement('div');
            fileSizeDiv.textContent = formatFileSize(fileSize);
            fileSizeDiv.style.fontSize = '10px';
            fileSizeDiv.style.color = '#6c757d';

            fileInfo.appendChild(fileNameDiv);
            fileInfo.appendChild(fileSizeDiv);

            // Remove button
            const removeBtn = document.createElement('button');
            removeBtn.type = 'button';
            removeBtn.className = 'remove-pdf';
            removeBtn.innerHTML = '×';
            removeBtn.style.position = 'absolute';
            removeBtn.style.top = '2px';
            removeBtn.style.right = '4px';
            removeBtn.style.background = 'rgba(255, 0, 0, 0.8)';
            removeBtn.style.color = 'white';
            removeBtn.style.border = 'none';
            removeBtn.style.borderRadius = '50%';
            removeBtn.style.fontSize = '14px';
            removeBtn.style.width = '20px';
            removeBtn.style.height = '20px';
            removeBtn.style.cursor = 'pointer';
            removeBtn.style.textAlign = 'center';
            removeBtn.style.lineHeight = '17px';
            removeBtn.style.zIndex = '2';
            removeBtn.onclick = removeCallback;

            wrapper.appendChild(pdfIcon);
            wrapper.appendChild(fileInfo);
            wrapper.appendChild(removeBtn);

            return wrapper;
        }

        // Helper function to format file size
        function formatFileSize(bytes) {
            if (bytes === 0) return '0 Bytes';
            const k = 1024;
            const sizes = ['Bytes', 'KB', 'MB', 'GB'];
            const i = Math.floor(Math.log(bytes) / Math.log(k));
            return parseFloat((bytes / Math.pow(k, i)).toFixed(2)) + ' ' + sizes[i];
        }

        // Business Logo Handler (original)
        function handleBusinessLogoChange(e) {
            const previewContainer = document.getElementById('business_logo_preview');
            clearContainer(previewContainer);

            const file = e.target.files[0];
            if (file && file.type.startsWith('image/')) {
                const reader = new FileReader();
                reader.onload = function(evt) {
                    clearContainer(previewContainer);
                    const thumbnail = createImageThumbnail(evt.target.result, 'Logo Preview', removeBusinessLogo);
                    previewContainer.appendChild(thumbnail);
                };
                reader.readAsDataURL(file);
            }
        }

        // Photo Handler (new)
        function handlePhotoChange(e) {
            const previewContainer = document.getElementById('photo_preview');
            clearContainer(previewContainer);

            const file = e.target.files[0];
            if (file && file.type.startsWith('image/')) {
                const reader = new FileReader();
                reader.onload = function(evt) {
                    clearContainer(previewContainer);
                    const thumbnail = createImageThumbnail(evt.target.result, 'Photo Preview', removePhoto);
                    previewContainer.appendChild(thumbnail);
                };
                reader.readAsDataURL(file);
            }
        }

        // PDF Handler for pitch_deck
        function handlePitchDeckChange(e) {
            const previewContainer = document.getElementById('investor_profile_preview');
            if (!previewContainer) {
                // Create preview container if it doesn't exist
                const container = document.createElement('div');
                container.id = 'investor_profile_preview';
                container.className = 'pdf-preview-container mt-2';
                e.target.parentNode.parentNode.appendChild(container);
            }

            const container = document.getElementById('investor_profile_preview');
            clearContainer(container);

            const file = e.target.files[0];
            if (file && file.type === 'application/pdf') {
                const pdfPreview = createPDFPreview(file.name, file.size, removePitchDeck);
                container.appendChild(pdfPreview);
            }
        }

        // Remove functions
        function removeBusinessLogo() {
            const container = document.getElementById('business_logo_preview');
            const input = document.getElementBy1d('business_logo');
            clearContainer(container);
            input.value = '';
        }

        // Remove function for Photo (new)
        function removePhoto() {
            const container = document.getElementById('photo_preview');
            const input = document.getElementById('photo');
            clearContainer(container);
            input.value = '';
        }

        // PDF Remove functions
        function removePitchDeck() {
            const container = document.getElementById('investor_profile_preview');
            const input = document.getElementById('investor_profile');
            clearContainer(container);
            input.value = '';
        }

        // Generic update file input function
        function updateFileInput(inputId, filesArray) {
            const input = document.getElementById(inputId);

            if (filesArray.length === 0) {
                input.value = '';
                return;
            }

            try {
                const dataTransfer = new DataTransfer();
                filesArray.forEach(({
                    file
                }) => {
                    dataTransfer.items.add(file);
                });
                input.files = dataTransfer.files;
            } catch (error) {
                console.log('DataTransfer not supported');
            }
        }

        // Clear event listeners
        function clearEventListeners() {
            const elements = [{
                    id: 'business_logo',
                    handler: handleBusinessLogoChange
                },
                {
                    id: 'photo',
                    handler: handlePhotoChange
                }, // Added photo
                {
                    id: 'investor_profile',
                    handler: handlePitchDeckChange
                }
            ];

            elements.forEach(({
                id,
                handler
            }) => {
                const element = document.getElementById(id);
                if (element) {
                    element.removeEventListener('change', handler);
                }
            });
        }

        // Initialize event listeners
        function initializeEventListeners() {
            clearEventListeners();

            const elements = [{
                    id: 'business_logo',
                    handler: handleBusinessLogoChange
                },
                {
                    id: 'photo',
                    handler: handlePhotoChange
                }, // Added photo
                {
                    id: 'investor_profile',
                    handler: handlePitchDeckChange
                }
            ];

            elements.forEach(({
                id,
                handler
            }) => {
                const element = document.getElementById(id);
                if (element) {
                    element.addEventListener('change', handler);
                }
            });
        }

        // Legacy function for backward compatibility
        function removeImage(button, inputId) {
            if (inputId === 'business_logo') {
                removeBusinessLogo();
            } else if (inputId === 'photo') { // Added photo
                removePhoto();
            } else if (inputId === 'investor_profile') {
                removePitchDeck();
            }
        }

        // Initialize when DOM is ready
        if (document.readyState === 'loading') {
            document.addEventListener('DOMContentLoaded', initializeEventListeners);
        } else {
            initializeEventListeners();
        }
    </script>
@endsection
