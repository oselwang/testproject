<?php

    namespace App;

    use Illuminate\Database\Eloquent\Model;

    class Review extends Model
    {
        protected $table = 'reviews';

        protected $fillable = ['recipe_id', 'user_id', 'rating', 'review'];

        public function recipe()
        {
            return $this->belongsTo(Recipe::class);
        }

        public function user()
        {
            return $this->belongsTo(User::class);
        }

        public function getUserFullName(){
            $user = $this->user()->first();
            
            return $user->present()->fullname;
        }
        
        public function getUserProfilePhoto(){
            $user = $this->user()->first();
            
            return $user->getProfilePhoto();
        }
    }
