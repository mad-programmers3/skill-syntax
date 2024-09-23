<?php

namespace Database\Seeders;

use App\Models\Role;
use App\Models\User;
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
        $adminRoleID = Role::where('name', 'admin')->value('id');
        $vendorRoleID = Role::where('name', 'vendor')->value('id');
        $customerRoleID = Role::where('name', 'customer')->value('id');

        $users = [
            [
                'role_id' => $adminRoleID,
                'name' => 'Mehedi Hasan',
                'email' => 'mehedi@gmail.com',
                'password' => Hash::make('123456'),
            ],
            [
                'role_id' => $adminRoleID,
                'name' => 'Mamun',
                'email' => 'mamun@gmail.com',
                'password' => Hash::make('123456'),
            ],
            [
                'role_id' => $adminRoleID,
                'name' => 'Shihab',
                'email' => 'shihab@gmail.com',
                'password' => Hash::make('123456'),
            ],


            [
                'role_id' => $vendorRoleID,
                'name' => 'Our Teacher',
                'email' => 'teacher@gmail.com',
                'password' => Hash::make('123456'),
            ],
            [
                'role_id' => $customerRoleID,
                'name' => 'Our Student',
                'email' => 'student@gmail.com',
                'password' => Hash::make('123456'),
            ],
        ];

        foreach ($users as $user) {
            User::create($user);
        }
    }
}
