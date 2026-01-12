<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\FormulirPendaftaran;
use App\Models\Jurusan;
use App\Models\GelombangPendaftaran;

class LaporanController extends Controller
{
    public function index(Request $request)
    {
        $totalPendaftar = FormulirPendaftaran::count();

        // jumlah per jurusan (nama => total)
        $perJurusan = Jurusan::all()->mapWithKeys(function($j) {
            $count = FormulirPendaftaran::where('jurusan_id', $j->id)->count();
            return [$j->nama_jurusan => $count];
        });

        // jumlah per gelombang
        $perGelombang = GelombangPendaftaran::all()->mapWithKeys(function($g) {
            $count = FormulirPendaftaran::where('gelombang_id', $g->id)->count();
            return [$g->nama_gelombang => $count];
        });

        // list pendaftar (recent) dengan pagination
        $pendaftar = FormulirPendaftaran::with(['user', 'jurusan', 'gelombang'])
                        ->orderBy('created_at', 'desc')
                        ->paginate(25);

        return view('admin.laporan.index', compact(
            'totalPendaftar', 'perJurusan', 'perGelombang', 'pendaftar'
        ));
    }

    public function exportCsv(Request $request)
    {
        $filename = 'laporan_pendaftar_' . date('Ymd_His') . '.csv';
        $columns = ['Nama', 'Email', 'Nomor Pendaftaran', 'Jurusan', 'Gelombang', 'Status', 'No HP', 'Tanggal Daftar'];

        $callback = function () use ($columns) {
            $out = fopen('php://output', 'w');
            fputcsv($out, $columns);

            FormulirPendaftaran::with(['user', 'jurusan', 'gelombang'])->chunk(200, function ($rows) use ($out) {
                foreach ($rows as $r) {
                    fputcsv($out, [
                        $r->nama_lengkap,
                        optional($r->user)->email,
                        $r->nomor_pendaftaran,
                        optional($r->jurusan)->nama_jurusan,
                        optional($r->gelombang)->nama_gelombang,
                        $r->status_pendaftaran,
                        $r->no_hp,
                        $r->created_at ? $r->created_at->format('Y-m-d H:i:s') : '',
                    ]);
                }
            });

            fclose($out);
        };

        return response()->streamDownload($callback, $filename, [
            'Content-Type' => 'text/csv',
            'Content-Disposition' => 'attachment; filename="' . $filename . '"',
        ]);
    }
}
