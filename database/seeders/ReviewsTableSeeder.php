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
                'user_id' => 1,
                'rating' => 5,
                'comment' => 'This app is so nice.',
            ],
            [
                'user_id' => 2,
                'rating' => 1,
                'comment' => 'The courses are so expensive',
            ],
            [
                'user_id' => 2,
                'rating' => 1,
                'comment' => 'Nice and attractive',
                'type' => 3
            ],
            [
                'user_id' => 1,
                'rating' => 5,
                'comment' => 'Excellent course! Very informative and well-structured.',
                'type' => 2
            ],
            [
                'user_id' => 2,
                'rating' => 4,
                'comment' => 'Great course but could use more examples.',
                'type' => 2
            ],
            [
                'user_id' => 1,
                'rating' => 3,
                'comment' => 'The content was good, but the pace was too fast.',
                'type' => 2
            ],
            [
                'user_id' => 3,
                'rating' => 2,
                'comment' => 'Not what I expected. Lacked depth.',
                'type' => 2
            ],
            [
                'user_id' => 2,
                'rating' => 5,
                'comment' => 'Fantastic course! I learned a lot and enjoyed every lesson.',
                'type' => 2
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
