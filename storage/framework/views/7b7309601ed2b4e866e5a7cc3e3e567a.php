<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <title>Surat Penerimaan</title>
    <style>
        body { 
            font-family: Arial, sans-serif; 
            font-size: 11px; 
            margin: 10px;
            padding: 0;
        }
        .kop { text-align: center; border-bottom: 2px solid #000; padding: 5px 0; margin-bottom: 8px; }
        .kop h2 { font-size: 15px; margin: 0; padding: 0; }
        .kop p { font-size: 9px; margin: 2px 0; padding: 0; }
        .nomor { text-align: center; font-size: 10px; margin: 5px 0; }
        .judul { text-align: center; font-size: 13px; font-weight: bold; text-decoration: underline; margin: 8px 0; }
        .isi { font-size: 11px; line-height: 1.6; margin: 4px 0; text-align: justify; }
        .indent { margin-left: 30px; text-indent: 0; }
        .tabel { width: 100%; border-collapse: collapse; margin: 6px 0; background: #fafafa; }
        .tabel td { padding: 3px 5px; font-size: 10px; border-left: 2px solid #000; }
        .label { width: 110px; }
        .nilai { width: auto; }
        .tanda { margin-top: 15px; display: table; width: 100%; }
        .sig { display: table-cell; width: 50%; text-align: center; font-size: 10px; padding: 0 10px; vertical-align: top; }
        .sig-title { font-weight: bold; margin: 3px 0; }
        .sig-sub { margin: 20px 0; }
        .sig-garis { border-top: 1px solid #000; height: 25px; }
        .kanan { text-align: right; font-size: 11px; margin: 10px 0; text-indent: 0; }
    </style>
</head>
<body>
<!-- KOP SURAT -->
<div class="kop">
    <h2>SMK ANTARTIKA 1</h2>
    <p>Jl. Pendidikan No. 123, Sakti (0341) Pasuruan - Jawa Timur</p>
    <p>Telpon: (0341) 123-4567 | Email: info@antartika.sch.id</p>
</div>

<!-- NOMOR -->
<div class="nomor">Nomor: 095/PENERIMAAN/<?php echo e(date('Y')); ?></div>

<!-- JUDUL -->
<div class="judul">SURAT PENERIMAAN SISWA BARU</div>

<!-- PEMBUKA -->
<p class="isi">Yang bertanda tangan di bawah ini, Kepala Sekolah Menengah Kejuruan Antartika 1, dengan ini menerangkan bahwa:</p>

<!-- DATA SISWA -->
<table class="tabel">
<tr><td class="label">Nama Lengkap</td><td class="nilai"><?php echo e($formulir->nama_lengkap); ?></td></tr>
<tr><td class="label">NISN</td><td class="nilai"><?php echo e($formulir->nisn ?? '-'); ?></td></tr>
<tr><td class="label">NIK</td><td class="nilai"><?php echo e($formulir->nik ?? '-'); ?></td></tr>
<tr><td class="label">Tempat/Tgl Lahir</td><td class="nilai"><?php echo e($formulir->tempat_lahir); ?>, <?php echo e(\Carbon\Carbon::parse($formulir->tanggal_lahir)->format('d F Y')); ?></td></tr>
<tr><td class="label">Jenis Kelamin</td><td class="nilai"><?php echo e($formulir->jenis_kelamin == 'L' ? 'Laki-laki' : 'Perempuan'); ?></td></tr>
<tr><td class="label">Asal Sekolah</td><td class="nilai"><?php echo e($formulir->asal_sekolah); ?></td></tr>
<tr><td class="label">Jurusan</td><td class="nilai"><?php echo e($formulir->jurusan->nama_jurusan ?? '-'); ?></td></tr>
<tr><td class="label">Agama</td><td class="nilai"><?php echo e(ucfirst($formulir->agama ?? '-')); ?></td></tr>
</table>

<!-- PERNYATAAN DITERIMA -->
<p class="isi">Berdasarkan hasil seleksi dan evaluasi yang telah dilakukan, dengan ini kami beritahukan bahwa calon siswa di atas <strong>DITERIMA</strong> sebagai siswa baru di SMK Antartika 1 untuk Tahun Pelajaran <?php echo e(date('Y')); ?>/<?php echo e(date('Y') + 1); ?>.</p>

<!-- KEWAJIBAN -->
<p class="isi">Kepada siswa yang diterima diwajibkan untuk:</p>
<p class="indent isi" style="text-indent: 0;">1. Melakukan daftar ulang sesuai jadwal yang telah ditentukan</p>
<p class="indent isi" style="text-indent: 0;">2. Mengikuti kegiatan pengenalan lingkungan sekolah (MPLS)</p>
<p class="indent isi" style="text-indent: 0;">3. Memenuhi semua persyaratan administrasi yang diminta</p>

<!-- PENUTUP -->
<p class="isi">Keterlambatan atau kelalaian dalam memenuhi persyaratan tersebut dapat mengakibatkan pembatalan penerimaan. Demikian surat penerimaan ini diberikan untuk digunakan sebagaimana mestinya.</p>

<!-- TANGGAL -->
<p class="kanan">Pasuruan, <?php echo e(\Carbon\Carbon::now()->format('d F Y')); ?></p>

<!-- TANDA TANGAN -->
<div class="tanda">
    <div class="sig">
        <div class="sig-title">DIKETAHUI</div>
        <div class="sig-sub">Orang Tua / Wali</div>
        <div class="sig-garis"></div>
    </div>
    <div class="sig">
        <div class="sig-title">DISAHKAN</div>
        <div class="sig-sub">Kepala Sekolah</div>
        <div class="sig-garis"></div>
    </div>
</div>

</body>
</html>
<?php /**PATH C:\Users\Lenovo\Documents\adi_ppdb\aplikasi_ppdb\resources\views/admin/seleksi/surat-penerimaan-pdf.blade.php ENDPATH**/ ?>