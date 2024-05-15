<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Paymentlink extends Model
{
	
    protected $table = "stripe_payment_links";
    protected $primaryKey = "payment_link_id";
    protected $fillable = ['payment_link_id'];

}
