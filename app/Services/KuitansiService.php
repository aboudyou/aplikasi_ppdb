<?php

namespace App\Services;

use App\Models\Pembayaran;
use Barryvdh\DomPDF\Facade\Pdf;
use Illuminate\Support\Facades\Storage;

class KuitansiService
{
    /**
     * Generate PDF kuitansi
     */
    public static function generatePdf(Pembayaran $pembayaran)
    {
        // Generate view PDF
        $pdf = Pdf::loadView('user.pembayaran.kuitansi-pdf', [
            'pembayaran' => $pembayaran
        ]);

        // Set paper size
        $pdf->setPaper('A4', 'portrait');

        // Generate nama file
        $filename = 'kuitansi_' . str_replace(' ', '_', $pembayaran->formulir->nama_lengkap) . '_' . date('Y-m-d-His') . '.pdf';

        // Simpan ke storage
        $path = storage_path('app/kuitansi/' . $filename);
        
        // Pastikan folder ada
        if (!file_exists(dirname($path))) {
            mkdir(dirname($path), 0755, true);
        }

        // Save PDF
        $pdf->save($path);

        return $path;
    }

    /**
     * Get atau generate PDF kuitansi
     */
    public static function getOrGeneratePdf(Pembayaran $pembayaran)
    {
        $kuitansiPath = storage_path('app/kuitansi/');
        
        // Cek apakah sudah ada file kuitansi yang di-generate
        if (!file_exists($kuitansiPath)) {
            mkdir($kuitansiPath, 0755, true);
        }

        // Generate PDF baru
        $pdfPath = self::generatePdf($pembayaran);

        return $pdfPath;
    }
}
