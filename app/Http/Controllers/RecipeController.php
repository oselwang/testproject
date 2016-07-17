<?php

namespace App\Http\Controllers;

use App\Eatnshare\Services\RecipeService;
use App\Eatnshare\Services\ReviewService;
use App\Http\Requests;
use App\Notification;
use App\Recipe;
use Illuminate\Http\Request;

class RecipeController extends BaseController
{
    protected $recipe;
    protected $request;
    protected $notification;
    protected $recipe_service;
    protected $review_service;

    public function __construct(Recipe $recipe, Notification $notification, Request $request,
                                RecipeService $recipeService, ReviewService $reviewService)
    {
        $this->request = $request;
        $this->notification = $notification;
        $this->recipe = $recipe;
        $this->recipe_service = $recipeService;
        $this->review_service = $reviewService;
        parent::__construct();
    }

    public function suggestion()
    {
        $recipes = $this->recipe->all();

        return view('suggestion', compact('recipes'));
    }

    public function showRecipe($slug)
    {
        $notification = $this->recipe_service->checkNotification();
        $recipe = $this->recipe->whereSlug($slug)->first();
        if ( empty($recipe) ) {
            return redirect('/');
        }
        $user = $recipe->user()->first();
        $ingredients = $recipe->ingredient()->get();
        $instructions = $recipe->instruction()->get();
        $categories = $recipe->categories()->get();
        $related_recipes = $this->recipe->paginate(3);
        $reviews = $recipe->review()->get();
        $rating = $this->review_service->countRating($reviews);

        return view('recipe', compact('user', 'recipe', 'ingredients', 'instructions', 'categories', 'related_recipes', 'reviews', 'rating'));
    }

    public function buyIngredient()
    {
        dd($this->request->all());
    }



}
