@extends('layouts.app')

@section('title', 'Dashboard')

@section('content')
<div class="d-sm-flex align-items-center justify-content-between mb-4">
    <h1 class="h3 mb-0 text-gray-800"><i class="fas fa-tachometer-alt me-2"></i>Dashboard</h1>
    
</div>

@if (Auth::user())
<div class="alert alert-success">
    Welcome back, <strong>{{ Auth::user()->name }}</strong>! You are logged in as {{ Auth::user()->role === 'admin' ?
    'an Administrator' : 'a User' }}.
</div>
@endif

<div class="row row-cols-1 row-cols-md-2 row-cols-xl-3 g-4">
    @if(Auth::user()->isAdmin())
    <x-stat-card title="Total Users" value="{{ $totalUsers ?? 'N/A' }}" icon="fa-users" colorClass="text-primary"
        bgColorClass="bg-light-primary" link="{{ route('users.index') }}" />
    @endif

    <x-stat-card title="Total Projects" value="{{ $totalProjects ?? 'N/A' }}" icon="fa-project-diagram"
        colorClass="text-success" bgColorClass="bg-light-success" link="{{ route('projects.index') }}" />

    @if(Auth::user()->isAdmin())
    <x-stat-card title="Active Users" value="{{ $activeUsers ?? 'N/A' }}" icon="fa-user-check" colorClass="text-info"
        bgColorClass="bg-light-info" link="{{ route('users.index', ['status' => 'active']) }}" />
    @endif

    <x-stat-card title="Employee Directory" value="View All" icon="fa-user-tie" colorClass="text-warning"
        bgColorClass="bg-light-warning" link="{{ route('employees.index') }}" />

    <x-stat-card title="Analytics" value="View Reports" icon="fa-chart-line" colorClass="text-danger"
        bgColorClass="bg-light-danger" link="{{ route('analytics.index') }}" />
</div>

<div class="row mt-5">
    <div class="col-lg-12">
        <div class="accordion" id="systemOverviewAccordion">
            <div class="accordion-item shadow-sm">
                <h2 class="accordion-header" id="headingSystemOverview">
                    <button class="accordion-button collapsed" type="button" data-bs-toggle="collapse"
                        data-bs-target="#collapseSystemOverview" aria-expanded="false"
                        aria-controls="collapseSystemOverview">
                        <i class="fas fa-info-circle me-2"></i>
                        <span class="fw-bold text-primary">System Overview</span>
                    </button>
                </h2>
                <div id="collapseSystemOverview" class="accordion-collapse collapse"
                    aria-labelledby="headingSystemOverview" data-bs-parent="#systemOverviewAccordion">
                    <div class="accordion-body">
                        <p>This is your main dashboard. From here you can navigate to various sections of the
                            application using
                            the menu above.</p>
                        @if(Auth::user()->isAdmin())
                        <p>As an administrator, you have access to User Management features.</p>
                        @endif
                        <p>Key features include:</p>
                        <ul>
                            <li>Project Management: Create, view, edit, and delete projects.</li>
                            <li>Employee Directory: View employee details and their assigned projects.</li>
                            <li>Analytics: View various data reports and insights.</li>
                        </ul>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>

@endsection