<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Pembayaran extends Model
{
    use HasFactory;

    protected $table = 'pembayaran';

    protected $fillable = [
        'formulir_id',
        'gelombang_id',
        'tanggal_bayar',
        'metode_bayar',
        'status',
        'no_kuitansi',
        'bukti_bayar',
        'admin_verifikasi_id',
        'verified_at',
        'catatan',
        'path_nota_pdf',
        'jumlah_bayar',
    ];

    protected $casts = [
        'tanggal_bayar' => 'datetime',
        'verified_at' => 'datetime',
    ];

    public function formulir()
    {
        return $this->belongsTo(FormulirPendaftaran::class, 'formulir_id');
    }

    public function gelombang()
    {
        return $this->belongsTo(GelombangPendaftaran::class, 'gelombang_id');
    }

    public function adminVerifikasi()
    {
        return $this->belongsTo(User::class, 'admin_verifikasi_id');
    }
}
