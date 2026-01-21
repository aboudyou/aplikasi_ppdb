@extends('layouts.app')

@section('content')
<div class="container mt-4">

    {{-- Success Message --}}
    @if(session('success'))
        <div class="alert alert-success alert-dismissible fade show" role="alert">
            <i class="bi bi-check-circle"></i> {{ session('success') }}
            <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
        </div>
    @endif

    <!-- Data Sudah Tersimpan -->
    <div class="card mt-2 p-4 border-success bg-light">
        <div class="mb-3">
            <h5 class="mb-3"><i class="bi bi-check-circle text-success"></i> Data Orang Tua Sudah Tersimpan</h5>
            <p class="text-muted mb-0"><small>Terakhir diperbarui: {{ $orangTua->updated_at ? $orangTua->updated_at->format('d M Y H:i') : '-' }}</small></p>
        </div>

        {{-- Tab Info --}}
        <ul class="nav nav-tabs mb-3" role="tablist">
            <li class="nav-item" role="presentation">
                <button class="nav-link active" id="tab1-btn" data-bs-toggle="tab" data-bs-target="#tab1" type="button" role="tab">
                    <i class="bi bi-person"></i> Data Ayah
                </button>
            </li>
            <li class="nav-item" role="presentation">
                <button class="nav-link" id="tab2-btn" data-bs-toggle="tab" data-bs-target="#tab2" type="button" role="tab">
                    <i class="bi bi-person-fill"></i> Data Ibu
                </button>
            </li>
            @if($orangTua->nama_wali)
            <li class="nav-item" role="presentation">
                <button class="nav-link" id="tab3-btn" data-bs-toggle="tab" data-bs-target="#tab3" type="button" role="tab">
                    <i class="bi bi-person-square"></i> Data Wali
                </button>
            </li>
            @endif
        </ul>

        {{-- Tab Content --}}
        <div class="tab-content">
            {{-- Tab 1: Data Ayah --}}
            <div class="tab-pane fade show active" id="tab1" role="tabpanel">
                <div class="p-3 border-top">
                    <h6 class="mb-3"><strong>Data Ayah</strong></h6>
                    
                    <div class="row">
                        <div class="col-md-6 mb-3">
                            <p><strong>Nama:</strong> <span class="text-muted">{{ $orangTua->nama_ayah ?? '-' }}</span></p>
                        </div>
                        <div class="col-md-6 mb-3">
                            <p><strong>NIK:</strong> <span class="text-muted">{{ $orangTua->nik_ayah ?? '-' }}</span></p>
                        </div>
                    </div>

                    <div class="row">
                        <div class="col-md-6 mb-3">
                            <p><strong>Tanggal Lahir:</strong> <span class="text-muted">{{ $orangTua->tanggal_lahir_ayah ? \Carbon\Carbon::parse($orangTua->tanggal_lahir_ayah)->format('d M Y') : '-' }}</span></p>
                        </div>
                        <div class="col-md-6 mb-3">
                            <p><strong>Pekerjaan:</strong> <span class="text-muted">{{ $orangTua->pekerjaan_ayah ?? '-' }}</span></p>
                        </div>
                    </div>

                    <div class="row">
                        <div class="col-md-6 mb-3">
                            <p><strong>Penghasilan/Bulan:</strong> <span class="text-muted">Rp {{ number_format($orangTua->penghasilan_ayah, 0, ',', '.') }}</span></p>
                        </div>
                        <div class="col-md-6 mb-3">
                            <p><strong>Pendidikan:</strong> <span class="text-muted">{{ $orangTua->pendidikan_ayah ?? '-' }}</span></p>
                        </div>
                    </div>

                    <div class="row">
                        <div class="col-md-6 mb-3">
                            <p><strong>No. HP:</strong> <span class="text-muted">{{ $orangTua->no_hp_ayah ?? '-' }}</span></p>
                        </div>
                    </div>

                    <p><strong>Alamat:</strong></p>
                    <p class="text-muted">{{ $orangTua->alamat_ayah ?? '-' }}</p>
                </div>
            </div>

            {{-- Tab 2: Data Ibu --}}
            <div class="tab-pane fade" id="tab2" role="tabpanel">
                <div class="p-3 border-top">
                    <h6 class="mb-3"><strong>Data Ibu</strong></h6>
                    
                    <div class="row">
                        <div class="col-md-6 mb-3">
                            <p><strong>Nama:</strong> <span class="text-muted">{{ $orangTua->nama_ibu ?? '-' }}</span></p>
                        </div>
                        <div class="col-md-6 mb-3">
                            <p><strong>NIK:</strong> <span class="text-muted">{{ $orangTua->nik_ibu ?? '-' }}</span></p>
                        </div>
                    </div>

                    <div class="row">
                        <div class="col-md-6 mb-3">
                            <p><strong>Tanggal Lahir:</strong> <span class="text-muted">{{ $orangTua->tanggal_lahir_ibu ? \Carbon\Carbon::parse($orangTua->tanggal_lahir_ibu)->format('d M Y') : '-' }}</span></p>
                        </div>
                        <div class="col-md-6 mb-3">
                            <p><strong>Pekerjaan:</strong> <span class="text-muted">{{ $orangTua->pekerjaan_ibu ?? '-' }}</span></p>
                        </div>
                    </div>

                    <div class="row">
                        <div class="col-md-6 mb-3">
                            <p><strong>Penghasilan/Bulan:</strong> <span class="text-muted">Rp {{ number_format($orangTua->penghasilan_ibu, 0, ',', '.') }}</span></p>
                        </div>
                        <div class="col-md-6 mb-3">
                            <p><strong>Pendidikan:</strong> <span class="text-muted">{{ $orangTua->pendidikan_ibu ?? '-' }}</span></p>
                        </div>
                    </div>

                    <div class="row">
                        <div class="col-md-6 mb-3">
                            <p><strong>No. HP:</strong> <span class="text-muted">{{ $orangTua->no_hp_ibu ?? '-' }}</span></p>
                        </div>
                    </div>

                    <p><strong>Alamat:</strong></p>
                    <p class="text-muted">{{ $orangTua->alamat_ibu ?? '-' }}</p>
                </div>
            </div>

            {{-- Tab 3: Data Wali (jika ada) --}}
            @if($orangTua->nama_wali)
            <div class="tab-pane fade" id="tab3" role="tabpanel">
                <div class="p-3 border-top">
                    <h6 class="mb-3"><strong>Data Wali</strong></h6>
                    
                    <div class="row">
                        <div class="col-md-6 mb-3">
                            <p><strong>Nama:</strong> <span class="text-muted">{{ $orangTua->nama_wali ?? '-' }}</span></p>
                        </div>
                        <div class="col-md-6 mb-3">
                            <p><strong>NIK:</strong> <span class="text-muted">{{ $orangTua->nik_wali ?? '-' }}</span></p>
                        </div>
                    </div>

                    <div class="row">
                        <div class="col-md-6 mb-3">
                            <p><strong>Tanggal Lahir:</strong> <span class="text-muted">{{ $orangTua->tanggal_lahir_wali ? \Carbon\Carbon::parse($orangTua->tanggal_lahir_wali)->format('d M Y') : '-' }}</span></p>
                        </div>
                        <div class="col-md-6 mb-3">
                            <p><strong>Pekerjaan:</strong> <span class="text-muted">{{ $orangTua->pekerjaan_wali ?? '-' }}</span></p>
                        </div>
                    </div>

                    <div class="row">
                        <div class="col-md-6 mb-3">
                            <p><strong>Penghasilan/Bulan:</strong> <span class="text-muted">Rp {{ number_format($orangTua->penghasilan_wali, 0, ',', '.') }}</span></p>
                        </div>
                        <div class="col-md-6 mb-3">
                            <p><strong>Pendidikan:</strong> <span class="text-muted">{{ $orangTua->pendidikan_wali ?? '-' }}</span></p>
                        </div>
                    </div>

                    <div class="row">
                        <div class="col-md-6 mb-3">
                            <p><strong>No. HP:</strong> <span class="text-muted">{{ $orangTua->no_hp_wali ?? '-' }}</span></p>
                        </div>
                    </div>

                    <p><strong>Alamat:</strong></p>
                    <p class="text-muted">{{ $orangTua->alamat_wali ?? '-' }}</p>
                </div>
            </div>
            @endif
        </div>

        <!-- Tombol Aksi -->
        <div class="mt-4 pt-3 border-top">
            <div class="d-flex gap-2 flex-wrap">
                <a href="{{ route('user.dashboard') }}" class="btn btn-success">
                    <i class="bi bi-check"></i> Lanjut ke Step Berikutnya
                </a>
                <a href="{{ route('user.orangtua.step1') }}" class="btn btn-warning">
                    <i class="bi bi-pencil"></i> Edit Data
                </a>
            </div>
        </div>
    </div>

</div>
@endsection
