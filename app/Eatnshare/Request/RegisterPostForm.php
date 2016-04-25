<?php
/**
 * Created by PhpStorm.
 * User: oselwang
 * Date: 4/24/16
 * Time: 2:07 AM
 */

namespace App\Eatnshare\Request;


use App\User;

class RegisterPostForm extends Form
{
    protected $rules = [
        'username' => 'required|min:8|unique:users',
        'firstname' => 'required',
        'lastname' => 'required',
        'password' => 'required|min:8|alpha_num|confirmed',
        'phone' => 'numeric',
        'email' => 'email|unique:users'
    ];

    public function create()
    {
        $user = New User;
        if ($this->isValid()) {
            
            $user_registered = $user->create([
                'firstname' => $this->fields('firstname'),
                'lastname' => $this->fields('lastname'),
                'email' => $this->fields('email'),
                'username' => $this->fields('username'),
                'password' => bcrypt($this->fields('password')),
                'phone' => $this->fields('phone'),
                'gender' => $this->fields('gender'),
                'confirmed' => false,
                'token' => $this->fields('_token')
            ]);

            return $user_registered;
            
        } else return false;


    }
}