<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\User;
use App\Models\StatusSeleksi;

class AdminController extends Controller
{
    /**
     * 📋 Halaman Verifikasi Berkas Pendaftaran
     */
     public function verifikasi()
    {
    $pendaftar = \App\Models\FormulirPendaftaran::orderBy('created_at', 'desc')->get();

    return view('admin.verifikasi.index', compact('pendaftar'));
    }
    public function verifikasiShow($id)
    {
        $data = \App\Models\FormulirPendaftaran::with(['dokumen', 'orangTua', 'jurusan', 'gelombang'])
        ->findOrFail($id);

    return view('admin.verifikasi.show', compact('data'));
    }
    /**
     * 📋 Halaman Seleksi — menampilkan semua siswa
     */
    public function seleksi()
    {
        // Ambil semua user yang role-nya "user"
        $siswa = User::where('role', 'user')->get();

        // Ambil juga data status seleksi mereka
        $statusSeleksi = StatusSeleksi::all();

        return view('admin.seleksi', compact('siswa', 'statusSeleksi'));
    }

    /**
     * 💾 Simpan / update status seleksi siswa
     */
    public function updateSeleksi(Request $request, $id)
    {
        $request->validate([
            'status' => 'required|string',
            'nilai' => 'nullable|numeric',
            'keterangan' => 'nullable|string',
        ]);

        StatusSeleksi::updateOrCreate(
            ['user_id' => $id],
            [
                'status' => $request->status,
                'nilai' => $request->nilai,
                'keterangan' => $request->keterangan,
            ]
        );

        return redirect()->route('admin.seleksi')->with('success', 'Status seleksi berhasil diperbarui!');
    }
}
