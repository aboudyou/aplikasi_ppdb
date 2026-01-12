<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\FormulirPendaftaran;
use App\Models\Jurusan;
use App\Models\GelombangPendaftaran;
use App\Models\Pembayaran;

class DashboardController extends Controller
{
    public function index()
    {

        // dd('ok');
        $totalPendaftar = FormulirPendaftaran::count();
        $lengkap =  FormulirPendaftaran::where('status_pendaftaran', 'Lengkap')->count();
        $diverifikasi = FormulirPendaftaran::where('status_pendaftaran', 'Diverifikasi')->count();
        $lulus = FormulirPendaftaran::where('status_pendaftaran', 'diterima')->count();
        $totalPembayaran = Pembayaran::where('status', 'Lunas')->count();
        $pembayaranMenunggu = Pembayaran::where('status', 'Menunggu')->count();
        $totalJurusan =  Jurusan::count();
        $totalGelombang = GelombangPendaftaran::count();
        $perJurusan = FormulirPendaftaran::selectRaw('jurusan_id, COUNT(*) as total')
                    ->groupBy('jurusan_id')
                    ->pluck('total', 'jurusan_id');
    
        $perGelombang = FormulirPendaftaran::selectRaw('gelombang_id, COUNT(*) as total')
                    ->groupBy('gelombang_id')
                    ->pluck('total', 'gelombang_id');
  
        $statusPendaftaran = FormulirPendaftaran::selectRaw('status_pendaftaran, COUNT(*) as total')
                    ->groupBy('status_pendaftaran')
                    ->pluck('total', 'status_pendaftaran'); 
        $pendaftarTerbaru = FormulirPendaftaran::with(['jurusan', 'user'])
                    ->orderBy('created_at', 'DESC')
                    ->limit(8)
                    ->get();

        return view('admin.dashboard', [
            'totalPendaftar'      => $totalPendaftar,
            'lengkap'             => $lengkap,
            'diverifikasi'        => $diverifikasi,
            'lulus'               => $lulus,
            'totalPembayaran'     => $totalPembayaran,
            'pembayaranMenunggu'  => $pembayaranMenunggu,
            'totalJurusan'        => $totalJurusan,
            'totalGelombang'      => $totalGelombang,

            // grafik
            'perJurusan' => $perJurusan,
            
            'perGelombang' => $perGelombang,

            'statusPendaftaran' => $statusPendaftaran,

            'pendaftarTerbaru' => $pendaftarTerbaru,
        ]);
    }
}
