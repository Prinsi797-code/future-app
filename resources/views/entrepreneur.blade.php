@extends('layouts.admin')
<link href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css" rel="stylesheet">

@section('title', 'Entrepreneurs Directory')
<style>
    .custom-switch-scale {
        transform: scale(1.5);
        transform-origin: left;
        margin-right: 10px;
    }

    #successToast {
        background-color: #d4edda;
        color: #155724;
    }

    #successToast .toast-header {
        background-color: #c3e6cb;
    }

    .resume-container {
        font-family: 'Arial', sans-serif;
        line-height: 1.6;
        color: #333;
    }

    .section-title {
        font-size: 1.25rem;
        font-weight: 600;
        color: #2c3e50;
        margin-bottom: 1rem;
        border-bottom: 2px solid #3498db;
        padding-bottom: 0.25rem;
    }

    .info-grid {
        display: grid;
        grid-template-columns: repeat(auto-fit, minmax(300px, 1fr));
        gap: 1rem;
    }

    .info-item {
        display: flex;
        flex-direction: column;
        padding: 0.5rem;
        background-color: #f9f9f9;
        border-radius: 4px;
    }

    .info-label {
        font-weight: 600;
        color: #34495e;
        margin-right: 0.5rem;
    }

    .product-image {
        max-width: 80px;
        max-height: 80px;
        margin-right: 5px;
        border-radius: 4px;
    }

    .download-link {
        color: #3498db;
        text-decoration: none;
    }

    .download-link:hover {
        text-decoration: underline;
    }

    .table {
        font-size: 0.9rem;
    }

    .table th,
    .table td {
        vertical-align: middle;
    }

    .modal-content {
        border-radius: 8px;
    }

    .modal-header {
        background-color: #f8f9fa;
        border-bottom: #3498db;
    }





    .resume-container {
        max-width: 100%;
        margin: 0 auto;
        background: #ffffff;
        font-family: 'Segoe UI', Tahoma, Geneva, Verdana, sans-serif;
        line-height: 1.6;
    }

    .resume-section {
        margin-bottom: 35px;
        padding: 25px;
        background: #ffffff;
        border-radius: 15px;
        box-shadow: 0 5px 20px rgba(0, 0, 0, 0.08);
        border: 1px solid #e8ecf4;
        transition: all 0.3s ease;
        position: relative;
        overflow: hidden;
    }

    .resume-section::before {
        content: '';
        position: absolute;
        top: 0;
        left: 0;
        width: 5px;
        height: 100%;
        background: #2EA9B9;
    }

    .resume-section:hover {
        transform: translateY(-5px);
        box-shadow: 0 10px 30px rgba(0, 0, 0, 0.15);
    }

    .section-title {
        font-size: 1.5rem;
        font-weight: 700;
        color: #2c3e50;
        margin-bottom: 25px;
        padding-bottom: 15px;
        border-bottom: 2px solid #3498db;
        position: relative;
        display: flex;
        align-items: center;
        gap: 10px;
    }

    .section-title::after {
        content: '';
        position: absolute;
        bottom: -2px;
        left: 0;
        width: 50px;
        height: 2px;
        background: linear-gradient(135deg, #2EA9B9 100%);
    }

    .info-grid {
        display: grid;
        grid-template-columns: repeat(auto-fit, minmax(300px, 1fr));
        gap: 20px;
        margin-top: 0;
    }

    .info-item {
        background: #f8f9ff;
        padding: 20px;
        border-radius: 12px;
        border: 1px solid #e8ecf4;
        transition: all 0.3s ease;
        position: relative;
        overflow: hidden;
    }

    .info-item::before {
        content: '';
        position: absolute;
        top: 0;
        left: 0;
        width: 100%;
        height: 3px;
        background: linear-gradient(135deg, #2EA9B9 100%);
        transform: translateX(-100%);
        transition: transform 0.3s ease;
    }

    .info-item:hover {
        transform: translateY(-3px);
        box-shadow: 0 8px 25px rgba(0, 0, 0, 0.1);
        border-color: #3498db;
        background: #ffffff;
    }

    .info-item:hover::before {
        transform: translateX(0);
    }

    .info-label {
        font-weight: 700;
        color: #2c3e50;
        display: block;
        margin-bottom: 8px;
        font-size: 0.9rem;
        text-transform: uppercase;
        letter-spacing: 0.5px;
    }

    .info-value {
        color: #34495e;
        font-size: 1rem;
        line-height: 1.5;
        word-wrap: break-word;
    }

    /* Product Images Styling */
    .product-image {
        max-width: 80px;
        max-height: 80px;
        border-radius: 8px;
        margin: 5px;
        transition: all 0.3s ease;
        box-shadow: 0 4px 12px rgba(0, 0, 0, 0.1);
        cursor: pointer;
    }

    .product-image:hover {
        transform: scale(1.2);
        box-shadow: 0 8px 20px rgba(0, 0, 0, 0.2);
        z-index: 10;
        position: relative;
    }

    /* Download Link Styling */
    .download-link {
        color: #3498db;
        text-decoration: none;
        font-weight: 600;
        display: inline-flex;
        align-items: center;
        gap: 8px;
        padding: 8px 16px;
        background: #e8f4f8;
        border-radius: 25px;
        transition: all 0.3s ease;
        border: 2px solid transparent;
    }

    .download-link:hover {
        color: #2980b9;
        background: #3498db;
        color: white;
        border-color: #3498db;
        transform: translateY(-2px);
        box-shadow: 0 5px 15px rgba(52, 152, 219, 0.3);
    }

    .download-link::after {
        content: '\f019';
        font-family: 'Font Awesome 6 Free';
        font-weight: 900;
        font-size: 0.9rem;
    }

    /* Status Badge */
    .status-badge {
        display: inline-flex;
        align-items: center;
        padding: 6px 12px;
        border-radius: 20px;
        font-size: 0.85rem;
        font-weight: 600;
        text-transform: uppercase;
        letter-spacing: 0.5px;
    }

    .status-registered {
        background: #d4edda;
        color: #155724;
        border: 1px solid #c3e6cb;
    }

    .status-unregistered {
        background: #f8d7da;
        color: #721c24;
        border: 1px solid #f5c6cb;
    }

    /* Modal Styling */
    .modal-header {
        background: linear-gradient(135deg, #2EA9B9 100%);
        color: white;
        border-bottom: none;
        padding: 20px 30px;
    }

    .modal-title {
        font-weight: 700;
        font-size: 1.6rem;
        display: flex;
        align-items: center;
        gap: 10px;
    }

    .modal-title::before {
        content: '\f007';
        font-family: 'Font Awesome 6 Free';
        font-weight: 900;
        font-size: 1.2rem;
    }

    .modal-body {
        padding: 30px;
        background: #ffffff;
        min-height: 400px;
    }

    .btn-close {
        filter: invert(1);
        opacity: 0.8;
    }

    .btn-close:hover {
        opacity: 1;
        transform: scale(1.1);
    }

    /* Special styling for investment section */
    .investment-section .info-item {
        background: linear-gradient(135deg, #ffeaa7 0%, #fab1a0 100%);
        border: 2px solid #fdcb6e;
        color: #2d3436;
    }

    .investment-section .info-label {
        color: #2d3436;
        font-weight: 800;
    }

    .investment-section .info-value {
        color: #2d3436;
        font-weight: 600;
        font-size: 1.1rem;
    }

    /* Revenue styling for registered business */
    .revenue-item {
        background: linear-gradient(135deg, #2EA9B9 100%);
        color: white;
        padding: 20px;
        border-radius: 12px;
        text-align: center;
        position: relative;
        overflow: hidden;
    }

    .revenue-item::before {
        content: '';
        position: absolute;
        top: -50%;
        left: -50%;
        width: 200%;
        height: 200%;
        background: radial-gradient(circle, rgba(255, 255, 255, 0.1) 0%, transparent 70%);
        animation: pulse 3s ease-in-out infinite;
    }

    @keyframes pulse {

        0%,
        100% {
            opacity: 0.5;
        }

        50% {
            opacity: 1;
        }
    }

    .revenue-label {
        font-size: 0.9rem;
        opacity: 0.9;
        margin-bottom: 5px;
    }

    .revenue-value {
        font-size: 1.3rem;
        font-weight: 700;
    }

    /* Responsive Design */
    @media (max-width: 768px) {
        .info-grid {
            grid-template-columns: 1fr;
        }

        .resume-section {
            padding: 20px 15px;
            margin-bottom: 20px;
        }

        .section-title {
            font-size: 1.3rem;
        }

        .product-image {
            max-width: 60px;
            max-height: 60px;
        }

        .modal-body {
            padding: 20px 15px;
        }
    }

    /* Custom scrollbar */
    .modal-body::-webkit-scrollbar {
        width: 8px;
    }

    .modal-body::-webkit-scrollbar-track {
        background: #f1f1f1;
        border-radius: 10px;
    }

    .modal-body::-webkit-scrollbar-thumb {
        background: #888;
        border-radius: 10px;
    }

    .modal-body::-webkit-scrollbar-thumb:hover {
        background: #555;
    }

    /* Animation for modal entrance */
    .modal.fade .modal-dialog {
        transition: transform 0.3s ease-out;
    }

    .modal.show .modal-dialog {
        transform: none;
    }

    /* Enhanced hover effects */
    .resume-section:hover::before {
        width: 8px;
        transition: width 0.3s ease;
    }

    /* Professional touch */
    .info-item {
        border-left: 4px solid transparent;
        transition: all 0.3s ease;
    }

    .info-item:hover {
        border-left-color: #3498db;
    }

    /* Better text contrast */
    .info-label {
        background: rgba(52, 152, 219, 0.1);
        padding: 4px 8px;
        border-radius: 4px;
        display: inline-block;
    }

    /* Loading animation (optional) */
    .loading {
        display: inline-block;
        width: 20px;
        height: 20px;
        border: 3px solid #f3f3f3;
        border-top: 3px solid #3498db;
        border-radius: 50%;
        animation: spin 1s linear infinite;
    }

    @keyframes spin {
        0% {
            transform: rotate(0deg);
        }

        100% {
            transform: rotate(360deg);
        }
    }

    /* Icon styling */
    .section-title i {
        color: #3498db;
        font-size: 1.2rem;
    }

    /* Better spacing for business status */
    .info-item:has(.status-badge) {
        display: flex;
        align-items: center;
        gap: 10px;
    }

    /* Photo gallery styling */
    .photo-gallery {
        display: flex;
        flex-wrap: wrap;
        gap: 10px;
        margin-top: 10px;
    }

    .photo-gallery .product-image {
        margin: 0;
    }

    /* Print-friendly styles */
    @media print {
        .resume-container {
            box-shadow: none;
        }

        .resume-section {
            box-shadow: none;
            border: 1px solid #ddd;
            page-break-inside: avoid;
        }

        .info-item {
            border: 1px solid #ddd;
            background: white !important;
        }
    }
</style>
@section('content')
    <!-- Table -->
    <div class="card shadow-sm rounded-3">
        <div class="card-body">
            <div class="d-flex justify-content-between align-items-center mb-4">
                {{-- <h2 class="mb-0">
                    <i class="bi bi-people-fill me-2"></i>
                    Entrepreneurs
                </h2> --}}
                {{-- <span class="badge bg-primary fs-6">
                    Total: {{ count($entrepreneur) }} Entrepreneurs
                </span> --}}
            </div>
            {{-- <div class="bg-light text-white py-4 px-3 rounded mb-4">
                <div class="d-flex justify-content-center align-items-center flex-wrap">
                    <div class="d-flex" style="height: 45px;">
                        <!-- Filter Tabs -->
                        <div class="btn-group" role="group">
                            <a href="?filter=idea" class="btn btn-light active">Business Idea</a>
                            <a href="?filter=trending" class="btn btn-light">Trending</a>
                            <a href="?filter=country" class="btn btn-light">Country</a>
                            <a href="?filter=describe" class="btn btn-light">Business Describe</a>
                        </div>

                        <!-- Search Form -->
                        <div href="" class="" style="padding-left: 5px;">
                            <form action="{{ route('search') }}" method="GET" class="d-flex">
                                <input type="text" name="query" class="form-control border-start-0"
                                    placeholder="Search by company name or keyword..." style="height: 45px; border-radius: 0;">
                            </form>
                        </div>
                    </div>
                </div>
            </div> --}}

            <div class="bg-light d-flex justify-content-center align-items-center flex-wrap text-white py-4">
                <div class="d-flex" style="height: 45px;">
                    <!-- Filter Tabs -->
                    <div class="btn-group" role="group">
                        <a href="{{ route('admin.entrepreneurs', ['filter' => 'latest']) }}"
                            class="btn btn-light {{ request('filter') == 'latest' || !request('filter') ? 'active' : '' }}">
                            Latest
                        </a>
                        {{-- <a href="{{ route('admin.entrepreneurs', ['filter' => 'trending']) }}"
                            class="btn btn-light {{ request('filter') == 'trending' ? 'active' : '' }}">
                            Trending
                        </a>
                        <a href="{{ route('admin.entrepreneurs', ['filter' => 'alreadyfunded']) }}"
                            class="btn btn-light {{ request('filter') == 'alreadyfunded' ? 'active' : '' }}">
                            Already Funded
                        </a> --}}
                        <a href="{{ route('admin.entrepreneurs', ['filter' => 'approved']) }}"
                            class="btn btn-light {{ request('filter') == 'approved' ? 'active' : '' }}">
                            Approved
                        </a>
                    </div>

                    <!-- Search Form -->
                    <div style="padding-left: 5px;">
                        <form action="{{ route('admin.entrepreneurs') }}" method="GET" class="d-flex">
                            <input type="hidden" name="filter" value="{{ request('filter') }}">
                            <input type="text" name="query" class="form-control border-start-0"
                                placeholder="Search by business name, country, or capital..." value="{{ request('query') }}"
                                style="height: 45px; border-radius: 2;">
                        </form>
                    </div>
                    @if (session('selected_role') === 'admin')
                        <div class="ml-3" style="padding-left: 20px;">
                            <a href="{{ route('admin.download', request()->all()) }}" class="btn btn-lg btn-primary">
                                Download
                            </a>
                        </div>
                    @endif
                </div>
            </div>

            <div class="table-container">
                <div class="table-responsive">
                    <table class="table table-hover mb-0">
                        <thead class="table-light sticky-top">
                            <tr>
                                <th scope="col" style="min-width: 50px;">#</th>
                                <th scope="col" style="min-width: 150px;">Full Name</th>
                                @unless (session('selected_role') === 'investor')
                                    <th scope="col" style="min-width: 200px;">Email</th>
                                    <th scope="col" style="min-width: 130px;">Phone</th>
                                @endunless
                                <th scope="col" style="min-width: 100px;">Country</th>
                                <th scope="col" style="min-width: 100px;">Business Name</th>
                                {{-- <th scope="col" style="min-width: 80px;">Funding Requirement</th> --}}
                                @unless (session('selected_role') === 'investor')
                                    <th scope="col" style="min-width: 80px;">Video Link</th>
                                @endunless
                                @unless (session('selected_role') === 'admin')
                                    <th scope="col" style="min-width: 80px;">Video Link</th>
                                @endunless
                                @if (session('selected_role') === 'investor')
                                    {{-- <th scope="col" style="min-width: 80px;">Remark</th> --}}
                                    <th scope="col" style="min-width: 80px;">Intrested</th>
                                @endif
                                @if (session('selected_role') === 'admin')
                                    <th scope="col" style="min-width: 80px;">Reject</th>
                                    <th scope="col" style="min-width: 80px;">Youtube Link</th>
                                    <th scope="col" style="min-width: 80px;">Edit Image</th>
                                    <th scope="col" style="min-width: 80px;">Approved</th>
                                @endif
                                <th scope="col" style="min-width: 100px;">Action</th>
                            </tr>
                        </thead>
                        <tbody>
                            @forelse($entrepreneur as $index => $entrepreneurs)
                                <tr>
                                    <td>{{ $entrepreneur->firstItem() + $index }}</td>
                                    <td>
                                        <strong>{{ $entrepreneurs->full_name }}</strong>
                                    </td>
                                    @unless (session('selected_role') === 'investor')
                                        <td>
                                            <a href="mailto:{{ $entrepreneurs->email }}" class="text-decoration-none">
                                                {{ $entrepreneurs->email }}
                                            </a>
                                        </td>
                                        <td>
                                            <a href="tel:{{ $entrepreneurs->phone_number }}" class="text-decoration-none">
                                                {{ $entrepreneurs->phone_number }}
                                            </a>
                                        </td>
                                    @endunless
                                    <td>
                                        <span class="badge bg-secondary badge-custom">
                                            {{ $entrepreneurs->country }}
                                        </span>
                                    </td>
                                    <td>
                                        <span>
                                            @if ($entrepreneurs->register_business == 1)
                                                {{ $entrepreneurs->y_business_name }}
                                            @else
                                                {{ $entrepreneurs->business_name }}
                                            @endif
                                        </span>
                                    </td>

                                    {{-- <td>                                                                                                                                                                                                                                                                                                   </td> --}}
                                    @unless (session('selected_role') === 'investor')
                                        <td>
                                            @if (!empty($entrepreneurs->video_upload))
                                                <a href="{{ $entrepreneurs->video_upload }}" target="_blank">
                                                    Video Link
                                                </a>
                                            @else
                                                <span class="text-muted">No video</span>
                                            @endif
                                        </td>
                                    @endunless
                                    @unless (session('selected_role') === 'admin')
                                        <td>
                                            @if (!empty($entrepreneurs->pitch_video))
                                                <a href="{{ $entrepreneurs->pitch_video }}" target="_blank">
                                                    Video Link
                                                </a>
                                            @else
                                                <span class="text-muted">No video</span>
                                            @endif
                                        </td>
                                    @endunless
                                    @unless (session('selected_role') === 'investor')
                                        {{-- @unless (Auth::user()->role === 'investor') --}}
                                        <td>
                                            @php
                                                $user = Auth::guard('web')->user();
                                                $isInvestor = $user && $user->role === 'admin'; // Check for admin role
                                                $investor = null; // No need to query Investor model for admin
                                                $hasRejected = false;

                                                if ($user && $isInvestor) {
                                                    // Check if the admin (user) has rejected the entrepreneur
                                                    $hasRejected = \App\Models\InvestorRejectEntrepreneur::where(
                                                        'user_id',
                                                        $user->id,
                                                    ) // Use user_id instead of investor_id
                                                        ->where('entrepreneur_id', $entrepreneurs->id)
                                                        ->exists();
                                                }
                                            @endphp
                                            <button
                                                class="btn btn-sm {{ $hasRejected ? 'btn-success' : 'btn-danger' }} rejected-btn"
                                                data-id="{{ $entrepreneurs->id }}" data-bs-toggle="modal"
                                                data-bs-target="#rejectReasonModal"
                                                {{ $hasRejected || !$isInvestor ? 'disabled' : '' }}>
                                                {{ $hasRejected ? 'Rejected ✔' : 'Rejected' }}
                                            </button>
                                        </td>
                                        <td>
                                            <button class="btn btn-sm btn-primary video-btn" data-id="{{ $entrepreneurs->id }}"
                                                data-video="{{ $entrepreneurs->pitch_video }}" data-bs-toggle="modal"
                                                data-bs-target="#videoModal">
                                                Youtube Link
                                            </button>
                                        </td>
                                        <td>
                                            <button class="btn btn-sm btn-primary" data-id="{{ $entrepreneurs->id }}"
                                                data-business-logo="{{ $entrepreneurs->business_logo_admin }}"
                                                data-y-business-logo="{{ $entrepreneurs->y_business_logo_admin }}"
                                                data-product-photos="{{ $entrepreneurs->product_photos_admin }}"
                                                data-y-product-photos="{{ $entrepreneurs->y_product_photos_admin }}"
                                                data-register-business="{{ $entrepreneurs->register_business }}"
                                                data-bs-toggle="modal" data-bs-target="#productLogo">
                                                Products/Logo
                                            </button>
                                        </td>
                                    @endunless
                                    @if (session('selected_role') === 'investor')
                                        {{-- @if (Auth::user()->role === 'investor') --}}
                                        {{-- <td>
                                            @php
                                                $user = Auth::guard('web')->user();
                                                $isInvestor = $user && $user->role === 'investor';
                                                $investor = $user
                                                    ? \App\Models\Investor::where('user_id', $user->id)->first()
                                                    : null;
                                                $hasRemark =
                                                    $investor &&
                                                    \App\Models\RemarkEntrepreneur::where('investor_id', $investor->id)
                                                        ->where('entrepreneur_id', $entrepreneurs->id)
                                                        ->exists();
                                            @endphp
                                            <button
                                                class="btn btn-sm {{ $hasRemark ? 'btn-success' : 'btn-primary' }} remark-btn"
                                                data-id="{{ $entrepreneurs->id }}" data-bs-toggle="modal"
                                                data-bs-target="#remarkModal"
                                                {{ $hasRemark || !$isInvestor ? 'disabled' : '' }}>
                                                {{ $hasRemark ? 'Remarked ✔' : 'Remark' }}
                                            </button>
                                        </td> --}}

                                        {{-- <td>
                                            @php
                                                $interested = \App\Models\Interest::where(
                                                    'entrepreneur_id',
                                                    $entrepreneurs->id,
                                                )
                                                    ->where('investor_id', Auth::id())
                                                    ->exists();
                                            @endphp
                                            <button
                                                class="btn btn-sm {{ $interested ? 'btn-success' : 'btn-danger' }} interested-btn"
                                                data-id="{{ $entrepreneurs->id }}" {{ $interested ? 'disabled' : '' }}
                                                data-market-capital="{{ $entrepreneurs->market_capital }}"
                                                data-your-stake="{{ $entrepreneurs->your_stake }}"
                                                data-company-value="{{ $entrepreneurs->stake_funding }}"
                                                data-debug="Interested button: {{ $interested ? 'true' : 'false' }}"
                                                data-bs-toggle="modal" data-bs-target="#interestModal">
                                                {{ $interested ? 'Interested ✔' : 'Interested' }}
                                            </button>
                                        </td> --}}
                                        <td>
                                            @php
                                                $interested = \App\Models\Interest::where(
                                                    'entrepreneur_id',
                                                    $entrepreneurs->id,
                                                )
                                                    ->where('investor_id', Auth::id())
                                                    ->exists();
                                            @endphp
                                            <button
                                                class="btn btn-sm {{ $interested ? 'btn-success' : 'btn-danger' }} interested-btn"
                                                data-id="{{ $entrepreneurs->id }}" {{ $interested ? 'disabled' : '' }}
                                                data-market-capital="{{ $entrepreneurs->register_business == 1 ? $entrepreneurs->y_market_capital : $entrepreneurs->market_capital }}"
                                                data-your-stake="{{ $entrepreneurs->register_business == 1 ? $entrepreneurs->y_your_stake : $entrepreneurs->your_stake }}"
                                                data-company-value="{{ $entrepreneurs->register_business == 1 ? $entrepreneurs->y_stake_funding : $entrepreneurs->stake_funding }}"
                                                data-register-business="{{ $entrepreneurs->register_business }}"
                                                data-debug="Interested button: {{ $interested ? 'true' : 'false' }}"
                                                data-bs-toggle="modal" data-bs-target="#interestModal">
                                                {{ $interested ? 'Interested ✔' : 'Interested' }}
                                            </button>
                                        </td>
                                    @endif

                                    {{-- @unless (Auth::user()->role === 'investor')
                                    <td>
                                        <div class="form-check form-switch">
                                            <input class="form-check-input custom-switch-scale toggle-approval"
                                                type="checkbox" role="switch" data-id="{{ $entrepreneurs->id }}"
                                                {{ $entrepreneurs->approved ? 'checked' : '' }}>
                                        </div>
                                    </td>
                                @endunless --}}
                                    @unless (session('selected_role') === 'investor')
                                        <td>
                                            <div class="form-check form-switch">
                                                <input class="form-check-input custom-switch-scale toggle-approval"
                                                    type="checkbox" role="switch" data-id="{{ $entrepreneurs->id }}"
                                                    {{ $entrepreneurs->approved ? 'checked' : '' }}>
                                            </div>
                                        </td>
                                    @endunless
                                    <td>
                                        <button class="btn btn-sm btn-primary view-details-btn"
                                            data-id="{{ $entrepreneurs->id }}"
                                            data-name="{{ $entrepreneurs->full_name }}"
                                            @unless (session('selected_role') === 'investor')
            data-email="{{ $entrepreneurs->email }}"
            data-countrycode="{{ $entrepreneurs->country_code }}"
            data-phone="{{ $entrepreneurs->phone_number }}"
            data-website="{{ $entrepreneurs->website_links }}"
            data-address="{{ $entrepreneurs->current_address }}"
        @endunless
                                            data-qualification="{{ $entrepreneurs->qualification }}"
                                            data-country="{{ $entrepreneurs->country }}"
                                            data-age="{{ $entrepreneurs->age }}" data-dob="{{ $entrepreneurs->dob }}"
                                            data-city="{{ $entrepreneurs->city }}"
                                            data-state="{{ $entrepreneurs->state }}"
                                            data-pincode="{{ $entrepreneurs->pin_code }}"
                                            data-industry="{{ $entrepreneurs->industry }}"
                                            data-registerbusiness="{{ $entrepreneurs->register_business }}"
                                            @if ($entrepreneurs->register_business == 0) data-businessname="{{ $entrepreneurs->business_name }}"
            data-brandname="{{ $entrepreneurs->brand_name }}"
            data-businesscountry="{{ $entrepreneurs->business_country }}"
            data-businessstate="{{ $entrepreneurs->business_state }}"
            data-businesscity="{{ $entrepreneurs->business_city }}"
            data-describe="{{ $entrepreneurs->business_describe }}"
            data-businessaddress="{{ $entrepreneurs->business_address }}"
            data-ownfund="{{ $entrepreneurs->own_fund }}" 
            data-loan="{{ $entrepreneurs->loan }}"
            data-amount="{{ $entrepreneurs->invested_amount }}" 
            data-marketcapital="{{ $entrepreneurs->market_capital }}"
            data-yourstake="{{ $entrepreneurs->your_stake }}"
            data-stakefunding="{{ $entrepreneurs->stake_funding }}"
            data-product_photos="{{ is_array(json_decode($entrepreneurs->product_photos, true)) ? implode(',', json_decode($entrepreneurs->product_photos, true)) : '' }}"
            data-business_logo="{{ str_replace('business_logos/', '', $entrepreneurs->business_logo) }}"
            data-pitch_deck="{{ str_replace('pitch_decks/', '', $entrepreneurs->pitch_deck) }}" @endif
                                            @if ($entrepreneurs->register_business == 1) data-employee_number="{{ $entrepreneurs->employee_number }}"
            data-founder="{{ $entrepreneurs->founder_number }}"
            data-y_business_name="{{ $entrepreneurs->y_business_name }}"
            @unless (session('selected_role') === 'investor')
                data-businessemail="{{ $entrepreneurs->business_email }}"
                data-businessmobile="{{ $entrepreneurs->business_mobile }}"
            @endunless
            data-taxregistrationnumber="{{ $entrepreneurs->tax_registration_number }}"
            data-y_brand_name="{{ $entrepreneurs->y_brand_name }}"
            data-businessyear="{{ $entrepreneurs->business_year }}"
            data-yearcount="{{ $entrepreneurs->business_year_count }}"
            data-y_describe_business="{{ $entrepreneurs->y_describe_business }}"
            data-y_business_address="{{ $entrepreneurs->y_business_address }}"
            data-y_business_country="{{ $entrepreneurs->y_business_country }}"
            data-y_business_state="{{ $entrepreneurs->y_business_state }}"
            data-y_business_city="{{ $entrepreneurs->y_business_city }}"
            data-y_zipcode="{{ $entrepreneurs->y_zipcode }}"
            data-y_type_industries="{{ $entrepreneurs->y_type_industries }}"
            data-y_own_fund="{{ $entrepreneurs->y_own_fund }}"
            data-y_loan="{{ $entrepreneurs->y_loan }}"
            data-y_invested_amount="{{ $entrepreneurs->y_invested_amount }}"
            data-revenue1="{{ $entrepreneurs->business_revenue1 }}"
            data-revenue2="{{ $entrepreneurs->business_revenue2 }}"
            data-revenue3="{{ $entrepreneurs->business_revenue3 }}"
            data-y_product_photos="{{ implode(',', json_decode($entrepreneurs->y_product_photos, true)) }}"
            data-y_business_logo="{{ str_replace('y_business_logos/', '', $entrepreneurs->y_business_logo) }}"
            data-y_pitch_deck="{{ str_replace('y_pitch_decks/', '', $entrepreneurs->y_pitch_deck) }}"
            data-market_capital="{{ $entrepreneurs->y_market_capital }}"
            data-your_stake="{{ $entrepreneurs->y_your_stake }}"
            data-stake_funding="{{ $entrepreneurs->y_stake_funding }}" @endif>
                                            View Details
                                        </button>
                                        @unless (session('selected_role') === 'investor')
                                            <button class="btn btn-sm btn-danger delete-btn"
                                                data-id="{{ $entrepreneurs->id }}">
                                                Delete
                                            </button>
                                        @endunless
                                    </td>
                                </tr>
                            @empty
                                <tr>
                                    <td colspan="14" class="text-center py-4">
                                        <div class="text-muted">
                                            <i class="bi bi-inbox display-4 d-block mb-3"></i>
                                            <h5>No Entrepreneurs Found</h5>
                                            <p class="mb-0">No Entrepreneurs have been registered yet.</p>
                                        </div>
                                    </td>
                                </tr>
                            @endforelse
                        </tbody>
                    </table>
                </div>
            </div>

            {{-- product logo edit --}}
            <div class="modal fade" id="productLogo" tabindex="-1" aria-labelledby="productLogoLabel"
                aria-hidden="true">
                <div class="modal-dialog modal-lg">
                    <form id="productLogoForm" enctype="multipart/form-data">
                        @csrf
                        <input type="hidden" name="entrepreneur_id" id="productLogoEntrepreneurId">

                        <div class="modal-content">
                            <div class="modal-header">
                                <h5 class="modal-title" id="productLogoLabel">Update Products & Logo</h5>
                                <button type="button" class="btn-close" data-bs-dismiss="modal"
                                    aria-label="Close"></button>
                            </div>

                            <div class="modal-body">
                                <!-- Business Logo (for register_business = 0) -->
                                <div class="mb-3" id="businessLogoSection" style="display: none;">
                                    <label for="businessLogo" class="form-label">Business Logo</label>
                                    <input type="file" class="form-control" id="businessLogo"
                                        name="business_logo_admin" accept="image/*">
                                    <div id="businessLogoPreview" class="mt-2">
                                        <img id="businessLogoImg" src="" alt="Business Logo Preview"
                                            style="max-width: 200px; display: none;">
                                    </div>
                                </div>

                                <!-- Product Photos (for register_business = 0) -->
                                <div class="mb-3" id="productPhotosSection" style="display: none;">
                                    <label for="productPhotos" class="form-label">Product Photos</label>
                                    <input type="file" class="form-control" id="productPhotos"
                                        name="product_photos_admin[]" multiple accept="image/*">
                                    <div id="productPhotosPreview" class="mt-2 d-flex flex-wrap gap-2"></div>
                                </div>

                                <!-- YouTube Business Logo (for register_business = 1) -->
                                <div class="mb-3" id="yBusinessLogoSection" style="display: none;">
                                    <label for="yBusinessLogo" class="form-label">YouTube Business Logo</label>
                                    <input type="file" class="form-control" id="yBusinessLogo"
                                        name="y_business_logo_admin" accept="image/*">
                                    <div id="yBusinessLogoPreview" class="mt-2">
                                        <img id="yBusinessLogoImg" src="" alt="YouTube Logo Preview"
                                            style="max-width: 200px; display: none;">
                                    </div>
                                </div>

                                <!-- YouTube Product Photos (for register_business = 1) -->
                                <div class="mb-3" id="yProductPhotosSection" style="display: none;">
                                    <label for="yProductPhotos" class="form-label">YouTube Product Photos</label>
                                    <input type="file" class="form-control" id="yProductPhotos"
                                        name="y_product_photos_admin[]" multiple accept="image/*">
                                    <div id="yProductPhotosPreview" class="mt-2 d-flex flex-wrap gap-2"></div>
                                </div>
                            </div>

                            <div class="modal-footer">
                                <button type="submit" class="btn btn-success">Save</button>
                                <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Cancel</button>
                            </div>
                        </div>
                    </form>
                </div>
            </div>

            <!-- Video URL Modal -->
            <div class="modal fade" id="videoModal" tabindex="-1" aria-labelledby="videoModalLabel"
                aria-hidden="true">
                <div class="modal-dialog">
                    <form id="videoForm">
                        @csrf
                        <input type="hidden" name="entrepreneur_id" id="videoEntrepreneurId">

                        <div class="modal-content">
                            <div class="modal-header">
                                <h5 class="modal-title" id="videoModalLabel">Update Pitch Video URL</h5>
                                <button type="button" class="btn-close" data-bs-dismiss="modal"
                                    aria-label="Close"></button>
                            </div>

                            <div class="modal-body">
                                <div class="mb-3">
                                    <label for="pitchVideoUrl" class="form-label">Pitch Video URL</label>
                                    <input type="url" class="form-control" id="pitchVideoUrl" name="pitch_video"
                                        required placeholder="https://example.com/video.mp4">
                                </div>
                            </div>


                            <div class="modal-footer">
                                <button type="submit" class="btn btn-success">Save</button>
                                <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Cancel</button>
                            </div>
                        </div>
                    </form>
                </div>
            </div>

            <div class="modal fade" id="deleteConfirmationModal" tabindex="-1"
                aria-labelledby="deleteConfirmationModalLabel" aria-hidden="true">
                <div class="modal-dialog">
                    <div class="modal-content">
                        <div class="modal-header">
                            <h5 class="modal-title" id="deleteConfirmationModalLabel">Confirm Deletion</h5>
                            <button type="button" class="btn-close" data-bs-dismiss="modal"
                                aria-label="Close"></button>
                        </div>
                        <div class="modal-body">
                            Are you sure you want to delete this entrepreneur? This action cannot be undone.
                        </div>
                        <div class="modal-footer">
                            <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Cancel</button>
                            <button type="button" class="btn btn-danger" id="confirmDeleteBtn">Delete</button>
                        </div>
                    </div>
                </div>
            </div>

            <!-- Success Toast -->
            <div class="position-fixed bottom-0 end-0 p-3" style="z-index: 11">
                <div id="successToast" class="toast hide" role="alert" aria-live="assertive" aria-atomic="true">
                    <div class="toast-header">
                        <strong class="me-auto">Success</strong>
                        <button type="button" class="btn-close" data-bs-dismiss="toast" aria-label="Close"></button>
                    </div>
                    <div class="toast-body">
                        Entrepreneur deleted successfully.
                    </div>
                </div>
            </div>
            <!-- Modal for Rejection Reason -->
            <div class="mt-4">
                {{ $entrepreneur->links('pagination::bootstrap-5') }}
            </div>
        </div>
    </div>

    <div class="modal fade" id="rejectReasonModal" tabindex="-1" aria-labelledby="rejectReasonModalLabel"
        aria-hidden="true">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="rejectReasonModalLabel">Reject Entrepreneur</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <form id="rejectReasonForm" method="POST">
                    @csrf
                    <input type="hidden" name="entrepreneur_id" id="entrepreneur_id">
                    <div class="modal-body">
                        <div class="mb-3">
                            <label for="reject_reason" class="form-label">Reason for Rejection *</label>
                            <textarea class="form-control" name="reject_reason" id="reject_reason" rows="3" required
                                placeholder="Please provide a reason for rejecting this entrepreneur..."></textarea>
                        </div>
                    </div>
                    <div class="modal-footer">
                        <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
                        <button type="submit" class="btn btn-danger">Submit Rejection</button>
                    </div>
                </form>
            </div>
        </div>
    </div>

    <!-- Interest Modal -->
    <div class="modal fade" id="interestModal" tabindex="-1" aria-labelledby="interestModalLabel" aria-hidden="true">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="interestModalLabel">Confirm Interest</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <form id="interestForm" method="POST">
                    @csrf
                    <input type="hidden" name="entrepreneur_id" id="interest_entrepreneur_id">
                    <input type="hidden" name="form_type" id="form_type" value="remark">
                    <div class="modal-body">
                        <div class="mb-3">
                            <label class="form-label">Offer Type *</label>
                            <div>
                                <div class="form-check form-check-inline">
                                    <input class="form-check-input offer-type-radio" type="radio" name="offer_type"
                                        id="same_offer" value="same" checked>
                                    <label class="form-check-label" for="same_offer">Same Offer</label>
                                </div>
                                <div class="form-check form-check-inline">
                                    <input class="form-check-input offer-type-radio" type="radio" name="offer_type"
                                        id="counter_offer" value="counter">
                                    <label class="form-check-label" for="counter_offer">Counter Offer</label>
                                </div>
                            </div>
                        </div>

                        <div class="mb-3 remark-field">
                            <label for="remark_market_capital" class="form-label">Fund Asked *</label>
                            <input type="number" class="form-control" name="market_capital" id="remark_market_capital"
                                readonly required>
                        </div>
                        <div class="mb-3 remark-field">
                            <label for="remark_your_stake" class="form-label">Equity offered(%) *</label>
                            <input type="number" class="form-control" name="your_stake" id="remark_your_stake" readonly
                                required>
                        </div>
                        <div class="mb-3 remark-field">
                            <label for="remark_company_value" class="form-label">Company valuation</label>
                            <input type="text" class="form-control" name="stake_funding" id="remark_stake_funding"
                                readonly>
                        </div>
                        <div class="mb-3 remark-field">
                            <label for="remark_reason" class="form-label">Remark *</label>
                            <textarea class="form-control" name="remark_reason" id="remark_reason" rows="3" readonly required>Interested in your offer</textarea>
                        </div>
                        <div class="mb-3 counter-field" style="display: none;">
                            <label for="counter_market_capital" class="form-label">Fund Offered *</label>
                            <input type="number" class="form-control" name="counter_market_capital"
                                id="counter_market_capital" placeholder="200000" step="0.01">
                        </div>
                        <div class="mb-3 counter-field" style="display: none;">
                            <label for="counter_your_stake" class="form-label">Equity Asked (%) *</label>
                            <input type="number" class="form-control" name="counter_your_stake" id="counter_your_stake"
                                placeholder="10" step="0.01">
                        </div>
                        <div class="mb-3 counter-field" style="display: none;">
                            <label for="counter_company_value" class="form-label">Company Valuation </label>
                            <input type="text" class="form-control" name="counter_company_value"
                                id="counter_company_value" readonly placeholder="10000">
                        </div>
                        <div class="mb-3 counter-field" style="display: none;">
                            <label for="counter_reason" class="form-label">Reamrk *</label>
                            <textarea class="form-control" name="counter_reason" id="counter_reason" rows="3"
                                placeholder="Provide a reason for this counter offer..."></textarea>
                        </div>
                    </div>
                    <div class="modal-footer">
                        <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
                        {{-- <button type="button" class="btn btn-warning counter-offer-btn">Counter Offere</button> --}}
                        <button type="submit" class="btn btn-primary">Submit</button>
                    </div>
                </form>
            </div>
        </div>
    </div>

    <!-- New Remark Modal -->
    <div class="modal fade" id="remarkModal" tabindex="-1" aria-labelledby="remarkModalLabel" aria-hidden="true">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="remarkModalLabel">Add Remark for Entrepreneur</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <form id="remarkForm" method="POST">
                    @csrf
                    <input type="hidden" name="entrepreneur_id" id="remark_entrepreneur_id">
                    <div class="modal-body">
                        <div class="mb-3">
                            <label for="remark_market_capital" class="form-label">Fund Asked *</label>
                            <input type="number" class="form-control" name="remark_market_capital"
                                id="remark_market_capital2" required placeholder="200000" step="0.01" min="0">
                        </div>
                        <div class="mb-3">
                            <label for="remark_your_stake" class="form-label">Equity offered(%) *</label>
                            <input type="number" class="form-control" name="remark_your_stake" id="remark_your_stake2"
                                required placeholder="10" step="0.01" min="0" max="100">
                        </div>
                        <div class="mb-3">
                            <label for="remark_company_value" class="form-label">Company valuation</label>
                            <input type="text" class="form-control" name="remark_company_value"
                                id="remark_company_value2" readonly placeholder="10000">
                        </div>
                        <div class="mb-3">
                            <label for="remark_reason" class="form-label">Remark *</label>
                            <textarea class="form-control" name="remark_reason" id="remark_reason2" rows="3" required
                                placeholder="Provide a reason for this remark..."></textarea>
                        </div>
                    </div>
                    <div class="modal-footer">
                        <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
                        <button type="submit" class="btn btn-primary">Submit Remark</button>
                    </div>
                </form>
            </div>
        </div>
    </div>
    <div class="modal fade" id="investorDetailModal" tabindex="-1" aria-labelledby="investorDetailModalLabel"
        aria-hidden="true">
        <div class="modal-dialog modal-xl modal-dialog-scrollable">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="investorDetailModalLabel">Entrepreneur Profile</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body">
                    {{-- <h4 id="modal-investor-name" class="mb-4"></h4> --}}
                    <div class="resume-container">
                        <div id="modal-professional-table-body"></div>
                        {{-- <div class="table-responsive mb-4 mt-4">
                            <h5 class="section-title">Company Investments</h5>
                            <table class="table table-bordered table-striped">
                                <thead class="table-light">
                                    <tr>
                                        <th>#</th>
                                        <th>Company Name</th>
                                        <th>Investment</th>
                                        <th>Equity Holding (%)</th>
                                        <th>Company Valuation</th>
                                    </tr>
                                </thead>
                                <tbody id="modal-company-table-body">
                                    <tr>
                                        <td colspan="5" class="text-center text-muted">Loading...</td>
                                    </tr>
                                </tbody>
                            </table>
                        </div> --}}
                    </div>
                </div>
            </div>
        </div>
    </div>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
    <script src="https://code.jquery.com/jquery-3.7.1.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
    <!-- Existing HTML remains the same, only updating the JavaScript -->
    <script>
        document.addEventListener('DOMContentLoaded', function() {
            const productLogoModal = document.getElementById('productLogo');
            productLogoModal.addEventListener('show.bs.modal', function(event) {
                const button = event.relatedTarget;
                const entrepreneurId = button.getAttribute('data-id');
                const registerBusiness = button.getAttribute('data-register-business');
                const businessLogo = button.getAttribute('data-business-logo');
                const yBusinessLogo = button.getAttribute('data-y-business-logo');
                const productPhotos = button.getAttribute('data-product-photos');
                const yProductPhotos = button.getAttribute('data-y-product-photos');

                console.log(`Entrepreneur ID: ${entrepreneurId}, Register Business: ${registerBusiness}`);
                console.log('Modal opened with data:', {
                    entrepreneurId,
                    registerBusiness,
                    businessLogo,
                    yBusinessLogo,
                    productPhotos,
                    yProductPhotos
                });

                // Set entrepreneur ID
                document.getElementById('productLogoEntrepreneurId').value = entrepreneurId;

                // Get all sections
                const businessLogoSection = document.getElementById('businessLogoSection');
                const productPhotosSection = document.getElementById('productPhotosSection');
                const yBusinessLogoSection = document.getElementById('yBusinessLogoSection');
                const yProductPhotosSection = document.getElementById('yProductPhotosSection');

                // Show/hide sections based on register_business value
                if (registerBusiness === '0') {
                    // Show regular business sections
                    if (businessLogoSection) businessLogoSection.style.display = 'block';
                    if (productPhotosSection) productPhotosSection.style.display = 'block';
                    // Hide YouTube sections
                    if (yBusinessLogoSection) yBusinessLogoSection.style.display = 'none';
                    if (yProductPhotosSection) yProductPhotosSection.style.display = 'none';

                    console.log('Showing regular business sections');
                } else if (registerBusiness === '1') {
                    // Hide regular business sections
                    if (businessLogoSection) businessLogoSection.style.display = 'none';
                    if (productPhotosSection) productPhotosSection.style.display = 'none';
                    // Show YouTube sections
                    if (yBusinessLogoSection) yBusinessLogoSection.style.display = 'block';
                    if (yProductPhotosSection) yProductPhotosSection.style.display = 'block';

                    console.log('Showing YouTube business sections');
                }

                // Handle existing business logo
                const businessLogoImg = document.getElementById('businessLogoImg');
                if (businessLogo && businessLogoImg && registerBusiness === '0') {
                    businessLogoImg.src = `/storage/${businessLogo}`;
                    businessLogoImg.style.display = 'block';
                } else if (businessLogoImg) {
                    businessLogoImg.style.display = 'none';
                }

                // Handle existing YouTube business logo
                const yBusinessLogoImg = document.getElementById('yBusinessLogoImg');
                if (yBusinessLogo && yBusinessLogoImg && registerBusiness === '1') {
                    yBusinessLogoImg.src = `/storage/${yBusinessLogo}`;
                    yBusinessLogoImg.style.display = 'block';
                } else if (yBusinessLogoImg) {
                    yBusinessLogoImg.style.display = 'none';
                }

                // Handle existing product photos
                const productPhotosPreview = document.getElementById('productPhotosPreview');
                if (productPhotosPreview && productPhotos && registerBusiness === '0') {
                    productPhotosPreview.innerHTML = '';
                    const photos = productPhotos.split(',');
                    photos.forEach(photo => {
                        if (photo.trim()) {
                            const img = document.createElement('img');
                            img.src = `/storage/${photo.trim()}`;
                            img.alt = 'Product Photo';
                            img.style.maxWidth = '100px';
                            img.style.margin = '5px';
                            productPhotosPreview.appendChild(img);
                        }
                    });
                } else if (productPhotosPreview) {
                    productPhotosPreview.innerHTML = '';
                }

                // Handle existing YouTube product photos
                const yProductPhotosPreview = document.getElementById('yProductPhotosPreview');
                if (yProductPhotosPreview && yProductPhotos && registerBusiness === '1') {
                    yProductPhotosPreview.innerHTML = '';
                    const photos = yProductPhotos.split(',');
                    photos.forEach(photo => {
                        if (photo.trim()) {
                            const img = document.createElement('img');
                            img.src = `/storage/${photo.trim()}`;
                            img.alt = 'YouTube Product Photo';
                            img.style.maxWidth = '100px';
                            img.style.margin = '5px';
                            yProductPhotosPreview.appendChild(img);
                        }
                    });
                } else if (yProductPhotosPreview) {
                    yProductPhotosPreview.innerHTML = '';
                }
            });

            // File input event listeners
            const businessLogoInput = document.getElementById('businessLogo');
            if (businessLogoInput) {
                businessLogoInput.addEventListener('change', function(e) {
                    const file = e.target.files[0];
                    const preview = document.getElementById('businessLogoImg');
                    if (file) {
                        preview.src = URL.createObjectURL(file);
                        preview.style.display = 'block';
                        console.log('Business logo selected:', file.name);
                    }
                });
            }

            const yBusinessLogoInput = document.getElementById('yBusinessLogo');
            if (yBusinessLogoInput) {
                yBusinessLogoInput.addEventListener('change', function(e) {
                    const file = e.target.files[0];
                    const preview = document.getElementById('yBusinessLogoImg');
                    if (file) {
                        preview.src = URL.createObjectURL(file);
                        preview.style.display = 'block';
                        console.log('YouTube business logo selected:', file.name);
                    }
                });
            }

            const productPhotosInput = document.getElementById('productPhotos');
            if (productPhotosInput) {
                productPhotosInput.addEventListener('change', function(e) {
                    const files = e.target.files;
                    const preview = document.getElementById('productPhotosPreview');
                    preview.innerHTML = '';
                    Array.from(files).forEach(file => {
                        const img = document.createElement('img');
                        img.src = URL.createObjectURL(file);
                        img.alt = 'Product Photo Preview';
                        img.style.maxWidth = '100px';
                        img.style.margin = '5px';
                        preview.appendChild(img);
                    });
                    console.log('Product photos selected:', Array.from(files).map(f => f.name));
                });
            }

            const yProductPhotosInput = document.getElementById('yProductPhotos');
            if (yProductPhotosInput) {
                yProductPhotosInput.addEventListener('change', function(e) {
                    const files = e.target.files;
                    const preview = document.getElementById('yProductPhotosPreview');
                    preview.innerHTML = '';
                    Array.from(files).forEach(file => {
                        const img = document.createElement('img');
                        img.src = URL.createObjectURL(file);
                        img.alt = 'YouTube Product Photo Preview';
                        img.style.maxWidth = '100px';
                        img.style.margin = '5px';
                        preview.appendChild(img);
                    });
                    console.log('YouTube product photos selected:', Array.from(files).map(f => f.name));
                });
            }

            // Form submission
            document.getElementById('productLogoForm').addEventListener('submit', function(e) {
                e.preventDefault();

                const form = e.target;
                const formData = new FormData(form);
                const entrepreneurId = document.getElementById('productLogoEntrepreneurId').value;

                if (!entrepreneurId) {
                    console.error('Entrepreneur ID is missing.');
                    Swal.fire({
                        icon: 'error',
                        title: 'Error',
                        text: 'Entrepreneur ID is missing.',
                        confirmButtonColor: '#d33',
                        customClass: {
                            popup: 'rounded-3'
                        }
                    });
                    return;
                }

                formData.append('entrepreneur_id', entrepreneurId);

                console.log('Form data being sent:', Object.fromEntries(formData));

                const submitButton = form.querySelector('button[type="submit"]');
                const originalButtonText = submitButton.innerHTML;

                submitButton.disabled = true;
                submitButton.innerHTML =
                    '<span class="spinner-border spinner-border-sm" role="status" aria-hidden="true"></span> Saving...';

                fetch("{{ route('admin.update.product_logo') }}", {
                        method: 'POST',
                        headers: {
                            'X-CSRF-TOKEN': '{{ csrf_token() }}'
                        },
                        body: formData
                    })
                    .then(response => {
                        console.log('Fetch response status:', response.status);
                        return response.json();
                    })
                    .then(data => {
                        console.log('Server response:', data);
                        submitButton.disabled = false;
                        submitButton.innerHTML = originalButtonText;

                        if (data.status === 'success') {
                            const modalInstance = bootstrap.Modal.getInstance(document.getElementById(
                                'productLogo'));
                            if (modalInstance) modalInstance.hide();

                            setTimeout(() => {
                                const backdrop = document.querySelector('.modal-backdrop');
                                if (backdrop) backdrop.remove();
                                document.body.classList.remove('modal-open');
                                document.body.style.overflow = '';
                                document.body.style.paddingRight = '';
                            }, 100);

                            form.reset();

                            // Reset previews
                            const businessLogoImg = document.getElementById('businessLogoImg');
                            const yBusinessLogoImg = document.getElementById('yBusinessLogoImg');
                            const productPhotosPreview = document.getElementById(
                                'productPhotosPreview');
                            const yProductPhotosPreview = document.getElementById(
                                'yProductPhotosPreview');

                            if (businessLogoImg) businessLogoImg.style.display = 'none';
                            if (yBusinessLogoImg) yBusinessLogoImg.style.display = 'none';
                            if (productPhotosPreview) productPhotosPreview.innerHTML = '';
                            if (yProductPhotosPreview) yProductPhotosPreview.innerHTML = '';

                            Swal.fire({
                                icon: 'success',
                                title: 'Success',
                                text: data.message,
                                confirmButtonColor: '#3085d6',
                                customClass: {
                                    popup: 'rounded-3'
                                }
                            });
                        } else {
                            Swal.fire({
                                icon: 'error',
                                title: 'Error',
                                text: data.message || 'Something went wrong.',
                                confirmButtonColor: '#d33',
                                customClass: {
                                    popup: 'rounded-3'
                                }
                            });
                        }
                    })
                    .catch(error => {
                        console.error('Fetch error:', error);
                        submitButton.disabled = false;
                        submitButton.innerHTML = originalButtonText;

                        Swal.fire({
                            icon: 'error',
                            title: 'Oops...',
                            text: 'An error occurred. Please try again.',
                            confirmButtonColor: '#d33',
                            customClass: {
                                popup: 'rounded-3'
                            }
                        });
                    });
            });
        });
    </script>
    <script>
        //start video edit in admin
        document.querySelectorAll('.video-btn').forEach(button => {
            button.addEventListener('click', function() {
                const id = this.getAttribute('data-id');
                const video = this.getAttribute('data-video');
                document.getElementById('videoEntrepreneurId').value = id;
                document.getElementById('pitchVideoUrl').value = video || '';
            });
        });

        document.getElementById('videoForm').addEventListener('submit', function(e) {
            e.preventDefault();

            const form = e.target;
            const formData = new FormData(form);
            const submitButton = form.querySelector('button[type="submit"]');
            const originalButtonText = submitButton.innerHTML;

            submitButton.disabled = true;
            submitButton.innerHTML =
                '<span class="spinner-border spinner-border-sm" role="status" aria-hidden="true"></span> Saving...';

            fetch("{{ route('admin.update.pitch_video') }}", {
                    method: 'POST',
                    headers: {
                        'X-CSRF-TOKEN': '{{ csrf_token() }}',
                    },
                    body: formData
                })
                .then(response => response.json())
                .then(data => {
                    submitButton.disabled = false;
                    submitButton.innerHTML = originalButtonText;

                    if (data.status === 'success') {
                        // Close modal properly
                        const modalInstance = bootstrap.Modal.getInstance(document.getElementById(
                            'videoModal'));
                        if (modalInstance) {
                            modalInstance.hide();
                        }

                        // Cleanup backdrop and body class
                        setTimeout(() => {
                            const backdrop = document.querySelector('.modal-backdrop');
                            if (backdrop) backdrop.remove();
                            document.body.classList.remove('modal-open');
                            document.body.style.overflow = '';
                            document.body.style.paddingRight = '';
                        }, 100);

                        form.reset(); // clear form fields

                        Swal.fire({
                            icon: 'success',
                            title: 'Success',
                            text: data.message,
                            confirmButtonColor: '#3085d6',
                            customClass: {
                                popup: 'rounded-3'
                            }
                        });
                    } else {
                        Swal.fire({
                            icon: 'error',
                            title: 'Error',
                            text: data.message || 'Something went wrong.',
                            confirmButtonColor: '#d33',
                            customClass: {
                                popup: 'rounded-3'
                            }
                        });
                    }
                })
                .catch(error => {
                    submitButton.disabled = false;
                    submitButton.innerHTML = originalButtonText;

                    Swal.fire({
                        icon: 'error',
                        title: 'Oops...',
                        text: 'An error occurred. Please try again.',
                        confirmButtonColor: '#d33',
                        customClass: {
                            popup: 'rounded-3'
                        }
                    });
                });
        });

        //video edit in admin end
        document.addEventListener('DOMContentLoaded', function() {
            const downloadBtn = document.querySelector('.download-btn');
            if (downloadBtn) {
                downloadBtn.addEventListener('click', function() {
                    // Get the actual data from the paginated collection
                    let entrepreneurs = @json($entrepreneur->items()); // Use ->items() to get actual data
                    console.log('Raw entrepreneurs data:', entrepreneurs);

                    // Ensure it's an array
                    if (!Array.isArray(entrepreneurs)) {
                        entrepreneurs = [entrepreneurs];
                    }

                    // Check if we have data
                    if (entrepreneurs.length === 0) {
                        alert('No data available to download');
                        return;
                    }

                    // Create CSV content with proper headers
                    const csvContent = [
                        ['Serial Number', 'Full Name', 'Phone Number', 'Email', 'Country',
                            'Business Name'
                        ],
                        ...entrepreneurs.map((entrepreneur, index) => [
                            entrepreneur.serial_number || '',
                            entrepreneur.full_name || '',
                            entrepreneur.phone_number || '',
                            entrepreneur.email || '',
                            entrepreneur.country || '',
                            entrepreneur.register_business == 1 ?
                            (entrepreneur.y_business_name || '') :
                            (entrepreneur.business_name || '')
                        ])
                    ].map(row => row.map(cell => `"${cell}"`).join(',')).join('\n');

                    // Create and download the file
                    const blob = new Blob([csvContent], {
                        type: 'text/csv;charset=utf-8;'
                    });
                    const url = window.URL.createObjectURL(blob);
                    const a = document.createElement('a');
                    a.href = url;
                    a.download = 'entrepreneurs_data_' + new Date().toISOString().slice(0, 10) + '.csv';
                    document.body.appendChild(a); // Add to DOM
                    a.click();
                    document.body.removeChild(a); // Remove from DOM
                    window.URL.revokeObjectURL(url);
                });
            }
        });
        document.addEventListener('DOMContentLoaded', function() {
            // Debug initial state of Interested buttons (unchanged)

            // Handle "Rejected" button click to open the popup
            document.querySelectorAll('.rejected-btn').forEach(button => {
                button.addEventListener('click', function() {
                    if (!button.disabled) {
                        const entrepreneurId = this.getAttribute('data-id');
                        document.getElementById('entrepreneur_id').value = entrepreneurId;
                        const modal = new bootstrap.Modal(document.getElementById(
                            'rejectReasonModal'));
                        modal.show();
                    }
                });
            });

            // Get reject modal element
            const rejectReasonModal = document.getElementById('rejectReasonModal');

            // Add event listeners to handle modal closing properly for reject modal
            rejectReasonModal.addEventListener('hidden.bs.modal', function() {
                // Remove any remaining backdrop
                const backdrop = document.querySelector('.modal-backdrop');
                if (backdrop) {
                    backdrop.remove();
                }

                // Remove modal-open class from body if it exists
                document.body.classList.remove('modal-open');

                // Reset body styles
                document.body.style.overflow = '';
                document.body.style.paddingRight = '';

                // Reset the form
                document.getElementById('rejectReasonForm').reset();
            });

            // Handle close button clicks specifically for reject modal
            document.querySelectorAll('#rejectReasonModal [data-bs-dismiss="modal"]').forEach(closeBtn => {
                closeBtn.addEventListener('click', function() {
                    const modal = bootstrap.Modal.getInstance(rejectReasonModal);
                    if (modal) {
                        modal.hide();
                    }

                    // Force cleanup
                    setTimeout(() => {
                        const backdrop = document.querySelector('.modal-backdrop');
                        if (backdrop) {
                            backdrop.remove();
                        }
                        document.body.classList.remove('modal-open');
                        document.body.style.overflow = '';
                        document.body.style.paddingRight = '';
                    }, 300);
                });
            });

            // Handle form submission for rejection
            document.getElementById('rejectReasonForm').addEventListener('submit', function(e) {
                e.preventDefault();

                // Get modal instance for proper handling
                const modalInstance = bootstrap.Modal.getInstance(rejectReasonModal);

                const entrepreneurId = document.getElementById('entrepreneur_id').value;
                const reason = document.getElementById('reject_reason').value.trim();

                // Client-side validation
                if (!reason) {
                    Swal.fire({
                        icon: 'error',
                        title: 'Invalid Input',
                        text: 'Reason for rejection is required.',
                        confirmButtonColor: '#d33',
                        customClass: {
                            popup: 'rounded-3'
                        }
                    });
                    return;
                }

                const submitButton = this.querySelector('button[type="submit"]');
                const originalButtonText = submitButton.innerHTML;

                submitButton.disabled = true;
                submitButton.innerHTML =
                    '<span class="spinner-border spinner-border-sm" role="status" aria-hidden="true"></span> Submitting...';

                fetch('/entrepreneur/reject', {
                        method: 'POST',
                        headers: {
                            'Content-Type': 'application/json',
                            'X-CSRF-TOKEN': document.querySelector('meta[name="csrf-token"]')
                                .getAttribute('content'),
                        },
                        body: JSON.stringify({
                            entrepreneur_id: entrepreneurId,
                            reason: reason,
                        }),
                    })
                    .then(response => response.json())
                    .then(data => {
                        submitButton.disabled = false;
                        submitButton.innerHTML = originalButtonText;

                        const rejectedBtn = document.querySelector(
                            `.rejected-btn[data-id="${entrepreneurId}"]`);

                        if (data.success) {
                            // Properly close modal using instance
                            if (modalInstance) {
                                modalInstance.hide();
                            }

                            // Clean up modal backdrop immediately
                            setTimeout(() => {
                                const backdrop = document.querySelector('.modal-backdrop');
                                if (backdrop) {
                                    backdrop.remove();
                                }
                                document.body.classList.remove('modal-open');
                                document.body.style.overflow = '';
                                document.body.style.paddingRight = '';
                            }, 100);

                            // Reset form
                            this.reset();

                            if (rejectedBtn) {
                                console.log('Updating Rejected button for entrepreneurId:',
                                    entrepreneurId);
                                rejectedBtn.classList.remove('btn-danger');
                                rejectedBtn.classList.add('btn-success');
                                rejectedBtn.innerHTML = 'Rejected <span style="color:white;">✔</span>';
                                rejectedBtn.disabled = true;
                            }

                            const interestedBtn = document.querySelector(
                                `.interested-btn[data-id="${entrepreneurId}"]`);
                            console.log('Interested button state after rejection:', interestedBtn ?
                                interestedBtn.textContent : 'Not found');

                            Swal.fire({
                                icon: 'success',
                                title: 'Rejection Sent!',
                                text: 'Our team at Future Taikun will connect with the entrepreneur soon.',
                                confirmButtonColor: '#28a745',
                                customClass: {
                                    popup: 'rounded-3'
                                }
                            });
                        } else {
                            Swal.fire({
                                icon: 'info',
                                title: 'Already Rejected',
                                text: data.message ||
                                    'You have already rejected this entrepreneur.',
                                confirmButtonColor: '#6c757d',
                                customClass: {
                                    popup: 'rounded-3'
                                }
                            });
                        }
                    })
                    .catch(error => {
                        submitButton.disabled = false;
                        submitButton.innerHTML = originalButtonText;

                        console.error('Error:', error);
                        Swal.fire({
                            icon: 'error',
                            title: 'Oops...',
                            text: 'An error occurred while rejecting the entrepreneur.',
                            confirmButtonColor: '#d33',
                            customClass: {
                                popup: 'rounded-3'
                            }
                        });
                    });
            });

            // Additional cleanup function for reject modal (can be called manually if needed)
            function forceCleanupRejectModal() {
                // Remove all modal backdrops
                document.querySelectorAll('.modal-backdrop').forEach(backdrop => {
                    backdrop.remove();
                });

                // Remove modal-open class from body
                document.body.classList.remove('modal-open');

                // Reset body styles
                document.body.style.overflow = '';
                document.body.style.paddingRight = '';

                // Reset reject modal state
                const rejectModal = document.getElementById('rejectReasonModal');
                if (rejectModal) {
                    rejectModal.style.display = 'none';
                    rejectModal.classList.remove('show');
                    rejectModal.setAttribute('aria-hidden', 'true');
                    rejectModal.removeAttribute('aria-modal');
                }
            }
            // Handle "Remark" button click to open the popup
            document.querySelectorAll('.remark-btn').forEach(button => {
                button.addEventListener('click', function() {
                    if (!button.disabled) {
                        const entrepreneurId = this.getAttribute('data-id');
                        document.getElementById('remark_entrepreneur_id').value = entrepreneurId;
                        const modal = new bootstrap.Modal(document.getElementById('remarkModal'));
                        modal.show();
                    }
                });
            });

            // Auto-calculate company value
            const investmentField = document.querySelector('input[name="remark_market_capital"]');
            const equityField = document.querySelector('input[name="remark_your_stake"]');
            const valuationField = document.querySelector('input[name="remark_company_value"]');

            function calculateValuation() {
                const investment = parseFloat(investmentField.value) || 0;
                const equity = parseFloat(equityField.value) || 0;

                if (investment > 0 && equity > 0 && equity <= 100) {
                    const valuation = (investment / (equity / 100)); // Correct formula: investment / (equity %)
                    valuationField.value = valuation.toFixed(2);
                } else {
                    valuationField.value = '';
                }
            }

            investmentField.addEventListener('input', calculateValuation);
            equityField.addEventListener('input', calculateValuation);

            // Add event listeners to handle modal closing properly
            const remarkModal = document.getElementById('remarkModal');

            // Method 1: Handle modal hide events
            remarkModal.addEventListener('hidden.bs.modal', function() {
                // Remove any remaining backdrop
                const backdrop = document.querySelector('.modal-backdrop');
                if (backdrop) {
                    backdrop.remove();
                }

                // Remove modal-open class from body if it exists
                document.body.classList.remove('modal-open');

                // Reset body styles
                document.body.style.overflow = '';
                document.body.style.paddingRight = '';

                // Reset the form
                document.getElementById('remarkForm').reset();
                valuationField.value = '';
            });

            // Method 2: Handle close button clicks specifically
            document.querySelectorAll('[data-bs-dismiss="modal"]').forEach(closeBtn => {
                closeBtn.addEventListener('click', function() {
                    const modal = bootstrap.Modal.getInstance(remarkModal);
                    if (modal) {
                        modal.hide();
                    }

                    // Force cleanup
                    setTimeout(() => {
                        const backdrop = document.querySelector('.modal-backdrop');
                        if (backdrop) {
                            backdrop.remove();
                        }
                        document.body.classList.remove('modal-open');
                        document.body.style.overflow = '';
                        document.body.style.paddingRight = '';
                    }, 300);
                });
            });

            // Handle form submission for remark
            document.getElementById('remarkForm').addEventListener('submit', function(e) {
                e.preventDefault();

                // Get modal instance for proper handling
                const modalInstance = bootstrap.Modal.getInstance(remarkModal);

                // Client-side validation
                const marketCapital = document.getElementById('remark_market_capital2').value.trim();
                console.log('Market Capital:', marketCapital);
                const yourStake = document.getElementById('remark_your_stake2').value.trim();
                console.log('stake Capital:', yourStake);
                const companyValue = document.getElementById('remark_company_value2').value.trim();
                const reason = document.getElementById('remark_reason2').value.trim();
                const entrepreneurId = document.getElementById('remark_entrepreneur_id').value;

                if (!marketCapital) {
                    Swal.fire({
                        icon: 'error',
                        title: 'Invalid Input',
                        text: 'Fund Offered is required.',
                        confirmButtonColor: '#d33',
                        customClass: {
                            popup: 'rounded-3'
                        }
                    });
                    return;
                }
                if (!yourStake || parseFloat(yourStake) <= 0 || parseFloat(yourStake) > 100) {
                    Swal.fire({
                        icon: 'error',
                        title: 'Invalid Input',
                        text: 'Equity Asked must be between 0 and 100%.',
                        confirmButtonColor: '#d33',
                        customClass: {
                            popup: 'rounded-3'
                        }
                    });
                    return;
                }
                if (!companyValue || parseFloat(companyValue) <= 0) {
                    Swal.fire({
                        icon: 'error',
                        title: 'Invalid Input',
                        text: 'Valuation Considered is required and must be a positive number.',
                        confirmButtonColor: '#d33',
                        customClass: {
                            popup: 'rounded-3'
                        }
                    });
                    return;
                }
                if (!reason) {
                    Swal.fire({
                        icon: 'error',
                        title: 'Invalid Input',
                        text: 'Remark Reason is required.',
                        confirmButtonColor: '#d33',
                        customClass: {
                            popup: 'rounded-3'
                        }
                    });
                    return;
                }

                const submitButton = this.querySelector('button[type="submit"]');
                const originalButtonText = submitButton.innerHTML;

                submitButton.disabled = true;
                submitButton.innerHTML =
                    '<span class="spinner-border spinner-border-sm" role="status" aria-hidden="true"></span> Submitting...';

                fetch('/entrepreneur/remark', {
                        method: 'POST',
                        headers: {
                            'Content-Type': 'application/json',
                            'X-CSRF-TOKEN': document.querySelector('meta[name="csrf-token"]')
                                .getAttribute('content'),
                        },
                        body: JSON.stringify({
                            entrepreneur_id: entrepreneurId,
                            remark_market_capital: marketCapital,
                            remark_your_stake: yourStake,
                            remark_company_value: companyValue,
                            remark_reason: reason,
                        }),
                    })
                    .then(response => response.json())
                    .then(data => {
                        submitButton.disabled = false;
                        submitButton.innerHTML = originalButtonText;

                        const remarkBtn = document.querySelector(
                            `.remark-btn[data-id="${entrepreneurId}"]`);
                        if (data.success) {
                            // Properly close modal using instance
                            if (modalInstance) {
                                modalInstance.hide();
                            }

                            // Clean up modal backdrop immediately
                            setTimeout(() => {
                                const backdrop = document.querySelector('.modal-backdrop');
                                if (backdrop) {
                                    backdrop.remove();
                                }
                                document.body.classList.remove('modal-open');
                                document.body.style.overflow = '';
                                document.body.style.paddingRight = '';
                            }, 100);

                            this.reset();
                            valuationField.value = '';

                            if (remarkBtn) {
                                remarkBtn.classList.remove('btn-primary');
                                remarkBtn.classList.add('btn-success');
                                remarkBtn.innerHTML = 'Remarked <span style="color:white;">✔</span>';
                                remarkBtn.disabled = true;
                            }
                            Swal.fire({
                                icon: 'success',
                                title: 'Remark Sent!',
                                text: 'Our team at Future Taikun will connect with the entrepreneur soon.',
                                confirmButtonColor: '#28a745',
                                customClass: {
                                    popup: 'rounded-3'
                                }
                            });
                        } else if (data.message && data.message.includes('already')) {
                            Swal.fire({
                                icon: 'info',
                                title: 'Already Remarked',
                                text: data.message,
                                confirmButtonColor: '#6c757d',
                                customClass: {
                                    popup: 'rounded-3'
                                }
                            });
                        } else {
                            Swal.fire({
                                icon: 'error',
                                title: 'Validation Error',
                                text: data.message || 'Please check the form and try again.',
                                confirmButtonColor: '#d33',
                                customClass: {
                                    popup: 'rounded-3'
                                }
                            });
                        }
                    })
                    .catch(error => {
                        submitButton.disabled = false;
                        submitButton.innerHTML = originalButtonText;

                        error.json().then(data => {
                            console.log('Full Response:', data);
                            console.error('Error Message:', data.message);
                            Swal.fire({
                                icon: 'error',
                                title: 'Oops...',
                                text: data.message ||
                                    'An error occurred while submitting the remark.',
                                confirmButtonColor: '#d33',
                                customClass: {
                                    popup: 'rounded-3'
                                }
                            });
                        }).catch(() => {
                            console.error('Error:', error);
                            Swal.fire({
                                icon: 'error',
                                title: 'Oops...',
                                text: 'An error occurred while submitting the remark.',
                                confirmButtonColor: '#d33',
                                customClass: {
                                    popup: 'rounded-3'
                                }
                            });
                        });
                    });
            });

            // Additional cleanup function (can be called manually if needed)
            function forceCleanupModal() {
                // Remove all modal backdrops
                document.querySelectorAll('.modal-backdrop').forEach(backdrop => {
                    backdrop.remove();
                });

                // Remove modal-open class from body
                document.body.classList.remove('modal-open');

                // Reset body styles
                document.body.style.overflow = '';
                document.body.style.paddingRight = '';

                // Reset any modal states
                document.querySelectorAll('.modal').forEach(modal => {
                    modal.style.display = 'none';
                    modal.classList.remove('show');
                    modal.setAttribute('aria-hidden', 'true');
                    modal.removeAttribute('aria-modal');
                });
            }
        });
        document.addEventListener('DOMContentLoaded', function() {
            const interestForm = document.getElementById('interestForm');
            const modalEl = document.getElementById('interestModal');
            const modal = new bootstrap.Modal(modalEl);
            const submitButton = interestForm.querySelector('.btn-primary');

            interestForm.addEventListener('submit', function(e) {
                e.preventDefault();
                const formData = new FormData(interestForm);
                const offerType = formData.get('offer_type');
                const url = '/mark-interested';
                const originalButtonText = submitButton.textContent;

                submitButton.disabled = true;
                submitButton.innerHTML =
                    `<span class="spinner-border spinner-border-sm"></span> Loading...`;

                fetch(url, {
                        method: 'POST',
                        headers: {
                            'X-CSRF-TOKEN': document.querySelector('meta[name="csrf-token"]')
                                .getAttribute('content')
                        },
                        body: formData
                    })
                    .then(response => response.json())
                    .then(data => {
                        if (data.success) {
                            Swal.fire({
                                icon: 'success',
                                title: offerType === 'counter' ? 'Counter Offer Submitted!' :
                                    'Interest Submitted!',
                                text: data.message,
                                confirmButtonColor: '#28a745',
                            }).then(() => {
                                modal.hide();
                                interestForm.reset();
                                window.location.reload();
                            });
                        } else {
                            Swal.fire({
                                icon: 'info',
                                title: 'Already Interested',
                                text: data.message,
                                confirmButtonColor: '#6c757d'
                            });
                        }
                    })
                    .catch(error => {
                        console.error('Error:', error);
                        Swal.fire({
                            icon: 'error',
                            title: 'Error',
                            text: 'Something went wrong. Please try again.',
                            confirmButtonColor: '#dc3545'
                        });
                    })
                    .finally(() => {
                        submitButton.disabled = false;
                        submitButton.textContent = originalButtonText;
                    });
            });

            document.querySelectorAll('.interested-btn').forEach(btn => {
                btn.addEventListener('click', function() {
                    document.getElementById('interest_entrepreneur_id').value = this.dataset.id;
                    document.getElementById('remark_market_capital').value = this.dataset
                        .marketCapital;
                    document.getElementById('remark_your_stake').value = this.dataset.yourStake;
                    document.getElementById('remark_stake_funding').value = this.dataset
                        .companyValue;

                    document.getElementById('same_offer').checked = true;
                    switchToSameOffer();
                    modal.show();
                });
            });

            document.querySelectorAll('.offer-type-radio').forEach(radio => {
                radio.addEventListener('change', function() {
                    if (this.value === 'counter') {
                        switchToCounterOffer();
                    } else {
                        switchToSameOffer();
                    }
                });
            });

            function switchToSameOffer() {
                document.getElementById('interestModalLabel').textContent = 'Confirm Interest';
                submitButton.textContent = 'Submit Interest';

                toggleFieldSets('remark');
            }

            function switchToCounterOffer() {
                document.getElementById('interestModalLabel').textContent = 'Add Counter Offer';
                submitButton.textContent = 'Submit Counter Offer';

                toggleFieldSets('counter');
            }

            function toggleFieldSets(type) {
                const isCounter = type === 'counter';

                document.querySelectorAll('.remark-field').forEach(el => el.style.display = isCounter ? 'none' :
                    'block');
                document.querySelectorAll('.counter-field').forEach(el => el.style.display = isCounter ? 'block' :
                    'none');

                document.querySelectorAll('.remark-field input, .remark-field textarea').forEach(input => input
                    .required = !isCounter);
                document.querySelectorAll('.counter-field input, .counter-field textarea').forEach(input => input
                    .required = isCounter);
            }

            function updateCounterValuation() {
                const fund = parseFloat(document.getElementById('counter_market_capital').value) || 0;
                const stake = parseFloat(document.getElementById('counter_your_stake').value) || 0;
                if (fund > 0 && stake > 0) {
                    const value = fund / (stake / 100);
                    document.getElementById('counter_company_value').value = value.toFixed(2);
                }
            }

            document.getElementById('counter_market_capital').addEventListener('input', updateCounterValuation);
            document.getElementById('counter_your_stake').addEventListener('input', updateCounterValuation);
        });
    </script>
    <script>
        $(document).on('change', '.toggle-approval', function() {
            const $this = $(this); // Store reference to the checkbox
            const entrepreneurId = $this.data('id');
            const isApproved = $this.is(':checked') ? 1 : 0;

            // Show SweetAlert2 confirmation dialog
            Swal.fire({
                title: 'Are you sure?',
                icon: 'warning',
                showCancelButton: true,
                confirmButtonText: 'Yes, proceed!',
                cancelButtonText: 'Cancel'
            }).then((result) => {
                if (result.isConfirmed) {
                    // Proceed with AJAX request if confirmed
                    $.ajax({
                        url: '{{ route('entrepreneur.toggleApproval') }}',
                        type: 'POST',
                        data: {
                            _token: '{{ csrf_token() }}',
                            id: entrepreneurId,
                            approved: isApproved
                        },
                        success: function(response) {
                            if (response.success) {
                                Swal.fire({
                                    icon: 'success',
                                    title: 'Success',
                                    text: 'Status updated successfully!',
                                    showConfirmButton: false,
                                    timer: 1500
                                });
                            } else {
                                // Revert checkbox state on failure
                                $this.prop('checked', !isApproved);
                                Swal.fire({
                                    icon: 'error',
                                    title: 'Error',
                                    text: 'Error updating status',
                                    showConfirmButton: true
                                });
                            }
                        },
                        error: function() {
                            // Revert checkbox state on server error
                            $this.prop('checked', !isApproved);
                            Swal.fire({
                                icon: 'error',
                                title: 'Server Error',
                                text: 'An error occurred while communicating with the server',
                                showConfirmButton: true
                            });
                        }
                    });
                } else {
                    // Revert checkbox state if user cancels
                    $this.prop('checked', !isApproved);
                }
            });
        });

        document.addEventListener('DOMContentLoaded', function() {
            const buttons = document.querySelectorAll('.view-details-btn');
            //const nameField = document.getElementById('modal-investor-name');
            const tableBody = document.getElementById('modal-company-table-body');
            const profTableBody = document.getElementById('modal-professional-table-body');

            buttons.forEach(button => {
                button.addEventListener('click', function() {
                    const entrepreneursId = this.dataset.id;
                    //const investorName = this.dataset.name;

                    //nameField.textContent = investorName;

                    // Load company details
                    fetch(`/entrepreneur/${entrepreneursId}/companies`)
                        .then(res => res.json())
                    //.then(data => {
                    // tableBody.innerHTML = '';
                    //if (data.length === 0) {
                    //    tableBody.innerHTML =
                    //         `<tr><td colspan="5" class="text-center text-muted">No Companies Found</td></tr>`;
                    // } else {
                    // data.forEach((company, index) => {
                    //     tableBody.innerHTML += `
                //  <tr>
                //     <td>${index + 1}</td>
                // <td>${company.company_name}</td>
                // <td>${company.more_market_capital}</td>
                //  <td>${company.more_your_stake}</td>
                //  <td>${company.more_stake_funding}</td>
                //   </tr>
                //  `;
                    //      });
                    //  }
                    // })
                    //.catch(err => {
                    //    tableBody.innerHTML =
                    //`<tr><td colspan="5" class="text-danger">Failed to load companies</td></tr>`;
                    //#f8f9fa   console.error(err);
                    // });

                    // Professional Details HTML with resume-like structure
                    let profHTML = `
    <div class="resume-section">
        <h5 class="section-title">Personal Information</h5>
        <div class="info-grid">
            <div class="info-item"><span class="info-label">Name:</span> ${button.dataset.name || 'N/A'}</div>
            <div class="info-item"><span class="info-label">Age:</span> ${button.dataset.age || 'N/A'}</div>
            <div class="info-item"><span class="info-label">Date of Birth:</span> ${button.dataset.dob || 'N/A'}</div>
            <div class="info-item"><span class="info-label">Qualification:</span> ${button.dataset.qualification || 'N/A'}</div>
            <div class="info-item"><span class="info-label">Country:</span> ${button.dataset.country || 'N/A'}</div>
            <div class="info-item"><span class="info-label">City:</span> ${button.dataset.city || 'N/A'}</div>
            <div class="info-item"><span class="info-label">State:</span> ${button.dataset.state || 'N/A'}</div>
            <div class="info-item"><span class="info-label">Pin Code:</span> ${button.dataset.pincode || 'N/A'}</div>
            @unless (session('selected_role') === 'investor')
                <div class="info-item"><span class="info-label">Email:</span> ${button.dataset.email || 'N/A'}</div>
                <div class="info-item"><span class="info-label">Phone Number:</span> ${button.dataset.countrycode || 'N/A'} ${button.dataset.phone || 'N/A'}</div>
                <div class="info-item"><span class="info-label">Website:</span> ${button.dataset.website ? `<a href="${button.dataset.website}" target="_blank" class="download-link">${button.dataset.website}</a>` : 'N/A'}</div>
                <div class="info-item"><span class="info-label">Current Address:</span> ${button.dataset.address || 'N/A'}</div>
            @endunless
        </div>
    </div>
    <div class="resume-section">
        <h5 class="section-title mt-4">Business Overview</h5>
        <div class="info-grid">
            <div class="info-item"><span class="info-label">Industry:</span> ${button.dataset.industry || 'N/A'}</div>
            
            <div class="info-item"><span class="info-label">Registered Business:</span> ${button.dataset.registerbusiness == '1' ? 'Yes' : 'No'}</div>
        </div>
    </div>
`;
                    // Add conditional fields if register_business is 0
                    if (button.dataset.registerbusiness === '0') {
                        profHTML += `
<div class="resume-section">
    <h5 class="section-title mt-4">Unregistered Business Details</h5>
    <div class="info-grid">
        <div class="info-item"><span class="info-label">Business Name:</span> ${button.dataset.businessname || 'N/A'}</div>
        <div class="info-item"><span class="info-label">Brand Name:</span> ${button.dataset.brandname || 'N/A'}</div>
        <div class="info-item"><span class="info-label">Business Country:</span> ${button.dataset.businesscountry || 'N/A'}</div>
        <div class="info-item"><span class="info-label">Business State:</span> ${button.dataset.businessstate || 'N/A'}</div>
        <div class="info-item"><span class="info-label">Business City:</span> ${button.dataset.businesscity || 'N/A'}</div>
        <div class="info-item"><span class="info-label">Business Description:</span> ${button.dataset.describe || 'N/A'}</div>
        <div class="info-item"><span class="info-label">Business Address:</span> ${button.dataset.businessaddress || 'N/A'}</div>
        <div class="info-item"><span class="info-label">Own Fund:</span> ${button.dataset.ownfund || 'N/A'}</div>
        <div class="info-item"><span class="info-label">Loan:</span> ${button.dataset.loan || 'N/A'}</div>
        <div class="info-item"><span class="info-label">Invested Amount:</span> ${button.dataset.amount || 'N/A'}</div>
        <div class="info-item"><span class="info-label">Fund Asked:</span> ${button.dataset.marketcapital || 'N/A'}</div>
        <div class="info-item"><span class="info-label">Equity Offered:</span> ${button.dataset.yourstake || 'N/A'}</div>
        <div class="info-item"><span class="info-label">Company Valuation:</span> ${button.dataset.stakefunding || 'N/A'}</div>
        <div class="info-item"><span class="info-label">Product Photos:</span>
            ${button.dataset.product_photos ? 
                button.dataset.product_photos.replace(/[\[\]']/g, '').split(',').map(photo => 
                    `<img src="/storage/${photo.trim()}" alt="Product Photo" class="product-image">`
                ).join('') : 'N/A'}
        </div>
        <div class="info-item"><span class="info-label">Business Logo:</span>
            ${button.dataset.business_logo ? `<img src="/storage/business_logos/${button.dataset.business_logo.trim()}" alt="Business Logo" class="product-image">` : 'N/A'}
        </div>
        <div class="info-item"><span class="info-label">Business Summary:</span>
            ${button.dataset.pitch_deck ? `<a href="/storage/pitch_decks/${button.dataset.pitch_deck.trim()}" download class="download-link">Download PDF</a>` : 'N/A'}
        </div>
    </div>
</div>
`;
                    }

                    // Add conditional fields if register_business is 1
                    if (button.dataset.registerbusiness === '1') {
                        profHTML += `
    <div class="resume-section">
        <h5 class="section-title mt-4">Registered Business Details</h5>
        <div class="info-grid">
            <div class="info-item"><span class="info-label">Employee Number:</span> ${button.dataset.employee_number || 'N/A'}</div>
            <div class="info-item"><span class="info-label">Number of Founders:</span> ${button.dataset.founder || 'N/A'}</div>
            <div class="info-item"><span class="info-label">Business Name:</span> ${button.dataset.y_business_name || 'N/A'}</div>
            <div class="info-item"><span class="info-label">Brand Name:</span> ${button.dataset.y_brand_name || 'N/A'}</div>
              @unless (session('selected_role') === 'investor')
                <div class="info-item"><span class="info-label">Business Email:</span> ${button.dataset.businessemail || 'N/A'}</div>
                <div class="info-item"><span class="info-label">Business Mobile Number:</span> ${button.dataset.businessmobile || 'N/A'}</div>
            @endunless
            <div class="info-item"><span class="info-label">Tax Registration Number:</span> ${button.dataset.taxregistrationnumber || 'N/A'}</div>
            <div class="info-item"><span class="info-label">Year of Establishment:</span> ${button.dataset.businessyear || 'N/A'}</div>
            <div class="info-item"><span class="info-label">Years in Business:</span> ${button.dataset.yearcount || 'N/A'}</div>
            <div class="info-item"><span class="info-label">Business Description:</span> ${button.dataset.y_describe_business || 'N/A'}</div>
            <div class="info-item"><span class="info-label">Business Address:</span> ${button.dataset.y_business_address || 'N/A'}</div>
            <div class="info-item"><span class="info-label">Business Country:</span> ${button.dataset.y_business_country || 'N/A'}</div>
            <div class="info-item"><span class="info-label">Business State:</span> ${button.dataset.y_business_state || 'N/A'}</div>
            <div class="info-item"><span class="info-label">Business City:</span> ${button.dataset.y_business_city || 'N/A'}</div>
            <div class="info-item"><span class="info-label">Zip Code:</span> ${button.dataset.y_zipcode || 'N/A'}</div>
            <div class="info-item"><span class="info-label">Type of Industries:</span> ${button.dataset.y_type_industries || 'N/A'}</div>
            <div class="info-item"><span class="info-label">Own Fund:</span> ${button.dataset.y_own_fund || 'N/A'}</div>
            <div class="info-item"><span class="info-label">Loan:</span> ${button.dataset.y_loan || 'N/A'}</div>
            <div class="info-item"><span class="info-label">Invested Amount:</span> ${button.dataset.y_invested_amount || 'N/A'}</div>
            <div class="info-item"><span class="info-label">Revenue - FY 1:</span> ${button.dataset.revenue1 || 'N/A'}</div>
            <div class="info-item"><span class="info-label">Revenue - FY 2:</span> ${button.dataset.revenue2 || 'N/A'}</div>
            <div class="info-item"><span class="info-label">Revenue - FY 3:</span> ${button.dataset.revenue3 || 'N/A'}</div>
            <div class="info-item"><span class="info-label">Product Photos:</span>
                ${button.dataset.y_product_photos ? 
                    button.dataset.y_product_photos.replace(/[\[\]']/g, '').split(',').map(photo => 
                        `<img src="/storage/${photo.trim()}" alt="Product Photo" class="product-image">`
                    ).join('') : 'N/A'}
            </div>
            <div class="info-item"><span class="info-label">Business Logo:</span>
                ${button.dataset.y_business_logo ? `<img src="/storage/y_business_logos/${button.dataset.y_business_logo.trim()}" alt="Business Logo" class="product-image">` : 'N/A'}
            </div>
            <div class="info-item"><span class="info-label">Business Summary:</span>
                ${button.dataset.y_pitch_deck ? `<a href="/storage/y_pitch_decks/${button.dataset.y_pitch_deck.trim()}" download class="download-link">Download PDF</a>` : 'N/A'}
            </div>
        </div>
    </div>
    `;
                    }

                    // Add Investments section for all cases
                    profHTML += `
    <div class="resume-section">
        <h5 class="section-title mt-4">Investment Required</h5>
        <div class="info-grid">
            <div class="info-item"><span class="info-label">Fund Asked:</span> ${button.dataset.registerbusiness === '1' ? (button.dataset.market_capital || 'N/A') : (button.dataset.marketcapital || 'N/A')}</div>
            <div class="info-item"><span class="info-label">Equity Offered:</span> ${button.dataset.registerbusiness === '1' ? (button.dataset.your_stake || 'N/A') : (button.dataset.yourstake || 'N/A')}</div>
            <div class="info-item"><span class="info-label">Company Valuation:</span> ${button.dataset.registerbusiness === '1' ? (button.dataset.stake_funding || 'N/A') : (button.dataset.stakefunding || 'N/A')}</div>
        </div>
    </div>
`;
                    profTableBody.innerHTML = profHTML;

                    // Show modal
                    const modal = new bootstrap.Modal(document.getElementById(
                        'investorDetailModal'));
                    modal.show();
                });
            });
        });

        let deleteId = null;
        document.querySelectorAll('.delete-btn').forEach(button => {
            button.addEventListener('click', () => {
                deleteId = button.dataset.id;
                const modal = new bootstrap.Modal(document.getElementById('deleteConfirmationModal'));
                modal.show();
            });
        });

        document.getElementById('confirmDeleteBtn').addEventListener('click', () => {
            if (deleteId) {
                fetch(`/entrepreneurs/${deleteId}`, {
                        method: 'DELETE',
                        headers: {
                            'X-CSRF-TOKEN': document.querySelector('meta[name="csrf-token"]').getAttribute(
                                'content'),
                            'Content-Type': 'application/json',
                        },
                    })
                    .then(response => {
                        if (response.ok) {
                            // Close the confirmation modal
                            const confirmationModal = bootstrap.Modal.getInstance(document.getElementById(
                                'deleteConfirmationModal'));
                            confirmationModal.hide();

                            // Show success toast
                            const toast = new bootstrap.Toast(document.getElementById('successToast'));
                            toast.show();

                            // Remove the row from the table after a delay to allow toast visibility
                            setTimeout(() => {
                                const row = document.querySelector(
                                    `button.delete-btn[data-id="${deleteId}"]`).closest('tr');
                                if (row) row.remove();
                            }, 2000); // Adjust delay as needed

                        } else {
                            alert('Failed to delete entrepreneur.');
                        }
                    })
                    .catch(error => {
                        console.error('Error:', error);
                        alert('An error occurred while deleting the entrepreneur.');
                    });
            }
        });
    </script>
@endsection
