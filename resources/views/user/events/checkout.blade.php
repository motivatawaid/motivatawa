@extends('layouts.app')

@section('title', 'Checkout Event')
@section('desc', 'Selesaikan pembayaran event Anda')

@section('content')
<div class="row justify-content-center">
    <div class="col-md-8">
        <div class="card">
            <div class="card-header">
                <h4>Checkout Event</h4>
            </div>
            <div class="card-body">
                <div class="alert alert-info">
                    <i class="fas fa-info-circle"></i> Selesaikan pembayaran untuk mendapatkan akses event Anda.
                </div>

                <div class="row">
                    <div class="col-md-6">
                        @if($event->thumbnail)
                        <img src="{{ Storage::url($event->thumbnail) }}" class="img-fluid rounded mb-3"
                            alt="{{ $event->title }}">
                        @endif
                    </div>
                    <div class="col-md-6">
                        <h5>{{ $event->title }}</h5>
                        <p class="text-muted">{{ $event->talent->name }}</p>

                        <table class="table table-borderless">
                            <tr>
                                <td><i class="fas fa-calendar"></i> Tanggal</td>
                                <td>: {{ $event->start_date->format('d M Y, H:i') }}</td>
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
                        </table>
                    </div>
                </div>

                <hr>

                <div class="row">
                    <div class="col-md-6">
                        <h6>Detail Pembayaran</h6>
                        <table class="table">
                            <tr>
                                <td>Harga Event</td>
                                <td class="text-right">Rp {{ number_format($event->price, 0, ',', '.') }}</td>
                            </tr>
                            <tr class="font-weight-bold">
                                <td>Total</td>
                                <td class="text-right">Rp {{ number_format($event->price, 0, ',', '.') }}</td>
                            </tr>
                        </table>
                    </div>
                </div>

                <div class="mt-4">
                    <button type="button" class="btn btn-primary btn-lg btn-block" id="pay-button">
                        <i class="fas fa-credit-card"></i> Bayar Sekarang
                    </button>
                    <a href="{{ route('user.events.index') }}" class="btn btn-secondary btn-block">
                        <i class="fas fa-arrow-left"></i> Kembali ke Event
                    </a>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection

@push('scripts')
<script src="https://app.midtrans.com/snap/snap.js" data-client-key="{{ config('midtrans.client_key') }}">
</script>
<script>
    document.addEventListener('DOMContentLoaded', function() {
        const payButton = document.getElementById('pay-button');
        
        payButton.addEventListener('click', function() {
            payButton.disabled = true;
            payButton.innerHTML = '<i class="fas fa-spinner fa-spin"></i> Memproses...';
            
            fetch('{{ route("payment.snap-token") }}', {
                method: 'POST',
                headers: {
                    'Content-Type': 'application/json',
                    'X-CSRF-TOKEN': '{{ csrf_token() }}',
                    'Accept': 'application/json'
                },
                body: JSON.stringify({
                    type: 'ticket',
                    item_id: {{ $ticket->id }}
                })
            })
            .then(response => {
                if (!response.ok) {
                    throw new Error('Network response was not ok');
                }
                return response.json();
            })
            .then(data => {
                console.log('Snap Token Response:', data);
                
                if (data.success && data.snap_token) {
                    window.snap.pay(data.snap_token, {
                        onSuccess: function(result) {
                            console.log('Payment Success:', result);
                            const orderId = result.order_id; // Ambil order_id untuk sync

                            // Sync manual ke backend (update status DB)
                            fetch('{{ route("payment.verify-status") }}', {
                                method: 'POST',
                                headers: {
                                    'Content-Type': 'application/json',
                                    'X-CSRF-TOKEN': '{{ csrf_token() }}',
                                    'Accept': 'application/json'
                                },
                                body: JSON.stringify({ order_id: orderId })
                            })
                            .then(response => response.json())
                            .then(syncData => {
                                console.log('Sync Response:', syncData);
                                if (syncData.success && syncData.status === 'success') {
                                    alert('Pembayaran berhasil! Akses event Anda telah aktif dan siap digunakan.');
                                } else {
                                    alert('Pembayaran berhasil, status event sedang diproses. Cek riwayat sebentar lagi.');
                                }
                            })
                            .catch(syncError => {
                                console.error('Sync Error:', syncError);
                                alert('Pembayaran berhasil! (Update status otomatis sebentar lagi)');
                            })
                            .finally(() => {
                                window.location.href = '{{ route("user.tickets.index") }}';
                            });
                        },
                        onPending: function(result) {
                            console.log('Payment Pending:', result);
                            alert('Pembayaran menunggu konfirmasi...');
                            window.location.href = '{{ route("user.tickets.index") }}';
                        },
                        onError: function(result) {
                            console.log('Payment Error:', result);
                            alert('Pembayaran gagal! Silakan coba lagi.');
                            payButton.disabled = false;
                            payButton.innerHTML = '<i class="fas fa-credit-card"></i> Bayar Sekarang';
                        },
                        onClose: function() {
                            console.log('Popup Closed');
                            payButton.disabled = false;
                            payButton.innerHTML = '<i class="fas fa-credit-card"></i> Bayar Sekarang';
                        }
                    });
                } else {
                    throw new Error(data.error || 'Gagal mendapatkan token pembayaran');
                }
            })
            .catch(error => {
                console.error('Checkout Error:', error);
                alert('Terjadi kesalahan: ' + error.message);
                payButton.disabled = false;
                payButton.innerHTML = '<i class="fas fa-credit-card"></i> Bayar Sekarang';
            });
        });
    });
</script>
@endpush