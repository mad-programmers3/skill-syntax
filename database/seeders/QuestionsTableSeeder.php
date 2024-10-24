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
            // Quiz 1 questions
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

            // Quiz 2 questions
            [
                'quiz_id' => 2,
                'title' => 'Which company developed Java?',
                'option_a' => 'Microsoft',
                'option_b' => 'Google',
                'option_c' => 'Sun Microsystems',
                'option_d' => 'Apple',
                'correct_answer' => 'c',
            ],
            [
                'quiz_id' => 2,
                'title' => 'Which keyword is used to create a class in Java?',
                'option_a' => 'class',
                'option_b' => 'public',
                'option_c' => 'new',
                'option_d' => 'define',
                'correct_answer' => 'a',
            ],
            [
                'quiz_id' => 2,
                'title' => 'Which method must be implemented by all Java threads?',
                'option_a' => 'start()',
                'option_b' => 'run()',
                'option_c' => 'stop()',
                'option_d' => 'execute()',
                'correct_answer' => 'b',
            ],

            // Quiz 3 questions
            [
                'quiz_id' => 3,
                'title' => 'What is the default port number for HTTP?',
                'option_a' => '21',
                'option_b' => '80',
                'option_c' => '443',
                'option_d' => '8080',
                'correct_answer' => 'b',
            ],
            [
                'quiz_id' => 3,
                'title' => 'Which protocol is used to send an email?',
                'option_a' => 'FTP',
                'option_b' => 'HTTP',
                'option_c' => 'SMTP',
                'option_d' => 'IMAP',
                'correct_answer' => 'c',
            ],
            [
                'quiz_id' => 3,
                'title' => 'Which of the following is a NoSQL database?',
                'option_a' => 'MySQL',
                'option_b' => 'PostgreSQL',
                'option_c' => 'MongoDB',
                'option_d' => 'SQL Server',
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
