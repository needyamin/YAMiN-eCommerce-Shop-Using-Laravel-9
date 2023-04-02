<?php

namespace App\Models;
use App\Models\Products;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class category extends Model
{
    protected $table='categorymodel';
    protected $fillable=[
        'name',
        'product_id',
        'slug',
        'image',
    ];



    public function products()
    {
        return $this->hasMany(Products::class, 'category_id');

    }

    
    ##relationship with subcategory (ADMIN PANEL TABLE RELATION SUBCATEGOR)
    public function subcategory()
    {
        return $this->hasMany('App\Models\subcategory', 'category_id');
    } 

}
