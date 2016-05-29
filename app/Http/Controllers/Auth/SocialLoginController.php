<?php

namespace App\Http\Controllers\Auth;

use App\Eatnshare\Services\UserService;
use App\Http\Controllers\Controller;
use App\Http\Requests;
use App\User;
use Facebook\Facebook;
use Flash;

class SocialLoginController extends Controller
{
    const FACEBOOK_APP_ID = '250311455330726';
    const FACEBOOK_APP_SECRET = '64246f33d6a09c113d50efc1a7f259df';
    const DEFAULT_GRAPH_VERSION = 'v2.5';

    protected $user;
    protected $user_service;
    protected $facebook;

    public function __construct(User $user, UserService $userService)
    {
        session_start();

        $this->facebook = new Facebook([
            'app_id'                => self::FACEBOOK_APP_ID,
            'app_secret'            => self::FACEBOOK_APP_SECRET,
            'default_graph_version' => self::DEFAULT_GRAPH_VERSION
        ]);

        $this->user_service = $userService;
        $this->user = $user;
    }

    public function redirectFacebook()
    {

        $helper = $this->facebook->getRedirectLoginHelper();

        $permissions = [ 'email' ];

        $facebookUrl = $helper->getLoginUrl('http://testproject.net/auth/facebook/callback', $permissions);

        return redirect($facebookUrl);
    }

    public function facebookCallback()
    {

        $helper = $this->facebook->getRedirectLoginHelper();

        try {
            $accessToken = $helper->getAccessToken();
            $response = $this->facebook->get('/me?fields=id,name,email,gender', $accessToken);
        } catch ( \Facebook\Exceptions\FacebookResponseException $e ) {
            return redirect('/');
        } catch ( \Facebook\Exceptions\FacebookSDKException $e ) {
            return redirect('/');
        }

        $user = $response->getGraphUser();
        $email = $user->getEmail();
        
        if ( empty($email) ) {
            $this->facebook->delete('/' . $user[ 'id' ] . '/permissions', [ ], $accessToken);

            Flash::error('We need your email address to continue');

            return redirect('/');
        } else {
            if ( $facebook_id = $this->user->where('facebook_id', intval($user->getId()))->first() ) {
                flash('Welcome back');

                \Auth::login($facebook_id);

                return redirect('/');
            }
            $authUser = $this->user_service->createFacebookAccount($user);
            flash('Welcome to ___, start creating your own recipe !');

            return redirect('/');


        }

    }

}
