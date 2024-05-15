<?php

namespace App\Models;
use Illuminate\Database\Eloquent\SoftDeletes;
use Illuminate\Database\Eloquent\Model;

class Theory extends Model
{
     use SoftDeletes;
     protected $table = "theory";
     protected $primaryKey = 'theory_id';
     protected $fillable = ['ordering_id'];


}
