@extends('layouts.app')

@section('title', 'Create New Project')

@section('content')
<div class="d-flex justify-content-between align-items-center mb-3">
    <h1 class="h3 mb-0 text-gray-800"><i class="fas fa-folder-plus me-2"></i>Create New Project</h1>
    <a href="{{ route('projects.index') }}" class="btn btn-secondary btn-sm"><i class="fas fa-arrow-left me-1"></i>Back
        to List</a>
</div>

<div class="card shadow-sm">
    <div class="card-header bg-primary text-white">
        <h5 class="mb-0">Project Details</h5>
    </div>
    <div class="card-body p-4">
        <form method="POST" action="{{ route('projects.store') }}">
            @csrf

            <div class="mb-3">
                <label for="project_name" class="form-label">Project Name <span class="text-danger">*</span></label>
                <input type="text" class="form-control @error('project_name') is-invalid @enderror" id="project_name"
                    name="project_name" value="{{ old('project_name') }}" required>
                @error('project_name')
                <span class="invalid-feedback" role="alert"><strong>{{ $message }}</strong></span>
                @enderror
            </div>

            <div class="mb-3">
                <label for="description" class="form-label">Description</label>
                <textarea class="form-control @error('description') is-invalid @enderror" id="description"
                    name="description" rows="3">{{ old('description') }}</textarea>
                @error('description')
                <span class="invalid-feedback" role="alert"><strong>{{ $message }}</strong></span>
                @enderror
            </div>

            <div class="mb-3">
                <label for="employee_id" class="form-label">Assign to Employee <span
                        class="text-danger">*</span></label>
                <select class="form-select @error('employee_id') is-invalid @enderror" id="employee_id"
                    name="employee_id" required>
                    <option value="">Select an Employee</option>
                    @foreach ($employees as $employee)
                    <option value="{{ $employee->id }}" {{ old('employee_id')==$employee->id ? 'selected' : '' }}>
                        {{ $employee->name }} ({{ $employee->department->name ?? 'No Department' }})
                    </option>
                    @endforeach
                </select>
                @error('employee_id')
                <span class="invalid-feedback" role="alert"><strong>{{ $message }}</strong></span>
                @enderror
            </div>

            <div class="mb-3">
                <label for="task" class="form-label">Task Details</label>
                <textarea class="form-control @error('task') is-invalid @enderror" id="task" name="task"
                    rows="2">{{ old('task') }}</textarea>
                @error('task')
                <span class="invalid-feedback" role="alert"><strong>{{ $message }}</strong></span>
                @enderror
            </div>

            <div class="d-flex justify-content-end">
                <a href="{{ route('projects.index') }}" class="btn btn-outline-secondary me-2"><i
                        class="fas fa-times me-1"></i>Cancel</a>
                <button type="submit" class="btn btn-primary"><i class="fas fa-save me-1"></i>Create Project</button>
            </div>
        </form>
    </div>
</div>
@endsection