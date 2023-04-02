<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Products extends Model
{
    protected $table='products';
    protected $fillable=[
        'priority',
        'name',
        'description',
        'rating',
        'price',
        'discount',
        'url',
        'image1',
        'image2',
        'image3',
        'image4',
        'image5',
        'image6',
        'category_id',
        'quantity',
        'title',
        'keywords',
        'meta_description',
        'status',
    ];

    #### WORKS FOR CATEGORY $CATEGORY->PRODUCT_ID
    public function category()
    {
        return $this->belongsTo('App\Models\category', 'category_id');
    }

    public function subcategory()
    {
        return $this->belongsTo('App\Models\subcategory', 'subcategory_id');
    }

}


