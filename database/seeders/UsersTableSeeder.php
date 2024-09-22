<?php

namespace Database\Seeders;

use App\Models\User;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Hash;

class UsersTableSeeder extends Seeder
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
                'name' => 'Mehedi Hasan',
                'email' => 'mehedi@gmail.com',
                'password' => Hash::make('123456'),
            ],
            [
                'name' => 'Mamun',
                'email' => 'mamun@gmail.com',
                'password' => Hash::make('123456'),
            ],
            [
                'name' => 'Shihab',
                'email' => 'shihab@gmail.com',
                'password' => Hash::make('123456'),
            ],
            // Add more users as needed
        ];

        foreach ($users as $user) {
            User::create($user);
        }
    }
}
