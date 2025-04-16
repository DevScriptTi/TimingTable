<?php

namespace Database\Seeders;

use App\Models\Api\Users\Student;
use App\Models\Api\Main\Group;
use App\Models\Api\Core\Baladiya;
use Illuminate\Database\Seeder;

class StudentSeeder extends Seeder
{
    protected $algerianFirstNames = [
        'Mohamed', 'Ahmed', 'Ali', 'Youssef', 'Omar', 'Ibrahim', 'Abdallah', 'Abdellah', 'Abdelkader',
        'Fatima', 'Amina', 'Khadija', 'Zahra', 'Houda', 'Samira', 'Yasmina', 'Nadia', 'Soraya'
    ];

    protected $algerianLastNames = [
        'Bouaziz', 'Benali', 'Cherif', 'Dahmani', 'Farsi', 'Gacem', 'Haddad', 'Kadri', 'Lamari',
        'Mansouri', 'Naceri', 'Ouahab', 'Rahal', 'Saadi', 'Taleb', 'Zitouni'
    ];

    public function run()
    {
        $baladiya = Baladiya::firstOrCreate(['name' => 'Algiers']);

        $groups = Group::all();

        foreach ($groups as $group) {
            $studentCount = rand(10, 20); // 10 to 20 students per group
            for ($i = 1; $i <= $studentCount; $i++) {
                $firstName = $this->algerianFirstNames[array_rand($this->algerianFirstNames)];
                $lastName = $this->algerianLastNames[array_rand($this->algerianLastNames)];
                $username = strtolower($firstName[0] .'_'. $lastName .'_'. str()->random(5));

                Student::create([
                    'username' => $username,
                    'name' => $firstName,
                    'last' => $lastName,
                    'date_of_birth' => $this->randomDate('1995-01-01', '2005-12-31'),
                    'inscreption_number' => 'INS-' . rand(1000, 9999) . '-' . date('Y'),
                    'baladiyas_id' => $baladiya->id,
                    'group_id' => $group->id,
                ]);
            }
        }
    }

    protected function randomDate($startDate, $endDate)
    {
        $min = strtotime($startDate);
        $max = strtotime($endDate);
        $val = rand($min, $max);
        return date('Y-m-d', $val);
    }
}
