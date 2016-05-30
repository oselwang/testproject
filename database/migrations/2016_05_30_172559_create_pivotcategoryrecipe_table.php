<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreatePivotcategoryrecipeTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('pivotcategoryrecipe',function(Blueprint $table){

            $table->integer('id');
            $table->integer('recipe_id')->unsigned();
            $table->integer('recipe_category_id')->unsigned();

            $table->foreign('recipe_id')->references('id')->on('recipes')->onDelete('cascade');
            $table->foreign('recipe_category_id')->references('id')->on('recipecategories')->onDelete('cascade');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
     
        Schema::drop('pivotcategoryrecipe');
    }
}
