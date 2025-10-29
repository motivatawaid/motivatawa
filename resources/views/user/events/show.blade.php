{{-- resources/views/user/events/show.blade.php --}}
@extends('layouts.app')

@section('title', $event->title)
@section('desc', $event->description)

@section('content')
<div class="row justify-content-center">
    <div class="col-md-10">
        <div class="card">
            <div class="card-header">
                <h4>{{ $event->title }}</h4>
            </div>
            <div class="card-body">
                <div class="row">
                    <div class="col-md-4">
                        @if($event->thumbnail)
                        <img src="{{ Storage::url($event->thumbnail) }}" class="img-fluid rounded mb-3"
                            alt="{{ $event->title }}">
                        @endif
                    </div>
                    <div class="col-md-8">
                        <p class="text-muted">{{ $event->talent->name }}</p>
                        <p>{{ $event->description }}</p>

                        <table class="table table-borderless">
                            <tr>
                                <td><i class="fas fa-calendar"></i> Tanggal</td>
                                <td>: {{ $event->start_date->format('d M Y, H:i') }} -
                                    {{ $event->end_date->format('H:i') }}</td>
                            </tr>
                            <tr>
                                <td><i class="fas fa-map-marker-alt"></i> Lokasi</td>
                                <td>
                                    : @if($event->type === 'online')
                                    Online Event
                                    @else
                                    {{ $event->location }}
                                    @endif
                                </td>
                            </tr>
                            <tr>
                                <td><i class="fas fa-users"></i> Kuota</td>
                                <td>: {{ $event->quota }} tersisa</td>
                            </tr>
                            <tr>
                                <td><i class="fas fa-tag"></i> Tipe</td>
                                <td>: {{ ucfirst($event->type) }}</td>
                            </tr>
                            <tr>
                                <td><i class="fas fa-money-bill"></i> Harga</td>
                                <td>
                                    : @if($event->price > 0)
                                    Rp {{ number_format($event->price, 0, ',', '.') }}
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
                        @if($ticket)
                        <p class="text-success"><i class="fas fa-check"></i> Anda sudah memiliki tiket untuk event ini.
                        </p>
                        <a href="{{ route('user.tickets.show', $ticket->id) }}" class="btn btn-primary btn-sm">
                            <i class="fas fa-eye"></i> Lihat Tiket
                        </a>
                        @else
                        <p class="text-warning"><i class="fas fa-times"></i> Anda belum membeli tiket untuk event ini.
                        </p>
                        @if($event->start_date > now() && $event->quota > 0)
                        <form action="{{ route('user.events.buy', $event->id) }}" method="POST">
                            @csrf
                            <button type="submit" class="btn btn-primary">
                                <i class="fas fa-shopping-cart"></i> Beli Sekarang
                            </button>
                        </form>
                        @else
                        <button class="btn btn-secondary" disabled>Event Tidak Tersedia</button>
                        @endif
                        @endif
                    </div>
                </div>

                <div class="mt-4">
                    <a href="{{ route('user.events.index') }}" class="btn btn-secondary">
                        <i class="fas fa-arrow-left"></i> Kembali ke Daftar Event
                    </a>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection