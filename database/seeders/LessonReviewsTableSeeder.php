<?php

namespace Database\Seeders;

use App\Models\Lesson;
use App\Models\LessonReview;
use App\Models\Review;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class LessonReviewsTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        // Get all lessons and reviews(where type == 3 => lesson review)
        $lessons = Lesson::all();
        $reviews = Review::where('type', 3)->get();

        // Link each lesson to some reviews
        foreach ($lessons as $lesson) {
            foreach ($reviews as $review) {
                LessonReview::create([
                    'lesson_id' => $lesson->id,
                    'review_id' => $review->id,
                ]);
            }
        }
    }
}
