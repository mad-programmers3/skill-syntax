<?php

namespace Database\Seeders;

use App\Models\Course;
use App\Models\CourseLike;
use App\Models\User;
use Illuminate\Database\Seeder;

class CourseLikesTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $users = User::all();
        $courses = Course::all();

        // each user likes all course
        foreach ($courses as $course) {
            foreach ($users as $user) {
                CourseLike::create([
                    'user_id' => $user->id,
                    'course_id' => $course->id,
                ]);
            }
        }
    }
}