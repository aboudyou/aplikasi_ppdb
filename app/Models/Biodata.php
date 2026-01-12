<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Biodata extends Model
{
    use HasFactory;

    // Tidak perlu mendefinisikan $table kalau nama tabelnya mengikuti konvensi (biodatas)

    protected $fillable = [
        'user_id',
        'nama',
        'tempat_lahir',
        'tanggal_lahir',
        'alamat',
    ];

    /**
     * Relasi ke tabel users
     * Setiap biodata dimiliki oleh satu user
     */
    public function user()
    {
        return $this->belongsTo(User::class);
    }
}
