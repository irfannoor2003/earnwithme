<?php

namespace App\Mail;

use Illuminate\Bus\Queueable;
use Illuminate\Mail\Mailable;
use Illuminate\Mail\Mailables\Address;
use Illuminate\Mail\Mailables\Content;
use Illuminate\Mail\Mailables\Envelope;
use Illuminate\Queue\SerializesModels;

class ContactFormMessage extends Mailable
{
    use Queueable, SerializesModels;

    public function __construct(
        public string $senderName,
        public string $senderEmail,
        public string $messageSubject,
        public string $messageBody,
    ) {}

    /**
     * Strip anything that could break out of a mail header.
     *
     * These values are attacker-controlled (public contact form). A newline in
     * the subject or display name can otherwise terminate the header block and
     * append headers of the attacker's choosing, such as an extra Bcc.
     */
    private static function headerSafe(string $value): string
    {
        return trim(preg_replace('/[\r\n\t]+/', ' ', $value) ?? '');
    }

    public function envelope(): Envelope
    {
        return new Envelope(
            subject: 'Website contact: '.self::headerSafe($this->messageSubject),
            replyTo: [new Address($this->senderEmail, self::headerSafe($this->senderName))],
        );
    }

    public function content(): Content
    {
        return new Content(view: 'emails.contact-form');
    }

    public function attachments(): array
    {
        return [];
    }
}
