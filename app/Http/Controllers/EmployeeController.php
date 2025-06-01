<?php

namespace App\Http\Controllers;

use App\Models\Employee;
use Illuminate\Http\Request;

class EmployeeController extends Controller
{
    //
    public function index(Employee $employee)
    {
        $employees = $employee->with(['department', 'projects'])->get();
        // $employees = $employees->with(['department', 'projects'])->get();
        
        return view('employees.index', compact('employees'));
    }

    public function show(Employee $employee)
    {
        $employee->load(['department', 'projects']);
        
        return view('employees.show', compact('employee'));
    }
}
