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

    public function ownRecipe($recipe)
    {
        return $this->id == $recipe->user_id;
    }

    public function getProfilePhoto()
    {

        $profilephoto = $this->profilephoto()->first();

        if($profilephoto == null){
            return null;
        }

        return $profilephoto->photo_name;
    }

}
