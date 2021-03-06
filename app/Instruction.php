<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Instruction extends Model
{
    protected $fillable = ['recipe_id','body'];

    protected $table = 'instructions';

    public function recipe(){
        return $this->belongsTo(Recipe::class);
    }
}
