<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class actor extends Model
{
    public function passport(){
		return $this->hasOne('App\passport');
	}
	
	public function mobile(){
		return $this->hasMany(Mobile::class);
	}
}
