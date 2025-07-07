<!DOCTYPE html>
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

                {
                    {
                    -- text-overflow: ellipsis;
                    white-space: nowrap;
                    --
                }
            }
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
            /* Increase the size */
            transform-origin: left;
            /* Optional: keeps it aligned left */
            margin-right: 10px;
        }
    </style>
</head>

<body class="bg-light">
    <div class="container-fluid py-4">
        <div class="row">
            <div class="col-12">
                <!-- Header -->
                <div class="d-flex justify-content-between align-items-center mb-4">
                    <h2 class="mb-0">
                        <i class="bi bi-people-fill me-2"></i>
                        Investors
                    </h2>
                </div>

                <!-- Table -->
                <div class="card border-0">
                    <div class="card-body p-0">
                        <div class="table-responsive">
                            <table class="table table-hover mb-0">
                                <thead>
                                    <tr>
                                        <th scope="col">#</th>
                                        <th scope="col">Full Name</th>
                                        <th scope="col">Email</th>
                                        <th scope="col">Phone</th>
                                        <th scope="col">Country</th>
                                        <th scope="col">LinkedIn</th>
                                        <th scope="col">Investor Type</th>
                                        <th scope="col">Investment Range</th>
                                        <th scope="col">Preferred Industries</th>
                                        <th scope="col">Preferred Geography</th>
                                        <th scope="col">Preferred Stage</th>
                                        <th scope="col">Status</th>
                                        <th scope="col">Profile</th>
                                        {{-- <th scope="col">Registered</th> --}}
                                        <th scope="col">Action</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    @forelse($approvedInvestors as $index => $investor)
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
                                                <a href="tel:{{ $investor->phone_number }}"
                                                    class="text-decoration-none">
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
                                                    <span class="text-muted">-</span>
                                                @endif
                                            </td>
                                            <td>
                                                <span class="badge bg-info badge-custom">
                                                    {{ $investor->investor_type }}
                                                </span>
                                            </td>
                                            <td>
                                                <span class="badge bg-success badge-custom">
                                                    {{ $investor->investment_range }}
                                                </span>
                                            </td>
                                            <td>
                                                <div class="industries-list"
                                                    title="{{ is_array($investor->preferred_industries) ? implode(', ', $investor->preferred_industries) : $investor->preferred_industries }}">
                                                    @if (is_array($investor->preferred_industries))
                                                        @foreach ($investor->preferred_industries as $industry)
                                                            <span
                                                                class="badge bg-light text-dark badge-custom me-1 mb-1">{{ $industry }}</span>
                                                        @endforeach
                                                    @else
                                                        {{ $investor->preferred_industries }}
                                                    @endif
                                                </div>
                                            </td>
                                            <td>
                                                <div class="geography-list"
                                                    title="{{ is_array($investor->preferred_geographies) ? implode(', ', $investor->preferred_geographies) : $investor->preferred_geographies }}">
                                                    @if (is_array($investor->preferred_geographies))
                                                        @foreach ($investor->preferred_geographies as $geo)
                                                            <span
                                                                class="badge bg-light text-dark badge-custom me-1 mb-1">{{ $geo }}</span>
                                                        @endforeach
                                                    @else
                                                        {{ $investor->preferred_geographies }}
                                                    @endif
                                                </div>
                                            </td>
                                            <td>
                                                <span class="badge bg-warning text-dark badge-custom">
                                                    {{ $investor->preferred_startup_stage }}
                                                </span>
                                            </td>
                                            <td>
                                                @if ($investor->actively_investing)
                                                    <span class="badge bg-success badge-custom">
                                                        <i class="bi bi-check-circle me-1"></i>Active
                                                    </span>
                                                @else
                                                    <span class="badge bg-danger badge-custom">
                                                        <i class="bi bi-x-circle me-1"></i>Inactive
                                                    </span>
                                                @endif
                                            </td>

                                            <td>
                                                @if ($investor->investor_profile)
                                                    <a href="{{ asset('storage/' . $investor->investor_profile) }}"
                                                        target="_blank"
                                                        class="btn btn-sm btn-outline-primary investor-profile-link">
                                                        <i class="bi bi-file-earmark-pdf me-1"></i>View PDF
                                                    </a>
                                                @else
                                                    <span class="text-muted">No Profile</span>
                                                @endif
                                            </td>
                                            {{-- <td>
                                                    <small class="text-muted">
                                                        {{ $investor->created_at ? $investor->created_at->format('M d, Y') : '-' }}
                                            </small>
                                            </td> --}}
                                            <td>
                                                <button class="btn btn-sm btn-primary view-details-btn"
                                                    data-id="{{ $investor->id }}" data-name="{{ $investor->name }}"
                                                    data-range="{{ $investor->investment_range }}"
                                                    data-phone="{{ $investor->professional_phone }}"
                                                    data-email="{{ $investor->professional_email }}"
                                                    data-experience="{{ $investor->investment_experince }}"
                                                    data-website="{{ $investor->website }}"
                                                    data-designation="{{ $investor->designation }}"
                                                    data-organization="{{ $investor->organization_name }}">
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
                </div>

                <div class="modal fade" id="investorDetailModal" tabindex="-1"
                    aria-labelledby="investorDetailModalLabel" aria-hidden="true">
                    <div class="modal-dialog modal-lg modal-dialog-scrollable">
                        <div class="modal-content">
                            <div class="modal-header">
                                <h5 class="modal-title" id="investorDetailModalLabel">Investor Details</h5>
                                <button type="button" class="btn-close" data-bs-dismiss="modal"
                                    aria-label="Close"></button>
                            </div>
                            <div class="modal-body">
                                <h6 id="modal-investor-name" class="mb-3"></h6>

                                <div class="row mb-3">
                                    <div class="col-6">
                                        <h6 class="">Investment Range:</h6>
                                        <span class="badge bg-success" id="modal-investor-range"></span>
                                    </div>
                                </div>

                                <div class="table-responsive">
                                    <table class="table table-bordered table-sm">
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
                                <div class="table-responsive mt-4">
                                    <h6 class="mb-2">Details</h6>
                                    <table class="table table-bordered table-sm">
                                        <tbody id="modal-professional-table-body">
                                            <tr>
                                                <td colspan="2" class="text-muted text-center">Loading...</td>
                                            </tr>
                                        </tbody>
                                    </table>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
    <script src="https://code.jquery.com/jquery-3.7.1.min.js"></script>
    <script>
        document.addEventListener('DOMContentLoaded', function() {
            const buttons = document.querySelectorAll('.view-details-btn');
            const nameField = document.getElementById('modal-investor-name');
            const rangeField = document.getElementById('modal-investor-range');
            const tableBody = document.getElementById('modal-company-table-body');
            const profTableBody = document.getElementById('modal-professional-table-body');

            buttons.forEach(button => {
                button.addEventListener('click', function() {
                    const investorId = this.dataset.id;
                    const investorName = this.dataset.name;
                    const investmentRange = this.dataset.range;

                    nameField.textContent = `Name: ${investorName}`;
                    rangeField.textContent = investmentRange;

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

                    profTableBody.innerHTML = `
    <tr><th>Phone</th><td>${button.dataset.phone || '-'}</td></tr>
    <tr><th>Email</th><td>${button.dataset.email || '-'}</td></tr>
    <tr><th>Experience</th><td>${button.dataset.experience || '-'}</td></tr>
    <tr><th>Website</th><td>${button.dataset.website ? `<a href="${button.dataset.website}" target="_blank">${button.dataset.website}</a>` : '-'}</td></tr>
    <tr><th>Designation</th><td>${button.dataset.designation || '-'}</td></tr>
    <tr><th>Organization</th><td>${button.dataset.organization || '-'}</td></tr>
`;
                    // Show modal
                    const modal = new bootstrap.Modal(document.getElementById(
                        'investorDetailModal'));
                    modal.show();
                });
            });
        });
    </script>
</body>

</html>
