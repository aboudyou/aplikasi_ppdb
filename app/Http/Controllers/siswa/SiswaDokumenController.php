<?php

namespace App\Http\Controllers\Siswa;

use Illuminate\Http\Request;
use App\Models\Document;
use App\Models\FormulirPendaftaran;
use App\Http\Controllers\Controller;

class SiswaDokumenController extends Controller
{
   public function index()
{
    $documents = Document::whereHas('formulir', function ($q) {
        $q->where('user_id', auth()->id());
    })->get();

 
    return view('user.documents', compact('documents'));
}


    public function store(Request $request)
    {
        $request->validate([
            'nama_dokumen' => 'required',
            'file' => 'required|mimes:jpg,jpeg,png,pdf|max:2048',
        ]);

        // Pastikan user sudah mengisi biodata (formulir)
        $form = FormulirPendaftaran::where('user_id', auth()->id())->first();
        if (!$form) {
            return back()->with('error', 'Lengkapi biodata/formulir terlebih dahulu sebelum mengunggah dokumen.');
        }

        $file = $request->file('file');
        $fileName = time() . '-' . $file->getClientOriginalName();
        $file->move(public_path('uploads'), $fileName);

        Document::create([
            'formulir_id' => $form->id,
            'jenis_dokumen' => $request->nama_dokumen,
            'path_file' => $fileName,
        ]);

        return back()->with('success', 'Dokumen berhasil diupload!');
    }

    public function destroy($id)
    {
        $doc = Document::where('id', $id)
                       ->whereHas('formulir', function ($q) {
                           $q->where('user_id', auth()->id());
                       })->first();

        if (!$doc) {
            return back()->with('error', 'Dokumen tidak ditemukan.');
        }

        $filePath = public_path('uploads/' . $doc->path_file);
        if (file_exists($filePath)) {
            unlink($filePath);
        }

        $doc->delete();

        return back()->with('success', 'Dokumen berhasil dihapus!');
    }
}
