<?php

namespace App\Mail\User;

use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Http\Request;
use Illuminate\Mail\Mailable;
use Illuminate\Mail\Mailables\Attachment;
use Illuminate\Mail\Mailables\Content;
use Illuminate\Mail\Mailables\Envelope;
use Illuminate\Queue\SerializesModels;

class Query extends Mailable
{
    use Queueable, SerializesModels;

    public $data;
    public $request;
    
    /**
     * Create a new message instance.
     */
    public function __construct($data, $request)
    {
        $this->data = $data;
        $this->request = $request;
    }

    /**
     * Get the message envelope.
     */
    public function envelope(): Envelope
    {
        return new Envelope(
            subject: "Пользовательский запрос:   " . $this->data['theme'], 
        );
    }

    /**
     * Get the message content definition.
     */
    public function content(): Content
    {
        return new Content(
            markdown: 'mail.user.query',
        );
    }


    public function build()
    {

        $attachment = $this->request->file('attach');
        $attachmentName = $attachment->getClientOriginalName();
        $attachmentContent = file_get_contents($attachment->getRealPath());


        return $this->from($this->data['email'])
                    ->subject($this->data['theme'])
                    ->markdown('mail.user.query')
                    ->with([
                        'name' => $this->data['name'],
                        'message' => $this->data['message'],
                        'attach' => $attachmentName,
                    ])
                    ->attachData($attachmentContent, $attachmentName);
    }


    /**
     * Get the attachments for the message.
     *
     * @return array<int, \Illuminate\Mail\Mailables\Attachment>
     */
    public function attachments(): array
    {

        return [
        ];
    }
}
