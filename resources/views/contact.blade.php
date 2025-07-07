{{-- resources/views/contact.blade.php --}}
@extends('layouts.app')
<style>
    body {
        background-color: #f9f9f9;
        font-family: Arial, sans-serif;
    }

    .container {
        max-width: 1200px;
    }

    .card {
        border: none;
        border-radius: 10px;
        box-shadow: 0 4px 8px rgba(0, 0, 0, 0.1);
    }

    .card-body .form-control {
        border: 1px solid #ccc;
        border-radius: 5px;
        padding: 10px;
    }

    .btn-primary {
        background-color: #00c4cc;
        border: none;
        border-radius: 20px;
        padding: 10px 30px;
        font-weight: bold;
    }

    .btn-primary:hover {
        background-color: #00a1a7;
    }

    .card.h-100 {
        height: 100%;
    }

    .card-body {
        min-height: 400px;
        /* Ensure minimum height for alignment */
        display: flex;
        flex-direction: column;
    }

    .card-body.text-center p {
        color: #666;
        font-size: 14px;
    }

    .card-body.text-center strong {
        color: #333;
    }

    /* Responsive Design */
    @media (max-width: 768px) {
        .row {
            flex-direction: column;
        }

        .col-12.col-md-6 {
            width: 100% !important;
            max-width: 100% !important;
        }

        .card-body {
            min-height: auto;
            /* Reset min-height on mobile */
        }
    }
</style>
<!-- CSS -->
@section('content')
    <div class="container my-5">
        <div class="row">
            <!-- Left Div (Contact Details) -->
            <div class="col-12 col-md-6">
                <div class="card p-4 shadow-sm">
                    <div class="card-body">
                        <h2 class="mb-4 fw-bold text-center">Contact Us</h2>
                        <form action="{{ route('contact.store') }}" method="POST" class="row g-3">
                            @csrf
                            <div class="col-12">
                                <label for="name" class="form-label">Full Name</label>
                                <input type="text" name="name" class="form-control" id="name" required>
                            </div>
                            <div class="col-12">
                                <label for="email" class="form-label">Email</label>
                                <input type="email" name="email" class="form-control" id="email" required>
                            </div>
                            <div class="col-12">
                                <label class="form-label">Mobile Number</label>
                                <div class="input-group">
                                    <select name="country_code" class="form-select" id="country_code"
                                        style="max-width: 120px;">
                                        @foreach ($countries as $country)
                                            <option value="{{ $country['code'] }}"
                                                {{ $country['code'] == '+91' ? 'selected' : '' }}>
                                                {{ $country['name'] }} ({{ $country['code'] }})
                                            </option>
                                        @endforeach
                                    </select>
                                    <input type="tel" class="form-control" name="phone_number" id="phone_number"
                                        placeholder="Enter mobile number" value="{{ old('phone_number') }}" maxlength="10"
                                        required>
                                </div>
                                @error('country_code')
                                    <div class="text-danger mt-1">{{ $message }}</div>
                                @enderror
                                @error('phone_number')
                                    <div class="text-danger mt-1">{{ $message }}</div>
                                @enderror
                            </div>
                            <div class="col-12">
                                <label for="message" class="form-label">Message</label>
                                <textarea name="message" id="message" rows="4" class="form-control" required></textarea>
                            </div>
                            <div class="col-12">
                                <button type="submit" class="btn btn-primary mt-3">Send Message</button>
                            </div>
                        </form>
                    </div>
                </div>
            </div>

            <!-- Right Div (Let's Talk Text) -->
            <div class="col-12 col-md-6">
                <div class="card p-4 shadow-sm h-100">
                    <div class="card-body d-flex flex-column justify-content-center text-center">
                        <h2 class="mb-3">Let’s Connect!</h2>
                        <p>At Future Taikun, we’re a passionate community of entrepreneurs, creators, and investors who
                            believe in bold ideas and global opportunities.</p>
                        <p>Whether you’re building your first startup or looking to back the next big thing, we’re here to
                            listen, collaborate, and empower you—no matter where you are in the world.
                        </p>
                        <p>Have a question or want to pitch your idea?
                            Just drop us an email. We’re fully digital, always listening, and ready to support innovation
                            from anywhere..
                        </p>
                        <p class="mt-4"><strong>Contact:</strong><br>
                            Email: info@futuretaikun.com</p>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
