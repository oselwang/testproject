<?php

    namespace App\Eatnshare\Services;


    use App\Eatnshare\Repositories\UserRepository;

    class UserService
    {
        protected $user_repository;

        public function __construct(UserRepository $user_repository)
        {
            $this->user_repository = $user_repository;
        }

        public function changeProfilePhoto()
        {
            return  $this->user_repository->changeProfilePhoto();
        }

    }