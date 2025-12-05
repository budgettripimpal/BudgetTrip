<x-app-layout>
    @push('styles')
    <link href="https://fonts.googleapis.com/css2?family=Plus+Jakarta+Sans:wght@400;500;600;700;800&display=swap" rel="stylesheet">
    <script defer src="https://cdn.jsdelivr.net/npm/alpinejs@3.x.x/dist/cdn.min.js"></script>
    <style>
        body { font-family: 'Plus Jakarta Sans', sans-serif; }
        .text-primary { color: #2CB38B; }
        .bg-primary { background-color: #2CB38B; }
        .border-primary { border-color: #2CB38B; }
        .ring-primary { --tw-ring-color: #2CB38B; }
        .hover\:text-primary:hover { color: #2CB38B; }
        .hover\:bg-primary:hover { background-color: #2CB38B; }
        
        .no-scrollbar::-webkit-scrollbar { display: none; }
        .no-scrollbar { -ms-overflow-style: none; scrollbar-width: none; }
    </style>
    @endpush

    <nav class="bg-white shadow-sm fixed w-full top-0 z-50 h-20">
        <div class="container mx-auto px-6 h-full">
            <div class="flex items-center justify-between h-full">
                <div class="flex items-center space-x-2">
                    <svg class="w-8 h-8 text-yellow-400" fill="currentColor" viewBox="0 0 24 24"><path d="M12 2C8.13 2 5 5.13 5 9c0 5.25 7 13 7 13s7-7.75 7-13c0-3.87-3.13-7-7-7zm0 9.5c-1.38 0-2.5-1.12-2.5-2.5s1.12-2.5 2.5-2.5 2.5 1.12 2.5 2.5-1.12 2.5-2.5 2.5z"/></svg>
                    <span class="text-2xl font-bold tracking-tight">
                        <span class="text-gray-900">BUDGET</span><span class="text-[#2CB38B]">TRIP</span>
                    </span>
                </div>
                <div class="hidden md:flex items-center space-x-8">
                    <a href="{{ route('dashboard') }}" class="text-gray-900 hover:text-[#2CB38B] font-bold transition">Home</a>
                    <a href="#" class="text-gray-600 hover:text-[#2CB38B] transition">About</a>
                    <a href="#" class="text-gray-600 hover:text-[#2CB38B] transition">Tutorial</a>
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
                                <svg class="w-8 h-8 text-white" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 8c-1.657 0-3 .895-3 2s1.343 2 3 2 3 .895 3 2-1.343 2-3 2m0-8c1.11 0 2.08.402 2.599 1M12 8V7m0 1v8m0 0v1m0-1c-1.11 0-2.08-.402-2.599-1M21 12a9 9 0 11-18 0 9 9 0 0118 0z"/></svg>
                            </div>
                            <p class="text-xs font-bold text-[#2CB38B] text-center group-hover:underline">Input Budget &<br>Rencana</p>
                        </div>
                        <div class="w-full h-1 bg-[#2CB38B] mx-2 rounded-full"></div>
                    </a>

                    <a href="{{ route('travel-plan.transport', $plan->planID) }}" class="flex items-center flex-1 group cursor-pointer">
                        <div class="flex flex-col items-center relative z-10">
                            <div class="w-16 h-16 bg-[#2CB38B] rounded-full flex items-center justify-center mb-2 shadow-md border-2 border-[#2CB38B] group-hover:scale-110 transition-transform">
                                <svg class="w-8 h-8 text-white" fill="currentColor" viewBox="0 0 24 24"><path d="M18 20H6c-1.1 0-2-.9-2-2V6c0-2.2 1.8-4 4-4h8c2.2 0 4 1.8 4 4v12c0 1.1-.9 2-2 2zm-2-3c1.1 0 2-.9 2-2s-.9-2-2-2-2 .9-2 2 .9 2 2 2zm-8 0c1.1 0 2-.9 2-2s-.9-2-2-2-2 .9-2 2 .9 2 2 2zm0-9h8V4H8v4z"/></svg>
                            </div>
                            <p class="text-xs font-bold text-[#2CB38B] text-center group-hover:underline">Pilih<br>Transportasi</p>
                        </div>
                        <div class="w-full h-1 bg-[#2CB38B] mx-2 rounded-full"></div>
                    </a>

                    <a href="{{ route('travel-plan.accommodation', $plan->planID) }}" class="flex items-center flex-1 group cursor-pointer">
                        <div class="flex flex-col items-center relative z-10">
                            <div class="w-16 h-16 bg-[#2CB38B] rounded-full flex items-center justify-center mb-2 shadow-md border-2 border-[#2CB38B] group-hover:scale-110 transition-transform">
                                <svg class="w-8 h-8 text-white" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M3 12l2-2m0 0l7-7 7 7M5 10v10a1 1 0 001 1h3m10-11l2 2m-2-2v10a1 1 0 01-1 1h-3m-6 0a1 1 0 001-1v-4a1 1 0 011-1h2a1 1 0 011 1v4a1 1 0 001 1m-6 0h6"/></svg>
                            </div>
                            <p class="text-xs font-bold text-[#2CB38B] text-center group-hover:underline">Pilih<br>Akomodasi</p>
                        </div>
                        <div class="w-full h-1 bg-[#2CB38B] mx-2 rounded-full"></div>
                    </a>

                    <a href="{{ route('travel-plan.attraction', $plan->planID) }}" class="flex items-center flex-1 group cursor-pointer">
                        <div class="flex flex-col items-center relative z-10">
                            <div class="w-16 h-16 bg-[#2CB38B] rounded-full flex items-center justify-center mb-2 shadow-md border-2 border-[#2CB38B] group-hover:scale-110 transition-transform">
                                <svg class="w-8 h-8 text-white" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M17.657 16.657L13.414 20.9a1.998 1.998 0 01-2.827 0l-4.244-4.243a8 8 0 1111.314 0z"/><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 11a3 3 0 11-6 0 3 3 0 016 0z"/></svg>
                            </div>
                            <p class="text-xs font-bold text-[#2CB38B] text-center group-hover:underline">Pilih<br>Wisata</p>
                        </div>
                        <div class="w-full h-1 bg-[#2CB38B] mx-2 rounded-full"></div>
                    </a>

                    <div class="flex flex-col items-center relative z-10">
                        <div class="w-16 h-16 bg-[#2CB38B] rounded-full flex items-center justify-center mb-2 shadow-lg ring-4 ring-green-100 transform scale-110">
                            <svg class="w-8 h-8 text-white" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 12h6m-6 4h6m2 5H7a2 2 0 01-2-2V5a2 2 0 012-2h5.586a1 1 0 01.707.293l5.414 5.414a1 1 0 01.293.707V19a2 2 0 01-2 2z"/></svg>
                        </div>
                        <p class="text-xs font-bold text-[#2CB38B] text-center">Atur<br>Rencana</p>
                    </div>

                </div>
            </div>
        </div>

        <div class="max-w-7xl mx-auto px-8 py-8" x-data="{ activeTab: {{ $plan->itineraries->first()->itineraryID ?? 0 }} }">
            
            <div class="mb-8">
                <h1 class="text-4xl font-bold flex items-center text-gray-900">
                    <svg class="w-10 h-10 mr-3 text-[#2CB38B]" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M5 5a2 2 0 012-2h10a2 2 0 012 2v16l-7-3.5L5 21V5z"/>
                    </svg>
                    {{ $plan->planName }}
                </h1>
                <p class="text-gray-500 mt-2 ml-14">
                    Total Budget: <span class="font-bold text-[#2CB38B]">Rp {{ number_format($plan->amount, 0, ',', '.') }}</span>
                </p>
            </div>

            <div class="grid grid-cols-1 sm:grid-cols-3 gap-4 mb-10">
                @forelse($plan->itineraries as $itinerary)
                    <div @click="activeTab = {{ $itinerary->itineraryID }}" 
                         class="p-5 border-2 rounded-lg flex justify-between items-center cursor-pointer transition"
                         :class="activeTab === {{ $itinerary->itineraryID }} ? 'border-[#2CB38B] bg-green-50' : 'border-gray-200 hover:border-teal-300'">
                        <span class="font-semibold text-gray-700 text-lg">{{ $itinerary->itineraryName }}</span>
                        <span class="w-4 h-4 rounded-full" :class="activeTab === {{ $itinerary->itineraryID }} ? 'bg-[#2CB38B]' : 'bg-gray-300'"></span>
                    </div>
                @empty
                    <div class="p-5 border-2 border-dashed border-gray-300 rounded-lg text-center text-gray-500">
                        Belum ada folder rencana. Silakan buat satu.
                    </div>
                @endforelse

                <div class="p-5 border-2 border-dashed border-gray-300 rounded-lg flex justify-center items-center hover:border-[#2CB38B] cursor-pointer transition group">
                    <span class="font-semibold text-gray-400 group-hover:text-[#2CB38B]">+ Buat Opsi Baru</span>
                </div>
            </div>

            <hr class="my-10 border-gray-200">

            @foreach($plan->itineraries as $itinerary)
            <div x-show="activeTab === {{ $itinerary->itineraryID }}" style="display: none;">
                
                <div class="mb-10">
                    <h2 class="text-2xl font-bold mb-6 text-gray-900 flex items-center gap-2">
                        <span class="bg-blue-100 text-blue-600 p-2 rounded-lg"><svg class="w-6 h-6" fill="currentColor" viewBox="0 0 24 24"><path d="M18 20H6c-1.1 0-2-.9-2-2V6c0-2.2 1.8-4 4-4h8c2.2 0 4 1.8 4 4v12c0 1.1-.9 2-2 2zm-2-3c1.1 0 2-.9 2-2s-.9-2-2-2-2 .9-2 2 .9 2 2 2zm-8 0c1.1 0 2-.9 2-2s-.9-2-2-2-2 .9-2 2 .9 2 2 2zm0-9h8V4H8v4z"/></svg></span>
                        Transportasi Pilihan
                    </h2>
                    
                    @php
                        $transports = $itinerary->planItems->where('itemType', 'Transportasi');
                    @endphp

                    @if($transports->isEmpty())
                        <p class="text-gray-500 italic">Belum ada transportasi dipilih.</p>
                    @else
                        @foreach($transports as $item)
                        <div class="border-2 border-gray-200 rounded-xl p-6 hover:border-[#2CB38B] transition mb-4 relative group">
                            <button class="absolute top-4 right-4 text-gray-400 hover:text-red-500 transition">
                                <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 7l-.867 12.142A2 2 0 0116.138 21H7.862a2 2 0 01-1.995-1.858L5 7m5 4v6m4-6v6m1-10V4a1 1 0 00-1-1h-4a1 1 0 00-1 1v3M4 7h16"/></svg>
                            </button>

                            <div class="flex items-center justify-between">
                                <div class="flex items-center flex-1">
                                    <div class="w-14 h-14 bg-blue-50 rounded-lg flex items-center justify-center mr-5 text-2xl">🚌</div>
                                    <div>
                                        <p class="font-semibold text-gray-900 text-lg">{{ $item->providerName }}</p>
                                        <p class="text-base text-gray-500">{{ $item->description }}</p>
                                    </div>
                                </div>
                                <div class="text-right mr-10">
                                    <p class="font-bold text-gray-900 text-xl">Rp {{ number_format($item->estimatedCost, 0, ',', '.') }}</p>
                                    <p class="text-sm text-gray-400">Per Orang</p>
                                </div>
                            </div>
                        </div>
                        @endforeach
                    @endif
                </div>

                <div class="mb-10">
                    <h2 class="text-2xl font-bold mb-6 text-gray-900 flex items-center gap-2">
                        <span class="bg-yellow-100 text-yellow-600 p-2 rounded-lg"><svg class="w-6 h-6" fill="currentColor" viewBox="0 0 24 24"><path d="M3 12l2-2m0 0l7-7 7 7M5 10v10a1 1 0 001 1h3m10-11l2 2m-2-2v10a1 1 0 01-1 1h-3m-6 0a1 1 0 001-1v-4a1 1 0 011-1h2a1 1 0 011 1v4a1 1 0 001 1m-6 0h6"/></svg></span>
                        Akomodasi Pilihan
                    </h2>

                    @php
                        $hotels = $itinerary->planItems->where('itemType', 'Akomodasi');
                    @endphp

                    @if($hotels->isEmpty())
                        <p class="text-gray-500 italic">Belum ada akomodasi dipilih.</p>
                    @else
                        @foreach($hotels as $item)
                        <div class="border-2 border-gray-200 rounded-xl p-6 mb-5 hover:border-[#2CB38B] transition relative group">
                             <button class="absolute top-4 right-4 text-gray-400 hover:text-red-500 transition">
                                <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 7l-.867 12.142A2 2 0 0116.138 21H7.862a2 2 0 01-1.995-1.858L5 7m5 4v6m4-6v6m1-10V4a1 1 0 00-1-1h-4a1 1 0 00-1 1v3M4 7h16"/></svg>
                            </button>

                            <div class="flex justify-between gap-6">
                                <div class="flex gap-5 flex-1">
                                    <img src="https://images.unsplash.com/photo-1566073771259-6a8506099945?w=200&h=200&fit=crop" 
                                         alt="Hotel" class="w-32 h-32 rounded-lg object-cover">
                                    <div class="flex-1">
                                        <h3 class="font-semibold text-gray-900 text-lg mb-2">{{ $item->providerName }}</h3>
                                        <p class="text-base text-gray-500 mb-4">{{ $item->description }}</p>
                                        <div class="flex gap-2">
                                            <span class="bg-gray-100 text-gray-600 text-xs px-2 py-1 rounded">WiFi</span>
                                            <span class="bg-gray-100 text-gray-600 text-xs px-2 py-1 rounded">AC</span>
                                        </div>
                                    </div>
                                </div>
                                <div class="text-right mr-10">
                                    <p class="font-bold text-gray-900 text-xl">Rp {{ number_format($item->estimatedCost, 0, ',', '.') }}</p>
                                    <p class="text-sm text-gray-400">Per Malam</p>
                                </div>
                            </div>
                        </div>
                        @endforeach
                    @endif
                </div>

                <div class="mb-10">
                    <h2 class="text-2xl font-bold mb-6 text-gray-900 flex items-center gap-2">
                        <span class="bg-purple-100 text-purple-600 p-2 rounded-lg"><svg class="w-6 h-6" fill="currentColor" viewBox="0 0 24 24"><path d="M17.657 16.657L13.414 20.9a1.998 1.998 0 01-2.827 0l-4.244-4.243a8 8 0 1111.314 0z"/><path d="M15 11a3 3 0 11-6 0 3 3 0 016 0z"/></svg></span>
                        Wisata Pilihan
                    </h2>

                    @php
                        $attractions = $itinerary->planItems->where('itemType', 'Aktivitas'); 
                        if($attractions->isEmpty()) $attractions = $itinerary->planItems->where('itemType', 'Wisata');
                    @endphp

                    @if($attractions->isEmpty())
                        <p class="text-gray-500 italic">Belum ada tempat wisata dipilih.</p>
                    @else
                        @foreach($attractions as $item)
                        <div class="border-2 border-gray-200 rounded-xl p-6 mb-5 hover:border-[#2CB38B] transition relative group">
                             <button class="absolute top-4 right-4 text-gray-400 hover:text-red-500 transition">
                                <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 7l-.867 12.142A2 2 0 0116.138 21H7.862a2 2 0 01-1.995-1.858L5 7m5 4v6m4-6v6m1-10V4a1 1 0 00-1-1h-4a1 1 0 00-1 1v3M4 7h16"/></svg>
                            </button>

                            <div class="flex justify-between items-center">
                                <div class="flex items-center gap-5 flex-1">
                                    <img src="https://images.unsplash.com/photo-1559827260-dc66d52bef19?w=150&h=150&fit=crop" 
                                         alt="Wisata" class="w-24 h-24 rounded-lg object-cover">
                                    <div>
                                        <h3 class="font-semibold text-gray-900 text-lg">{{ $item->providerName }}</h3>
                                        <p class="text-base text-gray-500">{{ $item->description }}</p>
                                    </div>
                                </div>
                                <div class="text-right mr-10">
                                    <p class="font-bold text-gray-900 text-xl">
                                        {{ $item->estimatedCost == 0 ? 'Gratis' : 'Rp '.number_format($item->estimatedCost, 0, ',', '.') }}
                                    </p>
                                    <p class="text-sm text-gray-400">Per Orang</p>
                                </div>
                            </div>
                        </div>
                        @endforeach
                    @endif
                </div>

            </div>
            @endforeach

            <div class="flex justify-between mt-10">
                <a href="{{ route('travel-plan.attraction', $plan->planID) }}" class="px-8 py-3 bg-gray-200 text-gray-700 rounded-full hover:bg-gray-300 font-bold transition">
                    &larr; Kembali ke Wisata
                </a>
                <a href="{{ route('travel-plan.index') }}" class="px-10 py-3 bg-[#2CB38B] text-white rounded-full hover:bg-[#249d78] font-bold shadow-lg transition transform hover:-translate-y-1">
                    Simpan & Selesai
                </a>
            </div>

        </div>
    </div>
</x-app-layout>