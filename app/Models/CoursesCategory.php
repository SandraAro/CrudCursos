<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class CoursesCategory extends Model
{
    use HasFactory;
    public $timestamps = false;
    protected $fillable=[
        'course_id',
        'category_id'
    ];
}
