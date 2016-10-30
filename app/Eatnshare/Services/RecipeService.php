<?php

namespace App\Eatnshare\Services;

use App\Notification;
use Illuminate\Http\Request;
class RecipeService
{
    private $request;
    private $notification;

    public function __construct(Request $request,Notification $notification)
    {
        $this->notification = $notification;
        $this->request = $request;
    }

}