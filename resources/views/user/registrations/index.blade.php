@extends('layouts.app')

@section('title', 'Registrasi Saya')
@section('desc', 'Daftar course yang sudah Anda daftar')

@section('content')
<div class="row">
    <div class="col-12">
        <div class="card">
            <div class="card-header">
                <h4>Registrasi Saya</h4>
            </div>
            <div class="card-body">
                @if($registrations->isEmpty())
                <div class="empty-state" data-height="400">
                    <div class="empty-state-icon bg-primary">
                        <i class="fas fa-graduation-cap"></i>
                    </div>
                    <h2>Belum Ada Registrasi</h2>
                    <p class="lead">Anda belum mendaftar course apapun.</p>
                    <a href="{{ route('user.courses.index') }}" class="btn btn-primary mt-3">
                        <i class="fas fa-search"></i> Cari Course
                    </a>
                </div>
                @else
                <div class="table-responsive">
                    <table class="table table-striped table-hover">
                        <thead>
                            <tr>
                                <th>#</th>
                                <th>Course</th>
                                <th>Tanggal Daftar</th>
                                <th>WhatsApp</th>
                                <th>Harga</th>
                                <th>Status</th>
                                <th>Aksi</th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach($registrations as $index => $registration)
                            <tr>
                                <td>{{ $registrations->firstItem() + $index }}</td>
                                <td>
                                    <strong>{{ $registration->course->name }}</strong><br>
                                    <small class="text-muted">{{ $registration->course->talent->name }}</small>
                                </td>
                                <td>{{ $registration->created_at->format('d M Y, H:i') }}</td>
                                <td>
                                    <small>{{ $registration->whatsapp_number }}</small>
                                </td>
                                <td>Rp {{ number_format($registration->price_paid, 0, ',', '.') }}</td>
                                <td>
                                    @if($registration->status === 'purchased')
                                    <span class="badge badge-success">Aktif</span>
                                    @endif
                                </td>
                                <td>
                                    <a href="{{ route('user.registrations.show', $registration->id) }}"
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
                    {{ $registrations->links() }}
                </div>
                @endif
            </div>
        </div>
    </div>
</div>
@endsection