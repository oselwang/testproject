<?php

namespace App\Eatnshare\Services;

use App\Follow;
use App\User;
use Auth;

Class AccountService{
    /**
     * @var User
     */
    private $user;
    /**
     * @var Follow
     */
    private $follow;


    /**
     * AccountService constructor.
     * @param User $user
     * @param Follow $follow
     */
    public function __construct(User $user,Follow $follow)
    {
        $this->user = $user;
        $this->follow = $follow;
    }

    public function getFollower($followers){
        $item = [];
        foreach ($followers as $follower){
            $user_followers = $this->user->where('id',$follower->follower_id)->paginate(10);
            foreach ($user_followers as $user_follower){
                $check_follow = $this->follow->where(function ($query) use ($user_follower){
                   $query->where('user_id',$user_follower->id);
                    $query->where('follower_id',Auth::id());
                })->first();
                $array['id'] = $user_follower->id;
                $array['username'] = empty($user_follower->facebook_id) ? $user_follower->username : $user_follower->facebook_id;
                $array['name'] = $user_follower->present()->fullname;
                $array['last_page'] = $user_followers->lastPage();
                $array['current_page'] = $user_followers->currentPage();
                $array['followed_by_viewer'] = empty($check_follow) ? false : true;
                $array['viewer'] = $user_follower->id != Auth::id() ? false : true;
                $item[] = $array;
            }
        }

        return $item;
    }

    public function getFollowing($followings){
        $item = [];
        foreach ($followings as $following){
            $user_followings = $this->user->where('id',$following->user_id)->paginate(10);
            foreach ($user_followings as $user_following){
                $check_follow = $this->follow->where(function ($query) use ($user_following){
                    $query->where('user_id',$user_following->id);
                    $query->where('follower_id',Auth::id());
                })->first();
                $array['id'] = $user_following->id;
                $array['username'] = empty($user_following->facebook_id) ? $user_following->username : $user_following->facebook_id;
                $array['name'] = $user_following->present()->fullname;
                $array['last_page'] = $user_followings->lastPage();
                $array['current_page'] = $user_followings->currentPage();
                $array['followed_by_viewer'] = empty($check_follow) ? false : true;
                $array['viewer'] = $user_following->id != Auth::id() ? false : true;
                $item[] = $array;
            }
        }

        return $item;
    }
}