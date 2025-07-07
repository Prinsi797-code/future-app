@extends('layouts.admin')

@section('title', 'Change Password - Future Taikun')

@section('content')
    <div class="container py-5">
        <div class="row justify-content-center">
            <div class="col-md-6">
                <div class="card shadow-sm rounded-4">
                    <div class="card-body p-4">
                        {{-- <h2 class="text-center fw-bold">Change Password</h2> --}}
                        @if ($errors->any())
                            <div class="alert alert-danger">
                                @foreach ($errors->all() as $error)
                                    <div>{{ $error }}</div>
                                @endforeach
                            </div>
                        @endif
                        <form method="POST" action="{{ route('change.password.post') }}" class="mt-5">
                            @csrf
                            <div class="mb-3">
                                <div class="form-floating-custom">
                                    <label for="current_password" class="form-label">Current Password</label>
                                    <input type="password" class="form-control" id="current_password"
                                        name="current_password" required>
                                </div>
                            </div>
                            <div class="mb-3">
                                <div class="form-floating-custom">
                                    <label for="new_password" class="form-label">New Password</label>
                                    <input type="password" class="form-control" id="new_password" name="new_password"
                                        required>
                                </div>
                            </div>
                            <div class="mb-3">
                                <div class="form-floating-custom">
                                    <label for="new_password_confirmation" class="form-label">Confirm New Password</label>
                                    <input type="password" class="form-control" id="new_password_confirmation"
                                        name="new_password_confirmation" required>
                                </div>
                            </div>
                            <button type="submit" class="btn btn" style="background-color: #2EA9B9;">Change
                                Password</button>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
