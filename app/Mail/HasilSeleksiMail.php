<?php

namespace App\Mail;

use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Mail\Mailable;
use Illuminate\Mail\Mailables\Content;
use Illuminate\Mail\Mailables\Envelope;
use Illuminate\Mail\Mailables\Attachment;
use Illuminate\Queue\SerializesModels;

class HasilSeleksiMail extends Mailable
{
    use Queueable, SerializesModels;

    public $user;
    public $status;
    public $catatan;
    public $pdfPath;

    /**
     * Create a new message instance.
     */
    public function __construct($user, $status, $catatan = null, $pdfPath = null)
    {
        $this->user = $user;
        $this->status = $status;
        $this->catatan = $catatan;
        $this->pdfPath = $pdfPath;
    }

    /**
     * Get the message envelope.
     */
    public function envelope(): Envelope
    {
        $subject = $this->status === 'diterima'
            ? 'Selamat! Anda Diterima di SMK Antartika 1'
            : 'Informasi Hasil Seleksi PPDB SMK Antartika 1';

        return new Envelope(
            subject: $subject,
        );
    }

    /**
     * Get the message content definition.
     */
    public function content(): Content
    {
        return new Content(
            view: 'emails.hasil-seleksi',
        );
    }

    /**
     * Get the attachments for the message.
     *
     * @return array<int, \Illuminate\Mail\Mailables\Attachment>
     */
    public function attachments(): array
    {
        $attachments = [];
        
        // Jika status diterima dan ada PDF surat penerimaan, attach ke email
        if ($this->status === 'diterima' && $this->pdfPath && file_exists($this->pdfPath)) {
            $attachments[] = Attachment::fromPath($this->pdfPath)
                ->as('Surat_Penerimaan_' . str_replace(' ', '_', $this->user->name) . '.pdf')
                ->withMime('application/pdf');
        }
        
        return $attachments;
    }
}