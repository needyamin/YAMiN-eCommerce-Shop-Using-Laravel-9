<?php

namespace App\Models;
use App\Models\Order;
use App\Models\User;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class CUSTOM_ORDERS extends Model
{
    protected $table='custom_orders';
    protected $fillable = [
        'user_id',
        'product_id',
        'order_id',
        'quantity',
        'price',
        'del_CHARGE',
        'note',
        'ip',
    ];
    

    public function orders()
    {
        $this->belongsTo(Order::class);
    }

  public function user()
  {
      return $this->belongsTo(User::class);
  }
    
    }
