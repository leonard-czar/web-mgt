@extends('layouts.app')

@section('title', 'Project: ' . $project->project_name)

@section('content')
<div class="d-flex justify-content-between align-items-center mb-3">
    <h1 class="h3 mb-0 text-gray-800"><i class="fas fa-binoculars me-2"></i>Project Details</h1>
    <div>
        <a href="{{ route('projects.edit', $project->id) }}" class="btn btn-warning btn-sm"><i
                class="fas fa-edit me-1"></i>Edit Project</a>
        <a href="{{ route('projects.index') }}" class="btn btn-secondary btn-sm"><i
                class="fas fa-arrow-left me-1"></i>Back to List</a>
    </div>
</div>

<div class="card shadow-sm">
    <div class="card-header bg-info text-white">
        <h5 class="mb-0">{{ $project->project_name }}</h5>
    </div>
    <div class="card-body">
        <div class="row">
            <div class="col-md-6 mb-3">
                <strong><i class="fas fa-id-badge me-2"></i>ID:</strong> {{ $project->id }}
            </div>
            <div class="col-md-6 mb-3">
                <strong><i class="fas fa-user-tie me-2"></i>Assigned Employee:</strong> {{ $project->employee->name ??
                'N/A' }}
            </div>
            <div class="col-md-6 mb-3">
                <strong><i class="far fa-building me-2"></i>Employee's Department:</strong> {{
                $project->employee->department->name ?? 'N/A' }}
            </div>
            <div class="col-md-12 mb-3">
                <strong><i class="fas fa-align-left me-2"></i>Description:</strong>
                <p class="mt-1 ms-1">{{ $project->description ?: 'No description provided.' }}</p>
            </div>
            <div class="col-md-12 mb-3">
                <strong><i class="fas fa-tasks me-2"></i>Task Details:</strong>
                <p class="mt-1 ms-1">{{ $project->task ?: 'No task details provided.' }}</p>
            </div>
            <div class="col-md-6 mb-3">
                <strong><i class="fas fa-calendar-plus me-2"></i>Created At:</strong> {{ $project->created_at->format('F
                d, Y h:i A') }}
            </div>
            <div class="col-md-6 mb-3">
                <strong><i class="fas fa-calendar-check me-2"></i>Last Updated:</strong> {{
                $project->updated_at->format('F d, Y h:i A') }}
            </div>
        </div>
    </div>
    <div class="card-footer">
        <form action="{{ route('projects.destroy', $project->id) }}" method="POST" class="d-inline float-end"
            onsubmit="return confirm('Are you sure you want to delete this project? This action cannot be undone.');">
            @csrf
            @method('DELETE')
            <button type="submit" class="btn btn-sm btn-danger"><i class="fas fa-trash-alt me-1"></i>Delete
                Project</button>
        </form>
    </div>
</div>
@endsection