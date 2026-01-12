@extends('layouts.app')

@section('title', 'Laporan Pendaftaran')

@section('content')
<div class="container-fluid px-3 mt-4">
    <h3 class="mb-4"><i class="bi bi-file-earmark-text"></i> Laporan Pendaftaran</h3>
        <div>
            <a href="{{ route('admin.laporan.export.csv') }}" class="btn btn-sm btn-outline-secondary" target="_blank">Export CSV</a>
            <a href="#" class="btn btn-sm btn-primary">Export PDF</a>
        </div>
    </div>

    <div class="row mb-4">
        <div class="col-md-4 mb-2">
            <div class="card p-3">
                <small class="text-muted">Total Pendaftar</small>
                <div class="h4">{{ $totalPendaftar }}</div>
            </div>
        </div>
        <div class="col-md-4 mb-2">
            <div class="card p-3">
                <small class="text-muted">Pendaftar per Jurusan</small>
                <ul class="mb-0 list-unstyled mt-2">
                    @foreach($perJurusan as $nama => $jumlah)
                        <li class="d-flex justify-content-between"><span>{{ $nama }}</span><span>{{ $jumlah }}</span></li>
                    @endforeach
                </ul>
            </div>
        </div>
        <div class="col-md-4 mb-2">
            <div class="card p-3">
                <small class="text-muted">Pendaftar per Gelombang</small>
                <ul class="mb-0 list-unstyled mt-2">
                    @foreach($perGelombang as $nama => $jumlah)
                        <li class="d-flex justify-content-between"><span>{{ $nama }}</span><span>{{ $jumlah }}</span></li>
                    @endforeach
                </ul>
            </div>
        </div>
    </div>

    <div class="card">
        <div class="card-body">
            <h5>Daftar Pendaftar</h5>
            <div class="table-responsive">
                <table class="table table-striped">
                    <thead>
                        <tr>
                            <th>No</th>
                            <th>Nama</th>
                            <th>Nomor Pendaftaran</th>
                            <th>Jurusan</th>
                            <th>Gelombang</th>
                            <th>Status</th>
                            <th>Tanggal</th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach($pendaftar as $key => $p)
                            <tr>
                                <td>{{ $pendaftar->firstItem() + $key }}</td>
                                <td>{{ $p->nama_lengkap }}</td>
                                <td>{{ $p->nomor_pendaftaran ?? '-' }}</td>
                                <td>{{ $p->jurusan->nama_jurusan ?? '-' }}</td>
                                <td>{{ $p->gelombang->nama_gelombang ?? '-' }}</td>
                                <td>{{ $p->status_pendaftaran }}</td>
                                <td>{{ $p->created_at->format('d M Y') }}</td>
                            </tr>
                        @endforeach
                    </tbody>
                </table>
            </div>

            <div class="mt-3">
                {{ $pendaftar->links() }}
            </div>
        </div>
    </div>

</div>
@endsection
