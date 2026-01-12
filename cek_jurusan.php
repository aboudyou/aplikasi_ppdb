<?php
require 'vendor/autoload.php';

$app = require_once 'bootstrap/app.php';
$app->make('Illuminate\Contracts\Console\Kernel')->bootstrap();

use Illuminate\Support\Facades\DB;

// Truncate table
DB::statement('TRUNCATE TABLE jurusan');

// Insert hanya 4 jurusan
DB::table('jurusan')->insert([
    ['nama_jurusan' => 'RPL', 'created_at' => now(), 'updated_at' => now()],
    ['nama_jurusan' => 'TITL', 'created_at' => now(), 'updated_at' => now()],
    ['nama_jurusan' => 'TKR', 'created_at' => now(), 'updated_at' => now()],
    ['nama_jurusan' => 'TPM', 'created_at' => now(), 'updated_at' => now()],
]);

echo "✓ Jurusan berhasil direset!" . PHP_EOL;
echo "Jurusan sekarang:" . PHP_EOL;

$jurusans = DB::table('jurusan')->get();
foreach ($jurusans as $j) {
    echo "- {$j->nama_jurusan}" . PHP_EOL;
}
