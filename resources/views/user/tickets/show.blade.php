@extends('layouts.app')

@section('title', 'Detail Tiket')
@section('desc', 'Detail tiket event Anda')

@section('content')
<div class="row justify-content-center">
    <div class="col-md-8">
        <div class="card">
            <div class="card-header">
                <h4>Detail Tiket Event</h4>
            </div>
            <div class="card-body">
                <div class="row">
                    <div class="col-md-6">
                        <h5>{{ $ticket->event->title }}</h5>
                        <p class="text-muted">{{ $ticket->event->talent->name }}</p>

                        <table class="table table-borderless">
                            <tr>
                                <td width="120"><i class="fas fa-calendar"></i> Tanggal</td>
                                <td>: {{ $ticket->event->start_date->format('d M Y, H:i') }}</td>
                            </tr>
                            <tr>
                                <td><i class="fas fa-map-marker-alt"></i> Lokasi</td>
                                <td>
                                    : @if($ticket->event->type === 'online')
                                    Online Event
                                    @else
                                    {{ $ticket->event->location }}
                                    @endif
                                </td>
                            </tr>
                            <tr>
                                <td><i class="fas fa-money-bill"></i> Harga</td>
                                <td>: Rp {{ number_format($ticket->price_paid, 0, ',', '.') }}</td>
                            </tr>
                            <tr>
                                <td><i class="fas fa-check"></i> Status</td>
                                <td>
                                    : @if($ticket->status === 'purchased')
                                    <span class="badge badge-success">Aktif</span>
                                    @endif
                                </td>
                            </tr>
                        </table>
                    </div>

                    <div class="col-md-6">
                        <div class="mb-3">
                            <h6>Detail Tiket</h6>
                            <p class="text-muted">Tiket Anda siap digunakan untuk event ini.</p>
                        </div>
                    </div>
                </div>

                <div class="mt-4">
                    <a href="{{ route('user.tickets.index') }}" class="btn btn-secondary">
                        <i class="fas fa-arrow-left"></i> Kembali
                    </a>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection