@extends('layouts.admin')

@section('title', 'Users - Future Taikun')

@section('content')
    <div class="container mt-4">
        <!-- Filter Form -->
        <form method="GET" action="{{ route('admin.users') }}" class="mb-4">
            <div class="row g-3">
                <div class="col-md-3">
                    <div class="form-floating">
                        <input type="text" class="form-control" name="name" id="name" value="{{ $filters['name'] }}"
                            placeholder="Name">
                        <label for="name">Name</label>
                    </div>
                </div>
                <div class="col-md-3">
                    <div class="form-floating">
                        <input type="email" class="form-control" name="email" id="email"
                            value="{{ $filters['email'] }}" placeholder="Email">
                        <label for="email">Email</label>
                    </div>
                </div>
                <div class="col-md-3">
                    <div class="form-floating">
                        <select class="form-select" name="role" id="role">
                            <option value="">All Roles</option>
                            <option value="entrepreneur" {{ $filters['role'] === 'entrepreneur' ? 'selected' : '' }}>
                                Entrepreneur</option>
                            <option value="investor" {{ $filters['role'] === 'investor' ? 'selected' : '' }}>Investor
                            </option>
                            <option value="admin" {{ $filters['role'] === 'admin' ? 'selected' : '' }}>Admin</option>
                            <option value="null" {{ $filters['role'] === 'null' ? 'selected' : '' }}>No Role</option>
                        </select>
                        <label for="role">Role</label>
                    </div>
                </div>
                <div class="col-md-2 d-flex align-items-center">
                    <button type="submit" class="btn btn-primary w-100 form-control py-2">Filter</button>
                </div>
            </div>
        </form>

        <!-- Users Table -->
        <div class="table-responsive">
            <table class="table table-striped table-bordered">
                <thead>
                    <tr>
                        <th>ID</th>
                        <th>Name</th>
                        <th>Email</th>
                        <th>Role</th>
                        <th>Verified</th>
                    </tr>
                </thead>
                <tbody>
                    @forelse ($users as $user)
                        <tr>
                            <td>{{ $user->id }}</td>
                            <td>{{ $user->name ?? 'N/A' }}</td>
                            <td>{{ $user->email }}</td>
                            <td>{{ $user->role ?? 'No Role' }}</td>
                            <td>{{ $user->is_verified ? 'Yes' : 'No' }}</td>
                        </tr>
                    @empty
                        <tr>
                            <td colspan="5" class="text-center">No users found.</td>
                        </tr>
                    @endforelse
                </tbody>
            </table>
        </div>

        <!-- Pagination -->
        <div class="mt-4">
            {{ $users->links('pagination::bootstrap-5') }}
        </div>

    </div>

@endsection
