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
                <h1 class="text-4xl lg:text-5xl font-bold text-dark mb-4">Semua Event</h1>
                <p class="text-gray-600 max-w-2xl mx-auto text-lg">Temukan event inspiratif yang sesuai dengan minat dan
                    kebutuhan Anda</p>
            </div>

            <!-- Search and Filter Section -->
            <div class="mb-8">
                <div class="flex flex-col md:flex-row gap-4 justify-between items-center">
                    <div class="w-full md:w-64">
                        <div class="relative">
                            <input type="text" id="searchInput" placeholder="Cari event..."
                                class="w-full pl-10 pr-4 py-2 border border-gray-300 rounded-lg focus:outline-none focus:ring-2 focus:ring-primary focus:border-transparent">
                            <i class="fas fa-search absolute left-3 top-3 text-gray-400"></i>
                        </div>
                    </div>
                    <div class="flex gap-4">
                        <select id="categoryFilter"
                            class="border border-gray-300 rounded-lg px-4 py-2 focus:outline-none focus:ring-2 focus:ring-primary focus:border-transparent">
                            <option value="">Semua Tipe</option>
                            <option value="online">Online</option>
                            <option value="offline">Offline</option>
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

            <!-- Events Grid -->
            <div id="eventsContainer" class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-8 mb-12">
                @forelse ($events as $event)
                <div class="event-card bg-white rounded-xl shadow-lg overflow-hidden transition-all transform hover:-translate-y-2 hover:shadow-xl"
                    data-title="{{ strtolower($event->title) }}"
                    data-talent="{{ strtolower($event->talent->name ?? '') }}" data-type="{{ $event->type }}"
                    data-price="{{ $event->price }}" data-date="{{ $event->start_date->timestamp }}"
                    data-quota="{{ $event->remaining_quota }}">
                    <img src="{{ $event->thumbnail ? asset('storage/' . $event->thumbnail) : 'https://placehold.co/600x400' }}"
                        alt="{{ $event->title }}" class="w-full h-48 object-cover"
                        onerror="this.src='https://placehold.co/600x400'">
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
                        <p class="text-gray-600 mb-4">Oleh: <span
                                class="font-medium">{{ $event->talent->name ?? 'Tidak tersedia' }}</span>
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
                                class="flex-1 bg-primary text-white px-4 py-2 rounded-md font-medium hover:bg-yellow-600 transition-colors">
                                Detail
                            </button>
                            @guest
                            <a href="{{ url('/login') }}"
                                class="flex-1 bg-dark text-white px-4 py-2 rounded-md font-medium hover:bg-gray-800 transition-colors text-center">
                                Beli
                            </a>
                            @else
                            @if(isset($event->is_purchased) && $event->is_purchased)
                            <a href="{{ route('user.tickets.show', $event->ticket_id) }}"
                                class="flex-1 bg-green-600 text-white px-4 py-2 rounded-md font-medium hover:bg-green-700 transition-colors text-center">
                                Lihat Tiket
                            </a>
                            @elseif($event->remaining_quota <= 0) <button disabled
                                class="flex-1 bg-gray-400 text-white px-4 py-2 rounded-md font-medium cursor-not-allowed">
                                Kuota Habis
                                </button>
                                @else
                                <button onclick="buyEvent({{ $event->id }})"
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
                        <i class="fas fa-calendar-times"></i>
                    </div>
                    <h3 class="text-xl font-bold text-gray-600 mb-2">Belum ada event</h3>
                    <p class="text-gray-500">Saat ini belum ada event yang tersedia.</p>
                </div>
                @endforelse
            </div>

            <!-- No Results Message -->
            <div id="noResults" class="hidden text-center py-12">
                <div class="text-gray-400 text-6xl mb-4">
                    <i class="fas fa-search"></i>
                </div>
                <h3 class="text-xl font-bold text-gray-600 mb-2">Tidak ada hasil</h3>
                <p class="text-gray-500">Tidak ada event yang sesuai dengan pencarian Anda.</p>
            </div>

            <!-- Pagination -->
            @if($events->hasPages())
            <div class="flex justify-center">
                <div class="flex space-x-2">
                    {{ $events->onEachSide(1)->links() }}
                </div>
            </div>
            @endif
        </div>
    </main>

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
                <img id="eventModalImage" src="https://placehold.co/600x400" alt="Event Image"
                    class="w-full h-64 object-cover rounded-lg mb-4" onerror="this.src='https://placehold.co/600x400'">
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
                        class="flex-1 bg-primary text-white px-4 py-3 rounded-md font-medium hover:bg-yellow-600 transition-colors text-center">
                        Login untuk Membeli
                    </a>
                    @else
                    <div id="eventModalActionContainer">
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
        // Data events dari Laravel
        const eventsData = @json($events->items() ?? []);
        
        // Format price function
        function formatPrice(price) {
            if (typeof price !== 'number') {
                price = parseFloat(price);
                if (isNaN(price)) return 'Rp 0';
            }
            return 'Rp ' + price.toFixed(0).replace(/\B(?=(\d{3})+(?!\d))/g, ".");
        }

        // Filter Functions - Improved Version
        function initializeFilters() {
            const searchInput = document.getElementById('searchInput');
            const categoryFilter = document.getElementById('categoryFilter');
            const sortFilter = document.getElementById('sortFilter');
            const eventCards = document.querySelectorAll('.event-card');
            const noResults = document.getElementById('noResults');
            const eventsContainer = document.getElementById('eventsContainer');

            function filterEvents() {
                const searchTerm = searchInput.value.toLowerCase().trim();
                const categoryValue = categoryFilter.value;
                const sortValue = sortFilter.value;
                
                let visibleCards = [];
                
                eventCards.forEach(card => {
                    const title = card.getAttribute('data-title') || '';
                    const talent = card.getAttribute('data-talent') || '';
                    const type = card.getAttribute('data-type') || '';
                    
                    // Search filter
                    const matchesSearch = searchTerm === '' || 
                                        title.includes(searchTerm) || 
                                        talent.includes(searchTerm);
                    
                    // Category filter
                    const matchesCategory = categoryValue === '' || type === categoryValue;
                    
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
                    eventsContainer.classList.add('hidden');
                } else {
                    noResults.classList.add('hidden');
                    eventsContainer.classList.remove('hidden');
                    
                    // Sort events
                    sortEvents(visibleCards, sortValue);
                }
            }

            function sortEvents(cards, sortBy) {
                const container = document.getElementById('eventsContainer');
                
                // Sort the cards array
                cards.sort((a, b) => {
                    const aPrice = parseFloat(a.getAttribute('data-price')) || 0;
                    const bPrice = parseFloat(b.getAttribute('data-price')) || 0;
                    const aDate = parseInt(a.getAttribute('data-date')) || 0;
                    const bDate = parseInt(b.getAttribute('data-date')) || 0;
                    
                    switch(sortBy) {
                        case 'newest':
                            return bDate - aDate; // Descending date
                        case 'oldest':
                            return aDate - bDate; // Ascending date
                        case 'price_low':
                            return aPrice - bPrice; // Ascending price
                        case 'price_high':
                            return bPrice - aPrice; // Descending price
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
                searchTimeout = setTimeout(filterEvents, 300);
            });
            
            categoryFilter.addEventListener('change', filterEvents);
            sortFilter.addEventListener('change', filterEvents);
            
            // Initialize filters
            filterEvents();
        }
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
                eventImage.src = 'https://placehold.co/600x400';
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

        // Buy Event Function
        async function buyEvent(eventId) {
            // Cek kuota terlebih dahulu
            const event = eventsData.find(e => e.id === eventId);
            if (event && event.remaining_quota <= 0) {
                showNotification('error', 'Kuota Habis', 'Maaf, kuota untuk event ini sudah habis.');
                return;
            }

            document.getElementById('loadingSpinner').classList.remove('hidden');
            const csrfToken = document.querySelector('meta[name="csrf-token"]').getAttribute('content');
            
            try {
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
                    snap.pay(paymentData.snap_token, {
                        onSuccess: function(result) {
                            handlePaymentSuccess(result.order_id, csrfToken, 'event');
                        },
                        onPending: function(result) {
                            showNotification('info', 'Pembayaran Pending', 'Silakan lanjutkan pembayaran Anda');
                            setTimeout(() => {
                                window.location.href = '{{ route("user.tickets.index") }}';
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
                    showNotification('success', 'Pembayaran Berhasil', 'Tiket Anda telah aktif!');
                } else {
                    showNotification('info', 'Pembayaran Berhasil', 'Status tiket sedang diproses. Cek riwayat pembelian.');
                }
            } catch (syncError) {
                console.error('Sync Error:', syncError);
                showNotification('success', 'Pembayaran Berhasil', 'Tiket Anda telah aktif!');
            } finally {
                setTimeout(() => {
                    window.location.href = '{{ route("user.tickets.index") }}';
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
            const eventModal = document.getElementById('eventModal');
            if (event.target == eventModal) {
                eventModal.classList.add('hidden');
            }
        }

        // Initialize filters when page loads
        document.addEventListener('DOMContentLoaded', function() {
            initializeFilters();
        });
    </script>
</body>

</html>