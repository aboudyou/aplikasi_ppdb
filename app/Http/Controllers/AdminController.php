<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class AdminController extends Controller
{
    public function verifikasi()
    {
        return view('admin.verifikasi');
    }

    public function seleksi()
    {
        return view('admin.seleksi');
    }

    public function pengumuman()
    {
        return view('admin.pengumuman');
    }

    public function laporan()
    {
        return view('admin.laporan');
    }
}
