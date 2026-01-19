<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>@yield('title')</title>

    <!-- Bootstrap 5 -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css" rel="stylesheet">

    <style>
        .sidebar {
            position: fixed;
            top: 0;
            left: 0;
            height: 100vh;
            width: 250px;
            background-color: #343a40;
            color: white;
            padding-top: 20px;
            overflow-y: auto;
        }
        .sidebar .nav-link {
            color: white;
            padding: 10px 20px;
            display: block;
        }
        .sidebar .nav-link:hover {
            background-color: #495057;
            color: white;
        }
        .sidebar .nav-link.active {
            background-color: #007bff;
        }
        .main-content {
            margin-left: 250px;
            padding: 20px;
        }
        @media (max-width: 768px) {
            .sidebar {
                width: 100%;
                height: auto;
                position: relative;
            }
            .main-content {
                margin-left: 0;
            }
        }
    </style>

</head>
<body style="background: #f1f4f9">

    <div class="sidebar">
        <h4 class="text-center mb-4">Admin Panel</h4>
        <nav class="nav flex-column">
            <a class="nav-link {{ request()->routeIs('admin.dashboard') ? 'active' : '' }}" href="{{ route('admin.dashboard') }}">
                <i class="bi bi-house-door"></i> Dashboard
            </a>
            <a class="nav-link {{ request()->routeIs('admin.verifikasi.*') ? 'active' : '' }}" href="{{ route('admin.verifikasi.index') }}">
                <i class="bi bi-check-circle"></i> Verifikasi Berkas
            </a>
            <a class="nav-link {{ request()->routeIs('admin.pembayaran.*') ? 'active' : '' }}" href="{{ route('admin.pembayaran.index') }}">
                <i class="bi bi-cash"></i> Verifikasi Pembayaran
            </a>
            <a class="nav-link {{ request()->routeIs('admin.seleksi.*') ? 'active' : '' }}" href="{{ route('admin.seleksi.index') }}">
                <i class="bi bi-list-check"></i> Seleksi
            </a>
            <a class="nav-link {{ request()->routeIs('admin.pengumuman.*') ? 'active' : '' }}" href="{{ route('admin.pengumuman.index') }}">
                <i class="bi bi-bell"></i> Pengumuman
            </a>
            <a class="nav-link {{ request()->routeIs('admin.gelombang.*') ? 'active' : '' }}" href="{{ route('admin.gelombang.index') }}">
                <i class="bi bi-calendar-event"></i> Gelombang
            </a>
            <a class="nav-link {{ request()->routeIs('admin.jurusan.*') ? 'active' : '' }}" href="{{ route('admin.jurusan.index') }}">
                <i class="bi bi-book"></i> Jurusan
            </a>
            <a class="nav-link {{ request()->routeIs('admin.laporan.*') ? 'active' : '' }}" href="{{ route('admin.laporan.index') }}">
                <i class="bi bi-bar-chart"></i> Laporan
            </a>
            <a class="nav-link {{ request()->routeIs('admin.log_aktivitas.index') ? 'active' : '' }}" href="{{ route('admin.log_aktivitas.index') }}">
                <i class="bi bi-activity"></i> Log Aktivitas
            </a>
        </nav>
    </div>

    <div class="main-content">
        @yield('content')
    </div>

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/js/bootstrap.bundle.min.js"></script>

</body>
</html>
