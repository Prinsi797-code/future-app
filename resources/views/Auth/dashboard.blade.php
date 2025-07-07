@extends('layouts.admin')

@section('content')
    <div class="row">
        @if (session('selected_role') === 'admin')
            {{-- @if (Auth::user()->role !== 'investor') --}}
            <div class="col-md-6 mb-4">
                <a href="{{ route('admin.investors') }}" style="text-decoration: none;">
                    <div class="card shadow-sm">
                        <div class="card-body">
                            <h5>Investor Stats</h5>
                            <p>Number of Investors: {{ $investorCount }}</p>
                        </div>
                    </div>
                </a>
            </div>
        @endif

        <div class="col-md-6 mb-4">
            <a href="{{ route('admin.entrepreneurs') }}" style="text-decoration: none;">
                <div class="card shadow-sm">
                    <div class="card-body">
                        <h5>Entrepreneur Stats</h5>
                        <p>Number of Entrepreneurs: {{ $entrepreneurCount }}</p>
                    </div>
                </div>
            </a>
        </div>
    </div>
@endsection
