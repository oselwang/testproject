<?php

namespace App\Http\Controllers;

use App\Http\Requests;
use App\User;
use Auth;
use Illuminate\Http\Request;

class AccountController extends BaseController
{
    protected $request;
    protected $user;

    public function __construct(Request $request, User $user)
    {
        $this->user = $user;
        $this->request = $request;
        $this->middleware('auth');
        parent::__construct();
    }


    public function showAccountPage($account)
    {
        $fb_account = $this->user->where('facebook_id', $account)->first();
        $site_account = $this->user->where('username', $account)->first();
        $user = $fb_account != null ? $fb_account : $site_account;

        $profile_photo = $user->profilephoto()->first();
        $cover_photo = $user->coverphoto()->first();
        $recipes = $user->recipe()->get();
        

        return view('account', compact('user', 'profile_photo', 'cover_photo', 'recipes'));
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
