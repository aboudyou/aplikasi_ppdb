<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Pembayaran Diterima</title>
    <style>
        body { font-family: Arial, sans-serif; line-height: 1.6; color: #333; }
        .container { max-width: 600px; margin: 0 auto; padding: 20px; }
        .header { background: linear-gradient(135deg, #10b981 0%, #059669 100%); color: white; padding: 30px; text-align: center; border-radius: 10px 10px 0 0; }
        .content { background: #f9fafb; padding: 30px; border-radius: 0 0 10px 10px; }
        .success-icon { font-size: 48px; color: #10b981; text-align: center; margin: 20px 0; }
        .button { display: inline-block; background: #3b82f6; color: white; padding: 12px 30px; text-decoration: none; border-radius: 5px; margin: 20px 0; }
        .footer { text-align: center; margin-top: 30px; color: #666; font-size: 12px; }
    </style>
</head>
<body>
    <div class="container">
        <div class="header">
            <h1>💰 Pembayaran Diterima!</h1>
            <p>Pembayaran PPDB Anda telah berhasil diverifikasi</p>
        </div>

        <div class="content">
            <div class="success-icon">✅</div>

            <h2>Halo, {{ $user->name }}!</h2>

            <p>Selamat! Pembayaran PPDB Anda telah <strong>berhasil diverifikasi</strong> oleh admin.</p>

            <div style="background: white; padding: 20px; border-radius: 8px; margin: 20px 0; border-left: 4px solid #10b981;">
                <h3 style="margin-top: 0; color: #10b981;">Detail Pembayaran:</h3>
                <p><strong>Nama:</strong> {{ $user->name }}</p>
                <p><strong>Email:</strong> {{ $user->email }}</p>
                <p><strong>Jumlah Bayar:</strong> Rp {{ number_format($pembayaran->jumlah_bayar ?? $pembayaran->nilai, 0, ',', '.') }}</p>
                <p><strong>Status:</strong> <span style="color: #10b981; font-weight: bold;">DITERIMA</span></p>
                <p><strong>Tanggal Verifikasi:</strong> {{ \Carbon\Carbon::now()->format('d M Y H:i') }}</p>
            </div>

            <p>Proses selanjutnya:</p>
            <ol>
                <li><strong>Tunggu Pengumuman</strong> - Admin akan mengumumkan hasil seleksi</li>
                <li><strong>Cek Status</strong> - Pantau status pendaftaran di dashboard</li>
                <li><strong>Daftar Ulang</strong> - Jika diterima, lakukan daftar ulang</li>
            </ol>

            <div style="text-align: center; margin: 30px 0;">
                <a href="{{ url('/user/status') }}" class="button">Cek Status Seleksi</a>
            </div>

            <p>Jika Anda memiliki pertanyaan, silakan hubungi kami melalui:</p>
            <p><strong>Email:</strong> info@smkantartika1.sch.id<br>
            <strong>Telepon:</strong> (021) 123-4567</p>
        </div>

        <div class="footer">
            <p>&copy; {{ date('Y') }} SMK Antartika 1 - PPDB Online</p>
            <p>Email ini dikirim secara otomatis, mohon tidak membalas email ini.</p>
        </div>
    </div>
</body>
</html>