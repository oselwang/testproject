<?php

    namespace App;

    use Illuminate\Database\Eloquent\Model;

    class RecipeCategory extends Model
    {
        
        protected $fillable = ['photo_name'];
        
        protected $table = 'recipecategories';
        
        public function recipes()
        {
            return $this->belongsToMany(Recipe::class);
        }
    }
