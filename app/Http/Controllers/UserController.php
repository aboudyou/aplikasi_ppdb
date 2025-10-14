<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use App\Models\Biodata; // Pastikan kamu sudah punya model Biodata

class UserController extends Controller
{
    public function biodata()
    {
        // Ambil data biodata user yang sedang login (kalau sudah pernah diisi)
        $biodata = Biodata::where('user_id', Auth::id())->first();

        return view('user.biodata', compact('biodata'));
    }

    public function storeBiodata(Request $request)
    {
        $request->validate([
            'nama' => 'required|string|max:100',
            'tempat_lahir' => 'required|string|max:100',
            'tanggal_lahir' => 'required|date',
            'alamat' => 'required|string',
        ]);

        // Simpan atau update biodata user
        Biodata::updateOrCreate(
            ['user_id' => Auth::id()],
            [
                'nama' => $request->nama,
                'tempat_lahir' => $request->tempat_lahir,
                'tanggal_lahir' => $request->tanggal_lahir,
                'alamat' => $request->alamat,
            ]
        );

        return redirect()->route('user.biodata')->with('success', 'Biodata berhasil disimpan!');
    }

    public function dokumen()
    {
        return view('user.dokumen');
    }

    public function status()
    {
        return view('user.status');
    }

    public function daftarUlang()
    {
        return view('user.daftar_ulang');
    }
}
