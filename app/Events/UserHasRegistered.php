<?php

namespace App\Events;

use Illuminate\Queue\SerializesModels;

class UserHasRegistered extends Event
{
    use SerializesModels;

    public $user;

    /**
     * Create a new event instance.
     *
     * @param $user
     */
    public function __construct($user)
    {
        $this->user = $user;
    }

}
