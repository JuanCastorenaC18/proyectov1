<?php

namespace App\Mail;

use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Mail\Mailable;
use Illuminate\Mail\Mailables\Content;
use Illuminate\Mail\Mailables\Envelope;
use Illuminate\Queue\SerializesModels;

class Mailtokensupervisor extends Mailable
{
    use Queueable, SerializesModels;
    /**
     * Create a new message instance.
     *
     *  
     * @param  String  $mail
     * @param  String $code
     * 
     * @return void
     */
    public $token;
    public function __construct(String $token)
    {
        $this->token = $token;
    }

    /**
     * Get the message envelope.
     *
     * @return \Illuminate\Mail\Mailables\Envelope
     */
    public function envelope()
    {
        return new Envelope();
    }

    /**
     * Get the message content definition.
     *
     * @return \Illuminate\Mail\Mailables\Content
     */
    public function build()
    {
        return $this->subject('Token para permisos Supervisor')->view('emails.testtokensuper')->with($this->token);
    }
    public function content()
    {
        return new Content(
            view: 'emails.testtokensuper',
        );
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
