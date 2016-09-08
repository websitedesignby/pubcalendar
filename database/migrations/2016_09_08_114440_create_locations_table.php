<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateLocationsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('locations', function (Blueprint $table) {
            $table->increments('id');
            $table->timestamps();
            $table->string('fb_id', 100);
            $table->string('name', 50);
            $table->string('street', 50);
            $table->string('city', 50);
            $table->string('state', 50);
            $table->string('zip', 50);
            $table->string('country', 50);
            $table->string('email', 255);
            $table->string('phone', 50);
            $table->string('website', 100);
            $table->string('fb_url', 100);
            $table->double('longitude', 15, 12);
            $table->double('latitude', 15, 12);
            $table->string('image', 255);
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::drop('locations');
    }
}
