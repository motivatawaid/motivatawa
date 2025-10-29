<!-- Footer -->
<footer id="contact" class="bg-dark text-white py-16">
    <div class="container mx-auto px-4">
        <div
            class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-8 mb-12 justify-items-start md:justify-items-center">
            <div>
                <h3 class="text-xl font-bold mb-6 pb-2 border-b-2 border-primary inline-block">Tentang Motivatawa</h3>
                <h4 class="text-lg font-semibold text-primary mb-3">Motivasi untuk Inspirasi dan Tawa Adalah Senjata
                </h4>
                <p class="text-gray-300 mb-4 italic">
                    Hidup kadang serius banget, sampai lupa ketawa. Di sini, kamu nggak cuma dapat motivasi, tapi juga
                    alasan buat senyum lagi
                </p>
                <div class="flex space-x-4">
                    <a href="https://facebook.com" target="_blank" rel="noopener noreferrer"
                        class="bg-gray-800 w-10 h-10 rounded-md flex items-center justify-center hover:bg-primary transition-colors">
                        <i class="fab fa-facebook-f"></i>
                    </a>
                    <a href="https://twitter.com" target="_blank" rel="noopener noreferrer"
                        class="bg-gray-800 w-10 h-10 rounded-md flex items-center justify-center hover:bg-primary transition-colors">
                        <i class="fab fa-twitter"></i>
                    </a>
                    <a href="https://instagram.com/motivatawa.id" target="_blank" rel="noopener noreferrer"
                        class="bg-gray-800 w-10 h-10 rounded-md flex items-center justify-center hover:bg-primary transition-colors">
                        <i class="fab fa-instagram"></i>
                    </a>
                    <a href="https://linkedin.com" target="_blank" rel="noopener noreferrer"
                        class="bg-gray-800 w-10 h-10 rounded-md flex items-center justify-center hover:bg-primary transition-colors">
                        <i class="fab fa-linkedin-in"></i>
                    </a>
                </div>
            </div>
            <div>
                <h3 class="text-xl font-bold mb-6 pb-2 border-b-2 border-primary inline-block">Fitur</h3>
                <ul class="space-y-3">
                    <li><a href="{{ url('/all-event') }}"
                            class="text-gray-300 hover:text-primary transition-colors">Pembelian Tiket
                            Online</a></li>
                    <li><a href="{{ url('/all-video') }}"
                            class="text-gray-300 hover:text-primary transition-colors">Video
                            Pembelajaran</a></li>
                    <li><a href="{{ url('/dashboard') }}"
                            class="text-gray-300 hover:text-primary transition-colors">Riwayat
                            Pembelian</a></li>
                </ul>
            </div>
            <div>
                <h3 class="text-xl font-bold mb-6 pb-2 border-b-2 border-primary inline-block">Hubungi Kami</h3>
                <ul class="space-y-4">
                    <li class="flex items-start">
                        <i class="fas fa-map-marker-alt text-primary mt-1 mr-3"></i>
                        <span class="text-gray-300">Jawa Barat, Indonesia</span>
                    </li>
                    <li class="flex items-center">
                        <i class="fas fa-phone text-primary mr-3"></i>
                        <span class="text-gray-300">+62 859-6035-8633</span>
                    </li>
                    <li class="flex items-center">
                        <i class="fas fa-envelope text-primary mr-3"></i>
                        <span class="text-gray-300">motivatawaid@gmail.com</span>
                    </li>
                </ul>
            </div>
        </div>
        <div class="border-t border-gray-800 pt-8 text-center text-gray-400">
            <p>&copy; {{ date('Y') }} Motivatawa.id. All Rights Reserved.</p>
        </div>
    </div>
</footer>