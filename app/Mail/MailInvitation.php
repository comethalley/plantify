<?php

namespace App\Mail;

use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Mail\Mailable;
use Illuminate\Mail\PendingMail\Content;
use Illuminate\Mail\PendingMail\Envelope;
use Illuminate\Queue\SerializesModels;

class MailInvitation extends Mailable
{
    use Queueable, SerializesModels;

    public $data = [];

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
     * Get the message content definition.
     *
     * @return \Illuminate\Mail\PendingMail\Content
     */
    public function build()
    {
        return $this->view('email.email')->with("data", $this->data);
    }

    /**
     * Get the attachments for the message.
     *
     * @return array
     */
    public function attachments()
    {
        return [];
    }
}
