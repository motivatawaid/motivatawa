{{-- resources/views/user/videos/show.blade.php --}}
@extends('layouts.app')

@section('title', $video->title)
@section('desc', $video->description)

@section('content')
<div class="row justify-content-center">
    <div class="col-md-10">
        <div class="card">
            <div class="card-header">
                <h4>{{ $video->title }}</h4>
            </div>
            <div class="card-body">
                <div class="row">
                    <div class="col-md-4">
                        @if($video->thumbnail)
                        <img src="{{ Storage::url($video->thumbnail) }}" class="img-fluid rounded mb-3"
                            alt="{{ $video->title }}">
                        @endif
                    </div>
                    <div class="col-md-8">
                        <p class="text-muted">{{ $video->talent->name }}</p>
                        <p>{{ $video->description }}</p>

                        <table class="table table-borderless">
                            <tr>
                                <td><i class="fas fa-money-bill"></i> Harga</td>
                                <td>
                                    : @if($video->price > 0)
                                    Rp {{ number_format($video->price, 0, ',', '.') }}
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
                        @if($purchase)
                        <p class="text-success"><i class="fas fa-check"></i> Anda sudah membeli video ini.</p>
                        <video controls class="img-fluid" style="max-width: 100%;">
                            <source src="{{ Storage::url($video->video_path) }}" type="video/mp4">
                            Browser Anda tidak mendukung video.
                        </video>
                        <a href="{{ Storage::url($video->video_path) }}" class="btn btn-primary btn-sm mt-2" download>
                            <i class="fas fa-download"></i> Download Video
                        </a>
                        @else
                        <p class="text-warning"><i class="fas fa-times"></i> Anda belum membeli video ini.</p>
                        @if($video->price > 0)
                        <form action="{{ route('user.videos.buy', $video->id) }}" method="POST">
                            @csrf
                            <button type="submit" class="btn btn-primary">
                                <i class="fas fa-shopping-cart"></i> Beli Sekarang
                            </button>
                        </form>
                        @else
                        <button class="btn btn-success" disabled>Akses Gratis</button>
                        @endif
                        @endif
                    </div>
                </div>

                <div class="mt-4">
                    <a href="{{ route('user.videos.index') }}" class="btn btn-secondary">
                        <i class="fas fa-arrow-left"></i> Kembali ke Daftar Video
                    </a>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection