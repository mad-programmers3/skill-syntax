<?php

namespace Database\Seeders;

use App\Models\Course;
use App\Models\Lesson;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class LessonsTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $courses = Course::all();

        foreach ($courses as $course) {
            for ($i = 1; $i <= 10; $i++) {
                Lesson::create([
                    'course_id' => $course->id,
                    'title' => "Lesson {$i} for {$course->title}",
                    'description' => "This is the description for Lesson {$i} of the course {$course->title}.",
                    'video' => "https://example.com/videos/{$course->id}_lesson{$i}.mp4",
                    'created_at' => now(),
                    'updated_at' => now(),
                ]);
            }
        }
    }
}
