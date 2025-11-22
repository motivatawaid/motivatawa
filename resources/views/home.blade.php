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
        .news-card-overlay {
            background: linear-gradient(to top, rgba(0, 0, 0, 0.7), transparent);
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
                        <li><a href="{{ url('/all-course') }}"
                                class="font-medium hover:text-primary transition-colors">Course</a></li>
                        <li><a href="{{ url('/all-video') }}"
                                class="font-medium hover:text-primary transition-colors">Video</a></li>
                        <li><a href="{{ url('/all-news') }}"
                                class="font-medium hover:text-primary transition-colors">Berita</a></li>
                        <li><a href="{{ url('/') }}#features"
                                class="font-medium hover:text-primary transition-colors">Fitur</a></li>
                        <li><a href="{{ url('/') }}#about"
                                class="font-medium hover:text-primary transition-colors">Tentang</a></li>
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
                        <a href="{{ url('/all-event') }}"
                            class="bg-white text-primary px-6 py-3 rounded-md font-medium hover:bg-gray-100 transition-all transform hover:-translate-y-0.5">
                            Jelajahi Event
                        </a>
                        <a href="{{ url('/all-course') }}"
                            class="bg-white text-primary px-6 py-3 rounded-md font-medium hover:bg-gray-100 transition-all transform hover:-translate-y-0.5">
                            Jelajahi Course
                        </a>
                        <a href="{{ url('/all-video') }}"
                            class="bg-white text-primary px-6 py-3 rounded-md font-medium hover:bg-gray-100 transition-all transform hover:-translate-y-0.5">
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
    <!-- News Section -->
    <section id="news" class="py-20 bg-light">
        <div class="container mx-auto px-4">
            <div class="text-center mb-16">
                <h2 class="text-3xl lg:text-4xl font-bold text-dark mb-4">Berita Terbaru</h2>
                <p class="text-gray-600 max-w-2xl mx-auto text-lg">Temukan inspirasi dan tips pengembangan diri terbaru
                </p>
            </div>
            <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-8">
                @forelse ($latestNews as $news)
                <a href="{{ route('article-news.show', $news->slug) }}" class="block">
                    <div
                        class="bg-white rounded-xl shadow-lg overflow-hidden transition-all transform hover:-translate-y-2 hover:shadow-xl cursor-pointer">
                        <div class="relative">
                            <img src="{{ $news->thumbnail ? asset('storage/' . $news->thumbnail) : asset('assets/img/hero.png') }}"
                                alt="{{ $news->title }}" class="w-full aspect-[4/5] object-cover"
                                onerror="this.src='{{ asset('assets/img/hero.png') }}'">
                            <div class="absolute inset-0 news-card-overlay flex items-end p-4">
                                <div class="w-full">
                                    <h3 class="text-white font-bold text-3xl mb-1 leading-tight break-words">
                                        {{ $news->title }}</h3>
                                    <p class="text-white/90 text-lg mb-1">Oleh: <span
                                            class="font-medium">{{ $news->author->username ?? 'Anonim' }}</span></p>
                                    <p class="text-white/80 text-base">{{ $news->published_date_formatted }}</p>
                                </div>
                            </div>
                        </div>
                    </div>
                </a>
                @empty
                <div class="col-span-full text-center py-12">
                    <div class="text-gray-400 text-6xl mb-4">
                        <i class="fas fa-newspaper"></i>
                    </div>
                    <h3 class="text-xl font-bold text-gray-600 mb-2">Belum ada berita</h3>
                    <p class="text-gray-500">Saat ini belum ada berita yang tersedia.</p>
                </div>
                @endforelse
            </div>
            <div class="text-center mt-12">
                <a href="{{ url('/all-news') }}"
                    class="bg-primary text-white px-6 py-3 rounded-md font-medium hover:bg-yellow-600 transition-colors">Lihat
                    Semua Berita</a>
            </div>
        </div>
    </section>
    <!-- Features Section -->
    <section id="features" class="py-20 bg-white">
        <div class="container mx-auto px-4">
            <div class="text-center mb-16">
                <h2 class="text-3xl lg:text-4xl font-bold text-dark mb-4">Keuntungan Menggunakan Motivatawa</h2>
                <p class="text-gray-600 max-w-2xl mx-auto text-lg">Nikmati berbagai kemudahan dalam mengakses konten
                    edutainment berkualitas</p>
            </div>
            <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-8">
                <div
                    class="bg-white rounded-xl shadow-lg p-8 border-t-4 border-primary transition-all transform hover:-translate-y-2 hover:shadow-xl">
                    <div class="text-primary text-4xl mb-6">
                        <i class="fas fa-lightbulb"></i>
                    </div>
                    <h3 class="text-xl font-bold text-dark mb-4">Inspirasi Harian</h3>
                    <p class="text-gray-600">Dapatkan berita dan tips terbaru untuk pengembangan diri dari para ahli di
                        bidang motivasi dan hiburan.</p>
                </div>
                <div
                    class="bg-white rounded-xl shadow-lg p-8 border-t-4 border-primary transition-all transform hover:-translate-y-2 hover:shadow-xl">
                    <div class="text-primary text-4xl mb-6">
                        <i class="fas fa-users"></i>
                    </div>
                    <h3 class="text-xl font-bold text-dark mb-4">Komunitas Aktif</h3>
                    <p class="text-gray-600">Bergabunglah dengan komunitas pembelajar yang saling mendukung dalam
                        perjalanan pengembangan diri.</p>
                </div>
                <div
                    class="bg-white rounded-xl shadow-lg p-8 border-t-4 border-primary transition-all transform hover:-translate-y-2 hover:shadow-xl">
                    <div class="text-primary text-4xl mb-6">
                        <i class="fas fa-rocket"></i>
                    </div>
                    <h3 class="text-xl font-bold text-dark mb-4">Pengembangan Diri</h3>
                    <p class="text-gray-600">Akses konten edutainment yang menyenangkan untuk mencapai hasil serius
                        dalam karir dan kehidupan pribadi.</p>
                </div>
            </div>
        </div>
    </section>
    <!-- About Section -->
    <section id="about" class="py-20 bg-light">
        <div class="container mx-auto px-4">
            <div class="text-center mb-16">
                <h2 class="text-3xl lg:text-4xl font-bold text-dark mb-4">Tentang Motivatawa</h2>
                <p class="text-gray-600 max-w-2xl mx-auto text-lg">Platform Edutainment yang menggabungkan motivasi dan
                    tawa untuk pengembangan diri yang menyenangkan</p>
            </div>
            <div class="grid lg:grid-cols-2 gap-12 items-center">
                <div class="order-2 lg:order-1">
                    <img src="{{ asset('assets/img/hero.png') }}" alt="Tentang Motivatawa"
                        class="rounded-xl shadow-2xl w-full h-96 object-cover">
                </div>
                <div class="order-1 lg:order-2 prose prose-lg max-w-none text-gray-700 leading-relaxed space-y-6">
                    <p>Perpaduan <strong>Edukasi</strong> dan <strong>Entertainment</strong> diharapkan mampu menjadi
                        jalan yang baik untuk masyarakat Indonesia.</p>
                    <p>Banyak program yang akan kami siapkan. Ada seminar, workshop, kelas Bergaransi, Show serta event
                        - event yang berkaitan dengan Edutainment.</p>
                    <p><strong>Motivatawa</strong> berasal dari dua kata yaitu <em>Motivasi</em> dan <em>Tawa</em>.</p>
                    <p>Dengan harapan kedepannya, orang bisa belajar dengan santai namun hasilnya tetap serius karena
                        prosesnya dijalani dengan kebahagiaan.</p>
                    <p>Di platform ini juga para pengajar/tutor/narasumber/komika/public speaker/singer atau siapapun
                        yang terlibat di bidang edukasi dan Entertainment bisa menitipkan produknya untuk dijual berupa
                        video pembelajaran ataupun tiket event juga show/kelas mereka.</p>
                    <p>Semoga <strong>MOTIVATAWA</strong> bisa menjadi platform yang bermanfaat untuk banyak orang,
                        terkhusus bagi mereka yang ingin belajar public speaking/digital marketing/personal branding
                        atau hal-hal lainnya yang berkaitan dengan self development (pengembangan diri).</p>
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
    </script>
</body>

</html>