@extends('layouts.app')

@section('content')

<div class="card p-4">

    <h3>Form Biodata</h3>

    <form action="{{ route('user.biodata.store') }}" method="POST">
        @csrf

        {{-- PILIH JURUSAN --}}
        <div class="mb-3">
            <label class="form-label">Pilih Jurusan</label>
            <select name="jurusan_id" class="form-control" required>
                <option value="">-- Pilih Jurusan --</option>
                @foreach($jurusan as $item)
                    <option value="{{ $item->id }}">{{ $item->nama_jurusan }}</option>
                @endforeach
            </select>
        </div>

        {{-- PILIH GELOMBANG --}}
        <div class="mb-3">
            <label class="form-label">Gelombang Pendaftaran</label>
            <select name="gelombang_id" class="form-control" required>
                <option value="">-- Pilih Gelombang --</option>
                @foreach($gelombang as $g)
                    <option value="{{ $g->id }}">{{ $g->nama_gelombang }}</option>
                @endforeach
            </select>
        </div>

        <button class="btn btn-primary w-100">Simpan Biodata</button>
    </form>

</div>

@endsection
