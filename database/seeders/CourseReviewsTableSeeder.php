<?php

namespace Database\Seeders;

use App\Models\Course;
use App\Models\CourseReview;
use App\Models\Review;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class CourseReviewsTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        // Get all courses and reviews(where type == 2 => course review)
        $courses = Course::all();
        $reviews = Review::where('type', 2)->get();

        // Link each course to some reviews
        foreach ($courses as $course) {
            foreach ($reviews as $review) {
                CourseReview::create([
                    'course_id' => $course->id,
                    'review_id' => $review->id,
                ]);
            }
        }
    }
}
