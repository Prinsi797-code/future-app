@extends('layouts.admin')
<link href="https://cdn.jsdelivr.net/npm/select2@4.1.0-rc.0/dist/css/select2.min.css" rel="stylesheet" />
<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/flatpickr/4.6.13/flatpickr.min.css">
<script src="https://cdnjs.cloudflare.com/ajax/libs/flatpickr/4.6.13/flatpickr.min.js"></script>
@section('title', 'Profile Update - Future Taikun')
<style>
    /* Form Floating Custom Styles */
    .form-floating-custom {
        position: relative;
        margin-bottom: 1rem;
    }

    .form-floating-custom>.form-control:focus~label,
    .form-floating-custom>.form-control:not(:placeholder-shown)~label,
    .form-floating-custom>.form-select:focus~label,
    .form-floating-custom>.form-select:not([value=""])~label {
        opacity: 0.65;
        transform: scale(0.85) translateY(-0.5rem) translateX(0.15rem);
    }

    .form-floating-custom>.form-control,
    .form-floating-custom>.form-select {
        height: calc(3.5rem + 2px);
        padding: 1rem 0.75rem;
        border-radius: 0.5rem;
        border: 1px solid #ced4da;
        font-size: 1rem;
        background-color: #fff;
        transition: border-color 0.15s ease-in-out, box-shadow 0.15s ease-in-out;
    }

    .form-floating-custom>.form-control:focus,
    .form-floating-custom>.form-select:focus {
        border-color: #86b7fe;
        outline: 0;
        box-shadow: 0 0 0 0.25rem rgba(13, 110, 253, 0.25);
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
</style>

@php
    $isApproved = $investor->approved == 1;
@endphp
@section('content')
    <div class="row justify-content-center">
        <div class="col-md-10 col-lg-8">
            <div class="card">
                <div class="card-body p-5">
                    <div class="text-center mb-4">
                        <div class="mb-3">
                            <i class="fas fa-lightbulb text-primary" style="font-size: 48px;"></i>
                        </div>
                    </div>
                    @if (!$isApproved)
                        <form action="{{ route('investor.update', $investor->id) }}" method="POST"
                            enctype="multipart/form-data">
                            @csrf
                            <input type="hidden" name="user_id" value="{{ $user->id }}">

                            <!-- Existing Company Toggle -->
                            <div class="row mb-4">
                                <div class="col-12">
                                    <h5 class="mb-3 text-center">
                                        <i class="fas fa-building me-2"></i>Do You Have an Existing Company?
                                    </h5>
                                    <div class="d-flex gap-3 mt-2 justify-content-center">
                                        <div class="form-check form-check-inline">
                                            <input type="radio" class="form-check-input" name="existing_company"
                                                value="0" id="existing_company_no"
                                                {{ old('existing_company', $investor->existing_company ?? '0') == '0' ? 'checked' : '' }}>
                                            <label class="form-check-label" for="existing_company_no">No</label>
                                        </div>
                                        <div class="form-check form-check-inline">
                                            <input type="radio" class="form-check-input" name="existing_company"
                                                value="1" id="existing_company_yes"
                                                {{ old('existing_company', $investor->existing_company ?? '0') == '1' ? 'checked' : '' }}>
                                            <label class="form-check-label" for="existing_company_yes">Yes</label>
                                        </div>
                                    </div>
                                </div>
                            </div>

                            <!-- Personal Information -->
                            <div class="row mb-4">
                                <div class="col-12">
                                    <h5 class="mb-3">
                                        <i class="fas fa-user me-2"></i>Personal Information
                                    </h5>
                                </div>
                                <div class="col-md-6 mb-3">
                                    <div class="form-floating-custom">
                                        <input type="text" class="form-control" name="full_name" id="full_name"
                                            placeholder="Type your name..."
                                            value="{{ old('full_name', $investor->full_name) }}" readonly>
                                        <label for="full_name">Full Name *</label>
                                        <div class="text-danger mt-1 d-none" id="full_name_error"></div>
                                    </div>
                                </div>
                                <div class="col-md-6 mb-3">
                                    <div class="form-floating-custom">
                                        <input type="email" class="form-control" name="email"
                                            value="{{ old('email', $investor->email) }}" readonly>
                                        <label for="email">Email Address *</label>
                                    </div>
                                </div>
                                <div class="col-md-6 mb-3">
                                    <div class="input-group">
                                        <select name="country_code" class="form-select" style="max-width: 120px;" readonly
                                            disabled>
                                            @foreach ($countries as $country)
                                                <option value="{{ $country['code'] }}"
                                                    {{ old('country_code', $investor->country_code) == $country['code'] ? 'selected' : '' }}>
                                                    {{ $country['name'] }} ({{ $country['code'] }})
                                                </option>
                                            @endforeach
                                        </select>
                                        <input type="tel" class="form-control" name="phone_number"
                                            placeholder="Enter mobile number" readonly
                                            value="{{ old('phone_number', $investor->phone_number) }}" maxlength="12"
                                            style="padding: 15px;">
                                    </div>
                                    <div class="text-danger mt-1 d-none" id="phone_number_error"></div>
                                    <div class="text-danger mt-1 d-none" id="country_code_error"></div>
                                </div>
                                <div class="col-md-6 mb-3">
                                    <div class="form-floating-custom">
                                        <input type="text" class="form-control" name="country" id="country"
                                            value="{{ old('country', $investor->country) }}" readonly>
                                        <label for="country">Country *</label>
                                    </div>
                                </div>
                                <div class="col-md-6 mb-3">
                                    <div class="form-floating-custom">
                                        <input type="text" class="form-control" name="state" id="state"
                                            value="{{ old('state', $investor->state) }}" readonly>
                                        <label for="state">State *</label>
                                    </div>
                                </div>
                                <div class="col-md-6 mb-3">
                                    <div class="form-floating-custom">
                                        <input type="text" class="form-control" name="city" id="city"
                                            value="{{ old('city', $investor->city) }}" readonly>
                                        <label for="city">City *</label>
                                        <div class="text-danger mt-1 d-none" id="city_error"></div>
                                    </div>
                                </div>
                                <div class="col-md-6 mb-3">
                                    <div class="form-floating-custom">
                                        <input type="text" pattern="[0-9]{6}" inputmode="numeric" maxlength="6"
                                            class="form-control" name="pin_code"
                                            value="{{ old('pin_code', $investor->pin_code) }}"
                                            placeholder="Type your pin/zip code..." required>
                                        <label for="pin_code">Pin/Zip Code *</label>
                                        <div class="text-danger mt-1 d-none" id="pin_code_error"></div>
                                    </div>
                                </div>
                                <div class="col-md-6 mb-3">
                                    <div class="form-floating-custom">
                                        <input type="text" class="form-control" name="dob" id="dob"
                                            required value="{{ old('dob', $investor->dob) }}">
                                        <label for="dob">Date of Birth *</label>
                                        <div class="text-danger mt-1 d-none" id="dob_error"></div>
                                    </div>
                                </div>
                                <div class="col-md-6 mb-3">
                                    <div class="form-group">
                                        <div class="form-floating-custom">
                                            <select class="form-select" name="qualification" id="qualification" required>
                                                <option value="">Select Qualification</option>
                                                @foreach ($qualifications as $qualification)
                                                    <option value="{{ $qualification }}"
                                                        {{ old('qualification', $investor->qualification) == $qualification ? 'selected' : '' }}>
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
                                        <input type="text" class="form-control" name="age" id="age"
                                            placeholder="Type your age..." readonly
                                            value="{{ old('age', $investor->age) }}">
                                        <label for="age">Age</label>
                                    </div>
                                </div>
                                <div class="col-md-6 mb-3">
                                    <div class="form-floating-custom">
                                        <input type="text" class="form-control" name="current_address"
                                            id="current_address"
                                            value="{{ old('current_address', $investor->current_address) }}"
                                            placeholder="Type your current address...">
                                        <label for="current_address">Current Address</label>
                                    </div>
                                </div>
                                <div class="col-md-6 mb-3">
                                    <label for="photo" class="form-label">Upload Photo</label>
                                    <div class="file-upload-wrapper">
                                        <input class="form-control" type="file" id="photo" name="photo"
                                            accept=".jpg,.jpeg,.png">
                                        <label for="photo" class="file-upload-label w-100">
                                            <i class="fas fa-upload me-2"></i>Choose Image file...(jpg,png,jpeg)
                                        </label>
                                    </div>
                                    <div id="photo_preview" class="image-preview-container mt-2">
                                        @if ($investor->photo)
                                            <img src="{{ Storage::url($investor->photo) }}" class="img-thumbnail"
                                                style="max-width: 150px; max-height: 150px; object-fit: cover; margin: 5px;">
                                        @endif
                                    </div>
                                    <div class="text-danger mt-1 d-none" id="photo_error"></div>
                                </div>
                            </div>

                            <!-- Investor Information -->
                            <div class="row mb-4">
                                <div class="col-12">
                                    <h5 class="mb-3">
                                        <i class="fas fa-briefcase me-2"></i>Investor Information
                                    </h5>
                                </div>
                                <div class="col-md-6 mb-3">
                                    <div class="form-floating-custom">
                                        <input type="url" class="form-control" name="linkedin_profile"
                                            id="linkedin_profile"
                                            value="{{ old('linkedin_profile', $investor->linkedin_profile) }}"
                                            placeholder="https://linkedin.com/in/your-profile">
                                        <label for="linkedin_profile">LinkedIn Profile</label>
                                    </div>
                                </div>
                                <div class="col-md-6 mb-3">
                                    <div class="form-floating-custom">
                                        <select class="form-select" name="investor_type" id="investor_type">
                                            <option value="">Select Investor</option>
                                            @foreach ($investorTypes as $type)
                                                <option value="{{ $type }}"
                                                    {{ old('investor_type', $investor->investor_type ?? '') == $type ? 'selected' : '' }}>
                                                    {{ $type }}
                                                </option>
                                            @endforeach
                                        </select>
                                        <label for="investor_type">Select Investor Type *</label>
                                        <div class="text-danger mt-1 d-none" id="investor_type_error"></div>
                                    </div>
                                </div>
                                <div class="col-md-6 mb-3">
                                    <div class="form-floating-custom">
                                        <select class="form-select" name="investment_range" id="investment_range">
                                            <option value="">Select Investment Range</option>
                                            @foreach ($investmentRanges as $range)
                                                <option value="{{ $range }}"
                                                    {{ old('investment_range', $investor->investment_range ?? '') == $range ? 'selected' : '' }}>
                                                    {{ $range }}
                                                </option>
                                            @endforeach
                                        </select>
                                        <label for="investment_range">Investment Range *<span
                                                class="funding_currency_label">()</span></label>
                                        <div class="text-danger mt-1 d-none" id="investment_range_error"></div>
                                    </div>
                                </div>
                                <div class="col-md-6 mb-3">
                                    <div class="form-group">
                                        <div class="form-floating-custom">
                                            <select class="form-select" name="preferred_industries[]"
                                                id="preferred_industries" multiple>
                                                @foreach ($industries as $industry)
                                                    <option value="{{ $industry }}"
                                                        {{ in_array($industry, old('preferred_industries', json_decode($investor->preferred_industries, true) ?? [])) ? 'selected' : '' }}>
                                                        {{ $industry }}
                                                    </option>
                                                @endforeach
                                            </select>
                                            <label for="preferred_industries">Preferred Industries</label>
                                        </div>
                                    </div>
                                </div>
                                <div class="col-md-6 mb-3">
                                    <div class="form-group">
                                        <div class="form-floating-custom">
                                            <select class="form-select" name="preferred_geographies[]"
                                                id="preferred_geographies" multiple>
                                                @foreach ($geographies as $geography)
                                                    <option value="{{ $geography }}"
                                                        {{ in_array($geography, old('preferred_geographies', json_decode($investor->preferred_geographies, true) ?? [])) ? 'selected' : '' }}>
                                                        {{ $geography }}
                                                    </option>
                                                @endforeach
                                            </select>
                                            <label for="preferred_geographies">Preferred Geographies</label>
                                        </div>
                                    </div>
                                </div>
                                <div class="col-md-6 mb-3">
                                    <div class="form-floating-custom">
                                        <label class="form-label" for="preferred_startup_stage">Preferred Investment Stage
                                            *</label>
                                        <select class="form-select" name="preferred_startup_stage[]"
                                            id="preferred_startup_stage" multiple>
                                            <option value="">Select Stages</option>
                                            @foreach ($startupStages as $stage)
                                                <option value="{{ $stage }}"
                                                    {{ in_array($stage, old('preferred_startup_stage', $investor ? ($investor->preferred_startup_stage ? json_decode($investor->preferred_startup_stage, true) : []) : [])) ? 'selected' : '' }}>
                                                    {{ $stage }}
                                                </option>
                                            @endforeach
                                        </select>
                                        <div class="text-danger mt-1 d-none" id="preferred_startup_stage_error"></div>
                                    </div>
                                </div>
                                <div class="col-md-6 mb-3">
                                    <div class="form-group">
                                        <div class="form-floating-custom">
                                            <select class="form-select" name="investment_experince"
                                                id="investment_experince">
                                                <option value="">Select Investment Experience</option>
                                                @foreach ($investmentExperince as $experience)
                                                    <option value="{{ $experience }}"
                                                        {{ old('investment_experince', $investor->investment_experince) == $experience ? 'selected' : '' }}>
                                                        {{ $experience }}
                                                    </option>
                                                @endforeach
                                            </select>
                                            <label for="investment_experince">Investment Experience</label>
                                        </div>
                                    </div>
                                </div>
                            </div>

                            <!-- Company Information -->
                            <div class="row mb-4 company-information"
                                style="display: {{ old('existing_company', $investor->existing_company ?? '0') == '1' ? 'block' : 'none' }};">
                                <div class="col-12">
                                    <h5 class="mb-3">
                                        <i class="fas fa-building me-2"></i>Company Information
                                    </h5>
                                </div>
                                <div class="col-md-12 mb-3">
                                    <div class="form-floating-custom">
                                        <div class="input-group">
                                            <select name="company_country_code" class="form-select"
                                                style="max-width: 120px;">
                                                @foreach ($countries as $country)
                                                    <option value="{{ $country['code'] }}"
                                                        {{ old('company_country_code', $investor->company_country_code ?? '+91') == $country['code'] ? 'selected' : '' }}>
                                                        {{ $country['name'] }} ({{ $country['code'] }})
                                                    </option>
                                                @endforeach
                                            </select>
                                            <input type="tel" class="form-control" name="professional_phone"
                                                placeholder="9638527410"
                                                value="{{ old('professional_phone', $investor->professional_phone ?? '') }}"
                                                maxlength="12">
                                        </div>
                                        <div class="text-danger mt-1 d-none" id="professional_phone_error"></div>
                                        <div class="text-danger mt-1 d-none" id="company_country_code_error"></div>
                                    </div>
                                </div>
                                <div class="col-md-12 mb-3">
                                    <div class="form-floating-custom">
                                        <input type="email" class="form-control" name="professional_email"
                                            id="professional_email"
                                            value="{{ old('professional_email', $investor->professional_email) }}"
                                            placeholder="Enter professional email">
                                        <label for="professional_email">Professional Email</label>
                                    </div>
                                </div>
                                <div class="col-md-12 mb-3">
                                    <div class="form-floating-custom">
                                        <input type="url" class="form-control" name="website" id="website"
                                            value="{{ old('website', $investor->website) }}"
                                            placeholder="https://your-website.com">
                                        <label for="website">Website</label>
                                    </div>
                                </div>
                                <div class="col-md-12 mb-3">
                                    <div class="form-group">
                                        <div class="form-floating-custom">
                                            <select class="form-select" name="designation" id="designation">
                                                <option value="">Select Designation</option>
                                                @foreach ($designations as $designation)
                                                    <option value="{{ $designation }}"
                                                        {{ old('designation', $investor->designation) == $designation ? 'selected' : '' }}>
                                                        {{ $designation }}
                                                    </option>
                                                @endforeach
                                            </select>
                                            <label for="designation">Designation</label>
                                        </div>
                                    </div>
                                </div>
                                <div class="col-md-12 mb-3">
                                    <div class="form-floating-custom">
                                        <input type="text" class="form-control" name="organization_name"
                                            id="organization_name"
                                            value="{{ old('organization_name', $investor->organization_name) }}"
                                            placeholder="Enter organization name">
                                        <label for="organization_name">Organization Name</label>
                                    </div>
                                </div>
                                <div class="col-md-12 mb-3">
                                    <div class="form-floating-custom">
                                        <input type="text" class="form-control" name="company_address"
                                            id="company_address"
                                            value="{{ old('company_address', $investor->company_address) }}"
                                            placeholder="Enter company address">
                                        <label for="company_address">Company Address</label>
                                    </div>
                                </div>
                                {{-- <div class="col-md-12 mb-3">
                                    <div class="form-floating-custom">
                                        <select name="company_country" class="form-select" id="company_country">
                                            <option value="">Select a country</option>
                                            @foreach ($countries as $country)
                                                <option value="{{ $country['name'] }}"
                                                    {{ old('company_country', $investor->company_country ?? $autoDetectedCountry) == $country['name'] ? 'selected' : '' }}>
                                                    {{ $country['name'] }}
                                                </option>
                                            @endforeach
                                        </select>
                                        <label for="company_country">Business Country *</label>
                                        <div class="text-danger mt-1 d-none" id="company_country_error"></div>
                                    </div>
                                </div> --}}
                                <div class="col-md-12 mb-3">
                                    <div class="form-floating-custom">
                                        <select name="company_country" class="form-select" id="company_country">
                                            <option value="">Select a country</option>
                                            @foreach ($countries1 as $country)
                                                <option value="{{ $country['iso2'] }}"
                                                    {{ old('company_country', $investor->company_country ?? $autoDetectedCountry) == $country['iso2'] ? 'selected' : '' }}>
                                                    {{ $country['name'] }}
                                                </option>
                                            @endforeach
                                        </select>
                                        <label for="company_country">Business Country *</label>
                                        <div class="text-danger mt-1 d-none" id="company_country_error"></div>
                                    </div>
                                </div>
                                <div class="col-md-12 mb-3">
                                    <div class="form-floating-custom">
                                        <select class="form-control" name="company_state" id="company_state">
                                            <option value="">Select State</option>
                                        </select>
                                        <label for="company_state">Business State *</label>
                                        <div class="text-danger mt-1 d-none" id="company_state_error"></div>
                                    </div>
                                </div>
                                <div class="col-md-12 mb-3">
                                    <div class="form-floating-custom">
                                        <select class="form-control" name="company_city" id="company_city">
                                            <option value="">Select City</option>
                                        </select>
                                        <label for="company_city">Business City *</label>
                                        <div class="text-danger mt-1 d-none" id="company_city_error"></div>
                                    </div>
                                </div>
                                <div class="col-md-12 mb-3">
                                    <div class="form-floating-custom">
                                        <input type="text" class="form-control" name="company_zipcode"
                                            id="company_zipcode"
                                            value="{{ old('company_zipcode', $investor->company_zipcode) }}"
                                            placeholder="Enter company zipcode">
                                        <label for="company_zipcode">Company Zipcode</label>
                                    </div>
                                </div>
                                <div class="col-md-12 mb-3">
                                    <div class="form-floating-custom">
                                        <input type="text" class="form-control" name="tax_registration_number"
                                            id="tax_registration_number"
                                            value="{{ old('tax_registration_number', $investor->tax_registration_number) }}"
                                            placeholder="Enter tax registration number">
                                        <label for="tax_registration_number">Tax Registration Number</label>
                                    </div>
                                </div>
                                <div class="col-md-12 mb-3">
                                    <label for="business_logo" class="form-label">Upload Business Logo</label>
                                    <div class="file-upload-wrapper">
                                        <input class="form-control" type="file" id="business_logo"
                                            name="business_logo" accept=".jpg,.jpeg,.png">
                                        <label for="business_logo" class="file-upload-label w-100">
                                            <i class="fas fa-upload me-2"></i>Choose Image file...(jpg,png,jpeg)
                                        </label>
                                    </div>
                                    <div id="business_logo_preview" class="image-preview-container mt-2">
                                        @if ($investor->business_logo)
                                            <img src="{{ Storage::url($investor->business_logo) }}" class="img-thumbnail"
                                                style="max-width: 150px; max-height: 150px; object-fit: cover; margin: 5px;">
                                        @endif
                                    </div>
                                    <div class="text-danger mt-1 d-none" id="business_logo_error"></div>
                                </div>
                                <div class="col-md-12 mb-3">
                                    <label for="investor_profile" class="form-label">Upload Investor Profile</label>
                                    <div class="file-upload-wrapper">
                                        <input class="form-control" type="file" id="investor_profile"
                                            name="investor_profile" accept=".pdf">
                                        <label for="investor_profile" class="file-upload-label w-100">
                                            <i class="fas fa-upload me-2"></i>Choose PDF file...(PDF, max 10MB)
                                        </label>
                                    </div>
                                    <div id="investor_profile_preview" class="pdf-preview-container mt-2">
                                        @if ($investor->investor_profile)
                                            <div class="d-flex align-items-center p-2 border rounded mb-2">
                                                <i class="fas fa-file-pdf text-danger me-2"></i>
                                                <div>
                                                    <div class="fw-bold">
                                                        <a href="{{ Storage::url($investor->investor_profile) }}"
                                                            target="_blank">
                                                            {{ basename($investor->investor_profile) }}
                                                        </a>
                                                    </div>
                                                    <small class="text-muted">PDF</small>
                                                </div>
                                            </div>
                                        @endif
                                    </div>
                                    <div class="text-danger mt-1 d-none" id="investor_profile_error"></div>
                                    @error('investor_profile')
                                        <div class="text-danger mt-1">{{ $message }}</div>
                                    @enderror
                                </div>
                            </div>

                            <!-- Investment Companies -->
                            <div class="row mb-4 company-information"
                                style="display: {{ old('existing_company', $investor->existing_company ?? '0') == '1' ? 'block' : 'none' }};">
                                <div class="col-12">
                                    <h5 class="mb-3">
                                        <i class="fas fa-building me-2"></i>Investment Companies
                                    </h5>
                                </div>
                                @foreach ($investor->companies ?? [] as $index => $company)
                                    <div class="col-md-6 mb-3">
                                        <div class="form-floating-custom">
                                            <input type="text" class="form-control"
                                                name="company_name[{{ $index }}]"
                                                value="{{ old('company_name.' . $index, $company->company_name) }}"
                                                placeholder="Enter company name">
                                            <label for="company_name[{{ $index }}]">Company Name</label>
                                            @error('company_name.' . $index)
                                                <div class="text-danger mt-1">{{ $message }}</div>
                                            @enderror
                                        </div>
                                    </div>
                                    <div class="col-md-6 mb-3">
                                        <div class="form-floating-custom">
                                            <input type="number" class="form-control"
                                                name="market_capital[{{ $index }}]"
                                                value="{{ old('market_capital.' . $index, $company->market_capital) }}"
                                                placeholder="Enter market capital">
                                            <label for="market_capital[{{ $index }}]">Market Capital <span
                                                    class="funding_currency_label">()</span></label>
                                            @error('market_capital.' . $index)
                                                <div class="text-danger mt-1">{{ $message }}</div>
                                            @enderror
                                        </div>
                                    </div>
                                    <div class="col-md-6 mb-3">
                                        <div class="form-floating-custom">
                                            <input type="number" class="form-control"
                                                name="your_stake[{{ $index }}]"
                                                value="{{ old('your_stake.' . $index, $company->your_stake) }}"
                                                placeholder="Enter your stake (%)" min="0" max="100"
                                                step="0.01">
                                            <label for="your_stake[{{ $index }}]">Your Stake (%)</label>
                                            @error('your_stake.' . $index)
                                                <div class="text-danger mt-1">{{ $message }}</div>
                                            @enderror
                                        </div>
                                    </div>

                                    <div class="col-md-6 mb-3">
                                        <div class="form-floating-custom">
                                            <input type="number" class="form-control"
                                                name="stake_funding[{{ $index }}]"
                                                value="{{ old('stake_funding.' . $index, $company->stake_funding) }}"
                                                placeholder="Enter stake funding">
                                            <label for="stake_funding[{{ $index }}]."Stake Funding><span
                                                    class="funding_currency_label">funding_currency_label">()</span></label>
                                            @error('stake_funding.' . $index)
                                                <div class="text-danger mt-1">{{ $message }}</div>
                                    @endif
                                </div>
                    </div>
                    @endforeach
                </div>

                <!-- Terms and Conditions -->
                <div class="mb-4">
                    <div class="form-check">
                        <input class="form-check-input" type="checkbox" name="agreed_to_terms" id="agreed_to_terms"
                            required>
                        <label class="form-check-label" for="agreed_to_terms" for="agreed_to_terms">
                            I agree to the <a href="#" class="text-primary">"Terms and Conditions</a>
                            and
                            <a href="#" class="text-primary">Privacy Policy</a> *
                        </label>
                    </div>
                </div>

                <!-- Submit Buttons -->
                <div class="d-flex flex-column flex-sm-row gap-3">
                    <a href="#" class="btn btn-outline-secondary flex-fill">
                        <i class="fas fa-arrow-left me-2"></i> Back
                    </a>
                    <button type="submit" class="btn btn-primary flex-fill"
                        style="background-color: #2E50A9B9; color: white;">
                        <i class="fas fa-check me-2"></i> Update Profile
                    </button>
                </div>
                </form>
            @else
                <div class="text-center mt-4">
                    <p class="text-muted">
                        <i class="fas fa-info-circle me-2"></i>
                        Profile is approved and cannot be edited.
                    </p>
                </div>
                @endif
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
        $(document).ready(function() {
            // Initialize Select2 for multiple selects
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

            // Function to toggle company information visibility
            function toggleCompanyInformation() {
                const existingCompanyValue = $('input[name="existing_company"]:checked').val();
                const companyInfoSections = $('.company-information');
                if (existingCompanyValue === '1') {
                    companyInfoSections.slideDown(300);
                } else {
                    companyInfoSections.slideUp(300);
                    clearCompanyFields();
                }
            }

            // Function to clear company-related fields
            function clearCompanyFields() {
                $('.company-information input[type="text"]').val('');
                $('.company-information input[type="email"]').val('');
                $('.company-information input[type="url"]').val('');
                $('.company-information input[type="tel"]').val('');
                $('.company-information input[type="number"]').val('');
                $('.company-information select').val('').trigger('change');
                $('.company-information input[type="file"]').val('');
                $('#business_logo_preview').empty();
                $('#product_photos_preview').empty();
                $('#investor_profile_preview').empty();
                $('#pitch_deck_preview').empty();
            }

            // Event listener for existing company radio buttons
            $('input[name="existing_company"]').on('change', function() {
                console.log('Existing Company Value:', $(this).val());
                toggleCompanyInformation();
                console.log('Update Profile Button Visibility:', $('.btn:contains("Update Profile")').is(
                    ':visible'));
            });

            // Initialize the toggle on page load
            toggleCompanyInformation();

            // Initialize Flatpickr for DOB
            const dobInput = $('#dob');
            const ageInput = $('#age');
            const dobError = $('#dob_error');

            flatpickr("#dob", {
                dateFormat: "d/m/Y",
                maxDate: "today",
                minDate: new Date().setFullYear(new Date().getFullYear() - 100),
                disableMobile: "true",
                clickOpens: true,
                allowInput: false,
                onChange: function(selectedDates, dateStr, instance) {
                    if (selectedDates.length > 0) {
                        const dob = selectedDates[0];
                        const today = new Date();
                        let age = today.getFullYear() - dob.getFullYear();
                        const m = today.getMonth() - dob.getMonth();
                        if (m < 0 || (m === 0 && today.getDate() < dob.getDate())) {
                            age--;
                        }

                        if (isNaN(age) || age < 18) {
                            dobError.text('You must be at least 18 years old.').removeClass('d-none');
                            dobInput.val('');
                            ageInput.val('');
                        } else {
                            dobError.addClass('d-none');
                            ageInput.val(age);
                        }
                    } else {
                        dobError.addClass('d-none');
                        ageInput.val('');
                    }
                }
            });

            // File upload preview functionality for new uploads
            function setupFilePreview(inputId, previewId, fileType = 'image') {
                $(`#${inputId}`).on('change', function(e) {
                    const files = e.target.files;
                    const previewContainer = $(`#${previewId}`);

                    previewContainer.empty();

                    for (let file of files) {
                        if (fileType === 'image') {
                            const reader = new FileReader();
                            reader.onload = function(e) {
                                const img = $('<img>').attr('src', e.target.result)
                                    .addClass('img-thumbnail')
                                    .css({
                                        'max-width': '150px',
                                        'max-height': '150px',
                                        'object-fit': 'cover',
                                        'margin': '5px'
                                    });
                                previewContainer.append(img);
                            };
                            reader.readAsDataURL(file);
                        } else if (fileType === 'pdf') {
                            const fileName = file.name;
                            const fileSize = (file.size / 1024 / 1024).toFixed(2);
                            const pdfPreview = $('<div>').addClass('pdf-preview')
                                .html(`
                            <div class="d-flex align-items-center p-2 border rounded mb-2">
                                <i class="fas fa-file-pdf text-danger me-2"></i>
                                <div>
                                    <div class="fw-bold">${fileName}</div>
                                    <small class="text-muted">${fileSize} MB</small>
                                </div>
                            </div>
                        `);
                            previewContainer.append(pdfPreview);
                        }
                    }
                });
            }

            // Setup file previews for new uploads
            // setupFilePreview('business_logo', 'business_logo_preview', 'image');
            setupFilePreview('product_photos', 'product_photos_preview', 'image');
            setupFilePreview('investor_profile', 'investor_profile_preview', 'pdf');
            setupFilePreview('pitch_deck', 'pitch_deck_preview', 'pdf');

            // Form validation
            $('form').on('submit', function(e) {
                let hasErrors = false;

                // Clear previous errors
                $('.text-danger').addClass('d-none');

                // Required field validation
                const requiredFields = [
                    'full_name', 'country', 'state', 'city', 'pin_code',
                    'dob', 'qualification', 'investor_type', 'investment_range'
                ];

                requiredFields.forEach(field => {
                    const value = $(`[name="${field}"]`).val();
                    if (!value || value.trim() === '') {
                        $(`#${field}_error`).removeClass('d-none').text('This field is required');
                        hasErrors = true;
                    }
                });

                // Check if preferred startup stage is selected
                const preferredStage = $('#preferred_startup_stage').val();
                if (!preferredStage || preferredStage.length === 0) {
                    $('#preferred_startup_stage_error').removeClass('d-none').text(
                        'Please select at least one startup stage');
                    hasErrors = true;
                }

                // Email validation
                const email = $('[name="email"]').val();
                const emailRegex = /^[^\s@]+@[^\s@]+\.[^\s@]+$/;
                if (email && !emailRegex.test(email)) {
                    $('[name="email"]').next('.text-danger').removeClass('d-none').text(
                        'Please enter a valid email address');
                    hasErrors = true;
                }

                // Phone validation
                const phone = $('[name="phone_number"]').val();
                if (phone && (phone.length < 10 || phone.length > 12)) {
                    $('#phone_number_error').removeClass('d-none').text(
                        'Phone number must be between 10-12 digits');
                    hasErrors = true;
                }

                // Pin code validation
                const pinCode = $('[name="pin_code"]').val();
                if (pinCode && pinCode.length !== 6) {
                    $('#pin_code_error').removeClass('d-none').text('Pin code must be 6 digits');
                    hasErrors = true;
                }

                if (hasErrors) {
                    e.preventDefault();
                    $('html, body').animate({
                        scrollTop: $('.text-danger:not(.d-none)').first().offset().top - 100
                    }, 500);
                }
            });

            // Real-time validation
            $('[name="pin_code"]').on('input', function() {
                const value = $(this).val();
                if (value.length > 6) {
                    $(this).val(value.slice(0, 6));
                }
            });

            $('[name="phone_number"]').on('input', function() {
                const value = $(this).val();
                if (value.length > 12) {
                    $(this).val(value.slice(0, 12));
                }
            });
        });

        document.addEventListener('DOMContentLoaded', function() {
            const storageBaseUrl = 'http://127.0.0.1:8000/storage/';

            // Define folder mappings for file types
            const folderMap = {
                businessLogo: 'business_logos',
                productPhotos: 'product_photos',
                pitchDeck: 'pitch_decks',
                investorProfile: 'investor_profiles'
            };

            // Generic function to display previews for existing files
            function displayFilePreview(filePaths, previewId, fileType = 'image') {
                const previewContainer = document.getElementById(previewId);
                if (!previewContainer) {
                    console.warn(`Preview container #${previewId} not found.`);
                    return;
                }

                previewContainer.innerHTML = ''; // Clear existing content

                // Handle single file or array of files
                const files = Array.isArray(filePaths) ? filePaths : (filePaths ? [filePaths] : []);

                files.forEach(filePath => {
                    if (!filePath) return;

                    // Construct file URL
                    const folder = folderMap[fileType === 'image' ? (previewId.includes('business_logo') ?
                        'businessLogo' : 'productPhotos') : (previewId.includes('pitch_deck') ?
                        'pitchDeck' : 'investorProfile')];
                    const cleanPath = filePath.startsWith(`${folder}/`) ? filePath :
                        `${folder}/${filePath.split('/').pop()}`;
                    const fullUrl = storageBaseUrl + cleanPath;

                    console.log(`Displaying ${fileType} preview for: ${fullUrl}`);

                    if (fileType === 'image') {
                        const img = document.createElement('img');
                        img.src = fullUrl;
                        img.style.maxWidth = '150px';
                        img.style.maxHeight = '150px';
                        img.style.margin = '5px';
                        img.style.objectFit = 'cover';
                        img.onerror = () => console.error(`Failed to load ${fileType}: ${fullUrl}`);
                        previewContainer.appendChild(img);
                    } else if (fileType === 'pdf') {
                        const fileName = filePath.split('/').pop();
                        const pdfPreview = document.createElement('div');
                        pdfPreview.className = 'pdf-preview';
                        pdfPreview.innerHTML = `
                    <div class="d-flex align-items-center p-2 border rounded mb-2">
                        <i class="fas fa-file-pdf text-danger me-2"></i>
                        <div>
                            <div class="fw-bold">${fileName}</div>
                            <small class="text-muted">PDF</small>
                        </div>
                    </div>
                `;
                        previewContainer.appendChild(pdfPreview);
                    }
                });
            }

            // Display previews for existing files
            if (typeof existingFiles !== 'undefined' && existingFiles) {
                if (existingFiles.business_logo) {
                    displayFilePreview(existingFiles.business_logo, 'business_logo_preview', 'image');
                }
                if (existingFiles.product_photos) {
                    displayFilePreview(existingFiles.product_photos, 'product_photos_preview', 'image');
                }
                if (existingFiles.pitch_deck) {
                    displayFilePreview(existingFiles.pitch_deck, 'pitch_deck_preview', 'pdf');
                }
                if (existingFiles.investor_profile) {
                    displayFilePreview(existingFiles.investor_profile, 'investor_profile_preview', 'pdf');
                }
            } else {
                console.warn('existingFiles is undefined or not provided.');
            }

            // Setup event listeners for new file uploads
            const fileInputs = [{
                    inputId: 'business_logo',
                    previewId: 'business_logo_preview',
                    type: 'image'
                },
                {
                    inputId: 'product_photos',
                    previewId: 'product_photos_preview',
                    type: 'image'
                },
                {
                    inputId: 'pitch_deck',
                    previewId: 'pitch_deck_preview',
                    type: 'pdf'
                },
                {
                    inputId: 'investor_profile',
                    previewId: 'investor_profile_preview',
                    type: 'pdf'
                }
            ];

            fileInputs.forEach(({
                inputId,
                previewId,
                type
            }) => {
                const input = document.getElementById(inputId);
                if (input) {
                    input.addEventListener('change', function() {
                        const previewContainer = document.getElementById(previewId);
                        if (!previewContainer) return;

                        previewContainer.innerHTML = ''; // Clear existing preview
                        const files = this.files;

                        for (let file of files) {
                            if (type === 'image') {
                                const reader = new FileReader();
                                reader.onload = function(e) {
                                    const img = document.createElement('img');
                                    img.src = e.target.result;
                                    img.style.maxWidth = '150px';
                                    img.style.maxHeight = '150px';
                                    img.style.margin = '5px';
                                    img.style.objectFit = 'cover';
                                    previewContainer.appendChild(img);
                                };
                                reader.readAsDataURL(file);
                            } else if (type === 'pdf') {
                                const fileName = file.name;
                                const fileSize = (file.size / 1024 / 1024).toFixed(2);
                                const pdfPreview = document.createElement('div');
                                pdfPreview.className = 'pdf-preview';
                                pdfPreview.innerHTML = `
                            <div class="d-flex align-items-center p-2 border rounded mb-2">
                                <i class="fas fa-file-pdf text-danger me-2"></i>
                                <div>
                                    <div class="fw-bold">${fileName}</div>
                                    <small class="text-muted">${fileSize} MB</small>
                                </div>
                            </div>
                        `;
                                previewContainer.appendChild(pdfPreview);
                            }
                        }
                    });
                } else {
                    console.warn(`Input #${inputId} not found.`);
                }
            });

            // Country, State, City logic
            const bizCountrySelect = document.getElementById('company_country');
            const bizStateSelect = document.getElementById('company_state');
            const bizCitySelect = document.getElementById('company_city');
            //const fundingCurrencyLabels = document.querySelectorAll('.funding_currency_label');
            //const countryInput = document.getElementById('country');
            const API_KEY = 'WmtRc2MzTzhLRnltNGNmSjljT3RqakROckhSOFFQSTZqMXBGbVlNUw==';
            const BASE_URL = 'https://api.countrystatecity.in/v1';

            // Get database values for pre-selection
            const dbCountry = "{{ old('company_country', $investor->company_country ?? '') }}";
            const dbState = "{{ old('company_state', $investor->company_state ?? '') }}";
            const dbCity = "{{ old('company_city', $investor->company_city ?? '') }}";

            console.log('Database Values:', {
                dbCountry,
                dbState,
                dbCity
            });

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

                    bizCountrySelect.innerHTML = '<option value="">Select a country</option>';
                    countries.forEach(country => {
                        const option = document.createElement('option');
                        option.value = country.iso2;
                        option.textContent = country.name;
                        bizCountrySelect.appendChild(option);
                    });

                    // Pre-select country from database
                    if (dbCountry) {
                        console.log('Pre-selecting country:', dbCountry);
                        bizCountrySelect.value = dbCountry;
                        if (bizCountrySelect.value === dbCountry) {
                            console.log('Country pre-selected successfully:', dbCountry);
                            await populateStates(dbCountry);
                        } else {
                            console.warn('Country not found in dropdown:', dbCountry);
                        }
                    } else {
                        console.warn('No country value to pre-select (dbCountry is empty)');
                    }
                } catch (error) {
                    console.error('Error fetching countries:', error);
                    bizCountrySelect.innerHTML = '<option value="">Error loading countries</option>';
                }
            }

            async function populateStates(countryIso2) {
                bizStateSelect.innerHTML = '<option value="">Select State</option>';
                bizCitySelect.innerHTML = '<option value="">Select City</option>';

                if (!countryIso2) {
                    console.warn('No country selected for state population');
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
                    console.log(`States for country ${countryIso2}:`, states);

                    states.sort((a, b) => a.name.localeCompare(b.name, 'en', {
                        sensitivity: 'base'
                    }));
                    states.forEach(state => {
                        const option = document.createElement('option');
                        option.value = state.iso2;
                        option.textContent = state.name;
                        bizStateSelect.appendChild(option);
                    });

                    // Pre-select state from database
                    if (dbState) {
                        console.log('Pre-selecting state:', dbState);
                        bizStateSelect.value = dbState;
                        if (bizStateSelect.value === dbState) {
                            console.log('State pre-selected successfully:', dbState);
                            await populateCities(countryIso2, dbState);
                        } else {
                            console.warn('State not found in dropdown:', dbState);
                        }
                    } else {
                        console.warn('No state value to pre-select (dbState is empty)');
                    }
                } catch (error) {
                    console.error('Error fetching states:', error);
                    bizStateSelect.innerHTML = '<option value="">No states available</option>';
                }
            }

            async function populateCities(countryIso2, stateIso2) {
                bizCitySelect.innerHTML = '<option value="">Select City</option>';

                if (!countryIso2 || !stateIso2) {
                    console.warn('No country or state selected for city population');
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
                    console.log(`Cities for state ${stateIso2}:`, cities);

                    cities.forEach(city => {
                        const option = document.createElement('option');
                        option.value = city.name;
                        option.textContent = city.name;
                        bizCitySelect.appendChild(option);
                    });

                    // Pre-select city from database
                    if (dbCity) {
                        console.log('Pre-selecting city:', dbCity);
                        bizCitySelect.value = dbCity;
                        if (bizCitySelect.value === dbCity) {
                            console.log('City pre-selected successfully:', dbCity);
                        } else {
                            console.warn('City not found in dropdown:', dbCity);
                        }
                    } else {
                        console.warn('No city value to pre-select (dbCity is empty)');
                    }
                } catch (error) {
                    console.error('Error fetching cities:', error);
                    bizCitySelect.innerHTML = '<option value="">No cities available</option>';
                }
            }

            //function updateFundingCurrencyLabel() {
            //const selectedCountry = (bizCountrySelect?.value || '').trim().toLowerCase();
            // let label = '';

            //  if (selectedCountry === 'in') {
            //      label = '(₹)';
            //   } else if (selectedCountry !== '') {
            //       label = '($)';
            //   }

            // fundingCurrencyLabels.forEach(el => {
            //     el.textContent = label;
            //  });
            //  }

            const fundingCurrencyLabels = document.querySelectorAll('.funding_currency_label');
            const countryInput = document.getElementById('country');

            function updateFundingCurrencyLabel() {
                const selectedCountry = (countryInput?.value || '').trim().toLowerCase();
                console.log('Selected country:', selectedCountry);
                console.log('Funding currency labels found:', fundingCurrencyLabels.length);

                let label = '(USD)'; // Default to USD

                // Check for India by country code or name
                if (selectedCountry === 'in' || selectedCountry === 'india') {
                    label = '(INR)';
                }

                console.log('Label to set:', label);
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

                const countryError = document.getElementById('company_country_error');
                if (countryCode && countryCode !== '') {
                    if (countryError) {
                        countryError.classList.add('d-none');
                    }
                }
            });

            bizStateSelect?.addEventListener('change', () => {
                const countryCode = bizCountrySelect.value.trim();
                const stateCode = bizStateSelect.value.trim();
                console.log('State changed to:', stateCode);
                populateCities(countryCode, stateCode);
                bizCitySelect.value = '';
            });

            // Initialize on page load
            if (bizCountrySelect) {
                fetchCountries();
                updateFundingCurrencyLabel();
            }
        });
    </script>
@endsection
