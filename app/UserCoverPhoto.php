<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class CoverPhoto extends Model
{

    protected $table = 'coverphotos';

    public function user()
    {
        return $this->belongsTo(User::class);
    }
}
