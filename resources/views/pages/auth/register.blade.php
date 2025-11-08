@extends('layouts.auth')

@section('title', 'Register')

@section('content')
<section class="section">
    <div class="container mt-5">
        <div class="row">
            <div class="col-12 col-sm-10 offset-sm-1 col-md-8 offset-md-2 col-lg-8 offset-lg-2 col-xl-8 offset-xl-2">
                <div class="login-brand">
                    <img src="{{ asset('assets/img/icon.png') }}" class="icon mb-3" alt="icon">
                    <p class="font-weight-bold text-dark" style="font-size:16px;">{{ env('APP_NAME') }}</p>
                </div>
                <div class="card">
                    <div class="card-header">
                        <h4>Register</h4>
                    </div>
                    <div class="card-body">
                        <form method="POST" action="{{ route('register') }}" autocomplete="off">
                            @csrf
                            <div class="row">
                                <div class="form-group col-md-6">
                                    <label for="name">Nama</label>
                                    <input value="{{ old('name') }}" id="name" type="text"
                                        class="form-control @error('name') is-invalid @enderror" name="name" autofocus>
                                    @error('name')
                                    <div class="invalid-feedback">
                                        {{ $message }}
                                    </div>
                                    @enderror
                                </div>
                                <div class="form-group col-md-6">
                                    <label for="username">Username</label>
                                    <input value="{{ old('username') }}" id="username" type="text"
                                        class="form-control @error('username') is-invalid @enderror" name="username">
                                    @error('username')
                                    <div class="invalid-feedback">
                                        {{ $message }}
                                    </div>
                                    @enderror
                                </div>
                            </div>
                            <div class="row">
                                <div class="form-group col-md-6">
                                    <label for="email">Email</label>
                                    <input value="{{ old('email') }}" id="email" type="email"
                                        class="form-control @error('email') is-invalid @enderror" name="email">
                                    @error('email')
                                    <div class="invalid-feedback">
                                        {{ $message }}
                                    </div>
                                    @enderror
                                </div>
                                <div class="form-group col-md-6">
                                    <label for="whatsapp_number">WhatsApp Number</label>
                                    <div class="input-group">
                                        <div class="input-group-prepend">
                                            <span class="input-group-text">+62</span>
                                        </div>
                                        <input value="{{ old('whatsapp_number') }}" id="whatsapp_number" type="tel"
                                            class="form-control @error('whatsapp_number') is-invalid @enderror"
                                            name="whatsapp_number" placeholder="81234567890">
                                    </div>
                                    <small class="form-text text-muted">
                                        Contoh: 81234567890 (tanpa +62)
                                    </small>
                                    @error('whatsapp_number')
                                    <div class="invalid-feedback">
                                        {{ $message }}
                                    </div>
                                    @enderror
                                </div>
                            </div>
                            <div class="row">
                                <div class="form-group col-md-6">
                                    <label for="password" class="d-block">Password</label>
                                    <input id="password" type="password"
                                        class="form-control @error('password') is-invalid @enderror" name="password">
                                    @error('password')
                                    <div class="invalid-feedback">
                                        {{ $message }}
                                    </div>
                                    @enderror
                                </div>
                                <div class="form-group col-md-6">
                                    <label for="password_confirmation" class="d-block">Password Confirmation</label>
                                    <input id="password_confirmation" type="password"
                                        class="form-control @error('password_confirmation') is-invalid @enderror"
                                        name="password_confirmation">
                                    @error('password_confirmation')
                                    <div class="invalid-feedback">
                                        {{ $message }}
                                    </div>
                                    @enderror
                                </div>
                            </div>
                            <div class="form-group">
                                <button type="submit" class="btn btn-primary btn-lg btn-block">
                                    Register
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