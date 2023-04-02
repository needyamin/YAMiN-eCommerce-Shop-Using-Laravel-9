<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateOrdersTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('orders', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->string('Customer_Emailid')->nullable();
            $table->string('name')->nullable();
            $table->integer('user_id')->nullable();
            $table->string('Customer_phone_id')->nullable();
            $table->string('customer_alternative_phone_id')->nullable();
            $table->string('Delivery_Address')->nullable();;
            $table->string('city')->nullable();;
            $table->text('Order_Details');
            $table->float('Coupen_Code')->nullable();
            $table->double('Amount',8,2);
            $table->string('paymentmode');
            $table->string('Shipping_Status')->default('pending');
            $table->string('Delivery_Status')->default('pending');
            $table->tinyInteger('Order_Cancel_Status')->default('0'); 
            $table->string('Order_Cancelled_On')->nullable(); 
            $table->string('p_status')->default('pending');
            $table->string('p_status_Updated_By')->nullable();  
            $table->string('ip')->nullable();   
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('orders');
    }
}
