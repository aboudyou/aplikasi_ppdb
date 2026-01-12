<?php
require 'vendor/autoload.php';

$app = require_once 'bootstrap/app.php';
$app->make('Illuminate\Contracts\Console\Kernel')->bootstrap();

use Illuminate\Support\Facades\DB;

// Clear all jurusan
DB::table('jurusan')->truncate();

// Insert only 4 jurusan
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

echo "✓ Jurusan berhasil direset ke 4 pilihan (RPL, TITL, TKR, TPM)" . PHP_EOL;
