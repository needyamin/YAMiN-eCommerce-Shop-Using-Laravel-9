<?php

namespace App\Models;
use Illuminate\Database\Eloquent\Model;

class BLOCK_IP extends Model
{
    protected $table='block_ip';
    protected $fillable=[
        'ip',
        'note',
    ];

}
