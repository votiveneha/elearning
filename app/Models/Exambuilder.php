<?php

namespace App\Models;
use Illuminate\Database\Eloquent\SoftDeletes;
use Illuminate\Database\Eloquent\Model;

class Exambuilder extends Model
{
    
     protected $table = "exam_builder";
     protected $primaryKey = 'exam_builder_id';
     //protected $fillable = ['ordering_id'];


}