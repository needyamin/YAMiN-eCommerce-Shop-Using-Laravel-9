<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateTransactionsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('transactions', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->string('TXNID');
            $table->integer('Oder_No');
            $table->string('mobile_no')->nullable(); 
            $table->string('currency')->nullable(); 
            $table->string('cus_name')->nullable(); 
            $table->string('cus_add1')->nullable(); 
            $table->string('cus_add2')->nullable(); 
            $table->string('cus_city')->nullable(); 
            $table->string('email')->nullable(); 
            $table->double('amount',8,2);
            $table->string('status');
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
        Schema::dropIfExists('transactions');
    }
}
