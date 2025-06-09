<?php

namespace App\Mail;

use App\Models\CV;
use Illuminate\Http\Request;
use Illuminate\Bus\Queueable;
use Illuminate\Mail\Mailable;
use Illuminate\Support\Facades\Mail;
use Illuminate\Mail\Mailables\Address;
use Illuminate\Mail\Mailables\Content;
use Illuminate\Queue\SerializesModels;
use Illuminate\Mail\Mailables\Envelope;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Mail\Mailables\Attachment;

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
    public $cvPath;

    public function __construct($email, $subject, $email_message, $cvPath)
    {
        $this->user = auth()->guard('mahasiswa')->user();
        $this->email = $email;
        $this->subject = $subject;
        $this->email_message = $email_message;
        $this->cvPath = $cvPath;
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
            ->replyTo($this->email)
            ->with([
                'email' => $this->email,
                'subject' => $this->subject,
                'email_message' => $this->email_message,
            ])
            ->attach(storage_path('app/private/' . $this->cvPath), [
                'as' => 'CV_' . $this->user->nama . '.pdf',
                'mime' => 'application/pdf'
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
            'cvPath' => 'required|file|mimes:pdf,doc,docx|max:10240',
        ]);

        // Simpan file CV
        $file = $request->file('cv');
        $fileName = 'cv_' . time() . '.' . $file->getClientOriginalExtension();
        $cvPath = $file->storeAs('cv', $fileName, 'public');

        Mail::to($request->email)->send(new ApplicationSent(
            $request->email,
            $request->subject,
            $request->email_message,
            $cvPath,
        ));

        // dd($request);
        return back()->with('success', 'Lamaran berhasil dikirim!');
    }
}
