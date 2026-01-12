<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class JurusanSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        DB::table('jurusan')->insert([
            [
                'nama_jurusan' => 'RPL',
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'nama_jurusan' => 'TITL',
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'nama_jurusan' => 'TKR',
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'nama_jurusan' => 'TPM',
                'created_at' => now(),
                'updated_at' => now(),
            ],
        ]);
    }
}
