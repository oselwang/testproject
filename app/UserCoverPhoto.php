<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class CoverPhoto extends Model
{
    public function user()
    {
        return $this->belongsTo(User::class);
    }
}
