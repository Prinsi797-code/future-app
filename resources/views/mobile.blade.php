@extends('layouts.app')

@section('title', 'Enter Mobile Number - Future Taikun')
<style>
    /* Remove body background and padding */
    body {
        background: none !important;
        padding: 0 !important;
        margin: 0 !important;
        overflow-x: hidden;
    }

    /* Remove navbar margin/padding effects */
    .navbar {
        position: relative;
        z-index: 1000;
    }

    /* Main container styling - Full height */
    .main-wrapper {
        min-height: 100vh;
        padding: 0;
        margin: 0;
        position: relative;
        overflow: hidden;
    }

    .container-fluid {
        padding: 0;
        margin: 0;
        max-width: 100%;
        height: 100vh;
    }

    .row {
        margin: 0;

    }

    .row>[class*="col-"] {
        padding: 0;
    }

    /* Background image section - Full height with sliding images */
    .image-section {
        position: absolute;
        top: 0;
        left: 0;
        width: 100%;
        height: 100vh;
        min-height: 500px;
        overflow: hidden;
        z-index: 0;
        background-color: #333;
        /* Fallback background color for the section */
    }

    .slide {
        position: absolute;
        top: 0;
        left: 0;
        width: 100%;
        height: 100%;
        background-size: cover;
        background-position: center;
        opacity: 0;
        will-change: opacity;
        /* Optimize animation performance */
        transition: opacity 1s ease-in-out;
        z-index: 0;
    }

    .slide::before {
        content: '';
        position: absolute;
        top: 0;
        left: 0;
        width: 100%;
        height: 100%;
        background: rgba(0, 0, 0, 0.3);
        /* Semi-transparent black shadow */
        z-index: 1;
        box-shadow: inset 0 0 50px rgba(0, 0, 0, 0.5);
        /* Inner shadow effect */
    }

    /* 3 slides — each visible for 20s, whole cycle is 60s */
    .slide1 {
        background: url('img1.jpg') no-repeat center/cover;
        /* Image if available */
        background-color: #4a90e2;
        /* Fallback color */
        animation: fadeSlide 60s infinite;
    }

    .slide2 {
        background: url('img2.jpg') no-repeat center/cover;
        background-color: #e94e77;
        /* Fallback color */
        animation: fadeSlide 60s infinite 20s;
    }

    .slide3 {
        background: url('img3.jpg') no-repeat center/cover;
        background-color: #50c878;
        /* Fallback color */
        animation: fadeSlide 60s infinite 40s;
    }

    /* Unified keyframes for smooth transitions */
    @keyframes fadeSlide {
        0% {
            opacity: 0;
        }

        5% {
            opacity: 1;
        }

        33.33% {
            opacity: 1;
        }

        38.33% {
            opacity: 0;
        }

        100% {
            opacity: 0;
        }
    }

    /* Content overlay */
    .content-overlay {
        position: relative;
        z-index: 1;
        min-height: 100vh;
        display: flex;
        justify-content: space-between;
        align-items: center;
        padding: 0 5%;
    }

    /* Left side text section */
    .text-section {
        color: white;
        text-align: left;
        padding: 20px;
        max-width: 50%;
    }

    .text-section h3 {
        font-size: 20px;
        font-weight: 700;
        margin: 0;
        text-shadow: 2px 2px 4px rgba(0, 0, 0, 0.7);
        line-height: 1.3;
    }

    .text-section h1 {
        font-size: 60px;
        font-weight: 700;
        margin: 0;
        text-shadow: 2px 2px 4px rgba(0, 0, 0, 0.7);
        line-height: 1.3;
    }

    .text-section .raised {
        font-size: 3.5rem;
        font-weight: bold;
        margin-top: 10px;
        text-shadow: 2px 2px 4px rgba(0, 0, 0, 0.7);
    }

    /* Right side form section */
    .form-section {
        background: rgb(255 255 255 / 16%) !important;
        border-radius: 8px;
        box-shadow: 0 2px 10px rgb(0 0 0) !important;
        padding: 30px;
        max-width: 500px;
        width: 100%;
    }

    #email:focus {
        color: white !important;
    }

    .btn-group-toggle .btn {
        padding: 0.375rem 1.25rem;
        font-weight: 500;
        font-size: 1rem;
        border-radius: 9999px;
        transition: all 0.3s ease;
        cursor: pointer;
    }

    .btn-group-toggle .btn input[type="radio"] {
        display: none;
    }

    .btn-group-toggle .btn.active,
    .btn-group-toggle .btn:focus,
    .btn-group-toggle .btn:hover {
        background-color: #FFE7EA;
        color: black;
        border-color: #FFE7EA;
        box-shadow: 0 2px 6px #FFE7EA;
    }

    .role-card label.btn {
        border-radius: 50px;
        padding: 0.375rem 1.25rem;
        font-weight: 500;
        font-size: 0.9rem;
        text-transform: none;
        min-width: 80px;
        display: inline-block;
        cursor: pointer;
    }

    .role-card input[type="radio"]+label.btn {
        background-color: #2EA9B9;
        color: white;
        border-color: #2EA9B9;
    }

    .role-card input[type="radio"]:checked+label.btn {
        background-color: #717171;
        color: white;
        border-color: #717171;
    }

    .role-card {
        display: inline-block;
        margin-right: 10px;
    }

    /* Mobile responsive */
    @media (max-width: 991px) {
        .content-overlay {
            flex-direction: column;
            padding: 20px;
        }

        .text-section {
            max-width: 100%;
            text-align: center;
            margin-bottom: 20px;
        }

        .text-section h3 {
            font-size: 2.5rem;
        }

        .text-section .raised {
            font-size: 2.2rem;
        }

        .form-section {
            max-width: 100%;
            padding: 20px;
        }
    }

    @media (max-width: 768px) {
        .text-section h3 {
            font-size: 1.0rem;
        }

        .text-section h1 {
            font-size: 2.0rem;
        }

        .text-section .raised {
            font-size: 3rem;
        }

        .role-card {
            display: block;
            margin-bottom: 10px;
            margin-right: 0;
        }

        .role-card label.btn {
            width: 100%;
            margin-bottom: 10px;
        }

        .form-control {
            color: white !important;
        }
    }

    #email::placeholder {
        color: rgb(65, 62, 62);
        font-weight: bold;
        /* Example: red color for placeholder text */
        opacity: 2;
    }

    .stat-item {
        flex: 1;

        margin: 2px 4px;
        padding: 8px 4px;
    }

    .stat-item span:first-child {
        display: block;
        margin-bottom: 4px;
    }

    .single-line-stats {
        gap: 8px;
    }

    @media (max-width: 768px) {
        .stat-item {
            min-width: 100px;
            margin: 2px 2px;
            padding: 6px 2px;
        }

        .stat-item span:first-child {
            font-size: 12px !important;
        }

        .stat-item .badge {
            font-size: 11px !important;
        }
    }

    .company-detail {
        font-size: 35px;
        text-align: center;
        margin: 60px 0 60px 0;
        color: #000;
        font-weight: bold;
    }

    @media (max-width: 768px) {
        .form-section {
            padding: 15px;
            /* Reduce padding for smaller screens */
            width: 100%;
            /* Ensure full width */
        }

        .main-data {
            margin-top: 10px;
            /* Adjust margin for button */
        }

        .btn-primary {
            width: 100%;
            /* Make button full width on mobile */
            padding: 10px;
            /* Ensure button is clickable */
            font-size: 16px;
            /* Adjust font size for readability */
        }

        .form-floating-custom {
            margin-bottom: 15px;
            /* Add space below input */
        }
    }
</style>

@section('content')
    <?php
    // Number formatting function - add this at the top of your blade file or in a helper
    function formatNumber($number)
    {
        if ($number >= 10000000) {
            // 10M+
            return number_format($number / 1000000, 1) . 'M';
        } elseif ($number >= 1000000) {
            // 1M+
            return number_format($number / 1000000, 1) . 'M';
        } elseif ($number >= 100000) {
            // 100K+
            return number_format($number / 1000, 0) . 'K';
        } elseif ($number >= 10000) {
            // 10K+
            return number_format($number / 1000, 0) . 'K';
        } elseif ($number >= 1000) {
            // 1K+
            return number_format($number / 1000, 1) . 'K';
        } else {
            return number_format($number);
        }
    }
    ?>
    {{-- @if (config('app.debug'))
        <div style="background: #f0f0f0; padding: 10px; margin: 10px; border: 1px solid #ccc;">
            <strong>Debug Info:</strong><br>
            Auth Check: {{ Auth::check() ? 'Yes' : 'No' }}<br>
            User ID: {{ Auth::id() ?? 'Not logged in' }}<br>
            Has Entrepreneur Entry: {{ $hasEntrepreneurEntry ? 'Yes' : 'No' }}
        </div>
    @endif --}}
    <div class="main-wrapper">
        <div class="container-fluid">
            <div class="image-section">
                <div class="slide slide1"></div>
                <div class="slide slide2"></div>
                <div class="slide slide3"></div>
            </div>
            <div class="content-overlay">
                <!-- Left Side - Text Section -->
                <div class="text-section">
                    <h1>Fundraising Platform for Startups
                    </h1>
                    <h3>We're Connecting Entrepreneur With Investor-Shaping The Future Taikun</h3>
                    {{-- <div class="raised" id="raised-amount">$30,000</div> --}}
                </div>

                <!-- Right Side - Form Section -->
                <div class="form-section">
                    <div class="text-center mb-2" style="color:white;">
                        <h3><b>Let's Begin</b></h3>
                    </div>

                    <form action="{{ route('send.otp') }}" method="POST" class="mt-3">
                        @csrf
                        <div class="col-md-12 text-center mt-2">
                            <div class="mb-4 text-center">
                                <div class="role-card">
                                    <input type="radio" class="btn-check" name="role" id="entrepreneur"
                                        value="entrepreneur" required>
                                    <label class="btn btn-outline-secondary" for="entrepreneur">ENTREPRENEUR PITCH</label>
                                </div>

                                <div class="role-card">
                                    <input type="radio" class="btn-check" name="role" id="investor" value="investor"
                                        required>
                                    <label class="btn btn-outline-secondary" for="investor">INVESTOR LOUNGE</label>
                                </div>
                            </div>

                            @error('role')
                                <div class="alert alert-danger text-center">{{ $message }}</div>
                            @enderror
                        </div>

                        <div class="col-md-12">
                            <div class="form-floating-custom">
                                <input type="text" class="form-control" name="email" id="email"
                                    placeholder="xyz@gmail.com">
                                {{-- <label for="email">Email</label> --}}
                                @error('email')
                                    <div class="text-danger mt-1">{{ $message }}</div>
                                @enderror
                            </div>
                        </div>

                        <div class="main-data mt-5">
                            <button type="submit" class="btn btn-primary w-100 py-3" id="button-data">
                                <i class="fas fa-paper-plane me-2"></i>Send OTP
                            </button>
                        </div>
                    </form>

                    <div class="text-center mt-1">
                        <small class="text" style="color:white;">
                            By continuing, you agree to our
                            <a href="{{ route('service') }}" class="text-primary">Terms & Conditions</a>
                        </small>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <!-- Updated Section: Over a decade of Fundraising Success -->
    {{-- <div class="bg-dark text-center" style="background-color: #1a2a44; color: #ffffff; padding: 20px 0; min-height: 150px;">
        <div class="container py-5">
            <h1 class="text-white mb-3 fw-bold">Over a decade of Fundraising Success</h1>
            <div class="d-flex justify-content-center pt-5">
                <div class="mx-4">
                    <h1 class="text-white fw-bold">$700,000,000+</h1>
                    <p class="text-white">Funding Committed</p>
                </div>
                <div class="mx-4">
                    <h1 class="text-white fw-bold">20,000+</h1>
                    <p class="text-white">Accredited Investors</p>
                </div>
            </div>
        </div>
    </div> --}}
    <div>
        <h1 style="" class="company-detail">
            Fundraising <span class="company-span">Startups</span> On <span class="company-span">Future</span>Taikun
        </h1>
        <div class="row row-cols-1 row-cols-sm-1 row-cols-md-2 row-cols-xl-4 row-cols-lg-3 g-4 mb-3">
            @foreach ($approvedEntrepreneurs as $entrepreneur)
                @php
                    // Determine which photos to use based on register_business
                    if ($entrepreneur->register_business == 1) {
                        $photosField = $entrepreneur->y_product_photos_admin ?? $entrepreneur->y_product_photos;
                    } else {
                        $photosField = $entrepreneur->product_photos_admin ?? $entrepreneur->product_photos;
                    }

                    // Handle JSON string or array formats
                    $images = [];
                    if (is_string($photosField)) {
                        if (json_decode($photosField, true) !== null) {
                            $images = json_decode($photosField, true);
                        } else {
                            $images = !empty($photosField) ? explode(',', $photosField) : [];
                        }
                    } elseif (is_array($photosField)) {
                        $images = $photosField;
                    }

                    // Clean up image paths
                    $images = array_map(function ($path) {
                        return ltrim(str_replace(['\/', '\\'], '/', trim($path)), '/');
                    }, array_filter($images, fn($path) => !empty($path)));

                    // Only set $firstImage if images exist, otherwise leave it unset
                    $firstImage = !empty($images) ? $images[0] : null;

                    \Log::info('Image Path for Entrepreneur ' . $entrepreneur->id, [
                        'register_business' => $entrepreneur->register_business,
                        'photosField' => $photosField,
                        'images' => $images,
                        'firstImage' => $firstImage,
                    ]);

                    // Determine and normalize logo
                    if ($entrepreneur->register_business == 1) {
                        $logo = $entrepreneur->y_business_logo_admin ?? ($entrepreneur->y_business_logo ?? null);
                    } else {
                        $logo = $entrepreneur->business_logo_admin ?? ($entrepreneur->business_logo ?? null);
                    }
                    $logo = $logo ? ltrim(str_replace(['\/', '\\'], '/', $logo), '/') : null;

                    $videoUrl = $entrepreneur->pitch_video ?? '#';

                    // Use cached or eager-loaded data
                    $interestedInvestorsCount = $entrepreneur->interests()->count();
                    $highestRemark = $entrepreneur
                        ->interests()
                        ->selectRaw(
                            'MAX(your_stake) as max_stake, MAX(market_capital) as max_capital, MAX(company_value) as max_value',
                        )
                        ->first();

                    $currency = $entrepreneur->country === 'IN' ? '₹' : '$';

                    $marketCapital =
                        $entrepreneur->register_business == 1
                            ? $entrepreneur->y_market_capital
                            : $entrepreneur->market_capital;
                    $stakeFunding =
                        $entrepreneur->register_business == 1
                            ? $entrepreneur->y_stake_funding
                            : $entrepreneur->stake_funding;
                    $yourStake =
                        $entrepreneur->register_business == 1 ? $entrepreneur->y_your_stake : $entrepreneur->your_stake;

                    $marketCapitalFormatted = formatNumber($marketCapital);
                    $stakeFundingFormatted = formatNumber($stakeFunding);
                    $highestRemarkMaxCapitalFormatted =
                        $interestedInvestorsCount > 0 && $highestRemark->max_capital
                            ? formatNumber($highestRemark->max_capital)
                            : $marketCapitalFormatted;
                    $highestRemarkMaxValueFormatted =
                        $interestedInvestorsCount > 0 && $highestRemark->max_value
                            ? formatNumber($highestRemark->max_value)
                            : $stakeFundingFormatted;
                @endphp

                <div class="col">
                    <div class="card shadow-sm rounded-3 position-relative"
                        onclick="window.open('{{ $videoUrl }}', '_blank')" style="cursor: pointer; border: none;">
                        <div class="position-relative">
                            @if ($firstImage)
                                <img src="{{ asset('storage/' . $firstImage) }}" class="card-img-top rounded-top-3"
                                    style="height: 180px; object-fit: cover;" alt="Business Image" loading="lazy">
                            @else
                                <!-- Optional: Add a placeholder or hide the image area -->
                                <div
                                    style="height: 180px; background-color: #f8f9fa; display: flex; align-items: center; justify-content: center; color: #6c757d;">
                                    No Image Available
                                </div>
                            @endif

                            <div class="position-absolute" style="bottom: -20px; right: 10px;">
                                @if ($logo)
                                    <img src="{{ asset('storage/' . $logo) }}" alt="Logo"
                                        style="height: 50px; width: 50px; object-fit: contain; border-radius: 6px; background: white; box-shadow: 0 2px 8px rgba(0,0,0,0.1);"
                                        loading="lazy">
                                @else
                                    <!-- Optional: Add a placeholder or hide the logo area -->
                                    <div style="height: 50px; width: 50px; background-color: #f8f9fa; border-radius: 6px;">
                                    </div>
                                @endif
                            </div>
                        </div>

                        <div class="card-body py-3 text-left">
                            <h5 class="card-title fw-bold">
                                {{ Str::limit($entrepreneur->register_business == 1 ? $entrepreneur->y_business_name : $entrepreneur->business_name, 30) }}
                            </h5>
                            <p class="card-text text-muted">
                                {{ Str::limit($entrepreneur->register_business == 1 ? $entrepreneur->y_describe_business : $entrepreneur->business_describe, 35) }}
                            </p>
                            <div class="text-muted lg fw-bold d-flex">
                                <span><i class="fas fa-map-marker-alt me-1"
                                        style="color: red;"></i>{{ $entrepreneur->state }},
                                    {{ $entrepreneur->country }}</span>
                                @if ($entrepreneur->approved)
                                    @php
                                        $createdAt = \Carbon\Carbon::parse($entrepreneur->created_at);
                                        $daysSinceCreated = now()->diffInDays($createdAt);
                                        $daysLeft = max(0, 90 - $daysSinceCreated);
                                    @endphp
                                    <div class="px-3 pb-2 lg fw-bold text-center">
                                        - {{ $daysLeft }} day{{ $daysLeft !== 1 ? 's' : '' }} Left
                                    </div>
                                @endif
                            </div>
                        </div>
                        <hr class="m-0">

                        <div class="d-flex justify-content-between w-100 mt-3 px-2 mb-3"
                            style="gap: 5px; flex-wrap: nowrap;">
                            <div class="flex-fill text-center">
                                <div class="text-muted" style="font-size: 13px;">Fund</div>
                                <div class="fw-semibold text-dark">
                                    {{ $currency }}{{ $marketCapitalFormatted }}
                                </div>
                            </div>
                            <div class="flex-fill text-center">
                                <div class="text-muted" style="font-size: 13px;">Equity</div>
                                <div class="fw-semibold text-dark">
                                    {{ $yourStake }}%
                                </div>
                            </div>
                            <div class="flex-fill text-center">
                                <div class="text-muted" style="font-size: 13px;">Valuation</div>
                                <div class="fw-semibold text-dark">
                                    {{ $currency }}{{ $stakeFundingFormatted }}
                                </div>
                            </div>
                        </div>

                        <div class="card-footer border-top-0 p-3" style="background-color: #EEEEEF !important;">
                            <div class="d-flex flex-column align-items-center">
                                <div class="d-flex justify-content-center text-center">
                                    <div>
                                        <div class="fw-bold text-muted">Interested Investors</div>
                                        <div class="d-flex align-items-center gap-2 justify-content-center">
                                            <span class="range-indicator"
                                                style="display: inline-block; width: 200px; height: 10px; border-radius: 5px; background: linear-gradient(to right, 
                                        {{ $interestedInvestorsCount <= 2 ? '#ff0000' : ($interestedInvestorsCount <= 5 ? '#ffa500' : '#00ff00') }},
                                        {{ $interestedInvestorsCount <= 2 ? '#ff3333' : ($interestedInvestorsCount <= 5 ? '#ffcc00' : '#33ff33') }});
                                        transition: all 0.3s ease;">
                                            </span>
                                            {{ $interestedInvestorsCount }}
                                        </div>
                                    </div>
                                </div>

                                <div class="d-flex justify-content-between w-100 mt-3 px-2"
                                    style="gap: 5px; flex-wrap: nowrap;">
                                    <div class="flex-fill text-center">
                                        <div class="text-muted" style="font-size: 13px;">Fund Offered</div>
                                        <div class="fw-semibold text-dark">
                                            {{ $interestedInvestorsCount > 0 ? ($highestRemark->max_capital ? $currency . $highestRemarkMaxCapitalFormatted : $currency . $marketCapitalFormatted) : 'N/A' }}
                                        </div>
                                    </div>
                                    <div class="flex-fill text-center">
                                        <div class="text-muted" style="font-size: 13px;">Equity Asked</div>
                                        <div class="fw-semibold text-dark">
                                            {{ $interestedInvestorsCount > 0 ? ($highestRemark->max_stake ? $highestRemark->max_stake . '%' : $yourStake . '%') : 'N/A' }}
                                        </div>
                                    </div>
                                    <div class="flex-fill text-center">
                                        <div class="text-muted" style="font-size: 13px;">Valuation</div>
                                        <div class="fw-semibold text-dark">
                                            {{ $interestedInvestorsCount > 0 ? ($highestRemark->max_value ? $currency . $highestRemarkMaxValueFormatted : $currency . $stakeFundingFormatted) : 'N/A' }}
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            @endforeach
        </div>
        @if (count($approvedEntrepreneurs) > 3)
            <div class="text-center mt-4 mb-4">
                <a href="{{ route('search') }}" class="btn btn-primary">View More</a>
            </div>
        @endif
    </div>
@endsection

@section('scripts')
    <script>
        // Auto-update raised amount based on slide
        function updateRaisedAmount() {
            const slides = document.querySelectorAll('.slide');
            const raisedAmount = document.getElementById('raised-amount');
            let currentSlide = 1;

            function checkSlide() {
                slides.forEach(slide => {
                    if (window.getComputedStyle(slide).opacity === '1') {
                        currentSlide = parseInt(slide.className.match(/slide(\d)/)[1]);
                    }
                });

            }
            setInterval(checkSlide, 1000); // Check every second
        }
        document.addEventListener('DOMContentLoaded', updateRaisedAmount);
    </script>
@endsection
