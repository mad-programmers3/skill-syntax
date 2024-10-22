<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Lesson extends Model
{
    use HasFactory;

    protected $fillable = [
        'course_id',
        'thumbnail_id',
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
    // Relationship with File
    public function thumbnail()
    {
        return $this->belongsTo(MyFile::class, 'thumbnail_id');
    }
    // Relationship with CourseLike
    public function likes()
    {
        return $this->hasMany(LessonLike::class);
    }
    // Relationship with LessonReview
    public function lesson_reviews()
    {
        return $this->hasMany(LessonReview::class);
    }
    // Relationship with quizzes
    public function quizzes()
    {
        return $this->belongsToMany(Quiz::class, 'lesson_quizzes');
    }
}
