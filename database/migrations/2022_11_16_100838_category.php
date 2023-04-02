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
        Schema::create('categorymodel', function (Blueprint $table) {
            $table->id();
            $table->string('name');
            $table->string('product_id')->nullable();
            $table->string('slug')->unique();
            $table->string('image')->nullable();
            $table->integer('discount_percent')->nullable();
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
        Schema::dropIfExists('categorymodel');
    }
};
