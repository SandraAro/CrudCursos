<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Assigment extends Model
{
    use HasFactory;
    public $timestamps = false;

    protected $fillable=[
        'name'
    ];

    protected $table='assigments';
}
