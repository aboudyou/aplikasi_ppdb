<?php

namespace App\Console\Commands;

use App\Models\User;
use App\Models\BiodataUser;
use App\Models\FormulirPendaftaran;
use App\Models\OrangTua;
use App\Models\Document;
use App\Models\Pembayaran;
use App\Models\StatusSeleksi;
use Illuminate\Console\Command;

class ResetUserAccount extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'user:reset {email}';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Reset akun user ke status awal (seperti baru mendaftar)';

    /**
     * Execute the console command.
     */
    public function handle()
    {
        $email = $this->argument('email');

        // Cari user berdasarkan email
        $user = User::where('email', $email)->first();

        if (!$user) {
            $this->error("User dengan email '{$email}' tidak ditemukan!");
            return 1;
        }

        $this->info("Ditemukan user: {$user->name} ({$user->email})");
        $this->warn('WARNING: Operasi ini akan menghapus semua data pendaftaran, biodata, orangtua, dokumen, dan pembayaran!');

        // Konfirmasi
        if (!$this->confirm('Apakah Anda yakin ingin mereset akun ini?')) {
            $this->info('Reset dibatalkan.');
            return 0;
        }

        try {
            // Hapus status seleksi terlebih dahulu (jika tabel ada)
            try {
                StatusSeleksi::where('user_id', $user->id)->delete();
                $this->info('✓ Status seleksi dihapus');
            } catch (\Exception $e) {
                // Tabel tidak ada, skip
            }

            // Cari formulir pendaftaran yang terkait
            $formulir = FormulirPendaftaran::where('user_id', $user->id)->first();

            if ($formulir) {
                // Hapus pembayaran
                Pembayaran::where('formulir_id', $formulir->id)->delete();
                $this->info('✓ Data pembayaran dihapus');

                // Hapus orangtua
                OrangTua::where('formulir_id', $formulir->id)->delete();
                $this->info('✓ Data orangtua dihapus');

                // Hapus dokumen
                Document::where('formulir_id', $formulir->id)->delete();
                $this->info('✓ Dokumen pendaftaran dihapus');

                // Hapus formulir pendaftaran
                $formulir->delete();
                $this->info('✓ Formulir pendaftaran dihapus');
            }

            // Hapus biodata
            try {
                BiodataUser::where('user_id', $user->id)->delete();
                $this->info('✓ Biodata dihapus');
            } catch (\Exception $e) {
                // Tabel tidak ada, skip
            }

            $this->info('');
            $this->line('✅ Reset akun berhasil! Akun sekarang seperti baru (status awal)');
            $this->line("User dapat melakukan pendaftaran ulang melalui aplikasi");

            return 0;

        } catch (\Exception $e) {
            $this->error('❌ Terjadi kesalahan: ' . $e->getMessage());
            return 1;
        }
    }
}
