<?php

namespace App\Mail;

use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Mail\Mailable;
use Illuminate\Mail\Mailables\Content;
use Illuminate\Mail\Mailables\Envelope;
use Illuminate\Queue\SerializesModels;

class InterestedNotification extends Mailable
{
    use Queueable, SerializesModels;
    public $investorName;
    public $offer_type;
    public $market_capital;
    public $your_stake;
    public $company_value;
    public $remark_reason;
    public $counter_market_capital;
    public $counter_your_stake;
    public $counter_company_value;
    public $counter_reason;
    public $country; // Add country property
    /**
     * Create a new message instance.
     *
     * @return void
     */
    public function __construct($investorName, $offer_type, $market_capital = null, $your_stake = null, $company_value = null, $remark_reason = null, $counter_market_capital = null, $counter_your_stake = null, $counter_company_value = null, $counter_reason = null, $country = null)
    {
        $this->investorName = $investorName;
        $this->offer_type = $offer_type;
        $this->market_capital = $market_capital;
        $this->your_stake = $your_stake;
        $this->company_value = $company_value;
        $this->remark_reason = $remark_reason;
        $this->counter_market_capital = $counter_market_capital;
        $this->counter_your_stake = $counter_your_stake;
        $this->counter_company_value = $counter_company_value;
        $this->counter_reason = $counter_reason;
        $this->country = $country;// Add country parameter
    }

    /**
     * Get the message envelope.
     *
     * @return \Illuminate\Mail\Mailables\Envelope
     */
    public function envelope()
    {
        return new Envelope(
            subject: $this->offer_type === 'counter' ? 'New Counter Offer from Investor' : 'Investor Interest in Your Startup'
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
            view: 'emails.interested',
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