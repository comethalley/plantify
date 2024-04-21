<?php

namespace App\Mail;

use Illuminate\Bus\Queueable;
use Illuminate\Mail\Mailable;
use Illuminate\Queue\SerializesModels;

class StatusUpdateNotification extends Mailable
{
    use Queueable, SerializesModels;

    public $farmId;
    public $newStatus;

    /**
     * Create a new message instance.
     *
     * @return void
     */
    public function __construct($farmId, $newStatus)
    {
        $this->farmId = $farmId;
        $this->newStatus = $newStatus;
    }

    /**
     * Build the message.
     *
     * @return $this
     */
    public function build()
    {
        return $this->subject('Farm Status Update Notification')
                    ->view('emails.status_update_notification');
    }
}


