<?php

namespace Database\Seeders;

use App\Models\SubCategory;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class SubCategoriesTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $subCategories = [
            // Web Development
            [
                'title' => 'HTML & CSS',
                'category_id' => 1, // Web Development
            ],
            [
                'title' => 'JavaScript Frameworks',
                'category_id' => 1, // Web Development
            ],
            [
                'title' => 'Backend Development',
                'category_id' => 1, // Web Development
            ],

            // Data Science
            [
                'title' => 'Python for Data Science',
                'category_id' => 2, // Data Science
            ],
            [
                'title' => 'Machine Learning',
                'category_id' => 2, // Data Science
            ],
            [
                'title' => 'Data Visualization',
                'category_id' => 2, // Data Science
            ],

            // Graphic Design
            [
                'title' => 'Adobe Photoshop',
                'category_id' => 3, // Graphic Design
            ],
            [
                'title' => 'UI/UX Design',
                'category_id' => 3, // Graphic Design
            ],

            // Digital Marketing
            [
                'title' => 'SEO Optimization',
                'category_id' => 4, // Digital Marketing
            ],
            [
                'title' => 'Social Media Marketing',
                'category_id' => 4, // Digital Marketing
            ],

            // Business Management
            [
                'title' => 'Leadership Skills',
                'category_id' => 5, // Business Management
            ],
            [
                'title' => 'Entrepreneurship',
                'category_id' => 5, // Business Management
            ],

            // Personal Development
            [
                'title' => 'Time Management',
                'category_id' => 6, // Personal Development
            ],
            [
                'title' => 'Public Speaking',
                'category_id' => 6, // Personal Development
            ],

            // Mobile Development
            [
                'title' => 'Android Development',
                'category_id' => 7, // Mobile Development
            ],
            [
                'title' => 'iOS Development',
                'category_id' => 7, // Mobile Development
            ],

            // Photography
            [
                'title' => 'Portrait Photography',
                'category_id' => 8, // Photography
            ],
            [
                'title' => 'Photo Editing',
                'category_id' => 8, // Photography
            ],

            // Music Production
            [
                'title' => 'Audio Mixing',
                'category_id' => 9, // Music Production
            ],
            [
                'title' => 'Beat Making',
                'category_id' => 9, // Music Production
            ],

            // Language Learning
            [
                'title' => 'Spanish Language',
                'category_id' => 10, // Language Learning
            ],
            [
                'title' => 'French Language',
                'category_id' => 10, // Language Learning
            ],
        ];

        foreach ($subCategories as $subCategory) {
            SubCategory::create(array_merge($subCategory, [
                'created_at' => now(),
                'updated_at' => now(),
            ]));
        }
    }
}
