<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class CoursesAssigment extends Model
{
    use HasFactory;
    public $timestamps = false;

    protected $fillable=[
        'course_id',
        'assigment_id'
    ];

    public function assigment(){
        return $this->hasOne(Assigment::class,'id', 'assigment_id');
    }
}
