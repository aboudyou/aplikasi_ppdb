<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class FormulirPendaftaran extends Model
{
    use HasFactory;

    protected $table = 'formulir_pendaftaran';

   protected $fillable = [
    'user_id',
    'nomor_pendaftaran',

    'nama_lengkap',
    'jenis_kelamin',
    'tinggi_badan',
    'berat_badan',
    'nisn',
    'asal_sekolah',

    'tempat_lahir',
    'tanggal_lahir',
    'agama',

    'nik',
    'anak_ke',

    'alamat',
    'kelurahan_desa',
    'kecamatan',
    'kota',
    'no_hp',

    'jurusan_id',
    'gelombang_id',

    'status_pendaftaran',
    'status_berkas',
    'catatan_berkas',
    'status_seleksi',
    'nilai_rata',
];

    /* ===============================
       RELASI
    =============================== */

    // Relasi ke user (1 user punya 1 formulir)
    public function user()
    {
        return $this->belongsTo(User::class);
    }

    // Relasi ke jurusan
    public function jurusan()
    {
        return $this->belongsTo(Jurusan::class);
    }

    // Relasi ke gelombang
    public function gelombang()
    {
        return $this->belongsTo(GelombangPendaftaran::class, 'gelombang_id');
    }

    // Relasi ke dokumen pendaftaran (1 formulir banyak dokumen)
    public function dokumen()
    {
        return $this->hasMany(DokumenPendaftaran::class, 'formulir_id');
    }

    // Relasi ke data orang tua (1 formulir = 1 data orang tua)
    public function orangTua()
    {
        return $this->hasOne(OrangTua::class, 'formulir_id');
    }

    // Relasi ke pembayaran
    public function pembayaran()
    {
        return $this->hasMany(Pembayaran::class, 'formulir_id');
    }
}
