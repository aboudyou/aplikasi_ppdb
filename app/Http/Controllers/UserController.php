<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Jurusan;
use App\Models\GelombangPendaftaran;
use App\Models\FormulirPendaftaran;
use Illuminate\Support\Facades\Auth;
use App\Mail\PendaftaranBerhasilMail;
use Illuminate\Support\Facades\Mail;

class UserController extends Controller
{
    public function biodata()
    {
        $jurusan = Jurusan::all();
        $gelombang = GelombangPendaftaran::all();

        $data = FormulirPendaftaran::where('user_id', Auth::id())->first();

        return view('user.biodata', compact('jurusan', 'gelombang', 'data'));
    }

    public function dashboard()
    {
        return view('user.dashboard');
    }

    public function storeBiodata(Request $request)
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
        ]);

        // Convert jenis_kelamin from L/P to Laki-laki/Perempuan
        $jenisKelamin = $request->jenis_kelamin === 'L' ? 'Laki-laki' : 'Perempuan';

        // Jika user sudah punya formulir, jangan izinkan submit baru
        $existing = FormulirPendaftaran::where('user_id', Auth::id())->first();
        if ($existing) {
            return redirect()->route('user.profile.index')
                ->with('info', 'Anda sudah mengisi biodata. Untuk mengubah, gunakan menu Edit Profil.');
        }

        #buat increment untuk kolom nomor_pendaftaran
        $lastForm = FormulirPendaftaran::orderBy('created_at', 'desc')->first();
        if ($lastForm) {
            $lastNumber = intval(substr($lastForm->nomor_pendaftaran, -5));
            $newNumber = str_pad($lastNumber + 1, 5, '0', STR_PAD_LEFT);
        } else {
            $newNumber = '00001';
        }
        $nomorPendaftaran = 'PPDB' . date('Ymd') . $newNumber;

        $gelombang = GelombangPendaftaran::findOrFail($request->gelombang_id);

        FormulirPendaftaran::create([
            'user_id' => Auth::id(),
            'nomor_pendaftaran' => $nomorPendaftaran,
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
            'kelurahan_desa' => $request->desa,
            'kecamatan' => $request->kecamatan,
            'kota' => $request->kota,
            'no_hp' => $request->no_hp,
            'jurusan_id' => $request->jurusan_id,
            'gelombang_id' => $request->gelombang_id,
            'status_pendaftaran' => 'Draft',
        ]);

        // Kirim email notifikasi pendaftaran berhasil
        try {
            $user = Auth::user();
            Mail::to($user->email)->send(new PendaftaranBerhasilMail($user, $gelombang));
        } catch (\Exception $e) {
            // Log error tapi jangan hentikan proses
            \Log::error('Gagal kirim email pendaftaran berhasil: ' . $e->getMessage());
        }

        return redirect()->route('user.dashboard')->with('success', 'Biodata berhasil disimpan!');
    }    public function dokumen()
    {
        return redirect()->route('user.dokumen');
    }

    public function status()
    {
        $status = StatusSeleksi::where('user_id', Auth::id())->first();
        return view('user.status', compact('status'));
    }

    public function daftarUlang()
    {
        return view('user.daftar_ulang');
    }
}
