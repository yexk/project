<?php

namespace App\Mail;

use Illuminate\Bus\Queueable;
use Illuminate\Mail\Mailable;
use Illuminate\Queue\SerializesModels;

class SendMessage extends Mailable
{
    use Queueable, SerializesModels;

    public $request;
    public $subject;
    public $message;

    /**
     * Create a new message instance.
     *
     * @return void
     */
    public function __construct($request, $subject, $message)
    {
        $this->request = $request;
        $this->subject = $subject;
        $this->message = $message;
    }

    /**
     * Build the message.
     *
     * @return $this
     */
    public function build()
    {
        return $this->subject($this->subject)->markdown('back.email.sendmessage');
    }
}
