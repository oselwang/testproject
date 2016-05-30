<?php

namespace App\Http\Controllers;

use App\Http\Requests;
use Auth;
use Illuminate\Http\Request;

class AccountController extends BaseController
{
    protected $request;

    public function __construct(Request $request)
    {
        $this->request = $request;
        $this->middleware('auth');
        parent::__construct();
    }


    public function getAccountPage()
    {
        $profile_photo = Auth::user()->profilephoto()->first();
        $cover_photo = Auth::user()->coverphoto()->first();
        $recipes = Auth::user()->recipe()->get();
        
        return view('account', compact('profile_photo', 'cover_photo', 'recipes'));
    }

    public function editHeadline()
    {
        $user = Auth::user();

        $user->headline = $this->request->get('headline');
        $user->save();
        flash('Headline successfully updated');

        return response()->json('success');
    }

    public function getCoverPhoto()
    {
        $cover_photo = Auth::user()->coverphoto()->first();

        return $cover_photo->photo_name;
    }
}
