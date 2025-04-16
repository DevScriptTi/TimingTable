<?php

namespace Database\Seeders;

use App\Models\Api\Users\Admin;
use Illuminate\Database\Seeder;

class AdminSeeder extends Seeder
{
    public function run()
    {
        Admin::create([
            'username' => 'Salim_Raber_367254',
            'is_super' => true,
        ]);

        Admin::create([
            'username' => 'Rami_Djalali_483795',
            'is_super' => false,
        ]);

        Admin::create([
            'username' => 'Khalida_Ben_Abdelkader_834975',
            'is_super' => false,
        ]);
    }
}

