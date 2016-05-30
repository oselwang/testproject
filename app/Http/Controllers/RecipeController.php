<?php

namespace App\Http\Controllers;

use App\Http\Requests;
use App\Recipe;

class RecipeController extends BaseController
{
    protected $recipe;

    public function __construct(Recipe $recipe)
    {
        $this->recipe = $recipe;
        parent::__construct();
    }

    public function showRecipe($slug)
    {
        $recipe = $this->recipe->whereSlug($slug)->first();

        return view('recipe',compact('recipe'));
    }
}
