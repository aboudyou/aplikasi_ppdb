@extends('layouts.app')

@section('content')
<div class="container">
    <h3 class="mb-4">Status Seleksi</h3>

    {{-- Jika data formulir ditemukan --}}
    @if ($status)
        <div class="card p-4">
            <h5>
                Status:
                @if ($status->status_pendaftaran == 'Diterima')
                    <span class="badge bg-success">{{ $status->status_pendaftaran }}</span>
                @elseif ($status->status_pendaftaran == 'Ditolak')
                    <span class="badge bg-danger">{{ $status->status_pendaftaran }}</span>
                @elseif ($status->status_pendaftaran == 'pending')
                    <span class="badge bg-secondary">Menunggu Verifikasi</span>
                @else
                    <span class="badge bg-secondary">{{ $status->status_pendaftaran }}</span>
                @endif
            </h5>

            {{-- Jika admin memberikan keterangan --}}
            @if ($status->keterangan ?? false)
                <p>Keterangan: {{ $status->keterangan }}</p>
            @endif
        </div>
    @else
        {{-- Jika user belum mengisi formulir --}}
        <div class="alert alert-warning mt-3">
            Anda belum mengisi formulir pendaftaran.
        </div>
    @endif
</div>
@endsection
