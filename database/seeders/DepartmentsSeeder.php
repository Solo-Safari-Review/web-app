<?php

namespace Database\Seeders;

use App\Models\Department;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class DepartmentsSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $departments = ['Admin Review', 'Sales', 'Marketing', 'HR', 'IT', 'Finance'];

        foreach ($departments as $department) {
            Department::create(['name' => $department]);
        }
    }
}
