<?php

    namespace App;

    use Illuminate\Database\Eloquent\Model;

    class Recipe extends Model
    {

        protected $fillable = ['user_id', 'description','name', 'portion', 'difficulty', 'duration', 'preparation','rating'];

        protected $table = 'recipes';

        public function user()
        {
            return $this->belongsTo(User::class);
        }

        public function categories()
        {
            return $this->belongsToMany(RecipeCategory::class);
        }

        public function ingredient()
        {
            return $this->hasMany(Ingredient::class);
        }

        public function profilephoto()
        {
            return $this->hasOne(RecipeProfilePhoto::class);
        }

        public function coverphoto()
        {
            return $this->hasOne(RecipeCoverPhoto::class);
        }

        public function photo()
        {
            return $this->hasMany(RecipePhoto::class);
        }
        
        public function getProfilePhoto(){
            $profile_photo = $this->profilephoto()->first();
            
            return $profile_photo->photo_name;
        }
    }
