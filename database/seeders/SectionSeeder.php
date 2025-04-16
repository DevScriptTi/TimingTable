<?php

namespace Database\Seeders;

use App\Models\Api\Main\Year;
use App\Models\Api\Main\Section;
use Illuminate\Database\Seeder;

class SectionSeeder extends Seeder
{
    public function run()
    {
        $years = Year::all();

        foreach ($years as $year) {
            $sectionCount = rand(1, 3); // 1 to 3 sections per year
            for ($i = 1; $i <= $sectionCount; $i++) {
                Section::create([
                    'number' => $i,
                    'year_id' => $year->id,
                ]);
            }
        }
    }
}
