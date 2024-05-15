<?php

namespace App\Models;
use Illuminate\Database\Eloquent\SoftDeletes;
use Illuminate\Database\Eloquent\Model;

class Topics extends Model
{
    use SoftDeletes;
    protected $table = "topics";
    protected $primaryKey = 'topic_id';
    protected $fillable = ['ordering_id'];


}
