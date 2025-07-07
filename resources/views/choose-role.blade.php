{{-- @extends('layouts.app')

@section('content')
    <div class="container mt-5 text-center">
        <h2>Choose who you’re creating a profile for!</h2>
        <div class="mt-4">
            <a href="{{ route('entrepreneur.form') }}" class="btn btn-outline-primary btn-lg mx-2">Entrepreneur</a>
            <a href="{{ route('investor.form') }}" class="btn btn-outline-success btn-lg mx-2">Investor</a>
        </div>
    </div>
@endsection --}}



{{-- new app  --}}


@extends('layouts.app')

@section('title', 'Choose Your Role - Future Taikun')

@section('content')
    <div class="row justify-content-center">
        <div class="hero-section">
            <div class="hero-overlay">
                <div class="text-center text-white">
                    <h3>"We're connecting enterpuner with investore-shaping the future taikun"</h3>
                </div>
            </div>
        </div>
        <div class="card">
            <div class="card-body p-5">
                <div class="col-md-12 text-center">
                    <h3 class="mb-3">Choose who you’re!</h3>
                    <form action="{{ route('set.role') }}" method="POST">
                        @csrf
                        {{-- <input type="hidden" name="user_id" value="{{ $user->id }}"> --}}

                        <div class="mb-3 text-center">
                            <div class="role-card">
                                <input type="radio" class="btn-check" name="role" id="entrepreneur"
                                    value="entrepreneur" required>
                                <label class="btn btn-outline-secondary" for="entrepreneur">ENTREPRENEUR PITCH PAD</label>
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

                        <div class="d-flex justify-content-center">
                            <div class="w-100" style="max-width: 500px;">
                                <button type="submit" class="btn btn-primary w-100 py-3">
                                    <i class="fas fa-arrow-right me-2"></i>Continue
                                </button>
                            </div>
                        </div>
                        {{-- <button type="submit" class="btn btn-primary w-100 py-3">
                                <i class="fas fa-arrow-right me-2"></i>Continue
                            </button> --}}
                    </form>

                </div>
            </div>
        </div>
    </div>
@endsection

@section('scripts')
    <style>
        .btn-group-toggle .btn {
            padding: 0.375rem 1.25rem;
            font-weight: 500;
            font-size: 1rem;
            border-radius: 9999px;
            /* pill shape */
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
            /* Bootstrap primary */
            color: black;
            border-color: #FFE7EA;
            box-shadow: 0 2px 6px #FFE7EA;
        }

        .role-card label.btn {
            border-radius: 50px;
            /* fully rounded */
            padding: 0.375rem 1.25rem;
            /* smaller vertical padding, bigger horizontal */
            font-weight: 500;
            font-size: 0.9rem;
            text-transform: none;
            min-width: 80px;
            display: inline-block;
            cursor: pointer;
        }

        .role-card input[type="radio"]:checked+label.btn {
            background-color: #FFE7EA;
            /* Bootstrap primary blue or change as needed */
            color: black;
            border-color: #FFE7EA;
        }

        .role-card {
            display: inline-block;
            margin-right: 10px;
        }
    </style>
@endsection
