<!DOCTYPE html>
<html lang="id">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">

    <!-- SEO Meta Tags -->
    <title>Motivatawa - Platform Edutainment Indonesia | Belajar Santai, Hasil Serius</title>
    <meta name="description"
        content="Platform edutainment pertama di Indonesia yang menggabungkan edukasi dan entertainment. Belajar public speaking, digital marketing, dan pengembangan diri dengan metode menyenangkan.">
    <meta name="keywords"
        content="edutainment, edukasi, hiburan, motivasi, public speaking, digital marketing, pengembangan diri, workshop, seminar, kelas online, belajar santai">
    <meta name="author" content="Motivatawa.id">
    <meta name="robots" content="index, follow">
    <link rel="canonical" href="https://motivatawa.id" />

    <!-- Open Graph Meta Tags -->
    <meta property="og:type" content="website" />
    <meta property="og:title" content="Motivatawa - Platform Edutainment Indonesia | Belajar Santai, Hasil Serius" />
    <meta property="og:description"
        content="Platform edutainment pertama di Indonesia yang menggabungkan edukasi dan entertainment. Belajar dengan metode menyenangkan untuk hasil yang serius." />
    <meta property="og:image" content="{{ asset('assets/img/hero.png') }}" />
    <meta property="og:url" content="https://motivatawa.id" />
    <meta property="og:site_name" content="Motivatawa.id" />
    <meta property="og:locale" content="id_ID" />

    <!-- Twitter Card Meta Tags -->
    <meta name="twitter:card" content="summary_large_image" />
    <meta name="twitter:title" content="Motivatawa - Platform Edutainment Indonesia | Belajar Santai, Hasil Serius" />
    <meta name="twitter:description"
        content="Platform edutainment pertama di Indonesia yang menggabungkan edukasi dan entertainment. Belajar dengan metode menyenangkan untuk hasil yang serius." />
    <meta name="twitter:image" content="{{ asset('assets/img/hero.png') }}" />
    <meta name="twitter:site" content="@motivatawa" />

    <!-- Additional Meta Tags -->
    <meta name="theme-color" content="#ddb748">
    <meta name="msapplication-TileColor" content="#ddb748">

    <!-- Favicon -->
    <link rel="apple-touch-icon" sizes="180x180" href="{{ asset('assets/img/favicon/apple-touch-icon.png') }}">
    <link rel="icon" type="image/png" sizes="32x32" href="{{ asset('assets/img/favicon/favicon-32x32.png') }}">
    <link rel="icon" type="image/png" sizes="16x16" href="{{ asset('assets/img/favicon/favicon-16x16.png') }}">
    <link rel="manifest" href="{{ asset('assets/img/favicon/site.webmanifest') }}">

    <script src="https://cdn.tailwindcss.com"></script>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css">
    <link href="https://fonts.googleapis.com/css2?family=Poppins:wght@300;400;500;600;700&display=swap"
        rel="stylesheet">
    <script>
        tailwind.config = {
            theme: {
                extend: {
                    colors: {
                        primary: '#ddb748',
                        dark: '#1a1a1a',
                        light: '#f8f8f8',
                    },
                    fontFamily: {
                        poppins: ['Poppins', 'sans-serif'],
                    },
                },
            }
        }
    </script>
    <style type="text/tailwindcss">
        @layer utilities {
            .text-primary { color: #ddb748; }
            .bg-primary { background-color: #ddb748; }
            .border-primary { border-color: #ddb748; }
            .hover\:bg-primary:hover { background-color: #ddb748; }
            .hover\:text-primary:hover { color: #ddb748; }
        }
    </style>

    <!-- CSRF Token -->
    <meta name="csrf-token" content="{{ csrf_token() }}">
</head>

<body class="font-poppins text-gray-800 bg-white">
    <!-- Header & Navigation -->
    <header class="bg-white shadow-md fixed w-full top-0 z-50">
        <nav class="container mx-auto px-4 py-4">
            <div class="flex justify-between items-center">
                <div class="flex items-center font-bold text-xl text-dark">
                    <img src="{{ asset('assets/img/icon.png') }}" alt="Motivatawa Logo" class="mr-3 rounded-md"
                        width="50" height="50">
                    <span>Motivatawa</span>
                </div>
                <div class="flex items-center space-x-8">
                    <ul class="hidden md:flex space-x-8">

                        <li><a href="{{ url('/') }}"
                                class="font-medium hover:text-primary transition-colors">Beranda</a></li>
                        <li><a href="{{ url('/all-event') }}"
                                class="font-medium hover:text-primary transition-colors">Event</a></li>
                        <li><a href="{{ url('/all-video') }}"
                                class="font-medium hover:text-primary transition-colors">Video</a></li>
                        <li><a href="{{ url('/') }}#features"
                                class="font-medium hover:text-primary transition-colors">Fitur</a></li>
                        <li><a href="{{ url('/') }}#contact"
                                class="font-medium hover:text-primary transition-colors">Kontak</a></li>
                    </ul>
                    @guest
                    <a href="{{ url('/login') }}"
                        class="bg-primary text-white px-5 py-2 rounded-md font-medium hover:bg-yellow-600 transition-all transform hover:-translate-y-0.5">Login</a>
                    @else
                    <a href="{{ url('/dashboard') }}"
                        class="bg-primary text-white px-5 py-2 rounded-md font-medium hover:bg-yellow-600 transition-all transform hover:-translate-y-0.5">Dashboard</a>
                    @endguest
                </div>
            </div>
        </nav>
    </header>

    <!-- Hero Section -->
    <section id="home" class="pt-32 pb-20 bg-primary">
        <div class="container mx-auto px-4">
            <div class="flex flex-col lg:flex-row items-center gap-12">
                <div class="lg:w-1/2">
                    <!-- Headline -->
                    <h1 class="text-4xl lg:text-5xl font-bold text-white leading-tight mb-4">
                        Platform Edutainment Pertama di Indonesia
                    </h1>

                    <!-- Subheadline -->
                    <p class="text-white text-lg mb-8">
                        Gabungan sempurna antara <strong>Edukasi</strong> dan <strong>Entertainment</strong> untuk
                        pengalaman belajar yang menyenangkan. Belajar santai dengan metode interaktif, namun dengan
                        hasil yang serius untuk pengembangan diri Anda.
                    </p>

                    <div class="flex flex-wrap gap-4">
                        <a href="#events"
                            class="bg-white text-primary px-6 py-3 rounded-md font-medium hover:bg-gray-100 transition-all transform hover:-translate-y-0.5">
                            Jelajahi Event
                        </a>
                        <a href="#videos"
                            class="bg-transparent text-white border-2 border-white px-6 py-3 rounded-md font-medium hover:bg-white hover:text-primary transition-all">
                            Jelajahi Video
                        </a>
                    </div>
                </div>
                <div class="lg:w-1/2">
                    <img src="{{ asset('assets/img/hero.png') }}"
                        alt="Platform Edutainment Motivatawa - Belajar Santai Hasil Serius"
                        class="rounded-xl shadow-2xl w-full">
                </div>
            </div>
        </div>
    </section>

    <!-- Events Section -->
    <section id="events" class="py-20 bg-light">
        <div class="container mx-auto px-4">
            <div class="text-center mb-16">
                <h2 class="text-3xl lg:text-4xl font-bold text-dark mb-4">Event Terbaru</h2>
                <p class="text-gray-600 max-w-2xl mx-auto text-lg">Temukan event yang sesuai dengan minat Anda</p>
            </div>
            <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-8">
                @forelse ($upcomingEvents as $event)
                <div
                    class="bg-white rounded-xl shadow-lg overflow-hidden transition-all transform hover:-translate-y-2 hover:shadow-xl">
                    <img src="{{ $event->thumbnail ? asset('storage/' . $event->thumbnail) : asset('assets/img/hero.png') }}"
                        alt="{{ $event->title }}" class="w-full h-48 object-cover"
                        onerror="this.src='{{ asset('assets/img/hero.png') }}'">
                    <div class="p-6">
                        <div class="flex items-center mb-2">
                            <span
                                class="inline-block px-3 py-1 text-xs font-semibold rounded-full 
                            {{ $event->type === 'online' ? 'bg-blue-100 text-blue-800' : 'bg-green-100 text-green-800' }}">
                                {{ $event->type === 'online' ? 'Online' : 'Offline' }}
                            </span>
                            @if($event->remaining_quota <= 0) <span
                                class="inline-block px-3 py-1 text-xs font-semibold bg-red-100 text-red-800 rounded-full ml-2">
                                Habis
                                </span>
                                @elseif($event->remaining_quota <= 10) <span
                                    class="inline-block px-3 py-1 text-xs font-semibold bg-orange-100 text-orange-800 rounded-full ml-2">
                                    Hampir Habis
                                    </span>
                                    @endif
                        </div>
                        <h3 class="text-xl font-bold text-dark mb-2">{{ $event->title }}</h3>
                        <p class="text-gray-600 mb-4">Oleh: <span class="font-medium">{{ $event->talent->name }}</span>
                        </p>

                        <div class="flex items-center text-gray-500 text-sm mb-3">
                            <i class="fas fa-calendar-alt mr-2"></i>
                            <span>{{ $event->start_date->format('d M Y, H:i') }}</span>
                        </div>

                        @if($event->type === 'offline' && $event->location)
                        <div class="flex items-center text-gray-500 text-sm mb-3">
                            <i class="fas fa-map-marker-alt mr-2"></i>
                            <span>{{ $event->location }}</span>
                        </div>
                        @endif

                        <div class="flex justify-between items-center mb-4">
                            <span class="text-primary font-bold text-lg">{{ $event->price_formatted }}</span>
                            <span class="text-sm text-gray-500">
                                @if($event->remaining_quota <= 0) <span class="text-red-500">Kuota Habis</span>
                            @else
                            {{ $event->remaining_quota }} dari {{ $event->quota }} tersisa
                            @endif
                            </span>
                        </div>

                        <div class="flex gap-2">
                            <button onclick="openEventModal({{ $event->id }})"
                                class="flex-1 bg-primary text-white px-4 py-2 rounded-md font-medium hover:bg-yellow-600 transition-colors">Detail</button>
                            @guest
                            <button onclick="showLoginRequired()"
                                class="flex-1 bg-black text-white px-4 py-2 rounded-md font-medium hover:bg-gray-600 transition-colors">Beli</button>
                            @else
                            @if(isset($event->is_purchased) && $event->is_purchased)
                            <a href="{{ route('user.tickets.show', $event->ticket_id) }}"
                                class="flex-1 bg-green-600 text-white px-4 py-2 rounded-md font-medium hover:bg-green-700 transition-colors text-center">Lihat
                                Tiket</a>
                            @elseif($event->remaining_quota <= 0) <button disabled
                                class="flex-1 bg-gray-400 text-white px-4 py-2 rounded-md font-medium cursor-not-allowed">
                                Kuota Habis</button>
                                @else
                                <button onclick="buyEvent({{ $event->id }})"
                                    class="flex-1 bg-dark text-white px-4 py-2 rounded-md font-medium hover:bg-gray-800 transition-colors">Beli</button>
                                @endif
                                @endguest
                        </div>
                    </div>
                </div>
                @empty
                <div class="col-span-full text-center py-12">
                    <div class="text-gray-400 text-6xl mb-4">
                        <i class="fas fa-calendar-times"></i>
                    </div>
                    <h3 class="text-xl font-bold text-gray-600 mb-2">Belum ada event</h3>
                    <p class="text-gray-500">Saat ini belum ada event yang tersedia.</p>
                </div>
                @endforelse
            </div>
            <div class="text-center mt-12">
                <a href="{{ url('/all-event') }}"
                    class="bg-primary text-white px-6 py-3 rounded-md font-medium hover:bg-yellow-600 transition-colors">Lihat
                    Semua Event</a>
            </div>
        </div>
    </section>

    <!-- Videos Section -->
    <section id="videos" class="py-20 bg-white">
        <div class="container mx-auto px-4">
            <div class="text-center mb-16">
                <h2 class="text-3xl lg:text-4xl font-bold text-dark mb-4">Video Pembelajaran</h2>
                <p class="text-gray-600 max-w-2xl mx-auto text-lg">Akses pengetahuan dari para ahli kapan saja</p>
            </div>
            <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-8">
                @forelse ($latestVideos as $video)
                <div
                    class="bg-white rounded-xl shadow-lg overflow-hidden transition-all transform hover:-translate-y-2 hover:shadow-xl">
                    <div class="relative">
                        <img src="{{ $video->thumbnail ? asset('storage/' . $video->thumbnail) : asset('assets/img/hero.png') }}"
                            alt="{{ $video->title }}" class="w-full h-48 object-cover"
                            onerror="this.src='{{ asset('assets/img/hero.png') }}'">
                        <div class="absolute top-4 right-4">
                            <span
                                class="inline-block px-3 py-1 text-xs font-semibold bg-red-100 text-red-800 rounded-full">
                                <i class="fas fa-play mr-1"></i>Video
                            </span>
                        </div>
                    </div>
                    <div class="p-6">
                        <h3 class="text-xl font-bold text-dark mb-2">{{ $video->title }}</h3>
                        <p class="text-gray-600 mb-4">Oleh: <span class="font-medium">{{ $video->talent->name }}</span>
                        </p>

                        <div class="flex justify-between items-center mb-4">
                            <span class="text-primary font-bold text-lg">{{ $video->price_formatted }}</span>
                            <span class="text-sm text-gray-500">Akses Selamanya</span>
                        </div>

                        <div class="flex gap-2">
                            <button onclick="openVideoModal({{ $video->id }})"
                                class="flex-1 bg-primary text-white px-4 py-2 rounded-md font-medium hover:bg-yellow-600 transition-colors">Detail</button>
                            @guest
                            <button onclick="showLoginRequired()"
                                class="flex-1 bg-black text-white px-4 py-2 rounded-md font-medium hover:bg-gray-600 transition-colors">Beli</button>
                            @else
                            @if(isset($video->is_purchased) && $video->is_purchased)
                            <a href="{{ route('user.purchases.show', $video->purchase_id) }}"
                                class="flex-1 bg-green-600 text-white px-4 py-2 rounded-md font-medium hover:bg-green-700 transition-colors text-center">Tonton
                                Video</a>
                            @else
                            <button onclick="buyVideo({{ $video->id }})"
                                class="flex-1 bg-dark text-white px-4 py-2 rounded-md font-medium hover:bg-gray-800 transition-colors">Beli</button>
                            @endif
                            @endguest
                        </div>
                    </div>
                </div>
                @empty
                <div class="col-span-full text-center py-12">
                    <div class="text-gray-400 text-6xl mb-4">
                        <i class="fas fa-video-slash"></i>
                    </div>
                    <h3 class="text-xl font-bold text-gray-600 mb-2">Belum ada video</h3>
                    <p class="text-gray-500">Saat ini belum ada video pembelajaran yang tersedia.</p>
                </div>
                @endforelse
            </div>
            <div class="text-center mt-12">
                <a href="{{ url('/all-video') }}"
                    class="bg-primary text-white px-6 py-3 rounded-md font-medium hover:bg-yellow-600 transition-colors">Lihat
                    Semua Video</a>
            </div>
        </div>
    </section>

    <!-- Features Section -->
    <section id="features" class="py-20 bg-light">
        <div class="container mx-auto px-4">
            <div class="text-center mb-16">
                <h2 class="text-3xl lg:text-4xl font-bold text-dark mb-4">Keuntungan Menggunakan Motivatawa</h2>
                <p class="text-gray-600 max-w-2xl mx-auto text-lg">Nikmati berbagai kemudahan dalam mengakses event dan
                    video pembelajaran</p>
            </div>
            <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-8">
                <div
                    class="bg-white rounded-xl shadow-lg p-8 border-t-4 border-primary transition-all transform hover:-translate-y-2 hover:shadow-xl">
                    <div class="text-primary text-4xl mb-6">
                        <i class="fas fa-ticket-alt"></i>
                    </div>
                    <h3 class="text-xl font-bold text-dark mb-4">Pembelian Tiket Mudah</h3>
                    <p class="text-gray-600">Beli tiket event favorit Anda dengan mudah melalui platform. Berbagai
                        metode pembayaran aman dan terintegrasi tersedia untuk kenyamanan Anda.</p>
                </div>
                <div
                    class="bg-white rounded-xl shadow-lg p-8 border-t-4 border-primary transition-all transform hover:-translate-y-2 hover:shadow-xl">
                    <div class="text-primary text-4xl mb-6">
                        <i class="fas fa-video"></i>
                    </div>
                    <h3 class="text-xl font-bold text-dark mb-4">Video Pembelajaran Premium</h3>
                    <p class="text-gray-600">Akses ribuan video pembelajaran berkualitas dari para ahli. Tonton kapan
                        saja dan di mana saja sesuai dengan kebutuhan belajar Anda.</p>
                </div>
                <div
                    class="bg-white rounded-xl shadow-lg p-8 border-t-4 border-primary transition-all transform hover:-translate-y-2 hover:shadow-xl">
                    <div class="text-primary text-4xl mb-6">
                        <i class="fas fa-history"></i>
                    </div>
                    <h3 class="text-xl font-bold text-dark mb-4">Riwayat Pembelian</h3>
                    <p class="text-gray-600">Lihat semua riwayat pembelian tiket dan video Anda di satu tempat. Mudah
                        dikelola dan diakses kapan saja Anda butuhkan.</p>
                </div>
            </div>
        </div>
    </section>

    <!-- How It Works Section -->
    <section id="how-it-works" class="py-20 bg-white">
        <div class="container mx-auto px-4">
            <div class="text-center mb-16">
                <h2 class="text-3xl lg:text-4xl font-bold text-dark mb-4">Cara Menggunakan Motivatawa</h2>
                <p class="text-gray-600 max-w-2xl mx-auto text-lg">Langkah mudah untuk mulai belajar dan mengikuti event
                </p>
            </div>
            <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-4 gap-8">
                <div class="text-center">
                    <div
                        class="bg-primary text-white w-16 h-16 rounded-full flex items-center justify-center text-2xl font-bold mx-auto mb-6">
                        1</div>
                    <h3 class="text-xl font-bold text-dark mb-4">Daftar Akun</h3>
                    <p class="text-gray-600">Buat akun dengan mudah untuk mulai menjelajahi berbagai event dan video
                        pembelajaran yang tersedia.</p>
                </div>
                <div class="text-center">
                    <div
                        class="bg-primary text-white w-16 h-16 rounded-full flex items-center justify-center text-2xl font-bold mx-auto mb-6">
                        2</div>
                    <h3 class="text-xl font-bold text-dark mb-4">Jelajahi Konten</h3>
                    <p class="text-gray-600">Temukan event atau video pembelajaran yang sesuai dengan minat dan
                        kebutuhan Anda.</p>
                </div>
                <div class="text-center">
                    <div
                        class="bg-primary text-white w-16 h-16 rounded-full flex items-center justify-center text-2xl font-bold mx-auto mb-6">
                        3</div>
                    <h3 class="text-xl font-bold text-dark mb-4">Beli Tiket/Video</h3>
                    <p class="text-gray-600">Lakukan pembelian dengan mudah menggunakan berbagai metode pembayaran yang
                        aman.</p>
                </div>
                <div class="text-center">
                    <div
                        class="bg-primary text-white w-16 h-16 rounded-full flex items-center justify-center text-2xl font-bold mx-auto mb-6">
                        4</div>
                    <h3 class="text-xl font-bold text-dark mb-4">Nikmati Konten</h3>
                    <p class="text-gray-600">Ikuti event yang Anda pilih atau tonton video pembelajaran kapan saja dan
                        di mana saja.</p>
                </div>
            </div>
        </div>
    </section>

    <!-- CTA Section -->
    <section class="py-20 bg-gradient-to-r from-primary to-yellow-600 text-white">
        <div class="container mx-auto px-4 text-center">
            <h2 class="text-3xl lg:text-4xl font-bold mb-6">Siap Memulai Perjalanan Belajar Anda?</h2>
            <p class="text-xl max-w-2xl mx-auto mb-8 opacity-90">Bergabunglah dengan ribuan pengguna yang telah
                mengembangkan pengetahuan dan keterampilan melalui Motivatawa.id</p>
            @guest
            <a href="{{ url('/register') }}"
                class="bg-white text-primary px-8 py-3 rounded-md font-bold text-lg hover:bg-gray-100 transition-all transform hover:-translate-y-1 inline-block">Daftar
                Sekarang</a>
            @else
            <a href="{{ url('/dashboard') }}"
                class="bg-white text-primary px-8 py-3 rounded-md font-bold text-lg hover:bg-gray-100 transition-all transform hover:-translate-y-1 inline-block">Ke
                Dashboard</a>
            @endguest
        </div>
    </section>

    @include('footer')

    <!-- Event Modal -->
    <div id="eventModal" class="fixed inset-0 bg-black bg-opacity-50 flex items-center justify-center z-50 hidden">
        <div class="bg-white rounded-xl max-w-2xl w-full max-h-[90vh] overflow-y-auto">
            <div class="p-6">
                <div class="flex justify-between items-start mb-4">
                    <h3 class="text-2xl font-bold text-dark" id="eventModalTitle">Event Title</h3>
                    <button onclick="closeEventModal()" class="text-gray-500 hover:text-gray-700">
                        <i class="fas fa-times text-xl"></i>
                    </button>
                </div>
                <img id="eventModalImage" src="{{ asset('assets/img/hero.png') }}" alt="Event Image"
                    class="w-full h-64 object-cover rounded-lg mb-4"
                    onerror="this.src='{{ asset('assets/img/hero.png') }}'">
                <div class="mb-4">
                    <p class="text-gray-600 mb-2"><span class="font-medium">Penyelenggara:</span> <span
                            id="eventModalTalent">Talent Name</span></p>
                    <p class="text-gray-600 mb-2"><span class="font-medium">Tanggal:</span> <span
                            id="eventModalDate">Date</span></p>
                    <p class="text-gray-600 mb-2"><span class="font-medium">Lokasi:</span> <span
                            id="eventModalLocation">Location</span></p>
                    <p class="text-gray-600 mb-2"><span class="font-medium">Kuota:</span> <span
                            id="eventModalQuota">Quota</span> (<span id="eventModalRemainingQuota">Remaining</span>
                        tersisa)</p>
                    <p class="text-gray-600 mb-4"><span class="font-medium">Harga:</span> <span id="eventModalPrice"
                            class="text-primary font-bold">Price</span></p>
                </div>
                <div class="mb-6">
                    <h4 class="font-bold text-dark mb-2">Deskripsi</h4>
                    <p id="eventModalDescription" class="text-gray-600">Event description goes here...</p>
                </div>
                <div class="flex gap-3">
                    @guest
                    <a href="{{ url('/login') }}"
                        class="flex-1 bg-primary text-white px-4 py-3 rounded-md font-medium hover:bg-yellow-600 transition-colors text-center">Login
                        untuk Membeli</a>
                    @else
                    <div id="eventModalActionContainer">
                        <!-- Tombol akan di-generate oleh JavaScript -->
                    </div>
                    @endguest
                </div>
            </div>
        </div>
    </div>

    <!-- Video Modal -->
    <div id="videoModal" class="fixed inset-0 bg-black bg-opacity-50 flex items-center justify-center z-50 hidden">
        <div class="bg-white rounded-xl max-w-2xl w-full max-h-[90vh] overflow-y-auto">
            <div class="p-6">
                <div class="flex justify-between items-start mb-4">
                    <h3 class="text-2xl font-bold text-dark" id="videoModalTitle">Video Title</h3>
                    <button onclick="closeVideoModal()" class="text-gray-500 hover:text-gray-700">
                        <i class="fas fa-times text-xl"></i>
                    </button>
                </div>
                <img id="videoModalImage" src="{{ asset('assets/img/hero.png') }}" alt="Video Thumbnail"
                    class="w-full h-64 object-cover rounded-lg mb-4"
                    onerror="this.src='{{ asset('assets/img/hero.png') }}'">
                <div class="mb-4">
                    <p class="text-gray-600 mb-2"><span class="font-medium">Penyelenggara:</span> <span
                            id="videoModalTalent">Talent Name</span></p>
                    <p class="text-gray-600 mb-4"><span class="font-medium">Harga:</span> <span id="videoModalPrice"
                            class="text-primary font-bold">Price</span></p>
                </div>
                <div class="mb-6">
                    <h4 class="font-bold text-dark mb-2">Deskripsi</h4>
                    <p id="videoModalDescription" class="text-gray-600">Video description goes here...</p>
                </div>
                <div class="flex gap-3">
                    @guest
                    <a href="{{ url('/login') }}"
                        class="flex-1 bg-primary text-white px-4 py-3 rounded-md font-medium hover:bg-yellow-600 transition-colors text-center">Login
                        untuk Membeli</a>
                    @else
                    <div id="videoModalActionContainer">
                        <!-- Tombol akan di-generate oleh JavaScript -->
                    </div>
                    @endguest
                </div>
            </div>
        </div>
    </div>

    <!-- Loading Spinner -->
    <div id="loadingSpinner" class="fixed inset-0 bg-black bg-opacity-50 flex items-center justify-center z-50 hidden">
        <div class="bg-white rounded-lg p-6 flex flex-col items-center">
            <div class="animate-spin rounded-full h-12 w-12 border-t-2 border-b-2 border-primary mb-4"></div>
            <p class="text-gray-700">Memproses pembelian...</p>
        </div>
    </div>

    <!-- Notification Toast -->
    <div id="notificationToast"
        class="fixed bottom-4 right-4 bg-white rounded-lg shadow-lg p-4 flex items-center hidden z-50">
        <div id="notificationIcon" class="mr-3 text-xl"></div>
        <div>
            <p id="notificationTitle" class="font-bold"></p>
            <p id="notificationMessage" class="text-sm text-gray-600"></p>
        </div>
        <button onclick="hideNotification()" class="ml-4 text-gray-400 hover:text-gray-600">
            <i class="fas fa-times"></i>
        </button>
    </div>

    <!-- Structured Data (JSON-LD) -->
    <script type="application/ld+json">
        {
            "@context": "https://schema.org",
            "@type": "Organization",
            "name": "Motivatawa.id",
            "url": "https://motivatawa.id",
            "logo": "{{ asset('assets/img/icon.png') }}",
            "description": "Motivasi untuk Inspirasi dan Tawa Adalah Senjata - Hidup kadang serius banget, sampai lupa ketawa. Di sini, kamu nggak cuma dapat motivasi, tapi juga alasan buat senyum lagi",
            "address": {
                "@type": "PostalAddress",
                "addressLocality": "Jawa Barat",
                "addressCountry": "Indonesia"
            },
            "contactPoint": {
                "@type": "ContactPoint",
                "telephone": "+62 859-6035-8633",
                "contactType": "customer service",
                "email": "info@motivatawa.id"
            },
            "sameAs": [
                "https://www.facebook.com/motivatawa",
                "https://www.twitter.com/motivatawa",
                "https://www.instagram.com/motivatawa",
                "https://www.linkedin.com/company/motivatawa"
            ]
        }
    </script>

    <!-- Midtrans Snap -->
    <script src="https://app.sandbox.midtrans.com/snap/snap.js" data-client-key="{{ config('midtrans.client_key') }}">
    </script>

    <script>
        // Smooth scrolling for navigation links
        document.querySelectorAll('a[href^="#"]').forEach(anchor => {
            anchor.addEventListener('click', function (e) {
                e.preventDefault();
                
                document.querySelector(this.getAttribute('href')).scrollIntoView({
                    behavior: 'smooth'
                });
            });
        });

        // Add active class to navigation links on scroll
        window.addEventListener('scroll', () => {
            let current = '';
            const sections = document.querySelectorAll('section');
            
            sections.forEach(section => {
                const sectionTop = section.offsetTop;
                const sectionHeight = section.clientHeight;
                if (scrollY >= (sectionTop - 200)) {
                    current = section.getAttribute('id');
                }
            });
            
            document.querySelectorAll('nav a').forEach(link => {
                link.classList.remove('active');
                if (link.getAttribute('href').slice(1) === current) {
                    link.classList.add('active');
                }
            });
        });

        // Fungsi untuk memformat harga
        function formatPrice(price) {
            if (typeof price !== 'number') {
                price = parseFloat(price);
                if (isNaN(price)) {
                    return 'Rp 0';
                }
            }
            return 'Rp ' + price.toFixed(0).replace(/\B(?=(\d{3})+(?!\d))/g, ".");
        }

        // Data events dan videos dari Laravel
        const eventsData = @json($upcomingEvents ?? []);
        const videosData = @json($latestVideos ?? []);

        // Event Modal Functions
        function openEventModal(eventId) {
            const event = eventsData.find(e => e.id === eventId);
            
            if (!event) {
                showNotification('error', 'Error', 'Event tidak ditemukan');
                return;
            }
            
            document.getElementById('eventModalTitle').textContent = event.title || 'Tidak tersedia';
            document.getElementById('eventModalTalent').textContent = event.talent ? event.talent.name : 'Tidak tersedia';
            
            if (event.start_date) {
                const eventDate = new Date(event.start_date);
                document.getElementById('eventModalDate').textContent = eventDate.toLocaleString('id-ID', { 
                    weekday: 'long', 
                    year: 'numeric', 
                    month: 'long', 
                    day: 'numeric',
                    hour: '2-digit',
                    minute: '2-digit'
                });
            } else {
                document.getElementById('eventModalDate').textContent = 'Tidak tersedia';
            }
            
            document.getElementById('eventModalLocation').textContent = event.location || 'Tidak tersedia';
            document.getElementById('eventModalQuota').textContent = `${event.quota || 0} Peserta`;
            document.getElementById('eventModalRemainingQuota').textContent = `${event.remaining_quota || 0}`;
            document.getElementById('eventModalPrice').textContent = event.price_formatted || formatPrice(event.price);
            document.getElementById('eventModalDescription').textContent = event.description || 'Tidak ada deskripsi';
            
            const eventImage = document.getElementById('eventModalImage');
            if (event.thumbnail) {
                eventImage.src = `/storage/${event.thumbnail}`;
            } else {
                eventImage.src = '{{ asset('assets/img/hero.png') }}';
            }
            
            const actionContainer = document.getElementById('eventModalActionContainer');
            if (actionContainer) {
                actionContainer.innerHTML = '';
                
                if (event.is_purchased) {
                    const viewTicketBtn = document.createElement('a');
                    viewTicketBtn.href = `/user/tickets/${event.ticket_id}`;
                    viewTicketBtn.className = 'flex-1 bg-green-600 text-white px-4 py-3 rounded-md font-medium hover:bg-green-700 transition-colors text-center';
                    viewTicketBtn.textContent = 'Lihat Tiket';
                    actionContainer.appendChild(viewTicketBtn);
                } else if (event.remaining_quota <= 0) {
                    const soldOutBtn = document.createElement('button');
                    soldOutBtn.className = 'flex-1 bg-gray-400 text-white px-4 py-3 rounded-md font-medium cursor-not-allowed';
                    soldOutBtn.textContent = 'Kuota Habis';
                    soldOutBtn.disabled = true;
                    actionContainer.appendChild(soldOutBtn);
                } else {
                    const buyBtn = document.createElement('button');
                    buyBtn.className = 'flex-1 bg-primary text-white px-4 py-3 rounded-md font-medium hover:bg-yellow-600 transition-colors';
                    buyBtn.textContent = 'Beli Tiket';
                    buyBtn.setAttribute('onclick', `buyEvent(${eventId})`);
                    actionContainer.appendChild(buyBtn);
                }
            }
            
            document.getElementById('eventModal').classList.remove('hidden');
        }

        function closeEventModal() {
            document.getElementById('eventModal').classList.add('hidden');
        }

        // Video Modal Functions
        function openVideoModal(videoId) {
            const video = videosData.find(v => v.id === videoId);
            
            if (!video) {
                showNotification('error', 'Error', 'Video tidak ditemukan');
                return;
            }
            
            document.getElementById('videoModalTitle').textContent = video.title || 'Tidak tersedia';
            document.getElementById('videoModalTalent').textContent = video.talent ? video.talent.name : 'Tidak tersedia';
            document.getElementById('videoModalPrice').textContent = video.price_formatted || formatPrice(video.price);
            document.getElementById('videoModalDescription').textContent = video.description || 'Tidak ada deskripsi';
            
            const videoImage = document.getElementById('videoModalImage');
            if (video.thumbnail) {
                videoImage.src = `/storage/${video.thumbnail}`;
            } else {
                videoImage.src = '{{ asset('assets/img/hero.png') }}';
            }
            
            const actionContainer = document.getElementById('videoModalActionContainer');
            if (actionContainer) {
                actionContainer.innerHTML = '';
                
                if (video.is_purchased) {
                    const watchVideoBtn = document.createElement('a');
                    watchVideoBtn.href = `/user/purchases/${video.purchase_id}`;
                    watchVideoBtn.className = 'flex-1 bg-green-600 text-white px-4 py-3 rounded-md font-medium hover:bg-green-700 transition-colors text-center';
                    watchVideoBtn.textContent = 'Tonton Video';
                    actionContainer.appendChild(watchVideoBtn);
                } else {
                    const buyBtn = document.createElement('button');
                    buyBtn.className = 'flex-1 bg-primary text-white px-4 py-3 rounded-md font-medium hover:bg-yellow-600 transition-colors';
                    buyBtn.textContent = 'Beli Video';
                    buyBtn.setAttribute('onclick', `buyVideo(${videoId})`);
                    actionContainer.appendChild(buyBtn);
                }
            }
            
            document.getElementById('videoModal').classList.remove('hidden');
        }

        function closeVideoModal() {
            document.getElementById('videoModal').classList.add('hidden');
        }

        // Close modals when clicking outside
        window.onclick = function(event) {
            const eventModal = document.getElementById('eventModal');
            const videoModal = document.getElementById('videoModal');
            
            if (event.target == eventModal) {
                eventModal.classList.add('hidden');
            }
            if (event.target == videoModal) {
                videoModal.classList.add('hidden');
            }
        }

        // Buy Event Function - Two Step Process
        async function buyEvent(eventId) {
            // Cek kuota terlebih dahulu
            const event = eventsData.find(e => e.id === eventId);
            if (event && event.remaining_quota <= 0) {
                showNotification('error', 'Kuota Habis', 'Maaf, kuota untuk event ini sudah habis.');
                return;
            }

            // Show loading spinner
            document.getElementById('loadingSpinner').classList.remove('hidden');
            
            // Get CSRF token
            const csrfToken = document.querySelector('meta[name="csrf-token"]').getAttribute('content');
            
            try {
                // Step 1: Create ticket first
                const createTicketResponse = await fetch(`/event/${eventId}/create-ticket`, {
                    method: 'POST',
                    headers: {
                        'X-CSRF-TOKEN': csrfToken,
                        'Content-Type': 'application/json',
                        'Accept': 'application/json'
                    }
                });

                const ticketData = await createTicketResponse.json();

                if (!ticketData.success) {
                    throw new Error(ticketData.error || 'Gagal membuat ticket');
                }

                // Step 2: Proceed to payment with ticket_id
                const paymentResponse = await fetch('{{ route("payment.snap-token") }}', {
                    method: 'POST',
                    headers: {
                        'X-CSRF-TOKEN': csrfToken,
                        'Content-Type': 'application/json',
                        'Accept': 'application/json'
                    },
                    body: JSON.stringify({
                        type: 'ticket',
                        item_id: ticketData.ticket_id
                    })
                });

                const paymentData = await paymentResponse.json();
                document.getElementById('loadingSpinner').classList.add('hidden');
                
                if (paymentData.success && paymentData.snap_token) {
                    // Open Midtrans Snap popup
                    snap.pay(paymentData.snap_token, {
                        onSuccess: function(result) {
                            console.log('Payment Success:', result);
                            handlePaymentSuccess(result.order_id, csrfToken, 'event');
                        },
                        onPending: function(result) {
                            console.log('Payment Pending:', result);
                            showNotification('info', 'Pembayaran Pending', 'Silakan lanjutkan pembayaran Anda');
                            setTimeout(() => {
                                window.location.href = '{{ route("user.tickets.index") }}';
                            }, 2000);
                        },
                        onError: function(result) {
                            console.log('Payment Error:', result);
                            showNotification('error', 'Pembayaran Gagal', 'Silakan coba lagi');
                        },
                        onClose: function() {
                            console.log('Popup Closed');
                            showNotification('info', 'Pembayaran Dibatalkan', 'Anda telah membatalkan pembayaran');
                        }
                    });
                } else {
                    throw new Error(paymentData.error || 'Gagal mendapatkan token pembayaran');
                }
            } catch (error) {
                console.error('Checkout Error:', error);
                document.getElementById('loadingSpinner').classList.add('hidden');
                showNotification('error', 'Error', error.message || 'Terjadi kesalahan saat memproses pembelian.');
            }
        }

        // Buy Video Function - Two Step Process
        async function buyVideo(videoId) {
            // Show loading spinner
            document.getElementById('loadingSpinner').classList.remove('hidden');
            
            // Get CSRF token
            const csrfToken = document.querySelector('meta[name="csrf-token"]').getAttribute('content');
            
            try {
                // Step 1: Create purchase first
                const createPurchaseResponse = await fetch(`/video/${videoId}/create-purchase`, {
                    method: 'POST',
                    headers: {
                        'X-CSRF-TOKEN': csrfToken,
                        'Content-Type': 'application/json',
                        'Accept': 'application/json'
                    }
                });

                const purchaseData = await createPurchaseResponse.json();

                if (!purchaseData.success) {
                    throw new Error(purchaseData.error || 'Gagal membuat purchase');
                }

                // Step 2: Proceed to payment with purchase_id
                const paymentResponse = await fetch('{{ route("payment.snap-token") }}', {
                    method: 'POST',
                    headers: {
                        'X-CSRF-TOKEN': csrfToken,
                        'Content-Type': 'application/json',
                        'Accept': 'application/json'
                    },
                    body: JSON.stringify({
                        type: 'video',
                        item_id: purchaseData.purchase_id
                    })
                });

                const paymentData = await paymentResponse.json();
                document.getElementById('loadingSpinner').classList.add('hidden');
                
                if (paymentData.success && paymentData.snap_token) {
                    // Open Midtrans Snap popup
                    snap.pay(paymentData.snap_token, {
                        onSuccess: function(result) {
                            console.log('Payment Success:', result);
                            handlePaymentSuccess(result.order_id, csrfToken, 'video');
                        },
                        onPending: function(result) {
                            console.log('Payment Pending:', result);
                            showNotification('info', 'Pembayaran Pending', 'Silakan lanjutkan pembayaran Anda');
                            setTimeout(() => {
                                window.location.href = '{{ route("user.purchases.index") }}';
                            }, 2000);
                        },
                        onError: function(result) {
                            console.log('Payment Error:', result);
                            showNotification('error', 'Pembayaran Gagal', 'Silakan coba lagi');
                        },
                        onClose: function() {
                            console.log('Popup Closed');
                            showNotification('info', 'Pembayaran Dibatalkan', 'Anda telah membatalkan pembayaran');
                        }
                    });
                } else {
                    throw new Error(paymentData.error || 'Gagal mendapatkan token pembayaran');
                }
            } catch (error) {
                console.error('Checkout Error:', error);
                document.getElementById('loadingSpinner').classList.add('hidden');
                showNotification('error', 'Error', error.message || 'Terjadi kesalahan saat memproses pembelian.');
            }
        }

        // Handle payment success
        async function handlePaymentSuccess(orderId, csrfToken, type) {
            try {
                // Sync manual ke backend (update status DB)
                const syncResponse = await fetch('{{ route("payment.verify-status") }}', {
                    method: 'POST',
                    headers: {
                        'Content-Type': 'application/json',
                        'X-CSRF-TOKEN': csrfToken,
                        'Accept': 'application/json'
                    },
                    body: JSON.stringify({ order_id: orderId })
                });

                const syncData = await syncResponse.json();
                
                if (syncData.success && syncData.status === 'success') {
                    const message = type === 'event' ? 'Tiket Anda telah aktif!' : 'Akses video Anda telah aktif!';
                    showNotification('success', 'Pembayaran Berhasil', message);
                } else {
                    const message = type === 'event' ? 'Status tiket sedang diproses. Cek riwayat pembelian.' : 'Status video sedang diproses. Cek riwayat pembelian.';
                    showNotification('info', 'Pembayaran Berhasil', message);
                }
            } catch (syncError) {
                console.error('Sync Error:', syncError);
                const message = type === 'event' ? 'Tiket Anda telah aktif!' : 'Akses video Anda telah aktif!';
                showNotification('success', 'Pembayaran Berhasil', message);
            } finally {
                setTimeout(() => {
                    const redirectUrl = type === 'event' 
                        ? '{{ route("user.tickets.index") }}' 
                        : '{{ route("user.purchases.index") }}';
                    window.location.href = redirectUrl;
                }, 2000);
            }
        }

        // Notification System
        function showNotification(type, title, message) {
            const toast = document.getElementById('notificationToast');
            const icon = document.getElementById('notificationIcon');
            const titleEl = document.getElementById('notificationTitle');
            const messageEl = document.getElementById('notificationMessage');
            
            // Set icon based on type
            if (type === 'success') {
                icon.innerHTML = '<i class="fas fa-check-circle text-green-500"></i>';
            } else if (type === 'error') {
                icon.innerHTML = '<i class="fas fa-exclamation-circle text-red-500"></i>';
            } else if (type === 'info') {
                icon.innerHTML = '<i class="fas fa-info-circle text-blue-500"></i>';
            }
            
            // Set content
            titleEl.textContent = title;
            messageEl.textContent = message;
            
            // Show toast
            toast.classList.remove('hidden');
            
            // Auto hide after 5 seconds
            setTimeout(() => {
                hideNotification();
            }, 5000);
        }

        function hideNotification() {
            document.getElementById('notificationToast').classList.add('hidden');
        }

        // Function untuk menangani user yang belum login
        function showLoginRequired() {
            showNotification('error', 'Login Diperlukan', 'Anda harus login terlebih dahulu untuk melakukan pembelian. Anda akan diarahkan ke halaman login dalam 5 detik.');
            
            // Redirect ke halaman login setelah 5 detik
            setTimeout(() => {
                window.location.href = '{{ url('/login') }}';
            }, 5000);
        }
    </script>
</body>

</html>