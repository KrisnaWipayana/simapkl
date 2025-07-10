<?php

namespace App\Mail;

use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Mail\Mailable;
use Illuminate\Mail\Mailables\Content;
use Illuminate\Mail\Mailables\Envelope;
use Illuminate\Mail\Mailables\Attachment;
use Illuminate\Queue\SerializesModels;

class LaporanRevisiNotification extends Mailable
{
    use Queueable, SerializesModels;

    public $laporan;

    /**
     * Create a new message instance.
     */
    public function __construct($laporan)
    {
        $this->laporan = $laporan;
    }

    /**
     * Get the message envelope.
     */
    public function envelope(): Envelope
    {
        return new Envelope(
            subject: 'Pemberitahuan: Revisi Laporan Akhir Diserahkan',
        );
    }

    /**
     * Get the message content definition.
     */
    public function content(): Content
    {
        return new Content(
            markdown: 'emails.laporan_revisi_notification',
            with: [
                'laporan' => $this->laporan,
                'mahasiswa' => $this->laporan->mahasiswa,
            ]
        );
    }

    /**
     * Get the attachments for the message.
     *
     * @return array<int, \Illuminate\Mail\Mailables\Attachment>
     */
    public function attachments(): array
    {
        if ($this->laporan->file_revisi && file_exists(storage_path('app/public/laporan_revisi/' . $this->laporan->file_revisi))) {
            return [
                Attachment::fromStorageDisk('public', 'laporan_revisi/' . $this->laporan->file_revisi)
            ];
        }
        return [];
    }
}