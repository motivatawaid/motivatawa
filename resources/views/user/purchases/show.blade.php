{{-- resources/views/user/purchases/show.blade.php --}}
@extends('layouts.app')

@section('title', 'Detail Pembelian Video')
@section('desc', 'Detail pembelian video premium Anda')

@section('content')
<div class="row justify-content-center">
    <div class="col-md-8">
        <div class="card">
            <div class="card-header">
                <h4>Detail Pembelian Video</h4>
            </div>
            <div class="card-body">
                <div class="row">
                    <div class="col-md-6">
                        <h5>{{ $purchase->video->title }}</h5>
                        <p class="text-muted">{{ $purchase->video->talent->name }}</p>

                        <table class="table table-borderless">
                            <tr>
                                <td width="120"><i class="fas fa-user"></i> Talent</td>
                                <td>: {{ $purchase->video->talent->name }}</td>
                            </tr>
                            <tr>
                                <td><i class="fas fa-money-bill"></i> Harga</td>
                                <td>: Rp {{ number_format($purchase->price_paid, 0, ',', '.') }}</td>
                            </tr>
                            <tr>
                                <td><i class="fas fa-check"></i> Status</td>
                                <td>
                                    : @if($purchase->status === 'purchased')
                                    <span class="badge badge-success">Aktif</span>
                                    @endif
                                </td>
                            </tr>
                            <tr>
                                <td><i class="fas fa-calendar"></i> Dibeli</td>
                                <td>: {{ $purchase->created_at->format('d M Y, H:i') }}</td>
                            </tr>
                        </table>
                    </div>

                    <div class="col-md-6 text-center">
                        <div class="mb-3">
                            <h6>Akses Video</h6>
                            <video controls class="img-fluid" style="max-width: 250px;">
                                <source src="{{ Storage::url($purchase->video->video_path) }}" type="video/mp4">
                                Browser Anda tidak mendukung video.
                            </video>
                        </div>
                        <p class="text-muted small">Klik play untuk tonton video. Anda bisa download jika tersedia.</p>
                        <a href="{{ Storage::url($purchase->video->video_path) }}" class="btn btn-primary btn-sm"
                            download>
                            <i class="fas fa-download"></i> Download Video
                        </a>
                    </div>
                </div>

                <div class="mt-4">
                    <a href="{{ route('user.purchases.index') }}" class="btn btn-secondary">
                        <i class="fas fa-arrow-left"></i> Kembali
                    </a>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection