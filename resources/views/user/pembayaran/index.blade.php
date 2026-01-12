@extends('layouts.app')

@section('title', 'Pembayaran')

@section('content')

<div class="container mt-4">

    <h3 class="mb-3">Pembayaran Pendaftaran</h3>

    <div class="card p-4">

        @if(!$formulir)
            <div class="alert alert-warning">Anda belum mengisi biodata/formulir. <a href="{{ route('user.biodata') }}">Isi biodata</a> terlebih dahulu.</div>
        @else
            <p><strong>Nama:</strong> {{ $formulir->nama_lengkap }}</p>
            <p><strong>Gelombang:</strong> {{ $formulir->gelombang->nama_gelombang ?? '-' }}</p>
            
            @if($formulir->gelombang && $formulir->gelombang->nilai && $formulir->gelombang->nilai > 0)
                <div class="card p-3 bg-light mb-3">
                    <h6 class="mb-3">Rincian Biaya</h6>
                    
                    <p class="mb-1">
                        <strong>Biaya Pendaftaran:</strong> 
                        <span>Rp {{ number_format($formulir->gelombang->nilai, 0, ',', '.') }}</span>
                    </p>
                    
                    @if($formulir->gelombang->jenis_promo && $formulir->gelombang->nilai_promo > 0)
                        <div class="alert alert-success py-2 px-2 mt-2 mb-2">
                            <strong>✓ Promo Tersedia!</strong>
                            <br>
                            <small>
                                Jenis: <strong>{{ ucfirst($formulir->gelombang->jenis_promo) }}</strong>
                                @if($formulir->gelombang->tipe_nilai_promo === 'persen')
                                    - {{ $formulir->gelombang->nilai_promo }}%
                                @else
                                    - Rp {{ number_format($formulir->gelombang->nilai_promo, 0, ',', '.') }}
                                @endif
                            </small>
                        </div>
                        
                        <p class="mb-1">
                            <strong>{{ ucfirst($formulir->gelombang->jenis_promo) }}:</strong>
                            <span class="text-danger">
                                - Rp {{ number_format($formulir->gelombang->getNilaiPromo(), 0, ',', '.') }}
                            </span>
                        </p>
                        
                        <hr class="my-2">
                        
                        <p class="mb-0">
                            <strong class="text-success">Biaya Akhir:</strong>
                            <span class="text-success fs-5">
                                <strong>Rp {{ number_format($formulir->gelombang->getBiayaAkhir(), 0, ',', '.') }}</strong>
                            </span>
                        </p>
                    @else
                        <p class="text-muted mt-2">
                            <small>Tidak ada promo untuk gelombang ini</small>
                        </p>
                    @endif
                </div>
            @else
                <p><strong>Biaya:</strong>
                    <span class="badge bg-warning">Belum ditentukan admin</span>
                </p>
            @endif
        @endif

        <hr>

        @if ($pembayaran)
            <p><strong>Status Pembayaran:</strong> 
                <span class="badge 
                    @if($pembayaran->status == 'Menunggu') bg-warning text-dark
                    @elseif($pembayaran->status == 'Lunas') bg-success
                    @else bg-danger @endif">
                    {{ $pembayaran->status }}
                </span>
            </p>

            @if($pembayaran->bukti_bayar)
                <p><strong>Bukti Bayar:</strong></p>
                <img src="{{ asset('uploads/pembayaran/'.$pembayaran->bukti_bayar) }}" width="200" class="mb-3">
            @endif

            @if($pembayaran->status != 'Lunas')
                <hr>
                <div class="alert alert-info">
                    <strong>Catatan:</strong> Silakan upload ulang bukti pembayaran jika diperlukan.
                </div>
            @else
                <div class="alert alert-success">
                    <strong>Terima kasih!</strong> Pembayaran Anda telah diverifikasi dan diterima.
                </div>
            @endif
        @endif


        <hr>

        @if($formulir && ($formulir->gelombang && $formulir->gelombang->nilai && $formulir->gelombang->nilai > 0))
            <div class="alert alert-info">
                <strong>Jumlah yang Harus Dibayarkan:</strong>
                <h4 class="text-primary mt-2">Rp {{ number_format($formulir->gelombang->getBiayaAkhir(), 0, ',', '.') }}</h4>
            </div>

            <form id="pembayaranForm" action="{{ route('user.pembayaran.upload') }}" method="POST" enctype="multipart/form-data">
                @csrf

                <label>Metode Pembayaran</label>
                <select id="metodeSelect" name="metode" class="form-control mb-3" required>
                    <option value="">Pilih Metode</option>
                    <option>Transfer Bank</option>
                    <option>QRIS</option>
                    <option>Cash</option>
                </select>

                <label>Upload Bukti Pembayaran</label>
                <input type="file" id="buktiInput" name="bukti" class="form-control mb-3" required>

                <button class="btn btn-primary">Upload Pembayaran</button>
            </form>
        @elseif($formulir)
            <div class="alert alert-warning">
                <strong>Perhatian:</strong> Biaya pendaftaran belum ditentukan oleh admin. Silakan hubungi admin untuk mengatur biaya gelombang.
            </div>
        @endif

        <script>
            // Toggle required attribute on bukti file input based on metode selection
            (function(){
                const metode = document.getElementById('metodeSelect');
                const bukti = document.getElementById('buktiInput');
                if(!metode || !bukti) return;

                function toggleBuktiRequired(){
                    const val = metode.value.toLowerCase();
                    if(val.includes('cash')){
                        bukti.removeAttribute('required');
                    } else {
                        bukti.setAttribute('required','required');
                    }
                }

                metode.addEventListener('change', toggleBuktiRequired);
                // initialize
                toggleBuktiRequired();
            })();
        </script>

    </div>

</div>

@endsection
