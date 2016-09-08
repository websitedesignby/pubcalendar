<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class AlterUsers1 extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('users', function($table){
            $table->dropColumn('name');
            $table->string('fname', 50)->after('id');
            $table->string('lname', 50)->after('fname');
            $table->string('username', 50)->after('lname');
            $table->tinyInteger('type');
            $table->tinyInteger('role');
            $table->tinyInteger('enabled');
            $table->tinyInteger('privacy');
            $table->tinyInteger('agreed');
            $table->integer('ip_created');
            $table->integer('ip_last');
            $table->integer('ip_login');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('users', function($table){
            $table->string('name', 255)->after('id');
            $table->dropColumn('fname');
            $table->dropColumn('lname');
            $table->dropColumn('username');
            $table->dropColumn('type');
            $table->dropColumn('role');
            $table->dropColumn('enabled');
            $table->dropColumn('privacy');
            $table->dropColumn('agreed');
            $table->dropColumn('ip_created');
            $table->dropColumn('ip_last');
            $table->dropColumn('ip_login');
        });
    }
}
