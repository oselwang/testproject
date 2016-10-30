<?php

namespace App\Http\Controllers;

use App\Eatnshare\Request\AddRecipeForm;
use App\Eatnshare\Request\AddReviewForm;
use App\Eatnshare\Request\EditReviewForm;
use App\Eatnshare\Request\FollowUserForm;
use App\Eatnshare\Request\RegisterPostForm;
use App\Eatnshare\Services\AccountService;
use App\Eatnshare\Services\UserService;
use App\Events\UserForgotPassword;
use App\Events\UserHasRegistered;
use App\Follow;
use App\Http\Requests;
use App\Notification;
use App\Review;
use App\ReviewUserHelpful;
use App\User;
use Carbon\Carbon;
use Auth;
use Illuminate\Http\Request;

class AjaxController extends Controller
{

    protected $request;
    protected $user;
    protected $user_service;
    protected $notification;
    protected $review;
    protected $review_user_helpful;
    /**
     * @var Follow
     */
    private $follow;
    /**
     * @var AccountService
     */
    private $accountService;

    /**
     * AjaxController constructor.
     * @param Request $request
     * @param User $user
     * @param UserService $user_service
     * @param Notification $notification
     * @param Review $review
     * @param ReviewUserHelpful $reviewUserHelpful
     * @param Follow $follow
     * @param AccountService $accountService
     */
    public function __construct(Request $request, User $user, UserService $user_service,
                                Notification $notification, Review $review, ReviewUserHelpful $reviewUserHelpful,
                                Follow $follow,AccountService $accountService)
    {
        $this->request = $request;
        $this->user = $user;
        $this->user_service = $user_service;
        $this->notification = $notification;
        $this->review = $review;
        $this->review_user_helpful = $reviewUserHelpful;

        $this->follow = $follow;
        $this->accountService = $accountService;
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

        flash('You need to verify your email address');

        return response()->json('success');
    }

    public function postLogin()
    {
        $credentials = [
            'username' => $this->request->get('username'),
            'password' => $this->request->get('password')
        ];

        if (Auth::attempt($credentials)) {
            flash("Welcome back, You're now logged in");

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

    public function addRecipe(AddRecipeForm $recipeForm)
    {
        $this->middleware('auth');
        $recipeForm->create();
        flash('Your recipe successfully created, edit it in your recipe menu');

        return response()->json('success');
    }

    public function suggestSearch()
    {
        $client = \Elasticsearch\ClientBuilder::create()
            ->setHosts(['http://localhost:9200'])
            ->build();
        $search = $this->request->get('search');

        $params = [
            'index' => 'recipe',
            'type' => 'recipe',
            'from' => 0,
            'size' => 3,
            'body' => [
                'query' => [
                    'bool' => [
                        'must' => [
                            'multi_match' => [
                                'query' => $search,

                                'fields' => [
                                    'name^2'
                                ]
                            ]
                        ]
                    ]
                ]
            ]
        ];

        $data = $client->search($params);
        if ($this->request->get('search') == '') {
            return response()->json('');
        }

        if ($data['hits']['total'] >= 1) {
            return response()->json($data['hits']['hits']);
        } else {
            return $this->request->get('search');
        }

    }

    public function changeProfilePhoto()
    {

        $profilephoto = $this->request->file('profilephoto');

        $this->user_service->changeProfilePhoto($profilephoto);

        flash('Profile Photo successfully changed');

        return response()->json('success');

    }

    public function changeCoverPhoto()
    {
        $cover_photo = $this->request->file('coverphoto');

        $this->user_service->changeCoverPhoto($cover_photo);

        flash('Cover Photo sucessfully changed');

        return response()->json('success');
    }

    public function addReview(AddReviewForm $reviewForm)
    {
        $this->middleware('auth');
        $reviewForm->create();
        flash('Your review successfully added');

        return response()->json('success');
    }

    public function editReview(EditReviewForm $editReviewForm)
    {
        $this->middleware('auth');
        $editReviewForm->edit();
        flash('Your review successfully edited');

        return response()->json('success');
    }

    public function getNotification()
    {
        $notifications = Auth::user()->notification()
            ->orderBy('created_at', 'desc')
            ->get(['url', 'id', 'message']);

        foreach($notifications as $notification){
            $notification->viewed = true;
            $notification->save();
        }

        return response()->json($notifications);
    }

    public function helpfulReview()
    {
        $review_id = $this->request->query->get('review_id');
        $review = $this->review->where('id', intval($review_id))->first();

        if ($review->isAlreadyLiked($review_id)) {
            $review->subHelpfulReview();
        } else {
            $review->addHelpfulReview();
        }

        return response()->json($review->helpful);
    }

    /**
     * @param FollowUserForm $followUserForm
     * @return \Illuminate\Http\JsonResponse status
     */
    public function followUser(FollowUserForm $followUserForm)
    {
        $follow = $followUserForm->create();

        return response()->json($follow);
    }

    public function getFollower($username){
        $data = ['id','firstname','lastname'];
        $user = is_integer(intval($username)) ? $this->user->where('facebook_id',$username)->first($data) : $this->user->where('username',$username)->first($data);
        $followers = $this->follow->where('user_id',$user->id)->get(['follower_id']);
        $user_followers = $this->accountService->getFollower($followers);

        return response()->json($user_followers);
    }

    public function getFollowing($username){
        $data = ['id','firstname','lastname'];
        $user = is_integer(intval($username)) ? $this->user->where('facebook_id',$username)->first($data) : $this->user->where('username',$username)->first($data);
        $followings = $this->follow->where('follower_id',$user->id)->get(['user_id']);
        $user_followings = $this->accountService->getFollowing($followings);

        return response()->json($user_followings);
    }

    public function searchIngredient()
    {
        $client = \Elasticsearch\ClientBuilder::create()
            ->setHosts(['http://localhost:9200'])
            ->build();
        $ingredient = $this->request->get('ingredient');

        $params = [
            'index' => 'ingredient',
            'type' => 'ingredient',
            'from' => 0,
            'size' => 6,
            'body' => [
                'query' => [
                    'bool' => [
                        'must' => [
                            'multi_match' => [
                                'query' => $ingredient,

                                'fields' => [
                                    'name^2'
                                ]
                            ]
                        ]
                    ]
                ]
            ]
        ];

        $data = $client->search($params);
        if ($this->request->get('ingredient') == '') {
            return response()->json('');
        }

        if ($data['hits']['total'] >= 1) {
            return response()->json($data['hits']['hits']);
        } else {
            return $this->request->get('search');
        }

    }

    public function finishBuyIngredient(){
        $ingredient_name = $this->request->get('ingredient');
        $amount = $this->request->get('amount');

        return response()->json($amount);
    }
}
