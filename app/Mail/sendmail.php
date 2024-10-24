<?php

namespace App\Mail;

use App\Models\AdoptionApplication;
use App\Models\Pet;
use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Mail\Mailable;
use Illuminate\Mail\Mailables\Content;
use Illuminate\Mail\Mailables\Envelope;
use Illuminate\Queue\SerializesModels;

class sendmail extends Mailable
{
    use Queueable, SerializesModels;

    public $adoptionApplication;
    /**
     * Create a new message instance.
     */
    public function __construct(AdoptionApplication $adoptionApplication)
    {
        $this->adoptionApplication = $adoptionApplication; // Make sure to assign this
    }

    /**
     * Get the message envelope.
     */
    public function envelope(): Envelope
    {
        return new Envelope(
            subject: 'Sendmail',
            from: 'kumarasirirandika0706@gmail.com'
        );
    }

    /**
     * Get the message content definition.
     */
    public function content(): Content
    {
        dd("send");
//        return new Content(
//            view: 'mail.sendmail',
//        );
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
