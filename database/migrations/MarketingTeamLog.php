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
        Schema::create('MarketingTeamLog', function (Blueprint $table) {
            $table->id();
            $table->string('product_id')->nullable();
            $table->string('product_name');
            $table->string('slug')->nullable();
            $table->string('update_price')->nullable();
            $table->string('old_price')->nullable();
            $table->integer('username')->nullable();
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
        Schema::dropIfExists('MarketingTeamLog');
    }
};
