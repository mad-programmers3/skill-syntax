<?php

namespace Database\Seeders;

use App\Models\Role;
use App\Models\User;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Hash;
use Carbon\Carbon;

class UsersTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $supAdminRoleID = Role::where('name', 'Super Admin')->value('id');
        $adminRoleID = Role::where('name', 'Admin')->value('id');
        $instructorRoleID = Role::where('name', 'Instructor')->value('id');
        $studentRoleID = Role::where('name', 'Student')->value('id');

        $users = [
            [
                'role_id' => $supAdminRoleID,
                'name' => 'Mehedi Hasan',
                'email' => 'mehedi@gmail.com',
                'password' => Hash::make('123456'),
                'img' => null,
                'bio' => 'Super Admin at the course management system.',
                'mobile' => '1234567890',
                'location' => 'Dhaka, Bangladesh',
                'email_verified_at' => Carbon::now(),
            ],
            [
                'role_id' => $supAdminRoleID,
                'name' => 'Mamun',
                'email' => 'mamun@gmail.com',
                'password' => Hash::make('123456'),
                'img' => null,
                'bio' => 'Super Admin at the course management system.',
                'mobile' => '1234567891',
                'location' => 'Dhaka, Bangladesh',
                'email_verified_at' => Carbon::now(),
            ],
            [
                'role_id' => $supAdminRoleID,
                'name' => 'Shihab',
                'email' => 'shihab@gmail.com',
                'password' => Hash::make('123456'),
                'img' => null,
                'bio' => 'Super Admin at the course management system.',
                'mobile' => '1234567892',
                'location' => 'Dhaka, Bangladesh',
                'email_verified_at' => Carbon::now(),
            ],
            [
                'role_id' => $supAdminRoleID,
                'name' => 'Super Admin',
                'email' => 'superadmin@gmail.com',
                'password' => Hash::make('123456'),
                'img' => null,
                'bio' => 'Super Admin at the course management system.',
                'mobile' => '1234567893',
                'location' => 'Dhaka, Bangladesh',
                'email_verified_at' => Carbon::now(),
            ],
            [
                'role_id' => $adminRoleID,
                'name' => 'Our Admin',
                'email' => 'admin@gmail.com',
                'password' => Hash::make('123456'),
                'img' => null,
                'bio' => 'Admin at the course management system.',
                'mobile' => '1234567894',
                'location' => 'Dhaka, Bangladesh',
                'email_verified_at' => Carbon::now(),
            ],
            [
                'role_id' => $instructorRoleID,
                'name' => 'Our Teacher',
                'email' => 'teacher@gmail.com',
                'password' => Hash::make('123456'),
                'img' => null,
                'bio' => 'Instructor at the course management system.',
                'mobile' => '1234567895',
                'location' => 'Dhaka, Bangladesh',
                'email_verified_at' => Carbon::now(),
            ],
            [
                'role_id' => $studentRoleID,
                'name' => 'Our Student',
                'email' => 'student@gmail.com',
                'password' => Hash::make('123456'),
                'img' => null,
                'bio' => 'Student at the course management system.',
                'mobile' => '1234567896',
                'location' => 'Dhaka, Bangladesh',
                'email_verified_at' => Carbon::now(),
            ],
        ];

        foreach ($users as $user) {
            User::create($user);
        }
    }
}
