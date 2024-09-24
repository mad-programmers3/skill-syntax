<?php

namespace Database\Seeders;

use App\Models\Review;
use App\Models\Testimonial;
use Illuminate\Database\Seeder;

class TestimonialsTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        // Get all reviews(where type == 1 => testimonials)
        $reviews = Review::where('type', 1)->get();

        foreach ($reviews as $review) {
            Testimonial::create([
                'review_id' => $review->id
            ]);
        }
    }
}
