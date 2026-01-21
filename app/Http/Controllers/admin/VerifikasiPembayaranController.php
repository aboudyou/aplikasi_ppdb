<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Pembayaran;
use App\Mail\KuitansiPembayaranMail;
use App\Services\KuitansiService;
use Illuminate\Support\Facades\Mail;

class VerifikasiPembayaranController extends Controller
{
    public function index(Request $request)
    {
        // Default: tampilkan pembayaran yang Menunggu verifikasi
        $status = $request->get('status', 'menunggu');

        $query = Pembayaran::with('formulir.user')->latest();

        if ($status !== 'all') {
            if ($status === 'menunggu') {
                $query->where('status', 'Menunggu');
            } elseif ($status === 'lunas') {
                $query->where('status', 'Lunas');
            }
        }

        $data = $query->get();
        
        // Hitung untuk badge filter
        $pendingCount = Pembayaran::where('status', 'Menunggu')->count();
        $verifiedCount = Pembayaran::where('status', 'Lunas')->count();

        return view('admin.pembayaran.index', compact('data', 'status', 'pendingCount', 'verifiedCount'));
    }

    public function show($id)
    {
        $data = Pembayaran::with('formulir.user')->findOrFail($id);
        return view('admin.pembayaran.show', compact('data'));
    }

    public function approve($id)
    {
        $p = Pembayaran::findOrFail($id);
        $p->update([
            'status' => 'Lunas',
            'admin_verifikasi_id' => auth()->id(),
            'verified_at' => now(),
        ]);

        // Generate nomor kuitansi jika belum ada
        if (!$p->no_kuitansi) {
            $p->update([
                'no_kuitansi' => 'KUI-' . str_pad($p->id, 6, '0', STR_PAD_LEFT)
            ]);
        }

        // Generate PDF kuitansi
        try {
            $pdfPath = KuitansiService::getOrGeneratePdf($p);
            
            // Kirim email dengan kuitansi PDF
            $userEmail = $p->formulir->user->email;
            Mail::to($userEmail)->send(new KuitansiPembayaranMail($p, $pdfPath));
        } catch (\Exception $e) {
            // Log error tapi jangan block approval
            \Log::error('Error mengirim email kuitansi: ' . $e->getMessage());
        }

        return redirect()->route('admin.pembayaran.index')->with('success', 'Pembayaran diterima, kuitansi telah dikirim ke email siswa.');
    }

    public function reject($id)
    {
        $p = Pembayaran::findOrFail($id);
        $p->update([
            'status' => 'Menunggu',
            'admin_verifikasi_id' => auth()->id(),
            'verified_at' => now(),
        ]);

        return redirect()->route('admin.pembayaran.index')->with('success', 'Pembayaran ditolak (dikembalikan ke status Menunggu).');
    }
}
