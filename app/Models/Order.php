<?php

namespace App\Models;
use App\Models\CUSTOM_ORDERS;
use Illuminate\Database\Eloquent\Model;

class Order extends Model
{
    protected $table='orders';
    protected $fillable=[
        'Customer_Emailid',
        'user_id',
        'Delivery_Address',
        'Order_Details',
        'Amount',
        'paymentmode',
        'p_status',
        'p_status_Updated_By',
        'Coupen_Code',
        'ip',
              
    ];

    ###############

    public function custom_orders() 
    {
        return $this->hasMany(CUSTOM_ORDERS::class,'order_id');
        
    }



    


}
