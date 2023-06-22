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
                'jenis_kelamin' => 'Laki-laki',
                'no_hp' => '082123123',
                'alamat' => 'Karangampel Kidul',
                'role' => 0,
                'password' => bcrypt('password'),
            ],
            [
                'name' => 'Pengurus',
                'username' => 'Pengurus Dkm',
                'email' => 'pengurus@pengurus.com',
                'jenis_kelamin' => 'Laki-laki',
                'no_hp' => '082125533',
                'alamat' => 'Karangampel',
                'role' => 1,
                'password' => bcrypt('password'),
            ],
        ];

        foreach ($users as $key => $user) {
            User::create($user);
        }
    }
}
