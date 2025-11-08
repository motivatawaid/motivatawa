@extends('layouts.app')

@section('title', $course->name)
@section('desc', $course->description)

@section('content')
<div class="row justify-content-center">
    <div class="col-md-10">
        <div class="card">
            <div class="card-header">
                <h4>{{ $course->name }}</h4>
            </div>
            <div class="card-body">
                <div class="row">
                    <div class="col-md-4">
                        @if($course->thumbnail)
                        <img src="{{ Storage::url($course->thumbnail) }}" class="img-fluid rounded mb-3"
                            alt="{{ $course->name }}">
                        @endif
                    </div>
                    <div class="col-md-8">
                        <p class="text-muted">{{ $course->talent->name }}</p>
                        <p>{{ $course->description }}</p>

                        <table class="table table-borderless">
                            <tr>
                                <td><i class="fas fa-graduation-cap"></i> Tipe</td>
                                <td>: Online Course</td>
                            </tr>
                            <tr>
                                <td><i class="fas fa-users"></i> Kuota</td>
                                <td>: {{ $course->quota }} peserta tersisa</td>
                            </tr>
                            <tr>
                                <td><i class="fas fa-money-bill"></i> Harga</td>
                                <td>
                                    : @if($course->price > 0)
                                    Rp {{ number_format($course->price, 0, ',', '.') }}
                                    @else
                                    Gratis
                                    @endif
                                </td>
                            </tr>
                        </table>
                    </div>
                </div>

                <hr>

                <div class="row">
                    <div class="col-md-6">
                        <h6>Status Akses Anda</h6>
                        @if($registration)
                        <p class="text-success"><i class="fas fa-check"></i> Anda sudah terdaftar untuk course ini.</p>
                        <a href="{{ route('user.registrations.show', $registration->id) }}"
                            class="btn btn-primary btn-sm">
                            <i class="fas fa-eye"></i> Lihat Registrasi
                        </a>
                        @else
                        <p class="text-warning"><i class="fas fa-times"></i> Anda belum mendaftar untuk course ini.</p>
                        @if($course->quota > 0)
                        <form action="{{ route('user.courses.buy', $course->id) }}" method="POST">
                            @csrf
                            <button type="submit" class="btn btn-primary">
                                <i class="fas fa-shopping-cart"></i> Daftar Sekarang
                            </button>
                        </form>
                        @else
                        <button class="btn btn-secondary" disabled>Course Penuh</button>
                        @endif
                        @endif
                    </div>
                </div>

                <div class="mt-4">
                    <a href="{{ route('user.courses.index') }}" class="btn btn-secondary">
                        <i class="fas fa-arrow-left"></i> Kembali ke Daftar Course
                    </a>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection