@extends('layouts.auth')

@section('title', 'Login Page')

@section('content')
    <form method="POST" action="{{ route('login.post') }}">
        @csrf
        <div class="text-center mb-4">
            <div style="font-size:2.5rem; margin-bottom:0.5rem;">
                <i class="bi bi-person-circle text-primary animate__animated animate__pulse animate__infinite"></i>
            </div>
            <h3 class="mb-0" style="font-weight:700; background: linear-gradient(90deg, #3b82f6 0%, #f59e0b 100%); -webkit-background-clip: text; -webkit-text-fill-color: transparent; background-clip: text;">Login Akun</h3>
            <a href="/register" class="link-primary d-block mt-2">Belum punya akun?</a>
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
        <div class="form-group mb-3">
            <label class="form-label">Email Address</label>
            <input type="email" class="form-control" name="email" placeholder="Email Address"
                value="{{ session('registered_email') }}" autocomplete="off" required>
        </div>
        <div class="form-group mb-3">
            <label for="password" class="form-label">Password</label>
            @if (session('registered_email'))
                <input id="password" type="password" class="form-control" name="password" placeholder="Password"
                    autofocus required>
            @else
                <input id="password" type="password" class="form-control" name="password" placeholder="Password"
                    required>
            @endif
        </div>
        <div class="d-flex align-items-center mt-1 justify-content-between">
            <div class="form-check">
                <input class="form-check-input input-primary" type="checkbox" id="customCheckc1" name="remember">
                <label class="form-check-label text-muted" for="customCheckc1">Tetap masuk</label>
            </div>
            <a href="{{ route('forgot_password.email_form') }}" class="text-secondary f-w-400">Lupa Password?</a>
        </div>
        <div class="d-grid mt-4">
            <button type="submit" class="btn btn-primary btn-lg" style="font-weight:600; letter-spacing:1px;">
                <i class="bi bi-box-arrow-in-right"></i> Login
            </button>
        </div>
        <div class="saprator mt-4 mb-2 text-center">
            <span style="color:#888;">Atau login dengan</span>
        </div>
        @include('auth.sso')
        </form>
    @endsection
