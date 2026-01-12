@extends('layouts.app')

@section('title', 'Verifikasi Pembayaran')

@section('content')
<div class="container-fluid px-3 mt-4">
    <h3 class="mb-4"><i class="bi bi-credit-card"></i> Verifikasi Pembayaran</h3>

        @if(session('success'))
            <div class="alert alert-success alert-dismissible fade show" role="alert">
                <i class="bi bi-check-circle"></i> {{ session('success') }}
                <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
            </div>
        @endif

        <div class="mb-4">
            <div class="btn-group" role="group">
                <a href="{{ route('admin.pembayaran.index', ['status' => 'menunggu']) }}" class="btn btn-sm {{ (isset($status) && $status=='menunggu') ? 'btn-primary' : 'btn-outline-secondary' }}">
                    <i class="bi bi-hourglass-split"></i> Menunggu ({{ $pendingCount ?? 0 }})
                </a>
                <a href="{{ route('admin.pembayaran.index', ['status' => 'lunas']) }}" class="btn btn-sm {{ (isset($status) && $status=='lunas') ? 'btn-success' : 'btn-outline-secondary' }}">
                    <i class="bi bi-check-circle"></i> Lunas ({{ $verifiedCount ?? 0 }})
                </a>
                <a href="{{ route('admin.pembayaran.index', ['status' => 'all']) }}" class="btn btn-sm {{ (isset($status) && $status=='all') ? 'btn-info' : 'btn-outline-secondary' }}">
                    <i class="bi bi-list-ul"></i> Semua
                </a>
            </div>
        </div>

        <div class="card">
            <div class="card-body">
                <div class="table-responsive">
                    <table class="table table-striped align-middle">
                        <thead>
                            <tr>
                                <th>No</th>
                                <th>Nama Siswa</th>
                                <th>Gelombang</th>
                                <th>Tanggal Upload</th>
                                <th>Jumlah Bayar</th>
                                <th>Bukti</th>
                                <th>Status</th>
                                <th>Aksi</th>
                            </tr>
                        </thead>
                        <tbody>
                            @if($data->isEmpty())
                                <tr>
                                    <td colspan="8" class="text-center py-4 text-muted">
                                        <i class="bi bi-inbox"></i> Belum ada pembayaran
                                    </td>
                                </tr>
                            @else
                                @foreach($data as $item)
                                <tr>
                                    <td class="fw-bold">{{ $loop->iteration }}</td>
                                    <td class="fw-500">{{ $item->formulir->nama_lengkap }}</td>
                                    <td>
                                        <span class="badge bg-info">{{ $item->formulir->gelombang->nama_gelombang ?? '-' }}</span>
                                    </td>
                                <td>{{ $item->created_at->format('d-m-Y H:i') }}</td>
                                <td><strong style="color: #10b981;">Rp {{ number_format($item->jumlah_bayar ?? 0, 0, ',', '.') }}</strong></td>
                                <td>
                                    @if($item->bukti_bayar)
                                        <a href="{{ asset('uploads/pembayaran/'.$item->bukti_bayar) }}" target="_blank" class="btn btn-sm btn-info">
                                            <i class="bi bi-image"></i> Lihat
                                        </a>
                                    @else
                                        <span class="text-muted">-</span>
                                    @endif
                                </td>
                                <td>
                                    @if($item->status == 'Lunas')
                                        <span class="badge bg-success"><i class="bi bi-check-circle"></i> Lunas</span>
                                    @else
                                        <span class="badge bg-warning"><i class="bi bi-hourglass-split"></i> Menunggu</span>
                                    @endif
                                </td>
                                <td>
                                    <a href="{{ route('admin.pembayaran.show', $item->id) }}" class="btn btn-sm btn-primary">
                                        <i class="bi bi-eye"></i> Detail
                                    </a>
                                </td>
                            </tr>
                            @endforeach
                        @endif
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
    </div>
</div>

@endsection
