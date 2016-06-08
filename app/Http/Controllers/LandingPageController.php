<?php

namespace App\Http\Controllers;

use App\Recipe;
use Facebook\Facebook;
use Illuminate\Http\Request;

use App\Http\Requests;

class LandingPageController extends BaseController
{

    protected $recipe;

    public function __construct(Recipe $recipe)
    {
        $this->recipe = $recipe;
        parent::__construct();
    }

    public function index(){
        return view('index');
    }

    public function allRecipe(){
        $recipes = $this->recipe->all();

        return view('allrecipe',compact('recipes'));
    }
}
