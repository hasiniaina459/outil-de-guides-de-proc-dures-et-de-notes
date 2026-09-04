<?php

namespace App\Mail;

use App\Models\note;
use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Mail\Mailable;
use Illuminate\Queue\SerializesModels;

class NewNoteNotification extends Mailable implements ShouldQueue
{
    use Queueable, SerializesModels;

    public note $note;

    public function __construct(note $note)
    {
        $this->note = $note;
    }

    public function build()
    {
        return $this->subject('Nouvelle note: ' . $this->note->note_title)
            ->view('emails.new-note');
    }
}