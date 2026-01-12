<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use App\Models\Jurusan;
use App\Models\GelombangPendaftaran;
use App\Models\FormulirPendaftaran;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class BiodataController extends Controller
{
    // Menampilkan profil dengan biodata user
    public function index()
    {
        $user = Auth::user();
        $biodata = FormulirPendaftaran::where('user_id', $user->id)->first();
        $jurusan = $biodata ? Jurusan::find($biodata->jurusan_id) : null;
        $gelombang = $biodata ? GelombangPendaftaran::find($biodata->gelombang_id) : null;

        return view('profile.index', compact('user', 'biodata', 'jurusan', 'gelombang'));
    }

    // Menampilkan form edit profil
    public function edit()
    {
        $user = Auth::user();
        $biodata = FormulirPendaftaran::where('user_id', $user->id)->first();
        $jurusan = Jurusan::all();
        $gelombang = GelombangPendaftaran::all();

        return view('profile.edit', compact('user', 'biodata', 'jurusan', 'gelombang'));
    }

    // Update profil
    public function update(Request $request)
    {
        $request->validate([
            'nama_lengkap' => 'required|string|max:100',
            'nisn' => 'required',
            'nik' => 'required',
            'tempat_lahir' => 'required|string|max:100',
            'tanggal_lahir' => 'required|date',
            'jenis_kelamin' => 'required|in:L,P',
            'agama' => 'required|string',
            'alamat' => 'required|string',
            'jurusan_id' => 'required|exists:jurusan,id',
            'gelombang_id' => 'required|exists:gelombang_pendaftaran,id',
            // accept either 'kelurahan' or legacy 'desa'
            'kelurahan' => 'required_without:desa|string',
            'desa' => 'required_without:kelurahan|string',
            'foto' => 'nullable|image|mimes:jpeg,png,jpg|max:2048',
        ]);

        $jenisKelamin = $request->jenis_kelamin === 'L' ? 'Laki-laki' : 'Perempuan';

        $kelurahan = $request->kelurahan ?? $request->desa ?? null;

        $data = [
            'nama_lengkap' => $request->nama_lengkap,
            'nisn' => $request->nisn,
            'nik' => $request->nik,
            'tempat_lahir' => $request->tempat_lahir,
            'tanggal_lahir' => $request->tanggal_lahir,
            'jenis_kelamin' => $jenisKelamin,
            'agama' => $request->agama,
            'tinggi_badan' => $request->tinggi_badan,
            'berat_badan' => $request->berat_badan,
            'asal_sekolah' => $request->asal_sekolah,
            'anak_ke' => $request->anak_ke,
            'alamat' => $request->alamat,
            'kelurahan_desa' => $kelurahan,
            'kecamatan' => $request->kecamatan,
            'kota' => $request->kota,
            'no_hp' => $request->no_hp,
            'jurusan_id' => $request->jurusan_id,
            'gelombang_id' => $request->gelombang_id,
        ];

        // Handle foto upload
        if ($request->hasFile('foto')) {
            $biodata = FormulirPendaftaran::where('user_id', Auth::id())->first();
            
            // Delete old foto if exists
            if ($biodata && $biodata->foto && \Storage::disk('public')->exists($biodata->foto)) {
                \Storage::disk('public')->delete($biodata->foto);
            }

            // Upload new foto
            $fotoPath = $request->file('foto')->store('photos', 'public');
            $data['foto'] = $fotoPath;
        }

        FormulirPendaftaran::where('user_id', Auth::id())->update($data);

        return redirect()->route('user.profile.index')->with('success', 'Profil berhasil diperbarui!');
    }
}
