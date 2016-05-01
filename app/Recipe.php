<?php

    namespace App;

    use Illuminate\Database\Eloquent\Model;

    class Recipe extends Model
    {
        public function user()
        {
            return $this->belongsTo(User::class);
        }

        public function categories()
        {
            return $this->belongsToMany(RecipeCategory::class);
        }
    }
