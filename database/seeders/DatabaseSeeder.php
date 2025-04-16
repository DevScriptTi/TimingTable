<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    public function run()
    {
        $this->call([
            AdminSeeder::class,
            DepartmentSeeder::class,
            YearSeeder::class,
            SectionSeeder::class,
            GroupSeeder::class,
            StudentSeeder::class,
        ]);
    }
}
