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

    <div class="auth-wrapper">
        <div class="auth-card">
            <h2 class="text-center">Forgot Password</h2>

            @if (session('status'))
                <div class="alert alert-success">{{ session('status') }}</div>
            @endif

            <form method="POST" action="{{ route('password.email') }}">
                @csrf
                <div class="mb-4">
                    <div class="form-floating-custom">
                        <label for="email" class="form-label">Email address</label>
                        <input type="email" name="email" placeholder="xyz@gmail.com" id="email" class="form-control"
                            placeholder="Type your email" required>
                    </div>
                </div>
                <div class="text-center">
                    <button type="submit" class="btn btn-custom">Send Reset Link</button>
                </div>
            </form>
        </div>
    </div>
@endsection
