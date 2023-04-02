<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class search extends Model
{
    protected $table='search_table';
    protected $fillable=[
        'search_q',
        'user_id',
        'user_mobile_no',
        'ip',
        'product_name',       
    ];
}
