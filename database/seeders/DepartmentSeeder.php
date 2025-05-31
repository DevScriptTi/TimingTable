<?php

namespace Database\Seeders;

use App\Models\Api\Core\Baladiya;
use App\Models\Api\Core\Department;
use App\Models\Api\Core\Module;
use App\Models\Api\Main\Group;
use App\Models\Api\Main\Section;
use App\Models\Api\Main\Year;
use App\Models\Api\Users\Teacher;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Log;

class DepartmentSeeder extends Seeder
{
    public $departments = [
        'Computer Science',
    ];

    public $names = [
        'Karim',
        'Amina',
        'Youcef',
        'Fatima',
        'Mohamed',
        'Meriem',
        'Ahmed',
        'Leila',
        'Sofiane',
        'Samira',
        'Amine',
        'Nadia',
        'Rachid',
        'Houria',
        'Said',
        'Lamia',
        'Farid',
        'Dalila',
        'Omar',
        'Naima',
        'Hamid',
        'Malika',
        'Tarik',
        'Karima',
        'Lotfi',
        'Yasmine',
        'Mourad',
        'Sabrina',
        'Kamel',
        'Asma'
    ];

    public $lastNames = [
        'Benali',
        'Bouaziz',
        'Chaouche',
        'Djaballah',
        'Ferhat',
        'Guellati',
        'Hadj',
        'Khelifi',
        'Mansouri',
        'Nasri',
        'Ouadah',
        'Rahmani',
        'Saadi',
        'Taibi',
        'Ziani',
        'Benchaabane',
        'Djebbar',
        'Hamidi',
        'Khaldi',
        'Mebarki',
        'Oussedik',
        'Rabhi',
        'Slimani',
        'Yahiaoui',
        'Zerrouki',
        'Boudiaf',
        'Chentouf',
        'Hamdani',
        'Messaoud',
        'Zitouni'
    ];

    public $modules = [
        'Programming Fundamentals',
        'Data Structures',
        'Database Systems',
        'Operating Systems',
        'Computer Networks',
        'Software Engineering',
        'Web Development',
        'Artificial Intelligence',
        'Computer Architecture',
        'Calculus I',
        'Linear Algebra',
        'Differential Equations',
    ];


    public function run()
    {


        foreach ($this->modules as $module) {
            Module::create([
                'name' => $module
            ]);
        }
        foreach ($this->departments as $department) {
            Department::create([
                'name' => $department
            ]);
        }

        $baladiyas = Baladiya::all();
        $department = Department::all();
        for ($i = 1; $i <= 30; $i++) {
            $name = $this->names[array_rand($this->names)];
            $last = $this->lastNames[array_rand($this->lastNames)];
            Teacher::create([
                'username' => $name . '_' . $last . '_' . str()->random(4),
                'name' => $name,
                'last' => $last,
                'date_of_birth' => now()->subYears(rand(18, 25))->subDays(rand(1, 365)),
                'baladiya_id' => $baladiyas->random()->id
            ]);
        }
        foreach ($department as $d) {
            $rand = rand(12, 24);
            for ($i = 1; $i <= $rand; $i++) {
                $d->classRomes()->create([
                    'number' => $i
                ]);
            }
            for ($i = 1; $i <= 5; $i++) {
                $d->years()->create([
                    'name' => 'Year ' . $i
                ]);
            }
            $year = Year::where('department_id', $d->id)->get();
            foreach ($year as $y) {
                for ($i = 1; $i <= rand(1, 3); $i++) {
                    $y->sections()->create([
                        'number' => $i
                    ]);
                }
                $section = Section::where('year_id', $y->id)->get();
                foreach ($section as $s) {
                    for ($i = 1; $i <= rand(5, 11); $i++) {
                        $s->groups()->create([
                            'number' => $i,
                        ]);
                    }
                    $group = Group::where('section_id', $s->id)->get();
                    foreach ($group as $g) {
                        $rand = rand(10, 20);
                        for ($i = 1; $i <= $rand; $i++) {        
                            $name = $this->names[array_rand($this->names)];
                            $last = $this->lastNames[array_rand($this->lastNames)];
                            try {
                                $student = $g->students()->create([
                                    'username' => $name . '_' . $last . '_' . str()->random(4),
                                    'name' => $name,
                                    'last' => $last,
                                    'date_of_birth' => now()->subYears(rand(18, 25))->subDays(rand(1, 365)),
                                    'inscreption_number' => rand(1000000000, 9999999999),
                                    'baladiyas_id' => $baladiyas->random()->id
                                ]);
                                $student->key()->create([
                                    'value' => str()->random(10),
                                ]);
                            } catch (\Exception $e) {
                                // Log the error instead of dd() which stops execution
                                Log::error("Error creating student: " . $e->getMessage());
                                continue; // Skip this iteration and continue with the next student
                            }
                        }
                        $timing = $g->timeTable()->create();
                        $timing->days()->create([
                            'name' => 'mon',
                        ]);
                        $timing->days()->create([
                            'name' => 'tue',
                        ]);
                        $timing->days()->create([
                            'name' => 'wed',
                        ]);
                        $timing->days()->create([
                            'name' => 'thu',
                        ]);
                        $timing->days()->create([
                            'name' => 'fri',
                        ]);
                        $timing->days()->create([
                            'name' => 'sat',
                        ]);
                        $timing->days()->create([
                            'name' => 'sun',
                        ]);
                    }
                    $timing = $s->timeTable()->create();
                    $timing->days()->create([
                        'name' => 'mon',
                    ]);
                    $timing->days()->create([
                        'name' => 'tue',
                    ]);
                    $timing->days()->create([
                        'name' => 'wed',
                    ]);
                    $timing->days()->create([
                        'name' => 'thu',
                    ]);
                    $timing->days()->create([
                        'name' => 'fri',
                    ]);
                    $timing->days()->create([
                        'name' => 'sat',
                    ]);
                    $timing->days()->create([
                        'name' => 'sun',
                    ]);
                }
            }
        }
    }
}
