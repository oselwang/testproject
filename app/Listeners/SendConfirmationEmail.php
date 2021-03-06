<?php

namespace App\Listeners;

use App\Events\UserHasRegistered;
use Illuminate\Mail\Mailer;
use Illuminate\Queue\InteractsWithQueue;
use Illuminate\Contracts\Queue\ShouldQueue;

class SendConfirmationEmail
{

    protected $mailer;

    /**
     * Create the event listener.
     *
     * @param $mailer
     */
    public function __construct(Mailer $mailer)
    {
        $this->mailer = $mailer;
    }

    /**
     * Handle the event.
     *
     * @param  UserHasRegistered $event
     * @return void
     */
    public function handle(UserHasRegistered $event)
    {
        $user = $event->user['attributes'];

        $data = [
            'email' => $user['email'],
            'token' => $user['token']
        ];

        $this->mailer->queue('email.confirmation', $data, function ($message) use ($data) {
            $message->to($data['email'])
                ->subject('Confirmation Email');
        }, 'Email');

    }
}
