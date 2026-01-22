<!DOCTYPE html>
<html lang="id">
<head>
    
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>@yield('title', 'PPDB Online')</title>

    {{-- Bootstrap 5 CSS --}}
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet">

    {{-- Google Fonts --}}
    <link href="https://fonts.googleapis.com/css2?family=Poppins:wght@300;400;500;600;700;800&family=Playfair+Display:wght@600;700&display=swap" rel="stylesheet">

    {{-- Bootstrap Icons --}}
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.10.5/font/bootstrap-icons.css">

    {{-- AOS Animation Library --}}
    <link href="https://unpkg.com/aos@2.3.1/dist/aos.css" rel="stylesheet">

    {{-- Custom Style --}}
    <style>
        :root {
            --primary: #3b82f6;
            --primary-dark: #1e40af;
            --primary-light: #dbeafe;
            --accent: #f59e0b;
            --success: #10b981;
            --danger: #ef4444;
            --warning: #f97316;
            --dark: #1f2937;
            --light: #f9fafb;
            --text: #374151;
        }

        * {
            margin: 0;
            padding: 0;
            box-sizing: border-box;
        }

        html {
            scroll-behavior: smooth;
        }

        body {
            font-family: 'Poppins', sans-serif;
            background: linear-gradient(135deg, #f0f9ff 0%, #e0f2fe 50%, #f0fdf4 100%);
            background-attachment: fixed;
            min-height: 100vh;
            display: flex;
            flex-direction: column;
            color: var(--text);
        }

        /* Navbar Glassmorphism */
        .navbar {
            background: rgba(255, 255, 255, 0.7);
            backdrop-filter: blur(10px);
            -webkit-backdrop-filter: blur(10px);
            border-bottom: 1px solid rgba(255, 255, 255, 0.2);
            box-shadow: 0 4px 30px rgba(0, 0, 0, 0.05);
            padding: 1rem 2rem;
            position: sticky;
            top: 0;
            z-index: 999;
        }

        .navbar-container {
            display: flex;
            align-items: center;
            justify-content: space-between;
            width: 100%;
            max-width: 1400px;
            margin: 0 auto;
            padding: 0;
        }

        .navbar-brand {
            font-family: 'Playfair Display', serif;
            font-weight: 700;
            letter-spacing: 2px;
            font-size: 1.4rem;
            background: linear-gradient(135deg, #3b82f6 0%, #2563eb 100%);
            -webkit-background-clip: text;
            -webkit-text-fill-color: transparent;
            background-clip: text;
            display: flex;
            align-items: center;
            gap: 10px;
        }

        .navbar-brand::before {
            content: '🎓';
            font-size: 1.2rem;
        }

        .nav-link {
            font-weight: 600;
            color: var(--text) !important;
            padding: 0.6rem 1.2rem !important;
            border-radius: 8px;
            margin: 0 4px;
            position: relative;
            transition: all 0.3s cubic-bezier(0.4, 0, 0.2, 1);
            display: flex;
            align-items: center;
            gap: 6px;
        }

        .nav-link::before {
            content: '';
            position: absolute;
            width: 0;
            height: 3px;
            bottom: -8px;
            left: 50%;
            background: linear-gradient(135deg, var(--primary), var(--accent));
            border-radius: 10px;
            transform: translateX(-50%);
            transition: width 0.3s cubic-bezier(0.4, 0, 0.2, 1);
        }

        .nav-link:hover::before {
            width: 80%;
        }

        .nav-link:hover {
            color: var(--primary) !important;
            background: linear-gradient(135deg, rgba(59, 130, 246, 0.1), rgba(245, 158, 11, 0.05));
            transform: translateY(-2px);
        }

        .btn-outline-light {
            color: var(--primary) !important;
            border: 2px solid var(--primary) !important;
        }

        .btn-outline-light:hover {
            background: linear-gradient(135deg, var(--primary), #2563eb);
            color: white !important;
            transform: translateY(-2px);
        }

        .container-content {
            flex: 1;
            margin-top: 40px;
            margin-bottom: 40px;
            padding: 0 2rem !important;
            max-width: 100%;
        }

        /* Modern Card Design */
        .card {
            border: none;
            border-radius: 20px;
            background: rgba(255,255,255,0.7);
            backdrop-filter: blur(12px);
            -webkit-backdrop-filter: blur(12px);
            border: 3px solid;
            border-image: linear-gradient(135deg, #3b82f6 0%, #f59e0b 100%);
            border-image-slice: 1;
            box-shadow: 0 8px 32px rgba(59, 130, 246, 0.10), 0 2px 8px rgba(245, 158, 11, 0.10);
            transition: all 0.4s cubic-bezier(0.4, 0, 0.2, 1);
            overflow: hidden;
            position: relative;
        }

        .card:hover {
            box-shadow: 0 16px 48px rgba(59, 130, 246, 0.18), 0 4px 16px rgba(245, 158, 11, 0.16);
            transform: translateY(-8px) scale(1.04);
            background: rgba(255,255,255,0.85);
            border-image: linear-gradient(135deg, #f59e0b 0%, #3b82f6 100%);
        }

        /* Icon Animasi Dashboard Siswa */
        .dashboard-icon {
            font-size: 1.8rem;
            margin-bottom: 10px;
            transition: transform 0.4s cubic-bezier(0.4,0,0.2,1), filter 0.4s;
            filter: drop-shadow(0 2px 8px rgba(59,130,246,0.12));
        }
        .card:hover .dashboard-icon {
            transform: scale(1.15) rotate(-8deg);
            filter: drop-shadow(0 6px 16px rgba(245,158,11,0.18));
        }
        .card-title {
            font-size: 1.3rem;
            font-weight: 700;
            letter-spacing: 0.5px;
            margin-bottom: 0.5rem;
            background: linear-gradient(90deg, #3b82f6 0%, #f59e0b 100%);
            -webkit-background-clip: text;
            -webkit-text-fill-color: transparent;
            background-clip: text;
        }
        .card-body {
            background: linear-gradient(135deg, #e0f2fe 0%, #f0f9ff 60%, #f59e0b1a 100%);
            border-radius: 16px;
        }
        .btn {
            font-size: 1rem;
        }
        }

        .card:hover {
            box-shadow: 0 16px 48px rgba(59, 130, 246, 0.15), 0 4px 16px rgba(245, 158, 11, 0.12);
            transform: translateY(-8px) scale(1.03);
            background: linear-gradient(135deg, #f0f9ff 0%, #e0f2fe 60%, #f59e0b33 100%);
        }
        }

        .card::before {
            content: '';
            position: absolute;
            top: 0;
            left: 0;
            right: 0;
            height: 4px;
            background: linear-gradient(90deg, var(--primary), var(--accent));
        }

        .card:hover {
            box-shadow: 0 16px 48px rgba(59, 130, 246, 0.15);
            transform: translateY(-8px);
            background: rgba(255, 255, 255, 0.95);
        }

        .card-body {
            padding: 2rem;
        }

        .card-title {
            color: var(--primary);
            font-weight: 700;
            font-size: 1.25rem;
            margin-bottom: 1rem;
            display: flex;
            align-items: center;
            gap: 10px;
        }

        /* Modern Buttons */
        .btn {
            border-radius: 10px;
            font-weight: 600;
            padding: 0.75rem 1.5rem;
            border: none;
            transition: all 0.3s cubic-bezier(0.4, 0, 0.2, 1);
            box-shadow: 0 4px 15px rgba(0, 0, 0, 0.1);
            position: relative;
            overflow: hidden;
            display: inline-flex;
            align-items: center;
            gap: 6px;
        }

        .btn::before {
            content: '';
            position: absolute;
            top: 50%;
            left: 50%;
            width: 0;
            height: 0;
            border-radius: 50%;
            background: rgba(255, 255, 255, 0.3);
            transform: translate(-50%, -50%);
            transition: width 0.6s, height 0.6s;
        }

        .btn:hover::before {
            width: 300px;
            height: 300px;
        }

        .btn:hover {
            box-shadow: 0 8px 25px rgba(0, 0, 0, 0.2);
            transform: translateY(-4px);
        }

        .btn-primary {
            background: linear-gradient(135deg, var(--primary) 0%, #2563eb 100%);
            color: white;
        }

        .btn-primary:hover {
            background: linear-gradient(135deg, #2563eb 0%, #1e40af 100%);
            color: white;
        }

        .btn-success {
            background: linear-gradient(135deg, var(--success) 0%, #059669 100%);
            color: white;
        }

        .btn-success:hover {
            background: linear-gradient(135deg, #059669 0%, #047857 100%);
            color: white;
        }

        .btn-danger {
            background: linear-gradient(135deg, var(--danger) 0%, #dc2626 100%);
            color: white;
        }

        .btn-danger:hover {
            background: linear-gradient(135deg, #dc2626 0%, #b91c1c 100%);
            color: white;
        }

        .btn-info {
            background: linear-gradient(135deg, #06b6d4 0%, #0891b2 100%);
            color: white;
        }

        .btn-info:hover {
            background: linear-gradient(135deg, #0891b2 0%, #0e7490 100%);
            color: white;
        }

        .btn-sm {
            padding: 0.5rem 1rem;
            font-size: 0.875rem;
        }

        .btn-outline-secondary {
            color: var(--primary);
            border: 2px solid var(--primary);
            background: transparent;
        }

        .btn-outline-secondary:hover {
            background: linear-gradient(135deg, var(--primary), #2563eb);
            color: white;
            border-color: transparent;
        }

        /* Modern Alerts */
        .alert {
            border-radius: 12px;
            border: none;
            border-left: 4px solid;
            font-weight: 500;
            backdrop-filter: blur(10px);
            -webkit-backdrop-filter: blur(10px);
            animation: slideIn 0.3s ease-out;
        }

        @keyframes slideIn {
            from {
                transform: translateY(-20px);
                opacity: 0;
            }
            to {
                transform: translateY(0);
                opacity: 1;
            }
        }

        .alert-success {
            background-color: rgba(16, 185, 129, 0.1);
            border-color: var(--success);
            color: #065f46;
        }

        .alert-warning {
            background-color: rgba(245, 158, 11, 0.1);
            border-color: var(--accent);
            color: #92400e;
        }

        .alert-danger {
            background-color: rgba(239, 68, 68, 0.1);
            border-color: var(--danger);
            color: #7f1d1d;
        }

        /* Modern Table */
        .table {
            border-collapse: collapse;
        }

        .table thead {
            background: linear-gradient(135deg, rgba(59, 130, 246, 0.1), rgba(245, 158, 11, 0.05));
            border-bottom: 2px solid var(--primary);
        }

        .table thead th {
            font-weight: 700;
            color: var(--primary);
            padding: 1rem;
            text-transform: uppercase;
            font-size: 0.85rem;
            letter-spacing: 0.5px;
        }

        .table tbody tr {
            border-bottom: 1px solid rgba(0, 0, 0, 0.05);
            transition: all 0.3s ease;
        }

        .table tbody tr:hover {
            background-color: rgba(59, 130, 246, 0.05);
            transform: scale(1.01);
        }

        .table tbody td {
            padding: 1rem;
            vertical-align: middle;
        }

        /* Modern Badge */
        .badge {
            padding: 0.6rem 1.2rem;
            border-radius: 20px;
            font-weight: 700;
            font-size: 0.75rem;
            text-transform: uppercase;
            letter-spacing: 0.5px;
            box-shadow: 0 2px 8px rgba(0, 0, 0, 0.12);
        }

        .badge.bg-primary {
            background: linear-gradient(135deg, var(--primary), #2563eb) !important;
        }

        .badge.bg-success {
            background: linear-gradient(135deg, var(--success), #059669) !important;
        }

        .badge.bg-warning {
            background: linear-gradient(135deg, var(--accent), #d97706) !important;
            color: white !important;
        }

        .badge.bg-info {
            background: linear-gradient(135deg, #06b6d4, #0891b2) !important;
        }

        .badge.bg-secondary {
            background: linear-gradient(135deg, #6b7280, #4b5563) !important;
        }

        /* Modern Headings */
        h1, h2, h3, h4, h5, h6 {
            color: var(--primary);
            font-weight: 700;
            letter-spacing: -0.5px;
        }

        h1 {
            font-size: 2.5rem;
            font-family: 'Playfair Display', serif;
        }

        h2 {
            font-size: 2rem;
            font-family: 'Playfair Display', serif;
        }

        h3 {
            font-size: 1.5rem;
        }

        /* Modern Footer */
        footer {
            background: rgba(31, 41, 55, 0.95);
            backdrop-filter: blur(10px);
            -webkit-backdrop-filter: blur(10px);
            color: white;
            text-align: center;
            padding: 2rem 0;
            font-size: 0.95rem;
            box-shadow: 0 -4px 30px rgba(0, 0, 0, 0.1);
            margin-top: auto;
            border-top: 1px solid rgba(255, 255, 255, 0.1);
        }

        /* Modern Form */
        .form-control, .form-select {
            border-radius: 10px;
            border: 2px solid rgba(59, 130, 246, 0.2);
            padding: 0.875rem 1.125rem;
            font-size: 0.95rem;
            background: rgba(255, 255, 255, 0.7);
            transition: all 0.3s ease;
            font-weight: 500;
        }

        .form-control:focus, .form-select:focus {
            border-color: var(--primary);
            box-shadow: 0 0 0 4px rgba(59, 130, 246, 0.1);
            background: rgba(255, 255, 255, 0.95);
        }

        .form-label {
            font-weight: 600;
            color: var(--primary);
            margin-bottom: 0.5rem;
        }

        /* Table Striped */
        .table-striped tbody tr:nth-of-type(odd) {
            background-color: rgba(245, 247, 250, 0.4);
        }

        /* Responsive Design */
        @media (max-width: 768px) {
            .navbar-brand {
                font-size: 1.4rem;
            }

            .nav-link {
                padding: 0.5rem 0.75rem !important;
                font-size: 0.9rem;
            }

            h1 {
                font-size: 1.75rem;
            }

            h2 {
                font-size: 1.5rem;
            }

            .container-content {
                margin-top: 30px;
                margin-bottom: 30px;
            }

            .card {
                margin-bottom: 1rem;
            }
        }

        /* Loading Animation */
        @keyframes pulse {
            0%, 100% {
                opacity: 1;
            }
            50% {
                opacity: 0.5;
            }
        }

        .animate-pulse {
            animation: pulse 2s cubic-bezier(0.4, 0, 0.6, 1) infinite;
        }

        /* Smooth Transitions */
        a {
            transition: all 0.3s ease;
        }

        /* Icon Styling */
        .bi {
            transition: all 0.3s ease;
        }

        .nav-link:hover .bi {
            transform: translateY(-2px);
        }
    </style>
</head>
<body>
    {{-- Navbar --}}
    <nav class="navbar navbar-expand-lg navbar-dark">
        <div class="navbar-container">
            <div class="d-flex align-items-flex-start gap-3" style="width: 100%;">
                <div>
                    <a class="navbar-brand" href="{{ url('/') }}" style="margin: 0;">PPDB Online</a>
                    @auth
                    <div style="margin-top: 5px;">
                        <form action="{{ route('logout') }}" method="POST" class="d-inline">
                            @csrf
                            <button type="submit" class="btn btn-sm btn-outline-light" style="padding: 0.3rem 0.6rem; font-size: 0.8rem;"><i class="bi bi-box-arrow-right me-1"></i> Logout</button>
                        </form>
                    </div>
                    @endauth
                </div>
                
                <button class="navbar-toggler ms-auto" type="button" data-bs-toggle="collapse" data-bs-target="#navbarNav">
                    <span class="navbar-toggler-icon"></span>
                </button>
            </div>

            <div class="collapse navbar-collapse" id="navbarNav">
                <ul class="navbar-nav ms-auto">
                    @guest
                        <li class="nav-item"><a class="nav-link" href="{{ route('login') }}">Login</a></li>
                        <li class="nav-item"><a class="nav-link" href="{{ route('register') }}">Daftar</a></li>
                    @else
                        @if(auth()->user()->role === 'admin')
                            <li class="nav-item"><a class="nav-link d-flex align-items-center" href="{{ route('admin.dashboard') }}"><i class="bi bi-speedometer2 me-1"></i> Dashboard</a></li>
                            <li class="nav-item"><a class="nav-link d-flex align-items-center" href="{{ route('admin.gelombang.index') }}"><i class="bi bi-calendar-event me-1"></i> Gelombang</a></li>
                            <li class="nav-item"><a class="nav-link d-flex align-items-center" href="{{ route('admin.laporan.index') }}"><i class="bi bi-file-earmark-text me-1"></i> Laporan</a></li>
                            <li class="nav-item"><a class="nav-link d-flex align-items-center" href="{{ route('admin.verifikasi.index') }}"><i class="bi bi-file-check me-1"></i> Verifikasi</a></li>
                            <li class="nav-item"><a class="nav-link d-flex align-items-center" href="{{ route('admin.dokumen.index') }}"><i class="bi bi-file-earmark-pdf me-1"></i> Dokumen</a></li>
                            <li class="nav-item"><a class="nav-link d-flex align-items-center" href="{{ route('admin.pembayaran.index', ['status' => 'menunggu']) }}"><i class="bi bi-wallet2 me-1"></i> Pembayaran</a></li>
                            <li class="nav-item"><a class="nav-link d-flex align-items-center" href="{{ route('admin.pengumuman.index') }}"><i class="bi bi-megaphone me-1"></i> Pengumuman</a></li>
                        @else
                            <li class="nav-item"><a class="nav-link d-flex align-items-center" href="{{ route('user.dashboard') }}"><i class="bi bi-speedometer2 me-1"></i> Dashboard</a></li>
                            <li class="nav-item"><a class="nav-link d-flex align-items-center" href="{{ route('user.profile.index') }}"><i class="bi bi-person-circle me-1"></i> Profil</a></li>
                            <li class="nav-item"><a class="nav-link d-flex align-items-center" href="{{ route('user.pengumuman') }}"><i class="bi bi-megaphone me-1"></i> Pengumuman</a></li>
                        @endif
                    @endguest
                </ul>
            </div>
        </div>
    </nav>

    {{-- Bagian Konten --}}
    <div class="container container-content">
        @yield('content')
    </div>

    {{-- Footer --}}
    <footer>
        &copy; {{ date('Y') }} PPDB Online | SMK Swasta
    </footer>

    {{-- Bootstrap JS --}}
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js"></script>

    {{-- AOS JS --}}
    <script src="https://unpkg.com/aos@2.3.1/dist/aos.js"></script>
    <script>
        AOS.init();
    </script>
</body>
</html>
