<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class Pivotingredientrecipe extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('pivotingredientrecipe', function (Blueprint $table) {

            $table->integer('id');
            $table->integer('recipe_id')->unsigned()->index();
            $table->integer('ingredient_id')->unsigned()->index();
            $table->integer('amount');
            $table->timestamps();

            $table->foreign('recipe_id')->references('id')->on('recipes')->onDelete('cascade');
            $table->foreign('ingredient_id')->references('id')->on('ingredients')->onDelete('cascade');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::drop('pivotingredientrecipe');
    }
}
