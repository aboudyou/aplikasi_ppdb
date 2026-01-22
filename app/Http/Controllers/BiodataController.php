<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use App\Models\Jurusan;
use App\Models\GelombangPendaftaran;
use App\Models\FormulirPendaftaran;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Storage;

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
        $biodata = FormulirPendaftaran::where('user_id', Auth::id())->first();
        
        // Jika biodata tidak ada, buat baru
        if (!$biodata) {
            return redirect()->route('user.biodata')->with('error', 'Silakan isi biodata terlebih dahulu.');
        }
        
        // Validasi data yang lebih sederhana
        $validated = $request->validate([
            'nama_lengkap' => 'required|string|max:100',
            'nisn' => 'required|digits:10|unique:formulir_pendaftaran,nisn,' . $biodata->id,
            'nik' => 'required|digits:16|unique:formulir_pendaftaran,nik,' . $biodata->id,
            'tempat_lahir' => 'required|string|max:100',
            'tanggal_lahir' => 'required|date|before:today',
            'jenis_kelamin' => 'required|in:L,P',
            'agama' => 'required|in:Islam,Kristen,Katolik,Hindu,Buddha,Konghucu',
            'tinggi_badan' => 'nullable|numeric|min:50|max:250',
            'berat_badan' => 'nullable|numeric|min:20|max:200',
            'asal_sekolah' => 'required|string|max:100',
            'anak_ke' => 'nullable|integer|min:1|max:20',
            'alamat' => 'required|string|min:5|max:255',
            'no_hp' => 'nullable|digits_between:10,13',
            'jurusan_id' => 'required|exists:jurusan,id',
            'gelombang_id' => 'required|exists:gelombang_pendaftaran,id',
            'kecamatan' => 'required|string|max:100',
            'kota' => 'required|string|max:100',
            'kelurahan' => 'nullable|string|max:100',
            'desa' => 'nullable|string|max:100',
            'foto' => 'nullable|image|mimes:jpeg,png,jpg|max:2048',
        ]);

        // Konversi jenis kelamin
        $validated['jenis_kelamin'] = $request->jenis_kelamin === 'L' ? 'Laki-laki' : 'Perempuan';

        // Set kelurahan_desa
        $validated['kelurahan_desa'] = $request->kelurahan ?? $request->desa ?? null;
        unset($validated['kelurahan']);
        unset($validated['desa']);

        // Handle foto upload
        if ($request->hasFile('foto')) {
            // Delete old foto if exists
            if ($biodata->foto && Storage::disk('public')->exists($biodata->foto)) {
                Storage::disk('public')->delete($biodata->foto);
            }

            // Upload new foto
            $fotoPath = $request->file('foto')->store('photos', 'public');
            $validated['foto'] = $fotoPath;
        }

        // Update biodata
        $biodata->update($validated);

        return redirect()->route('user.profile.index')->with('success', 'Profil berhasil diperbarui!');
    }

    // Hapus biodata dan isi ulang
    public function destroy()
    {
        $biodata = FormulirPendaftaran::where('user_id', Auth::id())->first();
        
        if (!$biodata) {
            return redirect()->route('user.biodata')->with('error', 'Data biodata tidak ditemukan.');
        }

        // Delete foto jika ada
        if ($biodata->foto && Storage::disk('public')->exists($biodata->foto)) {
            Storage::disk('public')->delete($biodata->foto);
        }

        // Delete biodata
        $biodata->delete();

        return redirect()->route('user.biodata')->with('success', 'Biodata berhasil dihapus. Silakan isi kembali data Anda.');
    }
}

