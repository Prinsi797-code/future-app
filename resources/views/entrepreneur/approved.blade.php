{{-- <!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Entrepreneur List</title>
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
            text-overflow: ellipsis;
            white-space: nowrap;
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
    </style>
</head> --}}
@extends('layouts.app')

@section('title', 'Entrepreneur List - Future Taikun')
<style>
    .table-responsive {
        padding: 20px;
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
        text-overflow: ellipsis;
        white-space: nowrap;
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

    .btn-group .btn {
        height: 45px;
        border-radius: 0 !important;
    }

    .btn-group .btn:first-child {
        border-top-left-radius: 6px !important;
        border-bottom-left-radius: 6px !important;
    }

    form .form-control {
        height: 45px;
        border-top-right-radius: 6px;
        border-bottom-right-radius: 6px;
    }

    .card-img-top {
        border-top-left-radius: 0.5rem;
        border-top-right-radius: 0.5rem;
    }

    .card .position-absolute img {
        box-shadow: 0 2px 6px rgba(0, 0, 0, 0.2);
    }

    .btn-primary:hover {
        transform: translateY(0px) !important;
    }

    .single-line-stats {
        display: flex;
        flex-wrap: wrap;
        gap: 10px;
        /* Space between items */
        justify-content: center;
        align-items: center;
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

    .search-container {
        background: #343a40;
        color: white;
        padding: 1.5rem 1rem;
        margin-bottom: 1.5rem;
    }

    .filter-tabs {
        height: 45px;
    }

    .search-form {
        height: 45px;
    }

    /* Mobile specific styles */
    @media (max-width: 768px) {
        .search-container {
            padding: 1rem 0.75rem;
        }

        .mobile-stack {
            flex-direction: column !important;
            gap: 1rem;
        }

        .filter-tabs {
            width: 100%;
            height: auto;
        }

        .btn-group {
            width: 100%;
            display: flex;
        }

        .btn-group .btn {
            flex: 1;
            font-size: 0.875rem;
            padding: 0.5rem 0.25rem;
            white-space: nowrap;
        }

        .search-form {
            width: 100%;
            height: auto;
        }

        .search-input {
            height: 45px !important;
            border-radius: 4px 0 0 4px !important;
        }

        .search-btn {
            height: 45px !important;
            border-radius: 0 4px 4px 0 !important;
            min-width: 50px;
        }
    }

    /* Desktop specific styles */
    @media (min-width: 769px) {
        .desktop-flex {
            display: flex;
            justify-content: center;
            align-items: center;
            flex-wrap: wrap;
        }

        .desktop-search-wrapper {
            padding-left: 5px;
        }
    }
</style>
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

@section('content')

    <body class="bg-light">
        <div class="container-fluid">
            <div class="row">
                <div class="search-container">
                    <h3 class="mb-4 text-center fw-bold">Browse Business Idea In Future Taikun</h3>

                    <!-- Desktop Layout -->
                    <div class="d-none d-md-flex desktop-flex">
                        <div class="d-flex filter-tabs">
                            <!-- Filter Tabs -->
                            <div class="btn-group" role="group">
                                <a href="{{ route('search', ['filter' => 'latest']) }}"
                                    class="btn btn-light active {{ request('filter') == 'latest' || !request('filter') ? 'active' : '' }}">Latest</a>
                                <a href="{{ route('search', ['filter' => 'trending']) }}"
                                    class="btn btn-light {{ request('filter') == 'trending' ? 'active' : '' }}">Trending</a>
                                <a href="{{ route('search', ['filter' => 'alreadyfunded']) }}"
                                    class="btn btn-light {{ request('filter') == 'alreadyfunded' ? 'active' : '' }}">Already
                                    Funded</a>
                            </div>

                            <!-- Search Form -->
                            <div class="desktop-search-wrapper">
                                <form action="{{ route('search') }}" method="GET" class="d-flex search-form">
                                    <input type="hidden" name="filter" value="{{ request('filter') }}">
                                    <input type="text" name="query" class="form-control border-start-0"
                                        placeholder="Search by business name, country, or capital..."
                                        value="{{ request('query') }}" style="height: 45px; border-radius: 0 0 0 4px;">
                                    <button type="submit" class="btn btn-primary"
                                        style="height: 45px; border-radius: 0 4px 4px 0;">
                                        <i class="fas fa-search"></i>
                                    </button>
                                </form>
                            </div>
                        </div>
                    </div>

                    <!-- Mobile Layout -->
                    <div class="d-md-none mobile-stack">
                        <!-- Filter Tabs for Mobile -->
                        <div class="filter-tabs">
                            <div class="btn-group w-100" role="group">
                                <a href="{{ route('search', ['filter' => 'latest']) }}"
                                    class="btn btn-light active {{ request('filter') == 'latest' || !request('filter') ? 'active' : '' }}">Latest</a>
                                <a href="{{ route('search', ['filter' => 'trending']) }}"
                                    class="btn btn-light {{ request('filter') == 'trending' ? 'active' : '' }}">Trending</a>
                                <a href="{{ route('search', ['filter' => 'alreadyfunded']) }}"
                                    class="btn btn-light {{ request('filter') == 'alreadyfunded' ? 'active' : '' }}">Already
                                    Funded</a>
                            </div>
                        </div>

                        <!-- Search Form for Mobile -->
                        <div class="search-form">
                            <form action="{{ route('search') }}" method="GET" class="d-flex mt-3">
                                <input type="hidden" name="filter" value="{{ request('filter') }}">
                                <input type="text" name="query" class="form-control search-input"
                                    placeholder="Search by business name, country, or capital..."
                                    value="{{ request('query') }}">
                                <button type="submit" class="btn btn-primary search-btn">
                                    <i class="fas fa-search"></i>
                                </button>
                            </form>
                        </div>
                    </div>
                </div>

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
                                $logo =
                                    $entrepreneur->y_business_logo_admin ?? ($entrepreneur->y_business_logo ?? null);
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
                                $entrepreneur->register_business == 1
                                    ? $entrepreneur->y_your_stake
                                    : $entrepreneur->your_stake;

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
                                onclick="window.open('{{ $videoUrl }}', '_blank')"
                                style="cursor: pointer; border: none;">
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
                                            <div
                                                style="height: 50px; width: 50px; background-color: #f8f9fa; border-radius: 6px;">
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
                <div class="mt-4">
                    {{ $approvedEntrepreneurs->links('pagination::bootstrap-5') }}
                </div>
            </div>
        </div>
        <!-- Video Modal -->
        <div class="modal fade" id="videoModal" tabindex="-1" aria-labelledby="videoModalLabel" aria-hidden="true">
            <div class="modal-dialog modal-dialog-centered modal-lg">
                <div class="modal-content bg-dark">
                    <div class="modal-header border-0">
                        <button type="button" class="btn-close btn-close-white ms-auto" data-bs-dismiss="modal"
                            aria-label="Close"></button>
                    </div>
                    <div class="modal-body p-0">
                        <div class="ratio ratio-16x9">
                            <iframe id="videoIframe" src="" title="Pitch Video" frameborder="0"
                                allowfullscreen></iframe>
                        </div>
                    </div>
                </div>
            </div>
        </div>

        <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
        <script src="https://code.jquery.com/jquery-3.7.1.min.js"></script>
        <script>
            $videoUrl = $entrepreneur - > pitch_video ? : 'javascript:void(0);';

            $(document).on('change', '.toggle-approval', function() {
                const entrepreneurId = $(this).data('id');
                const isApproved = $(this).is(':checked') ? 1 : 0;

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
                            console.log('Status updated');
                        } else {
                            alert('Error updating status');
                        }
                    },
                    error: function() {
                        alert('Server error');
                    }
                });
            });

            document.addEventListener('DOMContentLoaded', function() {
                const buttons = document.querySelectorAll('.view-details-btn');
                const nameField = document.getElementById('modal-investor-name');
                const tableBody = document.getElementById('modal-company-table-body');
                const profTableBody = document.getElementById('modal-professional-table-body');

                buttons.forEach(button => {
                    button.addEventListener('click', function() {
                        const investorentrepreneurId = this.dataset.id;
                        const investorName = this.dataset.name;
                        const investmentRange = this.dataset.range;

                        nameField.textContent = `Name: ${investorName}`;

                        profTableBody.innerHTML = `
                    <tr><th>businessStage</th><td>${button.dataset.business || '-'}</td></tr>
                    <tr><th>ideaSummary</th><td>${button.dataset.idea || '-'}</td></tr>
                    <tr><th>industry</th><td>${button.dataset.industry || '-'}</td></tr>
                    <tr><th>website</th><td>${button.dataset.website || '-'}</td></tr>
                    <tr><th>pitchVideo</th><td>${button.dataset.video || '-'}</td></tr>`;

                        // Show modal
                        const modal = new bootstrap.Modal(document.getElementById(
                            'investorDetailModal'));
                        modal.show();
                    });
                });
            });
        </script>
    @endsection
    {{-- <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script> --}}
