<?php

namespace Database\Seeders;

use App\Models\Quiz;
use Illuminate\Database\Seeder;

class QuizzesTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $quizzes = [
            [
                'title' => 'Quiz 1',
            ],
            [
                'title' => 'Quiz 2',
            ],
            [
                'title' => 'Quiz 3',
            ],
            [
                'title' => 'Quiz 4'
            ],

        ];

        foreach ($quizzes as $qui) {
            Quiz::create(array_merge($qui, [
                'created_at' => now(),
                'updated_at' => now(),
                'time_limit' => getSetting('default_quiz_time_limit'),
            ]));
        }

    }
}
