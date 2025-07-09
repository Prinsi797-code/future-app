@extends('layouts.admin')

@section('title', 'Entrepreneurs Company')

@section('content')
    <div class="container">
        {{-- <h1>My Companies</h1> --}}

        {{-- @if (Auth::user()->role === 'entrepreneur') --}}
        @if (session('selected_role') === 'investor')
            <div class="d-flex justify-content-end mb-3">
                <button type="button" class="btn btn" data-bs-toggle="modal" data-bs-target="#addCompanyModal"
                    style="background-color: #2EA9B9;color:white;">
                    Setup New Company
                </button>
            </div>

            @if ($companies->isEmpty())
                <div class="alert alert-warning text-center" role="alert">
                    Company not found. <button type="button" class="alert-link" data-bs-toggle="modal"
                        data-bs-target="#addCompanyModal">Setup New Company</button>
                </div>
            @else
                <div class="table-responsive">
                    <table class="table table-striped">
                        <thead>
                            <tr>
                                <th>Id</th>
                                <th>Company Name</th>
                                <th>Investment</th>
                                <th>Equity Holding (%)</th>
                                <th>Company Valuation</th>
                                {{-- <th>Actions</th> --}}
                            </tr>
                        </thead>
                        <tbody>
                            @foreach ($companies as $company)
                                <tr>
                                    <td>{{ $company->id }}</td>
                                    <td>{{ $company->company_name }}</td>
                                    <td>{{ number_format($company->market_capital, 2) }}</td>
                                    <td>{{ number_format($company->your_stake, 2) }}</td>
                                    <td>{{ number_format($company->stake_funding, 2) }}</td>
                                    {{-- <td>
                                        <button type="button" class="btn btn-secondary btn-sm" data-bs-toggle="modal"
                                            data-bs-target="#editCompanyModal{{ $company->id }}">Edit</button>
                                    </td> --}}
                                </tr>

                                <!-- Edit Modal -->
                                <!-- Edit Modal -->
                                {{-- <div class="modal fade" id="editCompanyModal{{ $company->id }}" tabindex="-1"
                                    aria-labelledby="editCompanyModalLabel{{ $company->id }}" aria-hidden="true">
                                    <div class="modal-dialog modal-dialog-centered">
                                        <div class="modal-content">
                                            <div class="modal-header">
                                                <h5 class="modal-title" id="editCompanyModalLabel{{ $company->id }}">Edit
                                                    Company</h5>
                                                <button type="button" class="btn-close" data-bs-dismiss="modal"
                                                    aria-label="Close"></button>
                                            </div>
                                            <form method="POST" action="{{ route('company.update', $company->id) }}"
                                                id="editForm{{ $company->id }}">
                                                @csrf
                                                @method('PUT')
                                                <div class="modal-body">
                                                    @if ($errors->any())
                                                        <div class="alert alert-danger">
                                                            <ul>
                                                                @foreach ($errors->all() as $error)
                                                                    <li>{{ $error }}</li>
                                                                @endforeach
                                                            </ul>
                                                        </div>
                                                    @endif
                                                    <div class="mb-3">
                                                        <label class="form-label">Company Name</label>
                                                        <input type="text" name="company_name" class="form-control"
                                                            value="{{ old('company_name', $company->company_name) }}"
                                                            required>
                                                        @error('company_name')
                                                            <div class="text-danger mt-1">{{ $message }}</div>
                                                        @enderror
                                                    </div>
                                                    <div class="mb-3">
                                                        <label class="form-label">Investment</label>
                                                        <input type="number" name="more_market_capital"
                                                            class="form-control investment"
                                                            value="{{ old('more_market_capital', $company->more_market_capital) }}"
                                                            step="0.01" required>
                                                        @error('more_market_capital')
                                                            <div class="text-danger mt-1">{{ $message }}</div>
                                                        @enderror
                                                    </div>
                                                    <div class="mb-3">
                                                        <label class="form-label">Equity Holding (%)</label>
                                                        <input type="number" name="more_your_stake"
                                                            class="form-control equity"
                                                            value="{{ old('more_your_stake', $company->more_your_stake) }}"
                                                            min="0" max="100" step="0.01" required>
                                                        <div class="text-danger mt-1 d-none equity-error"></div>
                                                        @error('more_your_stake')
                                                            <div class="text-danger mt-1">{{ $message }}</div>
                                                        @enderror
                                                    </div>
                                                    <div class="mb-3">
                                                        <label class="form-label">Company Valuation</label>
                                                        <input type="text" name="more_stake_funding"
                                                            class="form-control valuation"
                                                            value="{{ old('more_stake_funding', $company->more_stake_funding) }}"
                                                            readonly>
                                                        @error('more_stake_funding')
                                                            <div class="text-danger mt-1">{{ $message }}</div>
                                                        @enderror
                                                    </div>
                                                </div>
                                                <div class="modal-footer">
                                                    <button type="button" class="btn btn-secondary"
                                                        data-bs-dismiss="modal">Close</button>
                                                    <button type="submit" class="btn btn-primary">Update</button>
                                                </div>
                                            </form>
                                        </div>
                                    </div>
                                </div> --}}
                            @endforeach
                        </tbody>
                    </table>
                </div>
            @endif

            <!-- Add Modal -->
            <div class="modal fade" id="addCompanyModal" tabindex="-1" aria-labelledby="addCompanyModalLabel"
                aria-hidden="true">
                <div class="modal-dialog modal-dialog-centered">
                    <div class="modal-content">
                        <div class="modal-header">
                            <h5 class="modal-title" id="addCompanyModalLabel">Add New Company</h5>
                            <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                        </div>
                        <form method="POST" action="{{ route('investor.company.store') }}" id="addForm">
                            @csrf
                            <div class="modal-body">
                                <div class="mb-3">
                                    <label class="form-label">Company Name</label>
                                    <input type="text" name="company_name" class="form-control" required>
                                </div>
                                <div class="mb-3">
                                    <label class="form-label">Investment</label>
                                    <input type="number" name="market_capital" class="form-control investment"
                                        step="0.01" required>
                                </div>
                                <div class="mb-3">
                                    <label class="form-label">Equity Holding (%)</label>
                                    <input type="number" name="your_stake" class="form-control equity" min="0"
                                        max="100" step="0.01" required>
                                    <div class="text-danger mt-1 d-none equity-error"></div>
                                </div>
                                <div class="mb-3">
                                    <label class="form-label">Company Valuation</label>
                                    <input type="text" name="stake_funding" class="form-control valuation" readonly>
                                </div>
                            </div>
                            <div class="modal-footer">
                                <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
                                <button type="submit" class="btn btn-primary">Save</button>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        @else
            <div class="alert alert-danger" role="alert">
                You do not have permission to view this page.
            </div>
        @endif
    </div>
    <script>
        function validateEquityPercentage(input) {
            let value = input.value.replace(/[^0-9.]/g, ''); // Remove non-numeric characters except decimal
            const parts = value.split('.');
            if (parts.length > 2) {
                value = parts[0] + '.' + parts.slice(1).join('');
            }
            if (parts[1] && parts[1].length > 2) {
                value = parts[0] + '.' + parts[1].substring(0, 2);
            }
            const numValue = parseFloat(value) || 0;
            if (numValue > 100) {
                value = '100.00';
            } else if (numValue < 0) {
                value = '0.00';
            }
            input.value = value;

            const errorDiv = input.nextElementSibling;
            if (errorDiv && errorDiv.classList.contains('equity-error')) {
                if (numValue >= 0 && numValue <= 100) {
                    errorDiv.classList.add('d-none');
                } else {
                    errorDiv.textContent = 'Please enter a valid percentage (0-100)';
                    errorDiv.classList.remove('d-none');
                }
            }

            calculateValuation(input);
        }

        function calculateValuation(triggerElement) {
            const form = triggerElement.closest('form');
            if (!form) {
                console.error('Form not found for input:', triggerElement);
                return;
            }

            const investmentInput = form.querySelector('input[name="market_capital"]');
            const equityInput = form.querySelector('input[name="your_stake"]');
            const valuationInput = form.querySelector('input[name="stake_funding"]');

            if (!investmentInput || !equityInput || !valuationInput) {
                console.error('Required inputs not found in form:', form.id);
                return;
            }

            const investment = parseFloat(investmentInput.value.replace(/,/g, '')) || 0;
            const equity = parseFloat(equityInput.value.replace(/,/g, '')) || 0;

            console.log('Calculating valuation for form:', form.id, {
                investment,
                equity
            });

            if (investment > 0 && equity > 0) {
                const valuation = (investment / equity) * 100;
                valuationInput.value = valuation.toFixed(2);
                console.log('Valuation updated to:', valuation.toFixed(2));
            } else {
                valuationInput.value = '';
                console.log('Valuation cleared due to invalid inputs');
            }
        }

        function addListenersToForm(form) {
            if (!form) {
                console.error('Cannot add listeners to null form');
                return;
            }

            console.log('Adding listeners to form:', form.id);

            const investmentInput = form.querySelector('input[name="market_capital"]');
            const equityInput = form.querySelector('input[name="your_stake"]');

            if (investmentInput) {
                investmentInput.addEventListener('input', (e) => {
                    console.log('Investment changed in', form.id, ':', e.target.value);
                    calculateValuation(e.target);
                });
            }
            if (equityInput) {
                equityInput.addEventListener('input', (e) => {
                    console.log('Equity changed in', form.id, ':', e.target.value);
                    validateEquityPercentage(e.target);
                });
            }

            // Trigger initial calculation
            if (investmentInput && investmentInput.value && equityInput && equityInput.value) {
                console.log('Triggering initial calculation for form:', form.id);
                calculateValuation(investmentInput);
            }
        }

        document.addEventListener('DOMContentLoaded', function() {
            console.log('DOM loaded, initializing forms');

            // Add listeners to add form
            const addForm = document.getElementById('addForm');
            if (addForm) {
                addListenersToForm(addForm);
            }

            // Add listeners to edit forms
            const editForms = document.querySelectorAll('form[id^="editForm"]');
            console.log('Found', editForms.length, 'edit forms');
            editForms.forEach(addListenersToForm);

            // Re-attach listeners when modals are shown
            const modals = document.querySelectorAll('.modal[id^="editCompanyModal"], #addCompanyModal');
            console.log('Found', modals.length, 'modals');
            modals.forEach(modal => {
                modal.addEventListener('shown.bs.modal', function() {
                    const form = modal.querySelector('form');
                    if (form) {
                        console.log('Modal shown, initializing form:', form.id);
                        addListenersToForm(form);
                    }
                });
            });
        });
    </script>
@endsection
