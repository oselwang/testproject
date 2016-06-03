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
        $this->middleware('auth');
        $this->recipe = $recipe;
        parent::__construct();
    }

    public function showRecipe($slug)
    {
        $recipe = $this->recipe->whereSlug($slug)->first();
        $profile_photo = $recipe->profilephoto()->first();
        $ingredients = $recipe->ingredient()->get();
        return view('recipe',compact('recipe','profile_photo','ingredients'));
    }

    public function buyIngredient(){
        dd($this->request->all());
    }

}
