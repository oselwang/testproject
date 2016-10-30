<?php

namespace App\Eatnshare\Services;


use Illuminate\Http\Request;
use App\Notification;

Class NotificationService{
    /**
     * @var Request
     */
    private $request;
    /**
     * @var Notification
     */
    private $notification;

    /**
     * NotificationService constructor.
     * @param Request $request
     * @param Notification $notification
     */
    public function __construct(Request $request,Notification $notification)
    {

        $this->request = $request;
        $this->notification = $notification;
    }

    public function checkNotification()
    {
        $notification_id = $this->request->query->get('notification_id');
        if ( !empty($notification_id) ) {
            $notification_id = intval($notification_id);
            $notification = $this->notification->where('id', $notification_id)->first();
            !empty($notification) ? $notification->status = 'read' : null;
            !empty($notification) ?$notification->save() : null;
        }

        return true;
    }
}