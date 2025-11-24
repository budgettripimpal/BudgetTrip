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

  <section class="bg-[#FFFBF0] pt-32 pb-0 min-h-[85vh] flex items-center overflow-hidden relative">
    
    <div class="absolute top-[-10%] right-[-5%] w-[600px] h-[600px] bg-[#FFDF67] rounded-full mix-blend-multiply filter blur-[100px] opacity-100 pointer-events-none"></div>

    <div class="absolute bottom-[-20%] left-[-5%] w-[600px] h-[600px] bg-[#FFDF67] rounded-full mix-blend-multiply filter blur-[100px] opacity-100 pointer-events-none"></div>

    <div class="container mx-auto px-6 max-w-7xl relative z-10 mb-16">
        
        <div class="flex flex-col-reverse lg:flex-row items-center justify-between gap-12">
            
            <div class="w-full lg:w-5/12 space-y-6 text-center lg:text-left z-20">
                
                <h1 class="text-5xl md:text-6xl lg:text-7xl font-black text-[#181E4B] leading-[1.1] tracking-tighter">
                    Travel smart. <br>
                    Save more. <br>
                    Experience <br> better.
                </h1>

                <p class="text-[#5E6282] font-medium text-base lg:text-lg leading-relaxed max-w-lg mx-auto lg:mx-0">
                    Setiap perjalanan punya cerita, dan Budget Trip memastikan ceritamu dimulai dengan perencanaan yang cerdas. Dari destinasi impian hingga rincian biaya, semuanya bisa kamu atur dalam satu aplikasi hemat perjalanan ini.✨
                </p>

                <div class="flex flex-col items-center lg:items-start space-y-5 pt-4">
                    <a href="{{ route('travel-plan.create') }}" class="px-10 py-4 bg-[#2CB38B] text-white font-bold text-lg rounded-full shadow-lg shadow-green-200 hover:bg-[#249372] transition transform hover:-translate-y-1 w-full md:w-auto min-w-[240px] text-center">
                        Buat Rencana Sekarang!
                    </a>
                    
                    <div class="space-y-2 w-full md:w-auto">
                        <p class="text-gray-400 font-semibold text-sm pl-2 hidden lg:block">
                            Sudah Memiliki Rencana?
                        </p>
                        <p class="text-gray-400 font-semibold text-sm lg:hidden">
                            Sudah Memiliki Rencana?
                        </p>

                        <a href="#" class="block px-10 py-4 bg-[#2CB38B] text-white font-bold text-lg rounded-full shadow-lg shadow-green-200 hover:bg-[#249372] transition transform hover:-translate-y-1 w-full md:w-auto min-w-[240px] text-center">
                            Lihat Rencana Sekarang!
                        </a>
                    </div>
                </div>
            </div>

            <div class="w-full lg:w-7/12 relative flex justify-center lg:justify-end">
                <img src="{{ asset('images/dashboard-hero.png') }}" 
                     alt="Travel Couple" 
                     class="w-full max-w-4xl lg:max-w-[140%] object-contain drop-shadow-2xl relative z-10 transform lg:translate-x-10 lg:scale-110 origin-bottom">
            </div>

        </div>
    </div>

    <div class="absolute bottom-0 left-0 w-full h-22 md:h-28 bg-gradient-to-b from-transparent to-white z-10 pointer-events-none"></div>
    
</section>

    <section id="about" class="py-20 bg-white scroll-mt-32">
        <div class="container mx-auto px-6">
            <div class="grid md:grid-cols-2 gap-16 items-center">
                
                <div class="flex justify-center">
                    <div class="bg-white rounded-[60px] shadow-2xl p-6 border border-gray-50 transform hover:scale-105 transition duration-300 flex items-center justify-center aspect-square w-full max-w-lg relative overflow-hidden">
                        <div class="absolute top-0 right-0 w-40 h-40 bg-green-50 rounded-full blur-3xl opacity-60"></div>
                        <div class="absolute bottom-0 left-0 w-40 h-40 bg-blue-50 rounded-full blur-3xl opacity-60"></div>

                        <div class="relative z-10 w-[400px] h-[400px] bg-white border-[10px] border-green-50/30 rounded-full flex items-center justify-center shadow-[inset_0_4px_20px_rgba(0,0,0,0.03)] p-4">
                            <img src="{{ asset('images/budgettrip-logo.png') }}" 
                                 alt="BudgetTrip Logo" 
                                 class="w-full h-full object-contain drop-shadow-md">
                        </div>
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

    <!-- Ganti section tutorial yang lama dengan yang ini -->
<section id="tutorial" class="py-20 bg-white relative overflow-hidden scroll-mt-32">
    
    <!-- Top gradient overlay -->
    <div class="absolute top-0 left-0 w-full h-40 bg-gradient-to-b from-white via-white/80 to-transparent z-10 pointer-events-none"></div>
    
    <!-- Bottom gradient overlay -->
    <div class="absolute bottom-0 left-0 w-full h-40 bg-gradient-to-t from-white via-white/80 to-transparent z-10 pointer-events-none"></div>

    <!-- Background decorative blobs -->
    <div class="absolute top-[-10%] right-[-5%] w-[600px] h-[600px] bg-[#2CB38B] rounded-full mix-blend-multiply filter blur-[100px] opacity-40 pointer-events-none animate-pulse"></div>
    <div class="absolute top-0 left-[-10%] w-[600px] h-[600px] bg-[#2CB38B] rounded-full mix-blend-multiply filter blur-3xl opacity-20 -z-10 animate-blob"></div>
    <div class="absolute bottom-0 right-[-10%] w-[600px] h-[600px] bg-[#2CB38B] rounded-full mix-blend-multiply filter blur-3xl opacity-20 -z-10 animate-blob animation-delay-2000"></div>
    <div class="absolute top-1/2 left-1/2 -translate-x-1/2 -translate-y-1/2 w-[400px] h-[400px] bg-green-100 rounded-full mix-blend-multiply filter blur-3xl opacity-40 -z-10"></div>

    <div class="max-w-7xl mx-auto px-6 relative z-10">
        
        <div class="text-center mb-16 fade-in-up delay-100">
            <h2 class="text-4xl md:text-5xl font-extrabold text-[#181E4B] mb-3 tracking-tight">
                Make Your Own Trip
            </h2>
            <p class="text-3xl font-bold text-[#2CB38B]">
                In 5 Easy Ways!
            </p>
        </div>

        <div class="grid grid-cols-1 sm:grid-cols-2 lg:grid-cols-5 gap-6">
            
            <!-- Step 1 -->
            <div class="bg-white rounded-[40px] p-8 shadow-[0_10px_40px_-10px_rgba(0,0,0,0.08)] border border-gray-100 hover:shadow-[0_20px_50px_-10px_rgba(44,179,139,0.2)] hover:border-[#2CB38B]/30 hover:-translate-y-2 transition-all duration-300 flex flex-col items-center text-center group fade-in-up delay-100 h-full relative overflow-hidden">
                <div class="w-16 h-16 bg-[#2CB38B] rounded-full flex items-center justify-center mb-2 shadow-md border-2 border-[#2CB38B] group-hover:scale-110 transition-transform">
                    <svg class="w-8 h-8 text-white" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 8c-1.657 0-3 .895-3 2s1.343 2 3 2 3 .895 3 2-1.343 2-3 2m0-8c1.11 0 2.08.402 2.599 1M12 8V7m0 1v8m0 0v1m0-1c-1.11 0-2.08-.402-2.599-1M21 12a9 9 0 11-18 0 9 9 0 0118 0z"/>
                    </svg>
                </div>
                <h3 class="text-lg font-bold text-[#181E4B] mb-3">Menentukan Budget</h3>
                <p class="text-gray-500 text-sm leading-relaxed">
                    Input jumlah uang yang ingin Anda habiskan.
                </p>
            </div>

            <!-- Step 2 -->
            <div class="bg-white rounded-[40px] p-8 shadow-[0_10px_40px_-10px_rgba(0,0,0,0.08)] border border-gray-100 hover:shadow-[0_20px_50px_-10px_rgba(44,179,139,0.2)] hover:border-[#2CB38B]/30 hover:-translate-y-2 transition-all duration-300 flex flex-col items-center text-center group fade-in-up delay-200 h-full relative overflow-hidden">
                <div class="w-16 h-16 bg-[#2CB38B] rounded-full flex items-center justify-center mb-2 shadow-md border-2 border-[#2CB38B] group-hover:scale-110 transition-transform">
                    <svg class="w-8 h-8 text-white" fill="currentColor" viewBox="0 0 24 24">
                        <path d="M18 20H6c-1.1 0-2-.9-2-2V6c0-2.2 1.8-4 4-4h8c2.2 0 4 1.8 4 4v12c0 1.1-.9 2-2 2zm-2-3c1.1 0 2-.9 2-2s-.9-2-2-2-2 .9-2 2 .9 2 2 2zm-8 0c1.1 0 2-.9 2-2s-.9-2-2-2-2 .9-2 2 .9 2 2 2zm0-9h8V4H8v4z"/>
                    </svg>
                </div>
                <h3 class="text-lg font-bold text-[#181E4B] mb-3">Pilih Transportasi</h3>
                <p class="text-gray-500 text-sm leading-relaxed">
                    Pilih travel, bus, atau kereta terbaik.
                </p>
            </div>

            <!-- Step 3 -->
            <div class="bg-white rounded-[40px] p-8 shadow-[0_10px_40px_-10px_rgba(0,0,0,0.08)] border border-gray-100 hover:shadow-[0_20px_50px_-10px_rgba(44,179,139,0.2)] hover:border-[#2CB38B]/30 hover:-translate-y-2 transition-all duration-300 flex flex-col items-center text-center group fade-in-up delay-300 h-full relative overflow-hidden">
                <div class="w-16 h-16 bg-[#2CB38B] rounded-full flex items-center justify-center mb-2 shadow-md border-2 border-[#2CB38B] group-hover:scale-110 transition-transform">
                    <svg class="w-8 h-8 text-white" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M3 12l2-2m0 0l7-7 7 7M5 10v10a1 1 0 001 1h3m10-11l2 2m-2-2v10a1 1 0 01-1 1h-3m-6 0a1 1 0 001-1v-4a1 1 0 011-1h2a1 1 0 011 1v4a1 1 0 001 1m-6 0h6"/>
                    </svg>
                </div>
                <h3 class="text-lg font-bold text-[#181E4B] mb-3">Pilih Akomodasi</h3>
                <p class="text-gray-500 text-sm leading-relaxed">
                    Cari penginapan nyaman sesuai budget.
                </p>
            </div>

            <!-- Step 4 -->
            <div class="bg-white rounded-[40px] p-8 shadow-[0_10px_40px_-10px_rgba(0,0,0,0.08)] border border-gray-100 hover:shadow-[0_20px_50px_-10px_rgba(44,179,139,0.2)] hover:border-[#2CB38B]/30 hover:-translate-y-2 transition-all duration-300 flex flex-col items-center text-center group fade-in-up delay-100 h-full relative overflow-hidden">
                <div class="w-16 h-16 bg-[#2CB38B] rounded-full flex items-center justify-center mb-2 shadow-md border-2 border-[#2CB38B] group-hover:scale-110 transition-transform">
                    <svg class="w-8 h-8 text-white" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M17.657 16.657L13.414 20.9a1.998 1.998 0 01-2.827 0l-4.244-4.243a8 8 0 1111.314 0z"/>
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 11a3 3 0 11-6 0 3 3 0 016 0z"/>
                    </svg>
                </div>
                <h3 class="text-lg font-bold text-[#181E4B] mb-3">Pilih Wisata</h3>
                <p class="text-gray-500 text-sm leading-relaxed">
                    Tambahkan destinasi seru ke itinerary.
                </p>
            </div>

            <!-- Step 5 -->
            <div class="bg-white rounded-[40px] p-8 shadow-[0_10px_40px_-10px_rgba(0,0,0,0.08)] border border-gray-100 hover:shadow-[0_20px_50px_-10px_rgba(44,179,139,0.2)] hover:border-[#2CB38B]/30 hover:-translate-y-2 transition-all duration-300 flex flex-col items-center text-center group fade-in-up delay-200 h-full relative overflow-hidden">
                <div class="w-16 h-16 bg-[#2CB38B] rounded-full flex items-center justify-center mb-2 shadow-md border-2 border-[#2CB38B] group-hover:scale-110 transition-transform">
                    <svg class="w-8 h-8 text-white" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 12h6m-6 4h6m2 5H7a2 2 0 01-2-2V5a2 2 0 012-2h5.586a1 1 0 01.707.293l5.414 5.414a1 1 0 01.293.707V19a2 2 0 01-2 2z"/>
                    </svg>
                </div>
                <h3 class="text-lg font-bold text-[#181E4B] mb-3">Simpan Rencana</h3>
                <p class="text-gray-500 text-sm leading-relaxed">
                    Simpan dan mulai perjalananmu!
                </p>
            </div>

        </div>
    </div>
</section>

   <section id="testimonials" class="py-20 bg-white relative scroll-mt-32">
        <div class="container mx-auto px-6">
            
            <div class="text-center mb-16">
                <p class="text-gray-500 font-bold uppercase tracking-widest mb-2">Testimonials</p>
                <h2 class="text-4xl font-bold text-[#181E4B]">What People Says About Us.</h2>
            </div>

            <div class="grid grid-cols-1 md:grid-cols-3 gap-8 max-w-7xl mx-auto">
                
                <div class="bg-gray-50 rounded-[40px] p-10 border border-gray-100 shadow-lg relative hover:-translate-y-2 transition-transform duration-300">
                    <div class="absolute top-6 left-8 text-6xl text-[#2CB38B] opacity-20 font-serif">“</div>
                    
                    <p class="text-gray-600 leading-relaxed italic mb-8 relative z-10 pt-4">
                        "Budget Trip benar-benar ngebantu aku yang sering bingung soal biaya liburan. Fiturnya simple, estimasinya akurat, dan rekomendasinya pas banget sama budget-ku!"
                    </p>
                    
                    <div class="flex items-center gap-4">
                        <div class="w-12 h-12 bg-gray-300 rounded-full overflow-hidden border-2 border-white shadow-sm">
                            <img src="https://i.pravatar.cc/150?img=32" class="w-full h-full object-cover">
                        </div>
                        <div>
                            <p class="text-[#181E4B] font-bold text-lg">Sarah J.</p>
                            <p class="text-[#2CB38B] text-sm font-medium">Travel Enthusiast</p>
                        </div>
                    </div>
                </div>

                <div class="bg-white rounded-[40px] p-10 border border-gray-100 shadow-xl relative transform md:-translate-y-4 hover:-translate-y-6 transition-transform duration-300 z-10">
                    <div class="absolute top-6 left-8 text-6xl text-[#2CB38B] opacity-20 font-serif">“</div>
                    
                    <p class="text-gray-600 leading-relaxed italic mb-8 relative z-10 pt-4">
                        "Aplikasi terbaik untuk backpacker! Saya bisa keliling Jogja dan Bali dengan budget minim tapi tetap dapat penginapan yang nyaman. Sangat direkomendasikan!"
                    </p>
                    
                    <div class="flex items-center gap-4">
                        <div class="w-12 h-12 bg-gray-300 rounded-full overflow-hidden border-2 border-white shadow-sm">
                            <img src="https://i.pravatar.cc/150?img=11" class="w-full h-full object-cover">
                        </div>
                        <div>
                            <p class="text-[#181E4B] font-bold text-lg">Raka Aditya</p>
                            <p class="text-[#2CB38B] text-sm font-medium">Backpacker</p>
                        </div>
                    </div>
                </div>

                <div class="bg-gray-50 rounded-[40px] p-10 border border-gray-100 shadow-lg relative hover:-translate-y-2 transition-transform duration-300">
                    <div class="absolute top-6 left-8 text-6xl text-[#2CB38B] opacity-20 font-serif">“</div>
                    
                    <p class="text-gray-600 leading-relaxed italic mb-8 relative z-10 pt-4">
                        "Fitur penyusunan itinerary-nya juara. Saya tidak perlu repot riset satu-satu, Budget Trip sudah menyusunkan rute wisata yang efisien dan hemat waktu."
                    </p>
                    
                    <div class="flex items-center gap-4">
                        <div class="w-12 h-12 bg-gray-300 rounded-full overflow-hidden border-2 border-white shadow-sm">
                            <img src="https://i.pravatar.cc/150?img=5" class="w-full h-full object-cover">
                        </div>
                        <div>
                            <p class="text-[#181E4B] font-bold text-lg">Amanda P.</p>
                            <p class="text-[#2CB38B] text-sm font-medium">Lifestyle Blogger</p>
                        </div>
                    </div>
                </div>

            </div>
        </div>
    </section>

    <footer id="contact" class="bg-white border-t border-gray-200 py-16 scroll-mt-32">
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
                            <span class="bg-green-50 p-2 rounded-full text-[#2CB38B]">✉</span>
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
                <p>&copy; 2025 Budget Trip. All rights reserved.</p>
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