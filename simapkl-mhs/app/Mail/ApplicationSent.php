<?php

namespace App\Mail;

use Illuminate\Http\Request;
use Illuminate\Bus\Queueable;
use Illuminate\Mail\Mailable;
use Illuminate\Support\Facades\Mail;
use Illuminate\Mail\Mailables\Address;
use Illuminate\Mail\Mailables\Content;
use Illuminate\Queue\SerializesModels;
use Illuminate\Mail\Mailables\Envelope;
use Illuminate\Contracts\Queue\ShouldQueue;

class ApplicationSent extends Mailable
{
    use Queueable, SerializesModels;

    /**
     * Create a new message instance.
     */
    public $user;
    public $email;
    public $subject;
    public $email_message;
    // public $cv_filename;

    public function __construct($email, $subject, $email_message)
    {
        $this->user = auth()->guard('mahasiswa')->user();
        $this->email = $email;
        $this->subject = $subject;
        $this->email_message = $email_message;
        // $this->cv_filename = $cv_filename;
    }

    /**
     * Get the message envelope.
     */
    public function envelope(): Envelope
    {

        // $mahasiswa = auth()->guard('mahasiswa')->user();

        return new Envelope();
    }


    public function build()
    {
        return $this->subject($this->subject)
            ->view('dashboard.application-form')
            ->with([
                'email' => $this->email,
                'subject' => $this->subject,
                'email_message' => $this->email_message,
            ]);
    }

    /**
     * Get the message content definition.
     */
    public function content(): Content
    {
        return new Content(
            // view: 'dashboard.application-email',
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

    public function sendEmail(Request $request)
    {
        $request->validate([
            'email' => 'required|email',
            'subject' => 'required|string',
            'email_message' => 'required|string',
        ]);

        Mail::to($request->email)->send(new ApplicationSent(
            $request->email,
            $request->subject,
            $request->email_message
        ));

        return back()->with('success', 'Lamaran berhasil dikirim!');
    }
}
