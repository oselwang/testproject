<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class PivotIngredientRecipe extends Model
{
    protected $table = 'pivotingredientrecipe';

    protected $fillable = ['recipe_id','ingredient_id','amount'];
}
