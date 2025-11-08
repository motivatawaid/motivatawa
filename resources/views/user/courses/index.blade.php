@extends('layouts.app')

@section('title', 'Daftar Course')
@section('desc', 'Temukan dan daftar course yang tersedia')

@section('content')
<div class="row">
    <div class="col-12">
        <div class="card">
            <div class="card-header">
                <h4>Course Tersedia</h4>
            </div>
            <div class="card-body">
                @if($courses->isEmpty())
                <div class="empty-state" data-height="400">
                    <div class="empty-state-icon bg-primary">
                        <i class="fas fa-graduation-cap"></i>
                    </div>
                    <h2>Belum Ada Course</h2>
                    <p class="lead">Saat ini belum ada course yang tersedia. Silakan cek kembali nanti.</p>
                </div>
                @else
                <div class="row">
                    @foreach($courses as $course)
                    <div class="col-lg-4 col-md-6 col-sm-12 mb-4">
                        <div class="card card-primary h-100">
                            @if($course->thumbnail)
                            <img src="{{ Storage::url($course->thumbnail) }}" class="card-img-top"
                                alt="{{ $course->name }}" style="height: 200px; object-fit: cover;">
                            @else
                            <div class="card-img-top bg-primary d-flex align-items-center justify-content-center"
                                style="height: 200px;">
                                <i class="fas fa-graduation-cap fa-5x text-white"></i>
                            </div>
                            @endif
                            <div class="card-body d-flex flex-column">
                                <h5 class="card-title">{{ $course->name }}</h5>
                                <p class="card-text text-muted small mb-2">
                                    <i class="fas fa-user"></i> {{ $course->talent->name }}
                                </p>

                                <div class="mt-auto">
                                    <div class="d-flex justify-content-between align-items-center">
                                        <a href="{{ route('user.courses.show', $course->id) }}"
                                            class="btn btn-info btn-sm">
                                            <i class="fas fa-eye"></i> Detail
                                        </a>
                                        @if(in_array($course->id, $ownedRegistrationCourseIds))
                                        <span class="badge badge-success">
                                            <i class="fas fa-check"></i> Sudah Didaftar
                                        </span>
                                        @else
                                        <form action="{{ route('user.courses.buy', $course->id) }}" method="POST"
                                            style="display: inline;">
                                            @csrf
                                            <button type="submit" class="btn btn-primary btn-sm">
                                                <i class="fas fa-shopping-cart"></i> Daftar
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
                    {{ $courses->links() }}
                </div>
                @endif
            </div>
        </div>
    </div>
</div>
@endsection