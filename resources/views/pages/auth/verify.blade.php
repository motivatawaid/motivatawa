@extends('layouts.auth')

@section('title', 'Register')

@section('content')
<section class="section">
    <div class="container mt-5">
        <div class="row justify-content-center">
            <div class="col-12 col-md-4">
                <div class="login-brand">
                    <img src="{{ asset('assets/img/icon.png') }}" class="icon mb-3" alt="icon">
                    <p class="font-weight-bold text-dark" style="font-size:16px;">{{ env('APP_NAME') }}</p>
                </div>
                @if (session('status') == 'verification-link-sent')
                <div class="mb-4 alert alert-success">
                    Email baru telah dikirim ke email anda
                </div>
                @endif
                <div class="card">
                    <div class="card-header">
                        <h4>Email anda belum verifikasi</h4>
                    </div>
                    <div class="card-body">
                        <p>tolong cek email anda dan klik link untuk verifikasi email.</p>
                        <div class="form-group">
                            <form action="{{ route('verification.send') }}" method="POST">
                                @csrf
                                <button type="submit" class="btn btn-primary btn-lg btn-block">
                                    Kirim Ulang Verifikasi Email
                                </button>
                            </form>
                        </div>
                    </div>
                </div>
                <div class="mt-5 text-muted text-center">
                    Sudah Punya Akun? <a href="{{ route('login') }}">Login</a>
                </div>
                <div class="simple-footer">
                    Copyright {{ date('Y') }} &copy; {{ env('APP_NAME') }}.
                </div>
            </div>
        </div>
    </div>
</section>
@endsection