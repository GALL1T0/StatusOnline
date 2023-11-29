<?php

namespace App\Mail;

use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Mail\Mailable;
use Illuminate\Mail\Mailables\Content;
use Illuminate\Mail\Mailables\Envelope;
use Illuminate\Queue\SerializesModels;

class StatusMail extends Mailable
{
    use Queueable, SerializesModels;
    public $nombre;
    public $estatus;
    public $reparador;
    public $comentario;
    public $fecha;
    

    /**
     * Create a new message instance.
     */
    public function __construct($nombre, $estatus, $reparador, $comentario, $fecha)
    {
        $this->nombre = $nombre;
        $this->estatus = $estatus;
        $this->reparador = $reparador;
        $this->comentario = $comentario;
        $this->fecha = $fecha;
    }


    /**
     * Get the message envelope.
     */
    public function envelope(): Envelope
    {
        return new Envelope(
            subject: '¡Cambio de Status!',
        );
    }

    /**
     * Get the message content definition.
     */
    public function content(): Content
    {
        return new Content(
            view: 'email.modificacion',
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
