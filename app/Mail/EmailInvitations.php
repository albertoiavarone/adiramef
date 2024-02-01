<?php

namespace App\Mail;

use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Mail\Mailable;
use Illuminate\Queue\SerializesModels;

class EmailInvitations extends Mailable
{
    use Queueable, SerializesModels;

    public $data;

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
        $name = config('values.APP_NAME');
        return $this->view('emails.invitations')
            ->from($this->data['address'], $name)
            //->cc($address, $name)
            //->bcc($address, $name)
            ->replyTo($this->data['address'], $name)
            ->subject($this->data['subject'])
            ->with([
                'link_accept' => $this->data['link_accept'] ,
                'link_deny' => $this->data['link_deny'],
                'inviter' => $this->data['inviter'],
                'locale' => $this->data['locale']
        ]);
    }
}
