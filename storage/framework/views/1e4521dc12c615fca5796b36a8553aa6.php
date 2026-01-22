<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Kuitansi Pembayaran - <?php echo e($pembayaran->formulir->nama_lengkap); ?></title>
    <style>
        * {
            margin: 0;
            padding: 0;
            box-sizing: border-box;
        }

        body {
            font-family: 'Segoe UI', Tahoma, Geneva, Verdana, sans-serif;
            background: #f5f5f5;
            padding: 20px;
        }

        .kuitansi-container {
            max-width: 800px;
            margin: 0 auto;
            background: white;
            padding: 40px;
            border: 2px solid #2c3e50;
            border-radius: 8px;
            box-shadow: 0 2px 10px rgba(0, 0, 0, 0.1);
        }

        .header {
            text-align: center;
            margin-bottom: 30px;
            border-bottom: 3px solid #2c3e50;
            padding-bottom: 20px;
        }

        .header h1 {
            color: #2c3e50;
            font-size: 28px;
            margin-bottom: 5px;
        }

        .header p {
            color: #666;
            font-size: 14px;
            margin: 3px 0;
        }

        .nomor-kuitansi {
            background: #f0f0f0;
            padding: 15px;
            border-radius: 5px;
            margin: 20px 0;
            text-align: center;
        }

        .nomor-kuitansi p {
            margin: 5px 0;
            color: #333;
        }

        .nomor-kuitansi .nomor {
            font-size: 18px;
            font-weight: bold;
            color: #2c3e50;
        }

        .section {
            margin: 25px 0;
        }

        .section-title {
            background: #2c3e50;
            color: white;
            padding: 10px 15px;
            font-weight: bold;
            border-radius: 4px;
            margin-bottom: 15px;
        }

        .info-table {
            width: 100%;
            margin-bottom: 20px;
        }

        .info-table tr {
            border-bottom: 1px solid #ddd;
        }

        .info-table td {
            padding: 12px 0;
        }

        .info-table .label {
            font-weight: bold;
            color: #333;
            width: 35%;
            vertical-align: top;
        }

        .info-table .value {
            color: #555;
            word-break: break-word;
        }

        .detail-table {
            width: 100%;
            border-collapse: collapse;
            margin: 15px 0;
        }

        .detail-table thead {
            background: #ecf0f1;
        }

        .detail-table th {
            padding: 12px;
            text-align: left;
            font-weight: bold;
            color: #2c3e50;
            border-bottom: 2px solid #bdc3c7;
        }

        .detail-table td {
            padding: 12px;
            border-bottom: 1px solid #ddd;
        }

        .detail-table .text-right {
            text-align: right;
        }

        .total-section {
            background: #ecf0f1;
            padding: 15px;
            border-radius: 5px;
            margin: 20px 0;
        }

        .total-row {
            display: flex;
            justify-content: space-between;
            margin: 8px 0;
            font-size: 14px;
        }

        .total-row.final {
            border-top: 2px solid #2c3e50;
            padding-top: 10px;
            margin-top: 10px;
            font-size: 18px;
            font-weight: bold;
            color: #27ae60;
        }

        .footer {
            margin-top: 40px;
            text-align: center;
            border-top: 1px solid #ddd;
            padding-top: 20px;
            font-size: 12px;
            color: #666;
        }

        .stamp {
            text-align: right;
            margin: 30px 0;
            min-height: 80px;
        }

        .stamp p {
            font-size: 12px;
            color: #666;
            margin-bottom: 30px;
        }

        .status-badge {
            display: inline-block;
            background: #27ae60;
            color: white;
            padding: 8px 15px;
            border-radius: 20px;
            font-weight: bold;
            margin: 10px 0;
        }

        .terbilang {
            background: #f9f9f9;
            padding: 10px;
            border-left: 3px solid #2c3e50;
            margin: 15px 0;
            font-style: italic;
            color: #555;
        }

        @media print {
            body {
                background: white;
                padding: 0;
            }

            .kuitansi-container {
                box-shadow: none;
                border: 1px solid #999;
            }

            .print-button {
                display: none;
            }
        }

        .print-button {
            text-align: center;
            margin: 20px 0;
        }

        .print-button button {
            background: #2c3e50;
            color: white;
            padding: 10px 25px;
            border: none;
            border-radius: 5px;
            cursor: pointer;
            font-size: 14px;
        }

        .print-button button:hover {
            background: #1a252f;
        }
    </style>
</head>
<body>
    <div class="print-button">
        <button onclick="window.print()"><i class="bi bi-printer"></i> Cetak / Print Kuitansi</button>
    </div>

    <div class="kuitansi-container">
        <!-- Header -->
        <div class="header">
            <h1>🧾 KUITANSI PEMBAYARAN</h1>
            <p>PENERIMAAN PESERTA DIDIK BARU (PPDB)</p>
            <div class="status-badge">✓ PEMBAYARAN DITERIMA</div>
        </div>

        <!-- Nomor Kuitansi -->
        <div class="nomor-kuitansi">
            <p>NOMOR KUITANSI</p>
            <p class="nomor"><?php echo e($pembayaran->no_kuitansi ?? 'KUI-' . str_pad($pembayaran->id, 6, '0', STR_PAD_LEFT)); ?></p>
            <p style="font-size: 12px; color: #999;">Tanggal: <?php echo e($pembayaran->verified_at ? $pembayaran->verified_at->format('d F Y') : date('d F Y')); ?></p>
        </div>

        <!-- Data Pembayar -->
        <div class="section">
            <div class="section-title">📋 DATA PEMBAYAR</div>
            <table class="info-table">
                <tr>
                    <td class="label">Nama Lengkap</td>
                    <td class="value">: <?php echo e($pembayaran->formulir->nama_lengkap); ?></td>
                </tr>
                <tr>
                    <td class="label">NISN</td>
                    <td class="value">: <?php echo e($pembayaran->formulir->nisn ?? '-'); ?></td>
                </tr>
                <tr>
                    <td class="label">NIK</td>
                    <td class="value">: <?php echo e($pembayaran->formulir->nik ?? '-'); ?></td>
                </tr>
                <tr>
                    <td class="label">Gelombang Pendaftaran</td>
                    <td class="value">: <?php echo e($pembayaran->gelombang->nama_gelombang ?? '-'); ?></td>
                </tr>
            </table>
        </div>

        <!-- Detail Pembayaran -->
        <div class="section">
            <div class="section-title">💳 DETAIL PEMBAYARAN</div>
            <table class="detail-table">
                <thead>
                    <tr>
                        <th>Keterangan</th>
                        <th class="text-right">Jumlah</th>
                    </tr>
                </thead>
                <tbody>
                    <tr>
                        <td>Biaya Pendaftaran</td>
                        <td class="text-right">Rp <?php echo e(number_format($pembayaran->gelombang->nilai, 0, ',', '.')); ?></td>
                    </tr>
                    <?php if($pembayaran->gelombang->jenis_promo && $pembayaran->gelombang->nilai_promo > 0): ?>
                    <tr>
                        <td><?php echo e(ucfirst($pembayaran->gelombang->jenis_promo)); ?></td>
                        <td class="text-right">- Rp <?php echo e(number_format($pembayaran->gelombang->getNilaiPromo(), 0, ',', '.')); ?></td>
                    </tr>
                    <?php endif; ?>
                </tbody>
            </table>

            <div class="total-section">
                <div class="total-row">
                    <span>Jumlah Pembayaran:</span>
                    <strong>Rp <?php echo e(number_format($pembayaran->formulir->gelombang->getBiayaAkhir(), 0, ',', '.')); ?></strong>
                </div>
                <div class="total-row final">
                    <span>TOTAL YANG DITERIMA:</span>
                    <strong>Rp <?php echo e(number_format($pembayaran->formulir->gelombang->getBiayaAkhir(), 0, ',', '.')); ?></strong>
                </div>
            </div>

            <div class="terbilang">
                <strong>Terbilang:</strong> <?php echo e(ucfirst(terbilang($pembayaran->formulir->gelombang->getBiayaAkhir()))); ?> Rupiah
            </div>
        </div>

        <!-- Informasi Pembayaran -->
        <div class="section">
            <div class="section-title">📅 INFORMASI PEMBAYARAN</div>
            <table class="info-table">
                <tr>
                    <td class="label">Metode Pembayaran</td>
                    <td class="value">: <?php echo e($pembayaran->metode_bayar ?? '-'); ?></td>
                </tr>
                <tr>
                    <td class="label">Tanggal Pembayaran</td>
                    <td class="value">: <?php echo e($pembayaran->tanggal_bayar ? $pembayaran->tanggal_bayar->format('d F Y') : '-'); ?></td>
                </tr>
                <tr>
                    <td class="label">Tanggal Diverifikasi</td>
                    <td class="value">: <?php echo e($pembayaran->verified_at ? $pembayaran->verified_at->format('d F Y H:i') : '-'); ?></td>
                </tr>
                <tr>
                    <td class="label">Status</td>
                    <td class="value">: <span style="color: #27ae60; font-weight: bold;">✓ <?php echo e($pembayaran->status); ?></span></td>
                </tr>
            </table>
        </div>

        <!-- Catatan Admin -->
        <?php if($pembayaran->catatan): ?>
        <div class="section">
            <div class="section-title">📝 CATATAN</div>
            <p style="color: #555; line-height: 1.6;"><?php echo e($pembayaran->catatan); ?></p>
        </div>
        <?php endif; ?>

        <!-- Tanda Tangan -->
        <div class="section">
            <div class="section-title">✍️ VERIFIKASI</div>
            <div style="display: grid; grid-template-columns: 1fr 1fr; gap: 40px; margin-top: 30px;">
                <div>
                    <p style="text-align: center; margin-bottom: 60px; color: #666;">Pembayar</p>
                    <p style="text-align: center; margin-top: 5px; font-weight: bold;">
                        <?php echo e($pembayaran->formulir->nama_lengkap); ?>

                    </p>
                </div>
                <div>
                    <p style="text-align: center; margin-bottom: 60px; color: #666;">Admin Penerima</p>
                    <p style="text-align: center; margin-top: 5px; font-weight: bold;">
                        <?php echo e($pembayaran->adminVerifikasi->name ?? 'Admin PPDB'); ?>

                    </p>
                </div>
            </div>
        </div>

        <!-- Footer -->
        <div class="footer">
            <p>Kuitansi ini adalah bukti resmi pembayaran pendaftaran. Mohon disimpan dengan baik.</p>
            <p>Dicetak pada: <?php echo e(now()->format('d F Y H:i:s')); ?></p>
        </div>
    </div>
</body>
</html>
<?php /**PATH C:\Users\Lenovo\Documents\adi_ppdb\aplikasi_ppdb\resources\views/user/pembayaran/kuitansi.blade.php ENDPATH**/ ?>