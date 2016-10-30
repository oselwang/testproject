<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Ingredient extends Model
{
    protected $fillable = ['recipe_id','name','unit'];
    
    protected $table = 'ingredients';
    
    public function recipe(){
        return $this->belongsToMany(Recipe::class);
    }
}
