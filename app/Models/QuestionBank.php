<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class QuestionBank extends Model
{
	
    protected $table = "question_bank";
    protected $primaryKey = "question_id";
    protected $fillable = ['ordering_id'];

}
