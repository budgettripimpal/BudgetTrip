<x-app-layout>
    @push('styles')
    <link href="https://fonts.googleapis.com/css2?family=Plus+Jakarta+Sans:wght@400;500;600;700;800&display=swap" rel="stylesheet">
    <style>
        body { font-family: 'Plus Jakarta Sans', sans-serif; }
        
        .text-primary { color: #2CB38B; }
        .bg-primary { background-color: #2CB38B; }
        .border-primary { border-color: #2CB38B; }
        
        /* Hover States */
        .hover\:text-primary:hover { color: #2CB38B; }
        .hover\:bg-primary:hover { background-color: #2CB38B; }
        .hover\:bg-green-600:hover { background-color: #249372; } 
    </style>
    @endpush

    <nav class="bg-white shadow-sm fixed w-full top-0 z-50">
        <div class="container mx-auto px-6 py-4">
            <div class="flex items-center justify-between">
                <div class="flex items-center space-x-3">
                    <img src="{{ asset('images/budgettrip-logo.png') }}" alt="BudgetTrip Logo" class="w-10 h-10 object-contain">
                    
                    <span class="text-2xl font-bold tracking-tight">
                        <span class="text-gray-900">BUDGET</span><span class="text-[#2CB38B]">TRIP</span>
                    </span>
                </div>
                
                <div class="hidden md:flex items-center space-x-8">
                    <a href="#" class="text-gray-900 hover:text-[#2CB38B] font-bold transition">Home</a>
                    <a href="#about" class="text-gray-600 hover:text-[#2CB38B] transition">About</a>
                    <a href="#tutorial" class="text-gray-600 hover:text-[#2CB38B] transition">Tutorial</a>
                    <a href="#testimonials" class="text-gray-600 hover:text-[#2CB38B] transition">Testimonials</a>
                    <a href="#contact" class="text-gray-600 hover:text-[#2CB38B] transition">Contact Us</a>
                </div>

                <div class="flex items-center space-x-4 relative group">
                    <span class="text-gray-600 hidden md:inline font-medium">Welcome, {{ Auth::user()->name }}</span>
                    <div class="w-10 h-10 bg-[#2CB38B] rounded-full flex items-center justify-center cursor-pointer shadow-md text-white font-bold text-lg transition transform group-hover:scale-105">
                        {{ substr(Auth::user()->name, 0, 1) }}
                    </div>
                    
                    <div class="absolute top-10 right-0 w-48 bg-white rounded-xl shadow-xl py-2 hidden group-hover:block border border-gray-100 animate-fade-in-down">
                        <form method="POST" action="{{ route('logout') }}">
                            @csrf
                            <a href="{{ route('logout') }}" onclick="event.preventDefault(); this.closest('form').submit();" class="block px-4 py-2 text-sm text-gray-700 hover:bg-green-50 hover:text-[#2CB38B] transition rounded-md mx-2">
                                Log Out
                            </a>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </nav>

    <section class="bg-gradient-to-br from-yellow-100 via-yellow-50 to-white pt-32 pb-16 mt-[-4rem]">
        <div class="container mx-auto px-6">
            <div class="grid md:grid-cols-2 gap-12 items-center">
                <div>
                    <h1 class="text-5xl md:text-6xl font-bold text-blue-900 leading-tight mb-6">
                        Travel smart.<br>
                        Save more.<br>
                        Experience better.
                    </h1>
                    <p class="text-gray-600 mb-8 leading-relaxed text-lg text-justify">
                        Setiap perjalanan punya cerita, dan Budget Trip memastikan ceritamu dimulai dengan perencanaan yang cerdas. Dari destinasi impian hingga rincian biaya, semuanya bisa kamu atur dalam satu aplikasi hemat perjalanan ini.✨
                    </p>
                    <div class="space-y-4 flex flex-col items-start">
                        <a href="{{ route('travel-plan.create') }}" class="bg-[#2CB38B] text-white px-8 py-4 rounded-full font-semibold transition duration-300 shadow-lg hover:shadow-xl hover:bg-[#249372] hover:-translate-y-1 inline-flex items-center gap-2">
                            <span>Buat Rencana Sekarang!</span>
                            <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M14 5l7 7m0 0l-7 7m7-7H3"></path></svg>
                        </a>
                        
                        <div class="flex flex-col gap-2">
                            <button class="text-[#2CB38B] font-medium underline hover:text-green-700 text-left transition">
                                Sudah Memiliki Rencana?
                            </button>
                            <button class="border-2 border-[#2CB38B] text-[#2CB38B] px-8 py-3 rounded-full font-semibold hover:bg-green-50 transition duration-300">
                                Lihat Rencana Sekarang!
                            </button>
                        </div>
                    </div>
                </div>
                
                <div class="relative">
                    <div class="absolute top-8 right-8 bg-white px-5 py-3 rounded-full shadow-lg flex items-center space-x-3 z-10 animate-bounce" style="animation-duration: 3s;">
                        <svg class="w-6 h-6 text-yellow-400" fill="currentColor" viewBox="0 0 24 24">
                            <path d="M12 2C8.13 2 5 5.13 5 9c0 5.25 7 13 7 13s7-7.75 7-13c0-3.87-3.13-7-7-7z"/>
                        </svg>
                        <div>
                            <p class="text-xs text-gray-400 font-bold uppercase">Destinasi</p>
                            <span class="font-bold text-gray-800">Kuta, Bali</span>
                        </div>
                    </div>
                    <div class="rounded-3xl shadow-2xl overflow-hidden border-[6px] border-white transform rotate-2 hover:rotate-0 transition duration-500">
                        <img src="https://images.unsplash.com/photo-1539635278303-d4002c07eae3?ixlib=rb-4.0.3&auto=format&fit=crop&w=800&q=80" alt="Travelers" class="w-full h-[500px] object-cover">
                    </div>
                    
                    <div class="absolute bottom-8 right-8 bg-white p-4 rounded-2xl shadow-lg z-10">
                        <svg class="w-8 h-8 text-[#2CB38B]" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M3 9a2 2 0 012-2h.93a2 2 0 001.664-.89l.812-1.22A2 2 0 0110.07 4h3.86a2 2 0 011.664.89l.812 1.22A2 2 0 0018.07 7H19a2 2 0 012 2v9a2 2 0 01-2 2H5a2 2 0 01-2-2V9z"/>
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 13a3 3 0 11-6 0 3 3 0 016 0z"/>
                        </svg>
                    </div>
                </div>
            </div>
        </div>
    </section>

    <section id="about" class="py-20 bg-white">
        <div class="container mx-auto px-6">
            <div class="grid md:grid-cols-2 gap-16 items-center">
                <div class="flex justify-center">
                    <div class="bg-white rounded-[40px] shadow-xl p-12 text-center border border-gray-50 transform hover:scale-105 transition duration-300 w-full max-w-md">
                        <div class="mb-8">
                            <div class="w-32 h-32 bg-white border-4 border-green-50 rounded-full mx-auto flex items-center justify-center shadow-inner p-4">
                                <img src="{{ asset('images/budgettrip-logo.png') }}" alt="BudgetTrip Logo" class="w-full h-full object-contain">
                            </div>
                        </div>
                        <h3 class="text-4xl font-extrabold text-gray-900 mb-2">BUDGET<br><span class="text-[#2CB38B]">TRIP</span></h3>
                        <div class="h-1 w-20 bg-[#2CB38B] mx-auto rounded-full my-4"></div>
                        <p class="text-gray-500 font-medium">Start your journey with us</p>
                    </div>
                </div>

                <div>
                    <h2 class="text-4xl font-bold text-blue-900 mb-6">Why Budget Trip Exists?</h2>
                    <p class="text-gray-600 leading-relaxed mb-8 text-justify text-lg">
                        Kami percaya bahwa setiap orang berhak merasakan pengalaman perjalanan tanpa harus khawatir soal biaya. Karena itu, Budget Trip hadir sebagai teman perencanaan perjalananmu—memberi rekomendasi hemat, tips liburan, dan panduan destinasi yang dinamis khusus sesuai budget. Dengan Budget Trip, kamu bisa fokus menikmati momen. Biarkan bagian rumitnya kami yang urus.
                    </p>
                    
                    <div class="bg-gray-50 p-8 rounded-3xl border border-gray-100">
                        <h3 class="text-xl font-bold text-blue-900 mb-6 flex items-center gap-2">
                            <span class="w-2 h-8 bg-[#2CB38B] rounded-full"></span>
                            Meet Our Teams
                        </h3>
                        <div class="grid grid-cols-4 gap-4">
                            @foreach(['Dani', 'Fajril', 'Haris', 'Damar'] as $name)
                            <div class="text-center group cursor-pointer">
                                <div class="w-16 h-16 bg-[#2CB38B] rounded-full mx-auto mb-3 flex items-center justify-center shadow-md group-hover:scale-110 transition text-white font-bold text-xl border-4 border-white">
                                    {{ substr($name, 0, 1) }}
                                </div>
                                <p class="text-sm text-gray-700 font-bold group-hover:text-[#2CB38B] transition">{{ $name }}</p>
                            </div>
                            @endforeach
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>

    <section id="tutorial" class="py-20 bg-gradient-to-br from-green-50 via-emerald-50 to-white relative overflow-hidden">
        <div class="absolute top-0 left-0 w-full h-full bg-[url('https://www.transparenttextures.com/patterns/cubes.png')] opacity-10 pointer-events-none"></div>

        <div class="container mx-auto px-6 relative z-10">
            <div class="text-center mb-16">
                <h2 class="text-4xl md:text-5xl font-bold text-blue-900 mb-2">Make Your Own Trip</h2>
                <p class="text-3xl font-bold text-[#2CB38B]">In 5 Easy Ways!</p>
            </div>

            <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-8 max-w-6xl mx-auto">
                
                <div class="bg-white rounded-2xl shadow-lg p-8 hover:shadow-2xl hover:-translate-y-2 transition duration-300 border-l-4 border-yellow-400 flex flex-col items-center text-center h-full">
                    <div class="w-16 h-16 bg-yellow-100 rounded-2xl flex items-center justify-center mb-4 text-3xl">
                        💰
                    </div>
                    <h3 class="text-xl font-bold text-blue-900 mb-2">1. Menentukan Budget</h3>
                    <p class="text-gray-500 text-sm">Input jumlah uang yang ingin Anda habiskan.</p>
                </div>

                <div class="bg-white rounded-2xl shadow-lg p-8 hover:shadow-2xl hover:-translate-y-2 transition duration-300 border-l-4 border-[#2CB38B] flex flex-col items-center text-center h-full">
                    <div class="w-16 h-16 bg-green-100 rounded-2xl flex items-center justify-center mb-4 text-3xl text-[#2CB38B]">
                        🚌
                    </div>
                    <h3 class="text-xl font-bold text-blue-900 mb-2">2. Memilih Transportasi</h3>
                    <p class="text-gray-500 text-sm">Pilih travel, bus, atau kereta terbaik.</p>
                </div>

                <div class="bg-white rounded-2xl shadow-lg p-8 hover:shadow-2xl hover:-translate-y-2 transition duration-300 border-l-4 border-blue-500 flex flex-col items-center text-center h-full">
                    <div class="w-16 h-16 bg-blue-100 rounded-2xl flex items-center justify-center mb-4 text-3xl text-blue-600">
                        🏨
                    </div>
                    <h3 class="text-xl font-bold text-blue-900 mb-2">3. Memilih Akomodasi</h3>
                    <p class="text-gray-500 text-sm">Cari penginapan nyaman sesuai budget.</p>
                </div>

                <div class="bg-white rounded-2xl shadow-lg p-8 hover:shadow-2xl hover:-translate-y-2 transition duration-300 border-l-4 border-purple-500 flex flex-col items-center text-center h-full md:ml-auto lg:ml-0">
                    <div class="w-16 h-16 bg-purple-100 rounded-2xl flex items-center justify-center mb-4 text-3xl text-purple-600">
                        🏖️
                    </div>
                    <h3 class="text-xl font-bold text-blue-900 mb-2">4. Memilih Wisata</h3>
                    <p class="text-gray-500 text-sm">Tambahkan destinasi seru ke itinerary.</p>
                </div>

                <div class="bg-white rounded-2xl shadow-lg p-8 hover:shadow-2xl hover:-translate-y-2 transition duration-300 border-l-4 border-red-500 flex flex-col items-center text-center h-full md:mr-auto lg:mr-0 lg:col-start-2">
                    <div class="w-16 h-16 bg-red-100 rounded-2xl flex items-center justify-center mb-4 text-3xl text-red-600">
                        💾
                    </div>
                    <h3 class="text-xl font-bold text-blue-900 mb-2">5. Simpan Rencana</h3>
                    <p class="text-gray-500 text-sm">Simpan dan mulai perjalananmu!</p>
                </div>

            </div>
        </div>
    </section>

    <section id="testimonials" class="py-20 bg-white">
        <div class="container mx-auto px-6">
            <div class="text-center mb-12">
                <p class="text-gray-500 font-bold uppercase tracking-widest mb-2">Testimonials</p>
                <h2 class="text-4xl font-bold text-blue-900">What People Says About Us.</h2>
            </div>

            <div class="max-w-3xl mx-auto relative">
                <div class="absolute -top-8 -left-4 text-8xl text-gray-100 font-serif z-0">“</div>
                
                <div class="bg-gray-50 rounded-[40px] shadow-xl p-10 border border-gray-100 relative z-10">
                    <p class="text-gray-700 text-lg leading-loose italic mb-8">
                        "Budget Trip benar-benar ngebantu aku yang sering bingung soal biaya liburan. Fiturnya simple, estimasi biayanya akurat, dan rekomendasinya pas banget sama budget-ku. Sekarang merencanakan trip jauh lebih mudah dan hemat!"
                    </p>
                    <div class="flex items-center gap-4">
                        <div class="w-12 h-12 bg-gray-300 rounded-full overflow-hidden">
                            <img src="https://i.pravatar.cc/150?img=68" class="w-full h-full object-cover">
                        </div>
                        <div>
                            <p class="text-gray-900 font-bold text-lg">User 1</p>
                            <p class="text-[#2CB38B] text-sm font-medium">Travel Enthusiast</p>
                        </div>
                    </div>
                </div>

                <div class="flex justify-center mt-8 space-x-2">
                    <button class="w-3 h-3 rounded-full bg-[#2CB38B]"></button>
                    <button class="w-3 h-3 rounded-full bg-gray-300 hover:bg-green-200 transition"></button>
                    <button class="w-3 h-3 rounded-full bg-gray-300 hover:bg-green-200 transition"></button>
                </div>
            </div>
        </div>
    </section>

    <footer id="contact" class="bg-white border-t border-gray-200 py-16">
        <div class="container mx-auto px-6">
            <div class="grid md:grid-cols-4 gap-12 mb-12">
                <div class="col-span-1 md:col-span-1">
                    <div class="flex items-center space-x-2 mb-6">
                        <img src="{{ asset('images/budgettrip-logo.png') }}" alt="BudgetTrip Logo" class="w-8 h-8 object-contain">
                        <span class="text-2xl font-bold"><span class="text-gray-800">BUDGET</span><span class="text-[#2CB38B]">TRIP</span></span>
                    </div>
                    <p class="text-gray-500 text-sm leading-relaxed mb-6">
                        Budget Trip adalah teman perencanaan perjalanan hemat Anda. Kami memberikan rekomendasi terbaik sesuai anggaran.
                    </p>
                    <div class="space-y-3 text-sm text-gray-600">
                        <div class="flex items-center gap-3">
                            <span class="bg-green-50 p-2 rounded-full text-[#2CB38B]">📞</span>
                            <span>+62-123-789-xxxx</span>
                        </div>
                        <div class="flex items-center gap-3">
                            <span class="bg-green-50 p-2 rounded-full text-[#2CB38B]">✉️</span>
                            <span>support@budgettrip.com</span>
                        </div>
                        <div class="flex items-center gap-3">
                            <span class="bg-green-50 p-2 rounded-full text-[#2CB38B]">🏢</span>
                            <span>Bandung, Indonesia</span>
                        </div>
                    </div>
                </div>

                <div>
                    <h4 class="font-bold text-blue-900 mb-6">Tentang</h4>
                    <ul class="space-y-4 text-gray-500 text-sm">
                        <li><a href="#" class="hover:text-[#2CB38B] transition">Fitur</a></li>
                        <li><a href="#" class="hover:text-[#2CB38B] transition">Tutorial</a></li>
                        <li><a href="#" class="hover:text-[#2CB38B] transition">Testimoni</a></li>
                    </ul>
                </div>

                <div>
                    <h4 class="font-bold text-blue-900 mb-6">Support</h4>
                    <ul class="space-y-4 text-gray-500 text-sm">
                        <li><a href="#" class="hover:text-[#2CB38B] transition">Contact</a></li>
                        <li><a href="#" class="hover:text-[#2CB38B] transition">About Us</a></li>
                        <li><a href="#" class="hover:text-[#2CB38B] transition">Syarat & Ketentuan</a></li>
                    </ul>
                </div>

                <div>
                    <h4 class="font-bold text-blue-900 mb-6">FAQ</h4>
                    <ul class="space-y-4 text-gray-500 text-sm">
                        <li><a href="#" class="hover:text-[#2CB38B] transition">Pembayaran</a></li>
                        <li><a href="#" class="hover:text-[#2CB38B] transition">Wisata</a></li>
                        <li><a href="#" class="hover:text-[#2CB38B] transition">Transportasi</a></li>
                    </ul>
                </div>
            </div>

            <div class="border-t border-gray-200 pt-8 text-center text-gray-400 text-sm">
                <p>&copy; 2024 Budget Trip. All rights reserved.</p>
            </div>
        </div>
    </footer>

    <script>
        // Smooth scroll
        document.querySelectorAll('a[href^="#"]').forEach(anchor => {
            anchor.addEventListener('click', function (e) {
                e.preventDefault();
                const target = document.querySelector(this.getAttribute('href'));
                if (target) {
                    target.scrollIntoView({ behavior: 'smooth' });
                }
            });
        });
    </script>
</x-app-layout>