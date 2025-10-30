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

    <!-- Main Content -->
    <main class="pt-32 pb-20 min-h-screen">
        <div class="container mx-auto px-4">
            <!-- Header Section -->
            <div class="text-center mb-12">
                <h1 class="text-4xl lg:text-5xl font-bold text-dark mb-4">Semua Video Pembelajaran</h1>
                <p class="text-gray-600 max-w-2xl mx-auto text-lg">Tingkatkan pengetahuan dan keterampilan Anda dengan
                    video pembelajaran premium dari para ahli</p>
            </div>

            <!-- Search and Filter Section -->
            <div class="mb-8">
                <div class="flex flex-col md:flex-row gap-4 justify-between items-center">
                    <div class="w-full md:w-64">
                        <div class="relative">
                            <input type="text" id="searchInput" placeholder="Cari video..."
                                class="w-full pl-10 pr-4 py-2 border border-gray-300 rounded-lg focus:outline-none focus:ring-2 focus:ring-primary focus:border-transparent">
                            <i class="fas fa-search absolute left-3 top-3 text-gray-400"></i>
                        </div>
                    </div>
                    <div class="flex gap-4">
                        <select id="categoryFilter"
                            class="border border-gray-300 rounded-lg px-4 py-2 focus:outline-none focus:ring-2 focus:ring-primary focus:border-transparent">
                            <option value="">Semua Kategori</option>
                            <option value="business">Bisnis</option>
                            <option value="technology">Teknologi</option>
                            <option value="personal">Pengembangan Diri</option>
                        </select>
                        <select id="sortFilter"
                            class="border border-gray-300 rounded-lg px-4 py-2 focus:outline-none focus:ring-2 focus:ring-primary focus:border-transparent">
                            <option value="newest">Terbaru</option>
                            <option value="oldest">Terlama</option>
                            <option value="price_low">Harga Terendah</option>
                            <option value="price_high">Harga Tertinggi</option>
                        </select>
                    </div>
                </div>
            </div>

            <!-- Videos Grid -->
            <div id="videosContainer" class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-8 mb-12">
                @forelse ($videos as $video)
                <div class="video-card bg-white rounded-xl shadow-lg overflow-hidden transition-all transform hover:-translate-y-2 hover:shadow-xl"
                    data-title="{{ strtolower($video->title) }}" data-talent="{{ strtolower($video->talent->name) }}"
                    data-price="{{ $video->price }}" data-date="{{ $video->created_at }}">
                    <div class="relative">
                        <img src="{{ $video->thumbnail ? asset('storage/' . $video->thumbnail) : 'https://placehold.co/600x400' }}"
                            alt="{{ $video->title }}" class="w-full h-48 object-cover"
                            onerror="this.src='https://placehold.co/600x400'">
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
                                class="flex-1 bg-primary text-white px-4 py-2 rounded-md font-medium hover:bg-yellow-600 transition-colors">
                                Detail
                            </button>
                            @guest
                            <a href="{{ url('/login') }}"
                                class="flex-1 bg-dark text-white px-4 py-2 rounded-md font-medium hover:bg-gray-800 transition-colors text-center">
                                Beli
                            </a>
                            @else
                            @if(isset($video->is_purchased) && $video->is_purchased)
                            <a href="{{ route('user.purchases.show', $video->purchase_id) }}"
                                class="flex-1 bg-green-600 text-white px-4 py-2 rounded-md font-medium hover:bg-green-700 transition-colors text-center">
                                Tonton Video
                            </a>
                            @else
                            <button onclick="buyVideo({{ $video->id }})"
                                class="flex-1 bg-dark text-white px-4 py-2 rounded-md font-medium hover:bg-gray-800 transition-colors">
                                Beli
                            </button>
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

            <!-- No Results Message -->
            <div id="noResults" class="hidden text-center py-12">
                <div class="text-gray-400 text-6xl mb-4">
                    <i class="fas fa-search"></i>
                </div>
                <h3 class="text-xl font-bold text-gray-600 mb-2">Tidak ada hasil</h3>
                <p class="text-gray-500">Tidak ada video yang sesuai dengan pencarian Anda.</p>
            </div>

            <!-- Pagination -->
            @if($videos->hasPages())
            <div class="flex justify-center">
                <div class="flex space-x-2">
                    {{ $videos->links() }}
                </div>
            </div>
            @endif
        </div>
    </main>

    @include('footer')

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
                <img id="videoModalImage" src="https://placehold.co/600x400" alt="Video Thumbnail"
                    class="w-full h-64 object-cover rounded-lg mb-4" onerror="this.src='https://placehold.co/600x400'">
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
                        class="flex-1 bg-primary text-white px-4 py-3 rounded-md font-medium hover:bg-yellow-600 transition-colors text-center">
                        Login untuk Membeli
                    </a>
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

    <!-- Midtrans Snap -->
    <script src="https://app.midtrans.com/snap/snap.js" data-client-key="{{ config('midtrans.client_key') }}">
    </script>

    <script>
        // Data videos dari Laravel
        const videosData = @json($videos->items() ?? []);

        // Filter Functions - Simple Version
        function initializeFilters() {
            const searchInput = document.getElementById('searchInput');
            const categoryFilter = document.getElementById('categoryFilter');
            const sortFilter = document.getElementById('sortFilter');
            const videoCards = document.querySelectorAll('.video-card');
            const noResults = document.getElementById('noResults');
            const videosContainer = document.getElementById('videosContainer');

            function filterVideos() {
                const searchTerm = searchInput.value.toLowerCase();
                const categoryValue = categoryFilter.value;
                const sortValue = sortFilter.value;
                
                let visibleCards = [];
                
                // First: Filter cards
                videoCards.forEach(card => {
                    const title = card.getAttribute('data-title');
                    const talent = card.getAttribute('data-talent');
                    
                    // Search filter
                    const matchesSearch = title.includes(searchTerm) || talent.includes(searchTerm);
                    
                    // Category filter
                    const matchesCategory = !categoryValue; // All videos match for now
                    
                    if (matchesSearch && matchesCategory) {
                        card.style.display = 'block';
                        visibleCards.push(card);
                    } else {
                        card.style.display = 'none';
                    }
                });

                // Show/hide no results message
                if (visibleCards.length === 0) {
                    noResults.classList.remove('hidden');
                    videosContainer.classList.add('hidden');
                    return;
                } else {
                    noResults.classList.add('hidden');
                    videosContainer.classList.remove('hidden');
                }
                
                // Second: Sort visible cards
                visibleCards.sort((a, b) => {
                    const aPrice = parseFloat(a.getAttribute('data-price')) || 0;
                    const bPrice = parseFloat(b.getAttribute('data-price')) || 0;
                    const aDate = new Date(a.getAttribute('data-date')).getTime() || 0;
                    const bDate = new Date(b.getAttribute('data-date')).getTime() || 0;
                    
                    switch(sortValue) {
                        case 'newest':
                            return bDate - aDate;
                        case 'oldest':
                            return aDate - bDate;
                        case 'price_low':
                            return aPrice - bPrice;
                        case 'price_high':
                            return bPrice - aPrice;
                        default:
                            return 0;
                    }
                });

                // Third: Reorder in DOM
                const container = document.getElementById('videosContainer');
                
                // Remove all visible cards temporarily
                visibleCards.forEach(card => {
                    container.removeChild(card);
                });
                
                // Re-append in sorted order
                visibleCards.forEach(card => {
                    container.appendChild(card);
                });
            }

            // Event listeners
            searchInput.addEventListener('input', filterVideos);
            categoryFilter.addEventListener('change', filterVideos);
            sortFilter.addEventListener('change', filterVideos);
            
            // Initialize
            filterVideos();
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
                videoImage.src = 'https://placehold.co/600x400';
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

        // Buy Video Function
        async function buyVideo(videoId) {
            document.getElementById('loadingSpinner').classList.remove('hidden');
            const csrfToken = document.querySelector('meta[name="csrf-token"]').getAttribute('content');
            
            try {
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
                    snap.pay(paymentData.snap_token, {
                        onSuccess: function(result) {
                            handlePaymentSuccess(result.order_id, csrfToken, 'video');
                        },
                        onPending: function(result) {
                            showNotification('info', 'Pembayaran Pending', 'Silakan lanjutkan pembayaran Anda');
                            setTimeout(() => {
                                window.location.href = '{{ route("user.purchases.index") }}';
                            }, 2000);
                        },
                        onError: function(result) {
                            showNotification('error', 'Pembayaran Gagal', 'Silakan coba lagi');
                        },
                        onClose: function() {
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

        // Helper Functions
        function formatPrice(price) {
            if (typeof price !== 'number') {
                price = parseFloat(price);
                if (isNaN(price)) return 'Rp 0';
            }
            return 'Rp ' + price.toFixed(0).replace(/\B(?=(\d{3})+(?!\d))/g, ".");
        }

        async function handlePaymentSuccess(orderId, csrfToken, type) {
            try {
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
                    showNotification('success', 'Pembayaran Berhasil', 'Akses video Anda telah aktif!');
                } else {
                    showNotification('info', 'Pembayaran Berhasil', 'Status video sedang diproses. Cek riwayat pembelian.');
                }
            } catch (syncError) {
                console.error('Sync Error:', syncError);
                showNotification('success', 'Pembayaran Berhasil', 'Akses video Anda telah aktif!');
            } finally {
                setTimeout(() => {
                    window.location.href = '{{ route("user.purchases.index") }}';
                }, 2000);
            }
        }

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

        // Close modal when clicking outside
        window.onclick = function(event) {
            const videoModal = document.getElementById('videoModal');
            if (event.target == videoModal) {
                videoModal.classList.add('hidden');
            }
        }

        // Initialize filters when page loads
        document.addEventListener('DOMContentLoaded', function() {
            initializeFilters();
        });
    </script>
</body>

</html>