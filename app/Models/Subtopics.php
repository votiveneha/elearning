<?php

namespace App\Models;
use Illuminate\Database\Eloquent\SoftDeletes;
use Illuminate\Database\Eloquent\Model;


class Subtopics extends Model
{
    use SoftDeletes;
    protected $table = "subtopics";
    protected $primaryKey = 'st_id';
    protected $fillable = ['ordering_id'];


}
