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

        return view('user.orangtua', compact('orangTua'));
    }

    public function store(Request $request)
    {
        $request->validate([
            'nama_ayah' => 'required|string|max:255',
            'tanggal_lahir_ayah' => 'required|date',
            'pekerjaan_ayah' => 'required|string|max:255',
            'penghasilan_ayah' => 'required|numeric',
            'alamat_ayah' => 'required|string',
            'no_hp_ayah' => 'required|string|max:15',
            'nik_ayah' => 'required|string|max:16',
            'pendidikan_ayah' => 'required|string|max:255',
            'nama_ibu' => 'required|string|max:255',
            'tanggal_lahir_ibu' => 'required|date',
            'pekerjaan_ibu' => 'required|string|max:255',
            'penghasilan_ibu' => 'required|numeric',
            'alamat_ibu' => 'required|string',
            'no_hp_ibu' => 'required|string|max:15',
            'nik_ibu' => 'required|string|max:16',
            'pendidikan_ibu' => 'required|string|max:255',
            'nama_wali' => 'nullable|string|max:255',
            'tanggal_lahir_wali' => 'nullable|date',
            'pekerjaan_wali' => 'nullable|string|max:255',
            'penghasilan_wali' => 'nullable|numeric',
            'alamat_wali' => 'nullable|string',
            'no_hp_wali' => 'nullable|string|max:15',
            'nik_wali' => 'nullable|string|max:16',
            'pendidikan_wali' => 'nullable|string|max:255',
        ]);

        $user = Auth::user();
        $formulir = FormulirPendaftaran::where('user_id', $user->id)->first();

        if (!$formulir) {
            return redirect()->route('user.biodata')->with('error', 'Silakan isi biodata siswa terlebih dahulu.');
        }

        OrangTua::updateOrCreate(
            ['formulir_id' => $formulir->id],
            $request->all()
        );

        return redirect()->route('user.orangtua')->with('success', 'Data orang tua berhasil disimpan.');
    }
}