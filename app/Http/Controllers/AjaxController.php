<?php

namespace App\Http\Controllers;

use App\Eatnshare\Request\RegisterPostForm;
use App\Events\UserForgotPassword;
use App\Events\UserHasRegistered;
use App\Http\Requests;
use App\User;
use Carbon\Carbon;
use Auth;
use Illuminate\Http\Request;

class AjaxController extends Controller
{

    protected $request;
    protected $user;

    public function __construct(Request $request, User $user)
    {
        $this->request = $request;
        $this->user = $user;
    }

    public function recipeOfTheDay()
    {
        if (Carbon::now()->toTimeString() > "11:00:00") {
            return response()->json(false);
        }

        return response()->json(Carbon::now()->createFromTime(11, 0, 0)->toDateTimeString());
    }

    public function postRegister(RegisterPostForm $user)
    {

        $user_registered = $user->create();

        event(new UserHasRegistered($user_registered));

        return response()->json('success');
    }

    public function postLogin()
    {
        $credentials = [
            'username' => $this->request->get('username'),
            'password' => $this->request->get('password')
        ];

        if (Auth::attempt($credentials)) {
            return response()->json('success');
        }

        return 'fail';

    }

    public function forgotPassword()
    {
        $user = $this->user->whereUsername($this->request->get('username'))->firstOrFail();
        if ($user->email != $this->request->get('email')) {
            $message = 'fail';
        } else {
            $event = event(new UserForgotPassword($user));
            $user->password = bcrypt($event[0]);
            $user->save();
            return response()->json($user);
        }

        return $message;
    }
}
