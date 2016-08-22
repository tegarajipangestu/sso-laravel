<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateUsersTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('users', function (Blueprint $table) {
            $table->increments('id');
            $table->string('name');
            $table->string('saml_id');
            $table->string('email')->unique();
            $table->string('remember_token');            
            $table->string('session_index');
            $table->string('organization');
            $table->string('address');
            $table->string('lastname');
            $table->string('im');
            $table->string('url');
            $table->string('country');            
            $table->string('mobile');
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
        Schema::drop('users');
    }
}
