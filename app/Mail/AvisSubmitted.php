<?php

namespace App\Mail;

use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Mail\Mailable;
use App\Models\Avis;
use Illuminate\Mail\Mailables\Content;
use Illuminate\Mail\Mailables\Envelope;
use Illuminate\Queue\SerializesModels;

class AvisSubmitted extends Mailable
{
    use Queueable, SerializesModels;


    public $avis;
    /**
     * Create a new message instance.
     *
     * @return void
     */
    public function __construct(Avis $avis)
    {
        $this->avis = $avis->load('restaurant');
    }

    /**
     * Get the message envelope.
     *
     * @return \Illuminate\Mail\Mailables\Envelope
     */
    public function envelope()
    {
        return new Envelope(
            subject: 'Avis Submitted',
        );
    }

    /**
     * Get the message content definition.
     *
     * @return \Illuminate\Mail\Mailables\Content
     */
    public function content()
    {
        
            return new Content(
                view: 'emails.avis_submitted',
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

    public function build()
{
    return $this->subject("Nouvel avis soumis par " . $this->avis->nomClient)
                ->view('emails.avis_submitted')
                ->with([
                    'avis' => $this->avis,
                    'restaurantName' => $this->avis->restaurant ? $this->avis->restaurant->nom : 'Inconnu',
                ]);
}
}
