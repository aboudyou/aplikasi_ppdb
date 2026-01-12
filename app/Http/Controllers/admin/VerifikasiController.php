<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\User;
use App\Models\FormulirPendaftaran;
use Illuminate\Http\Request;

class VerifikasiController extends Controller
{
    // LIST PENDAFTAR
    public function index()
    {
        // Ambil daftar formulir pendaftaran beserta relasi user
        $pendaftar = FormulirPendaftaran::with('user')->get();

        return view('admin.verifikasi.index', compact('pendaftar'));
    }

    // DETAIL PENDAFTAR
    public function show($id)
    {
       $formulir = FormulirPendaftaran::with(['user','dokumen'])->findOrFail($id);

        return view('admin.verifikasi.show', compact('formulir'));
    }

    // APPROVE
    public function approve($id)
{
    $formulir = FormulirPendaftaran::findOrFail($id);

    // Set status sesuai enum yang tersedia
    $formulir->status_pendaftaran = 'Diverifikasi';
    $formulir->save();

    return redirect()->route('admin.verifikasi.index')
        ->with('success', 'Status pendaftaran disetujui.');
}


    // REJECT
    public function reject($id)
{
    $formulir = FormulirPendaftaran::findOrFail($id);

    // Kembalikan ke Draft saat ditolak
    $formulir->status_pendaftaran = 'Draft';
    $formulir->save();

    return redirect()->route('admin.verifikasi.index')
        ->with('success', 'Status pendaftaran ditolak.');
}

}
