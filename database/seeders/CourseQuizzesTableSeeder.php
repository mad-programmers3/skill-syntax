<?php

namespace Database\Seeders;

use App\Models\CourseQuiz;
use App\Models\Quiz;
use Illuminate\Database\Seeder;

class CourseQuizzesTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $quizzesId = Quiz::all()->pluck('id');

        foreach ($quizzesId as $quiz_id) {
            CourseQuiz::create([
                'course_id' => 1,
                'quiz_id' => $quiz_id,
            ]);
        }

    }
}
