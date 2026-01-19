<?php

namespace App\Http\Controllers;

use App\Models\LogAktivitas;
use Illuminate\Http\Request;

class LogAktivitasController extends Controller
{
    public function index()
    {
        $logs = LogAktivitas::with('user')->orderBy('created_at', 'desc')->paginate(20);

        return view('admin.log_aktivitas.index', compact('logs'));
    }
}