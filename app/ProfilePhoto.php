<?php

    namespace App;

    use Illuminate\Database\Eloquent\Model;

    class ProfilePhoto extends Model
    {
        protected $fillable = ['user_id', 'photo_name'];
        protected $table = 'profilephotos';

        public function user()
        {
            return $this->belongsTo(User::class);
        }
    
    }
