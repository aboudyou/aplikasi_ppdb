<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\User;
use App\Models\GelombangPendaftaran;
use App\Models\FormulirPendaftaran;
use App\Models\Pembayaran;

class TestPembayaranSeeder extends Seeder
{
    public function run()
    {
        // Pastikan ada gelombang
        $gel = GelombangPendaftaran::first();
        if (!$gel) {
            $gel = GelombangPendaftaran::create([
                'nama_gelombang' => 'Gelombang Test',
                'tanggal_mulai' => now()->subDays(10),
                'tanggal_selesai' => now()->addDays(10),
                'nilai' => 100000,
                'kuota_maksimal' => 0,
            ]);
            echo "Created gelombang id={$gel->id}\n";
        }

        // Pastikan ada admin
        $admin = User::where('role', 'admin')->first();
        if (!$admin) {
            $admin = User::create([
                'name' => 'Admin Test',
                'username' => 'admin_test',
                'email' => 'admin@test.local',
                'password' => 'password',
                'role' => 'admin',
            ]);
            echo "Created admin id={$admin->id}\n";
        }

        // Buat user siswa
        $user = User::create([
            'name' => 'Siswa Test',
            'username' => 'siswa_test_' . time(),
            'email' => 'siswa' . time() . '@test.local',
            'password' => 'password',
            'role' => 'user',
        ]);

        // Pastikan ada jurusan
        $jur = \App\Models\Jurusan::first();
        if (!$jur) {
            $jur = \App\Models\Jurusan::create(['nama_jurusan' => 'Jurusan Test']);
        }

        // Buat formulir untuk siswa (sesuaikan kolom yang ada di migration)
        $form = FormulirPendaftaran::create([
            'user_id' => $user->id,
            'nomor_pendaftaran' => 'TEST-' . time(),
            'nama_lengkap' => $user->name,
            'jenis_kelamin' => 'Laki-laki',
            'tinggi_badan' => 170,
            'berat_badan' => 60,
            'nisn' => (string) time(),
            'asal_sekolah' => 'Sekolah Test',
            'tempat_lahir' => 'Jakarta',
            'tanggal_lahir' => now()->subYears(16)->toDateString(),
            'agama' => 'Islam',
            'nik' => (string) (time() + 1000),
            'anak_ke' => 1,
            'alamat' => 'Alamat Test',
            'kelurahan_desa' => 'Kelurahan Test',
            'kecamatan' => 'Kecamatan Test',
            'kota' => 'Kota Test',
            'no_hp' => '0812345' . rand(1000,9999),
            'jurusan_id' => $jur->id,
            'gelombang_id' => $gel->id,
            'status_pendaftaran' => 'Lengkap',
        ]);

        // Buat pembayaran menunggu
        $pembayaran = Pembayaran::create([
            'formulir_id' => $form->id,
            'gelombang_id' => $gel->id,
            'metode_bayar' => 'Transfer Bank',
            'bukti_bayar' => 'test-bukti.jpg',
            'status' => 'Menunggu',
            'jumlah_bayar' => $gel->getBiayaAkhir(),
        ]);

        echo "Created pembayaran id={$pembayaran->id} status={$pembayaran->status} jumlah_bayar={$pembayaran->jumlah_bayar}\n";

        // Simulasikan admin approve (seperti controller)
        $pembayaran->update([
            'status' => 'Lunas',
            'admin_verifikasi_id' => $admin->id,
            'verified_at' => now(),
        ]);

        $pembayaran->refresh();
        echo "After approve: id={$pembayaran->id} status={$pembayaran->status} admin_verifikasi_id={$pembayaran->admin_verifikasi_id} verified_at={$pembayaran->verified_at}\n";
    }
}
