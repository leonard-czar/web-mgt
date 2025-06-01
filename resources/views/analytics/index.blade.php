@extends('layouts.app')

@section('title', 'Analytics Dashboard')

@section('content')
<div class="d-flex justify-content-between align-items-center mb-3">
    <h1 class="h3 mb-0 text-gray-800"><i class="fas fa-chart-pie me-2"></i>Analytics Dashboard</h1>
</div>

<!-- Employees with Department Names -->
<div class="card shadow-sm mb-4">
    <div class="card-header py-3">
        <h6 class="m-0 font-weight-bold text-primary"><i class="fas fa-users me-1"></i>Employees with Department Names
        </h6>
    </div>
    <div class="card-body">
        @if($employeesWithDepartments->isEmpty())
        <div class="alert alert-info text-center">No data available.</div>
        @else
        <div class="table-responsive">
            <table class="table table-bordered table-sm" width="100%" cellspacing="0">
                <thead class="table-light">
                    <tr>
                        <th>ID</th>
                        <th>Employee Name</th>
                        <th>Department Name</th>

                    </tr>
                </thead>
                <tbody>
                    @foreach ($employeesWithDepartments as $employee)
                    <tr>
                        <td>{{ $employee->id }}</td>
                        <td>{{ $employee->name }}</td>
                        <td>{{ $employee->department->name ?? 'N/A' }}</td>

                    </tr>
                    @endforeach
                </tbody>
            </table>
        </div>
        @endif
    </div>
</div>

<!-- Total Salary Expenditure per Department -->
<div class="card shadow-sm mb-4">
    <div class="card-header py-3">
        <h6 class="m-0 font-weight-bold text-success"><i class="fas fa-wallet me-1"></i>Salary Expenditure by Department
        </h6>
    </div>
    <div class="card-body">
        @if($salaryByDepartment->isEmpty())
        <div class="alert alert-info text-center">No data available.</div>
        @else
        <div class="table-responsive">
            <table class="table table-bordered table-sm" width="100%" cellspacing="0">
                <thead class="table-light">
                    <tr>
                        <th>Department Name</th>
                        <th>Total Expenditure</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach ($salaryByDepartment as $dept)
                    <tr>
                        <td>{{ $dept->name }}</td>
                        <td>${{ number_format($dept->total_salary, 2) }}</td>
                       
                    </tr>
                    @endforeach
                </tbody>
            </table>
        </div>
        @endif
    </div>
</div>

<!-- Employees Working on More Than One Project -->
<div class="card shadow-sm mb-4">
    <div class="card-header py-3">
        <h6 class="m-0 font-weight-bold text-info"><i class="fas fa-tasks-alt me-1"></i>Employees with Multiple Projects
        </h6>
    </div>
    <div class="card-body">
        @if($multiProjectEmployees->isEmpty())
        <div class="alert alert-info text-center">No employees found working on more than one project.</div>
        @else
        <div class="table-responsive">
            <table class="table table-bordered table-sm" width="100%" cellspacing="0">
                <thead class="table-light">
                    <tr>
                        <th>Employee Name</th>
                        <th>Department</th>
                        <th>Project Count</th>
                        <th>Projects</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach ($multiProjectEmployees as $employee)
                    <tr>
                        <td><a href="{{ route('employees.show', $employee->id) }}">{{ $employee->name }}</a></td>
                        <td>{{ $employee->department->name ?? 'N/A' }}</td>
                        <td>{{ $employee->project_count }}</td>
                        <td>
                            @foreach($employee->projects as $project)
                            <a href="{{ route('projects.show', $project->id) }}"
                                class="badge bg-secondary text-decoration-none me-1">{{ $project->project_name }}</a>
                            @endforeach
                        </td>
                    </tr>
                    @endforeach
                </tbody>
            </table>
        </div>
        @endif
    </div>
</div>
@endsection