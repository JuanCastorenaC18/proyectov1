<?php

namespace App\Mail;

use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Mail\Mailable;
use Illuminate\Mail\Mailables\Content;
use Illuminate\Mail\Mailables\Envelope;
use Illuminate\Queue\SerializesModels;

class MailAlSuper extends Mailable
{
    use Queueable, SerializesModels;
    public $usuario;
    /**
     * Create a new message instance.
     */
    public function __construct(/*$usuario*/)
    {
        //$this->usuario = $usuario;
    }

    public function build()
    {
        return $this->subject('Prueba de correo')->view('emails.testcode')/*->with('usuario', $this->usuario)*/;
    }
    /**
     * Get the message envelope.
     */
    public function envelope(): Envelope
    {
        return new Envelope(
            subject: 'Mail Al Super',
        );
    }

    /**
     * Get the message content definition.
     */
    public function content(): Content
    {
        return new Content(
            view: 'emails.correoalsuper',
        );
    }

    /**
     * Get the attachments for the message.
     *
     * @return array<int, \Illuminate\Mail\Mailables\Attachment>
     */
    public function attachments(): array
    {
        return [];
    }
}
