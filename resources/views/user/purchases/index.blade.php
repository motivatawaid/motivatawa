@extends('layouts.app')

@section('title', 'Pembelian Video Saya')
@section('desc', 'Daftar pembelian video premium yang sudah Anda beli')

@section('content')
<div class="row">
    <div class="col-12">
        <div class="card">
            <div class="card-header">
                <h4>Pembelian Video Saya</h4>
            </div>
            <div class="card-body">
                @if($purchases->isEmpty())
                <div class="empty-state" data-height="400">
                    <div class="empty-state-icon bg-primary">
                        <i class="fas fa-video"></i>
                    </div>
                    <h2>Belum Ada Pembelian</h2>
                    <p class="lead">Anda belum membeli video premium apapun.</p>
                    <a href="{{ route('user.videos.index') }}" class="btn btn-primary mt-3">
                        <i class="fas fa-search"></i> Cari Video
                    </a>
                </div>
                @else
                <div class="table-responsive">
                    <table class="table table-striped table-hover">
                        <thead>
                            <tr>
                                <th>#</th>
                                <th>Video</th>
                                <th>Talent</th>
                                <th>Tanggal Beli</th>
                                <th>Harga</th>
                                <th>Status</th>
                                <th>Aksi</th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach($purchases as $index => $purchase)
                            <tr>
                                <td>{{ $purchases->firstItem() + $index }}</td>
                                <td>
                                    <strong>{{ $purchase->video->title }}</strong><br>
                                    <small class="text-muted">{{ $purchase->video->talent->name }}</small>
                                </td>
                                <td>{{ $purchase->video->talent->name }}</td>
                                <td>{{ $purchase->created_at->format('d M Y, H:i') }}</td>
                                <td>Rp {{ number_format($purchase->price_paid, 0, ',', '.') }}</td>
                                <td>
                                    @if($purchase->status === 'purchased')
                                    <span class="badge badge-success">Aktif</span>
                                    @endif
                                </td>
                                <td>
                                    <a href="{{ route('user.purchases.show', $purchase->id) }}"
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
                    {{ $purchases->links() }}
                </div>
                @endif
            </div>
        </div>
    </div>
</div>
@endsection