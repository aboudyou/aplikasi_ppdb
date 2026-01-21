<?php

namespace App\Services;

use App\Models\FormulirPendaftaran;
use Barryvdh\DomPDF\Facade\Pdf;

class SuratPenerimaanService
{
    /**
     * Generate PDF surat penerimaan
     */
    public static function generatePdf(FormulirPendaftaran $formulir)
    {
        // Generate view PDF
        $pdf = Pdf::loadView('admin.seleksi.surat-penerimaan-pdf', [
            'formulir' => $formulir
        ]);

        // Set paper size A4
        $pdf->setPaper('A4', 'portrait');

        // Generate nama file
        $filename = 'surat_penerimaan_' . str_replace(' ', '_', $formulir->nama_lengkap) . '_' . date('Y-m-d-His') . '.pdf';

        // Simpan ke storage
        $path = storage_path('app/surat-penerimaan/' . $filename);
        
        // Pastikan folder ada
        if (!file_exists(dirname($path))) {
            mkdir(dirname($path), 0755, true);
        }

        // Save PDF
        $pdf->save($path);

        return $path;
    }

    /**
     * Get atau generate PDF surat penerimaan
     */
    public static function getOrGeneratePdf(FormulirPendaftaran $formulir)
    {
        $suratPath = storage_path('app/surat-penerimaan/');
        
        // Cek apakah folder ada
        if (!file_exists($suratPath)) {
            mkdir($suratPath, 0755, true);
        }

        // Generate PDF baru
        $pdfPath = self::generatePdf($formulir);

        return $pdfPath;
    }
}
