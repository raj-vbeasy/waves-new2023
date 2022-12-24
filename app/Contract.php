<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Contract extends Model
{
	
    protected $fillable = ['first_name', 'last_name', 'address', 'date', 'email', 'phone', 'sign'];
}
