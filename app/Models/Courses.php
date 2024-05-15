<?php

namespace App\Models;
use Illuminate\Database\Eloquent\SoftDeletes;
use Illuminate\Database\Eloquent\Model;

class Courses extends Model
{
     use SoftDeletes;
     protected $table = "courses";
     protected $primaryKey = 'course_id';
     protected $fillable = ['ordering_id'];


}
