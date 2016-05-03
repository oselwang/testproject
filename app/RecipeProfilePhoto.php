<?php

    namespace App;

    use Illuminate\Database\Eloquent\Model;

    class RecipeProfilePhoto extends Model
    {
        protected $fillable = ['recipe_id', 'photo_name'];

        protected $table = 'recipeprofilephotos';

        public function recipe()
        {
            return $this->belongsTo(Recipe::class);
        }
    }
