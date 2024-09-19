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

        User::truncate();


        User::create([
            'name' => 'Mehedi Hasan',
            'email' => 'mehedi@gmail.com',
            'password' => Hash::make('123456'),
        ]);


        User::create([
            'name' => 'Mamun',
            'email' => 'mamun@gmail.com',
            'password' => Hash::make('123456'),
        ]);


        User::create([
            'name' => 'Shihab',
            'email' => 'shihab@gmail.com',
            'password' => Hash::make('123456'),
        ]);
    }
}
