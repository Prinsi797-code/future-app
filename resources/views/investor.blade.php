{{-- <!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Investors List</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.10.0/font/bootstrap-icons.css" rel="stylesheet">
    <style>
        .table-responsive {
            border-radius: 8px;
            box-shadow: 0 0 15px rgba(0, 0, 0, 0.1);
        }

        .badge-custom {
            font-size: 0.75rem;
            padding: 0.25em 0.5em;
        }

        .table th {
            background-color: #f8f9fa;
            border-top: none;
            font-weight: 600;
            color: #495057;
        }

        .table td {
            vertical-align: middle;
        }

        .investor-profile-link {
            text-decoration: none;
        }

        .investor-profile-link:hover {
            text-decoration: underline;
        }

        .industries-list,
        .geography-list {
            max-width: 200px;
            overflow: hidden;
        }

        @media (max-width: 768px) {
            .table-responsive table {
                font-size: 0.875rem;
            }

            .industries-list,
            .geography-list {
                max-width: 150px;
            }
        }
        .custom-switch-scale {
        transform: scale(1.5); 
        transform-origin: left;
        margin-right: 10px;
    }
    </style>
</head> --}}
@extends('layouts.admin')
<link href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css" rel="stylesheet">
@section('title', 'Investors Directory')
<style>
    .custom-switch-scale {
        transform: scale(1.5);
        transform-origin: left;
        margin-right: 10px;
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
        border-bottom: 1px solid #3498db;
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
    <div class="card shadow-sm rounded-3">
        <div class="card-body">
            <div class="d-flex justify-content-between align-items-center mb-4">
                {{-- <h2 class="mb-0">
                    <i class="bi bi-people-fill me-2"></i>
                    Investors
                </h2> --}}
                <span class="badge bg-primary fs-6">
                    Total: {{ count($investores) }} Investors
                </span>
                <div>
                    @if (session('selected_role') === 'admin')
                        {{-- @if (Auth::user()->role === 'admin') --}}
                        <div class="ml-3" style="padding-left: 20px;">
                            <a href="{{ route('admin.investor.download', request()->all()) }}" class="btn btn-sm btn-primary">
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
                                <th scope="col" style="min-width: 200px;">Email</th>
                                <th scope="col" style="min-width: 130px;">Phone</th>
                                <th scope="col" style="min-width: 100px;">Country</th>
                                <th scope="col" style="min-width: 100px;">LinkedIn</th>
                                <th scope="col" style="min-width: 130px;">Investor Type</th>
                                <th scope="col" style="min-width: 150px;">Investment Range</th>
                                <th scope="col" style="min-width: 130px;">Preferred Stage</th>
                                <th scope="col" style="min-width: 100px;">Profile</th>
                                <th scope="col" style="min-width: 80px;">Approved</th>
                                <th scope="col" style="min-width: 80px;">Product/Logo</th>
                                <th scope="col" style="min-width: 100px;">Action</th>
                            </tr>
                        </thead>
                        <tbody>
                            @forelse($investore as $index => $investor)
                                <tr>
                                    <td>{{ $index + 1 }}</td>
                                    <td>
                                        <strong>{{ $investor->full_name }}</strong>
                                    </td>
                                    <td>
                                        <a href="mailto:{{ $investor->email }}" class="text-decoration-none">
                                            {{ $investor->email }}
                                        </a>
                                    </td>
                                    <td>
                                        <a href="tel:{{ $investor->phone_number }}" class="text-decoration-none">
                                            {{ $investor->phone_number }}
                                        </a>
                                    </td>
                                    <td>
                                        <span class="badge bg-secondary badge-custom">
                                            {{ $investor->country }}
                                        </span>
                                    </td>
                                    <td>
                                        @if ($investor->linkedin_profile)
                                            <a href="{{ $investor->linkedin_profile }}" target="_blank"
                                                class="text-primary">
                                                <i class="bi bi-linkedin"></i> View
                                            </a>
                                        @else
                                            <span class="text-muted">N/A</span>
                                        @endif
                                    </td>
                                    <td>
                                        @if ($investor->investor_type)
                                            <span class="badge bg-secondary badge-custom">
                                                {{ $investor->investor_type }}
                                            </span>
                                        @else
                                            <span class="text-muted">N/A</span>
                                        @endif
                                    </td>

                                    <td>
                                        @if ($investor->investment_range)
                                            <span>
                                                {{ $investor->investment_range }}
                                            </span>
                                        @else
                                            <span class="text-muted">N/A</span>
                                        @endif
                                    </td>
                                    <td>
                                        <span>
                                            @if ($investor->preferred_startup_stage)
                                                @php
                                                    $stages = json_decode($investor->preferred_startup_stage, true);
                                                    if (is_array($stages) && !empty($stages)) {
                                                        echo implode(', ', $stages);
                                                    } else {
                                                        echo 'No Stage Selected';
                                                    }
                                                @endphp
                                            @else
                                                No Stage Selected
                                            @endif
                                        </span>
                                    </td>
                                    <td>
                                        @if ($investor->investor_profile)
                                            <a href="{{ asset('storage/' . $investor->investor_profile) }}" target="_blank"
                                                class="btn btn-sm btn-outline-primary investor-profile-link">
                                                <i class="bi bi-file-earmark-pdf me-1"></i>View PDF
                                            </a>
                                        @else
                                            <span class="text-muted">No Profile</span>
                                        @endif
                                    </td>
                                    <td>
                                        <div class="form-check form-switch">
                                            <input class="form-check-input custom-switch-scale toggle-approval"
                                                type="checkbox" role="switch" data-id="{{ $investor->id }}"
                                                {{ $investor->approved ? 'checked' : '' }}>
                                        </div>
                                    </td>
                                    <td>
                                        <button class="btn btn-sm btn-primary" data-id="{{ $investor->id }}"
                                            data-business-logo="{{ $investor->business_logo_admin }}"
                                            data-photo="{{ $investor->photo_admin }}" data-bs-toggle="modal"
                                            data-bs-target="#InvestorphotoLogo">
                                            Products/Logo
                                        </button>
                                    </td>

                                    <td>
                                        <button class="btn btn-sm btn-primary view-details-btn"
                                            data-id="{{ $investor->id }}" data-name="{{ $investor->full_name }}"
                                            data-address="{{ $investor->current_address }}"
                                            data-country="{{ $investor->country }}" data-state="{{ $investor->state }}"
                                            data-city="{{ $investor->city }}" data-pincode="{{ $investor->pin_code }}"
                                            data-dob="{{ $investor->dob }}" data-age="{{ $investor->age }}"
                                            data-qualification="{{ $investor->qualification }}"
                                            data-countrycode="{{ $investor->country_code }}"
                                            data-phone="{{ $investor->phone_number }}" data-email="{{ $investor->email }}"
                                            data-experience="{{ $investor->investment_experince }}"
                                            data-industries="{{ is_array(json_decode($investor->preferred_industries, true)) ? implode(', ', json_decode($investor->preferred_industries, true)) : $investor->preferred_industries }}"
                                            data-geographies="{{ is_array(json_decode($investor->preferred_geographies, true)) ? implode(', ', json_decode($investor->preferred_geographies, true)) : $investor->preferred_geographies }}"
                                            data-investing="{{ $investor->actively_investing }}"
                                            data-professionalphone="{{ $investor->professional_phone }}"
                                            data-investmentexperince="{{ $investor->investment_experince }}"
                                            data-photo="{{ str_replace('investor_photo/', '', $investor->photo) }}"
                                            data-photo_admin="{{ str_replace('investor_photo/', '', $investor->photo_admin) }}"
                                            data-existing_company="{{ $investor->existing_company }}"
                                            @if ($investor->existing_company == 1) data-designation="{{ $investor->designation }}"
                                            data-professionalemail="{{ $investor->professional_email }}"
                                            data-organization="{{ $investor->organization_name }}" 
                                            data-companyaddress="{{ $investor->company_address }}"
                                            data-companycountry="{{ $investor->company_country }}"
                                            data-companystate="{{ $investor->company_state }}"
                                            data-companycity="{{ $investor->company_city }}"
                                            data-companyzipcode="{{ $investor->company_zipcode }}"
                                            data-companycountrycode="{{ $investor->company_country_code }}"
                                            data-companytax="{{ $investor->tax_registration_number }}"
                                            data-business_logo="{{ str_replace('investor_logos/', '', $investor->business_logo) }}" 
                                            data-business_logo_admin="{{ str_replace('investor_logos/', '', $investor->business_logo_admin) }}"
                                            data-investor_profile="{{ str_replace('investor_profile/', '', $investor->investor_profile) }}"
                                            data-website="{{ $investor->website }}" @endif>
                                            View Details
                                        </button>
                                    </td>
                                </tr>
                            @empty
                                <tr>
                                    <td colspan="14" class="text-center py-4">
                                        <div class="text-muted">
                                            <i class="bi bi-inbox display-4 d-block mb-3"></i>
                                            <h5>No Investors Found</h5>
                                            <p class="mb-0">No investors have been registered yet.</p>
                                        </div>
                                    </td>
                                </tr>
                            @endforelse
                        </tbody>
                    </table>
                </div>
            </div>
            <div class="mt-4">
                {{ $investore->links('pagination::bootstrap-5') }}
            </div>
        </div>
    </div>
    <div class="modal fade" id="investorDetailModal" tabindex="-1" aria-labelledby="investorDetailModalLabel"
        aria-hidden="true">
        <div class="modal-dialog modal-xl modal-dialog-scrollable">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title text-center" id="investorDetailModalLabel">Investor Profile</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body">
                    <h5 id="modal-investor-name" class="mb-4"></h5>
                    <div id="modal-professional-table-body"></div>
                    <div class="resume-container">
                        <div class="table-responsive mb-4">
                            <h5 class="section-title mt-4">Company Investments</h5>
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
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <div class="modal fade" id="InvestorphotoLogo" tabindex="-1" aria-labelledby="InvestorphotoLogoLabel"
        aria-hidden="true">
        <div class="modal-dialog modal-lg">
            <form id="InvestorphotoLogoForm" enctype="multipart/form-data">
                @csrf
                <input type="hidden" name="investor_id" id="InvestorphotoLogoInvestorId">

                <div class="modal-content">
                    <div class="modal-header">
                        <h5 class="modal-title" id="InvestorphotoLogoLabel">Update Photos & Logo</h5>
                        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                    </div>

                    <div class="modal-body">
                        <div class="mb-3" id="businessLogoSection">
                            <label for="businessLogo" class="form-label">Business Logo</label>
                            <input type="file" class="form-control" id="businessLogo" name="business_logo_admin"
                                accept="image/*">
                            <div id="businessLogoPreview" class="mt-2">
                                <img id="businessLogoImg" src="" alt="Business Logo Preview"
                                    style="max-width: 200px; display: none;">
                            </div>
                        </div>

                        <div class="mb-3" id="productPhotosSection">
                            <label for="productPhotos" class="form-label">Photos</label>
                            <input type="file" class="form-control" id="productPhotos" name="photo_admin"
                                accept="image/*">
                            <div id="productPhotosPreview" class="mt-2 d-flex flex-wrap gap-2"></div>
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

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
    <script src="https://code.jquery.com/jquery-3.7.1.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
    <script>
        //photos, logo update 
        document.addEventListener('DOMContentLoaded', function() {
            const productLogoModal = document.getElementById('InvestorphotoLogo');
            productLogoModal.addEventListener('show.bs.modal', function(event) {
                const button = event.relatedTarget;
                const investorId = button.getAttribute('data-id');
                const businessLogo = button.getAttribute('data-business-logo');
                const productPhotos = button.getAttribute('data-photo');

                console.log(`Investor ID: ${investorId}`);
                console.log('Modal opened with data:', {
                    investorId,
                    businessLogo,
                    productPhotos
                });

                // Set investor ID
                document.getElementById('InvestorphotoLogoInvestorId').value = investorId;

                // Handle existing business logo
                const businessLogoImg = document.getElementById('businessLogoImg');
                if (businessLogo && businessLogoImg) {
                    businessLogoImg.src = `/storage/${businessLogo}`;
                    businessLogoImg.style.display = 'block';
                } else if (businessLogoImg) {
                    businessLogoImg.style.display = 'none';
                }

                // Handle existing product photos
                const productPhotosPreview = document.getElementById('productPhotosPreview');
                if (productPhotosPreview && productPhotos) {
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
            // Form submission
            document.getElementById('InvestorphotoLogoForm').addEventListener('submit', function(e) {
                e.preventDefault();

                const form = e.target;
                const formData = new FormData(form);
                const investorId = document.getElementById('InvestorphotoLogoInvestorId').value;

                if (!investorId) {
                    console.error('Investor ID is missing.');
                    Swal.fire({
                        icon: 'error',
                        title: 'Error',
                        text: 'Investor ID is missing.',
                        confirmButtonColor: '#d33',
                        customClass: {
                            popup: 'rounded-3'
                        }
                    });
                    return;
                }

                formData.append('investor_id', investorId);

                console.log('Form data being sent:', Object.fromEntries(formData));

                const submitButton = form.querySelector('button[type="submit"]');
                const originalButtonText = submitButton.innerHTML;

                submitButton.disabled = true;
                submitButton.innerHTML =
                    '<span class="spinner-border spinner-border-sm" role="status" aria-hidden="true"></span> Saving...';

                fetch("{{ route('admin.update.photo.logo') }}", {
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
                                'InvestorphotoLogo'));
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
                            const productPhotosPreview = document.getElementById(
                                'productPhotosPreview');

                            if (businessLogoImg) businessLogoImg.style.display = 'none';
                            if (productPhotosPreview) productPhotosPreview.innerHTML = '';

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

        //end photos and logo

        $(document).on('change', '.toggle-approval', function() {
            const $this = $(this); // Store reference to the checkbox
            const investorId = $this.data('id');
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
                        url: '{{ route('investor.toggleApproval') }}',
                        type: 'POST',
                        data: {
                            _token: '{{ csrf_token() }}',
                            id: investorId,
                            approved: isApproved
                        },
                        success: function(response) {
                            if (response.success) {
                                Swal.fire({
                                    icon: 'success',
                                    title: 'Success',
                                    text: 'Investor status updated successfully!',
                                    showConfirmButton: false,
                                    timer: 1500
                                });
                            } else {
                                // Revert checkbox state on failure
                                $this.prop('checked', !isApproved);
                                Swal.fire({
                                    icon: 'error',
                                    title: 'Error',
                                    text: 'Error updating investor status',
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
            const nameField = document.getElementById('modal-investor-name');
            const rangeField = document.getElementById('modal-investor-range');
            const tableBody = document.getElementById('modal-company-table-body');
            const profTableBody = document.getElementById('modal-professional-table-body');

            buttons.forEach(button => {
                button.addEventListener('click', function() {
                    const investorId = this.dataset.id;
                    //const investorName = this.dataset.name;
                    //const investmentRange = this.dataset.range;

                    //nameField.textContent = `Name: ${investorName}`;
                    //rangeField.textContent = investmentRange;

                    // Load company details
                    fetch(`/investor/${investorId}/companies`)
                        .then(res => res.json())
                        .then(data => {
                            tableBody.innerHTML = '';
                            if (data.length === 0) {
                                tableBody.innerHTML =
                                    `<tr><td colspan="5" class="text-center text-muted">No Companies Found</td></tr>`;
                            } else {
                                data.forEach((company, index) => {
                                    tableBody.innerHTML += `
                                            <tr>
                                                <td>${index + 1}</td>
                                                <td>${company.company_name}</td>
                                                <td>${company.market_capital}</td>
                                                <td>${company.your_stake}</td>
                                                <td>${company.stake_funding}</td>
                                            </tr>
                                        `;
                                });
                            }
                        })
                        .catch(err => {
                            tableBody.innerHTML =
                                `<tr><td colspan="5" class="text-danger">Failed to load companies</td></tr>`;
                            console.error(err);
                        });

                    let profHTML = `
                <div class="resume-section">
                    <h5 class="section-title">Personal Information</h5>
                    <div class="info-grid">
                        <div class="info-item"><span class="info-label">Name: </span> ${button.dataset.name || 'N/A'}</div>
                        <div class="info-item"><span class="info-label">Age:</span> ${button.dataset.age || 'N/A'}</div>
                        <div class="info-item"><span class="info-label">Date of Birth:</span> ${button.dataset.dob || 'N/A'}</div>
                        <div class="info-item"><span class="info-label">Qualification:</span> ${button.dataset.qualification || 'N/A'}</div>
                        <div class="info-item"><span class="info-label">Country:</span> ${button.dataset.country || 'N/A'}</div>
                        <div class="info-item"><span class="info-label">City:</span> ${button.dataset.city || 'N/A'}</div>
                        <div class="info-item"><span class="info-label">State:</span> ${button.dataset.state || 'N/A'}</div>
                        <div class="info-item"><span class="info-label">Pin Code:</span> ${button.dataset.pincode || 'N/A'}</div>
                        <div class="info-item"><span class="info-label">Address:</span> ${button.dataset.address || 'N/A'}</div>
                    </div>
                </div>
                <div class="resume-section">
                    <h5 class="section-title mt-4">Contact Information</h5>
                    <div class="info-grid">
                        <div class="info-item"><span class="info-label">Phone:</span> ${button.dataset.countrycode || ''} ${button.dataset.phone || 'N/A'}</div>
                        <div class="info-item"><span class="info-label">Professional Phone:</span> ${button.dataset.countrycode || ''} ${button.dataset.professionalphone || 'N/A'}</div>
                        <div class="info-item"><span class="info-label">Email:</span> ${button.dataset.email || 'N/A'}</div>
                                             ${button.dataset.existing_company == '1' ? `
                                                                                                                                                                                                                                                                                                                                                                                          <div class="info-item"><span class="info-label">Professional Email:</span> ${button.dataset.professionalemail || 'N/A'}</div>
                                                                                                                                                                                                                                                                                                                                                                                                        <div class="info-item"><span class="info-label">Website:</span> ${button.dataset.website ? `<a href="${button.dataset.website}" target="_blank" class="download-link">${button.dataset.website}</a>` : 'N/A'}</div>
                                                                                                                                                                                                                                                                                                                                                                                                        ` : ''}
                    </div>
                </div>
                <div class="resume-section">
                    <h5 class="section-title mt-4">Professional Details</h5>
                    <div class="info-grid">
                     ${button.dataset.existing_company == '1' ? `
                                                                                                                                                                                                                                                                                                                                                                                                                                                                            <div class="info-item"><span class="info-label">Designation:</span> ${button.dataset.designation || 'N/A'}</div>
                                                                                                                                                                                                                                                                                                                                                                                                                                                                            <div class="info-item"><span class="info-label">Organization:</span> ${button.dataset.organization || 'N/A'}</div>
                                                                                                                                                                                                                                                                                                                                                                                                                                                                            ` : ''}
                            <div class="info-item"><span class="info-label">Investment Experience:</span> ${button.dataset.investmentexperince || 'N/A'}</div>
                            <div class="info-item"><span class="info-label">Preferred Industries:</span> ${button.dataset.industries || 'N/A'}</div>
                            <div class="info-item"><span class="info-label">Preferred Geographies:</span> ${button.dataset.geographies || 'N/A'}</div>
                            <div class="info-item"><span class="info-label">Actively Investing:</span> ${button.dataset.investing == '1' ? 'Yes' : 'No'}</div>
                        </div>
                    </div>
                    ${button.dataset.existing_company == '1' ? `
                                                                                                                                                                                                                                                                                                                                                                                                                                                    <div class="resume-section">
                                                                                                                                                                                                                                                                                                                                                                                                                                                        <h5 class="section-title mt-4">Company Information</h5>
                                                                                                                                                                                                                                                                                                                                                                                                                                                        <div class="info-grid">
                                                                                                                                                                                                                                                                                                                                                                                                                                                            <div class="info-item"><span class="info-label">Company Address:</span> ${button.dataset.companyaddress || 'N/A'}</div>
                                                                                                                                                                                                                                                                                                                                                                                                                                                            <div class="info-item"><span class="info-label">Company Country:</span> ${button.dataset.companycountry || 'N/A'}</div>
                                                                                                                                                                                                                                                                                                                                                                                                                                                            <div class="info-item"><span class="info-label">Company State:</span> ${button.dataset.companystate || 'N/A'}</div>
                                                                                                                                                                                                                                                                                                                                                                                                                                                            <div class="info-item"><span class="info-label">Company City:</span> ${button.dataset.companycity || 'N/A'}</div>
                                                                                                                                                                                                                                                                                                                                                                                                                                                            <div class="info-item"><span class="info-label">Company Zipcode:</span> ${button.dataset.companyzipcode || 'N/A'}</div>
                                                                                                                                                                                                                                                                                                                                                                                                                                                            <div class="info-item"><span class="info-label">Company Country Code:</span> ${button.dataset.companycountrycode || 'N/A'}</div>
                                                                                                                                                                                                                                                                                                                                                                                                                                                            <div class="info-item"><span class="info-label">Tax Registration Number:</span> ${button.dataset.companytax || 'N/A'}</div>
                                                                                                                                                                                                                                                                                                                                                                                                                                                        </div>
                                                                                                                                                                                                                                                                                                                                                                                                                                                    </div>
                                                                                                                                                                                                                                                                                                                                                                                                                                                    ` : ''}
                    <div class="resume-section">
                        <h5 class="section-title mt-4">Media</h5>
                        <div class="info-grid">
                         ${button.dataset.existing_company == '1' ? `
                                                                                                                                                                                                                                                                                                                                                                                                        <div class="info-item"><span class="info-label">Business Logo:</span>
                                                                                                                                                                                                                                                                                                                                                                                                            ${button.dataset.business_logo_admin ? 
                                `<img src="/storage/investor_logos/${button.dataset.business_logo_admin.trim()}" alt="Business Logo" class="product-image">` : 
                                (button.dataset.business_logo ? 
                                    `<img src="/storage/investor_logos/${button.dataset.business_logo.trim()}" alt="Business Logo" class="product-image">` : 
                                    'N/A'
                                )
                            }
                                                                                                                                                                                                                                                                                                                                                                                                        </div>
                                                                                                                                                                                                                                                                                                                                                                                                        ` : ''}
                            <div class="info-item"><span class="info-label">Investor Photo:</span>
                                ${button.dataset.photo_admin ? 
        `<img src="/storage/investor_photo/${button.dataset.photo_admin.trim()}" alt="Investor Photo" class="product-image">` : 
        (button.dataset.photo ? 
            `<img src="/storage/investor_photo/${button.dataset.photo.trim()}" alt="Investor Photo" class="product-image">` : 
            'N/A'
        )
    }
                            </div>
                             ${button.dataset.existing_company == '1' ? `
                                                                                                                                                                                                                                                                                                                                                                                                        <div class="info-item"><span class="info-label">Investor Profile:</span>
                                                                                                                                                                                                                                                                                                                                                                                                            ${button.dataset.investor_profile ? `<a href="/storage/investor_profile/${button.dataset.investor_profile.trim()}" download class="download-link">Download PDF</a>` : 'N/A'}
                                                                                                                                                                                                                                                                                                                                                                                                        </div>
                                                                                                                                                                                                                                                                                                                                                                                                        ` : ''}
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
    </script>
@endsection
