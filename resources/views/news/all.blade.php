<!DOCTYPE html>
<html lang="id">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">

    <!-- SEO Meta Tags -->
    <title>Semua Berita - Motivatawa - Platform Edutainment Indonesia | Belajar Santai, Hasil Serius</title>
    <meta name="description"
        content="Temukan berita dan artikel inspiratif tentang edutainment, pengembangan diri, dan tren terkini. Baca kisah sukses, tips motivasi, dan update industri di Motivatawa.id.">
    <meta name="keywords"
        content="berita edutainment, artikel pengembangan diri, motivasi, public speaking, digital marketing, workshop, seminar, tren edukasi, hiburan belajar, inspirasi harian">
    <meta name="author" content="Motivatawa.id">
    <meta name="robots" content="index, follow">
    <link rel="canonical" href="https://motivatawa.id/all-news" />

    <!-- Open Graph Meta Tags -->
    <meta property="og:type" content="website" />
    <meta property="og:title"
        content="Semua Berita - Motivatawa - Platform Edutainment Indonesia | Belajar Santai, Hasil Serius" />
    <meta property="og:description"
        content="Temukan berita dan artikel inspiratif tentang edutainment, pengembangan diri, dan tren terkini di Motivatawa.id." />
    <meta property="og:image" content="{{ asset('assets/img/hero.png') }}" />
    <meta property="og:url" content="https://motivatawa.id/all-news" />
    <meta property="og:site_name" content="Motivatawa.id" />
    <meta property="og:locale" content="id_ID" />

    <!-- Twitter Card Meta Tags -->
    <meta name="twitter:card" content="summary_large_image" />
    <meta name="twitter:title"
        content="Semua Berita - Motivatawa - Platform Edutainment Indonesia | Belajar Santai, Hasil Serius" />
    <meta name="twitter:description"
        content="Temukan berita dan artikel inspiratif tentang edutainment, pengembangan diri, dan tren terkini di Motivatawa.id." />
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
                                class="font-medium hover:text-primary transition-colors text-primary">Berita</a></li>
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

    <!-- Main Content -->
    <main class="pt-32 pb-20 min-h-screen">
        <div class="container mx-auto px-4">
            <!-- Header Section -->
            <div class="text-center mb-12">
                <h1 class="text-4xl lg:text-5xl font-bold text-dark mb-4">Semua Berita</h1>
                <p class="text-gray-600 max-w-2xl mx-auto text-lg">Temukan berita dan artikel inspiratif tentang
                    edutainment, pengembangan diri, dan tren terkini</p>
            </div>

            <!-- Search and Filter Section -->
            <div class="mb-8">
                <div class="flex flex-col md:flex-row gap-4 justify-between items-center">
                    <div class="w-full md:w-64">
                        <div class="relative">
                            <input type="text" id="searchInput" placeholder="Cari berita..."
                                class="w-full pl-10 pr-4 py-2 border border-gray-300 rounded-lg focus:outline-none focus:ring-2 focus:ring-primary focus:border-transparent">
                            <i class="fas fa-search absolute left-3 top-3 text-gray-400"></i>
                        </div>
                    </div>
                    <div class="flex gap-4">
                        <select id="sortFilter"
                            class="border border-gray-300 rounded-lg px-4 py-2 focus:outline-none focus:ring-2 focus:ring-primary focus:border-transparent">
                            <option value="newest">Terbaru</option>
                            <option value="oldest">Terlama</option>
                        </select>
                    </div>
                </div>
            </div>

            <!-- News Grid -->
            <div id="newsContainer" class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-8 mb-12">
                @forelse ($news as $item)
                <a href="{{ route('article-news.show', $item->slug) }}" class="block news-card"
                    data-title="{{ strtolower($item->title) }}"
                    data-author="{{ strtolower($item->author->name ?? '') }}"
                    data-date="{{ $item->published_at ? $item->published_at->timestamp : 0 }}">
                    <div
                        class="bg-white rounded-xl shadow-lg overflow-hidden transition-all transform hover:-translate-y-2 hover:shadow-xl cursor-pointer">
                        <div class="relative">
                            <img src="{{ $item->thumbnail ? asset('storage/' . $item->thumbnail) : asset('assets/img/hero.png') }}"
                                alt="{{ $item->title }}" class="w-full aspect-[4/5] object-cover"
                                onerror="this.src='{{ asset('assets/img/hero.png') }}'">
                            <div class="absolute inset-0 news-card-overlay flex items-end p-4">
                                <div class="w-full">
                                    <h3 class="text-white font-bold text-xl mb-1 leading-tight break-words">
                                        {{ $item->title }}</h3>
                                    <p class="text-white/90 text-sm mb-1">Oleh: <span
                                            class="font-medium">{{ $item->author->name ?? 'Anonim' }}</span></p>
                                    <p class="text-white/80 text-xs">
                                        {{ $item->published_at ? $item->published_at->format('d M Y') : 'Belum dipublikasikan' }}
                                    </p>
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

            <!-- No Results Message -->
            <div id="noResults" class="hidden text-center py-12">
                <div class="text-gray-400 text-6xl mb-4">
                    <i class="fas fa-search"></i>
                </div>
                <h3 class="text-xl font-bold text-gray-600 mb-2">Tidak ada hasil</h3>
                <p class="text-gray-500">Tidak ada berita yang sesuai dengan pencarian Anda.</p>
            </div>

            <!-- Pagination -->
            @if($news->hasPages())
            <div class="flex justify-center">
                <div class="flex space-x-2">
                    {{ $news->onEachSide(1)->links() }}
                </div>
            </div>
            @endif
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
        // Data news dari Laravel
        const newsData = @json($news->items() ?? []);
        
        // Filter Functions - Improved Version
        function initializeFilters() {
            const searchInput = document.getElementById('searchInput');
            const sortFilter = document.getElementById('sortFilter');
            const newsCards = document.querySelectorAll('.news-card');
            const noResults = document.getElementById('noResults');
            const newsContainer = document.getElementById('newsContainer');

            function filterNews() {
                const searchTerm = searchInput.value.toLowerCase().trim();
                const sortValue = sortFilter.value;
                
                let visibleCards = [];
                
                newsCards.forEach(card => {
                    const title = card.getAttribute('data-title') || '';
                    const author = card.getAttribute('data-author') || '';
                    
                    // Search filter
                    const matchesSearch = searchTerm === '' || 
                                        title.includes(searchTerm) || 
                                        author.includes(searchTerm);
                    
                    if (matchesSearch) {
                        card.style.display = 'block';
                        visibleCards.push(card);
                    } else {
                        card.style.display = 'none';
                    }
                });

                // Show/hide no results message
                if (visibleCards.length === 0) {
                    noResults.classList.remove('hidden');
                    newsContainer.classList.add('hidden');
                } else {
                    noResults.classList.add('hidden');
                    newsContainer.classList.remove('hidden');
                    
                    // Sort news
                    sortNews(visibleCards, sortValue);
                }
            }

            function sortNews(cards, sortBy) {
                const container = document.getElementById('newsContainer');
                
                // Sort the cards array
                cards.sort((a, b) => {
                    const aDate = parseInt(a.getAttribute('data-date')) || 0;
                    const bDate = parseInt(b.getAttribute('data-date')) || 0;
                    
                    switch(sortBy) {
                        case 'newest':
                            return bDate - aDate; // Descending date
                        case 'oldest':
                            return aDate - bDate; // Ascending date
                        default:
                            return 0;
                    }
                });

                // Reorder cards in DOM
                cards.forEach(card => {
                    container.appendChild(card);
                });
            }

            // Event listeners dengan debounce untuk search
            let searchTimeout;
            searchInput.addEventListener('input', function() {
                clearTimeout(searchTimeout);
                searchTimeout = setTimeout(filterNews, 300);
            });
            
            sortFilter.addEventListener('change', filterNews);
            
            // Initialize filters
            filterNews();
        }

        // Helper Functions
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

        // Initialize filters when page loads
        document.addEventListener('DOMContentLoaded', function() {
            initializeFilters();
        });
    </script>
</body>

</html>