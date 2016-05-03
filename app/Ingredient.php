<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Ingredient extends Model
{
    protected $fillable = ['recipe_id','ingredient_name','amount'];
    
    protected $table = 'ingredients';
    
    public function recipe(){
        return $this->belongsTo(Recipe::class);
    }
}
