@extends('layouts.app')

@section('title', 'Login - Future Taikun')
<link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
@section('content')
    <div class="container py-5">
        <div class="row justify-content-center">
            <div class="col-md-6">
                <div class="card shadow-sm rounded-4">
                    <div class="card-body p-4">
                        <h2 class="text-center fw-bold">Login</h2>
                        @if ($errors->any())
                            <div class="alert alert-danger">
                                @foreach ($errors->all() as $error)
                                    <div>{{ $error }}</div>
                                @endforeach
                            </div>
                        @endif
                        <form method="POST" action="{{ route('login.process') }}">
                            @csrf
                            <div class="mb-3">
                                <div class="form-floating-custom">
                                    <label for="email" class="form-label">Email address</label>
                                    <input type="email" name="email" placeholder="xyz@gmail.com" class="form-control"
                                        value="{{ old('email') }}" required autofocus>
                                </div>
                            </div>

                            <div class="mb-3">
                                <div class="form-floating-custom">
                                    <label for="password" class="form-label">Password</label>
                                    <input type="password" placeholder="Password@123" name="password" class="form-control"
                                        required>
                                </div>
                            </div>

                            <div class="mb-3">
                                <div class="form-group">
                                    <label class="form-label">Login as a</label>
                                    <div class="d-flex flex-wrap align-items-center">
                                        <div class="form-check me-4 mb-2">
                                            <input type="radio" name="role" id="role_investor" value="investor"
                                                class="form-check-input" {{ old('role') === 'investor' ? 'checked' : '' }}>
                                            <label class="form-check-label" for="role_investor">Investor</label>
                                        </div>
                                        <div class="form-check me-4 mb-2">
                                            <input type="radio" name="role" id="role_entrepreneur" value="entrepreneur"
                                                class="form-check-input"
                                                {{ old('role') === 'entrepreneur' ? 'checked' : '' }}>
                                            <label class="form-check-label" for="role_entrepreneur">Entrepreneur</label>
                                        </div>
                                        {{-- <div class="form-check mb-2">
                                            <input type="radio" name="role" id="role_admin" value="admin"
                                                class="form-check-input" {{ old('role') === 'admin' ? 'checked' : '' }}
                                                required>
                                            <label class="form-check-label" for="role_admin">Admin</label>
                                        </div> --}}
                                    </div>
                                </div>
                            </div>

                            <button type="submit" class="btn btn-primary w-100">Login</button>
                        </form>
                        <div class="d-flex justify-content-between">
                            <div class="mt-3">
                                <a href="{{ route('password.request') }}" class="text-primary mt-2">Forgot Password?</a>
                            </div>
                            <div class="mt-3">
                                <a href="{{ route('mobile.form') }}" class="text-primary mt-2">SignUp</a>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
