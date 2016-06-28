<?php

    namespace App;

    use Illuminate\Database\Eloquent\Model;
    use Illuminate\Foundation\Auth\User;

    class Notification extends Model
    {
        protected $fillable = ['user_id', 'url', 'message'];

        protected $table = 'notifications';

        public function user()
        {
            return $this->belongsTo(User::class);
        }
    }
