<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class mobile extends Model
{
    public function actor(){
		return $this->belongsTo(Actor::class);
	}
}
