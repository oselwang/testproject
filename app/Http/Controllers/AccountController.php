<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Auth;
use App\Http\Requests;

class AccountController extends Controller
{
    protected $request;

    public function __construct(Request $request)
    {
        $this->request = $request;
        $this->middleware('auth');
    }



    public function getAccountPage(){
        $profile_photo = Auth::user()->profilephoto()->first();
        $cover_photo = Auth::user()->coverphoto()->first();
        
        return view('account',compact('profile_photo','cover_photo'));
    }
    
    public function editHeadline(){
        $user = Auth::user();
        
        $user->headline = $this->request->get('headline');
        $user->save();
        flash('Headline successfully updated');
        
        return response()->json('success');
    }
}
