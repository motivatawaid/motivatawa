<?php

namespace App\Mail;

use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Mail\Mailable;
use Illuminate\Mail\Mailables\Content;
use Illuminate\Mail\Mailables\Envelope;
use Illuminate\Queue\SerializesModels;

class PurchaseConfirmationMail extends Mailable implements ShouldQueue
{
    use Queueable, SerializesModels;

    public $user;
    public $itemName;
    public $type;
    public $amount;
    public $purchaseDate;

    /**
     * Create a new message instance.
     */
    public function __construct($user, $itemName, $type, $amount)
    {
        $this->user = $user;
        $this->itemName = $itemName;
        $this->type = $type;
        $this->amount = $amount;
        $this->purchaseDate = now()->format('d F Y H:i');
    }

    /**
     * Get the message envelope.
     */
    public function envelope()
    {
        $subject = $this->type === 'ticket'
            ? 'Terima Kasih telah Membeli Tiket - Motivatawa'
            : 'Terima Kasih telah Membeli Video - Motivatawa';

        return new Envelope(
            subject: $subject,
        );
    }

    /**
     * Get the message content definition.
     */
    public function content()
    {
        return new Content(
            view: 'emails.purchase-confirmation',
            with: [
                'userName' => $this->user->name,
                'itemName' => $this->itemName,
                'type' => $this->type,
                'amount' => $this->amount,
                'purchaseDate' => $this->purchaseDate,
            ],
        );
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
