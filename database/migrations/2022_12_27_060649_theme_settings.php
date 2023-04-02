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
        Schema::create('themesettings', function (Blueprint $table) {
            $table->id();
            $table->text('website_title')->nullable();
            $table->text('website_description')->nullable();
            $table->longtext('header_meta_code')->nullable();
            $table->text('logo')->nullable();
            $table->text('footer_text')->nullable();
            $table->string('social_links')->nullable();
            $table->string('theme_color')->nullable();
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
        Schema::dropIfExists('themesettings');
    }
};
