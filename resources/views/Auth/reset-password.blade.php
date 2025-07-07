@extends('layouts.app')
@section('content')
    <style>
        body {
            background: #f8f9fa;
        }

        .auth-wrapper {
            min-height: 80vh;
            display: flex;
            justify-content: center;
            align-items: center;
        }

        .auth-card {
            background: #f9fafc;
            border-radius: 20px;
            box-shadow: 0 15px 35px rgba(0, 0, 0, 0.1);
            padding: 40px 30px;
            max-width: 500px;
            width: 100%;
        }

        .auth-card h2 {
            font-weight: 600;
            margin-bottom: 25px;
        }

        .btn-custom {
            background-color: #2EA9B9;
            color: white;
            font-weight: 500;
            border-radius: 25px;
            padding: 10px 25px;
            transition: background 0.3s ease;
        }

        .btn-custom:hover {
            background-color: #2EA9B9;
        }

        .form-control {
            border-radius: 12px;
            padding: 12px;
        }
    </style>
    {{-- <div class="container">
            <h2>Reset Password</h2>
            <form method="POST" action="{{ route('password.update') }}">
                @csrf
                <input type="hidden" name="token" value="{{ $token }}">
                <input type="hidden" name="email" value="{{ $email }}">

                <div class="mb-3">
                    <label>New Password</label>
                    <input type="password" name="password" class="form-control" required>
                </div>

                <div class="mb-3">
                    <label>Confirm Password</label>
                    <input type="password" name="password_confirmation" class="form-control" required>
                </div>

                <button type="submit" class="btn btn-primary">Reset Password</button>
            </form>
        </div> --}}
    <div class="auth-wrapper">
        <div class="auth-card">
            <h2 class="text-center pb-3">Reset Password</h2>

            @if (session('status'))
                <div class="alert alert-success">{{ session('status') }}</div>
            @endif

            <form method="POST" action="{{ route('password.update') }}">
                @csrf
                <input type="hidden" name="token" value="{{ $token }}">
                <input type="hidden" name="email" value="{{ $email }}">
                <div class="mb-3">
                    <div class="form-floating-custom">
                        <label>New Password</label>
                        <input type="password" name="password" class="form-control"
                            placeholder="Type your new password.."required>
                    </div>
                </div>
                <div class="mb-3">
                    <div class="form-floating-custom">
                        <label>Confirm Password</label>
                        <input type="password" name="password_confirmation" class="form-control"
                            placeholder="Type your confirm password.." required>
                    </div>
                </div>
                <div class="text-center">
                    <button type="submit" class="btn btn-custom">Reset Password</button>
                </div>
            </form>
        </div>
    </div>
@endsection
