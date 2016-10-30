<?php

namespace App\Http\Controllers;

use App\Eatnshare\Services\AccountService;
use App\Eatnshare\Services\NotificationService;
use App\Follow;
use App\Http\Requests;
use App\User;
use Auth;
use Carbon\Carbon;
use Illuminate\Http\Request;

class AccountController extends BaseController
{
    protected $request;
    protected $user;
    /**
     * @var NotificationService
     */
    private $notificationService;
    /**
     * @var Follow
     */
    private $follow;
    /**
     * @var AccountService
     */
    private $accountService;

    /**
     * AccountController constructor.
     * @param Request $request
     * @param User $user
     * @param NotificationService $notificationService
     * @param Follow $follow
     * @param AccountService $accountService
     */
    public function __construct(Request $request, User $user, NotificationService $notificationService,Follow $follow,AccountService $accountService)
    {
        $this->user = $user;
        $this->request = $request;
        parent::__construct();
        $this->notificationService = $notificationService;
        $this->follow = $follow;
        $this->accountService = $accountService;
    }

    public function showAccountPage($account)
    {
        $notification = $this->notificationService->checkNotification();
        $data = ['id','firstname','lastname'];
        $user = is_integer(intval($account)) ? $this->user->where('facebook_id',$account)->first($data) : $this->user->where('username',$account)->first($data);
        $profile_photo = $user->profilephoto()->first();
        $cover_photo = $user->coverphoto()->first();
        $recipes = $user->recipe()->get();
        $followers = $this->follow->where('user_id',$user->id)->get(['follower_id']);
        $followings = $this->follow->where('follower_id',$user->id)->get(['user_id']);
        return view('account', compact('user', 'profile_photo', 'cover_photo', 'recipes','followers','followings'));
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

        return $cover_photo->photo_name;}
}

