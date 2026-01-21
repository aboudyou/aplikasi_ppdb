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
        $biodata = FormulirPendaftaran::where('user_id', Auth::id())->first();
        
        $request->validate([
            'nama_lengkap' => 'required|string|max:100|regex:/^[a-zA-Z\s]+$/',
            'nisn' => 'required|numeric|digits:10|unique:formulir_pendaftaran,nisn,' . ($biodata?->id ?? 'NULL'),
            'nik' => 'required|numeric|digits:16|unique:formulir_pendaftaran,nik,' . ($biodata?->id ?? 'NULL'),
            'tempat_lahir' => 'required|string|max:100|regex:/^[a-zA-Z\s]+$/',
            'tanggal_lahir' => 'required|date|before:today|after:1990-01-01',
            'jenis_kelamin' => 'required|in:L,P',
            'agama' => 'required|in:Islam,Kristen,Katolik,Hindu,Buddha,Konghucu',
            'tinggi_badan' => 'nullable|numeric|min:50|max:250',
            'berat_badan' => 'nullable|numeric|min:20|max:200',
            'asal_sekolah' => 'required|string|max:100',
            'anak_ke' => 'nullable|numeric|min:1|max:20',
            'alamat' => 'required|string|min:5|max:255',
            'no_hp' => 'nullable|numeric|digits_between:10,13',
            'jurusan_id' => 'required|exists:jurusan,id',
            'gelombang_id' => 'required|exists:gelombang_pendaftaran,id',
            'kelurahan' => 'required_without:desa|string',
            'desa' => 'required_without:kelurahan|string',
            'foto' => 'nullable|image|mimes:jpeg,png,jpg|max:2048',
        ], [
            'nama_lengkap.regex' => 'Nama Lengkap hanya boleh berisi huruf dan spasi (tidak boleh angka atau simbol)',
            'nisn.numeric' => 'NISN harus berisi angka saja (tidak boleh huruf)',
            'nisn.digits' => 'NISN harus terdiri dari 10 angka',
            'nisn.unique' => 'NISN sudah terdaftar di sistem',
            'nik.numeric' => 'NIK harus berisi angka saja (tidak boleh huruf)',
            'nik.digits' => 'NIK harus terdiri dari 16 angka',
            'nik.unique' => 'NIK sudah terdaftar di sistem',
            'tempat_lahir.regex' => 'Tempat Lahir hanya boleh berisi huruf dan spasi',
            'tanggal_lahir.before' => 'Tanggal Lahir tidak boleh di masa depan',
            'tanggal_lahir.after' => 'Tanggal Lahir tidak valid (terlalu jauh ke belakang)',
            'agama.in' => 'Agama harus dipilih dari daftar yang tersedia',
            'tinggi_badan.min' => 'Tinggi Badan minimal 50 cm',
            'tinggi_badan.max' => 'Tinggi Badan maksimal 250 cm',
            'berat_badan.min' => 'Berat Badan minimal 20 kg',
            'berat_badan.max' => 'Berat Badan maksimal 200 kg',
            'alamat.min' => 'Alamat Lengkap minimal 5 karakter',
            'alamat.max' => 'Alamat Lengkap maksimal 255 karakter',
            'no_hp.numeric' => 'Nomor HP harus berisi angka saja',
            'no_hp.digits_between' => 'Nomor HP harus antara 10-13 digit',
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
