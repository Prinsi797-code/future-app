<?php

namespace App\Mail;

use App\Models\Entrepreneur;
use App\Models\EntrepreneurCompany;
use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Mail\Mailable;
use Illuminate\Mail\Mailables\Content;
use Illuminate\Mail\Mailables\Envelope;
use Illuminate\Queue\SerializesModels;

class NewCompanyNotification extends Mailable
{
    use Queueable, SerializesModels;

    public $company;
    public $entrepreneur;

    /**
     * Create a new message instance.
     *
     * @return void
     */
    public function __construct(EntrepreneurCompany $company, Entrepreneur $entrepreneur)
    {
        $this->company = $company;
        $this->entrepreneur = $entrepreneur;

    }

    /**
     * Get the message envelope.
     *
     * @return \Illuminate\Mail\Mailables\Envelope
     */
    public function envelope()
    {
        return new Envelope(
            subject: 'New Company Added - ' . $this->company->company_name,
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
            view: 'emails.new-company-notification',
            with: [
                'companyName' => $this->company->company_name,
                'marketCapital' => $this->company->more_market_capital,
                'yourStake' => $this->company->more_your_stake,
                'stakeFunding' => $this->company->more_stake_funding,
                'entrepreneurName' => $this->entrepreneur->name,
                'entrepreneurEmail' => $this->entrepreneur->email,
                'dateAdded' => $this->company->created_at->format('d M Y, h:i A'),
            ],
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