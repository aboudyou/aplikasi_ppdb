<li class="pc-item {{ request()->routeIs('admin.dashboard') ? 'active' : '' }}">
    <a href="{{ route('admin.dashboard') }}" class="pc-link">
        <span class="pc-micon"><i class="ti ti-home"></i></span>
        <span class="pc-mtext">Dashboard</span>
    </a>
</li>

<li class="pc-item {{ request()->routeIs('admin.verifikasi.*') ? 'active' : '' }}">
    <a href="{{ route('admin.verifikasi.index') }}" class="pc-link">
        <span class="pc-micon"><i class="ti ti-check"></i></span>
        <span class="pc-mtext">Verifikasi Berkas</span>
    </a>
</li>

<li class="pc-item {{ request()->routeIs('admin.pembayaran.*') ? 'active' : '' }}">
    <a href="{{ route('admin.pembayaran.index') }}" class="pc-link">
        <span class="pc-micon"><i class="ti ti-cash"></i></span>
        <span class="pc-mtext">Verifikasi Pembayaran</span>
    </a>
</li>

<li class="pc-item {{ request()->routeIs('admin.seleksi.*') ? 'active' : '' }}">
    <a href="{{ route('admin.seleksi.index') }}" class="pc-link">
        <span class="pc-micon"><i class="ti ti-list-check"></i></span>
        <span class="pc-mtext">Seleksi</span>
    </a>
</li>

<li class="pc-item {{ request()->routeIs('admin.pengumuman.*') ? 'active' : '' }}">
    <a href="{{ route('admin.pengumuman.index') }}" class="pc-link">
        <span class="pc-micon"><i class="ti ti-bell"></i></span>
        <span class="pc-mtext">Pengumuman</span>
    </a>
</li>

<li class="pc-item {{ request()->routeIs('admin.gelombang.*') ? 'active' : '' }}">
    <a href="{{ route('admin.gelombang.index') }}" class="pc-link">
        <span class="pc-micon"><i class="ti ti-calendar-event"></i></span>
        <span class="pc-mtext">Gelombang</span>
    </a>
</li>

<li class="pc-item {{ request()->routeIs('admin.laporan.*') ? 'active' : '' }}">
    <a href="{{ route('admin.laporan.index') }}" class="pc-link">
        <span class="pc-micon"><i class="ti ti-report"></i></span>
        <span class="pc-mtext">Laporan</span>
    </a>
</li>
