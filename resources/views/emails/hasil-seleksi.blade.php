<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Hasil Seleksi PPDB</title>
    <style>
        body { font-family: Arial, sans-serif; line-height: 1.6; color: #333; }
        .container { max-width: 600px; margin: 0 auto; padding: 20px; }
        .header { background: linear-gradient(135deg, #3b82f6 0%, #2563eb 100%); color: white; padding: 30px; text-align: center; border-radius: 10px 10px 0 0; }
        .content { background: #f9fafb; padding: 30px; border-radius: 0 0 10px 10px; }
        .status-box { padding: 30px; border-radius: 10px; text-align: center; margin: 20px 0; font-size: 18px; font-weight: bold; }
        .diterima { background: linear-gradient(135deg, #10b981 0%, #059669 100%); color: white; }
        .ditolak { background: linear-gradient(135deg, #ef4444 0%, #dc2626 100%); color: white; }
        .button { display: inline-block; background: #3b82f6; color: white; padding: 12px 30px; text-decoration: none; border-radius: 5px; margin: 20px 0; }
        .footer { text-align: center; margin-top: 30px; color: #666; font-size: 12px; }
    </style>
</head>
<body>
    <div class="container">
        <div class="header">
            <h1>📋 Hasil Seleksi PPDB</h1>
            <p>SMK Antartika 1 - Tahun {{ date('Y') }}</p>
        </div>

        <div class="content">
            <h2>Halo, {{ $user->name }}!</h2>

            <p>Berikut adalah hasil seleksi PPDB SMK Antartika 1:</p>

            @if($status === 'diterima')
                <div class="status-box diterima">
                    🎉 SELAMAT! ANDA DITERIMA! 🎉<br>
                    <small>Selamat bergabung dengan keluarga besar SMK Antartika 1</small>
                </div>
            @else
                <div class="status-box ditolak">
                    😔 MOHON MAAF, ANDA BELUM DITERIMA<br>
                    <small>Jangan berkecil hati, tetap semangat untuk masa depan!</small>
                </div>
            @endif

            <div style="background: white; padding: 20px; border-radius: 8px; margin: 20px 0;">
                <h3 style="margin-top: 0; color: #3b82f6;">Informasi Pendaftaran:</h3>
                <p><strong>Nama:</strong> {{ $user->name }}</p>
                <p><strong>Email:</strong> {{ $user->email }}</p>
                <p><strong>Status:</strong>
                    @if($status === 'diterima')
                        <span style="color: #10b981; font-weight: bold;">DITERIMA</span>
                    @elseif($status === 'ditolak')
                        <span style="color: #ef4444; font-weight: bold;">DITOLAK</span>
                    @else
                        <span style="color: #f59e0b; font-weight: bold;">PROSES</span>
                    @endif
                </p>
                @if($catatan)
                    <p><strong>Catatan:</strong> {{ $catatan }}</p>
                @endif
            </div>

            @if($status === 'diterima')
                <div style="background: #d1fae5; border: 1px solid #10b981; padding: 20px; border-radius: 8px; margin: 20px 0;">
                    <h3 style="margin-top: 0; color: #059669;">Langkah Selanjutnya:</h3>
                    <ol>
                        <li><strong>Daftar Ulang</strong> - Lakukan daftar ulang sesuai jadwal</li>
                        <li><strong>Persiapkan Berkas</strong> - Siapkan berkas asli untuk verifikasi</li>
                        <li><strong>Pembayaran Daftar Ulang</strong> - Lakukan pembayaran sesuai ketentuan</li>
                        <li><strong>Masuk Sekolah</strong> - Ikuti kegiatan MOS (Masa Orientasi Siswa)</li>
                    </ol>
                </div>
            @else
                <div style="background: #fef3c7; border: 1px solid #f59e0b; padding: 20px; border-radius: 8px; margin: 20px 0;">
                    <h3 style="margin-top: 0; color: #d97706;">Saran untuk Kedepannya:</h3>
                    <ul>
                        <li>Tingkatkan prestasi akademik</li>
                        <li>Ikuti kegiatan ekstrakurikuler</li>
                        <li>Persiapkan diri untuk tahun depan</li>
                        <li>Coba sekolah lain yang sesuai minat Anda</li>
                    </ul>
                </div>
            @endif

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