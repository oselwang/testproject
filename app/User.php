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
            'firstname', 'lastname', 'email', 'password', 'phone', 'gender', 'username', 'confirmed', 'token'
        ];

        /**
         * The attributes that should be hidden for arrays.
         *
         * @var array
         */
        protected $hidden = [
            'password', 'remember_token',
        ];
        
        public function present(){
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
    }
