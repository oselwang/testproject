<?php

    namespace App\Http\Controllers\Auth;

    use Facebook\Facebook;
    use Illuminate\Http\Request;

    use App\Http\Requests;
    use App\Http\Controllers\Controller;

    class SocialLoginController extends Controller
    {
        const FACEBOOK_APP_ID = '250311455330726';
        const FACEBOOK_APP_SECRET = '64246f33d6a09c113d50efc1a7f259df';
        const DEFAULT_GRAPH_VERSION = 'v2.5';

        public function redirectFacebook()
        {
            if (!session_id()) {
                session_start();
            }

            $facebook = new Facebook([
                'app_id'                => self::FACEBOOK_APP_ID,
                'app_secret'            => self::FACEBOOK_APP_SECRET,
                'default_graph_version' => self::DEFAULT_GRAPH_VERSION
            ]);

            $helper = $facebook->getRedirectLoginHelper();

            $permissions = ['email'];

            $facebookUrl = $helper->getLoginUrl('http://testproject.net/auth/facebook/callback', ['scope' => 'email']);

            return redirect($facebookUrl);
        }

        public function facebookCallback()
        {
            if (!session_id()) {
                session_start();
            }

            $facebook = new Facebook([
                'app_id'                => self::FACEBOOK_APP_ID,
                'app_secret'            => self::FACEBOOK_APP_SECRET,
                'default_graph_version' => self::DEFAULT_GRAPH_VERSION
            ]);

            $helper = $facebook->getRedirectLoginHelper();

            try {
                $accessToken = $helper->getAccessToken();
                $response = $facebook->get('/me?fields=id,name,email', $accessToken);
            } catch (\Facebook\Exceptions\FacebookResponseException $e) {
                return redirect('/');
            } catch (\Facebook\Exceptions\FacebookSDKException $e) {
                return redirect('/');
            }

            $user = $response->getGraphUser();
            $email = $user->getEmail();
            if (empty($email)) {
                $facebook->delete('/' . $user['id'] . '/permissions', [], $accessToken);

                return redirect('/');
            } else {
                
            }

            return '';
        }

    }
