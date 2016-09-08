<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class AlterLocationsSourceMedium extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('locations', function($table){
            $table->string('source', 25)->after('image');
            $table->string('medium', 25)->after('source');
            $table->integer('addedby')->after('medium');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
         Schema::table('locations', function($table){
             $table->dropColumn('source');
             $table->dropColumn('medium');
             $table->dropColumn('addedby');
         });
    }
}
