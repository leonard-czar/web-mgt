@extends('layouts.app')

@section('title', 'Welcome to Our Portal')

@section('content')
<div class="container py-5">
    <div class="row justify-content-center">
        <div class="col-lg-8 text-center">
            <i class="fas fa-cogs fa-4x text-primary mb-4"></i>
            <h1 class="display-4 fw-bold mb-3">Welcome to the {{ config('app.name', 'Web Portal') }}</h1>
            <p class="lead text-muted mb-4">
                Manage your projects, employees, and gain insights through powerful analytics.
                Our Web portal offers a full set of tools to help make your work easier and more organized.
            </p>

            @guest
            <div class="d-grid gap-2 d-sm-flex justify-content-sm-center">
                <a href="{{ route('login') }}" class="btn btn-primary btn-lg px-4 gap-3"><i
                        class="fas fa-sign-in-alt me-2"></i>Login</a>
                <a href="{{ route('register') }}" class="btn btn-outline-secondary btn-lg px-4"><i
                        class="fas fa-user-plus me-2"></i>Register</a>
            </div>
            @else
            <p class="lead">You are already logged in. Go to your dashboard to get started.</p>
            <a href="{{ route('dashboard') }}" class="btn btn-success btn-lg px-4"><i
                    class="fas fa-tachometer-alt me-2"></i>Go to Dashboard</a>
            @endguest
        </div>
    </div>

    <hr class="my-5">

    <div class="row g-4">
        <div class="col-md-4">
            <div class="card h-100 shadow-sm">
                <div class="card-body text-center">
                    <div
                        class="feature-icon-small d-inline-flex align-items-center justify-content-center text-primary bg-light-primary fs-4 rounded-3 mb-3 p-3">
                        <i class="fas fa-project-diagram"></i>
                    </div>
                    <h5 class="card-title">Project Management</h5>
                    <p class="card-text">Easily track and manage all your projects in one place.</p>
                </div>
            </div>
        </div>
        <div class="col-md-4">
            <div class="card h-100 shadow-sm">
                <div class="card-body text-center">
                    <div
                        class="feature-icon-small d-inline-flex align-items-center justify-content-center text-success bg-light-success fs-4 rounded-3 mb-3 p-3">
                        <i class="fas fa-users"></i>
                    </div>
                    <h5 class="card-title">Employee Directory</h5>
                    <p class="card-text">Access employee information and see the projects they're working on.</p>
                </div>
            </div>
        </div>
        <div class="col-md-4">
            <div class="card h-100 shadow-sm">
                <div class="card-body text-center">
                    <div
                        class="feature-icon-small d-inline-flex align-items-center justify-content-center text-info bg-light-info fs-4 rounded-3 mb-3 p-3">
                        <i class="fas fa-chart-line"></i>
                    </div>
                    <h5 class="card-title">Data Analytics</h5>
                    <p class="card-text">Use data analytics to gain insights and make better decisions.</p>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection

@push('styles')
<style>
    .bg-light-primary {
        background-color: rgba(var(--bs-primary-rgb), 0.1) !important;
    }

    .bg-light-success {
        background-color: rgba(var(--bs-success-rgb), 0.1) !important;
    }

    .bg-light-info {
        background-color: rgba(var(--bs-info-rgb), 0.1) !important;
    }

    .bg-light-danger {
        background-color: rgba(var(--bs-danger-rgb), 0.1) !important;
    }

    .bg-light-warning {
        background-color: rgba(var(--bs-warning-rgb), 0.1) !important;
    }
</style>
@endpush