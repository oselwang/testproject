<?php

namespace App\Http\Controllers;

use Facebook\Facebook;
use Illuminate\Http\Request;

use App\Http\Requests;

class LandingPageController extends Controller
{
    public function index(){
        return view('index');
    }
}
