<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\User;
use App\Models\FormulirPendaftaran;
use Illuminate\Support\Facades\Hash;

class DemoPendaftarSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        // Buat user demo
        $user = User::create([
            'name' => 'Demo Siswa',
            'username' => 'demo.siswa',
            'email' => 'demo.siswa@example.test',
            'password' => Hash::make('password'),
            'no_hp' => '081234567890',
            'role' => 'siswa',
        ]);

        // Buat formulir pendaftaran terkait
        FormulirPendaftaran::create([
            'user_id' => $user->id,
            'nomor_pendaftaran' => 'DEM-001',
            'nama_lengkap' => 'Demo Siswa',
            'jenis_kelamin' => 'Laki-laki',
            'tinggi_badan' => 170,
            'berat_badan' => 60,
            'nisn' => '1234567890',
            'asal_sekolah' => 'SMA Demo',
            'tempat_lahir' => 'Demo City',
            'tanggal_lahir' => '2008-01-01',
            'agama' => 'Islam',
            'nik' => '1234567890123456',
            'anak_ke' => 1,
            'alamat' => 'Jl. Demo No.1',
            'kelurahan_desa' => 'Demo',
            'kecamatan' => 'Demo',
            'kota' => 'Demo',
            'no_hp' => '081234567890',
            'jurusan_id' => 1,
            'gelombang_id' => 1,
            'status_pendaftaran' => 'Lengkap',
            'status_berkas' => 'Lengkap',
            'status_seleksi' => 'Lulus',
            'nilai_rata' => 90,
        ]);
    }
}
