<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;

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
            $table->integer('user_id')->unsigned();
            $table->string('name')->index();
            $table->integer('portion');
            $table->integer('duration');
            $table->string('difficulty');
            $table->string('description',1000);
            $table->string('slug')->index()->unique();
            $table->float('rating')->nullable();
            $table->string('photo_name');
            $table->integer('preparation');
            $table->timestamps();

            $table->foreign('user_id')->references('id')->on('users')->onDelete('cascade');

        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('recipecategories');
        Schema::dropIfExists('ingredients');
        Schema::dropIfExists('instructions');
        Schema::dropIfExists('recipephotos');
        Schema::dropIfExists('recipeprofilephotos');
        Schema::dropIfExists('recipecoverphotos');
        Schema::drop('recipes');
    }
}
