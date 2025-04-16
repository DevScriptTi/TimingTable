<?php

namespace Database\Seeders;

use App\Models\Api\Core\Department;
use Illuminate\Database\Seeder;

class DepartmentSeeder extends Seeder
{
    public function run()
    {
        Department::create([
            'name' => 'Math and Computer Science',
        ]);
    }
}
