<?php

namespace Database\Seeders;

use App\Models\User;
use Illuminate\Database\Seeder;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;

class CreateUsersSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $users = [
            [
                'name' => 'Admin',
                'username' => 'Admin Dkm',
                'email' => 'admin@admin.com',
                'password' => bcrypt('password'),
                'role' => 0,
            ],
            [
                'name' => 'Pengurus',
                'username' => 'Pengurus Dkm',
                'email' => 'pengurus@pengurus.com',
                'password' => bcrypt('password'),
                'role' => 1,
            ],
        ];

        foreach ($users as $key => $user) {
            User::create($user);
        }
    }
}
