<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Course extends Model
{
    use HasFactory;

    protected $fillable = [
        'user_id', 'category_id', 'title', 'description', 'price', 'sits', 'start_date', 'end_date', 'thumbnail_id', 'status',
    ];


    // Relationship with User (Instructor)
    public function instructor()
    {
        return $this->belongsTo(User::class, 'user_id');
    }

    // Relationship with Category
    public function category()
    {
        return $this->belongsTo(Category::class, 'category_id');
    }
    // Relationship with File
    public function thumbnail()
    {
        return $this->belongsTo(MyFile::class, 'thumbnail_id');
    }
    // Relationship with Lessons
    public function lessons()
    {
        return $this->hasMany(Lesson::class, 'course_id');
    }
    // Relationship with CourseLike
    public function likes()
    {
        return $this->hasMany(CourseLike::class, 'course_id');
    }
}
