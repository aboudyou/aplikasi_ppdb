<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Pengumuman;
use Illuminate\Http\Request;

class PengumumanController extends Controller
{
    public function index()
    {
        $data = Pengumuman::latest()->get();
        return view('admin.pengumuman.index', compact('data'));
    }

    public function create()
    {
        return view('admin.pengumuman.create');
    }

   public function store(Request $request)
{
    $request->validate([
        'judul' => 'required',
        'isi' => 'required',
    ]);

    Pengumuman::create([
        'judul' => $request->judul,
        'isi' => $request->isi,
        'status' => 'aktif', // default
    ]);

    return redirect()->route('admin.pengumuman.index')
        ->with('success', 'Pengumuman berhasil dibuat');
}
    

    public function edit($id)
    {
        $data = Pengumuman::findOrFail($id);
        return view('admin.pengumuman.edit', compact('data'));
    }

    public function update(Request $request, $id)
    {
        $request->validate([
            'judul' => 'required',
            'isi' => 'required',
            'status' => 'required',
        ]);

        $data = Pengumuman::findOrFail($id);

        $data->update([
            'judul' => $request->judul,
            'isi' => $request->isi,
            'status' => $request->status,
        ]);

        return redirect()->route('admin.pengumuman.index')
            ->with('success', 'Pengumuman berhasil diperbarui');
    }

    public function destroy($id)
    {
        Pengumuman::destroy($id);
        return redirect()->route('admin.pengumuman.index')
            ->with('success', 'Pengumuman dihapus');
    }
}
