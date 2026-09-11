<?php

namespace App\Mail;

use App\Models\individu;
use App\Models\note;
use App\Models\rappel;
use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Mail\Mailable;
use Illuminate\Mail\Mailables\Attachment;
use Illuminate\Mail\Mailables\Content;
use Illuminate\Mail\Mailables\Envelope;
use Illuminate\Queue\SerializesModels;

class RappelNotification extends Mailable implements ShouldQueue
{
    use Queueable, SerializesModels;
    public rappel $rappel;
    public individu $individu;
    /**create a new message instance.
     */
    public function __construct(rappel $rappel,individu $individu)
    {
        $this->rappel=$rappel;
        $this->individu=$individu;
    }

    /**
     * Get the message envelope.
     */
    public function envelope(): Envelope
    {
        return new Envelope(
            subject: 'Rappel Notification' . $this->rappel->remind_title,
        );
    }

    /**
     * Get the message content definition.
     */
    public function content(): Content
    {
        return new Content(
            view: 'emails.rappel',
        );
    }

    /**
     * Get the attachments for the message.
     *
     * @return array<int, Attachment>
     */
    public function attachments(): array
    {
        return [];
    }
}
