<!DOCTYPE html>
<html lang="id">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">

    <!-- SEO Meta Tags -->
    <title>{{ $news->title }} - Motivatawa - Platform Edutainment Indonesia | Belajar Santai, Hasil Serius</title>
    <meta name="description" content="{{ Str::limit(strip_tags($news->article), 160) }}">
    <meta name="keywords"
        content="{{ $news->title }}, berita edutainment, pengembangan diri, motivasi, {{ $news->author->name ?? 'Motivatawa' }}">
    <meta name="author" content="{{ $news->author->name ?? 'Motivatawa.id' }}">
    <meta name="robots" content="index, follow">
    <link rel="canonical" href="{{ route('article-news.show', $news->slug) }}" />

    <!-- Open Graph Meta Tags -->
    <meta property="og:type" content="article" />
    <meta property="og:title" content="{{ $news->title }} - Motivatawa" />
    <meta property="og:description" content="{{ Str::limit(strip_tags($news->article), 160) }}" />
    <meta property="og:image"
        content="{{ $news->thumbnail ? asset('storage/' . $news->thumbnail) : asset('assets/img/hero.png') }}" />
    <meta property="og:url" content="{{ route('article-news.show', $news->slug) }}" />
    <meta property="og:site_name" content="Motivatawa.id" />
    <meta property="og:locale" content="id_ID" />
    <meta property="article:published_time"
        content="{{ $news->published_at ? $news->published_at->toAtomString() : '' }}" />
    <meta property="article:author" content="{{ $news->author->name ?? 'Motivatawa' }}" />

    <!-- Twitter Card Meta Tags -->
    <meta name="twitter:card" content="summary_large_image" />
    <meta name="twitter:title" content="{{ $news->title }} - Motivatawa" />
    <meta name="twitter:description" content="{{ Str::limit(strip_tags($news->article), 160) }}" />
    <meta name="twitter:image"
        content="{{ $news->thumbnail ? asset('storage/' . $news->thumbnail) : asset('assets/img/hero.png') }}" />
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
                                class="font-medium hover:text-primary transition-colors text-primary">Berita</a></li>
                        <li><a href="{{ url('/') }}#features"
                                class="font-medium hover:text-primary transition-colors">Fitur</a></li>
                        <li><a href="{{ url('/') }}#about"
                                class="font-medium hover:text-primary transition-colors">Tentang Kami</a></li>
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

    <!-- Main Content -->
    <main class="pt-32 pb-20">
        <div class="container mx-auto px-4">
            <!-- Breadcrumb -->
            <nav class="flex mb-8" aria-label="Breadcrumb">
                <ol class="inline-flex items-center space-x-1 md:space-x-3">
                    <li class="inline-flex items-center">
                        <a href="{{ url('/') }}"
                            class="inline-flex items-center text-sm font-medium text-gray-700 hover:text-primary">
                            <i class="fas fa-home mr-1"></i>
                            Beranda
                        </a>
                    </li>
                    <li>
                        <div class="flex items-center">
                            <i class="fas fa-chevron-right text-gray-400 mx-1"></i>
                            <a href="{{ url('/all-news') }}"
                                class="ml-1 text-sm font-medium text-gray-700 hover:text-primary md:ml-2">Berita</a>
                        </div>
                    </li>
                    <li aria-current="page">
                        <div class="flex items-center">
                            <i class="fas fa-chevron-right text-gray-400 mx-1"></i>
                            <span
                                class="ml-1 text-sm font-medium text-gray-500 md:ml-2">{{ Str::limit($news->title, 30) }}</span>
                        </div>
                    </li>
                </ol>
            </nav>

            <!-- Article Hero -->
            <article class="mb-12">
                <!-- Hero Image -->
                <div class="relative mb-8">
                    <img src="{{ $news->thumbnail ? asset('storage/' . $news->thumbnail) : asset('assets/img/hero.png') }}"
                        alt="{{ $news->title }}" class="w-full h-96 object-cover rounded-xl shadow-lg"
                        onerror="this.src='{{ asset('assets/img/hero.png') }}'">
                    <div
                        class="absolute bottom-0 left-0 right-0 bg-gradient-to-t from-black/70 to-transparent p-6 rounded-xl">
                        <h1 class="text-3xl md:text-4xl lg:text-5xl font-bold text-white mb-2 leading-tight">
                            {{ $news->title }}
                        </h1>
                        <div class="flex flex-wrap items-center text-white/90 gap-4 text-sm">
                            <div class="flex items-center">
                                <i class="fas fa-user mr-2"></i>
                                <span>{{ $news->author->name ?? 'Anonim' }}</span>
                            </div>
                            <div class="flex items-center">
                                <i class="fas fa-calendar-alt mr-2"></i>
                                <span>{{ $news->published_at ? $news->published_at->format('d F Y, H:i') : 'Belum dipublikasikan' }}</span>
                            </div>
                            <div class="flex items-center">
                                <i class="fas fa-clock mr-2"></i>
                                <span>{{ $news->published_at ? $news->published_at->diffForHumans() : 'Baru saja' }}</span>
                            </div>
                        </div>
                    </div>
                </div>

                <!-- Article Content -->
                <div class="prose prose-lg max-w-none text-gray-800">
                    {!! $news->article !!}
                </div>
            </article>

            <!-- Share Buttons -->
            <div class="bg-light rounded-xl p-6 mb-12">
                <h3 class="text-xl font-bold text-dark mb-4 flex items-center">
                    <i class="fas fa-share-alt mr-2 text-primary"></i>
                    Bagikan Artikel Ini
                </h3>
                <div class="flex space-x-4">
                    <a href="https://www.facebook.com/sharer/sharer.php?u={{ urlencode(route('article-news.show', $news->slug)) }}"
                        target="_blank"
                        class="flex items-center px-4 py-2 bg-blue-600 text-white rounded-md hover:bg-blue-700 transition-colors">
                        <i class="fab fa-facebook-f mr-2"></i> Facebook
                    </a>
                    <a href="https://twitter.com/intent/tweet?url={{ urlencode(route('article-news.show', $news->slug)) }}&text={{ urlencode($news->title) }}"
                        target="_blank"
                        class="flex items-center px-4 py-2 bg-blue-400 text-white rounded-md hover:bg-blue-500 transition-colors">
                        <i class="fab fa-twitter mr-2"></i> Twitter
                    </a>
                    <a href="https://wa.me/?text={{ urlencode($news->title . ' - ' . route('article-news.show', $news->slug)) }}"
                        target="_blank"
                        class="flex items-center px-4 py-2 bg-green-500 text-white rounded-md hover:bg-green-600 transition-colors">
                        <i class="fab fa-whatsapp mr-2"></i> WhatsApp
                    </a>
                </div>
            </div>

            <!-- Related News (Asumsi $relatedNews di-pass dari controller) -->
            @if(isset($relatedNews) && $relatedNews->count() > 0)
            <section class="mb-12">
                <h2 class="text-2xl font-bold text-dark mb-6">Berita Terkait</h2>
                <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-6">
                    @foreach($relatedNews as $related)
                    <a href="{{ route('article-news.show', $related->slug) }}" class="block">
                        <div
                            class="bg-white rounded-xl shadow-lg overflow-hidden transition-all transform hover:-translate-y-1 hover:shadow-md">
                            <img src="{{ $related->thumbnail ? asset('storage/' . $related->thumbnail) : asset('assets/img/hero.png') }}"
                                alt="{{ $related->title }}" class="w-full h-48 object-cover"
                                onerror="this.src='{{ asset('assets/img/hero.png') }}'">
                            <div class="p-4">
                                <h3 class="text-lg font-bold text-dark mb-2 line-clamp-2">{{ $related->title }}</h3>
                                <p class="text-gray-600 text-sm mb-2">Oleh: {{ $related->author->name ?? 'Anonim' }}</p>
                                <p class="text-gray-500 text-xs">
                                    {{ $related->published_at ? $related->published_at->format('d M Y') : 'Belum dipublikasikan' }}
                                </p>
                            </div>
                        </div>
                    </a>
                    @endforeach
                </div>
            </section>
            @endif

            <!-- Back to All News -->
            <div class="text-center">
                <a href="{{ url('/all-news') }}"
                    class="inline-flex items-center bg-primary text-white px-6 py-3 rounded-md font-medium hover:bg-yellow-600 transition-all">
                    <i class="fas fa-arrow-left mr-2"></i>
                    Kembali ke Semua Berita
                </a>
            </div>
        </div>
    </main>

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

    <script>
        // Notification System (sama seperti halaman lain)
        function showNotification(type, title, message) {
            const toast = document.getElementById('notificationToast');
            const icon = document.getElementById('notificationIcon');
            const titleEl = document.getElementById('notificationTitle');
            const messageEl = document.getElementById('notificationMessage');
          
            if (type === 'success') {
                icon.innerHTML = '<i class="fas fa-check-circle text-green-500"></i>';
            } else if (type === 'error') {
                icon.innerHTML = '<i class="fas fa-exclamation-circle text-red-500"></i>';
            } else if (type === 'info') {
                icon.innerHTML = '<i class="fas fa-info-circle text-blue-500"></i>';
            }
          
            titleEl.textContent = title;
            messageEl.textContent = message;
            toast.classList.remove('hidden');
          
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