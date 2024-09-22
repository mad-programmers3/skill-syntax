<?php

namespace Database\Seeders;

use App\Models\Review;
use Illuminate\Database\Seeder;

class ReviewsTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $reviews = [
            [
                'course_id' => 1, // Adjust according to your existing course IDs
                'user_id' => 1, // Adjust according to your existing user IDs
                'rating' => 5,
                'comment' => 'Excellent course! Very informative and well-structured.',
            ],
            [
                'course_id' => 1,
                'user_id' => 2,
                'rating' => 4,
                'comment' => 'Great course but could use more examples.',
            ],
            [
                'course_id' => 2,
                'user_id' => 1,
                'rating' => 3,
                'comment' => 'The content was good, but the pace was too fast.',
            ],
            [
                'course_id' => 2,
                'user_id' => 3,
                'rating' => 2,
                'comment' => 'Not what I expected. Lacked depth.',
            ],
            [
                'course_id' => 3,
                'user_id' => 2,
                'rating' => 5,
                'comment' => 'Fantastic course! I learned a lot and enjoyed every lesson.',
            ],
        ];

        foreach ($reviews as $review) {
            Review::create(array_merge($review, [
                'created_at' => now(),
                'updated_at' => now(),
            ]));
        }
    }
}
