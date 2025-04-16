<?php

namespace Database\Seeders;

use App\Models\Api\Main\Section;
use App\Models\Api\Main\Group;
use Illuminate\Database\Seeder;

class GroupSeeder extends Seeder
{
    public function run()
    {
        $sections = Section::all();

        foreach ($sections as $section) {
            $groupCount = rand(3, 10); // 3 to 10 groups per section
            for ($i = 1; $i <= $groupCount; $i++) {
                Group::create([
                    'number' => $i,
                    'section_id' => $section->id,
                ]);
            }
        }
    }
}
