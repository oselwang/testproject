<?php

namespace App\Http\Controllers;

use App\Http\Requests;
use App\Recipe;
use Illuminate\Http\Request;

class RecipeController extends BaseController
{
    protected $recipe;
    protected $request;

    public function __construct(Recipe $recipe,Request $request)
    {
        $this->request = $request;

        $this->recipe = $recipe;
        parent::__construct();
    }

    public function suggestion(){
        $recipes = $this->recipe->all();

        return view('suggestion',compact('recipes'));
    }

    public function showRecipe($slug)
    {
        $recipe = $this->recipe->whereSlug($slug)->first();
        $profile_photo = $recipe->profilephoto()->first();
        $ingredients = $recipe->ingredient()->get();
        $instructions = $recipe->instruction()->get();
        $categories = $recipe->categories()->get();
        $related_recipes = $this->recipe->paginate(3);
        return view('recipe',compact('recipe','profile_photo','ingredients','instructions','categories','related_recipes'));
    }

    public function buyIngredient(){
        dd($this->request->all());
    }

}
