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
        $data = FormulirPendaftaran::where('user_id', Auth::id())->first();
        $step = session('biodata_step', 1);

        if ($data && $step == 1) {
            // Jika sudah ada data, langsung ke summary
            return view('user.biodata.summary', compact('data'));
        }

        if ($step == 2) {
            return redirect()->route('user.biodata.step2');
        }

        return redirect()->route('user.biodata.step1');
    }

    public function biodataStep1()
    {
        $data = FormulirPendaftaran::where('user_id', Auth::id())->first();
        
        if ($data) {
            return view('user.biodata.summary', compact('data'));
        }

        return view('user.biodata.step1');
    }

    public function biodataStep2()
    {
        $jurusan = Jurusan::all();
        $gelombang = GelombangPendaftaran::all();
        
        // Redirect ke step 1 jika belum ada data di session
        if (!session()->has('biodata_step1_data')) {
            return redirect()->route('user.biodata.step1')->with('error', 'Silakan lengkapi step 1 terlebih dahulu');
        }

        return view('user.biodata.step2', compact('jurusan', 'gelombang'));
    }

    public function storeStep1(Request $request)
    {
        $request->validate([
            'nama_lengkap' => 'required|string|max:100|regex:/^[a-zA-Z\s]+$/',
            'nisn' => 'required|numeric|digits:10|unique:formulir_pendaftaran,nisn',
            'nik' => 'required|numeric|digits:16|unique:formulir_pendaftaran,nik',
            'tempat_lahir' => 'required|string|max:100|regex:/^[a-zA-Z\s]+$/',
            'tanggal_lahir' => 'required|date|before:today|after:1990-01-01',
            'jenis_kelamin' => 'required|in:L,P',
            'agama' => 'required|in:Islam,Kristen,Katolik,Hindu,Buddha,Konghucu',
            'tinggi_badan' => 'nullable|numeric|min:50|max:250',
            'berat_badan' => 'nullable|numeric|min:20|max:200',
            'asal_sekolah' => 'required|string|max:100',
            'anak_ke' => 'nullable|numeric|min:1|max:20',
        ], [
            'nama_lengkap.required' => 'Nama Lengkap harus diisi',
            'nama_lengkap.regex' => 'Nama Lengkap hanya boleh berisi huruf dan spasi (tidak boleh angka atau simbol)',
            'nisn.required' => 'NISN harus diisi',
            'nisn.numeric' => 'NISN harus berisi angka saja',
            'nisn.digits' => 'NISN harus terdiri dari 10 angka',
            'nisn.unique' => 'NISN sudah terdaftar di sistem',
            'nik.required' => 'NIK harus diisi',
            'nik.numeric' => 'NIK harus berisi angka saja',
            'nik.digits' => 'NIK harus terdiri dari 16 angka',
            'nik.unique' => 'NIK sudah terdaftar di sistem',
            'tempat_lahir.required' => 'Tempat Lahir harus diisi',
            'tempat_lahir.regex' => 'Tempat Lahir hanya boleh berisi huruf dan spasi',
            'tanggal_lahir.required' => 'Tanggal Lahir harus diisi',
            'tanggal_lahir.before' => 'Tanggal Lahir tidak boleh di masa depan',
            'jenis_kelamin.required' => 'Jenis Kelamin harus dipilih',
            'agama.required' => 'Agama harus dipilih',
            'tinggi_badan.numeric' => 'Tinggi Badan harus berupa angka',
            'tinggi_badan.min' => 'Tinggi Badan minimal 50 cm',
            'berat_badan.numeric' => 'Berat Badan harus berupa angka',
            'berat_badan.min' => 'Berat Badan minimal 20 kg',
            'asal_sekolah.required' => 'Asal Sekolah harus diisi',
            'anak_ke.numeric' => 'Anak ke- harus berupa angka',
        ]);

        // Simpan ke session
        session(['biodata_step1_data' => $request->only([
            'nama_lengkap', 'nisn', 'nik', 'tempat_lahir', 'tanggal_lahir', 
            'jenis_kelamin', 'agama', 'tinggi_badan', 'berat_badan', 
            'asal_sekolah', 'anak_ke'
        ])]);

        session(['biodata_step' => 2]);

        return redirect()->route('user.biodata.step2')->with('success', 'Data Diri tersimpan, silakan lanjutkan ke step 2');
    }

    public function storeStep2(Request $request)
    {
        // Ambil data step 1 dari session
        $step1Data = session('biodata_step1_data');
        
        if (!$step1Data) {
            return redirect()->route('user.biodata.step1')->with('error', 'Session expired, silakan mulai dari awal');
        }

        $request->validate([
            'alamat' => 'required|string|min:5|max:255',
            'desa' => 'nullable|string|max:100',
            'kelurahan' => 'nullable|string|max:100',
            'kecamatan' => 'required|string|max:100',
            'kota' => 'required|string|max:100',
            'no_hp' => 'nullable|numeric|digits_between:10,13',
            'jurusan_id' => 'required|exists:jurusan,id',
            'gelombang_id' => 'required|exists:gelombang_pendaftaran,id',
        ], [
            'alamat.required' => 'Alamat Lengkap harus diisi',
            'alamat.min' => 'Alamat minimal 5 karakter',
            'kecamatan.required' => 'Kecamatan harus diisi',
            'kota.required' => 'Kota harus diisi',
            'no_hp.numeric' => 'No. HP hanya boleh angka',
            'no_hp.digits_between' => 'No. HP harus 10-13 digit',
            'jurusan_id.required' => 'Jurusan harus dipilih',
            'gelombang_id.required' => 'Gelombang Pendaftaran harus dipilih',
        ]);

        // Merge semua data
        $allData = [
            'nama_lengkap' => $step1Data['nama_lengkap'],
            'nisn' => $step1Data['nisn'],
            'nik' => $step1Data['nik'],
            'tempat_lahir' => $step1Data['tempat_lahir'],
            'tanggal_lahir' => $step1Data['tanggal_lahir'],
            'jenis_kelamin' => $step1Data['jenis_kelamin'] === 'L' ? 'Laki-laki' : 'Perempuan',
            'agama' => $step1Data['agama'],
            'tinggi_badan' => $step1Data['tinggi_badan'] ?? null,
            'berat_badan' => $step1Data['berat_badan'] ?? null,
            'asal_sekolah' => $step1Data['asal_sekolah'],
            'anak_ke' => $step1Data['anak_ke'] ?? 0,
            'alamat' => $request->alamat,
            'kelurahan_desa' => ($request->kelurahan ?? '') . ($request->desa ? ', ' . $request->desa : ''),
            'kecamatan' => $request->kecamatan,
            'kota' => $request->kota,
            'no_hp' => $request->no_hp,
            'jurusan_id' => $request->jurusan_id,
            'gelombang_id' => $request->gelombang_id,
            'status_pendaftaran' => 'Lengkap',
        ];

        // Cek apakah sudah ada formulir, jika belum ada generate nomor_pendaftaran
        $existingForm = FormulirPendaftaran::where('user_id', Auth::id())->first();
        if (!$existingForm) {
            $allData['nomor_pendaftaran'] = $this->generateNomorPendaftaran();
        }

        // Simpan ke database
        $form = FormulirPendaftaran::updateOrCreate(
            ['user_id' => Auth::id()],
            $allData
        );

        // Clear session
        session()->forget(['biodata_step1_data', 'biodata_step']);

        return redirect()->route('user.biodata')->with('success', 'Biodata berhasil disimpan');
    }

    /**
     * Generate nomor pendaftaran unik
     */
    private function generateNomorPendaftaran()
    {
        $year = date('Y');
        $month = date('m');
        $count = FormulirPendaftaran::whereYear('created_at', $year)->whereMonth('created_at', $month)->count() + 1;
        
        return sprintf('REG-%s%s-%05d', $year, $month, $count);
    }

    public function dashboard()
    {
        $biodata = FormulirPendaftaran::where('user_id', Auth::id())->first();
        $orangTua = $biodata ? \App\Models\OrangTua::where('formulir_id', $biodata->id)->first() : null;
        $pembayaran = $biodata ? \App\Models\Pembayaran::where('formulir_id', $biodata->id)->first() : null;
        $dokumen = $biodata ? \App\Models\Document::where('formulir_id', $biodata->id)->get() : collect();
        return view('user.dashboard', compact('biodata', 'orangTua', 'pembayaran', 'dokumen'));
    }

    public function storeBiodata(Request $request)
    {

        $request->validate([
            'nama_lengkap' => 'required|string|max:100|regex:/^[a-zA-Z\s]+$/',
            'nisn' => 'required|numeric|digits:10|unique:formulir_pendaftaran,nisn',
            'nik' => 'required|numeric|digits:16|unique:formulir_pendaftaran,nik',
            'tempat_lahir' => 'required|string|max:100|regex:/^[a-zA-Z\s]+$/',
            'tanggal_lahir' => 'required|date|before:today|after:1990-01-01',
            'jenis_kelamin' => 'required|in:L,P',
            'agama' => 'required|in:Islam,Kristen,Katolik,Hindu,Buddha,Konghucu',
            'tinggi_badan' => 'nullable|numeric|min:50|max:250',
            'berat_badan' => 'nullable|numeric|min:20|max:200',
            'asal_sekolah' => 'required|string|max:100',
            'anak_ke' => 'nullable|numeric|min:1|max:20',
            'alamat' => 'required|string|min:5|max:255',
            'desa' => 'nullable|string|max:100',
            'kelurahan' => 'nullable|string|max:100',
            'kecamatan' => 'required|string|max:100',
            'kota' => 'required|string|max:100',
            'no_hp' => 'nullable|numeric|digits_between:10,13',
            'jurusan_id' => 'required|exists:jurusan,id',
            'gelombang_id' => 'required|exists:gelombang_pendaftaran,id',
        ], [
            // Nama Lengkap
            'nama_lengkap.required' => 'Nama Lengkap harus diisi',
            'nama_lengkap.string' => 'Nama Lengkap harus berupa teks',
            'nama_lengkap.max' => 'Nama Lengkap maksimal 100 karakter',
            'nama_lengkap.regex' => 'Nama Lengkap hanya boleh berisi huruf dan spasi (tidak boleh angka atau simbol)',
            
            // NISN
            'nisn.required' => 'NISN harus diisi',
            'nisn.numeric' => 'NISN harus berisi angka saja (tidak boleh huruf)',
            'nisn.digits' => 'NISN harus terdiri dari 10 angka',
            'nisn.unique' => 'NISN sudah terdaftar di sistem',
            
            // NIK
            'nik.required' => 'NIK harus diisi',
            'nik.numeric' => 'NIK harus berisi angka saja (tidak boleh huruf)',
            'nik.digits' => 'NIK harus terdiri dari 16 angka',
            'nik.unique' => 'NIK sudah terdaftar di sistem',
            
            // Tempat Lahir
            'tempat_lahir.required' => 'Tempat Lahir harus diisi',
            'tempat_lahir.regex' => 'Tempat Lahir hanya boleh berisi huruf dan spasi',
            
            // Tanggal Lahir
            'tanggal_lahir.required' => 'Tanggal Lahir harus diisi',
            'tanggal_lahir.date' => 'Tanggal Lahir harus format tanggal yang valid (YYYY-MM-DD)',
            'tanggal_lahir.before' => 'Tanggal Lahir tidak boleh di masa depan',
            'tanggal_lahir.after' => 'Tanggal Lahir tidak valid (terlalu jauh ke belakang)',
            
            // Jenis Kelamin
            'jenis_kelamin.required' => 'Jenis Kelamin harus dipilih',
            'jenis_kelamin.in' => 'Jenis Kelamin harus dipilih dengan benar',
            
            // Agama
            'agama.required' => 'Agama harus dipilih',
            'agama.in' => 'Agama harus dipilih dari daftar yang tersedia',
            
            // Tinggi Badan
            'tinggi_badan.numeric' => 'Tinggi Badan harus berupa angka',
            'tinggi_badan.min' => 'Tinggi Badan minimal 50 cm',
            'tinggi_badan.max' => 'Tinggi Badan maksimal 250 cm',
            
            // Berat Badan
            'berat_badan.numeric' => 'Berat Badan harus berupa angka',
            'berat_badan.min' => 'Berat Badan minimal 20 kg',
            'berat_badan.max' => 'Berat Badan maksimal 200 kg',
            
            // Asal Sekolah
            'asal_sekolah.required' => 'Asal Sekolah harus diisi',
            'asal_sekolah.string' => 'Asal Sekolah harus berupa teks',
            
            // Anak ke
            'anak_ke.numeric' => 'Anak ke- harus berupa angka',
            'anak_ke.min' => 'Anak ke- minimal 1',
            'anak_ke.max' => 'Anak ke- maksimal 20',
            
            // Alamat
            'alamat.required' => 'Alamat Lengkap harus diisi',
            'alamat.min' => 'Alamat Lengkap minimal 5 karakter',
            'alamat.max' => 'Alamat Lengkap maksimal 255 karakter',
            
            // Lokasi
            'kecamatan.required' => 'Kecamatan harus diisi',
            'kota.required' => 'Kota harus diisi',
            
            // No HP
            'no_hp.numeric' => 'Nomor HP harus berisi angka saja',
            'no_hp.digits_between' => 'Nomor HP harus antara 10-13 digit',
            
            // Jurusan & Gelombang
            'jurusan_id.required' => 'Jurusan harus dipilih',
            'jurusan_id.exists' => 'Jurusan yang dipilih tidak valid',
            'gelombang_id.required' => 'Gelombang Pendaftaran harus dipilih',
            'gelombang_id.exists' => 'Gelombang yang dipilih tidak valid',
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
