<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\FormulirPendaftaran;
use App\Models\Jurusan;
use Illuminate\Http\Request;
use App\Mail\HasilSeleksiMail;
use App\Services\SuratPenerimaanService;
use Illuminate\Support\Facades\Mail;

class SeleksiController extends Controller
{
    public function index()
    {
        // Ambil semua pendaftar dari tabel formulir_pendaftaran
        $pendaftar = FormulirPendaftaran::all();

        return view('admin.seleksi.index', compact('pendaftar'));
    }

    public function update(Request $request, $id)
    {
        $request->validate([
            'status_pendaftaran' => 'required',
        ]);

        $pendaftar = FormulirPendaftaran::findOrFail($id);
        $oldStatus = $pendaftar->status_pendaftaran;

        // Validasi kuota jika status yang diinginkan adalah 'diterima'
        if ($request->status_pendaftaran === 'diterima' && $oldStatus !== 'diterima') {
            $jurusan = Jurusan::find($pendaftar->jurusan_id);
            
            if ($jurusan && $jurusan->kuota > 0 && !$jurusan->isQuotaAvailable()) {
                return redirect()->back()->with('error', 'Kuota untuk jurusan ' . $jurusan->nama_jurusan . ' sudah penuh! Sisa kuota: ' . $jurusan->getAvailableQuota() . ' dari ' . $jurusan->kuota);
            }
        }

        $pendaftar->status_pendaftaran = $request->status_pendaftaran;
        $pendaftar->save();

        // Kirim email notifikasi jika status berubah ke diterima atau ditolak
        if (in_array($request->status_pendaftaran, ['diterima', 'ditolak']) && $oldStatus !== $request->status_pendaftaran) {
            try {
                $user = $pendaftar->user;
                $catatan = $request->catatan ?? null;
                $pdfPath = null;

                // Jika diterima, generate surat penerimaan PDF
                if ($request->status_pendaftaran === 'diterima') {
                    $pdfPath = SuratPenerimaanService::getOrGeneratePdf($pendaftar);
                }

                // Kirim email dengan attachment PDF jika ada
                Mail::to($user->email)->send(new HasilSeleksiMail($user, $request->status_pendaftaran, $catatan, $pdfPath));
                $emailSent = true;
            } catch (\Exception $e) {
                // Log error tapi jangan hentikan proses
                \Log::error('Gagal kirim email hasil seleksi: ' . $e->getMessage());
                $emailSent = false;
            }
        }

        return redirect()->back()->with('success', 'Status seleksi berhasil diperbarui!' . (isset($emailSent) ? ($emailSent ? ' Email notifikasi telah dikirim.' : ' (Email gagal dikirim - cek log)') : ''));
    }
}
