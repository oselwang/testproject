<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use App\Http\Requests;
use Carbon\Carbon;

class AjaxController extends Controller
{
    public function getRecipeofTheDayByAjax(){
        if(Carbon::now()->toTimeString() > "11:00:00") {
            return response()->json(false);
        }
        return response()->json(Carbon::now()->createFromTime(11,0,0)->toDateTimeString());
    }
}
