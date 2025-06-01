<?php

namespace App\Http\Controllers;

use App\Models\Department;
use App\Models\Employee;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class AnalyticsController extends Controller
{
    //
    public function index(Employee $Employee, Department $Department)
    {
        //  Employees with their department names
        $employeesWithDepartments = $Employee->with('department')
            ->orderBy('name')
            ->get();

        //  Total salary expenditure per department
        $salaryByDepartment = $Department->select([
            'departments.id',
            'departments.name',
            DB::raw('SUM(employees.salary) as total_salary'),
            DB::raw('COUNT(employees.id) as employee_count'),
        ])
            ->join('employees', 'departments.id', '=', 'employees.department_id')
            ->groupBy('departments.id', 'departments.name')
            ->orderByDesc('total_salary')
            ->get();

        // Employees working on more than one project
        $multiProjectEmployees = $Employee->select([
            'employees.*',
            DB::raw('COUNT(projects.id) as project_count')
        ])
            ->with(['department', 'projects'])
            ->join('projects', 'employees.id', '=', 'projects.employee_id')
            ->groupBy('employees.id', 'employees.name', 'employees.department_id', 'employees.salary', 'employees.created_at', 'employees.updated_at')
            ->havingRaw('COUNT(projects.id) > 1')
            ->orderByDesc('project_count')
            ->get();

        return view('analytics.index', compact(
            'employeesWithDepartments',
            'salaryByDepartment',
            'multiProjectEmployees'
        ));
    }
}
