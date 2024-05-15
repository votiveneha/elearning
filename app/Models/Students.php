<?php

namespace App\Models;
use Illuminate\Database\Eloquent\SoftDeletes;

use Illuminate\Database\Eloquent\Model;


class Students extends Model
{
    use SoftDeletes;
    protected $table = "users";

}
