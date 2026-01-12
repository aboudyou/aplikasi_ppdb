<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\FormulirPendaftaran;
use Illuminate\Support\Facades\Auth;

class StatusSeleksiController extends Controller
{
    public function index()
    {
        $status = FormulirPendaftaran::where('user_id', Auth::id())->first();

        return view('user.status', compact('status'));
    }
}
