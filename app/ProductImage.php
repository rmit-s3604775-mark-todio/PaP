<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class ProductImage extends Model
{
    public function product(){
        return $this->belongTo(product::class);
    }
}
