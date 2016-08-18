<?php
    /**
     * Created by PhpStorm.
     * User: bahasolaptop2
     * Date: 25/05/16
     * Time: 16:21
     */

    namespace App\Eatnshare\Presenter;

    

    use App\User;

    Abstract class Presenter
    {
        protected $user;

        public function __construct(User $user)
        {
            $this->user = $user;
        }

        public function __get($property)
        {
            if ( method_exists($this, $property) ) {
                return call_user_func([ $this, $property ]);
            }
        }
    }