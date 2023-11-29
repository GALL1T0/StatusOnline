<?php

namespace App\Mail;

use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Mail\Mailable;
use Illuminate\Mail\Mailables\Content;
use Illuminate\Mail\Mailables\Envelope;
use Illuminate\Queue\SerializesModels;

class newReparacion extends Mailable
{
    use Queueable, SerializesModels;

    public $UUID;
    public $fecha;
    public $reparador;
    /**
     * Create a new message instance.
     */
    public function __construct( $UUID, $fecha, $reparador)
    {
        $this->UUID = $UUID;
        $this->fecha = $fecha;
        $this->reparador = $reparador;
    }

    /**
     * Get the message envelope.
     */
    public function envelope(): Envelope
    {
        return new Envelope(
            subject: 'Nueva Reparacion Asignada',
        );
    }

    /**
     * Get the message content definition.
     */
    public function content(): Content
    {
        return new Content(
            view: 'email.nuevo',
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
