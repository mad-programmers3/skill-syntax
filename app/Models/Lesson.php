<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Lesson extends Model
{
    use HasFactory;

    protected $fillable = [
        'course_id',
        'title',
        'description',
        'video',
        'status',
    ];

    // Define the relationship with the Course model
    public function course()
    {
        return $this->belongsTo(Course::class);
    }
    // Relationship with CourseLike
    public function likes()
    {
        return $this->hasMany(LessonLike::class);
    }
    // Relationship with LessonReview
    public function reviews()
    {
        return $this->hasMany(LessonReview::class);
    }
}
