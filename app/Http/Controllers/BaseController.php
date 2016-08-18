<?php

namespace App\Http\Controllers;

use App\RecipeCategory;
use View;

use App\Http\Requests;

class BaseController extends Controller
{
    protected $all_category;

    public function __construct()
    {
        $recipe_category = new RecipeCategory();
        $this->all_category = $recipe_category->all();
        
        View::share('all_category', $this->all_category);
    }
}
