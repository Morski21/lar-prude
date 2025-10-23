<?php

namespace App\Mail;

use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Mail\Mailable;
use Illuminate\Mail\Mailables\Content;
use Illuminate\Mail\Mailables\Envelope;
use Illuminate\Queue\SerializesModels;
use App\Models\Doacao;

class DonationRescheduled extends Mailable
{
    use Queueable, SerializesModels;

    public $doacao;
    public $newDate;
    public $reason;

    /**
     * Create a new message instance.
     */
    public function __construct(Doacao $doacao, $newDate = null, $reason = null)
    {
        $this->doacao = $doacao;
        $this->newDate = $newDate;
        $this->reason = $reason;
    }

    /**
     * Get the message envelope.
     */
    public function envelope(): Envelope
    {
        return new Envelope(
            subject: 'Reagendamento da sua Doação - Lar dos Idosos',
        );
    }

    /**
     * Get the message content definition.
     */
    public function content(): Content
    {
        return new Content(
            view: 'emails.donation-rescheduled',
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
