<?php

namespace Database\Seeders;

use App\Models\Course;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class CoursesTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $courses = [
            [
                'user_id' => 1,
                'category_id' => 1,
                'sub_category_id' => 1,
                'title' => 'Introduction to Web Development',
                'description' => 'Learn the basics of web development, including HTML, CSS, and JavaScript.',
                'price' => 99.99,
                'sits' => 50,
                'start_date' => '2024-01-01',
                'end_date' => '2024-03-01',
                'status' => 1,
            ],
            [
                'user_id' => 2,
                'category_id' => 2,
                'sub_category_id' => 2,
                'title' => 'Data Science Bootcamp',
                'description' => 'Become a data scientist in this comprehensive bootcamp covering Python, R, and machine learning.',
                'price' => 199.99,
                'sits' => 30,
                'start_date' => '2024-02-01',
                'end_date' => '2024-04-01',
                'status' => 1,
            ],
            [
                'user_id' => 1,
                'category_id' => 3,
                'sub_category_id' => 3,
                'title' => 'Graphic Design Fundamentals',
                'description' => 'An introduction to graphic design concepts, tools, and techniques.',
                'price' => 89.99,
                'sits' => 40,
                'start_date' => '2024-03-01',
                'end_date' => '2024-05-01',
                'status' => 1,
            ],
        ];

        foreach ($courses as $course) {
            Course::create(array_merge($course, [
                'created_at' => now(),
                'updated_at' => now(),
            ]));
        }
    }
}
