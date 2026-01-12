<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class BiodataUser extends Model
{
    use HasFactory;

    protected $table = 'biodata_user'; // sesuaikan dengan nama tabelmu
    protected $fillable = [
        'user_id',
        'nama_lengkap',
        'nisn',
        'nik',
        'tempat_lahir',
        'tanggal_lahir',
        'jenis_kelamin',
        'agama',
        'tinggi_badan',
        'berat_badan',
        'asal_sekolah',
        'anak_ke',
        'desa',
        'kelurahan',
        'kecamatan',
        'kota',
        'no_hp',
        'alamat',
        'jurusan_id',
        'gelombang_id'
    ];

    public function user()
    {
        return $this->belongsTo(User::class);
    }

    public function jurusan()
    {
        return $this->belongsTo(Jurusan::class);
    }

    public function gelombang()
    {
        return $this->belongsTo(GelombangPendaftaran::class, 'gelombang_id');
    }
}
