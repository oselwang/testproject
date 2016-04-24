<?php

namespace App\Http\Controllers;

use App\Eatnshare\Request\RegisterPostForm;
use App\Events\UserHasRegistered;
use App\Http\Requests;
use Carbon\Carbon;

class AjaxController extends Controller
{
    public function recipeOfTheDay()
    {
        if (Carbon::now()->toTimeString() > "11:00:00") {
            return response()->json(false);
        }
        return response()->json(Carbon::now()->createFromTime(11, 0, 0)->toDateTimeString());
    }

    public function postRegister(RegisterPostForm $user){
        
        $user_registered = $user->create();

        event(new UserHasRegistered($user_registered));

        return response()->json('success');
    }
}
