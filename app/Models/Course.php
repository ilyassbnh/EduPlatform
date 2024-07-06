<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Str;

class Course extends Model
{
    use HasFactory;

    protected $fillable = [
        'title',
        'description',
        'slug',
        'category_id',
        'teacher_id',
        'image',
    ];

    public function category()
    {
        return $this->belongsTo(Category::class);
    }

    public function teacher()
    {
        return $this->belongsTo(User::class, 'teacher_id');
    }

    public function modules()
    {
        return $this->hasMany(Module::class);
    }

    // Automatically generate a slug from the title
    protected static function boot()
    {
        parent::boot();

        static::creating(function ($course) {
            $course->slug = Str::slug($course->title);
        });
    }
}
