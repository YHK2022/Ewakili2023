<?php
namespace App\Mail;
use Illuminate\Bus\Queueable;
use Illuminate\Mail\Mailable;
use Illuminate\Queue\SerializesModels;
use Illuminate\Contracts\Queue\ShouldQueue;
class VerifyFirm extends Mailable
{
  use Queueable, SerializesModels;
  
  public $confirmation;
  
  /**
     * Create a new message instance.
     *
     * @return void
     */
    public function __construct($confirmation)
    {
        $this->confirmation = $confirmation;
    }
  /**
  * Build the message.
  *
  * @return $this
  */
  public function build()
  {
    return $this->view('emails.verifyFirm');
  }
}