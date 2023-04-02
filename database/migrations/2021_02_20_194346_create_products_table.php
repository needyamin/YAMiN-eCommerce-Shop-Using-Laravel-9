<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateProductsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('products', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->integer('priority')->default('0');
            $table->string('sku')->nullable();
            $table->string('name');
            $table->text('description');
            $table->string('url')->unique();
            $table->integer('rating')->nullable();
            $table->integer('price')->nullable();
            $table->integer('discount')->nullable();
            $table->string('image1')->nullable();
            $table->string('image2')->nullable();
            $table->string('image3')->nullable();
            $table->string('image4')->nullable();
            $table->string('image5')->nullable(); 
            $table->string('image6')->nullable(); 
            $table->integer('category_id')->default('255'); 
            $table->string('subcategory_id')->nullable();
            $table->string('quantity')->nullable(); 
            $table->text('title')->nullable();
            $table->text('keywords')->nullable();
            $table->longtext('meta_description')->nullable();
            $table->string('status')->default('1');
            $table->integer('delivery_charges')->nullable();
            $table->longtext('additional_info')->nullable();
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
        Schema::dropIfExists('products');
    }
}
