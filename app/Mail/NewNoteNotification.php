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
use Illuminate\Support\Facades\URL;

class NewNoteNotification extends Mailable implements ShouldQueue
{
    use Queueable, SerializesModels;

    public note $note;
    public individu $individu;
    public string $trackUrl;
    public string $confirmUrl;

    public function __construct(note $note,individu $individu)
    {
        $this->note = $note;
        $this->individu = $individu;

        $this->trackUrl = URL::signedRoute('notes.track',[
            'note'=>$note->id_note,
            'individu'=>$individu->id_individu,
            ]);
        
        $this->confirmUrl = URL::signedRoute('notes.track',[
            'note'=>$note->id_note,
            'individu'=>$individu->id_individu,
            'confirm'=>1,
        ]);
    }

    /**
     * Get the message envelope.
     */
    public function envelope(): Envelope
    {
        return new Envelope(
            subject: 'Nouvelle note : ' . $this->note->note_title,
        );
    }

    /**
     * Get the message content definition.
     */
    public function content(): Content
    {
        return new Content(
            markdown: 'emails.new-note',
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