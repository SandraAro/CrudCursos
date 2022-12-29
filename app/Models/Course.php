<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Course extends Model
{
    use HasFactory;

    protected $fillable=[
        'name',
        'description',
        'image'
    ];

    protected $table='courses';

    public function coursesCategories()
    {
        return $this->hasMany(CoursesCategory::class);
    }

    public function coursesAssigments()
    {
        return $this->hasMany(CoursesAssigment::class);
    }
}
