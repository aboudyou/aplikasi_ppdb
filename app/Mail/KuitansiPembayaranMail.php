<?php

namespace App\Mail;

use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Mail\Mailable;
use Illuminate\Mail\Mailables\Content;
use Illuminate\Mail\Mailables\Envelope;
use Illuminate\Mail\Mailables\Attachment;
use App\Models\Pembayaran;

class KuitansiPembayaranMail extends Mailable
{
    use Queueable;

    public $pembayaran;
    public $pdfPath;

    /**
     * Create a new message instance.
     */
    public function __construct(Pembayaran $pembayaran, $pdfPath = null)
    {
        $this->pembayaran = $pembayaran;
        $this->pdfPath = $pdfPath;
    }

    /**
     * Get the message envelope.
     */
    public function envelope(): Envelope
    {
        return new Envelope(
            subject: 'Kuitansi Pembayaran Pendaftaran - ' . $this->pembayaran->formulir->nama_lengkap,
        );
    }

    /**
     * Get the message content definition.
     */
    public function content(): Content
    {
        return new Content(
            view: 'emails.kuitansi-pembayaran',
            with: [
                'pembayaran' => $this->pembayaran,
                'nama' => $this->pembayaran->formulir->nama_lengkap,
                'nomor_kuitansi' => $this->pembayaran->no_kuitansi ?? 'KUI-' . str_pad($this->pembayaran->id, 6, '0', STR_PAD_LEFT),
                'jumlah' => $this->pembayaran->formulir->gelombang->getBiayaAkhir(),
            ],
        );
    }

    /**
     * Get the attachments for the message.
     */
    public function attachments(): array
    {
        $attachments = [];
        
        if ($this->pdfPath && file_exists($this->pdfPath)) {
            $attachments[] = Attachment::fromPath($this->pdfPath)
                ->as('Kuitansi_Pembayaran_' . str_replace(' ', '_', $this->pembayaran->formulir->nama_lengkap) . '.pdf')
                ->withMime('application/pdf');
        }
        
        return $attachments;
    }
}
