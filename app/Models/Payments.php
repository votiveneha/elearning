<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Payments extends Model
{
	
    protected $table = "payments";
    protected $primaryKey = "payment_id";
    protected $fillable = ['payment_id'];

}
