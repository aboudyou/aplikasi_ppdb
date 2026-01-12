<?php

namespace App\Http\Controllers\Siswa;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Pembayaran;
use App\Models\FormulirPendaftaran;
use Illuminate\Support\Facades\Auth;

class PembayaranController extends Controller
{
    public function index()
    {
        $formulir = FormulirPendaftaran::where('user_id', Auth::id())->first();
        $pembayaran = null;

        if ($formulir) {
            $pembayaran = Pembayaran::where('formulir_id', $formulir->id)->first();
        }

        return view('user.pembayaran.index', compact('formulir', 'pembayaran'));
    }

    public function store(Request $request)
    {
        // Jika metode adalah Cash, bukti tidak wajib. Untuk metode lain, bukti wajib.
        $metodeLower = strtolower($request->metode ?? '');
        if (strpos($metodeLower, 'cash') !== false) {
            $rules = [
                'metode' => 'required',
                'bukti' => 'nullable|image|max:2048',
            ];
        } else {
            $rules = [
                'metode' => 'required',
                'bukti' => 'required|image|max:2048',
            ];
        }

        $request->validate($rules);
        // Pastikan formulir/biodata sudah diisi
        $formulir = FormulirPendaftaran::where('user_id', Auth::id())->first();
        if (!$formulir) {
            return back()->with('error', 'Lengkapi biodata/formulir terlebih dahulu sebelum melakukan pembayaran.');
        }

        $namaFile = null;
        if ($request->hasFile('bukti')) {
            $file = $request->file('bukti');
            $namaFile = time().'_'.$file->getClientOriginalName();
            $file->move(public_path('uploads/pembayaran'), $namaFile);
        }

        // Map metode input to DB enum values
        $metodeInput = strtolower($request->metode);
        // Map metode input to DB enum values and decide status
        if (strpos($metodeInput, 'transfer') !== false) {
            $metodeDb = 'Transfer Bank';
            $status = 'Menunggu';
        } elseif (strpos($metodeInput, 'qris') !== false || strpos($metodeInput, 'ewallet') !== false) {
            $metodeDb = 'E-Wallet';
            $status = 'Menunggu';
        } elseif (strpos($metodeInput, 'cash') !== false) {
            // Untuk pembayaran tunai (cash) anggap langsung lunas (admin tidak perlu verifikasi bukti)
            // Karena enum tidak punya 'Cash', simpan sebagai 'VA' untuk kompatibilitas schema
            $metodeDb = 'VA';
            $status = 'Lunas';
        } else {
            // fallback
            $metodeDb = 'VA';
            $status = 'Menunggu';
        }

        Pembayaran::updateOrCreate(
            ['formulir_id' => $formulir->id],
            [
                'metode_bayar' => $metodeDb,
                'bukti_bayar' => $namaFile,
                'status' => $status,
                'gelombang_id' => $formulir->gelombang_id,
                'tanggal_bayar' => now(),
                'jumlah_bayar' => $formulir->gelombang->getBiayaAkhir(),
            ]
        );

        return back()->with('success', 'Bukti pembayaran berhasil diupload. Menunggu verifikasi admin.');
    }
}
