<?php

namespace App;


use App\Eatnshare\Presenter\UserPresenter;
use Illuminate\Foundation\Auth\User as Authenticatable;

class User extends Authenticatable
{
    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'firstname', 'lastname', 'email', 'password', 'phone', 'gender', 'username', 'confirmed', 'token', 'facebook_id', 'google_id'
    ];

    /**
     * The attributes that should be hidden for arrays.
     *
     * @var array
     */
    protected $hidden = [
        'password', 'remember_token',
    ];

    public function present()
    {
        return new UserPresenter($this);
    }

    public function recipe()
    {
        return $this->hasMany(Recipe::class);
    }

    public function profilephoto()
    {
        return $this->hasOne(ProfilePhoto::class);
    }

    public function coverphoto()
    {
        return $this->hasOne(CoverPhoto::class);
    }
    
    public function notification(){
        return $this->hasMany(Notification::class);
    }

    public function own($property)
    {
        return $this->id == $property->user_id;
    }

    public function is($user){
        return $this->id == $user->id;
    }

    public function getProfilePhoto()
    {

        $profilephoto = $this->profilephoto()->first();

        if($profilephoto == null){
            return null;
        }

        return $profilephoto->photo_name;
    }
    
    public function submittedReviewOn($recipe){
        $review = $recipe->review()->where('user_id',$this->id)->first();
        if(!empty($review)){
            return true;
        }else{
            return false;
        }
    }
    
    public function getReviewOn($recipe){
        return $recipe->review()->where('user_id',$this->id)->first();
    }

    public function alreadyFollowed($user_id){
        $follow = Follow::where(function ($query) use ($user_id){
            $query->where('user_id',intval($user_id));
            $query->where('follower_id',\Auth::id());
        })->first(['user_id']);

        if(empty($follow)){
            return false;
        }else{
            return true;
        }
    }

}
