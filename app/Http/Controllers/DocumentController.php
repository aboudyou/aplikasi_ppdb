<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Document;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Storage;

class DocumentController extends Controller
{
    public function index()
    {
        $documents = Document::where('user_id', Auth::id())->get();
        return view('user.documents', compact('documents'));
    }

    public function store(Request $request)
    {
        $request->validate([
            'nama_dokumen' => 'required|string',
            'file' => 'required|mimes:pdf,jpg,png,jpeg|max:2048',
        ], [
            'nama_dokumen.required' => 'Nama dokumen harus dipilih',
            'file.required' => 'File harus diunggah',
            'file.mimes' => 'Tipe file harus: PDF, JPG, JPEG, atau PNG',
            'file.max' => 'Ukuran file maksimal 2MB',
        ]);

        // Cek apakah dokumen dengan nama yang sama sudah ada untuk user ini
        $exists = Document::where('user_id', Auth::id())
                         ->where('nama_dokumen', $request->nama_dokumen)
                         ->exists();

        if ($exists) {
            return redirect()->back()
                ->withInput()
                ->with('error', "Dokumen '{$request->nama_dokumen}' sudah pernah Anda upload. Silakan hapus dokumen lama terlebih dahulu jika ingin mengganti dengan yang baru.");
        }

        // Simpan file ke storage/app/public/documents
        $path = $request->file('file')->store('documents', 'public');

        // Simpan ke database
        Document::create([
            'user_id' => Auth::id(),
            'nama_dokumen' => $request->nama_dokumen,
            'file_path' => $path, // ✅ inilah path yang akan dipakai nanti
        ]);

        return redirect()->back()->with('success', 'Dokumen berhasil diunggah!');
    }

    public function show($id)
    {
        $document = Document::where('id', $id)
                            ->where('user_id', Auth::id())
                            ->firstOrFail();

        // Dapatkan path file dari storage
        $filePath = storage_path('app/public/' . $document->file_path);

        // Pastikan file ada dan bisa diakses
        if (!file_exists($filePath)) {
            abort(404, 'File tidak ditemukan.');
        }

        // Kembalikan file agar bisa dilihat di browser
        return response()->file($filePath);
    }

    public function destroy($id)
    {
        $document = Document::where('id', $id)
                            ->where('user_id', Auth::id())
                            ->firstOrFail();

        // Hapus file dari storage
        Storage::disk('public')->delete($document->file_path);

        // Hapus data dari database
        $document->delete();

        return redirect()->back()->with('success', 'Dokumen berhasil dihapus!');
    }
}
