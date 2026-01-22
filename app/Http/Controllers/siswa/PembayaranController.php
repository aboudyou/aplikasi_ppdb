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
        // Metode pembayaran hanya Transfer Bank, bukti wajib
        $request->validate([
            'metode' => 'required',
            'bukti' => 'required|image|max:2048',
        ]);

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

        // Metode hanya Transfer Bank
        $metodeDb = 'Transfer Bank';
        $status = 'Menunggu';

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

    public function kuitansi()
    {
        $formulir = FormulirPendaftaran::where('user_id', Auth::id())->first();
        if (!$formulir) {
            return back()->with('error', 'Lengkapi biodata/formulir terlebih dahulu.');
        }

        $pembayaran = Pembayaran::where('formulir_id', $formulir->id)->first();
        if (!$pembayaran || $pembayaran->status != 'Lunas') {
            return back()->with('error', 'Pembayaran belum lunas atau tidak ditemukan.');
        }

        return view('user.pembayaran.kuitansi', compact('pembayaran'));
    }
}
