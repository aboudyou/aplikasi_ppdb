<?php
$pdo = new PDO('mysql:host=127.0.0.1;dbname=aplikasi_ppdb_2', 'root', '');
$stmt = $pdo->prepare("DELETE FROM jurusan WHERE nama_jurusan IN (?, ?, ?, ?, ?)");
$result = $stmt->execute([
    'Teknik Informatika',
    'Teknik Listrik',
    'Teknik Mesin',
    'Akuntansi',
    'Manajemen Perkantoran'
]);
echo 'Deleted: ' . $stmt->rowCount() . ' rows' . PHP_EOL;
