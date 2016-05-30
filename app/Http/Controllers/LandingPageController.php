<?php

namespace App\Http\Controllers;

use Facebook\Facebook;
use Illuminate\Http\Request;

use App\Http\Requests;

class LandingPageController extends BaseController
{

    public function __construct()
    {
        parent::__construct();
    }

    public function index(){
        return view('index');
    }
}
