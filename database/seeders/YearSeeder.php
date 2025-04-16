<?php

namespace Database\Seeders;

use App\Models\Api\Main\Year;
use App\Models\Api\Core\Department;
use Illuminate\Database\Seeder;

class YearSeeder extends Seeder
{
    public function run()
    {
        $department = Department::first();

        $years = [
            ['year' => 1, 'name' => '1 License'],
            ['year' => 2, 'name' => '2 License Computer Science'],
            ['year' => 2, 'name' => '2 License Math'],
            ['year' => 3, 'name' => '3 License SI'],
            ['year' => 3, 'name' => '3 License ISIL'],
            ['year' => 1, 'name' => '1 Master AD'],
            ['year' => 1, 'name' => '1 Master IA'],
            ['year' => 2, 'name' => '2 Master AD'],
            ['year' => 2, 'name' => '2 Master IA'],
        ];

        foreach ($years as $year) {
            Year::create([
                'year' => $year['year'],
                'name' => $year['name'],
                'department_id' => $department->id,
            ]);
        }
    }
}
