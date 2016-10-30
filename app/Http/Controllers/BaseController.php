<?php

namespace App\Http\Controllers;

use App\RecipeCategory;
use View;
use Cache;
use App\Http\Requests;

class BaseController extends Controller
{
    protected $all_category;

    public function __construct()
    {
        $recipe_category = new RecipeCategory();
        if(Cache::get('category') == null){
            $category = $recipe_category->all();
            Cache::forever('category',$category);
        }

        View::share('all_category', Cache::get('category'));
    }
}
