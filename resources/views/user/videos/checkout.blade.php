@extends('layouts.app')

@section('title', 'Checkout Video')
@section('desc', 'Selesaikan pembayaran video premium')

@section('content')
<div class="row justify-content-center">
    <div class="col-md-8">
        <div class="card">
            <div class="card-header">
                <h4>Checkout Video Premium</h4>
            </div>
            <div class="card-body">
                <div class="alert alert-info">
                    <i class="fas fa-info-circle"></i> Selesaikan pembayaran untuk mendapatkan akses video ini.
                </div>

                <div class="row">
                    <div class="col-12">
                        <h5>{{ $video->title }}</h5>
                        <p class="text-muted">{{ $video->talent->name }}</p>
                        <p>{{ $video->description }}</p>
                    </div>
                </div>

                <hr>

                <div class="row">
                    <div class="col-md-6">
                        <h6>Detail Pembayaran</h6>
                        <table class="table">
                            <tr>
                                <td>Harga Video</td>
                                <td class="text-right">Rp {{ number_format($video->price, 0, ',', '.') }}</td>
                            </tr>
                            <tr class="font-weight-bold">
                                <td>Total</td>
                                <td class="text-right">Rp {{ number_format($video->price, 0, ',', '.') }}</td>
                            </tr>
                        </table>
                    </div>
                </div>

                <div class="mt-4">
                    <button type="button" class="btn btn-primary btn-lg btn-block" id="pay-button">
                        <i class="fas fa-credit-card"></i> Bayar Sekarang
                    </button>
                    <a href="{{ route('user.videos.index') }}" class="btn btn-secondary btn-block">
                        <i class="fas fa-arrow-left"></i> Kembali
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
                    type: 'video',
                    item_id: {{ $purchase->id }}
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
                                    alert('Pembayaran berhasil! Akses video Anda telah aktif.');
                                } else {
                                    alert('Pembayaran berhasil, status video sedang diproses. Cek riwayat sebentar lagi.');
                                }
                            })
                            .catch(syncError => {
                                console.error('Sync Error:', syncError);
                                alert('Pembayaran berhasil! (Update status otomatis sebentar lagi)');
                            })
                            .finally(() => {
                                window.location.href = '{{ route("user.purchases.index") }}';
                            });
                        },
                        onPending: function(result) {
                            console.log('Payment Pending:', result);
                            alert('Pembayaran menunggu konfirmasi...');
                            window.location.href = '{{ route("user.purchases.index") }}';
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