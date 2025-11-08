<!DOCTYPE html>
<html>

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Terima Kasih - Motivatawa</title>
    <style>
        body {
            font-family: 'Poppins', 'Arial', sans-serif;
            line-height: 1.6;
            color: #1a1a1a;
            max-width: 600px;
            margin: 0 auto;
            padding: 20px;
            background-color: #f8f8f8;
        }

        .container {
            background: white;
            border-radius: 12px;
            overflow: hidden;
            box-shadow: 0 4px 20px rgba(0, 0, 0, 0.1);
        }

        .header {
            text-align: center;
            background: linear-gradient(135deg, #ddb748 0%, #c99c2e 100%);
            padding: 50px 20px;
            color: white;
        }

        .header h1 {
            margin: 0;
            font-size: 32px;
            font-weight: 700;
        }

        .header p {
            margin: 10px 0 0 0;
            font-size: 16px;
            opacity: 0.9;
        }

        .content {
            padding: 40px 30px;
        }

        .thank-you {
            font-size: 26px;
            color: #1a1a1a;
            margin-bottom: 25px;
            text-align: center;
            font-weight: 600;
        }

        .details {
            background: #f8f8f8;
            padding: 25px;
            border-radius: 10px;
            margin: 25px 0;
            border-left: 5px solid #ddb748;
        }

        .details h3 {
            margin-top: 0;
            color: #1a1a1a;
            font-size: 18px;
            font-weight: 600;
            margin-bottom: 15px;
        }

        .motivatawa-info {
            background: rgba(221, 183, 72, 0.1);
            padding: 25px;
            border-radius: 10px;
            margin: 30px 0;
            border-left: 5px solid #ddb748;
            border: 2px solid rgba(221, 183, 72, 0.2);
        }

        .motivatawa-info h3 {
            margin-top: 0;
            color: #1a1a1a;
            font-size: 18px;
            font-weight: 600;
            margin-bottom: 15px;
        }

        .footer {
            text-align: center;
            margin-top: 40px;
            padding-top: 25px;
            border-top: 2px solid #f0f0f0;
            color: #666;
            font-size: 14px;
        }

        .button {
            display: inline-block;
            padding: 14px 35px;
            background: #ddb748;
            color: #1a1a1a;
            text-decoration: none;
            border-radius: 8px;
            margin: 15px 0;
            font-weight: 600;
            font-size: 16px;
            transition: all 0.3s ease;
            border: 2px solid #ddb748;
        }

        .button:hover {
            background: transparent;
            color: #ddb748;
        }

        .info-item {
            margin-bottom: 12px;
            display: flex;
            align-items: center;
        }

        .info-item strong {
            min-width: 150px;
            color: #1a1a1a;
        }

        .icon {
            margin-right: 10px;
            font-size: 18px;
        }

        .highlight {
            color: #ddb748;
            font-weight: 600;
        }

        .motivatawa-logo {
            font-size: 24px;
            font-weight: 700;
            color: #1a1a1a;
            margin-bottom: 10px;
        }

        .type-info {
            background: #f0f8ff;
            padding: 15px;
            border-radius: 8px;
            margin: 15px 0;
            border-left: 4px solid #4a90e2;
        }

        .type-info p {
            margin: 0;
            font-size: 14px;
            line-height: 1.5;
        }
    </style>
    <link href="https://fonts.googleapis.com/css2?family=Poppins:wght@300;400;500;600;700&display=swap"
        rel="stylesheet">
</head>

<body>
    <div class="container">
        <div class="header">
            <h1>🎉 Terima Kasih!</h1>
            <p>Platform Edutainment Indonesia</p>
        </div>

        <div class="content">
            <div class="motivatawa-logo">MOTIVATAWA</div>

            <div class="thank-you">
                Halo <strong class="highlight">{{ $userName }}</strong>,
            </div>

            <p style="font-size: 16px; line-height: 1.7; margin-bottom: 20px;">
                Terima kasih telah mempercayai <strong class="highlight">Motivatawa</strong> dan telah melakukan
                pembelian!
                Kami sangat menghargai dukungan Anda dalam perjalanan edukasi yang menyenangkan.
            </p>

            <div class="details">
                <h3>📋 Detail Pembelian</h3>
                <div class="info-item">
                    <span class="icon">🎯</span>
                    <strong>Item:</strong> {{ $itemName }}
                </div>
                <div class="info-item">
                    <span class="icon">📁</span>
                    <strong>Jenis:</strong>
                    @if($type === 'ticket')
                    🎫 Tiket Event
                    @elseif($type === 'registration')
                    🎓 Course / Kelas
                    @else
                    🎬 Video Edukasi
                    @endif
                </div>
                <div class="info-item">
                    <span class="icon">💳</span>
                    <strong>Total Pembayaran:</strong> Rp {{ number_format($amount, 0, ',', '.') }}
                </div>
                <div class="info-item">
                    <span class="icon">📅</span>
                    <strong>Tanggal Pembelian:</strong> {{ $purchaseDate }}
                </div>
                <div class="info-item">
                    <span class="icon">✅</span>
                    <strong>Status:</strong> <span style="color: #10b981; font-weight: 600;">Berhasil</span>
                </div>
            </div>

            <!-- Informasi khusus berdasarkan tipe -->
            @if($type === 'ticket')
            <div class="type-info">
                <p><strong>🎫 Informasi Tiket Event:</strong> Tiket Anda telah aktif! Silakan cek di halaman "Tiket
                    Saya" untuk detail event dan informasi akses.</p>
            </div>
            @elseif($type === 'registration')
            <div class="type-info">
                <p><strong>🎓 Informasi Course:</strong> Pendaftaran course Anda telah aktif! Anda sekarang memiliki
                    akses penuh ke materi course. Silakan cek di halaman "Registrasi Saya" untuk mulai belajar.</p>
            </div>
            @else
            <div class="type-info">
                <p><strong>🎬 Informasi Video:</strong> Video telah tersedia di library Anda! Anda dapat menontonnya
                    kapan saja melalui halaman "Video Saya".</p>
            </div>
            @endif

            <div class="motivatawa-info">
                <h3>🌟 Tentang Motivatawa</h3>
                <p style="font-size: 15px; line-height: 1.7; margin-bottom: 15px;">
                    <strong class="highlight">Motivatawa</strong> adalah platform khusus yang menyediakan layanan
                    <strong>Edutainment</strong> (Edukasi dan Entertainment).
                </p>
                <p style="font-size: 15px; line-height: 1.7; margin: 0;">
                    Perpaduan Edukasi dan Entertainment diharapkan mampu menjadi jalan yang baik untuk masyarakat
                    Indonesia
                    dalam menambah wawasan dengan cara yang menyenangkan dan inspiratif.
                </p>
            </div>

            <p style="font-size: 15px; line-height: 1.7; text-align: center; margin: 25px 0;">
                Jika Anda memiliki pertanyaan atau membutuhkan bantuan, jangan ragu untuk menghubungi tim support kami.
            </p>

            <div style="text-align: center; margin: 30px 0;">
                <a href="{{ url('/') }}" class="button">
                    🚀 Kunjungi Motivatawa
                </a>
            </div>

            <!-- Link khusus berdasarkan tipe -->
            <div style="text-align: center; margin: 20px 0;">
                @if($type === 'ticket')
                <a href="{{ url('/my/tickets') }}" style="color: #ddb748; text-decoration: none; font-size: 14px;">
                    📋 Lihat Tiket Saya
                </a>
                @elseif($type === 'registration')
                <a href="{{ url('/my/registrations') }}"
                    style="color: #ddb748; text-decoration: none; font-size: 14px;">
                    🎓 Lihat Registrasi Saya
                </a>
                @else
                <a href="{{ url('/my/purchases') }}" style="color: #ddb748; text-decoration: none; font-size: 14px;">
                    🎬 Lihat Video Saya
                </a>
                @endif
            </div>

            <div style="text-align: center; font-size: 14px; color: #666; margin-top: 20px;">
                <p>Butuh bantuan? <a href="mailto:motivatawaid@gmail.com"
                        style="color: #ddb748; text-decoration: none;">motivatawaid@gmail.com</a></p>
            </div>
        </div>

        <div class="footer">
            <p style="margin: 5px 0;">&copy; {{ date('Y') }} Motivatawa. All rights reserved.</p>
            <p style="margin: 5px 0; font-size: 13px;">Email ini dikirim secara otomatis, mohon tidak membalas email
                ini.</p>
        </div>
    </div>
</body>

</html>