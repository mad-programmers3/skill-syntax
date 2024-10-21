<?php

namespace Database\Seeders;

use App\Models\Question;
use Illuminate\Database\Seeder;

class QuestionsTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $questions = [
            [
                'quiz_id' => 1,
                'title' => 'What does PHP stand for?',
                'option_a' => 'Personal Home Page',
                'option_b' => 'PHP: Hypertext Preprocessor',
                'option_c' => 'Preprocessor Hypertext PHP',
                'option_d' => 'None of the above',
                'correct_answer' => 'b',
            ],
            [
                'quiz_id' => 1,
                'title' => 'Which of the following is a valid PHP variable?',
                'option_a' => '$variable_name',
                'option_b' => 'variable_name',
                'option_c' => '$variable-name',
                'option_d' => 'None of the above',
                'correct_answer' => 'a',
            ],
            [
                'quiz_id' => 1,
                'title' => 'What is the correct syntax to output "Hello World" in JavaScript?',
                'option_a' => 'echo "Hello World";',
                'option_b' => 'print("Hello World");',
                'option_c' => 'console.log("Hello World");',
                'option_d' => 'None of the above',
                'correct_answer' => 'c',
            ],
        ];

        foreach ($questions as $question) {
            Question::create(array_merge($question, [
                'created_at' => now(),
                'updated_at' => now(),
            ]));
        }

    }
}
