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
        Schema::create('search_table', function (Blueprint $table) {
            $table->id();
            $table->longText('search_q');
            $table->string('user_id')->nullable();
            $table->string('user_mobile_no')->nullable();
            $table->string('ip')->nullable();
            $table->string('product_name')->nullable();
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
        Schema::dropIfExists('search_table');
    }
};
