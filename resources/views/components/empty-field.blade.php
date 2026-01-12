@php
    // Komponen sederhana untuk menampilkan nilai atau indikator 'Belum diisi'
    // $value di-pass saat include: @include('components.empty-field', ['value' => $var])
    $isEmpty = is_null($value) || (is_string($value) && trim($value) === '');
@endphp

@if(!$isEmpty || $value === '0')
    {{ $value }}
@else
    <span class="text-muted"><small>&#8212; Belum diisi</small></span>
@endif
