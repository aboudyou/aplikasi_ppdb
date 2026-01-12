<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\GelombangPendaftaran;

class UpdateGelombangBiayaSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        // Update semua gelombang yang nilai-nya null atau 0 menjadi 500000
        GelombangPendaftaran::whereNull('nilai')
            ->orWhere('nilai', 0)
            ->update(['nilai' => 500000]);

        // Atau jika ingin set biaya per gelombang, bisa lakukan:
        // GelombangPendaftaran::where('nama_gelombang', 'Gelombang 1')->update(['nilai' => 500000]);
        // GelombangPendaftaran::where('nama_gelombang', 'Gelombang 2')->update(['nilai' => 600000]);

        $this->command->info('Biaya gelombang berhasil diperbarui ke Rp 500.000 (default).');
    }
}
