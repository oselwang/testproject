<?php

namespace App\Events;

use Illuminate\Queue\SerializesModels;

class UserForgotPassword extends Event
{
    use SerializesModels;

    public $user;

    /**
     * Create a new event instance.
     * @param $user
     */
    public function __construct($user)
    {
        $this->user = $user;
    }

    /**
     * Get the channels the event should be broadcast on.
     *
     * @return array
     */
    public function broadcastOn()
    {
        return [];
    }
}
