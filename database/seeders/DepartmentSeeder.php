<?php

namespace Database\Seeders;

use App\Models\Department;
use Illuminate\Database\Seeder;

class DepartmentSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $departments = [
            ['name' => 'ICT'],
            ['name' => 'Finance'],
            ['name' => 'Consultation'],
            ['name' => 'HealthCare'],
        ];

        foreach ($departments as $department) {
            Department::create($department);    
        }

    }
}
