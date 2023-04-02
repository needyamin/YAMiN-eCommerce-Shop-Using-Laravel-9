<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('custom_orders', function (Blueprint $table) {
            $table->id();
            $table->string('user_id')->nullable();
            $table->string('product_id')->nullable();
            $table->string('order_id')->nullable();
            $table->string('quantity')->nullable();
            $table->string('price')->nullable();
            $table->string('del_CHARGE')->nullable();
            $table->longtext('note')->nullable();
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
        Schema::dropIfExists('custom_orders');
    }
};
