<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\OrangTua;
use App\Models\FormulirPendaftaran;
use Illuminate\Support\Facades\Auth;

class OrangTuaController extends Controller
{
    public function index()
    {
        $user = Auth::user();
        $formulir = FormulirPendaftaran::where('user_id', $user->id)->first();
        $orangTua = $formulir ? OrangTua::where('formulir_id', $formulir->id)->first() : null;

        // Jika data sudah ada, tampilkan summary
        if ($orangTua) {
            return view('user.orangtua.summary', compact('orangTua'));
        }

        // Jika belum ada data, redirect ke step 1
        return redirect()->route('user.orangtua.step1');
    }

    public function step1()
    {
        $orangTua = $this->getOrangTuaData();
        
        if ($orangTua) {
            return view('user.orangtua.summary', compact('orangTua'));
        }

        return view('user.orangtua.step1');
    }

    public function step2()
    {
        // Redirect ke step 1 jika belum ada data di session
        if (!session()->has('orangtua_step1_data')) {
            return redirect()->route('user.orangtua.step1')->with('error', 'Silakan lengkapi step 1 terlebih dahulu');
        }

        return view('user.orangtua.step2');
    }

    public function storeStep1(Request $request)
    {
        $request->validate([
            'nama_ayah' => 'required|string|max:255|regex:/^[a-zA-Z\s]+$/',
            'tanggal_lahir_ayah' => 'required|date|before:today',
            'pekerjaan_ayah' => 'required|string|max:255',
            'penghasilan_ayah' => 'required|numeric|min:0',
            'alamat_ayah' => 'required|string|min:5|max:255',
            'no_hp_ayah' => 'required|numeric|digits_between:10,13',
            'nik_ayah' => 'required|numeric|digits:16',
            'pendidikan_ayah' => 'required|in:SD,SMP,SMA/SMK,D1,D2,D3,S1,S2,S3,Lainnya',
        ], [
            'nama_ayah.required' => 'Nama Ayah harus diisi',
            'nama_ayah.regex' => 'Nama Ayah hanya boleh berisi huruf dan spasi',
            'tanggal_lahir_ayah.required' => 'Tanggal Lahir Ayah harus diisi',
            'tanggal_lahir_ayah.before' => 'Tanggal Lahir Ayah tidak valid',
            'pekerjaan_ayah.required' => 'Pekerjaan Ayah harus diisi',
            'penghasilan_ayah.required' => 'Penghasilan Ayah harus diisi',
            'penghasilan_ayah.numeric' => 'Penghasilan Ayah harus berupa angka',
            'alamat_ayah.required' => 'Alamat Ayah harus diisi',
            'alamat_ayah.min' => 'Alamat Ayah minimal 5 karakter',
            'no_hp_ayah.required' => 'No. HP Ayah harus diisi',
            'no_hp_ayah.numeric' => 'No. HP Ayah hanya boleh angka',
            'no_hp_ayah.digits_between' => 'No. HP Ayah harus 10-13 digit',
            'nik_ayah.required' => 'NIK Ayah harus diisi',
            'nik_ayah.numeric' => 'NIK Ayah hanya boleh angka',
            'nik_ayah.digits' => 'NIK Ayah harus 16 digit',
            'pendidikan_ayah.required' => 'Pendidikan Ayah harus dipilih',
        ]);

        // Simpan ke session
        session(['orangtua_step1_data' => $request->only([
            'nama_ayah', 'tanggal_lahir_ayah', 'pekerjaan_ayah', 'penghasilan_ayah',
            'alamat_ayah', 'no_hp_ayah', 'nik_ayah', 'pendidikan_ayah'
        ])]);

        return redirect()->route('user.orangtua.step2')->with('success', 'Data Ayah tersimpan, silakan lanjutkan ke step 2');
    }

    public function storeStep2(Request $request)
    {
        $step1Data = session('orangtua_step1_data');
        
        if (!$step1Data) {
            return redirect()->route('user.orangtua.step1')->with('error', 'Session expired, silakan mulai dari awal');
        }

        $request->validate([
            'nama_ibu' => 'required|string|max:255|regex:/^[a-zA-Z\s]+$/',
            'tanggal_lahir_ibu' => 'required|date|before:today',
            'pekerjaan_ibu' => 'required|string|max:255',
            'penghasilan_ibu' => 'required|numeric|min:0',
            'alamat_ibu' => 'required|string|min:5|max:255',
            'no_hp_ibu' => 'required|numeric|digits_between:10,13',
            'nik_ibu' => 'required|numeric|digits:16',
            'pendidikan_ibu' => 'required|in:SD,SMP,SMA/SMK,D1,D2,D3,S1,S2,S3,Lainnya',
            'nama_wali' => 'nullable|string|max:255|regex:/^[a-zA-Z\s]+$/',
            'tanggal_lahir_wali' => 'nullable|date|before:today',
            'pekerjaan_wali' => 'nullable|string|max:255',
            'penghasilan_wali' => 'nullable|numeric|min:0',
            'alamat_wali' => 'nullable|string|min:5|max:255',
            'no_hp_wali' => 'nullable|numeric|digits_between:10,13',
            'nik_wali' => 'nullable|numeric|digits:16',
            'pendidikan_wali' => 'nullable|in:SD,SMP,SMA/SMK,D1,D2,D3,S1,S2,S3,Lainnya',
        ], [
            'nama_ibu.required' => 'Nama Ibu harus diisi',
            'nama_ibu.regex' => 'Nama Ibu hanya boleh berisi huruf dan spasi',
            'tanggal_lahir_ibu.required' => 'Tanggal Lahir Ibu harus diisi',
            'tanggal_lahir_ibu.before' => 'Tanggal Lahir Ibu tidak valid',
            'pekerjaan_ibu.required' => 'Pekerjaan Ibu harus diisi',
            'penghasilan_ibu.required' => 'Penghasilan Ibu harus diisi',
            'alamat_ibu.required' => 'Alamat Ibu harus diisi',
            'no_hp_ibu.required' => 'No. HP Ibu harus diisi',
            'no_hp_ibu.numeric' => 'No. HP Ibu hanya boleh angka',
            'no_hp_ibu.digits_between' => 'No. HP Ibu harus 10-13 digit',
            'nik_ibu.required' => 'NIK Ibu harus diisi',
            'nik_ibu.numeric' => 'NIK Ibu hanya boleh angka',
            'nik_ibu.digits' => 'NIK Ibu harus 16 digit',
            'pendidikan_ibu.required' => 'Pendidikan Ibu harus dipilih',
            'nama_wali.regex' => 'Nama Wali hanya boleh berisi huruf dan spasi',
            'no_hp_wali.numeric' => 'No. HP Wali hanya boleh angka',
            'no_hp_wali.digits_between' => 'No. HP Wali harus 10-13 digit',
            'nik_wali.numeric' => 'NIK Wali hanya boleh angka',
            'nik_wali.digits' => 'NIK Wali harus 16 digit',
        ]);

        // Merge semua data
        $allData = array_merge($step1Data, $request->only([
            'nama_ibu', 'tanggal_lahir_ibu', 'pekerjaan_ibu', 'penghasilan_ibu',
            'alamat_ibu', 'no_hp_ibu', 'nik_ibu', 'pendidikan_ibu',
            'nama_wali', 'tanggal_lahir_wali', 'pekerjaan_wali', 'penghasilan_wali',
            'alamat_wali', 'no_hp_wali', 'nik_wali', 'pendidikan_wali'
        ]));

        // Simpan ke database
        $user = Auth::user();
        $formulir = FormulirPendaftaran::where('user_id', $user->id)->first();

        if (!$formulir) {
            return redirect()->route('user.biodata')->with('error', 'Silakan isi biodata siswa terlebih dahulu.');
        }

        OrangTua::updateOrCreate(
            ['formulir_id' => $formulir->id],
            $allData
        );

        // Clear session
        session()->forget(['orangtua_step1_data']);

        return redirect()->route('user.orangtua')->with('success', 'Data orang tua berhasil disimpan');
    }

    public function store(Request $request)
    {
        // Legacy method untuk backward compatibility
        return $this->storeStep1($request);
    }

    private function getOrangTuaData()
    {
        $user = Auth::user();
        $formulir = FormulirPendaftaran::where('user_id', $user->id)->first();
        return $formulir ? OrangTua::where('formulir_id', $formulir->id)->first() : null;
    }
}