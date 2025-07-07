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
        min-height: 100vh;
        height: 100%;
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
        background-image: url('/img1.jpg');
        animation: slideAnim1 20s infinite;
    }

    .slide2 {
        background-image: url('/img2.jpg');
        animation: slideAnim2 20s infinite;
    }

    .slide3 {
        background-image: url('/img3.jpg');
        animation: slideAnim3 20s infinite;
    }

    /* Keyframes: full 20s visible, smooth fade in/out */
    @keyframes slideAnim1 {
        0% {
            opacity: 1;
        }

        32% {
            opacity: 1;
        }

        33% {
            opacity: 0;
        }

        100% {
            opacity: 0;
        }
    }

    @keyframes slideAnim2 {
        0% {
            opacity: 0;
        }

        33% {
            opacity: 0;
        }

        34% {
            opacity: 1;
        }

        65% {
            opacity: 1;
        }

        66% {
            opacity: 0;
        }

        100% {
            opacity: 0;
        }
    }

    @keyframes slideAnim3 {
        0% {
            opacity: 0;
        }

        66% {
            opacity: 0;
        }

        67% {
            opacity: 1;
        }

        98% {
            opacity: 1;
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
        background: rgba(255, 255, 255, 0.15) padding: 2rem !important;
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
    }
</style>

@section('content')
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
                        <h3><b>Verify
                                Your Number</b></h3>
                        <p class="text-muted" style="font-size: small;color:white !important;">Enter the 6-digit code sent
                            to</p>
                        <p class="fw-bold">{{ $email }}</p>
                    </div>

                    <form action="{{ route('verify.otp') }}" method="POST" class="mt-3">
                        @csrf
                        <input type="hidden" name="email" value="{{ $email }}">

                        {{-- <div class="d-flex justify-content-center mb-3">
                                        <div class="w-100" style="max-width: 500px;">
                                            <label class="form-label fw-bold">Enter OTP</label>
                                            <input type="text" class="form-control otp-input text-center" name="otp"
                                                placeholder="000000" maxlength="6" required>
                                            @error('otp')
                                                <div class="text-danger mt-1 text-center">{{ $message }}</div>
                                            @enderror
                                        </div>
                                    </div> --}}
                        <div class="d-flex justify-content-center mb-3" id="moreDetail">
                            <div class="d-flex gap-2" style="max-width: 500px;">
                                @for ($i = 1; $i <= 6; $i++)
                                    <input type="text" name="otp[]" maxlength="1"
                                        class="form-control text-center otp-box" required
                                        style="background-color:#ffffff00; color: white;padding: 10px 5px;">
                                @endfor
                            </div>
                        </div>

                        <input type="hidden" name="otp" id="otp">

                        @error('otp_combined')
                            <div class="text-danger mt-1 text-center">{{ $message }}</div>
                        @enderror

                        {{-- <div class="mb-5">
                                            <label class="form-label fw-bold">Mobile Number</label>
                                            <div class="input-group">
                                                <select name="country_code" class="form-select" style="max-width: 120px;">
                                                    @foreach ($countries as $country)
                                                        <option value="{{ $country['code'] }}"
                                                            {{ $country['code'] == '+91' ? 'selected' : '' }}>
                                                            {{ $country['name'] }} ({{ $country['code'] }})
                                                        </option>
                                                    @endforeach
                                                </select>

                                                <input type="tel" class="form-control" name="phone_number"
                                                    placeholder="Enter 10-digit mobile number" value="{{ old('phone_number') }}"
                                                    maxlength="10" required>
                                            </div>
                                            @error('country_code')
                                                <div class="text-danger mt-1">{{ $message }}</div>
                                            @enderror
                                            @error('phone_number')
                                                <div class="text-danger mt-1">{{ $message }}</div>
                                            @enderror
                                        </div>

                                        <div class="col-md-12 text-center mt-4">
                                            <label class="form-label fw-bold">Choose who you are!</label>
                                            <div class="mb-4 text-center">
                                                <div class="role-card">
                                                    <input type="radio" class="btn-check" name="role" id="entrepreneur"
                                                        value="entrepreneur" required>
                                                    <label class="btn btn-outline-secondary" for="entrepreneur">ENTREPRENEUR
                                                        PITCH PAD</label>
                                                </div>

                                                <div class="role-card">
                                                    <input type="radio" class="btn-check" name="role" id="investor"
                                                        value="investor" required>
                                                    <label class="btn btn-outline-secondary" for="investor">INVESTOR
                                                        LOUNGE</label>
                                                </div>
                                            </div>

                                            @error('role')
                                                <div class="alert alert-danger text-center">{{ $message }}</div>
                                            @enderror
                                        </div> --}}

                        {{-- <div class="d-flex justify-content-center"> --}}
                        <div class="main-data mt-5" style="max-width: 500px;">
                            <button type="submit" class="btn btn-primary w-100 py-3">
                                <i class="fas fa-check me-2"></i>Verify & Continue
                            </button>
                        </div>
                        {{-- </div> --}}
                        {{-- <div class="main-data mt-5">
                                            <button type="submit" class="btn btn-primary w-100 py-3" id="button-data">
                                                <i class="fas fa-paper-plane me-2"></i>Send OTP
                                            </button>
                                        </div> --}}
                    </form>

                    {{-- <div class="text-center mt-1">
                        <small class="text-muted">
                            Didn't receive code?
                            <a href="{{ route('mobile.form') }}" class="text-primary">Resend</a>
                        </small>
                    </div> --}}
                    <div class="text-center mt-3">
                        <a href="{{ route('mobile.form') }}" class="btn btn-outline-secondary"
                            style="border-color: white;color: white;">
                            <i class="fas fa-arrow-left me-2"></i>Back
                        </a>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection

@section('scripts')
    <script>
        // Auto-update raised amount based on slide

        const otpInputs = document.querySelectorAll('.otp-box');
        const otpCombined = document.getElementById('otp');

        otpInputs.forEach((input, index) => {
            input.addEventListener('input', () => {
                input.value = input.value.replace(/[^0-9]/g, ''); // Only digits

                // Move to next
                if (input.value && index < otpInputs.length - 1) {
                    otpInputs[index + 1].focus();
                }

                updateCombinedOtp();
            });

            input.addEventListener('keydown', (e) => {
                if (e.key === 'Backspace' && !input.value && index > 0) {
                    otpInputs[index - 1].focus();
                }
            });
        });

        function updateCombinedOtp() {
            const otp = Array.from(otpInputs).map(i => i.value).join('');
            otpCombined.value = otp;
        }

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

                switch (currentSlide) {
                    case 1:
                        raisedAmount.textContent = '$30,000';
                        break;
                    case 2:
                        raisedAmount.textContent = '$1,90,000';
                        break;
                    case 3:
                        raisedAmount.textContent = '$50,000';
                        break;
                }
            }

            setInterval(checkSlide, 1000); // Check every second
        }

        document.addEventListener('DOMContentLoaded', updateRaisedAmount);
    </script>
@endsection
