<?php

namespace Database\Seeders;

use App\Models\Category;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class CategoriesTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $categories = [
            [
                'title' => 'Web Development',
                'details' => 'Courses on building websites and web applications.',
            ],
            [
                'title' => 'Data Science',
                'details' => 'Courses focused on data analysis, machine learning, and AI.',
            ],
            [
                'title' => 'Graphic Design',
                'details' => 'Courses on visual communication and design principles.',
            ],
            [
                'title' => 'Digital Marketing',
                'details' => 'Courses covering SEO, social media, and online advertising.',
            ],
            [
                'title' => 'Business Management',
                'details' => 'Courses on management, entrepreneurship, and business strategy.',
            ],
            [
                'title' => 'Personal Development',
                'details' => 'Courses aimed at improving personal skills and growth.',
            ],
            [
                'title' => 'Mobile Development',
                'details' => 'Courses on developing applications for mobile platforms.',
            ],
            [
                'title' => 'Photography',
                'details' => 'Courses on photography techniques and editing.',
            ],
            [
                'title' => 'Music Production',
                'details' => 'Courses on producing and mixing music.',
            ],
            [
                'title' => 'Language Learning',
                'details' => 'Courses for learning new languages.',
            ],
        ];

        foreach ($categories as $category) {
            Category::create(array_merge($category, [
                'created_at' => now(),
                'updated_at' => now(),
            ]));
        }

    }
}
