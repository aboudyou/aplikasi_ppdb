<h3>Pengumuman Hasil Seleksi</h3>

@if($data)
    <p>Status: <b>{{ strtoupper($data->status) }}</b></p>
    <p>Catatan: {{ $data->catatan }}</p>
@else
    <p>Belum ada pengumuman.</p>
@endif
