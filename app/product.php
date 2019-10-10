<?php

namespace App;

use Laravel\Scout\Searchable;
use Illuminate\Database\Eloquent\Model;

class Product extends Model
{
    use Searchable;
    
     /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'user_id', 'product_name', 'images', 'price', 'quantity', 'brand', 'condition', 'rating'
    ];

	/**
     * Get the indexable data array for the model.
     *
     * @return array
     */
    public function toSearchableArray()
    {
        $array = $this->toArray();

        // Customize array...

        return $array;
    }

	public function User(){
		return $this->belongsTo(User::class);
    }
    
    /**
     * Relationship to the product images
     */
    public function images(){
        return $this->hasmany(ProductImage::class);
    }
}
