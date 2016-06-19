<?php
    /**
     * Created by PhpStorm.
     * User: bahasolaptop2
     * Date: 25/05/16
     * Time: 16:22
     */

    namespace App\Eatnshare\Presenter;

    use Auth;

    class UserPresenter extends Presenter
    {
        public function welcomeMessage()
        {
            return sprintf('Welcome, %s %s', ucfirst(Auth::user()->firstname), ucfirst(Auth::user()->lastname));
        }

        public function fullname(){
            return ucfirst($this->user->firstname) . ' ' . ucfirst($this->user->lastname);
        }
        
        public function accountname(){
            $account_name = $this->user->username != null ? $this->user->username : $this->user->facebook_id;
            return $account_name;
        }

    }