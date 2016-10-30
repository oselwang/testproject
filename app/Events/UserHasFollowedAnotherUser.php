<?php

namespace App\Events;

use App\Events\Event;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Queue\SerializesModels;
use Illuminate\Contracts\Broadcasting\ShouldBroadcast;

class UserHasFollowedAnotherUser extends Event implements ShouldBroadcast,ShouldQueue
{
    use SerializesModels;

    public $name;
    public $user_id;
    public $notification_url;
    public $notification_id;
    public $notification_status;

    /**
     * Create a new event instance.
     * @param $name
     * @param $user_id
     * @param $notification_url
     * @param $notification_id
     * @param $notification_status
     * @return void
     */
    public function __construct($name,$user_id,$notification_url,$notification_id,$notification_status)
    {
        $this->name = $name;
        $this->user_id = $user_id;
        $this->notification_url = $notification_url;
        $this->notification_id = $notification_id;
        $this->notification_status = $notification_status;
    }

    /**
     * Get the channels the event should be broadcast on.
     *
     * @return array
     */
    public function broadcastOn()
    {
        return ['follow-channel'];
    }
}
