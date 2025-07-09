<?php

namespace App\Mail;

use App\Models\Entrepreneur;
use App\Models\EntrepreneurCompany;
use App\Models\Investor;
use App\Models\InvestorCompany;
use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Mail\Mailable;
use Illuminate\Mail\Mailables\Content;
use Illuminate\Mail\Mailables\Envelope;
use Illuminate\Queue\SerializesModels;

class InvestorNewCompanyNotification extends Mailable
{
    use Queueable, SerializesModels;

    public $company;
    public $investor;

    /**
     * Create a new message instance.
     *
     * @return void
     */
    public function __construct(InvestorCompany $company, Investor $investor)
    {
        $this->company = $company;
        $this->investor = $investor;

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
            view: 'emails.investor-new-company-notification',
            with: [
                'companyName' => $this->company->company_name,
                'marketCapital' => $this->company->market_capital,
                'yourStake' => $this->company->your_stake,
                'stakeFunding' => $this->company->stake_funding,
                'investorName' => $this->investor->full_name,
                'investorEmail' => $this->investor->email,
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