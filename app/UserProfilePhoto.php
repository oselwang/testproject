<?php

    namespace App;

    use Illuminate\Database\Eloquent\Model;

    class ProfilePhoto extends Model
    {
        public function user()
        {
            return $this->belongsTo(User::class);
        }
    }
