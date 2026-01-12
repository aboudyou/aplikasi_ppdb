<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class GelombangSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        DB::table('gelombang_pendaftaran')->insert([
            [
                'nama_gelombang' => 'Gelombang 1',
                'tanggal_mulai' => '2025-01-01',
                'tanggal_selesai' => '2025-02-15',
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'nama_gelombang' => 'Gelombang 2',
                'tanggal_mulai' => '2025-02-16',
                'tanggal_selesai' => '2025-03-30',
                'created_at' => now(),
                'updated_at' => now(),
            ],
        ]);
    }
}
