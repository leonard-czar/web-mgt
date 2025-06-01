@extends('layouts.app')

@section('title', 'Employee: ' . $employee->name)

@section('content')
<div class="d-flex justify-content-between align-items-center mb-3">
    <h1 class="h3 mb-0 text-gray-800"><i class="fas fa-id-card-alt me-2"></i>Employee Details</h1>
    <a href="{{ route('employees.index') }}" class="btn btn-secondary btn-sm"><i class="fas fa-arrow-left me-1"></i>Back
        to Directory</a>
</div>

<div class="card shadow-sm mb-4">
    <div class="card-header bg-info text-white">
        <h5 class="mb-0">{{ $employee->name }}</h5>
    </div>
    <div class="card-body">
        <div class="row">
            <div class="col-md-6 mb-3">
                <strong><i class="fas fa-id-badge me-2"></i>ID:</strong> {{ $employee->id }}
            </div>
            <div class="col-md-6 mb-3">
                <strong><i class="far fa-building me-2"></i>Department:</strong> {{ $employee->department->name ?? 'N/A'
                }}
            </div>
            <div class="col-md-6 mb-3">
                <strong><i class="fas fa-dollar-sign me-2"></i>Salary:</strong> ${{ number_format($employee->salary, 2)
                }}
            </div>
            <div class="col-md-6 mb-3">
                <strong><i class="fas fa-briefcase me-2"></i>Projects Count:</strong> {{ $employee->projects->count() }}
            </div>
            <div class="col-md-6 mb-3">
                <strong><i class="fas fa-calendar-plus me-2"></i>Create Date:</strong> {{
                $employee->created_at->format('F d, Y') }}
            </div>
        </div>
    </div>
</div>

<div class="card shadow-sm">
    <div class="card-header bg-light">
        <h5 class="mb-0"><i class="fas fa-project-diagram me-2"></i>Assigned Projects</h5>
    </div>
    <div class="card-body">
        @if($employee->projects->isEmpty())
        <p class="text-muted">This employee is not currently assigned to any project.</p>
        @else
        <ul class="list-group list-group-flush">
            @foreach($employee->projects as $project)
            <li class="list-group-item d-flex justify-content-between align-items-center">
                {{ $project->project_name }}
                <a href="{{ route('projects.show', $project->id) }}" class="btn btn-outline-primary btn-sm"><i
                        class="fas fa-eye me-1"></i>View Project</a>
            </li>
            @endforeach
        </ul>
        @endif
    </div>
</div>
@endsection