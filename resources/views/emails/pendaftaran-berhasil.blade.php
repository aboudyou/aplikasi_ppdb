<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Pendaftaran Berhasil</title>
    <style>
        body { font-family: Arial, sans-serif; line-height: 1.6; color: #333; }
        .container { max-width: 600px; margin: 0 auto; padding: 20px; }
        .header { background: linear-gradient(135deg, #3b82f6 0%, #2563eb 100%); color: white; padding: 30px; text-align: center; border-radius: 10px 10px 0 0; }
        .content { background: #f9fafb; padding: 30px; border-radius: 0 0 10px 10px; }
        .button { display: inline-block; background: #10b981; color: white; padding: 12px 30px; text-decoration: none; border-radius: 5px; margin: 20px 0; }
        .footer { text-align: center; margin-top: 30px; color: #666; font-size: 12px; }
    </style>
</head>
<body>
    <div class="container">
        <div class="header">
            <h1>🎓 Selamat Datang di SMK Antartika 1!</h1>
            <p>Pendaftaran PPDB Anda telah berhasil diproses</p>
        </div>

        <div class="content">
            <h2>Halo, {{ $user->name }}!</h2>

            <p>Selamat! Pendaftaran PPDB Anda untuk <strong>{{ $gelombang->nama_gelombang }}</strong> telah berhasil diproses.</p>

            <div style="background: white; padding: 20px; border-radius: 8px; margin: 20px 0; border-left: 4px solid #3b82f6;">
                <h3 style="margin-top: 0; color: #3b82f6;">Detail Pendaftaran:</h3>
                <p><strong>Nama:</strong> {{ $user->name }}</p>
                <p><strong>Email:</strong> {{ $user->email }}</p>
                <p><strong>Gelombang:</strong> {{ $gelombang->nama_gelombang }}</p>
                <p><strong>Periode:</strong> {{ \Carbon\Carbon::parse($gelombang->tanggal_mulai)->format('d M Y') }} - {{ \Carbon\Carbon::parse($gelombang->tanggal_selesai)->format('d M Y') }}</p>
            </div>

            <p>Silakan lengkapi langkah-langkah berikut untuk menyelesaikan proses pendaftaran:</p>

            <ol>
                <li><strong>Lengkapi Biodata</strong> - Isi data diri dan orang tua</li>
                <li><strong>Upload Dokumen</strong> - Upload berkas persyaratan</li>
                <li><strong>Pembayaran</strong> - Lakukan pembayaran sesuai nominal</li>
                <li><strong>Tunggu Verifikasi</strong> - Admin akan memverifikasi data Anda</li>
            </ol>

            <div style="text-align: center; margin: 30px 0;">
                <a href="{{ url('/dashboard') }}" class="button">Lihat Dashboard</a>
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