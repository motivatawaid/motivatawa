@extends('layouts.app')

@section('title', 'Detail Registrasi')
@section('desc', 'Detail registrasi course Anda')

@section('content')
<div class="row justify-content-center">
    <div class="col-md-8">
        <div class="card">
            <div class="card-header">
                <h4>Detail Registrasi Course</h4>
            </div>
            <div class="card-body">
                <div class="row">
                    <div class="col-md-6">
                        <h5>{{ $registration->course->name }}</h5>
                        <p class="text-muted">{{ $registration->course->talent->name }}</p>

                        <table class="table table-borderless">
                            <tr>
                                <td width="120"><i class="fas fa-graduation-cap"></i> Course</td>
                                <td>: {{ $registration->course->name }}</td>
                            </tr>
                            <tr>
                                <td><i class="fas fa-user"></i> Tutor</td>
                                <td>: {{ $registration->course->talent->name }}</td>
                            </tr>
                            <tr>
                                <td><i class="fas fa-phone"></i> WhatsApp</td>
                                <td>: {{ $registration->whatsapp_number }}</td>
                            </tr>
                            <tr>
                                <td><i class="fas fa-money-bill"></i> Harga</td>
                                <td>: Rp {{ number_format($registration->price_paid, 0, ',', '.') }}</td>
                            </tr>
                            <tr>
                                <td><i class="fas fa-check"></i> Status</td>
                                <td>
                                    : @if($registration->status === 'purchased')
                                    <span class="badge badge-success">Aktif</span>
                                    @endif
                                </td>
                            </tr>
                            <tr>
                                <td><i class="fas fa-calendar"></i> Tanggal Daftar</td>
                                <td>: {{ $registration->created_at->format('d M Y, H:i') }}</td>
                            </tr>
                        </table>
                    </div>

                    <div class="col-md-6">
                        <div class="mb-3">
                            <h6>Detail Registrasi</h6>
                            <p class="text-muted">Registrasi Anda telah aktif. Anda sekarang memiliki akses ke course
                                ini.</p>

                            @if($registration->course->thumbnail)
                            <img src="{{ Storage::url($registration->course->thumbnail) }}"
                                class="img-fluid rounded mt-3" alt="{{ $registration->course->name }}"
                                style="max-height: 200px;">
                            @endif
                        </div>
                    </div>
                </div>

                <div class="mt-4">
                    <a href="{{ route('user.registrations.index') }}" class="btn btn-secondary">
                        <i class="fas fa-arrow-left"></i> Kembali
                    </a>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection