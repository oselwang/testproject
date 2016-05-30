<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class PivotRecipeCategory extends Model
{
    protected $table = 'pivotcategoryrecipe';
    protected $fillable = ['recipe_id','recipe_category_id'];
}
