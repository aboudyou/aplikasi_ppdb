<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\GelombangPendaftaran;
use Illuminate\Http\Request;

class GelombangController extends Controller
{
    public function index()
    {
        $gelombang = GelombangPendaftaran::all();
        return view('admin.gelombang.index', compact('gelombang'));
    }

    public function create()
    {
        return view('admin.gelombang.create');
    }

    public function store(Request $request)
    {
        $request->validate([
            'nama_gelombang' => 'required|string',
            'tanggal_mulai' => 'required|date',
            'tanggal_selesai' => 'required|date',
            'nilai' => 'required|numeric|min:0',
            'kuota_maksimal' => 'nullable|integer|min:0',
            'jenis_promo' => 'nullable|in:diskon,potongan',
            'nilai_promo' => 'nullable|numeric|min:0',
            'tipe_nilai_promo' => 'nullable|in:nominal,persen',
            'catatan' => 'nullable|string',
            'keterangan' => 'nullable|string',
        ]);

        GelombangPendaftaran::create($request->all());

        return redirect()->route('admin.gelombang.index')->with('success', 'Gelombang berhasil ditambahkan.');
    }

    public function edit($id)
    {
        $gelombang = GelombangPendaftaran::findOrFail($id);
        return view('admin.gelombang.edit', compact('gelombang'));
    }

    public function update(Request $request, $id)
    {
        $request->validate([
            'nama_gelombang' => 'required|string',
            'tanggal_mulai' => 'required|date',
            'tanggal_selesai' => 'required|date',
            'nilai' => 'required|numeric|min:0',
            'kuota_maksimal' => 'nullable|integer|min:0',
            'jenis_promo' => 'nullable|in:diskon,potongan',
            'nilai_promo' => 'nullable|numeric|min:0',
            'tipe_nilai_promo' => 'nullable|in:nominal,persen',
            'catatan' => 'nullable|string',
            'keterangan' => 'nullable|string',
        ]);

        $gelombang = GelombangPendaftaran::findOrFail($id);
        $gelombang->update($request->all());

        return redirect()->route('admin.gelombang.index')->with('success', 'Gelombang berhasil diperbarui.');
    }

    public function destroy($id)
    {
        $gelombang = GelombangPendaftaran::findOrFail($id);
        $gelombang->delete();

        return redirect()->route('admin.gelombang.index')->with('success', 'Gelombang berhasil dihapus.');
    }
}
