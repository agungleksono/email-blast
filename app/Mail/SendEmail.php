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
        $email = $this->subject($this->data['subject'])
                      ->view('emails');
        
        // Set dynamic sender email if provided
        if ($this->data['sender_mail'] && $this->data['sender_name']) {
            $email->from($this->data['sender_mail'], $this->data['sender_name']);
        } 
        // else {
        //     // Default sender email if no dynamic sender is provided
        //     $email->from(config('mail.from.address'), config('mail.from.name'));
        // }

        // $email->bcc($this->data['sender_mail']);

        return $email;
    }
}
