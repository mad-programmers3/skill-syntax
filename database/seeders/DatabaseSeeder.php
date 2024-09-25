<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     *
     * @return void
     */
    public function run()
    {
        $this->call(RolesTableSeeder::class);
        $this->call(UsersTableSeeder::class);
        $this->call(CategoriesTableSeeder::class);
        $this->call(SubCategoriesTableSeeder::class);
        $this->call(CoursesTableSeeder::class);
        $this->call(LessonsTableSeeder::class);
        $this->call(ReviewsTableSeeder::class);
        $this->call(CourseReviewsTableSeeder::class);
        $this->call(LessonReviewsTableSeeder::class);
        $this->call(TestimonialsTableSeeder::class);
        $this->call(CourseLikesTableSeeder::class);
        $this->call(LessonLikesTableSeeder::class);
        $this->call(ModulesAndPermissionsTableSeeder::class);
        $this->call(RolePermissionsTableSeeder::class);
        $this->call(RoleModulesTableSeeder::class);
        $this->call(MyFilesTableSeeder::class);
    }
}
