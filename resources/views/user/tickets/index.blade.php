@extends('layouts.app')

@section('title', 'Tiket Saya')
@section('desc', 'Daftar tiket event yang sudah Anda beli')

@section('content')
<div class="row">
    <div class="col-12">
        <div class="card">
            <div class="card-header">
                <h4>Tiket Saya</h4>
            </div>
            <div class="card-body">
                @if($tickets->isEmpty())
                <div class="empty-state" data-height="400">
                    <div class="empty-state-icon bg-primary">
                        <i class="fas fa-ticket-alt"></i>
                    </div>
                    <h2>Belum Ada Tiket</h2>
                    <p class="lead">Anda belum membeli tiket event apapun.</p>
                    <a href="{{ route('user.events.index') }}" class="btn btn-primary mt-3">
                        <i class="fas fa-search"></i> Cari Event
                    </a>
                </div>
                @else
                <div class="table-responsive">
                    <table class="table table-striped table-hover">
                        <thead>
                            <tr>
                                <th>#</th>
                                <th>Event</th>
                                <th>Tanggal</th>
                                <th>Lokasi/Tipe</th>
                                <th>Harga</th>
                                <th>Status</th>
                                <th>Aksi</th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach($tickets as $index => $ticket)
                            <tr>
                                <td>{{ $tickets->firstItem() + $index }}</td>
                                <td>
                                    <strong>{{ $ticket->event->title }}</strong><br>
                                    <small class="text-muted">{{ $ticket->event->talent->name }}</small>
                                </td>
                                <td>{{ $ticket->event->start_date->format('d M Y, H:i') }}</td>
                                <td>
                                    @if($ticket->event->type === 'online')
                                    <span class="badge badge-info">Online</span>
                                    @else
                                    <small>{{ $ticket->event->location }}</small>
                                    @endif
                                </td>
                                <td>Rp {{ number_format($ticket->price_paid, 0, ',', '.') }}</td>
                                <td>
                                    @if($ticket->status === 'purchased')
                                    <span class="badge badge-success">Aktif</span>
                                    @endif
                                </td>
                                <td>
                                    <a href="{{ route('user.tickets.show', $ticket->id) }}"
                                        class="btn btn-primary btn-sm">
                                        <i class="fas fa-eye"></i> Lihat Detail
                                    </a>
                                </td>
                            </tr>
                            @endforeach
                        </tbody>
                    </table>
                </div>

                <div class="mt-3">
                    {{ $tickets->links() }}
                </div>
                @endif
            </div>
        </div>
    </div>
</div>
@endsection