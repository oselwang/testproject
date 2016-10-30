<?php

namespace App\Http\Controllers;

use App\Eatnshare\Services\NotificationService;
use App\Eatnshare\Services\ReviewService;
use App\Notification;
use App\Recipe;
use PDF;
use Illuminate\Http\Request;

class RecipeController extends BaseController
{
    protected $recipe;
    protected $request;
    protected $notification;
    protected $review_service;
    /**
     * @var NotificationService
     */
    private $notificationService;

    /**
     * RecipeController constructor.
     * @param Recipe $recipe
     * @param Notification $notification
     * @param Request $request
     * @param NotificationService $notificationService
     * @param ReviewService $reviewService
     */
    public function __construct(Recipe $recipe, Notification $notification, Request $request,
                                NotificationService $notificationService, ReviewService $reviewService)
    {
        $this->request = $request;
        $this->notification = $notification;
        $this->recipe = $recipe;
        $this->review_service = $reviewService;
        parent::__construct();
        $this->notificationService = $notificationService;
    }

    public function suggestion()
    {
        $recipes = $this->recipe->all();

        return view('suggestion', compact('recipes'));
    }

    public function showRecipe($slug)
    {
        $notification = $this->notificationService->checkNotification();
        $recipe = $this->recipe->whereSlug($slug)->first();
        if ( empty($recipe) ) {
            return redirect('/');
        }
        $user = $recipe->user()->first();
        $ingredients = $recipe->ingredient()->get(['name','amount']);
        $instructions = $recipe->instruction()->get(['body']);
        $categories = $recipe->categories()->get();
        $related_recipes = $this->recipe->paginate(3);
        $reviews = $recipe->review()->orderBy('helpful','desc')->get();
        $rating = $this->review_service->countRating($reviews);

        return view('recipe', compact('user', 'recipe', 'ingredients', 'instructions', 'categories', 'related_recipes', 'reviews', 'rating'));
    }

    public function buyIngredient()
    {
        $ingredients = $this->request->get('ingredient');
        $ingredient_return = [];
        foreach($ingredients as $ingredient){
            $ingredient_wrapper = explode(' ',$ingredient);
            $ingredient_wrapper2['name'] = $ingredient_wrapper[1];
            $ingredient_wrapper2['amount'] = $ingredient_wrapper[0];
            $ingredient_return[] = $ingredient_wrapper2;
        }
        $ingredients = $ingredient_return;
        return view('buyingredient',compact('ingredients'));
    }

    public function printRecipe(){
        $slug = $this->request->get('recipe-slug');
        $recipe = $this->recipe->whereSlug($slug)->first();
        $user = $recipe->user()->first();
        $ingredients = $recipe->ingredient()->get(['name','amount']);
        $instructions = $recipe->instruction()->get(['body']);
        $categories = $recipe->categories()->get();
        $reviews = $recipe->review()->get(['id']);
        $rating = $this->review_service->countRating($reviews);

        $pdf = PDF::loadView('partial.recipepdf',compact('recipe','user','ingredients','instructions','categories'));

        return $pdf->download();
    }



}
