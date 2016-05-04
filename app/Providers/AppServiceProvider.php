<?php

namespace App\Providers;

use App\Eatnshare\Interfaces\ChangeAblePhoto;
use App\Eatnshare\Repositories\UserRepository;
use App\Eatnshare\Services\UserService;
use Illuminate\Support\ServiceProvider;


class AppServiceProvider extends ServiceProvider
{
    /**
     * Bootstrap any application services.
     *
     * @return void
     */
    public function boot()
    {
        $this->app->bind(UserService::class,function(){
            return new UserService(
              new UserRepository()  
            );
        });
    }

    /**
     * Register any application services.
     *
     * @return void
     */
    public function register()
    {
        
    }
}
