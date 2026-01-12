@extends('layouts.app')

@section('content')
<div class="container-fluid px-3 mt-4">
    <h3 class="mb-4"><i class="bi bi-megaphone"></i> Daftar Pengumuman</h3>
    <div class="card">
        <div class="card-body">

    <a href="{{ route('admin.pengumuman.create') }}" class="btn btn-primary mb-3">
        Tambah Pengumuman
    </a>

    @if ($data->count() == 0)
        <div class="alert alert-info">Belum ada pengumuman.</div>
    @else
        <table class="table table-bordered">
            <thead>
                <tr>
                    <th>Judul</th>
                    <th>Status</th>
                    <th>Tanggal</th>
                </tr>
            </thead>
            <tbody>
                @foreach ($data as $item)
                <tr>
                    <td>{{ $item->judul }}</td>
                    <td>
                        <span class="badge bg-{{ $item->status == 'aktif' ? 'success' : 'secondary' }}">
                            {{ $item->status }}
                        </span>
                    </td>
                    <td>{{ $item->created_at->format('d M Y') }}</td>
                </tr>
                @endforeach
            </tbody>
        </table>
    @endif
</div>
@endsection
