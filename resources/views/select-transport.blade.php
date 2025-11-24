<x-app-layout>
    @push('styles')
    <link href="https://fonts.googleapis.com/css2?family=Plus+Jakarta+Sans:wght@400;500;600;700;800&display=swap" rel="stylesheet">
    <style>
        body { font-family: 'Plus Jakarta Sans', sans-serif; }
        .text-primary { color: #2CB38B; }
        .bg-primary { background-color: #2CB38B; }
        .border-primary { border-color: #2CB38B; }
        .ring-primary { --tw-ring-color: #2CB38B; }
        .focus\:ring-primary:focus { --tw-ring-color: #2CB38B; }
        
        /* Checkbox Custom */
        input[type="checkbox"]:checked {
            background-color: #2CB38B;
            border-color: #2CB38B;
        }
        input[type="checkbox"]:focus { --tw-ring-color: #2CB38B; }
        
        /* Smooth Transition */
        .accordion-content { transition: max-height 0.3s ease-out; overflow: hidden; }
    </style>
    @endpush

    <nav class="bg-white shadow-sm fixed w-full top-0 z-50 h-20">
        <div class="container mx-auto px-6 h-full">
            <div class="flex items-center justify-between h-full">
                <div class="flex items-center space-x-2">
                    <svg class="w-8 h-8 text-yellow-400" fill="currentColor" viewBox="0 0 24 24">
                        <path d="M12 2C8.13 2 5 5.13 5 9c0 5.25 7 13 7 13s7-7.75 7-13c0-3.87-3.13-7-7-7zm0 9.5c-1.38 0-2.5-1.12-2.5-2.5s1.12-2.5 2.5-2.5 2.5 1.12 2.5 2.5-1.12 2.5-2.5 2.5z"/>
                    </svg>
                    <span class="text-2xl font-bold tracking-tight">
                        <span class="text-gray-900">BUDGET</span><span class="text-[#2CB38B]">TRIP</span>
                    </span>
                </div>
                <div class="hidden md:flex items-center space-x-8">
                    <a href="{{ route('dashboard') }}" class="text-gray-900 hover:text-[#2CB38B] font-bold transition">Home</a>
                </div>
                <div class="flex items-center space-x-4 relative group">
                    <span class="text-gray-600 hidden md:inline font-medium">Welcome, {{ Auth::user()->name }}</span>
                    <div class="w-10 h-10 bg-[#2CB38B] rounded-full flex items-center justify-center cursor-pointer shadow-md text-white font-bold text-lg">
                        {{ substr(Auth::user()->name, 0, 1) }}
                    </div>
                    <div class="absolute top-10 right-0 w-48 bg-white rounded-xl shadow-xl py-2 hidden group-hover:block border border-gray-100 animate-fade-in-down">
                        <form method="POST" action="{{ route('logout') }}">
                            @csrf
                            <a href="{{ route('logout') }}" onclick="event.preventDefault(); this.closest('form').submit();" class="block px-4 py-2 text-sm text-gray-700 hover:bg-green-50 hover:text-[#2CB38B] transition rounded-md mx-2">Log Out</a>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </nav>

    <div class="min-h-screen bg-gray-50 pb-12 pt-20">
        
        <div class="bg-white shadow-sm py-8 mb-8 sticky top-20 z-40">
            <div class="container mx-auto px-6">
                <div class="flex items-center justify-between max-w-6xl mx-auto">
                    
                    <a href="{{ route('travel-plan.edit', $plan->planID) }}" class="flex items-center flex-1 group cursor-pointer">
                        <div class="flex flex-col items-center relative z-10">
                            <div class="w-16 h-16 bg-[#2CB38B] rounded-full flex items-center justify-center mb-2 shadow-md border-2 border-[#2CB38B] group-hover:scale-110 transition-transform">
                                <svg class="w-8 h-8 text-white" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 8c-1.657 0-3 .895-3 2s1.343 2 3 2 3 .895 3 2-1.343 2-3 2m0-8c1.11 0 2.08.402 2.599 1M12 8V7m0 1v8m0 0v1m0-1c-1.11 0-2.08-.402-2.599-1M21 12a9 9 0 11-18 0 9 9 0 0118 0z"/>
                                </svg>
                            </div>
                            <p class="text-xs font-bold text-[#2CB38B] text-center group-hover:underline">Input Budget &<br>Rencana</p>
                        </div>
                        <div class="w-full h-1 bg-[#2CB38B] mx-2 rounded-full"></div>
                    </a>

                    <div class="flex items-center flex-1">
                        <div class="flex flex-col items-center relative z-10">
                            <div class="w-16 h-16 bg-[#2CB38B] rounded-full flex items-center justify-center mb-2 shadow-lg ring-4 ring-green-100 transform scale-110">
                                <svg class="w-8 h-8 text-white" fill="currentColor" viewBox="0 0 24 24">
                                    <path d="M18 20H6c-1.1 0-2-.9-2-2V6c0-2.2 1.8-4 4-4h8c2.2 0 4 1.8 4 4v12c0 1.1-.9 2-2 2zm-2-3c1.1 0 2-.9 2-2s-.9-2-2-2-2 .9-2 2 .9 2 2 2zm-8 0c1.1 0 2-.9 2-2s-.9-2-2-2-2 .9-2 2 .9 2 2 2zm0-9h8V4H8v4z"/>
                                </svg>
                            </div>
                            <p class="text-xs font-bold text-[#2CB38B] text-center">Pilih<br>Transportasi</p>
                        </div>
                        <div class="w-full h-1 bg-gray-200 mx-2 rounded-full"></div>
                    </div>

                    <a href="{{ route('travel-plan.accommodation', $plan->planID) }}" class="flex items-center flex-1 group cursor-pointer">
                        <div class="flex flex-col items-center relative z-10">
                            <div class="w-16 h-16 bg-gray-200 rounded-full flex items-center justify-center mb-2 transition-all duration-300 group-hover:bg-green-100 group-hover:text-[#2CB38B] group-hover:scale-110 group-hover:shadow-md">
                                <svg class="w-8 h-8 text-gray-400 group-hover:text-[#2CB38B]" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M3 12l2-2m0 0l7-7 7 7M5 10v10a1 1 0 001 1h3m10-11l2 2m-2-2v10a1 1 0 01-1 1h-3m-6 0a1 1 0 001-1v-4a1 1 0 011-1h2a1 1 0 011 1v4a1 1 0 001 1m-6 0h6"/>
                                </svg>
                            </div>
                            <p class="text-xs font-semibold text-gray-400 text-center group-hover:text-[#2CB38B] group-hover:underline">Pilih<br>Akomodasi</p>
                        </div>
                        <div class="w-full h-1 bg-gray-200 mx-2 rounded-full"></div>
                    </a>

                    <a href="{{ route('travel-plan.attraction', $plan->planID) }}" class="flex items-center flex-1 group cursor-pointer">
                        <div class="flex flex-col items-center relative z-10">
                            <div class="w-16 h-16 bg-gray-200 rounded-full flex items-center justify-center mb-2 transition-all duration-300 group-hover:bg-green-100 group-hover:text-[#2CB38B] group-hover:scale-110 group-hover:shadow-md">
                                <svg class="w-8 h-8 text-gray-400 group-hover:text-[#2CB38B]" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M17.657 16.657L13.414 20.9a1.998 1.998 0 01-2.827 0l-4.244-4.243a8 8 0 1111.314 0z"/><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 11a3 3 0 11-6 0 3 3 0 016 0z"/>
                                </svg>
                            </div>
                            <p class="text-xs font-semibold text-gray-400 text-center group-hover:text-[#2CB38B] group-hover:underline">Pilih<br>Wisata</p>
                        </div>
                        <div class="w-full h-1 bg-gray-200 mx-2 rounded-full"></div>
                    </a>

                    <div class="flex flex-col items-center relative z-10">
                        <div class="w-16 h-16 bg-gray-200 rounded-full flex items-center justify-center mb-2">
                            <svg class="w-8 h-8 text-gray-400" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 12h6m-6 4h6m2 5H7a2 2 0 01-2-2V5a2 2 0 012-2h5.586a1 1 0 01.707.293l5.414 5.414a1 1 0 01.293.707V19a2 2 0 01-2 2z"/>
                            </svg>
                        </div>
                        <p class="text-xs font-semibold text-gray-400 text-center">Atur<br>Rencana</p>
                    </div>
                </div>
            </div>
        </div>

        <div class="container mx-auto px-6 py-4">
            <div class="flex flex-col lg:flex-row gap-8">
                <div class="w-full lg:w-80 flex-shrink-0">
                    <div class="bg-white rounded-2xl shadow-lg p-6 sticky top-44 border border-gray-100">
                        <h2 class="text-xl font-bold text-gray-800 mb-6 flex items-center gap-2">
                            <svg class="w-5 h-5 text-[#2CB38B]" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 6V4m0 2a2 2 0 100 4m0-4a2 2 0 110 4m-6 8a2 2 0 100-4m0 4a2 2 0 110-4m0 4v2m0-6V4m6 6v10m6-2a2 2 0 100-4m0 4a2 2 0 110-4m0 4v2m0-6V4"></path></svg>
                            Filter Transportasi
                        </h2>
                        
                        <div class="mb-6 pb-6 border-b border-gray-100">
                            <button class="accordion-btn flex items-center justify-between w-full text-left font-semibold text-gray-700 mb-2 hover:text-[#2CB38B] transition">
                                <span>Jenis Transportasi</span>
                                <svg class="w-5 h-5 transform transition-transform duration-200" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 9l-7 7-7-7"/></svg>
                            </button>
                            <div class="accordion-content space-y-3 pl-1">
                                <label class="flex items-center space-x-3 cursor-pointer group"><input type="checkbox" class="w-5 h-5 text-[#2CB38B] rounded border-gray-300 focus:ring-[#2CB38B]"><span class="text-gray-600 group-hover:text-[#2CB38B] transition">Bus/Travel</span></label>
                                <label class="flex items-center space-x-3 cursor-pointer group"><input type="checkbox" class="w-5 h-5 text-[#2CB38B] rounded border-gray-300 focus:ring-[#2CB38B]"><span class="text-gray-600 group-hover:text-[#2CB38B] transition">Pesawat</span></label>
                                <label class="flex items-center space-x-3 cursor-pointer group"><input type="checkbox" class="w-5 h-5 text-[#2CB38B] rounded border-gray-300 focus:ring-[#2CB38B]"><span class="text-gray-600 group-hover:text-[#2CB38B] transition">Kereta Api</span></label>
                                <label class="flex items-center space-x-3 cursor-pointer group"><input type="checkbox" class="w-5 h-5 text-[#2CB38B] rounded border-gray-300 focus:ring-[#2CB38B]"><span class="text-gray-600 group-hover:text-[#2CB38B] transition">Kapal</span></label>
                            </div>
                        </div>
                        
                        <div class="mb-6 pb-6 border-b border-gray-100">
                            <button class="accordion-btn flex items-center justify-between w-full text-left font-semibold text-gray-700 mb-2 hover:text-[#2CB38B] transition">
                                <span>Fasilitas</span>
                                <svg class="w-5 h-5 transform transition-transform duration-200" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 9l-7 7-7-7"/></svg>
                            </button>
                            <div class="accordion-content space-y-3 pl-1">
                                <label class="flex items-center space-x-3 cursor-pointer group"><input type="checkbox" class="w-5 h-5 text-[#2CB38B] rounded border-gray-300 focus:ring-[#2CB38B]"><span class="text-gray-600 group-hover:text-[#2CB38B] transition">Bagasi</span></label>
                                <label class="flex items-center space-x-3 cursor-pointer group"><input type="checkbox" class="w-5 h-5 text-[#2CB38B] rounded border-gray-300 focus:ring-[#2CB38B]"><span class="text-gray-600 group-hover:text-[#2CB38B] transition">AC</span></label>
                                <label class="flex items-center space-x-3 cursor-pointer group"><input type="checkbox" class="w-5 h-5 text-[#2CB38B] rounded border-gray-300 focus:ring-[#2CB38B]"><span class="text-gray-600 group-hover:text-[#2CB38B] transition">Makanan</span></label>
                            </div>
                        </div>

                        <div>
                            <button class="accordion-btn flex items-center justify-between w-full text-left font-semibold text-gray-700 mb-2 hover:text-[#2CB38B] transition">
                                <span>Waktu Keberangkatan</span>
                                <svg class="w-5 h-5 transform transition-transform duration-200" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 9l-7 7-7-7"/></svg>
                            </button>
                            <div class="accordion-content space-y-3 pl-1">
                                <label class="flex items-center space-x-3 cursor-pointer group"><input type="checkbox" class="w-5 h-5 text-[#2CB38B] rounded border-gray-300 focus:ring-[#2CB38B]"><span class="text-gray-600 group-hover:text-[#2CB38B] transition">Pagi (06-12)</span></label>
                                <label class="flex items-center space-x-3 cursor-pointer group"><input type="checkbox" class="w-5 h-5 text-[#2CB38B] rounded border-gray-300 focus:ring-[#2CB38B]"><span class="text-gray-600 group-hover:text-[#2CB38B] transition">Siang (12-18)</span></label>
                                <label class="flex items-center space-x-3 cursor-pointer group"><input type="checkbox" class="w-5 h-5 text-[#2CB38B] rounded border-gray-300 focus:ring-[#2CB38B]"><span class="text-gray-600 group-hover:text-[#2CB38B] transition">Malam (18-06)</span></label>
                            </div>
                        </div>
                    </div>
                </div>

                <div class="flex-1">
                    <h2 class="text-2xl font-bold text-gray-800 mb-6">Rekomendasi Transportasi</h2>
                    
                    <div class="bg-white rounded-2xl shadow-sm border border-gray-100 p-6 mb-5 hover:shadow-xl hover:border-[#2CB38B]/30 transition duration-300 group relative overflow-hidden">
                        <div class="absolute top-0 left-0 w-1 h-full bg-[#2CB38B]"></div>
                        <div class="flex flex-col md:flex-row md:items-center justify-between mb-6">
                            <div class="flex items-center gap-4">
                                <div class="w-12 h-12 bg-orange-100 rounded-full flex items-center justify-center text-2xl">🚂</div>
                                <div>
                                    <h3 class="text-xl font-bold text-gray-800 group-hover:text-[#2CB38B] transition">KA Parahyangan</h3>
                                    <span class="inline-block bg-gray-100 text-gray-500 text-xs px-2 py-1 rounded-full font-medium mt-1">Eksekutif</span>
                                </div>
                            </div>
                            <div class="text-left md:text-right mt-4 md:mt-0">
                                <p class="text-2xl font-bold text-[#2CB38B]">Rp 590.000</p>
                                <p class="text-xs text-gray-400">/ penumpang</p>
                            </div>
                        </div>
                        <div class="flex flex-col md:flex-row items-center justify-between bg-gray-50 rounded-xl p-4">
                            <div class="flex items-center justify-between w-full md:w-auto gap-8">
                                <div class="text-center"><p class="text-xl font-bold text-gray-800">21.00</p><p class="text-xs text-gray-500">BDG</p></div>
                                <div class="flex flex-col items-center">
                                    <p class="text-xs text-gray-400 font-medium mb-1">1h 45m</p>
                                    <div class="w-24 h-0.5 bg-gray-300 relative flex items-center justify-between">
                                        <div class="w-2 h-2 bg-gray-300 rounded-full"></div>
                                        <svg class="w-4 h-4 text-gray-400" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M5 12h14m-7-7l7 7-7 7"/></svg>
                                        <div class="w-2 h-2 bg-gray-300 rounded-full"></div>
                                    </div>
                                </div>
                                <div class="text-center"><p class="text-xl font-bold text-gray-800">22.45</p><p class="text-xs text-gray-500">JKT</p></div>
                            </div>
                            <button class="w-full md:w-auto mt-4 md:mt-0 bg-[#2CB38B] hover:bg-[#249d78] text-white px-6 py-3 rounded-xl font-semibold transition shadow-lg hover:shadow-green-200 flex items-center justify-center gap-2">
                                <span>Pilih Tiket</span>
                                <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M17 8l4 4m0 0l-4 4m4-4H3"/></svg>
                            </button>
                        </div>
                    </div>
                    
                    <div class="bg-white rounded-2xl shadow-sm border border-gray-100 p-6 mb-5 hover:shadow-xl hover:border-[#2CB38B]/30 transition duration-300 group relative overflow-hidden">
                        <div class="absolute top-0 left-0 w-1 h-full bg-[#2CB38B]"></div>
                        <div class="flex flex-col md:flex-row md:items-center justify-between mb-6">
                            <div class="flex items-center gap-4">
                                <div class="w-12 h-12 bg-blue-100 rounded-full flex items-center justify-center text-2xl">🚌</div>
                                <div>
                                    <h3 class="text-xl font-bold text-gray-800 group-hover:text-[#2CB38B] transition">Cititrans</h3>
                                    <span class="inline-block bg-gray-100 text-gray-500 text-xs px-2 py-1 rounded-full font-medium mt-1">Executive Shuttle</span>
                                </div>
                            </div>
                            <div class="text-left md:text-right mt-4 md:mt-0">
                                <p class="text-2xl font-bold text-[#2CB38B]">Rp 185.000</p>
                                <p class="text-xs text-gray-400">/ penumpang</p>
                            </div>
                        </div>
                        <div class="flex flex-col md:flex-row items-center justify-between bg-gray-50 rounded-xl p-4">
                            <div class="flex items-center justify-between w-full md:w-auto gap-8">
                                <div class="text-center"><p class="text-xl font-bold text-gray-800">08.00</p><p class="text-xs text-gray-500">BDG</p></div>
                                <div class="flex flex-col items-center">
                                    <p class="text-xs text-gray-400 font-medium mb-1">3h 30m</p>
                                    <div class="w-24 h-0.5 bg-gray-300 relative flex items-center justify-between">
                                        <div class="w-2 h-2 bg-gray-300 rounded-full"></div>
                                        <svg class="w-4 h-4 text-gray-400" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M5 12h14m-7-7l7 7-7 7"/></svg>
                                        <div class="w-2 h-2 bg-gray-300 rounded-full"></div>
                                    </div>
                                </div>
                                <div class="text-center"><p class="text-xl font-bold text-gray-800">11.30</p><p class="text-xs text-gray-500">JKT</p></div>
                            </div>
                            <button class="w-full md:w-auto mt-4 md:mt-0 bg-[#2CB38B] hover:bg-[#249d78] text-white px-6 py-3 rounded-xl font-semibold transition shadow-lg hover:shadow-green-200 flex items-center justify-center gap-2">
                                <span>Pilih Tiket</span>
                                <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M17 8l4 4m0 0l-4 4m4-4H3"/></svg>
                            </button>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <script>
        document.addEventListener('DOMContentLoaded', function() {
            const accordions = document.querySelectorAll('.accordion-btn');
            accordions.forEach(acc => {
                const content = acc.nextElementSibling;
                const icon = acc.querySelector('svg');
                content.style.maxHeight = content.scrollHeight + "px"; // Default open
                icon.style.transform = "rotate(180deg)";
                acc.addEventListener('click', function() {
                    if (content.style.maxHeight) {
                        content.style.maxHeight = null;
                        icon.style.transform = "rotate(0deg)";
                    } else {
                        content.style.maxHeight = content.scrollHeight + "px";
                        icon.style.transform = "rotate(180deg)";
                    }
                });
            });
        });
    </script>
</x-app-layout>