<?php

namespace Database\Seeders;

use App\Models\Api\Users\Admin;
use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    public function run()
    {
        $admin = Admin::create([
            'username' => 'Admin_47856',
            'name' => 'Admin',
            'last' => 'Admin',
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
