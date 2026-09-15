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

class RappelNotification extends Mailable implements ShouldQueue
{
    use Queueable, SerializesModels;
    public rappel $rappel;
    public individu $individu;
    public string $trackUrl;
    public string $noteUrl;
    /**create a new message instance.
     */
    public function __construct(rappel $rappel,individu $individu)
    {
        $this->rappel=$rappel;
        $this->individu=$individu;
        $this->trackUrl =  URL::signedRoute('notes.track',[
            'note'=>$rappel->notes->id_note,
            'individu'=>$individu->id_individu,
        ]);

        $this->noteUrl = route('notes.show',$rappel->notes->id_note);
    }

    /**
     * Get the message envelope.
     */
    public function envelope(): Envelope
    {
        return new Envelope(
            subject: 'Rappel : ' . $this->rappel->remind_title,
        );
    }

    /**
     * Get the message content definition.
     */
    public function content(): Content
    {
        return new Content(
            markdown: 'emails.rappel',
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
