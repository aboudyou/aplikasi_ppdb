<?php

namespace App\Http\Controllers\Siswa;

use App\Http\Controllers\Controller;
use App\Models\FormulirPendaftaran;
use App\Services\SuratPenerimaanService;
use Illuminate\Support\Facades\Auth;

class SeleksiController extends Controller
{
    public function index()
    {
        // Minimal stub to satisfy route binding during development.
        abort(404);
    }

    public function suratPenerimaan()
    {
        $formulir = FormulirPendaftaran::where('user_id', Auth::id())->first();
        
        if (!$formulir) {
            return back()->with('error', 'Data formulir tidak ditemukan.');
        }

        if ($formulir->status_pendaftaran !== 'diterima') {
            return back()->with('error', 'Anda belum diterima atau tidak memiliki akses ke surat penerimaan.');
        }

        try {
            $pdfPath = SuratPenerimaanService::getOrGeneratePdf($formulir);
            return response()->file($pdfPath);
        } catch (\Exception $e) {
            return back()->with('error', 'Gagal mengambil surat penerimaan: ' . $e->getMessage());
        }
    }
}

