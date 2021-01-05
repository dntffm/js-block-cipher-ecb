<?php

namespace App\Mail;

use Illuminate\Bus\Queueable;
use Illuminate\Mail\Mailable;
use Illuminate\Queue\SerializesModels;
use Illuminate\Contracts\Queue\ShouldQueue;
use App\User; 
class Email extends Mailable
{
    use Queueable, SerializesModels;
    public $user;
    /**
     * Create a new message instance.
     *
     * @return void
     */
    public function __construct()
    {
        //
    }

    /**
     * Build the message.
     *
     * @return $this
     */
    public function build()
    {
        // $data= array('name'=>'clean', 'body'=>'test'){
        //     Mail::send('emails.auth.email', $data, function($message){
                
        //     });
        // }
        return $this->subject('forget password')markdown('emails.auth.email')->with('user', $this->user);
    }
}
