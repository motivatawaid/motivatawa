@extends('layouts.auth')

@section('title', 'Lupa Password')

@section('content')
<section class="section">
    <div class="container mt-5">
        <div class="row">
            <div class="col-12 col-sm-8 offset-sm-2 col-md-6 offset-md-3 col-lg-6 offset-lg-3 col-xl-4 offset-xl-4">
                <div class="login-brand">
                    <img src="{{ asset('assets/img/icon.png') }}" class="icon mb-3" alt="icon">
                    <p class="font-weight-bold text-dark" style="font-size:16px;">{{ env('APP_NAME') }}</p>
                </div>
                @if (session('status'))
                <div class="mb-4 alert alert-success">
                    {{ session('status') }}
                </div>
                @endif
                <div class="card">
                    <div class="card-header">
                        <h4>Lupa Password</h4>
                    </div>
                    <div class="card-body">
                        <p class="text-muted">Kami akan mengirim link reset password ke email anda</p>
                        <form method="POST" action="{{ route('password.email') }}">
                            @csrf
                            <div class="form-group">
                                <label for="email">Email</label>
                                <input id="email" type="email" class="form-control @error('email') is-invalid @enderror"
                                    name="email" tabindex="1" autofocus>
                                @error('email')
                                <div class="invalid-feedback">
                                    {{ $message }}
                                </div>
                                @enderror
                            </div>
                            <div class="form-group">
                                <button type="submit" class="btn btn-primary btn-lg btn-block" tabindex="4">
                                    Forgot Password
                                </button>
                            </div>
                        </form>
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