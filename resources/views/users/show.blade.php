@extends('layouts.app')

@section('title', 'User Details: ' . $user->name)

@section('content')
<div class="d-flex justify-content-between align-items-center mb-3">
    <h1 class="h3 mb-0 text-gray-800"><i class="fas fa-user-tag me-2"></i>User Details</h1>
    <div>
        <a href="{{ route('users.edit', $user->id) }}" class="btn btn-warning btn-sm"><i
                class="fas fa-edit me-1"></i>Edit User</a>
        <a href="{{ route('users.index') }}" class="btn btn-secondary btn-sm"><i class="fas fa-arrow-left me-1"></i>Back
            to List</a>
    </div>
</div>

<div class="card shadow-sm">
    <div class="card-header bg-primary text-white">
        <h5 class="mb-0">{{ $user->name }}</h5>
    </div>
    <div class="card-body">
        <div class="row">
            <div class="col-md-6 mb-3">
                <strong><i class="fas fa-id-card me-2"></i>ID:</strong> {{ $user->id }}
            </div>
            <div class="col-md-6 mb-3">
                <strong><i class="fas fa-envelope me-2"></i>Email:</strong> {{ $user->email }}
            </div>
            <div class="col-md-6 mb-3">
                <strong><i class="fas fa-user-shield me-2"></i>Role:</strong> <span
                    class="badge bg-{{ $user->role === 'admin' ? 'danger' : 'info' }}">{{ ucfirst($user->role) }}</span>
            </div>
            <div class="col-md-6 mb-3">
                <strong><i class="fas fa-check-circle me-2"></i>Status:</strong>
                <span class="badge bg-{{ $user->is_active ? 'success' : 'secondary' }}">
                    {{ $user->is_active ? 'Active' : 'Inactive' }}
                </span>
            </div>
            <div class="col-md-6 mb-3">
                <strong><i class="fas fa-calendar-plus me-2"></i>Joined:</strong> {{ $user->created_at->format('F d, Y
                h:i A') }}
            </div>
            <div class="col-md-6 mb-3">
                <strong><i class="fas fa-calendar-check me-2"></i>Last Updated:</strong> {{ $user->updated_at->format('F
                d, Y h:i A') }}
            </div>
            @if($user->email_verified_at)
            <div class="col-md-6 mb-3">
                <strong><i class="fas fa-user-check me-2"></i>Email Verified:</strong> {{
                $user->email_verified_at->format('F d, Y h:i A') }}
            </div>
            @endif
        </div>
    </div>
</div>
@endsection