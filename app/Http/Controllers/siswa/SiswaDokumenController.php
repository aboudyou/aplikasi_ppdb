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
        ], [
            'nama_dokumen.required' => 'Nama dokumen harus dipilih',
            'file.required' => 'File harus diunggah',
            'file.mimes' => 'Tipe file harus: JPG, JPEG, PNG, atau PDF',
            'file.max' => 'Ukuran file maksimal 2MB',
        ]);

        // Pastikan user sudah mengisi biodata (formulir)
        $form = FormulirPendaftaran::where('user_id', auth()->id())->first();
        if (!$form) {
            return back()->with('error', 'Lengkapi biodata/formulir terlebih dahulu sebelum mengunggah dokumen.');
        }

        // Cek apakah dokumen dengan nama yang sama sudah ada
        $exists = Document::where('formulir_id', $form->id)
                         ->where('jenis_dokumen', $request->nama_dokumen)
                         ->exists();

        if ($exists) {
            return back()
                ->withInput()
                ->with('error', "Dokumen '{$request->nama_dokumen}' sudah pernah Anda upload. Silakan hapus dokumen lama terlebih dahulu jika ingin mengganti dengan yang baru.");
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

    public function show($id)
    {
        $doc = Document::where('id', $id)
                       ->whereHas('formulir', function ($q) {
                           $q->where('user_id', auth()->id());
                       })->firstOrFail();

        $filePath = public_path('uploads/' . $doc->path_file);

        if (!file_exists($filePath)) {
            abort(404, 'File dokumen tidak ditemukan.');
        }

        return response()->file($filePath);
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
