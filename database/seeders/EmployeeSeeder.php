<?php

namespace Database\Seeders;

use App\Models\Employee;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class EmployeeSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run()
    {
        $employees = [
            ['id' => 1, 'name' => 'Alice Johnson', 'department_id' => 1, 'salary' => 60000.00],
            ['id' => 2, 'name' => 'Bob Smith', 'department_id' => 2, 'salary' => 75000.00],
            ['id' => 3, 'name' => 'Charlie Daniels', 'department_id' => 2, 'salary' => 80000.00],
            ['id' => 4, 'name' => 'Diana Ross', 'department_id' => 3, 'salary' => 50000.00],
            ['id' => 5, 'name' => 'Ethan Ray', 'department_id' => 1, 'salary' => 62000.00],
            ['id' => 6, 'name' => 'Fiona Lee', 'department_id' => 3, 'salary' => 55000.00],
        ];

        foreach ($employees as $employee) {
            Employee::create($employee);
        }
    }
}
