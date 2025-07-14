@extends('layouts.app')
<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/flatpickr/4.6.13/flatpickr.min.css">
<script src="https://cdnjs.cloudflare.com/ajax/libs/flatpickr/4.6.13/flatpickr.min.js"></script>
@section('title', 'Entrepreneur Registration - Future Taikun')
{{-- <link href="https://cdnjs.cloudflare.com/ajax/libs/bootstrap/5.3.0/css/bootstrap.min.css" rel="stylesheet"> --}}
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

    .industry-options,
    .y-industry-options,
    .register-types,
    .qualification-options,
    .geography-options,
    .investor-type-options,
    .investment-range-options,
    .funding-currency-options,
    .startup-stage-options {
        display: flex;
        flex-wrap: wrap;
        gap: 10px;
        margin-top: 10px;
    }

    .industry-option,
    .y-industry-option,
    .register-type,
    .qualification-option,
    .geography-option,
    .investor-type-option,
    .investment-range-option,
    .funding-currency-option,
    .startup-stage-option {
        display: inline-block;
    }

    .industry-label,
    .y-industry-label,
    .register-type-label,
    .qualification-label,
    .geography-label,
    .investor-type-label,
    .investment-range-label,
    .funding-currency-label,
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
    .y-industry-label:hover,
    .register-type-label:hover,
    .qualification-label:hover,
    .geography-label:hover,
    .investor-type-label:hover,
    .investment-range-label:hover,
    .funding-currency-label:hover,
    .startup-stage-label:hover {
        background-color: #e9ecef;
        border-color: #FFE7EA;
        color: #6c757d;
        transform: translateY(-1px);
    }

    input[type="radio"]:checked+.industry-label,
    input[type="radio"]:checked+.y-industry-label,
    input[type="radio"]:checked+.register-type-label,
    input[type="radio"]:checked+.qualification-label,
    input[type="checkbox"]:checked+.geography-label,
    input[type="radio"]:checked+.investor-type-label,
    input[type="radio"]:checked+.investment-range-label,
    input[type="radio"]:checked+.funding-currency-label,
    input[type="radio"]:checked+.startup-stage-label {
        background-color: #FFE7EA;
        border-color: #FFE7EA;
        color: black;
        box-shadow: 0 2px 4px rgba(40, 167, 69, 0.3);
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


    .image-preview-container {
        position: relative;
        display: flex;
        flex-wrap: wrap;
        gap: 10px;
    }

    .image-thumbnail {
        position: relative !important;
        width: 100px;
        height: 100px;
        display: inline-block !important;
        overflow: hidden;
        border-radius: 8px;
        border: 1px solid #ccc;
    }

    .image-thumbnail img {
        width: 100%;
        height: 100%;
        display: block !important;
        object-fit: cover;
    }

    .image-thumbnail * {
        pointer-events: none;
    }

    .image-thumbnail button {
        pointer-events: auto;
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

    /* Hide any duplicate images outside thumbnails */
    #product_photos_preview>img {
        display: none !important;
    }

    #business_logo_preview>img {
        display: none !important;
    }

    /* Only show images inside thumbnails */
    .image-thumbnail img {
        display: block !important;
    }

    #y_product_photos_preview>img {
        display: none !important;
    }

    #y_business_logo_preview>img {
        display: none !important;
    }

    /* Only show images inside thumbnails */
    .image-thumbnail img {
        display: block !important;
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
                <div class="step pending" data-step="3">
                    <div class="step-number">3</div>
                    <div class="step-label">Business/Idea Information</div>
                </div>
                <div class="step pending" data-step="4">
                    <div class="step-number">4</div>
                    <div class="step-label">Video Uploads</div>
                </div>
            </div>
        </div>

        {{-- <div class="debug-info">
                        <h4>Debug Information:</h4>
                        <p><strong>Form enctype:</strong> <span id="form-enctype">Not detected</span></p>
                        <p><strong>Input element present:</strong> <span id="input-present">Checking...</span></p>
                        <p><strong>Files selected:</strong> <span id="files-count">0</span></p>
                    </div> --}}

        <div class="col-md-10 col-lg-8">
            <div class="card">
                <div class="card-body p-5">
                    {{-- <div class="text-center mb-4">
                                    <div class="mb-3">
                                    </div>
                                    <h3 style="font-family:mat; font-weight: bold;">Personal Information</h3>
                                </div> --}}

                    <form action="{{ route('entrepreneur.store') }}" method="POST" enctype="multipart/form-data"
                        class="" id="mainForm">
                        @csrf
                        <input type="hidden" name="user_id" value="{{ $user->id }}">
                        <!-- Step 2: Personal Information -->
                        <div class="form-step active" data-step="2">
                            <div class="row mb-4">
                                <div class="text-center mb-4">
                                    <h3 style="font-family:mat; font-weight: bold; margin-left: 5px;">Personal Information
                                    </h3>
                                    {{-- <p class="text-muted">Tell us about yourself and your business idea</p> --}}
                                </div>

                                <div class="col-md-6 mb-3">
                                    <div class="form-floating-custom">
                                        <input type="text" class="form-control" name="full_name" id="full_name"
                                            placeholder="John Deny"
                                            value="{{ old('full_name', $enterprent->full_name ?? '') }}" required>
                                        <label for="full_name">Full Name *</label>
                                        <div class="text-danger mt-1 d-none" id="full_name_error"></div>
                                    </div>
                                </div>

                                <div class="col-md-6 mb-3">
                                    <div class="form-floating-custom">
                                        <input class="form-control" name="email" type="email"
                                            placeholder="john@gmail.com" value="{{ $userEmail }}" readonly>
                                        <label for="email">Email *</label>
                                        <div class="text-danger mt-1 d-none" id="email_error"></div>
                                    </div>
                                </div>

                                {{-- <div class="col-md-6 mb-3">
                                    <div class="form-floating-custom">
                                        <input type="text" class="form-control" placeholder="Type your mobile no."
                                            value="{{ $user->phone_number }}" readonly>
                                        <label for="text">Mobile No.</label>
                                    </div>
                                </div> --}}

                                <div class="col-md-6 mb-3">
                                    <div class="input-group">
                                        <select name="country_code" class="form-select" style="max-width: 120px;">
                                            @foreach ($countries as $country)
                                                <option value="{{ $country['code'] }}"
                                                    {{ $country['code'] == old('country_code', $enterprent->country_code ?? '+91') ? 'selected' : '' }}>
                                                    {{ $country['name'] }} ({{ $country['code'] }})
                                                    {{-- {{ $country['code'] == '+91' ? 'selected' : '' }}>
                                                    {{ $country['name'] }} ({{ $country['code'] }}) --}}
                                                </option>
                                            @endforeach
                                        </select>
                                        <input type="tel" class="form-control" name="phone_number"
                                            placeholder="8527416310"
                                            value="{{ old('phone_number', $enterprent->phone_number ?? '') }}"
                                            maxlength="12" required>
                                    </div>
                                    <div class="text-danger mt-1 d-none" id="phone_number_error"></div>
                                    <div class="text-danger mt-1 d-none" id="country_code_error"></div>
                                </div>

                                <div class="col-md-6 mb-3">
                                    <div class="form-floating-custom">
                                        <input type="text" class="form-control" name="current_address"
                                            id="current_address"
                                            value="{{ old('current_address', $enterprent->current_address ?? '') }}"
                                            placeholder="123 High Street, London, SW1A 1AA, UK">
                                        <label for="current_address">Current Address *</label>
                                        <div class="text-danger mt-1 d-none" id="current_address_error"></div>
                                    </div>
                                </div>

                                {{-- <div class="col-md-6 mb-3">
                                    <div class="form-floating-custom">
                                        <input type="text" class="form-control" name="country" id="country"
                                            value="{{ $autoDetectedCountry }}" readonly>
                                        <label for="country">Country</label>
                                        <div class="text-danger mt-1 d-none" id="country_error"></div>
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
                                            value="{{ old('pin_code', $enterprent->pin_code ?? '') }}"
                                            placeholder="520963">
                                        <label class="from-label">Pin/Zip Code *</label>
                                        <div class="text-danger mt-1 d-done" id="pin_code_error"></div>
                                    </div>
                                </div>

                                {{-- <div class="col-md-6 mb-3">
                                    <div class="form-floating-custom">
                                        <label class="form-label">Date of Birth *</label>
                                        <input type="date" class="form-control" name="dob" id="dob"
                                            required>
                                        <div class="text-danger mt-1 d-none" id="dob_error"></div>
                                    </div>
                                </div> --}}
                                <div class="col-md-6 mb-3">
                                    <div class="form-floating-custom">
                                        <label class="form-label">Date of Birth *</label>
                                        <input type="text" class="form-control" name="dob" id="dob"
                                            value ="{{ old('dob', $enterprent->dob ?? '') }}" placeholder="Select date"
                                            readonly>
                                        <div class="text-danger mt-1 d-none" id="dob_error"></div>
                                    </div>
                                </div>

                                {{-- <div class="col-md-6 mb-3">
                                    <div class="form-group">
                                        <label class="form-label">Highest Qualification *</label>
                                        <div class="qualification-options">
                                            @foreach ($qualifications as $qualification)
                                                <div class="qualification-option">
                                                    <input type="radio" id="qualification_{{ $loop->index }}"
                                                        name="qualification" value="{{ $qualification }}"
                                                        style="display: none;">
                                                    <label for="qualification_{{ $loop->index }}"
                                                        class="qualification-label">
                                                        {{ $qualification }}
                                                    </label>
                                                </div>
                                            @endforeach
                                        </div>
                                        <div class="text-danger mt-1 d-none" id="qualification_error"></div>
                                    </div>
                                </div> --}}

                                <div class="col-md-6 mb-3">
                                    <div class="form-group">
                                        <div class="form-floating-custom">
                                            <select class="form-select" name="qualification" id="qualification">
                                                <option value="">Select Qualification</option>
                                                @foreach ($qualifications as $qualification)
                                                    <option value="{{ $qualification }}"
                                                        {{ old('qualification', $enterprent->qualification ?? '') == $qualification ? 'selected' : '' }}>
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
                                            value="{{ old('age', $enterprent->age ?? '') }}" placeholder="20" readonly>
                                    </div>
                                </div>
                            </div>
                        </div>

                        <!-- Step 3: Business Information -->
                        <div class="form-step" data-step="3">
                            <div class="row mb-4">
                                <div class="text-center mb-4">
                                    <h3 style="font-family:mat; font-weight: bold; margin-left: 5px;">Business Information
                                    </h3>
                                </div>

                                <div class="col-12 mt-3 mb-4">
                                    <div class="form-group">
                                        <label class="form-label fw-bold text-center">Your Business Already
                                            Registered?
                                            *</label>
                                        <div class="d-flex gap-3 mt-2 justify-content-center">
                                            <div class="form-check">
                                                <input class="form-check-input" type="radio" name="register_business"
                                                    id="register_no" value="0" checked>
                                                <label class="form-check-label" for="register_no">No</label>
                                            </div>
                                            <div class="form-check">
                                                <input class="form-check-input" type="radio" name="register_business"
                                                    id="register_yes" value="1">
                                                <label class="form-check-label" for="register_yes">Yes</label>
                                            </div>
                                        </div>
                                        <div class="text-danger mt-1 d-none" id="register_business_error"></div>
                                    </div>
                                </div>
                                <div id="business_details_section_no">
                                    <div class="row">
                                        <div class="col-md-6 mb-3">
                                            <div class="form-floating-custom">
                                                <input type="text" class="form-control" name="business_name"
                                                    value="{{ old('business_name', $enterprent->business_name ?? '') }}"
                                                    placeholder="Nexora Ventures">
                                                <label class="form-label" id="business_name_label">Business Idea Name
                                                    *</label>
                                                <div class="text-danger mt-1 d-none" id="business_name_error"></div>
                                            </div>
                                        </div>

                                        <div class="col-md-6 mb-3">
                                            <div class="form-floating-custom">
                                                <input type="text" class="form-control" name="brand_name"
                                                    value="{{ old('brand_name', $enterprent->brand_name ?? '') }}"
                                                    placeholder="Tech & SaaS">
                                                <label class="form-label" id="brand_name_label">Business Brand Name
                                                    *</label>
                                                <div class="text-danger mt-1 d-none" id="brand_name_error"></div>
                                            </div>
                                        </div>

                                        <div class="col-md-6 mb-3">
                                            <div class="form-floating-custom">
                                                <input type="text" class="form-control" name="business_address"
                                                    value="{{ old('business_address', $enterprent->business_address ?? '') }}"
                                                    placeholder="Nexora Ventures Ltd.2 Farringdon Street London..">
                                                <label class="form-label" id="proposed_business_address_label">Proposed
                                                    Business Address
                                                    *</label>
                                                <div class="text-danger mt-1 d-none" id="proposed_business_address_error">
                                                </div>
                                            </div>
                                        </div>

                                        <div class="col-12 col-md-6 mb-3">
                                            <div class="form-floating-custom">
                                                <label class="form-label w-100">Describe Your Business in One Sentence
                                                    *</label>
                                                <textarea class="form-control" name="business_describe" rows="2" maxlength="75"
                                                    placeholder="Nexora Ventures empowers innovative startups..">{{ old('business_describe', $enterprent->business_describe ?? '') }}</textarea>
                                                <div class="text-danger mt-1 d-none" id="business_describe_error"></div>
                                            </div>
                                        </div>

                                        <div class="col-md-6 mb-3">
                                            <div class="form-floating-custom">
                                                <select name="business_country" class="form-select"
                                                    id="business_country">
                                                    <option value="">Select a country</option>
                                                </select>
                                                <label for="business_country">Business Country *</label>
                                                <div class="text-danger mt-1 d-none" id="business_country_error"></div>
                                            </div>
                                        </div>

                                        <div class="col-md-6 mb-3">
                                            <div class="form-floating-custom">
                                                <select class="form-control" name="business_state" id="business_state">
                                                    <option value="">Select State</option>
                                                </select>
                                                <label for="business_state">Business State *</label>
                                                <div class="text-danger mt-1 d-none" id="business_state_error"></div>
                                            </div>
                                        </div>

                                        <div class="col-md-6 mb-3">
                                            <div class="form-floating-custom">
                                                <select class="form-control" name="business_city" id="business_city">
                                                    <option value="">Select City</option>
                                                </select>
                                                <label for="business_city">Business City *</label>
                                                <div class="text-danger mt-1 d-none" id="business_city_error"></div>
                                            </div>
                                        </div>

                                        {{-- <div class="form-group">
                                            <label class="form-label">Type of Industries *</label>
                                            <div class="industry-options">
                                                @foreach ($industries as $industry)
                                                    <div class="industry-option">
                                                        <input type="radio" id="industry_{{ $loop->index }}"
                                                            name="industry" value="{{ $industry }}"
                                                            style="display: none;">
                                                        <label for="industry_{{ $loop->index }}" class="industry-label">
                                                            {{ $industry }}
                                                        </label>
                                                    </div>
                                                @endforeach
                                            </div>
                                            <div class="text-danger mt-1 d-none" id="industry_error"></div>
                                        </div> --}}

                                        <div class="col-md-6 mb-3">
                                            <div class="form-group">
                                                <div class="form-floating-custom">
                                                    <select class="form-select" name="industry" id="industry">
                                                        <option value="">Select Industries</option>
                                                        @foreach ($industries as $industry)
                                                            <option value="{{ $industry }}"
                                                                {{ old('industry', $enterprent->industry ?? '') == $industry ? 'selected' : '' }}>
                                                                {{ $industry }}
                                                            </option>
                                                        @endforeach
                                                    </select>
                                                    <label for="industry">Select Industries *</label>
                                                </div>
                                                <div class="text-danger mt-1 d-none" id="industry_error"></div>
                                            </div>
                                        </div>

                                        <div class="col-md-4 mb-3">
                                            <div class="form-floating-custom">
                                                <label class="form-label">Own Fund *<span
                                                        class="funding_currency_label">()</span></label>
                                                <input type="number" class="form-control" name="own_fund"
                                                    value="{{ old('own_fund', $enterprent->own_fund ?? '') }}"
                                                    placeholder="5000">
                                                <div class="text-danger mt-1 d-none" id="own_fund_error"></div>
                                            </div>
                                        </div>

                                        <div class="col-md-4 mb-3">
                                            <div class="form-floating-custom">
                                                <label class="form-label">Loan * <span
                                                        class="funding_currency_label">()</span></label>
                                                <input type="number" class="form-control" name="loan"
                                                    placeholder="50000"
                                                    value="{{ old('loan', $enterprent->loan ?? '') }}">
                                                <div class="text-danger mt-1 d-none" id="loan_error"></div>
                                            </div>
                                        </div>

                                        <div class="col-md-4 mb-3">
                                            <div class="form-floating-custom">
                                                <label class="form-label">Invested Amount<span
                                                        class="funding_currency_label">()</span></label>
                                                <input type="text" class="form-control" name="invested_amount"
                                                    id="invested_amount" placeholder="55000"
                                                    value ="{{ old('invested_amount', $enterprent->invested_amount ?? '') }}"
                                                    readonly>
                                                <div class="text-danger mt-1 d-none" id="invested_amount_error"></div>
                                            </div>
                                        </div>

                                        <div class="col-md-4 mb-3">
                                            <div class="form-floating-custom">
                                                {{-- <label class="form-label" id="funding_label">Fund Required for Proposed Business Idea<span class="funding_currency_label">()</span></label> --}}
                                                <label class="form-label">
                                                    <span id="funding_label_text">Fund Required
                                                        Idea *</span>
                                                    <span class="funding_currency_label">()</span>
                                                </label>
                                                <input type="number" class="form-control investment"
                                                    value="{{ old('market_capital', $enterprent->market_capital ?? '') }}"
                                                    name="market_capital" id="market_capital" min="1"
                                                    step="0.01" placeholder="50000">
                                                <div class="text-danger mt-1 d-none" id="market_capital_error"></div>
                                            </div>
                                        </div>

                                        <div class="col-md-4 mb-3">
                                            <div class="form-floating-custom">
                                                <label class="form-label">Equity Offered *(Percentage)</label>
                                                <input type="number" class="form-control equity" name="your_stake"
                                                    value="{{ old('your_stake', $enterprent->your_stake ?? '') }}"
                                                    id="your_stake" placeholder="10" min="1" max="100"
                                                    step="0.01">
                                                <div class="text-danger mt-1 d-none" id="your_stake_error"></div>
                                            </div>
                                        </div>

                                        <div class="col-md-4 mb-3">
                                            <div class="form-floating-custom">
                                                <label class="form-label">Company Valuation <span
                                                        class="funding_currency_label">()</span></label>
                                                <input type="number" class="form-control valuation" id="stake_funding"
                                                    value="{{ old('stake_funding', $enterprent->stake_funding ?? '') }}"
                                                    name="stake_funding" placeholder="500000.00" readonly>
                                                <div class="text-danger mt-1 d-none" id="stake_funding_error"></div>
                                            </div>
                                        </div>

                                        <div class="col-12 mb-3">
                                            {{-- <div class="form-floating-custom"> --}}
                                            <label for="pitch_deck" class="form-label">Upload Business Logo *</label>
                                            <div class="file-upload-wrapper">
                                                <input class="form-control" type="file" id="business_logo"
                                                    name="business_logo" accept=".jpg,.jpeg,.png">
                                                <label for="business_logo" class="file-upload-label w-100">
                                                </label>
                                            </div>
                                            <div id="business_logo_preview" class="image-preview-container mt-2">
                                                {{-- @if ($enterprent && $enterprent->business_logo)
                                                    <img src="{{ Storage::url($enterprent->business_logo) }}"
                                                        alt="Business Logo" style="max-width: 100px;">
                                                    <small class="form-text text-muted">
                                                        Current logo: <a
                                                            href="{{ Storage::url($enterprent->business_logo) }}"
                                                            target="_blank">View</a>
                                                    </small>
                                                @endif --}}
                                            </div>
                                            <div class="text-danger mt-1 d-none" id="business_logo_error"></div>
                                            <small class="text-muted">Select 1 image (JPG, JPEG, PNG only, max 5MB)</small>
                                            {{-- </div> --}}
                                        </div>

                                        <div class="col-12 mb-3">
                                            <label for="product_photos" class="form-label">Upload Products Photos
                                                *</label>
                                            <div class="file-upload-wrapper">
                                                <input class="form-control" type="file" id="product_photos"
                                                    name="product_photos[]" accept=".jpg,.jpeg,.png,.gif" multiple
                                                    style="display: block !important; visibility: visible !important; opacity: 1 !important;">
                                                <label for="product_photos" class="file-upload-label w-100"></label>
                                            </div>
                                            <div id="product_photos_preview"
                                                class="image-preview-container mt-2 d-flex flex-wrap gap-2"></div>

                                            {{-- @if ($enterprent && $enterprent->product_photos && is_array($enterprent->product_photos))
                                                @foreach ($enterprent->product_photos as $index => $photo)
                                                    <div class="existing-photo-preview d-none"
                                                        data-index="{{ $index }}"
                                                        data-url="{{ Storage::url($photo) }}">
                                                        <img src="{{ Storage::url($photo) }}"
                                                            alt="Product Photo {{ $index + 1 }}"
                                                            style="max-width: 100px; margin: 5px;">
                                                        <small class="form-text text-muted">
                                                            Current photo {{ $index + 1 }}: <a
                                                                href="{{ Storage::url($photo) }}"
                                                                target="_blank">View</a>
                                                        </small>
                                                    </div>
                                                @endforeach
                                            @endif --}}
                                            <div class="text-danger mt-1 d-none" id="product_photos_error"></div>
                                            <small class="text-muted">Select 1-3 images (JPG, JPEG, PNG only, max 5MB
                                                each)</small>
                                        </div>
                                        <div class="col-12 mb-3">
                                            <label for="pitch_deck" class="form-label">Upload Business Summary</label>
                                            <div class="file-upload-wrapper">
                                                <input class="form-control" type="file" id="pitch_deck"
                                                    name="pitch_deck" accept=".pdf">
                                                <label for="pitch_deck" class="file-upload-label w-100"></label>
                                            </div>
                                            <div id="pitch_deck_preview" class="pdf-preview-container mt-2">
                                                {{-- @if ($enterprent && $enterprent->pitch_deck)
                                                    <div class="pdf-preview" data-id="existing_pdf">
                                                        <small class="form-text text-muted">
                                                            Current summary: <a
                                                                href="{{ Storage::url($enterprent->pitch_deck) }}"
                                                                target="_blank">View PDF</a>
                                                        </small>
                                                    </div>
                                                @endif --}}
                                            </div>
                                            <div class="text-danger mt-1 d-none" id="pitch_deck_error"></div>
                                            <small class="text-muted">Select 1 PDF (max 5MB)</small>
                                        </div>

                                        {{-- <div id="investment-fields">
                                            <div class="col-12">
                                                <h5 class="text-black mb-3">
                                                    <i class="fas fa-chart-line me-2"></i>Other Company Details
                                                </h5>
                                            </div>
                                            <div id="company-wrapper">
                                                <!-- First Set -->
                                                <div class="company-group border rounded p-3 mb-3">
                                                    <div class="row">
                                                        <div class="col-md-6 mb-3">
                                                            <label class="form-label">Company Name *</label>
                                                            <input type="text" class="form-control"
                                                                name="company_name[]" placeholder="Company Name">
                                                        </div>
                                                        <div class="col-md-6 mb-3">
                                                            <label class="form-label">Investment in This Company <span
                                                                    class="funding_currency_label">()</span></label>
                                                            <input type="number" class="form-control investment"
                                                                name="more_market_capital[]" placeholder="Numeric Input">
                                                        </div>
                                                        <div class="col-md-6 mb-3">
                                                            <label class="form-label">Equity Holding in This Company (in
                                                                %)*</label>
                                                            <input type="number" class="form-control equity"
                                                                name="more_your_stake[]" min="0" max="100"
                                                                step="0.01" placeholder="00.00"
                                                                oninput="validateEquityPercentage(this)"
                                                                onblur="formatEquityValue(this)">
                                                            <div class="text-danger mt-1 d-none equity-error"></div>
                                                        </div>

                                                        <div class="col-md-6 mb-3">
                                                            <label class="form-label">Company Valuation <span
                                                                    class="funding_currency_label">()</span></label>
                                                            <input type="text" class="form-control valuation"
                                                                name="more_stake_funding[]" readonly>
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>

                                            <div class="text-end mb-3 d-flex justify-content-center">
                                                <button type="button" class="btn btn-outline-success"
                                                    id="add-more-company" title="Add Company">
                                                    <i class="fas fa-plus"></i>
                                                </button>
                                            </div>
                                        </div> --}}
                                        {{-- <div class="col-12 mb-3">
                                            <div class="form-floating-custom">
                                                <label class="form-label">Summary of Business Idea *</label>
                                                <textarea class="form-control" name="idea_summary" rows="5" maxlength="500" required
                                                    placeholder="Type your business idea...">{{ old('idea_summary') }}</textarea>
                                                <div class="text-danger mt-1 d-none" id="idea_summary_error"></div>
                                            </div>
                                        </div> --}}
                                    </div>
                                </div>
                                <!-- Business Details Section - Hidden by default -->
                                <div id="business_details_section" style="display: none;">
                                    <div class="row">
                                        <div class="col-md-6 mb-3">
                                            <div class="form-floating-custom">
                                                <input type="text" class="form-control" name="y_business_name"
                                                    value="{{ old('y_business_name', $enterprent->y_business_name ?? '') }}"
                                                    placeholder="Nexora Ventures">
                                                <label class="form-label" id="y_business_name_label">Business Name
                                                    *</label>
                                                <div class="text-danger mt-1 d-none" id="y_business_name_error"></div>
                                            </div>
                                        </div>

                                        <div class="col-md-6 mb-3">
                                            <div class="form-floating-custom">
                                                <input type="text" class="form-control" name="y_brand_name"
                                                    value="{{ old('y_brand_name', $enterprent->y_brand_name ?? '') }}"
                                                    placeholder="Tech & SaaS">
                                                <label class="form-label" id="y_brand_name_label">Brand Name
                                                    *</label>
                                                <div class="text-danger mt-1 d-none" id="y_brand_name_error"></div>
                                            </div>
                                        </div>

                                        <div class="col-12 col-md-6 mb-3">
                                            <div class="form-floating-custom">
                                                <label class="form-label">Describe Your Business in One Sentence *</label>
                                                <textarea class="form-control" name="y_describe_business" rows="2" maxlength="75"
                                                    placeholder="Nexora Ventures empowers innovative..">{{ old('y_describe_business', $enterprent->y_describe_business ?? '') }}</textarea>
                                                <div class="text-danger mt-1 d-none" id="y_describe_business_error"></div>
                                            </div>
                                        </div>

                                        <div class="col-12 col-md-6 mb-3">
                                            <div class="form-floating-custom">
                                                <label class="form-label">Business Address *</label>
                                                <textarea class="form-control" name="y_business_address" rows="2"
                                                    placeholder="Nexora Ventures Ltd.2 Farringdon Street London..">{{ old('y_business_address', $enterprent->y_business_address ?? '') }}</textarea>
                                                <div class="text-danger mt-1 d-none" id="y_business_address_error"></div>
                                            </div>
                                        </div>

                                        {{-- <div class="col-md-6 mb-3">
                                            <div class="form-floating-custom">
                                                <input type="text" class="form-control" name="y_business_country"
                                                    id="y_business_country" value="{{ $autoDetectedCountry }}" readonly>
                                                <label for="y_business_country">Country</label>
                                                <div class="text-danger mt-1 d-none" id="y_business_country_error"></div>
                                            </div>
                                        </div>

                                        <div class="col-md-6 mb-3">
                                            <div class="form-floating-custom">
                                                <label class="form-label">Business State *</label>
                                                <select class="form-control" name="y_business_state"
                                                    id="y_business_state">
                                                    <option value="">Select State</option>
                                                </select>
                                                <div class="text-danger mt-1 d-none" id="y_business_state_error"></div>
                                            </div>
                                        </div>

                                        <div class="col-md-6 mb-3">
                                            <div class="form-floating-custom">
                                                <label class="form-label">Business City *</label>
                                                <select class="form-control" name="y_business_city" id="y_business_city">
                                                    <option value="">Select City</option>
                                                </select>
                                                <div class="text-danger mt-1 d-none" id="y_business_city_error"></div>
                                            </div>
                                        </div> --}}

                                        <div class="col-md-6 mb-3">
                                            <div class="form-floating-custom">
                                                <select name="y_business_country" class="form-select"
                                                    id="y_business_country">
                                                    <option value="">Select a country</option>
                                                </select>
                                                <label for="y_business_country">Business Country *</label>
                                                <div class="text-danger mt-1 d-none" id="y_business_country_error"></div>
                                            </div>
                                        </div>

                                        <div class="col-md-6 mb-3">
                                            <div class="form-floating-custom">
                                                <select class="form-control" name="y_business_state"
                                                    id="y_business_state">
                                                    <option value="">Select State</option>
                                                </select>
                                                <label for="y_business_state">Business State *</label>
                                                <div class="text-danger mt-1 d-none" id="y_business_state_error"></div>
                                            </div>
                                        </div>

                                        <div class="col-md-6 mb-3">
                                            <div class="form-floating-custom">
                                                <select class="form-control" name="y_business_city" id="y_business_city">
                                                    <option value="">Select City</option>
                                                </select>
                                                <label for="y_business_city">Business City *</label>
                                                <div class="text-danger mt-1 d-none" id="y_business_city_error"></div>
                                            </div>
                                        </div>

                                        <div class="col-md-6 mb-3">
                                            <div class="form-floating-custom">
                                                <input type="text" class="form-control" name="y_zipcode"
                                                    value="{{ old('y_zipcode', $enterprent->y_zipcode ?? '') }}"
                                                    placeholder="852963">
                                                <label class="form-label" id="y_zipcode_label">Business Pin / Zip Code
                                                    *</label>
                                                <div class="text-danger mt-1 d-none" id="y_zipcode_error"></div>
                                            </div>
                                        </div>

                                        {{-- <div class="col-md-6 mb-3">
                                            <div class="form-floating-custom">
                                                <label class="form-label">Business Mobile No.</label>
                                                <input type="text" class="form-control" name="business_mobile"
                                                    id="business_mobile"
                                                    placeholder="Type your business mobile number...">
                                                <div class="text-danger mt-1 d-none" id="business_mobile_error"></div>
                                            </div>
                                        </div> --}}

                                        <div class="col-md-6 mb-3">
                                            <div class="input-group">
                                                <select name="business_country_code" class="form-select"
                                                    style="max-width: 120px;">
                                                    @foreach ($countries as $country)
                                                        <option value="{{ $country['code'] }}"
                                                            {{ $country['code'] == '+91' ? 'selected' : '' }}>
                                                            {{ $country['name'] }} ({{ $country['code'] }})
                                                        </option>
                                                    @endforeach
                                                </select>
                                                <input type="tel" class="form-control" name="business_mobile"
                                                    placeholder="7419638520"
                                                    value="{{ old('business_mobile', $enterprent->business_mobile ?? '') }}"
                                                    maxlength="12">
                                            </div>
                                            <div class="text-danger mt-1 d-none" id="business_mobile_error"></div>
                                            <div class="text-danger mt-1 d-none" id="business_mobile_error"></div>
                                        </div>

                                        <div class="col-md-6 mb-3">
                                            <div class="form-floating-custom">
                                                <label class="form-label">Business Email</label>
                                                <input type="text" class="form-control" name="business_email"
                                                    value ="{{ old('business_email', $enterprent->business_email ?? '') }}"
                                                    id="business_email" placeholder="john@gmail.com">
                                                <div class="text-danger mt-1 d-none" id="business_email_error"></div>
                                            </div>
                                        </div>

                                        <div class="col-md-6 mb-3">
                                            <div class="form-floating-custom">
                                                <input type="url" class="form-control" name="website_links"
                                                    value="{{ old('website_links', $enterprent->website_links ?? '') }}"
                                                    placeholder="https://xyz.com">
                                                <div class="text-danger mt-1 d-none" id="website_links_error"></div>
                                                <label class="form-label">Website / Social Links</label>
                                            </div>
                                        </div>

                                        <div class="col-md-6 mb-3">
                                            <div class="form-floating-custom">
                                                <label class="form-label">Business Started Year *</label>
                                                <select class="form-control" name="business_year" id="business_year">
                                                    <option value="">Select Year</option>
                                                    @php
                                                        $startYear = date('Y') - 50; // Adjust range as needed
                                                        $endYear = date('Y');
                                                        for ($year = $endYear; $year >= $startYear; $year--) {
                                                            $selected =
                                                                old(
                                                                    'business_year',
                                                                    $enterprent->business_year ?? '',
                                                                ) == $year
                                                                    ? 'selected'
                                                                    : '';
                                                            echo "<option value='$year' $selected>$year</option>";
                                                        }
                                                    @endphp
                                                    <!-- Will be populated dynamically -->
                                                </select>
                                                <div class="text-danger mt-1 d-none" id="business_year_error"></div>
                                            </div>
                                        </div>

                                        <div class="col-md-6 mb-3">
                                            <div class="form-floating-custom">
                                                <label class="form-label">Years in Business</label>
                                                <input type="text" class="form-control" name="business_year_count"
                                                    value ="{{ old('business_year_count', $enterprent->business_year_count ?? '') }}"
                                                    id="business_year_count" readonly placeholder="3">
                                                <div class="text-danger mt-1 d-none" id="business_year_count_error"></div>
                                            </div>
                                        </div>

                                        <div class="col-md-6 mb-3">
                                            <div class="form-group">
                                                {{-- <div class="register-types">
                                                    @foreach ($registratioTypes as $registratiotype)
                                                        <div class="register-type">
                                                            <input type="radio" id="register_{{ $loop->index }}"
                                                                name="registration_type_of_entity"
                                                                value="{{ $registratiotype }}" style="display: none;">
                                                            <label for="register_{{ $loop->index }}"
                                                                class="register-type-label">
                                                                {{ $registratiotype }}
                                                            </label>
                                                        </div>
                                                    @endforeach
                                                </div> --}}
                                                <div class="form-floating-custom">
                                                    <label class="form-label">Business Register Type Entity *</label>
                                                    <select class="form-select" id="registration_type_of_entity"
                                                        name="registration_type_of_entity">
                                                        <option value="">Select Entity Type</option>
                                                        @foreach ($registratioTypes as $registratiotype)
                                                            <option value="{{ $registratiotype }}"
                                                                {{ old('registration_type_of_entity', $enterprent->registration_type_of_entity ?? '') == $registratiotype ? 'selected' : '' }}>
                                                                {{ $registratiotype }}
                                                            </option>
                                                        @endforeach
                                                    </select>
                                                    {{-- <label class="form-label">Select Entity Type *</label> --}}
                                                    <div class="text-danger mt-1 d-none"
                                                        id="registration_type_of_entity_error"></div>
                                                </div>
                                            </div>
                                        </div>

                                        <div class="col-md-6 mb-3">
                                            <div class="form-floating-custom">
                                                <label class="form-label">Business Tax Registration Number *</label>
                                                <input type="text" class="form-control" name="tax_registration_number"
                                                    value ="{{ old('tax_registration_number', $enterprent->tax_registration_number ?? '') }}"
                                                    id="tax_registration_number" placeholder="SC123456">
                                                <div class="text-danger mt-1 d-none" id="tax_registration_number_error">
                                                </div>
                                            </div>
                                        </div>

                                        <div class="col-md-6 mb-3">
                                            {{-- <div class="y-industry-options">
                                                @foreach ($industries as $industry)
                                                    <div class="y-industry-option">
                                                        <input type="radio" id="y-industry_{{ $loop->index }}"
                                                            name="y_type_industries" value="{{ $industry }}"
                                                            style="display: none;">
                                                        <label for="y-industry_{{ $loop->index }}"
                                                            class="y-industry-label">
                                                            {{ $industry }}
                                                        </label>
                                                    </div>
                                                @endforeach
                                            </div> --}}
                                            <div class="form-floating-custom">
                                                <label class="form-label">Type of Industries *</label>
                                                <select class="form-select" id="y_type_industries"
                                                    name="y_type_industries">
                                                    <option value="">Select Industry</option>
                                                    @foreach ($industries as $industry)
                                                        <option value="{{ $industry }}"
                                                            {{ old('y_type_industries', $enterprent->y_type_industries ?? '') == $industry ? 'selected' : '' }}>
                                                            {{ $industry }}
                                                        </option>
                                                    @endforeach
                                                </select>

                                                <div class="text-danger mt-1 d-none" id="y_type_industries_error"></div>
                                            </div>
                                        </div>

                                        <div class="col-md-6 mb-3">
                                            <div class="form-floating-custom">
                                                <label class="form-label">Number of Founder *</label>
                                                <input type="number" class="form-control" name="founder_number"
                                                    value ="{{ old('founder_number', $enterprent->founder_number ?? '') }}"
                                                    min="1" max="20" placeholder="2">
                                                <div class="text-danger mt-1 d-none" id="founder_number_error"></div>
                                            </div>
                                        </div>

                                        <div class="col-md-6 mb-3">
                                            <div class="form-floating-custom">
                                                <label class="form-label">Number of Employee *</label>
                                                <input type="number" class="form-control" name="employee_number"
                                                    value ="{{ old('employee_number', $enterprent->employee_number ?? '') }}"
                                                    min="1" max="2000" placeholder="10">
                                                <div class="text-danger mt-1 d-none" id="employee_number_error"></div>
                                            </div>
                                        </div>

                                        <div class="col-md-4 mb-3">
                                            <div class="form-floating-custom">
                                                <label class="form-label">Own Fund *<span
                                                        class="funding_currency_label">()</span></label>
                                                <input type="number" class="form-control" name="y_own_fund"
                                                    value="{{ old('y_own_fund', $enterprent->y_own_fund ?? '') }}"
                                                    placeholder="5000">
                                                <div class="text-danger mt-1 d-none" id="y_own_fund_error"></div>
                                            </div>
                                        </div>

                                        <div class="col-md-4 mb-3">
                                            <div class="form-floating-custom">
                                                <label class="form-label">Loan *<span
                                                        class="funding_currency_label">()</span></label>
                                                <input type="number" class="form-control" name="y_loan"
                                                    value="{{ old('y_loan', $enterprent->y_loan ?? '') }}"
                                                    placeholder="10000">
                                                <div class="text-danger mt-1 d-none" id="y_loan_error"></div>
                                            </div>
                                        </div>

                                        <div class="col-md-4 mb-3">
                                            <div class="form-floating-custom">
                                                <label class="form-label">Total Invested Amount<span
                                                        class="funding_currency_label">()</span></label>
                                                <input type="text" class="form-control" name="y_invested_amount"
                                                    value="{{ old('y_invested_amount', $enterprent->y_invested_amount ?? '') }}"
                                                    id="y_invested_amount" placeholder="15000" readonly>
                                                <div class="text-danger mt-1 d-none" id="y_invested_amount_error"></div>
                                            </div>
                                        </div>

                                        <!-- Revenue Section -->
                                        <div class="col-12 mb-3">
                                            <h6 class="mb-3" style="color: black; font-weight:bold;">
                                                Financial Data of Last Three years<span
                                                    class="funding_currency_label">()</span>
                                            </h6>
                                        </div>

                                        <div class="col-md-4 mb-3">
                                            <div class="form-floating-custom">
                                                <label class="form-label">Revenue from Sales *<span
                                                        class="funding_currency_label">()</span></label>
                                                <input type="number" class="form-control" name="business_revenue1"
                                                    value="{{ old('business_revenue1', $enterprent->business_revenue1 ?? '') }}"
                                                    min="0" step="0.01" placeholder="60000">
                                                <div class="text-danger mt-1 d-none" id="business_revenue1_error"></div>
                                            </div>
                                        </div>

                                        <div class="col-md-4 mb-3">
                                            <div class="form-floating-custom">
                                                <label class="form-label">Gross Profit *<span
                                                        class="funding_currency_label">()</span></label>
                                                <input type="number" class="form-control" name="business_revenue2"
                                                    value="{{ old('business_revenue2', $enterprent->business_revenue2 ?? '') }}"
                                                    min="0" step="0.01" placeholder="90000">
                                                <div class="text-danger mt-1 d-none" id="business_revenue2_error"></div>
                                            </div>
                                        </div>

                                        <div class="col-md-4 mb-3">
                                            <div class="form-floating-custom">
                                                <label class="form-label">Net Profit *<span
                                                        class="funding_currency_label">()</span></label>
                                                <input type="number" class="form-control" name="business_revenue3"
                                                    value="{{ old('business_revenue3', $enterprent->business_revenue3 ?? '') }}"
                                                    min="0" step="0.01" placeholder="1500000">
                                                <div class="text-danger mt-1 d-none" id="business_revenue3_error"></div>
                                            </div>
                                        </div>

                                        <div class="col-md-4 mb-3">
                                            <div class="form-floating-custom">
                                                {{-- <label class="form-label" id="funding_label">Fund Required for Proposed Business Idea<span class="funding_currency_label">()</span></label> --}}
                                                <label class="form-label">
                                                    <span id="funding_label_text">Fund Required for Current Business
                                                        Idea *</span>
                                                    <span class="funding_currency_label">()</span>
                                                </label>
                                                <input type="number" class="form-control investment"
                                                    value ="{{ old('y_market_capital', $enterprent->y_market_capital ?? '') }}"
                                                    name="y_market_capital" id="y_market_capital" min="1"
                                                    step="0.01" placeholder="90000">
                                                <div class="text-danger mt-1 d-none" id="y_market_capital_error"></div>
                                            </div>
                                        </div>

                                        <div class="col-md-4 mb-3">
                                            <div class="form-floating-custom">
                                                <label class="form-label">Equity Offered *(Percentage)</label>
                                                <input type="number" class="form-control equity" name="y_your_stake"
                                                    value ="{{ old('y_your_stake', $enterprent->y_your_stake ?? '') }}"
                                                    id="y_your_stake" placeholder="20" min="1" max="100"
                                                    step="0.01">
                                                <div class="text-danger mt-1 d-none" id="y_your_stake_error"></div>
                                            </div>
                                        </div>

                                        <div class="col-md-4 mb-3">
                                            <div class="form-floating-custom">
                                                <label class="form-label">Company Valuation<span
                                                        class="funding_currency_label">()</span></label>
                                                <input type="number" class="form-control valuation" id="y_stake_funding"
                                                    value ="{{ old('y_stake_funding', $enterprent->y_stake_funding ?? '') }}"
                                                    name="y_stake_funding" placeholder="450000.00" readonly>
                                                <div class="text-danger mt-1 d-none" id="y_stake_funding_error"></div>
                                            </div>
                                        </div>

                                        <div class="col-12 mb-3">
                                            {{-- <div class="form-floating-custom"> --}}
                                            <label for="y_pitch_deck" class="form-label">Upload Business Logo *</label>
                                            <div class="file-upload-wrapper">
                                                <input class="form-control" type="file" id="y_business_logo"
                                                    name="y_business_logo">
                                                <label for="y_business_logo" class="file-upload-label w-100">

                                                </label>
                                            </div>
                                            <div id="y_business_logo_preview" class="image-preview-container mt-2">
                                                @if ($enterprent && $enterprent->y_business_logo)
                                                    <img src="{{ Storage::url($enterprent->y_business_logo) }}"
                                                        alt="Business Logo" style="max-width: 100px;">
                                                    <small class="form-text text-muted">
                                                        Current logo: <a
                                                            href="{{ Storage::url($enterprent->y_business_logo) }}"
                                                            target="_blank">View</a>
                                                    </small>
                                                @endif
                                            </div>
                                            <div class="text-danger mt-1 d-none" id="y_business_logo_error"></div>
                                            <small class="text-muted">Select 1 image (JPG, JPEG, PNG only, max 5MB)</small>
                                            {{-- </div> --}}
                                        </div>

                                        <div class="col-12 mb-3">
                                            <label for="y_product_photos" class="form-label">Upload Products
                                                Photos *</label>
                                            <div class="file-upload-wrapper">
                                                <input class="form-control" type="file" id="y_product_photos"
                                                    name="y_product_photos[]" accept=".jpg,.jpeg,.png,.gif" multiple
                                                    style="display: block !important; visibility: visible !important; opacity: 1 !important;">
                                                <label for="y_product_photos" class="file-upload-label w-100">
                                                </label>
                                            </div>
                                            <div id="y_product_photos_preview"
                                                class="image-preview-container mt-2 d-flex flex-wrap gap-2">
                                                @if ($enterprent && $enterprent->y_product_photos && is_array($enterprent->y_product_photos))
                                                    @foreach ($enterprent->y_product_photos as $index => $photo)
                                                        <div class="existing-photo-preview d-none"
                                                            data-index="{{ $index }}"
                                                            data-url="{{ Storage::url($photo) }}">
                                                            <img src="{{ Storage::url($photo) }}"
                                                                alt="Product Photo {{ $index + 1 }}"
                                                                style="max-width: 100px; margin: 5px;">
                                                            <small class="form-text text-muted">
                                                                Current photo {{ $index + 1 }}: <a
                                                                    href="{{ Storage::url($photo) }}"
                                                                    target="_blank">View</a>
                                                            </small>
                                                        </div>
                                                    @endforeach
                                                @endif
                                            </div>
                                            <div class="text-danger mt-1 d-none" id="y_product_photos_error"></div>
                                            <small class="text-muted">Select 1-3 images (JPG, JPEG, PNG only, max 5MB
                                                each)</small>
                                        </div>

                                        <div class="col-12 mb-3">
                                            {{-- <div class="form-floating-custom"> --}}
                                            <label for="y_pitch_deck" class="form-label">Upload Business Summary</label>
                                            <div class="file-upload-wrapper">
                                                <input class="form-control" type="file" id="y_pitch_deck"
                                                    name="y_pitch_deck" accept=".pdf">
                                                <label for="y_pitch_deck" class="file-upload-label w-100">
                                                </label>
                                            </div>
                                            <div id="y_pitch_deck_preview" class="pdf-preview-container mt-2">
                                                @if ($enterprent && $enterprent->y_pitch_deck)
                                                    <div class="pdf-preview">
                                                        <small class="form-text text-muted">
                                                            Current summary: <a
                                                                href="{{ Storage::url($enterprent->y_pitch_deck) }}"
                                                                target="_blank">View PDF</a>
                                                        </small>
                                                    </div>
                                                @endif
                                            </div>
                                            <div class="text-danger mt-1 d-none" id="y_pitch_deck_error"></div>
                                            <small class="text-muted">Upload one PDF file (maximum 5MB)</small>
                                        </div>

                                        {{-- <div id="investment-fields">
                                            <div class="col-12">
                                                <h5 class="text-black mb-3">
                                                    <i class="fas fa-chart-line me-2"></i>Other Company Details
                                                </h5>
                                            </div>
                                            <div id="company-wrapper">
                                                <!-- First Set -->
                                                <div class="company-group border rounded p-3 mb-3">
                                                    <div class="row">
                                                        <div class="col-md-6 mb-3">
                                                            <div class="form-floating-custom">
                                                                <label class="form-label">Company Name *</label>
                                                                <input type="text" class="form-control"
                                                                    name="company_name[]" placeholder="Company Name">

                                                            </div>
                                                        </div>
                                                        <div class="col-md-6 mb-3">
                                                            <div class="form-floating-custom">
                                                                <label class="form-label">Investment in This Company <span
                                                                        class="funding_currency_label">()</span></label>
                                                                <input type="number" class="form-control investment"
                                                                    name="more_market_capital[]"
                                                                    placeholder="Numeric Input">
                                                            </div>
                                                        </div>
                                                        <div class="col-md-6 mb-3">
                                                            <div class="form-floating-custom">
                                                                <label class="form-label">Equity Holding in This Company
                                                                    (in
                                                                    %)*</label>
                                                                <input type="number" class="form-control equity"
                                                                    name="more_your_stake[]" min="0"
                                                                    max="100" step="0.01" placeholder="00.00"
                                                                    oninput="validateEquityPercentage(this)"
                                                                    onblur="formatEquityValue(this)">
                                                                <div class="text-danger mt-1 d-none equity-error"></div>
                                                            </div>
                                                        </div>

                                                        <div class="col-md-6 mb-3">
                                                            <div class="form-floating-custom">
                                                                <label class="form-label">Company Valuation <span
                                                                        class="funding_currency_label">()</span></label>
                                                                <input type="text" class="form-control valuation"
                                                                    name="more_stake_funding[]" readonly>

                                                            </div>
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>

                                            <div class="text-end mb-3 d-flex justify-content-center">
                                                <button type="button" class="btn btn-outline-success"
                                                    id="add-more-company" title="Add Company">
                                                    <i class="fas fa-plus"></i>
                                                </button>
                                            </div>
                                        </div> --}}
                                    </div>
                                </div>
                            </div>
                        </div>

                        <!-- Step 4: Legal and Funding Information -->
                        <div class="form-step" data-step="4">
                            <div class="row mb-4">
                                <div class="col-12">
                                    {{-- <h5 class="mb-3" style="color: black; font-family:mat; font-weight:bold;">
                                                        <i class="fas fa-money-bill me-2"></i>Funding Information
                                                    </h5> --}}
                                </div>
                                {{-- <div class="col-12 mb-3">
                                    <div class="form-floating-custom">
                                        <label for="pitch_video" class="form-label">Pitch Video Link</label>
                                        <input type="url" class="form-control" id="pitch_video" name="pitch_video"
                                            value="{{ old('pitch_video') }}" placeholder="https://xyz.com..." required>
                                        <div class="text-danger mt-1 d-none" id="pitch_video_error"></div>
                                    </div>
                                </div> --}}
                                <div class="col-12 mb-3">
                                    <div class="form-floating-custom">
                                        <label for="video_upload" class="form-label">Upload Pitch Video</label>
                                        <input type="file" class="form-control" id="video_upload" name="video_upload"
                                            accept="video/mp4,video/x-m4v,video/avi,video/webm">
                                        <div class="text-danger mt-1 d-none" id="video_upload_error"></div>
                                        <small class="text-muted">Upload one video file (MP4, AVI, or WebM)</small>
                                    </div>
                                </div>
                            </div>
                            <!-- Terms and Conditions -->
                            <div class="mb-4">
                                <div class="form-check">
                                    <input class="form-check-input" type="checkbox" name="agreed_to_terms"
                                        id="agreed_to_terms" required>
                                    <label class="form-check-label" for="agreed_to_terms">
                                        I agree to the <a href="#" class="text-primary">Terms and Conditions</a> and
                                        <a href="#" class="text-primary">Privacy Policy</a> *
                                    </label>
                                    <div class="text-danger mt-1 d-none" id="agreed_to_terms_error"></div>
                                </div>
                            </div>
                        </div>
                        <!-- Step 5: Documents -->
                        <div class="form-step" data-step="5">
                            <div class="row mb-4">
                                <div class="col-12">
                                    {{-- <h5 class="mb-3" style="color: black; font-family:mat; font-weight:bold;">
                                                        <i class="fas fa-file me-2"></i>Documents
                                                    </h5> --}}
                                </div>

                                <div class="col-12 mb-3">
                                    <div class="alert alert-info">
                                        <i class="fas fa-info-circle me-2"></i>
                                        <strong>Review your information:</strong> Please review all the information you've
                                        provided
                                        before submitting your registration.
                                    </div>
                                </div>
                            </div>
                        </div>


                        <div class="step-navigation">
                            {{-- <button type="button" onclick="debugForm()" class="btn btn-info mb-3">Debug Form Data</button> --}}
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
    <script src="https://cdnjs.cloudflare.com/ajax/libs/bootstrap/5.3.0/js/bootstrap.bundle.min.js"></script>
    <script>
        function clearCurrentStep() {
            const currentStepEl = document.querySelector(`.form-step[data-step="${currentStep}"]`);

            // Clear non-readonly inputs and textareas, excluding email
            currentStepEl.querySelectorAll(
                'input[type="text"]:not([name="email"]), input[type="email"]:not([name="email"]), input[type="tel"], input[type="number"], input[type="url"], textarea'
            ).forEach(element => {
                if ((element.name === 'dob' || element.name === 'age') && element.hasAttribute('readonly')) {
                    element.removeAttribute('readonly');
                    element.value = '';
                    element.setAttribute('readonly', 'readonly');
                } else {
                    element.value = '';
                }
            });

            // Reset select elements to their default option
            currentStepEl.querySelectorAll('select').forEach(select => {
                Array.from(select.options).forEach(option => {
                    option.removeAttribute('selected');
                });
                select.selectedIndex = 0;
                if (select.options[0].value !== '') {
                    console.warn(
                        `Select element ${select.name} does not have an empty placeholder option`);
                }
            });

            // Clear file inputs, their previews, and reset tracked states
            currentStepEl.querySelectorAll('input[type="file"]').forEach(fileInput => {
                fileInput.value = ''; // Clear file input
                const previewId = fileInput.id + '_preview';
                const previewContainer = document.getElementById(previewId);
                if (previewContainer) {
                    previewContainer.innerHTML = ''; // Clear preview
                }

                // Reset tracked state based on input ID
                switch (fileInput.id) {
                    case 'product_photos':
                        window.selectedProductFiles = []; // Reset global array
                        break;
                    case 'business_logo':
                        window.selectedBusinessLogo = null; // Reset global variable
                        break;
                    case 'pitch_deck':
                        window.selectedPitchDeck = null; // Reset global variable
                        break;
                    case 'y_business_logo':
                        window.selectedYBusinessLogo = null; // Reset global variable
                        break;
                    case 'y_pitch_deck':
                        window.selectedYPitchDeck = null; // Reset global variable
                        break;
                    case 'y_product_photos':
                        window.selectedYProductFiles = []; // Reset global array (if used)
                        break;
                }
            });

            // Reset radio buttons
            currentStepEl.querySelectorAll('input[type="radio"]').forEach(radio => {
                if (currentStep === 3 && radio.name === 'register_business') {
                    if (radio.id === 'register_no') {
                        radio.checked = true;
                    } else {
                        radio.checked = false;
                    }
                } else if (currentStep !== 3 && radio.id === 'existing_company_no') {
                    radio.checked = true;
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
                    const companyGroups = companyWrapper.querySelectorAll('.company-group');
                    companyGroups.forEach((group, index) => {
                        if (index > 0) {
                            group.remove();
                        } else {
                            group.querySelectorAll('input:not([name="email"]), textarea').forEach(
                                element => {
                                    element.value = '';
                                });
                            group.querySelectorAll('select').forEach(select => {
                                select.selectedIndex = 0;
                            });
                        }
                    });
                    const investmentFields = document.getElementById('investment-fields');
                    if (investmentFields) {
                        investmentFields.style.display = 'none';
                    }
                }
            }

            // Handle Step 3: Clear and hide company fields, ensure register_no is set
            if (currentStep === 3) {
                const companyFields = currentStepEl.querySelector('.company-fields');
                if (companyFields) {
                    companyFields.querySelectorAll('input:not([name="email"]), textarea').forEach(element => {
                        if (element.hasAttribute('readonly')) {
                            element.removeAttribute('readonly');
                            element.value = '';
                            element.setAttribute('readonly', 'readonly');
                        } else {
                            element.value = '';
                        }
                    });
                    companyFields.querySelectorAll('select').forEach(select => {
                        select.selectedIndex = 0;
                    });
                    companyFields.querySelectorAll('input[type="file"]').forEach(fileInput => {
                        fileInput.value = '';
                        const previewId = fileInput.id + '_preview';
                        const previewContainer = document.getElementById(previewId);
                        if (previewContainer) {
                            previewContainer.innerHTML = '';
                        }
                    });
                    companyFields.style.display = 'none';
                }
                const businessDescribe = currentStepEl.querySelector('textarea[name="business_describe"]');
                if (businessDescribe) {
                    businessDescribe.value = '';
                }
                const registerBusinessRadio = currentStepEl.querySelector(
                    'input[name="register_business"][id="register_no"]');
                if (registerBusinessRadio) {
                    registerBusinessRadio.checked = true;
                    registerBusinessRadio.dispatchEvent(new Event('change'));
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

            // Ensure state and city are reset by triggering country change in Step 2
            if (currentStep === 2) {
                const countrySelect = currentStepEl.querySelector('select[name="country"]');
                if (countrySelect) {
                    countrySelect.selectedIndex = 0;
                    countrySelect.dispatchEvent(new Event('change'));
                }
                const stateSelect = currentStepEl.querySelector('select[name="state"]');
                const citySelect = currentStepEl.querySelector('select[name="city"]');
                if (stateSelect) {
                    stateSelect.innerHTML = '<option value="">Select State</option>';
                    stateSelect.selectedIndex = 0;
                }
                if (citySelect) {
                    citySelect.innerHTML = '<option value="">Select City</option>';
                    citySelect.selectedIndex = 0;
                }
            }
        }

        let currentStep = 2; // Starting from step 2 (Personal Information)
        const totalSteps = 4;

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

            if (step === totalSteps) {
                updateSubmitButtonState();
            }
        }

        let videoUploadInput;
        document.addEventListener('DOMContentLoaded', function() {
            const ownFundInput = document.querySelector('input[name="own_fund"]');
            const loanInput = document.querySelector('input[name="loan"]');
            const investedAmountInput = document.querySelector('input[name="invested_amount"]');

            function calculateInvestedAmount() {
                const ownFund = parseFloat(ownFundInput.value) || 0;
                const loan = parseFloat(loanInput.value) || 0;
                const total = ownFund + loan;

                investedAmountInput.value = total;
            }

            if (ownFundInput && loanInput) {
                ownFundInput.addEventListener('input', calculateInvestedAmount);
                loanInput.addEventListener('input', calculateInvestedAmount);
            }

            //const pitchVideoInput = document.querySelector('input[name="pitch_video"]');
            //  videoUploadInput = document.querySelector('input[name="video_upload"]');
            const termsCheckbox = document.querySelector('input[name="agreed_to_terms"]');

            //if (videoUploadInput) {
            //  videoUploadInput.addEventListener('input', updateSubmitButtonState);
            //  }

            //if (pitchVideoInput) {
            //pitchVideoInput.addEventListener('input', updateSubmitButtonState);
            // }

            if (termsCheckbox) {
                termsCheckbox.addEventListener('change', updateSubmitButtonState);
            }
        });

        document.addEventListener('DOMContentLoaded', function() {
            const ownFundInputY = document.querySelector('input[name="y_own_fund"]');
            const loanInputY = document.querySelector('input[name="y_loan"]');
            const investedAmountInputY = document.querySelector('input[name="y_invested_amount"]');

            function calculateInvestedAmountY() {
                const ownFundY = parseFloat(ownFundInputY.value) || 0;
                const loanY = parseFloat(loanInputY.value) || 0;
                const totalY = ownFundY + loanY;

                investedAmountInputY.value = totalY;
            }

            if (ownFundInputY && loanInputY) {
                ownFundInputY.addEventListener('input', calculateInvestedAmountY);
                loanInputY.addEventListener('input', calculateInvestedAmountY);
            }
        });

        function populateBusinessYears() {
            const businessYearSelect = document.getElementById('business_year');
            if (!businessYearSelect) {
                console.error('Error: business_year select element not found!');
                return;
            }
            const currentYear = new Date().getFullYear();
            businessYearSelect.innerHTML = '<option value="">Select Year</option>';
            // Generate years from current year - 1 to current year - 50
            for (let year = currentYear - 1; year >= currentYear - 50; year--) {
                const option = document.createElement('option');
                option.value = year;
                option.textContent = year;
                businessYearSelect.appendChild(option);
            }
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
                // Initially disable the submit button
                submitBtn.disabled = true;
                submitBtn.classList.add('btn-secondary');
                submitBtn.classList.remove('btn-primary');
            } else {
                nextBtn.style.display = 'block';
                submitBtn.style.display = 'none';
            }
        }

        function isValidVideo(file) {
            // Check if file exists
            if (!file) return false;

            // Define allowed video types
            const allowedTypes = [
                'video/mp4',
                'video/quicktime', // .mov files
                'video/x-msvideo', // .avi files
                'video/webm'
            ];

            // Check file type
            if (!allowedTypes.includes(file.type)) {
                return false;
            }

            // Check file size (100MB = 100 * 1024 * 1024 bytes)
            const maxSize = 100 * 1024 * 1024; // 100MB
            if (file.size > maxSize) {
                return false;
            }

            return true;
        }

        // Function to silently check if step 4 is valid (without showing errors)
        function isStep4Valid() {
            const currentStepEl = document.querySelector('.form-step[data-step="4"]');
            if (!currentStepEl) return false;

            // const pitchVideo = currentStepEl.querySelector('input[name="pitch_video"]');
            const terms = currentStepEl.querySelector('input[name="agreed_to_terms"]');

            // Validate video upload (optional)
            // Query the video upload input locally
            const videoUploadInput = currentStepEl.querySelector('input[name="video_upload"]');
            if (videoUploadInput && videoUploadInput.files[0]) {
                // If video is uploaded, validate it
                if (!isValidVideo(videoUploadInput.files[0])) {
                    return false; // Invalid video file
                }
            }

            // Check if pitch video has value and is a valid URL
            // if (!pitchVideo || !pitchVideo.value.trim()) {
            //return false;
            // }

            // try {
            //new URL(pitchVideo.value.trim());
            // } catch (e) {
            //return false;
            //  }

            // Check if terms are agreed
            if (!terms || !terms.checked) {
                return false;
            }

            return true;
        }


        function updateSubmitButtonState() {
            const submitBtn = document.getElementById('submitBtn');

            if (!submitBtn || currentStep !== totalSteps) return;

            // Use the silent validation check for real-time updates
            const isValid = isStep4Valid();

            if (isValid) {
                // Enable submit button
                submitBtn.disabled = false;
                submitBtn.classList.remove('btn-secondary');
                submitBtn.classList.add('btn-primary');
                submitBtn.innerHTML = '<i class="fas fa-check me-2"></i>Complete';
            } else {
                // Disable submit button
                submitBtn.disabled = true;
                submitBtn.classList.add('btn-secondary');
                submitBtn.classList.remove('btn-primary');
                submitBtn.innerHTML = '<i class="fas fa-lock me-2"></i>Complete Form First';
            }
        }

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
        document.addEventListener('DOMContentLoaded', function() {

            const equityInputs = document.querySelectorAll('input[name="your_stake[]"]');

            const checkbox = document.getElementById('actively_investing');
            const investmentFields = document.getElementById('investment-fields');
            const wrapper = document.getElementById('company-wrapper');
            const addBtn = document.getElementById('add-more-company');

            const countryInput = document.getElementById('country');

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

            function calculateValuation(group) {
                const investment = parseFloat(group.querySelector('.investment').value) || 0;
                const equity = parseFloat(group.querySelector('.equity').value) || 0;
                const valuationField = group.querySelector('.valuation');

                if (!isNaN(investment) && !isNaN(equity) && equity > 0) {
                    valuationField.value = ((investment / equity) * 100).toFixed(2);
                } else {
                    valuationField.value = '';
                }
            }

            function bindValuationEvents(group) {
                group.querySelector('.investment')?.addEventListener('input', () => calculateValuation(
                    group));
                group.querySelector('.equity')?.addEventListener('input', () => calculateValuation(group));
            }

            // Initial binding for existing groups
            wrapper?.querySelectorAll('.company-group').forEach(bindValuationEvents);

            addBtn?.addEventListener('click', function() {
                const lastGroup = wrapper.querySelector('.company-group:last-child');
                const newGroup = lastGroup.cloneNode(true);

                // Clear inputs
                newGroup.querySelectorAll('input').forEach(input => input.value = '');

                // Remove any existing remove button from the clone
                const existingRemoveBtn = newGroup.querySelector('.btn-outline-danger');
                if (existingRemoveBtn) existingRemoveBtn.remove();

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

        function validateStep(step) {
            console.log('Validating step:', step); // Debug log

            let isValid = true;
            const currentStepEl = document.querySelector(`.form-step[data-step="${step}"]`);
            const registerBusiness = currentStepEl.querySelector('input[name="register_business"]:checked');

            // Clear previous errors
            currentStepEl.querySelectorAll('.text-danger').forEach(el => el.classList.add('d-none'));

            if (step === 2) {
                // Validate Personal Information
                const fullName = currentStepEl.querySelector('input[name="full_name"]');
                const phoneNumber = currentStepEl.querySelector('input[name="phone_number"]');
                const email = currentStepEl.querySelector('input[name="email"]');
                const country = currentStepEl.querySelector(
                    'select[name="country"]'); // Changed from select to input
                const qualification = currentStepEl.querySelector('select[name="qualification"]');
                const countryCode = currentStepEl.querySelector('select[name="country_code"]');
                const dob = currentStepEl.querySelector('input[name="dob"]');
                const age = currentStepEl.querySelector('input[name="age"]');
                const current_address = currentStepEl.querySelector('input[name="current_address"]');
                const pin_code = currentStepEl.querySelector('input[name="pin_code"]');
                const state = currentStepEl.querySelector('select[name="state"]');
                const city = currentStepEl.querySelector('select[name="city"]');

                const pinCodeError = document.getElementById('pin_code_error');
                const countryError = document.getElementById('country_error');

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

                // State Validation
                if (!state.value) {
                    document.getElementById('state_error').textContent = 'State is required';
                    document.getElementById('state_error').classList.remove('d-none');
                    isValid = false;
                } else {
                    document.getElementById('state_error').classList.add('d-none');
                }

                if (!countryCode.value.trim()) {
                    document.getElementById('country_code_error').textContent = 'Country code is required';
                    document.getElementById('country_code_error').classList.remove('d-none');
                    isValid = false;
                } else {
                    document.getElementById('country_code_error').classList.add('d-none');
                }

                if (!phoneNumber.value.trim()) {
                    document.getElementById('phone_number_error').textContent = 'Phone number is required';
                    document.getElementById('phone_number_error').classList.remove('d-none');
                    isValid = false;
                } else {
                    const phone = phoneNumber.value.trim();
                    const expectedLength = phoneLengthMap[countryCode.value] ||
                        10; // Default to 10 if country code not in map
                    const phonePattern = new RegExp(
                        `^\\d{${expectedLength}}$`); // Dynamic regex for exact digit length

                    if (!phonePattern.test(phone)) {
                        document.getElementById('phone_number_error').textContent =
                            `Phone number must be exactly ${expectedLength} digits for ${countryCode.value}`;
                        document.getElementById('phone_number_error').classList.remove('d-none');
                        isValid = false;
                    } else {
                        document.getElementById('phone_number_error').classList.add('d-none');
                    }
                }

                if (!city.value) {
                    document.getElementById('city_error').textContent = 'City is required';
                    document.getElementById('city_error').classList.remove('d-none');
                    isValid = false;
                } else {
                    document.getElementById('city_error').classList.add('d-none');
                }

                if (!fullName.value.trim()) {
                    document.getElementById('full_name_error').textContent = 'Full name is required';
                    document.getElementById('full_name_error').classList.remove('d-none');
                    isValid = false;
                }

                if (!email.value.trim() || !email.validity.valid) {
                    document.getElementById('email_error').textContent = 'Valid email is required';
                    document.getElementById('email_error').classList.remove('d-none');
                    isValid = false;
                }

                document.getElementById('pin_code_error').classList.add('d-none');
                document.getElementById('pin_code_error').textContent = '';
                if (pinCodeError) {
                    pinCodeError.classList.add('d-none');
                    pinCodeError.textContent = '';
                }


                if (!pin_code || !pin_code.value.trim()) {
                    document.getElementById('pin_code_error').textContent = 'Pin/Zip code is required';
                    document.getElementById('pin_code_error').classList.remove('d-none');
                    isValid = false;
                } else if (!/^\d{5,6}$/.test(pin_code.value
                        .trim())) { // Basic validation for 5-6 digit zip code
                    document.getElementById('pin_code_error').textContent =
                        'Enter a valid 5-6 digit pin/zip code';
                    document.getElementById('pin_code_error').classList.remove('d-none');
                    isValid = false;
                }

            } else if (step === 3) {
                if (!registerBusiness) {
                    document.getElementById('register_business_error').textContent =
                        'Please select business registration status';
                    document.getElementById('register_business_error').classList.remove('d-none');
                    isValid = false;
                }

                if (registerBusiness && registerBusiness.value === '0') {
                    // Validate Business Information - NEW BUSINESS
                    const businessName = currentStepEl.querySelector('input[name="business_name"]');
                    const brandName = currentStepEl.querySelector('input[name="brand_name"]');

                    const proposedAddress = currentStepEl.querySelector('input[name="business_address"]');
                    const businessDescribe = currentStepEl.querySelector('textarea[name="business_describe"]');
                    const websiteLinks = currentStepEl.querySelector('input[name="website_links"]');
                    const industry = currentStepEl.querySelector('select[name="industry"]');
                    //const ideaSummary = currentStepEl.querySelector('textarea[name="idea_summary"]');
                    const businessCity = currentStepEl.querySelector('select[name="business_city"]');
                    const businessState = currentStepEl.querySelector('select[name="business_state"]');

                    const investmentField = currentStepEl.querySelector('input[name="market_capital"]');
                    const valuationField = currentStepEl.querySelector('input[name="stake_funding"]');
                    const equityField = currentStepEl.querySelector('input[name="your_stake"]');
                    const equityError = document.getElementById('your_stake_error');
                    const businessCountry = currentStepEl.querySelector('select[name="business_country"]');
                    const businessCountryError = document.getElementById('business_country_error');

                    const businessLogo = currentStepEl.querySelector('input[name="business_logo"]');
                    const productPhotos = currentStepEl.querySelector('input[name="product_photos[]"]');

                    const investedAmount = currentStepEl.querySelector('input[name="invested_amount"]');
                    const investedAmountError = document.getElementById('invested_amount_error');
                    const ownFund = currentStepEl.querySelector('input[name="own_fund"]');
                    const ownFundError = document.getElementById('own_fund_error');
                    const loan = currentStepEl.querySelector('input[name="loan"]');
                    const loanError = document.getElementById('loan_error');
                    const pitchDeck = currentStepEl.querySelector('input[name="pitch_deck"]');

                    // Clear previous errors
                    document.getElementById('business_name_error').classList.add('d-none');
                    document.getElementById('brand_name_error').classList.add('d-none');
                    document.getElementById('proposed_business_address_error').classList.add('d-none');
                    document.getElementById('business_describe_error').classList.add('d-none');
                    document.getElementById('business_city_error').classList.add('d-none');
                    document.getElementById('business_state_error').classList.add('d-none');
                    document.getElementById('industry_error').classList.add('d-none');
                    // document.getElementById('idea_summary_error').classList.add('d-none');
                    document.getElementById('market_capital_error').classList.add('d-none');
                    document.getElementById('stake_funding_error').classList.add('d-none');
                    document.getElementById('business_logo_error').classList.add('d-none');
                    document.getElementById('product_photos_error')?.classList.add('d-none');
                    document.getElementById('pitch_deck_error').classList.add('d-none');
                    document.getElementById('business_country_error').classList.add('d-none');

                    equityError.classList.add('d-none');
                    equityError.textContent = '';
                    investedAmountError.classList.add('d-none');
                    investedAmountError.textContent = '';
                    ownFundError.classList.add('d-none');
                    ownFundError.textContent = '';
                    loanError.classList.add('d-none');
                    loanError.textContent = '';


                    const companyGroups = document.querySelectorAll('.company-group');
                    let companyValid = true;

                    companyGroups.forEach((group) => {
                        const companyName = group.querySelector('input[name="company_name[]"]');
                        const marketCapital = group.querySelector(
                            'input[name="more_market_capital[]"]');
                        const yourStake = group.querySelector('input[name="more_your_stake[]"]');

                        // Check if any one field is filled
                        const anyFilled = companyName.value.trim() || marketCapital.value.trim() ||
                            yourStake.value
                            .trim();

                        if (anyFilled) {
                            // If any field is filled, then all must be filled
                            if (!companyName.value.trim() || !marketCapital.value.trim() || !yourStake
                                .value
                                .trim()) {
                                companyValid = false;
                            }
                        }
                    });

                    if (!companyValid) {
                        alert('Please fill in all company details for your active investments.');
                        isValid = false;
                    }

                    const BusinessCountryValue = businessCountry && businessCountry.value ? businessCountry
                        .value.trim() :
                        '';

                    if (pitchDeck.files.length > 0) {
                        const file = pitchDeck.files[0];
                        const validMime = file.type === "application/pdf";
                        const validExtension = file.name.toLowerCase().endsWith(".pdf");

                        if (!validMime || !validExtension) {
                            document.getElementById('pitch_deck_error').textContent =
                                'Only PDF files are allowed.';
                            document.getElementById('pitch_deck_error').classList.remove('d-none');
                            isValid = false;
                        } else if (file.size > 10 * 1024 * 1024) { // 10MB size check
                            document.getElementById('pitch_deck_error').textContent =
                                'File size must be less than 10MB.';
                            document.getElementById('pitch_deck_error').classList.remove('d-none');
                            isValid = false;
                        }
                    }

                    // Set up business description character limit
                    if (businessDescribe) {
                        businessDescribe.addEventListener('input', function() {
                            if (this.value.length > 75) {
                                this.value = this.value.slice(0, 75);
                            }
                        });
                    }

                    const investedAmountValue = investedAmount.value.trim();

                    if (investedAmountValue !== '' && !/^\d+(\.\d+)?$/.test(investedAmountValue)) {
                        investedAmountError.textContent = 'Please enter a valid number for invested amount';
                        investedAmountError.classList.remove('d-none');
                        isValid = false;
                    } else {
                        investedAmountError.classList.add('d-none'); // Hide error for blank or valid input
                    }

                    const ownFundValue = ownFund.value.trim();

                    if (ownFundValue !== '' && !/^\d+(\.\d+)?$/.test(ownFundValue)) {
                        ownFundError.textContent = 'Please enter a valid number for own fund';
                        ownFundError.classList.remove('d-none');
                        isValid = false;
                    } else {
                        ownFundError.classList.add('d-none');
                    }


                    if (ownFundValue !== '' && !/^\d+(\.\d+)?$/.test(loan.value.trim())) {
                        loanError.textContent = 'Please enter a valid number for loan';
                        loanError.classList.remove('d-none');
                        isValid = false;
                    } else {
                        ownFundError.classList.add('d-none');
                    }

                    const equityRaw = equityField.value.trim();


                    if (equityRaw !== '') {
                        const equityValue = parseFloat(equityRaw);

                        if (isNaN(equityValue) || equityValue <= 0 || equityValue > 100) {
                            equityError.textContent = 'Equity offered must be between 1 and 100 percent';
                            equityError.classList.remove('d-none');
                            isValid = false;
                        } else {
                            equityError.classList.add('d-none');
                        }
                    } else {
                        equityError.classList.add('d-none'); // hide error if field is blank
                    }


                    // Validate business logo (optional)
                    if (businessLogo && businessLogo.files.length > 0) {
                        const file = businessLogo.files[0];
                        const validImage = ['image/jpeg', 'image/png', 'image/jpg'].includes(file.type);
                        if (!validImage) {
                            document.getElementById('business_logo_error').textContent =
                                'Only JPG, JPEG, or PNG files allowed for business logo.';
                            document.getElementById('business_logo_error').classList.remove('d-none');
                            isValid = false;
                        }
                    }

                    // Validate product photos (CRITICAL: Handle the focusability issue)
                    if (!productPhotos) {
                        console.error('Product photos input element not found');
                        isValid = false;

                    } else if (productPhotos.files.length > 3) {
                        document.getElementById('product_photos_error').textContent =
                            'Maximum 3 product photos allowed.';
                        document.getElementById('product_photos_error').classList.remove('d-none');
                        isValid = false;
                    } else {
                        // Validate each product photo
                        const validImageTypes = ['image/jpeg', 'image/png', 'image/jpg', 'image/gif'];
                        const maxSize = 5 * 1024 * 1024; // 5MB

                        for (let i = 0; i < productPhotos.files.length; i++) {
                            const file = productPhotos.files[i];

                            if (!validImageTypes.includes(file.type)) {
                                document.getElementById('product_photos_error').textContent =
                                    'Only JPG, PNG, JPEG, or GIF files allowed for product photos.';
                                document.getElementById('product_photos_error').classList.remove('d-none');
                                isValid = false;
                                break;
                            } else if (file.size > maxSize) {
                                document.getElementById('product_photos_error').textContent =
                                    `Product photo ${i + 1} exceeds 5MB limit.`;
                                document.getElementById('product_photos_error').classList.remove('d-none');
                                isValid = false;
                                break;
                            }
                        }
                    }
                    if (investmentField && equityField &&
                        investmentField.value && equityField.value &&
                        parseFloat(investmentField.value) > 0 && parseFloat(equityField.value) > 0) {

                        const investment = parseFloat(investmentField.value);
                        const equity = parseFloat(equityField.value);
                        const valuation = (investment * 100) / equity;

                        if (valuationField) {
                            valuationField.value = valuation.toFixed(2);
                        }
                    }
                } else if (registerBusiness && registerBusiness.value === '1') {
                    // Validate Business Information - REGISTERED BUSINESS
                    const currentStepEl = document.querySelector('#business_details_section');
                    if (!currentStepEl) {
                        console.error('Could not find registered business form container element');
                        isValid = false;
                        return false;
                    }

                    // Select all relevant input fields
                    const businessNameY = currentStepEl.querySelector('input[name="y_business_name"]');
                    const brandNameY = currentStepEl.querySelector('input[name="y_brand_name"]');
                    const businessDescribeY = currentStepEl.querySelector(
                        'textarea[name="y_describe_business"]');
                    const businessAddressY = currentStepEl.querySelector('textarea[name="y_business_address"]');

                    const businessCountryY = currentStepEl.querySelector('select[name="y_business_country"]');
                    const businessCountryErrorY = document.getElementById('y_business_country_error');
                    const countryCodeY = currentStepEl.querySelector('select[name="business_country_code"]');

                    const businessStateY = currentStepEl.querySelector('select[name="y_business_state"]');
                    const businessCityY = currentStepEl.querySelector('select[name="y_business_city"]');
                    const zipcodeY = currentStepEl.querySelector('input[name="y_zipcode"]');
                    const industryY = currentStepEl.querySelector('select[name="y_type_industries"]');
                    const ownFundY = currentStepEl.querySelector('input[name="y_own_fund"]');
                    const loanY = currentStepEl.querySelector('input[name="y_loan"]');
                    const investedAmountY = currentStepEl.querySelector('input[name="y_invested_amount"]');
                    const businessMobile = currentStepEl.querySelector('input[name="business_mobile"]');
                    const businessEmail = currentStepEl.querySelector('input[name="business_email"]');
                    const websiteLinks = currentStepEl.querySelector('input[name="website_links"]');
                    const businessYear = currentStepEl.querySelector('select[name="business_year"]');
                    const registrationTypeofEntity = currentStepEl.querySelector(
                        'select[name="registration_type_of_entity"]');
                    const taxRegistrationNumber = currentStepEl.querySelector(
                        'input[name="tax_registration_number"]');
                    const founderNumber = currentStepEl.querySelector('input[name="founder_number"]');
                    const employeeNumber = currentStepEl.querySelector('input[name="employee_number"]');
                    const businessRevenue = currentStepEl.querySelector('input[name="business_revenue1"]');
                    const businessRevenue2 = currentStepEl.querySelector('input[name="business_revenue2"]');
                    const businessRevenue3 = currentStepEl.querySelector('input[name="business_revenue3"]');
                    const pitchDeckY = currentStepEl.querySelector('input[name="y_pitch_deck"]');

                    const businessLogoY = currentStepEl.querySelector('input[name="y_business_logo"]');
                    const productPhotosY = currentStepEl.querySelector('input[name="y_product_photos[]"]');

                    const investmentFieldY = currentStepEl.querySelector('input[name="y_market_capital"]');
                    const valuationFieldY = currentStepEl.querySelector('input[name="y_stake_funding"]');
                    const equityFieldY = currentStepEl.querySelector('input[name="y_your_stake"]');
                    const equityErrorY = document.getElementById('y_your_stake_error');
                    const investedAmountErrorY = document.getElementById('y_invested_amount_error');

                    document.getElementById('y_business_logo_error').classList.add('d-none');
                    document.getElementById('y_product_photos_error')?.classList.add('d-none');
                    document.getElementById('y_market_capital_error').classList.add('d-none');
                    document.getElementById('y_stake_funding_error').classList.add('d-none');
                    document.getElementById('y_pitch_deck_error').classList.add('d-none');
                    document.getElementById('y_business_country_error').classList.add('d-none');

                    document.querySelectorAll('.text-danger').forEach(el => {
                        el.classList.add('d-none');
                        el.textContent = '';
                    });


                    equityErrorY.classList.add('d-none');
                    equityErrorY.textContent = '';
                    investedAmountErrorY.classList.add('d-none');
                    investedAmountErrorY.textContent = '';

                    // Clear previous errors
                    const errorIds = [
                        'y_business_name_error', 'y_brand_name_error', 'y_describe_business_error',
                        'y_business_address_error',
                        'y_business_state_error', 'y_business_city_error', 'y_zipcode_error',
                        'y_type_industries_error',
                        'y_own_fund_error', 'y_loan_error', 'y_invested_amount_error',
                        'business_mobile_error',
                        'business_email_error', 'website_links_error', 'business_year_error',
                        'registration_type_of_entity_error',
                        'tax_registration_number_error', 'founder_number_error', 'employee_number_error',
                        'business_revenue1_error', 'business_revenue2_error', 'business_revenue3_error',
                        'your_stake_error', 'stake_funding_error'
                    ];
                    const businessEmailError = document.getElementById('business_email_error');

                    const mobileLengthMap = {
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

                    errorIds.forEach(id => {
                        const errorEl = document.getElementById(id);
                        if (errorEl) {
                            errorEl.classList.add('d-none');
                            errorEl.textContent = '';
                        }
                    });

                    const companyGroups = document.querySelectorAll('.company-group');
                    let companyValid = true;

                    companyGroups.forEach((group) => {
                        const companyName = group.querySelector('input[name="company_name[]"]');
                        const marketCapital = group.querySelector(
                            'input[name="more_market_capital[]"]');
                        const yourStake = group.querySelector('input[name="more_your_stake[]"]');

                        // Check if any one field is filled
                        const anyFilled = companyName.value.trim() || marketCapital.value.trim() ||
                            yourStake.value
                            .trim();

                        if (anyFilled) {
                            // If any field is filled, then all must be filled
                            if (!companyName.value.trim() || !marketCapital.value.trim() || !yourStake
                                .value
                                .trim()) {
                                companyValid = false;
                            }
                        }
                    });

                    if (!companyValid) {
                        alert('Please fill in all company details for your active investments.');
                        isValid = false;
                    }

                    const BusinessCountryValueY = businessCountryY && businessCountryY.value ? businessCountryY
                        .value
                        .trim() : '';

                    const mobile = businessMobile && businessMobile.value ? businessMobile.value.trim() : '';

                    if (mobile !== '') {
                        const expectedLengthMo = mobileLengthMap[countryCodeY.value] || 10; // Default to 10 digits
                        const mobilePattern = new RegExp(`^\\d{${expectedLengthMo}}$`);

                        if (!mobilePattern.test(mobile)) {
                            document.getElementById('business_mobile_error').textContent =
                                `Mobile number must be exactly ${expectedLengthMo} digits for ${countryCodeY.value}`;
                            document.getElementById('business_mobile_error').classList.remove('d-none');
                            isValid = false;
                        } else {
                            document.getElementById('business_mobile_error').classList.add('d-none');
                        }
                    } else {
                        document.getElementById('business_mobile_error').classList.add('d-none'); // No error if left blank
                    }


                    if (businessDescribeY) {
                        businessDescribeY.addEventListener('input', function() {
                            if (this.value.length > 75) {
                                this.value = this.value.slice(0, 75);
                                document.getElementById('y_describe_business_error').textContent =
                                    'Maximum 75 characters allowed';
                                document.getElementById('y_describe_business_error').classList.remove('d-none');
                            } else {
                                document.getElementById('y_describe_business_error').classList.add('d-none');
                            }
                        });
                    }


                    if (pitchDeckY && pitchDeckY.files.length > 0) {
                        const file = pitchDeckY.files[0];
                        const validMimeY = file.type === "application/pdf";
                        const validExtensionY = file.name.toLowerCase().endsWith(".pdf");

                        if (!validMimeY || !validExtensionY) {
                            document.getElementById('y_pitch_deck_error').textContent =
                                'Only PDF files are allowed.';
                            document.getElementById('y_pitch_deck_error').classList.remove('d-none');
                            isValid = false;
                        } else if (file.size > 10 * 1024 * 1024) {
                            document.getElementById('y_pitch_deck_error').textContent =
                                'File size must be less than 10MB.';
                            document.getElementById('y_pitch_deck_error').classList.remove('d-none');
                            isValid = false;
                        } else {
                            document.getElementById('y_pitch_deck_error').classList.add('d-none');
                        }
                    } else {
                        document.getElementById('y_pitch_deck_error').classList.add('d-none');
                    }


                    const equityValueRaw = equityFieldY && equityFieldY.value ? equityFieldY.value.trim() : '';

                    if (equityValueRaw !== '') {
                        const equityValueY = parseFloat(equityValueRaw);

                        if (isNaN(equityValueY) || equityValueY <= 0 || equityValueY > 100) {
                            equityErrorY.textContent = 'Equity offered must be between 1 and 100 percent';
                            equityErrorY.classList.remove('d-none');
                            isValid = false;
                        } else {
                            equityErrorY.classList.add('d-none');
                        }
                    } else {
                        equityErrorY.classList.add('d-none');
                    }

                    const zipcodeValue = zipcodeY && zipcodeY.value ? zipcodeY.value.trim() : '';

                    if (zipcodeValue !== '' && !/^\d{5,6}$/.test(zipcodeValue)) {
                        document.getElementById('y_zipcode_error').textContent =
                            'Enter a valid 5-6 digit pin/zip code';
                        document.getElementById('y_zipcode_error').classList.remove('d-none');
                        isValid = false;
                    } else {
                        document.getElementById('y_zipcode_error').classList.add('d-none');
                    }

                    // Validate industry
                    if (!industryY) {
                        document.getElementById('y_type_industries_error').textContent =
                            'Please select an industry';
                        document.getElementById('y_type_industries_error').classList.remove('d-none');
                        isValid = false;
                    } else {
                        document.getElementById('y_type_industries_error').classList.add('d-none');
                    }

                    // Validate own fund
                    const ownFundYValue = ownFundY && ownFundY.value ? ownFundY.value.trim() : '';

                    if (ownFundYValue !== '') {
                        const ownFundYNumber = parseFloat(ownFundYValue);

                        if (isNaN(ownFundYNumber) || ownFundYNumber < 0) {
                            document.getElementById('y_own_fund_error').textContent =
                                'Enter a valid non-negative number for own fund';
                            document.getElementById('y_own_fund_error').classList.remove('d-none');
                            isValid = false;
                        } else {
                            document.getElementById('y_own_fund_error').classList.add('d-none');
                        }
                    } else {
                        document.getElementById('y_own_fund_error').classList.add('d-none');
                    }


                    // Validate loan
                    const loanYValue = loanY && loanY.value ? loanY.value.trim() : '';

                    if (loanYValue !== '') {
                        const loanYAmount = parseFloat(loanYValue);

                        if (isNaN(loanYAmount) || loanYAmount < 0) {
                            document.getElementById('y_loan_error').textContent =
                                'Enter a valid non-negative number for loan';
                            document.getElementById('y_loan_error').classList.remove('d-none');
                            isValid = false;
                        } else {
                            document.getElementById('y_loan_error').classList.add('d-none');
                        }
                    } else {
                        document.getElementById('y_loan_error').classList.add('d-none');
                    }

                    const investedAmountYValue = investedAmountY && investedAmountY.value ? investedAmountY.value.trim() :
                        '';

                    if (investedAmountYValue !== '') {
                        const amount = parseFloat(investedAmountYValue);

                        if (isNaN(amount) || amount < 0) {
                            document.getElementById('y_invested_amount_error').textContent =
                                'Enter a valid non-negative number for invested amount';
                            document.getElementById('y_invested_amount_error').classList.remove('d-none');
                            isValid = false;
                        } else {
                            document.getElementById('y_invested_amount_error').classList.add('d-none');
                        }
                    } else {
                        document.getElementById('y_invested_amount_error').classList.add('d-none');
                    }

                    // Validate business mobile
                    const businessMobileValue = businessMobile && businessMobile.value ? businessMobile.value.trim() : '';

                    if (businessMobileValue !== '' && !/^\d{10}$/.test(businessMobileValue)) {
                        document.getElementById('business_mobile_error').textContent =
                            'Enter a valid 10-digit mobile number';
                        document.getElementById('business_mobile_error').classList.remove('d-none');
                        isValid = false;
                    } else {
                        document.getElementById('business_mobile_error').classList.add('d-none');
                    }


                    // Validate business email
                    if (!businessEmail) {
                        console.error('business_email input not found');
                        isValid = false;
                    } else {
                        const emailValue = businessEmail.value.trim();
                        const emailRegex =
                            /^[a-zA-Z0-9.!#$%&'*+/=?^_`{|}~-]+@[a-zA-Z0-9](?:[a-zA-Z0-9-]{0,61}[a-zA-Z0-9])?(?:\.[a-zA-Z]{2,})+$/;

                    if (emailValue !== '' && (!businessEmail.validity.valid || !emailRegex.test(emailValue))) {
                        businessEmailError.textContent =
                            'Enter a valid business email (e.g., john@example.com)';
                        businessEmailError.classList.remove('d-none');
                        isValid = false;
                    } else {
                        businessEmailError.classList.add('d-none');
                    }
                }

                // Validate website links
                if (websiteLinks && websiteLinks.value.trim()) {
                    const urlValue = websiteLinks.value.trim();
                    let url;
                    // Initialize or get the error element
                    const errorElement = document.getElementById('website_links_error') ||
                        createErrorElement(
                            'website_links_error', websiteLinks);

                    try {
                        // Try parsing as is
                        url = new URL(urlValue.startsWith('http://') || urlValue.startsWith('https://') ?
                            urlValue :
                            `https://${urlValue}`);

                        // Check if it's a valid domain (simple check for top-level domain)
                        const domainRegex = /^(?:https?:\/\/)?(?:[a-zA-Z0-9-]+\.)+[a-zA-Z]{2,}$/;
                        if (!domainRegex.test(url.hostname)) {
                            errorElement.textContent = 'Enter a valid domain (e.g., test.com)';
                            errorElement.classList.remove('d-none');
                            isValid = false;
                        } else {
                            // Normalize to https:// and update the input value
                            websiteLinks.value = `https://${url.hostname}`;
                            errorElement.classList.add('d-none');
                        }
                    } catch {
                        errorElement.textContent = 'Enter a valid domain (e.g., test.com)';
                        errorElement.classList.remove('d-none');
                        isValid = false;
                    }
                } else {
                    const errorElement = document.getElementById('website_links_error');
                    if (errorElement) {
                        errorElement.classList.add('d-none'); // Hide error if empty
                    }
                }

                // Validate registration type
                if (!registrationTypeofEntity) {
                    document.getElementById('registration_type_of_entity_error').textContent =
                        'Please select registration type';
                    document.getElementById('registration_type_of_entity_error').classList.remove('d-none');
                    isValid = false;
                }

                // Validate founder number
                const founderNumberValue = founderNumber && founderNumber.value ? founderNumber.value.trim() : '';

                if (founderNumberValue !== '') {
                    const founderCount = parseInt(founderNumberValue);

                    if (isNaN(founderCount) || founderCount < 1) {
                        document.getElementById('founder_number_error').textContent =
                            'Number of founders must be at least 1';
                        document.getElementById('founder_number_error').classList.remove('d-none');
                        isValid = false;
                    } else if (founderCount > 20) {
                        document.getElementById('founder_number_error').textContent =
                            'Number of founders cannot exceed 20';
                        document.getElementById('founder_number_error').classList.remove('d-none');
                        isValid = false;
                    } else {
                        document.getElementById('founder_number_error').classList.add('d-none');
                    }
                } else {
                    document.getElementById('founder_number_error').classList.add('d-none');
                }

                if (businessLogoY && businessLogoY.files.length > 0) {
                    const file = businessLogoY.files[0];
                    const validImage = ['image/jpeg', 'image/png', 'image/jpg'].includes(file.type);

                    if (!validImage) {
                        document.getElementById('y_business_logo_error').textContent =
                            'Only JPG, JPEG, or PNG files allowed for business logo.';
                        document.getElementById('y_business_logo_error').classList.remove('d-none');
                        isValid = false;
                    } else {
                        document.getElementById('y_business_logo_error').classList.add('d-none');
                    }
                } else {
                    document.getElementById('y_business_logo_error').classList.add('d-none');
                }


                // Validate product photos (CRITICAL: Handle the focusability issue)
                if (!productPhotosY) {
                    formDataStep.y_product_photos = [];
                    //console.error('Product photos input element not found');
                    isValid = false;
                } else if (productPhotosY.files.length > 3) {
                    document.getElementById('y_product_photos_error').textContent =
                        'Maximum 3 product photos allowed.';
                    document.getElementById('y_product_photos_error').classList.remove('d-none');
                    isValid = false;
                } else {
                    // Validate each product photo
                    const validImageTypesY = ['image/jpeg', 'image/png', 'image/jpg', 'image/gif'];
                    const maxSize = 5 * 1024 * 1024; // 5MB

                    for (let i = 0; i < productPhotosY.files.length; i++) {
                        const file = productPhotosY.files[i];

                        if (!validImageTypesY.includes(file.type)) {
                            document.getElementById('y_product_photos_error').textContent =
                                'Only JPG, PNG, JPEG, or GIF files allowed for product photos.';
                            document.getElementById('y_product_photos_error').classList.remove('d-none');
                            isValid = false;
                            break;
                        } else if (file.size > maxSize) {
                            document.getElementById('y_product_photos_error').textContent =
                                `Product photo ${i + 1} exceeds 5MB limit.`;
                            document.getElementById('y_product_photos_error').classList.remove('d-none');
                            isValid = false;
                            break;
                        }
                    }
                }
            }
            isFormValid = isValid;
            //return isValid;

        } else if (step === 4) {
            // Validate Legal and Funding Information
            //const pitchVideo = currentStepEl.querySelector('input[name="pitch_video"]');
            const terms = currentStepEl.querySelector('input[name="agreed_to_terms"]');
            const videoUpload = currentStepEl.querySelector('input[name="video_upload"]');


            // Validate Video Upload (optional)
            if (videoUpload && videoUpload.files[0]) {
                if (!isValidVideo(videoUpload.files[0])) {
                    if (document.getElementById('video_upload_error')) {
                        document.getElementById('video_upload_error').textContent =
                            'Please upload a valid video file (mp4, mov, avi, webm)';
                        document.getElementById('video_upload_error').classList.remove('d-none');
                    }
                    isValid = false;
                } else {
                    if (document.getElementById('video_upload_error')) {
                        document.getElementById('video_upload_error').classList.add('d-none');
                    }
                }
            } else {
                if (document.getElementById('video_upload_error')) {
                    document.getElementById('video_upload_error').classList.add('d-none');
                }
            }
            if (!terms || !terms.checked) {
                if (document.getElementById('agreed_to_terms_error')) {
                    document.getElementById('agreed_to_terms_error').textContent =
                        'You must agree to terms and conditions';
                    document.getElementById('agreed_to_terms_error').classList.remove('d-none');
                }
                isValid = false;
            } else {
                if (document.getElementById('agreed_to_terms_error')) {
                    document.getElementById('agreed_to_terms_error').classList.add('d-none');
                }
            }
            //return isValid;
        }
        return isValid;
    }

    document.addEventListener('DOMContentLoaded', function() {
        const businessLogoInput = document.getElementById('business_logo');
        const pitchDeckInput = document.getElementById('pitch_deck');
        let selectedBusinessLogo = null; // Track single business logo
        let selectedPitchDeck = null; // Track single pitch deck

        if (businessLogoInput) {
            businessLogoInput.addEventListener('change', handleBusinessLogoChange);
        }
        if (pitchDeckInput) {
            pitchDeckInput.addEventListener('change', handlePitchDeckChange);
        }

        function handleBusinessLogoChange(e) {
            const file = e.target.files[0];
            const previewContainer = document.getElementById('business_logo_preview');
            const errorElement = document.getElementById('business_logo_error');

            // Clear error and preview
            errorElement.classList.add('d-none');
            clearContainer(previewContainer);

            if (!file) {
                selectedBusinessLogo = null;
                updateFileInput('business_logo', []);
                return;
            }

            const validImageTypes = ['image/jpeg', 'image/png', 'image/jpg'];
            if (!validImageTypes.includes(file.type)) {
                errorElement.textContent = 'Only JPG, JPEG, or PNG files allowed for business logo.';
                errorElement.classList.remove('d-none');
                selectedBusinessLogo = null;
                updateFileInput('business_logo', []);
                return;
            }

            if (file.size > 5 * 1024 * 1024) { // 5MB
                errorElement.textContent = 'Business logo exceeds 5MB limit.';
                errorElement.classList.remove('d-none');
                selectedBusinessLogo = null;
                updateFileInput('business_logo', []);
                return;
            }

            const reader = new FileReader();
            reader.onload = function(event) {
                const wrapper = createImageThumbnail(event.target.result, 'Business Logo Preview',
                    removeBusinessLogo);
                wrapper.setAttribute('data-id', `logo_${Date.now()}`);
                previewContainer.appendChild(wrapper);
                selectedBusinessLogo = {
                    id: `logo_${Date.now()}`,
                    file
                };
                updateFileInput('business_logo', selectedBusinessLogo ? [selectedBusinessLogo.file] : []);
            };
            reader.readAsDataURL(file);
        }

        function handlePitchDeckChange(e) {
            const file = e.target.files[0];
            const previewContainer = document.getElementById('pitch_deck_preview');
            const errorElement = document.getElementById('pitch_deck_error');

            // Clear error and preview
            errorElement.classList.add('d-none');
            clearContainer(previewContainer);

            if (!file) {
                selectedPitchDeck = null;
                updateFileInput('pitch_deck', []);
                return;
            }

            const validMime = file.type === 'application/pdf';
            const validExtension = file.name.toLowerCase().endsWith('.pdf');
            if (!validMime || !validExtension) {
                errorElement.textContent = 'Only PDF files are allowed.';
                errorElement.classList.remove('d-none');
                selectedPitchDeck = null;
                updateFileInput('pitch_deck', []);
                return;
            }

            if (file.size > 5 * 1024 * 1024) { // 5MB
                errorElement.textContent = 'File size must be less than 5MB.';
                errorElement.classList.remove('d-none');
                selectedPitchDeck = null;
                updateFileInput('pitch_deck', []);
                return;
            }

            const pdfPreview = createPDFPreview(file.name, file.size, removePitchDeck);
            pdfPreview.setAttribute('data-id', `pdf_${Date.now()}`);
            previewContainer.appendChild(pdfPreview);
            selectedPitchDeck = {
                id: `pdf_${Date.now()}`,
                file
            };
            updateFileInput('pitch_deck', selectedPitchDeck ? [selectedPitchDeck.file] : []);
        }

        function removeBusinessLogo() {
            const container = document.getElementById('business_logo_preview');
            const input = document.getElementById('business_logo');
            clearContainer(container);
            selectedBusinessLogo = null;
            input.value = '';
            updateFileInput('business_logo', []);
        }

        function removePitchDeck() {
            const container = document.getElementById('pitch_deck_preview');
            const input = document.getElementById('pitch_deck');
            clearContainer(container);
            selectedPitchDeck = null;
            input.value = '';
            updateFileInput('pitch_deck', []);
        }

        function clearContainer(container) {
            if (container) {
                while (container.firstChild) {
                    container.removeChild(container.firstChild);
                }
            }
        }

        function updateFileInput(inputId, filesArray) {
            const input = document.getElementById(inputId);
            const dataTransfer = new DataTransfer();
            filesArray.forEach(file => dataTransfer.items.add(file));
            input.files = dataTransfer.files;
        }

        function createImageThumbnail(src, alt, onRemove) {
            const wrapper = document.createElement('div');
            wrapper.className = 'position-relative';

            const img = document.createElement('img');
            img.src = src;
            img.alt = alt;
            img.style.width = '100px';
            img.style.height = '100px';
            img.style.objectFit = 'cover';
            img.style.margin = '5px';
            img.style.border = '1px solid #ddd';
            img.style.borderRadius = '5px';

            const removeBtn = document.createElement('button');
            removeBtn.className = 'btn btn-danger btn-sm position-absolute top-0 end-0';
            removeBtn.style.padding = '2px 6px';
            removeBtn.textContent = '×';
            removeBtn.addEventListener('click', onRemove);

            wrapper.appendChild(img);
            wrapper.appendChild(removeBtn);
            return wrapper;
        }

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

            const pdfIcon = document.createElement('div');
            pdfIcon.innerHTML =
                '<i class="fas fa-file-pdf" style="font-size: 24px; color: #dc3545; margin-right: 10px;"></i>';

            const fileInfo = document.createElement('div');
            fileInfo.style.flex = '1';
            fileInfo.style.overflow = 'hidden';

            const fileNameDiv = document.createElement('div');
            fileNameDiv.textContent = fileName.length > 20 ? fileName.substring(0, 17) + '...' : fileName;
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

        function formatFileSize(bytes) {
            const sizes = ['Bytes', 'KB', 'MB', 'GB', 'TB'];
            if (bytes === 0) return '0 Byte';
            const i = parseInt(Math.floor(Math.log(bytes) / Math.log(1024)));
            return Math.round(bytes / Math.pow(1024, i), 2) + ' ' + sizes[i];
        }

        // Expose functions for external use
        window.removeBusinessLogo = removeBusinessLogo;
        window.removePitchDeck = removePitchDeck;
    });

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
            formDataStep.qualification = currentStepEl.querySelector('select[name="qualification"]')?.value || '';
            formDataStep.dob = currentStepEl.querySelector('input[name="dob"]')?.value || '';
            formDataStep.age = currentStepEl.querySelector('input[name="age"]')?.value || '';
            formDataStep.current_address = currentStepEl.querySelector('input[name="current_address"]')?.value || '';
            formDataStep.pin_code = currentStepEl.querySelector('input[name="pin_code"]')?.value || '';
            formDataStep.linkedin_profile = currentStepEl.querySelector('input[name="linkedin_profile"]')?.value || '';
            formDataStep.photo = currentStepEl.querySelector('input[name="photo"]')?.files[0] || null;
        } else if (step === 3) {
            const registerBusiness = currentStepEl.querySelector('input[name="register_business"]:checked')?.value;
            formDataStep.register_business = registerBusiness || '0';

            if (registerBusiness === '0') {
                formDataStep.business_name = currentStepEl.querySelector('input[name="business_name"]')?.value || '';
                formDataStep.brand_name = currentStepEl.querySelector('input[name="brand_name"]')?.value || '';
                formDataStep.business_address = currentStepEl.querySelector('input[name="business_address"]')?.value ||
                    '';
                formDataStep.business_describe = currentStepEl.querySelector('textarea[name="business_describe"]')
                    ?.value || '';
                formDataStep.website_links = currentStepEl.querySelector('input[name="website_links"]')?.value || '';
                formDataStep.industry = currentStepEl.querySelector('select[name="industry"]')?.value || '';
                formDataStep.business_country = currentStepEl.querySelector('select[name="business_country"]')?.value ||
                    '';
                formDataStep.business_state = currentStepEl.querySelector('select[name="business_state"]')?.value || '';
                formDataStep.business_city = currentStepEl.querySelector('select[name="business_city"]')?.value || '';
                formDataStep.market_capital = currentStepEl.querySelector('input[name="market_capital"]')?.value || '';
                formDataStep.stake_funding = currentStepEl.querySelector('input[name="stake_funding"]')?.value || '';
                formDataStep.your_stake = currentStepEl.querySelector('input[name="your_stake"]')?.value || '';
                // Handle business_logo: store null if no file is selected
                const businessLogo = currentStepEl.querySelector('input[name="business_logo"]')?.files[0];
                if (businessLogo) formDataStep.business_logo = businessLogo;
                // Handle product_photos: store empty array if no files are selected
                formDataStep.product_photos = Array.from(currentStepEl.querySelector('input[name="product_photos[]"]')
                    ?.files || []);
                formDataStep.own_fund = currentStepEl.querySelector('input[name="own_fund"]')?.value || '';
                formDataStep.loan = currentStepEl.querySelector('input[name="loan"]')?.value || '';
                formDataStep.invested_amount = currentStepEl.querySelector('input[name="invested_amount"]')?.value ||
                    '';
                const pitchDeck = currentStepEl.querySelector('input[name="pitch_deck"]')?.files[0];
                if (pitchDeck) formDataStep.pitch_deck = pitchDeck;
                // Company details
                const companyGroups = currentStepEl.querySelectorAll('.company-group');
                formDataStep.company_name = [];
                formDataStep.more_market_capital = [];
                formDataStep.more_your_stake = [];
                formDataStep.more_stake_funding = [];
                companyGroups.forEach(group => {
                    const companyName = group.querySelector('input[name="company_name[]"]')?.value || '';
                    const marketCapital = group.querySelector('input[name="more_market_capital[]"]')?.value ||
                        '';
                    const yourStake = group.querySelector('input[name="more_your_stake[]"]')?.value || '';
                    const stakeFunding = group.querySelector('input[name="more_stake_funding[]"]')?.value || '';
                    if (companyName || marketCapital || yourStake || stakeFunding) {
                        formDataStep.company_name.push(companyName);
                        formDataStep.more_market_capital.push(marketCapital);
                        formDataStep.more_your_stake.push(yourStake);
                        formDataStep.more_stake_funding.push(stakeFunding);
                    }
                });
            } else if (registerBusiness === '1') {
                formDataStep.y_business_name = currentStepEl.querySelector('input[name="y_business_name"]')?.value ||
                    '';
                formDataStep.y_brand_name = currentStepEl.querySelector('input[name="y_brand_name"]')?.value || '';
                formDataStep.y_describe_business = currentStepEl.querySelector('textarea[name="y_describe_business"]')
                    ?.value || '';
                formDataStep.y_business_address = currentStepEl.querySelector('textarea[name="y_business_address"]')
                    ?.value || '';
                formDataStep.y_business_country = currentStepEl.querySelector('select[name="y_business_country"]')
                    ?.value || '';
                formDataStep.y_business_state = currentStepEl.querySelector('select[name="y_business_state"]')?.value ||
                    '';
                formDataStep.y_business_city = currentStepEl.querySelector('select[name="y_business_city"]')?.value ||
                    '';
                formDataStep.y_zipcode = currentStepEl.querySelector('input[name="y_zipcode"]')?.value || '';
                formDataStep.y_type_industries = currentStepEl.querySelector('select[name="y_type_industries"]')
                    ?.value || '';
                formDataStep.y_own_fund = currentStepEl.querySelector('input[name="y_own_fund"]')?.value || '';
                formDataStep.y_loan = currentStepEl.querySelector('input[name="y_loan"]')?.value || '';
                formDataStep.y_invested_amount = currentStepEl.querySelector('input[name="y_invested_amount"]')
                    ?.value || '';
                formDataStep.y_market_capital = currentStepEl.querySelector('input[name="y_market_capital"]')?.value ||
                    '';
                formDataStep.y_stake_funding = currentStepEl.querySelector('input[name="y_stake_funding"]')?.value ||
                    '';
                formDataStep.y_your_stake = currentStepEl.querySelector('input[name="y_your_stake"]')?.value || '';
                formDataStep.business_year_count = currentStepEl.querySelector('input[name="business_year_count"]')
                    ?.value || '';
                formDataStep.business_mobile = currentStepEl.querySelector('input[name="business_mobile"]')?.value ||
                    '';
                formDataStep.business_email = currentStepEl.querySelector('input[name="business_email"]')?.value || '';
                formDataStep.business_year = currentStepEl.querySelector('select[name="business_year"]')?.value || '';
                formDataStep.registration_type_of_entity = currentStepEl.querySelector(
                    'select[name="registration_type_of_entity"]')?.value || '';
                formDataStep.tax_registration_number = currentStepEl.querySelector(
                    'input[name="tax_registration_number"]')?.value || '';
                formDataStep.founder_number = currentStepEl.querySelector('input[name="founder_number"]')?.value || '';
                formDataStep.employee_number = currentStepEl.querySelector('input[name="employee_number"]')?.value ||
                    '';
                formDataStep.business_revenue1 = currentStepEl.querySelector('input[name="business_revenue1"]')
                    ?.value || '';
                formDataStep.business_revenue2 = currentStepEl.querySelector('input[name="business_revenue2"]')
                    ?.value || '';
                formDataStep.business_revenue3 = currentStepEl.querySelector('input[name="business_revenue3"]')
                    ?.value || '';
                // Handle y_business_logo: store null if no file is selected
                formDataStep.y_business_logo = currentStepEl.querySelector('input[name="y_business_logo"]')?.files[0] ||
                    null;
                // Handle y_product_photos: store empty array if no files are selected
                formDataStep.y_product_photos = Array.from(currentStepEl.querySelector(
                    'input[name="y_product_photos[]"]')?.files || []);
                formDataStep.y_pitch_deck = currentStepEl.querySelector('input[name="y_pitch_deck"]')?.files[0] || null;
                formDataStep.website_links = currentStepEl.querySelector('input[name="website_links"]')?.value || '';
                // Company details
                const companyGroups = currentStepEl.querySelectorAll('.company-group');
                formDataStep.company_name = [];
                formDataStep.more_market_capital = [];
                formDataStep.more_your_stake = [];
                formDataStep.more_stake_funding = [];
                companyGroups.forEach(group => {
                    const companyName = group.querySelector('input[name="company_name[]"]')?.value || '';
                    const marketCapital = group.querySelector('input[name="more_market_capital[]"]')?.value ||
                        '';
                    const yourStake = group.querySelector('input[name="more_your_stake[]"]')?.value || '';
                    const stakeFunding = group.querySelector('input[name="more_stake_funding[]"]')?.value || '';
                    if (companyName || marketCapital || yourStake || stakeFunding) {
                        formDataStep.company_name.push(companyName);
                        formDataStep.more_market_capital.push(marketCapital);
                        formDataStep.more_your_stake.push(yourStake);
                        formDataStep.more_stake_funding.push(stakeFunding);
                    }
                });
            }
        } else if (step === 4) {
            formDataStep.video_upload = currentStepEl.querySelector('input[name="video_upload"]')?.files[0] || null;
            formDataStep.agreed_to_terms = currentStepEl.querySelector('input[name="agreed_to_terms"]')?.checked ? 1 :
                0;
        }

        formData[`step${step}`] = formDataStep;
        return formDataStep;
    }
    // Modified next button event listener with better debugging
    document.getElementById('nextBtn').addEventListener('click', async function() {
        console.log("=== Next Button Clicked ===");
        console.log("Current step:", currentStep);

        // पहले पिछले step का data save करें (अगर कोई है)
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
                    } else if (stepData[key] !== null && stepData[key] !== undefined) {
                        // Only append non-null and non-undefined values
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

                const response = await fetch('{{ route('save-step-data') }}', {
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

    document.getElementById('mainForm').addEventListener('submit', async function(event) {
        event.preventDefault(); // Prevent default form submission temporarily
        console.log("=== Form Submitted ===");
        console.log("Current step:", currentStep);

        const stepToValidate = currentStep; // Validate step 4
        const stepToSave = currentStep; // Save step 4

        console.log("Validating step:", stepToValidate);
        console.log("Will save data for step:", stepToSave);

        const isValidStep = validateStep(stepToValidate);
        console.log("Step validation result:", isValidStep);

        if (isValidStep) {
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

                const response = await fetch('{{ route('save-step-data') }}', {
                    method: 'POST',
                    body: formDataToSend,
                    headers: {
                        'X-CSRF-TOKEN': csrfToken
                    }
                });

                const responseData = await response.json();
                console.log('Server Response:', responseData);

                if (!response.ok) {
                    throw new Error(responseData.message || JSON.stringify(responseData.errors) ||
                        'Failed to save step data');
                }

                formData[`step${stepToSave}`] = stepData;
                console.log('Stored formData:', formData);

                // After saving step 4 data, submit the form to entrepreneur.store
                document.getElementById('mainForm').submit(); // Trigger default form submission

            } catch (error) {
                console.error('Error saving step data:', error);
                // Silently log the error and proceed with form submission
                document.getElementById('mainForm').submit(); // Still submit the form
            }
        } else {
            console.log("Step validation failed, staying on current step");
            const firstError = document.querySelector('.error-message:not(.d-none)');
            if (firstError) {
                firstError.scrollIntoView({
                    behavior: 'smooth',
                    block: 'center'
                });
            }
        }
    });

    document.addEventListener('DOMContentLoaded', async function() {
        console.log("=== Loading Saved Step Data ===");
        try {
            const csrfToken = document.querySelector('meta[name="csrf-token"]')?.content || document
                .querySelector('input[name="_token"]')?.value;
            if (!csrfToken) {
                console.error('CSRF token not found');
                showStep(2);
                return;
            }

            const response = await fetch('{{ route('get-step-data') }}', {
                method: 'GET',
                headers: {
                    'X-CSRF-TOKEN': csrfToken
                }
            });

            const responseData = await response.json();
            console.log('Retrieved Step Data:', responseData);

            if (response.ok && responseData.data) {
                formData = responseData;
                currentStep = determineCurrentStep();
                showStep(currentStep);
                populateFormFields(currentStep);
            } else {
                console.log('No saved data found, starting from step 2');
                showStep(2);
            }
        } catch (error) {
            console.error('Error loading step data:', error);
            showStep(2);
        }
    });

    // Function to determine the current step based on saved data
    function determineCurrentStep() {
        if (Object.keys(formData.step4 || {}).length > 0) return 4;
        if (Object.keys(formData.step3 || {}).length > 0) return 4; // Move to step 4 if step 3 is complete
        if (Object.keys(formData.step2 || {}).length > 0) return 3; // Move to step 3 if step 2 is complete
        return 2; // Default to step 2
    }

    // Function to populate form fields with saved data
    function populateFormFields(step) {
        const currentStepEl = document.querySelector(`.form-step[data-step="${step}"]`);
        if (!currentStepEl) return;

        const stepData = formData[`step${step}`];
        if (!stepData) return;

        Object.keys(stepData).forEach(key => {
            const input = currentStepEl.querySelector(`[name="${key}"]`);
            if (input) {
                if (input.type === 'checkbox') {
                    input.checked = stepData[key] == 1;
                } else if (input.type === 'select-one' || input.type === 'text' || input.type ===
                    'textarea' ||
                    input.type === 'email' || input.type === 'tel') {
                    input.value = stepData[key] || '';
                }
            }
            if (Array.isArray(stepData[key])) {
                stepData[key].forEach((value, index) => {
                    const arrayInput = currentStepEl.querySelector(
                        `[name="${key}[${index}]"]`);
                    if (arrayInput) {
                        arrayInput.value = value || '';
                    }
                });
            }
        });

        console.log(`Populated fields for step ${step}`);
    }

    function createErrorElement(id, parent) {
        const errorElement = document.createElement('div');
        errorElement.id = id;
        errorElement.className = 'text-danger mt-1 d-none';
        parent.parentNode.appendChild(errorElement);
        return errorElement;
    }

    function changeStep(direction) {
        const newStep = currentStep + direction;

        if (newStep < 2 || newStep > totalSteps) return;

        // If moving forward, validate current step
        if (direction > 0) {
            // Validate the current step before moving to next step
            if (!validateStep(currentStep)) {
                return; // Don't proceed if validation fails
            }
        }

        //setTimeout(() => {
        currentStep = newStep;
        showStep(currentStep);
        //}, 2000);
    }
    const registerRadios = document.querySelectorAll('input[name="register_business"]');
    const businessDetailsSection = document.getElementById('business_details_section');
    const businessDetailsSectionNo = document.getElementById('business_details_section_no');

    registerRadios.forEach(radio => {
        radio.addEventListener('change', function() {
            if (this.value === '1') {
                businessDetailsSection.style.display = 'block';
                businessDetailsSectionNo.style.display = 'none';
                populateBusinessYears(); // Populate years when "Yes" is selected
            } else {
                businessDetailsSection.style.display = 'none';
            }
        });
    });

    function createErrorElement(id, parent) {
        const errorElement = document.createElement('div');
        errorElement.id = id;
        errorElement.className = 'text-danger mt-1 d-none';
        parent.parentNode.appendChild(errorElement);
        return errorElement;
    }

    registerRadios.forEach(radio => {
        radio.addEventListener('change', function() {
            if (this.value === '0') {
                businessDetailsSectionNo.style.display = 'block';
                businessDetailsSection.style.display = 'none';
                populateBusinessYears(); // Populate years when "Yes" is selected
            } else {
                businessDetailsSectionNo.style.display = 'none';
            }
        });
    });

    const selectedRadio = document.querySelector('input[name="register_business"]:checked');
    if (selectedRadio) {
        if (selectedRadio.value === '1') {
            businessDetailsSection.style.display = 'block';
            populateBusinessYears();
            showStep(currentStep);
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

    // Initialize form
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

        const fundingCurrencyLabel = document.querySelectorAll('.funding_currency_label');
        const countryInput = document.getElementById('business_country');

        function updateFundingCurrencyLabel() {
            const selectedCountry = (countryInput?.value || '').trim().toLowerCase();
            let label = '';

            if (selectedCountry === 'in') {
                label = '(INR)';
            } else if (selectedCountry !== '') {
                label = '(USD)';
            }
            fundingCurrencyLabel.forEach(el => {
                el.textContent = label;
            });
        }

        updateFundingCurrencyLabel();

        countryInput?.addEventListener('input', updateFundingCurrencyLabel);

        ///
        const fundingCurrencyYLabel = document.querySelectorAll('.funding_currency_label');
        const countryYInput = document.getElementById('y_business_country');

        function updateFundingCurrencyYLabel() {
            const selectedCountryY = (countryYInput?.value || '').trim().toLowerCase();
            let label = '';

            if (selectedCountryY === 'in') {
                label = '(INR)';
            } else if (selectedCountryY !== '') {
                label = '(USD)';
            }
            fundingCurrencyLabel.forEach(el => {
                el.textContent = label;
            });
        }

        updateFundingCurrencyYLabel();

        countryYInput?.addEventListener('input', updateFundingCurrencyYLabel);
    });
    // Character counter for idea summary
    //  const ideaSummary = document.querySelector('textarea[name="idea_summary"]');
    // if (ideaSummary) {
    // const counter = document.createElement('small');
    // counter.className = 'text-muted';
    // ideaSummary.parentNode.appendChild(counter);

    // ideaSummary.addEventListener('input', function() {
    //counter.textContent = `${this.value.length} characters`;
    // });
    // }
    const countryToStates = {
        IN: {
            "Andhra Pradesh": ["Visakhapatnam", "Vijayawada", "Guntur", "Nellore", "Kurnool",
                "Rajahmundry",
                "Tirupati", "Kakinada", "Anantapur", "Kadapa (Cuddapah)", "Chittoor", "Eluru",
                "Ongole",
                "Machilipatnam", "Nizamabad"
            ],
            "Arunachal Pradesh": ["Itanagar", "Naharlagun", "Pasighat", "Tezpur", "Bomdila", "Tawang",
                "Ziro",
                "Along", "Basar", "Roing", "Namsai", "Changlang", "Khonsa", "Longding", "Koloriang",
                "Daporijo",
                "Yingkiong", "Mechuka", "Anini", "Hawai", "Seppa", "Chayang Tajo", "Aalo", "Tezu",
                "Nampong",
            ],
            "Assam": ["Guwahati", "Silchar", "Dibrugarh", "Jorhat", "Nagaon", "Tinsukia", "Tezpur",
                "Bongaigaon",
                "Golaghat", "Karimganj", "Haflong", "Dhubri", "North Lakhimpur", "Sivasagar",
                "Barpeta",
                "Mangaldoi", "Hailakandi", "Kokrajhar", "Goalpara", "Nalbari", "Majuli",
                "Kaziranga", "Manas",
                "Sualkuchi",
            ],
            "Bihar": ["Patna", "Gaya", "Bhagalpur", "Muzaffarpur", "Purnia", "Darbhanga",
                "Bihar Sharif", "Arrah",
                "Begusarai", "Katihar", "Bagaha", "Buxar", "Kishanganj", "Sitamarhi", "Jamalpur",
                "Jehanabad",
                "Aurangabad",
                "Siwan", "Motihari", "Nawada", "Sasaram", "Munger", "Chhapra", "Bettiah", "Saharsa",
                "Hajipur"
            ],
            "Chhattisgarh": ["Raipur", "Bhilai", "Korba", "Bilaspur", "Durg", "Rajnandgaon",
                "Jagdalpur",
                "Ambikapur", "Raigarh", "Jashpur", "Kanker", "Mahasamund", "Dhamtari", "Gariaband",
                "Balod",
                "Bemetara", "Mungeli", "Chirmiri", "Champa", "Bemetara", "Baikunthpur", "Kondagaon",
                "Tilda Neora", "Naila Janjgir", "Mahasamund", "Dalli-Rajhara", "Janjgir-cahmpa"
            ],
            "Goa": ["Panaji", "Margao", "Vasco da Gama", "Mapusa", "Ponda", "canacona", "Calangute",
                "Mormugao",
                "Bardez", "Arpora", "Tiswadi", "pernem", "Rajbag", "Patnem", "Cavelossim", "Valpoi",
                "Cuncolim", "Quepem", "Curchorem–Cacora", "Sanguem", "Aldona", "Anjuna", "Aquem",
                "Bandora", "Benaulim", "Borim", "Calapor", "Chicalim", "Chimbel", "Chinchinim",
                "Colvale", "Corlim", "Cortalim", "Davorlim", "Goa Velha", "Guirim", "Mandrem",
                "Murda",
                "Navelim", "Nerul", "Nuvem", "Onda", "Orgao", "Pale", "Parcem", "Penha-de-Franca",
                "Pilerne", "Priol", "Raia", "Reis Magos", "Saligao", "Sanvordem",
                "São José de Areal",
                "Siolim", "Socorro (Serula)", "Usgao", "Varca", "Verna", "Xeldem"
            ],
            "Gujarat": ["Ahmedabad", "Surat", "Vadodara", "Rajkot", "Bhavnagar", "Jamnagar", "Junagadh",
                "Gandhinagar", "Veraval", "Vadali", "Songadh", "Talaja", "Dwarka", "Ankleshwar",
                "Ahwa",
                "Amreli", "Bharuch", "Porbandar", "Godhra", "Navsari", "Anand", "Surendranagar",
                "Vapi",
                "Navsari", "Mehsana", "Palanpur", "Patan", "Godhra", "Dahod",
                "Himmatnagar", "Modasa", "Idar", "Veraval", "Porbandar", "Dwarka", "Botad",
                "Amreli",
                "Mahuva", "Khambhat", "Ankleshwar", "Kalol", "Gandhidham", "Mundra", "Kutch (Bhuj)",
                "Valasad"
            ],
            "Haryana": [
                "Gurugram", "Faridabad", "Panipat", "Ambala", "Yamunanagar", "Rohtak", "Hisar",
                "Chandigarh", "Karnal", "Sonipat", "Sirsa", "Bahadurgarh", "Jind", "Thanesar",
                "Kaithal", "Rewari", "Bhiwani", "Palwal", "Pinjore", "Panchkula", "Kurukshetra",
                "Fatehabad", "Narnaul", "Mahendragarh", "Charkhi Dadri",
                "Jhajjar", "Gohana", "Hansi", "Jagadhri", "Kalka", "Ballabgarh", "Sohna", "Tauru",
                "Hathin",
                "Hodal"
            ],
            "Himachal Pradesh": [
                "Shimla", "Dharamshala", "Solan", "Mandi", "Kullu", "Manali", "Palampur",
                "Bilaspur",
                "Hamirpur", "Una", "Kangra", "Chamba", "Kinnaur", "Lahaul and Spiti", "Sirmaur",
                "Nahan", "Baddi", "Parwanoo", "Kasauli", "Dalhousie", "Mcleodganj", "Jogindernagar",
                "Sundernagar", "Baijnath", "Nurpur", "Pathankot", "Nalagarh",
                "Amb", "Gagret", "Bharwain", "Nadaun", "Sujanpur", "Rampur", "Rekong Peo", "Kalpa",
                "Keylong", "Kaza", "Rohru", "Theog", "Chopal", "Arki", "Rajgarh",
                "Pachhad", "Paonta Sahib", "Renuka", "Sarahan"
            ],
            "Jharkhand": ["Ranchi", "Jamshedpur", "Dhanbad", "Bokaro", "Deoghar", "Hazaribagh",
                "Giridih",
                "Ramgarh", "Medininagar", "Chaibasa", "Rajmahal", "Sahibganj", "Pakur", "Dumka",
                "Godda",
                "Sahebganj", "Lohardaga", "Gumla", "Simdega", "Khunti", "Saraikela",
                "Chakradharpur",
                "Manoharpur", "Adityapur", "Jugsalai", "Bistupur", "Sakchi", "Kadma", "Sonari",
                "Jharia",
                "Sindri", "Nirsa", "Katras", "Govindpur", "Chas", "Bermo", "Phusro", "Gomoh",
                "Topchanchi",
                "Tundi", "Baghmara", "Bagodar", "Pirtand", "Bansjor", "Tisri", "Koderma", "Dhanwar",
                "Chatra", "Hunterganj", "Simaria", "Tandwa", "Lathehar", "Manika", "Chandwa",
                "Balumath",
                "Satbarwa", "Daltonganj", "Garhwa", "Bishrampur", "Bhandaria", "Ranka",
                "Bhawanathpur",
                "Hussainabad", "Chinia", "Mahagama"
            ],
            "Karnataka": ["Bangalore", "Mysore", "Mangalore", "Hubli", "Belgaum", "Gulbarga",
                "Davanagere",
                "Bellary", "Tumkur", "Shimoga", "Bijapur", "Raichur", "Bidar", "Hassan", "Udupi",
                "Chikmagalur", "Mandya", "Kolar", "Chitradurga", "Bagalkot", "Dharwad", "Gadag",
                "Haveri",
                "Uttara Kannada", "Dakshina Kannada", "Kodagu", "Chamarajanagar", "Chikkaballapur",
                "Ramanagara", "Yadgir", "Koppal", "Vijayanagara", "Karwar", "Bhatkal", "Sirsi",
                "Sagar",
                "Thirthahalli", "Hosanagar", "Kundapura", "Brahmavar", "Karkala", "Puttur",
                "Sullia",
                "Madikeri", "Virajpet", "Somvarpet", "Kushalanagar", "Gokarna", "Kumta", "Honnavar",
                "Ankola", "Yellapur", "Mundgod", "Haliyal", "Joida", "Siddapur", "Sirsi", "Sagar",
                "Hosanagar", "Thirthahalli", "Shimoga", "Bhadravati", "Tarikere", "Channagiri",
                "Harihar",
                "Ranebennur", "Hirekerur", "Shiggaon", "Savanur", "Byadgi", "Hangal", "Kundgol",
                "Navalgund", "Shirhatti", "Mundargi", "Nargund", "Gajendragad", "Ron",
                "Lakshmeshwar",
                "Gadag", "Betgeri", "Hulkoti", "Shirhatti", "Mundargi", "Nargund", "Gajendragad",
                "Ron",
                "Lakshmeshwar", "Gadag", "Betgeri", "Hulkoti", "Kalaghatgi", "Kundgol", "Dharwad",
                "Hubli",
                "Kalghatgi", "Navalgund", "Alnavar", "Belgaum", "Chikodi", "Gokak", "Athani",
                "Raibag",
                "Soundatti", "Savadatti", "Parasgad", "Khanapur", "Bailhongal", "Mudalgi",
                "Jamkhandi",
                "Biljapur", "Muddebihal", "Bagewadi", "Hungund", "Ilkal", "Narayanpet", "Bagalkot",
                "Badami", "Hunagund", "Mudhol", "Terdal", "Guledgudda", "Kerur", "Lokapur",
                "Mahalingpur",
                "Rabkavi Banhatti", "Saundatti", "Terdal", "Vijayapura", "Indi", "Sindgi",
                "Basavana Bagewadi", "Chadchan", "Muddebihal", "Talikota", "Nidagundi", "Tikota",
                "B Bagewadi", "Kolhar", "Devar Hippargi", "Talikota", "Gulbarga", "Afzalpur",
                "Aland",
                "Chincholi", "Chitapur", "Gulbarga", "Jevargi", "Kalagi", "Sedam", "Shahabad",
                "Shorapur",
                "Yadgir", "Hunagunda", "Surpur", "Shorapur", "Raichur", "Devadurga", "Lingsugur",
                "Manvi",
                "Sindhanur", "Sirwar", "Koppal", "Gangavathi", "Karatagi", "Kushtagi", "Yelburga",
                "Hospet",
                "Hagaribommanahalli", "Hoovina Hadagali", "Kudligi", "Sandur", "Siruguppa",
                "Toranagallu",
                "Kampli", "Ballari", "Hadagalli", "Harappanahalli", "Harpanhalli", "Hosdurga",
                "Jagalur",
                "Molakalmuru", "Chitradurga", "Bharamasagara", "Challakere", "Hiriyur", "Holalkere",
                "Hosadurga", "Tumkur", "Chikkanayakanahalli", "Cnhalli", "Gubbi", "Hiriyur",
                "Koratagere",
                "Kunigal", "Madhugiri", "Pavagada", "Sira", "Tiptur", "Turuvekere", "Kolar",
                "Bangarpet",
                "Chikkaballapur", "Chintamani", "Gauribidanur", "Gudibanda", "Malur", "Mulbagal",
                "Sidlaghatta", "Srinivaspur", "Chikkaballapur", "Bagepalli", "Chickballapur",
                "Gowribidanur", "Gudibande", "Sidlaghatta", "Ramanagara", "Channapatna",
                "Kanakapura",
                "Magadi", "Ramanagara", "Hassan", "Alur", "Arkalgud", "Arsikere", "Belur",
                "Channarayapatna", "Hassan", "Holenarsipur", "Sakleshpur", "Mandya",
                "Krishnarajpet",
                "Maddur", "Malavalli", "Mandya", "Nagamangala", "Pandavapura", "Shrirangapattana",
                "Mysore",
                "Bannur", "Chamarajanagar", "Gundlupet", "Hanur", "Kollegal", "Mysore", "Nanjangud",
                "Piriyapatna", "Sargur", "Suttur", "T Narasipur", "Yelandur", "Kodagu", "Madikeri",
                "Somvarpet", "Virajpet", "Chikmagalur", "Kadur", "Koppa", "Mudigere",
                "Narasimharajapura",
                "Sringeri", "Tarikere", "Dakshina Kannada", "Bantwal", "Belthangady", "Mangalore",
                "Moodbidri", "Puttur", "Sullia", "Udupi", "Brahmavar", "Byndoor", "Hebri",
                "Karkala",
                "Kaup", "Kundapur", "Udupi"
            ],
            "Kerala": ["Thiruvananthapuram", "Kochi", "Kozhikode", "Thrissur", "Kollam", "Palakkad",
                "Alappuzha", "Kannur", "Kottayam", "Malappuram", "Kasaragod", "Pathanamthitta",
                "Idukki",
                "Ernakulam", "Wayanad", "Attingal", "Varkala", "Neyyattinkara", "Parassala",
                "Kazhakuttom",
                "Poovar", "Kovalam", "Vizhinjam", "Balaramapuram", "Nedumangad", "Karakulam",
                "Munnar",
                "Thekkady", "Kumily", "Devikulam", "Udumbanchola", "Thodupuzha", "Adimali",
                "Rajakumari",
                "Kattappana", "Peerumade", "Vandanmedu", "Marayoor", "Kanjirappally",
                "Changanassery",
                "Vaikom", "Ettumanoor", "Pala", "Teekoy", "Kumarakom", "Erattupetta", "Mundakayam",
                "Ponkunnam", "Ranni", "Kozhencherry", "Thiruvalla", "Adoor", "Pathanamthitta",
                "Mallappally", "Konni", "Pandalam", "Aranmula", "Chengannur", "Mavelikara",
                "Kayamkulam",
                "Haripad", "Ambalappuzha", "Cherthala", "Mararikulam", "Kumbakonam", "Kuttanad",
                "Changanacherry", "Quilon", "Karunagappally", "Kottarakkara", "Punalur", "Anchal",
                "Kunnathur", "Sasthamcotta", "Kundara", "Chavara", "Ochira", "Chadayamangalam",
                "Paravur",
                "Vettoor", "Ayoor", "Ernakulam", "Fort Kochi", "Mattancherry", "Aluva",
                "Perumbavoor",
                "Muvattupuzha", "Kothamangalam", "Angamaly", "Kalamassery", "Tripunithura",
                "Edappally",
                "Kakkanad", "Cheranalloor", "Chottanikkara", "Piravom", "Kolenchery",
                "Mulanthuruthy",
                "Paippad", "Kodanad", "Malayattoor", "Kalady", "Njarakkal", "Vypin", "Guruvayur",
                "Kodungallur", "Irinjalakuda", "Chalakudy", "Kunnamkulam", "Wadakkanchery", "Ollur",
                "Cherpu", "Mathilakam", "Mala", "Kodakara", "Thrissur", "Chavakkad", "Ponnani",
                "Tirur",
                "Tanur", "Parappanangadi", "Kondotty", "Wandoor", "Nilambur", "Manjeri",
                "Perinthalmanna",
                "Areekode", "Kottakkal", "Valanchery", "Tirurangadi", "Vengara", "Marakkara",
                "Edappal",
                "Perumpadappu", "Ottapalam", "Shoranur", "Cherpulassery", "Kongad", "Mannarkad",
                "Alathur",
                "Chittur", "Nemmara", "Kollengode", "Pattambi", "Thrithala", "Kuzhalmannam",
                "Shornur",
                "Lakkidi", "Calicut", "Vadakara", "Koyilandy", "Ramanattukara", "Feroke", "Beypore",
                "Elathur", "Mukkam", "Thiruvambady", "Balussery", "Panthalayani", "Payyoli",
                "Cheruvannur",
                "Chathamangalam", "Koduvally", "Perambra", "Quilandy", "Thaliparamba", "Iritty",
                "Peravoor",
                "Kuthuparamba", "Mattannur", "Kalliassery", "Anthoor", "Valapattanam", "Azhikode",
                "Dharmadam", "Muzhappilangad", "Payyanur", "Cheruthazham", "Irikkur",
                "Sreekandapuram",
                "Taliparamba", "Chirakkal", "Brasilia", "Pazhayangadi", "Kanhangad", "Bekal",
                "Manjeshwar",
                "Uppala", "Kasaragod", "Chemnad", "Badiyadukka", "Pullur", "Kayyur", "Bedadka",
                "Balal",
                "Perla", "Delampady", "Kuttikol", "Nileshwar", "Vellarikundu", "Trikkarippur",
                "Cheruvathur", "Pilicode", "Manjeswaram", "Kumbla", "Parappa", "Bakel",
                "Sulthan Bathery",
                "Kalpetta", "Mananthavady", "Vythiri", "Meppadi", "Ambalavayal", "Thirunelli",
                "Pulpally",
                "Panamaram", "Vellamunda", "Pozhuthana", "Wayanad"
            ],
            "Madhya Pradesh": ["Bhopal", "Indore", "Gwalior", "Jabalpur", "Ujjain", "Sagar", "Dewas",
                "Satna", "Ratlam", "Rewa", "Katni", "Singrauli", "Burhanpur", "Khandwa", "Bhind",
                "Chhindwara", "Guna", "Shivpuri", "Vidisha", "Chhatarpur", "Damoh", "Mandsaur",
                "Khargone",
                "Neemuch", "Pithampur", "Morena", "Betul", "Harda", "Hoshangabad", "Raisen",
                "Sehore",
                "Rajgarh", "Shajapur", "Agar Malwa", "Alirajpur", "Anuppur", "Ashoknagar",
                "Balaghat",
                "Barwani", "Datia", "Dhar", "Dindori", "East Nimar", "Gwalior", "Harda",
                "Hoshangabad",
                "Jhabua", "Katni", "Khandwa", "Khargone", "Mandla", "Mandsaur", "Morena",
                "Narsinghpur",
                "Neemuch", "Panna", "Raisen", "Rajgarh", "Ratlam", "Rewa", "Sagar", "Satna",
                "Sehore",
                "Seoni", "Shahdol", "Shajapur", "Sheopur", "Shivpuri", "Sidhi", "Singrauli",
                "Tikamgarh",
                "Ujjain", "Umaria", "Vidisha", "West Nimar", "Itarsi", "Sanchi", "Orchha",
                "Khajuraho",
                "Pachmarhi", "Omkareshwar", "Maheshwar", "Mandu", "Chanderi", "Shivpuri", "Datia",
                "Jhansi",
                "Lalitpur", "Tikamgarh", "Chhatarpur", "Panna", "Damoh", "Sagar", "Vidisha",
                "Raisen",
                "Sehore", "Rajgarh", "Shajapur", "Agar", "Dewas", "Indore", "Dhar", "Jhabua",
                "Alirajpur",
                "Barwani", "Khargone", "Burhanpur", "Khandwa", "Harda", "Hoshangabad", "Betul",
                "Chhindwara", "Seoni", "Mandla", "Dindori", "Balaghat", "Gondia", "Jabalpur",
                "Katni",
                "Narsinghpur", "Chhindwara", "Seoni", "Mandla", "Dindori", "Umaria", "Shahdol",
                "Anuppur",
                "Sidhi", "Singrauli", "Rewa", "Satna", "Maihar", "Nagod", "Amarpatan", "Mauganj",
                "Chitrakoot", "Banda", "Hamirpur", "Mahoba", "Jalaun", "Jhansi", "Lalitpur",
                "Sagar",
                "Damoh", "Panna", "Chhatarpur", "Tikamgarh", "Niwari", "Orchha", "Prithvipur",
                "Niwari",
                "Khurai", "Banda", "Deori", "Rehli", "Khurai", "Banda", "Deori", "Rehli", "Bina",
                "Kurwai",
                "Vidisha", "Basoda", "Gyaraspur", "Lateri", "Sironj", "Gulabganj", "Berasia",
                "Obedullaganj", "Raisen", "Bareli", "Begamganj", "Gairatganj", "Sanchi", "Silwani",
                "Udaipura", "Budhni", "Ichhawar", "Hoshangabad", "Babai", "Kesla", "Seoni Malwa",
                "Sohagpur", "Pipariya", "Bankhedi", "Timarni", "Susner", "Agar", "Nalkheda",
                "Barod",
                "Dewas", "Sonkatch", "Khategaon", "Kannod", "Hatpipalya", "Satwas", "Tonk Khurd",
                "Bagli",
                "Mhow", "Sanwer", "Hatod", "Depalpur", "Indore", "Dhar", "Kukshi", "Manawar",
                "Sardarpur",
                "Gandhwani", "Nisarpur", "Jhabua", "Petlawad", "Thandla", "Meghnagar", "Jobat",
                "Alirajpur",
                "Sondwa", "Udaygarh", "Katthiwara", "Pansemal", "Sendhwa", "Barwani", "Rajpur",
                "Thikri",
                "Niwali", "Bhagvanpura", "Khargone", "Gogawan", "Kasrawad", "Bhikangaon",
                "Maheshwar",
                "Mandleshwar", "Omkareshwar", "Punasa", "Burhanpur", "Nepanagar", "Khandwa",
                "Pandhana",
                "Punasa", "Khalwa", "Harda", "Khirkiya", "Timarni", "Hoshangabad", "Sohagpur",
                "Kesla",
                "Seoni Malwa", "Babai", "Itarsi", "Bankhedi", "Pipariya", "Pachmarhi", "Betul",
                "Multai",
                "Bhainsdehi", "Shahpur", "Amla", "Ghoradongri", "Chicholi", "Chhindwara", "Sausar",
                "Amarwara", "Chourai", "Harrai", "Junnardeo", "Parasia", "Pandhurna", "Mohkhed",
                "Seoni",
                "Lakhnadon", "Barghat", "Keolari", "Ghansaur", "Mandla", "Bichhiya", "Narayanganj",
                "Niwas",
                "Dindori", "Shahpura", "Karanjia", "Mehandwani", "Samnapur", "Balaghat", "Birsa",
                "Waraseoni", "Katangi", "Khairlanji", "Paraswada", "Lanji", "Baihar", "Malajkhand",
                "Kirnapur", "Jabalpur", "Sihora", "Katni", "Rithi", "Dhimarkheda", "Bargi",
                "Shahpura",
                "Majholi", "Panagar", "Narsinghpur", "Gadarwara", "Kareli", "Gotegaon",
                "Tendukheda",
                "Babina", "Narsimhapur", "Umaria", "Manpur", "Nowrozabad", "Shahdol", "Beohari",
                "Jaisinghnagar", "Jaitpur", "Anuppur", "Jaithari", "Kotma", "Venkatnagar",
                "Pushprajgarh",
                "Sidhi", "Gopad Banas", "Majhauli", "Kusmi", "Churhat", "Chitrangi", "Singrauli",
                "Waidhan",
                "Deosar", "Sarai", "Devsar", "Rewa", "Sirmour", "Hanumana", "Jawa", "Gurh",
                "Mangawan",
                "Teonthar", "Satna", "Raghurajnagar", "Amarpatan", "Maihar", "Nagod", "Unchehra",
                "Kotar",
                "Sohawal"
            ],
            "Maharashtra": ["Mumbai", "Pune", "Nagpur", "Nashik", "Aurangabad", "Solapur", "Thane",
                "Kolhapur", "Amravati", "Navi Mumbai", "Kalyan", "Dombivli", "Sangli",
                "Jalgaon", "Akola", "Latur", "Ahmednagar", "Chandrapur", "Parbhani", "Dhule",
                "Ichalkaranji", "Panvel", "Beed", "Osmanabad", "Wardha", "Satara",
                "Yavatmal", "Nanded", "Bhiwandi", "Malegaon", "Gondia", "Thane", "Pimpri-Chinchwad",
                "Badlapur", "Gondia", "Satara", "Barshi", "Yavatmal", "Achalpur", "Nandurbar",
                "Udgir",
                "Ahmednagar", "Miraj", "Kamptee", "Parli", "Chiplun", "Ratnagiri", "Ichalkaranji",
                "Jalna",
                "Ambarnath", "Bhusawal", "Sangli‑Miraj‑Kupwad", "Malegaon", "Jalgaon",
            ],
            "Manipur": [
                "Imphal", "Thoubal", "Bishnupur", "Churachandpur", "Kakching", "Ukhrul", "Senapati",
                "Tamenglong", "Chandel", "Jiribam",
                "Kangpokpi", "Moreh", "Noney", "Pherzawl", "Mayang Imphal", "Moirang", "Nambol",
                "Samurou",
                "Lilong", "Heirok", "Wangjing", "Yairipok", "Sekmai Bazar", "Khongman",
                "Thoibang (Hill Town)", "Sikhong Sekmai", "Tengnoupal", "Rengkai", "Zenhang Lamka",
                "Hill Town", "Nambol", "Porompat", "Khurai Sajor Leikai", "Thongju", "Kshetrigao",
            ],
            "Meghalaya": [
                "Shillong", "Tura", "Jowai", "Nongstoin", "Baghmara", "Williamnagar", "Resubelpara",
                "Mawkyrwat", "Ampati", "Khliehriat", "Sohra (Cherrapunji)", "Mairang", "Nongpoh",
                "Nongthymmai", "Mawlai", "Mawpat", "Nongmynsong", "Pynthorumkhrah", "Umlyngka",
                "Lawsohtun",
                "Nongkseh", "Umpling", "Madanrting", "Cherrapunji", "Pynursla", "Cherrapunji",
                "Riwai",
                "Mawlyngot", "Mawlynnong", "Mawsynram",
            ],
            "Mizoram": [
                "Aizawl", "Lunglei", "Saiha", "Champhai", "Kolasib", "Serchhip", "Lawngtlai",
                "Mamit",
                "Saitual",
                "Hnahthial", "North Vanlaiphai", "Biate", "Thenzawl", "Zawlnuam", "Bairabi",
                "Sairang",
                "Zawlnuam", "Thenzawl", "Khawzawl", "Hnahthial", "Lengpui", "North Vanlaiphai",
                "Tlabung",
                "Vairengte", "Biate", "Darlawn", "Hnahthial", "Khawhai", "N. Kawnpui", "Khawzawl",
                "Zokhawthar"
            ],
            //end
            "Nagaland": ["Kohima", "Dimapur", "Mokokchung", "Tuensang", "Wokha", "Mon", "Zunheboto",
                "Chumukedima", "Longleng", "Kiphire", "Phek", "Changtongya", "Tsudikong", "Jalukie",
                "Tuli",
                "Pughoboto", "Ahthibung", "Kuda",
                "Chizami", "Chinglong", "Chungtia", "Chozumi", "Jotsama", "Ghaspani", "Henima",
                "Chimakudi",
                "Chipoketami", "Lazami", "Longching", "Lakhuti", "Laruri", "Litim"
            ],
            "Odisha": ["Bhubaneswar", "Cuttack", "Rourkela", "Brahmapur", "Sambalpur", "Puri",
                "Balasore",
                "Baripada", "Bhadrak", "Angul", "Talcher", "Athmallik", "Chhendipada", "Pallahara",
                "Jaleswar", "Soro", "Baliapal", "Basta", "Nilagiri", "Remuna", "Simulia", "Bargarh",
                "Attabira", "Barapali", "Bheden", "Bijepur", "Padmapur", "Paikamal", "Sohela",
                "Basudevpur",
                "Agarpada", "Chandabali", "Dhamnagar", "Dhamra", "Jagatsinghpur", "Paradeep",
                "Kujang",
                "Jajpur", "Vyasanagar", "Belpahar", "Brajarajnagar", "Jharsuguda", "Bhawanipatna",
                "Dharamgarh"
            ],
            "Punjab": ["Chandigarh", "Ludhiana", "Amritsar", "Jalandhar", "Patiala", "Bathinda",
                "Mohali",
                "Hoshiarpur", "Pathankot", "Moga", "Batala", "Abohar", "Malerkotla", "Khanna",
                "Muktsar",
                "Barnala", "Firozpur", "Kapurthala", "Phagwara", "Zirakpur", "Rajpura",
                "Dera Bassi",
                "Lalru", "Banur", "Sangrur", "Sunam", "Dhuri", "Ahmedgarh", "Longowal", "Lehragaga",
                "Bhawanigarh", "Moonak", "Dirba", "Khem Karan", "Tarn Taran", "Patti", "Bhikhiwind",
                "Amritsar Cantonment", "Firozpur Cantonment", "Jalandhar Cantonment", "Daper",
                "Mubarakpur",
                "Balongi", "Bhankharpur", "Sohana", "Mullanpur Garib Dass", "Mirpur", "Nangli",
                "Budha Theh", "Kathanian", "Baba Bakala", "Chogawan", "Khilchian", "Mudal", "Mehna",
                "Bhisiana", "Korianwali", "Satyewala", "Tibri", "Fateh Nangal", "Behrampur",
                "Shikar",
                "Baryar", "Chohal", "Hazipur", "Rakri", "Sufipind", "Jandiala", "Sarai Khas",
                "Apra",
                "Dhin", "Khambra", "Sansarpur", "Raipur Rasulpur", "Chomon", "Phagwara Sharki",
                "Hussainpur", "Chachoki", "Gill", "Bhamian Kalan", "Tharike", "Bhattian",
                "Partap Singhwala", "Halwara", "Akalgarh", "Baddowal", "Jodhan", "Rail", "Khothran",
                "Saloh", "Aur", "Mamun", "Jugial", "Daulatpur", "Narot Mehra", "Ghoh", "Manwal",
                "Sarna",
                "Kot", "Bungal", "Tharial", "Malikpur", "Dhaki", "Rurki Kasba", "Alhoran", "Nilpur",
                "Nehon", "Nawan Sujanpur"
            ],
            "Rajasthan": ["Jaipur", "Jodhpur", "Kota", "Bikaner", "Ajmer", "Udaipur", "Bhilwara",
                "Alwar",
                "Beawar", "Bhilwara", "Churu", "Sri Ganganagar", "Hanumangarh", "Jhunjhunu",
                "Kishangarh",
                "Pali", "Sikar", "Sirohi", "Tonk", "Kotputli", "Gangapur City", "Dausa", "Nagaur",
                "Bhiwadi", "Sawai Madhopur", "Kekri", "Sikar", "Bharatpur", "Pali", "Nawalgarh",
                "Vijainagar", "Nasirabad", "Sujangarh", "Chirawa", "Bidasar", "Ratangarh",
                "Chhapar",
                "Mandawa", "Pilani", "Mukandgarh", "Reengus", "Phulera", "Jobner", "Bagru",
                "Chaksu",
                "Deoli", "Deshnoke", "Dhariawad", "Didwana", "Dungargarh", "Falna", "Fatehnagar",
                "Fatehpur", "Gajsinghpur", "Goredi Chancha", "Govindgarh", "Gulabpura", "Hindaun",
                "Jahazpur", "Jalore", "Jhalawar", "Jhalrapatan"
            ],
            "Sikkim": ["Gangtok", "Namchi", "Gyalshing", "Mangan", "Pakyong", "Jorethang", "Rangpo",
                "Singtam", "Ravangla", "Mangan", "Pelling", "Chungthang", "Lachen", "Lachung",
                "Rhenock",
                "Rongli", "Yuksom", "Melli", "Sherathang", "Legship", "Majitar", "Namthang",
                "Yangang",
                "Damthang", "Nayabazar", "Singhik", "Tashiding", "Makha", "Rorathang", "Tumlong",
                "Ranipool", "Hee Burmiok", "Kumrek", "Richenpong", "Thambi Viewpoint (Zuluk)",
                "Sherathang",
                "Naya Bazar", "Chidam"
            ],
            "Tamil Nadu": ["Chennai", "Coimbatore", "Madurai", "Tiruchirappalli", "Salem",
                "Tirunelveli",
                "Erode",
                "Vellore", "Tiruppur", "Vellore", "Thoothukudi", "Dindigul", "Thanjavur", "Hosur",
                "Nagercoil", "Avadi", "Tambaram", "Kanchipuram", "Cuddalore", "Karur", "Kumbakonam",
                "Sivakasi", "Pudukottai", "Karaikudi", "Tiruvannamalai", "Namakkal", "Ambattur",
                "Tiruvottiyur", "Pallavaram", "Madavaram", "Alandur", "Kurichi", "Rajapalayam",
                "Neyveli",
                "Nagapattinam",
                "Mettunasuvanpalayam", "Thottipalayam", "Thevaram", "Tiruppattur", "Devakottai",
                "Lalgudi",
                "Milavittan", "Mappilaiurani", "Muttayyapuram", "Athimarapatti", "Sankaraperi",
                "Kumaragiri", "Nanjikottai", "Vallam", "Neelagiri", "Pudupattinam", "Vilar"
            ],
            "Telangana": ["Hyderabad", "Warangal", "Nizamabad", "Khammam", "Karimnagar", "Ramagundam",
                "Secunderabad", "Greater Warangal", "Mahabubnagar", "Nalgonda", "Adilabad",
                "Suryapet",
                "Miryalaguda", "Siddipet", "Jagtial", "Bhainsa", "Boduppal", "Jawaharnagar",
                "Medak",
                "Shamshabad", "Mahabubabad", "Bhupalpally", "Narayanpet", "Dundigal", "Huzurnagar",
                "Medchal", "Bandlaguda Jagir", "Kyathanpally", "Manuguru", "Naspur", "Narsampet",
                "Devarakonda", "Dubbaka", "Nakrekal", "Banswada", "Kalwakurthy", "Parigi",
                "Thumkunta",
                "Neredcherla", "Nagaram", "Gajwel", "Chennur", "Asifabad", "Madhira", "Ghatkesar",
                "Kompally", "Pocharam", "Dammaiguda", "Achampet", "Choutuppal", "Yenugonda",
                "Boyapalle",
                "Allipur", "Eddumailaram", "Dharmaram", "Pothreddipalle", "Kamalapuram",
                "Luxettipet",
                "Chandur", "Medipalle", "Kothur", "Ramannapeta", "Narsingi", "Jallaram",
                "Bibinagar",
                "Isnapur", "Asifabad"
            ],
            "Tripura": ["Agartala", "Dharmanagar", "Udaipur", "Kailashahar", "Bishalgarh", "Teliamura",
                "Khowai", "Belonia", "Melaghar", "Mohanpur", "Ambassa", "Ranirbazar", "Santirbazar",
                "Kumarghat", "Sonamura", "Panisagar", "Amarpur", "Jirania", "Kamalpur", "Sabroom",
                "Badharghat", "Gakulnagar", "Gandhigram", "Indranagar", "Jogendranagar",
                "Kanchanpur",
                "Narsingarh", "Pratapgarh", "Dharmanagar (CT)", "Khowai (CT)", "Chandigarh (CT)",
                "Madhupur", "Madhuban", "Fulkumari", "Lebachhara", "Manu Bazar", "Mairuhabari",
                "Manoharpur", "Manpui", "Meltraipara", "Moghiyabari", "Mukhachariduar",
                "Muktasinghpara",
                "Nakraihapara", "Navanchanarabari"
            ],
            "Uttar Pradesh": ["Lucknow", "Kanpur", "Ghaziabad", "Agra", "Varanasi", "Meerut",
                "Allahabad",
                "Bareilly", "Prayagraj", "Moradabad", "Aligarh", "Saharanpur", "Meerut",
                "Muzaffarnagar",
                "Gorakhpur", "Basti", "Jhansi", "Noida", "Greater Noida", "Gautam Buddha Nagar",
                "Firozabad", "Ghaziabad", "Ghazipur", "Sitapur", "Raebareli", "Pratapgarh",
                "Rampur",
                "Shamli", "Bijnor", "Ballia", "Azamgarh", "Basti", "Farrukhabad", "Shikohabad",
                "Akbarpur",
                "Tanda", "Basti", "Chandausi", "Bijnor", "Kasganj", "Awagarh", "Ballia", "Gonda",
                "Farrukhabad", "Fatehpur", "Firozabad", "Sambhal", "Shahjahanpur", "Jaunpur",
                "Ambedkar Nagar",
                "Raebareli", "Mau", "Saharsa", "Aligarh", "Hapur", "Achalganj", "Bangarmau",
                "Ganj Muradabad",
                "Safipur", "Kursath", "Auras", "Hyderabad(Unnao)", "Rasulabad", "Mohan(Unnao)",
                "Nawabganj(Unnao)",
                "Purwa ", "Maurawan", "Bighapur", "Bhagwant Nagar", "Katri Piper Khera",
                "Achalganj(CT)",
                "Majhara Pipar Ahatmali"
            ],
            "Uttarakhand": ["Dehradun", "Haridwar", "Roorkee", "Haldwani", "Rudrapur", "Kashipur",
                "Rishikesh", "Kotdwar", "Pithoragarh", "Almora", "Chakrata", "Landour", "Ramnagar",
                "Manglaur", "Jaspur", "Kichha", "Nainital", "Mussoorie", "Sitarganj", "Bajpur",
                "Pauri",
                "Tehri", "Gopeshwar", "Srinagar", "Gadarpur", "Tanakpur", "Uttarkashi",
                "Jyotirmath",
                "Rudraprayag", "Bageshwar", "Bhowali", "Narendranagar", "Dugadda", "Laksar",
                "Landhaura",
                "Mahua Kheraganj", "Dineshpur", "Jhabrera", "Kela Khera", "Muni Ki Reti",
                "Sultanpur",
                "Herbertpur", "Gauchar", "Doiwala", "Karnaprayag", "Lohaghat", "Chamba", "Bhimtal",
                "Lalkuan", "Kaladhungi", "Dharchula", "Barkot", "Didihat", "Garur", "Kapkot"
            ],
            "West Bengal": ["Kolkata", "Howrah", "Durgapur", "Asansol", "Siliguri", "Bardhaman",
                "Malda",
                "Barijhati", "Barjora",
                "Alipurduar", "Arambag", "Ashoknagar Kalyangarh", "Baduria", "Baharampur",
                "Baidyabati",
                "Bally", "Balurghat", "Bangaon", "Bankura", "Bansberia", "Baranagar", "Barasat",
                "Begampur",
                "Bikrampur", "Barrackpore", "Baruipur", "Basirhat", "Beldanga", "Bhadreswar",
                "Bhatpara",
                "Birnagar", "Bishnupur", "Bolpur", "Budge Budge", "Buniadpur", "Chakdaha",
                "Champdani",
                "Chandrakona", "Contai", "Dainhat", "Dalkhola", "Dankuni", "Darjeeling", "Dhulian",
                "Dhupguri", "Diamond Harbour", "Dinhata", "Domkal", "Dubrajpur", "Dum Dum", "Egra",
                "English Bazar", "Falakata", "Gangarampur", "Garulia", "Gayespur", "Ghatal",
                "Gobardanga",
                "Guskara", "Habra", "Haldia", "Haldibari", "Halisahar", "Hooghly‑Chinsurah",
                "Islampur",
                "Jalpaiguri", "Jangipur", "Jaynagar Majilpur", "Jhalda", "Jhargram",
                "Jiaganj‑Azimganj",
                "Kaliaganj", "Kalimpong", "Kalna", "Kalyani", "Kamarhati", "Kanchrapara", "Kandi",
                "Katwa",
                "Kharagpur", "Maheshtala", "Mainaguri", "Mal", "Midnapore", "Murshidabad",
                "Nabadwip",
                "Naihati", "New Barrackpur", "North Barrackpur", "North Dumdum", "Old Malda",
                "Panskura",
                "Panihati", "Pujali", "Purulia", "Raghunathpur", "Raiganj", "Rajpur Sonarpur",
                "Ramjibanpur", "Rampurhat", "Ranaghat", "Rishra", "Sainthia", "Santipur",
                "Serampore",
                "South Dumdum", "Suri", "Taki", "Tamluk", "Tarakeswar", "Titiksha",
                "Bilandapur", "Chak Enayetnagar", "Chak Kashipur", "Chakdaha", "Chachanda",
                "Birlapur",
                "Bowali", "Char Brahmanganj", "Char Majidia", "Kalaria", "Kulberia", "Chaltia",
                "Gopjan",
                "Kasim Bazar", "Sibdanga Badarpur", "Banjetia", "Ajodhya Nagar", "Haridasmati",
                "Gora Bazar", "Goaljan"

            ],
            "Delhi": ["New Delhi", "Dwarka", "Rohini", "Janakpuri", "Lajpat Nagar", "Karol Bagh",
                "Connaught Place", "North Delhi", "South Delhi", "East Delhi", "West Delhi",
                "Central Delhi", "Shahdara", "Pitampura", "Karol Bagh", "Lajpat Nagar", "Saket",
                "Connaught Place", "Chanakyapuri", "Mayur Vihar", "Vasant Kunj", "Janakpuri",
                "Rajouri Garden", "Laxmi Nagar", "Narela", "Okhla", "Badarpur", "Mehrauli",
                "Najafgarh",
                "Ashok Vihar", "Burari", "Vikaspuri", "Tilak Nagar", "Jangpura", "Greater Kailash",
                "Kalkaji", "Tughlakabad", "Dwarka Mor", "Uttam Nagar"
            ],
            "Jammu and Kashmir": ["Srinagar", "Jammu", "Anantnag", "Baramulla", "Udhampur", "Kathua",
                "Sopore", "Kupwara", "Rajouri", "Poonch", "Pulwama", "Kulgam", "Budgam",
                "Bandipora",
                "Ganderbal", "Reasi", "Handwara", "Doda", "Kishtwar", "Ramban", "Shopian",
                "Awantipora",
                "Bijbehara", "Leh", "Kargil", "Akhnur", "Banihal", "Bhadarwah", "Batote",
                "Bari Brahmana",
                "Qazigund", "Tral", "Charar-i-Sharief", "Thanamandi", "Uri", "Nowshera", "Chenani",
                "Billawar", "Katra", "Verinag"
            ],
            "Ladakh": ["Leh", "Kargil", "Nubra", "Zanskar", "Diskit", "Hemis", "Padum", "Turtuk",
                "Drass",
                "Tangtse", "Nyoma", "Hanle", "Chuchot", "Shey", "Spituk", "Lamayuru", "Basgo",
            ]
        },
        USA: {
            "Alabama": ["Birmingham", "Montgomery", "Mobile", "Huntsville", "Tuscaloosa", "Hoover",
                "Dothan",
                "Auburn", "Decatur", "Madison", "Florence", "Gadsden", "Phenix City", "Enterprise",
                "Vestavia Hills", "Prattville", "Alabaster", "Opelika", "Bessemer", "Homewood"
            ],
            "Alaska": ["Anchorage", "Fairbanks", "Juneau", "Sitka", "Ketchikan", "Wasilla", "Palmer",
                "Kenai",
                "Kodiak", "Bethel", "Homer", "Nome", "Seward", "Valdez", "Barrow (Utqiaġvik)",
                "Petersburg",
                "Wrangell", "Craig", "Cordova",
            ],
            "Arizona": ["Phoenix", "Tucson", "Mesa", "Chandler", "Glendale", "Scottsdale", "Gilbert",
                "Tempe",
                "Peoria", "Surprise", "Yuma", "Flagstaff", "Prescott", "Sierra Vista", "Avondale",
                "Goodyear", "Lake Havasu City", "Casa Grande", "Kingman", "Maricopa", "Nogales",
                "Show Low",
                "Sedona", "Winslow", "Page",
            ],
            "Arkansas": ["Little Rock", "Fort Smith", "Fayetteville", "Springdale", "Jonesboro",
                "North Little Rock", "Conway", "Rogers", "Bentonville", "Pine Bluff", "Hot Springs",
                "Benton", "Texarkana", "Searcy", "Russellville", "Bella Vista", "Van Buren",
                "Cabot",
                "El Dorado", "Paragould",
            ],
            "California": ["Los Angeles", "San Francisco", "San Diego", "San Jose", "Fresno",
                "Sacramento",
                "Oakland", "Long Beach", "Bakersfield", "Anaheim", "Santa Ana", "Riverside",
                "Stockton",
                "Irvine",
                "Chula Vista", "Fremont", "Modesto", "San Bernardino", "Oxnard", "Fontana",
                "Moreno Valley",
                "Huntington Beach", "Glendale", "Santa Clarita", "Garden Grove",
            ],
            "Colorado": ["Denver", "Colorado Springs", "Aurora", "Fort Collins", "Lakewood", "Thornton",
                "Arvada", "Westminster", "Pueblo", "Greeley", "Boulder", "Longmont", "Castle Rock",
                "Loveland", "Broomfield", "Grand Junction", "Commerce City", "Littleton", "Parker",
                "Brighton",
            ],
            "Connecticut": ["Bridgeport", "New Haven", "Hartford", "Stamford", "Waterbury", "Norwalk",
                "Danbury", "New Britain", "West Hartford", "Greenwich", "Manchester", "Meriden",
                "Bristol",
                "Milford", "Middletown", "Shelton", "Torrington", "Stratford", "East Hartford",
                "Groton",
            ],
            "Delaware": ["Wilmington", "Dover", "Newark", "Middletown", "Smyrna", "Milford", "Seaford",
                "Georgetown", "Elsmere", "New Castle", "Lewes", "Harrington", "Camden", "Claymont",
                "Bear",
                "Millsboro", "Bridgeville", "Delmar",
            ],
            "Florida": ["Jacksonville", "Miami", "Tampa", "Orlando", "St. Petersburg", "Hialeah",
                "Tallahassee",
                "Fort Lauderdale", "Port St. Lucie", "Cape Coral", "Pembroke Pines", "Hollywood",
                "Gainesville", "Miramar", "Coral Springs", "Lehigh Acres", "Clearwater", "Palm Bay",
                "Brandon", "West Palm Beach", "Lakeland", "Pompano Beach", "Deltona", "Boca Raton",
                "Daytona Beach", "Ocala", "Sarasota", "Bonita Springs", "Panama City",
            ],
            "Georgia": ["Atlanta", "Augusta", "Columbus", "Macon", "Savannah", "Athens",
                "Sandy Springs",
                "Roswell", "Johns Creek", "Albany", "Warner Robins", "Alpharetta", "Marietta",
                "Valdosta",
                "Smyrna", "Dunwoody", "Peachtree City", "Gainesville", "Newnan", "Dalton",
                "Cartersville",
                "Douglasville", "Statesboro", "Canton", "Rome",
            ],
            "Hawaii": ["Honolulu", "Pearl City", "Hilo", "Kailua", "Waipahu", "Kihei", "Kahului",
                "Lahaina",
                "Wailuku", "Mililani Town", "Ewa Beach", "Makakilo", "Waimea", "Kapaʻa", "Līhue",
                "Hanalei",
                "Volcano", "Pāhoa", "Hāna",
            ],
            "Idaho": ["Boise", "Nampa", "Meridian", "Idaho Falls", "Pocatello", "Caldwell",
                "Twin Falls",
                "Coeur d'Alene", "Lewiston", "Moscow", "Rexburg", "Post Falls", "Eagle", "Kuna",
                "Mountain Home", "Burley", "Ammon", "Chubbuck", "Hailey", "Sandpoint",
            ],
            "Illinois": ["Chicago", "Aurora", "Rockford", "Joliet", "Naperville", "Springfield",
                "Elgin",
                "Peoria", "Champaign", "Waukegan", "Cicero", "Bloomington",
                "Decatur", "Evanston", "Schaumburg", "Arlington Heights", "Bolingbrook", "Palatine",
                "Skokie", "Des Plaines", "Orland Park", "Berwyn", "Tinley Park", "Oak Lawn",
                "Normal",
            ],
            "Indiana": ["Indianapolis", "Fort Wayne", "Evansville", "South Bend", "Carmel",
                "Bloomington",
                "Lafayette", "Gary", "Fishers", "Muncie", "Terre Haute", "Noblesville", "Anderson",
                "Elkhart", "Greenwood", "Mishawaka", "Jeffersonville", "Columbus", "Columbus",
                "Valparaiso",
            ],
            "Iowa": ["Des Moines", "Cedar Rapids", "Davenport", "Sioux City", "Waterloo", "Ames",
                "West Des Moines", "Council Bluffs", "Ankeny", "Dubuque", "Urbandale",
                "Cedar Falls",
                "Bettendorf", "Mason City", "Mason City", "Marshalltown", "Ottumwa", "Fort Dodge",
                "Clinton", "Muscatine"
            ],
            "Kansas": ["Wichita", "Overland Park", "Kansas City", "Topeka", "Olathe", "Lawrence",
                "Shawnee",
                "Manhattan", "Lenexa", "Salina", "Hutchinson", "Leavenworth", "Garden City",
                "Emporia",
                "Emporia", "Dodge City", "Derby", "Newton", "Great Bend	",
            ],
            "Kentucky": ["Louisville", "Lexington", "Bowling Green", "Owensboro", "Covington",
                "Richmond",
                "Florence", "Georgetown", "Hopkinsville", "Nicholasville", "Elizabethtown",
                "Henderson",
                "Paducah", "Frankfort", "Ashland", "Berea", "Winchester", "Danville",
                "Madisonville",
                "Murray"
            ],
            "Louisiana": ["New Orleans", "Baton Rouge", "Shreveport", "Lafayette", "Lake Charles",
                "Kenner",
                "Bossier City", "Monroe", "Alexandria", "Houma", "Slidell", "Central", "Ruston",
                "Natchitoches", "Opelousas", "Zachary", "Thibodaux", "Gretna", "Morgan City",
                "Hammond",
            ],
            "Maine": ["Portland", "Lewiston", "Bangor", "South Portland", "Auburn", "Biddeford",
                "Sanford",
                "Saco", "Westbrook", "Augusta", "Waterville", "Brunswick", "Scarborough", "Orono",
                "Bath",
                "Presque Isle", "Ellsworth", "York", "Old Town", "Camden"
            ],
            "Maryland": ["Baltimore", "Frederick", "Rockville", "Gaithersburg", "Bowie", "Hagerstown",
                "Annapolis", "Salisbury", "Laurel", "Greenbelt", "Germantown", "Bel Air", "Bel Air",
                "Cumberland", "Takoma Park", "Ellicott City", "Waldorf", "Hyattsville",
                "Mount Airy",
                "Ocean City",
            ],
            "Massachusetts": ["Boston", "Worcester", "Springfield", "Lowell", "Cambridge", "Lowell",
                "Brockton",
                "New Bedford", "Quincy", "Lynn", "Fall River", "Newton", "Somerville", "Framingham",
                "Lawrence", "Medford", "Waltham", "Malden", "Chelsea", "Revere", "Peabody",
                "Pittsfield",
                "Holyoke", "Beverly", "Attleboro",
            ],
            "Michigan": ["Detroit", "Grand Rapids", "Warren", "Sterling Heights", "Lansing", "Flint",
                "Dearborn", "Livonia", "Troy", "Westland", "Farmington Hills", "Kalamazoo",
                "Wyoming",
                "Southfield", "Rochester Hills", "Taylor", "Pontiac", "Novi", "Royal Oak",
                "Saginaw",
                "Muskegon", "Ypsilanti", "Battle Creek", "Portage", "East Lansing", "Traverse City",
                "Jackson", "Midland", "Holland", "Mount Pleasant",
            ],
            "Minnesota": ["Minneapolis", "Saint Paul", "Rochester", "Duluth", "Bloomington",
                "Brooklyn Park",
                "Plymouth", "Maple Grove", "Woodbury", "St. Cloud", "Eagan", "Blaine", "Lakeville",
                "Coon Rapids", "Eden Prairie", "Burnsville", "Apple Valley", "Minnetonka", "Edina",
                "Inver Grove Heights", "Mankato", "Savage", "Shakopee"
            ],
            "Mississippi": ["Jackson", "Gulfport", "Southaven", "Hattiesburg", "Biloxi", "Meridian",
                "Tupelo",
                "Olive Branch", "Greenville", "Horn Lake", "Pearl", "Madison", "Starkville",
                "Clinton",
                "Brandon", "Vicksburg", "Columbus", "Pascagoula", "Laurel", "Ridgeland"
            ],
            "Missouri": ["Kansas City", "Saint Louis", "Springfield", "Independence", "Columbia",
                "Lee's Summit", "O'Fallon", "St. Joseph", "St. Charles", "Blue Springs",
                "Blue Springs",
                "Florissant", "Joplin", "Chesterfield", "Jefferson City", "Wentzville", "Ballwin",
                "Raytown", "Gladstone", "Kirkwood", "Maryville",
            ],
            "Montana": ["Billings", "Missoula", "Great Falls", "Bozeman", "Butte", "Helena",
                "Kalispell",
                "Havre", "Miles City", "Miles City", "Belgrade", "Livingston", "Laurel",
                "Whitefish",
                "Sidney", "Lewistown", "Columbia Falls", "Glendive", "Polson", "Libby", "Deer Lodge"
            ],
            "Nebraska": ["Omaha", "Lincoln", "Bellevue", "Grand Island", "Kearney", "Fremont",
                "Hastings",
                "North Platte", "Norfolk", "Columbus", "Papillion", "La Vista", "Scottsbluff",
                "South Sioux City", "Beatrice", "Lexington", "Alliance", "Gering", "York", "McCook"
            ],
            "Nevada": ["Las Vegas", "Henderson", "Reno", "North Las Vegas", "Sparks", "Carson City",
                "Elko",
                "Mesquite", "Boulder City", "Fernley", "Pahrump", "Fallon", "Winnemucca", "Ely",
                "Incline Village", "Laughlin", "Yerington", "Battle Mountain", "Tonopah", "Caliente"
            ],
            "New Hampshire": ["Manchester", "Nashua", "Concord", "Derry", "Rochester", "Keene",
                "Portsmouth",
                "Laconia", "Lebanon", "Claremont", "Somersworth", "Berlin", "Hanover",
                "Exeter", "Milford", "Franklin", "Raymond", "Goffstown", "Plymouth"
            ],
            "New Jersey": ["Newark", "Jersey City", "Paterson", "Elizabeth", "Edison", "Woodbridge",
                "Lakewood",
                "Toms River", "Hamilton", "Trenton", "Clifton", "Camden", "Brick", "Cherry Hill",
                "Passaic",
                "Union City", "Bayonne", "East Orange", "Hackensack", "Atlantic City"
            ],
            "New Mexico": ["Albuquerque", "Las Cruces", "Rio Rancho", "Santa Fe", "Roswell",
                "Farmington",
                "Clovis", "Hobbs", "Alamogordo", "Carlsbad", "Gallup", "Los Lunas", "Deming",
                "Grants",
                "Artesia", "Silver City", "Lovington", "Ruidoso", "Socorro", "Espanola"
            ],
            "New York": ["New York City", "Buffalo", "Rochester", "Yonkers", "Syracuse", "Albany",
                "New Rochelle", "Mount Vernon", "Schenectady", "Utica", "White Plains", "Troy",
                "Binghamton", "Ithaca", "Niagara Falls", "Poughkeepsie", "Jamestown", "Rome",
                "Elmira",
                "Kingston", "Saratoga Springs", "Beacon", "Middletown", "Glens Falls"
            ],
            "North Carolina": ["Charlotte", "Raleigh", "Greensboro", "Durham", "Winston-Salem", "Cary",
                "High Point", "Greenville", "Asheville", "Concord", "Gastonia", "Jacksonville",
                "Jacksonville", "Chapel Hill", "Rocky Mount", "Huntersville", "Apex", "Burlington",
                "Kannapolis"
            ],
            "North Dakota": ["Fargo", "Bismarck", "Grand Forks", "Minot", "West Fargo", "Williston",
                "Dickinson", "Mandan", "Jamestown", "Wahpeton", "Devils Lake", "Valley City",
                "Grafton",
                "Bottineau", "Beulah", "Rugby", "Horace", "Lincoln", "Carrington", "Stanley"
            ],
            "Ohio": ["Columbus", "Cleveland", "Cincinnati", "Toledo", "Akron", "Dayton", "Canton",
                "Youngstown",
                "Lorain", "Parma", "Hamilton", "Kettering", "Elyria", "Lakewood", "Cuyahoga Falls",
                "Mansfield", "Dublin", "Beavercreek", "Delaware", "Marion",
            ],
            "Oklahoma": ["Oklahoma City", "Tulsa", "Norman", "Broken Arrow", "Lawton", "Edmond",
                "Moore",
                "Midwest City", "Enid", "Stillwater", "Muskogee", "Bartlesville", "Shawnee",
                "Owasso",
                "Ponca City", "Ardmore", "Duncan", "Sapulpa", "Bixby", "Bixby",
            ],
            "Oregon": ["Portland", "Eugene", "Salem", "Gresham", "Hillsboro", "Beaverton", "Bend",
                "Medford",
                "Springfield", "Corvallis", "Albany", "Tigard", "Lake Oswego", "Keizer",
                "Grants Pass",
                "Oregon City", "Redmond", "Milwaukie", "Tualatin", "Newberg",
            ],
            "Pennsylvania": ["Philadelphia", "Pittsburgh", "Allentown", "Erie", "Reading", "Scranton",
                "Bethlehem", "Lancaster", "Harrisburg", "York", "State College", "Wilkes-Barre",
                "Altoona",
                "Chester", "Johnstown", "Johnstown", "Easton", "Lebanon", "Hazleton",
                "Williamsport",
                "New Castle",
            ],
            "Rhode Island": ["Providence", "Warwick", "Cranston", "Pawtucket", "East Providence",
                "Woonsocket",
                "Newport", "Central Falls", "Westerly", "North Providence", "Coventry", "Johnston",
                "Lincoln", "Barrington", "Smithfield", "Smithfield", "Narragansett", "Bristol",
                "South Kingstown", "North Kingstown",
            ],
            "South Carolina": ["Charleston", "Columbia", "North Charleston", "Mount Pleasant",
                "Rock Hill",
                "Greenville", "Summerville", "Sumter", "Florence", "Spartanburg", "Goose Creek",
                "Hilton Head Island", "Hilton Head Island", "Myrtle Beach", "Anderson", "Greer",
                "Aiken",
                "Easley", "Conway", "West Columbia", "Mauldin"
            ],
            "South Dakota": ["Sioux Falls", "Rapid City", "Aberdeen", "Brookings", "Watertown",
                "Mitchell",
                "Yankton", "Pierre", "Huron", "Vermillion", "Spearfish", "Box Elder", "Brandon",
                "Sturgis",
                "Madison", "Belle Fourche", "Tea", "Canton", "Hot Springs", "Dell Rapids"
            ],
            "Tennessee": ["Nashville", "Memphis", "Knoxville", "Chattanooga", "Clarksville",
                "Murfreesboro",
                "Franklin", "Johnson City", "Jackson", "Bartlett", "Hendersonville", "Kingsport",
                "Collierville", "Smyrna", "Cleveland", "Brentwood", "Cookeville", "Gallatin",
                "La Vergne",
                "Germantown", "Oak Ridge", "Spring Hill", "Columbia", "Tullahoma", "Morristown"
            ],
            "Texas": ["Houston", "Dallas", "San Antonio", "Austin", "Fort Worth", "El Paso",
                "Arlington",
                "Corpus Christi", "Plano", "Lubbock", "Laredo", "Irving", "Garland", "Frisco",
                "McKinney",
                "Amarillo", "Grand Prairie", "Brownsville", "Killeen", "Pasadena", "Mesquite",
                "Midland",
                "Waco", "Carrollton", "Denton", "Beaumont", "Odessa", "Round Rock", "Abilene",
                "College Station"
            ],
            "Utah": ["Salt Lake City", "West Valley City", "Provo", "West Jordan", "Orem", "Sandy",
                "Ogden",
                "St. George", "Layton", "Taylorsville", "South Jordan", "Lehi", "Logan", "Murray",
                "Draper",
                "Bountiful", "Herriman", "Tooele", "Cedar City", "Spanish Fork"
            ],
            "Vermont": ["Burlington", "Essex", "South Burlington", "Colchester", "Rutland", "Barre",
                "Montpelier", "St. Albans", "Winooski", "Brattleboro", "Bennington", "Middlebury",
                "Newport", "St. Johnsbury", "Springfield", "Springfield", "Vergennes", "Hartford",
                "Milton",
                "Shelburne"
            ],
            "Virginia": ["Virginia Beach", "Norfolk", "Chesapeake", "Richmond", "Newport News",
                "Alexandria",
                "Hampton", "Roanoke",
                "Portsmouth", "Suffolk",
                "Lynchburg", "Harrisonburg", "Charlottesville", "Danville", "Blacksburg",
                "Manassas",
                "Petersburg", "Winchester", "Leesburg", "Fairfax", "Falls Church", "Waynesboro",
                "Martinsville", "Colonial Heights"
            ],
            "Washington": ["Seattle", "Spokane", "Tacoma", "Vancouver", "Bellevue", "Everett", "Kent",
                "Yakima",
                "Yakima", "Renton", "Spokane Valley", "Federal Way", "Bellingham", "Kennewick",
                "Auburn",
                "Pasco", "Richland", "Marysville", "Lakewood", "Redmond", "Shoreline", "Lacey",
                "Olympia",
                "Mount Vernon", "Walla Walla"
            ],
            "West Virginia": ["Charleston", "Huntington", "Parkersburg", "Morgantown", "Wheeling",
                "Weirton",
                "Fairmont", "Beckley", "Martinsburg", "Clarksburg", "Bluefield", "Elkins",
                "Princeton",
                "Bridgeport", "South Charleston",
                "Nitro", "St.Albans", "Ripley", "Lewisburg", "Summersville",
            ],
            "Wisconsin": ["Milwaukee", "Madison", "Green Bay", "Kenosha", "Racine", "Appleton",
                "Waukesha",
                "Oshkosh", "Eau Claire", "Janesville", "West Allis", "La Crosse", "Sheboygan",
                "Wausau",
                "Fond du Lac", "Brookfield", "New Berlin", "Beloit", "Menomonee Falls", "Manitowoc",
                "Superior",
                "Stevens Point", "Franklin", "Mount Pleasant",
            ],
            "Wyoming": ["Cheyenne", "Casper", "Laramie", "Gillette", "Rock Springs", "Sheridan",
                "Green River",
                "Evanston", "Riverton", "Jackson", "Cody", "Rawlins", "Douglas", "Buffalo",
                "Torrington",
                "Worland", "Thermopolis", "Lander", "Newcastle", "Powell"
            ],
        },
        UK: {
            "England": ["London", "Manchester", "Liverpool", "Birmingham", "Leeds", "Sheffield",
                "Bristol",
                "Newcastle", "Nottingham", "Leicester", "Coventry", "Bradford", "Brighton", "Hull",
                "Plymouth", "Southampton", "Portsmouth", "Derby", "Stoke-on-Trent", "Wolverhampton",
                "York",
                "Cambridge", "Oxford", "Bath", "Exeter", "Canterbury", "Lancaster", "Chester",
                "Durham",
                "Sunderland",
            ],
            "Scotland": ["Edinburgh", "Glasgow", "Aberdeen", "Dundee", "Stirling", "Perth", "Ayr",
                "Falkirk",
                "Paisley", "Kirkcaldy", "East Kilbride", "Livingston", "Dumfries", "Motherwell",
                "Cumbernauld", "Greenock", "Arbroath", "Elgin", "Oban"
            ],
            "Wales": ["Cardiff", "Swansea", "Newport", "Wrexham", "Barry", "Caerphilly", "Bangor",
                "St Davids",
                "Aberystwyth", "Llandudno", "Caernarfon", "Conwy", "Rhyl", "Colwyn Bay",
                "Merthyr Tydfil",
                "Pontypridd", "Carmarthen", "Llanelli", "Neath", "Bridgend", "Holyhead",
                "Haverfordwest",
            ],
            "Northern Ireland": ["Belfast", "Londonderry", "Lisburn", "Newtownabbey", "Bangor",
                "Craigavon",
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
                "Palm Jumeirah", "Jumeirah Beach Residence (JBR)", "Business Bay", "Al Barsha",
                "Al Quoz",
                "Dubai Silicon Oasis", "Dubai Investment Park", "Mirdif",
                "Dubai International City",
                "Arabian Ranches", "The Springs", "The Meadows", "Jumeirah Village Circle (JVC)",
                "Jumeirah Lakes Towers (JLT)", "Al Nahda", "Satwa", "Umm Suqeim", "Al Safa",
                "Al Rashidiya",
            ],
            "Sharjah": ["Sharjah City", "Khorfakkan", "Kalba", "Dibba Al-Hisn", "Al Dhaid", "Al Madam",
                "Al Bataeh", "Mleiha", "Hamriyah", "Al Nahda, Sharjah", "Muwaileh", "Al Qasimia ",
                "Al Majaz ",
                "Al Khan",
                "Al Taawun", "Al Layyah"
            ],
            "Ajman": ["Ajman City", "Manama", "Masfout", "Al Jurf", "Al Nuaimiya", "Al Rashidiya",
                "Al Mowaihat", "Ajman Industrial Area", "Helio", "Al Hamidiya", "Ajman Free Zone",
            ],
            "Ras Al Khaimah": ["Ras Al Khaimah City", "Rams", "Dhayah", "Al Jazirah Al Hamra", "Khatt",
                "Masafi", "Al Ghail", "Digdaga", "Al Hamra Village", "Julphar", "Sha'am",
                "Al Qusaidat",
                "Al Dhait", "Mina Al Arab", "Al Uraibi", "Ghalilah"
            ],
            "Fujairah": ["Fujairah City", "Dibba", "Qidfa", "Mirbah", "Masafi", "Al Bidiyah",
                "Al Faqeet",
                "Gurfah", "Sakamkam", "Al Hala", "Rughaylat", "Al Aqah", "Thuban"
            ],
            "Umm Al Quwain": ["Umm Al Quwain City", "Falaj Al Mualla", "Al Rafaah", "Al Salamah",
                "Al Haditha",
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
                "Buangkok", "Kovan", "Lorong Chuan", "Compassvale", "Anchorvale", "Rivervale",
                "Fernvale",
                "Punggol East", "Punggol North", "Punggol West", "Hougang Central", "Kangkar",
                "Defu",
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
            "Shanghai": ["Huangpu", "Xuhui", "Changning", "Jing'an", "Putuo", "Hongkou",
                "Yangpu District",
                "Minhang District", "Baoshan District", "Pudong New Area", "Jiading District",
                "Jinshan District", "Songjiang District", "Qingpu District", "Fengxian District",
                "Chongming District"
            ],
            "Guangdong": ["Guangzhou", "Shenzhen", "Dongguan", "Foshan", "Zhongshan", "Zhuhai",
                "Jiangmen",
                "Huizhou", "Zhaoqing", "Shaoguan", "Heyuan", "Meizhou", "Shantou", "Shantou",
                "Jieyang",
                "Maoming", "Yangjiang", "Zhanjiang", "Yunfu", "Qingyuan"
            ],
            "Jiangsu": ["Nanjing", "Suzhou", "Wuxi", "Changzhou", "Nantong", "Xuzhou", "Zhenjiang",
                "Yangzhou",
                "Nantong", "Taizhou", "Yancheng", "Huai'an", "Lianyungang", "Suqian"
            ],
            "Zhejiang": ["Hangzhou", "Ningbo", "Wenzhou", "Jiaxing", "Huzhou", "Shaoxing", "Jinhua",
                "Quzhou",
                "Zhoushan", "Taizhou", "Lishui", "Yiwu", "Yueqing", "Cixi", "Yuyao", "Tongxiang",
                "Haining",
                "Lin'an", "Fuyang", "Wenling", "Luqiao", "Dongyang", "Lanxi", "Longquan", "Rui'an",
                "Pinghu", "Changxing", "Deqing", "Anji", "Sanmen", "Xinchang", "Tiantai", "Xianju",
                "Jingning", "Qingtian", "Wuyi",
            ],
            "Shandong": ["Jinan", "Qingdao", "Zibo", "Zaozhuang", "Dongying", "Yantai", "Dezhou",
                "Dongying",
                "Heze", "Jining", "Liaocheng", "Rizhao", "Taian", "Weifang", "Binzhou", "Zaozhuang",
                "Laixi", "Laizhou", "Penglai", "Qixia"
            ],
            "Henan": ["Zhengzhou", "Kaifeng", "Luoyang", "Pingdingshan", "Anyang", "Hebi", "Xinxiang",
                "Nanyang", "Xinyang", "Shangqiu", "Zhoukou", "Zhumadian", "Sanmenxia", "Hebi",
                "Jiaozuo",
                "Puyang", "Luohe", "Pingdingshan",
            ],
            "Sichuan": ["Chengdu", "Zigong", "Panzhihua", "Luzhou", "Deyang", "Mianyang", "Luzhou",
                "Neijiang",
                "Leshan", "Nanchong", "Yibin", "Guang'an", "Suining", "Meishan", "Ziyang",
                "Bazhong",
                "Dazhou",
                "Ya'an", "Aba Tibetan and Qiang Autonomous Prefecture",
                "Ganzi Tibetan Autonomous Prefecture", "Liangshan Yi Autonomous Prefecture"
            ]
        },
        JP: {
            "Tokyo": ["Shibuya", "Shinjuku", "Harajuku", "Ginza", "Akihabara", "Roppongi", "Adachi",
                "Arakawa",
                "Bunkyō", "Chiyoda", "Chūō", "Edogawa", "Itabashi", "Katsushika", "Kita", "Kōtō",
                "Meguro",
                "Minato", "Nakano", "Nerima", "Ōta", "Setagaya", "Shinagawa", "Suginami", "Sumida",
                "Taitō"
            ],
            "Osaka": ["Osaka City", "Sakai", "Higashiosaka", "Hirakata", "Toyonaka", "Takatsuki",
                "Ibaraki",
                "Suita", "Kadoma", "Moriguchi", "Hirakata", "Yao", "Kishiwada", "Izumi",
                "Izumisano",
                "Kawachinagano", "Tondabayashi", "Daitō", "Kashiwara", "Habikino", "Matsubara",
                "Sennan",
                "Kaizuka", "Shijōnawate"
            ],
            "Kyoto": ["Kyoto City", "Uji", "Kameoka", "Joyo", "Mukō", "Maizuru", "Fukuchiyama",
                "Miyazu",
                "Nagaokakyō", "Yawata", "Kyōtanabe", "Kyōtango", "Muko", "Nantan"
            ],
            "Kanagawa": ["Yokohama", "Kawasaki", "Sagamihara", "Fujisawa", "Chigasaki", "Kamakura",
                "Zushi",
                "Odawara", "Atsugi", "Ebina", "Isehara", "Hadano", "Hadano", "Yamato", "Ayase",
                "Miura",
                "Minamiashigara", "Kōza District"
            ],
            "Aichi": ["Nagoya", "Toyohashi", "Okazaki", "Ichinomiya", "Seto", "Toyota", "Kasugai",
                "Toyokawa",
                "Anjō", "Kariya", "Handa", "Tōkai", "Inazawa", "Komaki", "Inuyama", "Tokoname",
                "Nisshin",
                "Owariasahi", "Konan", "Chita", "Takahama", "Aisai", "Tōgō", "Nagakute",
                "Shinshiro",
                "Agui", "Obu", "Ama",
                "Gamagōri"
            ],
            "Hokkaido": ["Sapporo", "Asahikawa", "Hakodate", "Kushiro", "Tomakomai", "Obihiro", "Otaru",
                "Kitami", "Ebetsu", "Chitose", "Iwamizawa", "Muroran", "Abashiri", "Wakkanai",
                "Nayoro",
                "Biei", "Furano", "Shibetsu", "Rumoi", "Bibai", "Nemuro", "Tōbetsu", "Yubari",
                "Monbetsu"
            ]
        },
        DE: {
            "Bavaria": ["Munich", "Nuremberg", "Augsburg", "Würzburg", "Regensburg", "Ingolstadt",
                "Fürth",
                "Erlangen", "Bamberg", "Bayreuth", "Aschaffenburg", "Landshut", "Amberg", "Kempten",
                "Rosenheim", "Coburg", "Passau", "Schweinfurt", "Weiden in der Oberpfalz",
                "Deggendorf",
                "Freising",
            ],
            "North Rhine-Westphalia": ["Cologne", "Düsseldorf", "Dortmund", "Essen", "Duisburg"],
            "Baden-Württemberg": ["Stuttgart", "Mannheim", "Karlsruhe", "Freiburg", "Heidelberg",
                "Cologne",
                "Düsseldorf", "Dortmund", "Essen", "Duisburg", "Bochum", "Wuppertal", "Bielefeld",
                "Bonn",
                "Münster", "Aachen", "Gelsenkirchen", "Mönchengladbach", "Krefeld", "Leverkusen",
                "Siegen",
                "Paderborn", "Herne", "Hagen", "Remscheid", "Oberhausen", "Recklinghausen",
                "Solingen",
                "Witten", "Lüdenscheid",
            ],
            "Lower Saxony": ["Hanover", "Braunschweig", "Oldenburg", "Osnabrück", "Wolfsburg",
                "Göttingen",
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
                "Cannes", "Antibes", "Arles", "Grasse", "Fréjus", "Salon-de-Provence",
                "La Seyne-sur-Mer",
                "Hyères", "Menton", "Gap", "Manosque", "Draguignan", "Briançon", "Cavaillon",
                "Digne-les-Bains"
            ],
            "Auvergne-Rhône-Alpes": ["Lyon", "Saint-Étienne", "Grenoble", "Villeurbanne",
                "Clermont-Ferrand",
                "Chambéry", "Annecy", "Valence", "Vienne", "Le Puy-en-Velay", "Thonon-les-Bains",
                "Villeurbanne", "Roanne", "Montluçon", "Aurillac", "Albertville", "Bourg-en-Bresse",
                "Annemasse", "Moulins", "Oyonnax", "Issoire",
            ],
            "Nouvelle-Aquitaine": ["Bordeaux", "Limoges", "Poitiers", "Pau", "La Rochelle", "Angoulême",
                "Périgueux", "Bayonne", "Biarritz", "Brive-la-Gaillarde", "Bergerac", "Saintes",
                "Niort",
                "Marmande", "Rochefort", "Guéret", "Arcachon", "Cognac", "Oloron-Sainte-Marie",
                "Libourne"
            ],
            "Occitanie": ["Toulouse", "Montpellier", "Nîmes", "Perpignan", "Béziers", "Carcassonne",
                "Albi",
                "Tarbes", "Rodez", "Mende", "Castres", "Sète", "Colomiers", "Blagnac", "AgdeAgde",
                "Narbonne", "Foix", "Lourdes", "Auch", "Millau"
            ],
            "Hauts-de-France": ["Lille", "Amiens", "Tourcoing", "Roubaix", "Dunkirk", "Calais",
                "Dunkerque (Dunkirk)", "Roubaix", "Tourcoing", "Arras", "Boulogne-sur-Mer",
                "Saint-Quentin",
                "Lens", "Beauvais", "Compiègne", "Cambrai", "Maubeuge", "Soissons", "Creil",
                "Abbeville",
                "Laon", "Montreuil-sur-Mer", "Douai"
            ],
        },
        AU: {
            "New South Wales": ["Sydney", "Newcastle", "Wollongong", "Maitland", "Albury",
                "Wagga Wagga",
                "Wagga Wagga", "Coffs Harbour", "Tamworth", "Port Macquarie", "Dubbo", "Orange",
                "Bathurst",
                "Lismore", "Goulburn", "Nowra", "Armidale", "Griffith", "Tweed Heads",
                "Tweed Heads",
                "Broken Hill", "Queanbeyan"
            ],
            "Victoria": ["Melbourne", "Geelong", "Ballarat", "Bendigo", "Shepparton", "Mildura",
                "Warrnambool",
                "Traralgon", "Wodonga", "Wangaratta", "Sale", "Bairnsdale", "Moe", "Morwell",
                "Horsham",
                "Colac", "Leongatha", "Portland", "Maryboroug", "Benalla"
            ],
            "Queensland": ["Brisbane", "Gold Coast", "Townsville", "Cairns", "Toowoomba", "Mackay",
                "Rockhampton", "Bundaberg", "Hervey Bay", "Gladstone", "Mount Isa", "Roma",
                "Emerald",
                "Maryborough", "Gympie", "Warwick", "Goondiwindi", "Innisfail", "Charters Towers"
            ],
            "Western Australia": ["Perth", "Fremantle", "Rockingham", "Mandurah", "Bunbury", "Albany",
                "Kalgoorlie", "Broome", "Geraldton", "Esperance", "Karratha", "Port Hedland",
                "Busselton",
                "Margaret River", "Exmouth", "Carnarvon", "Derby", "Kununurra", "Northam",
                "Dunsborough",
                "Collie"
            ],
            "South Australia": ["Adelaide", "Mount Gambier", "Whyalla", "Murray Bridge", "Port Lincoln",
                "Port Pirie", "Gawler", "Murray Bridge", "Victor Harbor", "Port Lincoln",
                "Port Elliot",
                "Roxby Downs", "Coober Pedy", "Clare", "Naracoorte", "Berri", "Loxton", "Kadina",
                "Wallaroo", "Tanunda", "Renmark"
            ],
            "Tasmania": ["Hobart", "Launceston", "Devonport", "Burnie", "Ulverstone", "Glenorchy",
                "Kingston",
                "New Norfolk", "Huonville", "George Town", "Sorell", "Wynyard", "Smithton",
                "Scottsdale",
                "Queenstown", "Zeehan", "Deloraine", "St Helens", "Bicheno", "Orford"
            ],
            "Australian Capital Territory": ["Canberra", "Queanbeyan", "Gungahlin", "Tuggeranong",
                "Belconnen",
                "Woden Valley", "Weston Creek", "Molonglo Valley", "Inner North", "Inner South",
                "Hall",
                "Tharwa", "Majura", "Pialligo", "Fyshwick", "Greenway", "Calwell", "Kaleen",
                "Ngunnawal",
                "Charnwood"
            ],
            "Northern Territory": ["Darwin", "Alice Springs", "Palmerston", "Katherine", "Nhulunbuy",
                "Yulara",
                "Jabiru", "Batchelor", "Howard Springs", "Humpty Doo", "Wadeye", "Maningrida",
                "Gunbalanya",
                "Galiwin'ku", "Nauiyu", "Borroloola", "Timber Creek", "Barunga", "Milingimbi"
            ]
        },
        Brazil: {
            "São Paulo": ["São Paulo", "Guarulhos", "Campinas", "São Bernardo do Campo", "Santo André",
                "Ribeirão Preto", "Sorocaba", "Santo André", "Osasco", "Barueri", "Taubaté",
                "Mogi das Cruzes", "Bauru", "Piracicaba", "Jundiaí", "Franca", "Marília", "Itu",
                "Caraguatatuba", "Ilhabela", "Praia Grande", "São Vicente", "Suzano",
                "Bragança Paulista"
            ],
            "Rio de Janeiro": ["Rio de Janeiro", "São Gonçalo", "Duque de Caxias", "Nova Iguaçu",
                "Niterói",
                "Petrópolis", "Teresópolis", "Volta Redonda", "Barra Mansa",
                "Campos dos Goytacazes",
                "Macaé", "Cabo Frio", "Angra dos Reis", "Resende", "Itaboraí", "Belford Roxo",
                "Queimados",
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
                "Paulo Afonso", "Paulo Afonso", "Eunápolis", "Simões Filho",
                "Santo Antônio de Jesus",
                "Guanambi", "Jacobina", "Itapetinga", "Irecê", "Valença", "Porto Seguro",
                "Senhor do Bonfim", "Cruz das Almas"
            ],
            "Paraná": ["Curitiba", "Londrina", "Maringá", "Ponta Grossa", "Cascavel",
                "São José dos Pinhais",
                "Foz do Iguaçu", "Colombo", "Guarapuava", "Paranaguá", "Toledo", "Araucária",
                "Campo Largo",
                "Apucarana", "Arapongas", "Cambé", "Rolândia", "Sarandi", "Umuarama", "Palmas",
                "Francisco Beltrão", "Pinhais", "Cianorte"
            ],
            "Rio Grande do Sul": ["Porto Alegre", "Caxias do Sul", "Pelotas", "Canoas", "Santa Maria",
                "Gravataí", "Viamão", "Novo Hamburgo", "São Leopoldo", "Passo Fundo", "Rio Grande",
                "Bagé",
                "Uruguaiana", "Bento Gonçalves", "Santa Cruz do Sul", "Alvorada", "Erechim",
                "Sapucaia do Sul", "Esteio", "Guaíba", "Lajeado", "Ijuí", "Cachoeirinha",
                "Farroupilha",
            ]
        },
        RU: {
            "Moscow": ["Moscow City", "Zelenograd", "Troitsk", "Shcherbinka", "Tverskoy District",
                "Arbat District", "Zamoskvorechye District", "Khamovniki District",
                "Presnensky District",
                "Basmanny District", "Yakimanka District", "Tagansky District", "Krylatskoye",
                "Strogino",
                "Fili-Davydkovo", "Butovo District", "Zelenograd",
                "Novokosino", "Kuzminki",
            ],
            "Saint Petersburg": ["Saint Petersburg City", "Kronstadt", "Kolpino", "Pushkin",
                "Admiralteysky District", "Central District", "Vasileostrovsky District",
                "Vasileostrovsky District", "Petrogradsky District", "Moskovsky District",
                "Nevsky District", "Frunzensky District", "Kirovsky District",
                "Krasnogvardeysky District",
                "Kalininsky District", "Primorsky District", "Krasnoselsky District",
                "Pushkinsky District",
                "Petrodvortsovy District", "Kolpinsky District", "Kronshtadtsky District",
                "Vsevolozhsk (adjacent city)",
            ],
            "Moscow Oblast": ["Balashikha", "Khimki", "Podolsk", "Mytishchi", "Korolev", "Lyubertsy",
                "Reutov",
                "Zheleznodorozhny", "Elektrostal", "Domodedovo", "Odintsovo", "Serpukhov",
                "Noginsk",
                "Pushkino", "Shchyolkovo", "Zhukovsky", "Lobnya", "Dolgoprudny", "Ivanteyevka",
                "Krasnogorsk", "Chekhov", "Klin", "Voskresensk", "Dubna",
            ],
            "Krasnodar Krai": ["Krasnodar", "Sochi", "Novorossiysk", "Armavir", "Yeisk", "Anapa",
                "Gelendzhik",
                "Slavyansk-na-Kubani", "Tikhoretsk", "Kropotkin", "Labinsk", "Tuapse",
                "Belorechensk",
                "Kurganinsk", "Temryuk", "Goryachy Klyuch", "Apsheronsk", "Bryukhovetskaya",
                "Kanevskaya"
            ],
            "Sverdlovsk Oblast": ["Yekaterinburg", "Nizhny Tagil", "Kamensk-Uralsky", "Pervouralsk",
                "Serov",
                "Asbest", "Revda", "Polevskoy", "Severouralsk", "Krasnoturyinsk", "Alapayevsk",
                "Nevyansk",
                "Verkhnyaya Pyshma", "Bogdanovich", "Turinsk", "Artyomovsky", "Verkhny Tagil",
                "Irbit"
            ],
            "Tatarstan": ["Kazan", "Naberezhnye Chelny", "Nizhnekamsk", "Almetyevsk", "Zelenodolsk",
                "Bugulma",
                "Chistopol", "Leninogorsk", "Yelabuga", "Aznakayevo", "Arsk", "Bavly",
                "Mendeleyevsk",
                "Mamadysh", "Kukmor", "Laishevo"
            ]
        },
        IT: {
            "Lazio": ["Rome", "Latina", "Frosinone", "Rieti", "Viterbo", "Civitavecchia", "Anzio",
                "Nettuno",
                "Tivoli", "Pomezia", "Cassino", "Terracina", "Gaeta", "Formia", "Albano Laziale",
                "Frascati", "Velletri", "Cisterna di Latina"
            ],
            "Lombardy": ["Milan", "Bergamo", "Brescia", "Como", "Cremona", "Pavia", "Monza", "Varese",
                "Cremona", "Lodi", "Lecco", "Mantua (Mantova)", "Sondrio", "Desio", "Legnano",
                "Rho",
                "Gallarate", "Busto Arsizio", "Abbiategrasso", "Cernusco sul Naviglio"
            ],
            "Campania": ["Naples", "Salerno", "Giugliano in Campania", "Torre del Greco", "Pozzuoli",
                "Caserta",
                "Avellino", "Benevento", "Pompeii", "Herculaneum (Ercolano)", "Torre del Greco",
                "Torre Annunziata", "Pozzuoli", "Nocera Inferiore", "Scafati", "Pagani",
                "Battipaglia",
                "Acerra", "Afragola", "Portici", "Giugliano in Campania", "Marano di Napoli",
                "Ischia",
                "Procida", "Capri"
            ],
            "Sicily": ["Palermo", "Catania", "Messina", "Syracuse", "Marsala", "Trapani", "Agrigento",
                "Enna",
                "Ragusa", "Modica", "Noto", "Marsala", "Gela", "Caltanissetta", "Acireale", "Avola",
                "Piazza Armerina", "Licata", "Sciacca", "Milazzo", "Taormina", "Erice", "Cefalù"
            ],
            "Veneto": ["Venice", "Verona", "Padua", "Vicenza", "Treviso", "Belluno", "Rovigo",
                "Chioggia",
                "Mestre", "Marghera", "Castelfranco Veneto", "Conegliano", "Feltre",
                "Bassano del Grappa",
                "Este", "Cittadella", "Portogruaro", "San Donà di Piave", "Adria", "Montebelluna",
                "Schio",
            ],
            "Piedmont": ["Turin", "Novara", "Alessandria", "Asti", "Cuneo", "Novara", "Verbania",
                "Vercelli",
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
            "Catalonia": ["Barcelona", "Hospitalet de Llobregat", "Terrassa", "Badalona", "Sabadell",
                "Reus",
                "Girona", "Manresa", "Manresa", "Sabadell", "Mataró", "Granollers",
                "Sant Cugat del Vallès",
                "Castelldefels", "Cornellà de Llobregat", "Vic", "Vilanova i la Geltrú", "Figueres",
                "El Prat de Llobregat", "Blanes", "Roses"
            ],
            "Andalusia": ["Seville", "Málaga", "Córdoba", "Granada", "Almería", "Huelva", "Jaén",
                "Cádiz",
                "Marbella", "Jerez de la Frontera", "Estepona", "Ronda", "Torremolinos",
                "Benalmádena",
                "Nerja", "Motril", "Linares", "Ubeda", "Baeza", "El Puerto de Santa María"
            ],
            "Valencia": ["Valencia", "Alicante", "Elche", "Castellón de la Plana", "Torrevieja",
                "Gandia",
                "Torrent", "Sagunto (Sagunt)", "Paterna", "Alzira", "Ontinyent", "Xàtiva",
                "Cullera",
                "Sueca", "Carcaixent", "Burjassot", "Mislata", "Picassent", "Requena", "Manises",
                "Buñol",
                "Almussafes", "Bétera", "Llíria"
            ],
            "Galicia": ["A Coruña", "Vigo", "Ourense", "Lugo", "Santiago de Compostela", "Pontevedra",
                "Ferrol",
                "Vilagarcía de Arousa", "Ribeira", "Redondela", "Monforte de Lemos", "Carballo",
                "Narón",
                "Cangas", "O Barco de Valdeorras", "Noia", "Burela", "Betanzos", "Tui", "A Estrada"
            ],
            "Basque Country": ["Bilbao", "Vitoria-Gasteiz", "San Sebastián", "Barakaldo", "Getxo",
                "Portugalete", "Irún", "Eibar", "Durango", "Basauri", "Hernani", "Tolosa", "Leioa",
                "Zarautz", "Ondarroa", "Bermeo", "Amorebieta-Etxano", "Gernika-Lumo",
                "Lasarte-Oria",
                "Errenteria",
            ]
        },
        Netherlands: {
            "North Holland": ["Amsterdam", "Haarlem", "Zaanstad", "Haarlemmermeer", "Alkmaar",
                "Hilversum",
                "Hoofddorp", "Purmerend", "Amstelveen", "Hoorn", "Beverwijk", "Heemskerk",
                "IJmuiden",
                "Den Helder", "Enkhuizen", "Weesp", "Landsmeer", "Bloemendaal", "Naarden", "Laren",
                "Volendam", "Edam", "Monnickendam", "Zandvoort",
            ],
            "South Holland": ["The Hague", "Rotterdam", "Leiden", "Zoetermeer", "Dordrecht", "Gouda",
                "Schiedam", "Spijkenisse", "Alphen aan den Rijn", "Vlaardingen", "Katwijk",
                "Noordwijk",
                "Wassenaar", "Naaldwijk", "Maassluis", "Leidschendam", "Voorburg", "Oegstgeest",
                "Rijswijk",
                "Hillegom", "Lisse"
            ],
            "North Brabant": ["Eindhoven", "Tilburg", "Breda", "'s-Hertogenbosch", "Helmond",
                "Roosendaal",
                "Oss", "Veghel", "Uden", "Waalwijk", "Veldhoven", "Boxtel", "Etten-Leur",
                "Bergen op Zoom",
                "Steenbergen", "Gilze en Rijen", "Gilze en Rijen", "Drunen", "Haaren", "Bladel"
            ],
            "Utrecht": ["Utrecht", "Amersfoort", "Nieuwegein", "Veenendaal", "Houten", "Soest", "Baarn",
                "Woerden", "De Bilt", "IJsselstein", "Maarssen", "Leusden", "Bunnik", "Doorn",
                "Driebergen-Rijsenburg", "Wijk bij Duurstede", "Rhenen", "Montfoort", "Lopik"
            ],
            "Gelderland": ["Nijmegen", "Arnhem", "Apeldoorn", "Ede", "Zutphen", "Doetinchem",
                "Harderwijk",
                "Tiel", "Zevenaar", "Winterswijk", "Barneveld", "Culemborg", "Nunspeet",
                "Wageningen",
                "Lochem", "Elburg", "Druten", "Bemmel", "Putten", "Beuningen", "Doesburg", "Hattem"
            ],
            "Overijssel": ["Enschede", "Zwolle", "Deventer", "Almelo", "Hengelo", "Kampen", "Oldenzaal",
                "Steenwijk", "Rijssen", "Hasselt", "Genemuiden", "Ommen", "Haaksbergen", "Dalfsen",
                "Losser", "Borne", "Vriezenveen", "Wierden", "Staphorst", "Nieuwleusen"
            ]
        },
        Switzerland: {
            "Zurich": ["Zurich", "Winterthur", "Uster", "Dübendorf", "Dietikon", "Wetzikon",
                "Wallisellen",
                "Kloten", "Regensdorf", "Opfikon", "Schlieren", "Meilen", "Horgen", "Thalwil",
                "Bülach",
                "Volketswil", "Affoltern am Albis", "Adliswil", "Richterswil", "Erlenbach"
            ],
            "Bern": ["Bern", "Biel/Bienne", "Thun", "Köniz", "Burgdorf", "Spiez", "Interlaken", "Worb",
                "Zollikofen", "Köniz", "Münsingen", "Ostermundigen", "Lyss", "Moutier",
                "La Neuveville",
                "Brienz", "Meiringen", "Grindelwald", "Adelboden", "Gstaad"
            ],
            "Vaud": ["Lausanne", "Yverdon-les-Bains", "Montreux", "Renens", "Nyon", "Vevey", "Pully",
                "Ecublens", "Morges", "Aigle", "Rolle", "Échallens", "Prilly", "Crissier", "Gland",
                "Le Mont-sur-Lausanne", "Orbe", "Cossonay", "Saint-Prex", "Chavannes-près-Renens"
            ],
            "Geneva": ["Geneva", "Vernier", "Lancy", "Meyrin", "Carouge", "Onex", "Thônex",
                "Chêne-Bougeries",
                "Le Grand-Saconnex", "Cologny", "Versoix", "Plan-les-Ouates", "Pregny-Chambésy",
                "Satigny",
                "Confignon", "Bernex", "Troinex", "Veyrier"
            ],
            "Basel-Stadt": ["Basel", "Riehen", "Bettingen", "Altstadt Grossbasel", "St. Alban",
                "Gundeldingen",
                "Iselin", "St. Johann", "Clara", "Matthäus", "Wettstein", "Bachletten",
                "Hirzbrunnen",
                "Breite", "Klybeck", "Rosental", "Am Ring",
            ],
            "Aargau": ["Aarau", "Baden", "Wettingen", "Wohlen", "Rheinfelden", "Brugg", "Zofingen",
                "Lenzburg",
                "Oftringen", "Kaiseraugst", "Spreitenbach", "Mellingen", "Reinach (AG)",
                "Buchs (AG)",
                "Suhr", "Seon", "Rupperswil", "Leibstadt", "Birr",
            ]
        },
        Sweden: {
            "Stockholm": ["Stockholm", "Södermalm", "Östermalm", "Norrmalm", "Vasastan", "Solna",
                "Sundbyberg",
                "Nacka", "Täby", "Danderyd", "Lidingö", "Lidingö", "Botkyrka", "Södertälje",
                "Järfälla",
                "Värmdö", "Tyresö", "Upplands Väsby", "Ekerö", "Salem", "Sigtuna", "Sollentuna"
            ],
            "Västra Götaland": ["Gothenburg", "Borås", "Trollhättan", "Uddevalla", "Skövde",
                "Falköping",
                "Lidköping", "Alingsås", "Mariestad", "Vänersborg", "Kungälv", "Lerum", "Mölndal",
                "Partille", "Åmål", "Strömstad", "Lysekil", "Tjörn", "Orust", "Mark",
            ],
            "Skåne": ["Malmö", "Helsingborg", "Lund", "Kristianstad", "Landskrona", "Trelleborg",
                "Ängelholm",
                "Ystad", "Eslöv", "Hässleholm", "Hässleholm", "Simrishamn", "Landskrona", "Höganäs",
                "Svedala", "Skurup", "Tomelilla", "Båstad", "Kävlinge", "Staffanstorp", "Burlöv",
            ],
            "Uppsala": ["Uppsala", "Enköping", "Håbo", "Knivsta", "Tierp", "Heby", "Heby", "Öregrund",
                "Alunda",
                "Storvreta", "Bälinge", "Gimo", "Älvkarleby", "Gränby", "Luthagen", "Sunnersta",
                "Vänge",
                "Jälla", "Ramstalund", "Gunsta", "Danmark", "Björklinge", "Lövstalöt", "Vattholma",
                "Skyttorp",
            ],
            "Östergötland": ["Linköping", "Norrköping", "Motala", "Mjölby", "Finspång", "Söderköping",
                "Vadstena", "Åtvidaberg", "Kisa", "Boxholm", "Valdemarsvik", "Ödeshög", "Borghamn",
                "Rejmyre", "Gusum", "Kimstad", "Skärblacka", "Vikbolandet", "Hovetorp", "Linghem",
                "Malmslätt", "Östra Ryd", "Horn", "Brokind", "Tjällmo", "Grebo", "Östra Husby"
            ],
            "Värmland": ["Karlstad", "Arvika", "Kristinehamn", "Filipstad", "Hagfors", "Säffle",
                "Torsby",
                "Sunne", "Grums", "Munkfors", "Forshaga", "Kil", "Årjäng", "Storfors", "Ekshärad",
                "Sysslebäck", "Brunskog", "Skoghall", "Deje", "Charlottenberg", "Lesjöfors",
                "Molkom",
                "Edane", "Åmotfors", "Vålberg", "Bäckalund", "Ransäter", "Norra Råda"
            ]
        },
        Norway: {
            "Oslo": ["Oslo", "Bærum", "Asker", "Lørenskog", "Oppegård", "Sentrum", "Grünerløkka",
                "Majorstuen",
                "Frogner", "St. Hanshaugen", "Gamle Oslo", "Sagene", "Bjerke", "Nordre Aker",
                "Østensjø",
                "Grorud", "Stovner", "Alna", "Ullern", "Vestre Aker", "Søndre Nordstrand"
            ],
            "Hordaland": ["Bergen", "Askøy", "Øygarden", "Os", "Sund", "Fana", "Knarrevik", "Straume",
                "Voss",
                "Stord", "Odda", "Norheimsund", "Leirvik", "Bømlo", "Knarvik", "Eidfjord", "Ulvik",
                "Etne",
                "Rosendal", "Ålvik", "Jondal", "Tysnes", "Uskedalen", "Røldal", "Fitjar",
                "Masfjorden",
                "Øystese", "Granvin", "Kinsarvik", "Lindås", "Meland", "Fusa",
            ],
            "Rogaland": ["Stavanger", "Sandnes", "Haugesund", "Strand", "Randaberg", "Egersund",
                "Bryne",
                "Sauda", "Jørpeland", "Åkrehamn", "Kopervik", "Skudeneshavn", "Vikeså", "Varhaug",
                "Sokndal", "Sola", "Randaberg", "Tananger", "Hommersåk"
            ],
            "Akershus": ["Lillestrøm", "Rælingen", "Lørenskog", "Nittedal", "Gjerdrum", "Bærum",
                "Asker", "Ski",
                "Jessheim", "Ås", "Nesoddtangen", "Frogn (Drøbak)", "Enebakk", "Lørenskog",
                "Nittedal",
                "Gjerdrum", "Oppegård (Kolbotn)", "Sørumsand", "Kløfta", "Vestby",
            ],
            "Trøndelag": ["Trondheim", "Steinkjer", "Levanger", "Namsos", "Verdal", "Stjørdal",
                "Orkanger",
                "Røros", "Melhus", "Oppdal", "Malvik", "Selbu", "Brekstad", "Snåsa", "Tydal",
                "Åfjord",
                "Inderøy", "Meråker", "Leka", "Namsskogan", "Høylandet", "Flatanger", "Grong",
                "Rindal",
                "Frosta", "Lundamo", "Ålen",
                "Hitra", "Frøya", "Bjugn", "Rennebu", "Skaun", "Midtre Gauldal", "Osen",
            ],
            "Nordland": ["Bodø", "Narvik", "Mo i Rana", "Fauske", "Rana", "Mosjøen", "Sandnessjøen",
                "Sortland",
                "Svolvær", "Leknes", "Fauske", "Brønnøysund", "Rognan", "Ballangen", "Stokmarknes",
                "Andenes", "Melbu", "Hamarøy", "Ørnes", "Inndyr", "Lødingen", "Henningsvær",
                "Reine",
                "Å i Lofoten", "Kabelvåg", "Alstahaug", "Bø i Vesterålen", "Myre", "Vestvågøy",
                "Hadsel",
                "Tysfjord", "Gildeskål", "Meløy", "Røst", "Værøy", "Moskenes", "Træna", "Vega",
                "Vevelstad",
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
            "Central Jutland": ["Aarhus", "Randers", "Horsens", "Vejle", "Silkeborg", "Herning",
                "Viborg",
                "Skanderborg", "Holstebro", "Ikast", "Ringkøbing", "Struer", "Grenaa", "Hedensted",
                "Lemvig", "Ebeltoft", "Skive", "Brande", "Odder", "Samsø", "Hammel", "Bjerringbro",
                "Hadsten", "Give", "Hinnerup", "Tarm"
            ],
            "Southern Denmark": ["Odense", "Esbjerg", "Kolding", "Vejle", "Fredericia", "Svendborg",
                "Nyborg",
                "Middelfart", "Aabenraa", "Haderslev", "Faaborg", "Assens", "Ringe", "Nordborg",
                "Tønder",
                "Grindsted", "Rødekro", "Otterup", "Bogense", "Vamdrup", "Brørup", "Løgumkloster",
                "Ejby",
                "Guderup"
            ],
            "Zealand": ["Roskilde", "Næstved", "Holbæk", "Køge", "Slagelse", "Ringsted", "Kalundborg",
                "Sorø",
                "Vordingborg", "Haslev", "Skælskør", "Helsinge", "Faxe", "Nakskov", "Maribo",
                "Nykøbing Falster", "Slangerup", "Stege", "Store Heddinge", "Tølløse", "Præstø",
                "Høng", "Stenlille",
            ],
            "North Jutland": ["Aalborg", "Hjørring", "Frederikshavn", "Thisted", "Skagen",
                "Brønderslev",
                "Hobro", "Nørresundby", "Sæby", "Løgstør", "Farsø", "Støvring", "Sindal", "Aars",
                "Brovst",
                "Pandrup", "Hirtshals", "Tårs", "Nibe", "Østervrå", "Aabybro", "Vodskov",
            ]
        },
        Finland: {
            "Uusimaa": ["Helsinki", "Espoo", "Vantaa", "Kauniainen", "Kerava", "Porvoo", "Lohja",
                "Hyvinkää",
                "Järvenpää", "Kerava", "Tuusula", "Nurmijärvi", "Vihti", "Sipoo", "Karkkila",
                "Askola",
                "Mäntsälä", "Pornainen", "Lapinjärvi", "Pukkila", "Myrskylä"
            ],
            "Pirkanmaa": ["Tampere", "Nokia", "Ylöjärvi", "Orivesi", "Lempäälä", "Pirkkala",
                "Valkeakoski",
                "Akaa", "Ikaalinen", "Mänttä-Vilppula", "Ruovesi", "Pälkäne", "Juupajoki",
                "Vesilahti",
                "Parkano", "Kihniö", "Sastamala"
            ],
            "Southwest Finland": ["Turku", "Kaarina", "Raisio", "Naantali", "Mynämäki", "Salo",
                "Parainen (Pargas)", "Uusikaupunki", "Loimaa", "Paimio", "Kemiönsaari", "Mynämäki",
                "Somero", "Laitila", "Vehmaa", "Masku", "Nousiainen", "Taivassalo", "Askainen",
                "Sauvo",
                "Aura", "Oripää", "Pöytyä", "Koski Tl", "Tarvasjoki"
            ],
            "Northern Ostrobothnia": ["Oulu", "Raahe", "Ylivieska", "Oulainen", "Haapajärvi", "Nivala",
                "Kuusamo", "Pudasjärvi", "Muhos", "Kempele", "Liminka", "Siikalatva", "Haapavesi",
                "Pyhäjärvi", "Taivalkoski", "Tyrnävä", "Lumijoki", "Ii", "Vaala", "Utajärvi",
                "Merijärvi",
                "Reisjärvi", "Oulainen"
            ],
            "Kymenlaakso": ["Kotka", "Kouvola", "Hamina", "Anjalankoski", "Kuusankoski", "Pyhtää",
                "Miehikkälä",
                "Virolahti", "Inkeroisten", "Kuusankoski", "Elimäki", "Anjala", "Jaalan kirkonkylä",
                "Keltakangas", "Huruksela", "Langinkoski", "Karhula", "Sutelankylä", "Sippola",
                "Tommola",
                "Myllykoski", "Koria", "Ahvionkoski"
            ],
            "Central Finland": ["Jyväskylä", "Äänekoski", "Suolahti", "Jämsä", "Keuruu", "Saarijärvi",
                "Laukaa",
                "Hankasalmi", "Toivakka", "Uurainen", "Multia", "Petäjävesi", "Kannonkoski",
                "Kinnula",
                "Karstula", "Kivijärvi",
                "Kyyjärvi", "Pihtipudas", "Viitasaari", "Muurame", "Luhanka",
            ]
        },
        KR: {
            "Seoul": ["Jung-gu", "Gangnam-gu", "Songpa-gu", "Gangdong-gu", "Mapo-gu", "Jongno-gu",
                "Seocho-gu",
                "Yongsan-gu", "Gwangjin-gu", "Seodaemun-gu", "Dongdaemun-gu", "Nowon-gu",
                "Gangbuk-gu",
                "Dobong-gu", "Jungnang-gu", "Eunpyeong-gu", "Seongbuk-gu", "Gwanak-gu",
                "Dongjak-gu",
                "Yangcheon-gu", "Yeongdeungpo-gu", "Geumcheon-gu", "Guro-gu", "Gangseo-gu",
                "Songpa-gu",
                "Songpa-gu", "Dongjak-gu"
            ],
            "Busan": ["Haeundae-gu", "Busanjin-gu", "Dongnae-gu", "Nam-gu", "Buk-gu", "Suyeong-gu",
                "Yeonje-gu",
                "Sasang-gu", "Seo-gu", "Jung-gu", "Saha-gu", "Geumjeong-gu", "Dong-gu",
                "Gangseo-gu",
                "Yeongdo-gu", "Gijang-gun",
            ],
            "Incheon": ["Yeonsu-gu", "Namdong-gu", "Bupyeong-gu", "Seo-gu", "Jung-gu", "Dong-gu",
                "Michuhol-gu",
                "Michuhol-gu", "Ganghwa-gun", "Bupyeong-gu", "Ongjin-gun", "Ganghwa-gun",
                "Chinatown",
                "Wolmido", "Yeongjongdo", "Songdo", "Central Park", "Bupyeong Underground Market",
                "Incheon Grand Park", "Cheongna City", "Ganghwa Town", "Dolmen Sites", "Manisan",
                "Baengnyeongdo", "Yeonpyeongdo", "Deokjeokdo", "Jakyakdo",
            ],
            "Daegu": ["Suseong-gu", "Dalseo-gu", "Buk-gu", "Dong-gu", "Nam-gu", "Jung-gu",
                "Dalseong-gun",
                "Dongseongno", "Gyesan-dong", "Seomun Market", "Bangchon-dong", "Ansim-dong",
                "Sinam-dong",
                "Naedang-dong", "Gamsam-dong", "Daemyeong-dong", "Anjirang", "Hyeonchungno",
                "Chilgok",
                "Beomeo-dong", "Manchon-dong", "Siji-dong", "Wolbae-dong", "Hwawon-eup",
                "Okpo-myeon",
                "Gachang-myeon",
            ],
            "Daejeon": ["Yuseong-gu", "Seo-gu", "Dong-gu", "Daedeok-gu", "Jung-gu", "Eunhaeng-dong",
                "Dunsan-dong", "Tanbang-dong", "Gwanjeo-dong", "Yuseong Hot Springs", "KAIST",
                "Techno Valley", "Sintanjin", "Yongun-dong", "Hyo-dong", "Sannae-dong",
                "Inhyeon-dong",
                "Boramae-dong", "Seokgyo-dong", "Taepyeong-dong", "Yucheon-dong", "Gwanjeo 1-dong",
                "Gwanjeo 2-dong", "Tanbang 1-dong", "Tanbang 2-dong", "Wolpyeong-dong",
                "Giseong-dong",
                "Oncheon 1-dong", "Oncheon 2-dong", "Bongmyeong-dong", "Noeun-dong",
                "Sincheon-dong",
                "Songchon-dong", "Sintanjin-dong", "Wolmyeong-dong", "Ojeong-dong", "Panam-dong",
            ],
            "Gwangju": ["Buk-gu", "Dong-gu", "Seo-gu", "Nam-gu", "Gwangsan-gu", "Chungjang-dong",
                "Hakdong",
                "Geumnamno", "Naejang-dong", "Chipyeong-dong", "Ssangchon-dong", "Hwajeong-dong",
                "Bongseon-dong", "Yangrim-dong", "Jiwon-dong", "Yongbong-dong", "Unam-dong",
                "Juknang-dong",
                "Ilgok-dong", "Ochi-dong", "Baekun-dong", "Wolsan-dong",
            ]

        }
    };

    //business state & city
    document.addEventListener('DOMContentLoaded', function() {
        const bizCountrySelect = document.getElementById('business_country');
        const bizStateSelect = document.getElementById('business_state');
        const bizCitySelect = document.getElementById('business_city');
        const yCountrySelect = document.getElementById('y_business_country');
        const yStateSelect = document.getElementById('y_business_state');
        const yCitySelect = document.getElementById('y_business_city');
        const API_KEY = 'WmtRc2MzTzhLRnltNGNmSjljT3RqakROckhSOFFQSTZqMXBGbVlNUw==';
        const BASE_URL = 'https://api.countrystatecity.in/v1';

        // Get database values for pre-selection
        const dbCountry = "{{ old('business_country', $enterprent->business_country ?? '') }}";
        const dbState = "{{ old('business_state', $enterprent->business_state ?? '') }}";
        const dbCity = "{{ old('business_city', $enterprent->business_city ?? '') }}";
        const yDbCountry = "{{ old('y_business_country', $enterprent->y_business_country ?? '') }}";
        const yDbState = "{{ old('y_business_state', $enterprent->y_business_state ?? '') }}";
        const yDbCity = "{{ old('y_business_city', $enterprent->y_business_city ?? '') }}";

        console.log('Database Values:', {
            business_country: dbCountry,
            business_state: dbState,
            business_city: dbCity,
            y_business_country: yDbCountry,
            y_business_state: yDbState,
            y_business_city: yDbCity
        });

        // Store mapping for later use
        let countryMapping = {};
        let stateMapping = {};

        async function fetchCountries(selectElement) {
            try {
                const response = await fetch(`${BASE_URL}/countries`, {
                    headers: {
                        'X-CSCAPI-KEY': API_KEY
                    }
                });
                if (!response.ok) throw new Error('Failed to fetch countries');
                const countries = await response.json();
                console.log('Countries API response:', countries);

                selectElement.innerHTML = '<option value="">Select a country</option>';
                countries.forEach(country => {
                    const option = document.createElement('option');
                    option.value = country.iso2;
                    option.textContent = country.name;
                    selectElement.appendChild(option);
                    countryMapping[country.iso2] = country.name;
                });
            } catch (error) {
                console.error('Error fetching countries:', error);
                selectElement.innerHTML = '<option value="">Error loading countries</option>';
            }
        }

        async function populateStates(countryIso2, stateSelect, citySelect, preselectedState = null,
            preselectedCity = null) {
            stateSelect.innerHTML = '<option value="">Select State</option>';
            citySelect.innerHTML = '<option value="">Select City</option>';

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
                    stateSelect.appendChild(option);
                    stateMapping[state.iso2] = state.name;
                });

                if (preselectedState) {
                    console.log('Pre-selecting state:', preselectedState);
                    stateSelect.value = preselectedState;
                    if (stateSelect.value === preselectedState) {
                        console.log('State pre-selected successfully:', preselectedState);
                        await populateCities(countryIso2, preselectedState, citySelect, preselectedCity);
                    } else {
                        console.warn('State not found in dropdown:', preselectedState);
                    }
                }
            } catch (error) {
                console.error('Error fetching states:', error);
                stateSelect.innerHTML = '<option value="">No states available</option>';
            }
        }

        async function populateCities(countryIso2, stateIso2, citySelect, preselectedCity = null) {
            citySelect.innerHTML = '<option value="">Select City</option>';

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

        // Event Listeners for Business Country/State/City
        bizCountrySelect?.addEventListener('change', () => {
            const countryIso2 = bizCountrySelect.value.trim();
            console.log('Business country changed to:', countryIso2);
            populateStates(countryIso2, bizStateSelect, bizCitySelect);
            const countryError = document.getElementById('business_country_error');
            if (countryIso2 && countryError) countryError.classList.add('d-none');
        });

        bizStateSelect?.addEventListener('change', () => {
            const countryIso2 = bizCountrySelect.value.trim();
            const stateIso2 = bizStateSelect.value;
            console.log('Business state changed to:', stateIso2);
            populateCities(countryIso2, stateIso2, bizCitySelect);
        });

        // Event Listeners for Y Business Country/State/City
        yCountrySelect?.addEventListener('change', () => {
            const countryIso2 = yCountrySelect.value.trim();
            console.log('Y Business country changed to:', countryIso2);
            populateStates(countryIso2, yStateSelect, yCitySelect);
            const countryError = document.getElementById('y_business_country_error');
            if (countryIso2 && countryError) countryError.classList.add('d-none');
        });

        yStateSelect?.addEventListener('change', () => {
            const countryIso2 = yCountrySelect.value.trim();
            const stateIso2 = yStateSelect.value;
            console.log('Y Business state changed to:', stateIso2);
            populateCities(countryIso2, stateIso2, yCitySelect);
        });

        // Initialize form
        async function initializeForm() {
            // Initialize Business Country dropdown
            if (bizCountrySelect) {
                await fetchCountries(bizCountrySelect);
                if (dbCountry) {
                    console.log('Pre-selecting business country:', dbCountry);
                    bizCountrySelect.value = dbCountry;
                    if (bizCountrySelect.value === dbCountry) {
                        console.log('Business country pre-selected successfully:', dbCountry);
                        await populateStates(dbCountry, bizStateSelect, bizCitySelect, dbState, dbCity);
                    } else {
                        console.warn('Business country not found in dropdown:', dbCountry);
                        // Fallback: Try to find the country by name
                        const countryOption = Array.from(bizCountrySelect.options).find(
                            option => option.textContent === dbCountry
                        );
                        if (countryOption) {
                            bizCountrySelect.value = countryOption.value;
                            console.log('Fallback: Business country set to:', countryOption.value);
                            await populateStates(countryOption.value, bizStateSelect, bizCitySelect,
                                dbState, dbCity);
                        }
                    }
                }
            }

            // Initialize Y Business Country dropdown
            if (yCountrySelect) {
                await fetchCountries(yCountrySelect);
                if (yDbCountry) {
                    console.log('Pre-selecting Y business country:', yDbCountry);
                    yCountrySelect.value = yDbCountry;
                    if (yCountrySelect.value === yDbCountry) {
                        console.log('Y Business country pre-selected successfully:', yDbCountry);
                        await populateStates(yDbCountry, yStateSelect, yCitySelect, yDbState, yDbCity);
                    } else {
                        console.warn('Y Business country not found in dropdown:', yDbCountry);
                        // Fallback: Try to find the country by name
                        const countryOption = Array.from(yCountrySelect.options).find(
                            option => option.textContent === yDbCountry
                        );
                        if (countryOption) {
                            yCountrySelect.value = countryOption.value;
                            console.log('Fallback: Y Business country set to:', countryOption.value);
                            await populateStates(countryOption.value, yStateSelect, yCitySelect, yDbState,
                                yDbCity);
                        }
                    }
                }
            }
        }

        initializeForm();
    });
    //end if register

    // Event listeners

    //end business state & city

    document.addEventListener('DOMContentLoaded', function() {
        const countrySelect = document.getElementById('country');
        const stateSelect = document.getElementById('state');
        const citySelect = document.getElementById('city');
        const API_KEY = 'WmtRc2MzTzhLRnltNGNmSjljT3RqakROckhSOFFQSTZqMXBGbVlNUw==';
        const BASE_URL = 'https://api.countrystatecity.in/v1';

        // Get database or old values for pre-selection
        const dbCountry = "{{ old('country', $enterprent->country ?? '') }}";
        const dbState = "{{ old('state', $enterprent->state ?? '') }}";
        const dbCity = "{{ old('city', $enterprent->city ?? '') }}";

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
    </script>
    <script>
        // Before submitting the form
        document.querySelectorAll('input[required]').forEach(input => {
            if (input.offsetParent === null) { // hidden input
                input.removeAttribute('required');
            }
        });

        document.querySelectorAll('input[name="register_business"]').forEach((radio) => {
            radio.addEventListener('change', function() {
                const labelText = document.getElementById('funding_label_text');
                if (this.value === '1') {
                    labelText.textContent = 'Fund Required for Current Business';
                } else {
                    labelText.textContent = 'Fund Required for Proposed Business Idea';
                }
            });
        });


        document.addEventListener('DOMContentLoaded', function() {
            const label = document.getElementById('business_name_label');
            const radios = document.querySelectorAll('input[name="register_business"]');

            function updateLabel() {
                const selectedValue = document.querySelector('input[name="register_business"]:checked').value;
                if (selectedValue === '1') {
                    label.textContent = 'Business Name *';
                } else {
                    label.textContent = 'Business Idea Name *';
                }
            }
            // Initial update
            updateLabel();

            // Listen for change
            radios.forEach(radio => {
                radio.addEventListener('change', updateLabel);
            });
        });
    </script>
    <script>
        document.addEventListener('DOMContentLoaded', function() {
            const investmentField = document.querySelector('input[name="market_capital"]');
            const equityField = document.querySelector('input[name="your_stake"]');
            const valuationField = document.querySelector('input[name="stake_funding"]');

            function calculateValuation() {
                const investment = parseFloat(investmentField.value);
                const equity = parseFloat(equityField.value);

                if (!isNaN(investment) && !isNaN(equity) && equity > 0) {
                    const valuation = (investment / equity) * 100;
                    valuationField.value = valuation.toFixed(2);
                } else {
                    valuationField.value = '';
                }
            }
            investmentField.addEventListener('input', calculateValuation);
            equityField.addEventListener('input', calculateValuation);
        });

        document.addEventListener('DOMContentLoaded', function() {
            const investmentFieldY = document.querySelector('input[name="y_market_capital"]');
            const equityFieldY = document.querySelector('input[name="y_your_stake"]');
            const valuationFieldY = document.querySelector('input[name="y_stake_funding"]');

            function calculateValuationY() {
                const investmentY = parseFloat(investmentFieldY.value);
                const equityY = parseFloat(equityFieldY.value);

                if (!isNaN(investmentY) && !isNaN(equityY) && equityY > 0) {
                    const valuationY = (investmentY / equityY) * 100;
                    valuationFieldY.value = valuationY.toFixed(2);
                } else {
                    valuationFieldY.value = '';
                }
            }

            investmentFieldY.addEventListener('input', calculateValuationY);
            equityFieldY.addEventListener('input', calculateValuationY);
        });

        document.addEventListener('DOMContentLoaded', function() {
            const productPhotosInput = document.getElementById('product_photos');
            const previewContainer = document.getElementById('product_photos_preview');
            let selectedProductFiles = []; // Track all selected files globally
            let isProcessing = false;

            if (productPhotosInput && previewContainer) {
                productPhotosInput.addEventListener('change', handleProductPhotosChange);
            }

            function handleProductPhotosChange(e) {
                if (isProcessing) return;
                isProcessing = true;

                const files = Array.from(e.target.files);
                const errorElement = document.getElementById('product_photos_error');

                // Clear error
                errorElement.classList.add('d-none');

                // Limit to 3 total files
                const remainingSlots = 3 - selectedProductFiles.length;
                if (remainingSlots <= 0) {
                    errorElement.textContent = 'Maximum 3 product photos allowed.';
                    errorElement.classList.remove('d-none');
                    isProcessing = false;
                    e.target.value = ''; // Clear the input to prevent invalid files
                    return;
                }

                let processedCount = 0;
                const totalNewFiles = Math.min(files.length, remainingSlots);

                files.slice(0, remainingSlots).forEach((file, index) => {
                    if (!file.type.startsWith('image/')) {
                        errorElement.textContent = 'Only image files (JPG, PNG, JPEG, GIF) are allowed.';
                        errorElement.classList.remove('d-none');
                        isProcessing = false;
                        e.target.value = '';
                        return;
                    }

                    const maxSize = 5 * 1024 * 1024; // 5MB
                    if (file.size > maxSize) {
                        errorElement.textContent = `Product photo ${index + 1} exceeds 5MB limit.`;
                        errorElement.classList.remove('d-none');
                        isProcessing = false;
                        e.target.value = '';
                        return;
                    }

                    const uniqueId =
                        `product_${Date.now()}_${index}_${Math.random().toString(36).substr(2, 9)}`;
                    selectedProductFiles.push({
                        id: uniqueId,
                        file: file
                    });

                    const reader = new FileReader();
                    reader.onload = function(event) {
                        const wrapper = createImageThumbnail(event.target.result, 'Product Preview',
                            function() {
                                removeProductImage(uniqueId);
                            });
                        wrapper.setAttribute('data-id', uniqueId);

                        previewContainer.appendChild(wrapper); // Append new image
                        processedCount++;
                        if (processedCount === totalNewFiles) {
                            updateFileInput('product_photos', selectedProductFiles.map(f => f.file));
                            isProcessing = false;
                        }
                    };

                    reader.onerror = function() {
                        processedCount++;
                        if (processedCount === totalNewFiles) {
                            updateFileInput('product_photos', selectedProductFiles.map(f => f.file));
                            isProcessing = false;
                        }
                    };

                    reader.readAsDataURL(file);
                });

                if (totalNewFiles === 0) {
                    isProcessing = false;
                }

                // Clear the input to allow new selections
                e.target.value = '';
            }

            function removeProductImage(id) {
                selectedProductFiles = selectedProductFiles.filter(f => f.id !== id);
                const previewItem = document.querySelector(`[data-id="${id}"]`);
                if (previewItem && previewItem.parentNode) {
                    previewItem.parentNode.removeChild(previewItem);
                }
                updateFileInput('product_photos', selectedProductFiles.map(f => f.file));
            }

            function updateFileInput(inputId, filesArray) {
                const input = document.getElementById(inputId);
                const dataTransfer = new DataTransfer();
                filesArray.forEach(file => dataTransfer.items.add(file)); // Add File objects directly
                input.files = dataTransfer.files;
            }

            function createImageThumbnail(src, alt, onRemove) {
                const wrapper = document.createElement('div');
                wrapper.className = 'position-relative';

                const img = document.createElement('img');
                img.src = src;
                img.alt = alt;
                img.style.width = '100px';
                img.style.height = '100px';
                img.style.objectFit = 'cover';
                img.style.margin = '5px';
                img.style.border = '1px solid #ddd';
                img.style.borderRadius = '5px';

                const removeBtn = document.createElement('button');
                removeBtn.className = 'btn btn-danger btn-sm position-absolute top-0 end-0';
                removeBtn.style.padding = '2px 6px';
                removeBtn.textContent = '×';
                removeBtn.addEventListener('click', onRemove);

                wrapper.appendChild(img);
                wrapper.appendChild(removeBtn);
                return wrapper;
            }

            // Expose functions for external use if needed
            window.removeProductImage = removeProductImage;
        });
        document.addEventListener('DOMContentLoaded', function() {
            const productPhotosInputY = document.getElementById('y_product_photos');
            const previewContainerY = document.getElementById('y_product_photos_preview');
            let selectedYProductFiles = []; // Track all selected Y product files globally
            let isYProcessing = false; // Assume this is defined globally if used elsewhere

            if (productPhotosInputY && previewContainerY) {
                productPhotosInputY.addEventListener('change', handleYProductPhotosChange);
            }

            function handleYProductPhotosChange(e) {
                if (isYProcessing) return;
                isYProcessing = true;

                const files = Array.from(e.target.files);
                const previewContainer = document.getElementById('y_product_photos_preview');
                const errorElement = document.getElementById('y_product_photos_error');

                // Clear error on new selection
                errorElement.classList.add('d-none');

                // Limit to 3 total files
                const remainingSlots = 3 - selectedYProductFiles.length;
                if (remainingSlots <= 0) {
                    errorElement.textContent = 'Maximum 3 product photos allowed.';
                    errorElement.classList.remove('d-none');
                    isYProcessing = false;
                    return;
                }

                let processedCount = 0;
                const totalNewFiles = Math.min(files.length, remainingSlots);

                files.slice(0, remainingSlots).forEach((file, index) => {
                    if (!file.type.startsWith('image/')) {
                        errorElement.textContent = 'Only image files (JPG, PNG, JPEG, GIF) are allowed.';
                        errorElement.classList.remove('d-none');
                        isYProcessing = false;
                        return;
                    }

                    const maxSize = 5 * 1024 * 1024; // 5MB
                    if (file.size > maxSize) {
                        errorElement.textContent =
                            `Product photo ${selectedYProductFiles.length + index + 1} exceeds 5MB limit.`;
                        errorElement.classList.remove('d-none');
                        isYProcessing = false;
                        return;
                    }

                    const uniqueId =
                        `y_product_${Date.now()}_${index}_${Math.random().toString(36).substr(2, 9)}`;
                    selectedYProductFiles.push({
                        id: uniqueId,
                        file
                    });

                    const reader = new FileReader();
                    reader.onload = function(event) {
                        const wrapper = createImageThumbnail(event.target.result, 'Y Product Preview',
                            function() {
                                removeYProductImage(uniqueId);
                            });
                        wrapper.setAttribute('data-id', uniqueId);

                        previewContainer.appendChild(wrapper); // Append new image
                        processedCount++;
                        if (processedCount === totalNewFiles) {
                            updateFileInput('y_product_photos', selectedYProductFiles);
                            isYProcessing = false;
                        }
                    };

                    reader.onerror = function() {
                        processedCount++;
                        if (processedCount === totalNewFiles) {
                            updateFileInput('y_product_photos', selectedYProductFiles);
                            isYProcessing = false;
                        }
                    };

                    reader.readAsDataURL(file);
                });

                // If no new valid files were processed, reset processing
                if (totalNewFiles === 0) {
                    isYProcessing = false;
                }
            }

            function removeYProductImage(id) {
                selectedYProductFiles = selectedYProductFiles.filter(f => f.id !== id);
                const previewItem = document.querySelector(`[data-id="${id}"]`);
                if (previewItem && previewItem.parentNode) {
                    previewItem.parentNode.removeChild(previewItem);
                }
                updateFileInput('y_product_photos', selectedYProductFiles);
            }

            function updateFileInput(inputId, filesArray) {
                const input = document.getElementById(inputId);
                const dataTransfer = new DataTransfer();
                filesArray.forEach(fileObj => dataTransfer.items.add(fileObj.file));
                input.files = dataTransfer.files;
            }

            function createImageThumbnail(src, alt, onRemove) {
                const wrapper = document.createElement('div');
                wrapper.className = 'position-relative';

                const img = document.createElement('img');
                img.src = src;
                img.alt = alt;
                img.style.width = '100px';
                img.style.height = '100px';
                img.style.objectFit = 'cover';
                img.style.margin = '5px';
                img.style.border = '1px solid #ddd';
                img.style.borderRadius = '5px';

                const removeBtn = document.createElement('button');
                removeBtn.className = 'btn btn-danger btn-sm position-absolute top-0 end-0';
                removeBtn.style.padding = '2px 6px';
                removeBtn.textContent = '×';
                removeBtn.addEventListener('click', onRemove);

                wrapper.appendChild(img);
                wrapper.appendChild(removeBtn);
                return wrapper;
            }

            // Expose functions for external use if needed
            window.removeYProductImage = removeYProductImage;
        });
    </script>
    {{-- previe image logic --}}
    <script>
        // Global variables for all file uploads
        let selectedProductFiles = [];
        let selectedYProductFiles = [];
        let isProcessing = false;
        let isYProcessing = false;

        // Generic function to clear container
        function clearContainer(container) {
            while (container && container.firstChild) {
                container.removeChild(container.firstChild);
            }
        }

        // Generic function to create image thumbnail



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
            removeBtn.innerHTML = '&times;';
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

        // Y Business Logo Handler (new)
        function handleYBusinessLogoChange(e) {
            const previewContainer = document.getElementById('y_business_logo_preview');
            clearContainer(previewContainer);

            const file = e.target.files[0];
            if (file && file.type.startsWith('image/')) {
                const reader = new FileReader();
                reader.onload = function(evt) {
                    clearContainer(previewContainer);
                    const thumbnail = createImageThumbnail(evt.target.result, 'Y Logo Preview', removeYBusinessLogo);
                    previewContainer.appendChild(thumbnail);
                };
                reader.readAsDataURL(file);
            }
        }

        // Product Photos Handler (original)

        document.addEventListener('DOMContentLoaded', function() {
            const yBusinessLogoInput = document.getElementById('y_business_logo');
            const yPitchDeckInput = document.getElementById('y_pitch_deck');
            let selectedYBusinessLogo = null; // Track single Y business logo
            let selectedYPitchDeck = null; // Track single Y pitch deck

            if (yBusinessLogoInput) {
                yBusinessLogoInput.addEventListener('change', handleYBusinessLogoChange);
            }
            if (yPitchDeckInput) {
                yPitchDeckInput.addEventListener('change', handleYPitchDeckChange);
            }

            function handleYBusinessLogoChange(e) {
                const file = e.target.files[0];
                const previewContainer = document.getElementById('y_business_logo_preview');
                const errorElement = document.getElementById('y_business_logo_error');

                // Clear error and preview
                errorElement.classList.add('d-none');
                clearContainer(previewContainer);

                if (!file) {
                    selectedYBusinessLogo = null;
                    updateFileInput('y_business_logo', []);
                    return;
                }

                const validImageTypes = ['image/jpeg', 'image/png', 'image/jpg'];
                if (!validImageTypes.includes(file.type)) {
                    errorElement.textContent = 'Only JPG, JPEG, or PNG files allowed for business logo.';
                    errorElement.classList.remove('d-none');
                    selectedYBusinessLogo = null;
                    updateFileInput('y_business_logo', []);
                    return;
                }

                if (file.size > 5 * 1024 * 1024) { // 5MB
                    errorElement.textContent = 'Business logo exceeds 5MB limit.';
                    errorElement.classList.remove('d-none');
                    selectedYBusinessLogo = null;
                    updateFileInput('y_business_logo', []);
                    return;
                }

                const reader = new FileReader();
                reader.onload = function(event) {
                    const wrapper = createImageThumbnail(event.target.result, 'Y Business Logo Preview',
                        removeYBusinessLogo);
                    previewContainer.appendChild(wrapper);
                    selectedYBusinessLogo = {
                        id: `y_logo_${Date.now()}`,
                        file
                    };
                    updateFileInput('y_business_logo', selectedYBusinessLogo ? [selectedYBusinessLogo.file] :
                    []);
                };
                reader.readAsDataURL(file);
            }

            function handleYPitchDeckChange(e) {
                const file = e.target.files[0];
                const previewContainer = document.getElementById('y_pitch_deck_preview');
                const errorElement = document.getElementById('y_pitch_deck_error');

                // Clear error and preview
                errorElement.classList.add('d-none');
                clearContainer(previewContainer);

                if (!file) {
                    selectedYPitchDeck = null;
                    updateFileInput('y_pitch_deck', []);
                    return;
                }

                const validMime = file.type === 'application/pdf';
                const validExtension = file.name.toLowerCase().endsWith('.pdf');
                if (!validMime || !validExtension) {
                    errorElement.textContent = 'Only PDF files are allowed.';
                    errorElement.classList.remove('d-none');
                    selectedYPitchDeck = null;
                    updateFileInput('y_pitch_deck', []);
                    return;
                }

                if (file.size > 5 * 1024 * 1024) { // 5MB (adjusted from 10MB based on small text)
                    errorElement.textContent = 'File size must be less than 5MB.';
                    errorElement.classList.remove('d-none');
                    selectedYPitchDeck = null;
                    updateFileInput('y_pitch_deck', []);
                    return;
                }

                const reader = new FileReader();
                reader.onload = function() {
                    const pdfPreview = createPDFPreview(file.name, file.size, removeYPitchDeck);
                    previewContainer.appendChild(pdfPreview);
                    selectedYPitchDeck = {
                        id: `y_pdf_${Date.now()}`,
                        file
                    };
                    updateFileInput('y_pitch_deck', selectedYPitchDeck ? [selectedYPitchDeck.file] : []);
                };
                reader.readAsDataURL(file); // Metadata only for PDF
            }

            function removeYBusinessLogo() {
                const container = document.getElementById('y_business_logo_preview');
                const input = document.getElementById('y_business_logo');
                clearContainer(container);
                selectedYBusinessLogo = null;
                input.value = '';
                updateFileInput('y_business_logo', []);
            }

            function removeYPitchDeck() {
                const container = document.getElementById('y_pitch_deck_preview');
                const input = document.getElementById('y_pitch_deck');
                clearContainer(container);
                selectedYPitchDeck = null;
                input.value = '';
                updateFileInput('y_pitch_deck', []);
            }

            function updateFileInput(inputId, filesArray) {
                const input = document.getElementById(inputId);
                const dataTransfer = new DataTransfer();
                filesArray.forEach(file => dataTransfer.items.add(file));
                input.files = dataTransfer.files;
            }

            function createImageThumbnail(src, alt, onRemove) {
                const wrapper = document.createElement('div');
                wrapper.className = 'position-relative';

                const img = document.createElement('img');
                img.src = src;
                img.alt = alt;
                img.style.width = '100px';
                img.style.height = '100px';
                img.style.objectFit = 'cover';
                img.style.margin = '5px';
                img.style.border = '1px solid #ddd';
                img.style.borderRadius = '5px';

                const removeBtn = document.createElement('button');
                removeBtn.className = 'btn btn-danger btn-sm position-absolute top-0 end-0';
                removeBtn.style.padding = '2px 6px';
                removeBtn.textContent = '×';
                removeBtn.addEventListener('click', onRemove);

                wrapper.appendChild(img);
                wrapper.appendChild(removeBtn);
                return wrapper;
            }

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

                const pdfIcon = document.createElement('div');
                pdfIcon.innerHTML =
                    '<i class="fas fa-file-pdf" style="font-size: 24px; color: #dc3545; margin-right: 10px;"></i>';

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

            function formatFileSize(bytes) {
                const sizes = ['Bytes', 'KB', 'MB', 'GB', 'TB'];
                if (bytes === 0) return '0 Byte';
                const i = parseInt(Math.floor(Math.log(bytes) / Math.log(1024)));
                return Math.round(bytes / Math.pow(1024, i), 2) + ' ' + sizes[i];
            }

            // Expose functions for external use if needed
            window.removeYBusinessLogo = removeYBusinessLogo;
            window.removeYPitchDeck = removeYPitchDeck;
        });

        function validateProductPhotos() {
            const productPhotos = document.getElementById('product_photos');
            const errorElement = document.getElementById('product_photos_error');
            let isValid = true;

            if (!productPhotos) {
                formDataStep.product_photos = [];
                //console.error('Product photos input element not found');
                isValid = false;
            } else if (selectedProductFiles.length === 0) {
                errorElement.textContent = 'At least one product photo is required.';
                errorElement.classList.remove('d-none');
                isValid = false;
            } else if (selectedProductFiles.length > 3) {
                errorElement.textContent = 'Maximum 3 product photos allowed.';
                errorElement.classList.remove('d-none');
                isValid = false;
            } else {
                const validImageTypes = ['image/jpeg', 'image/png', 'image/jpg', 'image/gif'];
                const maxSize = 5 * 1024 * 1024; // 5MB

                for (let i = 0; i < selectedProductFiles.length; i++) {
                    const file = selectedProductFiles[i].file;
                    if (!validImageTypes.includes(file.type)) {
                        errorElement.textContent = 'Only JPG, PNG, JPEG, or GIF files allowed.';
                        errorElement.classList.remove('d-none');
                        isValid = false;
                        break;
                    } else if (file.size > maxSize) {
                        errorElement.textContent = `Product photo ${i + 1} exceeds 5MB limit.`;
                        errorElement.classList.remove('d-none');
                        isValid = false;
                        break;
                    }
                }
            }

            if (isValid) {
                errorElement.classList.add('d-none');
            }
            return isValid;
        }

        // Y Product Photos Handler (new)


        // PDF Handler for pitch_deck
        function handlePitchDeckChange(e) {
            const previewContainer = document.getElementById('pitch_deck_preview');
            if (!previewContainer) {
                // Create preview container if it doesn't exist
                const container = document.createElement('div');
                container.id = 'pitch_deck_preview';
                container.className = 'pdf-preview-container mt-2';
                e.target.parentNode.parentNode.appendChild(container);
            }

            const container = document.getElementById('pitch_deck_preview');
            clearContainer(container);

            const file = e.target.files[0];
            if (file && file.type === 'application/pdf') {
                const pdfPreview = createPDFPreview(file.name, file.size, removePitchDeck);
                container.appendChild(pdfPreview);
            }
        }

        // PDF Handler for y_pitch_deck
        function handleYPitchDeckChange(e) {
            const previewContainer = document.getElementById('y_pitch_deck_preview');
            if (!previewContainer) {
                // Create preview container if it doesn't exist
                const container = document.createElement('div');
                container.id = 'y_pitch_deck_preview';
                container.className = 'pdf-preview-container mt-2';
                e.target.parentNode.parentNode.appendChild(container);
            }

            const container = document.getElementById('y_pitch_deck_preview');
            clearContainer(container);

            const file = e.target.files[0];
            if (file && file.type === 'application/pdf') {
                const pdfPreview = createPDFPreview(file.name, file.size, removeYPitchDeck);
                container.appendChild(pdfPreview);
            }
        }

        // Remove functions
        function removeBusinessLogo() {
            const container = document.getElementById('business_logo_preview');
            const input = document.getElementById('business_logo');
            clearContainer(container);
            input.value = '';
        }

        function removeYBusinessLogo() {
            const container = document.getElementById('y_business_logo_preview');
            const input = document.getElementById('y_business_logo');
            clearContainer(container);
            input.value = '';
        }

        function removeProductImage(id) {
            selectedProductFiles = selectedProductFiles.filter(f => f.id !== id);
            const previewItem = document.querySelector(`[data-id="${id}"]`);
            if (previewItem && previewItem.parentNode) {
                previewItem.parentNode.removeChild(previewItem);
            }
            updateFileInput('product_photos', selectedProductFiles);
            validateProductPhotos(); // Re-validate after removal
        }

        function removeYProductImage(id) {
            selectedYProductFiles = selectedYProductFiles.filter(f => f.id !== id);
            const previewItem = document.querySelector(`[data-id="${id}"]`);
            if (previewItem && previewItem.parentNode) {
                previewItem.parentNode.removeChild(previewItem);
            }
            updateFileInput('y_product_photos', selectedYProductFiles);
        }

        // PDF Remove functions
        function removePitchDeck() {
            const container = document.getElementById('pitch_deck_preview');
            const input = document.getElementById('pitch_deck');
            clearContainer(container);
            input.value = '';
        }

        function removeYPitchDeck() {
            const container = document.getElementById('y_pitch_deck_preview');
            const input = document.getElementById('y_pitch_deck');
            clearContainer(container);
            input.value = '';
        }

        // Generic update file input function
        function updateFileInput(inputId, filesArray) {
            const input = document.getElementById(inputId);
            const dataTransfer = new DataTransfer();
            filesArray.forEach(fileObj => dataTransfer.items.add(fileObj.file));
            input.files = dataTransfer.files;
        }

        // Clear event listeners
        function clearEventListeners() {
            const elements = [{
                    id: 'business_logo',
                    handler: handleBusinessLogoChange
                },
                {
                    id: 'y_business_logo',
                    handler: handleYBusinessLogoChange
                },
                {
                    id: 'product_photos',
                    handler: handleProductPhotosChange
                },
                {
                    id: 'y_product_photos',
                    handler: handleYProductPhotosChange
                },
                {
                    id: 'pitch_deck',
                    handler: handlePitchDeckChange
                },
                {
                    id: 'y_pitch_deck',
                    handler: handleYPitchDeckChange
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
                    id: 'y_business_logo',
                    handler: handleYBusinessLogoChange
                },
                {
                    id: 'product_photos',
                    handler: handleProductPhotosChange
                },
                {
                    id: 'y_product_photos',
                    handler: handleYProductPhotosChange
                },
                {
                    id: 'pitch_deck',
                    handler: handlePitchDeckChange
                },
                {
                    id: 'y_pitch_deck',
                    handler: handleYPitchDeckChange
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
            } else if (inputId === 'y_business_logo') {
                removeYBusinessLogo();
            } else if (inputId === 'product_photos') {
                selectedProductFiles = [];
                const input = document.getElementById('product_photos');
                const container = document.getElementById('product_photos_preview');
                input.value = '';
                clearContainer(container);
            } else if (inputId === 'y_product_photos') {
                selectedYProductFiles = [];
                const input = document.getElementById('y_product_photos');
                const container = document.getElementById('y_product_photos_preview');
                input.value = '';
                clearContainer(container);
            } else if (inputId === 'pitch_deck') {
                removePitchDeck();
            } else if (inputId === 'y_pitch_deck') {
                removeYPitchDeck();
            }
        }

        // Initialize when DOM is ready
        if (document.readyState === 'loading') {
            document.addEventListener('DOMContentLoaded', initializeEventListeners);
        } else {
            initializeEventListeners();
        }
    </script>
    {{-- yes previe images  --}}

@endsection
