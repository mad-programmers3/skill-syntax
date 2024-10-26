<?php

namespace Database\Seeders;

use App\Models\LessonQuiz;
use App\Models\Quiz;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class LessonQuizzesTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $quizzes = Quiz::where('status', 0)->get();

        foreach ($quizzes as $quiz) {
            LessonQuiz::create([
                'lesson_id' => 1,
                'quiz_id' => $quiz->id,
            ]);

            $quiz->update(['status' => 1]);
        }
    }
}
