<?php

namespace App\Listeners;

use App\Events\UserForgotPassword;
use Illuminate\Mail\Mailer;
use Illuminate\Queue\InteractsWithQueue;
use Illuminate\Contracts\Queue\ShouldQueue;

class SendNewPassword
{

    protected $mailer;
    /**
     * Create the event listener.
     * @param $mailer
     */
    public function __construct(Mailer $mailer)
    {
        $this->mailer = $mailer;
    }

    /**
     * Handle the event.
     *
     * @param  UserForgotPassword  $event
     * @return string
     */
    public function handle(UserForgotPassword $event)
    {
        $user = $event->user['attributes'];
        
        $data = [
            'password' => str_random(7),
            'email' => $user['email']
        ];

        $this->mailer->queue('email.newpassword', $data, function ($message) use ($data) {
            $message->to($data['email'])
                ->subject('Confirmation Email');
        }, 'Email');
        
        return $data['password'];
    }
}
