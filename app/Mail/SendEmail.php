<?php

namespace App\Mail;

use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Mail\Mailable;
use Illuminate\Queue\SerializesModels;

class SendEmail extends Mailable
{
    use Queueable, SerializesModels;

    public $data;
    /**
     * Create a new message instance.
     *
     * @return void
     */
    public function __construct( $data)
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
        $name = config('values.APP_NAME');
        return $this->view('emails.standard_email')
            ->from($this->data['sender'], $name)
            //->cc($address, $name)
            //->bcc($address, $name)
            ->replyTo($this->data['sender'], $name)
            ->subject($this->data['subject'])
            ->with($this->data);

    }
}
