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
                        <li><a href="{{ url('/all-course') }}"
                                class="font-medium hover:text-primary transition-colors text-primary">Course</a></li>
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
                <h1 class="text-4xl lg:text-5xl font-bold text-dark mb-4">Semua Course</h1>
                <p class="text-gray-600 max-w-2xl mx-auto text-lg">Temukan course inspiratif yang sesuai dengan minat
                    dan
                    kebutuhan pengembangan diri Anda</p>
            </div>

            <!-- Search and Filter Section -->
            <div class="mb-8">
                <div class="flex flex-col md:flex-row gap-4 justify-between items-center">
                    <div class="w-full md:w-64">
                        <div class="relative">
                            <input type="text" id="searchInput" placeholder="Cari course..."
                                class="w-full pl-10 pr-4 py-2 border border-gray-300 rounded-lg focus:outline-none focus:ring-2 focus:ring-primary focus:border-transparent">
                            <i class="fas fa-search absolute left-3 top-3 text-gray-400"></i>
                        </div>
                    </div>
                    <div class="flex gap-4">
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

            <!-- Courses Grid -->
            <div id="coursesContainer" class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-8 mb-12">
                @forelse ($courses as $course)
                <div class="course-card bg-white rounded-xl shadow-lg overflow-hidden transition-all transform hover:-translate-y-2 hover:shadow-xl"
                    data-name="{{ strtolower($course->name) }}"
                    data-talent="{{ strtolower($course->talent->name ?? '') }}" data-price="{{ $course->price }}"
                    data-date="{{ $course->created_at->timestamp }}" data-quota="{{ $course->remaining_quota }}">
                    <img src="{{ $course->thumbnail ? asset('storage/' . $course->thumbnail) : 'https://placehold.co/600x400' }}"
                        alt="{{ $course->name }}" class="w-full h-48 object-cover"
                        onerror="this.src='https://placehold.co/600x400'">
                    <div class="p-6">
                        @if($course->remaining_quota <= 0) <span
                            class="inline-block px-3 py-1 text-xs font-semibold bg-red-100 text-red-800 rounded-full mb-2">
                            Kuota Habis
                            </span>
                            @elseif($course->remaining_quota <= 10) <span
                                class="inline-block px-3 py-1 text-xs font-semibold bg-orange-100 text-orange-800 rounded-full mb-2">
                                Hampir Habis
                                </span>
                                @endif

                                <h3 class="text-xl font-bold text-dark mb-2">{{ $course->name }}</h3>
                                <p class="text-gray-600 mb-4">Oleh: <span
                                        class="font-medium">{{ $course->talent->name ?? 'Tidak tersedia' }}</span>
                                </p>

                                <div class="flex justify-between items-center mb-4">
                                    <span class="text-primary font-bold text-lg">{{ $course->price_formatted }}</span>
                                    <span class="text-sm text-gray-500">
                                        @if($course->remaining_quota <= 0) <span class="text-red-500">Kuota Habis</span>
                                    @else
                                    {{ $course->remaining_quota }} dari {{ $course->quota }} tersisa
                                    @endif
                                    </span>
                                </div>

                                <div class="flex gap-2">
                                    <button onclick="openCourseModal({{ $course->id }})"
                                        class="flex-1 bg-primary text-white px-4 py-2 rounded-md font-medium hover:bg-yellow-600 transition-colors">
                                        Detail
                                    </button>
                                    @guest
                                    <a href="{{ url('/login') }}"
                                        class="flex-1 bg-dark text-white px-4 py-2 rounded-md font-medium hover:bg-gray-800 transition-colors text-center">
                                        Daftar
                                    </a>
                                    @else
                                    @if(isset($course->is_purchased) && $course->is_purchased)
                                    <a href="{{ route('user.registrations.show', $course->registration_id) }}"
                                        class="flex-1 bg-green-600 text-white px-4 py-2 rounded-md font-medium hover:bg-green-700 transition-colors text-center">
                                        Lihat Registrasi
                                    </a>
                                    @elseif($course->remaining_quota <= 0) <button disabled
                                        class="flex-1 bg-gray-400 text-white px-4 py-2 rounded-md font-medium cursor-not-allowed">
                                        Kuota Habis
                                        </button>
                                        @else
                                        <button onclick="buyCourse({{ $course->id }})"
                                            class="flex-1 bg-dark text-white px-4 py-2 rounded-md font-medium hover:bg-gray-800 transition-colors">
                                            Daftar
                                        </button>
                                        @endif
                                        @endguest
                                </div>
                    </div>
                </div>
                @empty
                <div class="col-span-full text-center py-12">
                    <div class="text-gray-400 text-6xl mb-4">
                        <i class="fas fa-graduation-cap"></i>
                    </div>
                    <h3 class="text-xl font-bold text-gray-600 mb-2">Belum ada course</h3>
                    <p class="text-gray-500">Saat ini belum ada course yang tersedia.</p>
                </div>
                @endforelse
            </div>

            <!-- No Results Message -->
            <div id="noResults" class="hidden text-center py-12">
                <div class="text-gray-400 text-6xl mb-4">
                    <i class="fas fa-search"></i>
                </div>
                <h3 class="text-xl font-bold text-gray-600 mb-2">Tidak ada hasil</h3>
                <p class="text-gray-500">Tidak ada course yang sesuai dengan pencarian Anda.</p>
            </div>

            <!-- Pagination -->
            @if($courses->hasPages())
            <div class="flex justify-center">
                <div class="flex space-x-2">
                    {{ $courses->onEachSide(1)->links() }}
                </div>
            </div>
            @endif
        </div>
    </main>

    @include('footer')

    <!-- Course Modal -->
    <div id="courseModal" class="fixed inset-0 bg-black bg-opacity-50 flex items-center justify-center z-50 hidden">
        <div class="bg-white rounded-xl max-w-2xl w-full max-h-[90vh] overflow-y-auto">
            <div class="p-6">
                <div class="flex justify-between items-start mb-4">
                    <h3 class="text-2xl font-bold text-dark" id="courseModalTitle">Course Title</h3>
                    <button onclick="closeCourseModal()" class="text-gray-500 hover:text-gray-700">
                        <i class="fas fa-times text-xl"></i>
                    </button>
                </div>
                <img id="courseModalImage" src="https://placehold.co/600x400" alt="Course Image"
                    class="w-full h-64 object-cover rounded-lg mb-4" onerror="this.src='https://placehold.co/600x400'">
                <div class="mb-4">
                    <p class="text-gray-600 mb-2"><span class="font-medium">Pengajar:</span> <span
                            id="courseModalTalent">Talent Name</span></p>
                    <p class="text-gray-600 mb-2"><span class="font-medium">Kuota:</span> <span
                            id="courseModalQuota">Quota</span> (<span id="courseModalRemainingQuota">Remaining</span>
                        tersisa)</p>
                    <p class="text-gray-600 mb-4"><span class="font-medium">Harga:</span> <span id="courseModalPrice"
                            class="text-primary font-bold">Price</span></p>
                </div>
                <div class="mb-6">
                    <h4 class="font-bold text-dark mb-2">Deskripsi</h4>
                    <p id="courseModalDescription" class="text-gray-600">Course description goes here...</p>
                </div>
                <div class="flex gap-3">
                    @guest
                    <a href="{{ url('/login') }}"
                        class="flex-1 bg-primary text-white px-4 py-3 rounded-md font-medium hover:bg-yellow-600 transition-colors text-center">
                        Login untuk Mendaftar
                    </a>
                    @else
                    <div id="courseModalActionContainer">
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
            <p class="text-gray-700">Memproses pendaftaran...</p>
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
    <script src="{{ config('midtrans.url') }}" data-client-key="{{ config('midtrans.client_key') }}">
    </script>

    <script>
        // Data courses dari Laravel
        const coursesData = @json($courses->items() ?? []);
        
        // Format price function
        function formatPrice(price) {
            if (typeof price !== 'number') {
                price = parseFloat(price);
                if (isNaN(price)) return 'Rp 0';
            }
            return 'Rp ' + price.toFixed(0).replace(/\B(?=(\d{3})+(?!\d))/g, ".");
        }

        // Filter Functions
        function initializeFilters() {
            const searchInput = document.getElementById('searchInput');
            const sortFilter = document.getElementById('sortFilter');
            const courseCards = document.querySelectorAll('.course-card');
            const noResults = document.getElementById('noResults');
            const coursesContainer = document.getElementById('coursesContainer');

            function filterCourses() {
                const searchTerm = searchInput.value.toLowerCase().trim();
                const sortValue = sortFilter.value;
                
                let visibleCards = [];
                
                courseCards.forEach(card => {
                    const name = card.getAttribute('data-name') || '';
                    const talent = card.getAttribute('data-talent') || '';
                    
                    // Search filter
                    const matchesSearch = searchTerm === '' || 
                                        name.includes(searchTerm) || 
                                        talent.includes(searchTerm);
                    
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
                    coursesContainer.classList.add('hidden');
                } else {
                    noResults.classList.add('hidden');
                    coursesContainer.classList.remove('hidden');
                    
                    // Sort courses
                    sortCourses(visibleCards, sortValue);
                }
            }

            function sortCourses(cards, sortBy) {
                const container = document.getElementById('coursesContainer');
                
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
                searchTimeout = setTimeout(filterCourses, 300);
            });
            
            sortFilter.addEventListener('change', filterCourses);
            
            // Initialize filters
            filterCourses();
        }

        // Course Modal Functions
        function openCourseModal(courseId) {
            const course = coursesData.find(c => c.id === courseId);
            
            if (!course) {
                showNotification('error', 'Error', 'Course tidak ditemukan');
                return;
            }
            
            document.getElementById('courseModalTitle').textContent = course.name || 'Tidak tersedia';
            document.getElementById('courseModalTalent').textContent = course.talent ? course.talent.name : 'Tidak tersedia';
            document.getElementById('courseModalQuota').textContent = `${course.quota || 0} Peserta`;
            document.getElementById('courseModalRemainingQuota').textContent = `${course.remaining_quota || 0}`;
            document.getElementById('courseModalPrice').textContent = course.price_formatted || formatPrice(course.price);
            document.getElementById('courseModalDescription').textContent = course.description || 'Tidak ada deskripsi';
            
            const courseImage = document.getElementById('courseModalImage');
            if (course.thumbnail) {
                courseImage.src = `/storage/${course.thumbnail}`;
            } else {
                courseImage.src = 'https://placehold.co/600x400';
            }
            
            const actionContainer = document.getElementById('courseModalActionContainer');
            if (actionContainer) {
                actionContainer.innerHTML = '';
            
                if (course.is_purchased) {
                    const viewRegistrationBtn = document.createElement('a');
                    viewRegistrationBtn.href = `/user/registrations/${course.registration_id}`;
                    viewRegistrationBtn.className = 'flex-1 bg-green-600 text-white px-4 py-3 rounded-md font-medium hover:bg-green-700 transition-colors text-center';
                    viewRegistrationBtn.textContent = 'Lihat Registrasi';
                    actionContainer.appendChild(viewRegistrationBtn);
                } else if (course.remaining_quota <= 0) {
                    const soldOutBtn = document.createElement('button');
                    soldOutBtn.className = 'flex-1 bg-gray-400 text-white px-4 py-3 rounded-md font-medium cursor-not-allowed';
                    soldOutBtn.textContent = 'Kuota Habis';
                    soldOutBtn.disabled = true;
                    actionContainer.appendChild(soldOutBtn);
                } else {
                    const registerBtn = document.createElement('button');
                    registerBtn.className = 'flex-1 bg-primary text-white px-4 py-3 rounded-md font-medium hover:bg-yellow-600 transition-colors';
                    registerBtn.textContent = 'Daftar Course';
                    registerBtn.setAttribute('onclick', `buyCourse(${courseId})`);
                    actionContainer.appendChild(registerBtn);
                }
            }
            
            document.getElementById('courseModal').classList.remove('hidden');
        }

        function closeCourseModal() {
            document.getElementById('courseModal').classList.add('hidden');
        }

        // Buy Course Function
        async function buyCourse(courseId) {
            // Cek kuota terlebih dahulu
            const course = coursesData.find(c => c.id === courseId);
            if (course && course.remaining_quota <= 0) {
                showNotification('error', 'Kuota Habis', 'Maaf, kuota untuk course ini sudah habis.');
                return;
            }

            document.getElementById('loadingSpinner').classList.remove('hidden');
            const csrfToken = document.querySelector('meta[name="csrf-token"]').getAttribute('content');
            
            try {
                const createRegistrationResponse = await fetch(`/course/${courseId}/create-registration`, {
                    method: 'POST',
                    headers: {
                        'X-CSRF-TOKEN': csrfToken,
                        'Content-Type': 'application/json',
                        'Accept': 'application/json'
                    }
                });

                const registrationData = await createRegistrationResponse.json();

                // TAMBAHKAN PENANGANAN REDIRECT DI SINI
                if (!registrationData.success) {
                    // Cek jika ada redirect_url (whatsapp_number NULL)
                    if (registrationData.redirect_url) {
                        document.getElementById('loadingSpinner').classList.add('hidden');
                        showNotification('error', 'Data Belum Lengkap', registrationData.error || 'Silakan lengkapi profil Anda terlebih dahulu.');
                        
                        // Redirect ke halaman profile setelah 3 detik
                        setTimeout(() => {
                            window.location.href = registrationData.redirect_url;
                        }, 3000);
                        return;
                    }
                    throw new Error(registrationData.error || 'Gagal membuat registrasi');
                }

                const paymentResponse = await fetch('{{ route("payment.snap-token") }}', {
                    method: 'POST',
                    headers: {
                        'X-CSRF-TOKEN': csrfToken,
                        'Content-Type': 'application/json',
                        'Accept': 'application/json'
                    },
                    body: JSON.stringify({
                        type: 'registration',
                        item_id: registrationData.registration_id
                    })
                });

                const paymentData = await paymentResponse.json();
                document.getElementById('loadingSpinner').classList.add('hidden');
                
                if (paymentData.success && paymentData.snap_token) {
                    snap.pay(paymentData.snap_token, {
                        onSuccess: function(result) {
                            handlePaymentSuccess(result.order_id, csrfToken, 'course');
                        },
                        onPending: function(result) {
                            showNotification('info', 'Pembayaran Pending', 'Silakan lanjutkan pembayaran Anda');
                            setTimeout(() => {
                                window.location.href = '{{ route("user.registrations.index") }}';
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
                showNotification('error', 'Error', error.message || 'Terjadi kesalahan saat memproses pendaftaran.');
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
                    showNotification('success', 'Pembayaran Berhasil', 'Registrasi course Anda telah aktif!');
                } else {
                    showNotification('info', 'Pembayaran Berhasil', 'Status registrasi sedang diproses. Cek riwayat pendaftaran.');
                }
            } catch (syncError) {
                console.error('Sync Error:', syncError);
                showNotification('success', 'Pembayaran Berhasil', 'Registrasi course Anda telah aktif!');
            } finally {
                setTimeout(() => {
                    window.location.href = '{{ route("user.registrations.index") }}';
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
            const courseModal = document.getElementById('courseModal');
            if (event.target == courseModal) {
                courseModal.classList.add('hidden');
            }
        }

        // Initialize filters when page loads
        document.addEventListener('DOMContentLoaded', function() {
            initializeFilters();
        });
    </script>
</body>

</html>