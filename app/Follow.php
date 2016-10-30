<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Auth;

class Follow extends Model
{
    protected $fillable = ['user_id','follower_id'];

    protected $table = 'follows';


    public function addFollower($user_id){
        return Follow::create([
            'user_id' => $user_id,
            'follower_id' => Auth::id()
        ]);
    }

    public function removeFollower($user_id){
        $follow = Follow::where(function ($query) use ($user_id){
           $query->where('user_id',$user_id);
            $query->where('follower_id',Auth::id());
        })->delete();

        return $follow;
    }
}
