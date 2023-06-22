<?php

namespace App\Mail;

use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Mail\Mailable;
use Illuminate\Queue\SerializesModels;

class LoginLinkMail extends Mailable
{
    use Queueable, SerializesModels;

    /**
     * Create a new message instance.
     *
     * @return void
     */
      public $user;
    public $loginLink;

    public function __construct($data)
    {
        $this->user = $data['user'];
        $this->loginLink = $data['loginLink'];
        
    }

    public function build()
    {
        return $this->view('emails.login-link');
    }
}
