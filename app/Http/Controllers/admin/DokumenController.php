<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Document;
use App\Models\FormulirPendaftaran;
use Illuminate\Http\Request;

class DokumenController extends Controller
{
    /**
     * Tampilkan daftar pendaftar dan dokumen mereka
     */
    public function index(Request $request)
    {
        $query = FormulirPendaftaran::with(['user', 'dokumen', 'jurusan', 'gelombang']);

        // Filter berdasarkan status
        if ($request->filled('status')) {
            $query->where('status_berkas', $request->status);
        }

        // Filter berdasarkan gelombang
        if ($request->filled('gelombang_id')) {
            $query->where('gelombang_id', $request->gelombang_id);
        }

        // Filter berdasarkan jurusan
        if ($request->filled('jurusan_id')) {
            $query->where('jurusan_id', $request->jurusan_id);
        }

        // Search berdasarkan nama atau NISN
        if ($request->filled('search')) {
            $search = $request->search;
            $query->where(function ($q) use ($search) {
                $q->where('nama_lengkap', 'like', "%$search%")
                    ->orWhere('nisn', 'like', "%$search%")
                    ->orWhereHas('user', function ($q) use ($search) {
                        $q->where('name', 'like', "%$search%");
                    });
            });
        }

        $pendaftar = $query->paginate(15);
        
        return view('admin.dokumen.index', compact('pendaftar'));
    }

    /**
     * Tampilkan dokumen dari seorang siswa
     */
    public function show($formulirId)
    {
        $formulir = FormulirPendaftaran::with(['user', 'dokumen', 'jurusan', 'gelombang', 'orangTua'])->findOrFail($formulirId);
        $dokumen = $formulir->dokumen;

        return view('admin.dokumen.show', compact('formulir', 'dokumen'));
    }

    /**
     * Download dokumen
     */
    public function download($dokumentId)
    {
        $dokumen = Document::findOrFail($dokumentId);
        $file = public_path('uploads/' . $dokumen->path_file);

        if (!file_exists($file)) {
            return redirect()->back()->with('error', 'File tidak ditemukan');
        }

        return response()->download($file);
    }

    /**
     * Verifikasi dokumen lengkap
     */
    public function approve($formulirId)
    {
        $formulir = FormulirPendaftaran::findOrFail($formulirId);
        
        // Check apakah ada dokumen yang ada
        $dokumenCount = $formulir->dokumen()->count();
        if ($dokumenCount === 0) {
            return redirect()->back()->with('error', 'Siswa belum upload dokumen apapun');
        }

        $formulir->update([
            'status_berkas' => 'Terverifikasi',
            'status_pendaftaran' => 'Diverifikasi',
        ]);

        return redirect()->back()->with('success', 'Dokumen berhasil diverifikasi');
    }

    /**
     * Tolak verifikasi dokumen
     */
    public function reject(Request $request, $formulirId)
    {
        $request->validate([
            'alasan' => 'required|string|min:10|max:500',
        ], [
            'alasan.required' => 'Alasan penolakan harus diisi',
            'alasan.min' => 'Alasan minimal 10 karakter',
        ]);

        $formulir = FormulirPendaftaran::findOrFail($formulirId);
        $formulir->update([
            'status_berkas' => 'Ditolak',
            'catatan_berkas' => $request->alasan,
        ]);

        return redirect()->back()->with('success', 'Dokumen berhasil ditolak dengan alasan: ' . $request->alasan);
    }

    /**
     * View file dokumen langsung
     */
    public function view($dokumentId)
    {
        $dokumen = Document::findOrFail($dokumentId);
        $file = public_path('uploads/' . $dokumen->path_file);

        if (!file_exists($file)) {
            return redirect()->back()->with('error', 'File tidak ditemukan');
        }

        return response()->file($file);
    }
}
