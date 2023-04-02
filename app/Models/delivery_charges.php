<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class delivery_charges extends Model
{
    protected $table='delivery_charges';
    protected $fillable=[
        'city',
        'cost',
        'postcode',
       
    ];
}
