@extends('layouts.admin')
<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/flatpickr/4.6.13/flatpickr.min.css">
<script src="https://cdnjs.cloudflare.com/ajax/libs/flatpickr/4.6.13/flatpickr.min.js"></script>
@section('title', 'Profile Update - Future Taikun')
<style>
    .business-stage-toggle {
        display: flex;
        gap: 8px;
        /* space between buttons */
    }

    .business-stage-toggle .btn {
        border-radius: 12px !important;
        /* rounded corners */
        /* Optional: increase padding for better look */
        padding: 0.375rem 1rem;
    }

    .industry-options,
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
    .geography-option,
    .investor-type-option,
    .investment-range-option,
    .funding-currency-option,
    .startup-stage-option {
        display: inline-block;
    }

    .industry-label,
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

    input[type="radio"]:checked+.industry-label:hover,
    input[type="checkbox"]:checked+.geography-label:hover,
    input[type="radio"]:checked+.investor-type-label:hover,
    input[type="radio"]:checked+.investment-range-label:hover,
    input[type="radio"]:checked+.funding-currency-label:hover,
    input[type="radio"]:checked+.startup-stage-label:hover {
        background-color: #FFE7EA;
        border-color: #FFE7EA;
        color: black;
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

    .image-preview-container img {
        margin-right: 10px;
        margin-bottom: 10px;
        border: 1px solid #ddd;
        border-radius: 4px;
    }

    .pdf-preview-container p {
        margin: 0;
        font-size: 0.9rem;
        color: #555;
    }

    .video-preview-container {
        display: flex;
        justify-content: center;
        align-items: center;
        border: 1px solid #ddd;
        border-radius: 4px;
        padding: 10px;
        background-color: #f9f9f9;
    }

    .video-preview-container video {
        max-width: 100%;
        max-height: 300px;
        object-fit: contain;
    }
</style>
@php
    $isApproved = $entrepreneur->approved == 1;
@endphp
@section('content')
    <div class="row justify-content-center">
        {{-- <div class="hero-section">
            <div class="hero-overlay">
                <div class="text-center text-white">
                    <h3>"We're connecting enterpuner with investore-shaping the future taikun"</h3>
                </div>
            </div>
        </div> --}}
        <div class="col-md-10 col-lg-8">
            <div class="card">
                <div class="card-body p-5">
                    <div class="text-center mb-4">
                        <div class="mb-3">
                            <i class="fas fa-lightbulb text-primary" style="font-size: 48px;"></i>
                        </div>
                        {{-- <h3>Profile Update</h3> --}}
                        {{-- <p class="text-muted">Tell us about yourself and your business idea</p> --}}
                    </div>
                    @if (!$isApproved)
                        <form action="{{ route('entrepreneur.update') }}" method="POST" enctype="multipart/form-data">
                            @csrf
                            <input type="hidden" name="user_id" value="{{ $user->id }}">
                    @endif

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
                                    placeholder="Type your name..." value="{{ old('full_name', $entrepreneur->full_name) }}"
                                    readonly>
                                <label for="full_name">Full Name *</label>
                                <div class="text-danger mt-1 d-none" id="full_name_error"></div>
                            </div>
                        </div>

                        {{-- <div class="col-md-6 mb-3">
                                <label class="form-label">Full Name *</label>
                                <input type="text" class="form-control" name="full_name" value="{{ old('full_name', $entrepreneur->full_name) }}"
                                    readonly>
                                @error('full_name')
                                    <div class="text-danger mt-1">{{ $message }}</div>
                                @enderror
                            </div> --}}

                        <div class="col-md-6 mb-3">
                            <div class="form-floating-custom">
                                <label class="form-label">Email Address *</label>
                                <input type="email" class="form-control" name="email"
                                    value="{{ old('email', $entrepreneur->email) }}" readonly>
                                @error('email')
                                    <div class="text-danger mt-1">{{ $message }}</div>
                                @enderror
                            </div>
                        </div>

                        <div class="col-md-6 mb-3">
                            <div class="input-group">
                                <select name="country_code" class="form-select" style="max-width: 120px;" readonly disabled>
                                    @foreach ($countries as $country)
                                        <option value="{{ $country['code'] }}"
                                            {{ old('country_code', $entrepreneur->country_code) == $country['code'] ? 'selected' : '' }}>
                                            {{ $country['name'] }} ({{ $country['code'] }})
                                        </option>
                                    @endforeach
                                </select>
                                <input type="tel" class="form-control" name="phone_number"
                                    placeholder="Enter mobile number" readonly
                                    value="{{ old('phone_number', $entrepreneur->phone_number) }}" maxlength="12"
                                    style="padding: 15px;">
                            </div>
                            <div class="text-danger mt-1 d-none" id="phone_number_error"></div>
                            <div class="text-danger mt-1 d-none" id="country_code_error"></div>
                            @error('phone_number')
                                <div class="text-danger mt-1">{{ $message }}</div>
                            @enderror
                            @error('country_code')
                                <div class="text-danger mt-1">{{ $message }}</div>
                            @enderror
                        </div>
                        {{-- <label class="form-label">Phone Number</label>
                                <input type="text" class="form-control" name="phone_number" value="{{ old('phone_number', $entrepreneur->phone_number) }}" readonly> --}}


                        <div class="col-md-6 mb-3">
                            <div class="form-floating-custom">
                                <input type="text" class="form-control" name="country" id="country" readonly
                                    value="{{ old('country', $entrepreneur->country) }}">
                                <label for="country">Country *</label>
                                @error('country')
                                    <div class="text-danger mt-1">{{ $message }}</div>
                                @enderror
                            </div>
                        </div>

                        <div class="col-md-6 mb-3">
                            <div class="form-floating-custom">
                                {{-- <select class="form-control" name="state" id="state" required>
                                        <option value="">Select State</option>
                                    </select> --}}
                                <input type="text" class="form-control" name="state" id="state" readonly
                                    value="{{ old('state', $entrepreneur->state) }}">
                                <label for="state">State *</label>
                                @error('state')
                                    <div class="text-danger mt-1">{{ $message }}</div>
                                @enderror
                            </div>
                        </div>

                        <div class="col-md-6 mb-3">
                            <div class="form-floating-custom">
                                {{-- <select class="form-control" name="city" id="city" required>
                                        <option value="">Select City</option>
                                    </select>
                                    <label for="city">City *</label> --}}
                                <input type="text" class="form-control" name="city" id="city" readonly
                                    value="{{ old('city', $entrepreneur->city) }}">
                                <label for="city">City *</label>
                                <div class="text-danger mt-1 d-none" id="city_error"></div>
                                @error('city')
                                    <div class="text-danger mt-1">{{ $message }}</div>
                                @enderror
                            </div>
                        </div>

                        <div class="col-md-6 mb-3">
                            <div class="form-floating-custom">
                                <input type="text" pattern="[0-9]{6}" inputmode="numeric" maxlength="6"
                                    class="form-control" name="pin_code"
                                    value="{{ old('pin_code', $entrepreneur->pin_code) }}"
                                    placeholder="Type your pin/zip code..." required>
                                <label for="pin_code">Pin/Zip Code *</label>
                                <div class="text-danger mt-1 d-none" id="pin_code_error"></div>
                                @error('pin_code')
                                    <div class="text-danger mt-1">{{ $message }}</div>
                                @enderror
                            </div>
                        </div>

                        <div class="col-md-6 mb-3">
                            <div class="form-floating-custom">
                                <input type="text" class="form-control" name="dob" id="dob" required
                                    value="{{ old('dob', $entrepreneur->dob) }}">
                                <label for="dob">Date of Birth *</label>
                                <div class="text-danger mt-1 d-none" id="dob_error"></div>
                                @error('dob')
                                    <div class="text-danger mt-1">{{ $message }}</div>
                                @enderror
                            </div>
                        </div>

                        <div class="col-md-6 mb-3">
                            <div class="form-group">
                                <div class="form-floating-custom">
                                    <select class="form-select" name="qualification" id="qualification" required>
                                        <option value="">Select Qualification</option>
                                        @foreach ($qualifications as $qualification)
                                            <option value="{{ $qualification }}"
                                                {{ old('qualification', $entrepreneur->qualification) == $qualification ? 'selected' : '' }}>
                                                {{ $qualification }}
                                            </option>
                                        @endforeach
                                    </select>
                                    <label for="qualification">Select Qualification *</label>
                                </div>
                                <div class="text-danger mt-1 d-none" id="qualification_error"></div>
                                @error('qualification')
                                    <div class="text-danger mt-1">{{ $message }}</div>
                                @enderror
                            </div>
                        </div>

                        <div class="col-md-6 mb-3">
                            <div class="form-floating-custom">
                                <input type="text" class="form-control" name="age" id="age"
                                    placeholder="Type your age..." readonly value="{{ old('age', $entrepreneur->age) }}">
                                <label for="age">Age</label>
                                @error('age')
                                    <div class="text-danger mt-1">{{ $message }}</div>
                                @enderror
                            </div>
                        </div>
                    </div>

                    <!-- Business Information -->
                    @if ($entrepreneur->register_business == 0)
                        <div class="row mb-4">
                            <div class="col-12">
                                <h5 class="mb-3">
                                    <i class="fas fa-building me-2"></i>Business Information
                                </h5>
                            </div>

                            <div class="col-md-6 mb-3">
                                <div class="form-floating-custom">
                                    <input type="text" class="form-control" name="business_name"
                                        value="{{ old('business_name', $entrepreneur->business_name) }}"
                                        placeholder="Type business name..." required>
                                    <label for="business_name">Business Idea Name *</label>
                                    <div class="text-danger mt-1 d-none" id="business_name_error"></div>
                                </div>
                            </div>

                            <div class="col-md-6 mb-3">
                                <div class="form-floating-custom">
                                    <input type="text" class="form-control" name="brand_name"
                                        value="{{ old('brand_name', $entrepreneur->brand_name) }}"
                                        placeholder="Type brand name..." required>
                                    <label for="brand_name">Business Brand Name *</label>
                                    <div class="text-danger mt-1 d-none" id="brand_name_error"></div>
                                </div>
                            </div>

                            <div class="col-md-6 mb-3">
                                <div class="form-floating-custom">
                                    <input type="text" class="form-control" name="business_address"
                                        value="{{ old('business_address', $entrepreneur->business_address) }}"
                                        placeholder="Type proposed business address..." required>
                                    <label for="proposed_business_address">Proposed Business Address *</label>
                                    <div class="text-danger mt-1 d-none" id="proposed_business_address_error"></div>
                                </div>
                            </div>

                            <div class="col-6 mb-3">
                                <div class="form-floating-custom">
                                    <textarea class="form-control" name="business_describe" rows="1" maxlength="75"
                                        placeholder="Type business describe...">{{ old('business_describe', $entrepreneur->business_describe) }}</textarea>
                                    <label for="business_describe">Describe Your Business in One Sentence *</label>
                                    <div class="text-danger mt-1 d-none" id="business_describe_error"></div>
                                </div>
                            </div>

                            <div class="col-md-6 mb-3">
                                <div class="form-floating-custom">
                                    <select name="business_country" class="form-select" id="business_country">
                                        <option value="">Select a country</option>
                                        <!-- Options will be dynamically populated by JavaScript -->
                                    </select>
                                    <label for="business_country">Business Country *</label>
                                    <div class="text-danger mt-1 d-none" id="business_country_error"></div>
                                </div>
                            </div>

                            <div class="col-md-6 mb-3">
                                <div class="form-floating-custom">
                                    <select class="form-control" name="business_state" id="business_state"
                                        data-selected="{{ old('business_state', $entrepreneur->business_state ?? '') }}">
                                        <option value="">Select State</option>
                                        <!-- Options will be dynamically populated by JavaScript -->
                                    </select>
                                    <label for="business_state">Business State *</label>
                                    <div class="text-danger mt-1 d-none" id="business_state_error"></div>
                                </div>
                            </div>

                            <div class="col-md-6 mb-3">
                                <div class="form-floating-custom">
                                    <select class="form-control" name="business_city" id="business_city"
                                        data-selected="{{ old('business_city', $entrepreneur->business_city ?? '') }}">
                                        <option value="">Select City</option>
                                        <!-- Options will be dynamically populated by JavaScript -->
                                    </select>
                                    <label for="business_city">Business City *</label>
                                    <div class="text-danger mt-1 d-none" id="business_city_error"></div>
                                </div>
                            </div>

                            {{-- Hidden script to set selected values --}}

                            <div class="col-md-6 mb-3">
                                <div class="form-group">
                                    <div class="form-floating-custom">
                                        <select class="form-select" name="industry" id="industry" required>
                                            <option value="">Select Industries</option>
                                            @foreach ($industries as $industry)
                                                <option value="{{ $industry }}"
                                                    {{ old('industry', $entrepreneur->industry) == $industry ? 'selected' : '' }}>
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
                                    <input type="number" class="form-control" name="own_fund"
                                        value="{{ old('own_fund', $entrepreneur->own_fund) }}"
                                        placeholder="Type own fund amount..." required>
                                    <label for="own_fund">Own Fund <span class="funding_currency_label">()</span>*</label>
                                    <div class="text-danger mt-1 d-none" id="own_fund_error"></div>

                                </div>
                            </div>

                            <div class="col-md-4 mb-3">
                                <div class="form-floating-custom">
                                    <input type="number" class="form-control" name="loan"
                                        value="{{ old('loan', $entrepreneur->loan) }}" placeholder="Type loan..."
                                        required>
                                    <label for="loan">Loan *</label>
                                    <div class="text-danger mt-1 d-none" id="loan_error"></div>

                                </div>
                            </div>

                            <div class="col-md-4 mb-3">
                                <div class="form-floating-custom">
                                    <input type="text" class="form-control" name="invested_amount"
                                        id="invested_amount" readonly
                                        value="{{ old('invested_amount', $entrepreneur->invested_amount) }}">
                                    <label for="invested_amount">Invested Amount <span
                                            class="funding_currency_label">()</span></label>
                                    <div class="text-danger mt-1 d-none" id="invested_amount_error"></div>

                                </div>
                            </div>

                            <div class="col-md-4 mb-3">
                                <div class="form-floating-custom">
                                    <input type="number" class="form-control investment" name="market_capital"
                                        id="market_capital" min="1" step="0.01"
                                        value="{{ old('market_capital', $entrepreneur->market_capital) }}"
                                        placeholder="Type your fund required for business idea..." required>
                                    <label for="market_capital">
                                        <span id="funding_label_text">Fund Required for Business Idea</span>
                                        <span class="funding_currency_label">()</span>
                                    </label>
                                    <div class="text-danger mt-1 d-none" id="market_capital_error"></div>

                                </div>
                            </div>

                            <div class="col-md-4 mb-3">
                                <div class="form-floating-custom">
                                    <input type="number" class="form-control equity" name="your_stake" id="your_stake"
                                        min="1" max="100" step="0.01"
                                        value="{{ old('your_stake', $entrepreneur->your_stake) }}"
                                        placeholder="Type your equity offered (percentage)..." required>
                                    <label for="your_stake">Equity Offered (Percentage)</label>
                                    <div class="text-danger mt-1 d-none" id="your_stake_error"></div>

                                </div>
                            </div>

                            <div class="col-md-4 mb-3">
                                <div class="form-floating-custom">
                                    <input type="number" class="form-control valuation" id="stake_funding"
                                        name="stake_funding" readonly
                                        value="{{ old('stake_funding', $entrepreneur->stake_funding) }}">
                                    <label for="stake_funding">Company Valuation <span
                                            class="funding_currency_label">()</span></label>
                                    <div class="text-danger mt-1 d-none" id="stake_funding_error"></div>

                                </div>
                            </div>

                            <div class="col-12 mb-3">
                                <label for="business_logo" class="form-label">Upload Business Logo</label>
                                <div class="file-upload-wrapper">
                                    <input class="form-control" type="file" id="business_logo" name="business_logo"
                                        accept=".jpg,.jpeg,.png">
                                    <label for="business_logo" class="file-upload-label w-100">
                                        <i class="fas fa-upload me-2"></i>Choose Image file...(jpg,png,jpeg)
                                    </label>
                                </div>
                                <div id="business_logo_preview" class="image-preview-container mt-2"></div>
                                <div class="text-danger mt-1 d-none" id="business_logo_error"></div>

                            </div>

                            <div class="col-12 mb-3">
                                <label for="product_photos" class="form-label">Upload Products Photos</label>
                                <div class="file-upload-wrapper">
                                    <input class="form-control" type="file" id="product_photos"
                                        name="product_photos[]" accept=".jpg,.jpeg,.png" multiple
                                        style="display: block !important; visibility: visible !important; opacity: 1 !important;">
                                    <label for="product_photos" class="file-upload-label w-100">
                                        <i class="fas fa-upload me-2"></i>Choose Image files...(jpg,png,jpeg)
                                    </label>
                                </div>
                                <div id="product_photos_preview"
                                    class="image-preview-container mt-2 d-flex flex-wrap gap-2"></div>
                                <div class="text-danger mt-1 d-none" id="product_photos_error"></div>
                                <small class="text-muted">Select 1-3 images (JPG, JPEG, PNG only, max 5MB each)</small>

                            </div>

                            <div class="col-12 mb-3">
                                <label for="pitch_deck" class="form-label">Upload Business Summary</label>
                                <div class="file-upload-wrapper">
                                    <input class="form-control" type="file" id="pitch_deck" name="pitch_deck"
                                        accept=".pdf">
                                    <label for="pitch_deck" class="file-upload-label w-100">
                                        <i class="fas fa-upload me-2"></i>Choose PDF file...(PDF, max 10MB)
                                    </label>
                                </div>
                                <div id="pitch_deck_preview" class="pdf-preview-container mt-2"></div>
                                <div class="text-danger mt-1 d-none" id="pitch_deck_error"></div>

                            </div>

                            <div class="col-12 mb-3">
                                <div class="form-floating-custom">
                                    <label for="video_upload" class="form-label">Upload Pitch Video</label>
                                    <input type="file" class="form-control" id="video_upload" name="video_upload"
                                        accept="video/mp4,video/x-m4v,video/avi,video/webm">
                                    <div class="text-danger mt-1 d-none" id="video_upload_error"></div>
                                    <small class="text-muted">Upload one video file (MP4, AVI, or WebM)</small>
                                    <input type="hidden" id="existing_video_url"
                                        value="{{ $entrepreneur->video_upload ?? '' }}">
                                    <div id="video_upload_preview" class="video-preview-container mt-2"></div>
                                </div>
                            </div>
                        </div>
                    @endif

                    {{-- yes business  --}}
                    @if ($entrepreneur->register_business == 1)
                        <div class="row mb-4">
                            <div class="col-12">
                                <h5 class="mb-3">
                                    <i class="fas fa-building me-2"></i>Business Information
                                </h5>
                            </div>
                            <div class="col-md-6 mb-3">
                                <div class="form-floating-custom">
                                    <input type="text" class="form-control" name="y_business_name"
                                        value="{{ old('y_business_name', $entrepreneur->y_business_name) }}"
                                        placeholder="Type your business name..." required>
                                    <label class="form-label" id="y_business_name_label">Business Name
                                        *</label>
                                    <div class="text-danger mt-1 d-none" id="y_business_name_error"></div>
                                </div>
                            </div>

                            <div class="col-md-6 mb-3">
                                <div class="form-floating-custom">
                                    <input type="text" class="form-control" name="y_brand_name"
                                        value="{{ old('y_brand_name', $entrepreneur->y_brand_name) }}"
                                        placeholder="Type your brand name..." required>
                                    <label class="form-label" id="y_brand_name_label">Business Brand Name
                                        *</label>
                                    <div class="text-danger mt-1 d-none" id="y_brand_name_error"></div>
                                </div>
                            </div>

                            <div class="col-md-6 mb-3">
                                <div class="form-floating-custom">
                                    <label class="form-label">Describe Your Business in One Sentence *</label>
                                    <textarea class="form-control" name="y_describe_business" rows="1" maxlength="75"
                                        value="{{ old('y_describe_business', $entrepreneur->y_describe_business) }}"
                                        placeholder="Type business describe...">{{ old('y_describe_business', $entrepreneur->y_describe_business) }}</textarea>
                                    <div class="text-danger mt-1 d-none" id="y_describe_business_error"></div>
                                </div>
                            </div>

                            <div class="col-6 mb-3">
                                <div class="form-floating-custom">
                                    <label class="form-label">Business Address *</label>
                                    <textarea class="form-control" name="y_business_address" rows="1" placeholder="Type business describe...">{{ old('y_business_address', $entrepreneur->y_business_address) }}</textarea>
                                    <div class="text-danger mt-1 d-none" id="y_business_address_error"></div>
                                </div>
                            </div>

                            {{-- <div class="col-md-6 mb-3">
                                <div class="form-floating-custom">
                                    <input type="text" class="form-control" name="y_business_country"
                                        id="y_business_country" readonly
                                        value="{{ old('y_business_country', $entrepreneur->y_business_country) }}">
                                    <label for="y_business_country">Business Country *</label>
                                    <div class="text-danger mt-1 d-none" id="y_business_country_error"></div>
                                </div>
                            </div> --}}

                            <div class="col-md-6 mb-3">
                                <div class="form-floating-custom">
                                    <select name="y_business_country" class="form-select" id="y_business_country">
                                        <option value="">Select a country</option>
                                        <!-- Options will be dynamically populated by JavaScript -->
                                    </select>
                                    <label for="y_business_country">Y Business Country *</label>
                                    <div class="text-danger mt-1 d-none" id="y_business_country_error"></div>
                                </div>
                            </div>

                            <div class="col-md-6 mb-3">
                                <div class="form-floating-custom">
                                    <select class="form-control" name="y_business_state" id="y_business_state"
                                        data-selected="{{ old('y_business_state', $entrepreneur->y_business_state ?? '') }}">
                                        <option value="">Select State</option>
                                        <!-- Options will be dynamically populated by JavaScript -->
                                    </select>
                                    <label for="y_business_state">Y Business State *</label>
                                    <div class="text-danger mt-1 d-none" id="y_business_state_error"></div>
                                </div>
                            </div>

                            <div class="col-md-6 mb-3">
                                <div class="form-floating-custom">
                                    <select class="form-control" name="y_business_city" id="y_business_city"
                                        data-selected="{{ old('y_business_city', $entrepreneur->y_business_city ?? '') }}">
                                        <option value="">Select City</option>
                                        <!-- Options will be dynamically populated by JavaScript -->
                                    </select>
                                    <label for="y_business_city">Y Business City *</label>
                                    <div class="text-danger mt-1 d-none" id="y_business_city_error"></div>
                                </div>
                            </div>
                            {{-- <div class="col-md-6 mb-3">
                                <div class="form-floating-custom">
                                    <input type="text" class="form-control" name="y_business_state"
                                        id="y_business_state" readonly
                                        value="{{ old('y_business_state', $entrepreneur->y_business_state) }}">
                                    <label for="y_business_state">Business State *</label>
                                    <div class="text-danger mt-1 d-none" id="business_state_error"></div>

                                </div>
                            </div>

                            <div class="col-md-6 mb-3">
                                <div class="form-floating-custom">
                                    <input type="text" class="form-control" name="y_business_city"
                                        id="y_business_city" readonly
                                        value="{{ old('y_business_city', $entrepreneur->y_business_city) }}">
                                    <label for="y_business_city">Business City *</label>
                                    <div class="text-danger mt-1 d-none" id="y_business_city_error"></div>

                                </div>
                            </div> --}}

                            <div class="col-md-6 mb-3">
                                <div class="form-floating-custom">
                                    <input type="text" class="form-control" name="y_zipcode"
                                        value="{{ old('y_zipcode', $entrepreneur->y_zipcode) }}"
                                        placeholder="Type your pin / zipcode..." required>
                                    <label class="form-label" id="y_zipcode_label">Business Pin / Zip Code *</label>
                                </div>
                            </div>

                            <div class="col-md-6 mb-3">
                                <div class="input-group">
                                    <select name="business_country_code" class="form-select" style="max-width: 120px;"
                                        readonly disabled>
                                        @foreach ($countries as $country)
                                            <option value="{{ $country['code'] }}"
                                                {{ old('business_country_code', $entrepreneur->business_country_code) == $country['code'] ? 'selected' : '' }}>
                                                {{ $country['name'] }} ({{ $country['code'] }})
                                            </option>
                                        @endforeach
                                    </select>
                                    <input type="tel" class="form-control" name="business_mobile"
                                        placeholder="Enter mobile number" readonly
                                        value="{{ old('business_mobile', $entrepreneur->business_mobile) }}"
                                        maxlength="12" style="padding: 15px;">
                                </div>
                                <div class="text-danger mt-1 d-none" id="business_mobile_error"></div>
                                <div class="text-danger mt-1 d-none" id="business_country_error"></div>
                            </div>

                            <div class="col-md-6 mb-3">
                                <div class="form-floating-custom">
                                    <label class="form-label">Business Email</label>
                                    <input type="text" class="form-control" name="business_email" id="business_email"
                                        value="{{ old('business_email', $entrepreneur->business_email) }}"
                                        placeholder="Type your business mobile number...">
                                    <div class="text-danger mt-1 d-none" id="business_email_error"></div>
                                </div>
                            </div>

                            <div class="col-md-6 mb-3">
                                <div class="form-floating-custom">
                                    <input type="url" class="form-control" name="website_links"
                                        value="{{ old('website_links', $entrepreneur->website_links) }}"
                                        placeholder="https://your-website.com">
                                    <div class="text-danger mt-1 d-none" id="website_links_error"></div>
                                    <label class="form-label">Website / Social Links</label>
                                </div>
                            </div>

                            <div class="col-md-6 mb-3">
                                <div class="form-floating-custom">
                                    <label class="form-label">Business Started Year *</label>
                                    <select class="form-control" name="business_year" id="business_year">
                                        <option value="">Select Year</option>
                                        <!-- Will be populated dynamically -->
                                    </select>
                                    <div class="text-danger mt-1 d-none" id="business_year_error"></div>
                                </div>
                            </div>

                            <div class="col-md-6 mb-3">
                                <div class="form-floating-custom">
                                    <label class="form-label">Years in Business</label>
                                    <input type="text" class="form-control" name="business_year_count"
                                        value="{{ old('business_year_count', $entrepreneur->business_year_count) }}"
                                        id="business_year_count" readonly placeholder="Business year count...">
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
                                                    {{ old('registration_type_of_entity', $entrepreneur->registration_type_of_entity) == $registratiotype ? 'selected' : '' }}>
                                                    {{ $registratiotype }}
                                                </option>
                                            @endforeach
                                        </select>
                                        {{-- <label class="form-label">Select Entity Type *</label> --}}
                                        <div class="text-danger mt-1 d-none" id="registration_type_of_entity_error">
                                        </div>
                                    </div>
                                </div>
                            </div>

                            <div class="col-md-6 mb-3">
                                <div class="form-floating-custom">
                                    <label class="form-label">Business Tax Registration Number *</label>
                                    <input type="text" class="form-control" name="tax_registration_number"
                                        value="{{ old('tax_registration_number', $entrepreneur->tax_registration_number) }}"
                                        id="tax_registration_number"
                                        placeholder="Type business tax registration number...">
                                    <div class="text-danger mt-1 d-none" id="tax_registration_number_error">
                                    </div>
                                </div>
                            </div>

                            <div class="col-md-6 mb-3">
                                <div class="form-floating-custom">
                                    <label class="form-label">Type of Industries *</label>
                                    <select class="form-select" id="y_type_industries" name="y_type_industries">
                                        <option value="">Select Industry</option>
                                        @foreach ($industries as $industry)
                                            <option value="{{ $industry }}"
                                                {{ old('y_type_industries', $entrepreneur->y_type_industries) == $industry ? 'selected' : '' }}>
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
                                        value="{{ old('founder_number', $entrepreneur->founder_number) }}" min="1"
                                        max="20" placeholder="Type number of founder...">
                                    <div class="text-danger mt-1 d-none" id="founder_number_error"></div>
                                </div>
                            </div>

                            <div class="col-md-6 mb-3">
                                <div class="form-floating-custom">
                                    <label class="form-label">Number of Employee *</label>
                                    <input type="number" class="form-control" name="employee_number"
                                        value="{{ old('employee_number', $entrepreneur->employee_number) }}"
                                        min="1" max="10000000" placeholder="Type number of employee...">
                                    <div class="text-danger mt-1 d-none" id="employee_number_error"></div>
                                </div>
                            </div>

                            <div class="col-md-4 mb-3">
                                <div class="form-floating-custom">
                                    <label class="form-label">Own Fund <span
                                            class="funding_currency_label">()</span>*</label>
                                    <input type="number" class="form-control" name="y_own_fund"
                                        value="{{ old('y_own_fund', $entrepreneur->y_own_fund) }}"
                                        placeholder="Type own fund amount...">
                                    <div class="text-danger mt-1 d-none" id="y_own_fund_error"></div>
                                </div>
                            </div>

                            <div class="col-md-4 mb-3">
                                <div class="form-floating-custom">
                                    <label class="form-label">Loan <span class="funding_currency_label">()</span>*</label>
                                    <input type="number" class="form-control" name="y_loan"
                                        value="{{ old('y_loan', $entrepreneur->y_loan) }}" placeholder="Type loan...">
                                    <div class="text-danger mt-1 d-none" id="y_loan_error"></div>
                                </div>
                            </div>

                            <div class="col-md-4 mb-3">
                                <div class="form-floating-custom">
                                    <label class="form-label">Total Invested Amount<span
                                            class="funding_currency_label">()</span></label>
                                    <input type="text" class="form-control" name="y_invested_amount"
                                        value="{{ old('y_invested_amount', $entrepreneur->y_invested_amount) }}"
                                        id="y_invested_amount" placeholder="Type your invested amount..." readonly>
                                    <div class="text-danger mt-1 d-none" id="y_invested_amount_error"></div>
                                </div>
                            </div>


                            <div class="col-12 mb-3">
                                <h6 class="mb-3" style="color: black; font-weight:bold;">
                                    Financial Data of Last Three years<span class="funding_currency_label">()</span>
                                </h6>
                            </div>

                            <div class="col-md-4 mb-3">
                                <div class="form-floating-custom">
                                    <label class="form-label">Revenue from Sales<span
                                            class="funding_currency_label">()</span></label>
                                    <input type="number" class="form-control" name="business_revenue1"
                                        value="{{ old('business_revenue1', $entrepreneur->business_revenue1) }}"
                                        min="0" step="0.01"
                                        placeholder="Type your revenue from sales revenue...">
                                    <div class="text-danger mt-1 d-none" id="business_revenue1_error"></div>
                                </div>
                            </div>

                            <div class="col-md-4 mb-3">
                                <div class="form-floating-custom">
                                    <label class="form-label">Gross Profit<span
                                            class="funding_currency_label">()</span></label>
                                    <input type="number" class="form-control" name="business_revenue2"
                                        value="{{ old('business_revenue2', $entrepreneur->business_revenue2) }}"
                                        min="0" step="0.01" placeholder="Type your gross profit...">
                                    <div class="text-danger mt-1 d-none" id="business_revenue2_error"></div>
                                </div>
                            </div>

                            <div class="col-md-4 mb-3">
                                <div class="form-floating-custom">
                                    <label class="form-label">Net Profit<span
                                            class="funding_currency_label">()</span></label>
                                    <input type="number" class="form-control" name="business_revenue3"
                                        value="{{ old('business_revenue3', $entrepreneur->business_revenue3) }}"
                                        min="0" step="0.01" placeholder="Type your net profit...">
                                    <div class="text-danger mt-1 d-none" id="business_revenue3_error"></div>
                                </div>
                            </div>

                            <div class="col-md-4 mb-3">
                                <div class="form-floating-custom">
                                    {{-- <label class="form-label" id="funding_label">Fund Required for Proposed Business Idea<span class="funding_currency_label">()</span></label> --}}
                                    <label class="form-label">
                                        <span id="funding_label_text">Fund Required for Current Business
                                            Idea</span>
                                        <span class="funding_currency_label">()</span>
                                    </label>
                                    <input type="number" class="form-control investment" name="y_market_capital"
                                        id="y_market_capital" min="1" step="0.01"
                                        value="{{ old('y_market_capital', $entrepreneur->y_market_capital) }}"
                                        placeholder="Type your fund required for business idea...">
                                    <div class="text-danger mt-1 d-none" id="y_market_capital_error"></div>
                                </div>
                            </div>


                            <div class="col-md-4 mb-3">
                                <div class="form-floating-custom">
                                    <label class="form-label">Equity Offered (Percentage)</label>
                                    <input type="number" class="form-control equity" name="y_your_stake"
                                        id="y_your_stake" placeholder="Type your equity offered (percentage)..."
                                        min="1" max="100" step="0.01"
                                        value="{{ old('y_your_stake', $entrepreneur->y_your_stake) }}">
                                    <div class="text-danger mt-1 d-none" id="y_your_stake_error"></div>
                                </div>
                            </div>


                            {{-- <div class="col-md-4 mb-3">
                                <div class="form-floating-custom">
                                    <label class="form-label">Company Valuation<span
                                            class="funding_currency_label">()</span></label>
                                    <input type="number" class="form-control valuation" id="y_stake_funding"
                                        name="y_stake_funding"
                                        value="{{ old('y_stake_funding', $entrepreneur->y_stake_funding) }}"
                                        placeholder="Type your company valuation..." readonly>
                                    <div class="text-danger mt-1 d-none" id="y_stake_funding_error"></div>
                                </div>
                            </div> --}}
                            <div class="col-md-4 mb-3">
                                <div class="form-floating-custom">
                                    <input type="number" class="form-control valuation" id="y_stake_funding"
                                        name="y_stake_funding" readonly
                                        value="{{ old('stake_funding', $entrepreneur->y_stake_funding) }}">
                                    <label for="y_stake_funding">Company Valuation <span
                                            class="funding_currency_label">()</span></label>
                                    <div class="text-danger mt-1 d-none" id="y_stake_funding_error"></div>

                                </div>
                            </div>

                            <div class="col-12 mb-3">
                                {{-- <div class="form-floating-custom"> --}}
                                <label for="y_pitch_deck" class="form-label">Upload Business Logo</label>
                                <div class="file-upload-wrapper">
                                    <input class="form-control" type="file" id="y_business_logo"
                                        name="y_business_logo">
                                    <label for="y_business_logo" class="file-upload-label w-100">
                                        <i class="fas fa-upload me-2"></i>Choose Image file...(jpg,png,jpeg)
                                    </label>
                                </div>
                                <div id="y_business_logo_preview" class="image-preview-container mt-2"></div>
                                <div class="text-danger mt-1 d-none" id="y_business_logo_error"></div>
                                {{-- </div> --}}
                            </div>


                            <div class="col-12 mb-3">
                                <label for="y_product_photos" class="form-label">Upload Products
                                    Photos</label>
                                <div class="file-upload-wrapper">
                                    <input class="form-control" type="file" id="y_product_photos"
                                        name="y_product_photos[]" accept=".jpg,.jpeg,.png,.gif" multiple
                                        style="display: block !important; visibility: visible !important; opacity: 1 !important;">
                                    <label for="y_product_photos" class="file-upload-label w-100">
                                        <i class="fas fa-upload me-2"></i>Choose Image files...(jpg,png,jpeg)
                                    </label>
                                </div>
                                <div id="y_product_photos_preview"
                                    class="image-preview-container mt-2 d-flex flex-wrap gap-2"></div>
                                <div class="text-danger mt-1 d-none" id="y_product_photos_error"></div>
                                <small class="text-muted">Select 1-3 images (JPG, JPEG, PNG only, max 5MB
                                    each)</small>
                            </div>

                            <div class="col-12 mb-3">
                                {{-- <div class="form-floating-custom"> --}}
                                <label for="y_pitch_deck" class="form-label">Upload Business Summary</label>
                                <div class="file-upload-wrapper">
                                    <input class="form-control" type="file" id="y_pitch_deck" name="y_pitch_deck"
                                        accept=".pdf">
                                    <label for="y_pitch_deck" class="file-upload-label w-100">
                                        <i class="fas fa-upload me-2"></i>Choose PDF file...(PDF, max 10MB)
                                    </label>
                                </div>
                                <div id="y_pitch_deck_preview" class="pdf-preview-container mt-2"></div>
                                <div class="text-danger mt-1 d-none" id="y_pitch_deck_error"></div>
                            </div>


                            <div class="col-12 mb-3">
                                <div class="form-floating-custom">
                                    <label for="video_upload" class="form-label">Upload Pitch Video</label>
                                    <input type="file" class="form-control" id="video_upload" name="video_upload"
                                        accept="video/mp4,video/x-m4v,video/avi,video/webm">
                                    <div class="text-danger mt-1 d-none" id="video_upload_error"></div>
                                    <small class="text-muted">Upload one video file (MP4, AVI, or WebM, max 50MB)</small>
                                    <input type="hidden" id="existing_video_url"
                                        value="{{ $entrepreneur->video_upload ?? '' }}">
                                    <div id="video_upload_preview" class="video-preview-container mt-2"></div>
                                </div>
                            </div>

                        </div>
                    @endif
                    {{-- end business yes --}}

                    <!-- Terms and Conditions -->


                    {{-- <div class="d-flex flex-column flex-sm-row gap-3">
                        <a href="{{ route('choose.role', $user->id) }}" class="btn btn-outline-secondary flex-fill">
                            <i class="fas fa-arrow-left me-2"></i>Back
                        </a>
                        <button type="submit" class="btn btn flex-fill"
                            style="background-color: #2EA9B9; color: white;">
                            <i class="fas fa-check me-2"></i>Update Profile
                        </button>
                    </div> --}}

                    @if (!$isApproved)
                        <div class="mb-4">
                            <div class="form-check">
                                <input class="form-check-input" type="checkbox" name="agreed_to_terms"
                                    id="agreed_to_terms" required>
                                <label class="form-check-label" for="agreed_to_terms">
                                    I agree to the <a href="#" class="text-primary">Terms and Conditions</a> and <a
                                        href="#" class="text-primary">Privacy Policy</a> *
                                </label>
                                {{-- @error('agreed_to_terms')
                                    <div class="text-danger mt-1">{{ $message }}</div>
                                @enderror --}}
                            </div>
                        </div>
                        <div class="d-flex flex-column flex-sm-row gap-3">
                            <a href="{{ route('choose.role', $user->id) }}" class="btn btn-outline-secondary flex-fill">
                                <i class="fas fa-arrow-left me-2"></i>Back
                            </a>
                            <button type="submit" class="btn btn flex-fill"
                                style="background-color: #2EA9B9; color: white;">
                                <i class="fas fa-check me-2"></i>Update Profile
                            </button>
                            </form>
                        </div>
                    @else
                        <div class="text-center mt-4">
                            <p class="text-muted">
                                <i class="fas fa-info-circle me-2"></i>
                                Profile is approved and cannot be edited.
                            </p>
                        </div>
                    @endif
                    </form>
                </div>
            </div>
        </div>
    </div>
@endsection
@section('scripts')
    <script>
        document.addEventListener('DOMContentLoaded', function() {
            const videoUploadInput = document.getElementById('video_upload');
            const videoPreviewContainer = document.getElementById('video_upload_preview');
            const videoError = document.getElementById('video_upload_error');
            const existingVideoUrl = document.getElementById('existing_video_url')?.value;

            // Function to display video in preview
            function displayVideo(src) {
                videoPreviewContainer.innerHTML = ''; // Clear existing preview
                const videoElement = document.createElement('video');
                videoElement.controls = true;
                videoElement.style.maxWidth = '100%';
                videoElement.style.maxHeight = '300px';
                videoElement.src = src;
                videoPreviewContainer.appendChild(videoElement);
            }

            // Display existing video from database (BunnyCDN URL) if it exists
            if (existingVideoUrl) {
                displayVideo(existingVideoUrl);
            }

            // Handle new video upload
            videoUploadInput?.addEventListener('change', function() {
                // Clear previous errors
                videoError.classList.add('d-none');
                videoError.textContent = '';

                const file = this.files[0];
                if (!file) {
                    // If no file is selected, restore existing video (if any)
                    videoPreviewContainer.innerHTML = '';
                    if (existingVideoUrl) displayVideo(existingVideoUrl);
                    return;
                }

                // Validate file type
                const allowedTypes = ['video/mp4', 'video/x-m4v', 'video/avi', 'video/webm'];
                if (!allowedTypes.includes(file.type)) {
                    videoError.textContent = 'Please upload a valid video file (MP4, AVI, or WebM).';
                    videoError.classList.remove('d-none');
                    this.value = ''; // Clear the input
                    videoPreviewContainer.innerHTML = ''; // Clear preview
                    if (existingVideoUrl) displayVideo(existingVideoUrl); // Restore existing video
                    return;
                }

                // Validate file size (50MB limit)
                const maxSize = 50 * 1024 * 1024; // 50MB in bytes
                if (file.size > maxSize) {
                    videoError.textContent = 'Video file size exceeds 50MB limit.';
                    videoError.classList.remove('d-none');
                    this.value = ''; // Clear the input
                    videoPreviewContainer.innerHTML = ''; // Clear preview
                    if (existingVideoUrl) displayVideo(existingVideoUrl); // Restore existing video
                    return;
                }

                // Create video preview for new file
                const videoSrc = URL.createObjectURL(file);
                displayVideo(videoSrc);

                // Clean up the object URL when the video is no longer needed
                const videoElement = videoPreviewContainer.querySelector('video');
                videoElement.onloadeddata = () => {
                    URL.revokeObjectURL(videoSrc);
                };
            });
        });
        document.addEventListener('DOMContentLoaded', function() {
            // Pass already uploaded file paths from Laravel to JavaScript
            const existingFiles = {
                businessLogo: @json(
                    $entrepreneur->register_business == 1
                        ? $entrepreneur->y_business_logo ?? null
                        : $entrepreneur->business_logo ?? null),
                productPhotos: @json($entrepreneur->register_business == 1 ? $entrepreneur->y_product_photos ?? [] : $entrepreneur->product_photos ?? []),
                pitchDeck: @json($entrepreneur->register_business == 1 ? $entrepreneur->y_pitch_deck ?? null : $entrepreneur->pitch_deck ?? null),
                registerBusiness: @json($entrepreneur->register_business ?? 0)
            };

            console.log('Existing files:', existingFiles);

            const productPhotosArray = Array.isArray(existingFiles.productPhotos) ?
                existingFiles.productPhotos :
                typeof existingFiles.productPhotos === 'string' ?
                JSON.parse(existingFiles.productPhotos || '[]') : [];

            console.log('Product photos (raw):', existingFiles.productPhotos);
            console.log('Product photos (normalized):', productPhotosArray);

            const storageBaseUrl = 'http://127.0.0.1:8000/storage/'; // Updated to match your local environment

            // Mapping of fields to their respective folders
            const folderMap = {
                businessLogo: existingFiles.registerBusiness === 1 ? 'y_business_logos' : 'business_logos',
                productPhotos: existingFiles.registerBusiness === 1 ? 'y_product_photos' : 'product_photos',
                pitchDeck: existingFiles.registerBusiness === 1 ? 'y_pitch_decks' : 'pitch_decks'
            };

            // Investment calculation based on register_business
            const isRegistered = existingFiles.registerBusiness === 1;
            console.log('register_business:', existingFiles.registerBusiness);

            // Non-prefixed fields (register_business = 0)
            const ownFundInput = document.querySelector('input[name="own_fund"]');
            const loanInput = document.querySelector('input[name="loan"]');
            const investedAmountInput = document.querySelector('input[name="invested_amount"]');
            console.log('own_fund Input:', ownFundInput);
            console.log('loan Input:', loanInput);
            console.log('invested_amount Input:', investedAmountInput);

            if (!isRegistered && ownFundInput && loanInput && investedAmountInput) {
                function calculateInvestedAmount() {
                    const ownFund = parseFloat(ownFundInput.value) || 0;
                    const loan = parseFloat(loanInput.value) || 0;
                    const total = ownFund + loan;
                    investedAmountInput.value = total;
                }

                ownFundInput.addEventListener('input', calculateInvestedAmount);
                loanInput.addEventListener('input', calculateInvestedAmount);
                calculateInvestedAmount(); // Initial calculation
            }

            // Prefixed fields (register_business = 1)
            const ownFundInputY = document.querySelector('input[name="y_own_fund"]');
            const loanInputY = document.querySelector('input[name="y_loan"]');
            const investedAmountInputY = document.querySelector('input[name="y_invested_amount"]');
            console.log('y_own_fund Input:', ownFundInputY);
            console.log('y_loan Input:', loanInputY);
            console.log('y_invested_amount Input:', investedAmountInputY);

            if (isRegistered && ownFundInputY && loanInputY && investedAmountInputY) {
                function calculateInvestedAmountY() {
                    const ownFundY = parseFloat(ownFundInputY.value) || 0;
                    const loanY = parseFloat(loanInputY.value) || 0;
                    const totalY = ownFundY + loanY;
                    investedAmountInputY.value = totalY;
                }

                ownFundInputY.addEventListener('input', calculateInvestedAmountY);
                loanInputY.addEventListener('input', calculateInvestedAmountY);
                calculateInvestedAmountY(); // Initial calculation
            }

            // Populate business years
            function populateBusinessYears() {
                const businessYearSelect = document.getElementById('business_year');
                if (!businessYearSelect) {
                    console.error('Error: business_year select element not found!');
                    return;
                }
                const currentYear = new Date().getFullYear();
                const defaultYear = {{ $entrepreneur->business_year ?? 'null' }};
                businessYearSelect.innerHTML = '<option value="">Select Year</option>';
                for (let year = currentYear - 1; year >= currentYear - 50; year--) {
                    const option = document.createElement('option');
                    option.value = year;
                    option.textContent = year;
                    if (defaultYear && year === defaultYear) {
                        option.selected = true;
                    }
                    businessYearSelect.appendChild(option);
                }
            }

            populateBusinessYears();

            // File preview logic (unchanged)
            const prefix = existingFiles.registerBusiness === 1 ? 'y_' : '';
            const businessLogoInput = document.getElementById(`${prefix}business_logo`);
            const businessLogoPreview = document.getElementById(`${prefix}business_logo_preview`);
            const productPhotosInput = document.getElementById(`${prefix}product_photos`);
            const productPhotosPreview = document.getElementById(`${prefix}product_photos_preview`);
            const pitchDeckInput = document.getElementById(`${prefix}pitch_deck`);
            const pitchDeckPreview = document.getElementById(`${prefix}pitch_deck_preview`);

            console.log('Business Logo Input:', businessLogoInput);
            console.log('Business Logo Preview:', businessLogoPreview);
            console.log('Product Photos Input:', productPhotosInput);
            console.log('Product Photos Preview:', productPhotosPreview);
            console.log('Pitch Deck Input:', pitchDeckInput);
            console.log('Pitch Deck Preview:', pitchDeckPreview);

            function displayBusinessLogoPreview(filePath) {
                if (filePath && businessLogoPreview) {
                    const folder = folderMap.businessLogo;
                    const cleanPath = filePath.startsWith(`${folder}/`) ? filePath :
                        `${folder}/${filePath.split('/').pop()}`;
                    const fullUrl = storageBaseUrl + cleanPath;
                    console.log('Business Logo URL:', fullUrl);
                    const img = document.createElement('img');
                    img.src = fullUrl;
                    img.style.maxWidth = '150px';
                    img.style.maxHeight = '150px';
                    img.onerror = () => console.error('Failed to load business logo:', fullUrl);
                    businessLogoPreview.innerHTML = '';
                    businessLogoPreview.appendChild(img);
                } else {
                    console.warn('No business logo file path or preview container found.');
                }
            }

            if (existingFiles.businessLogo) {
                displayBusinessLogoPreview(existingFiles.businessLogo);
            }

            if (businessLogoInput) {
                businessLogoInput.addEventListener('change', function() {
                    businessLogoPreview.innerHTML = '';
                    const file = this.files[0];
                    if (file) {
                        const reader = new FileReader();
                        reader.onload = function(e) {
                            const img = document.createElement('img');
                            img.src = e.target.result;
                            img.style.maxWidth = '150px';
                            img.style.maxHeight = '150px';
                            businessLogoPreview.appendChild(img);
                        };
                        reader.readAsDataURL(file);
                    }
                });
            }

            function displayProductPhotosPreview(filePaths) {
                const paths = Array.isArray(filePaths) ? filePaths : [];
                if (paths.length > 0 && productPhotosPreview) {
                    productPhotosPreview.innerHTML = '';
                    paths.forEach(filePath => {
                        if (filePath) {
                            const folder = folderMap.productPhotos;
                            const cleanPath = filePath.startsWith(`${folder}/`) ? filePath :
                                `${folder}/${filePath.split('/').pop()}`;
                            const fullUrl = storageBaseUrl + cleanPath;
                            console.log('Product Photo URL:', fullUrl);
                            const img = document.createElement('img');
                            img.src = fullUrl;
                            img.style.maxWidth = '100px';
                            img.style.maxHeight = '100px';
                            img.onerror = () => console.error('Failed to load product photo:', fullUrl);
                            productPhotosPreview.appendChild(img);
                        }
                    });
                } else {
                    console.warn('No product photos or preview container found.');
                }
            }

            displayProductPhotosPreview(productPhotosArray);

            if (productPhotosInput) {
                productPhotosInput.addEventListener('change', function() {
                    productPhotosPreview.innerHTML = '';
                    const files = this.files;
                    if (files.length > 0) {
                        Array.from(files).forEach(file => {
                            const reader = new FileReader();
                            reader.onload = function(e) {
                                const img = document.createElement('img');
                                img.src = e.target.result;
                                img.style.maxWidth = '100px';
                                img.style.maxHeight = '100px';
                                productPhotosPreview.appendChild(img);
                            };
                            reader.readAsDataURL(file);
                        });
                    }
                });
            }

            function displayPitchDeckPreview(filePath) {
                if (filePath && pitchDeckPreview) {
                    const folder = folderMap.pitchDeck;
                    const cleanPath = filePath.startsWith(`${folder}/`) ? filePath :
                        `${folder}/${filePath.split('/').pop()}`;
                    const fullUrl = storageBaseUrl + cleanPath;
                    console.log('Pitch Deck URL:', fullUrl);
                    const fileName = cleanPath.split('/').pop();
                    pitchDeckPreview.innerHTML = '';
                    const fileInfo = document.createElement('p');
                    fileInfo.textContent = `Existing file: ${fileName}`;
                    pitchDeckPreview.appendChild(fileInfo);
                } else {
                    console.warn('No pitch deck file path or preview container found.');
                }
            }

            if (existingFiles.pitchDeck) {
                displayPitchDeckPreview(existingFiles.pitchDeck);
            }

            if (pitchDeckInput) {
                pitchDeckInput.addEventListener('change', function() {
                    pitchDeckPreview.innerHTML = '';
                    const file = this.files[0];
                    if (file) {
                        const fileName = file.name;
                        const fileSize = (file.size / 1024 / 1024).toFixed(2);
                        const fileInfo = document.createElement('p');
                        fileInfo.textContent = `Selected file: ${fileName} (${fileSize} MB)`;
                        pitchDeckPreview.appendChild(fileInfo);
                    }
                });
            }

            // Existing script for funding_currency_label
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

            // Initial call to set the label
            console.log("Initializing funding currency label");
            updateFundingCurrencyLabel();

            // Add event listener for input changes
            countryInput?.addEventListener('input', updateFundingCurrencyLabel);

            console.log("frefefe");
            updateFundingCurrencyLabel();
            countryInput?.addEventListener('input', updateFundingCurrencyLabel);

            // Character counter for business_describe
            const businessDescribe = document.querySelector('textarea[name="business_describe"]');
            if (businessDescribe) {
                const counter = document.createElement('small');
                counter.className = 'text-muted';
                businessDescribe.parentNode.appendChild(counter);

                businessDescribe.addEventListener('input', function() {
                    counter.textContent = `${this.value.length} characters`;
                });

                counter.textContent = `${businessDescribe.value.length} characters`;
            }

            // Calculation dob and age
            const dobInput = document.getElementById('dob');
            const ageInput = document.getElementById('age');
            const dobError = document.getElementById('dob_error');

            // Function to calculate age
            function calculateAge(birthDate) {
                const today = new Date();
                let age = today.getFullYear() - birthDate.getFullYear();
                const monthDiff = today.getMonth() - birthDate.getMonth();

                if (monthDiff < 0 || (monthDiff === 0 && today.getDate() < birthDate.getDate())) {
                    age--;
                }

                return age;
            }

            // Function to validate age
            function validateAge(selectedDate) {
                const age = calculateAge(selectedDate);

                if (isNaN(age) || age < 18) {
                    dobError.textContent = 'You must be at least 18 years old.';
                    dobError.classList.remove('d-none');
                    dobInput.value = '';
                    ageInput.value = '';
                    return false;
                } else {
                    dobError.classList.add('d-none');
                    ageInput.value = age;
                    return true;
                }
            }

            // Initialize flatpickr
            flatpickr("#dob", {
                dateFormat: "d/m/Y",
                maxDate: "today",
                yearSelectorRange: 100,
                disableMobile: "true",
                clickOpens: true,
                allowInput: false,
                onChange: function(selectedDates, dateStr, instance) {
                    if (selectedDates.length > 0) {
                        const selectedDate = selectedDates[0];
                        validateAge(selectedDate);
                    }
                }
            });

            // Remove native date input event listeners since we're using flatpickr
            if (dobInput) {
                // Prevent manual typing
                dobInput.addEventListener('keydown', function(e) {
                    e.preventDefault();
                });

                // Remove the native change event listener since flatpickr handles it
                // The flatpickr onChange will handle all date selection validation
            }

            function updateYearsInBusiness() {
                const businessYearSelect = document.getElementById('business_year');
                const businessYearCountInput = document.getElementById('business_year_count');
                if (businessYearSelect && businessYearCountInput) {
                    const selectedYear = parseInt(businessYearSelect.value);
                    const currentYear = new Date().getFullYear();
                    if (!isNaN(selectedYear)) {
                        const yearsInBusiness = currentYear - selectedYear;
                        businessYearCountInput.value = yearsInBusiness >= 0 ? yearsInBusiness : 0;
                    } else {
                        businessYearCountInput.value = '';
                    }
                }
            }

            const businessYearSelect = document.getElementById('business_year');
            if (businessYearSelect) {
                businessYearSelect.addEventListener('change', updateYearsInBusiness);
                const defaultYear = {{ $entrepreneur->business_year ?? 'null' }};
                if (defaultYear && !isNaN(defaultYear)) {
                    businessYearSelect.value = defaultYear;
                    updateYearsInBusiness();
                }
            }

            if (typeof validateStep2 === 'undefined') {
                window.validateStep2 = function() {
                    const dobVal = dobInput.value;
                    if (!dobVal) {
                        dobError.textContent = 'Date Of Birth is Required';
                        dobError.classList.remove('d-none');
                        return false;
                    }

                    const dob = new Date(dobVal);
                    let age = today.getFullYear() - dob.getFullYear();
                    const m = today.getMonth() - dob.getMonth();

                    if (m < 0 || (m === 0 && today.getDate() < dob.getDate())) {
                        age--;
                    }

                    if (isNaN(age) || age < 18) {
                        dobError.textContent = 'You Must Be At Least 18 Years Old.';
                        dobError.classList.remove('d-none');
                        return false;
                    }

                    dobError.classList.add('d-none');
                    return true;
                };
            }

            const investmentFieldY = document.querySelector('input[name="y_market_capital"]');
            const equityFieldY = document.querySelector('input[name="y_your_stake"]');
            const valuationFieldY = document.querySelector('input[name="y_stake_funding"]');

            function calculateValuationY() {
                const investmentY = parseFloat(investmentFieldY.value) || 0;
                const equityY = parseFloat(equityFieldY.value) || 0;

                if (!isNaN(investmentY) && !isNaN(equityY) && equityY > 0) {
                    const valuationY = (investmentY / equityY) * 100;
                    valuationFieldY.value = valuationY.toFixed(2);
                } else {
                    valuationFieldY.value = '';
                }
            }

            if (investmentFieldY && equityFieldY) {
                investmentFieldY.addEventListener('input', calculateValuationY);
                equityFieldY.addEventListener('input', calculateValuationY);
            }


            // Valuation calculation
            const investmentField = document.querySelector('input[name="market_capital"]');
            const equityField = document.querySelector('input[name="your_stake"]');
            const valuationField = document.querySelector('input[name="stake_funding"]');

            function calculateValuation() {
                const investment = parseFloat(investmentField.value) || 0;
                const equity = parseFloat(equityField.value) || 0;

                if (!isNaN(investment) && !isNaN(equity) && equity > 0) {
                    const valuation = (investment / equity) * 100;
                    valuationField.value = valuation.toFixed(2);
                } else {
                    valuationField.value = '';
                }
            }

            if (investmentField && equityField) {
                investmentField.addEventListener('input', calculateValuation);
                equityField.addEventListener('input', calculateValuation);
            }
        });
        document.addEventListener('DOMContentLoaded', function() {
            const bizCountrySelect = document.getElementById('business_country');
            const bizStateSelect = document.getElementById('business_state');
            const bizCitySelect = document.getElementById('business_city');
            const yCountrySelect = document.getElementById('y_business_country');
            const yStateSelect = document.getElementById('y_business_state');
            const yCitySelect = document.getElementById('y_business_city');
            // const fundingCurrencyLabels = document.querySelectorAll('.funding_currency_label');
            const API_KEY = 'WmtRc2MzTzhLRnltNGNmSjljT3RqakROckhSOFFQSTZqMXBGbVlNUw==';
            const BASE_URL = 'https://api.countrystatecity.in/v1';

            // Get database values for pre-selection
            const dbCountry = "{{ old('business_country', $entrepreneur->business_country ?? '') }}";
            const dbState = "{{ old('business_state', $entrepreneur->business_state ?? '') }}";
            const dbCity = "{{ old('business_city', $entrepreneur->business_city ?? '') }}";
            const yDbCountry = "{{ old('y_business_country', $entrepreneur->y_business_country ?? '') }}";
            const yDbState = "{{ old('y_business_state', $entrepreneur->y_business_state ?? '') }}";
            const yDbCity = "{{ old('y_business_city', $entrepreneur->y_business_city ?? '') }}";

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
                    } else {
                        console.warn('No state value to pre-select');
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
                    } else {
                        console.warn('No city value to pre-select');
                    }
                } catch (error) {
                    console.error('Error fetching cities:', error);
                    citySelect.innerHTML = '<option value="">No cities available</option>';
                }
            }

            function updateFundingCurrencyLabel(countrySelect, labels) {
                const selectedCountry = (countrySelect?.value || '').trim().toLowerCase();
                console.log('Updating currency label for country:', selectedCountry);
                let label = selectedCountry === 'in' ? '(₹)' : selectedCountry === 'az' ? '(AZN)' : '($)';
                labels.forEach(el => (el.textContent = label));
                console.log('Currency label updated:', label);
            }

            // Event Listeners for Business Country/State/City
            bizCountrySelect?.addEventListener('change', () => {
                const countryIso2 = bizCountrySelect.value.trim();
                console.log('Business country changed to:', countryIso2);
                populateStates(countryIso2, bizStateSelect, bizCitySelect);
                // updateFundingCurrencyLabel(bizCountrySelect, fundingCurrencyLabels);
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
                // updateFundingCurrencyLabel(yCountrySelect, fundingCurrencyLabels);
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
                        }
                    } else {
                        console.warn('No business country value to pre-select');
                    }
                    // updateFundingCurrencyLabel(bizCountrySelect, fundingCurrencyLabels);
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
                        }
                    } else {
                        console.warn('No Y business country value to pre-select');
                    }
                    // updateFundingCurrencyLabel(yCountrySelect, fundingCurrencyLabels);
                }
            }

            initializeForm();
        });
    </script>
    <script>
        //document.addEventListener('DOMContentLoaded', function() {
        // Set selected values for editing
        // @if (old('business_country', $enterprent->business_country ?? null))
        // document.getElementById('business_country').value =
        //   "{{ old('business_country', $enterprent->business_country) }}";
        //  @endif
        //});
    </script>
@endsection
