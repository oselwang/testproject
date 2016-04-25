<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateRecipesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('recipes', function (Blueprint $table) {
        $table->increments('id');
        $table->string('user_id')->unsigned();
        $table->string('recipe_name');
        $table->string('portion');
        $table->string('preparation');
        $table->string('duration');
        $table->boolean('difficulty');
        $table->string('token')->unique();
        $table->string('email')->unique();
        $table->string('username')->unique();
        $table->string('password');
        $table->rememberToken();
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
        //
    }
}
