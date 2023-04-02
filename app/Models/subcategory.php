<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use App\Models\category;
class subcategory extends Model
{
    protected $table='subcategory';
    protected $fillable=[
        'name',
        'category_id',
        'slug',
  
    ];

    ##public $timestamps = false; ###later remove this ones

    ##public function products()
    ##{
       ## return $this->hasMany('App\Models\products', 'category_id');
    ##}

    ## relationship admin subcategory
    public function category()
    {
        return $this->belongsTo(category::class,'category_id');
    }
    

}
