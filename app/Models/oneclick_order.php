<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class oneclick_order extends Model
{
    use HasFactory;
    protected $table='guest_oneclick_orders';
    protected $fillable=[
        'name',
        'phone',
        'address',
        'product_id',
        'quantity',
        'price',
        'note',
        'ip',
    ];
}
