<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\FormulirPendaftaran;
use App\Models\DokumenPendaftaran;
use Illuminate\Http\Request;

class VerifikasiController extends Controller
{
    public function index()
    {
        // Ambil pendaftar yang statusnya "Lengkap"
        $pendaftar = FormulirPendaftaran::with('user')
                    ->where('status_pendaftaran', 'Lengkap')
                    ->get();

        return view('admin.verifikasi.index', compact('pendaftar'));
    }  
    public function show($id)
    {
        $formulir = FormulirPendaftaran::with(['user', 'dokumen'])->findOrFail($id);

        return view('admin.verifikasi.show', compact('formulir'));
    }

    public function approve($id)
    {
        $formulir = FormulirPendaftaran::findOrFail($id);
        $formulir->status_pendaftaran = "Diverifikasi";
        $formulir->save();

        return redirect()->route('admin.verifikasi.index')->with('success', 'Berkas berhasil diverifikasi!');
    }

    public function reject(Request $request, $id)
    {
        $formulir = FormulirPendaftaran::findOrFail($id);
        $formulir->status_pendaftaran = "Draft"; // atau buat status baru "Ditolak"
        $formulir->save();

        return redirect()->route('admin.verifikasi.index')->with('error', 'Berkas ditolak.');
    }
}
