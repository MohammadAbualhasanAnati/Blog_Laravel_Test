<?php

namespace Database\Seeders;

use Illuminate\Support\Facades\Hash;
use Illuminate\Database\Seeder;
use \App\Models\User;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     *
     * @return void
     */
    public function run()
    {
        // \App\Models\User::factory(10)->create();
        User::create([
            'first_name'=> 'Admin',
            'last_name'=> 'Test',
            'username' => 'admin',
            'email' => 'admin@blog.test',
            'password' => Hash::make('admin'),
            'role' => 'admin',
        ]);

        User::create([
            'first_name'=> 'Writer',
            'last_name'=> 'Test',
            'username' => 'writer',
            'email' => 'writer@blog.test',
            'password' => Hash::make('writer'),
            'role' => 'writer',
        ]);
    }
}
