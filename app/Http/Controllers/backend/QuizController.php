<?php

namespace App\Http\Controllers\backend;

use App\Http\Controllers\Controller;
use App\Models\Question;
use App\Models\Quiz;
use App\Models\SolvedQuestion;
use App\Supports\BaseCrudHelper;
use Exception;
use Illuminate\Http\Request;

class QuizController extends Controller
{
    use BaseCrudHelper;

    public function __construct()
    {
        $this->model = new Quiz();
        $this->with = ['questions'];

        $this->beforeStore = function ($request) {
            if (!$request->input('time_limit'))
                $request->merge(['time_limit' => getSetting('default_quiz_time_limit')]);
        };
    }


    public function submit(Request $request)
    {
        try {
            $user = auth()->user();
            if (!$user) return retRes('No auth found', null, CODE_DANGER);

            $attempts = $request->all();
            $solvedQsId = [];

            foreach ($attempts as $attempt) {
                $question = Question::find($attempt['question_id']);

                if ($question) {
                    if ($question->correct_answer === $attempt['answer']) {
                        // if the ans is correct then store
                        SolvedQuestion::firstOrCreate([
                            'user_id'     => $user->id,
                            'question_id' => $question->id,
                        ]);

                        $solvedQsId[] = $question->id;
                    } else {
                        // delete the correct one
                        SolvedQuestion::where('user_id', $user->id)
                            ->where('question_id', $question->id)
                            ->delete();
                    }
                }
            }

            return retRes('Successfully submitted quiz.', $solvedQsId, CODE_SUCCESS);

        } catch (Exception $e) {
            // Handle any errors and return a failure response
            return retRes('Failed to submit answers', $e->getMessage(), 500);
        }
    }


}
