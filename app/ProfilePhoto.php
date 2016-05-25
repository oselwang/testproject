<?php

    namespace App;

    use Illuminate\Database\Eloquent\Model;

    class ProfilePhoto extends Model
    {

        protected $table = 'profilephotos';

        protected $fillable = ['user_id', 'photo_name'];

        public function user()
        {
            return $this->belongsTo(User::class);
        }
    }
