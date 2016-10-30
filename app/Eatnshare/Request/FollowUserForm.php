<?php

namespace App\Eatnshare\Request;


use App\Eatnshare\Traits\NotificationTraits;
use App\Events\UserHasFollowedAnotherUser;
use App\Follow;
use Auth;

Class FollowUserForm extends Form{

    use NotificationTraits;

    function create()
    {
        $follow = new Follow();

        $user_id = $this->fields('user_id');
        if(Auth::user()->alreadyFollowed($user_id)){
            $follow->removeFollower($user_id);
            $status = 'Follow';
        }else{
            $follow = $follow->addFollower($user_id);
            $notification = $this->addNotification($follow);
            event(new UserHasFollowedAnotherUser(Auth::user()->present()->fullname,$notification->user_id,
                $notification->url,$notification->id,$notification->status));
            $status = 'Following';
        }

        return $status;
    }
}