<?php

namespace App\Events;

use App\Events\Event;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Queue\SerializesModels;
use Illuminate\Contracts\Broadcasting\ShouldBroadcast;

class UserFindedReviewHelpful extends Event implements ShouldBroadcast, ShouldQueue
{
    use SerializesModels;

    public $name;
    public $user_id;
    public $notification_url;
    public $notification_id;
    public $notification_status;
    
    /**
     * Create a new event instance.
     *
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
        return ['review-helpful-channel'];
    }
}
