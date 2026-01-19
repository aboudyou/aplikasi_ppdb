@extends('layouts.auth')

@section('title', 'Verifikasi Kode OTP - Reset Password')

@section('content')
    <div class="card my-5">
        <form method="POST" action="{{ route('forgot_password.verify_otp') }}">
            @csrf
            <div class="card-body">
                <div class="d-flex justify-content-between align-items-end mb-4">
                    <h3 class="mb-0"><b>Verifikasi Kode OTP</b></h3>
                    <a href="{{ route('forgot_password.email_form') }}" class="link-primary">Kembali</a>
                </div>

                @if ($errors->any())
                    <div class="alert alert-danger">
                        @foreach ($errors->all() as $error)
                            <div>{{ $error }}</div>
                        @endforeach
                    </div>
                @endif

                @if (session('success'))
                    <div class="alert alert-success">
                        {{ session('success') }}
                    </div>
                @endif

                <div class="mb-4">
                    <p class="text-muted">
                        Kami telah mengirimkan kode OTP (One-Time Password) ke email:
                        <br>
                        <strong>{{ $email }}</strong>
                    </p>
                    <p class="text-sm text-muted">Kode OTP berlaku selama 5 menit.</p>
                </div>

                <div class="form-group mb-3">
                    <label class="form-label">Masukkan Kode OTP (6 digit)</label>
                    <input type="text" 
                        name="otp" 
                        class="form-control form-control-lg text-center @error('otp') is-invalid @enderror" 
                        placeholder="000000"
                        maxlength="6"
                        inputmode="numeric"
                        pattern="[0-9]{6}"
                        autocomplete="off" 
                        autofocus 
                        required>
                    @error('otp')
                        <div class="invalid-feedback">
                            {{ $message }}
                        </div>
                    @enderror
                </div>

                <div class="d-grid mt-4">
                    <button type="submit" class="btn btn-primary">Verifikasi OTP</button>
                </div>

                <div class="mt-4 text-center">
                    @if ($cooldown >= $setResendOtp)
                        <form method="POST" action="{{ route('forgot_password.resend_otp') }}" style="display: inline;">
                            @csrf
                            <button type="submit" class="btn btn-link btn-sm p-0">Kirim ulang OTP</button>
                        </form>
                    @else
                        <p class="text-sm text-muted">
                            Kirim ulang OTP dalam <strong id="countdown">{{ $setResendOtp - $cooldown }}</strong> detik
                        </p>
                    @endif
                </div>

                <p class="mt-3 text-sm text-muted text-center">
                    Jangan terima pemberian kode OTP dari siapapun. Kami tidak akan pernah meminta kode OTP Anda.
                </p>
            </div>
        </form>
    </div>

    @if ($cooldown < $setResendOtp)
        <script>
            let countdown = {{ $setResendOtp - $cooldown }};
            const countdownElement = document.getElementById('countdown');

            setInterval(function() {
                countdown--;
                if (countdownElement) {
                    countdownElement.textContent = countdown;
                }
                if (countdown === 0) {
                    // Reload halaman untuk menampilkan tombol resend
                    location.reload();
                }
            }, 1000);
        </script>
    @endif
@endsection
x