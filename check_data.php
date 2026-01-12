<?php
require 'vendor/autoload.php';
$app = require_once 'bootstrap/app.php';
$app->make(Illuminate\Contracts\Console\Kernel::class)->bootstrap();

$count = App\Models\FormulirPendaftaran::count();
echo 'Total formulir: ' . $count . PHP_EOL;

$pendaftar = App\Models\FormulirPendaftaran::with('jurusan', 'gelombang', 'user')->get();
foreach($pendaftar as $p) {
    echo 'ID: ' . $p->id . ' - Nama: ' . $p->nama_lengkap . ' - Status: ' . ($p->status_pendaftaran ?? 'NULL') . PHP_EOL;
}
?>