<?php

    namespace App;

    use Illuminate\Database\Eloquent\Model;

    class CoverPhoto extends Model
    {
        protected $fillable = ['user_id', 'photo_name'];
        protected $table = 'coverphotos';

        public function user()
        {
            return $this->belongsTo(User::class);
        }
    }
