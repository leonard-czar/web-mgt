<?php

namespace Database\Seeders;

use App\Models\Department;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class DepartmentSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run()
    {
        $departments = [
            ['id' => 1, 'name' => 'Legal'],
            ['id' => 2, 'name' => 'IT'],
            ['id' => 3, 'name' => 'Finance'],
        ];

        foreach ($departments as $department) {
            Department::create($department);
        }
    }
}
