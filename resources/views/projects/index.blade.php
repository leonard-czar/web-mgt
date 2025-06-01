@extends('layouts.app')

@section('title', 'Projects')

@section('content')
<div class="d-flex justify-content-between align-items-center mb-3">
    <h1 class="h3 mb-0 text-gray-800"><i class="fas fa-project-diagram me-2"></i>Projects</h1>
    <a href="{{ route('projects.create') }}" class="btn btn-primary btn-sm"><i class="fas fa-plus me-1"></i>Create New
        Project</a>
</div>

<div class="card shadow-sm">
    <div class="card-header py-3 d-flex flex-row align-items-center justify-content-between">
        <h6 class="m-0 font-weight-bold text-primary"><i class="fas fa-list me-1"></i>Project List</h6>
    </div>
    <div class="card-body">
        @if($projects->isEmpty())
        <div class="alert alert-info text-center">
            <i class="fas fa-info-circle me-2"></i>No projects found. <a href="{{ route('projects.create') }}">Create
                one now!</a>
        </div>
        @else
        <div class="table-responsive">
            <table class="table table-bordered table-hover" width="100%" cellspacing="0">
                <thead class="table-light">
                    <tr>
                        <th>ID</th>
                        <th>Project Name</th>
                        <th>Assigned Employee</th>
                        <th>Department</th>
                        <th>Created At</th>
                        <th>Actions</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach ($projects as $project)
                    <tr>
                        <td>{{ $project->id }}</td>
                        <td>{{ $project->project_name }}</td>
                        <td>{{ $project->employee->name ?? 'N/A' }}</td>
                        <td>{{ $project->employee->department->name ?? 'N/A' }}</td>
                        <td>{{ $project->created_at->format('M d, Y') }}</td>
                        <td>
                            <a href="{{ route('projects.show', $project->id) }}" class="btn btn-sm btn-info"
                                title="View"><i class="fas fa-eye"></i></a>
                            <a href="{{ route('projects.edit', $project->id) }}" class="btn btn-sm btn-warning"
                                title="Edit"><i class="fas fa-edit"></i></a>
                            <form action="{{ route('projects.destroy', $project->id) }}" method="POST" class="d-inline"
                                onsubmit="return confirm('Are you sure you want to delete this project? This action cannot be undone.');">
                                @csrf
                                @method('DELETE')
                                <button type="submit" class="btn btn-sm btn-danger" title="Delete"><i
                                        class="fas fa-trash-alt"></i></button>
                            </form>
                        </td>
                    </tr>
                    @endforeach
                </tbody>
            </table>
        </div>
        <div class="mt-3 d-flex justify-content-center">
            {{ $projects->links() }}
        </div>
        @endif
    </div>
</div>
@endsection