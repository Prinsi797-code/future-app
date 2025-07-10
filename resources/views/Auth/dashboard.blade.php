@extends('layouts.admin')

@section('content')
    <div class="row">
        @if ($userRole === 'admin')
            <!-- Investor Stats Card -->
            <div class="col-md-6 mb-4">
                <a href="{{ route('admin.investors') }}" style="text-decoration: none;">
                    <div class="card shadow-sm">
                        <div class="card-body">
                            <h5>Investor Stats</h5>
                            <p>Approved Investors: {{ $investorCountApproved }}</p>
                            <p>Unapproved Investors: {{ $investorCountUnapproved }}</p>
                        </div>
                    </div>
                </a>
            </div>

            <!-- Entrepreneur Stats Card -->
            <div class="col-md-6 mb-4">
                <a href="{{ route('admin.entrepreneurs') }}" style="text-decoration: none;">
                    <div class="card shadow-sm">
                        <div class="card-body">
                            <h5>Entrepreneur Stats</h5>
                            <p>Approved Entrepreneurs: {{ $entrepreneurCountApproved }}</p>
                            <p>Unapproved Entrepreneurs: {{ $entrepreneurCountUnapproved }}</p>
                        </div>
                    </div>
                </a>
            </div>
        @elseif ($userRole === 'investor' && $investor->approved == 1)
            <!-- Entrepreneur Stats Card (Only Approved) -->
            <div class="col-md-6 mb-4">
                <a href="{{ route('admin.entrepreneurs') }}" style="text-decoration: none;">
                    <div class="card shadow-sm">
                        <div class="card-body">
                            <h5>Entrepreneur Stats</h5>
                            <p>Approved Entrepreneurs: {{ $entrepreneurCountApproved }}</p>
                        </div>
                    </div>
                </a>
            </div>
        @endif
    </div>
@endsection
