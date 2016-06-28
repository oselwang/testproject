<?php

namespace App\Http\Controllers;

use App\Notification;
use App\Recipe;
use Auth;

use App\Http\Requests;

class LandingPageController extends BaseController
{

    protected $recipe;
    protected $notification;

    public function __construct(Recipe $recipe,Notification $notification)
    {
        $this->recipe = $recipe;
        $this->notification = $notification;
        parent::__construct();
    }

    public function index(){
        return view('index');
    }
    
    public function notification(){
        $notification = $this->notification->where('status','unread')
                                            ->where('user_id',Auth::user()->id)->get();
        
        $total = count($notification);
        
        return response()->json($total);
    }

    public function allRecipe(){
        $recipes = $this->recipe->all();

        return view('allrecipe',compact('recipes'));
    }
}
