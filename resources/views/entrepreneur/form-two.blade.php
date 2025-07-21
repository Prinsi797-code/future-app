@extends('layouts.app')
<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/flatpickr/4.6.13/flatpickr.min.css">
<script src="https://cdnjs.cloudflare.com/ajax/libs/flatpickr/4.6.13/flatpickr.min.js"></script>
@section('title', 'Entrepreneur Registration - Future Taikun')

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
                                        <label for="current_address">Current Address</label>
                                        <div class="text-danger mt-1 d-none" id="current_address_error"></div>
                                    </div>
                                </div>

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
                                            class="form-control" name="pin_code" id="pin_code"
                                            value="{{ old('pin_code', $enterprent->pin_code ?? '') }}"
                                            placeholder="520963">
                                        <label class="from-label">Pin/Zip Code *</label>
                                        <div class="text-danger mt-1 d-done" id="pin_code_error"></div>
                                    </div>
                                </div>

                                <div class="col-md-6 mb-3">
                                    <div class="form-floating-custom">
                                        <label class="form-label">Date of Birth</label>
                                        <input type="text" class="form-control" name="dob" id="dob"
                                            value ="{{ old('dob', $enterprent->dob ?? '') }}" placeholder="Select date"
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
                                                        {{ old('qualification', $enterprent->qualification ?? '') == $qualification ? 'selected' : '' }}>
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
                                            value="{{ old('age', $enterprent->age ?? '') }}" placeholder="20" readonly>
                                    </div>
                                </div>
                            </div>
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
                                                    id="business_name"
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
                                                    id="brand_name"
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
                                                    id="business_address"
                                                    value="{{ old('business_address', $enterprent->business_address ?? '') }}"
                                                    placeholder="Nexora Ventures Ltd.2 Farringdon Street London..">
                                                <label class="form-label" id="proposed_business_address_label">Proposed
                                                    Business Address</label>
                                                <div class="text-danger mt-1 d-none" id="proposed_business_address_error">
                                                </div>
                                            </div>
                                        </div>

                                        <div class="col-12 col-md-6 mb-3">
                                            <div class="form-floating-custom">
                                                <label class="form-label w-100">Describe Your Business in One Sentence
                                                    *</label>
                                                <textarea class="form-control" name="business_describe" rows="2" maxlength="75" id="business_describe"
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
                                                    <label for="industry">Select Industries</label>
                                                </div>
                                                <div class="text-danger mt-1 d-none" id="industry_error"></div>
                                            </div>
                                        </div>

                                        <div class="col-md-4 mb-3">
                                            <div class="form-floating-custom">
                                                <label class="form-label">Own Fund *<span
                                                        class="funding_currency_label">()</span></label>
                                                <input type="number" class="form-control" name="own_fund"
                                                    id="own_fund"
                                                    value="{{ old('own_fund', $enterprent->own_fund ?? '') }}"
                                                    placeholder="5000">
                                                <div class="text-danger mt-1 d-none" id="own_fund_error"></div>
                                            </div>
                                        </div>

                                        <div class="col-md-4 mb-3">
                                            <div class="form-floating-custom">
                                                <label class="form-label">Loan *<span
                                                        class="funding_currency_label">()</span></label>
                                                <input type="number" class="form-control" name="loan" id="loan"
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
                                                    id="market_capital" step="0.01" placeholder="50000">
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

                                        <div class="upload-section">
                                            <label for="business_logo" class="form-label">Upload Business Logo *</label>
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

                                        <!-- Product Photos Upload -->
                                        <div class="upload-section">
                                            <label for="product_photos" class="form-label">Upload Product Photos</label>
                                            <div class="file-upload-wrapper">
                                                <input class="form-control" type="file" id="product_photos"
                                                    name="product_photos[]" accept=".jpg,.jpeg,.png,.gif" multiple>
                                                <div class="placeholder-container">
                                                    <div class="placeholder-box" id="product-placeholder-1">
                                                        <div class="placeholder-icon">📸</div>
                                                        <button class="remove-btn"
                                                            onclick="removeProductImage(0)">×</button>
                                                    </div>
                                                    <div class="placeholder-box" id="product-placeholder-2">
                                                        <div class="placeholder-icon">📸</div>
                                                        <button class="remove-btn"
                                                            onclick="removeProductImage(1)">×</button>
                                                    </div>
                                                    <div class="placeholder-box" id="product-placeholder-3">
                                                        <div class="placeholder-icon">📸</div>
                                                        <button class="remove-btn"
                                                            onclick="removeProductImage(2)">×</button>
                                                    </div>
                                                </div>
                                            </div>
                                            <div class="upload-text">Click to upload product photos (max 3)</div>
                                            <div id="product_photos_error" class="error-message d-none"></div>
                                            <small class="text-muted">Select 1-3 images (JPG, JPEG, PNG, GIF only, max 5MB
                                                each)</small>
                                        </div>

                                        <div class="col-12 mb-3">
                                            <label for="pitch_deck" class="form-label">Upload Business Summary</label>
                                            {{-- <div class="file-upload-wrapper"> --}}
                                            <input class="form-control" type="file" id="pitch_deck" name="pitch_deck"
                                                accept=".pdf">
                                            <label for="pitch_deck" class="file-upload-label w-100"></label>
                                            {{-- </div> --}}
                                            <div id="pitch_deck_preview" class="pdf-preview-container mt-2">

                                            </div>
                                            <div class="text-danger mt-1 d-none" id="pitch_deck_error"></div>
                                            <small class="text-muted">Select 1 PDF (max 5MB)</small>
                                        </div>
                                    </div>
                                </div>
                                <!-- Business Details Section - Hidden by default -->
                                <div id="business_details_section" style="display: none;">
                                    <div class="row">
                                        <div class="col-md-6 mb-3">
                                            <div class="form-floating-custom">
                                                <input type="text" class="form-control" name="y_business_name"
                                                    id="y_business_name"
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
                                                    id="y_brand_name"
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
                                                <textarea class="form-control" name="y_describe_business" id="y_describe_business" rows="2" maxlength="75"
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
                                                    id="y_own_fund"
                                                    value="{{ old('y_own_fund', $enterprent->y_own_fund ?? '') }}"
                                                    placeholder="5000">
                                                <div class="text-danger mt-1 d-none" id="y_own_fund_error"></div>
                                            </div>
                                        </div>

                                        <div class="col-md-4 mb-3">
                                            <div class="form-floating-custom">
                                                <label class="form-label">Loan *<span
                                                        class="funding_currency_label">()</span></label>
                                                <input type="number" class="form-control" name="y_loan" id="y_loan"
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
                                                    id="business_revenue1"
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
                                                    id="business_revenue2"
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
                                                    id="business_revenue3"
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

                                        <div class="upload-section">
                                            <div class="col-12 mb-3">
                                                <label for="y_business_logo" class="form-label">Upload Business Logo
                                                    *</label>
                                                <div class="file-upload-wrapper">
                                                    <input class="form-control" type="file" id="y_business_logo"
                                                        name="y_business_logo" accept=".jpg,.jpeg,.png">
                                                    <div class="business-logo-container">
                                                        <div class="placeholder-box business-logo-placeholder"
                                                            id="y-logo-placeholder">
                                                            <div class="placeholder-icon">📷</div>
                                                            <button class="remove-btn"
                                                                onclick="removeYBusinessLogo()">×</button>
                                                        </div>
                                                    </div>
                                                </div>
                                                <div class="upload-text">Click to upload logo</div>

                                                <!-- Current logo display (if exists) -->
                                                <div class="existing-photos" id="y-existing-logo" style="display: none;">
                                                    <h6>Current Logo:</h6>
                                                    <div class="existing-photo-item">
                                                        <img src="" alt="Current Business Logo"
                                                            id="y-current-logo-img">
                                                        <small class="form-text text-muted">
                                                            <a href="" target="_blank"
                                                                id="y-current-logo-link">View Current Logo</a>
                                                        </small>
                                                    </div>
                                                </div>

                                                <div id="y_business_logo_error" class="error-message d-none"></div>
                                                <small class="text-muted">Select 1 image (JPG, JPEG, PNG only, max
                                                    5MB)</small>
                                            </div>
                                        </div>

                                        <!-- Y Product Photos Upload -->
                                        <div class="upload-section">
                                            <div class="col-12 mb-3">
                                                <label for="y_product_photos" class="form-label">Upload Products Photos
                                                    *</label>
                                                <div class="file-upload-wrapper">
                                                    <input class="form-control" type="file" id="y_product_photos"
                                                        name="y_product_photos[]" accept=".jpg,.jpeg,.png,.gif" multiple>
                                                    <div class="placeholder-container">
                                                        <div class="placeholder-box" id="y-product-placeholder-1">
                                                            <div class="placeholder-icon">📸</div>
                                                            <button class="remove-btn"
                                                                onclick="removeYProductImage(0)">×</button>
                                                        </div>
                                                        <div class="placeholder-box" id="y-product-placeholder-2">
                                                            <div class="placeholder-icon">📸</div>
                                                            <button class="remove-btn"
                                                                onclick="removeYProductImage(1)">×</button>
                                                        </div>
                                                        <div class="placeholder-box" id="y-product-placeholder-3">
                                                            <div class="placeholder-icon">📸</div>
                                                            <button class="remove-btn"
                                                                onclick="removeYProductImage(2)">×</button>
                                                        </div>
                                                    </div>
                                                </div>
                                                <div class="upload-text">Click to upload product photos (max 3)</div>

                                                <!-- Current product photos display (if exists) -->
                                                <div class="existing-photos" id="y-existing-photos"
                                                    style="display: none;">
                                                    <h6>Current Product Photos:</h6>
                                                    <div id="y-current-photos-container">
                                                        <!-- Current photos will be displayed here -->
                                                    </div>
                                                </div>

                                                <div id="y_product_photos_error" class="error-message d-none"></div>
                                                <small class="text-muted">Select 1-3 images (JPG, JPEG, PNG, GIF only, max
                                                    5MB each)</small>
                                            </div>
                                        </div>

                                        <div class="col-12 mb-3">
                                            {{-- <div class="form-floating-custom"> --}}
                                            <label for="y_pitch_deck" class="form-label">Upload Business Summary</label>
                                            {{-- <div class="file-upload-wrapper"> --}}
                                            <input class="form-control" type="file" id="y_pitch_deck"
                                                name="y_pitch_deck" accept=".pdf">
                                            <label for="y_pitch_deck" class="file-upload-label w-100">
                                            </label>
                                            {{-- </div> --}}
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
                                    </div>
                                </div>
                                <div class="row mb-4">
                                    <div class="col-12">
                                    </div>

                                    <div class="col-12 mb-3">
                                        <div class="form-floating-custom">
                                            <label for="video_upload" class="form-label">Upload Pitch Video</label>
                                            <input type="file" class="form-control" id="video_upload"
                                                name="video_upload" accept="video/mp4,video/x-m4v,video/avi,video/webm">
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
                                            I agree to the <a href="#" class="text-primary">Terms and Conditions</a>
                                            and
                                            <a href="#" class="text-primary">Privacy Policy</a> *
                                        </label>
                                        <div class="text-danger mt-1 d-none" id="agreed_to_terms_error"></div>
                                    </div>
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
    <script src="https://cdnjs.cloudflare.com/ajax/libs/bootstrap/5.3.0/js/bootstrap.bundle.min.js"></script>
    <script>
        document.addEventListener('DOMContentLoaded', function() {
            const API_KEY = 'WmtRc2MzTzhLRnltNGNmSjljT3RqakROckhSOFFQSTZqMXBGbVlNUw==';
            const BASE_URL = 'https://api.countrystatecity.in/v1';
            const MAX_FILE_SIZE = 5 * 1024 * 1024; // 5MB in bytes

            // Elements for radio buttons and sections
            const registerNo = document.getElementById('register_no');
            const registerYes = document.getElementById('register_yes');
            const businessDetailsSectionNo = document.getElementById('business_details_section_no');
            const businessDetailsSection = document.getElementById('business_details_section');

            // Elements for personal information fields
            const fullNameInput = document.getElementById('full_name');
            const countrySelect = document.getElementById('country');
            const stateSelect = document.getElementById('state');
            const citySelect = document.getElementById('city');
            const pinCodeInput = document.getElementById('pin_code');
            const dobInput = document.getElementById('dob');
            const ageInput = document.getElementById('age');
            const businessYearSelect = document.getElementById('business_year');
            const businessYearCountInput = document.getElementById('business_year_count');
            const emailInput = document.querySelector('input[name="email"]');
            const countryCodeSelect = document.querySelector('select[name="country_code"]');

            // Elements for unregistered business fields
            const businessNameInput = document.getElementById('business_name');
            const brandNameInput = document.getElementById('brand_name');
            const businessDescribeInput = document.getElementById('business_describe');
            const businessCountrySelect = document.getElementById('business_country');
            const businessStateSelect = document.getElementById('business_state');
            const businessCitySelect = document.getElementById('business_city');
            const ownFundInput = document.getElementById('own_fund');
            const loanInput = document.getElementById('loan');
            const marketCapitalInput = document.getElementById('market_capital');
            const yourStakeInput = document.getElementById('your_stake');
            const stakeFundingInput = document.getElementById('stake_funding');

            // Elements for registered business fields
            const yBusinessNameInput = document.getElementById('y_business_name');
            const yBrandNameInput = document.getElementById('y_brand_name');
            const yDescribeBusinessInput = document.getElementById('y_describe_business');
            const yBusinessCountrySelect = document.getElementById('y_business_country');
            const yBusinessStateSelect = document.getElementById('y_business_state');
            const yBusinessCitySelect = document.getElementById('y_business_city');
            const yOwnFundInput = document.getElementById('y_own_fund');
            const yLoanInput = document.getElementById('y_loan');
            const businessRevenue1Input = document.getElementById('business_revenue1');
            const businessRevenue2Input = document.getElementById('business_revenue2');
            const yMarketCapitalInput = document.getElementById('y_market_capital');
            const yYourStakeInput = document.getElementById('y_your_stake');

            // File input and preview elements
            const businessLogoInput = document.getElementById('business_logo');
            const businessLogoPlaceholder = document.getElementById('logo-placeholder');
            const productPhotosInput = document.getElementById('product_photos');
            const yBusinessLogoInput = document.getElementById('y_business_logo');
            const yBusinessLogoPlaceholder = document.getElementById('y-logo-placeholder');
            const yProductPhotosInput = document.getElementById('y_product_photos');

            // Error elements
            const businessLogoError = document.getElementById('business_logo_error');
            const productPhotosError = document.getElementById('product_photos_error');
            const yBusinessLogoError = document.getElementById('y_business_logo_error');
            const yProductPhotosError = document.getElementById('y_product_photos_error');
            const fullNameError = document.getElementById('full_name_error');
            const countryError = document.getElementById('country_error');
            const stateError = document.getElementById('state_error');
            const cityError = document.getElementById('city_error');
            const pinCodeError = document.getElementById('pin_code_error');
            const dobError = document.getElementById('dob_error');
            const businessNameError = document.getElementById('business_name_error');
            const brandNameError = document.getElementById('brand_name_error');
            const businessDescribeError = document.getElementById('business_describe_error');
            const businessCountryError = document.getElementById('business_country_error');
            const businessStateError = document.getElementById('business_state_error');
            const businessCityError = document.getElementById('business_city_error');
            const ownFundError = document.getElementById('own_fund_error');
            const loanError = document.getElementById('loan_error');
            const marketCapitalError = document.getElementById('market_capital_error');
            const yourStakeError = document.getElementById('your_stake_error');
            const stakeFundingError = document.getElementById('stake_funding_error');
            const yBusinessNameError = document.getElementById('y_business_name_error');
            const yBrandNameError = document.getElementById('y_brand_name_error');
            const yDescribeBusinessError = document.getElementById('y_describe_business_error');
            const yBusinessCountryError = document.getElementById('y_business_country_error');
            const yBusinessStateError = document.getElementById('y_business_state_error');
            const yBusinessCityError = document.getElementById('y_business_city_error');
            const yOwnFundError = document.getElementById('y_own_fund_error');
            const yLoanError = document.getElementById('y_loan_error');
            const businessRevenue1Error = document.getElementById('business_revenue1_error');
            const businessRevenue2Error = document.getElementById('business_revenue2_error');
            const yMarketCapitalError = document.getElementById('y_market_capital_error');
            const yYourStakeError = document.getElementById('y_your_stake_error');

            const fundingCurrencyLabels = document.querySelectorAll('.funding_currency_label');

            // Default state: register_business = 0
            registerNo.checked = true;
            businessDetailsSectionNo.style.display = 'block';
            businessDetailsSection.style.display = 'none';

            // Radio button event listeners
            registerNo.addEventListener('change', function() {
                if (this.checked) {
                    businessDetailsSectionNo.style.display = 'block';
                    businessDetailsSection.style.display = 'none';
                    document.querySelector('input[name="register_business"][value="0"]').checked = true;
                }
            });

            registerYes.addEventListener('change', function() {
                if (this.checked) {
                    businessDetailsSectionNo.style.display = 'none';
                    businessDetailsSection.style.display = 'block';
                    document.querySelector('input[name="register_business"][value="1"]').checked = true;
                }
            });

            // Initialize Flatpickr for DOB with 18+ validation
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

            // Business year count calculation
            if (businessYearSelect) {
                businessYearSelect.addEventListener('change', function() {
                    const selectedYear = parseInt(this.value);
                    if (selectedYear) {
                        const currentYear = new Date().getFullYear();
                        businessYearCountInput.value = currentYear - selectedYear;
                    } else {
                        businessYearCountInput.value = '';
                    }
                });
            }

            // Clear form function
            function clearCurrentStep() {
                const emailValue = emailInput.value;
                const countryCodeValue = countryCodeSelect.value;

                const textInputs = document.querySelectorAll(
                    'input[type="text"], input[type="number"], input[type="tel"], textarea');
                textInputs.forEach(input => {
                    if (input !== emailInput && input.name !== 'country_code') {
                        input.value = '';
                    }
                });

                const selectElements = document.querySelectorAll('select');
                selectElements.forEach(select => {
                    if (select !== countryCodeSelect) {
                        select.selectedIndex = 0;
                    }
                });

                registerNo.checked = true;
                registerYes.checked = false;
                businessDetailsSectionNo.style.display = 'block';
                businessDetailsSection.style.display = 'none';

                const fileInputs = [businessLogoInput, productPhotosInput, yBusinessLogoInput, yProductPhotosInput];
                fileInputs.forEach(input => {
                    if (input) input.value = '';
                });

                const errorElements = document.querySelectorAll('.text-danger');
                errorElements.forEach(error => {
                    error.textContent = '';
                    error.classList.add('d-none');
                });

                emailInput.value = emailValue;
                countryCodeSelect.value = countryCodeValue;
            }

            const clearBtn = document.getElementById('clearBtn');
            if (clearBtn) {
                clearBtn.addEventListener('click', clearCurrentStep);
            }

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

                const isRegistered = registerYes.checked;

                // Unregistered Business Validation
                if (!isRegistered) {
                    if (!businessNameInput.value.trim()) {
                        setError(businessNameInput, businessNameError, 'Business Name is required');
                        isValid = false;
                    }

                    if (!brandNameInput.value.trim()) {
                        setError(brandNameInput, brandNameError, 'Brand Name is required');
                        isValid = false;
                    }

                    if (!businessDescribeInput.value.trim()) {
                        setError(businessDescribeInput, businessDescribeError, 'Business description is required');
                        isValid = false;
                    }

                    if (!businessCountrySelect.value) {
                        setError(businessCountrySelect, businessCountryError, 'Business Country is required');
                        isValid = false;
                    }

                    if (!businessStateSelect.value) {
                        setError(businessStateSelect, businessStateError, 'Business State is required');
                        isValid = false;
                    }

                    if (!businessCitySelect.value) {
                        setError(businessCitySelect, businessCityError, 'Business City is required');
                        isValid = false;
                    }

                    if (!ownFundInput.value.trim()) {
                        setError(ownFundInput, ownFundError, 'Own Fund is required');
                        isValid = false;
                    }

                    if (!loanInput.value.trim()) {
                        setError(loanInput, loanError, 'Loan is required');
                        isValid = false;
                    }

                    if (!marketCapitalInput.value.trim()) {
                        setError(marketCapitalInput, marketCapitalError, 'Fund Required is required');
                        isValid = false;
                    }

                    if (!yourStakeInput.value.trim()) {
                        setError(yourStakeInput, yourStakeError, 'Equity Offered is required');
                        isValid = false;
                    }

                    if (!stakeFundingInput.value.trim()) {
                        setError(stakeFundingInput, stakeFundingError, 'Company Valuation is required');
                        isValid = false;
                    }

                    if (businessLogoInput && !businessLogoInput.files.length) {
                        setError(businessLogoInput, businessLogoError, 'Business Logo is required');
                        isValid = false;
                    }
                } else {
                    // Registered Business Validation
                    if (!yBusinessNameInput.value.trim()) {
                        setError(yBusinessNameInput, yBusinessNameError, 'Business Name is required');
                        isValid = false;
                    }

                    if (!yBrandNameInput.value.trim()) {
                        setError(yBrandNameInput, yBrandNameError, 'Brand Name is required');
                        isValid = false;
                    }

                    if (!yDescribeBusinessInput.value.trim()) {
                        setError(yDescribeBusinessInput, yDescribeBusinessError,
                            'Business description is required');
                        isValid = false;
                    }

                    if (!yBusinessCountrySelect.value) {
                        setError(yBusinessCountrySelect, yBusinessCountryError, 'Business Country is required');
                        isValid = false;
                    }

                    if (!yBusinessStateSelect.value) {
                        setError(yBusinessStateSelect, yBusinessStateError, 'Business State is required');
                        isValid = false;
                    }

                    if (!yBusinessCitySelect.value) {
                        setError(yBusinessCitySelect, yBusinessCityError, 'Business City is required');
                        isValid = false;
                    }

                    if (!yOwnFundInput.value.trim()) {
                        setError(yOwnFundInput, yOwnFundError, 'Own Fund is required');
                        isValid = false;
                    }

                    if (!yLoanInput.value.trim()) {
                        setError(yLoanInput, yLoanError, 'Loan is required');
                        isValid = false;
                    }

                    if (!businessRevenue1Input.value.trim()) {
                        setError(businessRevenue1Input, businessRevenue1Error, 'Revenue from Sales is required');
                        isValid = false;
                    }

                    if (!businessRevenue2Input.value.trim()) {
                        setError(businessRevenue2Input, businessRevenue2Error, 'Gross Profit is required');
                        isValid = false;
                    }

                    if (!yMarketCapitalInput.value.trim()) {
                        setError(yMarketCapitalInput, yMarketCapitalError, 'Fund Required is required');
                        isValid = false;
                    }

                    if (!yYourStakeInput.value.trim()) {
                        setError(yYourStakeInput, yYourStakeError, 'Equity Offered is required');
                        isValid = false;
                    }

                    if (yBusinessLogoInput && !yBusinessLogoInput.files.length) {
                        setError(yBusinessLogoInput, yBusinessLogoError, 'Business Logo is required');
                        isValid = false;
                    }
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
                '{{ old('country', $enterprent->country ?? '') }}',
                '{{ old('state', $enterprent->state ?? '') }}');
            initCountryDropdown(businessCountrySelect, businessStateSelect, businessCitySelect,
                '{{ old('business_country', $enterprent->business_country ?? '') }}',
                '{{ old('business_state', $enterprent->business_state ?? '') }}');
            initCountryDropdown(yBusinessCountrySelect, yBusinessStateSelect, yBusinessCitySelect,
                '{{ old('y_business_country', $enterprent->y_business_country ?? '') }}',
                '{{ old('y_business_state', $enterprent->y_business_state ?? '') }}');

            // Update funding currency label based on active section
            function updateFundingCurrencyLabel() {
                const isRegistered = registerYes.checked;
                const selectedCountry = isRegistered ? (yBusinessCountrySelect?.value || '').trim().toUpperCase() :
                    (businessCountrySelect?.value || '').trim().toUpperCase();
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
            businessCountrySelect?.addEventListener('change', updateFundingCurrencyLabel);
            yBusinessCountrySelect?.addEventListener('change', updateFundingCurrencyLabel);

            // File upload and preview handler
            function previewImage(input, previewContainer, maxFiles = 1, errorElement) {
                const files = input.files;
                if (files.length > maxFiles) {
                    errorElement.textContent =
                        `You can only upload a maximum of ${maxFiles} file${maxFiles > 1 ? 's' : ''}.`;
                    errorElement.classList.remove('d-none');
                    input.value = '';
                    previewContainer.innerHTML = '';
                    return;
                }

                // Clear only the specific placeholder for single-file uploads (business logo)
                if (maxFiles === 1) {
                    previewContainer.innerHTML = '';
                }

                for (let i = 0; i < files.length; i++) {
                    const file = files[i];
                    const fileExtension = file.name.split('.').pop().toLowerCase();
                    const allowedExtensions = maxFiles === 1 ? ['jpg', 'jpeg', 'png'] : ['jpg', 'jpeg', 'png',
                        'gif'
                    ];

                    if (!allowedExtensions.includes(fileExtension)) {
                        errorElement.textContent = `Please upload only ${allowedExtensions.join(', ')} files.`;
                        errorElement.classList.remove('d-none');
                        input.value = '';
                        previewContainer.innerHTML = '';
                        return;
                    }

                    if (file.size > MAX_FILE_SIZE) {
                        errorElement.textContent = `File size exceeds 5MB limit.`;
                        errorElement.classList.remove('d-none');
                        input.value = '';
                        previewContainer.innerHTML = '';
                        return;
                    }

                    const reader = new FileReader();
                    reader.onload = function(e) {
                        // For single-file uploads (business logo), update the placeholder directly
                        if (maxFiles === 1) {
                            previewContainer.innerHTML = `
                    <img src="${e.target.result}" alt="Business Logo">
                    <button class="remove-btn" onclick="removeImage('${input.id}', '${previewContainer.id}')">×</button>
                `;
                            previewContainer.classList.add('has-image');
                        } else {
                            // For product photos, update the specific placeholder
                            const placeholder = document.getElementById(
                                `${input.id.split('_')[0]}-placeholder-${i + 1}`);
                            if (placeholder) {
                                placeholder.innerHTML = `
                        <img src="${e.target.result}" alt="Product Photo ${i + 1}">
                        <button class="remove-btn" onclick="removeProductImage(${i}, '${input.id.split('_')[0]}')">×</button>
                    `;
                                placeholder.classList.add('has-image');
                            }
                        }
                    };
                    reader.readAsDataURL(file);
                    errorElement.classList.add('d-none');
                    errorElement.textContent = '';
                }
            }

            // Business Logo (max 1)
            if (businessLogoInput) {
                businessLogoInput.addEventListener('change', function() {
                    previewImage(this, businessLogoPlaceholder, 1,
                        businessLogoError); // Updated to use businessLogoPlaceholder
                });
            }
            if (yBusinessLogoInput) {
                yBusinessLogoInput.addEventListener('change', function() {
                    previewImage(this, yBusinessLogoPlaceholder, 1,
                        yBusinessLogoError); // Updated to use yBusinessLogoPlaceholder
                });
            }

            // Product Photos (max 3)
            if (productPhotosInput) {
                productPhotosInput.addEventListener('change', function() {
                    previewImage(this, document.getElementById('product-placeholder-1'), 3,
                        productPhotosError); // Start with first placeholder
                });
            }
            if (yProductPhotosInput) {
                yProductPhotosInput.addEventListener('change', function() {
                    previewImage(this, document.getElementById('y-product-placeholder-1'), 3,
                        yProductPhotosError); // Start with first placeholder
                });
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
        });
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

        //image upload\
        let productImages = [];
        let businessLogoFile = null;

        // Business Logo Upload
        document.getElementById('business_logo').addEventListener('change', function(e) {
            const file = e.target.files[0];
            const placeholder = document.getElementById('logo-placeholder');
            const errorDiv = document.getElementById('business_logo_error');

            if (file) {
                // Validate file
                if (!validateFile(file, 'business_logo')) {
                    return;
                }

                businessLogoFile = file;
                const reader = new FileReader();

                reader.onload = function(e) {
                    placeholder.innerHTML = `
                        <img src="${e.target.result}" alt="Business Logo">
                        <button class="remove-btn" onclick="removeImage('business_logo', 'logo-placeholder')">×</button>
                    `;
                    placeholder.classList.add('has-image');
                    errorDiv.classList.add('d-none');
                };

                reader.readAsDataURL(file);
            }
        });

        let currentClickedSlot = 0;

        // Product Photos Upload
        document.getElementById('product_photos').addEventListener('change', function(e) {
            const files = Array.from(e.target.files);
            const errorDiv = document.getElementById('product_photos_error');

            if (files.length === 1) {
                // Single file upload - add to clicked slot
                const file = files[0];
                if (validateFile(file, 'product_photos')) {
                    productImages[currentClickedSlot] = file;
                    displayProductImage(file, currentClickedSlot);
                    errorDiv.classList.add('d-none');
                } else {
                    e.target.value = ''; // Clear input only on validation failure
                }
            } else if (files.length > 1) {
                // Multiple files - fill from first empty slot
                if (files.length > 3) {
                    showError('product_photos_error', 'Maximum 3 images allowed');
                    e.target.value = '';
                    return;
                }

                let slotIndex = 0;
                files.forEach((file) => {
                    if (slotIndex < 3 && validateFile(file, 'product_photos')) {
                        productImages[slotIndex] = file;
                        displayProductImage(file, slotIndex);
                        slotIndex++;
                    }
                });

                if (productImages.length > 0) {
                    errorDiv.classList.add('d-none');
                }
            }

            // Update file input
            updateProductPhotosInput();
        });
        // Function to update product_photos input
        function updateProductPhotosInput() {
            const input = document.getElementById('product_photos');
            const dataTransfer = new DataTransfer();
            productImages.filter(img => img !== undefined).forEach(file => {
                dataTransfer.items.add(file);
            });
            input.files = dataTransfer.files;
        }

        function validateFile(file, fieldName) {
            const maxSize = 5 * 1024 * 1024; // 5MB
            const allowedTypes = fieldName === 'business_logo' ? ['image/jpeg', 'image/jpg', 'image/png'] : ['image/jpeg',
                'image/jpg', 'image/png', 'image/gif'
            ];

            if (file.size > maxSize) {
                showError(fieldName + '_error', 'File size must be less than 5MB');
                return false;
            }

            if (!allowedTypes.includes(file.type)) {
                showError(fieldName + '_error', 'Invalid file type. Please select a valid image.');
                return false;
            }

            return true;
        }

        function displayProductImage(file, index) {
            const placeholder = document.getElementById(`product-placeholder-${index + 1}`);
            const reader = new FileReader();

            reader.onload = function(e) {
                placeholder.innerHTML = `
                    <img src="${e.target.result}" alt="Product Photo ${index + 1}">
                    <button class="remove-btn" onclick="removeProductImage(${index})">×</button>
                `;
                placeholder.classList.add('has-image');
            };

            reader.readAsDataURL(file);
        }

        function removeImage(inputId, placeholderId) {
            const input = document.getElementById(inputId);
            const placeholder = document.getElementById(placeholderId);

            input.value = '';
            placeholder.innerHTML = `
        <div class="placeholder-icon">📷</div>
        <button class="remove-btn" onclick="removeImage('${inputId}', '${placeholderId}')">×</button>
    `;
            placeholder.classList.remove('has-image');

            if (inputId === 'y_business_logo') {
                const existingLogo = document.getElementById('y-existing-logo');
                if (existingLogo.dataset.hasLogo === 'true') {
                    existingLogo.style.display = 'block';
                }
            }
        }

        // Update removeProductImage function to handle both product and y_product photos
        function removeProductImage(index) {
            delete productImages[index];

            const placeholder = document.getElementById(`product-placeholder-${index + 1}`);
            placeholder.innerHTML = `
        <div class="placeholder-icon">📸</div>
        <button class="remove-btn" onclick="removeProductImage(${index})">×</button>
    `;
            placeholder.classList.remove('has-image');

            // Update file input
            updateProductPhotosInput();
        }

        function clearProductPreviews() {
            for (let i = 1; i <= 3; i++) {
                const placeholder = document.getElementById(`product-placeholder-${i}`);
                placeholder.innerHTML = `
                    <div class="placeholder-icon">📸</div>
                    <button class="remove-btn" onclick="removeProductImage(${i-1})">×</button>
                `;
                placeholder.classList.remove('has-image');
            }
        }

        function showError(elementId, message) {
            const errorDiv = document.getElementById(elementId);
            errorDiv.textContent = message;
            errorDiv.classList.remove('d-none');
        }

        // Click handlers for placeholders
        document.getElementById('logo-placeholder').addEventListener('click', function() {
            document.getElementById('business_logo').click();
        });

        // Product photo placeholder click handlers
        document.getElementById('product-placeholder-1').addEventListener('click', function() {
            currentClickedSlot = 0;
            document.getElementById('product_photos').click();
        });

        document.getElementById('product-placeholder-2').addEventListener('click', function() {
            currentClickedSlot = 1;
            document.getElementById('product_photos').click();
        });

        document.getElementById('product-placeholder-3').addEventListener('click', function() {
            currentClickedSlot = 2;
            document.getElementById('product_photos').click();
        });

        // y product photos and lgo #
        let yCurrentClickedSlot = 0;
        let yProductImages = [];
        let yBusinessLogoFile = null;

        // Y Business Logo Upload
        document.getElementById('y_business_logo').addEventListener('change', function(e) {
            const file = e.target.files[0];
            const placeholder = document.getElementById('y-logo-placeholder');
            const errorDiv = document.getElementById('y_business_logo_error');

            if (file) {
                // Validate file
                if (!validateYFile(file, 'y_business_logo')) {
                    return;
                }

                yBusinessLogoFile = file;
                const reader = new FileReader();

                reader.onload = function(e) {
                    placeholder.innerHTML = `
                        <img src="${e.target.result}" alt="Business Logo">
                        <button class="remove-btn" onclick="removeYBusinessLogo()">×</button>
                    `;
                    placeholder.classList.add('has-image');
                    errorDiv.classList.add('d-none');

                    // Hide current logo when new one is uploaded
                    document.getElementById('y-existing-logo').style.display = 'none';
                };

                reader.readAsDataURL(file);
            }
        });

        // Y Product Photos Upload
        document.getElementById('y_product_photos').addEventListener('change', function(e) {
            const files = Array.from(e.target.files);
            const errorDiv = document.getElementById('y_product_photos_error');

            if (files.length === 1) {
                // Single file upload - add to clicked slot
                const file = files[0];
                if (validateYFile(file, 'y_product_photos')) {
                    yProductImages[yCurrentClickedSlot] = file;
                    displayYProductImage(file, yCurrentClickedSlot);
                    errorDiv.classList.add('d-none');

                    // Hide current photos when new ones are uploaded
                    document.getElementById('y-existing-photos').style.display = 'none';
                }
            } else if (files.length > 1) {
                // Multiple files - fill from first empty slot
                if (files.length > 3) {
                    showYError('y_product_photos_error', 'Maximum 3 images allowed');
                    e.target.value = ''; // Clear input only on error
                    return;
                }

                let slotIndex = 0;
                files.forEach((file) => {
                    if (slotIndex < 3 && validateYFile(file, 'y_product_photos')) {
                        yProductImages[slotIndex] = file;
                        displayYProductImage(file, slotIndex);
                        slotIndex++;
                    }
                });

                if (yProductImages.length > 0) {
                    errorDiv.classList.add('d-none');
                    document.getElementById('y-existing-photos').style.display = 'none';
                }
            }

            // Do NOT clear the input: e.target.value = '';
            // Instead, update the file input to reflect yProductImages
            updateYProductPhotosInput();
        });

        // Function to update y_product_photos input with files from yProductImages
        function updateYProductPhotosInput() {
            const input = document.getElementById('y_product_photos');
            const dataTransfer = new DataTransfer();
            yProductImages.filter(img => img !== undefined).forEach(file => {
                dataTransfer.items.add(file);
            });
            input.files = dataTransfer.files;
        }

        function validateYFile(file, fieldName) {
            const maxSize = 5 * 1024 * 1024; // 5MB
            const allowedTypes = fieldName === 'y_business_logo' ? ['image/jpeg', 'image/jpg', 'image/png'] : ['image/jpeg',
                'image/jpg', 'image/png', 'image/gif'
            ];

            if (file.size > maxSize) {
                showYError(fieldName + '_error', 'File size must be less than 5MB');
                return false;
            }

            if (!allowedTypes.includes(file.type)) {
                showYError(fieldName + '_error', 'Invalid file type. Please select a valid image.');
                return false;
            }

            return true;
        }

        function displayYProductImage(file, index) {
            const placeholder = document.getElementById(`y-product-placeholder-${index + 1}`);
            const reader = new FileReader();

            reader.onload = function(e) {
                placeholder.innerHTML = `
                    <img src="${e.target.result}" alt="Product Photo ${index + 1}">
                    <button class="remove-btn" onclick="removeYProductImage(${index})">×</button>
                `;
                placeholder.classList.add('has-image');
            };

            reader.readAsDataURL(file);
        }

        function removeYBusinessLogo() {
            const input = document.getElementById('y_business_logo');
            const placeholder = document.getElementById('y-logo-placeholder');
            const errorDiv = document.getElementById('y_business_logo_error');

            input.value = '';
            yBusinessLogoFile = null;
            placeholder.innerHTML = `
                <div class="placeholder-icon">📷</div>
                <button class="remove-btn" onclick="removeYBusinessLogo()">×</button>
            `;
            placeholder.classList.remove('has-image');
            errorDiv.classList.add('d-none');

            // Show current logo again if it exists
            const existingLogo = document.getElementById('y-existing-logo');
            if (existingLogo.dataset.hasLogo === 'true') {
                existingLogo.style.display = 'block';
            }
        }

        function removeYProductImage(index) {
            delete yProductImages[index];

            const placeholder = document.getElementById(`y-product-placeholder-${index + 1}`);
            placeholder.innerHTML = `
        <div class="placeholder-icon">📸</div>
        <button class="remove-btn" onclick="removeYProductImage(${index})">×</button>
    `;
            placeholder.classList.remove('has-image');

            // Update file input
            updateYProductPhotosInput();

            // Show current photos again if no new photos are uploaded
            const hasNewPhotos = yProductImages.some(img => img !== undefined);
            if (!hasNewPhotos) {
                const existingPhotos = document.getElementById('y-existing-photos');
                if (existingPhotos.dataset.hasPhotos === 'true') {
                    existingPhotos.style.display = 'block';
                }
            }
        }

        function showYError(elementId, message) {
            const errorDiv = document.getElementById(elementId);
            errorDiv.textContent = message;
            errorDiv.classList.remove('d-none');
        }

        // Click handlers for placeholders
        document.getElementById('y-logo-placeholder').addEventListener('click', function() {
            document.getElementById('y_business_logo').click();
        });

        // Y Product photo placeholder click handlers
        document.getElementById('y-product-placeholder-1').addEventListener('click', function() {
            yCurrentClickedSlot = 0;
            document.getElementById('y_product_photos').click();
        });

        document.getElementById('y-product-placeholder-2').addEventListener('click', function() {
            yCurrentClickedSlot = 1;
            document.getElementById('y_product_photos').click();
        });

        document.getElementById('y-product-placeholder-3').addEventListener('click', function() {
            yCurrentClickedSlot = 2;
            document.getElementById('y_product_photos').click();
        });

        // Functions to show existing files (call these if there are existing files)
        function showYExistingLogo(logoUrl) {
            const existingLogo = document.getElementById('y-existing-logo');
            const logoImg = document.getElementById('y-current-logo-img');
            const logoLink = document.getElementById('y-current-logo-link');

            if (logoUrl) {
                logoImg.src = logoUrl;
                logoLink.href = logoUrl;
                existingLogo.style.display = 'block';
                existingLogo.dataset.hasLogo = 'true';
            }
        }

        function showYExistingPhotos(photosArray) {
            const existingPhotos = document.getElementById('y-existing-photos');
            const photosContainer = document.getElementById('y-current-photos-container');

            if (photosArray && photosArray.length > 0) {
                photosContainer.innerHTML = '';
                photosArray.forEach((photoUrl, index) => {
                    const photoItem = document.createElement('div');
                    photoItem.className = 'existing-photo-item';
                    photoItem.innerHTML = `
                        <img src="${photoUrl}" alt="Product Photo ${index + 1}">
                        <small class="form-text text-muted">
                            <a href="${photoUrl}" target="_blank">View Photo ${index + 1}</a>
                        </small>
                    `;
                    photosContainer.appendChild(photoItem);
                });
                existingPhotos.style.display = 'block';
                existingPhotos.dataset.hasPhotos = 'true';
            }
        }
    </script>

@endsection
