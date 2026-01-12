<?php
namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Pengumuman;

class UserPengumumanController extends Controller
{
    public function index()
    {
        // Tampilkan semua pengumuman aktif untuk user
        $pengumuman = Pengumuman::where('status', 'aktif')->orderByDesc('created_at')->get();
        return view('user.pengumuman', compact('pengumuman'));
    }
}
