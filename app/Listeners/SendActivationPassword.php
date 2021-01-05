<?php

namespace App\Listeners;
use App\User;
use App\Events\ForgotActivationEmail;
use Illuminate\Queue\InteractsWithQueue;
use Illuminate\Contracts\Queue\ShouldQueue;
use App\Mail\ForgotEmail;
use Redirect,Response,DB,Config;
use Mail;
class SendActivationPassword
{
    /**
     * Create the event listener.
     *
     * @return void
     */
    public function __construct()
    {
        //
    }

    /**
     * Handle the event.
     *
     * @param  ForgotActivationEmail  $event
     * @return void
     */
    public function handle(ForgotActivationEmail $event)
    {
        

        $event->user;
        Mail::to($event->user->email)->send(new ForgotEmail($event->user));    }
}
