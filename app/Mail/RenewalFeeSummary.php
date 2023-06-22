<?php

namespace App\Mail;

use Illuminate\Bus\Queueable;
use Illuminate\Mail\Mailable;
use Illuminate\Queue\SerializesModels;

class RenewalFeeSummary extends Mailable
{
    use Queueable, SerializesModels;

    public $totalFee;
    public $profiles;

    /**
     * Create a new message instance.
     *
     * @return void
     */
    public function __construct($data)
    {
        $this->data = $data;
    }

    /**
     * Build the message.
     *
     * @return $this
     */
    public function build()
    {

        $subject = 'Fee Summary';
        $total_all_fees = $this->data['total_all_fees'];
        $profile_fees = $this->data['profile_fees'];
        $control_number = $this->data['control_number'];

        return $this->view('emails.renewalFeeSummary')->subject($subject)->with(compact('total_all_fees', 'profile_fees', 'control_number'));

    }
}
