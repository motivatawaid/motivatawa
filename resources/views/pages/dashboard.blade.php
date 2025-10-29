{{-- resources/views/dashboard.blade.php --}}

@extends('layouts.app')

@section('title', 'Dashboard')
@section('desc', 'Halaman Dashboard.')

@section('content')
@if(in_array(auth()->user()->role, ['admin']))
{{-- Dashboard Superadmin & Admin --}}
<div class="row">
    <div class="col-lg-3 col-md-6 col-sm-12">
        <div class="card card-statistic-2">
            <div class="card-icon shadow-primary bg-primary">
                <i class="fas fa-users"></i>
            </div>
            <div class="card-wrap">
                <div class="card-header">
                    <h4>Total Users</h4>
                </div>
                <div class="card-body">
                    {{ $data['totalUsers'] ?? 0 }}
                </div>
            </div>
        </div>
    </div>
    <div class="col-lg-3 col-md-6 col-sm-12">
        <div class="card card-statistic-2">
            <div class="card-icon shadow-success bg-success">
                <i class="fas fa-calendar-alt"></i>
            </div>
            <div class="card-wrap">
                <div class="card-header">
                    <h4>Total Events</h4>
                </div>
                <div class="card-body">
                    {{ $data['totalEvents'] ?? 0 }}
                </div>
            </div>
        </div>
    </div>
    <div class="col-lg-3 col-md-6 col-sm-12">
        <div class="card card-statistic-2">
            <div class="card-icon shadow-info bg-info">
                <i class="fas fa-video"></i>
            </div>
            <div class="card-wrap">
                <div class="card-header">
                    <h4>Total Videos</h4>
                </div>
                <div class="card-body">
                    {{ $data['totalVideos'] ?? 0 }}
                </div>
            </div>
        </div>
    </div>
    <div class="col-lg-3 col-md-6 col-sm-12">
        <div class="card card-statistic-2">
            <div class="card-icon shadow-warning bg-warning">
                <i class="fas fa-dollar-sign"></i>
            </div>
            <div class="card-wrap">
                <div class="card-header">
                    <h4>Total Revenue</h4>
                </div>
                <div class="card-body">
                    Rp {{ number_format($data['totalRevenue'] ?? 0, 0, ',', '.') }}
                </div>
            </div>
        </div>
    </div>
</div>

{{-- Recent Events --}}
<div class="row">
    <div class="col-12">
        <div class="card">
            <div class="card-header">
                <h4>Recent Events</h4>
            </div>
            <div class="card-body">
                <div class="table-responsive">
                    <table class="table table-striped">
                        <thead>
                            <tr>
                                <th>Title</th>
                                <th>Talent</th>
                                <th>Start Date</th>
                                <th>Quota Sold</th>
                            </tr>
                        </thead>
                        <tbody>
                            @forelse($data['recentEvents'] ?? [] as $event)
                            <tr>
                                <td>{{ $event->title }}</td>
                                <td>{{ $event->talent->name ?? 'N/A' }}</td>
                                <td>{{ $event->start_date->format('d/m/Y H:i') }}</td>
                                <td>{{ $event->tickets()->where('status', 'purchased')->count() }} /
                                    {{ $event->quota }}</td>
                            </tr>
                            @empty
                            <tr>
                                <td colspan="4">No recent events.</td>
                            </tr>
                            @endforelse
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
    </div>
</div>

{{-- Recent Videos --}}
<div class="row">
    <div class="col-12">
        <div class="card">
            <div class="card-header">
                <h4>Recent Videos</h4>
            </div>
            <div class="card-body">
                <div class="table-responsive">
                    <table class="table table-striped">
                        <thead>
                            <tr>
                                <th>Title</th>
                                <th>Talent</th>
                                <th>Sales</th>
                            </tr>
                        </thead>
                        <tbody>
                            @forelse($data['recentVideos'] ?? [] as $video)
                            <tr>
                                <td>{{ $video->title }}</td>
                                <td>{{ $video->talent->name ?? 'N/A' }}</td>
                                <td>{{ $video->purchases()->where('status', 'purchased')->count() }}</td>
                            </tr>
                            @empty
                            <tr>
                                <td colspan="3">No recent videos.</td>
                            </tr>
                            @endforelse
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
    </div>
</div>

@elseif(auth()->user()->role === 'talent')
{{-- Dashboard Talent --}}
<div class="row">
    <div class="col-lg-3 col-md-6 col-sm-12">
        <div class="card card-statistic-2">
            <div class="card-icon shadow-primary bg-primary">
                <i class="fas fa-calendar-alt"></i>
            </div>
            <div class="card-wrap">
                <div class="card-header">
                    <h4>My Events</h4>
                </div>
                <div class="card-body">
                    {{ $data['totalEvents'] ?? 0 }}
                </div>
            </div>
        </div>
    </div>
    <div class="col-lg-3 col-md-6 col-sm-12">
        <div class="card card-statistic-2">
            <div class="card-icon shadow-success bg-success">
                <i class="fas fa-video"></i>
            </div>
            <div class="card-wrap">
                <div class="card-header">
                    <h4>My Videos</h4>
                </div>
                <div class="card-body">
                    {{ $data['totalVideos'] ?? 0 }}
                </div>
            </div>
        </div>
    </div>
    <div class="col-lg-3 col-md-6 col-sm-12">
        <div class="card card-statistic-2">
            <div class="card-icon shadow-info bg-info">
                <i class="fas fa-ticket-alt"></i>
            </div>
            <div class="card-wrap">
                <div class="card-header">
                    <h4>Ticket Sales</h4>
                </div>
                <div class="card-body">
                    {{ $data['totalTicketSales'] ?? 0 }}
                </div>
            </div>
        </div>
    </div>
    <div class="col-lg-3 col-md-6 col-sm-12">
        <div class="card card-statistic-2">
            <div class="card-icon shadow-warning bg-warning">
                <i class="fas fa-dollar-sign"></i>
            </div>
            <div class="card-wrap">
                <div class="card-header">
                    <h4>Total Revenue</h4>
                </div>
                <div class="card-body">
                    Rp {{ number_format($data['totalRevenue'] ?? 0, 0, ',', '.') }}
                </div>
            </div>
        </div>
    </div>
</div>

{{-- My Events --}}
<div class="row">
    <div class="col-12">
        <div class="card">
            <div class="card-header">
                <h4>My Events</h4>
            </div>
            <div class="card-body">
                <div class="table-responsive">
                    <table class="table table-striped">
                        <thead>
                            <tr>
                                <th>Title</th>
                                <th>Start Date</th>
                                <th>Tickets Sold</th>
                                <th>Revenue</th>
                            </tr>
                        </thead>
                        <tbody>
                            @forelse($data['myEvents'] ?? [] as $event)
                            <tr>
                                <td>{{ $event->title }}</td>
                                <td>{{ $event->start_date->format('d/m/Y H:i') }}</td>
                                <td>{{ $event->tickets_count }} / {{ $event->quota }}</td>
                                <td>Rp
                                    {{ number_format($event->tickets()->where('status', 'purchased')->sum('price_paid'), 0, ',', '.') }}
                                </td>
                            </tr>
                            @empty
                            <tr>
                                <td colspan="4">No events yet. <a href="{{ route('events.create') }}">Create
                                        one!</a></td>
                            </tr>
                            @endforelse
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
    </div>
</div>

{{-- My Videos --}}
<div class="row">
    <div class="col-12">
        <div class="card">
            <div class="card-header">
                <h4>My Videos</h4>
            </div>
            <div class="card-body">
                <div class="table-responsive">
                    <table class="table table-striped">
                        <thead>
                            <tr>
                                <th>Title</th>
                                <th>Sales</th>
                                <th>Revenue</th>
                            </tr>
                        </thead>
                        <tbody>
                            @forelse($data['myVideos'] ?? [] as $video)
                            <tr>
                                <td>{{ $video->title }}</td>
                                <td>{{ $video->purchases_count }}</td>
                                <td>Rp
                                    {{ number_format($video->purchases()->where('status', 'purchased')->sum('price_paid'), 0, ',', '.') }}
                                </td>
                            </tr>
                            @empty
                            <tr>
                                <td colspan="3">No videos yet. <a href="{{ route('videos.create') }}">Upload
                                        one!</a></td>
                            </tr>
                            @endforelse
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
    </div>
</div>

@elseif(auth()->user()->role === 'user')
{{-- Dashboard User --}}
<div class="row">
    <div class="col-lg-4 col-md-6 col-sm-12">
        <div class="card card-statistic-2">
            <div class="card-icon shadow-primary bg-primary">
                <i class="fas fa-ticket-alt"></i>
            </div>
            <div class="card-wrap">
                <div class="card-header">
                    <h4>My Tickets</h4>
                </div>
                <div class="card-body">
                    {{ $data['totalTickets'] ?? 0 }}
                </div>
            </div>
        </div>
    </div>
    <div class="col-lg-4 col-md-6 col-sm-12">
        <div class="card card-statistic-2">
            <div class="card-icon shadow-success bg-success">
                <i class="fas fa-shopping-cart"></i>
            </div>
            <div class="card-wrap">
                <div class="card-header">
                    <h4>My Purchases</h4>
                </div>
                <div class="card-body">
                    {{ $data['totalPurchases'] ?? 0 }}
                </div>
            </div>
        </div>
    </div>
    <div class="col-lg-4 col-md-6 col-sm-12">
        <div class="card card-statistic-2">
            <div class="card-icon shadow-info bg-info">
                <i class="fas fa-dollar-sign"></i>
            </div>
            <div class="card-wrap">
                <div class="card-header">
                    <h4>Total Spent</h4>
                </div>
                <div class="card-body">
                    Rp {{ number_format($data['totalSpent'] ?? 0, 0, ',', '.') }}
                </div>
            </div>
        </div>
    </div>
</div>

{{-- My Tickets --}}
<div class="row">
    <div class="col-12">
        <div class="card">
            <div class="card-header">
                <h4>My Tickets</h4>
                <a href="{{ route('user.tickets.index') }}" class="btn btn-primary float-right">View All</a>
            </div>
            <div class="card-body">
                <div class="table-responsive">
                    <table class="table table-striped">
                        <thead>
                            <tr>
                                <th>Event</th>
                                <th>Status</th>
                                <th>Purchase Date</th>
                            </tr>
                        </thead>
                        <tbody>
                            @forelse($data['myTickets'] ?? [] as $ticket)
                            <tr>
                                <td>{{ $ticket->event->title ?? 'N/A' }}</td>
                                <td><span class="badge badge-success">{{ ucfirst($ticket->status) }}</span>
                                </td>
                                <td>{{ $ticket->created_at->format('d/m/Y H:i') }}</td>
                            </tr>
                            @empty
                            <tr>
                                <td colspan="3">No tickets yet. <a href="{{ route('user.events.index') }}">Browse
                                        Events</a></td>
                            </tr>
                            @endforelse
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
    </div>
</div>

{{-- My Purchases --}}
<div class="row">
    <div class="col-12">
        <div class="card">
            <div class="card-header">
                <h4>My Videos</h4>
                <a href="{{ route('user.purchases.index') }}" class="btn btn-primary float-right">View
                    All</a>
            </div>
            <div class="card-body">
                <div class="table-responsive">
                    <table class="table table-striped">
                        <thead>
                            <tr>
                                <th>Video</th>
                                <th>Status</th>
                                <th>Purchase Date</th>
                            </tr>
                        </thead>
                        <tbody>
                            @forelse($data['myPurchases'] ?? [] as $purchase)
                            <tr>
                                <td>{{ $purchase->video->title ?? 'N/A' }}</td>
                                <td><span class="badge badge-success">{{ ucfirst($purchase->status) }}</span>
                                </td>
                                <td>{{ $purchase->created_at->format('d/m/Y H:i') }}</td>
                            </tr>
                            @empty
                            <tr>
                                <td colspan="3">No purchases yet. <a href="{{ route('user.videos.index') }}">Browse
                                        Videos</a></td>
                            </tr>
                            @endforelse
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
    </div>
</div>
@endif
@endsection