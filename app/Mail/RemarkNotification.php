<?php

namespace App\Mail;

use App\Models\Entrepreneur;
use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Mail\Mailable;
use Illuminate\Mail\Mailables\Content;
use Illuminate\Mail\Mailables\Envelope;
use Illuminate\Queue\SerializesModels;

class RemarkNotification extends Mailable
{
    use Queueable, SerializesModels;
    public $entrepreneur;
    public $remarkData;

    /**
     * Create a new message instance.
     *
     * @return void
     */
    public function __construct(Entrepreneur $entrepreneur, array $remarkData)
    {
        $this->entrepreneur = $entrepreneur;
        $this->remarkData = $remarkData;
    }

    /**
     * Get the message envelope.
     *
     * @return \Illuminate\Mail\Mailables\Envelope
     */
    public function envelope()
    {
        return new Envelope(
            subject: 'Remark on Your Entrepreneurial Idea',
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
            view: 'emails.remark_notification',
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
}