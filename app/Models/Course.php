<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Course extends Model
{
    use HasFactory;

    protected $fillable = [
        'user_id', 'category_id', 'title', 'description', 'price', 'sits', 'start_date', 'end_date', 'thumbnail', 'status',
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

    // Relationship with Reviews
    public function reviews()
    {
        return $this->hasMany(Review::class, 'course_id');
    }
}
