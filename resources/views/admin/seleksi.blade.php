@extends('layouts.app')

@section('content')
<div class="container">
    <h2 class="mb-4">📊 Data Seleksi Siswa</h2>

    @if(session('success'))
        <div class="alert alert-success">{{ session('success') }}</div>
    @endif

    <table class="table table-bordered">
        <thead class="table-light">
            <tr>
                <th>Nama</th>
                <th>Email</th>
                <th>Status</th>
                <th>Nilai</th>
                <th>Keterangan</th>
                <th>Aksi</th>
            </tr>
        </thead>
        <tbody>
            @foreach($siswa as $item)
                @php
                    $status = $statusSeleksi->where('user_id', $item->id)->first();
                @endphp
                <tr>
                    <td>{{ $item->name }}</td>
                    <td>{{ $item->email }}</td>
                    <td>{{ $status->status ?? '-' }}</td>
                    <td>{{ $status->nilai ?? '-' }}</td>
                    <td>{{ $status->keterangan ?? '-' }}</td>

                    <td>
                        <form action="{{ route('admin.seleksi.update', $item->id) }}" method="POST" class="d-flex gap-2">
                            @csrf

                            <select name="status" class="form-select form-select-sm" required>
                                <option value="">-- Pilih --</option>
                                <option value="Lulus" {{ ($status->status ?? '') == 'Lulus' ? 'selected' : '' }}>Lulus</option>
                                <option value="Tidak Lulus" {{ ($status->status ?? '') == 'Tidak Lulus' ? 'selected' : '' }}>Tidak Lulus</option>
                            </select>

                            <input type="number" name="nilai" step="0.01"
                                   value="{{ $status->nilai ?? '' }}"
                                   placeholder="Nilai" class="form-control form-control-sm" style="width:100px">

                            <input type="text" name="keterangan"
                                   value="{{ $status->keterangan ?? '' }}"
                                   placeholder="Keterangan" class="form-control form-control-sm">

                            <button type="submit" class="btn btn-primary btn-sm">Simpan</button>
                        </form>
                    </td>

                </tr>
            @endforeach
        </tbody>
    </table>
</div>
@endsection
