<?php

namespace App\Http\Controllers;

use App\Http\Requests;
use App\Notification;
use App\Recipe;
use Illuminate\Http\Request;

class RecipeController extends BaseController
{
    protected $recipe;
    protected $request;
    protected $notification;

    public function __construct(Recipe $recipe,Notification $notification,Request $request)
    {
        $this->request = $request;
        $this->notification = $notification;
        $this->recipe = $recipe;
        parent::__construct();
    }

    public function suggestion(){
        $recipes = $this->recipe->all();

        return view('suggestion',compact('recipes'));
    }

    public function showRecipe($slug)
    {
        $notification_id = $this->request->query->get('notification_id');
        if(!empty($notification_id)){
            $notification_id = intval($notification_id);
            $notification = $this->notification->where('id',$notification_id)->first();
            $notification->status = 'read';
            $notification->save();
        }
        $recipe = $this->recipe->whereSlug($slug)->first();
        if(empty($recipe)){
            return redirect('/');
        }
        $user = $recipe->user()->first();
        $ingredients = $recipe->ingredient()->get();
        $instructions = $recipe->instruction()->get();
        $categories = $recipe->categories()->get();
        $related_recipes = $this->recipe->paginate(3);
        $reviews = $recipe->review()->get();
        return view('recipe',compact('user','recipe','ingredients','instructions','categories','related_recipes','reviews'));
    }

    public function buyIngredient(){
        dd($this->request->all());
    }

}
