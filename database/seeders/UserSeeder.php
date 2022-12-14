<?php

namespace Database\Seeders;

use App\Models\User;
use Illuminate\Database\Seeder;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;

class UserSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        User::create([
            'firstname' => 'Admin',
            'lastname'  => 'Mahmoud',
            'username'  => 'admin-mahmoud',
            'email'     => 'admin@task.com',
            'password'  => bcrypt('password'),
            'role_id'   => 1
        ]);

        User::create([
            'firstname' => 'Employee',
            'lastname'  => 'Mahmoud',
            'username'  => 'employee-mahmoud',
            'email'     => 'employee@task.com',
            'password'  => bcrypt('password'),
            'role_id'   => 2
        ]);

        User::factory(30)->create();
    }
}
