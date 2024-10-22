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
        $quizzesId = Quiz::all()->pluck('id');

        foreach ($quizzesId as $quiz_id) {
            LessonQuiz::create([
                'lesson_id' => 1,
                'quiz_id' => $quiz_id,
            ]);
        }
    }
}
