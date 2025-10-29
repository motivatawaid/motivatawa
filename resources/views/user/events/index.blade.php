@extends('layouts.app')

@section('title', 'Daftar Event')
@section('desc', 'Temukan dan beli akses event yang tersedia')

@section('content')
<div class="row">
    <div class="col-12">
        <div class="card">
            <div class="card-header">
                <h4>Event Tersedia</h4>
            </div>
            <div class="card-body">
                @if($events->isEmpty())
                <div class="empty-state" data-height="400">
                    <div class="empty-state-icon bg-primary">
                        <i class="fas fa-calendar"></i>
                    </div>
                    <h2>Belum Ada Event</h2>
                    <p class="lead">Saat ini belum ada event yang tersedia. Silakan cek kembali nanti.</p>
                </div>
                @else
                <div class="row">
                    @foreach($events as $event)
                    <div class="col-lg-4 col-md-6 col-sm-12 mb-4">
                        <div class="card card-primary h-100">
                            @if($event->thumbnail)
                            <img src="{{ Storage::url($event->thumbnail) }}" class="card-img-top"
                                alt="{{ $event->title }}" style="height: 200px; object-fit: cover;">
                            @else
                            <div class="card-img-top bg-primary d-flex align-items-center justify-content-center"
                                style="height: 200px;">
                                <i class="fas fa-calendar-alt fa-5x text-white"></i>
                            </div>
                            @endif
                            <div class="card-body d-flex flex-column">
                                <h5 class="card-title">{{ $event->title }}</h5>
                                <p class="card-text text-muted small mb-2">
                                    <i class="fas fa-user"></i> {{ $event->talent->name }}
                                </p>

                                <div class="mt-auto">
                                    <div class="d-flex justify-content-between align-items-center">
                                        <a href="{{ route('user.events.show', $event->id) }}"
                                            class="btn btn-info btn-sm">
                                            <i class="fas fa-eye"></i> Detail
                                        </a>
                                        @if(in_array($event->id, $ownedTicketEventIds))
                                        <span class="badge badge-success">
                                            <i class="fas fa-check"></i> Sudah Dibeli
                                        </span>
                                        @else
                                        <form action="{{ route('user.events.buy', $event->id) }}" method="POST"
                                            style="display: inline;">
                                            @csrf
                                            <button type="submit" class="btn btn-primary btn-sm">
                                                <i class="fas fa-shopping-cart"></i> Beli
                                            </button>
                                        </form>
                                        @endif
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                    @endforeach
                </div>

                <div class="mt-3">
                    {{ $events->links() }}
                </div>
                @endif
            </div>
        </div>
    </div>
</div>
@endsection