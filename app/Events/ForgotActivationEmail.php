<?php

namespace App\Events;



use Illuminate\Foundation\Events\Dispatchable;
use App\User;
use Illuminate\Queue\SerializesModels;

class ForgotActivationEmail
{
    use Dispatchable,  SerializesModels;
    public $user;

    /**
     * Create a new event instance.
     *
     * @return void
     */
    public function __construct(User $user)
    {
        $this->user=$user;
    }
}
