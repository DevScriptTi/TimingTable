<?php

namespace Database\Seeders;

use App\Models\Api\Users\Admin;
use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    public function run()
    {
        $admin = Admin::create([
            'username' => 'dev_script_FD',
            'name' => 'Dev',
            'last' => 'Script',
            'is_super' => true,
        ]);
        $key = $admin->key()->create(
            [
                'value' => str()->random(10),
            ]
        );
        $key->user()->create(
            [
                'email' => 'Dev@gmail.com',
                'password' => 'password',
            ]
        );
        $this->call([
            Wilayas::class,
            DepartmentSeeder::class,
        ]);
    }
}
