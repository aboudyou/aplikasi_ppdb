<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Kuitansi Pembayaran</title>
    <style>
        body {
            font-family: 'Segoe UI', Tahoma, Geneva, Verdana, sans-serif;
            line-height: 1.6;
            color: #333;
        }
        .container {
            max-width: 600px;
            margin: 0 auto;
            padding: 20px;
        }
        .header {
            text-align: center;
            margin-bottom: 30px;
        }
        .header h2 {
            color: #2c3e50;
            margin: 10px 0;
        }
        .status-badge {
            display: inline-block;
            background: #27ae60;
            color: white;
            padding: 10px 20px;
            border-radius: 5px;
            font-weight: bold;
            margin: 10px 0;
        }
        .info-section {
            background: #f9f9f9;
            padding: 15px;
            border-left: 4px solid #2c3e50;
            margin: 15px 0;
            border-radius: 3px;
        }
        .info-row {
            display: flex;
            justify-content: space-between;
            margin: 8px 0;
            padding: 5px 0;
            border-bottom: 1px solid #eee;
        }
        .info-row:last-child {
            border-bottom: none;
        }
        .info-label {
            font-weight: bold;
            color: #555;
        }
        .info-value {
            color: #333;
            text-align: right;
        }
        .amount {
            background: #ecf0f1;
            padding: 15px;
            border-radius: 5px;
            margin: 15px 0;
        }
        .amount-label {
            font-size: 14px;
            color: #666;
        }
        .amount-value {
            font-size: 24px;
            font-weight: bold;
            color: #27ae60;
            margin: 10px 0;
        }
        .button {
            display: inline-block;
            background: #2c3e50;
            color: white;
            padding: 12px 30px;
            text-decoration: none;
            border-radius: 5px;
            margin: 15px 0;
        }
        .button:hover {
            background: #1a252f;
        }
        .footer {
            text-align: center;
            margin-top: 30px;
            padding-top: 20px;
            border-top: 1px solid #ddd;
            font-size: 12px;
            color: #999;
        }
        .note {
            background: #fff3cd;
            border: 1px solid #ffc107;
            padding: 10px;
            border-radius: 4px;
            margin: 15px 0;
            font-size: 14px;
            color: #856404;
        }
    </style>
</head>
<body>
    <div class="container">
        <!-- Header -->
        <div class="header">
            <h2>🧾 KUITANSI PEMBAYARAN</h2>
            <p style="color: #666; margin: 5px 0;">Penerimaan Peserta Didik Baru (PPDB)</p>
            <div class="status-badge">✓ PEMBAYARAN DITERIMA</div>
        </div>

        <!-- Greeting -->
        <p>Halo <strong><?php echo e($nama); ?></strong>,</p>
        
        <p>
            Kami dengan senang hati memberitahukan bahwa pembayaran pendaftaran Anda telah <strong>diverifikasi dan diterima</strong>.
        </p>

        <!-- Info Pembayaran -->
        <div class="info-section">
            <div class="info-row">
                <span class="info-label">Nomor Kuitansi:</span>
                <span class="info-value"><strong><?php echo e($nomor_kuitansi); ?></strong></span>
            </div>
            <div class="info-row">
                <span class="info-label">Nama:</span>
                <span class="info-value"><?php echo e($pembayaran->formulir->nama_lengkap); ?></span>
            </div>
            <div class="info-row">
                <span class="info-label">Gelombang:</span>
                <span class="info-value"><?php echo e($pembayaran->gelombang->nama_gelombang ?? '-'); ?></span>
            </div>
            <div class="info-row">
                <span class="info-label">Metode Pembayaran:</span>
                <span class="info-value"><?php echo e($pembayaran->metode_bayar ?? '-'); ?></span>
            </div>
            <div class="info-row">
                <span class="info-label">Tanggal Verifikasi:</span>
                <span class="info-value"><?php echo e($pembayaran->verified_at ? $pembayaran->verified_at->format('d F Y H:i') : '-'); ?></span>
            </div>
        </div>

        <!-- Jumlah Pembayaran -->
        <div class="amount">
            <div class="amount-label">Jumlah yang Dibayarkan:</div>
            <div class="amount-value">Rp <?php echo e(number_format($jumlah, 0, ',', '.')); ?></div>
        </div>

        <!-- Action -->
        <div style="text-align: center;">
            <a href="<?php echo e(route('user.pembayaran')); ?>" class="button">
                ✓ Lihat Halaman Pembayaran
            </a>
        </div>

        <!-- Note -->
        <div class="note">
            <strong>📎 Lampiran:</strong> Kuitansi detail telah disertakan sebagai attachment PDF. Anda dapat menyimpan dan mencetaknya kapan saja.
        </div>

        <!-- Info Lanjutan -->
        <p style="margin-top: 20px; font-size: 14px;">
            Selanjutnya, silakan lengkapi tahap pendaftaran berikutnya melalui aplikasi PPDB Online. Jika ada pertanyaan, 
            jangan ragu untuk menghubungi pihak sekolah.
        </p>

        <!-- Footer -->
        <div class="footer">
            <p>
                Email ini merupakan pemberitahuan otomatis dari Sistem PPDB Online.<br>
                Mohon tidak membalas email ini.
            </p>
            <p>
                © <?php echo e(date('Y')); ?> PPDB Online. All rights reserved.
            </p>
        </div>
    </div>
</body>
</html>
<?php /**PATH C:\Users\Lenovo\Documents\adi_ppdb\aplikasi_ppdb\resources\views/emails/kuitansi-pembayaran.blade.php ENDPATH**/ ?>