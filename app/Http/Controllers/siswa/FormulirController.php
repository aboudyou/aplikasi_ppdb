<?php
namespace App\Http\Controllers\Siswa;

use App\Http\Controllers\Controller;
use App\Models\Jurusan;
use App\Models\Gelombang;
use App\Models\Formulir;
use Illuminate\Http\Request;

class FormulirController extends Controller
{
    public function create()
    {
        $jurusan = Jurusan::all();
        $gelombang = Gelombang::all();

        return view('siswa.formulir.create', compact('jurusan', 'gelombang'));
    }

    public function store(Request $request)
    {
        $request->validate([
            'jurusan_id' => 'required',
            'gelombang_id' => 'required',
            // tambah field lain
        ]);

        Formulir::create([
            'user_id' => auth()->id(),
            'jurusan_id' => $request->jurusan_id,
            'gelombang_id' => $request->gelombang_id,
        ]);

        return redirect()->route('user.formulir.index')
            ->with('success', 'Formulir berhasil dikirim');
    }
}
