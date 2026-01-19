<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class OrangTua extends Model
{
    use HasFactory;

    protected $table = 'orang_tua';

    protected $fillable = [
        'formulir_id',
        'nama_ayah',
        'tanggal_lahir_ayah',
        'pekerjaan_ayah',
        'penghasilan_ayah',
        'alamat_ayah',
        'no_hp_ayah',
        'nik_ayah',
        'pendidikan_ayah',
        'nama_ibu',
        'tanggal_lahir_ibu',
        'pekerjaan_ibu',
        'penghasilan_ibu',
        'alamat_ibu',
        'no_hp_ibu',
        'nik_ibu',
        'pendidikan_ibu',
        'nama_wali',
        'tanggal_lahir_wali',
        'pekerjaan_wali',
        'penghasilan_wali',
        'alamat_wali',
        'no_hp_wali',
        'nik_wali',
        'pendidikan_wali',
    ];

    public function formulir()
    {
        return $this->belongsTo(FormulirPendaftaran::class);
    }
}
