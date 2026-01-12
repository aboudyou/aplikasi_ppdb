<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;

class User extends Authenticatable
{
    use HasFactory, Notifiable;

    protected $table = 'users';

    protected $fillable = [
        'name',
        'username',
        'email',
        'password',
        'no_hp',
        'role',
    ];

    protected $hidden = [
        'password',
        'remember_token',
    ];

    protected function casts(): array
    {
        return [
            'email_verified_at' => 'datetime',
            'password' => 'hashed',
        ];
    }

    // Relasi ke formulir pendaftaran
    public function formulir()
    {
        return $this->hasOne(FormulirPendaftaran::class, 'user_id');
    }

    // Relasi ke status seleksi
    public function statusSeleksi()
    {
        return $this->hasOne(StatusSeleksi::class, 'user_id');
    }

    // Relasi ke log aktivitas
    public function logAktivitas()
    {
        return $this->hasMany(LogAktivitas::class);
    }

    // Relasi ke pembayaran yg diverifikasi admin
    public function verifikasiPembayaran()
    {
        return $this->hasMany(Pembayaran::class, 'admin_verifikasi_id');
    }

    // Relasi ke biodata
    public function biodata()
    {
        return $this->hasOne(\App\Models\BiodataUser::class, 'user_id');
    }
}
