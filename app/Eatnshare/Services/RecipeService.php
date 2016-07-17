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

    public function checkNotification()
    {
        $notification_id = $this->request->query->get('notification_id');
        if ( !empty($notification_id) ) {
            $notification_id = intval($notification_id);
            $notification = $this->notification->where('id', $notification_id)->first();
            $notification->status = 'read';
            $notification->save();
        }
        
        return true;
    }
}